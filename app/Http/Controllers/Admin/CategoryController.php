<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Models\Exhibition;
use App\Models\ExhibitionCategory;
class CategoryController extends Controller
{

    public function __construct()
    {
        // $this->middleware('permission:categories-create', ['only' => ['create','store']]);
        // $this->middleware('permission:categories-read',   ['only' => ['show', 'index']]);
        // $this->middleware('permission:categories-update',   ['only' => ['edit','update']]);
        // $this->middleware('permission:categories-delete',   ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = trans('backend.list_categories');
        $categories =  Category::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('title','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate();

        return view('admin.categories.index',compact('categories','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('backend.add_categories');
        $categories = Section::all();
        return view('admin.categories.create',compact('title','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'slug'=> $request->title
        ]);

        $request->validate([
            'slug'=>"required|max:190|unique:categories,slug",
            'title'=>"required|max:190"
            ]);
        $category = Category::create([
            "slug"=>$request->slug,
            "title"=>$request->title,
            "section_id"=>$request->section_id,
        ]);
          if($request->hasFile('image')){
              
            $thumbnail = $request->image;
           $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
                   $thumbnail->move(public_path('/uploads/categories/'),$filename);
            $category->image ='public/uploads/categories/'.$filename;
            $category->save();
         
        }
        
        toastr()->success(__('utils/toastr.category_store_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if(!auth()->user()->isAbleTo('categories-read'))abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $category = Category::find($id);
        $categories = Section::all();
        $title = trans('backend.edit_categories');
        return view('admin.categories.edit',compact('category','title','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
         $request->merge([
            'slug'=> $request->title 
        ]);

        $request->validate([
            'slug'=>"required|max:190|unique:categories,slug,".$category->id,
            'title'=>"required|max:190",
        ]);
        $category->update([
            "slug"=>$request->slug,
            "title"=>$request->title,
            "section_id"=>$request->section_id
            ]);
          if($request->hasFile('image')){
              
            $thumbnail = $request->image;
           $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
                   $thumbnail->move(public_path('/uploads/categories/'),$filename);
            $category->image ='public/uploads/categories/'.$filename;
            $category->save();
         
        }
        toastr()->success(__('utils/toastr.category_update_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = Category::find($request->id);
        $category->delete();
        toastr()->success(__('utils/toastr.category_destroy_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.categories.index');
    }
}
