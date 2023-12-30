<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $table = 'visits';
    protected $fillable = ['client_id','sale_id','status','code','visit_date','report','visit_day','lat','lng','visit_time'];
    protected $appends = ['statusLabel'];
    public function client(){
        return $this->belongsTo(Client::class);
    }
     public function sale(){
      
        return $this->belongsTo(Sale::class,'sale_id');
    }

    public function getStatusLabelAttribute(){
        return $this->status== 1 ? trans('status_pending') : trans('status_confirmed') ;
    }

}
