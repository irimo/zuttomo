<?php
/**
 * 20130615 irimo @DwangoHackathon
 */

require_once(DIRNAME(__FILE__)."/../classes/friend.class.php");

if(isset($_GET["id"])){
  $user_id = $_GET["id"];
} else {
  die("ユーザIDがありません！！暫定verなので、エラー処理ぬるいのごめんなさい。。");
}
$mode = ((isset($_GET["mode"])) ? $_GET["mode"] : "first");

switch($mode) {
  case "first":
    $template = file_get_contents(DIRNAME(__FILE__)."/../templates/friend.html");
    $footer = file_get_contents(DIRNAME(__FILE__)."/../templates/footer.html");
    $template = str_replace("<%=FOOTER=>", $footer, $template);

    $friend_class = new FriendClass($user_id);
    $template = $friend_class->prepareOptionValue($template);
    $template = $friend_class->prepareIDValue($template);
    $template = $friend_class->prepareMemoryOptionValue($template);
    print $template;
    break;
  case "regist":
    $friendname = $_POST["friendname"];
    $old = $_POST["old"];
    $friend_type = $_POST["friend_type"];
    $memory_type = $_POST["memory_type"];
    $memory_text = $_POST["memory_text"];
    $friend_class = new FriendClass($user_id);
    if($friend_class->set($friendname, $old, $friend_type, $memory_type, $memory_text)){
      $friend_id = $friend_class->friend_id();
      $template = file_get_contents(DIRNAME(__FILE__)."/../templates/memory_success.html");
      $footer = file_get_contents(DIRNAME(__FILE__)."/../templates/footer.html");
      $template = str_replace("<%=FOOTER=>", $footer, $template);

      $template = str_replace("<%=FRIEND_ID=>", $friend_id, $template);
      $template = str_replace("<%=FRIEND_NAME=>", $friendname, $template);
      $template = str_replace("<%=USER_ID=>", $user_id, $template);
      print $template;
    } else {
      die("登録に失敗しました。既に登録してる友達かも？お手数ですが、やり直してください。");
    }
  break;
}