<div class="col-md-7">
    <h2>{{ $category->name }}</h2>
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

    @foreach ($books as $book)

        @foreach ($book->reviews as $review)

            @include ('layouts.review-item')

        @endforeach

    @endforeach
    
</div>
