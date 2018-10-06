<?php
	ksort($_POST);
    reset($_POST);
    $codepay_key="QWGjo3m1pzOrJPzw8fAoYiG2j7YbLYuE";
    $sign = '';
	foreach ($_POST AS $key => $val) {
    if ($val == '' || $key == 'sign') continue;
    if ($sign) $sign .= '&';
    $sign .= "$key=$val";
	}
	if (!$_POST['pay_no'] || md5($sign . $codepay_key) != $_POST['sign']) {
		exit('fail');
	} else {
	include "../config/config.php";
	$conn=mysqli_connect(DB_HOST, DB_USER,DB_PASS) or die("Error-数据库连接失败！");
	$connection=mysqli_select_db($conn,DB_NAME) or die("Error-数据库选择失败！");
	if(!isset($_POST["pay_no"])) die("");
	$query="SELECT * FROM CHARGE WHERE `ID`='" .$_POST["pay_id"]. "'";
	$result = mysqli_query($conn,$query);
	while($row = mysqli_fetch_assoc($result)) {
		$str = array(
			'user' => $row["USER"],
			'count' => $row["COUNT"]
		);
	}
	$str["count"]*=60;
	$query="UPDATE `USER_DATA` SET `TIME`=`TIME`+'".$str["count"]."' WHERE `USER_ID`='".$str["user"]."'";
	mysqli_query($conn,$query);
	}
?>