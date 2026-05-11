<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center items-center w-full">
            <h2 class="font-serif text-3xl text-gray-800 leading-tight uppercase tracking-[0.3em]">
                {{ __('Admin Dashboard') }}
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
                        <p class="text-sm text-gray-600">You are an Admin</p>
                    </div>
                </div>
            </div>

            <!-- Staff Management Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 uppercase tracking-wide mb-6">STAFF MANAGEMENT</h3>
                    
                    <!-- Staff Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-100 border-b-2 border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Staff ID</th>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Name</th>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Position</th>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Branch</th>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Supervisor</th>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 text-sm text-gray-600">S1</td>
                                    <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Name goes here</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">Staff</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">B1</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">SPV1</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">
                                        <button class="text-blue-600 hover:text-blue-800 font-semibold text-xs">edit</button>
                                        <span class="text-gray-400 mx-2">•</span>
                                        <button class="text-red-600 hover:text-red-800 font-semibold text-xs">delete</button>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 text-sm text-gray-600">S2</td>
                                    <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Name goes here</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">Staff</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">B1</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">SPV1</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">
                                        <button class="text-blue-600 hover:text-blue-800 font-semibold text-xs">edit</button>
                                        <span class="text-gray-400 mx-2">•</span>
                                        <button class="text-red-600 hover:text-red-800 font-semibold text-xs">delete</button>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 text-sm text-gray-600">S3</td>
                                    <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Name goes here</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">Secretary</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">B1</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">SPV1</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">
                                        <button class="text-blue-600 hover:text-blue-800 font-semibold text-xs">edit</button>
                                        <span class="text-gray-400 mx-2">•</span>
                                        <button class="text-red-600 hover:text-red-800 font-semibold text-xs">delete</button>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 text-sm text-gray-600">SPV1</td>
                                    <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Name goes here</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">Supervisor</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">B1</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">None</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">
                                        <button class="text-blue-600 hover:text-blue-800 font-semibold text-xs">edit</button>
                                        <span class="text-gray-400 mx-2">•</span>
                                        <button class="text-red-600 hover:text-red-800 font-semibold text-xs">delete</button>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 text-sm text-gray-600">M1</td>
                                    <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Name goes here</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">Manager</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">B2</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">None</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">
                                        <button class="text-blue-600 hover:text-blue-800 font-semibold text-xs">edit</button>
                                        <span class="text-gray-400 mx-2">•</span>
                                        <button class="text-red-600 hover:text-red-800 font-semibold text-xs">delete</button>
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
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Staff Chart -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">STAFFS AT EACH BRANCH</h3>
                    <div class="flex items-center justify-center h-64 bg-gray-100 rounded-lg">
                        <div class="text-center text-gray-500">
                            <p class="text-sm">Chart Visualization</p>
                            <p class="text-xs mt-2">(Pie Chart - Branch Distribution)</p>
                        </div>
                    </div>
                </div>

                <!-- Sales Chart -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">SALES FOR EACH BRANCH</h3>
                    <div class="flex items-center justify-center h-64 bg-gray-100 rounded-lg">
                        <div class="text-center text-gray-500">
                            <p class="text-sm">Chart Visualization</p>
                            <p class="text-xs mt-2">(Pie Chart - Sales Distribution)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Download Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <button class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-8 rounded-lg transition duration-200">
                    Download data as PDF
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
