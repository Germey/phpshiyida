<?php 
	/*
		������࣬ҳ�룬ÿҳ���������ظ����������飬JSON��ʽ
		���ղ���:classification(string)��page(number),perpage(number)
		����ֵ:JSON��ʽ����������
	*/
	require("shiyida.php");
	$classification = "��������һ���";
	//$classification = $_POST['classification'];
	$page = 5;
	//$page = $_POST['page'];
	$perpage = 5;
	//$page = $_POST['perpage'];
	$shiyida = new Shiyida();
	$cate_id = $shiyida->getCateId($classification);
	
	
?>