<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeAca extends Model
{
    use HasFactory;
    protected $table = 'periodeacademique'; 
    protected $fillable = ['id','nomperio', 'nomorg','anneedebut','anneefin','codeorg'];
}
