<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $table = 'visits';
    protected $fillable = ['client_id','sale_id','status','code','visit_date','report'];
    public function client(){
        return $this->belongsTo(Client::class);
    }
     public function sale(){
      
        return $this->belongsTo(Sale::class);
    }

}
