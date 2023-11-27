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
        'max_order_quantity','description','status'
    ];
    
    protected $with=['category','section','photos','company'];
    protected $appends = ['fullPathImg'];
   
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
    

    protected function getfullPathImgAttribute (){
        if($this->main_img==null)
            return env('DEFAULT_IMAGE');
        else
            return asset($this->main_img);
    }
}
