<?php 
	/*
		传入分类，页码，每页数量，返回各个帖子详情，JSON格式
		接收参数:classification(string)，page(number),perpage(number)
		返回值:JSON格式的帖子详情
			   帖子名:title 发布时间:posttime 最后回复时间:lastreply 浏览量:viewcount 用户头像:picture 用户名:username
	*/
	require("shiyida.php");
	//$classification = "拉轰神器一箩筐！";
	$classification = $_POST['classification'];
	//$page = 99;
	$page = $_POST['page'];
	//$perpage = 5;
	$perpage = $_POST['perpage'];
	$shiyida = new Shiyida();
	echo $shiyida->getPostsByCateNameToPage($classification,$page,$perpage);
	
	
?> 