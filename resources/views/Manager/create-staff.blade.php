<form method="POST" action="/manager/create-staff">
    @csrf

    <input type="text" name="first_name" placeholder="First Name">

    <select name="position">
        <option value="Supervisor">Supervisor</option>
        <option value="Staff">Staff</option>
    </select>

    <button type="submit">Create Staff</button>
</form>