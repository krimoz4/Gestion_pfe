<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema; 

return new class extends Migration
{
    public function up()
    {
        Schema::table('stages', function (Blueprint $table) {
            
            if (!Schema::hasColumn('stages', 'examinateur_id')) {
                $table->foreignId('examinateur_id')->nullable()->constrained('professeurs')->onDelete('set null');
            }

            if (!Schema::hasColumn('stages', 'rapporteur_id')) {
                $table->foreignId('rapporteur_id')->nullable()->constrained('professeurs')->onDelete('set null');
            }

            if (!Schema::hasColumn('stages', 'note_encadrant')) {
                $table->decimal('note_encadrant', 4, 2)->nullable();
                $table->decimal('note_rapporteur', 4, 2)->nullable();
                $table->decimal('note_examinateur', 4, 2)->nullable();
                $table->decimal('note_finale', 4, 2)->nullable();
            }
        });
    }

    public function down()
    {
    }
};