<?php
/**
 * 20130615 irimo @DwangoHackathon
 */
require_once(DIRNAME(__FILE__)."/../db_classes/remind.db.class.php");

class RemindClass {
  private $db;
  private $user_id;
  private $friend_id;

  function __construct($user_id) {
    $this->db = new RemindDbClass();
    $this->user_id = $user_id;
  }
  function friends() {
    $list = $this->db->allFriends($this->user_id);
    if($list === false){
      return false;
    } else {
      return $list;
    }
  }
  function friend_types() {
    $list = $this->db->friendTypes();
    return $list;
  }
  function episodes($friend_id) {
    $list = $this->db->friendEpisodes($friend_id);
     if($list === false){
      return false;
    } else {
      return $list;
    }
 }
  function episode_types() {
    $list = $this->db->memoryTypes();
    return $list;
  }
  function episode_type($id) {
    $row = $this->db->memoryType($id);
    return $row;
  }
  function friend_type($id) {
    $row = $this->db->friendType($id);
    return $row;
  }
}