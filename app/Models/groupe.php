<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groupe extends Model
{
    use HasFactory;
    protected $table = 'groupe'; 
    protected $fillable = ['id','code', 'nom','description'];
}
