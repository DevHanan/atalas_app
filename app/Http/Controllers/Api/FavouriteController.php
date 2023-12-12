<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Favourite;
use App\Models\Product;
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
        $IDsList = Favourite::with(['product'])->where('client_id',auth()->guard('clients')->user()->id)->latest()->get();
        return $this->okApiResponse($IDsList,__('Loaded successfully'));
    }
    public function favourite($id){

        $client_id = auth()->guard('clients')->user()->id;
        $favourite = Favourite::where('client_id',$client_id)->where('product_id',$id)->first();

        if ($favourite){
            $favourite->delete();
            return $this->okApiResponse('',__('Unfavourite Done successfully'));

        }else{
            $obj = Favourite::create(['client_id'=>$client_id,'product_id'=>$id]);
            return $this->okApiResponse($obj,__('favourite Done successfully'));

        }



    }
}
