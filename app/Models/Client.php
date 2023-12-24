<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory, HasApiTokens;
    protected $fillable = ['first_name','last_name','lat','lng','phone','email','province_id','district_id','password','sale_id'];
    protected $hidden =['api_token','password'];
    // protected $with = ['province','district'];
    protected $guard='clients';
    protected $appends = ['provinc','district'];


    public function district(){
        return $this->belongsTo(District::class);
    }
     public function province(){
      
        return $this->belongsTo(Province::class);
    }

    protected function getProvinceAttribute(){
        return optional($this->province)->name;
    }
    protected function getDistrictAttribute(){
        return optional($this->district)->name;
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function visits(){
        return $this->hasMany(Visit::class);
    }
}
