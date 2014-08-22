document.domain = '51wan.com';
var my_url = 'http://my.51wan.com/';
var user_url = 'http://user.51wan.com/';

function str_cut(str, len){
	var returnStr = '';
	for (var i=0, length=str.length; i<length; i++){
		if (str.charCodeAt(i) > 255 || str.charCodeAt(i) < 0) {
			len = len - 2;
		}else{
			len--;
		}
		if (len >= 0){
			returnStr = returnStr + str.substr(i, 1);
		}
	}
	return returnStr;
}


var hotGame = {
	on:{},
	containerPre:'newserver_',
	divContainerPre:'divnewserver_',
	serverClass:{0:'new',1:'hot'},
	show:function(gameMin) {
		if(!gameMin) return;
		if(typeof(this.on[gameMin])!='undefined') {
			$('#'+this.divContainerPre+gameMin).show();
		}
		else {
			var oThis = this;
			$.getJSON(my_url+"interface/gameAPI/newServer.php?update=1&game="+gameMin+'&jsoncallback=?', function(json){		//hotGameServer.php
				if(!json) return;
				var str = '';
				for(i=0;i<json.length;++i) {
					str+='<p class="'+oThis.serverClass[i]+'">';
					//var d = new Date(json[i].date*1000);
					//str+=(d.getMonth()+1)+'��'+d.getDate()+'��';
					str+=json[i].time.substring(5, 7)+'��'+json[i].time.substring(8, 10)+'��';
					//http://my.51wan.com/game_login_0_frxz-427-0.html
					str+='<a href="'+user_url+'reg.html?gamename='+gameMin+'&serverid='+json[i].id+'" target="_blank">'+json[i].name+'</a>';		//json[i].game+json[i].serverid
					str+='</p>';
				}
				str+='<a class="more" href="'+my_url+'game_0_0_'+gameMin+'.html" target="_blank">����</a>';
				str = '<div id="' + this.divContainerPre + gameMin + '">' + ( str ? str : '<ul><li style="background-image: none;">�ף�������ά���У����Ե�Ƭ�̡�</li></ul><a class="more" href="' + my_url + 'game_0_0_' + gameMin + '.html" target="_blank">�鿴���&gt;&gt;</a>' );
				
				$("#"+oThis.containerPre+gameMin).parent().append(str);
				$('#'+this.divContainerPre+gameMin).show();
				oThis.on[gameMin] = true;
			});
		}
	},
	hide:function(gameMin) {
		if(!gameMin) return;
		if(typeof(this.on[gameMin])!='undefined') {
			$('#'+this.divContainerPre+gameMin).hide();
		}
	}
};


// JavaScript Document
(function ($) {
	$.fn.extend({
	Scroll: function (opt, callback) {
	if (!opt) var opt = {};
	var _btnUp = $("#" + opt.up); //Shawphy:���ϰ�ť
	var _btnDown = $("#" + opt.down); //Shawphy:���°�ť
	var _this = this.eq(0).find("ul:first");
	var lineH = _this.find("li:first").height(); //��ȡ�и�
	var line = opt.line ? parseInt(opt.line, 10) : parseInt(this.height() / lineH, 10); //ÿ�ι�����������Ĭ��Ϊһ�������������߶�
	var speed = opt.speed ? parseInt(opt.speed, 10) : 600; //���ٶȣ���ֵԽ���ٶ�Խ�������룩
	var m = line; //���ڼ���ı���
	var count = _this.find("li").length; //�ܹ���<li>Ԫ�صĸ���
	var upHeight = line * lineH;
	var visible = this.height() / lineH;
	function scrollUp() {
		if (!_this.is(":animated")) { //�ж�Ԫ���Ƿ������ڶ�������������ڶ���״̬����׷�Ӷ�����
			if (m + visible-line+1 < count) { //�ж� m �Ƿ�С���ܵĸ���
			m += line;
			_this.animate({ marginTop: "-=" + upHeight + "px" }, speed);
			}
		}
	}
	function scrollDown() {
		if (!_this.is(":animated")) {
			if (m > line) { //�ж�m �Ƿ����һ������
			m -= line;
			_this.animate({ marginTop: "+=" + upHeight + "px" }, speed);
			}
		}
	}
	_btnUp.bind("click", scrollUp);
	_btnDown.bind("click", scrollDown);
	}
	});
 })(jQuery);

//�����Ϸ�б�
function leftGameListModule() {
	$("#scrollDiv").Scroll({ line:3, speed: 500,up: "btn1", down: "btn2" });
	$("#gamelist li").each (function () {
		$(this).mouseover(function(){
			$(this).removeClass().prev().css({'background-image':'none'});
			$(this).addClass("curr");
		}).mouseout(function(){
			$(this).removeClass();
			$(this).prev().removeAttr("style");
		});
	});
	
	$("#scrollDiv li").mouseover(function(){
		var index = $(this).index();
		var toL = $(this).width();
		var toY = $(this).position().top;
		$(".detail li").css({left:toL+4,top:toY}).hide().eq(index).show();
	}).mouseout(function(){
		$(".detail li").hide();
	});
	
	$(".detail li").mouseover(function(){
		$(this).show();
		var index = $(this).index();
		$("#scrollDiv li").removeClass().eq(index).addClass("curr");
		$("#scrollDiv .curr").prev().css({background:"none"});
	}).mouseout(function(){
		$(this).hide();
		$("#scrollDiv .curr").removeClass().prev().removeAttr("style");
	});
}

//������
function headAdModule() {
	var currentIndex = 0;
	var DEMO; //��������
	var currentID = 0; //ȡ������·��Ķ���ID
	var pictureID = 0; //����ID
	$("#ifocus_piclist li").eq(0).show(); //Ĭ��
	autoScroll();
	$("#ifocus_btn li").hover(function() {
			StopScrolll();
			$("#ifocus_btn li").removeClass("current")//���е�liȥ����ǰ����ʽ������������ʽ
			$(this).addClass("current"); //����������ϵ�ǰ����ʽȥ����������ʽ
			currentID = $(this).attr("id"); //ȡ��ǰԪ�ص�ID
			pictureID = currentID.substring(currentID.length - 1)-1; //ȡ���һ���ַ�
			$("#ifocus_piclist li").filter(":visible").hide(); //����������ʾ��ͼƬ
			$("#ifocus_piclist li").eq(pictureID).show(); //��ʾ��ǰ���ָ���ͼƬ	
                        //$("#ifocus_piclist li").filter(":visible").fadeOut(); //����������ʾ��ͼƬ
			//$("#ifocus_piclist li").eq(pictureID).fadeIn(); //��ʾ��ǰ���ָ���ͼƬ
			//$("#ifocus_piclist li").not($("#ifocus_piclist li")[pictureID]).hide(); //����������ȫ������
			$("#ifocus_tx li").hide();
			$("#ifocus_tx li").eq(pictureID).show();

	}, function() {
			//������뿪�����ʱ���õ�ǰ�Ķ����ID�Ա����������Զ�ʱ����ͬ��
			currentID = $(this).attr("id"); //ȡ��ǰԪ�ص�ID
			pictureID = currentID.substring(currentID.length - 1)-1; //ȡ���һ���ַ�
			currentIndex = pictureID;
			autoScroll();
	});
			//�Զ�����
	function autoScroll() {
		$("#ifocus_btn li:last").removeClass("current");
		$("#ifocus_tx li:last").hide();
		$("#ifocus_btn li").eq(currentIndex).addClass("current");
		$("#ifocus_btn li").eq(currentIndex - 1).removeClass("current");
		$("#ifocus_tx li").eq(currentIndex).show();
		$("#ifocus_tx li").eq(currentIndex - 1).hide();
		$("#ifocus_piclist li").eq(currentIndex).fadeIn("slow");
		$("#ifocus_piclist li").eq(currentIndex - 1).hide();
		currentIndex++; currentIndex = currentIndex >= 5 ? 0 : currentIndex;
		DEMO = setTimeout(autoScroll, 3000);
	}
	function StopScrolll()//������ƶ������������ʱ��ֹͣ�Զ�����
	{
			clearTimeout(DEMO);
	}
			//�� e
	$("div.picList").carousel({dispItems:3});
	$("dd.info").carousel({direction:"vertical",equalWidths:"false"});
}


//��Ϸ����ģ��
function gameGuideModule(){
	var li = $("#ranks_change_bar li");
	var licount = li.length;
	var next = $("#next");
	var previous = $("#previous");
	$("#scroll_content ul:eq(0)").show().siblings("ul").hide();
	$("#ranks_change_bar li:eq(0)").addClass("nav_current").siblings("li").removeClass("nav_current");
	$("#ranks_change_bar li").each(function(){
		var nowcount = $(this).index();
		$(this).click(function(){
			if(nowcount == 0){
				next.css("background-position","-144px -1061px");
				previous.css("background-position","0 -1061px");
			}else if(nowcount == licount-1){
				next.css("background-position","-45px -1061px");
				previous.css("background-position","-99px -1061px");
			}else{
				next.css("background-position","-144px -1061px");
				previous.css("background-position","-99px -1061px");
			};
			$(this).addClass("nav_current").siblings("li").removeClass("nav_current");	
			$("#scroll_content ul:eq("+nowcount+")").show().siblings("ul").hide();
		});	
	});
	if(licount<6){
		next.css("background-position","-45px -1061px");
		previous.css("background-position","0 -1061px");
	}else{
		next.click(function(){
				var linow = $(".nav_current").index()+1;
				var lihide = linow-4;
				var lilt = $("#ranks_change_bar li:lt("+lihide+")");
				var lieq = $("#ranks_change_bar li:eq("+linow+")");
				var uleq = $("#scroll_content ul:eq("+linow+")");
				if(linow > 4){
					if(linow == licount){
						return false;
					}else{
						if(linow == licount-1){
							next.css("background-position","-45px -1061px");
							previous.css("background-position","-99px -1061px");
							lilt.hide();
							lieq.addClass("nav_current").siblings("li").removeClass("nav_current");
							uleq.show().siblings("ul").hide();
						}else{
							$("#next").css("background-position","-144px -1061px");
							previous.css("background-position","-99px -1061px");
							lilt.hide();
							lieq.addClass("nav_current").siblings("li").removeClass("nav_current");
							uleq.show().siblings("ul").hide();
						}
					}
				}else{
					next.css("background-position","-144px -1061px");
					previous.css("background-position","-99px -1061px");
					lieq.addClass("nav_current").siblings("li").removeClass("nav_current");
					uleq.show().siblings("ul").hide();
				};
		});
		previous.click(function(){
				var linow = $(".nav_current").index()-1;
				var lieq = $("#ranks_change_bar li:eq("+linow+")");
				var uleq = $("#scroll_content ul:eq("+linow+")");
				if(linow < 1){
					next.css("background-position","-144px -1061px");
					previous.css("background-position","0 -1061px");
					lieq.show().addClass("nav_current").siblings("li").removeClass("nav_current");
					uleq.show().siblings("ul").hide();
				}else{
					next.css("background-position","-144px -1061px");
					previous.css("background-position","-99px -1061px");
					lieq.show().addClass("nav_current").siblings("li").removeClass("nav_current");
					uleq.show().siblings("ul").hide();
				};
		});
	};
};

//��ϷͼƬģ��
function gamePictureModule() {
	var gEff = {
		tabmenu: function(obj) {
			var a = obj.show;
			for (var m = 0; m < a.length; m++) { //��ѭ��(���ٸ�������Ҫ�л�)
				$(a[m][0]).each(function(i) { //��ѭ��(���ٸ��˵���Ҫ�л�)
					var mm = m;
					$(a[mm][0]).eq(0).addClass(a[mm][2]);
					$(a[mm][1]).eq(0).addClass(a[mm][2]);
					$(this).mouseover(function() {
						$(a[mm][0]).removeClass(a[mm][2]).eq(i).addClass(a[mm][2]);
						$(a[mm][1]).removeClass(a[mm][2]).eq(i).addClass(a[mm][2]);
					});
				});
			}
		}
	};
	gEff.tabmenu({
		show: [
			["#announce .hd li", "#announce .bd ul", "curr"]
		]
	});
}

//���ڿ���ģ��
function recentOpenServerModule() {
	function parseToHtml (day, type, total){
		var html	= '';
		total		= parseInt(total);
		var j		= 0;
		var today_page = 1;		//lifz add
		var today_pageamount = 8;	//lifz add
		if (total > 0){
			for (name in day){
				if (day.hasOwnProperty(name)){
					var temp	= day[name];
					var game	= temp.game || '';
					var gameName	= temp.gameName ? str_cut(decodeURI(temp.gameName), 10) : '';
					var server	= temp.server || {};
					var gift	= temp.hasGift == '1' ? '<a class="gifts" href="'+my_url+'app_giftnew_getXsk_0.html?game='+game+'" target="_blank">��Ʒ��</a>' : '';
					for(var i=0, count=server.length; i<count; i++,j++){
						var s		= server[i];
						var serverName	= s.serverNum == 0 ? '����' : s.serverNum+'��';
						var href	= target = '';
						var oClass	= 'class="server"';
						if (s.power=='1'){
							href	= 'href="'+user_url+'reg.html?gamename='+game+'&serverid='+s.serverId+'" target="_blank"';
							oClass	= 'class="servers"';
							
						} else {
							//if(type == 'tomorrow' || s.state=='5'){
							//	href	= 'href="javascript:void(0);"';
							//}else{
								href	= 'href="'+my_url+'game_0_0_'+game+'.html" target="_blank"';
							//}
						}
						switch(type){
							case 'yesterday':
							case 'tomorrow':
								if (j == 0) {
									html	+= '<li>';
								} else if(j%3 == 0){
									html	+= '</li><li>';
								}
								html	+= '<a '+href+'>'+gameName+' ['+serverName+']</a>';
								if (j == total-1){
									html	+= '</li>';
								}
								break;
							case 'today':
								var d	= s.openTime.split(' ');
								var t	= d[1].split(':');
								//start | lifz add
								if(j >= today_pageamount)
								{
									today_page = Math.ceil((j+1)/today_pageamount);
								}
								//end
								html	+= '<li p="' + today_page + '"' + (today_page == 1 ? 'style="display:inline;"' : 'style="display:none;"') + '><span class="time">'+t[0]+':'+t[1]+'</span><span class="gamename"><a '+href+'>'+gameName+'</a></span><a '+oClass+' '+href+'>'+serverName+'</a>'+gift+'</li>';
								break;
							default:
								break;
						}
					}
				}
			}
		}
		switch(type){
			case 'yesterday':
				html	= (html == '') ? '�޿�����¼.' : '<ul>'+html+'</ul>';
				$("#yesterday").html(html);
				if (total > 3){
					$("#yesterday").carousel({direction:"vertical",equalWidths:"false"});
				}
				break;
			case 'tomorrow':
				html	= (html == '') ? '���޿�����Ϣ���·�����������֪ͨ.' : '<ul>'+html+'</ul>';
				$("#tomorrow").html(html);
				if (total > 3){
					$("#tomorrow").carousel({direction:"vertical",equalWidths:"false"});
				}
				break;
			case 'today':
				var center	= '';
				if (total <= 2) {
					center	= ' class="single"';
				}
				html	= (html == '') ? '<ul'+center+'><li>��Ҵ�󣬽�����ʱδ���·�Ӵ��</li></ul>' : '<ul'+center+' id="today_game_ul">'+html+'</ul>';
				//start lifz add
				if(today_page > 1)
				{
					html += '<p>';
					for(var i = 1; i <= today_page; i ++)
					{
						html += '<a ' + (i == 1 ? 'class="s_pages" ' : '') + 'href="javascript:void(0);" page="' + i + '">' + i + '</a>';
					}
					html += '</p>';
				}
				//end
				$("#today").html(html);
				//start lifz add
				function togger_today_game_list()
				{
					$('a[page]').removeAttr('class');
					$(this).attr('class', 's_pages');
					$("#today_game_ul").children(':visible').hide();
					$('li[p=' + $(this).attr('page') + ']').css('display', 'inline');
					window.interval_togger_json.page = $(this).attr('page');
				}
				window.interval_togger_json = 
				{
					'togg' : null, 
					'page' : 2, 
					'min_page' : 1, 
					'max_page' : 1,
					'func' : function ()
					{
						if(window.interval_togger_json.page > window.interval_togger_json.max_page)
						{
							window.interval_togger_json.page = window.interval_togger_json.min_page;
						}
						$('a[page=' + window.interval_togger_json.page + ']').click();
						window.interval_togger_json.page ++;
					}
				}
				window.interval_togger_json.max_page = today_page;
				$('#today_game_ul').mouseover(function () { window.interval_togger_json.togg && clearInterval(window.interval_togger_json.togg); } );
				$('#today_game_ul').mouseout(function () { window.interval_togger_json.togg = setInterval("window.interval_togger_json.func();", 5000); } );
				$('a[page]').click(togger_today_game_list);
				$('#today_game_ul').mouseout();
				//end
				break;
			default:
				break;
		}
	}
	$.getJSON(my_url + 'interface/openserver.php?limit=20&jsoncallback=?', function(list){
		var d	= list.today['date'].split('-');
		$("#today_date").html(d[1]+'��'+d[2]+'��');
		parseToHtml(list.yesterday.info, 'yesterday', list.yesterday.total);
		parseToHtml(list.today.info, 'today', list.today.total);
		parseToHtml(list.tomorrow.info, 'tomorrow', list.tomorrow.total);
	});
}

//����Ϸģ��
function hotGameModule() {
	$("a[id^='newserver_']").each(function(){
		$(this).mouseover(function(){
			var game = $(this).attr('id').replace(hotGame.containerPre,'');
			hotGame.show(game);
		});
		$(this).mouseout(function(){
			var regx = '/'+hotGame.containerPre+'/';
			var game = $(this).attr('id').replace(regx,'');
			hotGame.hide(game);
		});
	});
	$(".popup").hover(function(){
		$(this).find("div").show();
	},function(){
		$(this).find("div").hide();
	});
}

//���ͼƬ����
function adLoadAction() {	
	$("#ifocus_piclist ul li").each(function(){
		var image = $('img', this);
		image.attr("src", image.attr("url"));
	});
}

//��Ϸ��������
var hotList = {};
function loadGameHotAction(){
	var containers = $('#gamelist ol.detail li');
	var count = containers.length;
	var games = new Array();
	var start = 0;
	for (var i=0; i<count; i++){
		games.push(containers.eq(i).attr('game'));
		if (i%10 == 9 || i>=count-1){
			var display = function(s){
				var e = Math.min(s+10, count);
				return function(data){
					for (var j=s; j<e; j++){
						var g=containers.eq(j).attr('game');
						if (data.hasOwnProperty(g)){
							containers.eq(j).find('.c_more strong').html(data[g]);
						}
					}
					$.extend(hotList, data);
				}
			}(start);
			$.getJSON(my_url + 'interface/gameAPI/gameHot.php?action=get&game='+games.join(',')+'&jsoncallback=?', display);
			start = i+1;
			games = [];
		}
	}
}

//�������
$(function(){
	var imgUrl = ["http://i4.51wan.com/v3/spec/18/503.jpg","http://i4.51wan.com/v3/spec/17/mall.jpg"];
	var linkHref = ["http://user.51wan.com/login.html?gamename=503&link=bt1","http://mall.51wan.com/?link=bt1"];
	var randomInfo = parseInt(Math.random()*imgUrl.length);
	$(".wrapper").css("background-image","url("+imgUrl[randomInfo]+")");
	$(".screen").attr("href",linkHref[randomInfo]);
	$("#header .bn a").attr("href",linkHref[randomInfo]);
});

leftGameListModule();
headAdModule();
gameGuideModule();
gamePictureModule();
recentOpenServerModule();
hotGameModule();
setTimeout(adLoadAction,500);
setTimeout(loadGameHotAction,1000);