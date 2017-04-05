<input type="hidden" class="reviewId" value="{{ $review->id }}" />
<span class="col-md-5">
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
<span class="col-md-7">
    {{ $review->comments->count() }} 
    <a class="btn btn-link comment">
        {{ trans('app.comment') }}
    </a>
</span>
