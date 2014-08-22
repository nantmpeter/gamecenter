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
<form name="searchform" action="<?php echo U('Game/server_list');?>" method="post">
<table class="search-form" cellspacing="0" width="100%">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
			开服名称：  <input value="<?php echo ($servername); ?>" class="input-text" name="servername" type="text">  
状态：  <select name="status" id="status">
<option value="" >请选择区服状态</option>
<option value="0" <?php if($status =='0'){echo 'selected';} ?>>推荐</option>
<option value="1"<?php if($status=='1'){echo 'selected';} ?>>不推荐</option>
</select>
所属游戏：<select name="gid" id="gid">
<option value="">请选择游戏</option>
<?php if(is_array($game_list)): $i = 0; $__LIST__ = $game_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["gid"]); ?>" <?php if($vo['gid']==$gid){echo 'selected';} ?>><?php echo ($vo["gamename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
<input name="search" class="button" value="搜索" type="submit">
	</div>
		</td>
		</tr>
    </tbody>
</table>
</form>

<form name="myform" action="__URL__/server_delete" method="post">
<div class="table-list">
<table cellspacing="0" width="100%">
	<thead>
		<tr>
			<th align="left" width="20"><input value="" id="check_box" onclick="selectall('sid[]');" type="checkbox"></th>
			<th align="left"></th>
			<th align="left">区服ID</th>
			<th align="left">游戏名</th>
			<th align="left">区服名称</th>
			<th align="left">区服线路</th>
			<th align="left">状态</th>
			<th align="left">开服时间</th>
			<th align="center">操作</th>
		</tr>
	</thead>
<tbody>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
		<td align="left"><input value="<?php echo ($vo["sid"]); ?>" name="sid[]" type="checkbox"></td>
		<td align="left"></td>
		<td align="left"><?php echo ($vo["sid"]); ?></td>
		<td align="left"><?php echo ($vo["gamename"]); ?></td>
		<td align="left"><?php echo ($vo["servername"]); ?></td>
		<td align="left"><?php echo ($vo["line"]); ?></td>
		<td align="left"><?php if($vo["status"] == 0): ?>推荐
<?php else: ?> 不推荐<?php endif; ?>
</td>
		<td align="left"><?php echo (date("y-m-d H:i",$vo["start_time"])); ?></td>
		<td align="center">
			<a href="__URL__/server_edit/sid/<?php echo ($vo["sid"]); ?>">修改</a> | <a href="__URL__/server_delete/sid/<?php echo ($vo["sid"]); ?>">删除</a>
		</td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</tbody>
</table>
 <div class="btn"><label for="check_box">全选/取消</label>
		<input class="button" value="删除"    type="submit">
	</div>

<div align="right"><?php echo ($page); ?></div>
</div>
</form>
</div>
</body></html>