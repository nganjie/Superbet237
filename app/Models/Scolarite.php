<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scolarite extends Model
{
    use HasFactory;
    protected $table = 'scolarite'; 
    protected $fillable = ['codesco'];

    // Définissez les relations si nécessaire
}
