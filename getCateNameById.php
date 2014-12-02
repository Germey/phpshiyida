<?php
	/*
		传入分类，返回分类的数据库内部代号
		接收参数:classification(string)
		返回值:返回分类名，不存在返回null
	*/
	require("shiyida.php");
	//$cate_id = 15;
	$cate_id = $_POST['cate_id'];
	$shiyida = new Shiyida();
	$name = $shiyida->getCateNameById($cate_id);
	if($name)
		echo $name;
	else 
		echo "null";
?>
