<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'user_id'
    ]; 

    public function bouteillesPaniers() 
    {
        return $this->hasMany(BouteillePanier::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
