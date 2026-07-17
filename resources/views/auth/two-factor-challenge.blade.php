<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-md bg-red-100 p-4 text-red-700">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('two-factor.login.store') }}">
        @csrf

        <div>
            <x-input-label for="code" :value="__('Authentication Code')" />

            <x-text-input
                id="code"
                class="block mt-1 w-full"
                type="text"
                name="code"
                inputmode="numeric"
                autocomplete="one-time-code"
                autofocus
            />

            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-primary-button>
                {{ __('Verify') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 border-t pt-6">
        <p class="text-sm text-gray-600 mb-3">
            {{ __('Or enter one of your recovery codes.') }}
        </p>

        <form method="POST" action="{{ route('two-factor.login.store') }}">
            @csrf

            <div>
                <x-input-label for="recovery_code" :value="__('Recovery Code')" />

                <x-text-input
                    id="recovery_code"
                    class="block mt-1 w-full"
                    type="text"
                    name="recovery_code"
                    autocomplete="one-time-code"
                />

                <x-input-error :messages="$errors->get('recovery_code')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button>
                    {{ __('Use Recovery Code') }}
                </x-secondary-button>
            </div>
        </form>
    </div>
</x-guest-layout>