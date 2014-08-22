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
     	   url:'/hall/server_info',
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
     	   type:'get'
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
            headHtml += "<div class='btn'><a class='b1' href='/hall.html#"+game+"servers'>开始游戏</a><a class='b2' href='http://"+game+".qq163.com/xsk/' target='_blank'>新手卡</a><a class='b2' href='http://"+game+".qq163.com' target='_blank'>官网</a><a class='b3' href='http://bbs.qq163.com/"+game+"/' target='_blank'>玩家交流</a></div>";
        }else{
            headHtml += '抱歉，暂不存在此游戏的信息';
        }
        
        //列举所有服务器信息+推荐服务器信息
        goodServer += "<h5 id='"+game+"servers'><font color='#EC550B'>"+gameName+"</font>推荐服务器</h5><ul id='_good_server'>";
        tempHtml += "<h5><font color='#EC550B'>"+gameName+"</font>所有服务器列表</h5><div class='all'><div class='ban'></div></div><ul id='_all_server'>";
        
        for(i in data[game]['servers']){
            tempHtml +="<li><span>"+data[game]['servers'][i]['status']+"</span><a href='/game/game.php?game="+game+"&server="+data[game]['servers'][i]['id']+"' target='_blank'>"+data[game]['servers'][i]['name']+" "+data[game]['servers'][i]['line']+data[game]['servers'][i]['desc']+"</a></li>";   
            
            if(data[game]['servers'][i]['is_recommended']){
                goodServer += "<li><span>"+data[game]['servers'][i]['status']+"</span><a href='/game/game.php?game="+game+"&server="+data[game]['servers'][i]['id']+"' target='_blank'>"+data[game]['servers'][i]['name']+" "+data[game]['servers'][i]['line']+data[game]['servers'][i]['desc']+"</a></li>";
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
	
    var game = $(".games li:eq(0)").attr("desc");
    var game_name = $(".games li:eq(0)").find("a").attr("title");
    if (!game_name) return;
    $('.g_more').html('');
    $('.g_more').append('<h2>《'+game_name+'》</h2>');
    if(typeof tempData[game] != 'undefined'){
        hall.showData(game, tempData[game]);
    }else{
        $.ajax({
	       type:'get',
    	   url:'/hall/server_info',
    	   data:'gid='+game,
    	   dataType:'json',
    	   error:function(){
    		  // alert(game);
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
    			
    			    hall.showData(game, data);
    	            tempData[game] = data;
    			  	
    			   }
    	   },
    	   cache:false,
    	   
       })	
       
    }
});
