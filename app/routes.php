<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*Main Route for Dashboard */
Route::get('/', 'IndexController@showIndex');

Route::get('/getVMInfoRef/{vmRef}', 'DetailsController@getVMInfoRef');

Route::get('/getHostInfoRef/{hostRef}', 'DetailsController@getHostInfoRef');

/*Operations on VMs Route*/
Route::get('/startVMRef/{vmRef}', 'OperationsController@startVMRef');
Route::get('/cleanShutdownVMRef/{vmRef}', 'OperationsController@cleanShutdownVMRef');
Route::get('/suspendVMRef/{vmRef}', 'OperationsController@suspendVMRef');
Route::get('/cleanRebootVMRef/{vmRef}', 'OperationsController@cleanRebootVMRef');

/*Default catch all view for wrong routes*/
App::missing(function($exception)
{
        return View::make('oops');
});










/* Crap Routes for Testing */
Route::get('test', function()

{
	echo getcwd() . "\n";
	echo 'Environment: '.App::environment().'<br>';
	$results = DB::select('SHOW DATABASES;');
	echo print_r($results);
	phpinfo();
}); 

/* For Testing Xen API */
Route::get('xen', function()
{
    
    /*Classes, Fields and Messages
    Classes have both fields and messages. Messages are either implicit or explicit where an implicit message is one of:

    a constructor (usually called "create");
    a destructor (usually called "destroy");
    "get_by_name_label";
    "get_by_uuid"
    "get_record"; and
    "get_all".
    Explicit messages include all the rest, more class-specific messages (e.g. "VM.start", "VM.clone")

    Every field has at least one accessor depending both on its type and whether it is read-only or read-write. Accessors for a field named "X" would be    a proper subset of:

    set_X: change the value of field X (only if it is read-write);
    get_X: retrieve the value of field X;
    add_to_X: add a key/value pair (only if field has type set or map); and
    remove_from_X: remove a key (only if a field has type set or map). 
    */

    /*Get all VM references*/
	$vms_array = Credentials::loginXen()->VM_get_all();
    
    /*Get all Host references*/
    $hosts_array = Credentials::loginXen()->host_get_all();
    echo '<pre>';
            print_r($hosts_array);
        echo '</pre>';
        
    /*    $vm = 'OpaqueRef:dc5849a0-0677-0c22-1e67-27bf2939e9fa';
        Credentials::loginXen()->VM_start($vm, False, True); */

    /* Need to speed up page 
	echo'	<table class="table table-striped">
        	<thead>
        	    	<tr>
                		<th>Name</th>
	        	        <th>UUID</th>
				<th>Power State</th>
				<th>VCPUs</th>
				<th>Memory</th>
				<th>Resident On</th>
				<th>HVM Boot Policy</th>
				<th>VIFs</th>
      		  	</tr>
	        </thead>
	<tbody>';
	
	
	
	foreach ($vms_array as $vm) 
        {	
    
                $allParams = Credentials::loginXen()->VM_get_record($vm);
                
	
		$nameLabel = $allParams["name_label"];
		$uuid = $allParams["uuid"];
		$powerState = $allParams["power_state"];
		$vCPUsMax = $allParams["VCPUs_max"];
		$memoryTarget = $allParams["memory_target"];
		$residentOn = $allParams["resident_on"];
		$HVMBootPolicy = $allParams["HVM_boot_policy"];
		$VIFs = $allParams["VIFs"];
        	
	
		$template = Credentials::loginXen()->VM_get_is_a_template($vm);
		
	
		if ($template == '')
			{
				echo '<tr>';
				
               			echo '<td>';
					print_r($nameLabel);
				echo '</td>';

				echo '<td>';
	        		        print_r($uuid);
				echo '</td>';

				echo '<td>';
                                        print_r($powerState);
                                echo '</td>';
                                
                      		echo '<td>';
                                        print_r($vCPUsMax);
                                echo '</td>';
                                
                                echo '<td>';
                                        print_r($memoryTarget);
                                echo '</td>';
                                
                                echo '<td>';
                                        print_r($residentOn);
                                echo '</td>';
                                
                                echo '<td>';
                                        print_r($HVMBootPolicy);
                                echo '</td>';
                                
                                echo '<td>';
                                        print_r($VIFs);
                                echo '</td>';
      
        			echo '</tr>';
			}
	}

echo  '</tbody>
    </table>';


        echo '<pre>';
            print_r($vms_array);
        echo '</pre>';


	foreach ($vms_array as $vm)
        {
            $uuids = Credentials::loginXen()->VM_get_allowed_operations($vm);
                echo '<pre>';
                    print_r($uuids);
                echo '</pre>';
        }


	foreach ($vms_array as $vm) 
	{
	    $record = Credentials::loginXen()->VM_get_record($vm);
		echo '<pre>';
		    print_r($record);
		echo '</pre>';
	}
    
    */
});

	/* Once sucessfully logged in - any method (valid or not) is passed to the XenServer.
	Replace the first period (.) of the method with a underscore (_) - because PHP doesnt like 
	periods in the function names.
	All the methods (other then logging in) require passing the session_id as the first parameter,
	however this is done automatically - so you do not need to pass it.
	For example, to do VM.get_all(session_id) and get all the vms as an array, then get/print the details of each
	using VM.get_record(session_id, self) (self = VM object):

	For parameters/usage, check out:
            http://docs.vmd.citrix.com/XenServer/5.5.0/1.0/en_gb/api/docs/html/browser.html
        To see how parametes are returned, print_r() is your friend :)
        */
