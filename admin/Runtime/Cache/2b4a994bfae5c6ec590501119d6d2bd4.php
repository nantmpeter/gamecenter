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
<form name="searchform" action="<?php echo U('Game/game_list');?>" method="post">
<table class="search-form" cellspacing="0" width="100%">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
			游戏名：  <input value="<?php echo ($gamename); ?>" class="input-text" name="gamename" type="text">  
游戏类型：  <select name="gametype" id="gametype">
<option value="">请选择游戏类型</option>
<?php if(is_array($list_type)): $i = 0; $__LIST__ = $list_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id']==$type){echo 'selected';} ?>><?php echo ($vo["typename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
<input name="search" class="button" value="搜索" type="submit">
	</div>
		</td>
		</tr>
    </tbody>
</table>
</form>

<form name="myform" action="__URL__/game_delete" method="post">
<div class="table-list">
<table cellspacing="0" width="100%">
	<thead>
		<tr>
			<th align="left" width="20"><input value="" id="check_box" onclick="selectall('gid[]');" type="checkbox"></th>
			<th align="left"></th>
			<th align="left">游戏ID</th>
			<th align="left">游戏名称</th>
			<th align="left">游戏类型</th>
			<th align="left">接口缩写</th>
			<th align="left">状态</th>
			<th align="left">游戏开服时间</th>
			<th align="left">排序</th>
			<th align="center">操作</th>
		</tr>
	</thead>
<tbody>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
		<td align="left"><input value="<?php echo ($vo["gid"]); ?>" name="gid[]" type="checkbox"></td>
		<td align="left"></td>
		<td align="left"><?php echo ($vo["gid"]); ?></td>
		<td align="left"><?php echo ($vo["gamename"]); ?></td>
		<td align="left"><?php echo ($vo["typename"]); ?></td>
		<td align="left"><?php echo ($vo["tag"]); ?></td>
		<td align="left"><?php if($vo["isdisplay"] == 1): ?>不显示

<?php else: ?> 显示<?php endif; ?>
</td>
		<td align="left"><?php echo (date("y-m-d",$vo["game_starttime"])); ?></td>
		<td align="left"><?php echo ($vo["sort"]); ?></td>
		<td align="center">
			<a href="__URL__/game_edit/gid/<?php echo ($vo["gid"]); ?>">修改</a> | <a  href="__URL__/game_delete/gid/<?php echo ($vo["gid"]); ?>">删除</a>| <a href="__URL__/server_add/gid/<?php echo ($vo["gid"]); ?>">增加开服</a>
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
<script type="text/javascript"> 


</script>
</div>
</body></html>