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
                                <h3 class="mb-0">{{ __('Tracks') }}</h3>
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
<form method="POST" action="{{ route('tracks.update',$track) }}"    autocomplete="off">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-sm-9 offset-sm-1">
            <div class="form-group">
        <input value="{{$track->name}}" type="text" name="name" class="form-control">
        <button type="submit" class="btn btn-success mt-4">Update </button>
            </div>
        </div>
    </div>
</form>

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
