<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Generos;
class generosController extends Controller
{
    function getGeneros(){
        
        $generos=Generos::all();
        return view('dashboard', [
            'generos'=>$generos,
        ]);
    }
}
