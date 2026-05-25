<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Viewings Calendar</h2>
            <p class="mt-1 text-sm text-gray-600">Schedule and bookings grouped by date.</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">

                @php
                    $grouped = collect($viewings ?? [])
                        ->sortBy('viewing_date')
                        ->groupBy(function ($v) {
                            return (string) $v->viewing_date;
                        });
                @endphp

                @if(($viewings ?? collect())->count() === 0)
                    <p class="text-gray-500">No viewings found.</p>
                @else
                    <div class="space-y-6">
                        @foreach($grouped as $date => $items)
                            <div class="border border-gray-200 rounded-xl p-4">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $date }}</h3>
                                    <span class="text-sm text-gray-600">{{ $items->count() }} booking(s)</span>
                                </div>

                                <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($items as $viewing)
                                        <div class="border border-gray-200 rounded-lg p-4">
                                            <div class="font-semibold text-gray-900">
                                                {{ $viewing->renter->first_name ?? '' }} {{ $viewing->renter->last_name ?? '' }}
                                                <span class="text-gray-500 font-normal">({{ $viewing->renter_id }})</span>
                                            </div>

                                            <div class="text-sm text-gray-700 mt-1">
                                                <div><span class="font-medium">Property:</span> {{ optional($viewing->propertyDetails)->property_id ?? $viewing->property_id }}</div>
                                                <div class="mt-1"><span class="font-medium">Comments:</span> {{ $viewing->comments ?? '-' }}</div>
                                            </div>

                                            <div class="mt-3 flex gap-3 items-center">
                                                <a href="{{ route('viewing.edit', $viewing->viewing_id) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-xs">edit</a>
                                                <form action="{{ route('viewing.destroy', $viewing->viewing_id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-xs" onclick="return confirm('Delete this viewing?')">
                                                        delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>

