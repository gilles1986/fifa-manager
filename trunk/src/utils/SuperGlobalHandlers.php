<?php

abstract class SuperGlobalHandler {
  public static function getVar($var ,$key="", $full=false) {
    if($key != "") {
      if(isset($var)) {
        if(array_key_exists($key, $var))
        return $var[$key];
        else return ""; 
      } else {
        return null;
      }           
    } else {
      if($full) {
        if(isset($var)) {
          return $var;
        } else {
          return null;
        }
      }
    }
  }
}

class RequestHandler extends SuperGlobalHandler {
	public static function get($key="", $full=false) {
		$var = (isset($_REQUEST)) ? $_REQUEST : null;  
		return parent::getVar($var , $key, $full);
	}
}

class CookieHandler extends SuperGlobalHandler {
  public static function get($key="", $full=false) {
    $var = (isset($_COOKIE)) ? $_COOKIE : null;  
    return parent::getVar($var , $key, $full);
  }
}

class SessionHandler extends SuperGlobalHandler {
  public static function get($key="", $full=false) {
    $var = (isset($_SESSION)) ? $_SESSION : null;  
    return parent::getVar($var , $key, $full);
  }
}

class sh extends SessionHandler{}

class rh extends RequestHandler { 
}

class ch extends CookieHandler { 
}

?>
