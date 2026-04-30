<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center items-center w-full">
            <h2 class="font-serif text-3xl text-gray-800 leading-tight uppercase tracking-[0.3em]">
                {{ __('Dream Home') }}
            </h2>
        </div>
    </x-slot>

    <div class="relative h-[500px] w-full overflow-hidden flex items-center justify-center">
        <img src="{{ asset('images/photo2.jpg') }}" 
             class="absolute inset-0 w-full h-full object-cover brightness-50"
             alt="Hero Background">
        
        <div class="relative text-center px-4">
            <h1 class="text-white text-6xl md:text-8xl font-serif tracking-widest uppercase mb-6 drop-shadow-2xl">
                Dream Home
            </h1>
            <button class="bg-white text-gray-900 px-8 py-3 tracking-widest uppercase text-sm font-bold hover:bg-gray-200 transition-all duration-300">
                View Listings
            </button>
        </div>
    </div>

    <div class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="w-16 h-1 bg-gray-800 mx-auto mb-10"></div>
            <p class="text-xl md:text-2xl text-gray-700 leading-relaxed font-light mb-8 italic">
                "At Dream Home, we believe that a house is more than just a structure—it’s the foundation for your best life."
            </p>
            <p class="text-gray-500 leading-relaxed text-lg">
                As a specialized rental branch, we curate a premium portfolio of homes designed to meet the diverse needs of today’s renters. 
            </p>
        </div>
    </div>
</x-app-layout>