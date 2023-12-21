<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Auth;
use App\Http\Resources\Api\SaleResource;



class SaleAuthController extends Controller
{

    use ApiResponse;

    // login step 1
    public function login(Request $request)
    {
        $rules=array(
            "email"                 => 'required|email',
           'password' => 'min:8|required',
           'type'=>'required'
        );         


         if(Auth::guard('sales-login')->attempt(['email' =>$request->email ,'password' =>$request->password,'type'=>$request->type])){ 
             $token = auth::guard('sales-login')->user()->createToken('apiToken')->plainTextToken;
             $user = auth::guard('sales-login')->user();
             $user->api_token= $token;
             $user->save();
            return $this->okApiResponse(new SaleResource($user),__("User information"));
                } 
                else{ 
                   return $this->errorApiResponse([],401,__('invaild data')); 
                }                

    }


    public function logout()
    {
        // Revoke a specific user token
        auth()->guard('sales')->user()->tokens()->delete();
        return $this->okApiResponse([],__("Logged out successfully"));
    }


 
  

}
