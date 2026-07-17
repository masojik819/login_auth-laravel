<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Two Factor Authentication
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Lindungi akun Anda dengan Google Authenticator.
        </p>
    </header>

    <div class="mt-6">

        {{-- Enable --}}
        @if (! auth()->user()->two_factor_secret)

            <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                @csrf

                <x-primary-button>
                    Enable Two Factor
                </x-primary-button>
            </form>

        @else

            <div class="rounded-lg border p-6">

                @if (! auth()->user()->two_factor_confirmed_at)

                    <h3 class="text-lg font-semibold text-gray-900">
                        Finish enabling Two Factor Authentication
                    </h3>

                    <p class="mt-2 text-sm text-gray-600">
                        Scan QR Code berikut menggunakan Google Authenticator,
                        kemudian masukkan kode OTP untuk menyelesaikan aktivasi.
                    </p>

                @else

                    <h3 class="text-lg font-semibold text-green-700">
                        Two Factor Authentication Enabled
                    </h3>

                @endif

                {{-- QR CODE --}}
                <div class="mt-5">
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>

                {{-- Recovery Codes --}}
                <div class="mt-6">

                    <h4 class="font-semibold">
                        Recovery Codes
                    </h4>

                    <div class="mt-3 rounded-lg bg-gray-100 p-4 font-mono text-sm space-y-1">
                        @foreach (auth()->user()->recoveryCodes() as $code)
                            <div>{{ $code }}</div>
                        @endforeach
                    </div>

                </div>

                {{-- Confirm OTP --}}
                @if (! auth()->user()->two_factor_confirmed_at)

                    <form
                        method="POST"
                        action="{{ url('/user/confirmed-two-factor-authentication') }}"
                        class="mt-8">

                        @csrf

                        <div>

                            <x-input-label
                                for="code"
                                value="Authentication Code" />

                            <x-text-input
                                id="code"
                                name="code"
                                type="text"
                                class="mt-2 block w-full"
                                autocomplete="one-time-code"
                                required />

                            <x-input-error
                                :messages="$errors->get('code')"
                                class="mt-2" />

                        </div>

                        <div class="mt-5">

                            <x-primary-button>
                                Confirm
                            </x-primary-button>

                        </div>

                    </form>

                @endif

                {{-- Action Buttons --}}
                <div class="mt-8 flex gap-3">

                    <form
                        method="POST"
                        action="{{ url('/user/two-factor-recovery-codes') }}">

                        @csrf

                        <x-secondary-button>
                            Regenerate Recovery Codes
                        </x-secondary-button>

                    </form>

                    <form
                        method="POST"
                        action="{{ url('/user/two-factor-authentication') }}">

                        @csrf
                        @method('DELETE')

                        <x-danger-button>
                            Disable
                        </x-danger-button>

                    </form>

                </div>

            </div>

        @endif

    </div>
</section>