<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use validate;


class ProfileController extends Controller
{
    use ApiResponse;

    public function index() {
        return $this->okApiResponse(new UserResource(Auth::user()),__("User information"));
    }

    public function update(Request $request) {
        
        
        $requests =[
          'first_name' => $request->first_name,
          'last_name'  => $request->last_name,
          'email' => $request->email ,
          'address'  => $request->address
        ];

        if ($request->has('image') && $request->image != null){
            $requests['image'] = $this->saveImage($request->image);
            $request->files->remove('image');
        }
        User::find(Auth::id())->fill($requests)->save();
        return $this->okApiResponse(new UserResource(Auth::user()),__("Profile updated"));

    }
    public function updatePassword(PasswordUpdateRequest $request) {
        
    if(auth()->user()->password = Hash::make($request->old_password)){ 

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();
        return $this->createdApiResponse(new UserResource($user),__("Password Updated Successfully"));
    }else{
        return $this->errorApiResponse([],401,__('Old Password Not Correct')); 

    }
}

public function updateLocation(Request $request){
    $district = District::find($request->district_id);
        $prov = Province::find($district->province_id);

        $user = auth()->user();
         $user->district_id = $request->district_id;
         $user->address = $prov->title . '-' . $district->title;
        $user->save();
    
     return $this->createdApiResponse(new UserResource(auth()->user()),__("Location Updated Successfully"));
}

    public function deleteaccount()  {
        auth()->user()->tokens()->delete();
        auth()->user()->delete();
        return $this->okApiResponse([],__("account delete successfully"));
    }
        
    

}
