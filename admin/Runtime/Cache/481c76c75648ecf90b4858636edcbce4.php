<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
<script src="__PUBLIC__/js/dialog/plugins/iframeTools.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/calendar/jscal2.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/calendar/border-radius.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/calendar/win2k.css">
<script type="text/javascript" src="__PUBLIC__/js/calendar/calendar.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/calendar/lang/en.js"></script>
<script language="javascript" type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
</head>
<body>
<style type="text/css">
	html{_overflow-y:scroll}
</style>
<script>
</script>

<div class="pad-10">
<div class="col-tab">

<div id="div_setting_1" class="contentList pad-10" style="">
<form action="<?php echo U('Global/manager_add');?>" method="post" id="myform" >
<table class="table_form contentWrap" width="100%">
<tbody><tr>
<td>用户名</td> 
<td><input name="username" value="" class="input-text" id="username" type="text"></td>
</tr>
<tr>
<td>密码</td>
<td><input name="password" value="" class="input-text" id="password" type="password"></td>
</tr>
<tr>
<td>email</td>
<td><input name="email" value="" class="input-text" id="email" type="text"></td>
</tr>
<tr>
<td>所属角色</td>
<td>
<select name="roleid" id="roleid">
<?php if(is_array($role_list)): $i = 0; $__LIST__ = $role_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["roleid"]); ?>" ><?php echo ($vo["rolename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>

</td>
</tr>
</tbody></table>
</div>

<div class="bk15"></div>

<input name="dosubmit" type="submit" value="提交" class="button">
</form>
</div>

 

</body></html>