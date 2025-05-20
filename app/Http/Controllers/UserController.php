<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUserRequest;
use App\Models\Invitation;
use App\Notifications\SendInvitationNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(): View
    {
        $invitations = Invitation::where('tenant_id', auth()->user()->current_tenant_id)
            ->latest()
            ->get(); 

        return view('users.index', compact('invitations'));
    }

    public function store(StoreUserRequest $request): RedirectResponse 
    {
        $invitation = Invitation::create([
            'tenant_id' => auth()->user()->current_tenant_id,
            'email' => $request->input('email'),
            'token' => Str::random(32),
        ]);

        Notification::route('mail', $request->input('email'))->notify(new SendInvitationNotification($invitation)); 
 
        return redirect()->route('users.index')->with('success', 'Invitation sent successfully');
    } 

    public function acceptInvitation(string $token)
    {
        $invitation = Invitation::where('token', $token) 
            ->whereNull('accepted_at')
            ->firstOrFail();
            
        if (auth()->check()) { 
            $invitation->update(['accepted_at' => now()]); 
 
            auth()->user()->tenants()->attach($invitation->tenant_id);
 
            auth()->user()->update(['current_tenant_id' => $invitation->tenant_id]);
 
            $tenantDomain = str_replace('://', '://' . $invitation->tenant->subdomain . '.', config('app.url'));
            return redirect($tenantDomain . route('dashboard', absolute: false));
        } else {
            return redirect()->route('register', ['token' => $invitation->token]); 
        }
    }
}