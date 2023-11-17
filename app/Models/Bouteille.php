<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bouteille extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'prix',
        'format',
        'pays',
        'region',
        'cepage',
        'lienProduit',
        'srcImage',
        'srcsetImage',
        'designation',
        'degre',
        'tauxSucre',
        'couleur',
        'producteur',
        'agentPromotion',
        'produitQuebec',
        'type',
        'millesime',
        'pastilleGoutTitre',
        'pastilleImageSrc',
    

      
    ];


    public function bouteillesCelliers() 
    {
        return $this->hasMany(BouteilleCellier::class);
    }

    public function bouteillesListes() 
    {
        return $this->hasMany(BouteilleListe::class);
    }

    public function commentaires() 
    {
        return $this->hasMany(Commentaire::class);
    }

    public function favoris() 
    {
        return $this->hasMany(Favoris::class);
    }

}
