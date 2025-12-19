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
    Schema::create('entreprises', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('adresse')->nullable();
        $table->string('ville');
        $table->string('telephone')->nullable();
        $table->string('email_contact')->nullable();
        $table->timestamps();
    });

    Schema::table('stages', function (Blueprint $table) {
        $table->foreignId('entreprise_id')->nullable()->constrained()->onDelete('set null');
    });
}
};
