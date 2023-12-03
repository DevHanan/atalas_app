<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\District;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filterSection(Request $request){
        $categories = Category::where('section_id',$request->section_id)->get();
        return response()->json($categories);

    }


    public function filterDistrict(Request $request){
        $cities = District::where('province_id',$request->province_id)->get();
        return response()->json($cities);

    }
}