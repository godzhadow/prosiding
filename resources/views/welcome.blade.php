{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else

                    // comment here to remove login button
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    // end commment
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html> --}}


@extends('layouts.base')

@section('content')
<div class="container">

    {{-- <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as admin!
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Filter
                </div>
                <div class="card-body">
                    <form method="GET" action="/" id="formFilter">
                        {{-- @csrf --}}
                        <div class="row">
                            <div class="col-md-4">
                                    <select class="nice-select wide" name="year" id="year">
                                        <option value="" {{ $year == ""?'selected':'' }}>Year</option>
                                        <option value="2020" {{ $year == "2020"?'selected':'' }}>2020</option>
                                        <option value="2021" {{ $year == "2021"?'selected':'' }}>2021</option>
                                        <option value="2022" {{ $year == "2022"?'selected':'' }}>2022</option>
                                        <option value="2023" {{ $year == "2023"?'selected':'' }}>2023</option>
                                    </select>
                            </div>
                            <div class="col-md-4">
                                <select class="nice-select wide" name="country" id="country">
                                    <option value="" data-display="Country" {{ $country == ""?'selected':'' }}>Country</option>
                                    <option value="australia" {{ $country == "australia"?'selected':'' }}>Australia</option>
                                    <option value="indonesia" {{ $country == "indonesia"?'selected':'' }}>Indonesia</option>
                                    <option value="philipine" {{ $country == "philipine"?'selected':'' }}>Philipine</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Search .." value="{{ $search }}" onfocus="var value = this.value; this.value = null; this.value = value;">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($paper as $p)
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <a href="/abstract/{{$p->id}}">
                        <div class="row">
                            <div class="col-md-9">
                                <h6>{{$p->title}}</h6>
                                <p>{{$p->team}}</p>
                                <p>{{$p->year}}</p>
                            </div>
                            <div class="col-md-3">
                                @if ($p->preview !=null)
                                    <img width="150px" src="{{ url($p->preview) }}">
                                @else
                                    <i class="fa fa-file-pdf fa-3x text-danger"></i>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script>
    window.onload = function(){
        document.getElementById('search').focus();
    }
    var select = document.getElementById('year');
    select.onchange = function(){
        this.form.submit();
    };
    var select = document.getElementById('country');
    select.onchange = function(){
        this.form.submit();
    };
    // var search = document.getElementById('search');
    // search.addEventListener("keyup", function() {
    //     this.form.submit();
    // })
    var search = document.getElementById('search');
    var timeout = null;
    var formFilter = document.getElementById('formFilter');

    search.addEventListener("keyup", function (e) {
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            formFilter.submit();
        }, 1000);
    });

</script>
@endsection

