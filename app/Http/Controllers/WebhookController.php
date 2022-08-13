<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use Carbon\Carbon;

class WebhookController extends Controller
{
    public function shopifyOrderCreate()
    {

        $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
        $data = file_get_contents('php://input');
        $json = json_decode($data, TRUE);
        $verified = $this->verify_webhook($data, $hmac_header);
        
        if($verified){

            $order = new Order();

            $order->shopifyOrderId = $json['id'];
            $order->shoipifyOrderObject = $data;
            $order->result = "-";
            $order->attempts = 0;
            $order->timestamp = Carbon::now()->timestamp;

            Log::info($order->save());
        }

    }








    function verify_webhook($data, $hmac_header)
    {
        $calculated_hmac = base64_encode(hash_hmac('sha256', $data, env("SHOPIFY_WEBHOOK_SECRET", "SECRET"), true));
        return hash_equals($hmac_header, $calculated_hmac);
    }
}
