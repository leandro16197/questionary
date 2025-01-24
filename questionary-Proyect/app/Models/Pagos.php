<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pagos extends Model
{
    use HasFactory;
    protected $table = 'pagos';
    protected $fillable = [
        'user_id',
        'life_purchase_option_id',
        'amount',
        'payment_status',
        'payment_method',
        'preference_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lifePurchaseOption()
{
    return $this->belongsTo(LifePurchaseOption::class);
}

}
