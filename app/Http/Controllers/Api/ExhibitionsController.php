<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\Exhibition;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rate;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
class ExhibitionsController extends Controller
{

    use ApiResponse;

    public function list(){

        $items = Exhibition::where('status','1')->get();

        return $this->okApiResponse($items,__('data loaded'));
    }

    public function show($id){

        $item = Exhibition::find($id);
  $visit = visitor()->visit($item);
         $visit->item_id = $id;
         $visit->type = 'exhibition';
         $visit->save();        return $this->okApiResponse($item,__('data loaded'));
    }
    
    public function exhibitionByCategory($id){
        
        $items = Exhibition::whereHas('categories',function($q)use($id){
            $q->where('category_id',$id);
        })->where('status','1')->get();

        return $this->okApiResponse($items,__('data loaded'));
    }
      public function exhibitionByDistrict($id){
        
        $items = Exhibition::where('district_id',$id)->where('status','1')->get();

        return $this->okApiResponse($items,__('data loaded'));
    }
    public function exhibitionProduct($id){
         $items = Product::where('exhibition_id',$id)->where('status','1')->get();

        return $this->okApiResponse($items,__('data loaded'));
    }
    
   
  
}
