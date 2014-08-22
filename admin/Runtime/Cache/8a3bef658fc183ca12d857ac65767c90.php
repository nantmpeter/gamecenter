<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<!-- <link href="__PUBLIC__/admin/css/layout.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/admin/css/common.css" type="text/css" rel="stylesheet">
<link href="__PUBLIC__/admin/css/Admin_css.css" type=text/css rel=stylesheet> -->
<link href="__PUBLIC__/admin/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<link href="__PUBLIC__/admin/css/style.css" type="text/css" rel="stylesheet">
<link href="__PUBLIC__/admin/css/table_form.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="__PUBLIC__/admin/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/bootstrap.min.js"></script>
<style type="text/css">
<!--
.STYLE1 {
	font-family: tahoma, arial, \5b8b\4f53, sans-serif;
	font-size: 12px;
	line-height: 1.5;
}
-->
</style>
</head>
 
<body>
<div class="table-list">
<table cellspacing="0" width="100%">
  <thead>
    <tr class="STYLE1" >
    <th align="center">栏目名称</th>
     <th align="center">栏目ID</th>
     <th align="center">显示描述</th>
     <th align="center">用户投稿</th>
     <th align="center">导航排序</th>
     <th align="center">导航显示</th>
	 <th align="center">首页排序</th>
     <th align="center">首页显示</th>
	 <th align="center">Dly页面</th>
     <th align="center">操 作</th>
      </tr>
    </thead>
  <tbody>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="STYLE1" >
    <td align="center"><?php echo ($vo["space"]); echo ($vo["cname"]); ?>
	<?php if(($vo["islink"]) == "1"): ?>[<?php echo ($vo["total"]); ?>)<?php endif; ?>
	</td>
    <td align="center"><?php echo ($vo["typeid"]); ?></td>
    <td align="center">
<?php switch($vo["is_showdesc"]): case "1": ?>显示<?php break;?>
<?php case "0": ?>不显示<?php break; endswitch;?>
</td>
    <td align="center" class="tdleft"><?php if(($vo["isuser"]) == "1"): ?>是<?php else: ?>否<?php endif; ?></td>
    <td align="center"><?php if(($vo["ismenu"]) == "1"): endif; echo ($vo["drank"]); ?></td>
    <td align="center"><?php if(($vo["ismenu"]) == "1"): ?>显示<?php else: ?>不显示<?php endif; ?></td>
	<td align="center"><?php if(($vo["isindex"]) == "1"): echo ($vo["irank"]); else: ?>-<?php endif; ?></td>
    <td align="center"><?php if(($vo["isindex"]) == "1"): ?>显示<?php else: ?>不显示<?php endif; ?></td>
	 <td width="6%" align="center">
 <?php switch($vo["show"]): case "1": ?>显示<?php break;?>
<?php case "0": ?>不显示<?php break; endswitch;?>
	 </td>
    <td align="center">
    <a href="__URL__/category_edit/typeid/<?php echo ($vo["typeid"]); ?>"><font color="#3e3e3e">编辑</font></a> | <a href="__URL__/category_del/typeid/<?php echo ($vo["typeid"]); ?>" onClick="JavaScript:return confirm('删除的栏目必须无子栏目,且无文章！确定？')"><font color="#3e3e3e">删除</font></a>
    </td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?> 
 </tbody>
</table>
<div style="text-align:center;margin:10px;">
<hr>
  
</div>
</div>
</body>
</html>