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
     
     $player3 = new Team();
     $player3->setName("Jack");
     
     $player4 = new Team();
     $player4->setName("Forter");
     
     $players = array($player1,$player2, $player3, $player4);
     $games = array();
     
     for($spieler1 = 0; $spieler1 < count($players); $spieler1++) {
       for($spieler2 = ($spieler1+1); $spieler2 < count($players); $spieler2++) {
        $game = new Game();
        $game->setPlayer1($players[$spieler1]);
        $game->setPlayer2($players[$spieler2]);
        array_push($games, $game);  
       }
       
     }
     
     shuffle($games);
     
     $this->var->assign("games", $games);
       
       
     $this->show();
  }
  
  
}


?>