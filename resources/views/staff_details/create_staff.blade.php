<form action="{{ route('staff.store') }}" method="POST">
    @csrf

    <h3>User Account</h3>

    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">

    <h3>Staff Details</h3>

    <input type="text" name="staff_id" placeholder="Staff ID">

    <input type="text" name="first_name" placeholder="First Name">

    <input type="text" name="last_name" placeholder="Last Name">

    <textarea name="address" placeholder="Address"></textarea>

    <input type="text" name="phone" placeholder="Phone">

    <select name="sex">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>

    <input type="date" name="date_of_birth">

    <input type="text" name="nin" placeholder="NIN">

    <!-- POSITION DROPDOWN -->

    <select name="position">

        @if(auth()->user()->user_type == 'admin')
            <option value="Manager">Manager</option>
        @endif

        <option value="Supervisor">Supervisor</option>
        <option value="Secretary">Secretary</option>
        <option value="Staff">Staff</option>
    </select>

    <input type="number" step="0.01" name="salary" placeholder="Salary">

    <input type="date" name="date_joined">

    <input type="text" name="branch_id" placeholder="Branch ID">

    <input type="text" name="supervisor_id" placeholder="Supervisor ID">

    <button type="submit">
        Create Staff
    </button>
</form>