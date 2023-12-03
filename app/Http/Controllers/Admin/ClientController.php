<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use App\Models\Client;
use Toastr;
use Hash;
use Auth;
use DB;

class ClientController extends Controller
{
    use FileUploader;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct () 
    {
        // Module Data
        $this->title     = 'العملاء';
        $this->route     = 'admin.clients';
        $this->view      = 'admin.clients';
        $this->path      = 'admins';
        $this->access    = 'admins';


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['title']     = $this->title;
        $data['route']     = $this->route;
        $data['view']      = $this->view;
        $data['path']      = $this->path;
        $data['access']    = $this->access;
         $data['rows']  =  Client::latest()->get();
        return view($this->view.'.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['title']     = $this->title;
        $data['route']     = $this->route;
        $data['view']      = $this->view;
        return view($this->view.'.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Field Validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:clients,email',
            'password' => 'required',
            'phone'  => 'required'
        ]);
        

        $request->merge(['password '=> Hash::make($request->password) , 'type'=>'1']);
       Client::create($request->all());
        Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->route($this->route.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
   {
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['title']     = $this->title;
        $data['route']     = $this->route;
        $data['view']      = $this->view;
        $data['path']      = $this->path;
        $data['row'] = $user = Client::find($id);
        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Field Validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:clients,email,'.$id
        ]);

        
        if($request->password){
            $request->merge(['password '=> Hash::make($request->password) , 'type'=>'1']);
            Client::where('id',$id)->update($request->all());
        }
        else
        Client::where('id',$id)->update($request->except(['password']));

        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $user = Client::find($id);

        $user->delete();
        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {   
        // Set Status
        $user = Client::where('id', $id)->firstOrFail();
        $status = $user->status== 0 ? 1:0;
            $user->status = $status;
            $user->save();
        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }

    public function passwordChange(Request $request)
    {
        // Field Validation
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        // Update Data
        $saleman = Client::findOrFail($request->id);
        $saleman->password = Hash::make($request->password);
        $saleman->save();

        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }


}
