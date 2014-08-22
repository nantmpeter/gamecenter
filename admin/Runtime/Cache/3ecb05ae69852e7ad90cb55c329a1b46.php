<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title>发布文章</title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <link href="__PUBLIC__/admin/css/bootstrap.min.css" type="text/css" rel="stylesheet">
  <link href="__PUBLIC__/admin/css/style.css" type="text/css" rel="stylesheet">
  <script type="text/javascript" src="__PUBLIC__/admin/js/jquery-1.8.0.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/admin/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/admin/js/dialog/jquery.artDialog.js?skin=default"></script>
  <script type="text/javascript" src="__PUBLIC__/admin/js/jquery.colorpicker.js"></script>
 <link rel="stylesheet" type="text/css" href="__PUBLIC__/js/calendar/jscal2.css">
			<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/calendar/border-radius.css">
			<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/calendar/win2k.css">
			<script type="text/javascript" src="__PUBLIC__/js/calendar/calendar.js"></script>
			<script type="text/javascript" src="__PUBLIC__/js/calendar/lang/en.js"></script>
  <script type="text/javascript" src="__PUBLIC__/ueditor/editor_config.js"></script>
<script type="text/javascript" src="__PUBLIC__/ueditor/editor_all_min.js"></script> 
<link rel="stylesheet" href="__PUBLIC__/ueditor/themes/default/ueditor.css">
  <style type="text/css">
  input[type="text"]{
    height: 18px;
  }
  </style>
<script>
$(document).ready(
   function(){
	$(".send").click(function(){
	var $title = $("#title").val();
	var $type = $("#typeid").val();
	if($title==""||$type=="")
	{
	   $.dialog({
	   lock:true,
	   icon:'error',
	   content:'提交失败!至少要填写文章标题,所属栏目,文章内容!',
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
	function round()
	{
		
	document.getElementById("Hits").value=Math.ceil(Math.random()*(1000-1)+1);
	}
</script>
  
 </head>
 <body>
 <form action="__URL__/doadd"  name="myform" method="post" id="myform" enctype="multipart/form-data">
<table width="98%" border="0.2" class="table table-condensed table-striped">
  <tr>
    <td>文章标题:</td>
    <td><input type="text" name="title" id="title" size="47" style="width: 475px;" /></td>
    <td>来源:</td>
    <td>
    <input name="from" type="text" id="CopyFrom" value="31玩平台" size="14" maxlength="60">
    </td>
  </tr>
  <tr>
    <td>自定属性:</td><input type="hidden" name="typename" id="ty" >
    <td>
      推荐
      <input name="ishot" type="checkbox" class="noborder" id="IsHot" value="1">
      幻灯
      <input name="isflash" type="checkbox" class="noborder" id="IsFlash" value="1">
	  置顶
	  <input name="istop" type="checkbox" class="noborder" id="istop" value="1">
    </td>
    <td>作者:</td>
    <td><input name="author" type="text" id="Author" value="31玩小编" size="20" maxlength="200"></td>
  </tr>
  <tr>
    <td>所属栏目:</td>
    <td> <select id="typeid" name="typeid">
      <option value="" >请选择分类</option>
    	<?php if(is_array($option)): $i = 0; $__LIST__ = $option;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["typeid"]); ?>"><?php echo ($v["cname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </td>

    <td>点击数:</td>
    <td><input name="hits" type="text" id="Hits" value="1" size="6" maxlength="10">&nbsp;&nbsp;<input style="margin-top: -10px;" name="get" type="button" class="btn btn-primary" onClick="round();" value="随机"></td>
  </tr>
  <tr>
    <td>发布日期:</td>
    <td>
    <input name="addtime" id="addtime" value="<?php echo date('Y-m-d H:i:s',time()); ?>"  size="10" class="date input-text" readonly="" type="text">&nbsp;<script type="text/javascript">
			Calendar.setup({
			weekNumbers: true,
		    inputField : "addtime",
		    trigger    : "addtime",
		    dateFormat: "%Y-%m-%d %H:%M:%S",
		    showTime: false,
		    minuteStep: 1,
		    onSelect   : function() {this.hide();}
			});
        </script> 
    &nbsp;&nbsp;&nbsp;标签:&nbsp;&nbsp;<input type="text" name="tags" id="tags" size="30"/>
    
      <td></td>
    <td></td>
  </tr>
  <tr>
    <td>内容简介:</td>
    
    <td><textarea name="description" id="note" ></textarea></td>
     <td>跳转url:</td>
    <td><input name="redirect" type="text" id="redirect" value="" size="20" maxlength="200"></td>

  </tr>
</table>
<div><textarea name="content" id="editor_id"></textarea></div>

<input type="submit" class="send" value="发布"/> <input type="reset" value="重置" />
</form>
<script type="text/javascript">

    var editor = new UE.ui.Editor({initialContent:'31wan'});
    editor.render("editor_id");

</script> 
 </body>
</html>