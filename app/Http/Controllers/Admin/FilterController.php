<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filterSection(Request $request){
        $categories = Category::where('section_id',$request->section_id)->get();
        return response()->json($categories);

    }
}