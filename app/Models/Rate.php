<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    public $fillable=['rate','comment','client_id','product_id'];
    protected $with=['client'];
  
    public function client(){
        return $this->belongsTo(\App\Models\Client::class);
    }
    
      public function product(){
        return $this->belongsTo(\App\Models\Product::class);
    }
}
