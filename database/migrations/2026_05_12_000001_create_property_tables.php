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
        // Create owner table
        Schema::create('owner', function (Blueprint $table) {
            $table->string('owner_id', 10)->primary();
            $table->string('full_name', 100);
            $table->text('address')->nullable();
            $table->string('phone', 20)->nullable();
        });

        // Create property table
        Schema::create('property', function (Blueprint $table) {
            $table->string('property_id', 10)->primary();
            $table->string('street', 100)->nullable();
            $table->string('area', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('postcode', 20)->nullable();
            $table->string('property_type', 50)->nullable();
            $table->integer('number_of_rooms')->nullable();
            $table->decimal('monthly_rent', 10, 2)->nullable();
            $table->string('status', 20)->default('Available');

            $table->string('branch_id', 10)->nullable();
            $table->string('staff_id', 10)->nullable();

            $table->foreign('branch_id')->references('branch_id')->on('branch')->onDelete('set null');
            $table->foreign('staff_id')->references('staff_id')->on('staff')->onDelete('set null');
        });

        // Create property_owner table
        Schema::create('property_owner', function (Blueprint $table) {
            $table->string('property_id', 10);
            $table->string('owner_id', 10);

            $table->primary(['property_id', 'owner_id']);
            $table->foreign('property_id')->references('property_id')->on('property')->onDelete('cascade');
            $table->foreign('owner_id')->references('owner_id')->on('owner')->onDelete('cascade');
        });

        // Create renter table
        Schema::create('renter', function (Blueprint $table) {
            $table->string('renter_id', 10)->primary();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->text('address')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('preferred_property_type', 50)->nullable();
            $table->decimal('max_rent', 10, 2)->nullable();
            $table->text('comments')->nullable();

            $table->string('branch_id', 10)->nullable();

            $table->foreign('branch_id')->references('branch_id')->on('branch')->onDelete('set null');
        });

        // Create viewing table
        Schema::create('viewing', function (Blueprint $table) {
            $table->id('viewing_id');
            $table->string('renter_id', 10)->nullable();
            $table->string('property_id', 10)->nullable();
            $table->date('viewing_date')->nullable();
            $table->text('comments')->nullable();

            $table->foreign('renter_id')->references('renter_id')->on('renter')->onDelete('cascade');
            $table->foreign('property_id')->references('property_id')->on('property')->onDelete('cascade');
        });

        // Create advert table
        Schema::create('advert', function (Blueprint $table) {
            $table->id('advert_id');
            $table->string('property_id', 10)->nullable();
            $table->string('newspaper', 100)->nullable();
            $table->date('date_advertised')->nullable();

            $table->foreign('property_id')->references('property_id')->on('property')->onDelete('cascade');
        });

        // Create lease table
        Schema::create('lease', function (Blueprint $table) {
            $table->string('lease_id', 10)->primary();
            $table->string('property_id', 10)->nullable();
            $table->string('renter_id', 10)->nullable();
            $table->string('staff_id', 10)->nullable();

            $table->decimal('rent', 10, 2)->nullable();
            $table->decimal('deposit', 10, 2)->nullable();
            $table->boolean('deposit_paid')->default(false);
            $table->string('payment_method', 50)->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('duration')->nullable();

            $table->foreign('property_id')->references('property_id')->on('property')->onDelete('set null');
            $table->foreign('renter_id')->references('renter_id')->on('renter')->onDelete('set null');
            $table->foreign('staff_id')->references('staff_id')->on('staff')->onDelete('set null');
        });

        // Create inspection table
        Schema::create('inspection', function (Blueprint $table) {
            $table->id('inspection_id');
            $table->string('property_id', 10)->nullable();
            $table->string('staff_id', 10)->nullable();
            $table->date('inspection_date')->nullable();
            $table->text('comments')->nullable();

            $table->foreign('property_id')->references('property_id')->on('property')->onDelete('cascade');
            $table->foreign('staff_id')->references('staff_id')->on('staff')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection');
        Schema::dropIfExists('lease');
        Schema::dropIfExists('advert');
        Schema::dropIfExists('viewing');
        Schema::dropIfExists('renter');
        Schema::dropIfExists('property_owner');
        Schema::dropIfExists('property');
        Schema::dropIfExists('owner');
    }
};
