<?php
/**
 * 20130615 irimo @DwangoHackathon
 */

require_once(DIRNAME(__FILE__)."/../classes/friend.class.php");
require_once(DIRNAME(__FILE__)."/../classes/memory.class.php");

if(isset($_GET["id"])){
  $user_id = $_GET["id"];
} else {
  die("作り込んでません＞＜");
}

if(isset($_GET["friend"])){
  $friend_id = $_GET["friend"];
} else {
  die("パラメタいじくるなんてえっち♡");
}
$mode = ((isset($_GET["mode"])) ? $_GET["mode"] : "first");

$friend_class = new FriendClass($user_id);
$friend_name = $friend_class->getName($friend_id);

switch($mode) {
  case "first":
    $template = file_get_contents(DIRNAME(__FILE__)."/../templates/memory.html");
    $footer = file_get_contents(DIRNAME(__FILE__)."/../templates/footer.html");
    $template = str_replace("<%=FOOTER=>", $footer, $template);
    $template = $friend_class->prepareMemoryOptionValue($template);
    $template = str_replace("<%=FRIEND_NAME=>", $friend_name, $template);
    $template = str_replace("<%=USER_ID=>", $user_id, $template);
    $template = str_replace("<%=FRIEND_ID=>", $friend_id, $template);
    print $template;
    break;
  case "regist":
    $memory_type_id = $_POST["memory_type"];
    $memory_text = $_POST["memory_text"];
    $memory_class = new MemoryClass($user_id, $friend_id);
    if($memory_class->set($memory_type_id, $memory_text)){
      $template = file_get_contents(DIRNAME(__FILE__)."/../templates/memory_success.html");
      $footer = file_get_contents(DIRNAME(__FILE__)."/../templates/footer.html");
      $template = str_replace("<%=FOOTER=>", $footer, $template);
      $template = str_replace("<%=USER_ID=>", $user_id, $template);
      $template = str_replace("<%=FRIEND_ID=>", $friend_id, $template);
      $template = str_replace("<%=FRIEND_NAME=>", $friend_name, $template);
      print $template;
    } else {
    die("登録に失敗しました。(IDが使われてるかも？)お手数ですが、最初からやり直してください。");
    }
  break;
}