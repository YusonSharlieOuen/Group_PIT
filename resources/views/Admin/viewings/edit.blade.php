<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Admin - Edit Viewing</h2>
            <p class="mt-1 text-sm text-gray-600">Update booking details.</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                @if($errors->any())
                    <div class="mb-4 rounded-md border border-red-200 bg-red-50 p-3">
                        <ul class="list-disc pl-5 text-red-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('viewing.update', $viewing->viewing_id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Property</label>
                        <select name="property_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @foreach($properties as $property)
                                <option value="{{ $property->property_id }}" {{ (string)$viewing->property_id === (string)$property->property_id ? 'selected' : '' }}>
                                    {{ $property->property_id }} - {{ $property->street }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Renter</label>
                        <select name="renter_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @foreach($renters as $renter)
                                <option value="{{ $renter->renter_id }}" {{ (string)$viewing->renter_id === (string)$renter->renter_id ? 'selected' : '' }}>
                                    {{ $renter->first_name }} {{ $renter->last_name }} ({{ $renter->renter_id }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Viewing Date</label>
                        <input type="date" name="viewing_date" value="{{ $viewing->viewing_date }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Comments</label>
                        <textarea name="comments" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Optional">{{ $viewing->comments }}</textarea>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('admin.viewings.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Back</a>
                        <button type="submit" class="rounded-md bg-[#5c9aa9] px-4 py-2 text-sm font-semibold text-white hover:bg-[#4a8291]">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

