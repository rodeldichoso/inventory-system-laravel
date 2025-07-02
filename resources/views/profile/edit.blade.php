<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="p-6 sm:p-10 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 border-4 border-amber-200 rounded-2xl shadow-lg">
                <div class="max-w-xl mx-auto">
                    <h2 class="text-3xl font-bold text-amber-900 mb-6 flex items-center gap-2"><span>👤</span> Profile Information</h2>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-10 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 border-4 border-amber-200 rounded-2xl shadow-lg">
                <div class="max-w-xl mx-auto">
                    <h2 class="text-2xl font-bold text-amber-900 mb-6 flex items-center gap-2"><span>🔒</span> Update Password</h2>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-10 bg-gradient-to-br from-yellow-100 via-amber-100 to-yellow-200 border-4 border-amber-200 rounded-2xl shadow-lg">
                <div class="max-w-xl mx-auto">
                    <h2 class="text-2xl font-bold text-amber-900 mb-6 flex items-center gap-2"><span>⚠️</span> Delete Account</h2>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>