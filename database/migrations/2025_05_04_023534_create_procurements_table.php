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
        Schema::create('procurements', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('palay_type', ['Dry', 'Wet']);
            $table->integer('bags');
            $table->decimal('total_weight', 8, 2); // User input
            $table->decimal('weight_per_bag', 5, 2); // Auto-computed: total_weight / bags
            $table->string('wsr_number'); // WSR form number
            $table->foreignId('farmer_id')->constrained()->onDelete('cascade');
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procurements');
    }
};
