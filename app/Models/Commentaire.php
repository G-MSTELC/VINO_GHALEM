<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'bouteille_id',
        'user_id'
    ]; 

    public function bouteille() 
    {
        return $this->belongsTo(Bouteille::class);
    }

    public function bouteillePersonnalisee() 
    {
        return $this->belongsTo(BouteillePersonnalisee::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
