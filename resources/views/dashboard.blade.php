<x-app-layout>
    @php
        $availableCount = $availableProperties->count();
        $viewingCount = $myViewings->count();
        $branch = $renter?->branch ?? $activeLease?->property?->branch ?? $availableProperties->first()?->branch;
        $preferredType = $renter?->preferred_property_type ?: 'Any property';
    @endphp

        <div class="relative mx-auto flex min-h-[520px] max-w-7xl items-center px-4 py-16 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <p class="mb-4 text-xs font-semibold uppercase tracking-[0.35em] text-white/75">Dream Home</p>
                <h1 class="font-serif text-5xl font-semibold leading-none text-white sm:text-6xl lg:text-7xl">
                    Find a home that fits your next chapter.
                </h1>
                <p class="mt-6 max-w-xl text-base leading-7 text-white/85 sm:text-lg">
                    Browse available rentals, manage property records, and keep staff, branches, leases, and viewings organized in one place.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('home.find') }}" class="inline-flex items-center rounded-md bg-white px-5 py-3 text-sm font-semibold uppercase tracking-wider text-gray-950 shadow-sm transition hover:bg-gray-100">
                        View Listings
                    </a>
                    <a href="{{ route('property.create') }}" class="inline-flex items-center rounded-md border border-white/50 px-5 py-3 text-sm font-semibold uppercase tracking-wider text-white transition hover:bg-white/10">
                        Manage Properties
                </a>

                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="-mt-20 grid gap-4 rounded-lg border border-gray-200 bg-white p-4 shadow-lg sm:grid-cols-2 lg:grid-cols-4">
                <a href="{{ route('home.find') }}" class="rounded-md border border-gray-100 p-4 transition hover:border-gray-300 hover:bg-gray-50">
                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-500">Search</p>
                    <p class="mt-2 text-lg font-semibold text-gray-950">Find a Home</p>
                </a>
                <a href="{{ route('property.create') }}" class="rounded-md border border-gray-100 p-4 transition hover:border-gray-300 hover:bg-gray-50">
                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-500">Portfolio</p>

                    <p class="mt-2 text-lg font-semibold text-gray-950">Properties</p>
                </a>

                @if(!auth()->user() || (!auth()->user()?->hasRole('Renter')))
                    <a href="{{ route('viewing.create') }}" class="rounded-md border border-gray-100 p-4 transition hover:border-gray-300 hover:bg-gray-50">
                        <p class="text-xs font-semibold uppercase tracking-widest text-gray-500">Schedule</p>
                        <p class="mt-2 text-lg font-semibold text-gray-950">Book Viewing</p>
                    </a>
                @endif

            </div>
        </div>
    </section>

    <section class="bg-gray-50 pb-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-[#5c9aa9]">Client Dashboard</p>
                    <h1 class="mt-3 font-serif text-4xl font-semibold text-gray-950 sm:text-5xl">
                        Welcome back, {{ $renter?->first_name ?? Auth::user()->name }}.
                    </h1>
                    <p class="mt-4 max-w-2xl text-base leading-7 text-gray-600">
                        Browse available rentals, book viewings, review your lease, and keep your renter profile ready for the branch team.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="#browse-properties" class="rounded-md bg-[#5c9aa9] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#4a8796]">
                            Browse Properties
                        </a>
                        <a href="{{ route('viewing.create') }}" class="rounded-md border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-900 transition hover:bg-gray-50">
                            Book Viewing
                        </a>
                    </div>
                </div>

                <div class="rounded-lg border border-gray-200 bg-gray-50 p-5">
                    <p class="text-sm font-semibold text-gray-900">Branch Contact</p>
                    <div class="mt-4 space-y-2 text-sm text-gray-600">
                        <p class="font-medium text-gray-950">{{ $branch?->city ?? 'No branch assigned yet' }}</p>
                        <p>{{ $branch ? trim(($branch->street ?? '').' '.($branch->area ?? '')) : 'Your assigned branch will appear once your renter profile is completed.' }}</p>
                        <p>Telephone: {{ $branch?->telephone ?? 'Not available' }}</p>
                        <p>Postcode: {{ $branch?->postcode ?? 'Not available' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-8">
        <div class="mx-auto grid max-w-7xl gap-4 px-4 sm:grid-cols-2 sm:px-6 lg:grid-cols-4 lg:px-8">
            <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-500">Available Homes</p>
                <p class="mt-3 text-3xl font-bold text-gray-950">{{ $availableCount }}</p>
                <p class="mt-1 text-sm text-gray-600">Ready to view</p>
            </div>
            <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-500">My Viewings</p>
                <p class="mt-3 text-3xl font-bold text-gray-950">{{ $viewingCount }}</p>
                <p class="mt-1 text-sm text-gray-600">Scheduled or requested</p>
            </div>
            <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-500">Active Lease</p>
                <p class="mt-3 text-3xl font-bold text-gray-950">{{ $activeLease ? '1' : '0' }}</p>
                <p class="mt-1 text-sm text-gray-600">{{ $activeLease?->lease_id ?? 'No active lease' }}</p>
            </div>
            <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-500">Preference</p>
                <p class="mt-3 text-xl font-bold text-gray-950">{{ $preferredType }}</p>
                <p class="mt-1 text-sm text-gray-600">Max rent: PHP {{ number_format($renter?->max_rent ?? 0) }}</p>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 pb-12">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-3 lg:px-8">
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm lg:col-span-2">
                <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                    <div>
                        <h2 class="font-serif text-2xl font-semibold text-gray-950">My Renter Profile</h2>
                        <p class="mt-1 text-sm text-gray-600">Details used for viewings and lease applications.</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-900 transition hover:bg-gray-50">
                        Edit Profile
                    </a>
                </div>

                <dl class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-widest text-gray-500">First Name</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-950">{{ $renter?->first_name ?? 'Not set' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-widest text-gray-500">Last Name</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-950">{{ $renter?->last_name ?? 'Not set' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-widest text-gray-500">Phone</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-950">{{ $renter?->phone ?? 'Not set' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-widest text-gray-500">Preferred Type</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-950">{{ $preferredType }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-xs font-semibold uppercase tracking-widest text-gray-500">Address</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-950">{{ $renter?->address ?? 'Not set' }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-xs font-semibold uppercase tracking-widest text-gray-500">Comments</dt>
                        <dd class="mt-1 text-sm text-gray-700">{{ $renter?->comments ?? 'No comments added.' }}</dd>
                    </div>
                </dl>
            </div>

            <div id="notifications" class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <h2 class="font-serif text-2xl font-semibold text-gray-950">Notifications</h2>
                <div class="mt-5 space-y-4">
                    @if($myViewings->isNotEmpty())
                        <div class="rounded-md bg-[#eef6f8] p-4 text-sm text-gray-700">
                            Your next viewing is scheduled for {{ $myViewings->first()->viewing_date }}.
                        </div>
                    @endif
                    @if($activeLease)
                        <div class="rounded-md bg-amber-50 p-4 text-sm text-gray-700">
                            Lease {{ $activeLease->lease_id }} ends on {{ $activeLease->end_date ?? 'an open date' }}.
                        </div>
                    @endif
                    @if($availableProperties->isNotEmpty())
                        <div class="rounded-md bg-gray-50 p-4 text-sm text-gray-700">
                            {{ $availableCount }} available homes match the current rental catalog.
                        </div>
                    @endif
                    @if($myViewings->isEmpty() && !$activeLease && $availableProperties->isEmpty())
                        <p class="text-sm text-gray-600">No renter notifications yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section id="browse-properties" class="bg-white py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
                <div>
                    <h2 class="font-serif text-3xl font-semibold text-gray-950">Browse Properties</h2>
                    <p class="mt-2 text-sm text-gray-600">Available homes with branch and staff information.</p>
                </div>
                <a href="{{ route('home.find') }}" class="text-sm font-semibold text-gray-950 underline underline-offset-4 hover:text-gray-600">Open full search</a>
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse($availableProperties as $property)
                    <article class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
                        <img src="{{ $property->photo_path ? asset('storage/'.$property->photo_path) : asset('images/house1.jpg') }}"
                             class="h-52 w-full object-cover"
                             alt="{{ $property->property_type ?? 'Property' }}">
                        <div class="p-5">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="font-serif text-xl font-semibold text-gray-950">{{ $property->street ?? 'Rental Property' }}</h3>
                                    <p class="mt-1 text-sm text-gray-600">{{ $property->area }}, {{ $property->city }}</p>
                                </div>
                                <p class="text-right text-sm font-bold text-gray-950">PHP {{ number_format($property->monthly_rent ?? 0) }}</p>
                            </div>

                            <dl class="mt-4 grid grid-cols-2 gap-3 text-sm">
                                <div>
                                    <dt class="text-xs uppercase tracking-widest text-gray-500">Type</dt>
                                    <dd class="font-medium text-gray-900">{{ $property->property_type ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs uppercase tracking-widest text-gray-500">Rooms</dt>
                                    <dd class="font-medium text-gray-900">{{ $property->number_of_rooms ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs uppercase tracking-widest text-gray-500">Branch</dt>
                                    <dd class="font-medium text-gray-900">{{ $property->branch?->city ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs uppercase tracking-widest text-gray-500">Agent</dt>
                                    <dd class="font-medium text-gray-900">{{ $property->staff ? $property->staff->first_name.' '.$property->staff->last_name : 'N/A' }}</dd>
                                </div>
                            </dl>

                            <div class="mt-5 flex gap-2">
                                <a href="{{ route('property.show', $property->property_id) }}" class="flex-1 rounded-md border border-gray-300 px-4 py-2 text-center text-sm font-semibold text-gray-900 transition hover:bg-gray-50">
                                    View Details
                                </a>
                                <a href="{{ route('viewing.create', ['property_id' => $property->property_id]) }}" class="flex-1 rounded-md bg-[#5c9aa9] px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-[#4a8796]">
                                    Book Viewing
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-lg border border-dashed border-gray-300 bg-gray-50 p-8 text-center md:col-span-2 xl:col-span-3">
                        <h3 class="text-lg font-semibold text-gray-950">No available properties yet</h3>
                        <p class="mt-2 text-sm text-gray-600">New available rentals will appear here when staff publish them.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-12">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div id="my-viewings" class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <h2 class="font-serif text-2xl font-semibold text-gray-950">My Viewings</h2>
                    <a href="{{ route('viewing.create') }}" class="text-sm font-semibold text-[#4a8796] hover:text-[#326673]">New Viewing</a>
                </div>
                <div class="mt-5 overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-gray-200 text-xs uppercase tracking-widest text-gray-500">
                            <tr>
                                <th class="py-3 pr-4">Property</th>
                                <th class="py-3 pr-4">Viewing Date</th>
                                <th class="py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($myViewings as $viewing)
                                <tr>
                                    <td class="py-3 pr-4 text-gray-900">{{ $viewing->propertyDetails?->street ?? $viewing->property_id }}</td>
                                    <td class="py-3 pr-4 text-gray-700">{{ $viewing->viewing_date }}</td>
                                    <td class="py-3">
                                        <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">Pending</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-5 text-center text-gray-600">No viewings booked yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="my-lease" class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <h2 class="font-serif text-2xl font-semibold text-gray-950">My Lease</h2>
                @if($activeLease)
                    <dl class="mt-5 grid gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-widest text-gray-500">Lease ID</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-950">{{ $activeLease->lease_id }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-widest text-gray-500">Property</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-950">{{ $activeLease->property?->street ?? $activeLease->property_id }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-widest text-gray-500">Monthly Rent</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-950">PHP {{ number_format($activeLease->rent ?? 0) }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-widest text-gray-500">Deposit</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-950">PHP {{ number_format($activeLease->deposit ?? 0) }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-widest text-gray-500">Payment Method</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-950">{{ $activeLease->payment_method ?? 'Not set' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-widest text-gray-500">Duration</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-950">{{ $activeLease->duration ?? 'N/A' }} months</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-widest text-gray-500">Start Date</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-950">{{ $activeLease->start_date ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-widest text-gray-500">End Date</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-950">{{ $activeLease->end_date ?? 'N/A' }}</dd>
                        </div>
                    </dl>
                @else
                    <div class="mt-5 rounded-lg border border-dashed border-gray-300 bg-gray-50 p-6 text-center">
                        <p class="text-sm text-gray-600">You do not have an active lease yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
