<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    
    public function __construct()
    {
        // $this->middleware('permission:sliders-create', ['only' => ['create','store']]);
        // $this->middleware('permission:sliders-read',   ['only' => ['show', 'index']]);
        // $this->middleware('permission:sliders-update',   ['only' => ['edit','update']]);
        // $this->middleware('permission:sliders-delete',   ['only' => ['delete']]);
    }


    public function index(Request $request)
    {
        $title = trans('backend.list_sliders');
        $sliders =  Slider::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('title','LIKE','%'.$request->q.'%')->orWhere('description','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate();
        return view('admin.sliders.index',compact('sliders','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('backend.add_Slider');
        return view('admin.sliders.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'status'=>"required|in:0,1",
            'title'=>"required|max:190",
        ]);
        $slider = Slider::create([
            "status"=>$request->status==1?1:0,
            "title"=>$request->title ,
            'link' => $request->link,
            'description' => $request->description,

            ]);
           if($request->hasFile('main_image')){
              
            $thumbnail = $request->main_image;
           $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
                   $thumbnail->move(public_path('/uploads/sliders/'),$filename);
            $slider->image='public/uploads/sliders/'.$filename;
            $slider->save();
         
        }
        toastr()->success(__('utils/toastr.slider_store_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.sliders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $title = trans('backend.edit_slider');
        return view('admin.sliders.edit',compact('slider','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        

        $request->validate([
            'status'=>"required|in:0,1",
            'title'=>"required|max:190"
        ]);
        $slider->update([
            "status"=>$request->status==1?1:0,
            "title"=>$request->title,
            'link' => $request->link,
            'description' => $request->description,

        ]);
        if($request->hasFile('main_image')){
              
            $thumbnail = $request->main_image;
           $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
                   $thumbnail->move(public_path('/uploads/sliders/'),$filename);
            $slider->image='public/uploads/sliders/'.$filename;
            $slider->save();
         
        }
        toastr()->success(__('utils/toastr.Slider_update_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        toastr()->success(__('utils/toastr.Slider_destroy_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.sliders.index');
    }
}
