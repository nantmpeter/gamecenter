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
<script src="__PUBLIC__/js/dialog/jquery.artDialog.js?skin=idialog" type="text/javascript"></script>
<script src="__PUBLIC__/js/ajaxfileupload.js" type="text/javascript"></script>
<script src="__PUBLIC__/js/dialog/plugins/iframeTools.js" type="text/javascript"></script>
<script type="text/javascript">
	
  $(document).ready(function(){
	  $('#load').click(function(){
		  $.ajaxFileUpload({
			  fileElementId :'favicon',
			  secureuri :false,
			  type:'POST',
			  dataType:'json',
			  error:function(){$.dialog.tips('上传图标发生错误,请稍候再试')},
			  success:function(data){
				  $.dialog.tips(data.msg);
			  },
			  url:"<?php echo U('Global/save_icon');?>"
			  })
	  })
	  
	  $('#load1').click(function(){
		  $.ajaxFileUpload({
			  fileElementId :'logo',
			  secureuri :false,
			  type:'POST',
			  dataType:'json',
			  error:function(){$.dialog.tips('上传logo发生错误,请稍候再试')},
			  success:function(data){
				  $.dialog.tips(data.msg);
			  },
			  url:"<?php echo U('Global/save_logo');?>"
			  })
	  })
	  
	  $('#sub').ajaxStart(function(){
		  $.dialog.tips('提交中..');
	  });
	  $('#sub').ajaxComplete(function(){
		   
	  });
	  $('#sub').click(function(){
		  $.ajax({
			  data:$('#myform').serialize(),
			  type:"POST",
			  dataType:'json',
			  url:"<?php echo U('Global/save_basic');?>",
			  success:function(data){
				  if(data.status=="0"){
					  $.dialog({
			      			title:'警告',
			      			lock:true,
			      			time:2,
			      			content:data.msg,
			      			icon: 'face-sad'
			        	 });

				  }else{
					  $.dialog({
			      			title:'恭喜',
			      			lock:true,
			      			time:2,
			      			content:data.msg,
			      			icon: 'face-smile'
			        	 });
 
				  }
			  },
			  error:function(){
				  $.dialog.tips('对不起,你没有进行任何更改');
			  }
		  })
	  })
  })
</script>
</head>
<body>
<style type="text/css">
	html{_overflow-y:scroll}
</style>
<script>
</script>

<div class="pad-10">
<div class="col-tab">
<ul class="tabBut cu-li">
            <li id="tab_setting_1" class="on" onclick="SwapTab('setting','on','',5,1);">基本配置</li>
            <li id="tab_setting_2" onclick="SwapTab('setting','on','',5,2);" class="">安全配置</li>
            <li id="tab_setting_3" onclick="SwapTab('setting','on','',5,3);" class="">社会化登陆配置</li>
            <li id="tab_setting_4" onclick="SwapTab('setting','on','',5,4);" class="">邮箱配置</li>
		<!-- 	<li id="tab_setting_5" onclick="SwapTab('setting','on','',5,5);" class="">ucenter通信配置</li> -->
</ul>
<div id="div_setting_1" class="contentList pad-10" style="">
<table width="100%" class="table_form">
  <tbody>
    <tr>
    <th width="120">网站ico(SEO使用)</th>
    <td class="y-bg"><form action="" method="POST" enctype="multipart/form-data"><input type="file" class="input-text" name="favicon" id="favicon" style="height:30px;">&nbsp;&nbsp;&nbsp;<input type="button" id="load"  value="上传"/></form></td>
  </tr>
    <tr>
    <th width="120">站点LOGO</th>
    <td class="y-bg"><form action="" method="POST" enctype="multipart/form-data"><input type="file" class="input-text" name="logo" id="logo"  style="height:30px;">&nbsp;&nbsp;&nbsp;<input type="button" id="load1"  value="上传"/></form></td>
  </tr>
  <form action="<?php echo U('Global/save_icon');?>" method="post" id="myform" enctype="multipart/form-data">
  <tr>
    <th width="120">站点名称</th>
    <td class="y-bg"><input type="text" class="input-text" name="sitename" id="sitename" size="30" value="<?php echo ($info["sitename"]); ?>">&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">输入你的网站名称</font></td>
  </tr>
  <tr>
    <th width="120">站点标题</th>
    <td class="y-bg"><input type="text" class="input-text" name="sitename2" id="sitename2" size="30" value="<?php echo ($info["sitename2"]); ?>">&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">输入你的网站标题</font></td>
  </tr>
   <tr>
    <th width="120">站点域名</th>
    <td class="y-bg"><input type="text" class="input-text" name="domain" id="domain" size="30" value="<?php echo ($info["domain"]); ?>">&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">输入你的站点域名</font></td>
  </tr>
  <tr>
    <th width="120">网站关键字（SEO使用）</th>
    <td class="y-bg"><textarea name="keywords" id="keywords" cols="50" rows="6"><?php echo ($info["keywords"]); ?></textarea>&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray"> 有利于SEO优化.请填入符合你网站内容的词语</font></td>
  </tr>
  <tr>
    <th width="120">网站描述（SEO使用）</th>
    <td class="y-bg"><textarea name="descriptions" id="descriptions" cols="50" rows="6"><?php echo ($info["descriptions"]); ?></textarea>&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray"> 输入描述你的网站描述</font></td>
  </tr>
  <tr>
    <th width="120">URL 模式</th>
    <td class="y-bg"><select name="urlmode">
    <option value="0" <?php if(($info["urlmode"]) == "0"): ?>selected<?php endif; ?>>普通模式</option>
    <option value="1" <?php if(($info["urlmode"]) == "1"): ?>selected<?php endif; ?>>PATHINFO模式</option>
    <option value="2" <?php if(($info["urlmode"]) == "2"): ?>selected<?php endif; ?>>REWRITE模式</option>
    <option value="3" <?php if(($info["urlmode"]) == "3"): ?>selected<?php endif; ?>>兼容模式</option>

    </select>&nbsp;&nbsp;&nbsp;&nbsp;<font color="gray">可选参数0、1、2、3,代表以下四种模式：0(普通模式);1(PATHINFO模式);2(REWRITE模式);3(兼容模式) 默认为PATHINFO模式，提供最好的用户体验和SEO支持</font></td>
  </tr>
  <tr>
    <th width="120">URL 后缀</th>
    <td class="y-bg"><select name="suffix">
   	<option value="0" <?php if(($info["suffix"]) == "0"): ?>selected<?php endif; ?>>.html</option>
	<option value="1" <?php if(($info["suffix"]) == "1"): ?>selected<?php endif; ?>>.htm</option>
     <option value="2" <?php if(($info["suffix"]) == "2"): ?>selected<?php endif; ?>>.shtml</option>
			<option value="3" <?php if(($info["suffix"]) == "3"): ?>selected<?php endif; ?>>.php</option>
			<option value="4" <?php if(($info["suffix"]) == "4"): ?>selected<?php endif; ?>>.asp</option>
			<option value="5" <?php if(($info["suffix"]) == "5"): ?>selected<?php endif; ?>>.aspx</option>
			<option value="6" <?php if(($info["suffix"]) == "6"): ?>selected<?php endif; ?>>.jsp</option>
    </select></td>
  </tr>
  <tr>
    <th width="120">站点状态</th>
    <td class="y-bg">
    <input name="open" value="0" type="radio" <?php if(($info["open"]) == "0"): ?>checked<?php endif; ?>> 开启&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="open" value="1" type="radio" <?php if(($info["open"]) == "1"): ?>checked<?php endif; ?> > 关闭</td>
    </td>
  </tr>
  <tr>
    <th width="120">站点注册状态</th>
    <td class="y-bg">
    <input name="openreg" value="0" type="radio" <?php if(($info["openreg"]) == "0"): ?>checked<?php endif; ?>> 开启&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="openreg" value="1" type="radio" <?php if(($info["openreg"]) == "1"): ?>checked<?php endif; ?>> 关闭</td>
    </td>
  </tr>

  <tr>
    <th width="120">启用页面Gzip压缩</th>
    <td class="y-bg">
    <input name="gzip" value="0" type="radio" <?php if(($info["gzip"]) == "0"): ?>checked<?php endif; ?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="gzip" value="1" type="radio" <?php if(($info["gzip"]) == "1"): ?>checked<?php endif; ?>> 否</td>
  </tr> 	
</tbody></table>
</div>
<div id="div_setting_2" class="contentList pad-10 hidden" style="display: none;">
	<table width="100%" class="table_form">
  <tbody><tr>  
    <th width="120">启用后台管理操作日志</th>
    <td class="y-bg">
	  <input name="save_uselog" value="0" type="radio" <?php if(($info["save_uselog"]) == "0"): ?>checked<?php endif; ?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
	  <input name="save_uselog" value="1" type="radio" <?php if(($info["save_uselog"]) == "1"): ?>checked<?php endif; ?>> 否     </td>
  </tr>
  <tr>
    <th width="120">保存错误日志</th>
    <td class="y-bg">
	  <input name="save_errorlog" value="0" type="radio" <?php if(($info["save_errorlog"]) == "0"): ?>checked<?php endif; ?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
	  <input name="save_errorlog" value="1" type="radio" <?php if(($info["save_errorlog"]) == "1"): ?>checked<?php endif; ?>> 否     </td>
  </tr> 
  <tr>
    <th>后台最大登陆失败次数</th>
    <td class="y-bg"><input type="text" class="input-text" name="max_error" id="max_error" size="10" value="<?php echo ($info["max_error"]); ?>"></td>
  </tr>
 </table> </td>
  </tr> 
</tbody></table>
</div>
<div id="div_setting_3" class="contentList pad-10 hidden" style="display: none;">
<table width="100%" class="table_form">
  <tbody><tr>
    <th width="120">启用社会化登陆</th>
    <td class="y-bg">
    <input name="social_login" value="0" type="radio" <?php if(($info["save_errorlog"]) == "0"): ?>checked<?php endif; ?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
	 <input name="social_login" value="1" type="radio"  <?php if(($info["save_errorlog"]) == "1"): ?>checked<?php endif; ?>> 否</td>
  </tr> 
  <tr>
    <th>应用ID(AppID)</th>
    <td class="y-bg"><input type="text" class="input-text" name="appid" id="appid" size="30" value="<?php echo ($info["appid"]); ?>"><div id="phpsso_appidTip" class="onShow">请输入应用ID</div></td>
  </tr> 
  <tr>
    <th>应用密钥(AppKey)</th>
    <td class="y-bg"><input type="text" class="input-text" name="appkey" id="appkey" size="50" value="<?php echo ($info["appkey"]); ?>"><div id="phpsso_api_urlTip" class="onShow">请填写应用密钥</div></td>
  </tr>      
  </tbody></table>
</div>
<div id="div_setting_4" class="contentList pad-10 hidden" style="display: none;">
<table width="100%" class="table_form">
  <tbody id="smtpcfg" style="">
  <tr>
    <th>邮件服务器</th>
    <td class="y-bg"><input type="text" class="input-text" name="mail_server" id="mail_server" size="30" value="<?php echo ($info["mail_server"]); ?>"></td>
  </tr>  
  <tr>
    <th>邮件发送端口</th>
    <td class="y-bg"><input type="text" class="input-text" name="mail_port" id="mail_port" size="30" value="<?php echo ($info["mail_port"]); ?>"></td>
  </tr> 
  <tr>
    <th>发件人地址</th>
    <td class="y-bg"><input type="text" class="input-text" name="mail_from" id="mail_from" size="30" value="<?php echo ($info["mail_from"]); ?>"></td>
  </tr>   
	  <tr>
	    <th>验证用户名</th>
	    <td class="y-bg"><input type="text" class="input-text" name="mail_user" id="mail_user" size="30" value="<?php echo ($info["mail_user"]); ?>"></td>
	  </tr> 
	  <tr>
	    <th>验证密码</th>
	    <td class="y-bg"><input type="password" class="input-text" name="mail_password" id="mail_password" size="30" value="<?php echo ($info["mail_password"]); ?>"></td>
	  </tr>

 </tbody>
  <tbody>         
  </tbody></table>
</div>

<!-- <div id="div_setting_5" class="contentList pad-10 hidden" style="display: none;">
<table width="100%" class="table_form">


  <tbody>
  <tr>
    <th>ucenter</th>
    <td class="y-bg">
	uc_key  &nbsp;<input type="text" class="input-text" name="uc_key" id=""uc_key"" size="20" value="<?php echo ($info["uc_key"]); ?>">
	uc_password <input type="text" class="input-text" name="uc_password" id="uc_password" size="40" value="<?php echo ($info["uc_password"]); ?>"> 
	uc_api <input type="text" class="input-text" name="uc_api" id="uc_api" size="40" value="<?php echo ($info["uc_api"]); ?>">

	</td>
  </tr> 

  </tbody></table>
</div> -->
</form>
<div class="bk15"></div>
<input name="dosubmit" type="button" value="提交" class="button" id="sub">
</div>
</div>


<script type="text/javascript">

function SwapTab(name,cls_show,cls_hide,cnt,cur){
    for(i=1;i<=cnt;i++){
		if(i==cur){
			 $('#div_'+name+'_'+i).show();
			 $('#tab_'+name+'_'+i).attr('class',cls_show);
		}else{
			 $('#div_'+name+'_'+i).hide();
			 $('#tab_'+name+'_'+i).attr('class',cls_hide);
		}
	}
}

function showsmtp(obj,hiddenid){
	hiddenid = hiddenid ? hiddenid : 'smtpcfg';
	var status = $(obj).val();
	if(status == 1) $("#"+hiddenid).show();
	else  $("#"+hiddenid).hide();
}
function test_mail() {
	var mail_type = $('input[checkbox=mail_type][checked]').val();
	var mail_auth = $('input[checkbox=mail_auth][checked]').val();
    $.post('?m=admin&c=setting&a=public_test_mail&mail_to='+$('#mail_to').val(),{mail_type:mail_type,mail_server:$('#mail_server').val(),mail_port:$('#mail_port').val(),mail_user:$('#mail_user').val(),mail_password:$('#mail_password').val(),mail_auth:mail_auth,mail_from:$('#mail_from').val()}, function(data){
	alert(data);
	});
}

</script>
</body></html>