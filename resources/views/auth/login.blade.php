<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- <h1 class="text-4xl font-extrabold text-white drop-shadow-lg tracking-wide select-none" style="font-family: 'Orbitron', sans-serif;">
                KalaChan Login
            </h1> -->
        </x-slot>

        <x-validation-errors class="mb-6" />

        @if (session('status'))
            <div class="mb-6 px-4 py-3 rounded-md bg-green-100 text-green-800 text-center text-sm font-semibold shadow-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" autocomplete="off" class="space-y-6">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" class="text-gray-300" />
                <x-input
                    id="email"
                    class="block mt-1 w-full rounded-md border border-gray-600 bg-gray-900 text-white placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1 transition"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="off"
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
                    placeholder="Type your password"
                />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center cursor-pointer select-none">
                    <x-checkbox id="remember_me" name="remember" class="rounded text-indigo-600 focus:ring-indigo-500" />
                    <span class="ml-2 text-sm text-gray-400 hover:text-gray-200">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-sm text-indigo-400 hover:text-indigo-600 underline transition"
                    >
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div>
                <x-button class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-2 focus:ring-offset-2 transition font-semibold text-lg rounded-md shadow-md">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
