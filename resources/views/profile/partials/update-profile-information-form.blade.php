<section>
    <header>
        <h2 class="text-lg font-bold text-amber-900">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-amber-700">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-amber-900 font-bold" />
            <x-text-input id="name" name="name" type="text" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200 focus:ring-2 focus:ring-amber-400 mt-1" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-amber-900 font-bold" />
            <x-text-input id="email" name="email" type="email" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200 focus:ring-2 focus:ring-amber-400 mt-1" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-amber-700">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="underline text-sm text-amber-600 hover:text-amber-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>
            </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-amber-600 hover:bg-amber-700 focus:ring-amber-400">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-amber-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>