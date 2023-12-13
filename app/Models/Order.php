<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','status','order_date'];
    protected $with = ['products'];
    public function products(){
           return $this->hasMany(\App\Models\OrderProduct::class);
       }
    public function client(){
        return $this->belongsTo(Client::class);
    }
     public function delivery(){
      
        return $this->belongsTo(Sale::class);
    }
}
