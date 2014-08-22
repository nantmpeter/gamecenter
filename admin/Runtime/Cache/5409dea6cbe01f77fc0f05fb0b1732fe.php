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


<form name="myform" action="" method="post">
<div class="table-list">
<table cellspacing="0" width="100%">
	<thead>
		<tr>
			<th align="left">序号</th>
			<th align="left">用户名</th>
			<th align="left">所属角色</th>
			<th align="left">最后登录IP</th>
			<th align="left">最后登录时间</th>
			<th align="left">登录次数</th>
			<th align="left">状态</th>
			<th align="center">管理操作</th>
		</tr>
	</thead>
<tbody>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>

		<td align="left"><?php echo ($vo["uid"]); ?></td>
		<td align="left"><?php echo ($vo["username"]); ?></td>
		<td align="left"><?php echo ($vo["rolename"]); ?></td>
<td align="left"><?php echo ($vo["login_ip"]); ?></td>
		<td align="left">
<?php echo (date("y-m-d H:i:s",$vo["login_time"])); ?>

</td>
		<td align="left"><?php echo ($vo["login_count"]); ?></td>
		<td align="left"><?php if($vo["status"] == 1 ): ?>锁住
<?php else: ?> 正常<?php endif; ?></td>
		<td align="center">
		<a href="__URL__/manager_edit/uid/<?php echo ($vo["uid"]); ?>">修改</a> | 
		<?php if(($vo["username"]) == "admin"): ?><font color="#cccccc">删除</font>
		<?php else: ?>
<a  href="__URL__/manager_delete/uid/<?php echo ($vo["uid"]); ?>">删除</a><?php endif; ?>
		</td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</tbody>
</table>
    
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