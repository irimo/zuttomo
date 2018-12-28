<?php
/**
 * 20130615 irimo @DwangoHackathon
 */
class DBStandard {
  var $host;
  var $user;
  var $pw;
  var $port = "3306";
  var $dbname = "mnlab_zuttomo";

  var $dbcon;

  function __construct(){
    $this->setServer();
    $this->dbcon = mysql_connect($this->host.":".$this->port, $this->user, $this->pw);
    mysql_query("SET NAMES utf8",$this->dbcon); //クエリの文字コードを設定
    mysql_select_db($this->dbname, $this->dbcon);
  }
/* public */
// T/Fのクエリー
// sql文はエスケープ処理して渡すこと！
  function query($sql){
    $ret = mysql_query($sql,$this->dbcon);
    if($ret === false){
      return false;
    } else {
      return true;
    }
  }
/* public */
// 一行取得
// sql文はエスケープ処理して渡すこと！
  function select1($sql){
    $res = mysql_query($sql,$this->dbcon);
    if($res) {
      $row = mysql_fetch_assoc($res);
      return $row;
    } else {
      return false;
    }
  }
/* public */
// 複数行取得
// sql文はエスケープ処理して渡すこと！
  function selectAll($sql){
    $res = mysql_query($sql,$this->dbcon);
    $ret = array();
    while($row = mysql_fetch_assoc($res)){
      $ret[] = $row;
    }
    return $ret;
  }
/* public */
// whereからcount取得
  function getCount($where, $table){
    $sql = "SELECT COUNT(*) AS CNT FROM {$table} ";
    $sql .= " {$where}";
    $res = mysql_query($sql,$this->dbcon);
    $ret = mysql_fetch_assoc($res);
    return $ret["CNT"];
  }
  function html($str){
    return htmlspechalchar($str,ENT_QUOTES,mb_internal_encoding());
  }
/* public */
  function sql_escape($str){
    return mysql_real_escape_string($str);
  }

/* private */
  function setServer(){
    if($_SERVER["HTTP_HOST"] === "localhost"){
      $this->host = "localhost";
      $this->user = "root";
      $this->pw = "";
    } else {
        $this->host = PRODUCTION_HOST;
        $this->user = PRODUCTION_USER;
        $this->pw = PRODUCTION_PW;
    }
  }
}
