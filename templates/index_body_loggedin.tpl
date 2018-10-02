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
	<form method="POST" action="clientarea.php" class="cd-form floating-labels">
	<input type="submit" class="btn btn-default" value="进入客户中心" style="display:inline; margin-top: 12px; margin-bottom:-5px;margin-left= -40px">
	</form>
</div>

</body>
</html>