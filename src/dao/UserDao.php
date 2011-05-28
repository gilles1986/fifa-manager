<?php

class UserDao {
  
  private $db;
  
  public function __construct() {
    $this->db = new MysqlDatabase(parse_ini_file(CONFIG."db.ini"));
  }
  
  public function getUserById($id) {
    $this->db->connect();
    $res = $this->db->select("Select * from `user` Where `id` = '".intval($id)."'");
    $this->db->close();
    return $res[0];
  }
  
  public function getUserByName($name) {
    $this->db->connect();
    $res = $this->db->select("Select * from `user` Where `name` = '".mysql_real_escape_string($name)."'");
    $this->db->close();
    return $res[0];
  }
  
  public function getUserByNickname($name) {
    $this->db->connect();
    $res = $this->db->select("Select * from `user` Where `nickname` = '".mysql_real_escape_string($name)."'");
    $this->db->close();
    return $res[0];
  }
  
  public function login($name, $pw) {
    $this->db->connect();
    $res = $this->db->select("Select * from `user` Where `name` = '".mysql_real_escape_string($name)."' And `password` = md5('".mysql_real_escape_string($pw)."')");
    $this->db->close();
    return $res;
  }
  
  public function getUsers() {
    $this->db->connect();
    $res = $this->db->select("Select * from `user`");
    $this->db->close();
    return $res;
  }
  
  public function getFullUsersByTournamentId($id) {
    $this->db->connect();
    $res = $this->db->select("
    Select `user`.`name` as `name`,
    `user`.`nickname` as `nickname`,
    `user`.`id` as `id`,
    `user`.`avatar` as `avatar`,
    `tournplayer`.`team` as `team`, 
    `tournplayer`.`wins` as `wins`,
    `tournplayer`.`loss` as `loss`,
    `tournplayer`.`points` as `points`,
    `tournplayer`.`ties` as `ties` From `user`, `tournplayer`
     Where `user`.`id` = `tournplayer`.`playerid` AND `tournid`='".intval($id)."' Order By `tournplayer`.`points` Desc");
    $this->db->close();
    return $res;
  }
  
  public function getUsersByTournamentId($id) {
    $this->db->connect();
    $res = $this->db->select("Select `user`.`nickname` as `nickname`,`user`.`id` as `id`, `user`.`avatar` as `avatar`, `tournplayer`.`team` as `team` From `user`, `tournplayer`  Where `user`.`id` = `tournplayer`.`playerid` AND `tournid`='".intval($id)."'");
    $this->db->close();
    return $res;
  }
  
  public function getFreeUsersByTournamentId($id) {
    $this->db->connect();
    $res = $this->db->select("SELECT `user`.`nickname` as `nickname`, `user`.`id` as `id`, `user`.`avatar` as `avatar` FROM `user` WHERE 
    `id` NOT IN (SELECT `tournplayer`.`playerid` FROM `tournplayer` WHERE `tournid` = '".intval($id)."')");
    $this->db->close();
    return $res;
  }
  
  
  
  public function register($name,$pw,$nickname, $avatar) {
    $this->db->connect();
    $res = $this->db->insert("user",
      array("name","password","nickname","avatar"),
      array(mysql_real_escape_string($name), md5(mysql_real_escape_string($pw)), mysql_real_escape_string($nickname), mysql_real_escape_string($avatar)));
    $this->db->close();
    return $res;
  }
  
  public function update($id,$name,$pw,$nickname, $avatar) {
    $this->db->connect();
    $res = $this->db->insert("user",
      array("name","password","nickname","avatar"),
      array(mysql_real_escape_string($name), md5(mysql_real_escape_string($name)), mysql_real_escape_string($nickname), mysql_real_escape_string($avatar)),
      "`id`='".intval($id)."'");
    $this->db->close();
    return $res;
  }
  
  
}

?>