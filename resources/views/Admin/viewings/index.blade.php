<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Admin - Viewings (Bookings)</h2>
            <p class="mt-1 text-sm text-gray-600">Manage client bookings: edit or delete.</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                @if(session('success'))
                    <div class="mb-4 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">All Viewings</h3>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.viewings.calendar') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 rounded-md text-sm font-semibold hover:bg-gray-200">
                            Calendar
                        </a>
                        <a href="{{ route('viewing.create') }}" class="inline-flex items-center px-4 py-2 bg-[#5c9aa9] text-white rounded-md text-sm font-semibold hover:bg-[#4a8291]">
                            Add Viewing
                        </a>
                    </div>

                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Viewing ID</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Property</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Renter</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Comments</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($viewings as $viewing)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $viewing->viewing_id }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $viewing->propertyDetails->property_id ?? $viewing->property_id }}

                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $viewing->renter->first_name ?? '' }} {{ $viewing->renter->last_name ?? '' }}
                                        <span class="text-gray-500">({{ $viewing->renter_id }})</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $viewing->viewing_date }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $viewing->comments ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        <div class="flex gap-3 items-center">
                                            <a href="{{ route('viewing.edit', $viewing->viewing_id) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-xs">edit</a>
                                            <form action="{{ route('viewing.destroy', $viewing->viewing_id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-xs" onclick="return confirm('Delete this viewing?')">delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-sm text-gray-500">No viewings found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

