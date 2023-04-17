<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'team';
    protected $fillable = ['paper_id','name','created_at','updated_at'];

    public function paper() {
        return $this->belongsTo('App\Paper');
    }
}
