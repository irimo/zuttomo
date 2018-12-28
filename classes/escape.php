<?php
function html($str){
	return htmlspecialchars($str,ENT_QUOTES,mb_internal_encoding());
}
function sql_escape($str){
	return mysql_real_escape_string($str);
}
?>