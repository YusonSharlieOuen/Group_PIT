<h2>
    {{ $staff->first_name }}
    {{ $staff->last_name }}
</h2>

<p>Position: {{ $staff->position }}</p>

<p>Email: {{ $staff->user->email }}</p>

@if($staff->nextOfKin)

    <h3>Next of Kin</h3>

    <p>{{ $staff->nextOfKin->full_name }}</p>

@else

    <a href="{{ route('staff.nextofkin.create', $staff->staff_id) }}">
        Add Next of Kin
    </a>

@endif