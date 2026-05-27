<x-app-layout>

<div class="bg-white min-h-screen pb-16">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">

            <h2 class="text-3xl font-bold text-gray-800">
                Property List
            </h2>

            <div class="flex gap-3 mt-4 md:mt-0">

                <a href="{{ route('property.create') }}">
                    <button class="px-4 py-2 bg-gray-200 rounded-lg text-sm font-semibold hover:bg-gray-300 transition">

                        All Properties
                    </button>
                </a>

                <a href="{{ route('property.index', ['filter' => 'available']) }}">
                    <button class="px-4 py-2 bg-[#5c9aa9] text-white rounded-lg text-sm font-semibold hover:bg-[#4a8291] transition">
                        Available Only
                    </button>
                </a>

            </div>

        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($properties as $property)

                <a href="{{ route('property.show', $property->property_id) }}"
                   class="group">

                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden">

                        <!-- TOP SECTION -->
                        <div class="h-40 bg-gradient-to-br from-[#5c9aa9] to-[#6caec1] flex items-center justify-center overflow-hidden">
                            @if($property->photo_path)
                                <img src="{{ asset('storage/'.$property->photo_path) }}" class="h-full w-full object-cover" alt="{{ $property->property_id }}">
                            @else
                                <span class="text-white font-bold text-xl tracking-wide">
                                    {{ $property->property_id }}
                                </span>
                            @endif
                        </div>

                        <!-- CONTENT -->
                        <div class="p-5">

                            <p class="text-gray-700 font-semibold mb-1">
                                {{ $property->street }}
                            </p>

                            <p class="text-gray-500 text-sm mb-3">
                                {{ $property->city }}
                            </p>

                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-600">
                                    {{ $property->property_type }}
                                </span>

                                <span class="font-bold text-gray-800">
                                    ₱{{ number_format($property->monthly_rent) }}
                                </span>
                            </div>

                            <!-- STATUS -->
                            <div>
                                <span class="px-3 py-1 text-xs rounded-full text-white
                                    {{ $property->status == 'Available' ? 'bg-green-500' : 'bg-red-500' }}">
                                    {{ $property->status }}
                                </span>
                            </div>

                        </div>

                    </div>

                </a>

            @endforeach

        </div>

    </div>

</div>

</x-app-layout>
