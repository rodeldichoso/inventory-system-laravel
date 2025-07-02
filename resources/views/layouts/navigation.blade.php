<style>
    .nav-link-active {
        border-bottom: 3px solid #f59e42 !important;
        color: #b45309 !important;
        background: none !important;
    }

    /* Fix Breeze dropdown clipping and stacking on mobile/Android */
    nav,
    nav * {
        overflow: visible !important;
    }

    nav {
        z-index: 9999 !important;
        position: relative !important;
    }

    .dropdown-menu,
    .dropdown-menu * {
        z-index: 99999 !important;
        position: relative !important;
    }

    .breeze-account-trigger {
        z-index: 100000 !important;
        position: relative !important;
        width: 100%;
        min-width: 44px;
        min-height: 44px;
        touch-action: manipulation;
    }

    @media (max-width: 640px) {
        .breeze-account-trigger {
            width: 100% !important;
            display: block !important;
        }

        .mobile-nav-menu {
            width: 100vw !important;
            left: 0 !important;
            right: 0 !important;
            border-radius: 0 !important;
            min-width: 0 !important;
            max-width: 100vw !important;
        }
    }

    [x-cloak] {
        display: none !important;
    }
</style>

<nav x-data="{ open: false }" class="bg-gradient-to-r from-yellow-100 via-amber-100 to-yellow-200 dark:from-gray-900 dark:via-amber-900 dark:to-gray-800 border-b border-amber-200 dark:border-amber-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-amber-500 dark:text-amber-400" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" :class="request()->routeIs('dashboard') ? 'nav-link-active' : ''">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" :class="request()->routeIs('products.*') ? 'nav-link-active' : ''">
                        {{ __('Products') }}
                    </x-nav-link>
                    <x-nav-link :href="route('orderitems.index')" :active="request()->routeIs('orderitems.*')" :class="request()->routeIs('orderitems.*') ? 'nav-link-active' : ''">
                        {{ __('Sales') }}
                    </x-nav-link>
                    <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')" :class="request()->routeIs('orders.*') ? 'nav-link-active' : ''">
                        {{ __('Orders') }}
                    </x-nav-link>
                    <x-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')" :class="request()->routeIs('suppliers.*') ? 'nav-link-active' : ''">
                        {{ __('Suppliers') }}
                    </x-nav-link>
                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" :class="request()->routeIs('categories.*') ? 'nav-link-active' : ''">
                        {{ __('Categories') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-amber-900 dark:text-yellow-200 bg-gradient-to-r from-yellow-200 via-amber-100 to-yellow-300 dark:from-gray-800 dark:via-amber-900 dark:to-yellow-900 hover:text-amber-700 dark:hover:text-yellow-300 hover:bg-yellow-100 dark:hover:bg-amber-900 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Expandable Mobile Nav -->
            <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4" class="sm:hidden w-full absolute left-0 top-16 bg-gradient-to-r from-yellow-100 via-amber-100 to-yellow-200 border-b-2 border-amber-200 shadow-lg z-50">
                <div class="pt-2 pb-3 space-y-1 px-4">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                        {{ __('Products') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('orderitems.index')" :active="request()->routeIs('orderitems.*')">
                        {{ __('Sales') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">
                        {{ __('Orders') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')">
                        {{ __('Suppliers') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                        {{ __('Categories') }}
                    </x-responsive-nav-link>
                </div>
                <div class="pt-4 pb-1 border-t border-amber-200 px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1 px-4 pb-4">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>