@php
    $dashboardRoute = 'dashboard';

    if (auth()->user()?->hasRole('Admin')) {
        $dashboardRoute = 'admin.dashboard';
    } elseif (auth()->user()?->hasRole('Manager')) {
        $dashboardRoute = 'manager.dashboard';
    }

    $navItems = [
        ['label' => 'Dashboard', 'route' => $dashboardRoute, 'active' => request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') || request()->routeIs('manager.dashboard')],
        ['label' => 'Profile', 'route' => 'profile.edit', 'active' => request()->routeIs('profile.edit')],
    ];

    if (auth()->user()?->hasRole('Admin')) {
        $navItems = array_merge($navItems, [
            ['label' => 'Staff', 'route' => 'staff.index', 'active' => request()->routeIs('staff.*')],
            ['label' => 'Branches', 'route' => 'branch.index', 'active' => request()->routeIs('branch.*')],
            ['label' => 'Admin', 'route' => 'admin.dashboard', 'active' => request()->routeIs('admin*')],
        ]);
    } elseif (auth()->user()?->hasRole('Manager')) {
        $navItems = array_merge($navItems, [
            ['label' => 'Staff', 'route' => 'staff.index', 'active' => request()->routeIs('staff.*')],
            ['label' => 'Create Staff', 'route' => 'manager.create', 'active' => request()->routeIs('manager.create')],
            ['label' => 'Create Lease', 'route' => 'lease.create', 'active' => request()->routeIs('lease.create')],
        ]);
    } else {
        $navItems = array_merge($navItems, [
            ['label' => 'Find a Home', 'route' => 'home.find', 'active' => request()->routeIs('home.find')],
            ['label' => 'Services', 'route' => 'services', 'active' => request()->routeIs('services')],
            ['label' => 'About Us', 'route' => 'about', 'active' => request()->routeIs('about')],
            ['label' => 'Contact', 'route' => 'contact', 'active' => request()->routeIs('contact')],
        ]);
    }
@endphp

<button
    type="button"
    class="fixed left-4 top-4 z-50 inline-flex h-10 w-10 items-center justify-center rounded-md border border-gray-200 bg-white text-gray-600 shadow-sm transition hover:bg-gray-50 lg:hidden"
    @click="sidebarOpen = ! sidebarOpen"
    aria-label="Toggle navigation"
>
    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

<div
    x-show="sidebarOpen"
    x-transition.opacity
    class="fixed inset-0 z-30 bg-gray-950/30 lg:hidden"
    @click="sidebarOpen = false"
></div>

<aside
    class="fixed top-4 bottom-0 left-0 z-40 flex flex-col border-r border-gray-200 bg-white shadow-sm transition-all duration-300"
    :class="[
        sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0',
        sidebarOpen ? 'w-64' : 'lg:w-20'
    ]"
>
    <div class="flex h-16 items-center gap-3 border-b border-gray-100 px-4" :class="sidebarOpen ? 'justify-between' : 'justify-center'">
        @php
            $user = Auth::user();
            $userType = $user?->user_type;
            $isAdminOrManagement = in_array(strtolower($userType ?? ''), ['admin', 'management'], true) || $user?->hasRole(['Admin','Manager']);
        @endphp
        <a href="{{ $isAdminOrManagement ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-3 overflow-hidden">
            <x-application-logo class="h-9 w-auto shrink-0 fill-current text-gray-800" />
            <span x-show="sidebarOpen" x-cloak class="whitespace-nowrap font-serif text-lg font-semibold tracking-widest text-gray-950">
                DREAM
            </span>
        </a>

        <button
            type="button"
            class="hidden h-9 w-9 shrink-0 items-center justify-center rounded-md text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 lg:inline-flex"
            @click="sidebarOpen = ! sidebarOpen"
            aria-label="Toggle sidebar"
        >
            <svg x-show="sidebarOpen" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <svg x-show="! sidebarOpen" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

    <div class="border-b border-gray-100 px-4 py-5">
        <div class="mb-4 flex items-center" :class="sidebarOpen ? 'justify-start gap-3' : 'justify-center'">
            @if (Auth::user()->profile_photo_path)
                <img src="{{ asset('storage/'.Auth::user()->profile_photo_path) }}"
                     class="h-12 w-12 rounded-full border-2 border-white object-cover shadow-sm"
                     alt="{{ Auth::user()->name }}">
            @else
                <div class="flex h-12 w-12 items-center justify-center rounded-full border-2 border-white bg-gray-100 text-sm font-bold text-gray-700 shadow-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            @endif

            <div x-show="sidebarOpen" x-cloak class="min-w-0">
                <p class="truncate text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                <p class="truncate text-xs text-gray-500">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <x-dropdown align="left" width="48">
            <x-slot name="trigger">
                <button class="flex w-full items-center rounded-md text-left text-sm font-medium text-gray-600 transition hover:text-gray-900" :class="sidebarOpen ? 'justify-between' : 'justify-center'">
                    <span x-show="sidebarOpen" x-cloak class="truncate">Account Options</span>
                    <span x-show="! sidebarOpen" x-cloak class="text-xs font-semibold">...</span>
                    <svg x-show="sidebarOpen" x-cloak class="h-4 w-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>

    @php
        $user = Auth::user();
        $userType = $user?->user_type;
        $isAdminOrManagement = in_array(strtolower($userType ?? ''), ['admin', 'management'], true) || $user?->hasRole(['Admin','Manager']);
        $isRenter = strtolower($userType ?? '') === 'renter' || $user?->hasRole('Renter');
    @endphp

    <nav class="flex-1 space-y-1 px-3 py-5">
        @foreach ($navItems as $item)
            @continue(
                ($isRenter && in_array($item['label'], ['Staff', 'Branches', 'Admin'], true)) ||
                (!$isRenter && in_array($item['label'], ['Find a Home', 'Services', 'About Us', 'Contact'], true))
            )

            <a href="{{ $item['route'] === 'dashboard' ? ($isAdminOrManagement ? route('admin.dashboard') : route('dashboard')) : route($item['route']) }}"
               class="group flex items-center rounded-md px-3 py-2 text-sm font-medium transition"
               :class="sidebarOpen ? 'justify-start' : 'justify-center'"
               title="{{ $item['label'] }}"
            >
                <span class="{{ $item['active'] ? 'border-indigo-500 text-gray-950' : 'border-transparent text-gray-600 group-hover:text-gray-950' }} flex w-full items-center border-b-2 pb-2 transition"
                      :class="sidebarOpen ? 'justify-start' : 'justify-center'">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded text-xs font-bold {{ $item['active'] ? 'bg-indigo-50 text-indigo-600' : 'bg-gray-50 text-gray-500 group-hover:bg-gray-100' }}">
                        {{ strtoupper(substr($item['label'], 0, 1)) }}
                    </span>
                    <span x-show="sidebarOpen" x-cloak class="ml-3 whitespace-nowrap">{{ $item['label'] }}</span>
                </span>
            </a>
        @endforeach
    </nav>
</aside>

