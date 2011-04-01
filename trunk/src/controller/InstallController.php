<?php 

class InstallController extends Controller {
  
  public function init() { 
  }
  
  public function install() {
    // Check if is installed
    $tournamentConfig = parse_ini_file(CONFIG."tournament.ini");
    if($tournamentConfig['installed'] == "true") {
      header("Location: index.php");
    } else {
      $tournamentConfig['installed'] = "true";
      IniWriter::writeArray($tournamentConfig,CONFIG."tournament.ini");
      $this->show();
    }
    
  }
  
}


?>