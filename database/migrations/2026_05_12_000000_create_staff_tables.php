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
        // Create branch table
        Schema::create('branch', function (Blueprint $table) {
            $table->string('branch_id', 10)->primary();
            $table->string('street', 100)->nullable();
            $table->string('area', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('postcode', 20)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('fax', 20)->nullable();
        });

        // Create staff table
        Schema::create('staff', function (Blueprint $table) {
            $table->string('staff_id', 10)->primary();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->text('address')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('sex', 10)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('nin', 20)->nullable();
            $table->string('position', 20);
            $table->decimal('salary', 10, 2)->nullable();
            $table->date('date_joined')->nullable();
            
            $table->string('branch_id', 10)->nullable();
            $table->string('supervisor_id', 10)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('branch_id')->references('branch_id')->on('branch')->onDelete('set null');
            $table->foreign('supervisor_id')->references('staff_id')->on('staff')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        // Create next_of_kin table
        Schema::create('next_of_kin', function (Blueprint $table) {
            $table->id('kin_id');
            $table->string('staff_id', 10)->unique();
            $table->string('full_name', 100);
            $table->string('relationship', 50)->nullable();
            $table->text('address')->nullable();
            $table->string('phone', 20)->nullable();

            $table->foreign('staff_id')->references('staff_id')->on('staff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('next_of_kin');
        Schema::dropIfExists('staff');
        Schema::dropIfExists('branch');
    }
};
