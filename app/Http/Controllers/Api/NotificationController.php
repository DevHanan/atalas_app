<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\UserResource;
use App\Models\Notification;
use App\Models\Token;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    use ApiResponse;

    public function index() {
        $data = Notification::where('user_id',auth()->user()->id)->latest()->paginate(10);
        return $this->okApiResponse(NotificationResource::collection($data)->response()->getData(true),__('Notification loaded'));

    }

   
    public function refreshToken(Request $request) {
      
         try{
        $request->user()->update(['fcm_token'=>$request->token]);
               return $this->okApiResponse(['token' => $request->token,'id'=>Auth::id()],__("Token updated"));

    }catch(\Exception $e){
        report($e);
        return response()->json([
            'success'=>false
        ],500);
    }

    }

    public function testFCM(Request $request){
        $requests = $request->all();
        $tokens =[$request->device_token];
        return firebase_notification('Test','Test',$tokens,'',[]);
    }
}
