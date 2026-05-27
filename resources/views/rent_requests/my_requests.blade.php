<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Rent Requests
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @forelse($requests as $request)

                <div class="bg-white shadow rounded-lg p-6 mb-4">

                    <h2 class="text-lg font-bold">
                        Property:
                        {{ $request->property->property_id }}
                    </h2>

                    <p class="mt-2">
                        Status:
                        <span class="font-semibold">
                            {{ $request->status }}
                        </span>
                    </p>

                    @if($request->assignedStaff)
                        <p class="mt-2">
                            Assigned Staff:
                            {{ $request->assignedStaff->first_name }}
                            {{ $request->assignedStaff->last_name }}
                        </p>
                    @endif

                    @if($request->approvedStaff)
                        <p class="mt-2 text-green-600 font-semibold">
                            Accepted By:
                            {{ $request->approvedStaff->first_name }}
                            {{ $request->approvedStaff->last_name }}
                        </p>
                    @endif

                </div>

            @empty

                <div class="bg-white shadow rounded-lg p-6">
                    No rent requests yet.
                </div>

            @endforelse

        </div>
    </div>

</x-app-layout>