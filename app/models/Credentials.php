<?php
class Credentials extends Eloquent
    {   
	public static function url()
		{
			$staticURL = "https://192.168.0.2";
			return $staticURL;
		}

	public static function login()
                {
			$staticLogin = "root";
			return $staticLogin;
                }

	public static function password()
                {
			$staticPassword = "";
			return $staticPassword;
                }
    }

	
