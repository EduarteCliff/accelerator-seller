<body>
	<div class="outer-container">
    	<div class="inner-container">
    	<div id="container">
		<div id="scene">
			<div data-depth="0.07"><img src="./assets/images/layer1.jpg"></div>
			<div data-depth="0.05"><img src="./assets/images/layer2.png"></div>
		</div>
	</div>
	</div>
	</div>
    	<script src="./js/parallax.js"></script>
	<script>
	var scene = document.getElementById('scene');
	var parallax = new Parallax(scene);
	</script>
<div class="footer">
	<form method="POST" class="cd-form floating-labels">
		<fieldset style="width: 100%; height: auto; ">
			<div style="float: left; margin-left: 30px; width: 42%;">
				<label class="cd-label" for="cd-email" style="width: 200%">邮箱</label>
				<input type="email" class="cd-email" id="cd-email" name="email">
			</div>
			<div style="float: left; margin-left: 20px; width: 42%; ">
				<label class="cd-label" for="cd-company">密码</label>
				<input type="password" class="cd-company" id="cd-company" name="passwd">
			</div>
			<br>
			<input type="submit" class="btn btn-default" value="登陆/注册" style="display:inline; margin-top: 12px; margin-right: 30px; ">
		</fieldset>
	</form><div class="g-recaptcha" data-sitekey="6LeK-3IUAAAAAMKVQi8eym1MHjrtGAnQpBNPQDXp"></div>
	<script src="js/jquery-1.8.3.min.js"></script>
	<script src="js/main.js"></script>
</div>

</body>
</html>