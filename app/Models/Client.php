<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name','location','phone','email','province_id','district_id','password','sale_id'];


    public function district(){
        return $this->belongsTo(District::class);
    }
     public function province(){
      
        return $this->belongsTo(Province::class);
    }
}
