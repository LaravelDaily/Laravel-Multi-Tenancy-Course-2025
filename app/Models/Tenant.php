<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = ['name', 'subdomain'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('is_owner');
    }
}
