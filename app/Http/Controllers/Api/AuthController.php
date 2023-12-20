<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\Api\ClientResource;
use App\Models\Client;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function __;
use function auth;
use function public_path;
use function request;
use Hash;

class AuthController extends Controller
{

    use ApiResponse;

    // login step 1
    public function login(Request $request)
    {
       
        if(is_numeric($request->email))
            $field = 'phone';
            else
            $field = 'email';
        
         if(auth()->guard('clients-login')->attempt([$field =>$request->email ,'password' =>$request->password,'status'=>'1'])){ 
             $client = auth()->guard('clients-login')->user();
             $token = $client->createToken('apiToken')->plainTextToken;
             $client->api_token = $token;
             $client->save();
            return $this->okApiResponse(new ClientResource($client),__("client information"));
                } 
                else{ 
                   return $this->errorApiResponse([],401,__('invaild data')); 
                } 

    }

  
    public function register(RegisterRequest $request)
    {


    
        $request->merge(['password' => Hash::make($request->password) ,'status'=>'0' ]);
        
        $user = Client::create($request->all());
        $token =$this->generateToken($user);
        $user->api_token = $token->plainTextToken;
        $user->save();
        return $this->createdApiResponse(new ClientResource($user),__("Account Created Successfully"));
    }

 
    private function generateToken($user)
    {
        $user->tokens()->delete();
        return $user->createToken("Mobile:token");
    }


    function saveImage($file, $folder = '/')
    {
        request()->files->remove('link');

        $fileName = time() . rand(10,99).$file->getClientOriginalName();
        $dest = public_path('/uploads/' . $folder);
        $file->move($dest, $fileName);

        $uploaded_file = 'uploads/' . $folder . '/' . $fileName;
        return $uploaded_file;
    }


    public function logout()
    {
        // Revoke a specific user token
        auth()->guard('clients')->user()->tokens()->delete();
        return $this->okApiResponse([],__("Logged out successfully"));
    }
    
     public function updateToken(Request $request){
    try{
        $user = User::find($request->user_id);
        $user->fcm_token=$request->token;
        $user->save();
        return $this->okApiResponse([],__("Update token success"));

    }catch(\Exception $e){
        report($e);
        return response()->json([
            'success'=>false
        ],500);
    }
} 

}
