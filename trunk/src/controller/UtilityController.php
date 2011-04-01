<?php 

class UtilityController extends Controller {
  
  public function init() {
    
  }
  
  public function language() {
    $lang = $_REQUEST['language'];
    if($lang) {
      $ini =  parse_ini_file(CONFIG."tournament.ini", true);
      $langs = explode(",",$ini['languages']);
      if(in_array($lang, $langs)) setcookie("lang", $lang);      
    }
    Logger::debug("Ist Language gesetzt? ".$lang , "System");
    header("Location: index.php");
  }
}


?>