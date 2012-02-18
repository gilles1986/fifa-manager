<?php 

class HomeController extends Controller {
  
  public function init() {
    $this->var->assign("title","Fifa Tournament Manager");
    $scripts = array("main", "home");
    // If logged in load the backend scripts too
    if(sh::get('loggedIn')) {
      array_push($scripts, "backend");  
    }
    $this->var->assign("scripts",$scripts);
    
    include_once SRC."model/User.php";
    include_once SRC."dao/UserDao.php";
    
    if(sh::get('error')) {
      Logger::debug("Setze Error Message: ".$_SESSION['error'], "HomeController");
      $this->var->assign("error", $_SESSION['error']);
      $_SESSION['error'] = null;
    }
    if(sh::get('user')) {
      $this->var->assign("user", unserialize($_SESSION['user']));
    }
  }
  
  public function home() {
    
    // Check if the database is connectable
    if(! MysqlDatabase::isConnectable(parse_ini_file(CONFIG."db.ini"))) {
      header("Location: index.php?action=noDb");
    }
    
    // Check if is installed
    $tournamentConfig = parse_ini_file(CONFIG."tournament.ini");
    if($tournamentConfig['installed'] != "true") {
      header("Location: index.php?action=installer");
    }
    if(sh::get('loggedIn')) $this->loadTable();
    
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
    $this->var->assign("tournament", $tourns->getTournaments());
    Logger::debug("loadTable: \r\n".print_r($tourns, true), "Home");
  }
  
  public function manager() {
    $this->loadTable();
    $this->show();
  }
  
  /**
   * Lädt das Benutzer Profil
   * 
   */
  public function profile() {
   $id = intval($_REQUEST['id']);
   $user = new User();
   $user->setId($id);
   $user->load();
   if($user->exists()) {
    $this->var->assign("profile", $user);
   } else {
    $this->var->assign("error", "user_profile_not_exist");
   }
   $this->show();
  }
  
  
  
}

?>