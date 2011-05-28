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
  
  public function loadOwnTournamentsByUserId($id) {
    $this->db->connect();
    $res = $this->db->select("Select * from `tourn` Where `autorid` = '".intval($id)."'");
    $this->db->close();
    return $res;
  }
  
  public function loadTournamentsByUserId($id) {
    $this->db->connect();
    $res = $this->db->select("SELECT
     `t`.`id` as `id`,
		 `t`.`name` as `name`,
		 `t`.`status` as `status`,
		 `t`.`winnerid` as `winnerid`,
		 `t`.`autorid` as `autorid`
     FROM `tourn` `t`, `tournplayer` `tp`
     WHERE `t`.`autorid` = '".intval($id)."' 
     OR  `tp`.`playerid` = '".intval($id)."' 
     AND `tp`.`tournid` = `tournid` 
     GROUP BY `t`.`id`");
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
    $status = $this->db->update("tourn",array("name","status","winnerid","autorid"), array(mysql_real_escape_string($name), mysql_real_escape_string($status), mysql_real_escape_string($winner), intval($autorid)),"`id`='".intval($id)."'");
    $this->db->close(); 
    return $status;   
  }
  
  public function insertTournament($name, $autorid) {
    $this->db->connect();
    $status = $this->db->insert("tourn",array("name","status","winnerid","autorid"), array(mysql_real_escape_string($name),"open",0, $autorid) );
    $this->db->close();
    return $status;    
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
    Logger::debug("getTournPlayerById:: \r\n Select * From `tournplayer` Where `id` = '".intval($id)."'", "TournamentDao");
    $this->db->connect();
    $res = $this->db->select("Select * From `tournplayer` Where `id` = '".intval($id)."'");
    $this->db->close();
    return $res[0];
  }
  
  public function getTournPlayerByTournId($id) {
    Logger::debug("getTournPlayerByTournId:: \r\n Select * From `tournplayer` Where `tournid` = '".intval($id)."'", "TournamentDao");
    $this->db->connect();
    $res = $this->db->select("Select * From `tournplayer` Where `tournid` = '".intval($id)."'");
    $this->db->close();
    return $res[0];
  }
  
  public function insertTournamentPlayer($playerid, $tournid) {
    $this->db->connect();
    $status = $this->db->insert("tournplayer",array("playerid","tournid", "wins", "loss", "ties", "team"), array(intval($playerid),intval($tournid),0,0,0,""));
    $this->db->close(); 
    return $status;
  }
  
  public function updateTournamentPlayer($id ,$playerid, $tournid, $wins, $loss, $ties, $team) {
    Logger::debug(print_r(array($id ,$playerid, $tournid, $wins, $loss, $ties, $team), true), "TournamentDao");
    $this->db->connect();
    $status = $this->db->update("tournplayer",array("playerid","tournid", "wins", "loss", "ties", "team"), array(intval($playerid),intval($tournid),intval($wins),intval($loss),intval($ties),intval($team)), "`id`='".intval($id)."'");
    $this->db->close(); 
    return $status;
  }
  
  public function deleteTournamentPlayer($playerid, $tournid) {
    $this->db->connect();
    $status = $this->db->delete("tournplayer", " `playerid` = '".intval($playerid)."' AND `tournid` = '".intval($tournid)."'");
    $this->db->close(); 
    return $status;
  }
  
  public function startTournament($matches) {
    $this->db->connect();
    $status = $this->db->insertMore("tourngame", array("player1", "player2", "status", "p1goals", "p2goals", "tournid", "winner", "order"), $matches);
    $this->db->close(); 
    return $status;
  }
  
  
  
}

?>