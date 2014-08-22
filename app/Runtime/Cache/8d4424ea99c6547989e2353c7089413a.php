<?php if (!defined('THINK_PATH')) exit();?>
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/games.css" rel="stylesheet" type="text/css" />
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/user.css" rel="stylesheet" type="text/css" /><!--header-->
<script type="text/javascript">
 $(document).ready(function(){
	 $('#submit').click(function(){
		 $('#f1').submit();
	 })
 })
    setInterval('showBanner()',15000);

function showBanner(){
    $(".banner_embed1").toggle();
    $(".banner_embed2").toggle();
}
</script>

<div class="u_box">
  <div class="dh"> 你现在所在的位置：
    <a href="/">首页</a> &gt; 
    <a href="/user/">用户中心</a> &gt; 
    <span>防沉迷设置</span>
</div>
<ul class="user_b">
    <li class=""><a class="b1" href="<?php echo U('members/index');?>">我的信息</a></li>
    <li class=""><a href="<?php echo U('members/card');?>" class="b2">新手卡</a></li>
      <!-- qq用户不用修改密码服务 -->
        <li class=""><a href="<?php echo U('members/user_modifypwd');?>" class="b4">修改密码</a></li>
    <li class="on"><a href="<?php echo U('members/user_fcm');?>" class="b5">防沉迷系统</a></li>
    <li><a class="b6" href="<?php echo U('accounts/loginout');?>">安全退出</a></li>
</ul>
  <div class="user_m step5">
  <form id="f1" method="post"> 
    <table width="600" border="0" cellspacing="0">
        <tr><td colspan="2" align="left">您可以进入游戏，但是我们建议您填写如下身份资料以免受到防沉迷系统的限制。</td></tr>
        <tr>
            <td width="80" align="left">&nbsp;&nbsp;&nbsp;真实姓名：</td>
            <td width="520"><input id="real_name" id="realname" type="text"  value="<?php echo ($data["realname"]); ?>"  <?php if(empty($data["realname"])): else: ?> readonly<?php endif; ?>></td>
        </tr>
        <tr>
            <td align="left">身份证号码：</td>
            <td width="520"><input id="id_card" name="id_card" type="text"  value="<?php echo ($data["id_card"]); ?>" <?php if(empty($data["id_card"])): else: ?> readonly<?php endif; ?> > </td>
        </tr>
                <tr>
            <td colspan="2" align="cente" style="background:url(__TMPL__<?php echo ($config["THEME"]); ?>/images/icon_07.jpg) no-repeat center; text-align:center; font-weight:bold; color:#fff; height:28px; line-height:28px;" id="submit" >确认提交</td>
             </form>
        </tr>
            </table>
            <?php echo ($data["success"]); ?>
    <p></p>
    <p><b>网络游戏防沉迷系统及用户隐私说明</b><br />
    按照版署《网络游戏未成年人防沉迷系统》要求：<br />
    为预防青少年过度游戏，未满18岁的用户和身份信息不完整的用户将受到防沉迷系统的限制，<?php echo ($config["SITENAME"]); ?>平台积极响应国家新闻
    出版总署防沉迷政策要求，开发出网页游戏防沉迷系统。年龄已满18周岁的玩家，在填写身份证资料后，可以不受防沉迷系
    统影响，自由进行游戏，否则游戏每日在线3小时后即打怪经验减半,超过5小时则无经验。<br /></p>
    <p><b>说明：</b>系统只支持输入18位的中国身份证号码，持有其他证件（如：外国护照，军人证，等）者，请与<a href="http://www.<?php echo ($config["SITENAME"]); ?>.com/kefu/online.html"><font color="orange">客服GM</font></a>联系处理。填
    写身份信息将使我们可以对您的年龄做出判断，以确定您的游戏时间是否需要按照国家新闻出版总署的要求纳入防沉迷
    系统的管理。<br /></p>
    <p><b>隐私说明：</b>用户填写的身份信息属于用户的隐私。<?php echo ($config["SITENAME"]); ?>平台游戏绝对尊重用户个人隐私权。所以，<?php echo ($config["SITENAME"]); ?>平台游戏绝不会公
    开，编辑或透露用户的信息内容，除非有法律许可及公安管理规定。</p>
    <div class="clear"></div>
</div><!--user_m-->
</div><!--u_box-->