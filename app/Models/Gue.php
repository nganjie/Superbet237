<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gue extends Model
{
    use HasFactory;
    protected $table = 'gue'; 
    protected $fillable = ['id','nomgue'];
}