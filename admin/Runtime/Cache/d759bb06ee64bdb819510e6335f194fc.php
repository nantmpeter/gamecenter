<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>31wan - 后台管理中心</title>
<link href="__PUBLIC__/admin/css/reset.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/admin/css/zh-cn-system.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/admin/css/table_form.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/style/zh-cn-styles1.css" title="styles1" media="screen">
<link rel="alternate stylesheet" type="text/css" href="__PUBLIC__/admin/css/style/zh-cn-styles2.css" title="styles2" media="screen">
<link rel="alternate stylesheet" type="text/css" href="__PUBLIC__/admin/css/style/zh-cn-styles3.css" title="styles3" media="screen">
<link rel="alternate stylesheet" type="text/css" href="__PUBLIC__/admin/css/style/zh-cn-styles4.css" title="styles4" media="screen">
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/admin_common.js"></script>
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/styleswitch.js"></script>

<script type="text/javascript">
	window.focus();
	var pc_hash = 'r32q3e';
	</script>
</head>
<body>
<style type="text/css">
	html{_overflow-y:scroll}
	
</style><div id="main_frameid" class="pad-10" style="_margin-right:-12px;_width:98.9%;">
<script type="text/javascript">
$(function(){if ($.browser.msie && parseInt($.browser.version) < 7) $('#browserVersionAlert').show();}); 
</script>
<div class="explain-col mb10" style="display:none" id="browserVersionAlert">
使用IE8浏览器可获得最佳视觉效果</div>
<div class="col-2 lf mr10" style="width:48%">
	<h6>我的个人信息</h6>
	<div class="content">
	<?php echo ($data["sitename"]); ?>客户您好，<?php echo (session('user')); ?><br>
	您所属角色：<?php echo (session('group')); ?> <br>
	<div class="bk20 hr"><hr></div>
	上次登录时间：<?php echo (date("Y-m-d H:i:s",$info["time"])); ?><br>
	上次登录IP：<?php echo ($info["ip"]); ?> <br>
	</div>
</div>
<div class="col-2 col-auto">
	<h6>安全警示</h6>
	<div class="content" style="color:#ff0000;">
	
※ 禁止把源码给予（或出售）第三方，会失去售后和永久更新。<br>
※ 如果您的网站出现问题，请记住您的操作，方便技术处理。<br>
	<div class="bk20 hr"><hr></div>	
※ 31玩平台源码，是使用开源THINKPHP系统内核，方便您扩展。<br>
※ 有任何技术或运营问题，请及时联系在线客服或是售后服务。<br>
	</div>
</div>
<div class="bk10"></div>
<div class="col-2 lf mr10" style="width:48%">
	<h6>官方新闻</h6>
	<div class="content" id="admin_panel">
	<ul>
	<script src="http://www.31wan.cn/api.php?mod=js&bid=12" type="text/javascript"></script>
	</ul>
	</div>
</div>
<div class="col-2 col-auto">
	<h6>系统信息</h6>
	<div class="content">
	程序版本： <?php echo C('VERSION'); ?> <br>
	操作系统：<?php $os = explode(" ", php_uname()); echo $os[0]; ?> &nbsp;内核版本：<?php if('/'==DIRECTORY_SEPARATOR){echo $os[2];}else{echo $os[1];} ?><br>
	服务器软件：<?php echo $_SERVER['SERVER_SOFTWARE']; ?> <br>
	MySQL 版本：<?php echo mysql_get_server_info() ?><br>
	上传文件：<?php echo ini_get('upload_max_filesize'); ?><br>	
	</div>
</div>
<div class="bk10"></div>
<div class="col-2 lf mr10" style="width:48%">
	<h6>31wan团队</h6>
	
	<div class="content">
	官方网站:　<a href="http://www.31wan.cn/" target="_blank">http://www.31wan.cn/</a> <br>
        授权网站:　<a href="http://www.<?php echo ($domain); ?>/" target="_blank">http://www.<?php echo ($domain); ?>/</a><br> 
	</div>
</div>

<div class="col-2 col-auto">
	<h6>授权信息</h6>
	<div class="content">
	程序版本：V2.1 [<a href="http://www.31wan.cn" target="_blank">技术支持与服务</a>]<br>
	授权类型：<span id="31wanlink"><script src="http://demo.31wan.cn/license/search?domain=<?php echo ($domain); ?>" type="text/javascript"></script></span><br>
	</div>
</div>
    <div class="bk10"></div>
</div>