<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Models\Exhibition;
use App\Models\ExhibitionCategory;
class SectionController extends Controller
{

    public function __construct()
    {
        // $this->middleware('permission:sections-create', ['only' => ['create','store']]);
        // $this->middleware('permission:sections-read',   ['only' => ['show', 'index']]);
        // $this->middleware('permission:sections-update',   ['only' => ['edit','update']]);
        // $this->middleware('permission:sections-delete',   ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = trans('backend.list_sections');
        $sections =  Section::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('title','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate();

        return view('admin.sections.index',compact('sections','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('backend.add_sections');
        return view('admin.sections.create',compact('title','sections'));
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
            'slug'=>"required|max:190|unique:sections,slug",
            'title'=>"required|max:190"
            ]);
        $category = Section::create([
            "slug"=>$request->slug,
            "title"=>$request->title,
            "parent_id"=>$request->parent_id,
        ]);
          if($request->hasFile('image')){
              
            $thumbnail = $request->image;
           $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
                   $thumbnail->move(public_path('/uploads/sections/'),$filename);
            $category->image ='public/uploads/sections/'.$filename;
            $category->save();
         
        }
        
        toastr()->success(__('utils/toastr.category_store_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.sections.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if(!auth()->user()->isAbleTo('sections-read'))abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $category = Section::find($id);
        $sections = Section::all();
        $title = trans('backend.edit_sections');
        return view('admin.sections.edit',compact('category','title','sections'));
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
            'slug'=>"required|max:190|unique:sections,slug,".$category->id,
            'title'=>"required|max:190",
        ]);
        $category->update([
            "slug"=>$request->slug,
            "title"=>$request->title,
            "parent_id"=>$request->parent_id
            ]);
          if($request->hasFile('image')){
              
            $thumbnail = $request->image;
           $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
                   $thumbnail->move(public_path('/uploads/sections/'),$filename);
            $category->image ='public/uploads/sections/'.$filename;
            $category->save();
         
        }
        toastr()->success(__('utils/toastr.category_update_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.sections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = Section::find($request->id);
        $category->delete();
        toastr()->success(__('utils/toastr.category_destroy_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.sections.index');
    }
}
