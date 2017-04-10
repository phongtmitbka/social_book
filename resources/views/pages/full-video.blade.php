<div class="col-md-7">
    <h2>{{ trans('app.all_video') }}</h2>
</div>
<!-- Item -->
<div class="col-md-5">
    <div class="input-group">
        <input type="search" class="form-control" name="caption" placeholder="{{ trans('app.search_video') }}" id="searchVideo">
        </br>
        <div class="input-group-btn">
            <button class="btn btn-default">
                <i class="glyphicon glyphicon-search"></i>
            </button>
        </div>
    </div>                        
</div>
<div class="list-group col-md-12" id="review_content">

    @foreach ($videos as $video)

        @include ('layouts.video-item')

    @endforeach
    
</div>
