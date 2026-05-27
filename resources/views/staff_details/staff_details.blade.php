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
                <h3 class="text-lg font-semibold text-gray-900">Personal Information (Core Profile)</h3>

                <dl class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Full Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ trim(($staff->first_name ?? '') . ' ' . ($staff->last_name ?? '')) ?: 'N/A' }}</dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Gender</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $staff->sex ?? 'N/A' }}</dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Date of Birth</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $staff->date_of_birth ? date('M d, Y', strtotime($staff->date_of_birth)) : 'N/A' }}</dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Government ID</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $staff->nin ?? 'N/A' }}</dd>
                    </div>

                    <div class="md:col-span-2">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Contact Info</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <span class="block"><span class="font-medium text-gray-700">Phone:</span> {{ $staff->phone ?? 'N/A' }}</span>
                            <span class="block"><span class="font-medium text-gray-700">Address:</span> {{ $staff->address ?? 'N/A' }}</span>
                        </dd>
                    </div>
                </dl>
            </div>

            {{-- EMPLOYMENT DETAILS --}}
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900">EMPLOYMENT DETAILS</h3>

                <dl class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Job Title</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $staff->position ?? 'N/A' }}</dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Current Salary</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ is_null($staff->salary) ? 'N/A' : 'PHP ' . number_format($staff->salary, 2) }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Date Joined</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $staff->date_joined ? date('M d, Y', strtotime($staff->date_joined)) : 'N/A' }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Branch Office</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @if ($staff->branch)
                                {{ $staff->branch->street ?? 'N/A' }}, {{ $staff->branch->city ?? 'N/A' }}
                                <span class="text-gray-600">(Phone: {{ $staff->branch->telephone ?? 'N/A' }})</span>
                            @else
                                N/A
                            @endif
                        </dd>
                    </div>

                    <div class="md:col-span-2">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Supervisor Manager</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @if ($staff->supervisor)
                                {{ $staff->supervisor->first_name }} {{ $staff->supervisor->last_name }}
                            @else
                                N/A
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>

            {{-- Existing Branch / Supervisor cards follow --}}
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

            {{-- EMERGENCY CONTACT / NEXT OF KIN --}}
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">EMERGENCY CONTACT / NEXT OF KIN</h3>
                    @unless ($staff->nextOfKin)
                        <a href="{{ route('staff.nextofkin.create', $staff->staff_id) }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-semibold text-white hover:bg-gray-700">Add</a>
                    @endunless
                </div>

                @if ($staff->nextOfKin)
                    <dl class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Full Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $staff->nextOfKin->full_name ?? 'N/A' }}</dd>
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




            {{-- STAFF ACTIVITY LOGS --}}
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900">STAFF ACTIVITY LOGS</h3>
                <p class="mt-1 text-sm text-gray-600">Overview of managed properties, handled leases, and inspection activity.</p>

                <div class="mt-6 space-y-6">
                    {{-- Managed Properties --}}
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">Managed Properties</h4>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Street</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">City</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Property Type</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Monthly Rent</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($staff->properties ?? [] as $property)
                                        <tr>
                                            <td class="px-4 py-3 text-sm text-gray-900">{{ $property->street ?? 'N/A' }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $property->city ?? 'N/A' }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $property->property_type ?? 'N/A' }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                {{ is_null($property->monthly_rent ?? null) ? 'N/A' : 'PHP ' . number_format($property->monthly_rent, 2) }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500">No managed properties found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Handled Leases --}}
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">Handled Leases</h4>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Lease ID</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Rent Amount</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Deposit</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Start / End Dates</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($staff->leases ?? [] as $lease)
                                        <tr>
                                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $lease->lease_id ?? 'N/A' }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                {{ is_null($lease->rent_amount ?? null) ? 'N/A' : 'PHP ' . number_format($lease->rent_amount, 2) }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                {{ is_null($lease->deposit ?? null) ? 'N/A' : 'PHP ' . number_format($lease->deposit, 2) }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                {{ $lease->start_date ? date('M d, Y', strtotime($lease->start_date)) : 'N/A' }}
                                                <span class="text-gray-400">→</span>
                                                {{ $lease->end_date ? date('M d, Y', strtotime($lease->end_date)) : 'N/A' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500">No handled leases found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Inspections Log --}}
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">Inspections Log</h4>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Property ID</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Inspection Date</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Comments</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($staff->inspections ?? [] as $inspection)
                                        <tr>
                                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $inspection->property_id ?? 'N/A' }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                {{ $inspection->inspection_date ? date('M d, Y', strtotime($inspection->inspection_date)) : 'N/A' }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $inspection->comments ?? 'N/A' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-4 py-8 text-center text-sm text-gray-500">No inspections logged.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
