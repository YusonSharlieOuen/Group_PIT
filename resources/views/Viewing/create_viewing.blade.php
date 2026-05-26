<x-app-layout>

@unless(auth()->user()?->hasRole('Admin') || auth()->user()?->hasRole('Manager'))

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800 font-semibold">
            Unauthorized.
        </div>
    </div>
    @php abort(403); @endphp
@endunless

    <div class="bg-white min-h-screen pb-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="bg-white border border-gray-200 rounded-2xl shadow-md p-6">
                <h1 class="text-3xl font-bold text-gray-900">Book a viewing</h1>
                <p class="mt-2 text-sm text-gray-600">Fill the form below to create a booking.</p>

                @if(session('success'))
                    <div class="mt-4 rounded-md border border-green-200 bg-green-50 p-3 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mt-4 rounded-md border border-red-200 bg-red-50 p-3">
                        <ul class="text-red-700 list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('viewing.store') }}" method="POST" class="mt-6 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Property</label>
                            <select
                                name="property_id"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9]"
                                required
                            >
                                <option value="">Select property</option>
                                @foreach($properties as $property)
                                    <option value="{{ $property->property_id }}">
                                        {{ $property->property_id }} - {{ $property->city }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Renter</label>
                            <select
                                name="renter_id"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9]"
                                required
                            >
                                <option value="">Select renter</option>
                                @foreach($renters as $renter)
                                    <option value="{{ $renter->renter_id }}">
                                        {{ $renter->first_name }} {{ $renter->last_name }} ({{ $renter->renter_id }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Viewing Date</label>
                            <input
                                type="date"
                                name="viewing_date"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9]"
                                required
                            >
                        </div>

                        <div class="flex items-end">
                            <div class="w-full">
                                <label class="block text-sm font-medium text-gray-700 mb-2">&nbsp;</label>
                                <button
                                    type="submit"
                                    class="bg-[#5c9aa9] hover:bg-[#4a8796] text-white font-semibold px-6 py-3 rounded-xl transition w-full"
                                >
                                    Add Viewing
                                </button>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Comments</label>
                        <textarea
                            name="comments"
                            rows="4"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#5c9aa9] focus:border-[#5c9aa9]"
                            placeholder="Optional comments..."
                        ></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

