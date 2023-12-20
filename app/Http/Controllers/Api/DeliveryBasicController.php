<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryBasicController extends Controller
{

    use ApiResponse;


    public function listClients(Request $request){
        $ids = Order::where('sale_id',auth()->guard('sales')->user()->id)->pluck('client_id')->ToArray();
        $clients = Client::whereIn('id',$ids)->withCount([
            'orders', 
            'orders as orders_count' => function ($query) {
                $query->where('sale_id', auth()->guard('sales')->user()->id);
            }])
            ->get();
        return $this->okApiResponse($clients,__('Loaded successfully'));
    }
    
    public function dashoard($id){

        $data['order'] = order::where(['sale_id'=>auth()->guard('sales')->user()->id,'id'=>$id])->first();
        return $this->okApiResponse($data,__('Loaded successfully'));

    }
    
   
}
