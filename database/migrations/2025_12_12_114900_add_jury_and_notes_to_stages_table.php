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
    Schema::table('stages', function (Blueprint $table) {

        /*$table->foreignId('rapporteur_id')->nullable()->constrained('professeurs')->onDelete('set null');
        $table->foreignId('examinateur_id')->nullable()->constrained('professeurs')->onDelete('set null');*/
        $table->decimal('note_encadrant', 4, 2)->nullable();
        $table->decimal('note_rapporteur', 4, 2)->nullable();
        $table->decimal('note_examinateur', 4, 2)->nullable();
        $table->decimal('note_finale', 4, 2)->nullable();
    });
}

public function down()
{
    Schema::table('stages', function (Blueprint $table) {
        $table->dropForeign(['rapporteur_id']);
        $table->dropForeign(['examinateur_id']);
        $table->dropColumn(['rapporteur_id', 'examinateur_id', 'note_encadrant', 'note_rapporteur', 'note_examinateur', 'note_finale']);
    });
}
};