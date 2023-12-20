<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Complain;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{

    use ApiResponse;
    
    public function __construct()
    {
        $this->middleware('auth:clients');
    }

    public function index(){
        $IDsList = Complain::where('client_id',auth()->guard('clients')->user()->id)->latest()->get();
        return $this->okApiResponse($IDsList,__('Loaded successfully'));
    }
    public function save($id){

        $client_id = auth()->guard('clients')->user()->id;
       
            $obj = Complain::create(['client_id'=>$client_id,'report'=>$request->report]);
            return $this->okApiResponse($obj,__('Complain Stored successfully'));

        }



    }
}
