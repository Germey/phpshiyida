<?php
	/*
		传入分类名字，返回分类的数据库内部代号
		接收参数:classification(string)
		返回值:0代表未找到该分类，否则返回分类代号
	*/
	require("shiyida.php");
	//$classification = "拉轰神器一箩筐！";
	$classification = $_POST['classification'];
	$shiyida = new Shiyida();
	$id = $shiyida->getCateIdByName($classification);
	echo $id;
?>
