<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class SaleUnit extends Model
{
    protected $table='sale_units';
    protected $fillable=['name','sale_unit_id','number'];
    protected $appends = ['hasParent'];


    protected function getHasParentAttribute(){
        return !is_null($this->sale_unit_id) ?0:1;
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
 {
 return $this->belongsTo(SaleUnit::class, 'sale_unit_id');
 }
public function children()
 {
 return $this->hasMany(SaleUnit::class, 'sale_unit_id');
 }
}
