<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Toastr;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function __construct()
    {

        // $this->middleware('permission:pages-create', ['only' => ['create','store']]);
        // $this->middleware('permission:pages-read',   ['only' => ['show', 'index']]);
        // $this->middleware('permission:pages-update',   ['only' => ['edit','update']]);
        // $this->middleware('permission:pages-delete',   ['only' => ['delete']]);
    }

    public function index(Request $request)
    {
          $title = trans('backend.list_pages');
        $pages =  Page::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('title','LIKE','%'.$request->q.'%')->orWhere('description','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate();
        return view('admin.pages.index',compact('pages','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('backend.add_page');
        return view('admin.pages.create',compact('title'));
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
            'type' => 'required',
            'title'=>"required|max:190|unique:pages,title",
            'description'=>"nullable|max:100000",
            'meta_description'=>"nullable|max:10000",
        ]);
        
        if($request->type == 'about')
        {
         $page = Page::where('type','about')->first();
         if($page){
                Toastr::error(__('about_page_type_exist'), __('msg_error'));
                return redirect()->back();
         }
            
        }
              $page = Page::create([
            'user_id'=>auth()->user()->id,
            "slug"=>$request->slug,
            "title"=>$request->title,
            "description"=>$request->description,
            "type"=>$request->type,
        ]);
        if($request->hasFile('image')){
              
            $thumbnail = $request->image;
           $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
                   $thumbnail->move(public_path('/uploads/pages/'),$filename);
            $page->image ='public/uploads/pages/'.$filename;
            $page->save();
         
        }
        Toastr::success(__('page_created_successfully'), __('msg_success'));
        return redirect()->route('admin.pages.index');
         
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page= Page::find($id);
        $title = trans('backend.edit_page');
        return view('admin.pages.edit',['page'=>$page,'title'=>$title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        if($request->type == 'about'){
        $obj= Page::where('type','about')->where('id','!=',$page->id)->first();
        if($obj){
        Toastr::error(__('about_page_type_exist'), __('msg_error'));
        return redirect()->back(); 
        }
        }
        
        $request->merge([
            'slug'=>$request->title
        ]);
        $request->validate([
            'title'=>"required|max:190|unique:pages,title,".$page->id,
            'description'=>"nullable|max:100000",
        ]);
        $page->update([
            "title"=>$request->title,
            "description"=>$request->description,
        ]);
     if($request->hasFile('image')){
              
            $thumbnail = $request->image;
           $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
                   $thumbnail->move(public_path('/uploads/pages/'),$filename);
            $page->image ='public/uploads/pages/'.$filename;
            $page->save();
         
        }
        Toastr::success(__('page_updated_successfully'), __('msg_success'));
        return redirect()->back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        if($page->removable==1){
            $page->delete();
        Toastr::success(__('page_deleted_successfully'), __('msg_success'));
        }else{
        Toastr::error(__('failed_to_delete'), __('msg_success'));
        }
        return redirect()->route('admin.pages.index');
    }
    
    public function editpage($type){
         $title = $type;
         $page = Page::where('type',$type)->first();
        return view('admin.pages.edit',compact('page','title'));
    }
}
