<?php
/**
 * 20130615 irimo @DwangoHackathon
 */

require_once(DIRNAME(__FILE__)."/../classes/remind.class.php");

if(isset($_GET['id'])){
  $id = $_GET['id'];
} else {
  die("こちら作り込んでないです^^;");
}

$template = file_get_contents(DIRNAME(__FILE__)."/../templates/remind.html");     
$footer = file_get_contents(DIRNAME(__FILE__)."/../templates/footer.html");
$template = str_replace("<%=FOOTER=>", $footer, $template);

$remind_class = new RemindClass($id);
$friends = $remind_class->friends();
$count = count($friends);
$friend_id = rand(0, $count-1);
$friend_data = $friends[$friend_id];
$friend_id = $friend_data['friend_id'];
$friend_name = $friend_data['friend_name'];
$since_user_old = $friend_data['since_user_old'];

$friend_type_id = $friend_data['friend_type_id'];
$friend_type_row = $remind_class->friend_type($friend_type_id);
$friend_type = $friend_type_row['friend_type_ja'];

$episodes = $remind_class->episodes($friend_id);
$count = count($episodes);
if($count > 1){
  $episode_tmp_id = rand(0, $count-1);
} else {
  $episode_tmp_id = 0;
}
$episode_data = $episodes[$episode_tmp_id];
$episode_id = $episode_data['friend_memory_id'];
$episode_type_id = $episode_data['memory_type_id'];
$episode_text = $episode_data['friend_memory_text'];

$episode_row = $remind_class->episode_type($episode_type_id);
$episode_type = $episode_row['memory_type_en'];
switch($episode_type){
  case "proverb":
  case "conversation":
  $episode_text = "＼{$episode_text}／";
  break;
  
  case "happen":
  $episode_text = "<small>‐｀)｡o O （</small>{$episode_text}<small>）</small>";
  break;
}
$template = str_replace("<%=USER_ID=>", $id , $template);
$template = str_replace("<%=EPISODE=>", $episode_text, $template);
$template = str_replace("<%=FRIEND_NAME=>", $friend_name, $template);
$template = str_replace("<%=FRIEND_TYPE=>", $friend_type, $template);

print $template;