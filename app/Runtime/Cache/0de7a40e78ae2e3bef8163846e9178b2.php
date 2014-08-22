<?php if (!defined('THINK_PATH')) exit();?>
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/user.css" rel="stylesheet" type="text/css" />
<script>
if (top.location.href!=window.location.href){
    top.location.href = window.location.href;
}
</script>
<style>
.log_form ul li{margin-top:10px;}
</style>
<!--header-->
<div id="login">
  <div class="dh">你现在所在的位置：<a href="/">首页</a> &gt; <a href="/user/">用户中心</a> &gt; <span>用户登录</span></div>
  <div class="log_form">
      <form id="log_form_frame" target="_self" name="loginfrm" method="post" action="<?php echo U('accounts/checklogin');?>" autocomplete="off" >
        <input type="hidden" name="game" value=""/>
        <ul>   
            <li>
                <div id="errorHandel01">&nbsp;</div>
                <label class="labela">帐　号：</label>
                <input type="hidden" name="url" value="<?php echo ($url); ?>" />
                <input type="text" maxlength="20" class="text ipt1" id="user_name" name="user_name">
            </li>
            <li>
                <label class="labelb">密　码：</label>
                <input type="password" maxlength="20" class="text ipt2" id="user_pwd" name="user_pwd">
            </li>
            <li>
             <input name="" type="button"  id="login_cc" class="log_b" value=""  style="cursor:pointer"/>
             </li>
            <li>
                <p class="links">还没有帐号？<a href="<?php echo U('Accounts/register');?>" class="reg_l" target="_blank"> 免费注册&gt;&gt;</a><a href="<?php echo U('accounts/forget_password');?>" class="lose_l">忘记密码？</a> </p>
            </li>
        
        </ul>
    </form>
  </div><!--log_form-->
</div>


<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/jquery-1.4.2.js" type="text/javascript"></script>
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/dialog/jquery.artDialog.js?skin=default" type="text/javascript"></script>
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/dialog/plugins/iframeTools.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$('#login_cc').click(function(){
		var $username = $('#user_name').val();
		var $password = $('#user_pwd').val();
		if($username.length<4||$password.length<5||$username==""||$password=="")
			{
			  $.dialog.alert('请完善你的账户信息再进行登录!');
			  return false;
			}
		$.ajax({
			type:'post',
			data:$('#log_form_frame').serialize(),
			url:"<?php echo U('Accounts/checklogin');?>",
			error:function(){
				$.dialog.alert('登陆发生错误,请稍候重试.');
			},
			cache: false,
			dataType:'json',
			success:function(data){
				if(data.state!="1")
					{
					
					   $.dialog({
						   title:'提示信息',
						   content:data.msg,
						   ok:true,
						   okVal:'确定',
						   lock:true,
						   icon:'face-sad'
					   })
					}
				else
				  {
					
					  $('body').append(data.script)
					  $.dialog.tips(data.msg);
					  if(data.returnu==""){
					  setTimeout("window.location.href= '/'",2000);
					  }else{
						  window.location.href = data.returnu;
 					  }
				  }
			}
		});
	})
})
</script>