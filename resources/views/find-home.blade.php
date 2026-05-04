<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Find a Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Search & Filter Bar -->
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 flex flex-wrap gap-4 items-end mb-8">
                <div class="flex-grow min-w-[250px]">
                    <div class="relative flex items-center">
                        <input type="text" placeholder="Location (City, Zip, or Address)" class="w-full pl-4 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm">
                    </div>
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Price Range</label>
                    <div class="flex items-center space-x-2">
                        <input type="text" placeholder="min" class="w-24 px-3 py-2 border border-gray-300 rounded-md text-sm">
                        <span class="text-gray-400">-</span>
                        <input type="text" placeholder="max" class="w-24 px-3 py-2 border border-gray-300 rounded-md text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Property Type</label>
                    <select class="w-48 px-3 py-2 border border-gray-300 rounded-md text-sm bg-white">
                        <option>House, Condo, Townhome</option>
                    </select>
                </div>

                <button class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition text-sm font-medium">
                    Search
                </button>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                
                <!-- Left Column: Property List -->
                <div class="lg:col-span-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- START OF DYNAMIC LOOP --}}
                        @forelse($properties as $property)
                            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition">
                                <img src="{{ asset('storage/' . $property->image_path) }}" class="w-full h-48 object-cover" alt="{{ $property->title }}">
                                <div class="p-4">
                                    <h3 class="text-xl font-bold text-gray-900">${{ number_format($property->price) }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ $property->address }}</p>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $property->beds }} Beds | {{ $property->baths }} Baths | {{ number_format($property->sqft) }} sq ft
                                    </p>
                                    <div class="flex justify-between items-center mt-4">
                                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">{{ $property->type }}</span>
                                        <button class="border border-gray-300 text-gray-700 text-sm px-3 py-1 rounded hover:bg-gray-50">Details</button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 py-10 text-center">
                                <p class="text-gray-500">No properties found.</p>
                            </div>
                        @endforelse
                        {{-- END OF DYNAMIC LOOP --}}

                    </div>
                </div>

                <!-- Right Column: Map Placeholder -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-100 w-full h-[500px] rounded-xl border border-gray-300 flex items-center justify-center sticky top-6">
                        <div class="text-center p-6">
                            <p class="text-gray-500 font-medium">Interactive Map View</p>
                            <p class="text-xs text-gray-400 mt-2">(Integration with Leaflet or Google Maps recommended)</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>