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

<?php /*Get all VM references from IndexController*/ ?> 
<?php $vms = $xenserver->VM_get_all(); ?>

<!--Build table for main page  -->
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Name</th>
	        <th>UUID</th>
		<th>VCPUs</th>
		<th>Memory</th>
		<th>Resident On</th>
		<th>HVM Boot Policy</th>
		<th>Power State</th>
		<th>Action</th>
	        <th>Action</th>
            </tr>
        </thead>
        <tbody>

<!--Loop through each VM and get the parameter requested below-->
@foreach($vms as $vm)

        <?php /*Pull ALL params for a single VM*/ ?>
        <?php $allParams = $xenserver->VM_get_record($vm); ?>
        
        <?php /*Check if a template to skip for now*/ ?>
        <?php $template = $xenserver->VM_get_is_a_template($vm); ?>
        
@if($template == '')     
        <tr>
                <td>{{ $allParams["name_label"] }}</td>
                <td><a href="/showParams/{{ $vm }}">{{ $allParams["uuid"] }}</a></td>
                <td>{{ $allParams["VCPUs_max"] }}</td>
                <td>{{ $allParams["memory_target"] }}</td>
                <td>{{ $allParams["resident_on"] }}</td>
                <td>{{ $allParams["HVM_boot_policy"] }}</td>
                <td>{{ $allParams["power_state"] }}</td>
                <td><a href="{{ action('IndexController@showIndex', $allParams["uuid"]) }}"class="btn btn-success"> <i class="fa fa-play fa-fw"></i> Start</a></td>
                <td><a href="{{ action('IndexController@showIndex', $allParams["uuid"]) }}" class="btn btn-danger"> <i class="fa fa-stop fa-fw"></i> Stop</a></td>
              
        </tr>
@endif


@endforeach

        </tbody>
    </table>

@stop
