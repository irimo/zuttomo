<?php
/**
 * 20130615 irimo @DwangoHackathon
 */
require_once(DIRNAME(__FILE__)."/db.standard.php");
 
class FriendDbClass {
  private $db;
  
  function __construct() {
    $this->db = new DBStandard();
  }
  function friend_types(){
    $sql = "SELECT `friend_type_id`, `friend_type_ja` ";
    $sql .= " FROM z_friend_types ";
    $sql .= " WHERE `del_flag`=0 ";
    $list = $this->db->selectAll($sql);
    return $list;
  }
  function memory_types(){
    $sql = "SELECT `memory_type_id`, `memory_type_ja` ";
    $sql .= " FROM z_memory_types ";
    $sql .= " WHERE `del_flag`=0 ";
    $list = $this->db->selectAll($sql);
    return $list;
  }
  function registFriend($friend_name, $user_id, $old, $friend_type_id) {
    $friend_name = $this->db->sql_escape($friend_name);
    $user_id = $this->db->sql_escape($user_id);
    $old = $this->db->sql_escape($old);
    $friend_type_id = $this->db->sql_escape($friend_type_id);
    $sql = "INSERT INTO z_friends(`friend_name`, `user_id`, `since_user_old`, `friend_type_id`) VALUES ";
    $sql .= '("'.$friend_name.'","'.$user_id.'","'.$old.'","'.$friend_type_id.'")';
    $ret = $this->db->query($sql);
    if($ret === true){
      $friendid_sql = 'SELECT `friend_id` FROM z_friends WHERE `user_id`='.$user_id.' AND friend_name LIKE "'.$friend_name.'"';
      $select = $this->db->select1($friendid_sql);
      $friend_id = $select['friend_id'];
      return $friend_id;
    } else {
      return false;
    }
  }
  function registEpisode($friend_id, $episode_type_id, $episode_text){
    $user_id = $this->db->sql_escape($user_id);
    $episode_type_id = $this->db->sql_escape($episode_type_id);
    $episode_text = $this->db->sql_escape($episode_text);
    $episode_sql = "INSERT INTO z_friend_memories(`friend_id`, `memory_type_id`,`friend_memory_text`) ";
    $episode_sql .= ' VALUES("'.$friend_id.'","'.$episode_type_id.'","'.$episode_text.'") ';
    $episode_success = $this->db->query($episode_sql);
    if($episode_success === true){
      return true;
    } else {
      return false;
    }
  }
  function getName($friend_id) {
    $friend_id = $this->db->sql_escape($friend_id);
    $sql = 'SELECT `friend_name` FROM z_friends WHERE `friend_id`='.$friend_id;
    $row = $this->db->select1($sql);
    if($row === false){
      return false;
    }
    return $row['friend_name'];
  }
}