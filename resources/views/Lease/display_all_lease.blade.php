<x-app-layout>

@unless(auth()->user()?->hasRole('Admin') || auth()->user()?->hasRole('Manager'))
    <div class="max-w-7xl mx-auto px-6 py-10">
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800 font-semibold">
            Unauthorized.
        </div>
    </div>
    @php abort(403); @endphp
@endunless

<div class="max-w-7xl mx-auto px-6 py-10">

    <div class="flex items-center justify-between gap-4 mb-6">
        <h2 class="text-2xl font-bold">All Leases</h2>

        <a href="{{ route('leases.create') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Add New Lease
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded-lg border">

        <table class="w-full text-left border-collapse">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border">Lease ID</th>
                    <th class="p-3 border">Property</th>
                    <th class="p-3 border">Renter</th>
                    <th class="p-3 border">Staff</th>
                    <th class="p-3 border">Rent</th>
                    <th class="p-3 border">Deposit</th>
                    <th class="p-3 border">Paid</th>
                    <th class="p-3 border">Start</th>
                    <th class="p-3 border">End</th>
                    <th class="p-3 border">Duration (mo)</th>
                    <th class="p-3 border">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($leases as $lease)
                    <tr class="border-t hover:bg-gray-50">

                        <td class="p-3 border">{{ $lease->lease_id }}</td>

                        <td class="p-3 border">
                            {{ $lease->property->property_id ?? 'N/A' }}
                            {{ '-' }}
                            {{ $lease->property->city ?? 'N/A' }}
                        </td>

                        <td class="p-3 border">
                            {{ $lease->renter->renter_id ?? 'N/A' }}
                            {{ $lease->renter->first_name ?? '' }} {{ $lease->renter->last_name ?? '' }}
                        </td>

                        <td class="p-3 border">
                            {{ $lease->staff->staff_id ?? 'N/A' }}
                            {{ $lease->staff->first_name ?? '' }} {{ $lease->staff->last_name ?? '' }}
                        </td>

                        <td class="p-3 border">
                            {{ number_format($lease->rent, 2) }}
                        </td>

                        <td class="p-3 border">
                            {{ number_format($lease->deposit, 2) }}
                        </td>

                        <td class="p-3 border">
                            @if($lease->deposit_paid)
                                <span class="text-green-600 font-semibold">Yes</span>
                            @else
                                <span class="text-red-600 font-semibold">No</span>
                            @endif
                        </td>

                        <td class="p-3 border">
                            {{ $lease->start_date }}
                        </td>

                        <td class="p-3 border">
                            {{ $lease->end_date }}
                        </td>

                        <td class="p-3 border">
                            {{ $lease->duration }}
                        </td>

                        <td class="p-3 border">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('leases.edit', $lease->lease_id) }}" class="inline-flex items-center rounded-md bg-yellow-500 px-2.5 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                                    Edit
                                </a>

                                <form action="{{ route('leases.destroy', $lease->lease_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lease?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center rounded-md bg-red-600 px-2.5 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="p-4 text-center text-gray-500">
                            No leases found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

</x-app-layout>