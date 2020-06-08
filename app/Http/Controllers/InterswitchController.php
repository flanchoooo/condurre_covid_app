<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Interswitch\Constants;
use Interswitch\HttpClient;
use Interswitch\Interswitch;
use Interswitch\Utils;

class InterswitchController extends Controller
{

    public  function headers (){
         $clientId     = "IKIACA67D931869E40BE07EE418A0B07A4A6D9EEF588";
         $clientSecret = "y0FISAGAS+OSIASec5Cts/khsWVXaWCoxZcLF2d8o/A=";



        // Initialize Interswitch object
        $interswitch = new Interswitch($clientId, $clientSecret);

        // Create sensitive data
        $pan = "5061030000000000084";
        $expiryDate = "2109";
        $cvv = "123";
        $pin = "1234";
        $authData = $interswitch->getAuthData($pan, $expiryDate, $cvv, $pin);

        // Build request data
        $transactionRef = "ISW|API|JAM|" . mt_rand(0, 65535);
        $customerId = "api-jam@interswitchgroup.com";
        $currency = "NGN";
        $amount = "50"; // Minor denomination

         $data = array(
            "customerId" => $customerId,
            "amount" => $amount,
            "transactionRef" => $transactionRef,
            "currency" => $currency,
            "authData" => $authData
        );



        return $response = $interswitch->send("api/v2/purchases", "POST", $data);
        $httpRespCode = $response["HTTP_CODE"];
       $respBody = $response["RESPONSE_BODY"];
    }




}
