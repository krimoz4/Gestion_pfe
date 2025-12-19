<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('stages', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->text('description')->nullable();
        $table->string('rapport_path')->nullable(); 
        $table->enum('statut', ['en_cours', 'depose', 'valide', 'refuse'])->default('en_cours');
        $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade');
        $table->foreignId('encadrant_id')->constrained('professeurs');
        $table->foreignId('rapporteur_id')->nullable()->constrained('professeurs');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};
