<?php
class TournamentPlayer {

  private $id;
  private $playerid;
  private $tournid;
  private $wins;
  private $loss;
  private $ties;
  private $team;
  private $points;
  
  private $dao;
  private $user;
  private $teamObj;

  public function __construct() {
    $this->dao = new TournamentDao();
    $this->teamObj = new Team();
  }

  public function save() {
    Logger::debug("save::\r\nplayerid: ".$this->playerid."\r\ntournid: ".$this->tournid."\r\nid: ".$this->id."\r\nteam: ".$this->team , "TournamentPlayer");
    if($this->playerid > 0 && $this->tournid > 0 && $this->id < 1) {
      Logger::debug("save::insert");
      if($this->dao->insertTournamentPlayer($this->playerid, $this->tournid) == false) {
        throw new LogWarning("Konnte keinen Benutzer hinzufügen", "TournamentPlayer");
      } else if($this->playerid > 0 && $this->tournid > 0 && $this->id > 0){
        
      }
    } else if($this->playerid > 0 && $this->tournid > 0 && $this->id > 0){
        Logger::debug("save::update!!!\r\n".print_r($this, true), "TournamentPlayer");
        $this->dao->updateTournamentPlayer($this->id, $this->playerid, $this->tournid, $this->wins, $this->loss, $this->ties, $this->team);
    }
  }
  
  public function delete() {
    if($this->playerid > 0 && $this->tournid > 0) {
      if($this->dao->deleteTournamentPlayer($this->playerid, $this->tournid) == false) {
        throw new LogWarning("Konnte Benutzer nicht entfernen", "TournamentPlayer");
      } 
    } 
    
  }
  
  public function load() {
    if($this->id > 0) {
      $this->loadById();
    } else if($this->playerid > 0 && $this->tournid > 0){
      Logger::debug("load!!", "TournamentPlayer");
      $this->loadByIds();
    } else {
      return false;
    }
  }
  
  private function loadById() {
    Logger::debug("loadById:: ".$this->id,"TournamentPlayer");
    $user = $this->dao->getTournPlayerById($this->id);
    $this->id = $user['id'];
    $this->loss = $user['loss'];
    $this->wins = $user['wins'];
    $this->ties = $user['ties'];
    $this->points = $user['points'];
    $this->tournid = $user['tournid'];
    $this->playerid = $user['playerid'];
    $this->team = $user['team'];  
    $this->teamObj = new Team();
    $this->teamObj->setId($this->team);
    $this->teamObj->load();   
    
  }
  
  public function loadUser() {
    if($this->playerid > 0) {
      $this->user = new User();
      $this->user->setId($this->playerid);
      $this->user->load();           
    }
  }
  
  private function loadByIds() {
    Logger::debug("loadByIds:: ","TournamentPlayer");
    $user = $this->dao->getTournPlayerByIds($this->playerid, $this->tournid);
    $this->id = $user['id'];
    $this->loss = $user['loss'];
    $this->wins = $user['wins'];
    $this->ties = $user['ties'];
    $this->tournid = $user['tournid'];
    $this->playerid = $user['playerid'];
    $this->team = $user['team'];
    $this->teamObj = new Team();
    $this->teamObj->setId($this->team);
    $this->teamObj->load();
  }


  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getPlayerid()
  {
    return $this->playerid;
  }

  public function setPlayerid($playerid)
  {
    $this->playerid = $playerid;
  }

  public function getTournid()
  {
    return $this->tournid;
  }

  public function setTournid($tournid)
  {
    $this->tournid = $tournid;
  }

  public function getWins()
  {
    return $this->wins;
  }

  public function setWins($wins)
  {
    $this->wins = $wins;
  }

  public function getLoss()
  {
    return $this->loss;
  }

  public function setLoss($loss)
  {
    $this->loss = $loss;
  }

  public function getTies()
  {
    return $this->ties;
  }

  public function setTies($ties)
  {
    $this->ties = $ties;
  }

  public function getTeam()
  {
    return $this->team;
  }

  public function setTeam($team)
  {
    $this->team = $team;
  }
  
  


  public function getUser()
  {
      return $this->user;
  }

  public function setUser($user)
  {
      $this->user = $user;
  }

  public function getPoints()
  {
      return $this->points;
  }

  public function setPoints($points)
  {
      $this->points = $points;
  }

  public function getTeamObj()
  {
      return $this->teamObj;
  }

  public function setTeamObj($teamObj)
  {
      $this->teamObj = $teamObj;
  }
}

?>