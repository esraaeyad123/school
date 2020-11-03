<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class QuizController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    public function index($slug , $name){
        $course= Course::where('slug',$slug)->first();
        $quiz = $course->quizzes()->where('name',$name)->first();

        return view('quiz',compact('course','quiz'));

    }
}
