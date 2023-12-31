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

      /** Product Most reuired in current month */
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

   /** Product Most reuired in current year */

            $data['requiredProductsinYear'] = DB::table('order_products')
            ->select('product_id', DB::raw('COUNT(*) as total'))
            ->whereYear('created_at', '=', $data['currentYear'])
            ->groupBy('product_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

// For the chart, we'll convert the result to arrays
$ids = $data['requiredProductsinYear'] ->pluck('product_id')->toArray();
$data['productIdsinyear'] = Product::whereIn('id',$ids)->pluck('name')->ToArray();
$data['productCountsinyear'] =  $data['requiredProductsinYear'] ->pluck('total')->toArray();

/** Most Required Client Chart */

$clients  = Order::select('client_id', DB::raw('count(*) as total_orders'))
->groupBy('client_id')
->orderBy('total_orders', 'desc')
->take(5)
->get();
$data['clientsLabel'] = $clients->pluck('client.name');
$data['clientsTotal'] = $clients->pluck('total_orders');

$chart4  = Order::select('client_id', DB::raw('sum("remainig_payment") as total_remainig_payment'))
->groupBy('client_id')
->orderBy('total_remainig_payment', 'desc')
->take(5)
->get();
$data['char4label'] = $chart4->pluck('client.name');
$data['char4Total'] = $chart4->pluck('total_remainig_payment');

      return view($this->view.'.index', $data);
   }
}
