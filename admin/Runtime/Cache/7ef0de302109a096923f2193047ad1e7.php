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
<form name="searchform" action="<?php echo U('Article/article_index');?>" method="post">
<table class="search-form" cellspacing="0" width="100%">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
			文章名称：  <input value="<?php echo ($title); ?>" class="input-text" name="title" type="text">  
状态：  <select name="status" id="status">
<option value="">请选择状态</option>
<option value="0" <?php if($status=='0'){echo 'selected';} ?>>审核</option>
<option value="1" <?php if($status=='1'){echo 'selected';} ?>>未审核</option>
</select>
所属栏目：<select id="typeid" name="typeid">
      <option value="" >请选择分类</option>
    	<?php if(is_array($option)): $i = 0; $__LIST__ = $option;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["typeid"]); ?>" <?php if($v['typeid']==$typeid){echo 'selected';} ?>><?php echo ($v["cname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
<input name="search" class="button" value="搜索" type="submit">
	</div>
		</td>
		</tr>
    </tbody>
</table>
</form>

<form name="myform" action="__URL__/delall" method="post">
<div class="table-list">
<table cellspacing="0" width="100%">
	<thead>
		<tr>
		<th align="left" width="20"><input value="" id="check_box" onclick="selectall('aid[]');" type="checkbox"></th>
			<th align="left"></th>
			<th align="left">ID</th>
			<th align="left">文章名称</th>
		
			<th align="left">发布时间</th>
			<th align="left">浏览</th>
			<th align="center">操作</th>
		</tr>
	</thead>
<tbody>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
	<td align="left"><input value="<?php echo ($vo["aid"]); ?>" name="aid[]" type="checkbox"></td>
		<td align="left"></td>
		<td align="left"><?php echo ($vo["aid"]); ?></td>
		<td align="left">[<a href="__URL__/index/typeid/<?php echo ($vo["typeid"]); ?>"><?php echo ($vo["typename"]); ?></a>]&nbsp;&nbsp;<a href="__ROOT__/<?php echo ($urlmode); ?>article/read?aid=<?php echo ($vo["aid"]); echo ($suffix); ?>" target="_blank"><?php echo ($vo["title"]); ?></a><?php if(($vo["ishot"]) == "1"): ?><font color="red">[荐]</font><?php endif; if(($vo["istop"]) == "1"): ?><font color="red">[顶]</font><?php endif; if(($vo["isimg"]) == "1"): ?><font color="red">[图]</font><?php endif; if(($vo["islink"]) == "1"): ?><font color="red">[转]</font><?php endif; if(($vo["isflash"]) == "1"): ?><font color="red">[幻]</font><?php endif; ?></td>

<td align="left"><?php echo (date( "Y-m-d H:i",$vo["addtime"])); ?></td>
	
	<td align="left"><?php echo ($vo["hits"]); ?>
</td>
		
		
		<td align="center">
			<a class="btn btn-mini" href="__URL__/status/aid/<?php echo ($vo["aid"]); ?>/status/<?php echo ($vo["status"]); ?>"><?php if(($vo["status"]) == "1"): ?>未审<?php else: ?><font color="red">已审</font><?php endif; ?></a> |<a class="btn btn-mini btn-primary" href="__URL__/edit/aid/<?php echo ($vo["aid"]); ?>">编辑</a>| <a class="btn btn-mini btn-danger" href="__URL__/del/aid/<?php echo ($vo["aid"]); ?>" onClick="JavaScript:return confirm('确定要删除？')">删除</a>
		</td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</tbody>
</table>
  <div class="btn"><label for="check_box">全选/取消</label>
		<input class="button" onclick="document.myform.action='__URL__/delall'"  name="Del" value="删除" type="submit">
		<input class="button" onclick="document.myform.action='__URL__/delall'"  name="Del"  value="批量审核" type="submit">
<input class="button" onclick="document.myform.action='__URL__/delall'"  name="Del"  value="批量未审" type="submit">
		<input class="button" onclick="document.myform.action='__URL__/delall'"  name="Del"  value="推荐" type="submit">
			<input class="button" onclick="document.myform.action='__URL__/delall'"  name="Del"  value="解除推荐" type="submit">
		
			<input class="button" onclick="document.myform.action='__URL__/delall'"  name="Del"  value="固顶" type="submit">
				<input class="button" onclick="document.myform.action='__URL__/delall'"  name="Del" value="解除固顶" type="submit">
				<input class="button" onclick="document.myform.action='__URL__/delall'"  name="Del"  value="幻灯" type="submit">
			
				<input class="button" onclick="document.myform.action='__URL__/delall'"  name="Del"  value="解除幻灯" type="submit">
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