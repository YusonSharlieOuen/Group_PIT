<x-app-layout>

<div class="max-w-7xl mx-auto px-6 py-10">

    <h2 class="text-2xl font-bold mb-6">All Leases</h2>

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

                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="p-4 text-center text-gray-500">
                            No leases found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

</x-app-layout>