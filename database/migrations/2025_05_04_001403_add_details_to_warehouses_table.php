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
        Schema::table('warehouses', function (Blueprint $table) {
            $table->string('supervisor_name')->nullable()->after('name');
            $table->string('location')->nullable();
            $table->integer('design_capacity')->nullable();
            $table->integer('effective_capacity')->nullable();
            $table->string('usage_type')->nullable(); // can hold values like 'Buying Station', 'Food Security', or 'Both'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warehouses', function (Blueprint $table) {
            $table->dropColumn([
                'supervisor_name',
                'location',
                'design_capacity',
                'effective_capacity',
                'usage_type',
            ]);
        });
    }
};
