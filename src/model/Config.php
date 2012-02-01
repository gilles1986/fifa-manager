<?php

class Config {
  private $configs = false;
  
    
  public function __construct() {
    $this->dao = new ConfigDao();
  }  
  
  
  public function save($name) {
    if($this->configs[$name]) {
      $this->dao->updateByName($this->name, $this->configs[$name]);
    } 
  }
  
  public function load() {
  if(!$this->configs) {
      $array = $this->dao->getConfig();
    Logger::debug("load Config: \r\n ".print_r($array, true), "Config");
      $this->configs = array();
      for($i=0; $i < count($array); $i++) {
        $this->configs[$array[$i]['name']] = $array[$i]['value'];
      }    
      Logger::debug("Config: \r\n".print_r($this->configs, true), "Config");  
    } else {
      return false;
    }
  }
  
  public function get($name) {
    Logger::debug("get $name: ".print_r($this->configs, true), "Config");
    if(!$this->configs) {
      Logger::debug("config is false", "Config");
      return false;
    }
    if($this->configs[$name]) {
      Logger::debug("return this: ".$this->configs[$name], "Config"); 
      return $this->configs[$name];
    } else return false;
  }
  
  public function set($name, $value) {
    if(!$this->configs) $this->configs = array();
    $this->configs[$name] = $value;   
  }
  
}


?>