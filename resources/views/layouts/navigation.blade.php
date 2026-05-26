@php
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
    class="fixed top-4 bottom-0 left-0 z-40 flex flex-col border-r border-gray-200 bg-white shadow-sm transition-all duration-300"
    :class="[
        sidebarOpen ? 'translate-x-0 w-64' : '-translate-x-full lg:translate-x-0 lg:w-20'
    ]"
>

    <div class="flex h-16 items-center justify-between border-b border-gray-100 px-4">

        <a href="{{ route($dashboardRoute) }}"
           class="flex items-center gap-3 overflow-hidden">

            <x-application-logo
                class="h-9 w-auto shrink-0 fill-current text-gray-800" />

            <span
                x-show="sidebarOpen"
                x-cloak
                class="whitespace-nowrap font-serif text-lg font-semibold tracking-widest text-gray-950">
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

        <div class="mb-4 flex items-center gap-3">

            @if ($user->profile_photo_path)
                <img
                    src="{{ asset('storage/'.$user->profile_photo_path) }}"
                    class="h-12 w-12 rounded-full border object-cover shadow-sm"
                >
            @else
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-sm font-bold text-gray-700 shadow-sm">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif

            <div x-show="sidebarOpen" x-cloak class="min-w-0">
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

</aside>
