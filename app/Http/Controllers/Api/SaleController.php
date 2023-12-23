<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Visit;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{

    use ApiResponse;


    public function listClients(Request $request){
        $ids = Visit::where('sale_id',auth()->guard('sales')->user()->id)->pluck('client_id')->ToArray();
        $clients = Client::whereIn('id',$ids)->withCount([
            'visits', 
            'visits as visits_count' => function ($query) {
                $query->where('sale_id', auth()->guard('sales')->user()->id);
            }])
            ->get();
        return $this->okApiResponse($clients,__('Loaded successfully'));
    }
    public function showClient($id){
        $client = Client::with('visits')->where('id',$id)->withCount([
            'visits', 
            'visits as visits_count' => function ($query) {
                $query->where('sale_id', auth()->guard('sales')->user()->id);
            }])
            ->get();
        return $this->okApiResponse($client,__('Loaded successfully'));
    }
    
    public function dashboard(){
        $login_id = auth()->guard('sales')->user()->id;
        $delivery_orders = Visit::where('sale_id',$login_id )->get();
        $data['total_orders'] = $delivery_orders->sum('total');
        $data['count_orders'] = $delivery_orders->count();
        $data['paid'] = $delivery_orders->sum('paid');
        $data['remaining'] = $delivery_orders->sum('remainig_payment');
        $ids = Order::where('sale_id',$login_id)->pluck('client_id')->ToArray();
        $data['clients'] = Client::whereIn('id',$ids)->count();
        return $this->okApiResponse($data,__('Loaded successfully'));

    }

    
   
}
