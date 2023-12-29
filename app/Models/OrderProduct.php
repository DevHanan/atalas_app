<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['product_id','order_id','quantity','price'];

    use HasFactory;
    protected $with = ['product'];
    protected $appends = ['productName'];
    public function product(){
           return $this->belongsTo(Product::class);
       }
       protected  function getProductNameAttribute(){
        return $this->product->name;
       }

}
