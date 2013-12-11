<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Actober</title>
<script type="text/javascript" src="tpl/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="tpl/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="tpl/js/fabric.min.js" ></script>
<script type="text/javascript" src="tpl/js/modernizr.custom.50476.js"></script>
<script type="text/javascript" src="tpl/js/url.min.js"></script>

<link rel="stylesheet" type="text/css" href="tpl/css/sunny/jquery-ui-1.10.3.custom.min.css" />
<link rel="stylesheet" type="text/css" href="tpl/css/actober.css" />

</head>

<body>
<div id="whole_block">
	<div id="header">
		<span class="logo">
			<!--
			<img src="tpl/images/actober-logo.png" height="80">
			-->
		</span>
	</div>
	<div id="design_block" align="center">
		<div id="actober_desktop">
			<div id="company_name">Actober Design</div>
			<div id="tools_block">
				<div id="actober_functions">
					<div>
						<span class="function_button">正面</span>
						<span class="function_button">反面</span>
						<span class="function_button">右側</span>
						<span class="function_button">左側</span>
					</div>
					<div style="padding-top:22px;">
						<span class="function_button">存檔</span>
						<span class="function_button">開啟</span>
						<span class="function_button">列印</span>
					</div>
				</div>
				
				<div id="actober_tools">
					<h3>衣服顏色</h3>
					<div>
							<div id="color_list">
							</div>
							
					</div>
					<h3>圖案</h3>
					<div>
						<p>
						Mauris mauris ante, blandi
						</p>
					</div>
					<h3>上傳照片</h3>
					<div>
						<p>
						上傳自己的照片
						</p>
					</div>
					<h3>字型</h3>
					<div>
						<p>
						Sed non urna. 
						</p>
					</div>
					<h3>姓名或編號</h3>
					<div>
						<p>
						Sed non urna. 
						</p>
					</div>
				</div>
			</div>
			<canvas id="actober_painter"></canvas>
		</div>
	</div>
</div>
<!-- upload images -->
<div id="upload_image_window">
	<div class="window_bar">
	    <span class="window_title">上傳照片</span>
		<img src="tpl/images/icons/window-close.png" class="window_close_button">
	</div>
	<div id="custom_upload_file_list">
		<div>
			<input type="file" name="custom_upload_files[]" />
			<img src="tpl/images/icons/add.png" onclick="add_more_upload_field()">
		</div>
	</div>
	<span id="custom_upload_button" class="button_style">上傳</span>
</div>
<script type="text/javascript" src="tpl/js/actober.js"></script>
<script type="text/javascript" src="tpl/js/actober-ui.js"></script>
</body>
</html>

