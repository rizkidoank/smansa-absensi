@extends('layout.master')
@section('head')

@stop
@section('content')
    <div class="container">
        <div class="col-md-4 col-md-offset-4">
            <div id="login-panel" class="panel panel-default animated fadeInDown">
                <div class="panel-heading">
                    <h3 class="panel-title">@yield('title')</h3>
                </div>
                <div class="panel-body">
                    @yield('form')
                </div>
            </div>
        </div>
    </div>
@stop