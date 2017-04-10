@extends('layouts.app')

@section('content')
<div class="container">
    <div class="rank-title col-md-12 panel">
        <center><h1>{{ trans('rank.rank-top') }}</h1></center>
        <center>
            <h4>
                <i>{{ trans('rank.update') }}</i>
            </h4>
        </center>
    </div>
    <div class="rank col-md-3">
        <center>
            <h3>
                {{ trans('rank.rank-top-user') }}
            </h3>
        </center>

        @foreach ($members as $member)
            <div class="list-group-item">
                <a href="{{ route('member.show', $member->id) }}">
                    <h4>{{ $member->name }}</h4>
                </a>
                <hr>
                <span class="col-md-8">{{ trans('rank.follower') }}: {{ $member->followers }}</span>
                <span class="follow-status">
                    @include('layouts.follow')
                </span>
            </div>
        @endforeach

    </div>
    <div class="rank col-md-3">
        <center>
            <h3>
                {{ trans('rank.rank-top-review') }}
            </h3>
        </center>

        @foreach ($reviews as $review)
            <div class="list-group-item">
                <h4>{{ str_limit($review->caption, $limit = config('view.limit_caption'), $end = '...') }}</h4>
                <hr>
                <span class="col-md-8">
                    <a href="{{ route('member.show', $review->user_id) }}">{{ $review->user->name }}</a>
                </span>
                <span class="col-md-8">{{ trans('rank.number-like') }}: {{ $review->num_likes }}</span>
                <a href="{{ route('review.show', $review->id) }}" class="btn btn-default">{{ trans('rank.show') }}</a>
            </div>
        @endforeach

    </div>
    <div class="rank col-md-3">
        <center>
            <h3>
                {{ trans('rank.rank-top-video') }}
            </h3>
        </center>

        @foreach ($videos as $video)
            <div class="list-group-item">
                <h4>{{ str_limit($video->caption, $limit = config('view.limit_caption'), $end = '...') }}</h4>
                <hr>
                <span class="col-md-8">
                    <a href="{{ route('member.show', $video->user_id) }}">{{ $video->user->name }}</a>
                </span>
                <span class="col-md-8">{{ trans('rank.number-like') }}: {{ $video->num_likes }}</span>
                <a href="{{ route('video', $video->id) }}" class="btn btn-default">{{ trans('rank.show') }}</a>
            </div>
        @endforeach

    </div>
    <div class="rank col-md-3">
        <center>
            <h3>
                {{ trans('rank.rank-top-book') }}
            </h3>
        </center>

        @foreach ($books as $book)
            <div class="list-group-item">
                <h4>{{ str_limit($book->title, $limit = config('view.limit_caption'), $end = '...') }}</h4>
                <hr>
                <span class="col-md-8"><a href="">{{ $book->author }}</a></span>
                <span class="col-md-8">{{ trans('rank.favorites') }}: {{ $book->favorites }}</span>
                <a href="" class="btn btn-default">{{ trans('rank.show') }}</a>
            </div>
        @endforeach

    </div>
    <div class="col-md-12 footer">
    </div>
</div>
@endsection