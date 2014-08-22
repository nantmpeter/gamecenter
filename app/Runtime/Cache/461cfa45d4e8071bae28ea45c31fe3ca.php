<?php if (!defined('THINK_PATH')) exit();?>
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    setInterval('showBanner()',15000);

function showBanner(){
    $(".banner_embed1").toggle();
    $(".banner_embed2").toggle();
}
</script>

<div class="box">
  <div class="user">
    <h3>用户登录</h3>
    <div class="login_box_v2">
    <form id="login_box"  method="post" action="#">
      <p>     
        <input id="user_name" name="user_name" type="text" class="text"/>
      </p>
      <p>
        <input id="user_pwd" name="user_pwd" type="password" class="text" value=""/>
      </p>
      <p>
        <input name="" type="button" class="log_b" value=""/>
      </p>
      </form>
      <center><p><a href="<?php echo U('Accounts/register');?>" class="">账号注册</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo U('accounts/forget_password');?>" class="">找回密码</a></p></center>
       <center><p><a class="qq" href="<?php echo U('open/index');?>">用QQ号码登录</a>&nbsp;&nbsp;&nbsp;&nbsp;<!-- <a href="<?php echo U('open/alipay');?>" class="reg_i global_reg">支付宝登陆</a></p> --></center>
		
	</div>

    <div id="logined">
      <div class="u_head"><?php echo ($config["SITENAME"]); ?>欢迎您！<br />
        昵称：<a href="/members/"><strong id="user" title="user"><?php echo ($userinfo["nickname"]); ?></strong></a></div>
        <div class="benSafeInfo">
            <p class="safe1 yellow">您的积分：<span class="satr full"  id="safe_level"><?php echo ($userinfo["point"]); ?>分</span></p>
            <p class="safe2">您的平台币：<span id="safe_server"><?php echo ($userinfo["money"]); ?>元</span></p> 
        </div>
      <p class="btn"><a class="b1" href="<?php echo U('members/index');?>" target="_blank">用户中心</a><a class="b1" href="<?php echo U('Service/index');?>" target="_blank">客服中心</a><a class="b2" href="<?php echo U('pay/index');?>" target="_blank">充值</a><a href="<?php echo U('accounts/loginout');?>" class="b3 global_logout">退出</a></p>
      <div class="wan History"> 
        <?php switch($history): case "": ?><p>您可能喜欢以下游戏:</p>
 		<?php if(is_array($no_history)): $i = 0; $__LIST__ = $no_history;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cc): $mod = ($i % 2 );++$i;?><a target="_blank" href="<?php echo ($cc["game_web"]); ?>"><?php echo ($cc["gamename"]); ?></a> |<?php endforeach; endif; else: echo "" ;endif; break;?>
		<?php default: ?>
		<p>您之前玩过的游戏:</p>
		<?php if(is_array($history)): $i = 0; $__LIST__ = $history;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vc): $mod = ($i % 2 );++$i;?><a target="_blank" href="<?php echo U('game/login');?>?game=<?php echo ($vc["gid"]); ?>&server=<?php echo ($vc["sid"]); ?>"><?php echo ($vc["gamename"]); ?>[<?php echo ($vc["sid"]); ?>服] </a> |<?php endforeach; endif; else: echo "" ;endif; endswitch;?>		
      </div>
    </div>
  </div><!--user-->
  <div class="focus">
      <div id="flash" style="width:450px;height:222px;position:relative;background-color:#FFF;"></div>
 
  </div>
  <div class="date">
    <h3>最新开服</h3>
    <div class="date_s">
      <table cellspacing="0" border="0" id="server_list">
        <tbody>
          <tr>
            <th>游戏</th>
            <th>时间</th>
            <th>服务器</th>
          </tr>
               <?php $_result=D('GameView')->order('server.start_time desc')->limit(5)->select(); if ($_result): $i=0;foreach($_result as $key=>$game):++$i;$mod = ($i % 2 );?><tr>
                <th><a href="<?php echo U('game/login');?>?game=<?php echo ($game["gid"]); ?>&server=<?php echo ($game["sid"]); ?>" target="_blank" title="登陆游戏"><?php echo ($game["gamename"]); ?></a></th>
                <th><a href="<?php echo U('game/login');?>?game=<?php echo ($game["gid"]); ?>&server=<?php echo ($game["sid"]); ?>" target="_blank" title="登陆游戏"><?php echo (date('m/d H:i',$game["start_time"])); ?></a></th>
                <th><a href="<?php echo U('game/login');?>?game=<?php echo ($game["gid"]); ?>&server=<?php echo ($game["sid"]); ?>" target="_blank" title="登陆游戏"><?php echo ($game["servername"]); ?></a></th>
                </tr><?php endforeach; endif;?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="tj_games">
  <ul>
           <?php if(is_array($games_list)): $i = 0; $__LIST__ = $games_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li>
            <div class="g_pic"><a href="#" target="_blank"><img src="/Public/Uploads/images/<?php echo ($list["gamepic"]); ?>" alt="<?php echo ($list["gamename"]); ?>" width="223" height="141" /></a></div>
                <div class="g_tit">
                    <h2><?php echo ($list["gamename"]); ?></h2>
                    <div class="g_lx">类别：<?php echo ($list["typename"]); ?></div>
                </div>
            <p><?php echo ($list["desc1"]); ?></p>
            <div class="enter_g"><a href="/hall" class="enter" target="_blank">进入游戏</a></div>
            <div class="links"><a href="<?php echo ($list["game_web"]); ?>" target="_blank">官网</a><a href="<?php echo U('pay/index');?>" target="_blank">充值</a><a href="<?php echo U('members/card');?>" target="_blank">新手卡</a></div>
             <?php if(($list["ishot"]) == "1"): ?><div class="hot">火爆游戏</div> 
<?php else: ?>             <div class="tj">推荐游戏</div><?php endif; ?>
           </li><?php endforeach; endif; else: echo "" ;endif; ?>
  </ul>                                                                                                                                                                                                          </ul>
</div>
<div class="bg1"></div>
<div class="mid">
  <div class="help">
    <h3>在线客服</h3>
    <div class="help_s">
      <p>平台企业QQ：800030820
          <a class="b1" target="_blank" href="/service">游戏客服</a>
          <a class="b2" target="_blank" href="/service">充值客服</a> 
      </p>
    </div>
  </div>
  <div class="news">
    <h3>
        <a class="tab_nav on" href="<?php echo U('article/category?t=9&q=热点');?>" target="_blank" tab_for="hot">热点</a>
        <a class="tab_nav" href="<?php echo U('article/category?t=7&p=新闻');?>" target="_blank" tab_for="new">新闻</a>
        <a class="tab_nav" href="<?php echo U('article/category?t=8&p=活动');?>" target="_blank" tab_for="huodong">活动</a>
    </h3>
    <div class="news_all">
        <!--热点-->
        <div class="tab_a hot" >
            <a class="more" href="<?php echo U('article/category?id=9');?>" target="_blank">更多>></a>
            <ul>
                <?php if(($hot_top) == "1"): else: endif; ?>
                <?php if(is_array($hotart)): $i = 0; $__LIST__ = $hotart;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?><li><a href="/article/read?aid=<?php echo ($art["aid"]); ?>" title="<?php echo ($art["title"]); ?>" target="_blank"><?php echo ($art["title"]); ?></a><span><?php echo (date('m/d',$art["addtime"])); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <!--新闻-->
        <div class="tab_a new" style="display:none">
            <a class="more" href="<?php echo U('article/category?t=7');?>" target="_blank">更多>></a>
            <ul>
                <?php if(($news_top) == "1"): else: endif; ?>
                <?php if(is_array($news)): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$news): $mod = ($i % 2 );++$i;?><li><a href="/article/read?aid=<?php echo ($news["aid"]); ?>" title="<?php echo ($news["title"]); ?>" target="_blank"><?php echo ($news["title"]); ?></a><span><?php echo (date('m/d',$news["addtime"])); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?> 
            </ul>
        </div>
        <!--活动-->
        <div class="tab_a huodong" style="display:none">
            <a class="more" href="<?php echo U('article/category?t=8');?>" target="_blank">更多>></a>
            <ul>
              <?php if(($huodong_top) == "1"): else: endif; ?>
              <?php if(is_array($huodong)): $i = 0; $__LIST__ = $huodong;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$huodong): $mod = ($i % 2 );++$i;?><li><a href="/article/read?aid=<?php echo ($huodong["aid"]); ?>" title="<?php echo ($huodong["title"]); ?>" target="_blank"><?php echo ($huodong["title"]); ?></a>                <span><?php echo (date('m/d',$huodong["addtime"])); ?></span>
                </li><?php endforeach; endif; else: echo "" ;endif; ?> 
            </ul>
        </div>
    </div>
  </div><!--news-->
  <div class="faq">
    <h3>常见问题</h3>
    <ul>             
                     <?php $_result=D('article')->where('typeid=10')->limit(6)->select(); if ($_result): $i=0;foreach($_result as $key=>$game):++$i;$mod = ($i % 2 );?><li><a href="/article/read/aid/<?php echo ($game["aid"]); ?>" target="_blank"><?php echo ($game["title"]); ?></a></li><?php endforeach; endif;?>
            </ul>
    <a class="more" href="<?php echo U('article/category');?>?t=10&p=常见问题" target="_blank">更多>></a>
  </div><!--faq-->
</div>
<div class="f_links">
    <p>
                                   <a href="/" target="_blank">最新网页游戏</a>
                                   <?php $_result=D('link')->order('listorder asc')->where('passed =1 ')->select(); if ($_result): $i=0;foreach($_result as $key=>$game):++$i;$mod = ($i % 2 );?>|                     <a href="<?php echo ($game["url"]); ?>" title="<?php echo ($game["introduce"]); ?>" target="_blank"><?php echo ($game["name"]); ?></a><?php endforeach; endif;?>
                        </p>
 </div>
<!--引入的JS-->

<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/dialog/jquery.artDialog.js?skin=default" type="text/javascript"></script>
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/dialog/plugins/iframeTools.js" type="text/javascript"></script>
<script type="text/javascript" src="__TMPL__<?php echo ($config["THEME"]); ?>/js/JSSlide.js"></script>
<script type="text/javascript">
$(function(){
    
	
	<?php if(($userinfo["username"]) != ""): ?>$('.login_box_v2').css('display','none');
	$('#logined').css('display','block');<?php endif; ?>
	document.onkeydown=function(){
		if(event.keyCode=="13"){
			$('.log_b').click();
		}
	} 
	$(".log_b").click(function(){
		var $username = $('#user_name').val();
		var $password = $('#user_pwd').val();
		if($username==""||$password==""||$username.length<5||$username.length>22||$password.length<5)
	    {
	      $.dialog.alert('登陆失败，提交数据不合法，请检查您的输入。');
	      return false;
	    }
		$.ajax({
			type:'post',
			data:$('#login_box').serialize(),
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
					  setTimeout("location.reload(true)",2000);
				  }
			}
		});
		$('#login_box').ajaxStart(function(){
			$.dialog({
				   id:'dialog1',
				   title:'提示信息',
				   content:"<div style='text-align:center;'><img style='width:14px; height:14px;' src='__TMPL__<?php echo ($config[THEME]); ?>/images/loading.gif' alt='loading'><span>&nbsp;请稍候,操作正在进行中.</span></div>",
				   lock:true,
				   time:1.1
			   })
		})
		
	})
    $('.tab_nav').mouseover(function(){
            $('.tab_nav').removeClass('on');
            $(this).addClass('on');
            $('.news .tab_a').hide();
            $('.' + $(this).attr('tab_for')).show();
    });
    var pics = [];
  
        <?php if(is_array($ad_list)): $i = 0; $__LIST__ = $ad_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$flv): $mod = ($i % 2 );++$i;?>pics.push('<?php echo ($flv["title"]); ?>|<?php echo ($flv["url"]); ?>|/Public/Uploads/images/<?php echo ($flv["content"]); ?>');<?php endforeach; endif; else: echo "" ;endif; ?>
    
        window.jsslide = new JSSlide('jsslide', {container:'flash',each:pics});
});




</script>