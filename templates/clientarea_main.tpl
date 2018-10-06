<!doctype html>
<html lang="ZH_CN">
  <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.21.1/sweetalert2.all.min.js"></script>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Area</title>
  </head>
  <body>
    <h1 style="margin-left: 2%;">Client Area</h1>
    <div class="pure-menu custom-restricted-width" style="width=30%">
      <ul class="pure-menu-list" style="margin-left: 1%;">
	      <li class="pure-menu-item pure-menu-selected"><a href="/clientarea/logout.php" class="pure-menu-link">登出</a></li>
	      <li class="pure-menu-item"><a href="/clientarea/?q=info" class="pure-menu-link">查看配置</a></li>
	      <li class="pure-menu-item"><a href="/clientarea/?q=charge" class="pure-menu-link">充值</a></li>
      </ul>
    </div><br>
    <table class="pure-table" style="margin-left: 2%;">
    <thead>
        <tr>
            <th>#</th>
            <th>剩余使用时长</th>
            <th>累计使用</th>
            <th>累计消费</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>#</td>
            <td>%!time!%</td>
            <td>%!used!%</td>
            <td>%!charged!%</td>
        </tr>
    </tbody>
   </table>
	<h2 style="margin-left: 2%;">联系我们</h2>
	<h3 style="margin-left: 2%;">在使用中遇到问题？点击按钮联系我们</h3>
	<a class="pure-button pure-button-primary" href="#" style="margin-left: 2%;">点击联系我们</a>
	</body>
</html>
