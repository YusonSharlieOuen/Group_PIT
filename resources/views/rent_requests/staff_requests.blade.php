<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold">Staff Rent Requests</h1>

        @forelse($requests as $request)
            <div class="p-4 border rounded mt-3">

                <p><strong>Property:</strong> {{ $request->property_id }}  {{$request->property->city ?? 'N/A' }}</p>
                <p><strong>Renter:</strong> {{ $request->renter_id }} {{$request->renter->first_name }} {{ $request->renter->last_name ?? 'N/A' }}</p>
                <p><strong>Status:</strong> {{ $request->status }}</p>

                @if($request->status !== 'Accepted')
                    <form method="POST"
                          action="{{ route('staff.rent.approve', $request->id) }}"
                          class="mt-3">
                        @csrf

                        <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Approve
                        </button>
                    </form>
                @else
                    <span class="text-green-600 font-semibold">
                        Already Approved
                    </span>
                @endif

            </div>
        @empty
            <p>No rent requests assigned to you.</p>
        @endforelse
    </div>
</x-app-layout>