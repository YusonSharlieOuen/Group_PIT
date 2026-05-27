<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rent_requests', function (Blueprint $table) {

            $table->id();

            $table->string('renter_id');
            $table->string('property_id');

            // Manager assigns staff
            $table->string('assigned_staff_id')->nullable();

            // Staff who accepted
            $table->string('approved_by')->nullable();

            $table->enum('status', [
                'Pending',
                'Assigned',
                'Accepted',
                'Rejected'
            ])->default('Pending');

            $table->timestamps();

            $table->foreign('renter_id')
                ->references('renter_id')
                ->on('renter');

            $table->foreign('property_id')
                ->references('property_id')
                ->on('property');

            $table->foreign('assigned_staff_id')
                ->references('staff_id')
                ->on('staff');

            $table->foreign('approved_by')
                ->references('staff_id')
                ->on('staff');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_request');
    }
};
