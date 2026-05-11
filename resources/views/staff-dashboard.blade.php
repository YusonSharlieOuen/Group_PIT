<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center items-center w-full">
            <h2 class="font-serif text-3xl text-gray-800 leading-tight uppercase tracking-[0.3em]">
                {{ __('Staff Dashboard') }}
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
                        <p class="text-sm text-gray-600">You are a Staff</p>
                    </div>
                </div>
            </div>

            <!-- Assigned Work Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 uppercase tracking-wide mb-6">ASSIGNED WORK</h3>
                    
                    <!-- Assigned Work Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-100 border-b-2 border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Property ID</th>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Location</th>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Property Type</th>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Purpose</th>
                                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 text-sm text-gray-600">P1</td>
                                    <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Manila</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">House</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">Inspection</td>
                                    <td class="px-6 py-3 text-sm">
                                        <button class="text-gray-600 hover:text-gray-800 text-lg">⋮</button>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 text-sm text-gray-600">P2</td>
                                    <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Cebu</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">House</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">Leasing</td>
                                    <td class="px-6 py-3 text-sm">
                                        <button class="text-gray-600 hover:text-gray-800 text-lg">⋮</button>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 text-sm text-gray-600">P3</td>
                                    <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Manila</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">House</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">Leasing</td>
                                    <td class="px-6 py-3 text-sm">
                                        <button class="text-gray-600 hover:text-gray-800 text-lg">⋮</button>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 text-sm text-gray-600">P4</td>
                                    <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Quezon</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">House</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">Leasing</td>
                                    <td class="px-6 py-3 text-sm">
                                        <button class="text-gray-600 hover:text-gray-800 text-lg">⋮</button>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 text-sm text-gray-600">P5</td>
                                    <td class="px-6 py-3 text-sm text-gray-900 font-semibold">Cagayan De Oro</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">House</td>
                                    <td class="px-6 py-3 text-sm text-gray-600">Inspection</td>
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
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-blue-600">5</p>
                    <p class="text-gray-600 mt-2">Total Assignments</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-green-600">3</p>
                    <p class="text-gray-600 mt-2">Completed</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-orange-600">2</p>
                    <p class="text-gray-600 mt-2">In Progress</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-purple-600">0</p>
                    <p class="text-gray-600 mt-2">Pending</p>
                </div>
            </div>

            <!-- My Profile Quick Link -->
            <div class="bg-blue-50 border border-blue-200 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-blue-900 mb-2">View Your Profile</h3>
                <p class="text-blue-800 mb-4">Update your personal information and view your work history.</p>
                <a href="{{ route('profile.edit') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                    Edit Profile
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
