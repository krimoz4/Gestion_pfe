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
    Schema::create('rapports', function (Blueprint $table) {
        $table->id();
        $table->foreignId('stage_id')->constrained('stages')->onDelete('cascade');
        
        $table->string('fichier_path');
        $table->integer('version_numero'); 
        $table->text('remarques_rapporteur')->nullable();
        $table->enum('statut', ['en_attente', 'valide', 'a_corriger'])->default('en_attente');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapports');
    }
};
