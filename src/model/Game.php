<?php

class Game {
  private $dao;

  private $id;
  private $player1;
  private $player2;

  public function __construct() {
    $this->dao = new TeamDao();
  }

  public function save() {
    if ($this -> id > 0) {
      $this -> dao -> update($this -> id, $this -> name);
    } else {
      $this -> dao -> insert($this -> name);
    }
  }

  public function delete() {
    if ($this -> id > 0) {
      $this -> dao -> delete($this -> id);
    } else {
      return false;
    }
  }

  public function load() {
    if ($this -> id > 0) {
      $result = $this -> dao -> getById($this -> id);
      $this -> name = $result['name'];
    } else {
      return false;
    }
  }
 
  public function setId($id) {
    $this->id = $id;
  }
  
  public function setPlayer1($player1) {
    $this->player1 = $player1;
  }
  
  public function setPlayer2($player2) {
    $this->player2 = $player2;
  }

  public function getId() {
    return $this->id;
  }
  
  public function getPlayer1() {
    return $this->player1;
  }
  
  public function getPlayer2() {
    return $this->player2;
  }

  
  
}

?>
	

	

	
