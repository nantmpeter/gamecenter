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
<form name="searchform" action="<?php echo U('Pay/admin_pay');?>" method="post">
<table class="search-form" cellspacing="0" width="100%">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
			操作管理员：  <input value="<?php echo ($op_username); ?>" class="input-text" name="op_username" type="text">
			用户：    <input value="<?php echo ($username); ?>" class="input-text" name="username" type="text">  
<input name="search" class="button" value="搜索" type="submit">
	</div>
		</td>
		</tr>
    </tbody>
</table>
</form>


<div class="table-list">
<table cellspacing="0" width="100%">
	<thead>
		<tr>
			<th align="left">ID</th>
			<th align="left">操作管理员</th>
			<th align="left">充值账户</th>
			<th align="left">充值金额</th>
			<th align="left">充值时间</th>
			<th align="left">充值ip</th>
		    <th align="left">备注</th>
		</tr>
	</thead>
<tbody>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>

		<td align="left"><?php echo ($vo["id"]); ?></td>
		<td align="left"><?php echo ($vo["op_username"]); ?></td>

<td align="left"><?php echo ($vo["username"]); ?></td>
		<td align="left"><?php echo ($vo["real_money"]); ?>
</td>
	<td align="left"><?php echo (date("y-m-d H:i:s",$vo["add_time"])); ?>
</td>
		<td align="left">
<?php echo ($vo["ip"]); ?>
</td>
		<td align="left"><?php echo ($vo["remark"]); ?></td>

    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</tbody>

<tr>
 <td colspan=4>累计后台充值： <?php echo ($money); ?> 元</td> 
 
</tr>
</table>
  
<div align="right"><?php echo ($page); ?></div>
</div>


</div>
</body></html>