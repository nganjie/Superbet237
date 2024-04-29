<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class divisionca extends Model
{
    use HasFactory;
    protected $table = 'divisionca'; 
    protected $fillable = ['id','idperio','iduc','nom','datedebut','datefin'];
}
