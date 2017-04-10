@extends('layouts.app')

@section('content')
<div class="container custom-container">
    <div class="col-md-12">
        <div class="col-md-3">
            <img class="img-reponsive thumbnail avatar" src="{{ asset($member->avatar) }}">
            <ul class="list-group">
                <li class="list-group-item">
                    <label>{{ $member->name }}</label>
                </li>
                <li class="list-group-item">
                    <h5>
                        <label>{{ trans('app.email') }}</label>
                    </h5>
                    {{ $member->email }}
                </li>
                <li class="list-group-item">
                    <label>{{ trans('app.number_review') }}</label> 
                    {{ $member->reviews->count() }}
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <img class="img-reponsive thumbnail col-md-12 photo-cover" src="{{ asset($member->photo_cover) }}" alt="photo cover">
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-header">
                    <a class="navbar-brand btn" href="{{ route('member.show', $member->id) }}">
                        {{ trans('app.time_line') }}
                    </a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ route('member.about', $member->id) }}">
                                {{ trans('app.about') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('member.showVideo', $member->id) }}">
                                {{ trans('app.video') }}
                                <small class="total"> {{ $numberVideos }}</small>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('member.favorites', $member->id) }}">
                                {{ trans('app.favorite') }}
                                <small class="total">{{ $numberFavorites }}</small>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('member.following', $member->id) }}">
                                {{ trans('app.following') }}
                                <small class="total"> {{ $member->followers->count() }}</small>
                            </a>
                        </li>
                        <li class="follow-status">
                            @include('layouts.follow')
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="col-md-9" id="profile_content">

        @yield ('profile_content')
        
    </div>
    <div class="col-md-3">

        @include('profiles.following-menu')
        
    </div>
</div>
@endsection
