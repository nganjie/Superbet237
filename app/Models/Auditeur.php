<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditeur extends Model
{
    use HasFactory;
    protected $table = 'auditeurs'; 
    protected $fillable = ['id','code','matricule', 'nom', 'prenom', 'genre', 'email', 'tel','provenance','initiale','imageurl','iduser'];

    // Définissez les relations si nécessaire
}
