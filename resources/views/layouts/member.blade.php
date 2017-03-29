<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            <a href="{{ route('member.show', $member->id) }}">
                {{ $member->name }}
            </a>
        </h3>
        <h4>
            {{ trans('app.number_review') }} {{ $member->reviews->count() }}
        </h4>
    </div>
    <div class="panel-body">
        <div class="col-md-4">
            <a href="{{ route('member.show', $member->id) }}">
                <img class="img-thumbnail avatar" src="{{ asset($member->avatar) }}" alt="{{ $member->name }}">
            </a>
        </div>
        <div class="col-md-8">
            <h3>{{ trans('app.about') }} {{ $member->name }}</h3>
            <p>
                {!! str_limit($member->about, $limit = config('view.limit_about'), $end = '...') !!}
            </p>
            <br>
        </div>                          
    </div>
</div>
