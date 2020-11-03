@extends('layouts.app', ['title' => __('Tracks Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">



                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{$track->name}}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{$track->id}}/courses/create" class="btn btn-sm btn-primary">{{ __('Add Courses') }}</a>
                                </div>
                            </div>
                        </div>


                    @include('incledes.errors')
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>


                    @if(count($track->courses ))
                        <div class="row">

                            @foreach ($track->courses as $course)

                                <div class="col-sm-3">
                                    <div class="card" style="width: 18rem;">
                                        @if($course->photo)
                                            <img height="80" class="card-img-top" src="/school/public/images/{{$course->photo->filename}}" alt="Card image cap">
                                        @else
                                            <img height="80" class="card-img-top" src="/school/public/images/1.jpg" alt="Card image cap">

                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{\Str::limit($course->title,100)}}</h5>
                                            <p class="card-text"></p>

                                            <form action="{{ route('courses.destroy',$course) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('courses.show',$course) }}" class="btn btn-primary btn-sm">show</a>

                                                <a href="{{ route('courses.edit',$course) }}" class="btn btn-primary btn-sm">edit</a>
                                                <input class="btn btn-danger btn-sm" type="submit" value="Delete" name="deleteCourse">

                                            </form>


                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    @else
                        No courses
                    @endif


                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
