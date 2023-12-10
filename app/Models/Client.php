<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Client extends Model
{
    use HasFactory, HasApiTokens;
    protected $fillable = ['name','location','phone','email','province_id','district_id','password','sale_id'];
    protected $guard='clients';

    public function district(){
        return $this->belongsTo(District::class);
    }
     public function province(){
      
        return $this->belongsTo(Province::class);
    }
}
