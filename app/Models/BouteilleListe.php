<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BouteilleListe extends Model
{
    use HasFactory;

    protected $table = 'bouteilles_listes';

    protected $fillable = [
        'bouteille_id',
        'liste_id',
        'quantite' 
    ]; 

    public function bouteille() 
    {
        return $this->belongsTo(Bouteille::class);
    }

    public function liste() 
    {
        return $this->belongsTo(Liste::class);
    }
}
