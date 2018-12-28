<?php
/**
 * 20130615 irimo @DwangoHackathon
 */
 
 require_once(DIRNAME(__FILE__)."/../classes/index.class.php");


 if(isset($_GET['id'])){
  $id = $_GET['id'];
  $template = file_get_contents(DIRNAME(__FILE__)."/../templates/index.html");
  $footer = file_get_contents(DIRNAME(__FILE__)."/../templates/footer.html");
  $template = str_replace("<%=FOOTER=>", $footer, $template);
  $template = str_replace("<%=USER_ID=>", $id, $template);
  
  $indexClass = new IndexClass();
  $user_name = $indexClass->name($id);
  $template = str_replace("<%=USER_NAME=>", $user_name, $template);
} else {
  $template = file_get_contents(DIRNAME(__FILE__)."/../templates/index_first.html");
}
print $template;