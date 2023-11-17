<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBouteillesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bouteilles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom');
            $table->string('pays'); 
            $table->string('region')->nullable(); 
            $table->string('couleur')->nullable(); 
            $table->string('format'); 
            $table->decimal('prix', 7, 2); 
            $table->string('srcImage', 512); 
            $table->string('srcsetImage', 512); 
            $table->string('producteur'); 
            $table->unsignedSmallInteger('millesime')->nullable(); 
            $table->string('cepage')->nullable(); 
            $table->string('tauxSucre')->nullable(); 
            $table->string('designation'); 
            $table->string('degre')->nullable(); 
            $table->string('agentPromotion')->nullable(); 
            $table->string('produitQuebec')->nullable(); 
            $table->string('type'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bouteilles');
    }
}
