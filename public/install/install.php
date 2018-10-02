<!DOCTYPE html>
<html lang="ZH_CN">
<head>
	<title>GreenHat游戏加速器主页-安装程序</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex,nofollow" />
	<link rel='stylesheet' id='buttons-css'  href='buttons.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='install-css'  href='install.min.css' type='text/css' media='all' />
</head>
<?php
	if(!file_exists("install_lock")){
		$step=$_GET["step"];
		if(!isset($step) || $step=="1"){
			echo "<body class='wp-core-ui'>";
			echo "<p>欢迎使用GreenHat游戏加速器主页。在开始前，我们需要您数据库的一些信息。请准备好如下信息。</p>";
			echo "<ol>
					<li>数据库名</li>
					<li>数据库用户名</li>
					<li>数据库密码</li>
					<li>数据库主机</li>
				</ol>";
			echo "我们会使用这些信息创建一个<code>config.php</code>文件,您可以随时修改它";
			echo "<p class='step'><a href='install.php?step=2' class='button button-large'>现在就开始！</a></p>";
			echo "</body>\n</html>";
		}
		elseif($step=="2"){
			echo file_get_contents('step2.tpl');
		}
		elseif($step=="3"){
			$host=$_POST["dbhost"];
			$user=$_POST["uname"];
			$pwd=$_POST["pwd"];
			$dbname=$_POST["dbname"];
			$conn=mysqli_connect($host, $user, $pwd) or die("Error-数据库连接失败！");
			$connection=mysqli_select_db($conn,$dbname) or die("Error-数据库选择失败！");
			if($connection){
				$file = fopen("config.php", "w");
				$txt = "<?php\ndefine('DB_HOST','".$host."');\ndefine('DB_NAME','".$dbname."');\ndefine('DB_PASS','".$pwd."');\ndefine('DB_USER','".$user."');\n?>";
				fwrite($file, $txt);
				fclose($file);
				echo file_get_contents('step3.tpl');
			}
		}
		elseif($step=="4"){
			include "config.php";
			$conn=mysqli_connect(DB_HOST, DB_USER,DB_PASS) or die("Error-数据库连接失败！");
			$connection=mysqli_select_db($conn,DB_NAME) or die("Error-数据库选择失败！");
			$query="CREATE TABLE `".DB_NAME."`.`USER_DATA` ( `USER_PASS` TEXT NOT NULL , `USER_ID` TEXT NOT NULL , `EMAIL` TEXT NOT NULL ) ENGINE = InnoDB;";
			mysqli_query($conn,$query) or die("新增错误");
			fopen("install_lock", "w");
			header('location:/install_finish.php');
		}
	}
	else{
		echo "<p>程序已经安装！</p>";
	}
?>
</html>