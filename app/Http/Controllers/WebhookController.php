<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function shopifyOrderCreate()
    {

        $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
        $data = file_get_contents('php://input');
        $verified = $this->verify_webhook($data, $hmac_header);
        
        if($verified){
            Log::info(json_encode($data));
        }

    }



    function verify_webhook($data, $hmac_header)
    {
        $calculated_hmac = base64_encode(hash_hmac('sha256', $data, env("SHOPIFY_WEBHOOK_SECRET", "SECRET"), true));
        return hash_equals($hmac_header, $calculated_hmac);
    }
}
