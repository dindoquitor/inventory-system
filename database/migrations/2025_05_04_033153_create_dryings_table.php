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
        Schema::create('dryings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procurement_id')->constrained()->onDelete('cascade');
            $table->enum('drying_method', ['Sun Drying', 'Mechanical']);
            $table->foreignId('drying_facility_id')->constrained()->onDelete('cascade');
            $table->date('date_issued');
            $table->date('date_received')->nullable();
            $table->decimal('final_weight', 8, 2)->nullable();
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->integer('bags')->nullable(); // for receipt
            $table->decimal('kilos_per_bag', 6, 2)->nullable(); // auto-computed
            $table->string('wsr_number')->nullable(); // for receipt
            $table->string('wsi_number'); // required on issuance
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dryings');
    }
};
