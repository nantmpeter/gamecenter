<?php if (!defined('THINK_PATH')) exit();?>
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/games.css" rel="stylesheet" type="text/css" />
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/user.css" rel="stylesheet" type="text/css" />

<style>
.readonly input { display:none; }
.readonly select { display:none; }
.readonly span { display:inline-block;}
.readonly span { display:inline;}
.readonly span a { margin-left:8px; }
.editinfo input, .safe_box button {border:1px solid #CCC; text-indent:2px;}
.editinfo input, .safe_box button {display:inline-block;}
.editinfo input, .safe_box button {display:inline;}
.editinfo input, .safe_box button { border:1px solid #CCC; text-indent:2px;}
.editinfo input, .safe_box button { display:inline-block;}
.editinfo input, .safe_box button { display:inline;}
.safe_box button {margin-left:5px;color:#666;cursor:pointer;}
.editinfo select {height: 22px;padding-top: 2px;text-align: left;}
.editinfo select { height: 22px;padding-top: 2px;text-align: left;}
.editinfo select { display:inline-block;}
.editinfo select { display:inline;}
.editinfo span { display:none; }
.step6 .savebtn{ background: url("__TMPL__<?php echo ($config["THEME"]); ?>/images/stage/b1.jpg") repeat scroll -62px -299px transparent;border: medium none;height: 22px;margin: 2px 5px 0;text-align: center;width: 52px;}
</style>
<!--header-->
<script type="text/javascript">
    setInterval('showBanner()',15000);

function showBanner(){
    $(".banner_embed1").toggle();
    $(".banner_embed2").toggle();
}
</script>

<div class="u_box">
  <div class="dh"> 你现在所在的位置：
    <a href="/">首页</a> &gt; 
    <a href="<?php echo U('members/index');?>">用户中心</a> &gt; 
    <span>用户详细信息</span>
     </div>
<ul class="user_b">
    <li class="on"><a class="b1" href="<?php echo U('members/index');?>">我的信息</a></li>
    <li class=""><a href="<?php echo U('members/card');?>" class="b2">新手卡</a></li>
      <!-- qq用户不用修改密码服务 -->
        <li class=""><a href="<?php echo U('members/user_modifypwd');?>" class="b4">修改密码</a></li>
    <li class=""><a href="<?php echo U('members/user_fcm');?>" class="b5">防沉迷系统</a></li>
    <li><a class="b6" href="<?php echo U('accounts/loginout');?>">安全退出</a></li>
</ul>
  <div class="user_m step1">
    <ul class="benUserInfo">
      <li>Hi,
          <b>
             
           <?php echo ($info["nickname"]); ?>  </b> <?php switch($info["from_soical"]): case "腾讯": ?><img src="__PUBLIC__/images/icon/qq.gif" width="16" height="16"/><?php break;?>
             <?php case "新浪微博": ?><img src="__PUBLIC__/images/icon/sina.gif" width="16" height="16"/><?php break;?>
             <?php case "人人网": ?><img src="__PUBLIC__/images/icon/renren.gif" width="16" height="16"/><?php break;?>
             <?php case "豆瓣": ?><img src="__PUBLIC__/images/icon/douban.gif" width="16" height="16"/><?php break;?>
             <?php case "Google": ?><img src="__PUBLIC__/images/icon/google.gif" width="16" height="16"/><?php break;?>
             <?php case "MSN": ?><img src="__PUBLIC__/images/icon/msn.gif" width="16" height="16"/><?php break; endswitch;?>
          <br />
        欢迎光临<?php echo ($config["SITENAME"]); ?>用户中心！<br />
        最新登录：<?php echo (date('Y年m月d日 H:i:s',$info["lastlogin_time"])); ?>
               </li>
      <li>
        <h5>你玩过的游戏</h5>
        <div class="wan history"> 
         <?php if(is_array($history)): $i = 0; $__LIST__ = $history;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="#" target="_blank">
                <?php echo ($v["gamename"]); ?>
            </a><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
      </li>
      <li>
        <h5>推荐你玩</h5>
        <div class="wan tj"> 
            <?php $_result=D('GameView')->order('server.start_time desc')->select(); if ($_result): $i=0;foreach($_result as $key=>$game):++$i;$mod = ($i % 2 );?><a href="<?php echo U('game/login');?>?game=<?php echo ($game["gid"]); ?>&server=<?php echo ($game["sid"]); ?>" target="_blank">
               <?php echo ($game["gamename"]); ?>
            </a><?php endforeach; endif;?>
        </div>
      </li>
    </ul><!--benUserInfo-->
  </div><!--user_m-->
  <!--底部-->   
</div>