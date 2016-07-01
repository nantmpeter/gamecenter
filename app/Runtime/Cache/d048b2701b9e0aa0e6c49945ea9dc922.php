<?php if (!defined('THINK_PATH')) exit();?>
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/games.css" rel="stylesheet" type="text/css" />
<!--header-->
<script type="text/javascript">
    setInterval('showBanner()',15000);

function showBanner(){
    $(".banner_embed1").toggle();
    $(".banner_embed2").toggle();
}
</script>

<div class="main">
  <div class="l">
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
     <center><p><a class="qq" href="<?php echo U('open/index');?>">用QQ号码登录</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo U('Accounts/register');?>" class="reg_i global_reg">免费注册</a></p></center>
		
	</div>
    <div id="logined">
      <div class="u_head"><?php echo ($config["SITENAME"]); ?>欢迎您！<br />
        用户名：<a href="/user/"><strong id="user" title="user"><?php echo ($userinfo["nickname"]); ?></strong></a></div>
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
                 <?php $_result=D('GameView')->order('server.start_time desc')->limit(8)->select(); if ($_result): $i=0;foreach($_result as $key=>$game):++$i;$mod = ($i % 2 );?><tr>
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
        <p>游戏客服热线：400-9966-163
            <a class="b1" target="_blank" href="/kefu/online.html">游戏客服</a>
            <a class="b2" target="_blank" href="/kefu/online/pay.html">充值客服</a> 
        </p>
        </div>
    </div><!--help-->
</div><!--l-->
  <div class="game" id="hall_open_latest">
    
                                        <div class="g_img"><a href="http://txj.qq163.com" target="_blank"><img src="/Public/Uploads/images/<?php echo ($hot_game["gamepic"]); ?>" width="680" height="152" /></a></div>
                <div class="about">
                <p><?php echo ($hot_game["desc1"]); ?></p>
                类型：<span class="type"><?php echo ($type["typename"]); ?></span> 状态：<span class="state"><em>火爆开启</em></span> </div>
                <div class="btn"><a class="b1" href="<?php echo U('game/login');?>?game=<?php echo ($hot_game["gid"]); ?>&server=<?php echo ($hot_game["sid"]); ?>" onclick="hall.showServer('txj');">开始游戏</a><a class="b2" href="/index.php/members/card" target="_blank">新手卡</a><a class="b2" href="<?php echo ($hot_game["game_web"]); ?>" target="_blank">官网</a></div>
                <div class="kf"><span>火爆开启</span><a class="new" href="<?php echo U('game/login');?>?game=<?php echo ($hot_game["gid"]); ?>&server=<?php echo ($hot_game["sid"]); ?>" target='_blank'><?php echo ($hot_game["gamename"]); ?>　　<?php echo ($hot_game["servername"]); ?></a></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                            
  </div>
  <div class="game_server_list" id="games">
    <h3>游戏列表</h3>
    <div class="bor">
      <ul class="games">
      <?php $_result=D('game')->select(); if ($_result): $i=0;foreach($_result as $key=>$game):++$i;$mod = ($i % 2 );?><li class="<?php if($i==1){echo 'on';}?>" desc="<?php echo ($game["gid"]); ?>" onclick="hall.showServer('<?php echo ($game["gid"]); ?>');return false;" ><a href="<?php echo ($game["game_web"]); ?>" title="<?php echo ($game["gamename"]); ?>"onclick="return false;"><img src="/Public/Uploads/images/<?php echo ($game["smallpic"]); ?>" alt="<?php echo ($game["gamename"]); ?>" width="138" height="72" /></a></li><?php endforeach; endif;?>
      </ul>
      <div class="g_more">
        <h2></h2>
        <div class="about">类型：<span>角色扮演</span> 特征：<span>武侠</span> 状态：<span><em>火爆开启</em></span> 人气：<span><em>56789人在线</em></span></div>
        <div class="btn">
            <a class="b1">开始游戏</a>
            <a class="b2">新手卡</a>
            <a class="b2">新活动</a>
            <a class="b2">官网</a>
            <a class="b3">玩家交流</a>
        </div>
        <h5>推荐服务器列表</h5>
        <ul id="_good_server">
        </ul>
        <!--h5>您玩过的服务器列表</h5>
        <ul id="lastgames">
          <li><span>火爆开启</span><a>大唐真龙2 166区</a></li>
        </ul-->
        <h5>所有服务器列表</h5>
        <div class="all">
            <div class="ban"></div>
            <ul id="_all_server"> </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="cl"></div>
</div>


 
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/jquery-1.4.2.js" type="text/javascript"></script>
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/jsstage/plat_action.js" type="text/javascript"></script>
<script type="text/javascript" src="__TMPL__<?php echo ($config["THEME"]); ?>/js/open_server.js"></script>
<script type="text/javascript" src="__TMPL__<?php echo ($config["THEME"]); ?>/js/jquery.pages.js?v=2"></script>
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/dialog/jquery.artDialog.js?skin=default" type="text/javascript"></script>
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/dialog/plugins/iframeTools.js" type="text/javascript"></script>
<script type="text/javascript" src="__TMPL__<?php echo ($config["THEME"]); ?>/js/JSSlide.js"></script>
<script type="text/javascript">
<?php if(($userinfo["username"]) != ""): ?>$('.login_box_v2').css('display','none');
$('#logined').css('display','block');<?php endif; ?>
var tempData = {};
var hall = {
    /**
     * 显示服务器信息
     */
    showServer : function(game){
        if ( ! /^\w+$/i.test(game)) return;
        var game_name = $(".games li[desc='" + game + "']").find("a").attr("title");
        if (!game_name) return;
        $(".games li").removeClass("on");
        $(".games li[desc='"+game+"']").attr('class','on');
        $('.g_more').html('');
        $('.g_more').append('<h2>《'+game_name+'》</h2>');
        if(typeof tempData[game] != 'undefined'){
            hall.showData(game, tempData[game]);
        }else{
        $.ajax({
 	       type:'get',
     	   url:'<?php echo U("Hall/server_info");?>',
     	   data:'gid='+game,
     	   dataType:'json',
     	   error:function(){
     		   $.dialog.tips('系统发生错误,请稍候重试!');
     	   },
     	   success:function(data)
     	   {
     		  
     		   if(data.state!="1")
     			   {
    
   			         $('#cardNoTd_'+$game).html("<span class='tips'>"+data.msg+"</span>");	
   			       return false;
     			   }
     		   else{
     
     			    hall.showData(game, data);
     	            tempData[game] = data;
     			  	
     			   }
     	   },
     	   cache:false,
     
        })	
        }
    },
    
    /**
     * 显示函数
     */
    showData : function(game, data){

        var headHtml = '', tempHtml = '', goodServer = '', i = '', j = 0, gameName='';
        gameName = $(".games li[desc='"+game+"'] a").attr("title");
        if(typeof data[game] != 'undefined' && typeof data[game]['hall'] != 'undefined'){
            headHtml += data[game]['hall']['hall_detail_desc'];
            headHtml += "<div class='about'>类型：<span>"+data[game]['hall']['hall_game_type']+"</span>  状态：<span><em>"+data[game]['hall']['hall_game_state']+"</em></span> </div>";   
            headHtml += "<div class='btn'><a class='b1' href='/hall.html#"+game+"servers'>开始游戏</a><a class='b2' href='/index.php/members/card' target='_blank'>新手卡</a><a class='b2' href='http://"+game+".31wan.cn' target='_blank'>官网</a><a class='b3' href='http://bbs.31wan.cn/"+game+"/' target='_blank'>玩家交流</a></div>";
        }else{
            headHtml += '抱歉，暂不存在此游戏的信息';
        }
        
        //列举所有服务器信息+推荐服务器信息
        goodServer += "<h5 id='"+game+"servers'><font color='#EC550B'>"+gameName+"</font>推荐服务器</h5><ul id='_good_server'>";
        tempHtml += "<h5><font color='#EC550B'>"+gameName+"</font>所有服务器列表</h5><div class='all'><div class='ban'></div></div><ul id='_all_server'>";
        
        for(i in data[game]['servers']){
            tempHtml +="<li><span>"+data[game]['servers'][i]['status']+"</span><a href='<?php echo U('game/login');?>?game="+game+"&server="+data[game]['servers'][i]['id']+"' target='_blank'>"+data[game]['servers'][i]['name']+" "+data[game]['servers'][i]['line']+data[game]['servers'][i]['desc']+"</a></li>";   
            
            if(data[game]['servers'][i]['is_recommended']){
                goodServer += "<li><span>"+data[game]['servers'][i]['status']+"</span><a href='<?php echo U('game/login');?>?game="+game+"&server="+data[game]['servers'][i]['id']+"' target='_blank'>"+data[game]['servers'][i]['name']+" "+data[game]['servers'][i]['line']+data[game]['servers'][i]['desc']+"</a></li>";
                j++;
            }
        }
        tempHtml += "</ul>";
        goodServer += "</ul>";
        
        $(".g_more").append(headHtml);
        $(".g_more").append(goodServer);
        $(".g_more").append(tempHtml);
        
        $("#_all_server").pages('li', {
            size:42
        }, ".all .ban", function(c, l, s){
            var str = '', r, x, y;
            for (var i = 1; i <= c; i ++) {
                r = $.fn.pages.prototype.get_range(i, c, s);
                x = $("#_all_server li"+r[1]+":first a").attr('href');
                x = x.substr(x.indexOf('server=') + 8);
                y = $("#_all_server li"+r[1]+":last a").attr('href');
                y = y.substr(y.indexOf('server=') + 8);
                str += '<a class="pages_each" pages_number="'+i+'">'+y+'-'+x+'服</a>';
            }
            return str;
        }); 
    },
    
    /**
     * 最近玩过的游戏
     */
    lastPlay : function(){
        
    }

}
/**
 * 初始化游戏信息
 */
$(function(){
    var $game = $(".games li:eq(0)").attr("desc");
    var $game_name = $(".games li:eq(0)").find("a").attr("title");
    if (!$game_name) return;
    $('.g_more').html('');
    $('.g_more').append('<h2>《'+$game_name+'》</h2>');
    if(typeof tempData[$game] != 'undefined'){
        hall.showData($game, tempData[$game]);
    }else{
        $.ajax({
	       type:'get',
    	   url:'<?php echo U("Hall/server_info");?>',
    	   data:' gid='+$game,
    	   dataType:'json',
    	   error:function(){
    		   $.dialog.tips('系统发生错误,请稍候重试!');
    	   },
    	   success:function(data)
    	   {
    		   if(data.state!="1")
    			   {
  			         $('#cardNoTd_'+$game).html("<span class='tips'>"+data.msg+"</span>");	
  			       return false;
    			   }
    		   else
    			   {

    			    hall.showData($game, data);
    	            tempData[$game] = data;
    			  	
    			   }
    	   },
    	   cache:false,
    	   
       })	
       
    }
});

</script>
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