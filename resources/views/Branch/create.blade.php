<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Add Branch</h2>
            <p class="mt-1 text-sm text-gray-600">Create a branch record.</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                @include('Branch.partials.form', [
                    'action' => route('branch.store'),
                    'method' => 'POST',
                    'branch' => null,
                    'submit' => 'Create Branch',
                ])
            </div>
        </div>
    </div>
</x-app-layout>
