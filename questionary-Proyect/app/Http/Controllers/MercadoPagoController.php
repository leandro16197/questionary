<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

class MercadoPagoController extends Controller
{
    public function createPreference(Request $request)
    {
        MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

        $client = new PreferenceClient();
        $preference = $client->create([
            "items" => [
                [
                    "title" => "Mi producto",
                    "quantity" => 1,
                    "unit_price" => 2000, 
                ]
            ],
            "back_urls" => [
                "success" => route('success'),
                "failure" => route('failure'),
                "pending" => route('pending'),
            ],
            "auto_return" => "approved",
        ]);

        // Devuelve el ID de la preferencia
        return response()->json([
            "preferenceId" => $preference->id,
        ]);
    }
}


