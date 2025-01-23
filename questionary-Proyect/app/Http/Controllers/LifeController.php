<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LifePurchaseOption;
use Illuminate\Support\Facades\Auth;
use App\Models\vidaModel;
class LifeController extends Controller
{
    public function getLife()
    {
        $user = Auth::user();
        $vidas = vidaModel::where('user_id', $user->id)->first();
        $compra = LifePurchaseOption::all();
        if (!$compra) {
            return view('gama-layouts.compra-vidas', [
                'data' => 'no se encontraron vidas',
            ]);
        }
        return view('game-layouts.compra-vidas', [
            'data' => $compra,
            'vidas'=>$vidas
        ]);
    }
}
