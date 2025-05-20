<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mt-4 mb-4">
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('users.store') }}"> 
                        @csrf
 
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
 
                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('Send Invitation') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <table class="mt-8 w-full text-left text-sm text-gray-500"> 
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700">
                            <th scope="col" class="px-6 py-3 text-left">{{ __('Email') }}</th>
                            <th scope="col" class="px-6 py-3 text-left">{{ __('Sent on') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($invitations as $invitation)
                                <tr class="border-b bg-white dark:bg-gray-800">
                                    <td class="px-6 py-4 font-medium text-gray-900whitespace-nowrap">
                                        {{ $invitation->email }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900whitespace-nowrap">
                                        {{ $invitation->created_at }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>