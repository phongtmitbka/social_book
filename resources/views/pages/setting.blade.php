@extends('layouts.app')

@section('content')
<div class="container custom-container">
    <div class="row carousel-holder">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <center class="panel-heading"><b>{{ trans('profile.title') }}</b></center>
                <div class="panel-body">
                    <div class="panel-body">
                    
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label>
                                {{ trans('profile.name') }}
                            </label>
                            <input type="text" value="{{ $user->name }}" class="form-control" placeholder="{{ trans('profile.message.name') }}" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>
                                {{ trans('profile.email') }}: {{ $user->email }}
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                {{ trans('profile.avatar') }}
                            </label>
                            <input type="file" name="avatar">
                        </div>
                        <div class="form-group">
                            <label>
                                {{ trans('profile.cover_photo') }}
                            </label>
                            <input type="file" name="photo_cover">
                        </div>
                        <div class="form-group">
                            <label class="radio-inline">
                            <input name="language" 
                                {{ ($user->language == 'en') ? 'checked' : ''}}
                                value="en" type="radio"> 
                                {{ trans('profile.english') }}
                        </label>
                        <label class="radio-inline">
                            <input name="language" 
                                {{ ($user->language == 'vi') ? 'checked' : ''}}
                                value="vi" type="radio">
                                {{ trans('profile.vietnamese') }}
                        </label>
                        </div>
                        <div class="form-group">
                            <label>
                                {{ trans('app.about') }}
                            </label>
                            <textarea class="form-control ckeditor" rows="10" name="about">
                                {{ $user->about }}
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{ trans('app.button.update') }}
                        </button>
                        <button type="reset" class="btn btn-default">
                            {{ trans('app.button.reset') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>
@endsection
