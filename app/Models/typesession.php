<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typesession extends Model
{
    use HasFactory;
    protected $table = 'typesession'; 
    protected $fillable = ['id','nom','description','anonymat'];
}
