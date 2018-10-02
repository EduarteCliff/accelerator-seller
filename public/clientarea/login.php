<!doctype html>
<html lang="ZH_CN">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.21.1/sweetalert2.all.min.js"></script>
	<script src='https://www.recaptcha.net/recaptcha/api.js'></script>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<title>登录</title>
  	<style type="text/css">
		.form-bg{
		    padding: 2em 0;
		}
		.form-horizontal{
		    background: #fff;
		    padding-bottom: 40px;
		    border-radius: 15px;
		    text-align: center;
		}
		.form-horizontal .heading{
		    display: block;
		    font-size: 35px;
		    font-weight: 700;
		    padding: 35px 0;
		    border-bottom: 1px solid #f0f0f0;
		    margin-bottom: 30px;
		}
		.form-horizontal .form-group{
		    padding: 0 40px;
		    margin: 0 0 25px 0;
		    position: relative;
		}
		.form-horizontal .form-control{
		    background: #f0f0f0;
		    border: none;
		    border-radius: 20px;
		    box-shadow: none;
		    padding: 0 20px 0 45px;
		    height: 40px;
		    transition: all 0.3s ease 0s;
		}
		.form-horizontal .form-control:focus{
		    background: #e0e0e0;
		    box-shadow: none;
		    outline: 0 none;
		}
		.form-horizontal .form-group i{
		    position: absolute;
		    top: 12px;
		    left: 60px;
		    font-size: 17px;
		    color: #c8c8c8;
		    transition : all 0.5s ease 0s;
		}
		.form-horizontal .form-control:focus + i{
		    color: #00b4ef;
		}
		.form-horizontal .fa-question-circle{
		    display: inline-block;
		    position: absolute;
		    top: 12px;
		    right: 60px;
		    font-size: 20px;
		    color: #808080;
		    transition: all 0.5s ease 0s;
		}
		.form-horizontal .fa-question-circle:hover{
		    color: #000;
		}
		.form-horizontal .main-checkbox{
		    float: left;
		    width: 20px;
		    height: 20px;
		    background: #11a3fc;
		    border-radius: 50%;
		    position: relative;
		    margin: 5px 0 0 5px;
		    border: 1px solid #11a3fc;
		}
		.form-horizontal .main-checkbox label{
		    width: 20px;
		    height: 20px;
		    position: absolute;
		    top: 0;
		    left: 0;
		    cursor: pointer;
		}
		.form-horizontal .main-checkbox label:after{
		    content: "";
		    width: 10px;
		    height: 5px;
		    position: absolute;
		    top: 5px;
		    left: 4px;
		    border: 3px solid #fff;
		    border-top: none;
		    border-right: none;
		    background: transparent;
		    opacity: 0;
		    -webkit-transform: rotate(-45deg);
		    transform: rotate(-45deg);
		}
		.form-horizontal .main-checkbox input[type=checkbox]{
		    visibility: hidden;
		}
		.form-horizontal .main-checkbox input[type=checkbox]:checked + label:after{
		    opacity: 1;
		}
		.form-horizontal .text{
		    float: left;
		    margin-left: 7px;
		    line-height: 20px;
		    padding-top: 5px;
		    text-transform: capitalize;
		}
		.form-horizontal .btn{
		    float: right;
		    font-size: 14px;
		    color: #fff;
		    background: #00b4ef;
		    border-radius: 30px;
		    padding: 10px 25px;
		    border: none;
		    text-transform: capitalize;
		    transition: all 0.5s ease 0s;
		}
		@media only screen and (max-width: 479px){
		    .form-horizontal .form-group{
		        padding: 0 25px;
		    }
		    .form-horizontal .form-group i{
		        left: 45px;
		    }
		    .form-horizontal .btn{
		        padding: 10px 20px;
		    }
		}
	</style>
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
          		header("location:/clientarea");
          		echo "<form method='POST' action='/clientarea' class='cd-form floating-labels'>
							<input type='submit' class='btn btn-default' value='进入客户中心'>
					  </form>";
          		die("</body></html>");
    	    }
  			endfunc:
          ?>
  		  <div class="demo form-bg" style="padding: 20px 0;">
		        <div class="container">
		            <div class="row">
		                <div class="col-md-offset-3 col-md-6">
		                    <form method="POST" class="form-horizontal">
		                        <span class="heading">用户登录</span>
		                        <div class="form-group">
		                            <input type="email" class="form-control" id="inputEmail3" placeholder="用户名或电子邮件" name="email">
		                            <i class="fa fa-user"></i>
		                        </div>
		                        <div class="form-group help">
		                            <input type="password" class="form-control" id="inputPassword3" placeholder="密码" name="passwd">
		                            <i class="fa fa-lock"></i>
		                            <a href="#" class="fa fa-question-circle"></a><br>
                                    <div class="g-recaptcha"data-sitekey="6LeK-3IUAAAAAMKVQi8eym1MHjrtGAnQpBNPQDXp" style="margin:0 auto;"></div>
		                        </div>
		                            <button type="submit" class="btn btn-default">登录</button>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>
</body>
</html>