<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Visit;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{

    use ApiResponse;


    public function index(Request $request){
        $visits = Visit::where(function($q)use($request){
            if($request->status)
            $q->where('status',$request->status);
        })->where('sale_id',auth()->guard('sales')->user()->id)->latest()->get();
        return $this->okApiResponse($visits,__('Loaded successfully'));
    }
    
    public function show($id){

        $data['order'] = Visit::where(['sale_id'=>auth()->guard('sales')->user()->id,'id'=>$id])->first();
        return $this->okApiResponse($data,__('Loaded successfully'));

    }

    public function store(Request $request){
        $request->merge(['sale_id'=> auth()->guard('sales')->user()->id]);
        $visit = Visit::create($request->all());
        return $this->okApiResponse($visit,__('Visit Created successfully'));

    }
    
   
}
