<?php

class VMDetailsController extends BaseController {

        /*Inherit __construct method from BaseController*/
	public function __construct()
        {
            parent::__construct();
        }
        
        /*Landing page for WilXC*/
       public function showIndex()
        {   
            	/*Pull credentials from the Credentials class*/
        	$url = Credentials::url();
	        $login = Credentials::login();
        	$password = Credentials::password(); 

	        /*Connect to xenserver via HTTPS*/
        	$xenserver = new XenApi($url, $login, $password);
        
                return View::make('indexWilXC', compact('xenserver'));
        }

    /*Get all the details on a VM based on UUID*/
    public function getAllInfoRef($vmRef) 
        {
      
	       /*Pull credentials from the Credentials class*/
	       $url = Credentials::url();
	       $login = Credentials::login();
	       $password = Credentials::password(); 

	       /*Connect to xenserver via HTTPS*/
	       $xenserver = new XenApi($url, $login, $password);
           $allDetails = $xenserver->VM_get_record($vmRef);
        
           return View::make('vmInfo', compact('allDetails'));
            
        }
    
}
