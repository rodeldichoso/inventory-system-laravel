<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-amber-900">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-amber-700">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-400 hover:bg-red-500 border-amber-200">{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-amber-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-amber-700">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input id="password" name="password" type="password" class="w-full rounded px-3 py-2 bg-amber-50 text-amber-900 border border-amber-200 focus:ring-2 focus:ring-amber-400 mt-1 block w-3/4" placeholder="{{ __('Password') }}" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <button type="button" @click="show = false" class="bg-gray-200 text-amber-900 hover:bg-gray-300 font-bold rounded-lg px-6 py-2 transition">{{ __('Cancel') }}</button>
                <x-danger-button class="ml-3 bg-red-400 hover:bg-red-500">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>