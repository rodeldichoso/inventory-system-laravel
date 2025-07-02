<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-amber-800 dark:text-amber-300" />
            <x-text-input id="email" class="block mt-1 w-full border-amber-300 dark:border-amber-600 focus:border-amber-500 focus:ring-amber-500 dark:focus:border-amber-400 dark:focus:ring-amber-400 bg-yellow-50 dark:bg-gray-900 text-amber-900 dark:text-amber-200 placeholder-amber-400" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-amber-600 dark:text-amber-400" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-amber-800 dark:text-amber-300" />

            <x-text-input id="password" class="block mt-1 w-full border-amber-300 dark:border-amber-600 focus:border-amber-500 focus:ring-amber-500 dark:focus:border-amber-400 dark:focus:ring-amber-400 bg-yellow-50 dark:bg-gray-900 text-amber-900 dark:text-amber-200 placeholder-amber-400" type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-amber-600 dark:text-amber-400" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-amber-300 dark:border-amber-600 text-amber-600 shadow-sm focus:ring-amber-500 dark:focus:ring-amber-400 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-amber-700 dark:text-amber-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-amber-700 dark:text-amber-400 hover:text-amber-900 dark:hover:text-yellow-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 dark:focus:ring-offset-gray-800 transition" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-primary-button class="ms-3 bg-amber-600 hover:bg-amber-700 focus:ring-amber-500 border-amber-600 shadow-lg text-white">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="mt-4">
            <p class="text-sm text-amber-700 dark:text-amber-400 flex justify-end">
                <a href="{{ route('register') }}" class="ml-1 text-amber-600 dark:text-amber-400 hover:text-amber-800 dark:hover:text-yellow-200 font-bold underline transition">
                    {{ __('Don\'t have an account? Register') }}
                </a>
            </p>
    </form>
</x-guest-layout>