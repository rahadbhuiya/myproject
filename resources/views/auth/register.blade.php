<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- <h1 class="text-4xl font-extrabold text-white drop-shadow-lg tracking-wide select-none mb-6" style="font-family: 'Orbitron', sans-serif;">
              KalaChan  Register
            </h1> -->
        </x-slot>

        <x-validation-errors class="mb-6" />

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" class="text-gray-300" />
                <x-input
                    id="name"
                    class="block mt-1 w-full rounded-md border border-gray-600 bg-gray-900 text-white placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1 transition"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Your full name"
                />
            </div>

            <div>
                <x-label for="email" value="{{ __('Email') }}" class="text-gray-300" />
                <x-input
                    id="email"
                    class="block mt-1 w-full rounded-md border border-gray-600 bg-gray-900 text-white placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1 transition"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
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
                    placeholder="At least 8 characters"
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
                    placeholder="Re-enter your password"
                />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms" class="cursor-pointer select-none">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" class="rounded text-indigo-600 focus:ring-indigo-500" required />
                            <div class="ml-2 text-sm text-gray-400 hover:text-gray-200 leading-tight">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline hover:text-indigo-500 transition">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline hover:text-indigo-500 transition">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-between mt-6">
                <a
                    href="{{ route('login') }}"
                    class="text-sm text-indigo-400 hover:text-indigo-600 underline transition rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    {{ __('Already registered?') }}
                </a>

                <x-button class="py-3 px-8 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-2 focus:ring-offset-2 rounded-md shadow-lg font-semibold text-lg transition">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
