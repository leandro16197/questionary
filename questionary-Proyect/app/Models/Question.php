<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Generos;

class Question extends Model
{
    use HasFactory;

    protected $fillable=[
        'question',
        'genero_id'
    ];
    

        public function responses()
    {
        return $this->hasMany(Response::class, 'question_id');
    }

    public function genero()
    {
        return $this->belongsTo(Generos::class, 'genero_id');
    }
}
