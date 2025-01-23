<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pagos extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'life_purchase_option_id',
        'amount',
        'payment_status',
        'payment_method',
        'preference_id',
    ];
}
