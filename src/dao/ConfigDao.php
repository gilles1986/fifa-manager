<?php

class ConfigDao {
  
  private $db;
  
  public function __construct() {
    $this->db = new MysqlDatabase(parse_ini_file(CONFIG."db.ini"));
  }
  
  public function getConfig() {
    $this->db->connect();
    $res = $this->db->select("Select * from `config`");
    $this->db->close();
    return $res;
  }

  
  public function updateByName($name, $value) {
    $this->db->connect();
    $res = $this->db->update("config",array("value"), array(mysql_real_escape_string($value)), "`name` = '".mysql_real_escape_string($name)."'");
    $this->db->close();
    return $res;
  }
  
  public function deleteByName($name) {
    $this->db->connect();
    $res = $this->db->delete("config","`name` = '".mysql_real_escape_string($name)."'");
    $this->db->close();
    return $res;
  }
  
}

?>