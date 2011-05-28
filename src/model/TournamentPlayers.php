<?php
class TournamentPlayers {

  private $players;
  private $id;
  
  private $dao;
  private $tournDao;
  
  public function __construct() {
    $this->dao = new UserDao();
    $this->tournDao = new TournamentDao();
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
       $user->setId($data['id']);
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
  
  public function createTournamentGames() {
    $players = $this->getPlayers();
    
    //var_dump($players);
    
    // Mix Player
    shuffle($players);
    $matches = array();
    
    // Anzahl der Matches
    $matchCount = 0;
    $j = 1;
    for($i=1; $i <= count($players); $i++ ) {
      $matchCount += count($players)-$j;
      $j++;
    }
    
    $start = 0;
    $plus=1;
    for($i=0; $i < $matchCount; $i++ ) {
      if(($plus) >= count($players)) { $start++;  $plus = $start+1;  }
      $matches[$i] = array($players[$start]->getUser()->getId(), $players[$plus]->getUser()->getId(), 'open', 0, 0, $this->id, 0, 0);  
      $plus++;
    }
    
    $this->tournDao->startTournament($matches);
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