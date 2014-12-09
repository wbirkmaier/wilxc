<?php

class VMDetailsController extends BaseController {

        /*Inherit __construct method from BaseController*/
	public function __construct()
        {
            parent::__construct();
        }  

    /*Get all the details on a VM based on UUID*/
    public function getAllInfoRef($vmRef) 
        {
      
           $allDetails = Credentials::loginXen()->VM_get_record($vmRef);
        
           return View::make('vmInfo', compact('allDetails'));
            
        }
    
}
