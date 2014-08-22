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


<form name="myform" action="__URL__/gametype_delete" method="post" >
<div class="table-list">
<table cellspacing="0" width="100%">
	<thead>
		<tr>
			<th align="left" width="20"><input value="" id="check_box" onclick="selectall('id[]');" type="checkbox"></th>
			<th align="left"></th>
			<th align="left">游戏类型ID</th>
			<th align="left">类型名称</th>
			<th align="center">操作</th>
		</tr>
	</thead>
<tbody>
<?php if(is_array($gametype)): $i = 0; $__LIST__ = $gametype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
		<td align="left"><input value="<?php echo ($vo["id"]); ?>" name="id[]" type="checkbox"></td>
		<td align="left"></td>
		<td align="left"><?php echo ($vo["id"]); ?></td>
		<td align="left"><?php echo ($vo["typename"]); ?></td>
		<td align="center">
			<a href="__URL__/gametype_edit/id/<?php echo ($vo["id"]); ?>">修改</a> | <a href="__URL__/gametype_delete/id/<?php echo ($vo["id"]); ?>">删除</a> 
		</td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</tbody>
</table>
 <div class="btn"><label for="check_box">全选/取消</label>
		<input class="button" value="删除"    type="submit">
			</div>
</div>
</form>
</div>
</body></html>