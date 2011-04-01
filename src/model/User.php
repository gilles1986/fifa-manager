<?php

class User {
  private $dao;
  
  private $id;
  private $username;
  private $password;
  private $avatar;
  private $nickname;
  
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
         return true;
       } else {
         throw new Exception("error_login");
       }
     } else {
       return false;
     }
  }
  
  public function save() {
    Logger::debug("User::save()","User");
    if($this->id) {
      Logger::debug("User::save::update()","User");
      $this->dao->update($this->id, $this->username, $this->password, $this->nickname, $this->avatar);
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
  
  public function register() {
    Logger::debug("User::register","User");
    if($this->username && $this->password && $this->nickname) {
      $user = $this->dao->loadUserByName($this->username);
      // Existiert der User ?
      if($user) { 
        Logger::debug("User \"".$this->getName()."\" existiert bereits", "User"); 
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
}

?>