<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pending Rent Requests (Manager)
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @foreach ($requests as $request)
                <div class="bg-white p-4 mb-4 shadow rounded">

                    <p><strong>Renter:</strong> {{ $request->renter->first_name }} {{ $request->renter->last_name ?? 'N/A' }}</p>
                    <p><strong>Property:</strong> {{ $request->property->city ?? 'N/A' }}</p>
                    <p><strong>Property ID:</strong> {{ $request->property->property_id ?? 'N/A' }}</p>
                    <p><strong>Status:</strong> {{ $request->status }}</p>
                    <p><strong>Requested At:</strong> {{ $request->created_at }}</p>

                    <form method="POST"
                          action="{{ route('rent.request.assign', $request->id) }}"
                          class="mt-3">
                        @csrf

                        <select name="staff_id" required>
                            <option value="">Assign Staff</option>
                            @foreach (\App\Models\Staff::all() as $staff)
                                <option value="{{ $staff->staff_id }}">
                                    {{ $staff->first_name }} {{ $staff->last_name }}
                                </option>
                            @endforeach
                        </select>

                        <button class="bg-blue-500 text-white px-3 py-1 rounded">
                            Assign
                        </button>
                    </form>

                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>