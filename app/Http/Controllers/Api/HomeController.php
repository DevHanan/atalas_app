<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\Page;
use App\Models\Category;
use App\Models\District;
use App\Models\Province;
use App\Models\Slider;
use App\Models\UnitType;
use App\Models\Exhibition;
use App\Models\Room;
use App\Models\Setting;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
class HomeController extends Controller
{

    use ApiResponse;
    
    public function home(){
        $data['sliders'] = Slider::latest()->take(5)->get();
        $data['exhibitions'] = Exhibition::where(['status'=>'1','in_home'=>1])->where('expire_date','>=',Carbon::Today())->orderBy('order','DESC')->take(8)->get();
        $data['categories'] = Category::with('children')->whereNull('parent_id')->get();
                return $this->okApiResponse($data,__('data loaded'));
    }
    
    public function unitTypes(){
        
        $data = UnitType::latest()->get();
        return $this->okApiResponse($data,__('data loaded'));
        
    }

    public function aboutUs(){

        $page = Page::where('type','about')->first();

        return $this->okApiResponse(new PageResource($page),__('page loaded'));
    }

    public function terms(){

        $page = Page::where('type','terms')->first();
        return $this->okApiResponse(new PageResource($page),__('page loaded'));
    }

    public function categories()
    {
      $categories = Category::with('children')->whereNull('parent_id')->get();
      return $this->okApiResponse($categories,__('Categories loaded'));

    }
    
    public function city(){
        $cities = Province::where('status','1')->get();
      return $this->okApiResponse($cities,__('Cities loaded')); 
    }
    
    public function cityDistrict($id){
         $districts = District::where('province_id',$id)->get();
      return $this->okApiResponse($districts,__('Districts loaded')); 
    }
    
    public function rooms(){
           $rooms = Room::latest()->get();
      return $this->okApiResponse($rooms,__('Rooms loaded')); 
    }
    
    public function settings(){
         $data = Setting::find(9);
      return $this->okApiResponse($data,__('data loaded')); 
    }
}
