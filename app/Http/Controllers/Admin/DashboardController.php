<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\User;
use DB;
class DashboardController extends Controller
{
   /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct()
   {
      // Module Data
      $this->title = trans_choice('module_dashboard', 1);
      $this->route = 'admin.dashboard';
      $this->view = 'admin';
   }

   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      //
      $data['title'] = $this->title;
      $data['route'] = $this->route;
      $data['view'] = $this->view;
      $data['clients'] = Client::count();
      $data['sales'] = Sale::where('type','1')->count();
      $data['delivery'] = Sale::where('type','2')->count();
      $data['orders'] = Order::count();
      $data['total_orders'] = Order::sum('total');
      $data['total_remaining'] = Order::sum('remainig_payment');

      $data['currentMonth'] = date('m');
      $data['currentYear'] = date('Y');
      
      $data['requiredProducts'] = DB::table('order_products')
                       ->select('product_id', DB::raw('COUNT(*) as total'))
                       ->whereMonth('created_at', '=', $data['currentMonth'])
                       ->whereYear('created_at', '=', $data['currentYear'])
                       ->groupBy('product_id')
                       ->orderBy('total', 'desc')
                       ->limit(5)
                       ->get();
      
      // For the chart, we'll convert the result to arrays
      $ids = $data['requiredProducts'] ->pluck('product_id')->toArray();
      $data['productIds'] = Product::whereIn('id',$ids)->pluck('name')->ToArray();
      $data['productCounts'] =  $data['requiredProducts'] ->pluck('total')->toArray();


      return view($this->view.'.index', $data);
   }
}
