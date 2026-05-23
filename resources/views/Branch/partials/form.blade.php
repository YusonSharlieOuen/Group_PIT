@if ($errors->any())
    <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
        <ul class="list-disc space-y-1 pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ $action }}" method="POST" class="space-y-6">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
        <div>
            <label for="branch_id" class="block text-sm font-medium text-gray-700">Branch ID</label>
            <input id="branch_id" name="branch_id" type="text" value="{{ old('branch_id', $branch->branch_id ?? '') }}" maxlength="10" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900" @disabled($branch) required>
        </div>
        <div>
            <label for="telephone" class="block text-sm font-medium text-gray-700">Telephone</label>
            <input id="telephone" name="telephone" type="text" value="{{ old('telephone', $branch->telephone ?? '') }}" maxlength="20" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
        </div>
        <div>
            <label for="street" class="block text-sm font-medium text-gray-700">Street</label>
            <input id="street" name="street" type="text" value="{{ old('street', $branch->street ?? '') }}" maxlength="100" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
        </div>
        <div>
            <label for="area" class="block text-sm font-medium text-gray-700">Area</label>
            <input id="area" name="area" type="text" value="{{ old('area', $branch->area ?? '') }}" maxlength="100" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
        </div>
        <div>
            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
            <input id="city" name="city" type="text" value="{{ old('city', $branch->city ?? '') }}" maxlength="50" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
        </div>
        <div>
            <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
            <input id="postcode" name="postcode" type="text" value="{{ old('postcode', $branch->postcode ?? '') }}" maxlength="20" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
        </div>
        <div>
            <label for="fax" class="block text-sm font-medium text-gray-700">Fax</label>
            <input id="fax" name="fax" type="text" value="{{ old('fax', $branch->fax ?? '') }}" maxlength="20" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
        </div>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('branch.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Cancel</a>
        <button type="submit" class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">{{ $submit }}</button>
    </div>
</form>
