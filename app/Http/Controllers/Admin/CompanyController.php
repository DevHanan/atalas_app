<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Company;
use Illuminate\Http\Request;
class CompanyController extends Controller
{

    public function __construct()
    {
        // $this->middleware('permission:companies-create', ['only' => ['create','store']]);
        // $this->middleware('permission:companies-read',   ['only' => ['show', 'index']]);
        // $this->middleware('permission:companies-update',   ['only' => ['edit','update']]);
        // $this->middleware('permission:companies-delete',   ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = trans('backend.list_companies');
        $companies =  Company::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('name','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate();

        return view('admin.companies.index',compact('companies','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('backend.add_companies');
        return view('admin.companies.create',compact('title'));
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
            'name'=>"required|max:190",
            'section_id'=>'required',
            'category_id' => 'required'
            ]);
        $company = Company::create($request->all());
          if($request->hasFile('image')){
              
            $thumbnail = $request->image;
           $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
                   $thumbnail->move(public_path('/uploads/companies/'),$filename);
            $company->image ='public/uploads/companies/'.$filename;
            $company->save();
         
        }
        
        toastr()->success(__('utils/toastr.company_store_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.companies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        if(!auth()->user()->isAbleTo('companies-read'))abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $company = Company::find($id);
        $title = trans('backend.edit_companies');
        return view('admin.companies.edit',compact('company','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
         $request->merge([
            'slug'=> $request->title 
        ]);

        $request->validate([
            'name'=>"required|max:190",
            'section_id' => 'required',
            'category_id'=> 'required'
        ]);
        $company->update($request->all());
          if($request->hasFile('image')){
              
            $thumbnail = $request->image;
           $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
                   $thumbnail->move(public_path('/uploads/companies/'),$filename);
            $company->image ='public/uploads/companies/'.$filename;
            $company->save();
         
        }
        toastr()->success(__('utils/toastr.company_update_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company = Company::find($request->id);
        $company->delete();
        toastr()->success(__('utils/toastr.company_destroy_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.companies.index');
    }
}
