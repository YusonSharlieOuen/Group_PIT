<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">Staff Management</h2>
                <p class="mt-1 text-sm text-gray-600">Manage staff records, branch assignments, and supervisors.</p>
            </div>
            <a href="{{ route('staff.create') }}" class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">
                Add Staff
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="flex items-center gap-4 border-b border-gray-200 pb-6">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full border-4 border-slate-300 bg-slate-50">
                        <svg class="h-10 w-10 text-slate-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" />
                            <path d="M4 20a8 8 0 0 1 16 0H4Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name ?? 'Name goes here' }}</p>
                        <p class="text-sm text-gray-600">You are an Admin</p>
                    </div>
                </div>

                <div class="mt-10 overflow-x-auto">
                    <table class="min-w-full border-separate border-spacing-y-2">
                        <thead>
                            <tr class="text-left text-lg font-medium text-gray-950">
                                <th class="px-2 py-1 font-medium">Staff ID</th>
                                <th class="px-2 py-1 font-medium">Name</th>
                                <th class="px-2 py-1 font-medium">Position</th>
                                <th class="px-2 py-1 font-medium">Branch</th>
                                <th class="px-2 py-1 font-medium">Salary</th>
                                <th class="px-2 py-1 font-medium">Sex</th>
                                <th class="px-2 py-1 font-medium">Date of Birth</th>
                                <th class="px-2 py-1 font-medium">Date Joined</th>
                                <th class="px-2 py-1 font-medium">Supervisor</th>
                                <th class="px-2 py-1 text-right font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($staffs as $staff)
                                <tr id="staff-{{ $staff->staff_id }}" class="text-base text-gray-950">
                                    <td class="bg-gray-300 px-2 py-2 font-medium">{{ $staff->staff_id }}</td>
                                    <td class="bg-gray-300 px-2 py-2">{{ $staff->first_name }} {{ $staff->last_name }}</td>
                                    <td class="bg-gray-300 px-2 py-2">{{ $staff->position }}</td>
                                    <td class="bg-gray-300 px-2 py-2">{{ $staff->branch->branch_id ?? 'N/A' }}</td>
                                    <td class="bg-gray-300 px-2 py-2">{{ is_null($staff->salary) ? 'N/A' : 'PHP ' . number_format($staff->salary, 2) }}</td>
                                    <td class="bg-gray-300 px-2 py-2">{{ $staff->sex ?? 'N/A' }}</td>

                                    <td class="bg-gray-300 px-2 py-2">{{ $staff->date_of_birth ? date('M d, Y', strtotime($staff->date_of_birth)) : 'N/A' }}</td>
                                    <td class="bg-gray-300 px-2 py-2">{{ $staff->date_joined ? date('M d, Y', strtotime($staff->date_joined)) : 'N/A' }}</td>

                                    <td class="bg-gray-300 px-2 py-2">
                                        @if($staff->supervisor)
                                            {{ $staff->supervisor->first_name }} {{ $staff->supervisor->last_name }}
                                        @else
                                            None
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap bg-gray-300 px-2 py-2 text-right text-sm">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('staff.show', $staff->staff_id) }}" class="font-medium text-gray-900 hover:underline">view</a>
                                            @if(auth()->user()?->hasRole('Admin'))
                                                <a href="{{ route('staff.edit', $staff->staff_id) }}" class="font-medium text-gray-900 hover:underline">edit</a>
                                            @endif


                                        @if($staff->nextOfKin)
                                            <button type="button" class="ml-3 font-medium text-gray-900 hover:underline" data-modal-target="nok-{{ $staff->staff_id }}">
                                                Next of Kin
                                            </button>
                                        @else
                                            <a href="{{ route('staff.nextofkin.create', $staff->staff_id) }}" class="ml-3 font-medium text-gray-900 hover:underline">
                                                Add Next of Kin
                                            </a>
                                        @endif

                                        @if($staff->nextOfKin)
                                            <div id="nok-{{ $staff->staff_id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
                                                <div class="w-full max-w-md rounded-lg bg-white p-5 shadow">
                                                    <div class="flex items-center justify-between">
                                                        <h3 class="text-lg font-semibold text-gray-900">Next of Kin</h3>
                                                        <button type="button" class="text-gray-500 hover:text-gray-800" data-modal-close="nok-{{ $staff->staff_id }}">&times;</button>
                                                    </div>

                                                    <div class="mt-4 space-y-3 text-sm">
                                                        <div>
                                                            <div class="text-xs font-semibold uppercase tracking-wider text-gray-500">Full Name</div>
                                                            <div class="text-gray-900">{{ $staff->nextOfKin->full_name }}</div>
                                                        </div>
                                                        <div>
                                                            <div class="text-xs font-semibold uppercase tracking-wider text-gray-500">Relationship</div>
                                                            <div class="text-gray-900">{{ $staff->nextOfKin->relationship ?? 'N/A' }}</div>
                                                        </div>
                                                        <div>
                                                            <div class="text-xs font-semibold uppercase tracking-wider text-gray-500">Phone</div>
                                                            <div class="text-gray-900">{{ $staff->nextOfKin->phone ?? 'N/A' }}</div>
                                                        </div>
                                                        <div>
                                                            <div class="text-xs font-semibold uppercase tracking-wider text-gray-500">Address</div>
                                                            <div class="text-gray-900">{{ $staff->nextOfKin->address ?? 'N/A' }}</div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-5 flex justify-end gap-3">
                                                        <a href="{{ route('staff.nextofkin.create', $staff->staff_id) }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-semibold text-white hover:bg-gray-700">Edit/Add</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <form action="{{ route('staff.destroy', $staff->staff_id) }}" method="POST" class="ml-3 inline" onsubmit="return confirm('Delete this staff record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-gray-900 hover:underline">delete</button>
                                        </form>
                                        <span class="ml-3 text-xl leading-none" aria-hidden="true">&#8942;</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="bg-gray-100 px-4 py-10 text-center text-sm text-gray-500">
                                        No staff records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <a href="{{ route('staff.create') }}" class="inline-flex w-fit items-center bg-gray-300 px-3 py-2 text-sm font-semibold uppercase text-gray-950 hover:bg-gray-400">
                        Add Staff
                    </a>

                    <div class="flex flex-col items-end gap-3">
                        <div class="inline-flex items-center bg-gray-300 px-3 py-2 text-lg font-medium text-gray-950">
                            @if ($staffs->onFirstPage())
                                <span class="text-gray-500">&lt;</span>
                            @else
                                <a href="{{ $staffs->previousPageUrl() }}" class="hover:underline" aria-label="Previous staff page">&lt;</a>
                            @endif

                            <span class="px-3">|</span>
                            <span>{{ $staffs->currentPage() }}</span>
                            <span class="px-3">|</span>

                            @if ($staffs->hasMorePages())
                                <a href="{{ $staffs->nextPageUrl() }}" class="hover:underline" aria-label="Next staff page">&gt;</a>
                            @else
                                <span class="text-gray-500">&gt;</span>
                            @endif
                        </div>

                        <p class="text-xs text-gray-500">
                            Showing {{ $staffs->firstItem() ?? 0 }}-{{ $staffs->lastItem() ?? 0 }} of {{ $staffs->total() }} staff
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    document.addEventListener('click', function (e) {
        const openBtn = e.target.closest('[data-modal-target]');
        if (openBtn) {
            const targetId = openBtn.getAttribute('data-modal-target');
            const modal = document.getElementById(targetId);
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        const closeBtn = e.target.closest('[data-modal-close]');
        if (closeBtn) {
            const targetId = closeBtn.getAttribute('data-modal-close');
            const modal = document.getElementById(targetId);
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        const overlay = e.target.closest('.fixed.inset-0');
        if (overlay) {
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
        }
    });
</script>
</x-app-layout>
