<?php
	include "public/config/config.php";
	$connect=mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die('数据库连接失败，错误信息：'.mysqli_error($connect));
	mysqli_select_db($connect,DB_NAME) or die('数据库连接错误，错误信息：'.mysqli_error($connect));
	$query="UPDATE `USER_DATA` SET `TIME`=`TIME`-5 WHERE `TIME`>0";
	$result = mysqli_query($connect,$query);
?>