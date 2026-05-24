<x-app-layout>
    <section class="relative min-h-[520px] overflow-hidden bg-gray-950">
        <img src="{{ asset('images/photol3.jpg') }}"
             class="absolute inset-0 h-full w-full object-cover opacity-70"
             alt="Dream Home property">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-950/80 via-gray-950/45 to-gray-950/15"></div>

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
                    <a href="{{ route('property.index') }}" class="inline-flex items-center rounded-md border border-white/50 px-5 py-3 text-sm font-semibold uppercase tracking-wider text-white transition hover:bg-white/10">
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
                <a href="{{ route('property.index') }}" class="rounded-md border border-gray-100 p-4 transition hover:border-gray-300 hover:bg-gray-50">
                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-500">Portfolio</p>
                    <p class="mt-2 text-lg font-semibold text-gray-950">Properties</p>
                </a>
                <a href="{{ route('lease.all') }}" class="rounded-md border border-gray-100 p-4 transition hover:border-gray-300 hover:bg-gray-50">
                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-500">Records</p>
                    <p class="mt-2 text-lg font-semibold text-gray-950">Leases</p>
                </a>
                <a href="{{ route('viewing.create') }}" class="rounded-md border border-gray-100 p-4 transition hover:border-gray-300 hover:bg-gray-50">
                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-500">Schedule</p>
                    <p class="mt-2 text-lg font-semibold text-gray-950">Book Viewing</p>
                </a>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 pb-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <h2 class="font-serif text-3xl font-semibold text-gray-950">Featured Listings</h2>
                    <p class="mt-2 text-sm text-gray-600">A quick look at properties currently available.</p>
                </div>
                <a href="{{ route('home.find') }}" class="text-sm font-semibold text-gray-950 underline underline-offset-4 hover:text-gray-600">View all listings</a>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                @forelse($featuredProperties as $property)
                    <a href="{{ route('property.show', $property->property_id) }}" class="group overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                        <img src="{{ asset('images/house1.jpg') }}"
                             class="h-56 w-full object-cover transition duration-300 group-hover:scale-105"
                             alt="{{ $property->property_type }}">
                        <div class="p-5">
                            <div class="flex items-start justify-between gap-4">
                                <h3 class="font-serif text-xl font-semibold text-gray-950">{{ ucfirst($property->property_type) }}</h3>
                                <p class="text-right text-sm font-bold text-gray-950">PHP {{ number_format($property->monthly_rent) }}</p>
                            </div>
                            <p class="mt-2 text-sm text-gray-600">{{ $property->street }}, {{ $property->city }}</p>
                            <p class="mt-4 text-xs font-semibold uppercase tracking-widest text-gray-400">Details -></p>
                        </div>
                    </a>
                @empty
                    @foreach ([
                        ['image' => 'house1.jpg', 'title' => 'Modern Minimalist Villa', 'price' => 'PHP 45,000 / mo', 'meta' => '3 Bed - 2 Bath - Manila'],
                        ['image' => 'house2.jpg', 'title' => 'Skyline Luxury Condo', 'price' => 'PHP 32,000 / mo', 'meta' => '2 Bed - 1 Bath - Quezon City'],
                        ['image' => 'photo4.jpg', 'title' => 'Cozy Garden Terrace', 'price' => 'PHP 60,000 / mo', 'meta' => '4 Bed - 3 Bath - Taguig'],
                    ] as $listing)
                        <a href="{{ route('home.find') }}" class="group overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                            <img src="{{ asset('images/'.$listing['image']) }}"
                                 class="h-56 w-full object-cover transition duration-300 group-hover:scale-105"
                                 alt="{{ $listing['title'] }}">
                            <div class="p-5">
                                <div class="flex items-start justify-between gap-4">
                                    <h3 class="font-serif text-xl font-semibold text-gray-950">{{ $listing['title'] }}</h3>
                                    <p class="text-right text-sm font-bold text-gray-950">{{ $listing['price'] }}</p>
                                </div>
                                <p class="mt-2 text-sm text-gray-600">{{ $listing['meta'] }}</p>
                                <p class="mt-4 text-xs font-semibold uppercase tracking-widest text-gray-400">View listings -></p>
                            </div>
                        </a>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
