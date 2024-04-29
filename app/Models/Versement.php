<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Versement extends Model
{
    use HasFactory;
    protected $table = 'frais_scolarite'; 
    protected $fillable = ['id','idparc','idreg','libelle_frais','montant_total','delai'];

    // Définissez les relations si nécessaire
}
