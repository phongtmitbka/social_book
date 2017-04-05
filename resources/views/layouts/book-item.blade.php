<div class="col-md-3 col-xs-12 col-sm-6">
    <div class="product-image-wrapper polaroid">
        <div class="productinfo text-center margin-top">
            <div class="saishou">
                <a href="">
                    <img name="image" src="{{ $book->image }}" title="{{ $book->title }}"/>
                </a>
            </div>
            <div class="saigo" style="display: none">
                <a href="" class="margin btn btn-custom btn-success green">
                    <i class="fa fa-book fa-fw"></i>@lang('sidebar.show')
                </a>
                <a href="{{ route('review.createReview', $book->id) }}" class="btn btn-custom btn-success green">
                    <i class="fa fa-pencil fa-fw"></i>@lang('sidebar.review')
                </a>
            </div>
            <h2>{{ $book->price }}</h2>
            <h4 class="oneline">{{ $book->title }}</h4>
            <h5>{{ $book->author }}</h5>
            <h6>{{ $book->publish_date }}</h6>
        </div>
    </div>
</div>
