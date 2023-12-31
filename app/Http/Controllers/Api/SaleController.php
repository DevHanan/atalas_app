<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ClientResource;
use App\Models\Client;
use App\Models\Order;
use App\Models\Visit;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
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
        $data['client'] =  new ClientResource(Client::find($id));
        $data['visit_count'] = Visit::where('sale_id',auth()->guard('sales')->user()->id)->count();
        $data['month_visit_count'] = Visit::where('sale_id',auth()->guard('sales')->user()->id)->whereMonth('visit_date', Carbon::now()->month)
        ->count();
        $client_orders = Order::where('client_id',$id)->get();
        $data['order_number'] = $client_orders->count();
        $data['order_total'] = $client_orders->sum('total');
        $data['paid'] = $client_orders->sum('paid');
        $data['remaining'] = $client_orders->sum('remainig_payment');


        return $this->okApiResponse($data,__('Loaded successfully'));
    }
    
    public function dashboard(){
        $login_id = auth()->guard('sales')->user()->id;
        $visits = Visit::where('sale_id',$login_id )->get();
        $data['visit_count'] = $visits->count();
        $data['current_month_visit'] = $visits->count();
        $ids = Visit::where('sale_id',$login_id)->pluck('client_id')->ToArray();
        $data['client_count'] = Client::whereIn('id',$ids)->count();
        return $this->okApiResponse($data,__('Loaded successfully'));

    }

    public function addClient(Request $request){

        $request->merge(['password '=> Hash::make($request->password) , 'type'=>'1','sale_id'=>auth()->guard('sales')->user()->id]);
      $data = Client::create($request->all());
       return $this->okApiResponse($data,__('Loaded successfully'));

    }

    
   
}
