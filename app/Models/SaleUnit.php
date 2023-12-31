<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class SaleUnit extends Model
{
    protected $table='sale_units';
    protected $fillable=['name'];
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
