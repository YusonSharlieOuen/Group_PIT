<form method="POST" action="admin/create-staff">
    @csrf

    <input type="text" name="first_name" placeholder="First Name">

    <select name="position">
        <option value="Manager">Manager</option>
        <option value="Supervisor">Supervisor</option>
        <option value="Staff">Staff</option>
    </select>

    <select name="branch_id">
        @foreach($branches as $branch)
            <option value="{{ $branch->branch_id }}">{{ $branch->branch_id }} - {{ $branch->city }}</option>
        @endforeach
    </select>

    <button type="submit">Create Staff</button>
</form>