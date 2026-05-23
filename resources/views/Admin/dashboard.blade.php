<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Admin Dashboard</h2>
            <p class="mt-1 text-sm text-gray-600">Overview and quick actions</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-4 bg-white shadow sm:rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Total Properties</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ $totalProperties }}</p>
                </div>

                <div class="p-4 bg-white shadow sm:rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Available</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ $available }}</p>
                </div>

                <div class="p-4 bg-white shadow sm:rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Total Staff</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ $totalStaff }}</p>
                </div>
            </div>

            <div class="mt-8 bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
                <div class="mt-4 flex gap-3">
                    <a href="{{ route('property.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded">Create Property</a>
                    <a href="{{ route('branch.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded">Branches</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
