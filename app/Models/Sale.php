<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Passport\PersonalAccessToken;


class Sale extends Authenticatable
{
    use HasApiTokens, HasFactory;
    protected $fillable = ['name','phone','email','province_id','district_id','password'];
    protected $hidden = ['password'];
    protected $guard='sales';

    public function district(){
        return $this->belongsTo(District::class);
    }
     public function province(){
      
        return $this->belongsTo(Province::class);
    }
}
