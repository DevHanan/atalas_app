<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Toastr;
use Image;
use File;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = 'بروفايل المتجر';
        $this->route = 'admin.setting';
        $this->view = 'admin.setting';
        $this->path = 'setting';
        $this->access = 'setting';


        // $this->middleware('permission:'.$this->access.'-view');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;

        $data['row'] = Setting::where('status', 1)->first();

        return view($this->view.'.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function siteInfo(Request $request)
    {
        // Field Validation
        $request->validate([
            'title' => 'required',
            'logo' => 'nullable|image',
            'favicon' => 'nullable|image',
            'phone' => 'nullable',
            'email' => 'nullable|email'
        ]);

       
        $data = Setting::where('id',1)->first();
        if(!$data)
        $data = new Setting();

        $data->update($request->except(['logo_path','favicon_path']));
        if($request->hasFile('logo_path')){
              
            $thumbnail = $request->logo_path;
           $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('/uploads/settings/'),$filename);
            $data->logo_path ='public/uploads/settings/'.$filename;
            $data->save();
         
        }

        if($request->hasFile('favicon_path')){
              
            $thumbnail = $request->favicon_path;
           $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('/uploads/settings/'),$filename);
            $data->favicon_path ='public/uploads/settings/'.$filename;
            $data->save();
         
        }

        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }
}
