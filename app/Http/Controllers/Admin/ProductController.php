<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Toastr;
use App\Models\Photo;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = 'products';
        $this->route = 'admin.products';
        $this->view = 'admin.products';
        $this->path = 'products';
        $this->access = 'products';

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
        
        $data['rows'] = Product::latest()->get();
        return view($this->view.'.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;
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
        $request->validate([
            'name' => 'required|max:191|unique:products,name',
        ]);

        // Insert Data
        $product =  Product::create($request->except(['img','photos']));
        
         if($request->hasFile('img')){
              
            $thumbnail = $request->img;
           $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('/uploads/Products/mainImg/'),$filename);
            $product->main_img ='public/uploads/Products/mainImg/'.$filename;
            $product->save();
         
        }

        if($request->photos){
              foreach($request->photos as $photo){
                    $thumbnail_path = $photo;
                   $file = "-".time() .$thumbnail_path->getClientOriginalExtension();
                  $file= md5(Str::random(30).time().'_'.$thumbnail_path).'.'.$thumbnail_path->getClientOriginalExtension();
                    $thumbnail_path->move(public_path('/uploads/Products/photos/'),$file);
                    Photo::create(['product_id'=>$product->id , 'path'=>'public/uploads/Products/photos/'.$file]);
              }
         
        }
        
        
        
        
        Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;
        $data['row'] = Product::with('photos')->find($id);
        $data['category'] = Category::where('id',$data['row']->category_id)->get();


      return view($this->view.'.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // Field Validation
        $request->validate([
            'name' => 'required|max:191|unique:products,name,'.$product->id,
        ]);

          $product->update($request->except(['img','photos']));

         if($request->hasFile('img')){
              
            $thumbnail = $request->img;
           $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('/uploads/Products/'),$filename);
            $product->main_img ='public/uploads/products/'.$filename;
            $product->save();
         
        }
        
             if($request->photos){
               Photo::where('product_id',$product->id)->delete();
              foreach($request->photos as $img){
            $thumbnail_path = $img;
            $file= md5(Str::random(30).time().'_'.$thumbnail_path).'.'.$thumbnail_path->getClientOriginalExtension();
            $thumbnail_path->move(public_path('/uploads/Products/photos/'),$file);
            Photo::create(['product_id'=>$product->id , 'path'=>'public/uploads/Products/photos/'.$file]);
              }
         
        }


        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
         $product = Product::find($request->id);
        // Delete Data
        $product->delete();

        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));

        return redirect()->back();
    }
    
    
    public function deletePhoto(Request $request)
    {
         $photo = Photo::find($request->id);
        $photo->delete();
        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));

        return redirect()->back();
    }
    
}
