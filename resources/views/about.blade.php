<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <div class="bg-white min-h-screen py-10 font-sans">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="relative w-full h-[300px] md:h-[400px] rounded-[2rem] border-4 border-[#007aff] overflow-hidden shadow-lg mb-12">
                <img src="{{ asset('images/team-meeting.jpg') }}" class="absolute inset-0 w-full h-full object-cover" alt="Team meeting">
                
                <div class="absolute inset-0 bg-black/40"></div>
                
                <div class="absolute inset-0 flex flex-col items-center justify-start pt-10 px-4 text-center">
                    <h2 class="text-white text-xl md:text-3xl font-medium drop-shadow-md mb-1">
                        Our Story: Empathy in Every Transaction.
                    </h2>
                    <h2 class="text-white text-xl md:text-3xl font-medium drop-shadow-md">
                        Our Mission: Redefining the Rental Experience.
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-16">
                
                <div class="bg-[#dbdbdb] rounded-[2rem] p-8 flex justify-center items-start h-64 md:h-80 shadow-sm hover:shadow-md transition">
                    <h3 class="text-xl md:text-2xl font-serif text-center text-gray-900 leading-tight">
                        Founder<br>vision
                    </h3>
                </div>

                <div class="md:col-span-2 bg-[#dbdbdb] rounded-[2rem] p-8 flex justify-center items-start h-64 md:h-80 shadow-sm hover:shadow-md transition">
                    <h3 class="text-2xl md:text-3xl font-serif text-center text-gray-900 uppercase tracking-wide">
                        DREAM HOME<br>TEAM
                    </h3>
                </div>

                <div class="bg-[#dbdbdb] rounded-[2rem] p-8 flex justify-center items-start h-64 md:h-80 shadow-sm hover:shadow-md transition">
                    <h3 class="text-xl md:text-2xl font-serif text-center text-gray-900 leading-tight">
                        Why<br>choose us?
                    </h3>
                </div>

            </div>

            <div class="flex justify-center pb-12">
                <button class="bg-[#00e600] text-black text-lg md:text-xl font-medium px-10 py-3 rounded-full hover:bg-[#00cc00] transition shadow-md border border-gray-200">
                    LEARN MORE about Our Story
                </button>
            </div>

        </div>
    </div>
</x-app-layout>