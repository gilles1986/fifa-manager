<?php
class LeagueController extends Controller {
  
  
  public function init() {
    $this->var->assign("title","Fifa Tournament Manager");
    $scripts = array("main", "home");
    // If logged in load the backend scripts too
    if(sh::get('loggedIn')) {
      array_push($scripts, "backend");  
    }
    $this->var->assign("scripts",$scripts);
    
    include_once SRC."model/User.php";
    include_once SRC."dao/TeamDao.php";
    include_once SRC."model/Team.php";
    include_once SRC."model/Game.php";
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
  
  public function createLeague() {
     
     $player = array();
     
     $player1 = new Team();
     $player1->setName("Gilles");
     
     $player2 = new Team();
     $player2->setName("John");
     
     
     
       
     $game1 = new Game();
     $game1->setPlayer1($player1);
     $game1->setPlayer2($player2);
     
     
     $this->var->assign("game", $game1);
      
       
     $this->show();
  }
  
  
}


?>