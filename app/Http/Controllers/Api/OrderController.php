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
        
        $order = Order::create(['client_id'=>auth()->guard('clients')->user()->id , 'status'=>'0' ,'order_date'=>Carbon::today()]);
       $total = 0;
        foreach($request->products as $product){
            $product = Product::find((int)$product['id']);
        OrderProduct::create(['product_id'=>(int)$product['id'] , 'quantity'=> (int)$product['qty'],
                      'order_id'=>$order->id ,'price'=>$product->price]);
                      $total += $product->price * (int)$product['qty'];
        }
        $order->total = $total;
        $order->save();
        return $this->okApiResponse($order->load('products'),__('Order Created successfully'));

    }
}
