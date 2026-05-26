<?php

namespace Tests\Feature;

use App\Models\Branch;
use App\Models\Lease;
use App\Models\PropertyDetails;
use App\Models\Renter;
use App\Models\Staff;
use App\Models\User;
use App\Models\Viewing;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_without_renter_profile_still_sees_client_sidebar(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Client Dashboard')
            ->assertSee('Browse Properties')
            ->assertSee('My Viewings')
            ->assertSee('My Lease')
            ->assertSee('Notifications');
    }

    public function test_renter_dashboard_and_client_pages_render(): void
    {
        $user = User::factory()->create();

        Branch::create([
            'branch_id' => 'B_TEST',
            'street' => 'Main Street',
            'area' => 'Central',
            'city' => 'Manila',
            'postcode' => '1000',
            'telephone' => '555-1000',
        ]);

        Staff::create([
            'staff_id' => 'S_TEST',
            'first_name' => 'Agent',
            'last_name' => 'Smith',
            'phone' => '555-2000',
            'position' => 'Staff',
            'branch_id' => 'B_TEST',
        ]);

        Renter::create([
            'renter_id' => 'R_TEST',
            'first_name' => 'Client',
            'last_name' => 'User',
            'address' => 'Client Address',
            'phone' => '555-3000',
            'preferred_property_type' => 'Apartment',
            'max_rent' => 50000,
            'comments' => 'Needs parking',
            'branch_id' => 'B_TEST',
            'user_id' => $user->id,
        ]);

        PropertyDetails::create([
            'property_id' => 'P_TEST',
            'street' => 'Sunrise Tower',
            'area' => 'Makati',
            'city' => 'Manila',
            'postcode' => '1200',
            'property_type' => 'Apartment',
            'number_of_rooms' => 3,
            'monthly_rent' => 45000,
            'status' => 'Available',
            'branch_id' => 'B_TEST',
            'staff_id' => 'S_TEST',
        ]);

        Viewing::create([
            'renter_id' => 'R_TEST',
            'property_id' => 'P_TEST',
            'viewing_date' => now()->addWeek()->toDateString(),
            'comments' => 'Morning preferred',
        ]);

        Lease::create([
            'lease_id' => 'L_TEST',
            'property_id' => 'P_TEST',
            'renter_id' => 'R_TEST',
            'staff_id' => 'S_TEST',
            'rent' => 45000,
            'deposit' => 90000,
            'payment_method' => 'Bank Transfer',
            'start_date' => now()->subMonth()->toDateString(),
            'end_date' => now()->addYear()->toDateString(),
            'duration' => 12,
        ]);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Client Dashboard')
            ->assertSee('Browse Properties')
            ->assertSee('My Viewings')
            ->assertSee('My Lease');

        $this->actingAs($user)
            ->get(route('viewing.create', ['property_id' => 'P_TEST']))
            ->assertOk()
            ->assertSee('Book a Viewing')
            ->assertSee('Booking as');

        $this->actingAs($user)
            ->get(route('property.show', 'P_TEST'))
            ->assertOk()
            ->assertSee('Property Details')
            ->assertSee('Branch and Agent');
    }
}
