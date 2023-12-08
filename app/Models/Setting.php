<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable=['title','email','address','phone','phone3','phone2','facebook_url','twitter_url','instgram_url','youtube_url'];
}
