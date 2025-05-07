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
        Schema::create('drying_facilities', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Mechanical', 'Sun Drying']);
            $table->string('name')->nullable(); // for mechanical only
            $table->string('location'); // address
            $table->string('brand')->nullable(); // mechanical only
            $table->integer('capacity'); // bags or bags/hour
            $table->string('accountable_officer');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drying_facilities');
    }
};
