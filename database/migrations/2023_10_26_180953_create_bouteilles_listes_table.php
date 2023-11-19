<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBouteillesListesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bouteilles_listes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('bouteille_id'); 
            $table->foreign('bouteille_id')->references('id')->on('bouteilles'); 
            $table->unsignedBigInteger('liste_id'); 
            $table->foreign('liste_id')->references('id')->on('listes'); 
            $table->unsignedInteger('quantite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bouteilles_listes');
    }
}
