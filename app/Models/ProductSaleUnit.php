<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSaleUnit extends Model
{
    protected $table = 'product_sales_unit';
    protected $fillable = ['product_id','sale_unit_id'];
    protected $with = ['product','saleUnit'];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function saleUnit(){
        return $this->belongsTo(SaleUnit::class);
    }
}
