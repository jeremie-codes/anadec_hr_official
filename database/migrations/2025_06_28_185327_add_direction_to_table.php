<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            // Ajouter les clés étrangères pour direction et service
            // $table->foreignId('direction_id')->nullable()->constrained('directions')->onDelete('set null');

            // // Index pour améliorer les performances
            // $table->index('direction_id');
        });
    }

    public function down(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropForeign('direction_id');
        });
    }
};
