<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    use ApiResponse;


    public function index(){
        $orders = Order::with('products')->where('user_id',Auth::id())->latest()->get();
        return $this->okApiResponse($orders,__('Loaded successfully'));
    }
    
    public function show($id){

        $data['order'] = order::find($id);
        $product_ids = OrderProduct::where('order_id',$id)->pluck('product_id')->ToArray();
        $data['product'] = Product::whereIn('id',$product_ids)->get();

            return $this->okApiResponse($data,__('Loaded successfully'));

    }
    
    public function store(Request $request){
        
        $order = Order::create(['user_id'=>auth()->user()->id , 'status'=>'0']);
        foreach($request->products as $product)
        OrderProduct::create(['product_id'=>(int)$product['id'] , 'qty'=> (int)$product['qty'],'order_id'=>$order->id]);
        return $this->okApiResponse($order->load('products'),__('Order Created successfully'));

    }
}
