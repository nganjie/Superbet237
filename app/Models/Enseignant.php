<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;
    protected $table = 'enseignant'; 
    protected $fillable = ['codeens','numeroens', 'nomens','gradeEns', 'prenomens', 'emailens', 'telens','idue','iduser'];

    // Définissez les relations si nécessaire
}
