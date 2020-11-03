@extends('layouts.app', ['title' => __('Courses Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('courses') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('courses.create') }}" class="btn btn-sm btn-primary">{{ __('Add Courses') }}</a>
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
                    <div class="card-body">
                  <div class="row the_course">
                           <div class="col-sm">

                                      <div class="course-image">
                                               @if($course->photo)
                                     <img src="/school/public/images/{{ $course->photo->filename}}" class="img-fluid">
                                                @else
                                     <img src="/school/public/images/1.jpg" class="img-fluid">
                                        </div>

                                      @endif
                                           </div>

                      <div class="col-sm-8">
                              <div class="course-info">

    <h3>{{\Str::limit($course->title , 50)}}</h3>

    <h3><a href="/admin/tracks/{{$course->track->id}}">{{$course->track->name}}</a></h3>

    <span class="{{$course->status == 0 ? 'text-success' : 'text-danger'}}">{{$course->status == 0 ? 'FREE':'PAID'}}</span>
                                        </div>
                                            </div>
                                              </div>
                                            </div>

                </div>
            </div>


            <div class="table-responsive">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h2 class="mb-0">{{ __('Courses Quiz') }}</h2>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{$course->id}}/quizzes/create" class="btn btn-sm btn-primary">{{ __('Add new Quiz') }}</a>
                        </div>
                        <div class="col-8">
                            <h2 class="mb-0">{{ __('courses video') }}</h2>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{$course->id}}/videos/create" class="btn btn-sm btn-primary">{{ __('Add new Viedo') }}</a>
                        </div>

                    </div>

                </div>
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">{{ __('Title') }}</th>
                        <th scope="col">{{ __('Creation Date') }}</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($course->Video as $video)
                        <tr>
                            <td title="{{$video->title }}"><a href="admin/videos/{{$video->id}}">{{\Str::limit($video->title ,30  )}}</a></td>
                            <td>
                                <a href="{{ route('videos.show' ,$video)}}">{{\Str::limit( $video->course->title ,30 )}}</a>
                            </td>
                            <td>{{ $video->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                        <form action="{{ route('videos.destroy', $video) }}" method="post">
                                            @csrf
                                            @method('delete')

                                            <a class="dropdown-item" href="{{ route('videos.edit', $video) }}">{{ __('Edit') }}</a>
                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>







                </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
