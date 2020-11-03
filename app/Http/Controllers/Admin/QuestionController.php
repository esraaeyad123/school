<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Question;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::orderBy('id', 'desc')->paginate(30);
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }
    public function store(Request $request)
    {


        $rules = [
            'title' => 'required|min:20|max:1000',
            'answers' => 'required|min:10|max:1000',
            'right_answer' => 'required|min:3|max:50',
            'score' => 'required|integer|in:5,10,15,20,25,30',
            'type' => 'required|in:text,checkbox',

            'quiz_id' => 'required|integer',
        ];







        if(Question::create($request->all())) {
            return redirect('/admin/questions')->withStatus('Question successfully created.');
        }else {
            return redirect('/admin/questions/create')->withStatus('Something Wrong, Try again.');
        }
    }


    public function edit(Question $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);


        $rules = [
            'title' => 'required|min:10|max:1000',
            'answers' => 'required|min:10|max:1000',
            'right_answer' => 'required|min:3|max:50',
            'score' => 'required|integer|in:5,10,15,20,25,30',
            'type' => 'required|in:text,checkbox',

            'quiz_id' => 'required|integer',
        ];



        $values = $request->all();
        $question->fill($values)->save();
        if($question) {
            return redirect('/admin/questions')->withStatus('Question successfully up[dated.');
        }else {
            return redirect('/admin/questions/'. $question->id .'/edit')->withStatus('Something Wrong, Try again.');
        }
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect('/admin/questions')->withStatus('Question successfully deleted.');
    }
}
