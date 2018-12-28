<?php
/**
 * 20130615 irimo @DwangoHackathon
 */

require_once(DIRNAME(__FILE__)."/../classes/you.class.php");

$mode = ((isset($_GET["mode"])) ? $_GET["mode"] : "first");

// 登録 mode=null
switch($mode) {
  case "first":
    $template = file_get_contents(DIRNAME(__FILE__)."/../templates/you.html");
    print $template;
    break;
  case "regist":
    $username = $_POST["name"];
    $birthday = $_POST["birthday"];
    $you_class = new YouClass();
    if($you_class->set($username, $birthday)){
      $id = $you_class->id();
      $template = file_get_contents(DIRNAME(__FILE__)."/../templates/you_success.html");
      $footer = file_get_contents(DIRNAME(__FILE__)."/../templates/footer.html");
      $template = str_replace("<%=FOOTER=>", $footer, $template);
      $template = str_replace("<%=USER_ID=>", $id, $template);

      print $template;
    } else {
    die("登録に失敗しました。(IDが使われてるかも？)お手数ですが、最初からやり直してください。");
    }
  break;
}