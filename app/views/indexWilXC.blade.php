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

<!--Build table for main page  -->
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Name</th>
	        <th>UUID</th>
		<th>vCPUs</th>
		<th>Memory</th>
		<th>Resident On</th>
		<th>HVM Boot Policy</th>
		<th>Power State</th>
		<th>Action</th>
            </tr>
        </thead>
        <tbody>

<?php /*Get all VM references from IndexController*/ ?>
<?php $vms = $xenserver->VM_get_all(); ?>
            
<!--Loop through each VM and get the parameter requested below-->
@foreach($vms as $vm)

        <?php /*Pull ALL params for a single VM along with variables for resident and powerstate*/ ?>
        <?php $allParams = $xenserver->VM_get_record($vm); ?>
            
        <?php /*Set residentOn variable for current VM ObjRef*/ ?>    
        <?php $residentOn = $allParams["resident_on"]; ?>
            
        <?php /*Set powerState variable for current VM ObjRef*/ ?>   
        <?php $powerState = $allParams["power_state"] ?>
        
        <?php /*Set hvmBootState variable for current VM ObjRef*/ ?>   
        <?php $hvmBootState = $allParams["HVM_boot_policy"] ?>
            
        <?php /*Check if a template to skip for now*/ ?>
        <?php $template = $xenserver->VM_get_is_a_template($vm); ?>
        
@if($template == '')     
        <tr>
                <td>{{ $allParams["name_label"] }}</td>
                <td><a href="/getVMInfoRef/{{ $vm }}">{{ $allParams["uuid"] }}</a></td>
                <td>{{ $allParams["VCPUs_max"] }}</td>
                
                <?php $megaByte = $allParams["memory_static_max"] / '1048576' ?>
                <td>{{ $megaByte }} MB</td>
            
<?php /*Check if a VM is on a host and display row approprialy with link*/ ?>            
@if($residentOn == 'OpaqueRef:NULL')
                <td>None</td>
@else
                <?php /*Create new instance with Credentials Model to get do a host.get_record on Host ObjRef */ ?>
                <?php $hostDetails = Credentials::loginXen()->host_get_record($residentOn); ?>
                <td><a href="/getHostInfoRef/{{ $allParams["resident_on"] }}">{{ $hostDetails["name_label"] }}</a></td>
@endif
                
                <td>{{ $hvmBootState }}</td>
                
                <td>{{ $powerState }}</td>
<?php /*Check power state from variable above anddisplay row approprialy with link*/ ?> 
@if($powerState == 'Halted')              
                <td><a href="/startVMRef/{{ $vm }}"class="btn btn-success btn-sm"> <i class="fa fa-play fa-fw"></i> Start VM</a></td>
@elseif($powerState == 'Running')
            <?php /*Check if HVM and Generate shorter Menu*/ ?>
            @if($hvmBootState =='BIOS order')
                <td>
                    <div class="btn-group dropdown">
                        <a class="btn btn-primary btn-sm" href="/getVMInfoRef/{{ $vm }}"><i class="fa fa-cog fa-spin fa-fw"></i> Ops</a>
                        <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="fa fa-caret-down"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/hardShutdownVMRef/{{ $vm }}"><i class="fa fa-ban fa-fw"></i> Force Shutdown</a></li>
                            <li><a href="/hardRebootVMRef/{{ $vm }}"><i class="fa fa-recycle fa-fw"></i> Force Reboot</a></li>
                            <li class="divider"></li>
                            <li><a href="/getVMInfoRef/{{ $vm }}"><i class="fa fa-gears fa-fw"></i> Properties</a></li>
                        </ul>
                    </div>
                </td>
            <?php /*Check if PV and Generate longer Menu*/ ?>
            @else
                <td>
                    <div class="btn-group dropdown">
                        <a class="btn btn-primary btn-sm" href="/getVMInfoRef/{{ $vm }}"><i class="fa fa-cog fa-spin fa-fw"></i> Ops</a>
                        <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="fa fa-caret-down"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/cleanShutdownVMRef/{{ $vm }}"><i class="fa fa-ban fa-fw"></i> Shutdown</a></li>
                            <li><a href="/suspendVMRef/{{ $vm }}"><i class="fa fa-pause fa-fw"></i> Suspend</a></li>
                            <li><a href="/cleanRebootVMRef/{{ $vm }}"><i class="fa fa-refresh fa-fw"></i> Reboot</a></li>
                            <li class="divider"></li>
                            <li><a href="/hardShutdownVMRef/{{ $vm }}"><i class="fa fa-flash fa-fw"></i> Force Shutdown</a></li>
                            <li><a href="/hardRebootVMRef/{{ $vm }}"><i class="fa fa-recycle fa-fw"></i> Force Reboot</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-camera fa-fw"></i> Take Snapshot</a></li>
                            <li class="divider"></li>
                            <li><a href="/getVMInfoRef/{{ $vm }}"><i class="fa fa-gears fa-fw"></i> Properties</a></li>
                        </ul>
                    </div>
                </td>
            @endif
                
@elseif($powerState == 'Suspended')
                <td>
                    <div class="btn-group dropdown">
                        <a class="btn btn-primary btn-sm" href="/resumeVMRef/{{ $vm }}"><i class="fa fa-pause fa-fw"></i> Ops</a>
                        <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="fa fa-caret-down"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/resumeVMRef/{{ $vm }}"><i class="fa fa-refresh fa-fw"></i> Resume</a></li>
                            <li class="divider"></li>
                            <li><a href="/hardShutdownVMRef/{{ $vm }}"><i class="fa fa-recycle fa-fw"></i> Force Shutdown</a></li>
                        </ul>
                    </div>
                </td>
@endif              
        </tr>
@endif


@endforeach

        </tbody>
    </table>

@stop