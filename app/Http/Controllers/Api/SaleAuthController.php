<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class SaleAuthController extends Controller
{

    use ApiResponse;

    // login step 1
    public function auth(Request $request)
    {
        $response = Http::post('https://test.salesforce.com/services/oauth2/token', [
            'grant_type' => $request->grant_type,
            'client_id' => $request->client_id,
            'client_secret' => $request->client_secret,
            'username' => $request->username,
            'password'=> $request->password
        ]);

        $jsonData = $response->json();
        return $jsonData;
        return $this->okApiResponse($jsonData,__("User information"));                

    }



 
  

}
