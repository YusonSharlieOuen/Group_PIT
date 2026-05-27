<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Admin Dashboard</h2>
            <p class="mt-1 text-sm text-gray-600">Overview and quick actions</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                <div class="p-4 bg-white shadow sm:rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Total Branches</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ $totalBranches ?? '—' }}</p>
                </div>

                <div class="p-4 bg-white shadow sm:rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Total Properties</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ $totalProperties }}</p>
                </div>

                <div class="p-4 bg-white shadow sm:rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Available Properties</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ $available ?? '—' }}</p>
                </div>

                <div class="p-4 bg-white shadow sm:rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Occupied Properties</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ $occupiedProperties ?? '—' }}</p>
                </div>

                <div class="p-4 bg-white shadow sm:rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Total Staff</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ $totalStaff }}</p>
                </div>
            </div>


            <div class="mt-8 bg-white p-6 shadow sm:rounded-lg">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h4 class="text-lg font-medium text-gray-900">Analytics</h4>
                        <p class="mt-1 text-xs text-gray-500">Charts by branch and portfolio distribution (placeholder UI).</p>
                    </div>
                </div>

                <div class="mt-5 grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
                        <p class="text-sm font-semibold text-gray-900">Total Revenue by Branch</p>
                        <p class="mt-1 text-xs text-gray-500">(Monthly rent sum placeholder)</p>
                        <div class="mt-4 h-72 w-full rounded-md bg-gray-50 p-3">
                            <canvas id="revenueByBranchChart" class="w-full h-full"></canvas>
                        </div>
                    </div>

                    <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
                        <p class="text-sm font-semibold text-gray-900">Property Portfolio Breakdown</p>
                        <p class="mt-1 text-xs text-gray-500">(By status)</p>
                        <div class="mt-4 h-72 w-full rounded-md bg-gray-50 p-3">
                            <canvas id="portfolioBreakdownChart" class="w-full h-full"></canvas>
                        </div>
                    </div>

                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a
                        href="{{ route('property.create') }}"
                        class="group block rounded-lg border border-green-100 bg-green-50 p-4 transition hover:bg-green-100"
                    >
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-sm font-semibold text-green-900">Create Property</p>
                                <p class="mt-1 text-xs text-green-800">
                                    Add property details, upload a photo, choose a branch, and assign staff.
                                </p>
                            </div>
                            <span class="inline-flex items-center rounded-full bg-green-600 px-3 py-1 text-xs font-bold text-white group-hover:bg-green-700">
                                Click
                            </span>
                        </div>
                    </a>

                    <a
                        href="{{ route('branch.index') }}"
                        class="group block rounded-lg border border-gray-100 bg-white p-4 transition hover:bg-gray-50"
                    >
                        <p class="text-sm font-semibold text-gray-900">Branches</p>
                        <p class="mt-1 text-xs text-gray-600">Manage branch locations used by properties.</p>
                    </a>

                    <a
                        href="{{ route('lease.all') }}"
                        class="group block rounded-lg border border-blue-100 bg-blue-50 p-4 transition hover:bg-blue-100"
                    >
                        <div class="flex items-start justify-between gap-3">

                            <div>
                                <p class="text-sm font-semibold text-blue-900">Leases</p>
                                <p class="mt-1 text-xs text-blue-800">Add, edit, and manage lease transactions.</p>
                            </div>
                            <span class="inline-flex items-center rounded-full bg-blue-600 px-3 py-1 text-xs font-bold text-white group-hover:bg-blue-700">
                                Manage
                            </span>
                        </div>
                    </a>


                </div>
            </div>

        </div>
    </div>

    @include('admin.partials.admin-charts-scripts')
</x-app-layout>

