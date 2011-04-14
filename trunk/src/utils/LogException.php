<?php

class LogWarning extends Exception {
  
  public function __construct($message, $logname="Log") {
    Logger::warning($message, $logname);
    parent::__construct($message);
  }
  
}

class LogError extends Exception {
  
  public function __construct($message, $logname="Log") {
    Logger::error($message, $logname);
    parent::__construct($message);
  }
  
}

?>