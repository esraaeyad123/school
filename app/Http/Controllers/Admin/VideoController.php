<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Video;
class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::orderBy('id', 'desc')->paginate(20);
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videos.create');
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
            'title' => 'required|string|min:5|max:130',
            'link' => 'required|url',
            'course_id' => 'required|integer',
        ];
        $this->validate($request, $rules);
        $video = Video::create($request->all());

        if($video){
        return redirect()->route('videos.index')->withStatus(__('videos successfully created.'));

    } else {
return redirect()->route('videos.index')->withStatus(__('wrong'));

}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('admin.videos.show',compact('video'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('admin.videos.edit',compact('video'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $rules = [
            'title' => 'required|string|min:5|max:130',
            'link' => 'required|url',
            'course_id' => 'required|integer',
        ];
        $this->validate($request, $rules);

        if($video->update($request->all())){
            $video->save();
            return redirect()->route('videos.index')->withStatus(__('videos successfully update.'));


        }else{
            return redirect('/admin/videos/'.$video->id.'/edit')->withStatus(__('someting wrong '));


        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('videos.index')->withStatus(__('videos successfully deleted.'));
    }
}
