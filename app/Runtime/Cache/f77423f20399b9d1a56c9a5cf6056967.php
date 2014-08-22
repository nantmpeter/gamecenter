<?php if (!defined('THINK_PATH')) exit();?>
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/games.css" rel="stylesheet" type="text/css" />
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/user.css" rel="stylesheet" type="text/css" />
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
    <span>新手卡</span>
</div>
<ul class="user_b">
    <li class=""><a class="b1" href="<?php echo U('members/index');?>">我的信息</a></li>
    <li class="on"><a href="<?php echo U('members/card');?>" class="b2">新手卡</a></li>
      <!-- qq用户不用修改密码服务 -->
        <li class=""><a href="<?php echo U('members/user_modifypwd');?>" class="b4">修改密码</a></li>
    <li class=""><a href="<?php echo U('members/user_fcm');?>" class="b5">防沉迷系统</a></li>
    <li><a class="b6" href="<?php echo U('accounts/loginout');?>">安全退出</a></li>
</ul>
 
<div class="user_m step1">
<div class="xsk">
<div class="bor">
      <table cellspacing="0" border="0">
          <tbody>
            <tr><th>游戏</th><th>名称</th><th>服务器列表</th><th>状态</th><th>领取时段</th><th class="cl">领取</th></tr> 
           
           <?php if(is_array($game_list)): $i = 0; $__LIST__ = $game_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
              <td><img src="/Public/Uploads/images/<?php echo ($vo["gamepic"]); ?>" width="138" height="72" /></td>
              <td><?php echo ($vo["gamename"]); ?>-新手卡</td>
              <td>
                  <select id="rank_server_<?php echo ($vo["gid"]); ?>">
                  <?php if(is_array($vo['server_info'])): $i = 0; $__LIST__ = $vo['server_info'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?><option value="<?php echo ($sub["sid"]); ?>"><?php echo ($sub["servername"]); ?>--<?php echo ($sub["line"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>                                                    
                    </select>
              </td>
              <td>推荐</td>
              <td><span>无限制</span></td>
              <td><a class="get"  game="<?php echo ($vo["gid"]); ?>" >我要领取</a></td>
            </tr>
         <tr class="cardNo_<?php echo ($vo["gid"]); ?>" ><td colspan="6"><span id="cardNoTd_<?php echo ($vo["gid"]); ?>"></span></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
      
       </tbody>
        </table>
    </div>
</div>  </div>
</div>

<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/jquery-1.4.2.js" type="text/javascript"></script>
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/dialog/jquery.artDialog.js?skin=default" type="text/javascript"></script>
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/dialog/plugins/iframeTools.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
 
    $(".get").click(function(){
    	$game = $(this).attr("game");
        $("#rank_server_"+$game).change(function(){
            $server = $("#rank_server_"+$game).val();
        });
        $("#rank_server_"+$game).trigger("change");
          $.ajax({
        	        type:'get',
    	    	   url:'<?php echo U("Members/card_check");?>',
    	    	   data:'gid='+$game+'&sid='+$server,
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
    	    			   $('#cardNoTd_'+$game).html("<span class='tips'>"+data.msg+"</span>");	
    	    			   }
    	    	   },
    	    	   cache:false,
    	    	   type:'get'
    	       })	
    	       
    })
})

</script>