<?php

class DetailsController extends BaseController {

        /*Inherit __construct method from BaseController*/
	public function __construct()
        {
            parent::__construct();
        }  

    /*Get all the details on a VM based on UUID*/
    public function getVMInfoRef($vmRef) 
        {
      
           $allDetails = Credentials::loginXen()->VM_get_record($vmRef);
        
           return View::make('detailInfo', compact('allDetails'));
            
        }
    
    public function getHostInfoRef($hostRef)
        {
            $allDetails = Credentials::loginXen()->host_get_record($hostRef);
            return View::make('detailInfo', compact('allDetails'));
        }
    
}
