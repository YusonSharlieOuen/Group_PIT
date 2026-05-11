<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center items-center w-full">
            <h2 class="font-serif text-3xl text-gray-800 leading-tight uppercase tracking-[0.3em]">
                {{ __('Dream Home') }}
            </h2>
        </div>
    </x-slot>

<div class="bg-[#fbfaf8] w-full min-h-screen font-sans">

    <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden flex flex-col items-center justify-center">
        <img src="{{ asset('images/photo4.jpg') }}" 
             class="absolute inset-0 w-full h-full object-cover"
             alt="Hero Background">
             
        <div class="absolute inset-0 bg-black/40"></div>
        
        <div class="relative z-10 text-center px-4 flex flex-col items-center mt-12">
            <h1 class="text-[#d8b97d] text-6xl md:text-8xl font-serif tracking-widest uppercase mb-6 drop-shadow-xl">
                Dream Home
            </h1>
            
            <button class="bg-[#1c2925] text-[#e0cfab] border border-[#d8b97d] px-8 py-3 font-serif tracking-wider text-lg hover:bg-[#d8b97d] hover:text-[#1c2925] transition-all duration-300">
                Explore Our Portfolio
            </button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-16 md:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            
            <div class="lg:col-span-7">
                <p class="text-2xl md:text-3xl font-serif text-gray-800 leading-relaxed text-justify md:text-left">
                    At Dream Home, we believe that a house is more than just a structure—it’s the foundation for your best life. As a specialized rental branch, we curate a premium portfolio of homes designed to meet the diverse needs of today’s renters. Whether you are a homeowner looking for a trusted partner to care for your property, or a tenant searching for your next great chapter. Dream Home is here to make the transition seamless, comfortable, and rewarding.
                </p>
            </div>

            <div class="lg:col-span-5 flex flex-col gap-8">
                
                <div class="bg-[#fbfaf8] rounded-2xl p-8 border-[3px] border-[#d8b97d]/60 shadow-[0_8px_30px_rgb(0,0,0,0.08)] flex flex-col items-center justify-center text-center relative">
                    <div class="mb-4 text-[#d8b97d]">
                        <svg class="w-16 h-16 transform -rotate-45" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L2 19v-2h2v-2h2l2-2h2l1.257-1.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-xl md:text-2xl font-serif text-[#2a302c] tracking-widest leading-snug uppercase">
                        Curated<br>Premium<br>Portfolio
                    </h3>
                </div>

                <div class="bg-[#f0ede6] rounded-2xl flex overflow-hidden shadow-lg h-48">
                    <div class="w-2/5 h-full">
                        <img src="{{ asset('images/keys-hand.jpg') }}" alt="Handing over keys" class="w-full h-full object-cover">
                    </div>
                    
                    <div class="w-3/5 p-6 relative flex flex-col justify-center">
                        <h4 class="text-lg font-serif text-gray-900 leading-tight mb-3 uppercase tracking-wide">
                            For Renters &<br>Homeowners
                        </h4>
                        
                        <ul class="text-sm text-gray-700 space-y-1.5">
                            <li class="flex items-center">
                                <span class="w-1.5 h-1.5 bg-gray-500 rounded-full mr-2"></span> Profiles and Renters
                            </li>
                            <li class="flex items-center">
                                <span class="w-1.5 h-1.5 bg-gray-500 rounded-full mr-2"></span> Promotary profiles
                            </li>
                            <li class="flex items-center">
                                <span class="w-1.5 h-1.5 bg-gray-500 rounded-full mr-2"></span> Concise benefits
                            </li>
                        </ul>
                        
                        <div class="absolute bottom-4 right-4 flex -space-x-2">
                            <img class="w-10 h-10 rounded-full border-2 border-[#f0ede6] object-cover" src="{{ asset('images/avatar1.jpg') }}" alt="Agent">
                            <img class="w-10 h-10 rounded-full border-2 border-[#f0ede6] object-cover" src="{{ asset('images/avatar2.jpg') }}" alt="Agent">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
        <!-- FEATURED LISTINGS GRID -->
        <div class="max-w-7xl mx-auto px-6 mt-24">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-serif uppercase tracking-widest text-gray-900">Featured Listings</h2>
                    <p class="text-gray-500 mt-2">Explore our handpicked premium properties.</p>
                </div>
                <a href="#" class="text-gray-900 font-bold border-b-2 border-gray-900 pb-1 hover:text-gray-600 hover:border-gray-600 transition">View All</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Card 1 -->
                <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-sm group cursor-pointer hover:shadow-md transition">
                    <div class="flex justify-between items-start mb-6">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80" 
                             class="w-20 h-30 object-cover rounded group-hover:scale-105 transition duration-300">
                        <span class="text-xl font-light text-gray-900">₱45,000 / mo</span>
                    </div>
                    <div>
                        <h4 class="text-lg font-serif font-bold text-gray-900">Modern Minimalist Villa</h4>
                        <p class="text-gray-500 text-sm mb-4">3 Bed • 2 Bath • 150sqm</p>
                        <span class="text-xs uppercase tracking-widest font-bold text-gray-400 group-hover:text-gray-900 transition">Details →</span>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-sm group cursor-pointer hover:shadow-md transition">
                    <div class="flex justify-between items-start mb-6">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80" 
                             class="w-20 h-30 object-cover rounded group-hover:scale-105 transition duration-300">
                        <span class="text-xl font-light text-gray-900">₱32,000 / mo</span>
                    </div>
                    <div>
                        <h4 class="text-lg font-serif font-bold text-gray-900">Skyline Luxury Condo</h4>
                        <p class="text-gray-500 text-sm mb-4">2 Bed • 1 Bath • 85sqm</p>
                        <span class="text-xs uppercase tracking-widest font-bold text-gray-400 group-hover:text-gray-900 transition">Details →</span>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-sm group cursor-pointer hover:shadow-md transition">
                    <div class="flex justify-between items-start mb-6">
                        <img src="https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=800&q=80" 
                             class="w-20 h-30 object-cover rounded group-hover:scale-105 transition duration-300">
                        <span class="text-xl font-light text-gray-900">₱60,000 / mo</span>
                    </div>
                    <div>
                        <h4 class="text-lg font-serif font-bold text-gray-900">Cozy Garden Terrace</h4>
                        <p class="text-gray-500 text-sm mb-4">4 Bed • 3 Bath • 220sqm</p>
                        <span class="text-xs uppercase tracking-widest font-bold text-gray-400 group-hover:text-gray-900 transition">Details →</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>