<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('montantTotale');
            $table->boolean('isPaid');
            $table->string('adresse');
            $table->integer('periode');
            $table->double('prixUnitaire');
            $table->double('quantite');
            $table->date('dateFinConsommation');
            $table->date('dateLimitePaiement');
            $table->foreignId('compteur_id');
            $table->timestamps();
            $table->foreign('compteur_id')->references('id')->on('compteurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures');
    }
};
