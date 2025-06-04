<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- <x-authentication-card-logo /> -->
        </x-slot>

        <x-validation-errors class="mb-6" />

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <x-label for="email" value="{{ __('Email') }}" class="text-gray-300" />
                <x-input
                    id="email"
                    class="block mt-1 w-full rounded-md border border-gray-600 bg-gray-900 text-white placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1 transition"
                    type="email"
                    name="email"
                    :value="old('email', $request->email)"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="you@example.com"
                />
            </div>

            <div>
                <x-label for="password" value="{{ __('Password') }}" class="text-gray-300" />
                <x-input
                    id="password"
                    class="block mt-1 w-full rounded-md border border-gray-600 bg-gray-900 text-white placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1 transition"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Enter your new password"
                />
            </div>

            <div>
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-gray-300" />
                <x-input
                    id="password_confirmation"
                    class="block mt-1 w-full rounded-md border border-gray-600 bg-gray-900 text-white placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1 transition"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm your new password"
                />
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-button
                    class="py-3 px-8 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-2 focus:ring-offset-2 rounded-md shadow-lg font-semibold text-lg transition"
                >
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
