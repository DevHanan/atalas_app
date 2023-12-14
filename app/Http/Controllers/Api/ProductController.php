<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rate;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
class ProductController extends Controller
{

    use ApiResponse;

    public function ProductByCategory(Request $request){
        $order = $request->order == 0 ?"ASC" :"DESC";
        $data = Product::active()->where(function($q)use($request){
            if($request->search)
            $q->where('name', 'like', '%'.$request->search.'%');
        })->where('category_id',$request->id)->orderBy('price',$order)->get();
        return $this->okApiResponse($data,__('product loaded'));
    }

    
    public function ProductByCategoryANDCompany(Request $request){
        $order = $request->order == 0 ?"ASC" :"DESC";
        $data = Product::active()->where(function($q)use($request){
            if($request->search)
            $q->where('name', 'like', '%'.$request->search.'%');
        })->where(['category_id'=>$request->category_id,'company_id'=>$request->company_id])->orderBy('price',$order)->get();
        return $this->okApiResponse($data,__('product loaded'));
    }

    public function show(Request $request,$id){

        $data['product'] = Product::active()->where('id',$id)->first();
        $data['related'] = Product::where('category_id',$data['product']->category_id)->where('id','!=',$id)->get();
        return $this->okApiResponse($data,__('page loaded'));
    }

    public function list(){

        $data = Product::active()->latest()->get();
        return $this->okApiResponse($data,__('page loaded'));
    }


    public function recommendProduct(){
        $data = Product::active()->where('recommend','1')->first();
        return $this->okApiResponse($data,__('page loaded'));
    }

    public function topRatedProduct(){
        $data = Product::active()->where('highest_rated','1')->first();
        return $this->okApiResponse($data,__('page loaded'));
    }

    public function bestSellingProduct(){
        $data = Product::active()->where('best_seller','1')->first();
        return $this->okApiResponse($data,__('page loaded'));
    }

    public function rate(Request $request){
        $request->merge(['client_id'=>auth()->guard('clients')->user()->id]);
        $rate_exist = Rate::where('product_id',$request->exhibition_id)->where('client_id',auth()->guard('clients')->user()->id)->first();
        if($rate_exist)
        $rate_exist->delete();
         $rate =Rate::create($request->all());
        return $this->okApiResponse($rate->load('product'),__('product rated successfully'));

    }

}
