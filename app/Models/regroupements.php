<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class regroupements extends Model
{
    use HasFactory;
    protected $table = 'regroupement'; 
    protected $fillable = ['id','nomreg', 'descriptionreg', 'heuredebut', 'heurefin'];
}
