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

            @if($property->photo_path)
                <img src="{{ asset('storage/'.$property->photo_path) }}"
                     class="h-80 w-full object-cover"
                     alt="Property {{ $property->property_id }}">
            @endif

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">

                <div>
                    <p><strong>Area:</strong> {{ $property->area }}</p>
                    <p><strong>Postcode:</strong> {{ $property->postcode }}</p>
                    <p><strong>Type:</strong> {{ $property->property_type }}</p>
                    <p><strong>Rooms:</strong> {{ $property->number_of_rooms }}</p>
                </div>

                <div>
                    <p><strong>Monthly Rent:</strong> ₱{{ number_format($property->monthly_rent) }}</p>

                    <p class="mt-2">
                        <strong>Status:</strong>

                        <span class="px-3 py-1 rounded-full text-white text-sm
                            {{ $property->status == 'Available'
                                ? 'bg-green-500'
                                : 'bg-red-500' }}">

                            {{ $property->status }}

                        </span>
                    </p>
                </div>

            </div>

        </div>

        <!-- BOOKING GUI (Create Viewing) -->
        <div class="mt-10 bg-white border border-gray-200 rounded-2xl shadow-md p-6">

            <h2 class="text-2xl font-bold text-gray-800 mb-1">
                Book this property
            </h2>
            <p class="text-sm text-gray-600 mb-6">
                Pick a renter and select a viewing date.
            </p>

            <form action="{{ route('viewing.store') }}" method="POST" class="space-y-6">

                @csrf

                <!-- hidden property id -->
                <input
                    type="hidden"
                    name="property_id"
                    value="{{ $property->property_id }}"
                >

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- RENTER -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Renter
                        </label>

                        <select
                            name="renter_id"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9]"
                            required
                        >

                            <option value="">Select Renter</option>

                            @foreach($renters as $renter)

                                <option value="{{ $renter->renter_id }}">
                                    {{ $renter->first_name }}
                                    {{ $renter->last_name }}
                                    ({{ $renter->renter_id }})
                                </option>

                            @endforeach

                        </select>
                    </div>

                    <!-- DATE -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Viewing Date
                        </label>

                        <input
                            type="date"
                            name="viewing_date"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9]"
                            required
                        >
                    </div>

                </div>

                <!-- COMMENTS -->
                <div class="mt-6">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Comments
                    </label>

                    <textarea
                        name="comments"
                        rows="4"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9]"
                        placeholder="Enter comments..."
                    ></textarea>

                </div>

                <div class="mt-6">
                    <button
                        type="submit"
                        class="bg-[#5c9aa9] hover:bg-[#4a8796] text-white font-semibold px-6 py-3 rounded-xl transition"
                    >
                        Create Viewing
                    </button>
                </div>

            </form>

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
