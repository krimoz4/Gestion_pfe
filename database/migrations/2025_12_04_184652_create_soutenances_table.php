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
    Schema::create('soutenances', function (Blueprint $table) {
        $table->id();
        $table->date('date_soutenance');
        $table->time('heure_soutenance');
        $table->string('salle');
        $table->foreignId('stage_id')->constrained('stages')->onDelete('cascade');
        $table->foreignId('president_id')->constrained('professeurs');
        $table->foreignId('examinateur_id')->nullable()->constrained('professeurs');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soutenances');
    }
};
