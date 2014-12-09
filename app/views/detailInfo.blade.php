@extends('_master')

@section('active')

    <!-- Generate dynamic menu base on URL and Login Status -->
    @if (Auth::check())
        <li><a href="{{ action('IndexController@showIndex') }}"> <i class="fa fa-cogs"></i> Customize</a></li>
        <li><a href="{{ action('IndexController@showIndex') }}"> <i class="fa fa-sign-out"></i> Logout</a></li>
    @else
        <li class="active"><a href="{{ action('IndexController@showIndex') }}"> <i class="fa fa fa-cogs"></i> xen1.bur</a></li>
        <li><a href="{{ action('IndexController@showIndex') }}"> <i class="fa fa fa-cogs"></i> xen2.bur</a></li>
        <li><a href="{{ action('IndexController@showIndex') }}"> <i class="fa fa-sign-in"></i> Login</a></li>
        <li><a href="{{ action('IndexController@showIndex') }}"> <i class="fa fa-keyboard-o"></i> Register</a></li>
    @endif

@stop

@section('content')

    <a href="{{ action('IndexController@showIndex') }}" class="btn btn-success"><i class="fa fa fa-reply"></i> Return</a>

    <br>
    
    <div style="text-align: left">
    
        <?php /*Get all VM references from VMDetailsController*/ ?> 
        <pre><?php print_r ($allDetails) ?></pre>
    </div>


@stop
