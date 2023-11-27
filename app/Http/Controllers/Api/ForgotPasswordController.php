<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ResetCodePassword;
use App\Models\User;
use App\Mail\SendCodeResetPassword;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Mail;
use Hash;

class ForgotPasswordController extends Controller
{
    public function sendCode(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        ResetCodePassword::where('email', $request->email)->delete();
        $data['code'] = mt_rand(100000, 999999);
        $codeData = ResetCodePassword::create($data);
        Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));
        return response(['message' => trans('passwords.sent')], 200);
    }
    public function checkCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords',
            'email' => 'required|email|exists:reset_code_passwords',

        ]);

        // find the code
        $passwordReset = ResetCodePassword::where('email',$request->email)->Where('code', $request->code)->first();

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }

        return response([
            'code' => $passwordReset->code,
            'message' => trans('passwords.code_is_valid')
        ], 200);
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }

        // find user's email 
        $user = User::firstWhere('email', $passwordReset->email);

        // update user password
        $user->update(['password' => Hash::make($request->password)]);

        // delete current code 
        $passwordReset->delete();

        return response(['message' =>'password has been successfully reset'], 200);
    }

}