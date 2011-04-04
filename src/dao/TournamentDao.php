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
  
  
  
  public function getTournPlayerByIds($playerid, $tournid) {
    $this->db->connect();
    $res = $this->db->select("Select * From `tournplayer` Where `playerid` = '".intval($playerid)."' AND `tournid` = '".intval($tournid)."'");
    $this->db->close();
    return $res[0];
  }
  
  public function getTournPlayerById($id) {
    $this->db->connect();
    $res = $this->db->select("Select * From `tournplayer` Where `id` = '".intval($id)."'");
    $this->db->close();
    return $res[0];
  }
  
  public function insertTournamentPlayer($playerid, $tournid) {
    $this->db->connect();
    $status = $this->db->insert("tournplayer",array("playerid","tournid", "wins", "loss", "ties", "team"), array(intval($playerid),intval($tournid),0,0,0,""));
    $this->db->close(); 
    return $status;
  }
  
  public function deleteTournamentPlayer($playerid, $tournid) {
    $this->db->connect();
    $status = $this->db->delete("tournplayer", " `playerid` = '".intval($playerid)."' AND `tournid` = '".intval($tournid)."'");
    $this->db->close(); 
    return $status;
  }
  
  
  
}

?>