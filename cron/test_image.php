<?
include("config.php");
$country = "en";
$domain = "123viec.com";
$keywords = "123viec";
$firstnresults = 100;
$baseurl = "https://www.google.com/search?hl=".$country."&output=search&start=0&q=".urlencode($keywords);
$html = file_get_contents($baseurl);
echo $html;
?>