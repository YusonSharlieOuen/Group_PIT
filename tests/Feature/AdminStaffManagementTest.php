<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Staff;

class AdminStaffManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_staff_management()
    {
        $user = User::factory()->create(['email' => 'admin2@test.local']);
        Staff::create([
            'staff_id' => 'T_ADMIN2',
            'first_name' => 'TAdmin2',
            'last_name' => 'User',
            'position' => 'Admin',
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get(route('admin.staff'))
            ->assertStatus(200)
            ->assertSee('Staff');
    }
}
