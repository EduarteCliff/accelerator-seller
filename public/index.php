	<?php
	/*
		这里可以放进config.php
	*/
	if(($_GET["submit"])=="前往主页") header('location:/');
    include "../functions/ismobile.php";
    if(isMobile()) die("暂不支持手机浏览器<br>实在太忙了没时间做<br>如果你可以帮忙开发手机前端，可以联系qq207083702");
    echo file_get_contents("../templates/index_head.tpl");
  		if(file_exists("./config/config.php")){
          define('SITE_NAME','GreenHat游戏加速器');	//网站名称
		  include "./config/config.php";
          define('MAIL_HOST','smtp.gmail.com');	//SMTP服务器
          define('MAIL_NICK',"eduartecliff@gmail.com");	//发件人
          define('MAIL_USER',"eduartecliff@gmail.com");	//发件人账号
          define('MAIL_PASS',"907382289Zcy");	//发件密码
          define('MAIL_FROM',"eduartecliff@gmail.com");	//发件人邮箱
          $user=$_POST["email"];
          $passwd=$_POST["passwd"];
          if($user!=""){
              $hash_user=md5(urldecode($user));
              $connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die('数据库连接失败，错误信息：'.mysqli_error($connect));	//数据库连接
              mysqli_select_db($connect,DB_NAME) or die('数据库连接错误，错误信息：'.mysqli_error($connect));		//选择库
              $query = "SELECT * FROM USER_DATA WHERE `USER_ID`='" . $hash_user . "'";
              $result = mysqli_query($connect,$query);
              while($row = mysqli_fetch_assoc($result)) {
                      $str = array(
                          'hash_pass' => $row["USER_PASS"]
                      );
              }
              $hash_pass=md5(urldecode($passwd));
              if($str["hash_pass"]==$hash_pass){
                  setcookie("user",$hash_user,time()+2592000);
                  setcookie("pass",$hash_pass,time()+2592000);
              }
              elseif(!isset($str["hash_pass"])){
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
                  $body=str_replace("$!PASSWORD!$",$pass,$body);
                  $body=str_replace("$!HTTP-REQUEST!$",$hash_user,$body);
                  $mail->Body = $body;
                  $status = $mail->send();
              }
          }
          elseif(isset($_COOKIE["user"])&&isset($_COOKIE["pass"])){
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
                  echo file_get_contents("../templates/indexbody__loggedin.tpl");
              }
              else{
                echo file_get_contents("../templates/index_body.tpl");
              }
          }
          else{
            echo file_get_contents("../templates/index_body.tpl");
          }
        }
  		else{
        	header('location:/install/install.php');
        }
	?>