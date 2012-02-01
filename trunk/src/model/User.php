<?php

class User {
  private $dao;
  
  private $id;
  private $username;
  private $password;
  private $avatar;
  private $nickname;
  private $role;
  
  private $team;
  
  private $exists = false;
  
  public function __construct() {
    $this->dao = new UserDao();
  }
  
  public function login() {
    Logger::debug("User::login()","User"); 
    Logger::debug("Ist Username und Passwort gesetzt? ".$this->username." , ".$this->password);
    if($this->username && $this->password) {
       Logger::debug("Try to Login with userdata","User");
       $result = $this->dao->login($this->username, $this->password);
       Logger::debug("login Data: \r\n".print_r($result, true), "User");
       if(count($result) > 0) {
         Logger::debug("login:: Yep there is data for user: ".$result[0]['name']);
         $result = $result[0];
         $this->id = $result['id'];
         $this->username = $result['name'];
         $this->nickname = $result['nickname'];
         $this->avatar = $result['avatar'];
         $this->role = $result['roleid'];
         return true;
       } else {
         throw new Exception("error_login");
       }
     } else {
       return false;
     }
  }
  
  public function exist() {
    Logger::debug("User::exist()","User");
    $this->loadByName(); 
    if($this->id > 0)  return true;
    return false;    
  }
  
  public function load() {
    if($this->id) {
      $this->loadById();
    } else if($this->name != "") {
      $this->loadByName();
    } else if($this->nickname != "") {
      
    } else {
      return false;
    }
  }
  
  private function loadByNickname() {
    $user = $this->dao->getUserByNickname($this->nickname);
    if($user['id'] != "") $this->exists = true; 
    else $this->exists = false;
    $this->id = $user['id'];
    $this->username = $user['name'];
    $this->password = $user['password'];
    $this->avatar = $user['avatar'];
    $this->role = $user['roleid'];
  }
  
  private function loadByName() {
    Logger::debug("loadByName:: name: ".$this->username, "User");
    $user = $this->dao->getUserByName($this->username);
    if($user['id'] != "") $this->exists = true; 
    else $this->exists = false;
    Logger::debug(print_r($user, true), "LOGTEMP");
    $this->id = $user['id'];
    $this->password = $user['password'];
    $this->nickname = $user['nickname'];
    $this->avatar = $user['avatar'];
    $this->role = $user['roleid'];
  }
  
  private function loadById() {
    $user = $this->dao->getUserById($this->id);
    Logger::debug(print_r($user, true), "LOGTEMP");
    if($user['id'] != "") $this->exists = true; 
    else $this->exists = false;   
    $this->username = $user['name'];
    $this->password = $user['password'];
    $this->nickname = $user['nickname'];
    $this->avatar = $user['avatar'];
    $this->role = $user['roleid'];
  }
  
  public function save() {
    Logger::debug("User::save()","User");
    if($this->id) {
      Logger::debug("User::save::update()","User");
      $this->dao->update($this->id, $this->username, $this->password, $this->nickname, $this->avatar, $this->role);
    } else {
      Logger::debug("User::save::register() ".print_r(array($this->username, $this->password, $this->nickname, $this->avatar), true),"User");
      $this->dao->register($this->username, $this->password, $this->nickname, $this->avatar);
    }
  }
  
  
  public function getDao()
  {
      return $this->dao;
  }

  public function setDao($dao)
  {
      $this->dao = $dao;
  }

  public function getId()
  {
      return $this->id;
  }

  public function setId($id)
  {
      $this->id = $id;
  }

  public function getUsername()
  {
      return $this->username;
  }

  public function setUsername($username)
  {
      $this->username = $username;
  }

  public function getPassword()
  {
      return $this->password;
  }

  public function setPassword($password)
  {
      $this->password = $password;
  }

  public function getAvatar()
  {
      return $this->avatar;
  }

  public function setAvatar($avatar)
  {
      $this->avatar = $avatar;
  }

  public function getNickname()
  {
      return $this->nickname;
  }

  public function setNickname($nickname)
  {
      $this->nickname = $nickname;
  }
  
  public function setRole($number) {
     $this->role = $number;
  }
  
  public function getRole() {
    return $this->role;
  }
  
  public function register() {
    Logger::debug("User::register","User");
    if($this->username && $this->password && $this->nickname) {
      $user = $this->dao->getUserByName($this->username);
      // Existiert der User ?
      if(!empty($user)) { 
        Logger::debug("User \"".$this->getUsername()."\" existiert bereits", "User"); 
        throw new Exception("user_exists");
      }
      // Avatar ? 
      if($this->avatar['tmp_name']) {
        try {
          Logger::debug("User::register: Avatar erstellen", "User");
          $fileUploader = new FileUploader($this->avatar, $this->nickname);
          $this->avatar = $fileUploader->upload();
        } catch(Exception $e) {
          Logger::warning("Fehler beim erstellen des Avatars: ".$e->getMessage(), "User");
          $this->avatar = "default.jpg";
        }
      } else {
        $this->avatar = "default.jpg";
      }      
      $this->save();
      $_SESSION['error'] = "user_regged";
    } else {
      throw new Exception("form_not_filled");
    }
  
  }

  public function getTeam()
  {
      return $this->team;
  }

  public function setTeam($team)
  {
      $this->team = $team;
  }
  
  
  
  

  public function exists()
  {
      return $this->exists;
  }

  public function setExists($exists)
  {
      $this->exists = $exists;
  }
}


?>