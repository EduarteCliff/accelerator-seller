<!DOCTYPE html>
<html lang="ZH_CN">
<head>
	<title>GreenHat游戏加速器主页-安装完成</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex,nofollow" />
	<link rel='stylesheet' id='buttons-css'  href='./install/buttons.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='install-css'  href='./install/install.min.css' type='text/css' media='all' />
</head>
<?php
	echo file_get_contents('./install/finish.tpl');
	unlink("./install/finish.tpl");
	unlink("./install/install.php");
	unlink("./install/buttons.min.css");
	unlink("./install/install.min.css");
	unlink("./install/jquery.js");
	unlink("./install/jquery-migrate.min.js");
	unlink("./install/step2.tpl");
	unlink("./install/step3.tpl");
	unlink("./install_finish.php");
	rename("install","config") or die("无法完成重命名");
?>
</html>