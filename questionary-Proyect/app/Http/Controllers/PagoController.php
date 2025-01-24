<?php

namespace App\Http\Controllers;

use App\Models\LifePurchaseOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\vidaModel;

class PagoController extends Controller
{
    public function success(Request $request)
    {
        $user = Auth::user();
        $vida = vidaModel::where('user_id', $user->id)->first();
        $vidaId = $request->vidaId;
        $vidasExtras = LifePurchaseOption::select('lives_quantity')->where('id', $vidaId)->first();

        if ($user) {
            $actual = $vida->vidas;
            $vida->vidas = $actual + $vidasExtras->lives_quantity;
            $vida->save();
            return redirect('/home')->with('success', '¡Pago exitoso! Vidas añadidas: ' . $vidasExtras->lives_quantity);
        } else {
            return redirect('/home')->with('error', 'Hubo un problema al procesar el pago. Intenta nuevamente.');
        }
    }

    public function failure(Request $request)
    {
        return redirect('/home')->with('error', 'El pago falló. Por favor, intenta nuevamente.');
    }

    public function pending(Request $request)
    {
        return redirect('/home')->with('info', 'El pago está pendiente. Por favor, revisa más tarde.');
    }
}
