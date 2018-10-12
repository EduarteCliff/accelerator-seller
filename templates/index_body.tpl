	<div id="text" style="position:absolute;z-index:1;margin-top:67vh;margin-left:2%;">
		<div style="color:white;font-size:6vh;">使用GreenHat&trade;游戏加速器</div>
		<div style="color:white;font-size:4vh;">优化您的游戏体验</div>
	</div>
<div class="outer-container" style="position:absolute;z-index:0;">
    	<div class="inner-container">
    	<div id="container">
		<div id="scene">
			<div data-depth="0.07"><img src="./assets/images/layer1.jpg"></div>
			<div data-depth="0.05" style="margin-top:1.7%;"><img src="./assets/images/layer2.png"></div>
		</div>
	</div>
	</div>
	</div>
    	<script src="./js/parallax.min.js"></script>
	<script>
	var scene = document.getElementById('scene');
	var parallax = new Parallax(scene);
	</script>
	<div class="footer">
		<center>
			<form method="POST" id="rgform">
				<div style="float: left;margin-left:4.5%;width:39%;margin-top:1%;margin-bottom:1%;" id="email">
					<input type="email" class="form-control" id="cd-email" name="email" placeholder="邮箱">
				</div>
				<div style="float: left;margin-left:4.5%;width:39%;margin-top:1%;margin-bottom:1%;" id="username">
					<input type="text" class="form-control" id="cd-text" name="username" placeholder="用户名">
				</div>
				<div style="float: left;margin-left:1.5%;width:39%;margin-top:1%;margin-bottom:1%;" id="passwd">
					<input type="password" class="form-control" id="cd-company" name="passwd" placeholder="密码">
				</div>
				<div style="float: left;margin-left:1.5%;margin-top:1%;margin-bottom:1%;">
					<button data-sitekey="6LfUBnMUAAAAAGqnrBETNBnURJARXLYQAXaUUwcr" data-callback="onSubmit" class="g-recaptcha btn btn-primary">登陆/注册</button>
				</div>
			</form>
		</center>
		<script src="js/jquery-1.8.3.min.js"></script>
		<script src="js/main.js"></script>
	</div>
</body>
</html>
