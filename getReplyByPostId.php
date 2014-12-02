<?php 

	/*
		传入帖子的代号和页码，每页数量，返回回复的详情,注意其中第一页第一条为楼主的发布内容
		注意:第一条回复(楼主的发言)，page=1而不是0
		传入参数:post_id(number),page(number),perpage(number)
		返回值: JSON格式的回复详情，二维JSON
				回复代号:pid 回复内容:content 回复时间:timestamp
				赞同量:votes 回帖者头像:picture 回帖者名字:username
		
	*/
	require("shiyida.php");
	$post_id = $_POST['post_id'];
	$page = $_POST['page'];
	$perpage = $_POST['perpage'];
	$shiyida = new Shiyida();
	$result = $shiyida->getReplyByPostId($post_id,$page,$perpage);
	echo $result;
	
?>