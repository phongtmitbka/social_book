<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href ="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <link href="{{ asset('https://fonts.googleapis.com/icon?family=Material+Icons') }}" rel="stylesheet">
    @yield('css')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Social book') }}</title>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Social book') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/home') }}">{{ trans('app.home') }}</a></li>
                        <li><a href="{{ url('/book') }}">{{ trans('app.book') }}</a></li>
                        <li><a href="#">{{ trans('app.rank') }}</a></li>
                    </ul>
                    <ul class="navbar-nav nav col-md-5">
                        <li class="navbar-form navbar-left">
                            <div class="input-group">
                                <input type="search" class="form-control" name="name" placeholder="{{ trans('app.search_member') }}" id="searchMember">
                                </br>
                                <div class="input-group-btn">
                                    <button class="btn btn-default" id="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li>
                                <a href="{{ route('login') }}">
                                    <span class="glyphicon glyphicon-log-in"></span> 
                                    {{ trans('app.login') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}">
                                    {{ trans('app.register') }}
                                </a>
                            </li>
                        @else
                            <li><a href="{{ route('member.show', Auth::user()->id) }}">
                                <span>
                                    <img src="{{ asset(Auth::user()->avatar) }}" id="avatar_header">
                                </span>
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('user.setting') }}">
                                            <i class="fa fa-gear fa-fw">
                                            </i> 
                                            {{ trans('app.setting') }}
                                        </a>
                                        <a href="{{ route('user.changePass') }}">
                                            <i class="fa fa-gear fa-fw"></i> 
                                            {{ trans('app.change_pass') }}
                                        </a>
                                        <a id="logout">
                                            <i class="fa fa-sign-out fa-fw">
                                            </i>
                                            @lang('app.logout')
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div id="content">
            @yield('content')
        </div>
            
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('bower_components/jquery/dist/jquery.js') }}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('ckeditor/ckeditor.js') }}" ></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    @yield('script')
</body>
</html>
