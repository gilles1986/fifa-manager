<?php

/**
 * Abstract Class for controllers which can be extended by every controller
 * @author Gilles
 *
 */
abstract class Controller {
  
  protected $template;
  protected $var;
  protected $space;
  protected $view;
  
  public function __construct($templ, $conf) {
    Logger::debug("Template: ".print_r($templ, true)." \r\n Config: ".print_r($conf, true), "Controller");
    $this->template = $templ;
    $this->var = new Smarty();
    
    $this->var->template_dir = '../src/view/';
    $this->var->compile_dir = '../src/_compiled/';
    $this->var->config_dir = '../src/_smartyConfig/';
    
    $this->space = $conf['space'];
    $this->view = $conf['view'];
    $site = new Site();
    $this->var->assign("site", $site );
    
    $lang = ($_COOKIE['lang']) ? $_COOKIE['lang'] : "en";  
    $this->var->assign("lang", $lang);
    try {
      $this->init();
    } catch(Exception $e) {
      // Dont throw an error if init is not defined
    }
  }
  
  protected function show($template=false) {
    if($template == false) {
      $this->var->display(SRC."view/".$this->space."/".$this->view.".tpl");  
    } else {
      $this->var->display(SRC."view/".$template.".tpl");
    }
    
  }
  
  protected function redirect($location) {
    header("Location: ".$location);
  }
  
 
}

?>