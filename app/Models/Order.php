<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function client(){
        return $this->belongsTo(Client::class);
    }
     public function delivery(){
      
        return $this->belongsTo(Sale::class);
    }
}
