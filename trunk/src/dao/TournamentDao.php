<?php

class TournamentDao {
  
  private $db;
  
  public function __construct() {
    $this->db = new MysqlDatabase(parse_ini_file(CONFIG."db.ini"));
  }
  
  public function loadTournamentById($id) {
    $this->db->connect();
    $res = $this->db->select("Select * from `tourn` Where `id` = '".intval($id)."'");
    $this->db->close();
    return $res[0];
  }
  
  public function loadTournamentsByUserId($id) {
    $this->db->connect();
    $res = $this->db->select("Select * from `tourn` Where `autorid` = '".intval($id)."'");
    $this->db->close();
    return $res;
  }
  
  public function loadTournaments() {
    $this->db->connect();
    $res = $this->db->select("Select * from `tourn`");
    $this->db->close();
    return $res;
  }
  
  public function loadGamesByTournamentId($id) {
    $this->db->connect();
    $res = $this->db->select("Select * from `tourn`");
    $this->db->close();
    return $res;
  }
  
  public function updateTournament($id, $name, $status, $autorid, $winner=0) {
    $this->db->connect();
    $this->db->update("tourn",array("name","status","winnerid","autorid"), array(mysql_real_escape_string($name), mysql_real_escape_string($status), mysql_real_escape_string($winner), intval($autorid)),"`id`='".intval($id)."'");
    $this->db->close();    
  }
  
  public function insertTournament($name, $autorid) {
    $this->db->connect();
    $this->db->insert("tourn",array("name","status","winnerid","autorid"), array(mysql_real_escape_string($name),"open",0, $autorid) );
    $this->db->close();    
  }
  
  public function getUsersByTourn($id) {
    $this->db->connect();
    $res = $this->db->select("Select `id` from `tourn`");
    $this->db->close();
    return $res;
  }
  
}

?>