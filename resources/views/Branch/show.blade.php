<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">Branch {{ $branch->branch_id }}</h2>
                <p class="mt-1 text-sm text-gray-600">{{ $branch->street }}, {{ $branch->area }}, {{ $branch->city }}</p>
            </div>
            <a href="{{ route('branch.edit', $branch->branch_id) }}" class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">
                Edit Branch
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900">Branch Details</h3>
                    <dl class="mt-5 space-y-4 text-sm">
                        <div><dt class="font-medium text-gray-500">Street</dt><dd class="text-gray-900">{{ $branch->street ?? 'N/A' }}</dd></div>
                        <div><dt class="font-medium text-gray-500">Area</dt><dd class="text-gray-900">{{ $branch->area ?? 'N/A' }}</dd></div>
                        <div><dt class="font-medium text-gray-500">City</dt><dd class="text-gray-900">{{ $branch->city ?? 'N/A' }}</dd></div>
                        <div><dt class="font-medium text-gray-500">Postcode</dt><dd class="text-gray-900">{{ $branch->postcode ?? 'N/A' }}</dd></div>
                        <div><dt class="font-medium text-gray-500">Telephone</dt><dd class="text-gray-900">{{ $branch->telephone ?? 'N/A' }}</dd></div>
                        <div><dt class="font-medium text-gray-500">Fax</dt><dd class="text-gray-900">{{ $branch->fax ?? 'N/A' }}</dd></div>
                    </dl>
                </div>

                <div class="bg-white p-6 shadow-sm sm:rounded-lg lg:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-900">Assigned Staff</h3>
                    <div class="mt-5 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Staff</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Role</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Salary</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Supervisor</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($branch->staff as $staff)
                                    <tr>
                                        <td class="px-4 py-3 text-sm">
                                            <a href="{{ route('staff.show', $staff->staff_id) }}" class="font-medium text-gray-900 hover:underline">
                                                {{ $staff->staff_id }} - {{ $staff->first_name }} {{ $staff->last_name }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $staff->position }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ is_null($staff->salary) ? 'N/A' : 'GBP ' . number_format($staff->salary, 2) }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $staff->supervisor?->staff_id ?? 'None' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500">No staff assigned.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900">Branch Responsibilities</h3>
                <p class="mt-1 text-sm text-gray-600">Properties assigned to this branch and responsible staff.</p>
                <div class="mt-5 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Property</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Location</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Type</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Responsible Staff</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($branch->properties as $property)
                                <tr>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $property->property_id }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $property->street }}, {{ $property->area }}, {{ $property->city }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $property->property_type }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        @if ($property->staff)
                                            {{ $property->staff->staff_id }} - {{ $property->staff->first_name }} {{ $property->staff->last_name }}
                                        @else
                                            Unassigned
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500">No properties assigned.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
