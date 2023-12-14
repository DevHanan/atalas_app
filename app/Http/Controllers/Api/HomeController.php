<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\Page;
use App\Models\Category;
use App\Models\Company;
use App\Models\District;
use App\Models\Product;
use App\Models\Province;
use App\Models\Slider;
use App\Models\Section;
use App\Models\Setting;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
class HomeController extends Controller
{

    use ApiResponse;
    
    public function home(){
        $data['sliders'] = Slider::latest()->take(5)->get();
        $data['sections'] = Section::latest()->get();
        $data['categories'] = Category::latest()->get();
        $data['most_selling_product'] = Product::where('best_seller','1')->get();
        $data['top_rated_product'] = Product::where('highest_rated','1')->get();
        $data['recommend_product'] = Product::where('recommend','1')->get();
        $data['recent_added_product'] = Product::latest()->get();



        return $this->okApiResponse($data,__('data loaded'));
    }
    
    public function sections(){
        
        $data = Section::latest()->get();
        return $this->okApiResponse($data,__('data loaded'));
        
    }

    public function CategoryBySection($id){
        
      $data = Category::where('section_id',$id)->get();
      return $this->okApiResponse($data,__('data loaded'));
      
  }

  public function city(){
    $cities = Province::where('status','1')->get();
  return $this->okApiResponse($cities,__('Cities loaded')); 
}

public function companies(){
  $companies = Company::where('status','1')->get();
  return $this->okApiResponse($companies,__('Companies loaded'));  
}
public function companyByCategory($id){
$ids = Product::where('category_id',$id)->pluck('company_id')->ToArray();
$companies = Company::whereIn('id',$ids)->where('status','1')->get();
return $this->okApiResponse($companies,__('Companies loaded'));  

}

public function cityDistrict($id){
     $districts = District::where('province_id',$id)->get();
  return $this->okApiResponse($districts,__('Districts loaded')); 
}


    public function aboutUs(){

        $page = Page::where('type','about')->first();

        return $this->okApiResponse(new PageResource($page),__('page loaded'));
    }

    public function terms(){

        $page = Page::where('type','terms')->first();
        return $this->okApiResponse(new PageResource($page),__('page loaded'));
    }

    
    public function settings(){
         $data = Setting::find(1);
      return $this->okApiResponse($data,__('data loaded')); 
    }
}
