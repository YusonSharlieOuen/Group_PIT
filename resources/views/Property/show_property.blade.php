<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
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
                            {{ $property->status == 'Available'
                                ? 'bg-green-500'
                                : 'bg-red-500' }}">

                            {{ $property->status }}

                        </span>
                    </p>
                </div>

            </div>

        </div>

@unless(auth()->user()?->hasRole('Renter'))
        <div class="mt-10 bg-white border border-gray-200 rounded-2xl shadow-md p-6">




            <h2 class="text-2xl font-bold text-gray-800 mb-1">
                Book this property
            </h2>

            <p class="text-sm text-gray-600 mb-6">
                Pick a renter and select a viewing date.
            </p>

            <form action="{{ route('viewing.store') }}" method="POST" class="space-y-6">

                @csrf

                <input
                    type="hidden"
                    name="property_id"
                    value="{{ $property->property_id }}"
                >

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    @if(!auth()->user() || !auth()->user()?->hasRole('Renter'))

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
                    @else
                        {{-- Client booking: capture renter_id automatically --}}
                        <input type="hidden" name="renter_id" value="{{ auth()->user()->renter?->renter_id ?? auth()->user()->id }}">
                    @endif

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

                        <div class="rounded-lg border border-gray-200 p-5">
                            <h2 class="font-serif text-2xl font-semibold text-gray-950">Branch and Agent</h2>
                            <div class="mt-5 space-y-4 text-sm text-gray-700">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-500">Branch</p>
                                    <p class="mt-1 font-medium text-gray-950">{{ $property->branch?->city ?? 'N/A' }}</p>
                                    <p>{{ $property->branch?->telephone ?? 'No telephone listed' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-500">Assigned Staff</p>
                                    <p class="mt-1 font-medium text-gray-950">
                                        {{ $property->staff ? $property->staff->first_name.' '.$property->staff->last_name : 'N/A' }}
                                    </p>
                                    <p>{{ $property->staff?->phone ?? 'No phone listed' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-6 rounded-lg border border-gray-200 p-5">
                        <h2 class="font-serif text-2xl font-semibold text-gray-950">Advertisement Details</h2>
                        @if($property->adverts->isNotEmpty())
                            <div class="mt-4 grid gap-3 sm:grid-cols-2">
                                @foreach($property->adverts as $advert)
                                    <div class="rounded-md bg-gray-50 p-4 text-sm text-gray-700">
                                        <p class="font-semibold text-gray-950">{{ $advert->newspaper ?? 'Advertisement' }}</p>
                                        <p class="mt-1">Advertised: {{ $advert->date_advertised ?? 'Date not set' }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="mt-3 text-sm text-gray-600">No advertisement records are attached to this property.</p>
                        @endif
                    </div>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('viewing.create', ['property_id' => $property->property_id]) }}" class="rounded-md bg-[#5c9aa9] px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-[#4a8796]">
                            Schedule Viewing
                        </a>
                        <a href="{{ route('dashboard') }}#browse-properties" class="rounded-md border border-gray-300 px-5 py-3 text-center text-sm font-semibold text-gray-900 transition hover:bg-gray-50">
                            Back to Client Dashboard
                        </a>
                    </div>
                </div>
            @endif
            </div>

            <div class="mt-8 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <h2 class="font-serif text-2xl font-semibold text-gray-950">My Viewing Requests for This Property</h2>
                <div class="mt-5 overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-gray-200 text-xs uppercase tracking-widest text-gray-500">
                            <tr>
                                <th class="py-3 pr-4">Viewing Date</th>
                                <th class="py-3 pr-4">Comments</th>
                                <th class="py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($viewings as $viewing)
                                <tr>
                                    <td class="py-3 pr-4 text-gray-900">{{ $viewing->viewing_date }}</td>
                                    <td class="py-3 pr-4 text-gray-700">{{ $viewing->comments ?? 'No comments' }}</td>
                                    <td class="py-3">
                                        <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">Pending</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-5 text-center text-gray-600">You have not booked a viewing for this property.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endunless
</x-app-layout>