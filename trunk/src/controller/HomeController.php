<?php 

class HomeController extends Controller {
  
  public function init() {
    $this->var->assign("title","Super Seite");
    $scripts = array("main", "home");
    // If logged in load the backend scripts too
    if($_SESSION['loggedIn']) {
      array_push($scripts, "backend");  
    }
    $this->var->assign("scripts",$scripts);
    
    include_once SRC."model/User.php";
    include_once SRC."dao/UserDao.php";
    
    if($_SESSION['error']) {
      $this->var->assign("error", $_SESSION['error']);
      $_SESSION['error'] = null;
    }
    if($_SESSION['user']) {
      $this->var->assign("user", unserialize($_SESSION['user']));
    }
  }
  
  public function home() {
    // Check if is installed
    $tournamentConfig = parse_ini_file(CONFIG."tournament.ini");
    if($tournamentConfig['installed'] != "true") {
      header("Location: index.php?action=installer");
    }
    if($_SESSION['loggedIn']) $this->loadTable();
    
    $this->show();    
  }
  
  
  
  private function loadTable() {
    include_once SRC."model/Tournament.php";
    include_once SRC."model/TournamentGame.php";
    include_once SRC."model/TournamentOrder.php";
    include_once SRC."model/TournamentPlayer.php";
    include_once SRC."model/Tournaments.php";
    include_once SRC."dao/TournamentDao.php";
    
    $tourns = new Tournaments();
    $user = unserialize($_SESSION['user']);
    
    $tourns->loadByUserId($user->getId());
    Logger::debug("LOOL\r\n".print_r($tourns->getTournaments(), true), "HomeController");
    $this->var->assign("tournament", $tourns->getTournaments());
    Logger::debug("loadTable: \r\n".print_r($tourns, true), "Home");
  }
  
  public function manager() {
    $this->loadTable();
    $this->show();
  }
  
  
  
}

?>