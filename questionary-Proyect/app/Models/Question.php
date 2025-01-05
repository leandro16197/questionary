<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable=[
        'question',
        'genero_id'
    ];
    
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
