<?php
namespace App\Http\Controllers;

use App\Models\LifePurchaseOption;
use App\Models\Pagos;
use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use Illuminate\Support\Facades\Auth;
class MercadoPagoController extends Controller
{
    public function createPreference(Request $request)
    { 
        MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
        $validated = $request->validate([
                'vidaId' => 'required|integer',
            
        ]);

        $id = $request->input('vidaId'); 
        $dato=LifePurchaseOption::select('price')->where('id',$id)->first();
        $client = new PreferenceClient();
        $preference = $client->create([
            "items" => [
                [
                    "title" => "Vidas Quiz",
                    "quantity" => 1,
                    "unit_price" => $dato->price, 
                ]
            ],
            "back_urls" => [
                "success" => route('success'),
                "failure" => route('failure'),
                "pending" => route('pending'),
            ],
            "auto_return" => "approved",
        ]);    
      

        return response()->json([
            "preferenceId" => $preference->id,
        ]);
    }    
}


