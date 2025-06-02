<x-guest-layout>
    <x-authentication-card class="bg-gray-900 p-8 rounded-lg shadow-xl">
        <x-slot name="logo">
            <!-- Optional: Insert your logo component here -->
        </x-slot>

        <p class="mb-6 text-gray-300 leading-relaxed text-base">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>

        @session('status')
            <div class="mb-6 text-green-500 font-semibold text-sm">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-6 text-red-400" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <div>
                <x-label for="email" class="text-gray-300" value="{{ __('Email') }}" />
                <x-input
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="you@example.com"
                    class="mt-1 block w-full rounded-md bg-gray-800 border border-gray-700 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1 transition"
                />
            </div>

            <div class="flex justify-end">
                <x-button
                    class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-2 focus:ring-offset-2 font-semibold px-6 py-3 rounded-md shadow-lg transition"
                >
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
