<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Add Staff</h2>
            <p class="mt-1 text-sm text-gray-600">Create a record in the staff table.</p>
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

                <form action="{{ route('staff.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700">
                                Position
                            </label>

                            <select id="position"
                                    name="position"
                                    class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900"
                                    required>

                                <option value="">Select Position</option>

                                <option value="Manager"
                                    @selected(old('position') === 'Manager')>
                                    Manager
                                </option>

                                <option value="Supervisor"
                                    @selected(old('position') === 'Supervisor')>
                                    Supervisor
                                </option>

                                <option value="Staff"
                                    @selected(old('position') === 'Staff')>
                                    Staff
                                </option>

                            </select>
                        </div>

                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input id="first_name" name="first_name" type="text" value="{{ old('first_name') }}" maxlength="50" class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900" required>
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input id="last_name" name="last_name" type="text" value="{{ old('last_name') }}" maxlength="50" class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900" required>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input id="phone" name="phone" type="text" value="{{ old('phone') }}" maxlength="20" class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                        </div>

                        <div>
                            <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
                            <select id="sex" name="sex" class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                                <option value="">Select sex</option>
                                <option value="Male" @selected(old('sex') === 'Male')>Male</option>
                                <option value="Female" @selected(old('sex') === 'Female')>Female</option>
                            </select>
                        </div>

                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                            <input id="date_of_birth" name="date_of_birth" type="date" value="{{ old('date_of_birth') }}" class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                        </div>

                        <div>
                            <label for="date_joined" class="block text-sm font-medium text-gray-700">Date Joined</label>
                            <input id="date_joined" name="date_joined" type="date" value="{{ old('date_joined') }}" class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                        </div>

                        <div>
                            <label for="nin" class="block text-sm font-medium text-gray-700">NIN</label>
                            <input id="nin" name="nin" type="text" value="{{ old('nin') }}" maxlength="20" class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                        </div>

                        <div>
                            <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                            <input id="salary" name="salary" type="number" step="0.01" min="0" value="{{ old('salary') }}" class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                        </div>

                        <div>
                            <label for="branch_id" class="block text-sm font-medium text-gray-700">Branch</label>
                            <select id="branch_id" name="branch_id" class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                                <option value="">No branch</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->branch_id }}" @selected(old('branch_id') === $branch->branch_id)>
                                        {{ $branch->branch_id }} - {{ $branch->city }} {{ $branch->area ? '(' . $branch->area . ')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="supervisor_id" class="block text-sm font-medium text-gray-700">Supervisor</label>
                            <select id="supervisor_id" name="supervisor_id" class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                                <option value="">No supervisor</option>
                                @foreach ($supervisors as $supervisor)
                                    <option value="{{ $supervisor->staff_id }}" @selected(old('supervisor_id') === $supervisor->staff_id)>
                                        {{ $supervisor->staff_id }} - {{ $supervisor->first_name }} {{ $supervisor->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea id="address" name="address" rows="3" class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">{{ old('address') }}</textarea>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4">
                        <h3 class="text-lg font-semibold text-gray-900">Staff Login Account</h3>
                        <p class="mt-1 text-sm text-gray-600">Optional: add an email and password to create a login for this staff member.</p>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 mt-4">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" maxlength="255" class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input id="password" name="password" type="password" class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('staff.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Cancel</a>
                        <button type="submit" class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Create Staff</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
