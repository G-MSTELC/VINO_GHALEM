<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBouteillesPaniersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bouteilles_paniers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('bouteille_id'); 
            $table->foreign('bouteille_id')->references('id')->on('bouteilles'); 
            $table->unsignedBigInteger('panier_id'); 
            $table->foreign('panier_id')->references('id')->on('paniers'); 
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
        Schema::dropIfExists('bouteilles_paniers');
    }
}
