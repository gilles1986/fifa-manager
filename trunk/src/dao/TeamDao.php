<?php

class TeamDao {
  
  private $db;
  
  public function __construct() {
    $this->db = new MysqlDatabase(parse_ini_file(CONFIG."db.ini"));
  }
  
  public function getTeams() {
    $this->db->connect();
    $res = $this->db->select("Select * from `teams` Order By `name`");
    $this->db->close();
    return $res;
  }

  public function getById($id) {
    $this->db->connect();
    $res = $this->db->select("Select * from `teams` Where `id`='".intval($id)."'");
    $this->db->close();
    return $res[0];
  }
  
  public function insert($name) {
    $this->db->connect();
    $res = $this->db->insert("teams",array("name"), array(mysql_real_escape_string($name)));
    $this->db->close();
    return $res;
  }
  
  public function update($id, $name) {
    $this->db->connect();
    $res = $this->db->update("teams",array("name"), array(mysql_real_escape_string($name)), "`id` = '".intval($id)."'");
    $this->db->close();
    return $res;
  }
  
  public function delete($id) {
    $this->db->connect();
    $res = $this->db->delete("teams","`id` = '".intval($id)."'");
    $this->db->close();
    return $res;
  }
  
}

?>