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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('direction_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->timestamps();

            $table->unique(['direction_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
