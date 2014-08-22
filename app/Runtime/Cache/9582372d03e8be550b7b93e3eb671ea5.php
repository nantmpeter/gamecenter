<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($config["SITENAME"]); ?>-<?php echo ($info_a["title"]); ?>  <?php echo ($info[0]["keywords"]); ?>-<?php echo ($config["KEYWORDS"]); ?></title>
<meta name="keywords" content="<?php if($info[0]['keywords'] ==''){echo $config['KEYWORDS'];}else{echo $info_a['title'];echo $info[0]['keywords'];}?>">
<meta name="description" content="<?php if($info[0]['description'] ==''){echo $config['DESCRIPTIONS'];}else{echo $info_a['description'];echo $info[0]['description'];}?>">
<script src="__TMPL__<?php echo ($config["THEME"]); ?>/js/jquery-1.4.2.js" type="text/javascript"></script>
<link href="__TMPL__<?php echo ($config["THEME"]); ?>/css/total.css?v=1" rel="stylesheet" type="text/css" />
<meta property="qc:admins" content="72316162757631716636" />
<link rel="shortcut icon" href="<?php echo ($config["FAVICON"]); ?>" />
<meta property="qc:admins" content="72316162757631716636" />
<script type="text/javascript">
$(function(){
    var top_game_list_on = false;
    $(".tit").hover(function(){
        $('.g_list').show();
    },function(){
        $('.g_list').hide();
    });
    $(".g_list").hover(function(){
        $('.g_list').show();
    },function(){
        $('.g_list').hide();
    }); 
    $(".header .g_list").hover(function(){
        top_game_list_on = true;
        $(".header .g_list").fadeIn('fast');
    },function(){
        top_game_list_on = false;
        $(".header .g_list").fadeOut('slow');
    });
});

function setHomepage(url){
    if (document.all){
        document.body.style.behavior='url(#default#homepage)';
        document.body.setHomePage(url);
    }else if (window.sidebar){
        if(window.netscape){
            try{  
                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");  
            }catch (e) {  
                alert( "抱歉！您的浏览器不支持直接设为首页。\n请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为“true”，点击“加入收藏”后忽略安全提示，即可设置成功。" );  
            }
        } 
        var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components. interfaces.nsIPrefBranch);
        prefs.setCharPref('browser.startup.homepage',url);
    }
}

function AddFavorite(sURL, sTitle){
    try{
        window.external.addFavorite(sURL, sTitle);
    }catch (e){
        try{
            window.sidebar.addPanel(sTitle, sURL, "");
        }catch (e){
            alert("加入收藏失败，请使用Ctrl+D进行添加");
        }
    }
} 
function addFavorites(){
    var t = window.document.title;
    var u = window.document.location.href;
    if (u.indexOf("&s=fav")){
        u += "&s=fav";
    }
    if (window.sidebar) { // Mozilla Firefox Bookmark
        window.sidebar.addPanel(t, u,"");
    }else if( window.external ) { // IE Favorite
        window.external.AddFavorite( u, t);
    }else if(window.opera && window.print) { // Opera Hotlist
        var elem = document.createElement('a');
        elem.setAttribute('href',u);
        elem.setAttribute('title',t);
        elem.setAttribute('rel','sidebar');
        elem.click();
    }else{
        alert("加入收藏失败，请使用Ctrl+D进行添加");
    }
    return false;
}
</script>
</head>
<body>
<div class="header">
<div class="topban">
  <div class="ban">
    <div class="news"><a href="#" target="_blank">三国快，31wan三国快打首服服火爆登场</a></div>
    <div class="links">
     <a href="#" onClick="setHomepage('<?php echo ($_SERVER['HOST']); ?>/?f=home');return false;">设为首页</a> | <a href="#" onclick="AddFavorite('http://www.31wan.cn/?f=fav', '31wan网页游戏');return false;">加入收藏</a></div>
    <div class="s_games">
    <a class="tit">网页游戏全目录</a>
      <div class="g_list">
        <ul>
 


    <?php $_result=D('game')->select(); if ($_result): $i=0;foreach($_result as $key=>$game):++$i;$mod = ($i % 2 );?><li>
<a class="red" target="_blank" href="/hall">
<?php echo ($game["gamename"]); ?>
</a>
</li><?php endforeach; endif;?>
        </ul>
        <div class="bg"></div>
      </div><!--g_list-->
    </div><!--s_games-->
  </div>
</div>
<div class="top">
  <div class="logo"><a href="/"><img src="<?php echo ($config["LOGO"]); ?>" alt="<?php echo ($config["SITENAME"]); ?>" width="226" height="66" /></a></div>
  <div class="banner">
    <embed class="banner_embed1" menu="" loop="" play="" scale="" quality="high" wmode="transparent" src="__TMPL__<?php echo ($config["THEME"]); ?>/swf/webtop1.swf" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" height="66" width="680" style="display:none;">
    <embed class="banner_embed2" menu="" loop="" play="" scale="" quality="high" wmode="transparent" src="__TMPL__<?php echo ($config["THEME"]); ?>/swf/webtop_sgkd.swf" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" height="66" width="680" style="display:block;">
  </div>
</div>
<div class="nav">
  <ul>
    <li class="<?php if($str == 'index'){echo 'on';}else{echo 'nor';} ?>"><a href="/" target="_self">首  页</a></li>
    <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?> 
    <?php switch($vo["islink"]): case "0": ?><li class="<?php if($vo['url1']==$str){echo 'on222';}else{echo 'nor111';} ?>"
    <a href="/<?php echo (url(lists,$vo["typeid"])); ?>" target="_self"><?php echo ($vo["typename"]); echo ($vo["url1"]); ?></a></li><?php break;?>
    <?php default: ?>  <li class="<?php if($vo['url1']==$str){echo 'on';}else{echo 'nor';} ?>">
    <a href="<?php echo ($vo["url"]); ?>" target="_self"><?php echo ($vo["typename"]); ?></a></li><?php endswitch; endforeach; endif; else: echo "" ;endif; ?>
  </ul>
  <div class="tj"><strong>热门推荐：</strong> <p>
	<?php if(is_array($lists)): $i = 0; $__LIST__ = array_slice($lists,0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><a href="/hall" target="_blank" title="<?php echo ($list["gamename"]); ?>"><?php echo ($list["gamename"]); ?></a> |<?php endforeach; endif; else: echo "" ;endif; ?> <a href="<?php echo U('lists/index?id=1');?>">更多&gt;&gt;</a> 
</p></div>
  <div class="n_l"></div>
  <div class="n_r"></div>
</div>
</div>