<?php
/**
 * Format array proxies:
 * array('host' => 'HOST', 'port' => 'PORT', 'username' => 'USERNAME', 'password' => 'PASSWORD');
 */
include('RankChecker.class.php');

$newGoogleRankChecker   = new GoogleRankChecker();
$newquery               = '123viec';
$useproxies             = false;
$arrayproxies           = [];
$googledata             = $newGoogleRankChecker->find($newquery, $useproxies, $arrayproxies);

echo '<pre>'; var_dump($googledata);
