<?php
/*
	x~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~x
	+ copyright ©2018 oxdl.cn AllRights reserved +
	+~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~+
	+ github.com/EduarteCliff/accelerator-seller +
	x~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~x
*/
	if(isset($_POST["username"])) die("");
	if(isset($_GET["submit"])) header('location:/');
	include "../functions/ismobile.php";
	if(isMobile()) die("<body>暂不支持手机浏览器<br>实在太忙了没时间做<br>如果你可以帮忙开发手机前端，可以联系qq207083702</body></html>");
	echo file_get_contents("../templates/index_head.tpl");
	if(file_exists("./config/config.php")){
		define('SITE_NAME','GreenHat游戏加速器');
		//网站名称
		include "./config/config.php";
		define('MAIL_HOST','smtp.gmail.com');
		//SMTP服务器
		define('MAIL_NICK',"xxxx@gmail.com");
		//发件人
		define('MAIL_USER',"xxxx@gmail.com");
		//发件人账号
		define('MAIL_PASS',"xxxx");
		//发件密码
		define('MAIL_FROM',"xxxx@gmail.com");
		//发件人邮箱
		if(isset($_POST["email"])){
			$user=$_POST["email"];
			$passwd=$_POST["passwd"];
			$hash_pass=md5($passwd);
			$hash_user=md5($user);
		}
		if(isset($user)){
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
			if($str["hash_pass"]==$hash_pass){
				include '../functions/post.php';
				$chaptcha=post("https://www.google.com/recaptcha/api/siteverify","secret=6LfUBnMUAAAAAPW0Rt6gJivMR67OJbWPHLDhIIgd&response=".$_POST["g-recaptcha-response"]);
				$chaptcha=json_decode($chaptcha,true);
				if(!$chaptcha["success"]){
					echo "<body>";
					echo "<link rel='stylesheet' href='./css/sweetalert2.min.css'>";
					echo "<script>sweetAlert(
									 '出错了...',
									 '你没有点击验证码哦',
									 'error'
								  )</script>";
					echo file_get_contents("../templates/index_body.tpl");
					die("");
				}
				echo "<body>";
              	echo "<script>sweetAlert('干得漂亮！', '登录成功！','success')</script>";
				echo file_get_contents("../templates/index_body_loggedin.tpl");
				setcookie("user",$hash_user,time()+2592000,"/");
				setcookie("pass",$hash_pass,time()+2592000,"/");
            }
			elseif($str["hash_pass"]!=$hash_pass){
				include '../functions/post.php';
				$chaptcha=post("https://www.google.com/recaptcha/api/siteverify","secret=6LfUBnMUAAAAAPW0Rt6gJivMR67OJbWPHLDhIIgd&response=".$_POST["g-recaptcha-response"]);
				$chaptcha=json_decode($chaptcha,true);
				if(!$chaptcha["success"]){
					echo "<body>";
					echo "<link rel='stylesheet' href='./css/sweetalert2.min.css'>";
					echo "<script>sweetAlert(
									 '出错了...',
									 '你没有点击验证码哦',
									 'error'
								  )</script>";
					echo file_get_contents("../templates/index_body.tpl");
					die("");
				}
				echo "<body>";
				echo "<script>sweetAlert(
									 '出错了...',
									 '账号或密码错误',
									 'error'
					)</script>";
				echo file_get_contents("../templates/index_body.tpl");
			}
			elseif(!isset($str["hash_pass"])){
				include '../functions/post.php';
				$chaptcha=post("https://www.google.com/recaptcha/api/siteverify","secret=6LfUBnMUAAAAAPW0Rt6gJivMR67OJbWPHLDhIIgd&response=".$_POST["g-recaptcha-response"]);
				$chaptcha=json_decode($chaptcha,true);
				if(!$chaptcha["success"]){
					echo "<body>";
					echo "<link rel='stylesheet' href='./css/sweetalert2.min.css'>";
					echo "<script>sweetAlert(
									 '出错了...',
									 '你没有点击验证码哦',
									 'error'
								  )</script>";
					echo file_get_contents("../templates/index_body.tpl");
					die("");
				}
				echo file_get_contents("../templates/index_body.tpl");
				require_once("../phpmailer/class.phpmailer.php");
				require_once("../phpmailer/class.smtp.php");
				$mail = new PHPMailer();
				$mail->isSMTP();
				$mail->SMTPAuth=true;
				$mail->Host = MAIL_HOST;
				$mail->SMTPSecure = 'ssl';
				$mail->Port = 465;
				$mail->CharSet = 'UTF-8';
				$mail->FromName = MAIL_NICK;
				$mail->Username = MAIL_USER;
				$mail->Password = MAIL_PASS;
				$mail->From = MAIL_FROM;
				$mail->isHTML(true);
				$mail->addAddress($user,'USER');
				$mail->Subject = '欢迎注册'.SITE_NAME;
				$body=file_get_contents("../templates/mail_reg.tpl");
				$body=str_replace("$!PASSWORD!$",$passwd,$body);
				$body=str_replace("$!HTTP-REQUEST!$",$hash_user,$body);
				$mail->Body = $body;
				$status = $mail->send();
				if($status) echo "<script>sweetAlert('干得漂亮！', '注册邮件已发送，请查收！','success')</script>"; else echo "<script>sweetAlert(
									 '出错了...',
									 '邮件发送失败',
									 'error'
								  )</script>";
				$query="INSERT INTO USER_DATA(USER_PASS,USER_ID,EMAIL)VALUES('".$passwd."','".$hash_user."','".$user."')";
				$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die('数据库连接失败，错误信息：'.mysqli_error($connect));
				//数据库连接
				mysqli_select_db($connect,DB_NAME) or die('数据库连接错误，错误信息：'.mysqli_error($connect));
				//选择库
				mysqli_query($connect,$query);
			}
		}
		elseif(isset($_COOKIE["user"])){
					  $hash_user=$_COOKIE["user"];
					  $hash_pass=$_COOKIE["pass"];
					  $connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die('数据库连接失败，错误信息：'.mysqli_error($connect));	//数据库连接
					  mysqli_select_db($connect,DB_NAME) or die('数据库连接错误，错误信息：'.mysqli_error($connect));		//选择库
					  $query = "SELECT * FROM USER_DATA WHERE `USER_ID`='" . $hash_user . "'";
					  $result = mysqli_query($connect,$query);
					  while($row = mysqli_fetch_assoc($result)) {
							  $str = array(
								  'hash_pass' => $row["USER_PASS"]
							  );
					  }
					  if($str["hash_pass"]==$hash_pass){
						  echo "<body>";
						  echo file_get_contents("../templates/index_body_loggedin.tpl");
					  }
					  else{
						echo "<body>";
						echo file_get_contents("../templates/index_body.tpl");
					  }
				  }
		else{
			echo "<body>";
			echo file_get_contents("../templates/index_body.tpl");
		}
	} else{
		header('location:/install/install.php');
	}
	?>
