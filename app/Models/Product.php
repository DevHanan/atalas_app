<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'company_id', 'section_id', 'category_id', 'status',
        'price','discount','supplier_price','gomalla_price','carton_price','quantity',
        'max_order_quantity','description','best_seller','highest_rated','recommend',
        'sale_unit_id','purchase_unit_id'
    ];
    
    protected $with=['category','section','photos','company','rates','saleUnits'];
    protected $appends = ['fullPathImg','reviewCount','isFavourite'];
   
    public function scopeActive($query)
    {
    return $query->where('status', '1');
    }
    public function company(){
        return $this->belongsTo(Company::class);
    }
    
    public function section(){
        return $this->belongsTo(Section::class);
    }
     public function category(){
      
        return $this->belongsTo(Category::class);
    }
    
     public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function rates(){
        return $this->hasMany(Rate::class);
    }
    
    

    protected function getfullPathImgAttribute (){
        if($this->main_img==null)
            return env('DEFAULT_IMAGE');
        else
            return asset($this->main_img);
    }

    protected function getreviewCountAttribute (){
        return $this->rates()->count();
    }

    protected function getIsFavouriteAttribute (){
        if(auth()->guard('clients')->user())
        return Favourite::where(['client_id'=>auth()->guard('clients')->user()->id,'product_id'=>$this->id])->first() ? 1:0;
    else return 0;
        
    }
    public function saleUnits()
{
    return $this->belongsToMany(SaleUnit::class,'product_sale_unit');
}

}
