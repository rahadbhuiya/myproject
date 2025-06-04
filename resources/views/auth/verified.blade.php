<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- <x-authentication-card-logo /> -->
        </x-slot>

        <div class="mb-4 text-sm text-green-600 dark:text-green-400">
            {{ __('Your email has been successfully verified!') }}
        </div>

        <div class="mt-4">
            <a href="{{ route('dashboard') }}">
                <x-button>
                    {{ __('Go to Dashboard') }}
                </x-button>
            </a>
        </div>
    </x-authentication-card>
</x-guest-layout>
