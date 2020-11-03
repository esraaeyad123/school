<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Quiz;


class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $quizzes = Quiz::orderBy('id', 'desc')->paginate(20);
        return view('admin.quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quizzes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:5|max:130',
            'course_id' => 'required|integer',
        ];
        $this->validate($request, $rules);
        $quizz = Quiz::create($request->all());
        if($quizz){
            return redirect()->route('quizzes.index')->withStatus(__('videos successfully created.'));

        } else {
            return redirect()->route('quizzes.index')->withStatus(__('wrong'));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        return view('admin.quizzes.show',compact('quiz'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        return view('admin.quizzes.edit',compact('quiz'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $rules = [
            'name' => 'required|string|min:5|max:130',
            'course_id' => 'required|integer',
        ];
        $this->validate($request, $rules);

        if($quiz->update($request->all())){
            $quiz->save();
            return redirect()->route('quizzes.index')->withStatus(__('videos successfully update.'));


        }else{
            return redirect('/admin/quizzes/'.$quiz->id.'/edit')->withStatus(__('someting wrong '));


        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('quizzes.index')->withStatus(__('videos successfully deleted.'));
    }
}
