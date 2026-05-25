<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <p class="text-xs font-semibold uppercase tracking-widest text-[#5c9aa9]">Client Booking</p>
                <h1 class="mt-2 font-serif text-4xl font-semibold text-gray-950">Book a Viewing</h1>
                <p class="mt-2 text-sm text-gray-600">Choose an available property, select a viewing date, and add any notes for the branch team.</p>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                @if(session('success'))
                    <div class="mb-5 rounded-md border border-green-200 bg-green-50 p-3 text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-5 rounded-md border border-red-200 bg-red-50 p-3">
                        <ul class="list-disc pl-5 text-sm text-red-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($renter)
                    <div class="mb-6 rounded-md bg-gray-50 p-4 text-sm text-gray-700">
                        Booking as <span class="font-semibold text-gray-950">{{ $renter->first_name }} {{ $renter->last_name }}</span>
                        <span class="text-gray-500">({{ $renter->renter_id }})</span>
                    </div>
                @else
                    <div class="mb-6 rounded-md bg-amber-50 p-4 text-sm text-amber-800">
                        No renter profile is linked to this account yet. Select a renter record to continue.
                    </div>
                @endif

                <form action="{{ route('viewing.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">Property</label>
                            <select
                                name="property_id"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5c9aa9] focus:ring-[#5c9aa9]"
                                required
                            >
                                <option value="">Select property</option>
                                @foreach($properties as $property)
                                    <option value="{{ $property->property_id }}" @selected(old('property_id', $selectedPropertyId) === $property->property_id)>
                                        {{ $property->property_id }} - {{ $property->street }}, {{ $property->city }} - PHP {{ number_format($property->monthly_rent ?? 0) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">Viewing Date</label>
                            <input
                                type="date"
                                name="viewing_date"
                                value="{{ old('viewing_date') }}"
                                min="{{ now()->toDateString() }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5c9aa9] focus:ring-[#5c9aa9]"
                                required
                            >
                        </div>
                    </div>

                    @unless($renter)
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">Renter</label>
                            <select
                                name="renter_id"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5c9aa9] focus:ring-[#5c9aa9]"
                                required
                            >
                                <option value="">Select renter</option>
                                @foreach($renters as $record)
                                    <option value="{{ $record->renter_id }}" @selected(old('renter_id') === $record->renter_id)>
                                        {{ $record->first_name }} {{ $record->last_name }} ({{ $record->renter_id }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endunless

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Comments</label>
                        <textarea
                            name="comments"
                            rows="4"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5c9aa9] focus:ring-[#5c9aa9]"
                            placeholder="Preferred time, questions, or access notes..."
                        >{{ old('comments') }}</textarea>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">
                        <a href="{{ route('dashboard') }}" class="rounded-md border border-gray-300 px-5 py-3 text-center text-sm font-semibold text-gray-900 transition hover:bg-gray-50">
                            Back to Dashboard
                        </a>
                        <button
                            type="submit"
                            class="rounded-md bg-[#5c9aa9] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#4a8796]"
                        >
                            Submit Viewing Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
