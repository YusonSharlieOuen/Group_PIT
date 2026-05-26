<x-app-layout>

<div class="bg-white min-h-screen pb-16">

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- HEADER -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            Create Lease
        </h1>

        <!-- SUCCESS -->
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- ERRORS -->
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM CARD -->
        <form action="{{ route('lease.store') }}" method="POST"
              class="bg-white border border-gray-200 rounded-2xl shadow-md p-6 space-y-6">

            @csrf

            <!-- ROW 1 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- LEASE ID -->
                <div>
                    <label class="font-semibold text-gray-700">Lease ID</label>
                    <input type="text"
                           name="lease_id"
                           value="{{ $leaseId ?? '' }}"
                           readonly
                           class="w-full mt-1 p-2 border rounded-lg bg-gray-100">
                </div>

                <!-- PAYMENT METHOD -->
                <div>
                    <label class="font-semibold text-gray-700">Payment Method</label>
                    <select name="payment_method"
                            class="w-full mt-1 p-2 border rounded-lg">

                        <option value="">-- Select Payment Method --</option>
                        <option value="monthly" {{ old('payment_method') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="yearly" {{ old('payment_method') == 'yearly' ? 'selected' : '' }}>Yearly</option>

                        <option value="monthly">Monthly</option>
                        <option value="yearly">Yearly</option>

                    </select>
                </div>

            </div>

            <!-- ROW 2 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- PROPERTY -->
                <div>
                    <label class="font-semibold text-gray-700">Property</label>

                    <select name="property_id" id="property_id"
                            class="w-full mt-1 p-2 border rounded-lg" required>




                        <option value="">-- Select Property --</option>

                        @foreach($properties ?? [] as $property)
                            <option value="{{ $property->property_id }}"
                                    {{ old('property_id') == $property->property_id ? 'selected' : '' }}
                                    data-rent="{{ $property->monthly_rent }}">
                                {{ $property->property_id }} - {{ $property->street }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- RENTER -->
                <div>
                    <label class="font-semibold text-gray-700">Renter</label>

                    <select name="renter_id"
                            class="w-full mt-1 p-2 border rounded-lg">

                        @foreach($renters ?? [] as $renter)
                            <option value="{{ $renter->renter_id }}">
                            <option value="{{ $renter->renter_id }}"
                                    {{ old('renter_id') == $renter->renter_id ? 'selected' : '' }}>
                                {{ $renter->renter_id }} - {{ $renter->first_name }} {{ $renter->last_name }}
                            </option>
                        @endforeach

                    </select>
                </div>

            </div>

            <!-- ROW 3 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- STAFF -->
                <div>
                    <label class="font-semibold text-gray-700">Staff</label>

                    <select name="staff_id"
                            class="w-full mt-1 p-2 border rounded-lg" required>

                        @foreach($staff ?? [] as $member)
                            <option value="{{ $member->staff_id }}"
                                    {{ old('staff_id') == $member->staff_id ? 'selected' : '' }}>
                                {{ $member->staff_id }} - {{ $member->first_name }} {{ $member->last_name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- RENT (AUTO) -->
                <div>
                    <label class="font-semibold text-gray-700">Monthly Rent</label>

                    <input type="number"
                           name="rent"
                           id="rent"
                           readonly
                           class="w-full mt-1 p-2 border rounded-lg bg-gray-100"
                           placeholder="Auto-filled">
                </div>

            </div>

            <!-- ROW 4 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- DEPOSIT -->
                <div>
                    <label class="font-semibold text-gray-700">Deposit</label>
                    <input type="number"
                           name="deposit"
                           value="{{ old('deposit') }}"
                           class="w-full mt-1 p-2 border rounded-lg">
                </div>

                <!-- DEPOSIT PAID -->
                <div>
                    <label class="font-semibold text-gray-700">Deposit Paid</label>

                    <select name="deposit_paid"
                            class="w-full mt-1 p-2 border rounded-lg">

                        <option value="1">Yes</option>
                        <option value="0">No</option>
                        <option value="1" {{ old('deposit_paid') == '1' ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('deposit_paid') == '0' ? 'selected' : '' }}>No</option>

                    </select>
                </div>

            </div>

            <!-- DATES -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="font-semibold text-gray-700">Start Date</label>
                    <input type="date"
                           name="start_date"
                           value="{{ old('start_date') }}"
                           class="w-full mt-1 p-2 border rounded-lg">
                </div>

                <div>
                    <label class="font-semibold text-gray-700">End Date</label>
                    <input type="date"
                           name="end_date"
                           value="{{ old('end_date') }}"
                           class="w-full mt-1 p-2 border rounded-lg">
                </div>

            </div>

            <!-- SUBMIT -->
            <button type="submit"
                    class="w-full bg-[#5c9aa9] text-white py-3 rounded-lg font-semibold hover:bg-[#4a8291] transition">

                Create Lease

            </button>

        </form>

    </div>

</div>

<!-- SCRIPT -->
<script>

document.getElementById('property_id').addEventListener('change', function () {

    let selected = this.options[this.selectedIndex];
    let rent = selected.getAttribute('data-rent');

    document.getElementById('rent').value = rent ?? '';

});

</script>

</x-app-layout>