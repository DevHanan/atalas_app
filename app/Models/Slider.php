<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable =['title','status','link','description'];

    protected $appends = ['statusLabel'];

    public function getStatusLabelAttribute(){
        return $this->status== 1 ? trans('status_appear') : trans('status_hidden') ;
    }
}
