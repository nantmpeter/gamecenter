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
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/jquery-1.8.0.min.js"></script>
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/admin_common.js"></script>
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/styleswitch.js"></script>
</head>
<body>
<div class="subnav">
    <div class="content-menu ib-a blue line-x">
    </div>
<style type="text/css">
	html{_overflow-y:scroll}
</style><div class="pad-lr-10">
<form name="searchform" action="<?php echo U('Statistical/fcm_list');?>" method="post">
<table class="search-form" cellspacing="0" width="100%">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
			用户名：  <input value="<?php echo ($username); ?>" class="input-text" name="username" type="text">  
是否开启：  <select name="is_fcm" id="is_fcm">
<option value="">请选择状态</option>
<option value="0" <?php if($is_fcm=='0'){echo 'selected';} ?>>开启</option>
<option value="1" <?php if($is_fcm=='1'){echo 'selected';} ?>>关闭</option>
</select>
<input name="search" class="button" value="搜索" type="submit">
	</div>
		</td>
		</tr>
    </tbody>
</table>
</form>

<form name="myform" action="__URL__/fcm_batch" method="post">
<div class="table-list">
<table cellspacing="0" width="100%">
	<thead>
		<tr>
		<th align="left" width="20"><input value="" id="check_box" onclick="selectall('uid[]');" type="checkbox"></th>
			<th align="left"></th>
			<th align="left">用户ID</th>
			<th align="left">用户名</th>
			<th align="left">真实姓名</th>
			<th align="left">身份证</th>
			<th align="left">注册时间</th>
			<th align="left">最后登录</th>
			<th align="left">是否开启防沉迷</th>
	
			<th align="center">操作</th>
		</tr>
	</thead>
<tbody>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
	<td align="left"><input value="<?php echo ($vo["uid"]); ?>" name="uid[]" type="checkbox"></td>
		<td align="left"></td>
		<td align="left"><?php echo ($vo["uid"]); ?></td>
		<td align="left"><?php echo ($vo["username"]); ?></td>
		<td align="left"><?php echo ($vo["realname"]); ?></td>
<td align="left"><?php echo ($vo["id_card"]); ?></td>
		<td align="left"><?php echo (date("y-m-d H:i:s",$vo["register_time"])); ?>
</td>
		<td align="left">
		
	
<?php echo (date("y-m-d H:i:s",$vo["lastlogin_time"])); ?>


</td>
		<td align="left"><?php if($vo["is_fcm"] == 0 ): ?>开启
<?php else: ?> 关闭<?php endif; ?></td>
		<td align="center">
			<a href="__URL__/fcm_edit/uid/<?php echo ($vo["uid"]); ?>">修改</a> 
		</td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</tbody>
</table>
  <div class="btn"><label for="check_box">全选/取消</label>
		<input class="button" value="批量关闭" type="submit">
			<input class="button" name="dosubmit" onclick="document.myform.action='__URL__/fcm_open'" value="批量开启" type="submit">
		</div>
<div align="right"><?php echo ($page); ?></div>
</div>
</form>
<script type="text/javascript"> 
function confirm_delete(){
	if(confirm('确认删除吗？')) $('#myform').submit();
}

</script>
</div>
</body></html>