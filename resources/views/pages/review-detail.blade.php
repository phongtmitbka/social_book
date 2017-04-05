@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default review-item col-md-9">
            <div class="panel-heading">
                <div>
                    <div class="col-md-11">
                        <h5>{{ trans('app.review_date') }}: {{ $review->created_at }}</h5>
                    </div>
                    <div class="col-md-1">
                        @if ($user && $review->user->id == $user->id)
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        <span class="fa fa-sort-desc"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('review.edit', $review->id) }}">
                                                <i class="fa fa-pencil-square-o">
                                                </i> 
                                                {{ trans('review.edit') }}
                                            </a>
                                            <a class="del-review">
                                                <i class="fa fa-trash-o"></i> 
                                                {{ trans('review.delete') }}
                                            </a>
                                            <form id="del-review-form" action="{{ route('review.destroy', $review->id) }}" class="hidden" method="POST">
                                                <input name="_method" type="hidden" value="DELETE">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        @endif
                    </div>
                    <br>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <a href="">
                        <img class="book-image reponsive" src="{{ asset($review->book->image) }}" alt="{{ $review->book->title }}">
                    </a>
                </div>
                <div class="col-md-8">
                    <h2>{{ trans('app.caption') }}: {{ $review->caption }}</h2>
                    <h4>{{ trans('review.location') }}: {{ $review->location }}</h4>
                    <h3>{{ trans('app.book') }}: {{ $review->book->title }}</h3>
                    <h4>{{ trans('app.reviewer') }}:
                        <a href="{{ route('member.show', $review->user) }}" >{{ $review->user->name }}</a>
                    </h4>
                    <div class="col-md-1 fb-share-button" data-href="http://fast-ridge-82270.herokuapp.com/" data-layout="button" data-size="large" data-mobile-iframe="true">
                        <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Ffast-ridge-82270.herokuapp.com%2F&amp;src=sdkpreparse">
                            {{ trans('app.share') }}
                        </a>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                    <p>
                        {!! $review->content !!}
                    </p>
                    <hr>
                    <div class="action-item">

                        @include('layouts.action-item')
                        
                    </div>
                    <hr>
                </div>                          
            </div>
        </div>
        <div class="col-md-3">
            <div class="list-group">
                <h3>{{ trans('review.same-author') }}</h3>

                @foreach ($reviewAuthors as $reviewAuthor)
                    <a href="{{ route('review.show', $reviewAuthor->id) }}" class="list-group-item">{{ $reviewAuthor->book->title }}</a>
                @endforeach

                <h3>{{ trans('review.same-book') }}</h3>

                @foreach ($reviewBooks as $reviewBook)
                    <a href="{{ route('review.show', $reviewBook->id) }}" class="list-group-item">{{ $reviewBook->book->title }}</a>
                @endforeach

                <h3>{{ trans('review.popular-review') }}</h3>

                @foreach ($reviewTops as $reviewTop)
                    <a href="{{ route('review.show', $reviewTop->id) }}" class="list-group-item">{{ $reviewTop->book->title }}</a>
                @endforeach

            </div>
        </div>    
    </div>
@endsection
