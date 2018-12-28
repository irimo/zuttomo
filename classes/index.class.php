<?php
/**
 * 20130615 irimo @DwangoHackathon
 */
require_once(DIRNAME(__FILE__)."/../db_classes/you.db.class.php");

class IndexClass {
  private $db;
  function __construct(){
    $this->db = new YouDbClass();
  }
  function name($user_id) {
    $name = $this->db->userName($user_id);
    if($name === false){
      return false;
    }
    return $name;
  }
}