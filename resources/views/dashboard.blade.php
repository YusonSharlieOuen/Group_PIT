<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center items-center w-full">
            <h2 class="font-serif text-3xl text-gray-800 leading-tight uppercase tracking-[0.3em]">
                {{ __('Dream Home') }}
            </h2>
        </div>
    </x-slot>

    <div class="bg-gray-50 pb-20">
        <div class="relative h-[700px] w-full overflow-hidden flex flex-col items-center justify-start pt-20">
            <img src="{{ asset('images/photol3.jpg') }}"
                 class="absolute inset-0 w-full h-full object-cover brightness-50"
                 alt="Hero Background">

            <div class="relative z-10 text-center px-4 max-w-4xl mx-auto flex flex-col items-center">
                <h1 class="text-white text-6xl md:text-8xl font-serif tracking-widest uppercase mb-4 drop-shadow-2xl">
                    Dream Home
                </h1>

                <a href="{{ route('home.find') }}" class="bg-white text-gray-900 px-8 py-3 tracking-widest uppercase text-sm font-bold hover:bg-gray-200 transition-all duration-300 mb-12 shadow-lg">
                    View Listings
                </a>

                <div class="mb-10 px-6">
                    <p class="text-xl md:text-2xl text-white leading-relaxed font-semibold mb-4 italic drop-shadow-sm">
                        "At Dream Home, we believe that a house is more than just a structure. It is the foundation for your best life."
                    </p>
                    <p class="text-gray-100 leading-relaxed text-lg drop-shadow-md">
                        As a specialized rental branch, we curate a premium portfolio of homes designed to meet the diverse needs of today's renters. Whether you are a homeowner looking for a trusted partner to care for your property, or a tenant searching for your next great chapter, Dream Home is here to make the transition seamless, comfortable, and rewarding.
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto -mt-32 relative z-20 px-6">
            <div class="bg-white p-8 rounded-xl shadow-2xl border border-gray-100">
                <h3 class="text-xl font-serif font-bold mb-6 text-gray-800 uppercase tracking-wider">Find Your Property</h3>
                <form action="{{ route('home.find') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Location</label>
                        <select name="location" class="w-full border-gray-200 rounded-md py-3 focus:ring-gray-800 focus:border-gray-800">
                            <option>Manila, Philippines</option>
                            <option>Cebu City</option>
                            <option>Davao City</option>
                            <option>Quezon City</option>
                            <option>Pasig City</option>
                            <option>Taguig City</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Budget Range</label>
                        <input name="budget" type="range" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-gray-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Property Type</label>
                        <div class="flex space-x-2">
                            <button type="button" class="flex-1 py-2 border border-gray-200 rounded hover:bg-gray-50 text-sm">House</button>
                            <button type="button" class="flex-1 py-2 border border-gray-200 rounded hover:bg-gray-50 text-sm">Condo</button>
                        </div>
                    </div>
                    <button type="submit" class="bg-gray-900 text-white py-3 px-6 rounded-md font-bold uppercase text-xs tracking-widest hover:bg-gray-700 transition">
                        Search Now
                    </button>
                </form>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 mt-24">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-serif uppercase tracking-widest text-gray-900">Featured Listings</h2>
                    <p class="text-gray-500 mt-2">Explore our handpicked premium properties.</p>
                </div>
                <a href="{{ route('home.find') }}" class="text-gray-900 font-bold border-b-2 border-gray-900 pb-1 hover:text-gray-600 hover:border-gray-600 transition">View All</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @if($featuredProperties->isNotEmpty())
                    @foreach ($featuredProperties as $property)
                        <a href="{{ route('property.show', $property->property_id) }}" class="bg-white p-6 border border-gray-100 rounded-xl shadow-sm group hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-6">
                                <img src="{{ asset('images/house1.jpg') }}"
                                     class="w-24 h-32 object-cover rounded group-hover:scale-105 transition duration-300"
                                     alt="{{ $property->property_type }}">
                                <span class="text-xl font-light text-gray-900">PHP {{ number_format($property->monthly_rent) }} / mo</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-serif font-bold text-gray-900">{{ ucfirst($property->property_type) }}</h4>
                                <p class="text-gray-500 text-sm mb-4">{{ $property->number_of_rooms }} Bed - 1 Bath - {{ $property->area }}sqm</p>
                                <span class="text-xs uppercase tracking-widest font-bold text-gray-400 group-hover:text-gray-900 transition">Details -></span>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-sm">
                        <div class="flex justify-between items-start mb-6">
                            <img src="{{ asset('images/house1.jpg') }}"
                                 class="w-24 h-32 object-cover rounded transition duration-300"
                                 alt="Modern Minimalist Villa">
                            <span class="text-xl font-light text-gray-900">PHP 45,000 / mo</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-serif font-bold text-gray-900">Modern Minimalist Villa</h4>
                            <p class="text-gray-500 text-sm mb-4">3 Bed - 2 Bath - 150sqm</p>
                            <a href="{{ route('home.find') }}" class="text-xs uppercase tracking-widest font-bold text-gray-400 hover:text-gray-900 transition">View All Listings -></a>
                        </div>
                    </div>

                    <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-sm">
                        <div class="flex justify-between items-start mb-6">
                            <img src="{{ asset('images/house2.jpg') }}"
                                 class="w-24 h-32 object-cover rounded transition duration-300"
                                 alt="Skyline Luxury Condo">
                            <span class="text-xl font-light text-gray-900">PHP 32,000 / mo</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-serif font-bold text-gray-900">Skyline Luxury Condo</h4>
                            <p class="text-gray-500 text-sm mb-4">2 Bed - 1 Bath - 85sqm</p>
                            <a href="{{ route('home.find') }}" class="text-xs uppercase tracking-widest font-bold text-gray-400 hover:text-gray-900 transition">View All Listings -></a>
                        </div>
                    </div>

                    <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-sm">
                        <div class="flex justify-between items-start mb-6">
                            <img src="{{ asset('images/photo4.jpg') }}"
                                 class="w-24 h-32 object-cover rounded transition duration-300"
                                 alt="Cozy Garden Terrace">
                            <span class="text-xl font-light text-gray-900">PHP 60,000 / mo</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-serif font-bold text-gray-900">Cozy Garden Terrace</h4>
                            <p class="text-gray-500 text-sm mb-4">4 Bed - 3 Bath - 220sqm</p>
                            <a href="{{ route('home.find') }}" class="text-xs uppercase tracking-widest font-bold text-gray-400 hover:text-gray-900 transition">View All Listings -></a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
