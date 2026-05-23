<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_dashboard()
    {
        $user = User::factory()->create(['email' => 'admin@test.local']);
        Staff::create([
            'staff_id' => 'T_ADMIN',
            'first_name' => 'TAdmin',
            'last_name' => 'User',
            'position' => 'Admin',
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertStatus(200)
            ->assertSee('Admin Dashboard');
    }

    public function test_non_admin_cannot_access_admin_pages()
    {
        $user = User::factory()->create(['email' => 'normal@test.local']);
        Staff::create([
            'staff_id' => 'T_STAFF',
            'first_name' => 'TStaff',
            'last_name' => 'User',
            'position' => 'Staff',
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertStatus(403);
    }
}
