<?php 
	/*
		获取所有分类代号接口
		返回类型为数组
	*/
	require("shiyida.php");
	$shiyida = new Shiyida();
	$shiyida -> getAllCateIds();
	
?>