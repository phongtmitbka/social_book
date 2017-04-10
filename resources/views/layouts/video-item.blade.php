<div class="panel panel-default">
    <div class="panel-heading">
        <a href="{{ route('video', $video->id) }}">
            <h2>
                {{ $video->caption }}
            </h2>
        </a>
        <h3>{{ trans('app.book') }}: {{ $video->book->title }}</h3>
        <h4>{{ trans('app.reviewer') }}: 
            <a href="{{ route('video', $video->id) }}" >{{ $video->user->name }}</a>
        </h4>
        <h5>{{ trans('app.review_date') }}: {{ $video->created_at }}</h5>   
    </div>
    <div class="panel-body">
        <iframe class="big-video-frame frame-border" src="{{ $video->stream_link }}" allowfullscreen>
        </iframe>                  
    </div>
</div>
