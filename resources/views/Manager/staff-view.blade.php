<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-900">
            Staff List
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Staff ID
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Name
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Position
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Branch
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">

                        @forelse ($staffs as $staff)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $staff->staff_id }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $staff->first_name }} {{ $staff->last_name }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $staff->position }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $staff->branch->city ?? 'N/A' }}
                                </td>

                                <td class="px-6 py-4 text-sm">
                                    <a href="{{ route('manager.staff.show', $staff->staff_id) }}"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        View
                                    </a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    No staff found.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $staffs->links() }}
            </div>

        </div>
    </div>
</x-app-layout>