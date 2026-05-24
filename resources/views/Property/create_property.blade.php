<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Create Property</h2>
            <p class="mt-1 text-sm text-gray-600">Add a new property listing</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                @if ($errors->any())
                    <div class="mb-4 rounded-md border border-red-200 bg-red-50 p-3">
                        <ul class="list-disc pl-5 text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('property.details.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Property ID</label>
                        <input
                            type="text"
                            name="property_id"
                            value="{{ $propertyId }}"
                            readonly
                            class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm focus:border-green-500 focus:ring-green-500"
                        >
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Street</label>
                            <input
                                type="text"
                                name="street"
                                placeholder="Street"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Area</label>
                            <input
                                type="text"
                                name="area"
                                placeholder="Area"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">City</label>
                            <input
                                type="text"
                                name="city"
                                placeholder="City"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Postcode</label>
                            <input
                                type="text"
                                name="postcode"
                                placeholder="Postcode"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                            >
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Property Type</label>
                        <input
                            type="text"
                            name="property_type"
                            placeholder="Property Type"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                        >
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Number of Rooms</label>
                            <input
                                type="number"
                                name="number_of_rooms"
                                placeholder="Number of Rooms"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Monthly Rent</label>
                            <input
                                type="number"
                                step="0.01"
                                name="monthly_rent"
                                placeholder="Monthly Rent"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                            >
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Property Photo</label>
                        <input
                            type="file"
                            name="photo"
                            accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-700"
                        >
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Branch</label>
                            <select
                                name="branch_id"
                                id="branch_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                            >
                                <option value="">-- Select Branch --</option>

                                @foreach($branches as $branch)
                                    <option value="{{ $branch->branch_id }}">
                                        {{ $branch->branch_id }} - {{ $branch->city }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Assign Staff</label>
                            <select
                                name="staff_id"
                                id="staff_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                            >
                                <option value="">-- Select Staff --</option>

                                @foreach($staff as $member)
                                    <option value="{{ $member->staff_id }}">
                                        {{ $member->staff_id }} - {{ $member->first_name }} {{ $member->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button
                            type="submit"
                            class="inline-flex items-center px-5 py-2.5 bg-green-600 text-white rounded-md text-sm font-semibold hover:bg-green-700 transition"
                        >
                            Create Property
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const branchSelect = document.getElementById('branch_id');
            const staffSelect = document.getElementById('staff_id');

            if (!branchSelect || !staffSelect) return;

            branchSelect.addEventListener('change', function () {
                const branchId = this.value;

                staffSelect.innerHTML = '<option value="">Loading...</option>';

                if (!branchId) {
                    staffSelect.innerHTML = '<option value="">-- Select Staff --</option>';
                    return;
                }

                fetch('/get-staff/' + branchId)
                    .then(res => res.json())
                    .then(data => {
                        staffSelect.innerHTML = '<option value="">-- Select Staff --</option>';

                        data.forEach(staff => {
                            staffSelect.innerHTML += `
                                <option value="${staff.staff_id}">
                                    ${staff.staff_id} - ${staff.first_name} ${staff.last_name}
                                </option>
                            `;
                        });
                    })
                    .catch(() => {
                        staffSelect.innerHTML = '<option value="">-- Select Staff --</option>';
                    });
            });
        });
    </script>
</x-app-layout>

