<?php

namespace App\Http\Controllers\Api\Delivery;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    use ApiResponse;


    public function index(Request $request){
        $orders = Order::where(function($q)use($request){
            if($request->status)
            $q->where('status',$request->status);
        })->with('products')->where('sale_id',auth()->guard('sales')->user()->id)->latest()->get();
        return $this->okApiResponse($orders,__('Loaded successfully'));
    }
    
    public function show($id){

        $data['order'] = order::where(['sale_id'=>auth()->guard('sales-login')->user()->id,'id'=>$id])->first();
        return $this->okApiResponse($data,__('Loaded successfully'));

    }
    
   
}
