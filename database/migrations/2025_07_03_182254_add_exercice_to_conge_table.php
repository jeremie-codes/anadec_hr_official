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
        Schema::table('conges', function (Blueprint $table) {
            $table->string('exercice')->after('id')->nullable()->comment('Exercice de la demande de congé');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conge', function (Blueprint $table) {
            //
        });
    }
};
