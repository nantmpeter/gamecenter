<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equtv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理</title>
<link href="__PUBLIC__/admin/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<link href="__PUBLIC__/admin/css/style.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="__PUBLIC__/admin/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/bootstrap.min.js"></script>
<script src="__PUBLIC__/admin/js/admin.js"></script>
<script src="__PUBLIC__/admin/js/jquery.min.js"></script>
</head>
<body>
<form name="myform" method="POST" action="__URL__/dobackup">
<table width="100%" border="0"  align=center cellpadding="3" cellspacing="2" class="table table-condensed table-striped admintable">
<tr> 
  <td colspan="2" align=left class="admintitle">数据库分卷备份 <a href="__URL__/upload">上传备份文件</a></td>
</tr>
    <tr style="font-weight:bold;">
    <td width="10%" height="30" align="center" class="ButtonList">&nbsp;</td>
    <td width="90%" align="center" class="ButtonList">表名</td>
    </tr>
	<?php if(is_array($tablelist)): $i = 0; $__LIST__ = $tablelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
    <td align="center"><?php echo ($i); ?>.&nbsp;<input type="checkbox" value="<?php echo ($vo); ?>" name="ids[]" onClick="unselectall(this.form)"></td>
    <td align="left"><?php echo ($vo); ?></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
<tr><td align="center">全选: <input name="Action" type="hidden"  value="Del"><input name="chkAll" type="checkbox" id="chkAll" onClick=CheckAll(this.form) value="checkbox"></td>
  <td colspan="1">
  <label>每个分卷文件大小：</label><input type="text" name="filesize" value="2048" size="5" class="ct"> K 
  <input name="Del" type="submit" class="" id="Del" value="开始备份" style="margin-top: -10px;"></td>
  </tr><tr><td colspan="6">
</td></tr></table>
</form>
<div style="text-align:center;margin:10px;">
<hr>
 
</div>
</body>
</html>