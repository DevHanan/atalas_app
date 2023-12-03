<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\WorkShiftType;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use App\Models\Designation;
use App\Models\MailSetting;
use App\Mail\SendPassword;
use App\Models\Department;
use App\Models\District;
use App\Models\Province;
use App\Models\Document;
use App\Models\Program;
use App\User;
use Toastr;
use Hash;
use Auth;
use Mail;
use DB;

class UserController extends Controller
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
        $this->title     = trans_choice('module_staff', 1);
        $this->route     = 'admin.user';
        $this->view      = 'admin.user';
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
         $data['rows']  =  User::where('is_admin','1')->latest()->get();
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
        $data['roles'] = Role::orderBy('name', 'asc')->get();
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
            'first_name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ]);
        // Store data
        $user = new User;
        $user->first_name = $request->first_name;
        $user->email = $request->email;
                $user->phone = $request->phone;

        $user->password = Hash::make($request->password);
        $user->status = '1';
        $user->is_admin = '1';

        $user->created_by = Auth::guard('web')->user()->id;
        $user->save();
          $user->roles()->attach($request->roles);

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
                $data['row'] = $user = User::find($id);
        $data['userRoles'] = $user->roles->all();
        $data['row'] = $user = User::find($id);
                $data['roles'] = Role::orderBy('name', 'asc')->get();
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
            'first_name' => 'required',
            'email' => 'required|unique:users,email,'.$id
        ]);

        
        // Update data
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->email = $request->email;
                        $user->phone = $request->phone;

        $user->updated_by = Auth::guard('web')->user()->id;
        $user->save();
        // Assign Role
                $user->roles()->sync($request->roles);

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
        DB::beginTransaction();
        // Delete
        $user = User::find($id);
        $this->deleteMultiMedia($this->path, $user, 'photo');

        // Detach
        $user->roles()->detach();

        $user->delete();
        DB::commit();

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
        $user = User::where('id', $id)->firstOrFail();

        if($user->status == 1){
            $user->login = 0;
            $user->status = 0;
            $user->save();
        }
        else {
            $user->login = 1;
            $user->status = 1;
            $user->save();
        }

        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendPassword($id)
    {   
        //
        $user = User::where('id', $id)->firstOrFail();
        
        $mail = MailSetting::where('status', '1')->first();

        if(isset($mail->sender_email) && isset($mail->sender_name)){

            $sendTo = $user->email;
            $receiver = $user->first_name.' '.$user->address;

            // Passing data to email template
            $data['name'] = $user->first_name.' '.$user->address;
            $data['staff_id'] = $user->staff_id;
            $data['email'] = $user->email;
            $data['password'] = Crypt::decryptString($user->password_text);

            // Mail Information
            $data['subject'] = 'Your Login Credentials';
            $data['from'] = $mail->sender_email;
            $data['sender'] = $mail->sender_name;
            

            // Send Mail
            Mail::to($sendTo, $receiver)->send(new SendPassword($data));

            
            Toastr::success(__('msg_sent_successfully'), __('msg_success'));
        }
        else{
            Toastr::success(__('msg_receiver_not_found'), __('msg_success'));
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printPassword($id)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        
        $data['row'] = User::where('id', $id)->firstOrFail();

        return view($this->view.'.password-print', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordChange(Request $request)
    {
        // Field Validation
        $request->validate([
            'staff_id' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        // Update Data
        $student = User::findOrFail($request->staff_id);
        $student->password = Hash::make($request->password);
        $student->save();


        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }
}
