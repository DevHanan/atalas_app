<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaleUnit;

use Illuminate\Http\Request;
class UnitController extends Controller
{

    public function __construct()
    {
        $this->title = 'units';
        $this->route = 'admin.units';
        $this->view = 'admin.units';
        $this->path = 'units';
        $this->access = 'units';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['route'] = $this->route;
        $datap['title'] = trans('backend.list_units');
        $data['units'] =  SaleUnit::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('name','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate();
        return view($this->view.'.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('backend.add_units');
        return view('admin.units.create',compact('title'));
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
            'name'=>"required|max:190|unique:sale_units,name"
                    ]);
        $unit = SaleUnit::create([
            "name"=>$request->name,
            'number' => $request->number,
            'sale_unit_id' => $request->sale_unit_id
        ]);
          
        toastr()->success(__('utils/toastr.unit_store_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.units.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(SaleUnit $unit)
    {
        if(!auth()->user()->isAbleTo('units-read'))abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $unit = SaleUnit::find($id);
        $title = trans('backend.edit_units');
        return view('admin.units.edit',compact('unit','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleUnit $unit)
    {
        

        $request->validate([
            'name'=>"required|max:190|unique:sale_units,name,".$unit->id
        ]);
        $unit->update([
            "name"=>$request->name,
            'number' => $request->number,
            'sale_unit_id' => $request->sale_unit_id
            ]);
        
        toastr()->success(__('utils/toastr.unit_update_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.units.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $unit = SaleUnit::find($request->id);
        $unit->delete();
        toastr()->success(__('utils/toastr.unit_destroy_success_message'), __('utils/toastr.successful_process_message'));
        return redirect()->route('admin.units.index');
    }
}
