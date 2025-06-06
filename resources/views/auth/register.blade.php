<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        @empty(! $invitationEmail)
            <input type="hidden" name="token" value="{{ request('token') }}">
        @endempty

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $invitationEmail)" required autocomplete="email" :disabled="! is_null($invitationEmail)" /> 
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Subdomain -->
        @empty($invitationEmail) 
        <div class="mt-4">
            <x-input-label for="subdomain" :value="__('Subdomain')" />
            <x-text-input id="subdomain" class="block mt-1 mr-2 w-full" type="text" name="subdomain" :value="old('subdomain')" required />
            <x-input-error :messages="$errors->get('subdomain')" class="mt-2" />
        </div>
        @endempty

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
