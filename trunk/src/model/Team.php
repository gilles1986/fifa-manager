<?php

class Team {
  private $dao;
  
  private $id;
  private $name;
  
  
  public function __construct() {
    $this->dao = new TeamDao();
  }  
  
  
  public function save() {
    if($this->id > 0) {
      $this->dao->update($this->id, $this->name);
    } else {
      $this->dao->insert($this->name);
    }
  }
  
  public function delete() {
    if($this->id > 0) {
      $this->dao->delete($this->id);
    } else {
      return false;
    }
  }
  
  public function load() {
  if($this->id > 0) {
      $result = $this->dao->getById($this->id);
      $this->name = $result['name'];
    } else {
      return false;
    }
  }
  
  public function getId()
  {
      return $this->id;
  }

  public function setId($id)
  {
      $this->id = $id;
  }

  public function getName()
  {
      return $this->name;
  }

  public function setName($name)
  {
      $this->name = $name;
  }
}


?>