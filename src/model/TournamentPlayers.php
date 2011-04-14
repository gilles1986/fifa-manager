<?php
class TournamentPlayers {

  private $players;
  private $id;
  
  private $dao;
  
  public function __construct() {
    $this->dao = new UserDao();
  }
  
  public function load() {
    Logger::debug("load::\r\n".print_r($this, true), "TournamentPlayers");
    if($this->id) {
      $this->players = array();
     $users = $this->dao->getFullUsersByTournamentId($this->id);
     for($i=0; $i < count($users); $i++) {
       $data = $users[$i];
       $player = new TournamentPlayer();
       $player->setPlayerid($data['id']);
       $player->setLoss($data['loss']);
       $player->setWins($data['wins']);
       $player->setTies($data['ties']);
       $player->setPoints($data['points']);
       $player->setTeam($data['team']);
       $teamObj = new Team();
       $teamObj->setId($player->getTeam());
       $teamObj->load();
       $player->setTeamObj($teamObj);
       
       $user = new User();
       $user->setAvatar($data['avatar']);
       $user->setUsername($data['name']);
       $user->setNickname($data['nickname']);
       
       $player->setUser($user);
       
       array_push($this->players, $player);
       Logger::debug("Folgende Spieler wurden geladen: ".print_r($this->players, true), "TournamentPlayers");
     }
     
    }
  }

  
  public function getPlayers()
  {
      return $this->players;
  }

  public function setPlayers($players)
  {
      $this->players = $players;
  }
  

  public function getId()
  {
      return $this->id;
  }

  public function setId($id)
  {
      $this->id = $id;
  }
  


}

?>