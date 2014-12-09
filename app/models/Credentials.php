<?php
/*This */
class Credentials extends Eloquent
    {   
	private static function url()
		{
			$staticURL = "https://192.168.0.2";
			return $staticURL;
		}

	private static function login()
        {
			$staticLogin = "root";
			return $staticLogin;
        }

	private static function password()
        {
            $staticPassword = "";
			return $staticPassword;
        }
    
    public static function loginXen()
        {
            /*Pull credentials from private function in the Credentials class*/
            $url = Credentials::url();
            $login = Credentials::login();
            $password = Credentials::password(); 

            /*Connect to xenserver via HTTPS and create session*/
            $xenserver = new XenApi($url, $login, $password);
        
            return $xenserver;
        }
    }

	
