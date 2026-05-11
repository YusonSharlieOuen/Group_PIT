<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Edit Staff</h2>
            <p class="mt-1 text-sm text-gray-600">{{ $staff->staff_id }} - {{ $staff->first_name }} {{ $staff->last_name }}</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
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

                <form action="{{ route('staff.update', $staff->staff_id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <label for="staff_id" class="block text-sm font-medium text-gray-700">Staff ID</label>
                            <input id="staff_id" type="text" value="{{ $staff->staff_id }}" class="mt-1 w-full rounded-md border-gray-300 bg-gray-100 shadow-sm" disabled>
                        </div>

                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                            <input id="position" name="position" type="text" value="{{ old('position', $staff->position) }}" maxlength="20" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900" required>
                        </div>

                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input id="first_name" name="first_name" type="text" value="{{ old('first_name', $staff->first_name) }}" maxlength="50" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900" required>
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input id="last_name" name="last_name" type="text" value="{{ old('last_name', $staff->last_name) }}" maxlength="50" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900" required>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input id="phone" name="phone" type="text" value="{{ old('phone', $staff->phone) }}" maxlength="20" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                        </div>

                        <div>
                            <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
                            <select id="sex" name="sex" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                                <option value="">Select sex</option>
                                <option value="Male" @selected(old('sex', $staff->sex) === 'Male')>Male</option>
                                <option value="Female" @selected(old('sex', $staff->sex) === 'Female')>Female</option>
                            </select>
                        </div>

                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                            <input id="date_of_birth" name="date_of_birth" type="date" value="{{ old('date_of_birth', $staff->date_of_birth) }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                        </div>

                        <div>
                            <label for="date_joined" class="block text-sm font-medium text-gray-700">Date Joined</label>
                            <input id="date_joined" name="date_joined" type="date" value="{{ old('date_joined', $staff->date_joined) }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                        </div>

                        <div>
                            <label for="nin" class="block text-sm font-medium text-gray-700">NIN</label>
                            <input id="nin" name="nin" type="text" value="{{ old('nin', $staff->nin) }}" maxlength="20" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                        </div>

                        <div>
                            <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                            <input id="salary" name="salary" type="number" step="0.01" min="0" value="{{ old('salary', $staff->salary) }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                        </div>

                        <div>
                            <label for="branch_id" class="block text-sm font-medium text-gray-700">Branch</label>
                            <select id="branch_id" name="branch_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                                <option value="">No branch</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->branch_id }}" @selected(old('branch_id', $staff->branch_id) === $branch->branch_id)>
                                        {{ $branch->branch_id }} - {{ $branch->city }} {{ $branch->area ? '(' . $branch->area . ')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="supervisor_id" class="block text-sm font-medium text-gray-700">Supervisor</label>
                            <select id="supervisor_id" name="supervisor_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                                <option value="">No supervisor</option>
                                @foreach ($supervisors as $supervisor)
                                    <option value="{{ $supervisor->staff_id }}" @selected(old('supervisor_id', $staff->supervisor_id) === $supervisor->staff_id)>
                                        {{ $supervisor->staff_id }} - {{ $supervisor->first_name }} {{ $supervisor->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea id="address" name="address" rows="3" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">{{ old('address', $staff->address) }}</textarea>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('staff.show', $staff->staff_id) }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Cancel</a>
                        <button type="submit" class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
