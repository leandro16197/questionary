<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Ranking extends Model
{
    use HasFactory;

    protected $table='ranking';
    
    protected $fillable=[
        'id',
        'points',
        'users'
    ];
    
}
