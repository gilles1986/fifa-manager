<?php 

class ErrorController extends Controller {
  
  public function init() {
    
  }
  
  public function error404() {
    
    $this->show();
  }
  
  public function noDb() {
    
    $this->show();
  }
}


?>