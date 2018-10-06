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
	echo post("https://codepay.fateqq.com:51888/creat_order?id=62007&token=qxNJ9LqWV3lFEZ5druyE9CguayEEttPW&price=".$total."&pay_id=admin&type=1&notify_url=https://www.speed-up.tk/clientarea/callback.php","");
?>