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
    include_once SRC."libs/Smarty.class.php";



    /*
     * Define Log
     */
    Logger::init();

    // Aktion auslesen
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

      Logger::debug(print_r($actionConf, true),"System");
      Logger::debug("Action: ".$contr, "System");

      // Existiert die Aktion?
      if($actionConf[$contr]) {
        $action = $actionConf[$contr];
      } else {
        // Aktion existiert nicht.
        if($actionConf['error404']) {
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