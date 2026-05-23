<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-900">Admin - Staff Management</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Staff</h3>
                    <a href="{{ route('staff.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">Create Staff</a>
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Staff ID</th>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Position</th>
                            <th class="px-4 py-2 text-left">Branch</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($staffs as $staff)
                            <tr>
                                <td class="px-4 py-2">{{ $staff->staff_id }}</td>
                                <td class="px-4 py-2">{{ $staff->first_name }} {{ $staff->last_name }}</td>
                                <td class="px-4 py-2">{{ $staff->position }}</td>
                                <td class="px-4 py-2">{{ $staff->branch?->branch_name }}</td>
                                <td class="px-4 py-2 text-center">
                                    <a href="{{ route('staff.show', $staff->staff_id) }}" class="text-blue-600">View</a>
                                    @if(auth()->user()?->hasRole('Admin'))
                                        | <a href="{{ route('staff.edit', $staff->staff_id) }}" class="text-green-600">Edit</a>
                                        | <form action="{{ route('staff.destroy', $staff->staff_id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600" onclick="return confirm('Delete this staff?')">Delete</button>
                                          </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $staffs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
