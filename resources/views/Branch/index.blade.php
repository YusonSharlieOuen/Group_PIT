<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">Branch Management</h2>
                <p class="mt-1 text-sm text-gray-600">Maintain branch details and review staff assignments.</p>
            </div>
            <a href="{{ route('branch.create') }}" class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">
                Add Branch
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

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Branch ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Address</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Telephone</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Staff</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Properties</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($branches as $branch)
                                <tr class="hover:bg-gray-50">
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-900">{{ $branch->branch_id }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $branch->street ?? 'N/A' }}, {{ $branch->area ?? 'N/A' }}, {{ $branch->city ?? 'N/A' }} {{ $branch->postcode }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $branch->telephone ?? 'N/A' }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $branch->staff_count }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $branch->properties_count }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                        <a href="{{ route('branch.show', $branch->branch_id) }}" class="text-gray-700 hover:text-gray-950">View</a>
                                        <a href="{{ route('branch.edit', $branch->branch_id) }}" class="ml-4 text-blue-700 hover:text-blue-900">Edit</a>
                                        <form action="{{ route('branch.destroy', $branch->branch_id) }}" method="POST" class="ml-4 inline" onsubmit="return confirm('Delete this branch? Staff and properties will be unassigned by the database rules.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-700 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500">No branches found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($branches->hasPages())
                    <div class="border-t border-gray-200 px-6 py-4">
                        {{ $branches->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
