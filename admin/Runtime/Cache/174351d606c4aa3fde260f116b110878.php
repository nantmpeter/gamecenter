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

<table class="search-form" cellspacing="0" width="100%">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
			<a href="__URL__/menu_add">添加后台栏目</a>
	</div>
		</td>
		</tr>
    </tbody>
</table>
<form name="myform" action="__URL__/menu_listorders" method="post">
<div class="table-list">
<table cellspacing="0" width="100%">

  <thead>
		<tr>

			<th align="left">排序</th>
			<th align="left">序号</th>
			<th align="left">菜单英文名称</th>
			<th align="left">管理操作</th>
		
		</tr>
	</thead>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
    <td align="left"><input name="listorders[<?php echo ($vo["id"]); ?>]" size="3" value="<?php echo ($vo["listorder"]); ?>" class="input-text-c input-text" type="text"></td>
    <td align="left"><?php echo ($vo["id"]); ?></td>
    <td class="tdleft"><?php echo ($vo["space"]); echo ($vo["cname"]); ?><font color="blue">
	<font color="blue"><?php if(($vo["hidden"]) == "1"): ?>[隐藏]-<?php echo ($vo["module_alias"]); else: ?>(<?php echo ($vo["module_alias"]); ?>)<?php endif; ?></font>
	</td>
    


    <td width="17%" align="left"><a class="btn btn-primary btn-mini" href="__URL__/menu_edit/id/<?php echo ($vo["id"]); ?>">编辑</a>  <a class="btn btn-danger btn-mini" href="__URL__/menu_del/id/<?php echo ($vo["id"]); ?>" >删除</a></td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?> 
</tbody>

</table>
    
    <div class="btn"><input class="button" name="dosubmit" value="排序" type="submit"></div>  </div>
</div>
</form>
<script type="text/javascript"> 

function confirm_delete(){
	if(confirm('确认删除吗？')) $('#myform').submit();
}

</script>
</div>
</body></html>