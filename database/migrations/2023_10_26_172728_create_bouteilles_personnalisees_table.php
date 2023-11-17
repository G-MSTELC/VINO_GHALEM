<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBouteillesPersonnaliseesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bouteilles_personnalisees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom');
            $table->string('pays'); 
            $table->string('region'); 
            $table->string('couleur'); 
            $table->string('format'); 
            $table->decimal('prix'); 
            $table->string('producteur'); 
            $table->unsignedSmallInteger('millesime'); 
            $table->string('cepage'); 
            $table->string('tauxSucre'); 
            $table->string('degre'); 
            $table->string('type'); 
            $table->unsignedBigInteger('user_id'); 
            $table->foreign('user_id')->references('id')->on('users'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bouteilles_personnalisees');
    }
}
