@extends('layouts.app')

@section('content')
<div class="container custom-container">
    <div class="col-md-10">
        <div class="col-md-12">
            <center>
                <h1>{{ trans('app.livestream') }}</h1>
            </center>

            <div class="col-md-12">
                <iframe class="big-video-frame frame-border" src="{{ $mostNewVideo->stream_link }}" allowfullscreen>
                </iframe>
            </div>
            
            @include ('layouts.top-video')

            <hr>
        </div>
    </div>
    <div class="col-md-2">
        <center>
            <h3>{{ trans('app.video') }}</h3>
        </center>

        @foreach ($videos as $video)
            <iframe class="frame-border small-video" src="{{ $video->stream_link }}"  allowfullscreen>
            </iframe>
            <a href="{{ route('video', $video->id) }}">
                <center>
                    {{ $video->caption }}
                </center>
            </a>
        @endforeach

        <p>
            <center>
                <a class="btn btn-default form-control" id="full-video">
                    {{ trans('app.full_video') }} 
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </center>
        </p>

    </div>
    <div class="row main-left">
        <div class="col-md-3">
            <div class="list-group">
                <h3>{{ trans('app.category') }}</h3>

                @foreach ($cates as $cate)
                    <a class="list-group-item review-category">
                        {{ $cate->name }}
                        <input type="hidden" class="categoryId" value="{{ $cate->id }}">
                    </a>
                @endforeach

            </div>
        </div>
        <!--Main content -->
        <div class="col-md-9" id="content-search">
            <div class="col-md-7">
                <h2>{{ trans('app.all_review') }}</h2>
            </div>
            <!-- Item -->
            <div class="col-md-5">
                <div class="input-group">
                    <input type="search" class="form-control" name="caption" placeholder="{{ trans('app.search_review') }}" id="searchReview">
                    </br>
                    <div class="input-group-btn">
                        <button class="btn btn-default">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>                        
            </div>
            <div class="list-group col-md-12" id="review_content">

                @foreach ($reviews as $review)

                    @include ('layouts.review-item')

                @endforeach
                
            </div>
            <!-- End item -->
        </div>
        <!-- End main content -->
    </div>
</div>
@endsection
