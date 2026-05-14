<h1>Add Viewing</h1>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<form action="{{ route('viewing.store') }}" method="POST">
    @csrf

    <label>Property</label>
    <select name="property_id">
        @foreach($properties as $property)
            <option value="{{ $property->property_id }}">
                {{ $property->property_id }} - {{ $property->city }}
            </option>
        @endforeach
    </select>

    <br>

    <label>Renter</label>

    <select name="renter_id">

    @foreach($renters as $renter)

        <option value="{{ $renter->renter_id }}">

            {{ $renter->renter_id }}
            -
            {{ $renter->first_name }}
            {{ $renter->last_name }}

        </option>

    @endforeach

    </select>

    <br>

    <label>Viewing Date</label>
    <input type="date" name="viewing_date">

    <br>

    <label>Comments</label>
    <textarea name="comments"></textarea>

    <br>

    <button type="submit">Add Viewing</button>
</form>