<x-app-layout>
    <div class="w-full h-[220px] bg-cover bg-center relative flex items-center justify-center" style="background-image: url('{{ asset('images/photo4.jpg') }}');">
        <div class="absolute inset-0 bg-black/30"></div>
        <h1 class="relative z-10 text-white text-5xl md:text-6xl font-serif tracking-[0.2em] uppercase opacity-90 drop-shadow-lg">
            Dream Home
        </h1>
    </div>

    <div class="bg-white min-h-screen pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="relative z-20 -mt-8 mb-4 max-w-4xl mx-auto">
                <form action="{{ route('home.find') }}" method="GET" class="bg-white rounded-xl shadow-lg border border-gray-200 p-1.5 flex items-center">
                    <svg class="h-6 w-6 text-gray-400 ml-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Enter City, Neighborhood, or Zip Code" 
                           class="flex-1 border-none outline-none focus:ring-0 text-gray-700 py-2 sm:text-lg">
                    <button type="submit" class="bg-[#5c9aa9] text-white px-8 py-2.5 rounded-lg font-medium hover:bg-[#4a8291] transition shadow-sm">
                        Search
                    </button>
                </form>
            </div>

            <div class="flex flex-wrap justify-center gap-3 mb-10 max-w-5xl mx-auto">
                <select name="type" class="bg-gray-50 border border-gray-200 text-gray-700 py-2 px-4 rounded-md text-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9] shadow-sm font-medium cursor-pointer">
                    <option value="">Property Type</option>
                    <option value="House" {{ request('type') == 'House' ? 'selected' : '' }}>House</option>
                    <option value="Condo" {{ request('type') == 'Condo' ? 'selected' : '' }}>Condo</option>
                </select>
                
                <select class="bg-gray-50 border border-gray-200 text-gray-700 py-2 px-4 rounded-md text-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9] shadow-sm font-medium cursor-pointer">
                    <option value="">Price Range</option>
                </select>

                <select class="bg-gray-50 border border-gray-200 text-gray-700 py-2 px-4 rounded-md text-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9] shadow-sm font-medium cursor-pointer">
                    <option value="">Beds/Baths</option>
                </select>

                <select class="bg-gray-50 border border-gray-200 text-gray-700 py-2 px-4 rounded-md text-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9] shadow-sm font-medium cursor-pointer">
                    <option value="">Square Feet</option>
                </select>

                <button type="submit" class="bg-[#b39e60] text-white px-8 py-2 rounded-md font-medium hover:bg-[#9c8952] transition text-sm shadow-sm">
                    Search
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-7">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        
                        <div class="bg-white rounded-2xl border-2 border-[#5c9aa9] overflow-hidden flex flex-col shadow-md">
                            <div class="h-48 w-full bg-gray-200">
                                <img src="{{ asset('images/house1.jpg') }}" class="w-full h-full object-cover" alt="Villa" onerror="this.style.display='none'">
                            </div>
                            <div class="p-4 flex flex-col flex-1">
                                <h3 class="font-bold text-gray-900 text-lg leading-tight mb-1">Address Villa, Mianan</h3>
                                <div class="flex justify-between items-baseline mb-2">
                                    <span class="text-gray-900 font-extrabold text-xl">$850,000</span>
                                    <span class="text-gray-800 font-bold text-sm">3 Bd, 2 Ba</span>
                                </div>
                                <p class="text-gray-600 text-xs mb-4 line-clamp-3 leading-relaxed flex-1">
                                    A modern piece of architecture right on the beachfront with complete home amenities.
                                </p>
                                <div class="flex gap-2 mt-auto">
                                    <button class="flex-1 bg-[#e8e6df] text-gray-800 py-2.5 rounded-lg text-xs font-bold hover:bg-gray-300 transition">Save Property</button>
                                    <button class="flex-1 bg-[#6caec1] text-white py-2.5 rounded-lg text-xs font-bold hover:bg-[#5a93a3] transition">View Details</button>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden flex flex-col shadow-sm hover:shadow-md transition">
                            <div class="h-48 w-full bg-gray-200">
                                <img src="{{ asset('images/house2.jpg') }}" class="w-full h-full object-cover" alt="Brick Home" onerror="this.style.display='none'">
                            </div>
                            <div class="p-4 flex flex-col flex-1">
                                <h3 class="font-bold text-gray-900 text-lg leading-tight mb-1">Address Brick home</h3>
                                <div class="flex justify-between items-baseline mb-2">
                                    <span class="text-gray-900 font-extrabold text-xl">$750,000</span>
                                    <span class="text-gray-800 font-bold text-sm">3 Bd, 2 Ba</span>
                                </div>
                                <p class="text-gray-600 text-xs mb-4 line-clamp-3 leading-relaxed flex-1">
                                    Traditional consolidated brick home fit for a family seeking comfort and stability.
                                </p>
                                <div class="flex gap-2 mt-auto">
                                    <button class="flex-1 bg-[#e8e6df] text-gray-800 py-2.5 rounded-lg text-xs font-bold hover:bg-gray-300 transition">Save Property</button>
                                    <button class="flex-1 bg-[#6caec1] text-white py-2.5 rounded-lg text-xs font-bold hover:bg-[#5a93a3] transition">View Details</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="lg:col-span-5 relative">
                    <div class="sticky top-6 w-full h-[700px] bg-[#eef3f2] rounded-3xl overflow-hidden shadow-inner border-[6px] border-white flex flex-col items-center justify-center">
                        
                        <img src="{{ asset('images/map-placeholder.jpg') }}" class="absolute inset-0 w-full h-full object-cover z-0" alt="Map" onerror="this.style.display='none'">
                        
                        <div class="relative z-10 text-center p-6 bg-white/80 rounded-xl backdrop-blur-sm border border-gray-200 shadow-sm">
                            <svg class="w-12 h-12 text-[#5c9aa9] mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                            <h4 class="font-bold text-gray-800 text-lg">Interactive Map</h4>
                            <p class="text-sm text-gray-500 mt-1">Property locations will appear here.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>