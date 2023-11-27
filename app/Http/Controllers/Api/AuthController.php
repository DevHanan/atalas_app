<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Token;
use App\Models\User;
use App\Models\District;
use App\Models\Province;
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
    public function login(LoginRequest $request)
    {
        $rules=array(
            "email"                 => 'required|email',
           'password' => 'min:8|required',
        );
         if(Auth::attempt(['email' =>$request->email ,'password' =>$request->password])){ 
             $user = auth()->user();
             $token = $user->createToken('apiToken')->plainTextToken;
             auth()->user()->update(['api_token' => $token]);
            $data = auth()->user() ;
            return $this->okApiResponse(new UserResource($data),__("User information"));
                } 
                else{ 
                   return $this->errorApiResponse([],401,__('invaild data')); 
                } 

    }

  
    public function register(RegisterRequest $request)
    {


        if ($request->has('image') && $request->image != null){
            $requests['image'] = $this->saveImage($request->image);
            $request->files->remove('image');
        }
        if($request->district_id){
            $district = District::find($request->district_id);
         $prov = Province::find($district->province_id);
        }else{
            $district = District::where('status',1)->first();
         $prov = Province::find($district->province_id); 
        }

        $request->merge(['password' => Hash::make($request->password) ,'status'=>'0' ,'address'=> $prov->title . '-' . $district->title ]);
        
        $user = User::create($request->all());
        $token =$this->generateToken($user);
        $user->api_token = $token->plainTextToken;
        $user->save();
        return $this->createdApiResponse(new UserResource($user),__("Account Created Successfully"));
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
        auth()->user()->tokens()->delete();
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
