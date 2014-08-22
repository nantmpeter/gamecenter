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
	var $gamename = $("#gamename").val();
	if($gamename=="")
	{
	   $.dialog({
	   lock:true,
	   icon:'error',
	   content:'提交失败!游戏名称不能为空！',
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
<form action="<?php echo U('Game/game_add');?>" method="post" id="myform" enctype="multipart/form-data">
<table width="100%" class="table_form">
  <tbody>
  <tr>
    <th width="120">游戏名称</th>
    <td class="y-bg"><input type="text" class="input-text" name="gamename" id="gamename" size="30" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">输入游戏名称</font></td>
  </tr>
  <tr>
    <th width="120">游戏类型</th>
    <td class="y-bg">
   <select name="gametype" id="gametype">
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["typename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
    &nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">请选择游戏类型</font></td>
  </tr>
   <tr>
    <th width="120">状态</th>
    <td class="y-bg">
    <input name="isdisplay" value="0" type="radio" checked> 开启&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="isdisplay" value="1" type="radio" > 关闭
  &nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">前台是否显示</font></td>
  </tr>
   <tr>
    <th width="120">简介</th>
    <td class="y-bg"><input type="text" class="input-text" name="desc1" id="desc1" size="40" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">简介</font></td>
  </tr>
  <tr>
    <th width="120">内容</th>
    <td class="y-bg"><textarea name="content" id="content" cols="50" rows="6"></textarea>&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray"> 有利于SEO优化.请填入符合你网站内容的词语</font></td>
  </tr>
  <tr>
    <th width="120">游戏官网</th>
    <td class="y-bg"><input type="text" class="input-text" name="game_web" id="game_web" size="30" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">游戏官网地址</font></td>
  </tr>
  <tr>
    <th width="120">游戏bbs</th>
   <td class="y-bg"><input type="text" class="input-text" name="game_bbs" id="game_bbs" size="30" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">游戏bbs地址</font></td>
  </tr>
  <tr>
    <th width="120">游戏攻略</th>
  <td class="y-bg"><input type="text" class="input-text" name="game_guide" id="game_guide" size="30" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">游戏攻略地址</font></td>
  </tr>
  <tr>
    <th width="120">游戏币名称</th>
   
  <td class="y-bg"><input type="text" class="input-text" name="currency" id="currency" size="30" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">例（元宝/金币）</font></td>
  </tr>
  <tr>
    <th width="120">游戏币比例</th>
    
   <td class="y-bg"><input type="text" class="input-text" name="payto" id="payto" size="30" value="10">&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">例（1:10）</font></td>
  </tr>

  <tr>
    <th width="120">游戏简写</th>
    
   <td class="y-bg"><input type="text" class="input-text" name="tag" id="tag" size="30" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">例（1:10）</font></td>
  </tr>	
  <tr>
    <th width="120">游戏首字母</th>
    <td class="y-bg"><input type="text" class="input-text" name="short" id="short" size="50" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">例（F）</font></td>
  </tr>
  <tr>
    <th width="120">点击数量</th>
    <td class="y-bg"><input type="text" class="input-text" name="game_hit" id="game_hit" size="50" value="1">&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">点击次数</font></td>
  </tr> 
  <tr>
    <th width="120">开服时间</th>
    <td class="y-bg">
<input name="game_starttime" id="game_starttime" value="" size="20" class="date input-text" readonly="" type="text">&nbsp;<script type="text/javascript">
			Calendar.setup({
			weekNumbers: true,
		    inputField : "game_starttime",
		    trigger    : "game_starttime",
		    dateFormat: "%Y-%m-%d %H:%M:%S",
		    showTime: true,
		    minuteStep: 1,
		    onSelect   : function() {this.hide();}
			});
        </script> 
</td>
  </tr>
  <tr>
    <th width="120">是否推荐</th>
    <td class="y-bg">
    <input name="ishot" value="0" type="radio" > 推荐&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="ishot" value="1" type="radio" checked> 不推荐
  &nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">是否推荐</font></td>
  </tr>
  
    <tr>
    <th width="120">排序</th>
    <td class="y-bg"><input type="text" class="input-text" name="sort" id="sort" size="50" value="1">&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">数字越大排在越前面</font></td>
  </tr>
  <tr>
    <th width="120">图1（大）</th>
    <td class="y-bg"><input type="file" class="input-text" name="gamepic" id="gamepic" size="30" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">图1（大）</font></td>
  </tr>
  <tr>
    <th width="120">图2（中）</th>
    <td class="y-bg"><input type="file" class="input-text" name="smallpic" id="smallpic" size="30" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">图2（中）</font></td>
  </tr>
  <tr>
    <th width="120">图3（小）</th>
    <td class="y-bg"><input type="file" class="input-text" name="ordinarypic" id="ordinarypic" size="30">&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">图3（小）</font></td>
  </tr>
    <tr>
    <th width="120">游戏key</th>
    <td class="y-bg"><input type="text" class="input-text" name="game_key" id="game_key" size="50">&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">游戏key</font></td>
  </tr>
    <tr>
    <th width="120">游戏支付key</th>
    <td class="y-bg"><input type="text" class="input-text" name="game_paykey" id="game_paykey" size="50" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">游戏支付key</font></td>
  </tr>
   <tr>
    <th width="120">游戏登录url</th>
    <td class="y-bg"><input type="text" class="input-text" name="game_url" id="game_url" size="50">&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">游戏登陆地址</font></td>
  </tr>
  
   <tr>
    <th width="120">游戏支付url</th>
    <td class="y-bg"><input type="text" class="input-text" name="game_payurl" id="game_payurl" size="50" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">游戏支付地址</font></td>
  </tr>
  
   <tr>
    <th width="120">合作id</th>
    <td class="y-bg"><input type="text" class="input-text" name="p_id" id="p_id" size="50" >&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">合作id</font></td>
  </tr>
</tbody></table>
</div>

<div class="bk15"></div>

<input name="dosubmit" type="submit" value="提交" class="send">
</form>
</div>



</body></html>