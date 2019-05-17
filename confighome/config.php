<? 
$visitor = $_SERVER['REMOTE_ADDR'];
require_once("../functions/functions.php"); 
ob_start('callback');
require_once("../functions/function_rewrite.php");
require_once("../classes/database.php");
require_once("../classes/config.php");
require_once("../data/array_front_end.php");
require_once("../data/array_du_lieu.php");
require_once("../cache_file/top-cache.php");
require_once("../classes/resize-class.php");
require_once("../functions/pagebreak.php");
if(!isset($set_mn))
{
   $set_mn = 0;
}
if($set_mn == 0)
{
   setcookie('fillmoney','0',time()+3600,'/');
   setcookie('filltime','0',time()+3600,"/");
}
if(!isset($_COOKIE['saveid']))
{
   setcookie("saveid","",time()+3600,"/");
}
?>