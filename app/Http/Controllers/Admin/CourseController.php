<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Photo;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('id', 'desc')->paginate(20);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|min:5|max:130',
            'status' => 'required|integer|in:0,1',
            'link' => 'required|url',
            'track_id' => 'required|integer',
        ];
        $this->validate($request, $rules);
        $request['slug']= strtolower(str_replace('','-', $request->title));
        $course = Course::create($request->all());
        if ($course) {
            if ($file = $request->file('image')) {
                $filename = $file->GetClientOriginalName();
                $fileextens = $file->GetClientOriginalExtension();
                $file_to_store = time() . '_' . explode('.', $filename)[0] . '_' . $fileextens;
                if ($file->move('images', $file_to_store)) {
                    Photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $course->id,
                        'photoable_type' => 'App\Course',
                    ]);
                }

            }
            return redirect()->route('courses.index')->withStatus(__('Course successfully created.'));

        } else {
            return redirect()->route('courses.index')->withStatus(__('wrong'));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $rules = [
            'title' => 'required|string|min:5|max:130',
            'status' => 'required|integer|in:0,1',
            'link' => 'required|url',
            'track_id' => 'required|integer',
        ];
        $this->validate($request, $rules);
        $course->update($request->all());

        if ($file = $request->file('image')) {
            $filename = $file->GetClientOriginalName();
            $fileextens = $file->GetClientOriginalExtension();
            $file_to_store = time() . '_' . explode('.', $filename)[0] . '_' . $fileextens;


            if ($file->move('images', $file_to_store)) {
                if($course->photo){
                $photo = $course->photo;
                    $filename = $course->photo->filename;
                    unlink('images/'.$filename );

                $photo->filename = $file_to_store;
                $photo->save();}else{
                    Photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $course->id,
                        'photoable_type' => 'App\Course',
                    ]);
                }
            }

        }
        return redirect()->route('courses.index')->withStatus(__('Course successfully update.'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if($course->photo) {
            $filename = $course->photo->filename;
            unlink('images/'.$filename );

        }
        $course->photo->delete();
        $course->delete();

        return redirect()->route('courses.index')->withStatus(__('courses successfully deleted.'));
    }
}
