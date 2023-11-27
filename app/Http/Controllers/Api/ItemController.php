<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
class ItemController extends Controller
{

    use ApiResponse;

    public function ProductByCategory(Request $request){
        $order = $request->order == 0 ?"ASC" :"DESC";
        $data = Product::where(function($q)use($request){
            if($request->search)
            $q->where('name', 'like', '%'.$request->search.'%');
        })->where('category_id',$request->id)->orderBy('price',$order)->get();
        return $this->okApiResponse($data,__('product loaded'));
    }

    public function show(Request $request,$id){

        $data = Product::where('id',$id)->first();
         $visit = visitor()->visit($data);
         $visit->item_id = $id;
         $visit->type = 'product';
         $visit->save();

        return $this->okApiResponse($data,__('page loaded'));
    }
    
    public function offer(Request $request){
        $data = Product::where(function($q)use($request){
            if($request->search)
            $q->where('name', 'like', '%'.$request->search.'%');
        })->get();
        return $this->okApiResponse($data,__('product loaded'));
    }
    
    public function ProductByExhibition($id){
        $data = Product::where('exhibition_id',$id)->get();
        return $this->okApiResponse($data,__('product loaded'));
        
    }

}
