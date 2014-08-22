// JavaScript Document
var user_name = get_cookie("qq163_user").toString();
var user_id = parseInt(get_cookie("qq163_userid"));
if (user_name && (isNaN(user_id)||user_id<=0)){
    if (user_name.indexOf('@qq')<=0){
        $("input[name='user_name']").val(user_name);
    }
}else if(user_name){
    login_show_loged(user_name);
    show_user_safe_info();
    show_last_play(user_name);
}

$(document).ready(function(){
    $("head").append('<link rel="stylesheet" href="http://' + comm_setting.DOMAIN +'/css/stage/safe.css?v=2" />'); 
    
    //输入用户名判断
    var word = '请输入用户名';
    if($('#user_name').val() == "" || $('#user_name').val() == word){
        $('#user_name').val(word);
        $('#user_name').css('color', '#ccc');
    }else{
        $('#user_name').css('color', '#000');
    }
    $('#user_name').focus(function(){
        $('#user_name').css('color', '#000');
        if($('#user_name').val() == word) $('#user_name').val('');
    });
    $('#user_name').blur(function(){
        if($('#user_name').val() == ''){
            $('#user_name').val(word);
            $('#user_name').css('color', '#ccc');
        }
    });

    $("form#login_box").submit(function(){
        var form = $(this);
        var target = form.attr('action');
        var inputs = login_check_input(form, word);
        if(inputs.length!=2){
            login_show_tips(form,"用户名或者密码没有填写",1);
            return false;
        }
        $.getJSON(target+"?user_name="+inputs[0]+"&user_pwd="+encodeURIComponent(inputs[1])+"&game="+login_check_game($(this))+"&keep_live="+((form.find('input[name="keep_live"]:checked').length>0||form.find('input[name="keep_live"]').length==0)?1:0)+"&api=1&return_format=JSON&jsoncallback=?",function(data){
            if(data[0]){
                user_name = inputs[0];
                login_show_loged(inputs[0]);
                show_user_safe_info();
                login_show_tips(form,"欢迎回来",1);
                form.find('input[name="user_pwd"]').val('');
                show_last_play(inputs[0]);
                var game=gameName();
                //入口设置
                if(game== 'mhfx'){
                    userp.show(user_name, game);
                }

                if(typeof login_callback != 'undefined'){
                    login_callback(user_name);
                }
                
		//媒介数据统计
                USER = user_name;
                record_relog();
            }else{
                var msg = "";
                switch(data[1]){
                    case "201":
                        msg = "用户密码不正确";
                        break;
                    case "202":
                        msg = "用户账号不存在，请检查确认。";
                        break;
                    case "203":
                        msg = "账号异常，详情请咨询客服。";
                        break;
                }
                login_show_tips(form, msg, 1);
            }
        });
        return false;
    });
	
    $(".global_reg").click(function(){
        var _top = $(document).scrollTop()+($(window).height()/2)-255;
        var _left = ($(window).width()/2)-325;
        if (_top<0){
            _top = 0;
        }
        if (_left<0){
            _left = 0;
        }
        $('body').append('<div id="full_mark" style="height:'+$(document).height()+'px;"></div>');
        $('body').append('<iframe id="reg_iframe" src="http://'+comm_setting.DOMAIN+'/user/reg.php?in_frame=1&game_src='+login_check_game($(this))+'&referer='+encodeURIComponent(window.location)+'" frameBorder="0" style="top:'+_top+'px;left:'+_left+'px;" scrolling="no"></iframe>');
        $('body').append('<div id="reg_box_close" style="top:'+(_top)+'px; left:'+(_left+$('#reg_iframe').width()-28)+'px;"></div>');
        return false;
    });
	
    $(".global_logout").click(function(){
        $.getJSON('http://' + comm_setting.DOMAIN+'/user/logout.php?from=api&jsoncallback=?');
        $("#login_box").css('display', 'block');
        $("#logined").css('display', 'none');
        return false;
    });
	
    $("#reg_box_close").live("click",function close_reg_box(){
        $(this).remove();
        $('#full_mark').remove();
        $('#reg_iframe').remove();
    });
	
    if ($(".header .g_list ul").length > 0){
        if(location.href.indexOf(comm_setting.DOMAIN) == -1){
            _url = 'http://'+comm_setting.DOMAIN+'/games.php?jsoncallback=?';	
        }else{
            _url = 'http://'+comm_setting.DOMAIN+'/games.json';
        }
        $.getJSON(_url, function(games){
            var j=0;
            $.each(games,function(i, item){
                if(i != 'ch' && i != 'llj' && i != 'sbyh' && i != 'tmst'){
                    $(".header .g_list ul").append('<li><a game="'+i+'" href="'+item.url+'" target="_blank"'+(j<6?' class="red"':'')+'>'+item.name+'<span class="ico_'+i+'"></span></a></li>');
                }
                j++;
            });
        });
		
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
    }
	
    if (get_cookie("referrer") == ''||get_cookie("referrer") == 'undefined'){
        document.cookie = "referrer="+encodeURIComponent(document.referrer?document.referrer:document.location.href)+"; domain=qq163.com;";
    }
		
    function login_check_game(form){
        var game = form.find('input[name="game"]').val();
        if (typeof(game)=='string'&&game.replace(/^\s*|\s*$/g,'')!=""){
            return game;
        }
        var url = window.location.href.replace("http://",'');
        var url_1 = url.split("/");
        var url_2 = url.split(".");
        return ((url_2[0]=='www'&&url_1.length>2)?url_1[1]:url_2[0]);
    }
    function login_check_input(form, word){
        var inputs = [];
        var _user = form.find('input[name="user_name"]').val();
        var _pwd = form.find('input[name="user_pwd"]').val();
        if (_user.replace(/^\s*|\s*$/g,'')=="" || _user == word){
            form.find('input[name="user_name"]').focus();
            return inputs;
        }
        else{
            inputs.push(_user);
        }
        if (_pwd.replace(/^\s*|\s*$/g,'')==""){
            form.find('input[name="user_pwd"]').focus();
            return inputs;
        }
        else{
            inputs.push(_pwd);
        }
        return inputs;
    }
    function login_clear_tips(){
        $("#form_mark_content").remove();
        $("#form_mark").remove();
    }
    function login_show_tips(form,tips,timeout){
        var  _top = form.offset().top - form.offsetParent().offset().top-10;
        var  _left =form.offset().left - form.offsetParent().offset().left;
        form.append('<div id="form_mark" style="top:'+_top+'px;left:'+_left+'px;width:'+form.width()+'px;height:'+form.height()+'px;"></div>');
        form.append('<table id="form_mark_content" style="top:'+(_top+(form.height()*0.1))+'px;left:'+(_left+(form.width()*0.1))+'px;width:'+(form.width()*0.8)+'px;height:'+(form.height()*0.5)+'px;"><tr><td style="width:'+(form.width()*0.8-12)+'px; height:'+(form.height()*0.5-14)+'px;">'+tips+'</td></tr></table>');
        if (parseInt(timeout)>0){
            setTimeout(login_clear_tips,timeout*1000);
        }
        if(typeof tips_callback != 'undefined'){
            tips_callback();
        }
    }
});



function get_cookie(cookie_name){
    if (document.cookie == ''){
        return '';
    }
	
    var value = '';
    var cookie_values = document.cookie.split(";");
    for (i in cookie_values){
        temp = $.trim(cookie_values[i]).split("=");
        if (temp[0] == cookie_name){
            value = temp[1];
            try{
                value = decodeURIComponent(value);
            }catch(e){}
            break;
        }
    }

    return value;
}

function show_user_safe_info(){
    if (user_name.indexOf('@qq')>0){ 
        $('#safe_level').html('您是QQ账号登录状态').css('color','#666');
        $('.benSafeInfo,.benSafeInfo p').css('color','#F2F7FF');
        return false;
    }else if(user_name.indexOf('@17173')>0){ 
        $('#safe_level').html('您是17173账号登录状态').css('color','#666');
        $('.benSafeInfo,.benSafeInfo p').css('color','#F2F7FF');
        return false;
    }
    var safe_info = get_cookie('qq163_safe');
    $('.benSafeInfo,.benSafeInfo p').css('color','#666');
    try{
        eval("safe_info="+safe_info+";");
    }
    catch(e){}
	
    if (safe_info[0]){
        safe_star(safe_info[0]);
        safe_server(safe_info[1]);
    }
}

function safe_star(level){
    $('#safe_level').html('');
    var color = (level<30?"red":(level<60?"yellow":"green"));
    $('#safe_level').addClass(color);
    for(var i=20;i<=100;i+=20){
        if (i<=level){
            $('#safe_level').append('<span class="satr full">&nbsp;</span>');
        }else{
            $('#safe_level').append('<span class="satr'+(i-parseInt(level)==10?' half':'')+'">&nbsp;</span>');
        }
    }
    if (level<100){
        $('#safe_level').append('&nbsp;<a target="_blank" href="/safe/">马上升级</a>');
    }
}

function safe_server(server){
    $('#safe_server').html('');
    var protected_name = {
        'phone':'手机短信',
        'qq':'QQ',
        'email':'电子邮箱',
        'ques':'密保问题'
    };
    $.each(server, function(i,item){
        $('#safe_server').append('<span id="icon_'+i+'" class="icon icon_'+i+' icon_' + i + '_' +(item==1?'on':'off')+ ' ' + (item==1?'on':'off')+'">&nbsp;<div class="f_box"><div>您的账号'+(item==1?'已经':'还没')+'开通'+protected_name[i]+'保护<br /><a href="/safe/" target="_blank">查看详情</a></div></div></span>');
    });

    var icon_mouse_on = {
        'icon_phone':false,
        'icon_email':false,
        'icon_qq':false,
        'icon_ques':false
    };
    $("#safe_server span").hover(function(){
        show_float($(this).attr('id'));
        icon_mouse_on[$(this).attr('id')] = true;
    },function(){
        hide_float($(this).attr('id'));
        icon_mouse_on[$(this).attr('id')] = false;
    });
    $("#safe_server span div").hover(function(){
        show_float($(this).parent().attr('id'));
        icon_mouse_on[$(this).parent().attr('id')] = true;
    },function(){
        hide_float($(this).parent().parent().attr('id'));
        icon_mouse_on[$(this).parent().parent().attr('id')] = false;
    });
	
    function hide_float(icon_type){
        setTimeout(function(){
            if(!icon_mouse_on[icon_type]){
                $("#safe_server #"+icon_type+" .f_box").fadeOut('slow');
            }
        }, 200);
    }
    function show_float(icon_type){
        $("#safe_server #"+icon_type+" .f_box").fadeIn('fast');
    }
}

function show_last_play(user){
    var game_num = $('.History').length>0?4:1;
    $.getJSON("http://"+comm_setting.DOMAIN+"/api/user/last_play_game.php?user="+user+"&num="+game_num+"&return_format=JSON&jsoncallback=?", function(games){
        if (games.length>0){
            if($('.History').length>0){
                $(".History").html('<p>您最近玩过的游戏</p><ul style="height:auto;"></ul>');
                $.each(games, function(i, item){
                    $(".History ul").append('<li><a href="http://'+comm_setting.DOMAIN+'/game/game.php?game='+item[1]+'&server='+item[2]+'" target="_blank">'+item[0]+'</a></li>');
                });
            }else{
                $(".GameHistory p:eq(1)").html('<a href="http://'+comm_setting.DOMAIN+'/game/game.php?game='+games[0][1]+'&server='+games[0][2]+'" target="_blank">'+games[0][0]+'</a>');	
            }
        }
    });
}

function login_show_loged(user_name){
    var lastlog = get_cookie("qq163_lastlog");
    try{
        eval("lastlog="+lastlog+";");
    }
    catch(e){}

    $("#logined #user").html(user_name.indexOf('@qq')<=0?user_name:'<img src="http://' + comm_setting.DOMAIN_IMG + '/qq_logo.png" width="16" height="16"/> '+get_cookie("qq_nickname").replace('+','')+' - '+user_name).attr('title',user_name.indexOf('@qq')<=0?user_name:''+get_cookie("qq_nickname").replace('+','')+' - '+user_name);
    if (lastlog){
        if (lastlog.time){
            $("#logined #last_time").text(lastlog.time.replace('+'," "));
            $("#logined #last_addr").text(lastlog.addr);
        }
    }
    $("#login_box").css('display',"none");
    $("#logined").css('display',"block");
}

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
function gameName() {
    var url = window.location.href;
    var url_part = url.split('/');
    var game;
    if (url_part[2] == comm_setting.DOMAIN) {
        game = url_part[3];
    } else {
        temp = url_part[2].split('.');
        game = temp[0];
    }
    return game;
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