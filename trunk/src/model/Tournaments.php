<?php

class Tournaments {
  private $tournaments = array();
  private $dao;
  
  
  public function __construct() {
    $this->dao = new TournamentDao();
  }
  
  public function load() {
    $this->tournaments = array();
    $tournaments = $this->dao->loadTournaments();
    for($i=0; $i < count($tournaments); $i++) {
      $tournament = new Tournament();
      $tournament->setId($tournaments[i]['id']);
      $tournament->setName($tournaments[i]['name']);
      $tournament->setStatus($tournaments[i]['status']);
      $tournament->setWinner($tournaments[i]['winner']);
      array_push($this->tournaments, $tournament); 
    }
  }
  
  
  public function loadByUserId($id) {
    $this->tournaments = array();
    $tournaments = $this->dao->loadTournamentsByUserId($id);
    Logger::debug(print_r($tournaments, true), "Tournaments");
    for($i=0; $i < count($tournaments); $i++) {
      Logger::debug("LoadByUser::$i", "Tournaments");
      $tournament = new Tournament();      
      $tournament->setId($tournaments[$i]['id']);
      $tournament->setName($tournaments[$i]['name']);
      $tournament->setStatus($tournaments[$i]['status']);
      $tournament->setWinner($tournaments[$i]['winner']);
      array_push($this->tournaments, $tournament); 
    }
    
  }
  
  public function getTournaments()
  {
      return $this->tournaments;
  }

  public function setTournaments($tournaments)
  {
      $this->tournaments = $tournaments;
  }
}

?>