<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-900">Admin - Leases</h2>
        <p class="mt-1 text-sm text-gray-600">View and manage lease records</p>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">All Leases</h3>
                </div>

                <a href="{{ route('lease.create') }}"
                   class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Create Lease
                </a>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">Lease ID</th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">Property</th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">Renter</th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">Staff</th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">Rent</th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">Deposit</th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">Paid</th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">Start</th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">End</th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($leases as $lease)
                                <tr class="hover:bg-gray-50/60">
                                    <td class="px-4 py-3 font-semibold text-gray-900">{{ $lease->lease_id }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $lease->property->property_id ?? 'N/A' }} — {{ $lease->property->city ?? '' }}</td>
                                    <td class="px-4 py-3 text-gray-700">
                                        {{ $lease->renter->renter_id ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-700">{{ $lease->staff->staff_id ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-gray-700">PHP {{ number_format($lease->rent, 2) }}</td>
                                    <td class="px-4 py-3 text-gray-700">PHP {{ number_format($lease->deposit, 2) }}</td>
                                    <td class="px-4 py-3">
                                        @if($lease->deposit_paid)
                                            <span class="text-green-700 font-bold">Yes</span>
                                        @else
                                            <span class="text-red-700 font-bold">No</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-gray-700">{{ $lease->start_date }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $lease->end_date }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-col sm:flex-row gap-2">
                                            <a href="{{ route('leases.edit', $lease->lease_id) }}"
                                               class="inline-flex items-center rounded-md bg-yellow-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-yellow-600">
                                                Edit
                                            </a>

                                            <form action="{{ route('leases.destroy', $lease->lease_id) }}" method="POST"
                                                  onsubmit="return confirm('Delete this lease?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center rounded-md bg-red-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-red-700">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="px-4 py-8 text-center text-gray-500">No leases found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

