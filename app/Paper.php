<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $table = 'paper';
    protected $fillable = ['title','team','abstract','preview','year','country','created_at','updated_at'];

    public function team()
    {
        return $this->hasMany('App\Team');
    }

    // public function scopeYear($query)
    // {
    //     if( isset(request()->year) ){
    //     $query->where('year', '=', request()->year);
    //     }
    // }
    // public function scopeCountry($query)
    // {
    //     if( isset(request()->country) ){
    //         return $query->where('country', '=', request()->country);
    //     }
    // }
    // public function scopeSearch($query)
    // {
    //     if( isset(request()->search) ){
    //         return $query->where('title', '=', request()->search);
    //     }
    // }
}
