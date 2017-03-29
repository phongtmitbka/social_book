<p class="col-md-12">

    @if (isset($user))
        <p>
            <div class="col-md-1">
                <img src="{{ asset($user->avatar) }}" class="small_avatar">
            </div>
            <div class="col-md-11">
                <input type="hidden" name="_token" class="token-comment" value="{{ csrf_token() }}">
                <input type="text" name="comment" class="enter_comment form-control" placeholder="write comment ...">
            </div>
        </p>
    @endif
    
</p>

@foreach ($review->comments as $comment)
    <p class="col-md-12">
        <p>
            <div class="col-md-1">
                 <a href="">
                    <img src="{{ asset($comment->user->avatar) }}" class="small_avatar">
                 </a>
            </div>
            <div class="col-md-11">
                <a href="{{ route('member.show', $comment->user_id) }}">{{ $comment->user->name }}</a>
                <div class="old_comment">
                    <input type="hidden" class="commentId" value="{{ $comment->id }}">
                    <span class="col-md-10">
                        <input class="hidden edit_comment form-control" type="text" placeholder="write comment ..." value="{{ $comment->content }}">
                        <span>{{ $comment->content }}</span>  
                    </span>

                    @if (isset($user) && ($comment->user_id == $user->id || ($review->user_id == $user->id)))
                        <input type="hidden" name="_token" class="token-action" value="{{ csrf_token() }}">
                        <span class="col-md-1 hidden material-icons btn edit">mode_edit</span> 
                        <span class="col-md-1 hidden material-icons btn del">highlight_off</span> 
                    @endif

                </div>
            </div>
        </p>
    </p>
@endforeach
