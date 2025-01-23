<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifePurchaseOption extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'price',
        'life_quantity',
    ];
}
