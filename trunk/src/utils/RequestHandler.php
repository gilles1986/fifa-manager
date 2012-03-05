<?php
class RequestHandler {
	
	public function get($key="", $full=false) {
		if($key != "") {
			if(isset($_REQUEST)) {
				if(array_key_exists($key, $_REQUEST))
				return $_REQUEST[$key];
				else return "";	
			} else {
				return null;
			}						
		} else {
			if($full) {
				if(isset($_REQUEST)) {
					return $_REQUEST;
				} else {
					return null;
				}
			}
		}
	}
	
}
$req = new RequestHandler();
?>
