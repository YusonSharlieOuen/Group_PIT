<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class StaffUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin account
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Alice Admin', 'password' => Hash::make('AdminPass123')]
        );

        Staff::firstOrCreate(
            ['staff_id' => 'S_ADMIN'],
            [
                'staff_id' => 'S_ADMIN',
                'first_name' => 'Alice',
                'last_name' => 'Admin',
                'position' => 'Admin',
                'branch_id' => null,
                'user_id' => $admin->id,
            ]
        );

        // Staff account
        $staffUser = User::firstOrCreate(
            ['email' => 'staff@example.com'],
            ['name' => 'Bob Staff', 'password' => Hash::make('StaffPass123')]
        );

        Staff::firstOrCreate(
            ['staff_id' => 'S_STAFF1'],
            [
                'staff_id' => 'S_STAFF1',
                'first_name' => 'Bob',
                'last_name' => 'Staff',
                'position' => 'Staff',
                'branch_id' => null,
                'user_id' => $staffUser->id,
            ]
        );
    }
}
