<!DOCTYPE html>
<html lang="ZH_CN">
<head>
  	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="default.css">
	<link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" href="style.css">
	<script src="../js/modernizr.js"></script>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!--<link rel="stylesheet" type="text/css" href="./assets/styles.css"/>-->
	<style>html { overflow: hidden; }</style>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.21.1/sweetalert2.all.min.js"></script>
	<style>
	img{
		width: 110%;
		height: 110%;
 		margin-left: -5%; 
    		margin-top:-2%; 
    		display:block;
	}
	.footer {
		width: 100%;
		height: auto;
		position: fixed;
		bottom: 0;
		background-color:rgba(0,0,0,0.8);
		border-top: #d8d8d8 solid 7px;
		transition-duration: 1s;
	}
		.footer:hover {
			background-color: rgba(0,0,0,0.5);
		}

	</style>
	<title>GreenHat注册确认</title>
</head>
<?php
	echo "<body>";
	include '../config/config.php';
	if(isset($_POST["passwd"])){
		$query="SELECT * FROM USER_DATA WHERE `USER_ID`='" . $_GET["req"] . "'";
		$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die('数据库连接失败，错误信息：'.mysqli_error($connect));	//数据库连接
		mysqli_select_db($connect,DB_NAME) or die('数据库连接错误，错误信息：'.mysqli_error($connect));		//选择库
		$result = mysqli_query($connect,$query);
		while($row = mysqli_fetch_assoc($result)) {
			$str = array(
				'pass' => $row["USER_PASS"]
			);
		}
		if($str["pass"]==$_POST["passwd"]){
			$hash_pass=md5($_POST["passwd"]);
			$state=mysqli_query($connect,"UPDATE USER_DATA SET USER_PASS='".$hash_pass."' WHERE USER_ID='".$_GET["req"]."'");
		}
		if($state){
			echo "<script>sweetAlert('干得漂亮！', '注册完成！','success')</script>";
		}
		else{
			echo "<script>sweetAlert(
 							 '出错了...',
 							 '数据库连接失败',
 							 'error'
						  )</script>";
		}
		echo file_get_contents("../../templates/reg_confirm.tpl");
	}
	else echo file_get_contents("../../templates/reg_confirm.tpl");
?>