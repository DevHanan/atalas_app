<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    CONST STATUS_NEW = 'جديد';
    CONST STATUS_SHIPMENT = 'تم الشحن'; 
    CONST STATUS_DELIVERED = 'تم التسليم'; 
    CONST STATUS_POSTPONE = 'مؤجل'; 
    CONST STATUS_FAILED = 'فشل'; 

    protected $fillable = ['client_id','status','order_date','delivery_date','remainig_payment','status_reason'];
    protected $with = ['products','delivery'];
    protected $appends = ['statusLabel'];
    protected $casts = [
        'delivery_date' => 'datetime',
        'order_date' =>'datetime'
    ];
    public function products(){
           return $this->hasMany(\App\Models\OrderProduct::class);
       }
    public function client(){
        return $this->belongsTo(Client::class);
    }
   
    
     public function delivery(){
      
        return $this->belongsTo(Sale::class,'sale_id','id');
    }

    public function getStatusLabelAttribute(){
        if($this->status == 1)
        return Self::STATUS_NEW;
        elseif($this->status == 2)
        return Self::STATUS_SHIPMENT; 
        elseif($this->status == 3)
        return Self::STATUS_DELIVERED; 
        elseif($this->status == 4)
        return Self::STATUS_POSTPONE; 
        else
        return Self::STATUS_FAILED; 


    }
}
