<?php

namespace App\Http\Controllers\Api;

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
        })->with('products')->where('client_id',auth()->guard('clients')->user()->id)->latest()->get();
        return $this->okApiResponse($orders,__('Loaded successfully'));
    }
    
    public function show($id){

        $data['order'] = order::find($id);
        $product_ids = OrderProduct::where('order_id',$id)->pluck('product_id')->ToArray();
        $data['product'] = Product::whereIn('id',$product_ids)->get();

            return $this->okApiResponse($data,__('Loaded successfully'));

    }
    
    public function store(Request $request){
        
        $order = Order::create(['client_id'=>auth()->guard('clients')->user()->id ,
         'status'=>'1' ,'order_date'=>Carbon::today(),'delivery_date'=>$request->delivery_date]);
        foreach($request->products as $item){
            $product = Product::find((int)$item['id']);
        OrderProduct::create(['product_id'=>(int)$item['id'] , 'quantity'=> (int)$item['qty'],
                      'order_id'=>$order->id ,'price'=>$product->price]);
                      $order->total =   $order->total + $product->price * (int)$item['qty'];
                      $order->save();
        }
      
        return $this->okApiResponse($order->load('products'),__('Order Created successfully'));

    }
}
