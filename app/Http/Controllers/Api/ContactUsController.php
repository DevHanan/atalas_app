<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;


class ContactUsController extends Controller
{

    use ApiResponse;


    public function store(Request $request){
        Contact::create([
            'name'=>$request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ]);
        return $this->okApiResponse([],__('Message sent'));
    }

}
