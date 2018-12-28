<?php
/**
 * 20130615 irimo @DwangoHackathon
 */
require_once(DIRNAME(__FILE__)."/db.standard.php");
require_once(DIRNAME(__FILE__)."/friend.db.class.php");
 
class RemindDbClass {
  private $db;
  
  function __construct() {
    $this->db = new DBStandard();
  }
  function allFriends($user_id){
    $user_id = $this->db->sql_escape($user_id);
    $sql = 'SELECT `friend_id`, `friend_name`,`friend_type_id`, `since_user_old` ';
    $sql .= ' FROM z_friends WHERE `user_id`="'.$user_id.'" AND `del_flag`=0';
    $list = $this->db->selectAll($sql);
    return $list;
  }
  function friendEpisodes($friend_id){
    $friend_id = $this->db->sql_escape($friend_id);
    $sql = 'SELECT `friend_memory_id`, `memory_type_id`, `friend_memory_text` ';
    $sql .= ' FROM z_friend_memories WHERE `friend_id`="'.$friend_id.'" AND ';
    $sql .= ' `del_flag`=0';
    $list = $this->db->selectAll($sql);
    return $list;
  }
  function friendTypes(){
    $friendDB = new FriendDbClass();
    return $friendDB->friend_types();
  }
  function friendType($id) {
    $id = $this->db->sql_escape($id);
    $sql = 'SELECT `friend_type_id`, `friend_type_ja`, `friend_type_en` ';
    $sql .= ' FROM z_friend_types WHERE `friend_type_id`="'.$id.'" AND `del_flag`=0';
    $row = $this->db->select1($sql);
    return $row;
  }
  function memoryTypes(){
    $friendDB = new FriendDbClass();
    return $friendDB->memory_types();
  }
  function memoryType($id) {
    $id = $this->db->sql_escape($id);
    $sql = 'SELECT `memory_type_ja`, `memory_type_en`, `memory_type_id` FROM z_memory_types ';
    $sql .= ' WHERE `memory_type_id`='.$id.' AND `del_flag`=0';
    $row = $this->db->select1($sql);
    return $row;
  }
}