<body class="wp-core-ui">
<h1 class="screen-reader-text">设置您的数据库连接</h1>
<form method="post" action="install.php?step=3">
	<p>请在下方填写您的数据库连接信息。</p>
	<table class="form-table">
		<tr>
			<th scope="row"><label for="dbname">数据库名</label></th>
			<td><input name="dbname" id="dbname" type="text" size="25" value="greenhat" /></td>
			<td>将程序安装到哪个数据库？</td>
		</tr>
		<tr>
			<th scope="row"><label for="uname">用户名</label></th>
			<td><input name="uname" id="uname" type="text" size="25" value="用户名" /></td>
			<td>您的数据库用户名。</td>
		</tr>
		<tr>
			<th scope="row"><label for="pwd">密码</label></th>
			<td><input name="pwd" id="pwd" type="text" size="25" value="密码" autocomplete="off" /></td>
			<td>您的数据库密码。</td>
		</tr>
		<tr>
			<th scope="row"><label for="dbhost">数据库主机</label></th>
			<td><input name="dbhost" id="dbhost" type="text" size="25" value="localhost" /></td>
			<td>如果<code>localhost</code>不能用，您通常可以从网站服务提供商处得到正确的信息。</td>
		</tr>
	</table>
	<p class="step"><input name="submit" type="submit" value="提交" class="button button-large" /></p>
</form>
<script type='text/javascript' src='jquery.js'></script>
<script type='text/javascript' src='jquery-migrate.min.js'></script>
</body>
</html>