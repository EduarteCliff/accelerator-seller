<?php
	echo "helloworld!";
	include '../config/config.php';
	if(isset($_COOKIE["user"])){
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
    	if($hash_pass!=$str["hash_pass"]) header("location:/clientarea/login.php");
      	else{
          echo "<br>";
          echo "loggedin";
        }
    }else header("location:/clientarea/login.php");
?>