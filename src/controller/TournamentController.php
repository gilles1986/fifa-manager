<?php 

class TournamentController extends Controller {
  
  public function init() {
    include_once SRC."model/Config.php";
    include_once SRC."dao/ConfigDao.php";
    include_once SRC."model/User.php";
    include_once SRC."model/Users.php";
    include_once SRC."dao/UserDao.php";
    include_once SRC."dao/TeamDao.php";
    include_once SRC."model/Tournament.php";
    include_once SRC."model/TournamentGame.php";
    include_once SRC."model/TournamentOrder.php";
    include_once SRC."model/TournamentPlayer.php";
    include_once SRC."model/TournamentPlayers.php";
    include_once SRC."model/Tournaments.php";
    include_once SRC."model/Team.php";
    include_once SRC."model/Teams.php";
    include_once SRC."dao/TournamentDao.php";
    if($_SESSION['user']) {
      $this->var->assign("user", unserialize($_SESSION['user']));
    }
  }
  
  public function showTournament() {
    if(intval($_REQUEST['id']) > 0) {
      $tournament = new Tournament();
      $tournament->loadById(intval($_REQUEST['id']));
      $tournamentPlayers = new TournamentPlayers();
      $tournamentPlayers->setId(intval($_REQUEST['id']));
      $tournamentPlayers->load();
      $this->var->assign("players", $tournamentPlayers->getPlayers());
      $this->var->assign("tournament", $tournament);
      $players = $tournamentPlayers->getPlayers();
      $user = unserialize($_SESSION['user']);
      
      if($_REQUEST['message']) $this->var->assign("message", $_REQUEST['message']);
      
      // Creator of Tournament
      $createPlayer = new User;
      $createPlayer->setId($tournament->getAutorid());
      $createPlayer->load();
      $this->var->assign("createUser", $createPlayer);
      
      $teams = new Teams();
      $teams->loadTeams();
      Logger::debug("teams: ".print_r($teams->getTeams(), true),"TournamentController");
      $this->var->assign("user",$user);
      $this->var->assign("teams", $teams->getTeams());
      
      for($i=0; $i < count($players); $i++) {
        $player = $players[$i]->getUser();
        if($player->getNickname() == $user->getNickname() && $tournament->getStatus() == "open") {
          Logger::debug("ChooseTeam: \r\n".print_r($user, true), "TournamentController");
          $this->var->assign("userid", $user->getId());
          $this->var->assign("teamField", true);  
        }
      }
      
      $this->show();
    } else {
      $this->redirect("Home/Home");
    }
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
    Logger::debug("addPlayer", "TournamentController");
    $tournId = intval($_REQUEST['id']) | intval($_REQUEST['tourn']);
    
    $freeUsers = new Users();
    $freeUsers->loadFreeUsersByTourn($tournId);
    
    $takenUsers = new Users();
    $takenUsers->loadUsersByTourn($tournId);
    
    $this->var->assign("tournId", $tournId);
    $this->var->assign("takenUsers", $takenUsers->getUsers());
    $this->var->assign("freeUsers", $freeUsers->getUsers());
    
    $this->show();
  }
  
  public function doAddPlayer() {
    Logger::debug("doAddPlayer", "TournamentController");
    $userId = intval($_REQUEST['user']);
    $tournId = intval($_REQUEST['tourn']);
    
    Logger::info(print_r($_REQUEST, true), "TournamentController");
    
    $tournPlayer = new TournamentPlayer();
    $tournPlayer->setPlayerid($userId);
    $tournPlayer->setTournid($tournId);
    try {
      Logger::debug("Spieler zu Turnier hinzufügen", "TournamentController");
      $tournPlayer->save();
      $this->var->assign("message","add_player_message_succ");      
    } catch(LogWarning $e) {
      $this->var->assign("message","add_player_message_err");
    }

    $this->addPlayer();
  }
  
  public function chooseTeam() {
    Logger::debug("chooseTeam::\r\n".print_r($_REQUEST, true), "TournamentController");
    $tournPlayer = new TournamentPlayer();
    $tournPlayer->setPlayerid($_REQUEST['playerId']);
    $tournPlayer->setTournid($_REQUEST['tournId']);
    $tournPlayer->load();
    $tournPlayer->setTeam($_REQUEST['teamname']);
    $tournPlayer->save();
    $this->redirect("?action=showtournament&id=".$tournPlayer->getTournid());
  }
  
  public function startTourn() {
    Logger::debug("startTourn::\r\n".print_r($_REQUEST, true), "TournamentController");
    $tournId = intval($_REQUEST['id']);
    $tourn = new Tournament;
    $tourn->setId($tournId);
    $tourn->load();
    $tourn->setStatus("started");
    try {
      $user = unserialize($_SESSION['user']);
      if($user->getId() != $tourn->getAutorid()) throw new LogWarning("Insufficient Permission"); 
      $tourn->save();
      $tournplayer = new TournamentPlayers();
      $tournplayer->setId($tourn->getId());
      $tournplayer->load();
      $tournplayer->createTournamentGames();
      $message = "start_tourn";
    } catch(LogWarning $e) {
      $message = "start_tourn_error";
    }
    $this->redirect("?action=showtournament&id=".$tourn->getId()."&message=$message");
  }
  
  public function stopTourn() {
    Logger::debug("stopTourn::\r\n".print_r($_REQUEST, true), "TournamentController");
    $tournId = intval($_REQUEST['id']);
    $tourn = new Tournament;
    $tourn->setId($tournId);
    $tourn->load();
    $tourn->setStatus("open");
    try {
      $tourn->save();
      $message = "stop_tourn";
    } catch(LogWarning $e) {
      $message = "stop_tourn_error";
    }
    $this->redirect("?action=showtournament&id=".$tourn->getId()."&message=$message");
  }
  
  public function deleteTourn() {
    Logger::debug("deleteTourn", "TournamentController");
    $tournId = intval($_REQUEST['id']);
    $tourn = new Tournament;
    $tourn->setId($tournId);
    $tourn->load();
    
    $config = new Config();
    $config->load();
    
    try {
      $user = unserialize($_SESSION['user']);
      Logger::debug("User Rolle: ".$user->getRole().", und Config Rolle: ".$config->get("delete_role"), "TournamentController");
      if($user->getId() != $tourn->getAutorid() && $user->getRole() < $config->get("delete_role")) throw new LogWarning("Insufficient Permission"); 
      $tourn->delete();
            
    } catch(LogWarning $e) {
      $message = "start_tourn_error";
    }
    $this->redirect("?action=manager");
  }
  
  public function doDeletePlayer() {
    Logger::debug("doDeletePlayer", "TournamentController");
    $userId = intval($_REQUEST['user']);
    $tournId = intval($_REQUEST['tourn']);
    
    Logger::info(print_r($_REQUEST, true), "TournamentController");
    
    $tournPlayer = new TournamentPlayer();
    $tournPlayer->setPlayerid($userId);
    $tournPlayer->setTournid($tournId);
    try {
      Logger::debug("Spieler vom Turnier entfernen", "TournamentController");
      $tournPlayer->delete();
      $this->var->assign("message","delete_player_message_succ");      
    } catch(LogWarning $e) {
      $this->var->assign("message","delete_player_message_err");
    }

    $this->addPlayer();
  }
}

?>