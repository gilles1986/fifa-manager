<?php

class Teams {
  private $dao;
  
  private $teams;
  
  
  public function __construct() {
    $this->dao = new TeamDao();
  }  
  
  public function loadTeams()  {
    $this->teams = array();
    $teams = $this->dao->getTeams();
    for($i=0; $i < count($teams); $i++) {
      $team = new Team();
      $team->setName($teams[$i]['name']);
      $team->setId($teams[$i]['id']);
      array_push($this->teams, $team);
    }
  }
 
  

  public function getTeams()
  {
      return $this->teams;
  }

  public function setTeams($teams)
  {
      $this->teams = $teams;
  }
}


?>