<h1>Create Property</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('property.details.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="property_id" value="{{ $propertyId }}" readonly>

    <input type="text" name="street" placeholder="Street">

    <input type="text" name="area" placeholder="Area">

    <input type="text" name="city" placeholder="City">

    <input type="text" name="postcode" placeholder="Postcode">

    <input type="text" name="property_type" placeholder="Property Type">

    <input type="number" name="number_of_rooms" placeholder="Number of Rooms">

    <input type="number" step="0.01" name="monthly_rent" placeholder="Monthly Rent">

    <label>Property Photo</label>
    <input type="file" name="photo" accept="image/*">

    <label>Branch</label>

<select name="branch_id" id="branch_id">

    <option value="">-- Select Branch --</option>

    @foreach($branches as $branch)

        <option value="{{ $branch->branch_id }}">

            {{ $branch->branch_id }}
            - {{ $branch->city }}

        </option>

    @endforeach

</select>

    <label>Assign Staff</label>

<select name="staff_id">

    <option value="">-- Select Staff --</option>

    @foreach($staff as $member)

        <option value="{{ $member->staff_id }}">

            {{ $member->staff_id }}
            - {{ $member->first_name }}
            {{ $member->last_name }}

        </option>

    @endforeach

</select>

    <button type="submit">Create Property</button>
</form>

<script>

document.getElementById('branch_id').addEventListener('change', function () {

    let branchId = this.value;

    let staffSelect = document.getElementById('staff_id');

    staffSelect.innerHTML = '<option>Loading...</option>';

    fetch('/get-staff/' + branchId)
        .then(res => res.json())
        .then(data => {

            staffSelect.innerHTML = '<option value="">-- Select Staff --</option>';

            data.forEach(staff => {

                staffSelect.innerHTML += `
                    <option value="${staff.staff_id}">
                        ${staff.staff_id} - ${staff.first_name} ${staff.last_name}
                    </option>
                `;

            });

        });

});

</script>
