<?php

class Main {


  public function __construct() {
    
    /*
     * Load Util Classes
     */
    include_once SRC."utils/Logger.php";
    include_once SRC."utils/Site.php";
    include_once SRC."utils/Controller.php";
    include_once SRC."utils/MysqlDatabase.php";
    include_once SRC."utils/IniWriter.php";
    include_once SRC."utils/FileUploader.php";
    include_once SRC."utils/LogException.php";
    include_once SRC."libs/Smarty.class.php";



    /*
     * Define Log
     */
    Logger::init();

    // Aktion auslesen
    Logger::info("Request ist ".print_r($_REQUEST, true), "System");
    Logger::debug("Action Name ist '".$_REQUEST['action']."'", "System");
    $action = ($_REQUEST['action']) ? $_REQUEST['action'] : "home";
    $actionsConf = parse_ini_file(CONFIG."action.ini");

    try {
      // Configs für Aktionen auslesen
      $contr = ($actionsConf[$action]) ? $actionsConf[$action] : "error404";
      $actionConf = json_decode(file_get_contents(CONFIG."actions.json"), true);

      if($actionConf == NULL) {
        Logger::warn("actions.json ist nicht valide", "System");
        die();
      }

      //Logger::debug(print_r($actionConf, true),"System");
      Logger::debug("Action: ".$contr, "System");

      // Existiert die Aktion?
      if($actionConf[$contr]) {
        $action = $actionConf[$contr];
        Logger::debug("Die Action $contr existiert", "System");
      } else {
        // Aktion existiert nicht.
        if($actionConf['error404']) {
          Logger::debug("Die Action $contr existiert nicht. 404 aufrufen", "System");
          $action = $actionConf['error404'];
          $contr = 'error404';
        } else {
          // error 404 Aktion existiert auch nicht
          die("<h1>Error</h1>
        <p>Die Seite ist defekt. Bitte kontaktieren sie den Admin</p>
        <p>The page won't work. Please contact the Admin</p>
        ");
        }
      }

      
      include_once SRC."controller/".$action['controller']."Controller.php";
      $className = $action['controller']."Controller";
    } catch (Exception $e) {
      echo $e->getMessage();
    }
    // Controller aufrufen
    try {
      Logger::debug("Objekt von $className erzeugen", "System");
      $obj = new $className($contr, $action);
      $obj->{$contr}();
    } catch (Exception $e) {
      echo "OHOH";
    }
    
    /*
    } catch(Exception $e) {
      echo "OH NO";
      //$obj = new ErrorController("error404",$actionConf['error404'] );
    }*/
  }

}

?>