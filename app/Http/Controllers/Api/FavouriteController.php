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


    /**
     * show event data
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */


    public function index(){
        $IDsList = Favourite::where('user_id',Auth::id())->pluck('product_id')->toArray();

        $products = Product::whereIn('id',$IDsList)->paginate(10);

        return $this->okApiResponse($products,__('Loaded successfully'));
    }
    public function favourite($id){

        $favourite = Favourite::where('user_id',Auth::id())->where('product_id',$id)->first();

        if ($favourite){
            $favourite->delete();
        }else{
            Favourite::create(['user_id'=>Auth::id(),'product_id'=>$id]);
        }

            return $this->okApiResponse('',__('Done successfully'));


    }
}
