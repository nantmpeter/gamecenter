<?php if (!defined('THINK_PATH')) exit();?>
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/games.css" rel="stylesheet" type="text/css" />
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/user.css" rel="stylesheet" type="text/css" /><!--header-->
<script type="text/javascript">
    setInterval('showBanner()',15000);

function showBanner(){
    $(".banner_embed1").toggle();
    $(".banner_embed2").toggle();
}
</script><div class="main">
  <div class="l">
    <div class="date time">
        <h3>最新开服</h3>
        <div class="date_s time_s">
            <table cellspacing="0" border="0" id="server_list">
            <tbody>
                <tr>
                <th>游戏</th>
                <th>时间</th>
                <th>服务器</th>
                </tr>
                  <?php $_result=D('GameView')->order('server.start_time desc')->select(); if ($_result): $i=0;foreach($_result as $key=>$game):++$i;$mod = ($i % 2 );?><tr>
                <th><a href="<?php echo U('game/login');?>?game=<?php echo ($game["gid"]); ?>&server=<?php echo ($game["sid"]); ?>" target="_blank" title="登陆游戏"><?php echo ($game["gamename"]); ?></a></th>
                <th><a href="<?php echo U('game/login');?>?game=<?php echo ($game["gid"]); ?>&server=<?php echo ($game["sid"]); ?>" target="_blank" title="登陆游戏"><?php echo (date('m/d h:i',$game["start_time"])); ?></a></th>
                <th><a href="<?php echo U('game/login');?>?game=<?php echo ($game["gid"]); ?>&server=<?php echo ($game["sid"]); ?>" target="_blank" title="登陆游戏"><?php echo ($game["servername"]); ?></a></th>
                </tr><?php endforeach; endif;?>
            </tbody>
            </table>
        </div>
    </div><!--date-->
    <div class="help">
        <h3>在线客服</h3>
        <div class="help_s">
        <p>平台企业QQ：800030820  
            <a class="b1" target="_blank" href="/kefu/online.html">游戏客服</a>
            <a class="b2" target="_blank" href="/kefu/online/pay.html">充值客服</a> 
        </p>
        </div>
    </div><!--help-->
</div><!--l-->  <div class="news">
    <h3>资讯中心</h3>
    <div class="bor">
   
      <div>
        <ul class="news_list">
           <?php if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><span><?php echo (date($vo["addtime"],'m/d')); ?></span><h4><strong><a href="<?php echo U('article/category');?>?t=<?php echo ($vo["typeid"]); ?>&p=<?php echo ($vo["typename"]); ?>"><?php echo ($vo["typename"]); ?></a></strong> | <a href="<?php echo U('article/read');?>?aid=<?php echo ($vo["aid"]); ?>" title="<?php echo ($vo["title"]); ?>"><strong style="color:<?php echo ($vo["titlecorlor"]); ?>"><?php echo ($vo["title"]); ?></strong></a></h4></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <div class="pages"><?php echo ($page); ?></div>
      </div>
    </div>
  </div>
  <div class="cl"></div>
</div>
<script type="text/javascript" src="__TMPL__<?php echo ($config["THEME"]); ?>/js/jquery-1.4.2.js"></script>