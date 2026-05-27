<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            {{-- PROPERTY CARD --}}
            <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">

                <img src="{{ $property->photo_path ? asset('storage/'.$property->photo_path) : asset('images/house1.jpg') }}"
                     class="h-80 w-full object-cover"
                     alt="Property {{ $property->property_id }}">

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
                                {{ $property->status == 'Available' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $property->status }}
                            </span>
                        </p>
                    </div>

                </div>
            </div>

            {{-- RENT REQUEST SECTION --}}
            @auth
                @if(strtolower(auth()->user()->user_type) === 'renter')

                    <div class="mt-10">

                        <form action="{{ route('rent-request.store', ['propertyId' => $property->property_id]) }}"
                              method="POST"
                              class="bg-white border border-gray-200 rounded-2xl shadow-md p-6">

                            @csrf

                            <h2 class="text-2xl font-bold text-gray-800 mb-1">
                                Request to Rent
                            </h2>

                            <p class="text-sm text-gray-600 mb-6">
                                Submit your rental request for this property.
                            </p>

                            <div class="space-y-4">

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Proposed Monthly Rent
                                    </label>

                                    <input type="number"
                                           name="max_rent"
                                           class="w-full border-gray-300 rounded-lg shadow-sm"
                                           required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Message (optional)
                                    </label>

                                    <textarea name="message"
                                              rows="4"
                                              class="w-full border-gray-300 rounded-lg shadow-sm"></textarea>
                                </div>

                            </div>

                            <div class="mt-6">
                                <button type="submit"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-xl">
                                    Submit Rent Request
                                </button>
                            </div>

                        </form>

                    </div>

                @endif
            @endauth

        </div>
    </div>
</x-app-layout>