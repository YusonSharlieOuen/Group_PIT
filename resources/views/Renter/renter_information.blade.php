<x-app-layout>
    @php
        $renter = $renter ?? (object) [
            'renter_id' => auth()->user()->id ?? 'R-0001',
            'first_name' => auth()->user()->name ? explode(' ', auth()->user()->name)[0] : 'Jane',
            'last_name' => auth()->user()->name && str_contains(auth()->user()->name, ' ') ? explode(' ', auth()->user()->name)[1] : 'Smith',
            'address' => '—',
            'phone' => '—',
            'preferred_property_type' => '—',
            'max_rent' => 0,
        ];
    @endphp

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6 px-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="min-w-0">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Client / Renter Information</h1>
                    <p class="mt-1 text-sm text-gray-600">Read-only profile details from your rental record.</p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="h-11 w-11 rounded-2xl bg-blue-600/10 ring-1 ring-blue-200/70 flex items-center justify-center text-2xl">👤</div>
                    <div class="text-left">
<p class="text-sm font-bold text-gray-900 truncate">{{ $renter->first_name ?? '—' }} {{ $renter->last_name ?? '' }}</p>
<p class="text-xs text-gray-500 truncate">{{ $renter->renter_id ?? '—' }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl bg-white/70 backdrop-blur ring-1 ring-gray-200/60 shadow-sm overflow-hidden">
                <div class="px-6 py-5 bg-gradient-to-r from-blue-600/10 via-sky-600/10 to-indigo-600/10 border-b border-gray-200/70">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Personal Information</h2>
                            <p class="text-sm text-gray-600">Your details are displayed in read-only mode.</p>
                        </div>
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold ring-1 ring-blue-200/70 bg-blue-50 text-blue-700">Renter Portal</span>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="rounded-2xl bg-white ring-1 ring-gray-200/70 p-4 shadow-sm hover:shadow-md transition">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-xl bg-blue-50 ring-1 ring-blue-200/70 flex items-center justify-center text-blue-700">🪪</div>
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Renter ID</p>
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ $renter->renter_id ?? '—' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-2xl bg-white ring-1 ring-gray-200/70 p-4 shadow-sm hover:shadow-md transition">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-xl bg-blue-50 ring-1 ring-blue-200/70 flex items-center justify-center text-blue-700">📛</div>
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Full Name</p>
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ $renter->first_name ?? '—' }} {{ $renter->last_name ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-2xl bg-white ring-1 ring-gray-200/70 p-4 shadow-sm hover:shadow-md transition md:col-span-2">
                            <div class="flex items-start gap-3">
                                <div class="h-9 w-9 rounded-xl bg-blue-50 ring-1 ring-blue-200/70 flex items-center justify-center text-blue-700">🏠</div>
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Address</p>
                                    <p class="text-sm font-bold text-gray-900">{{ $renter->address ?? '—' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-2xl bg-white ring-1 ring-gray-200/70 p-4 shadow-sm hover:shadow-md transition">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-xl bg-blue-50 ring-1 ring-blue-200/70 flex items-center justify-center text-blue-700">📞</div>
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Phone Number</p>
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ $renter->phone ?? '—' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-2xl bg-white ring-1 ring-gray-200/70 p-4 shadow-sm hover:shadow-md transition">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-xl bg-blue-50 ring-1 ring-blue-200/70 flex items-center justify-center text-blue-700">🏷️</div>
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Preferred Property Type</p>
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ $renter->preferred_property_type ?? '—' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-2xl bg-white ring-1 ring-gray-200/70 p-4 shadow-sm hover:shadow-md transition md:col-span-2">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-xl bg-blue-50 ring-1 ring-blue-200/70 flex items-center justify-center text-blue-700">💰</div>
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Maximum Rent Budget</p>
                                    <p class="text-sm font-bold text-gray-900">PHP {{ number_format((int)($renter->max_rent ?? 0)) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-7 rounded-2xl bg-gray-50 ring-1 ring-gray-200/70 p-4">
                        <div class="flex items-start gap-3">
                            <div class="h-10 w-10 rounded-xl bg-blue-600/10 ring-1 ring-blue-200/70 flex items-center justify-center text-blue-700">🔒</div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Read-only</p>
                                <p class="text-sm text-gray-600">This page is for viewing only. Updates should be requested through your branch or admin.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center text-xs text-gray-500">© {{ date('Y') }} Real Estate Rental Management System</div>
        </div>
    </div>
</x-app-layout>

