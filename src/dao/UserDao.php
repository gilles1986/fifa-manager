<?php

class UserDao {
  
  private $db;
  
  public function __construct() {
    $this->db = new MysqlDatabase(parse_ini_file(CONFIG."db.ini"));
  }
  
  public function loadUserById($id) {
    $this->db->connect();
    $res = $this->db->select("Select * from `user` Where `id` = '".intval($id)."'");
    $this->db->close();
    return $res[0];
  }
  
  public function loadUserByName($name) {
    $this->db->connect();
    $res = $this->db->select("Select * from `user` Where `username` = '".mysql_real_escape_string($name)."'");
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
  
  public function getUsersByTournamentId($id) {
    $this->db->connect();
    $res = $this->db->select("Select * From `user`");
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