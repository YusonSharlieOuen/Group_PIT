<x-app-layout>

<div class="bg-white min-h-screen pb-16">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- PROPERTY CARD -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">

            <div class="bg-[#5c9aa9] text-white p-6">
                <h1 class="text-3xl font-bold tracking-wide">
                    Property {{ $property->property_id }}
                </h1>
                <p class="text-sm opacity-90">
                    {{ $property->street }}, {{ $property->city }}
                </p>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">

                <div>
                    <p><strong>Area:</strong> {{ $property->area }}</p>
                    <p><strong>Postcode:</strong> {{ $property->postcode }}</p>
                    <p><strong>Type:</strong> {{ $property->property_type }}</p>
                    <p><strong>Rooms:</strong> {{ $property->number_of_rooms }}</p>
                </div>

                <div>
                    <p><strong>Monthly Rent:</strong> ₱{{ number_format($property->monthly_rent) }}</p>
                    <p><strong>Status:</strong>
                        <span class="px-3 py-1 rounded-full text-white text-sm
                            {{ $property->status == 'Available' ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ $property->status }}
                        </span>
                    </p>
                </div>

            </div>

        </div>

        <!-- VIEWINGS SECTION -->
        <div class="mt-10">

            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Viewings
            </h2>

            @if($viewings->count() == 0)

                <p class="text-gray-500">No viewings yet.</p>

            @else

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    @foreach($viewings as $viewing)

                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 hover:shadow-md transition">

                            <p class="font-semibold text-gray-800">
                                {{ $viewing->renter->first_name }}
                                {{ $viewing->renter->last_name }}
                                <span class="text-gray-500 font-normal">
                                    ({{ $viewing->renter_id }})
                                </span>
                            </p>

                            <p class="text-sm text-gray-600 mt-2">
                                <strong>Date:</strong> {{ $viewing->viewing_date }}
                            </p>

                            <p class="text-sm text-gray-600 mt-1">
                                <strong>Comments:</strong> {{ $viewing->comments }}
                            </p>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>

    </div>

</div>

</x-app-layout>