<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $guarded = [];

    protected $fileable
        =[
       'id',
    'title'  ,
    'answers'  ,
    'right_answer',
       'type',
    'score'

   ];
    public function quiz(){

        return $this->belongsTo('App\Quiz', 'id');
    }
}
