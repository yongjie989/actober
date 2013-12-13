<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Actober</title>
<script type="text/javascript" src="tpl/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="tpl/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="tpl/js/url.min.js"></script>
<link rel="stylesheet" type="text/css" href="tpl/css/sunny/jquery-ui-1.10.3.custom.min.css" />
<link rel="stylesheet" type="text/css" href="tpl/css/actober.css" />
</head>

<body>
<div id="whole_block">
	<div id="header">
		<div >
		<span onclick="open_page('product')">產品</span> 
		<span onclick="open_page('singup')">註冊</span> 
		<span onclick="open_page('singin')">登入</span>
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1382707091957767";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		</div>
	</div>
	<div id="design_block" align="center">
		<div class="empty_header"></div>
		<div id="actober_normal_desktop">
			<form name="form" action="" method="POST" enctype="multipart/form-data">
				
			</form>
		</div>
	</div>

</div>

<script type="text/javascript" src="tpl/js/actober-ui.js"></script>
</body>
</html>

