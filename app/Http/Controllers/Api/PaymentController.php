<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MercadoPago;
use MercadoPago\MerchantOrder;

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

        $name = 'pepe';
        $email = 'pepe@pepe.com';

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();
        $item->title = 'Mi producto';
        $item->quantity = 1;
        $item->unit_price = 75.56;
        $preference->items = array($item);
       

        // $preference = new MercadoPago\Preference();

        // $item = new MercadoPago\Item();

        // $item->title = 'TITANIC LIMIT EDITION';
        // $item->quantity = 1;
        // $item->unit_price = 75.56;
        // $preference->items = array($item);
        // $preference->save();


        $payer = new MercadoPago\Payer();  
        $payer->name = 'pepe';  
        $payer->email = 'ppepe@asd.com';  
        $preference->payer = $payer; 
      
        // $external_reference = $preference->external_reference;  
        $preference->save();  
        return response()->json(['url' => $preference->init_point, 'id_payment' => $preference->id]);
    }

    public function getPayments()
    {   
        $mp = new MercadoPago\RestClient;
        $payments = $mp->get("/v1/payments/search",
        array(
			"limit" => 5,
			"criteria" => "desc",
            "sort" => "date_last_updated"
		));
        
        return response()->json($payments);
    }
}
