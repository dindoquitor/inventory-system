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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // e.g. Palay, Rice, Bran, etc.
            $table->string('classification')->nullable(); // e.g. Wet, Dry (optional depending on type)
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade');
            $table->integer('bags');
            $table->decimal('total_weight', 10, 2);
            $table->decimal('kilos_per_bag', 6, 2)->nullable(); // auto-computed
            $table->date('recorded_at');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
