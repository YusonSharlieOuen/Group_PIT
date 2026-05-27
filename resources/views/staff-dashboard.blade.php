<x-app-layout>
    @php
        $authUser = auth()->user();

        // Placeholder staff profile (replace with controller-provided data later)
        $staff = $staff ?? (object) [
            'staff_id' => 'S-1001',
            'first_name' => $authUser->name ? explode(' ', $authUser->name)[0] : 'John',
            'last_name' => $authUser->name && strpos($authUser->name, ' ') !== false ? explode(' ', $authUser->name)[1] : 'Doe',
            'position' => 'Property Coordinator',
            'branch' => (object) [
                'branch_id' => 'B-01',
                'street' => 'Main Ave',
                'area' => 'Central',
                'city' => 'Manila',
                'postcode' => '1000',
                'telephone' => '+63 900 000 0000',
            ],
            'phone' => '+63 912 345 6789',
            'address' => '123 Dream Street, Manila',
            'supervisor' => (object) [
                'staff_id' => 'S-0901',
                'first_name' => 'Ava',
                'last_name' => 'Cruz',
                'position' => 'Branch Supervisor',
            ],
            'date_joined' => now()->subYears(2)->toDateString(),
            'status' => 'Active',
        ];

        $stats = $stats ?? [
            'total_clients' => 42,
            'active_leases' => 18,
            'properties_managed' => 12,
            'scheduled_viewings' => 9,
            'completed_inspections' => 26,
        ];

        $clients = $clients ?? collect([
            (object) [
                'renter_name' => 'Maria Santos',
                'preferred_property_type' => 'Condo',
                'max_rent_budget' => 32000,
                'contact_number' => '+63 945 100 2000',
                'status' => 'Active',
            ],
            (object) [
                'renter_name' => 'Juan Dela Cruz',
                'preferred_property_type' => 'House',
                'max_rent_budget' => 45000,
                'contact_number' => '+63 912 500 3000',
                'status' => 'Pending',
            ],
            (object) [
                'renter_name' => 'Nina Reyes',
                'preferred_property_type' => 'Apartment',
                'max_rent_budget' => 25000,
                'contact_number' => '+63 998 900 8000',
                'status' => 'Active',
            ],
        ]);

        $properties = $properties ?? collect([
            (object) [
                'property_id' => 'P-001',
                'street' => 'Main Ave',
                'area' => 'Central',
                'city' => 'Manila',
                'property_type' => 'Condo',
                'monthly_rent' => 32000,
                'availability_status' => 'Available',
                'photo' => 'house1.jpg',
            ],
            (object) [
                'property_id' => 'P-002',
                'street' => 'Sunset Blvd',
                'area' => 'Luzon',
                'city' => 'Quezon City',
                'property_type' => 'House',
                'monthly_rent' => 45000,
                'availability_status' => 'Occupied',
                'photo' => 'house2.jpg',
            ],
            (object) [
                'property_id' => 'P-003',
                'street' => 'River Road',
                'area' => 'North',
                'city' => 'Taguig',
                'property_type' => 'Apartment',
                'monthly_rent' => 25000,
                'availability_status' => 'Available',
                'photo' => 'photo4.jpg',
            ],
        ]);

        $leases = $leases ?? collect([
            (object) [
                'lease_id' => 'L-101',
                'renter_name' => 'Maria Santos',
                'property' => 'P-001 - Main Ave, Manila',
                'monthly_rent' => 32000,
                'deposit_paid' => 64000,
                'start_date' => now()->subMonths(2)->toDateString(),
                'end_date' => now()->addMonths(10)->toDateString(),
                'payment_method' => 'Bank Transfer',
            ],
            (object) [
                'lease_id' => 'L-102',
                'renter_name' => 'Juan Dela Cruz',
                'property' => 'P-002 - Sunset Blvd, Quezon City',
                'monthly_rent' => 45000,
                'deposit_paid' => 90000,
                'start_date' => now()->subMonths(1)->toDateString(),
                'end_date' => now()->addMonths(11)->toDateString(),
                'payment_method' => 'GCash',
            ],
        ]);

        $viewings = $viewings ?? collect([
            (object) [
                'viewing_date' => now()->addDays(1)->toDateString(),
                'renter_name' => 'Nina Reyes',
                'property' => 'P-003 - River Road, Taguig',
                'assigned_staff' => ($staff->first_name.' '.$staff->last_name),
                'notes' => 'Bring ID + proof of income.',
                'status' => 'Pending Approval',
            ],
            (object) [
                'viewing_date' => now()->addDays(3)->toDateString(),
                'renter_name' => 'Juan Dela Cruz',
                'property' => 'P-001 - Main Ave, Manila',
                'assigned_staff' => ($staff->first_name.' '.$staff->last_name),
                'notes' => 'Property tour + contract briefing.',
                'status' => 'Scheduled',
            ],
        ]);

        $inspections = $inspections ?? collect([
            (object) [
                'inspection_id' => 'I-201',
                'property' => 'P-002 - Sunset Blvd, Quezon City',
                'inspection_date' => now()->subDays(6)->toDateString(),
                'comments' => 'All fixtures functional. Minor repaint needed.',
                'status' => 'Completed',
            ],
            (object) [
                'inspection_id' => 'I-202',
                'property' => 'P-001 - Main Ave, Manila',
                'inspection_date' => now()->subDays(2)->toDateString(),
                'comments' => 'AC checked—needs filter replacement.',
                'status' => 'In Progress',
            ],
        ]);

        $notifications = $notifications ?? collect([
            (object) [
                'title' => 'New viewing request',
                'body' => 'Maria Santos scheduled a viewing. Awaiting approval.',
                'time' => 'Just now',
            ],
            (object) [
                'title' => 'Inspection reminder',
                'body' => 'P-001 inspection is due soon. Review checklist.',
                'time' => '2 hours ago',
            ],
            (object) [
                'title' => 'Lease update',
                'body' => 'Lease L-101 needs rent payment confirmation.',
                'time' => 'Yesterday',
            ],
        ]);

        $recentActivity = $recentActivity ?? collect([
            (object) [
                'label' => 'Viewing approved',
                'detail' => 'Nina Reyes viewing confirmed for P-003.',
                'time' => 'Today',
            ],
            (object) [
                'label' => 'Property updated',
                'detail' => 'P-001 availability changed to Available.',
                'time' => 'Yesterday',
            ],
            (object) [
                'label' => 'Inspection logged',
                'detail' => 'I-202 status moved to In Progress.',
                'time' => '2 days ago',
            ],
        ]);

        $taskReminders = $taskReminders ?? collect([
            (object) [
                'task' => 'Confirm renter details',
                'due' => now()->addDays(1)->format('M d'),
                'priority' => 'High',
            ],
            (object) [
                'task' => 'Schedule inspection follow-up',
                'due' => now()->addDays(3)->format('M d'),
                'priority' => 'Medium',
            ],
            (object) [
                'task' => 'Review lease documents',
                'due' => now()->addDays(5)->format('M d'),
                'priority' => 'Low',
            ],
        ]);

        $groupedViewings = $viewings
            ->sortBy('viewing_date')
            ->groupBy(fn ($v) => (string) $v->viewing_date);

        $statCards = [
            ['label' => 'Total Clients Handled', 'value' => $stats['total_clients'], 'icon' => '👥', 'color' => 'text-blue-600', 'ring' => 'ring-blue-200/60 bg-blue-50/60'],
            ['label' => 'Active Leases', 'value' => $stats['active_leases'], 'icon' => '🧾', 'color' => 'text-green-600', 'ring' => 'ring-green-200/60 bg-green-50/60'],
            ['label' => 'Properties Managed', 'value' => $stats['properties_managed'], 'icon' => '🏠', 'color' => 'text-orange-600', 'ring' => 'ring-orange-200/60 bg-orange-50/60'],
            ['label' => 'Scheduled Viewings', 'value' => $stats['scheduled_viewings'], 'icon' => '📅', 'color' => 'text-indigo-600', 'ring' => 'ring-indigo-200/60 bg-indigo-50/60'],
            ['label' => 'Completed Inspections', 'value' => $stats['completed_inspections'], 'icon' => '🔎', 'color' => 'text-purple-600', 'ring' => 'ring-purple-200/60 bg-purple-50/60'],
        ];

        $statusLower = strtolower($staff->status ?? 'active');
        $isActive = in_array($statusLower, ['active', '1', 'yes'], true);
    @endphp

    <x-slot name="header">
        <div class="w-full">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="min-w-0">
                    <h2 class="font-serif text-3xl text-gray-800 leading-tight tracking-[0.02em]">{{ __('Staff Management Dashboard') }}</h2>
                    <nav class="mt-2 text-sm text-gray-500" aria-label="Breadcrumb">
                        <ol class="flex flex-wrap items-center gap-2">
                            <li><a class="hover:text-gray-700 transition" href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="text-gray-400">/</li>
                            <li class="text-gray-700 font-semibold">Staff</li>
                        </ol>
                    </nav>
                </div>

                <div class="flex items-center gap-3">
                    <a href="#" class="relative rounded-xl bg-white/70 backdrop-blur px-3 py-2 shadow-sm ring-1 ring-gray-200/60 transition hover:-translate-y-0.5 hover:shadow-md" aria-label="Profile">
                        <span class="text-gray-700 inline-flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5 text-blue-600">
                                <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4Zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4Z" />
                            </svg>
                            <span class="hidden sm:inline text-sm font-semibold">Profile</span>
                        </span>
                    </a>

                    <div class="relative" x-data="{ openNotif: false }">
                        <button type="button" @click="openNotif = !openNotif" class="relative rounded-xl bg-white/70 backdrop-blur px-3 py-2 shadow-sm ring-1 ring-gray-200/60 transition hover:-translate-y-0.5 hover:shadow-md">
                            <span class="text-gray-700 inline-flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5 text-blue-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0 1 18 14.158V11a6.002 6.002 0 0 0-5-5.917V4a1 1 0 0 0-2 0v1.083A6.002 6.002 0 0 0 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 0 1-6 0" />
                                </svg>
                                <span class="hidden sm:inline text-sm font-semibold">Notifications</span>
                            </span>
                            <span class="absolute -top-1 -right-1 inline-flex items-center justify-center rounded-full bg-red-600 text-white text-xs font-bold px-1.5 h-5">{{ $notifications->count() }}</span>
                        </button>

                        <div x-cloak x-show="openNotif" x-transition.origin.top.right class="absolute right-0 mt-2 w-80 rounded-2xl bg-white shadow-lg ring-1 ring-gray-200 overflow-hidden z-50" @click.away="openNotif=false">
                            <div class="px-4 py-3 bg-gradient-to-r from-blue-50 to-indigo-50">
                                <div class="text-sm font-bold text-gray-900">Real-time notifications</div>
                                <div class="text-xs text-gray-600">Latest updates for your assignments</div>
                            </div>
                            <div class="max-h-72 overflow-y-auto">
                                @forelse($notifications as $n)
                                    <div class="px-4 py-3 hover:bg-gray-50 transition border-b border-gray-100">
                                        <div class="flex items-center justify-between gap-3">
                                            <p class="text-sm font-semibold text-gray-900">{{ $n->title }}</p>
                                            <span class="text-xs text-gray-500 whitespace-nowrap">{{ $n->time }}</span>
                                        </div>
                                        <p class="text-xs text-gray-600 mt-1">{{ $n->body }}</p>
                                    </div>
                                @empty
                                    <div class="p-4 text-sm text-gray-500">No notifications</div>
                                @endforelse
                            </div>
                            <div class="p-4 bg-gray-50">
                                <a class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition" href="#">View all</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="relative overflow-hidden rounded-3xl border border-white/20 bg-gradient-to-r from-blue-500/10 via-indigo-500/10 to-cyan-500/10">
                <div class="absolute inset-0 opacity-60 pointer-events-none bg-[radial-gradient(circle_at_top,rgba(59,130,246,0.35),transparent_40%)]"></div>
                <div class="relative p-6 sm:p-7">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-white/70 backdrop-blur shadow-sm ring-1 ring-gray-200/60 flex items-center justify-center">
                                <span class="text-2xl">🏢</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-500">Welcome back</p>
                                <p class="text-xl font-bold text-gray-900">{{ $staff->first_name }} {{ $staff->last_name }}</p>
                                <p class="text-sm text-gray-600">{{ $staff->position }} • {{ $staff->branch->city ?? '—' }}</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 hover:-translate-y-0.5">
                                Edit Staff Profile
                            </a>
                            <a href="#" class="inline-flex items-center justify-center rounded-2xl bg-white/70 backdrop-blur px-4 py-2.5 text-sm font-semibold text-gray-800 ring-1 ring-gray-200/60 shadow-sm transition hover:bg-white hover:-translate-y-0.5">
                                View Assignment Inbox
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                {{-- Staff Profile Card --}}
                <div class="lg:col-span-2 rounded-3xl bg-white/70 backdrop-blur ring-1 ring-gray-200/60 shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <span class="inline-flex w-9 h-9 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">🪪</span>
                                Staff Profile
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">Client-handling and property management overview</p>
                        </div>
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold {{ $isActive ? 'bg-green-50 text-green-700 ring-1 ring-green-200' : 'bg-gray-100 text-gray-700 ring-1 ring-gray-200' }}">
                            {{ $staff->status ?? 'Active' }}
                        </span>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Staff ID</p>
                                <p class="mt-1 text-sm font-bold text-gray-900">{{ $staff->staff_id ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Full Name</p>
                                <p class="mt-1 text-sm font-bold text-gray-900">{{ $staff->first_name }} {{ $staff->last_name }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Position</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $staff->position ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Branch Assigned</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $staff->branch->branch_id ?? '—' }} • {{ $staff->branch->city ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Phone Number</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $staff->phone ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Address</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $staff->address ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Supervisor</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $staff->supervisor->first_name ?? '—' }} {{ $staff->supervisor->last_name ?? '' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Date Joined</p>
                                <p class="mt-1 text-sm text-gray-900">{{ isset($staff->date_joined) ? date('M d, Y', strtotime($staff->date_joined)) : '—' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-2">
                        <a href="#" class="flex-1 inline-flex items-center justify-center rounded-2xl bg-gray-900 text-white px-4 py-2.5 text-sm font-semibold shadow-sm transition hover:bg-gray-800 hover:-translate-y-0.5">
                            Edit Staff
                        </a>
                        <button type="button" class="inline-flex items-center justify-center rounded-2xl bg-white/70 text-gray-800 px-4 py-2.5 text-sm font-semibold ring-1 ring-gray-200/60 shadow-sm transition hover:bg-white hover:-translate-y-0.5" onclick="confirm('Delete staff record? (Placeholder)')">
                            Delete Staff
                        </button>
                    </div>
                </div>

                {{-- Charts / Performance --}}
                <div class="lg:col-span-3 rounded-3xl bg-white/70 backdrop-blur ring-1 ring-gray-200/60 shadow-sm p-6">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <span class="inline-flex w-9 h-9 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-700">📈</span>
                                Staff Performance
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">A quick view of your impact (placeholder UI)</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Last 30 days</p>
                            <p class="text-sm font-bold text-gray-900">On track</p>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="rounded-2xl border border-gray-200 bg-white/60 p-4 shadow-sm">
                            <p class="text-sm font-semibold text-gray-900">Client Handling</p>
                            <div class="mt-3 h-28 flex items-end gap-2">
                                @php $bars = [18, 24, 16, 29, 22, 31, 27]; @endphp
                                @foreach($bars as $h)
                                    <div class="flex-1 rounded-xl bg-blue-600/80 hover:bg-blue-600 transition" style="height: {{ $h * 3 }}px"></div>
                                @endforeach
                            </div>
                            <div class="mt-2 text-xs text-gray-500">Hover effects enabled</div>
                        </div>

                        <div class="rounded-2xl border border-gray-200 bg-white/60 p-4 shadow-sm">
                            <p class="text-sm font-semibold text-gray-900">Operations Pulse</p>
                            <div class="mt-3 space-y-3">
                                @php
                                    $pulse = [
                                        ['label' => 'Viewings', 'value' => 78, 'color' => 'bg-blue-500'],
                                        ['label' => 'Inspections', 'value' => 64, 'color' => 'bg-indigo-500'],
                                        ['label' => 'Leases', 'value' => 71, 'color' => 'bg-cyan-500'],
                                    ];
                                @endphp
                                @foreach($pulse as $p)
                                    <div>
                                        <div class="flex items-center justify-between text-xs">
                                            <span class="font-semibold text-gray-700">{{ $p['label'] }}</span>
                                            <span class="font-bold text-gray-900">{{ $p['value'] }}%</span>
                                        </div>
                                        <div class="mt-2 h-2 rounded-full bg-gray-100 overflow-hidden">
                                            <div class="h-full {{ $p['color'] }} transition-all duration-500" style="width: {{ $p['value'] }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 p-4">
                        <div class="flex items-start gap-3">
                            <div class="text-lg">✨</div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Tip</p>
                                <p class="text-sm text-gray-700">Use the sections below to manage clients, leases, viewings, and inspection reports.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Dashboard Statistic Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                @foreach($statCards as $c)
                    <div class="group rounded-3xl bg-white/70 backdrop-blur ring-1 {{ $c['ring'] }} shadow-sm p-5 transition hover:-translate-y-1 hover:shadow-md">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">{{ $c['label'] }}</p>
                                <p class="mt-2 text-3xl font-extrabold {{ $c['color'] }}">{{ $c['value'] }}</p>
                            </div>
                            <div class="w-11 h-11 rounded-2xl bg-white/60 ring-1 ring-gray-200/60 flex items-center justify-center text-xl group-hover:scale-105 transition">
                                {{ $c['icon'] }}
                            </div>
                        </div>
                        <div class="mt-3 text-xs font-semibold text-gray-600">View details →</div>
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
                <div class="xl:col-span-8 space-y-6">
                    {{-- Assigned Clients / Renters --}}
                    <section class="rounded-3xl bg-white/70 backdrop-blur ring-1 ring-gray-200/60 shadow-sm p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="inline-flex w-9 h-9 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">🧑‍💼</span>
                                    Assigned Clients / Renters
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">Search, filter, and manage the client pipeline</p>
                            </div>

                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                                <div class="relative">
                                    <input type="text" placeholder="Search renters..." class="w-full sm:w-72 rounded-2xl bg-white/80 ring-1 ring-gray-200/70 shadow-sm px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-200" />
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">🔎</span>
                                </div>
                                <select class="rounded-2xl bg-white/80 ring-1 ring-gray-200/70 shadow-sm px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-200">
                                    <option value="all">Filter: All</option>
                                    <option value="active">Filter: Active</option>
                                    <option value="pending">Filter: Pending</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-5 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50/70">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Renter Name</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Preferred Property Type</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Max Rent Budget</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Contact Number</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Status</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($clients as $cl)
                                        @php
                                            $status = strtolower($cl->status ?? 'active');
                                            $pill = $status === 'active' ? 'bg-green-50 text-green-700 ring-green-200/60' : 'bg-gray-100 text-gray-700 ring-gray-200/60';
                                        @endphp
                                        <tr class="hover:bg-gray-50/60 transition">
                                            <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ $cl->renter_name }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $cl->preferred_property_type }}</td>
                                            <td class="px-4 py-3 text-sm font-bold text-gray-900">PHP {{ number_format($cl->max_rent_budget) }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $cl->contact_number }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold ring-1 {{ $pill }}">{{ $cl->status }}</span>
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                <div class="flex flex-col sm:flex-row gap-2">
                                                    <a href="#" class="rounded-xl bg-white/80 ring-1 ring-gray-200/70 px-3 py-2 text-xs font-bold text-blue-700 hover:bg-blue-50 transition">View Client</a>
                                                    <a href="{{ route('viewing.create') }}" class="rounded-xl bg-blue-600 px-3 py-2 text-xs font-bold text-white hover:bg-blue-700 transition">Schedule Viewing</a>
                                                    @if(auth()->user()?->hasRole(['Admin', 'Manager']) || in_array(strtolower(auth()->user()?->user_type ?? ''), ['admin','manager'], true))
                                                        <a href="{{ route('lease.create') }}" class="rounded-xl bg-gray-900 px-3 py-2 text-xs font-bold text-white hover:bg-gray-800 transition">Create Lease</a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-4 py-10 text-center text-sm text-gray-500">No renters found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 flex items-center justify-between gap-3">
                            <div class="text-xs text-gray-500">Showing 1–{{ min(10, $clients->count()) }} of {{ $clients->count() }} renters</div>
                            <div class="flex items-center gap-2">
                                <button class="px-3 py-2 rounded-xl ring-1 ring-gray-200/70 bg-white/80 hover:bg-gray-50 transition" type="button"><</button>
                                <button class="px-3 py-2 rounded-xl bg-blue-50 text-blue-700 ring-1 ring-blue-200/70 font-bold" type="button">1</button>
                                <button class="px-3 py-2 rounded-xl ring-1 ring-gray-200/70 bg-white/80 hover:bg-gray-50 transition" type="button">></button>
                            </div>
                        </div>
                    </section>

                    {{-- Managed Properties --}}
                    <section class="rounded-3xl bg-white/70 backdrop-blur ring-1 ring-gray-200/60 shadow-sm p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="inline-flex w-9 h-9 items-center justify-center rounded-2xl bg-orange-50 text-orange-700">🏘️</span>
                                    Managed Properties
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">Availability, pricing, and operational actions</p>
                            </div>
                            <a href="{{ route('property.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-gray-900 text-white px-4 py-2.5 text-sm font-semibold shadow-sm transition hover:bg-gray-800 hover:-translate-y-0.5">
                                Manage All
                            </a>

                        </div>

                        <div class="mt-5 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50/70">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Property ID</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Property Address</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Property Type</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Monthly Rent</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Availability Status</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($properties as $p)
                                        @php
                                            $avail = strtolower($p->availability_status ?? 'available');
                                            $pill = $avail === 'available' ? 'bg-green-50 text-green-700 ring-green-200/60' : 'bg-gray-100 text-gray-700 ring-gray-200/60';
                                        @endphp
                                        <tr class="hover:bg-gray-50/60 transition">
                                            <td class="px-4 py-3 text-sm font-semibold text-gray-900">
                                                <div class="flex items-center gap-3">
                                                    <img src="{{ asset('images/'.$p->photo) }}" alt="{{ $p->property_id }}" class="h-10 w-12 rounded-xl object-cover ring-1 ring-gray-200/70" onerror="this.src='{{ asset('images/house1.jpg') }}'" />
                                                    <span>{{ $p->property_id }}</span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $p->street }}, {{ $p->area }}, {{ $p->city }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $p->property_type }}</td>
                                            <td class="px-4 py-3 text-sm font-bold text-gray-900">PHP {{ number_format($p->monthly_rent) }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold ring-1 {{ $pill }}">{{ $p->availability_status }}</span>
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                <div class="flex flex-col sm:flex-row gap-2">
                                                    <a href="{{ route('property.show', $p->property_id) }}" class="rounded-xl bg-white/80 ring-1 ring-gray-200/70 px-3 py-2 text-xs font-bold text-blue-700 hover:bg-blue-50 transition">View Property</a>
                                                    <a href="{{ route('property.edit', $p->property_id) }}" class="rounded-xl bg-gray-900 px-3 py-2 text-xs font-bold text-white hover:bg-gray-800 transition">Edit Property</a>
                                                    <a href="#" class="rounded-xl bg-indigo-600 px-3 py-2 text-xs font-bold text-white hover:bg-indigo-700 transition">Schedule Inspection</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-4 py-10 text-center text-sm text-gray-500">No properties found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>

                    {{-- Lease Transactions --}}
                    <section class="rounded-3xl bg-white/70 backdrop-blur ring-1 ring-gray-200/60 shadow-sm p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="inline-flex w-9 h-9 items-center justify-center rounded-2xl bg-green-50 text-green-700">🧾</span>
                                    Lease Transactions
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">Track deposits, payment method, and contract dates</p>
                            </div>
                            <a href="{{ route('lease.all') }}" class="inline-flex items-center justify-center rounded-2xl bg-gray-900 text-white px-4 py-2.5 text-sm font-semibold shadow-sm transition hover:bg-gray-800 hover:-translate-y-0.5">All Leases</a>
                        </div>

                        <div class="mt-5 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50/70">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Lease ID</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Renter Name</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Property</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Monthly Rent</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Deposit Paid</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Start Date</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">End Date</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Payment Method</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($leases as $l)
                                        <tr class="hover:bg-gray-50/60 transition">
                                            <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ $l->lease_id }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $l->renter_name }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $l->property }}</td>
                                            <td class="px-4 py-3 text-sm font-bold text-gray-900">PHP {{ number_format($l->monthly_rent) }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">PHP {{ number_format($l->deposit_paid) }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ date('M d, Y', strtotime($l->start_date)) }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ date('M d, Y', strtotime($l->end_date)) }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $l->payment_method }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <div class="flex flex-col sm:flex-row gap-2">
                                                    <a href="#" class="rounded-xl bg-white/80 ring-1 ring-gray-200/70 px-3 py-2 text-xs font-bold text-blue-700 hover:bg-blue-50 transition">View Lease</a>
                                                    <span class="rounded-xl bg-indigo-200/60 px-3 py-2 text-xs font-bold text-indigo-900/80 cursor-not-allowed select-none" title="Staff cannot edit leases">Update Lease</span>
                                                    <span class="rounded-xl bg-red-200/60 px-3 py-2 text-xs font-bold text-red-900/80 cursor-not-allowed select-none" title="Staff cannot delete leases">Terminate</span>

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="px-4 py-10 text-center text-sm text-gray-500">No lease transactions found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>

                    {{-- Viewing Schedule --}}
                    <section class="rounded-3xl bg-white/70 backdrop-blur ring-1 ring-gray-200/60 shadow-sm p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="inline-flex w-9 h-9 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-700">📅</span>
                                    Viewing Schedule
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">Upcoming viewings (timeline/calendar style)</p>
                            </div>
                            <a href="{{ route('viewing.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 text-white px-4 py-2.5 text-sm font-semibold shadow-sm transition hover:bg-blue-700 hover:-translate-y-0.5">Schedule Viewing</a>
                        </div>

                        <div class="mt-6 space-y-6">
                            @forelse($groupedViewings as $date => $items)
                                <div class="border border-gray-200/70 rounded-3xl bg-white/60 p-5">
                                    <div class="flex items-center justify-between gap-3">
                                        <h4 class="text-base font-extrabold text-gray-900">{{ $date }}</h4>
                                        <span class="text-xs font-bold text-gray-600">{{ $items->count() }} viewing(s)</span>
                                    </div>

                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach($items as $v)
                                            <div class="rounded-2xl bg-white/70 ring-1 ring-gray-200/70 p-4 shadow-sm hover:shadow-md transition">
                                                <div class="flex items-start justify-between gap-4">
                                                    <div>
                                                        <p class="text-sm font-bold text-gray-900">{{ $v->renter_name }}</p>
                                                        <p class="text-xs text-gray-600 mt-1">{{ $v->property }}</p>
                                                    </div>
                                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold bg-gray-100 text-gray-700 ring-1 ring-gray-200/70">{{ $v->status ?? 'Scheduled' }}</span>
                                                </div>

                                                <div class="mt-3 space-y-1 text-xs text-gray-700">
                                                    <div><span class="font-semibold">Assigned Staff:</span> {{ $v->assigned_staff ?? ($staff->first_name.' '.$staff->last_name) }}</div>
                                                    <div><span class="font-semibold">Notes:</span> {{ $v->notes ?? '-' }}</div>
                                                </div>

                                                <div class="mt-4 flex flex-wrap gap-2">
                                                    <button type="button" class="rounded-xl bg-green-600 text-white px-3 py-2 text-xs font-bold hover:bg-green-700 transition" onclick="confirm('Approve viewing? (Placeholder)')">Approve</button>
                                                    <button type="button" class="rounded-xl bg-indigo-600 text-white px-3 py-2 text-xs font-bold hover:bg-indigo-700 transition" onclick="confirm('Reschedule viewing? (Placeholder)')">Reschedule</button>
                                                    <button type="button" class="rounded-xl bg-red-600 text-white px-3 py-2 text-xs font-bold hover:bg-red-700 transition" onclick="confirm('Cancel viewing? (Placeholder)')">Cancel</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="text-sm text-gray-500">No upcoming viewings found.</div>
                            @endforelse
                        </div>
                    </section>

                    {{-- Inspection Reports --}}
                    <section class="rounded-3xl bg-white/70 backdrop-blur ring-1 ring-gray-200/60 shadow-sm p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="inline-flex w-9 h-9 items-center justify-center rounded-2xl bg-purple-50 text-purple-700">🔎</span>
                                    Inspection Reports
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">Inspection history and status tracking</p>
                            </div>
                            <a href="#" class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 text-white px-4 py-2.5 text-sm font-semibold shadow-sm transition hover:bg-indigo-700 hover:-translate-y-0.5">Add Inspection</a>
                        </div>

                        <div class="mt-5 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50/70">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Inspection ID</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Property</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Inspection Date</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Comments</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Status</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($inspections as $i)
                                        @php
                                            $st = strtolower($i->status ?? 'completed');
                                            $pill = $st === 'completed' ? 'bg-green-50 text-green-700 ring-green-200/60' : ($st === 'in progress' ? 'bg-indigo-50 text-indigo-700 ring-indigo-200/60' : 'bg-gray-100 text-gray-700 ring-gray-200/60');
                                        @endphp
                                        <tr class="hover:bg-gray-50/60 transition">
                                            <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ $i->inspection_id }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $i->property }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ date('M d, Y', strtotime($i->inspection_date)) }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $i->comments ?? '-' }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold ring-1 {{ $pill }}">{{ $i->status ?? '—' }}</span>
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                <div class="flex flex-col sm:flex-row gap-2">
                                                    <a href="#" class="rounded-xl bg-white/80 ring-1 ring-gray-200/70 px-3 py-2 text-xs font-bold text-blue-700 hover:bg-blue-50 transition">Add Inspection</a>
                                                    <a href="#" class="rounded-xl bg-indigo-600 px-3 py-2 text-xs font-bold text-white hover:bg-indigo-700 transition">Edit Report</a>
                                                    <a href="#" class="rounded-xl bg-gray-900 px-3 py-2 text-xs font-bold text-white hover:bg-gray-800 transition">View Details</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-4 py-10 text-center text-sm text-gray-500">No inspections logged.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>

                {{-- Side Panels --}}
                <aside class="xl:col-span-4 space-y-6">
                    <div class="rounded-3xl bg-white/70 backdrop-blur ring-1 ring-gray-200/60 shadow-sm p-6">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <span class="inline-flex w-9 h-9 items-center justify-center rounded-2xl bg-red-50 text-red-700">🔔</span>
                            Recent Activity
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Updates across clients and property operations</p>

                        <div class="mt-5 space-y-4">
                            @forelse($recentActivity as $a)
                                <div class="rounded-2xl bg-white/70 ring-1 ring-gray-200/70 p-4 hover:shadow-md transition">
                                    <div class="flex items-start justify-between gap-3">
                                        <p class="text-sm font-bold text-gray-900">{{ $a->label }}</p>
                                        <span class="text-xs font-semibold text-gray-500">{{ $a->time }}</span>
                                    </div>
                                    <p class="text-xs text-gray-700 mt-2">{{ $a->detail }}</p>
                                </div>
                            @empty
                                <div class="text-sm text-gray-500">No activity yet.</div>
                            @endforelse
                        </div>
                    </div>

                    <div class="rounded-3xl bg-white/70 backdrop-blur ring-1 ring-gray-200/60 shadow-sm p-6">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <span class="inline-flex w-9 h-9 items-center justify-center rounded-2xl bg-amber-50 text-amber-700">✅</span>
                            Task Reminders
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">What to do next for smoother operations</p>

                        <div class="mt-5 space-y-4">
                            @forelse($taskReminders as $t)
                                @php
                                    $priority = strtolower($t->priority ?? 'medium');
                                    $pill = $priority === 'high' ? 'bg-red-50 text-red-700 ring-red-200/60' : ($priority === 'medium' ? 'bg-amber-50 text-amber-700 ring-amber-200/60' : 'bg-gray-100 text-gray-700 ring-gray-200/60');
                                @endphp
                                <div class="rounded-2xl bg-white/70 ring-1 ring-gray-200/70 p-4 hover:shadow-md transition">
                                    <div class="flex items-start justify-between gap-3">
                                        <p class="text-sm font-bold text-gray-900">{{ $t->task }}</p>
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold ring-1 {{ $pill }}">{{ $t->priority }}</span>
                                    </div>
                                    <div class="mt-2 text-xs text-gray-600">Due: <span class="font-bold text-gray-900">{{ $t->due }}</span></div>
                                    <button type="button" class="mt-3 inline-flex text-xs font-bold text-blue-700 hover:text-blue-800 transition" onclick="confirm('Mark reminder done? (Placeholder)')">Mark done →</button>
                                </div>
                            @empty
                                <div class="text-sm text-gray-500">No reminders.</div>
                            @endforelse
                        </div>
                    </div>

                    <div class="rounded-3xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-sm p-6 overflow-hidden relative">
                        <div class="absolute inset-0 opacity-20 pointer-events-none bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.9),transparent_40%)]"></div>
                        <div class="relative">
                            <h3 class="text-lg font-extrabold">Quick Actions</h3>
                            <p class="text-sm text-white/90 mt-1">Common operations</p>

                            <div class="mt-4 grid grid-cols-1 gap-3">
                                <a href="{{ route('viewing.create') }}" class="rounded-2xl bg-white/10 ring-1 ring-white/20 px-4 py-3 text-sm font-bold hover:bg-white/15 transition">Book Viewing</a>
                                @if(auth()->user()?->hasRole(['Admin', 'Manager']) || in_array(strtolower(auth()->user()?->user_type ?? ''), ['admin','manager'], true))
                                <a href="{{ route('lease.create') }}" class="rounded-2xl bg-white/10 ring-1 ring-white/20 px-4 py-3 text-sm font-bold hover:bg-white/15 transition">Create Lease</a>
                                @endif
                                <a href="{{ route('property.create') }}" class="rounded-2xl bg-white/10 ring-1 ring-white/20 px-4 py-3 text-sm font-bold hover:bg-white/15 transition">Add Property</a>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

            <div class="text-center text-xs text-gray-500 pt-2">© {{ date('Y') }} Real Estate Rental Management System</div>
        </div>
    </div>
</x-app-layout>

