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
            /*Connect to xenserver via HTTPS and Credentials.php method*/
            $xenserver = Credentials::loginXen();
        
            /*return View::make('indexWilXC', compact('xenserver')); */
            /*return View::make('indexWilXC')->with('xenserver', $xenserver)->with('var',$var);*/
            return View::make('indexWilXC')->with('xenserver', $xenserver);
        }
}
