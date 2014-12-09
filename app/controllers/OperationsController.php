<?php

class OperationsController extends BaseController {

        /*Inherit __construct method from BaseController*/
	public function __construct()
        {
            parent::__construct();
        }  

    /*Start a: VM, paused, forced*/
    public function startVMRef($vmRef) 
        {
            Credentials::loginXen()->VM_start($vmRef, False, True);
            return Redirect::to('/')->with('flashBanner', 'VM Started');
        }
    
    public function stopVMRef($vmRef) 
        {
            Credentials::loginXen()->VM_clean_shutdown($vmRef);
            return Redirect::to('/')->with('flashBanner', 'VM Clean Shutdown');
        }
}
