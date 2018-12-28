<?php
/**
 * 20130615 irimo @DwangoHackathon
 */
require_once(DIRNAME(__FILE__)."/../db_classes/friend.db.class.php");

class FriendClass {
  private $db;
  private $user_id;
  private $friend_id;

  function __construct($user_id) {
    $this->db = new FriendDbClass();
    $this->user_id = $user_id;
  }
  function prepareOptionValue($template){
    $option = "";
    $list = $this->db->friend_types();
    foreach($list as $i => $record){
      $option .= "<option value={$record['friend_type_id']}>{$record['friend_type_ja']}</option>";
    }
    $template = str_replace("<%=OPTION_VALUE=>", $option, $template);
    return $template;
  }
  function prepareMemoryOptionValue($template){
    $option = "";
    $list = $this->db->memory_types();
    foreach($list as $i => $record){
      $option .= "<option value={$record['memory_type_id']}>{$record['memory_type_ja']}</option>";
    }
    $template = str_replace("<%=OPTION_VALUE_MEMORY=>", $option, $template);
    return $template;
  }
  function prepareIDValue($template){
    $template = str_replace("<%=USER_ID=>", $this->user_id, $template);
    return $template;
  }
  
  function set($friend_name, $old, $friend_type_id, $episode_type_id, $episode_text){
    $friend_id = $this->db->registFriend($friend_name, $this->user_id, $old, $friend_type_id);
    if($friend_id === false){
      die("友達登録に失敗しました(同じ名前の人を入れてるかも？)");
    }
    $this->friend_id = $friend_id;
    $episode_success = $this->db->registEpisode($friend_id, $episode_type_id, $episode_text);
    return $episode_success;
  }
  function friend_id(){
    return $this->friend_id;
  }
  function getName($friend_id){
    $name = $this->db->getName($friend_id);
    return $name;
  }
}