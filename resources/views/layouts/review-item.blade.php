<div class="panel panel-default review-item">
    <div class="panel-heading">
        <h3>{{ trans('app.book') }}: {{ $review->book->title }}</h3>
        <h4>{{ trans('app.reviewer') }}:
            <a href="{{ route('member.show', $review->user) }}" >{{ $review->user->name }}</a>
        </h4>
        <h5>{{ trans('app.review_date') }}: {{ $review->created_at }}</h5>    
    </div>
    <div class="panel-body">
        <div class="col-md-4">
            <a href="">
                <img class="book-image reponsive" src="{{ asset($review->book->image) }}" alt="{{ $review->book->title }}">
            </a>
        </div>
        <div class="col-md-8">
            <h3>
                {{ trans('app.caption') }}: {{ $review->caption }}
            </h3>
            <p class="review-frame">
                {!! str_limit($review->content, $limit = config('view.limit_review'), $end = '...') !!}
            </p>                         
            <p>
                <a class="btn btn-default" href="">
                    {{ trans('app.show_detail') }}
                    <span class="glyphicon glyphicon-chevron-right">
                    </span>
                </a>
            </p>
            <hr>
            <div class="action-item">
                <p class="action">
                    <input type="hidden" class="reviewId" value="{{ $review->id }}" />
                    <span class="col-md-4">
                        <span class="like">{{ $review->likes->count() }} </span>

                        @if (!isset($user))
                            {{ trans('app.like') }}
                        @elseif ($review->user_like == 1)
                            <a class="btn btn-unlike btn-link">
                                {{ trans('app.unlike') }}
                            </a>
                        @else
                            <a class="btn btn-like btn-link">
                                {{ trans('app.like') }}
                            </a>
                        @endif
                        
                    </span> 
                    <span class="col-md-4">
                        {{ $review->comments->count() }} 
                        <a class="btn btn-link comment">
                            {{ trans('app.comment') }}
                        </a>
                    </span>
                    <span class="col-md-4"> 
                        <a href="">{{ trans('app.share') }}
                            <i class="btn btn-link glyphicon glyphicon-share"></i>
                        </a>
                    </span>
                </p>
                <div class="content hidden">

                    @include('layouts.comment-item')   
                                                       
                </div>
            </div>
        </div>                          
    </div>
</div>
