<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Manager Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome Card --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900">
                    Welcome, {{ auth()->user()->name }}
                </h3>

                <p class="mt-2 text-sm text-gray-600">
                    Manage your branch staff and monitor branch activity.
                </p>
            </div>

            {{-- Statistics --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Total Staff
                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-gray-900">
                        {{ $staffCount }}
                    </h3>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Supervisors
                    </p>

                    <h3 class="mt-2 text-3xl font-bold text-gray-900">
                        {{ $supervisorCount }}
                    </h3>
                </div>

            </div>

            {{-- Recent Staff --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Recent Staff Members
                    </h3>

                    <a href="{{ route('manager.staff.index') }}"
                       class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                        View All
                    </a>
                </div>

                <div class="mt-5 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Staff ID
                                </th>

                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Name
                                </th>

                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Position
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">

                            @forelse ($staffMembers as $staff)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-900">
                                        {{ $staff->staff_id }}
                                    </td>

                                    <td class="px-4 py-3 text-sm text-gray-900">
                                        {{ $staff->first_name }} {{ $staff->last_name }}
                                    </td>

                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $staff->position }}
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-6 text-center text-sm text-gray-500">
                                        No staff found.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div> 
</x-app-layout>