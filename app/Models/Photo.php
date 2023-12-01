<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable=['product_id','path'];
   
    
     public function product(){
      
        return $this->belongsTo(Product::class);
    }
        protected $appends = ['fullpath'];

    protected function getFullPathAttribute (){
       
            return asset($this->path);
    }
}
