<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Create Property</h2>
            <p class="mt-1 text-sm text-gray-600">Add a new rental listing and assign it to a branch.</p>
        </div>
    </x-slot>

    <div class="bg-gray-50 py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('property.details.store') }}" method="POST" enctype="multipart/form-data" class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
                @csrf

                <div class="border-b border-gray-100 px-6 py-5">
                    <h3 class="text-lg font-semibold text-gray-900">Property Information</h3>
                    <p class="mt-1 text-sm text-gray-500">Complete the required listing details.</p>
                </div>

                <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">
                    <div>
                        <label for="property_id" class="block text-sm font-medium text-gray-700">Property ID</label>
                        <input id="property_id" type="text" name="property_id" value="{{ old('property_id', $propertyId) }}" readonly class="mt-1 w-full rounded-md border-gray-300 bg-gray-100 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    <div>
                        <label for="property_type" class="block text-sm font-medium text-gray-700">Property Type</label>
                        <input id="property_type" type="text" name="property_type" value="{{ old('property_type') }}" placeholder="House, Condo, Apartment" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    <div>
                        <label for="street" class="block text-sm font-medium text-gray-700">Street</label>
                        <input id="street" type="text" name="street" value="{{ old('street') }}" placeholder="Street address" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    <div>
                        <label for="area" class="block text-sm font-medium text-gray-700">Area</label>
                        <input id="area" type="text" name="area" value="{{ old('area') }}" placeholder="Area or neighborhood" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input id="city" type="text" name="city" value="{{ old('city') }}" placeholder="City" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    <div>
                        <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                        <input id="postcode" type="text" name="postcode" value="{{ old('postcode') }}" placeholder="Postcode" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    <div>
                        <label for="number_of_rooms" class="block text-sm font-medium text-gray-700">Number of Rooms</label>
                        <input id="number_of_rooms" type="number" name="number_of_rooms" value="{{ old('number_of_rooms') }}" min="1" placeholder="3" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    <div>
                        <label for="monthly_rent" class="block text-sm font-medium text-gray-700">Monthly Rent</label>
                        <input id="monthly_rent" type="number" step="0.01" name="monthly_rent" value="{{ old('monthly_rent') }}" placeholder="50000" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    <div>
                        <label for="branch_id" class="block text-sm font-medium text-gray-700">Branch</label>
                        <select name="branch_id" id="branch_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                            <option value="">-- Select Branch --</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->branch_id }}" @selected(old('branch_id') === $branch->branch_id)>
                                    {{ $branch->branch_id }} - {{ $branch->city ?? 'No city' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="staff_id" class="block text-sm font-medium text-gray-700">Assign Staff</label>
                        <select name="staff_id" id="staff_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                            <option value="">-- Select Staff --</option>
                            @foreach($staff as $member)
                                <option value="{{ $member->staff_id }}" @selected(old('staff_id') === $member->staff_id)>
                                    {{ $member->staff_id }} - {{ $member->first_name }} {{ $member->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="photo" class="block text-sm font-medium text-gray-700">Property Photo</label>
                        <div class="mt-1 rounded-lg border border-dashed border-gray-300 bg-gray-50 p-6">
                            <input id="photo" type="file" name="photo" accept="image/*" class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-md file:border-0 file:bg-gray-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-gray-700">
                            <p class="mt-2 text-xs text-gray-500">Upload a JPG, PNG, WEBP, or GIF up to 4MB.</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-gray-100 bg-gray-50 px-6 py-4">
                    <a href="{{ route('property.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-white">Cancel</a>
                    <button type="submit" class="rounded-md bg-gray-900 px-5 py-2 text-sm font-semibold text-white hover:bg-gray-700">
                        Create Property
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('branch_id').addEventListener('change', function () {
            const branchId = this.value;
            const staffSelect = document.getElementById('staff_id');

            if (!branchId) {
                staffSelect.innerHTML = '<option value="">-- Select Staff --</option>';
                return;
            }

            staffSelect.innerHTML = '<option value="">Loading...</option>';

            fetch('/get-staff/' + branchId)
                .then(response => response.json())
                .then(data => {
                    staffSelect.innerHTML = '<option value="">-- Select Staff --</option>';

                    data.forEach(staff => {
                        staffSelect.innerHTML += `
                            <option value="${staff.staff_id}">
                                ${staff.staff_id} - ${staff.first_name} ${staff.last_name}
                            </option>
                        `;
                    });
                });
        });
    </script>
</x-app-layout>
