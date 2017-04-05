@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('review.update', $review->id) }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="_method" type="hidden" value="PUT">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <input type="hidden" name="bookId" value="{{ $book->id }}">
                        <h3>{{ trans('app.book') }}: {{ $book->title }}</h3>
                        <h3>{{ trans('app.author') }}: {{ $book->author }}</h3>
                        <a class="btn btn-primary">
                            {{ trans('app.livestream') }}
                            <i class="fa fa-video-camera"></i>
                        </a>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-3">
                            <a>
                                <img class="book-image reponsive" src="{{ asset($book->image) }}" alt="{{ $book->title }}">
                            </a>
                        </div>
                        <div class="col-md-9">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif

                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            
                            <div class="form-group">
                                <label>{{ trans('review.location') }}</label>
                                <input type="text" name="location" class="form-control" value="{{ $review->location }}"><br>
                                <label>{{ trans('app.caption') }}</label>
                                <textarea class="form-control" name="caption">{{ $review->caption }}</textarea>
                                <label>{{ trans('review.write-review') }}</label>
                                <textarea id="demo" class="form-control ckeditor" rows="3" name="content">
                                	{{ $review->content }}
                                </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ trans('review.send') }}</button>
                            <button type="reset" class="btn btn-default">{{ trans('review.reset') }}</button> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <pre>


    </pre>
</div>
@endsection
