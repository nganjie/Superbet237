<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promotions extends Model
{
    use HasFactory;
    protected $table = 'promotionacademique'; 
    protected $fillable = ['id','nompromo', 'nombapteme','rentréeofficielle','sortieofficielle'];


}
