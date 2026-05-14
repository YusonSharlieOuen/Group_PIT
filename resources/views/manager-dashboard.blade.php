<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center items-center w-full">
            <h2 class="font-serif text-3xl text-gray-800 leading-tight uppercase tracking-[0.3em]">
                {{ __('Manager Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- User Info Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center">
                        <span class="text-xl font-bold text-gray-600">👤</span>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-600">You are a Manager</p>
                    </div>
                </div>
            </div>

            <!-- Staff Management Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 uppercase tracking-wide mb-6">MANAGED STAFF</h3>
                    
                    <!-- Staff Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-100 border-b-2 border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Staff ID</th>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Name</th>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Position</th>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 text-sm text-gray-600">S1</td>
                                    <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Name goes here</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">Staff</td>
                                    <td class="px-6 py-3 text-sm">
                                        <button class="text-gray-600 hover:text-gray-800 text-lg">⋮</button>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 text-sm text-gray-600">S2</td>
                                    <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Name goes here</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">Staff</td>
                                    <td class="px-6 py-3 text-sm">
                                        <button class="text-gray-600 hover:text-gray-800 text-lg">⋮</button>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 text-sm text-gray-600">S3</td>
                                    <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Name goes here</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">Secretary</td>
                                    <td class="px-6 py-3 text-sm">
                                        <button class="text-gray-600 hover:text-gray-800 text-lg">⋮</button>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 text-sm text-gray-600">S5</td>
                                    <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Name goes here</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">Staff</td>
                                    <td class="px-6 py-3 text-sm">
                                        <button class="text-gray-600 hover:text-gray-800 text-lg">⋮</button>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 text-sm text-gray-600">S4</td>
                                    <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Name goes here</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">Staff</td>
                                    <td class="px-6 py-3 text-sm">
                                        <button class="text-gray-600 hover:text-gray-800 text-lg">⋮</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="flex items-center justify-center gap-2 mt-6">
                        <button class="px-3 py-2 border border-gray-300 rounded text-gray-600 hover:bg-gray-50">&lt;</button>
                        <button class="px-3 py-2 bg-gray-200 rounded text-gray-800 font-semibold">1</button>
                        <button class="px-3 py-2 border border-gray-300 rounded text-gray-600 hover:bg-gray-50">&gt;</button>
                    </div>

                    <!-- Add Staff Button -->
                    <div class="mt-6">
                        <a href="{{ route('staff.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                            ADD STAFF
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-blue-600">5</p>
                    <p class="text-gray-600 mt-2">Total Staff</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-green-600">4</p>
                    <p class="text-gray-600 mt-2">Active Staff</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-orange-600">1</p>
                    <p class="text-gray-600 mt-2">Inactive Staff</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
