<?php

class IndexController extends BaseController {

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
}
