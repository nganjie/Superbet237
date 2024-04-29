<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soutenance extends Model
{
    use HasFactory;
    protected $table = 'soutenance'; 
    protected $fillable = ['id','idaudi','datesoutenance','sujet','presidentjury','directeurthese','codirecteur'];
}
