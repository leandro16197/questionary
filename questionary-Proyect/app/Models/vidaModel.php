<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vidaModel extends Model
{   
    protected $table='vidas';
    protected $fillable = [
<<<<<<< HEAD
        'id','vidas','user_id','max_vidas','last_updated' 
=======
        'id','vidas','user_id' 
>>>>>>> f7ce9542c7d24e9ef74ada78f0cf3d8fae0bfe31
    ];
}
