<?php
/**
 * 20130615 irimo @DwangoHackathon
 */
require_once(DIRNAME(__FILE__)."/../db_classes/friend.db.class.php");

class MemoryClass {
  private $db;
  private $user_id;
  private $friend_id;

  function __construct($user_id, $friend_id) {
    $this->db = new FriendDbClass();
    $this->user_id = $user_id;
    $this->friend_id = $friend_id;
  }
  function set($memory_type_id, $friend_memory_text) {
    $success = $this->db->registEpisode($this->friend_id, $memory_type_id, $friend_memory_text);
    return $success;
  }
}