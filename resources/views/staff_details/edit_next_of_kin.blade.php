<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Add Next of Kin</h2>
            <p class="mt-1 text-sm text-gray-600">{{ $staff->staff_id }} - {{ $staff->first_name }} {{ $staff->last_name }}</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                @if ($errors->any())
                    <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <ul class="list-disc space-y-1 pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('staff.nextofkin.store', $staff->staff_id) }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input id="full_name" name="full_name" type="text" value="{{ old('full_name') }}" maxlength="100" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900" required>
                        </div>

                        <div>
                            <label for="relationship" class="block text-sm font-medium text-gray-700">Relationship</label>
                            <input id="relationship" name="relationship" type="text" value="{{ old('relationship') }}" maxlength="50" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900" required>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input id="phone" name="phone" type="text" value="{{ old('phone') }}" maxlength="20" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                        </div>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea id="address" name="address" rows="3" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">{{ old('address') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('staff.show', $staff->staff_id) }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Cancel</a>
                        <button type="submit" class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Save Next of Kin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
