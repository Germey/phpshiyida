<?php 
	//实例化Redis
	$redis = new Redis();
	//连接Redis
	$redis->connect("121.42.8.51");
	$redis->auth("memeda");
?>