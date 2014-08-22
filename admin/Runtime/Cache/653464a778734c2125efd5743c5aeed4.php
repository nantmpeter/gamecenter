<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<!--
-->
<title><?php echo ($data["sitename"]); ?>-系统后台管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="__PUBLIC__/images/login.css" type="text/css">
<script src="__PUBLIC__/js/jquery-1.4.2.js"></script>
<script src="__PUBLIC__/js/dialog/jquery.artDialog.js?skin=idialog" type="text/javascript"></script>
<script src="__PUBLIC__/js/dialog/plugins/iframeTools.js" type="text/javascript"></script>

<script>
$(document).ready(function(){
	 $('#form1').submit(function(){
		 var $username = $('#username').val();
		 var $password = $('#password').val();
		 if($username==""||$password==""){
			 $.dialog.tips('用户名或者密码不能为空,请检查输入!');
			 return false;
			 }
	 })
	 
})
</script>
</HEAD>
<BODY>
<div class="LoginCont">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <form id="form1" method="post" action="<?php echo ($action); ?>">
  <tr>
    <td class="left">
    	<div><span class="word">帐号：</span><span><input type="text" name="loginname" class="input" id="username"></span></div>
        <div><span class="word">密码：</span><span><input type="password" name="loginpwd" class="input" id="password"></span></div>
<!---->
    </td>
    <td class="right"><input class="submit" type="image" src="__PUBLIC__/images/login.gif"></td>
  </tr>
  </form>
</table>
</div>
</BODY>
</HTML>
<!---->