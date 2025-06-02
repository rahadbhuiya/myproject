<x-guest-layout>
    <x-authentication-card class="max-w-md mx-auto p-8 shadow-lg rounded-xl bg-white dark:bg-gray-900">
        <x-slot name="logo">
            <!-- Optional: Add a sleek logo here -->
        </x-slot>

        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 text-center">
            {{ __('Verify Your Email Address') }}
        </h2>

        <p class="mb-6 text-center text-gray-600 dark:text-gray-300 leading-relaxed">
            {{ __('Check your inbox for the verification link. Need another? Just ask!') }}
        </p>

        @if (session('status') == 'verification-link-sent')
            <div
                class="mb-6 text-center text-green-600 dark:text-green-400 font-medium bg-green-50 dark:bg-green-900 rounded-lg px-4 py-3 shadow-inner"
                role="alert"
            >
                {{ __('A new verification link has been sent to your email.') }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:justify-center gap-4">
            <form method="POST" action="{{ route('verification.send') }}" class="flex-grow">
                @csrf
                <button
                    type="submit"
                    class="w-full px-6 py-3 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-700 text-white font-semibold rounded-lg shadow-md transition duration-200"
                >
                    {{ __('Resend Verification Email') }}
                </button>
            </form>

            <!-- <a
                href="{{ route('profile.show') }}"
                class="flex items-center justify-center w-full px-6 py-3 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-700 transition duration-200 font-medium"
            >
                {{ __('Edit Profile') }}
            </a> 
        </div> -->

        <form method="POST" action="{{ route('logout') }}" class="mt-6 text-center">
            @csrf
            <button
                type="submit"
                class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 underline focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded transition duration-150"
            >
                {{ __('Log Out') }}
            </button>
        </form>
    </x-authentication-card>
</x-guest-layout>
