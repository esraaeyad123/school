<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable=[
        'name',
        'course_id'

    ];
    public function questions(){

        return $this->hasMany('App\Question', 'id');
    }
    public function Course(){

        return $this->belongsTo('App\Course');
    }
    public function users(){

        return $this->belongsTo('App\User');
    }
}
