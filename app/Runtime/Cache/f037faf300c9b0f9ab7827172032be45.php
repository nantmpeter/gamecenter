<?php if (!defined('THINK_PATH')) exit();?>
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/games.css" rel="stylesheet" type="text/css" />
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/user.css" rel="stylesheet" type="text/css" /><!--header-->
<script type="text/javascript">
    setInterval('showBanner()',15000);

function showBanner(){
    $(".banner_embed1").toggle();
    $(".banner_embed2").toggle();
}
</script>

<!--主体内容开始--> 
<div class="u_box"> 
<div class="dh"> 你现在所在的位置：
    <a href="/">首页</a> &gt; 
    <a href="<?php echo U('members/index');?>">用户中心</a> &gt; 
    <span>玩家修改密码</span>
</div>
<ul class="user_b">
    <li class=""><a class="b1" href="<?php echo U('members/index');?>">我的信息</a></li>
    <li class=""><a href="<?php echo U('members/card');?>" class="b2">新手卡</a></li>
      <!-- qq用户不用修改密码服务 -->
        <li class="on"><a href="<?php echo U('members/user_modifypwd');?>" class="b4">修改密码</a></li>
    <li class=""><a href="<?php echo U('members/user_fcm');?>" class="b5">防沉迷系统</a></li>
    <li><a class="b6" href="<?php echo U('accounts/loginout');?>">安全退出</a></li>
</ul>
<div class="user_m step4"> 
<form id="myform" name="myform" method="post">
  <div class="user_conh">
  <p>密保问题，保障您的帐号安全，当您对帐号进行重要操作时需要验证密保问题。</p>
  <h5>密码修改</h5>
    <ul>
        <li>
            <label><em>*</em>原密码：</label>
            <input name="password_old" class="text" id="password_old" value="" type="password">
            <span id="o_info" class="">请填写您的原密码</span>
        <li>
            <label><em>*</em>新密码：</label>
            <input name="login_password" class="text" id="login_password" onkeyup="checkPwd(this.value);" type="password">
        </li>
     
        <li>
            <label><em>*</em>确认新密码：</label>
            <input name="relogin_pwd" class="text" id="relogin_pwd" type="password">
            <span class="" id="p_info" style="color:red"></span>
        </li>
        <li><div class="ucoh_an"> <input name="imageField2" class="btn_m" id="imageField2" value="确认修改" type="submit" style="cursor:pointer"></div></li>
    </ul>
  </div>
  </form>
  <div class="clear"></div>  
 </div>
</div>
<div class="clearbox"></div>
</div>