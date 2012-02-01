<?php

  class Tournament {
    private $id;
    private $name;
    private $status;
    private $winner;
    private $autorid;
    
    private $dao;
    private $players; 
    
    public function __construct() {
      $this->dao = new TournamentDao();
    }
    
    public function load() {
      if($this->id > 0) {
        $this->loadById($this->id);
      }
    }
    
    public function loadById($id) {
      $res = $this->dao->loadTournamentById($id);
      $this->id = $res['id'];
      $this->name = $res['name'];
      $this->status = $res['status'];
      $this->winner = $res['winnerid'];
      $this->autorid = $res['autorid'];
    }
    
    
    public function save() {
      if($this->id && $this->id > 0) {
        if(!$this->dao->updateTournament($this->id, $this->name, $this->status, $this->autorid, $this->winner)) throw new LogWarning("tourn_update_error");
      } else {
        if($this->name != "") {
          Logger::debug("Add new Tournament", "Tournament");
          if(!$this->dao->insertTournament($this->name, $this->autorid)) throw new LogWarning("tourn_insert_error");
        } else {
          throw new LogWarning("tourn_save_no_id");
        }
      }
    }
    
    public function delete() {
      if($this->id && $this->id > 0) {
        Logger::debug("Delete tournament ".$this->id." from database");
        $this->dao->deleteTournament($this->id);
      } else {
        throw new LogWarning("tourn_delete_no_id");
      }
    }
  
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        Logger::debug("Tournament::setId ".$id, "Tournament");
        $this->id = $id;
    }

    public function getName()
    {        
        return $this->name;
    }

    public function setName($name)
    {
        Logger::debug("Tournament::setName ".$name, "Tournament");
        $this->name = $name;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getWinner()
    {
        return $this->winner;
    }

    public function setWinner($winner)
    {
        $this->winner = $winner;
    }
    
    

  public function getAutorid()
  {
      return $this->autorid;
  }

  public function setAutorid($autorid)
  {
      $this->autorid = $autorid;
  }
}

?>