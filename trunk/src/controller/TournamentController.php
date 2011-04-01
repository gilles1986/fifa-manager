<?php 

class TournamentController extends Controller {
  
  public function init() {
    include_once SRC."model/User.php";
    include_once SRC."model/Users.php";
    include_once SRC."dao/UserDao.php";
    include_once SRC."model/Tournament.php";
    include_once SRC."model/TournamentGame.php";
    include_once SRC."model/TournamentOrder.php";
    include_once SRC."model/TournamentPlayer.php";
    include_once SRC."model/Tournaments.php";
    include_once SRC."dao/TournamentDao.php";
  }
  
  public function showTournament() {
    $tournament = new Tournament();
    $tournament->loadById($_REQUEST['id']);
    $this->var->assign("tournament", $tournament);
    $this->show();
  }
  
  public function createTournament() {
    $this->show();
  }
  
  public function searchTournament() {
    $this->show();
  }
  
  public function doCreateTourn() {
    $tournament = new Tournament();
    
    if($_SESSION['user']) {
      $user = unserialize($_SESSION['user']);
      $user = $user->getId();
    } else {
      throw new Exception("create_error");
    }
    
    $tournament->setName($_REQUEST['tournName']);
    $tournament->setAutorid($user);
    $tournament->save();
    
    
    $this->redirect("index.php?action=manager");
  }
  
  public function addGame() {
    $this->show();
  }
  
  public function addPlayer() {
    $users = new Users();
    $users->loadUsers();
    $users = $users->getUsers();
    $this->var->assign("users", $users);
    
    $this->show();
  }
  
}

?>