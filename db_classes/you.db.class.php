<?php
/**
 * 20130615 irimo @DwangoHackathon
 */
 
require_once(DIRNAME(__FILE__)."/db.standard.php");
 
class YouDbClass {
  private $db;
  
  function __construct() {
    $this->db = new DBStandard();
  }
  function regist($username, $birthday, $password="") {
    $username = $this->db->sql_escape($username);
    $birthday = $this->db->sql_escape($birthday);
    $sql = 'INSERT INTO z_user(`user_name_en`, `user_birthday`,`password`) ';
    $sql .= 'VALUES("'.$username.'","'.$birthday.'","'.$password.'");';
    $ret = $this->db->query($sql);
    if($ret === true){
      $getid_sql = 'SELECT `user_id` FROM z_user WHERE user_name_en LIKE "'.$username.'"';
      $select = $this->db->select1($getid_sql);
      $id = $select["user_id"];
      return $id;
    } else {
      return false;
    }
  }
  function userName($user_id) {
    $user_id = $this->db->sql_escape($user_id);
    $sql = "SELECT `user_name_en` FROM z_user WHERE `user_id`=".$user_id;
    $record = $this->db->select1($sql);
    if($record === false){
      return false;
    }
    return $record['user_name_en'];
  }
}