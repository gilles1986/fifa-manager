<?php

class Users {
  private $dao;
  
  private $users;
  
  public function __construct() {
    $this->dao = new UserDao();
  }
  
  public function loadUsers() {
    $this->users = array();
    $users = $this->dao->getUsers();
    for($i=0; $i < count($users); $i++) {
      $user = new User();
      $user->setId($users[$i]['id']);
      $user->setUsername($users[$i]['name']);
      $user->setPassword($users[$i]['password']);
      $user->setAvatar($users[$i]['avatar']);
      $user->setNickname($users[$i]['nickname']);
      array_push($this->users, $user);
    }
  }
  
  public function loadUsersByTourn($id) {
    $this->users = array();
    $users = $this->dao->getFreeUsersByTournamentId($id);
    
  }
  
  public function loadFreeUsersByTourn($id) {
    
  }
  
  public function getUsers() {
    return $this->users;
  }

  public function setUsers($users) {
    $this->users = $users;
  }
}

?>