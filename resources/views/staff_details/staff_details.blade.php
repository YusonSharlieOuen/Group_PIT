<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">{{ $staff->first_name }} {{ $staff->last_name }}</h2>
                <p class="mt-1 text-sm text-gray-600">Staff ID: {{ $staff->staff_id }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('staff.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Back</a>
                <a href="{{ route('staff.edit', $staff->staff_id) }}" class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Edit</a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-5xl space-y-6 px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900">Staff Information</h3>
                <dl class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Position</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $staff->position }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Salary</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ is_null($staff->salary) ? 'N/A' : 'PHP ' . number_format($staff->salary, 2) }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Phone</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $staff->phone ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Sex</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $staff->sex ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Date of Birth</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $staff->date_of_birth ? date('M d, Y', strtotime($staff->date_of_birth)) : 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Date Joined</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $staff->date_joined ? date('M d, Y', strtotime($staff->date_joined)) : 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">NIN</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $staff->nin ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Address</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $staff->address ?? 'N/A' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900">Branch</h3>
                    @if ($staff->branch)
                        <dl class="mt-5 space-y-4">
                            <div>
                                <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Branch ID</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $staff->branch->branch_id }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Location</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $staff->branch->street }}, {{ $staff->branch->area }}, {{ $staff->branch->city }} {{ $staff->branch->postcode }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Telephone</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $staff->branch->telephone ?? 'N/A' }}</dd>
                            </div>
                        </dl>
                    @else
                        <p class="mt-5 text-sm text-gray-500">No branch assigned.</p>
                    @endif
                </div>

                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900">Supervisor</h3>
                    @if ($staff->supervisor)
                        <p class="mt-5 text-sm font-medium text-gray-900">{{ $staff->supervisor->first_name }} {{ $staff->supervisor->last_name }}</p>
                        <p class="mt-1 text-sm text-gray-500">{{ $staff->supervisor->staff_id }} - {{ $staff->supervisor->position }}</p>
                    @else
                        <p class="mt-5 text-sm text-gray-500">No supervisor assigned.</p>
                    @endif

                    <h4 class="mt-6 text-sm font-semibold text-gray-900">Subordinates</h4>
                    @if ($staff->subordinates->count())
                        <ul class="mt-3 space-y-2 text-sm text-gray-700">
                            @foreach ($staff->subordinates as $subordinate)
                                <li>
                                    <a href="{{ route('staff.show', $subordinate->staff_id) }}" class="hover:text-gray-950">
                                        {{ $subordinate->staff_id }} - {{ $subordinate->first_name }} {{ $subordinate->last_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mt-3 text-sm text-gray-500">No subordinates listed.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900">Assigned Responsibilities</h3>
                <p class="mt-1 text-sm text-gray-600">Properties this staff member is responsible for.</p>

                <div class="mt-5 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Property</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Location</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Type</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($staff->assignedProperties as $property)
                                <tr>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $property->property_id }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $property->street }}, {{ $property->area }}, {{ $property->city }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $property->property_type }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $property->status }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500">No property responsibilities assigned.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Next of Kin</h3>
                    @unless ($staff->nextOfKin)
                        <a href="{{ route('staff.nextofkin.create', $staff->staff_id) }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-semibold text-white hover:bg-gray-700">Add</a>
                    @endunless
                </div>

                @if ($staff->nextOfKin)
                    <dl class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Full Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $staff->nextOfKin->full_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Relationship</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $staff->nextOfKin->relationship ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Phone</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $staff->nextOfKin->phone ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Address</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $staff->nextOfKin->address ?? 'N/A' }}</dd>
                        </div>
                    </dl>
                @else
                    <p class="mt-5 text-sm text-gray-500">No next of kin record has been added.</p>
                @endif
            </div>

            <div class="flex justify-end">
                <form action="{{ route('staff.destroy', $staff->staff_id) }}" method="POST" onsubmit="return confirm('Delete this staff record?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-md bg-red-700 px-4 py-2 text-sm font-semibold text-white hover:bg-red-800">Delete Staff</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
