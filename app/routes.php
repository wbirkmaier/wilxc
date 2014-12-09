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

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('test', function()

{
	echo getcwd() . "\n";
	echo 'Environment: '.App::environment().'<br>';
	$results = DB::select('SHOW DATABASES;');
	echo print_r($results);
	phpinfo();
}); 

Route::get('xen', function()
{
	/*Pull credentials from the Credentials class*/
	$url = Credentials::url();
	$login = Credentials::login();
	$password = Credentials::password(); 

	/*Connect to xenserver via HTTPS*/
	$xenserver = new XenApi($url, $login, $password);
	
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

	$vms_array = $xenserver->VM_get_all();

	echo '<pre>';
            print_r($vms_array);
        echo '</pre>';

	echo'	<table class="table table-striped">
        	<thead>
        	    	<tr>
                		<th>Name</th>
	        	        <th>UUID</th>
      		  	</tr>
	        </thead>
	<tbody>';
	
	foreach ($vms_array as $vm) 
        {
		$nameLabel = $xenserver->VM_get_name_label($vm);
		$uuid = $xenserver->VM_get_uuid($vm);
		$template = $xenserver->VM_get_is_a_template($vm);
		
		if ($template == '')
			{
				echo '<tr>';
               			echo '<td>';
					print_r($nameLabel);
				echo '</td>';

				echo '<td>';
	        		        print_r($uuid);
				echo '</td>';
        			echo '</tr>';
			}
	}

echo  '</tbody>
    </table>';



	foreach ($vms_array as $vm)
        {
            $uuids = $xenserver->VM_get_allowed_operations($vm);
                echo '<pre>';
                    print_r($uuids);
                echo '</pre>';
        }


	foreach ($vms_array as $vm) 
	{
	    $record = $xenserver->VM_get_record($vm);
		echo '<pre>';
		    print_r($record);
		echo '</pre>';
	}
});
