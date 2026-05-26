@php
<<<<<<< HEAD
    $user = auth()->user();

    $dashboardRoute = 'dashboard';

    if (($user?->hasRole('Admin')) || (strtolower($user?->user_type ?? '') === 'admin')) {
        $dashboardRoute = 'admin.dashboard';
    } elseif (($user?->hasRole('Manager')) || (strtolower($user?->user_type ?? '') === 'manager')) {
        $dashboardRoute = 'manager.dashboard';
    }


    $navItems = [
        [
            'label' => 'Dashboard',
            'route' => $dashboardRoute,
            'active' =>
                request()->routeIs('dashboard') ||
                request()->routeIs('admin.dashboard') ||
                request()->routeIs('manager.dashboard'),
        ],

        [
            'label' => 'Profile',
            'route' => 'profile.edit',
            'active' => request()->routeIs('profile.edit'),
        ],
    ];

    // ADMIN
    if (($user?->hasRole('Admin')) || (strtolower($user?->user_type ?? '') === 'admin')) {


=======
    $user = Auth::user();
    $profilePhotoUrl = null;

    if ($user?->profile_photo_path) {
        $isExternalPhoto = str_starts_with($user->profile_photo_path, 'http://')
            || str_starts_with($user->profile_photo_path, 'https://');

        if ($isExternalPhoto) {
            $profilePhotoUrl = $user->profile_photo_path;
        } elseif (Storage::disk('public')->exists($user->profile_photo_path)) {
            $profilePhotoUrl = Storage::disk('public')->url($user->profile_photo_path);
        }
    }

    $userType = strtolower($user?->user_type ?? '');
    $isManagementUser = in_array($userType, ['admin', 'manager', 'management', 'staff', 'supervisor'], true)
        || $user?->hasRole(['Admin', 'Manager', 'Staff', 'Supervisor']);
    $isClientUser = $user && ! $isManagementUser;
    $dashboardRoute = 'dashboard';

    if ($user?->hasRole('Admin')) {
        $dashboardRoute = 'admin.dashboard';
    } elseif ($user?->hasRole('Manager')) {
        $dashboardRoute = 'manager.dashboard';
    }

    $navItems = [];

    if ($isClientUser) {
        $navItems = [
            ['label' => 'Dashboard', 'route' => 'dashboard', 'active' => request()->routeIs('dashboard')],
            ['label' => 'Browse Properties', 'href' => route('dashboard').'#browse-properties', 'active' => request()->routeIs('home.find')],
            ['label' => 'My Viewings', 'href' => route('dashboard').'#my-viewings', 'active' => request()->routeIs('viewing.create')],
            ['label' => 'My Lease', 'href' => route('dashboard').'#my-lease', 'active' => false],
            ['label' => 'Profile', 'route' => 'profile.edit', 'active' => request()->routeIs('profile.edit')],
            ['label' => 'Notifications', 'href' => route('dashboard').'#notifications', 'active' => false],
        ];
    } elseif ($user) {
        $navItems = [
            ['label' => 'Dashboard', 'route' => $dashboardRoute, 'active' => request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') || request()->routeIs('manager.dashboard')],
            ['label' => 'Profile', 'route' => 'profile.edit', 'active' => request()->routeIs('profile.edit')],
        ];
    }

    if ($user?->hasRole('Admin')) {
>>>>>>> 4d8fd99ccfa23617e6d133e307f9932fcfbcb2b4
        $navItems = array_merge($navItems, [

            [
                'label' => 'Staff',
                'route' => 'staff.index',
                'active' => request()->routeIs('staff.*'),
            ],

            [
                'label' => 'Properties',
                'route' => 'property.create',
                'active' => request()->routeIs('property.*'),
            ],

            [
                'label' => 'Branches',
                'route' => 'branch.index',

                'active' => request()->routeIs('branch.*'),
            ],
        ]);
<<<<<<< HEAD

    // MANAGER
    } elseif ($user?->hasRole('Manager')) {

        $navItems = array_merge($navItems, [

            [
                'label' => 'Staff',
                'route' => 'staff.index',
                'active' => request()->routeIs('staff.*'),
            ],

            [
                'label' => 'Properties',
                'route' => 'property.create',
                'active' => request()->routeIs('property.*'),
            ],

            [
                'label' => 'Create Staff',
                'route' => 'manager.create',
                'active' => request()->routeIs('manager.create'),
            ],
        ]);
    

    // RENTER / USER
    } else {

        $navItems = array_merge($navItems, [

            [
                'label' => 'Find a Home',
                'route' => 'home.find',
                'active' => request()->routeIs('home.find'),
            ],

            [
                'label' => 'Services',
                'route' => 'services',
                'active' => request()->routeIs('services'),
            ],

            [
                'label' => 'About Us',
                'route' => 'about',
                'active' => request()->routeIs('about'),
            ],

            [
                'label' => 'Contact',
                'route' => 'contact',
                'active' => request()->routeIs('contact'),
            ],
=======
    } elseif ($user?->hasRole('Manager')) {
        $navItems = array_merge($navItems, [
            ['label' => 'Staff', 'route' => 'manager.staff.index', 'active' => request()->routeIs('manager.staff.*')],
            ['label' => 'Create Staff', 'route' => 'manager.create', 'active' => request()->routeIs('manager.create')],
            ['label' => 'Create Lease', 'route' => 'lease.create', 'active' => request()->routeIs('lease.create')],
        ]);
    } elseif (! $user) {
        $navItems = array_merge($navItems, [
            ['label' => 'Find a Home', 'route' => 'home.find', 'active' => request()->routeIs('home.find')],
            ['label' => 'List Property', 'route' => 'property.list', 'active' => request()->routeIs('property.list')],
            ['label' => 'Services', 'route' => 'services', 'active' => request()->routeIs('services')],
            ['label' => 'About Us', 'route' => 'about', 'active' => request()->routeIs('about')],
            ['label' => 'Contact', 'route' => 'contact', 'active' => request()->routeIs('contact')],
>>>>>>> 4d8fd99ccfa23617e6d133e307f9932fcfbcb2b4
        ]);
    }
@endphp

<button
    type="button"
    class="fixed left-4 top-4 z-50 inline-flex h-10 w-10 items-center justify-center rounded-md border border-gray-200 bg-white text-gray-600 shadow-sm transition hover:bg-gray-50 lg:hidden"
    @click="sidebarOpen = ! sidebarOpen"
>
    ☰
</button>

<div
    x-show="sidebarOpen"
    x-transition.opacity
    class="fixed inset-0 z-30 bg-gray-950/30 lg:hidden"
    @click="sidebarOpen = false"
></div>

<aside
    class="fixed inset-y-0 left-0 z-40 flex flex-col border-r border-gray-200 bg-white shadow-sm transition-all duration-300"
    :class="[
        sidebarOpen ? 'translate-x-0 w-64' : '-translate-x-full lg:translate-x-0 lg:w-20'
    ]"
>
<<<<<<< HEAD

    <div class="flex h-16 items-center justify-between border-b border-gray-100 px-4">

        <a href="{{ route($dashboardRoute) }}"
           class="flex items-center gap-3 overflow-hidden">

            <x-application-logo
                class="h-9 w-auto shrink-0 fill-current text-gray-800" />

            <span
                x-show="sidebarOpen"
                x-cloak
                class="whitespace-nowrap font-serif text-lg font-semibold tracking-widest text-gray-950">
=======
    <div class="flex h-16 items-center gap-3 border-b border-gray-100 px-4" :class="sidebarOpen ? 'justify-between' : 'justify-center'">
        @php
            $userType = $user?->user_type;
            $isAdminOrManagement = in_array(strtolower($userType ?? ''), ['admin', 'management'], true) || $user?->hasRole(['Admin','Manager']);
            $homeRoute = $user ? ($isAdminOrManagement ? route('admin.dashboard') : route('dashboard')) : route('home.find');
        @endphp
        <a href="{{ $homeRoute }}" class="flex items-center gap-3 overflow-hidden">
            <x-application-logo class="h-9 w-auto shrink-0 fill-current text-gray-800" />
            <span x-show="sidebarOpen" x-cloak class="whitespace-nowrap font-serif text-lg font-semibold tracking-widest text-gray-950">
>>>>>>> 4d8fd99ccfa23617e6d133e307f9932fcfbcb2b4
                DREAM
            </span>
        </a>

        <button
            type="button"
            class="hidden lg:inline-flex h-9 w-9 items-center justify-center rounded-md text-gray-500 hover:bg-gray-100"
            @click="sidebarOpen = ! sidebarOpen"
        >
            ⇄
        </button>
    </div>

    <div class="border-b border-gray-100 px-4 py-5">
<<<<<<< HEAD

        <div class="mb-4 flex items-center gap-3">

            @if ($user->profile_photo_path)
                <img
                    src="{{ asset('storage/'.$user->profile_photo_path) }}"
                    class="h-12 w-12 rounded-full border object-cover shadow-sm"
                >
            @else
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-sm font-bold text-gray-700 shadow-sm">
=======
        @auth
        <div class="mb-4 flex items-center" :class="sidebarOpen ? 'justify-start gap-3' : 'justify-center'">
            @if ($profilePhotoUrl)
                <img src="{{ $profilePhotoUrl }}"
                     class="h-12 w-12 rounded-full border-2 border-white object-cover shadow-sm"
                     alt="{{ $user->name }}">
            @else
                <div class="flex h-12 w-12 items-center justify-center rounded-full border-2 border-white bg-gray-100 text-sm font-bold text-gray-700 shadow-sm">
>>>>>>> 4d8fd99ccfa23617e6d133e307f9932fcfbcb2b4
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif

            <div x-show="sidebarOpen" x-cloak class="min-w-0">
<<<<<<< HEAD
                <p class="truncate text-sm font-semibold text-gray-900">
                    {{ $user->name }}
                </p>

                <p class="truncate text-xs text-gray-500">
                    {{ $user->email }}
                </p>
            </div>
        </div>
    </div>

    <nav class="flex-1 space-y-1 px-3 py-5">

        @foreach ($navItems as $item)

            <a href="{{ route($item['route']) }}"
               class="group flex items-center rounded-md px-3 py-2 text-sm font-medium transition hover:bg-gray-100"

               :class="sidebarOpen ? 'justify-start' : 'justify-center'">

                <span
                    class="flex h-6 w-6 items-center justify-center rounded text-xs font-bold
                    {{ $item['active']
                        ? 'bg-indigo-100 text-indigo-700'
                        : 'bg-gray-100 text-gray-500' }}">
                    {{ strtoupper(substr($item['label'], 0, 1)) }}
                </span>

                <span
                    x-show="sidebarOpen"
                    x-cloak
                    class="ml-3 whitespace-nowrap">

                    {{ $item['label'] }}
                </span>
            </a>

        @endforeach

    </nav>

    <div class="border-t border-gray-100 px-3 py-4">
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf

            <button type="submit"
                    class="w-full flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition hover:bg-gray-100 text-left">
                <span
                    class="flex h-6 w-6 items-center justify-center rounded text-xs font-bold bg-gray-100 text-gray-500">
                    ⎋
                </span>

                <span
                    x-show="sidebarOpen"
                    x-cloak
                    class="ml-3 whitespace-nowrap">
                    Logout
                </span>
            </button>
        </form>
    </div>

=======
                <p class="truncate text-sm font-semibold text-gray-900">{{ $user->name }}</p>
                <p class="truncate text-xs text-gray-500">{{ $user->email }}</p>
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
        @else
            <div class="space-y-2">
                <a href="{{ route('login') }}" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-gray-950" :class="sidebarOpen ? 'justify-start' : 'justify-center'">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded bg-gray-50 text-xs font-bold text-gray-500">L</span>
                    <span x-show="sidebarOpen" x-cloak class="ml-3 whitespace-nowrap">Log In</span>
                </a>
                <a href="{{ route('register') }}" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-gray-950" :class="sidebarOpen ? 'justify-start' : 'justify-center'">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded bg-gray-50 text-xs font-bold text-gray-500">R</span>
                    <span x-show="sidebarOpen" x-cloak class="ml-3 whitespace-nowrap">Register</span>
                </a>
            </div>
        @endauth
    </div>

    @php
        $isAdminOrManagement = in_array($userType, ['admin', 'management'], true) || $user?->hasRole(['Admin','Manager']);
    @endphp

    <nav class="flex-1 space-y-1 px-3 py-5">
        @foreach ($navItems as $item)
            @continue(
                $isClientUser && in_array($item['label'], ['Staff', 'Branches', 'Admin'], true)
            )

            <a href="{{ $item['href'] ?? ($item['route'] === 'dashboard' ? ($isAdminOrManagement ? route('admin.dashboard') : route('dashboard')) : route($item['route'])) }}"
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
>>>>>>> 4d8fd99ccfa23617e6d133e307f9932fcfbcb2b4
</aside>
