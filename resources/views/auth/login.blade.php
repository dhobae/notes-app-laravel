<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        {{-- <div class="block mt-4"> --}}
        <div class="flex items-center justify-between mt-4">
            <div>

                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                {{-- <span class="ms-2 text-sm text-gray-600"></span> --}}
                <label for="remember_me" class="ms-1 text-sm text-gray-600">
                    {{ __('Remember me') }}
                </label>
            </div>
            <div class="">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </div>

        {{-- <div class="flex items-center justify-center mt-4">
            <div>tes</div>
            <div>tes2</div>
        </div> --}}
        {{-- </div> --}}

        <div class="flex items-center justify-between mt-4 gap-2 pb-3 border-b-2">
            <x-secondary-button>
                <a href="auth/redirect" class="flex items-center gap-2">
                    Login/Register With
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                        <path
                            d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
                    </svg>
                </a>
            </x-secondary-button>
            <x-primary-button class="me-2">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="flex justify-center items-center pt-3">


            <div class="ms-2">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('register') }}">
                    {{ __('Don`t Have Account?') }}
                </a>
            </div>
        </div>
    </form>


</x-guest-layout>
