<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MercadoPago;

class PaymentController extends Controller
{
    public function __construct()  
    {  
     // MercadoPago\SDK::setClientId(config('services.mercadopago.client_id'));  
     // MercadoPago\SDK::setClientSecret(config('services.mercadopago.client_secret'));   
     MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));  
    }  

    public function createPayment(Request $request)
    {
        // $user = auth()->user();

        // $name = $user->name;
        // $email = $user->email;


        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();
        $item->title = 'Mi producto';
        $item->quantity = 1;
        $item->unit_price = 75.56;

        $preference->items = array($item);  
       
        $payer = new MercadoPago\Payer();  
        $payer->name = 'pepe';  
        $payer->email = 'ppepe@asd.com';

        $preference->payer = $payer; 
      
        $preference->external_reference = '12345';
        $preference->save();

        /**
         * HAY QUE HACER UNA NUEVA FUNCION QUE RECIBA EL EL IPN DE MERCADOPAGO, 
         * PARA ASI, UNA VEZ EL PAGO FUE ACREDITADO
         * EL IPN HACE UNA PETICION A LA URL QUE TAMBIEN 
         * HAY QUE CREAR CON EL PAGO QUE FUE HECHO, Y ESTE VA A SER MODIFICADO PARA ASI
         * APARECE EN MYSQL EL STATUS QUE TIENE  
         * 
         * (EN ESTA FUNCION SOLO VAMOS A MANDAR EL INIT_POINT, EL LINK DONDE EL USUARIO VA A PAGAR)
        */

        return response()->json(['url' => $preference->init_point, 'id_payment' => $preference->id]);
    }

    public function getPayments()
    {   
        $payments = Http::get('https://api.mercadopago.com/v1/payments/search?access_token='
        .config('services.mercadopago.token')
        .'&criteria=desc'
        );
        
        return $payments;
    }
}
