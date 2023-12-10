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


         if(Auth::guard('sales')->attempt(['email' =>$request->email ,'password' =>$request->password,'type'=>$request->type])){ 
             $token = auth::guard('sales')->user()->createToken('apiToken')->plainTextToken;
             $user = auth::guard('sales')->user();
             $user->api_token= $token;
             $user->save();
             return $this->okApiResponse(new SaleResource($user),__("Sale information"));

            return $this->okApiResponse($user,__("User information"));
                } 
                else{ 
                   return $this->errorApiResponse([],401,__('invaild data')); 
                }                

    }



 
  

}
