<?php
	$hours=$_GET["charge_hours"];
	if($hours>=13&&$hours<=240){
		$total=$hours*0.06;
	}
	elseif($hours>240){
		$total=$hours*0.05;
	}
	else{
		$total=$hours*0.07;
	}
	include "../../functions/post.php";
	include "../config/config.php";
	$conn=mysqli_connect(DB_HOST, DB_USER,DB_PASS) or die("Error-数据库连接失败！");
	$connection=mysqli_select_db($conn,DB_NAME) or die("Error-数据库选择失败！");
	$query="SELECT COUNT(*) FROM CHARGE";
	$return=mysqli_query($conn,$query) or die("新增错误");
	while($row = mysqli_fetch_assoc($return)) {
		$str = array(
			'count' => $row["COUNT(*)"]
		);
	}
	$str["count"]=$str["count"]+1;
	$query="INSERT INTO CHARGE(ID,COUNT,STATE,USER)VALUES('".md5($str["count"])."','".$hours."','PENDING','".$_COOKIE["user"]."')"; 
	mysqli_query($conn,$query) or die("新增错误");
	echo post("https://codepay.fateqq.com:51888/creat_order?id=62007&token=qxNJ9LqWV3lFEZ5druyE9CguayEEttPW&price=".$total."&pay_id=".md5($str["count"])."&type=1&notify_url=https://www.speed-up.tk/clientarea/callback.php","");
?>