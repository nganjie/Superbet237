<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sessions extends Model
{
    use HasFactory;
    protected $table = 'session'; 
    protected $fillable = ['id','idtypesess','nom','description'];
}
