<!doctype html>
<html lang="ZH_CN">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../reg_confirm/default.css">
	<link rel="stylesheet" href="../reg_confirm/reset.css">
	<link rel="stylesheet" href="../reg_confirm/style.css">
	<script src="../js/modernizr.js"></script>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!--<link rel="stylesheet" type="text/css" href="./assets/styles.css"/>-->
	<style>html { overflow: hidden; }</style>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.21.1/sweetalert2.all.min.js"></script>
	<script src='https://www.recaptcha.net/recaptcha/api.js'></script>
	<title>登录</title>
</head>
<body>
  	<?php
		include '../config/config.php';
		$user=$_POST["email"];
		$passwd=$_POST["passwd"];
		$hash_pass=md5($passwd);
		$hash_user=md5($user);
		if($user!=""){
			$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die('数据库连接失败，错误信息：'.mysqli_error($connect));
			//数据库连接
			mysqli_select_db($connect,DB_NAME) or die('数据库连接错误，错误信息：'.mysqli_error($connect));
			//选择库
			$query = "SELECT * FROM USER_DATA WHERE `USER_ID`='" . $hash_user . "'";
			$result = mysqli_query($connect,$query);
			while($row = mysqli_fetch_assoc($result)) {
				$str = array(
											  'hash_pass' => $row["USER_PASS"]
										  );
			}
				include '../../functions/post.php';
				$chaptcha=post("https://www.google.com/recaptcha/api/siteverify","secret=6LeK-3IUAAAAABRzTjaawbvdZVdcbBSKzZthftES&response=".$_POST["g-recaptcha-response"]);
				$chaptcha=json_decode($chaptcha,true);
				if(!$chaptcha["success"]){
					echo "<script>sweetAlert(
									 '出错了...',
									 '你没有点击验证码哦',
									 'error'
								  )</script>";
					goto endfunc;
				}
          		elseif($str["hash_pass"]!=$hash_pass){
                  	echo "<script>sweetAlert(
									 '出错了...',
									 '用户名或者密码不正确',
									 'error'
								  )</script>";
					goto endfunc;
                }
              	echo "<script>sweetAlert('干得漂亮！', '登录成功！','success')</script>";
				setcookie("user",$hash_user,time()+2592000);
				setcookie("pass",$hash_pass,time()+2592000);
          		echo "<form method='POST' action='/clientarea' class='cd-form floating-labels'>
							<input type='submit' class='btn btn-default' value='进入客户中心'>
					  </form>";
          		die("</body></html>");
    	    }
  			endfunc:
          ?>
	<form method="POST" class="cd-form floating-labels">
		<fieldset>
			<div>
				<label class="cd-label" for="cd-email">邮箱</label>
				<input type="email" class="cd-email" id="cd-email" name="email">
			</div>
			<div>
				<label class="cd-label" for="cd-company">密码</label>
				<input type="password" class="cd-company" id="cd-company" name="passwd">
			</div>
			<br>
			<div class="g-recaptcha" data-sitekey="6LeK-3IUAAAAAMKVQi8eym1MHjrtGAnQpBNPQDXp" style="margin-top: -40px;"></div>
			<input type="submit" class="btn btn-default" value="登陆/注册" style="display:inline">
		</fieldset>
	</form>
	<script src="../js/jquery-1.8.3.min.js"></script>
	<script src="../js/main.js"></script>
</body>
</html>