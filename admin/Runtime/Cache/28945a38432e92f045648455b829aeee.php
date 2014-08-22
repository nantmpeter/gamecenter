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
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/admin_common.js"></script>
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/styleswitch.js"></script>
<script src="__PUBLIC__/js/dialog/plugins/iframeTools.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/calendar/jscal2.css">
			<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/calendar/border-radius.css">
			<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/calendar/win2k.css">
			<script type="text/javascript" src="__PUBLIC__/js/calendar/calendar.js"></script>
			<script type="text/javascript" src="__PUBLIC__/js/calendar/lang/en.js"></script>

</head>
<body>
<style type="text/css">
	html{_overflow-y:scroll}
</style>
<script>
$(document).ready(
   function(){
	$(".send").click(function(){
	var $gid = $("#gid").val();
	var $servername = $("#servername").val();
	var $start_time = $("#start_time").val();
	if($gid=="")
	{
	   $.dialog({
	   lock:true,
	   icon:'error',
	   content:'请选择相应的游戏',
	   title:"提示信息",
	   ok:true,
	   });
	 return false;
	}
	if($start_time=="")
	{
	   $.dialog({
	   lock:true,
	   icon:'error',
	   content:'请填写开服时间',
	   title:"提示信息",
	   ok:true,
	   });
	 return false;
	}
	if($servername=="")
	{
	   $.dialog({
	   lock:true,
	   icon:'error',
	   content:'开服名称不能为空',
	   title:"提示信息",
	   ok:true,
	   });
	 return false;
	}
	});
	 $("tr:odd").addClass("ev");
	$("tr:even").addClass("ov");
	$("#cp3").colorpicker({
    fillcolor:true,
    success:function(o,color){
        $("#title").css("color",color);
		$("#TitleFontColor").val(color);
    }
});
}
	   
)
</script>

<div class="pad-10">
<div class="col-tab">

<div id="div_setting_1" class="contentList pad-10" style="">
<form action="<?php echo U('Game/server_add');?>" method="post" id="myform" enctype="multipart/form-data">
<table width="100%" class="table_form">
  <tbody>
   <tr>
    <th width="120">开服游戏</th>
    <td class="y-bg">
<select name="gid" id="gid">
<option value="">请选择游戏</option>
<?php if(is_array($game_list)): $i = 0; $__LIST__ = $game_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["gid"]); ?>" <?php if($vo['gid']==$gid){echo 'selected';} ?>><?php echo ($vo["gamename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
    &nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">请选择游戏</font></td>
     </tr>
  
  <tr>
    <th width="120">开服名称</th>
    <td class="y-bg"><input type="text" class="input-text" name="servername" id="servername" size="30" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">输入开服名称</font></td>
  </tr>
  <tr>
    <th width="120">开服线路</th>
     <td class="y-bg"><input type="text" class="input-text" name="line" id="line" size="30" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">输入开服线路</font></td>
  </tr>
   <tr>
    <th width="120">状态</th>
    <td class="y-bg">
    <input name="status" value="0" type="radio" checked> 推荐&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="status" value="1" type="radio" > 不推荐
  &nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">是否推荐</font></td>
  </tr>
  <tr>
    <th width="120">简介</th>
    <td class="y-bg"><textarea name="content" id="content" cols="50" rows="6"></textarea>&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray"> 有利于SEO优化.请填入符合你网站内容的词语</font></td>
  </tr>
   <tr>
    <th width="120">是否显示</th>
    <td class="y-bg">
    <input name="is_display" value="0" type="radio" checked> 显示&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="is_display" value="1" type="radio" > 不显示
  &nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">是否显示</font></td>
  </tr>
  <tr>
    <th width="120">开服时间</th>
    <td class="y-bg">
<input name="start_time" id="start_time" value="" size="20" class="date input-text" readonly="" type="text">&nbsp;<script type="text/javascript">
			Calendar.setup({
			weekNumbers: true,
		    inputField : "start_time",
		    trigger    : "start_time",
		    dateFormat: "%Y-%m-%d %H:%M:%S",
		    showTime: true,
		    minuteStep: 1,
		    onSelect   : function() {this.hide();}
			});
        </script> 
</td>
  </tr>
    <tr>
    <th width="120">开服图标</th>
    <td class="y-bg"><input type="file" class="input-text" name="server_img" id="server_img" size="30" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">开服图标</font></td>
  </tr>
     <tr>
    <th width="120">开服地址（url）</th>
    <td class="y-bg"><input type="text" class="input-text" name="server_url" id="server_url" size="50">&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">开服地址（url）</font></td>
  </tr>
    <tr>
    <th width="120">混服游戏id</th>
    <td class="y-bg"><input type="text" class="input-text" name="gameid" id="gameid" size="50">&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">游戏id</font></td>
  </tr>
    <tr>
    <th width="120">混服开服id</th>
    <td class="y-bg"><input type="text" class="input-text" name="serverid" id="serverid" size="50" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">游戏开服id</font></td>
  </tr>
</tbody></table>
</div>

<div class="bk15"></div>

<input name="dosubmit" type="submit" value="提交" class="send">
</form>
</div>



</body></html>