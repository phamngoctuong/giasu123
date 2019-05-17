<?
include("../home/config.php");
$time = time();
$db_ex = new db_execute("UPDATE new SET new_over = 1 WHERE new_han_nop < ".$time."");
?>
