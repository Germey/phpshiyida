<?php 
	/*
		传入分类，页码，每页数量，返回各个帖子详情，JSON格式
		接收参数:classification(string)，page(number),perpage(number)
		返回值:JSON格式的帖子详情
	*/
	require("shiyida.php");
	$classification = "拉轰神器一箩筐！";
	//$classification = $_POST['classification'];
	$page = 3;
	//$page = $_POST['page'];
	$perpage = 5;
	//$page = $_POST['perpage'];
	$shiyida = new Shiyida();
	var_dump($shiyida->getPostsIdByCateName($classification,$page,$perpage));
	
	
?> 