<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Viewing Details</h2>
            <p class="mt-1 text-sm text-gray-600">View booking information.</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                @if(session('success'))
                    <div class="mb-4 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Viewing ID</h3>
                        <p class="text-gray-700">{{ $viewing->viewing_id }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Property</h3>
                        <p class="text-gray-700">{{ optional($viewing->propertyDetails)->property_id }}</p>
                        <p class="text-gray-700">{{ optional($viewing->propertyDetails)->street }}, {{ optional($viewing->propertyDetails)->city }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Renter</h3>
                        <p class="text-gray-700">{{ $viewing->renter->first_name ?? '' }} {{ $viewing->renter->last_name ?? '' }}</p>
                        <p class="text-gray-700">({{ $viewing->renter_id }})</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Date</h3>
                        <p class="text-gray-700">{{ $viewing->viewing_date }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Comments</h3>
                        <p class="text-gray-700">{{ $viewing->comments ?? '-' }}</p>
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('admin.viewings.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Back</a>
                    <a href="{{ route('viewing.edit', $viewing->viewing_id) }}" class="rounded-md bg-[#5c9aa9] px-4 py-2 text-sm font-semibold text-white hover:bg-[#4a8291]">Edit</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

