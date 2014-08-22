<?php if (!defined('THINK_PATH')) exit();?>
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/reg.css" rel="stylesheet" type="text/css" />
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/dialog/jquery.artDialog.js?skin=default" type="text/javascript"></script>
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/dialog/plugins/iframeTools.js" type="text/javascript"></script>
<style>
.reg {width: auto !important;background:  none !important;}
#submit_btn{margin-left:80px;}
.content {border-top: medium none;margin: 0 auto;width: 960px;}
.tips{
	margin-top: -4px;
	position: absolute;
	margin-left: 9px;
}
</style>
<!--header-->
<script type="text/javascript">
$(document).ready(function(){
	$('.verify').click(function(){
		  var num =   new Date().getTime();
		  var rand = Math.round(Math.random() * 10000);
		  num = num + rand;
		  $('.verify')[0].src = "<?php echo U('Public/verify');?>";
	});
	var state = '1';
	if(state=='1')
	{
	$.dialog({
        title:'注册协议',
        content:$('#J_agreements_content').html(),
        ok:function(){
           $.dialog.tips('你已经同意了此协议,现在可以进行帐号注册 ',2);
        },
        cancel: function () {
        	history.back();
        },
        cancelVal:'我不同意',
        okVal:'我同意',
        lock:true
        });
	 }
     $('#J_agreements_btn').click(function(){
           $.dialog.tips($('#J_agreements_content').html(),'5');
     });
     $('#username').blur(function(){
    	 var $val = $(this).val();
    	     if($val==""||$val.length<5||$val.length>22)
    		 {
    		    $('#show_error_username').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/error.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>用户名应由5-22位的字母、数字组成</span>");
    		 }
    	     else
    	     {
    	    	 $.ajax({
      	    	   type:'get',
      	    	   data:'u='+$val,
      	    	   dataType:'json',
      	    	   error:function(){
      	    		   $.dialog.tips('系统发生错误,请稍候重试!');
      	    	   },
      	    	   success:function(data){
      	    		   if(data.state!="1")
      	    			   {
      	    			     $('#show_error_username').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/error.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>"+data.msg+"</span>");
      	    			   return false;
      	    			   }
      	    		   else
      	    			   {
      	    			     $('#show_error_username').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/right.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>"+data.msg+"</span>");
      	    			   }
      	    	   },
      	    	   url:'<?php echo U("Accounts/username_check");?>'
      	       })  
    	     }
    	$("#password").blur(function(){
    		var $pass = $(this).val();
    		if($pass==""||$pass.length<6||$pass.length>22)
    			{
 			     $('#show_error_password').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/error.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>您的输入有误，请检查</span>");
 			    return false;
    			}
    		else
    			{
			     $('#show_error_password').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/right.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>密码验证通过!</span>");
    			}
    	})
     });
      
     $('#email').blur(function(){
    	 var $email = $(this).val();
    	 if($email!="")
         {
    	       $.ajax({
    	    	   url:'<?php echo U("Accounts/email_check");?>',
    	    	   data:'e='+$email,
    	    	   dataType:'json',
    	    	   error:function(){
    	    		   $.dialog.tips('系统发生错误,请稍候重试!');
    	    	   },
    	    	   success:function(data)
    	    	   {
    	    		   if(data.state!="1")
    	    			   {
    	  			         $('#show_error_email').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/error.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>"+data.msg+"</span>");	
    	  			       return false;
    	    			   }
    	    		   else
    	    			   {
    	    			   $('#show_error_email').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/right.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>"+data.msg+"</span>");	
    	    			   }
    	    	   },
    	    	   cache:false,
    	    	   type:'get'
    	       })	 
         }
    	 else
    		 {
			   $('#show_error_email').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/error.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>您的输入有误，请检查</span>");	
			   return false;
    		 }
     })
    $('#nickname').blur(function(){
    	var $nickname = $(this).val();
    	if($nickname!="")
    		{
    		  $.ajax({
    			  data:'n='+$nickname,
    			  url:'<?php echo U("Accounts/nickname_check");?>',
    			  dataType:'json',
    			  error:function(){
    				  $.dialog.tips('系统发生错误,请稍候重试');
    			  },
    			  success:function(data){
    				  if(data.state!="1")
    					  {
    					  $('#show_error_nickname').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/error.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>"+data.msg+"</span>");	
    					  return false;
    					  }
    				  else
    					  {
    					  $('#show_error_nickname').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/right.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>"+data.msg+"</span>");
    					  }
    			  }
    		  })
    		}
    	else
    		{
			  $('#show_error_nickname').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/error.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>请输入用户昵称 </span>");
			  return false;
    		}
    });
    
    $('#true_name').blur(function(){
    	$truename = $(this).val();
    	if($truename==""||$truename.length<2||$truename.length>4)
    		{
			  $('#show_error_true_name').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/error.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>请输入您的真实姓名 </span>");
			  return false;
    		}
    	else
    		{
    		$.ajax({
  			  data:{real:$truename},
  			  url:'<?php echo U("Accounts/realname_check");?>',
  			  type:'get',
  			  dataType:'json',
  			  cache:false,
  			  error:function(){
  				  $.dialog.tips('系统发生错误,请稍候重试');
  			  },
  			  success:function(data){
  				  if(data.state!="1")
  					  {
  					  $('#show_error_true_name').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/error.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>"+data.msg+"</span>");	
  					  return false;
  					  }
  				  else
  					  {
  					  $('#show_error_true_name').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/right.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>"+data.msg+"</span>");
  					  }
  			  }
  		  })
    		}
    });
    $('#idcard').blur(function(){
    	$idcard = $(this).val();
    	if($idcard==""||$idcard.length<15||$idcard.length>18)
    		{
			  $('#show_error_idcard').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/error.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>请输入您的身份证号码! </span>");
			  return false;
    		}
    	else
    		{
    		$.ajax({
  			  data:'id='+$idcard,
  			  url:'<?php echo U("Accounts/idcard_check");?>',
  			  dataType:'json',
  			  error:function(){
  				  $.dialog.tips('系统发生错误,请稍候重试');
  			  },
  			  success:function(data){
  				  if(data.state!="1")
  					  {
  					  $('#show_error_idcard').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/error.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>"+data.msg+"</span>");	
  					return false;
  					  }
  				  else
  					  {
  					  $('#show_error_idcard').html("<img src='__TMPL__<?php echo ($config["THEME"]); ?>/images/right.png' alt='ok' style='width:16px; height:16px'/><span class='tips'>"+data.msg+"</span>");
  					  }
  			  }
  		  })
    		}
    });
    $('#reg_form').submit(function(){
    	var $username = $('#username').val();
    	var $password = $('#password').val();
    	var $email = $('#email').val();
    	var $nickname = $('#nickname').val();
    	var $true_name = $('#true_name').val();
    	var $idcard = $('#idcard').val();
    	//var $verify_code = $('#verify_code').val();
    	if($username.length<5||$username.length>20||$password.leng<6||$password.length>22||$username==""||$password==""||$email==""||$nickname==""||$true_name==""||$idcard=="")
    	{
    		$.dialog.alert('请填写完整您的注册信息再进行提交!');
    		return false;
    	}
    })
})
</script>

            <div class="main">
                <div class="content">    
                    <!--主体内容开始--> 
                    <div class="conmian">
                        <form id="reg_form" name="reg_form" action="<?php echo U('Accounts/do_register');?>" method="post">
                        <input type="hidden" name="referer" value="<?php echo ($url); ?>" />
                        <div class="reg">
                            <div class="st1">(<span>*</span>为必填项，请认真填写！)</div>
                            <ul>
                                <li>
                                    <label>用户帐号：</label>
                                    <input type="text" maxlength="22" value="" id="username" name="username" class="txt">
                                        <b>*</b><span class="show_msg" id="show_error_username">由半角字符的字母、数字组成，长度为5~22位</span></li>
                                <li>
                                    <label>登录密码：</label>
                                    <input type="password" id="password" name="password"  class="txt">
                                        <b>*</b><span class="show_msg" id="show_error_password">长度为6到22位的字符</span>
                                </li>
                                <li>
                                    <label>电子邮件：</label>
                                    <input type="text" id="email" name="email"  class="txt">
                                        <b>*</b><span class="show_msg msgx" id="show_error_email">填入您常用的电子邮箱</span>
                                </li>
                                <li>
                                    <label>用户昵称：</label>
                                    <input type="text" id="nickname" name="nickname"  class="txt">
                                        <b>*</b><span class="show_msg msgx" id="show_error_nickname">给自己起个响亮的名字吧</span>
                                </li>
                              <!--    <li>
                                    <label>验证码：</label>
                                    <input type="text" id="verify_code" name="verify_code"  class="txt_v">
                                        <b>*</b><img src="<?php echo U('Public/verify');?>" class="verify"/>
                                </li> -->
                            </ul>
                            <div class="st2">(<span>*</span>为必填项，请认真填写！)</div>
                            <div class="about">根据2010年8月1日实施的《网络游戏管理暂行办法》，网络游戏用户需使用<span>有效身份证件</span>进行实名注册。为保证流畅游戏体验，享受健康游戏生活，请广大QQ163游戏的玩家尽快实名注册。</div>
                            <ul>
                                <li>
                                    <label>真实姓名：</label>
                                    <input type="text" maxlength="6" value="" id="true_name" name="true_name"  class="txt">
                                        <b>*</b><span class="show_msg msgx" id="show_error_true_name">如：张三</span></li>
                                <li>
                                    <label>身份证：</label>
                                    <input type="text" maxlength="18" id="idcard" name="idcard"  class="txt">
                                        <b>*</b><span class="show_msg msgx" id="show_error_idcard">如：120100198709093259</span>
                                        <div style="position: static; display: block; margin-left: 120px;" class="Monitoring">
                                            <div id="pwinfo"></div>
                                        </div>
                                </li>
                                <li class="ok">
                                    <input type="submit" value=""  class="submit_btn" id="submit_btn" />
                                </li>
                            </ul>
                             <div class="yes">
                              <div><a id="J_agreements_btn" class="s4" title="点击显示本协议" style="margin-left: 70px;">点此显示本站协议内容</a></div>
                               </div>
                        <div class="close">关闭</div>
                        </div>                        
                    </form>
                    </div><!--conmian-->
                    </div><!--content-->
                    </div><!--main-->                    
                    <div class="agreements" style="display:none">
							<pre id="J_agreements_content" style="display:none;">当您申请用户时，表示您已经同意遵守本规章。 欢迎您加入本站点参加交流和讨论，本站点为公共论坛，为维护网上公共秩序和社会稳定，请您自觉遵守以下条款： <br>
   &nbsp; 一、不得利用本站危害国家安全、泄露国家秘密，不得侵犯国家社会集体的和公民的合法权益，不得利用本站制作、复制和传播下列信息： <br>
（一）煽动抗拒、破坏宪法和法律、行政法规实施的；<br/>
（二）煽动颠覆国家政权，推翻社会主义制度的；<br>
（三）煽动分裂国家、破坏国家统一的；<br>
（四）煽动民族仇恨、民族歧视，破坏民族团结的；<br>
（五）捏造或者歪曲事实，散布谣言，扰乱社会秩序的；<br>
（六）宣扬封建迷信、淫秽、色情、赌博、暴力、凶杀、恐怖、教唆犯罪的；<br>
（七）公然侮辱他人或者捏造事实诽谤他人的，或者进行其他恶意攻击的；<br>
（八）损害国家机关信誉的；<br>
（九）其他违反宪法和法律行政法规的；<br>
（十）进行商业广告行为的。<br>
二、互相尊重，对自己的言论和行为负责。<br>
三、禁止在申请用户时使用相关本站的词汇，或是带有侮辱、毁谤、造谣类的或是有其含义的各种语言进行注册用户，否则我们会将其删除。<br>
四、禁止以任何方式对本站进行各种破坏行为。<br>
五、如果您有违反国家相关法律法规的行为，本站概不负责，您的登录论坛信息均被记录无疑，必要时，我们会向相关的国家管理部门提供此类信息。 </pre></div>
						</div>