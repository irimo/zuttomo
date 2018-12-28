<?php
/**
 * 20130615 irimo @DwangoHackathon
 */
require_once(DIRNAME(__FILE__)."/../db_classes/you.db.class.php");

class YouClass {
  private $db;
  private $id = null;
  function __construct(){
    $this->db = new YouDbClass();
  }
  function set($username, $birthday){
    $ret = $this->db->regist($username, $birthday);
    if($ret === false){
      return false;
    } else {
      $this->id = $ret;
    }
    return true;
  }
  function id(){
    if($this->id === null){
      return false;
    }
    return $this->id;
  }
}