    function get_sid(self)
    {
    	var attr = self.getAttribute('server'); //服务器ID
    	var server = self.getAttribute('name'); //服服务器名称
    	var $server = $('#select_server_a');
    	var $server_id = $('#server_id');
    	$server.val(server);
    	$('#select_server_a').attr('sid',attr);
    	$server_id.val(attr);
		$('.radio').change();
		$('#cz_select_server').hide();
    }
    function paste_money(_money){
    	_money = parseInt(_money);
    	if(isNaN(_money)) _money = 0;
    	_money = Math.round(_money);
    	return _money;
    }
    $(document).ready(function(){
    	$('.p_name').html($('#yeepay').attr('node'));
    	$('#yeepay').attr('class','on');
    	$('.pay_ways li').mouseover(function(){
    		//$(this).attr('class','on');
    	});
    	$('.pay_ways li').mouseleave(function(){
    		//$(this).attr('class','');
    	});
    	$('.pay_ways li').click(function(){
    		$('#bankpay').attr('class','');
    	    
    		
    	
    		if($(this).attr('id')=="chinabank")
    		{    
    			$('#alipay').attr('class','');
    			$('#chinabank').attr('class','on');
    			$('#yeepay').attr('class','');
    			$('#JUNNET').attr('class','');
    		   
    		}
    		
    		if($(this).attr('id')=="alipay")
    		{
    			$('#alipay').attr('class','on');
    			$('#chinabank').attr('class','');
    			$('#yeepay').attr('class','');
    			$('#JUNNET').attr('class','');
    		}
    		if($(this).attr('id')=="yeepay")
    		{
    		
    			$('#alipay').attr('class','');
    			$('#chinabank').attr('class','');
    			$('#yeepay').attr('class','on');
    			$('#JUNNET').attr('class','');
    		}
    		if($(this).attr('id')=="JUNNET")
    		{
    		
    			$('#alipay').attr('class','');
    			$('#chinabank').attr('class','');
    			$('#yeepay').attr('class','');
    			$('#JUNNET').attr('class','on');
    		}
	    	
    		if($(this).attr('id') != "yeepay"){
    	    	$('.bank_list_a').hide();
    	    	$('.card_info').hide(1200);
    	    }
    		//网银充值
    		if($(this).attr('id')=="yeepay")
    		{
    			$('.bank_list_a').show();
    	    	$('.card_info').hide(600);
    		}
    		if($(this).attr('id')=="pay4399")
    		{
    			$('#JUNNET').attr('class','on')
    		   $('.card_info').show(600);
    		}
    		if($(this).attr('id')=="JUNNET")
    		{
    		
    		   $('.card_info').show(600);
    		}
        	$('.p_name').html($(this).attr('node'));
    		$.dialog.tips('您选择的是'+$(this).attr('node'));
    	    $('#pay_tag').val($(this).attr('id'));
    	});
    	$('.select_game_btn').click(function(){
    		 var $server = $('#select_server_a').val();
    		 if($server!="")//如果server有数据就清空
    			 {
    			   $('#select_server_a').val('');
    			   $('#server_id').val('');
    			   $('.benShowSelectGame').show(500);
    			 }
    		 else
    			 {
  			   $('.benShowSelectGame').show(500);
    			 }
    		 
     	});
    	$('.close_select_game_win_btn').click(function(){
    		$('.benShowSelectGame').hide(200);
    	});
    	$('#no1').click(function(){
    		$(this).attr('class','on');
    		$('#no2').attr('class','.no_2');
    		$('.pay_last_game_list').show();
    		$('.payg_list').hide();
    	})
    	$('#no2').click(function(){
    		$('#no1').attr('class','.no_1');
    		$(this).attr('class','on');
    		$('.payg_list').show();
    		$('.pay_last_game_list').hide();
    	});
    	$('.all_game_data li').mouseover(function(){
    		$(this).css('border','1px solid red');
    	});
    	$('.all_game_data li').mouseleave(function(){
    		$(this).css('border','');
    	});
    	$('.all_game_data li').click(function(){
    		var $gid = $(this).attr('data');
    		var $game = $(this).attr('game');
    		$('#select_game_a').attr('gid',$gid);
    		$('#select_game_a').val($game);
    		$('#game_id').val($gid);//赋值给隐藏框
    		$('.benShowSelectGame').hide();
    		$.ajax({
    			url:"/index.php?m=pay&a=get_server",
    			type:"get",
    			data:"gid="+$gid,
    			dataType:"html",
    			cache:false,
    			success:function(data){
    				$('#cz_select_server').show();
    				$('.cz_sega_boxa .all_servers').html(data);
    			},
    			error:function()
    			{
    				$.dialog.tips('获取服务器列表失败,请刷新后重试.');
    			}
    		})
     	});
    	$('.select_server_btn').click(function(){
    		if($('#game_id').val()!=""){
    		$('#cz_select_server').show();
    		}else{
       		 $('.benShowSelectGame').show(500);
    		}
    	});
    	$('.close_select_server_win_btn').click(function(){
    		$('#cz_select_server').hide();

    	});
    	$("input#other_money").blur(function(){
    		_money = paste_money($("input#other_money").val());
    		if(_money == 0 || isNaN(_money)){
    			$("input#other_money").val('');
    			return;
    		}
    		this_money_limit = $('.limit_money_a').text().split('-');
    		this_money_limit1 = parseInt(this_money_limit[0]);
    		this_money_limit2 = parseInt(this_money_limit[1]);
    		if(_money < this_money_limit1){
    			_money = this_money_limit1; 
    		}else if(_money > this_money_limit2){
    			_money = this_money_limit2;
    		}
    		$("input#other_money").val(_money);
 
    	}).focus(function(){
    		$("input#other_money_radio").attr('checked', true);
 
    	});
    	$('#game_account').blur(function(){
    		var $val = $(this).val();
    		if($val!=""||$val.length>4){
    		  $.ajax({
    			  url:'/index.php?m=pay&a=u_check',
    			  data:'user='+$val,
    			  type:'get',
    			  dataType:'json',
    			  cache:false,
    			  success:function(data)
    			  {
    				 $('.show_msg_a1').html('');
    				 $('.show_msg_a1').html(data.msg);
    			  },
    		      error:function(){
    		    	  $.dialog({
    		    		  title:'错误警告',
    		    		  content:'系统发生错误:检测用户名操作未能成功,系统即将刷新,请重试',
    		    		  lock:true,
    		    		  ok:function(){
    		    			  window.location.reload();
    		    		  }
    		    	  })
    		      }
    		  })
    		}else{
    			$('.show_msg_a1').html('输入有误');
    		}
    	});
    	$('#game_account2').blur(function(){
    		var $game_account = $('#game_account').val();
    		if($game_account!=""||$game_account.length>4)
    		{
    		    if($game_account == $(this).val()){
    		    	$('.show_msg_a2').html('输入正确');
    		    }
    		    else{
    		    	$('.show_msg_a2').html('两次输入不一致');
    		    }
    	    }else{
		    	$('.show_msg_a2').html('输入有误');
    	    }
    	});
    	$('.radio').change(function(){
    		var $game = $('#select_game_a').attr('gid');
    		var $server = $('#select_server_a').attr('sid');
    		if($game==""||$server==""){
    			$.dialog({
    				title:'系统信息',
    				content:'请先选择要充值的游戏和服务器.',
    				ok:function(){
    	    			$('.select_game_btn').click();
    				},
    				lock:true,
    				icon:'warning'
    			})
    			return false;
    		}
    		$.ajax({
    			url:'/index.php?m=pay&a=cash_change_currency',
    			type:'get',
    			dataType:'json',
    			data:'game='+$game+'&server='+$server+'&cash='+$('.radio:checked').val(),
    			success:function(data){
    				if(data.state!= 1){
    					$.dialog.tips(data.msg);
    					return false;
    				}
    				$('.gameb').html(data.cash+data.currency);
    				$('.gameb').show(600);
    			},
    			error:function(){
    				$.dialog.tips('获取货币发生错误.请稍候重试');
    			}
    		})
    	});
    	$('#other_money').blur(function(){
    		var $game = $('#game_id').val();
    		var $server = $('#server_id').val();
    		if($game==""||$server==""){
    			$.dialog.tips('请先选择要充值的游戏和服务器.');
    			return false;
    		}
    		$.ajax({
    			url:'/index.php?m=pay&a=cash_change_currency',
    			type:'get',
    			dataType:'json',
    			data:'game='+$game+'&server='+$server+'&cash='+$(this).val(),
    			success:function(data){
    				if(data.state!= 1){
    					$.dialog.tips(data.msg);
    					return false;
    				}
    				$('.gameb').html(data.cash+data.currency);
    				$('.gameb').show(600);
    			},
    			error:function(){
    				$.dialog.tips('获取货币发生错误.请稍候重试');
    			}
    		})
    	});
       $('.text3').click(function(){
    	  var $game = $('#select_game_a').val();
    	  var $gid = $('#select_game_a').attr('gid');
    	  var $server = $('#select_server_a').val();
    	  var $sid = $('#select_server_a').attr('sid');
    	  var $account = $('#game_account').val();
    	  var $accounts  = $('#game_account2').val();
    	  var $bank = $('.bank_lists:checked').val();
    	  $.ajax({
    		  url:'/index.php?m=pay&a=create_order',
    		  cache:false,
    		  data:'{t:d}',
    		  type:'get',
    		  success:function(data){
    			  if($game!=""&&$gid!=""&&$server!=""&&$sid!=""&&$account==$accounts&&$account!=""){
    	    		  var $payport = $('.p_name').html();
    	    		  $('.show_result_paytype').html($payport);
    	    		  var $game = $('#select_game_a').val();
    	              $('.show_result_game').html('<font color=red>'+$game+'</font>');
    	              var $server = $('#select_server_a').val();
    	              $('.show_result_server').html('<font color=red>'+$server+'</font>');
    	     		  var $order = $('.show_result_order').html('<font color=red>'+data+'</font>');
    	              var $user = $account;
    	              $('.show_result_username').html('<font color=red>'+$user+'</font>');
    	              var $money = $('.radio:checked').val();
    	              if($money == undefined)
    	              {
    	            	  $money = $('#other_money').val();
    	              }
    	              $('.show_result_money').html($money+'元');
    	              var $gamecoin = $('.gameb').html();
    	              $('.show_result_glod').html($gamecoin);
    	              
    	              $addr = $('.to_where:checked').val();
    	              $('#game_id').val($('#select_game_a').attr('gid')); //游戏ID
    	              $('#server_id').val($('#select_server_a').attr('sid'));//服务器ID
    	              $('#order_id').val(data);//order
    	              $('#user_id').val($user);//用户
    	              $('#user_id2').val($accounts);
    	              $('#pay_money').val($money);
    	              $('#pay_where').val($addr);	
    	              $('#pay_bank').val($bank);
    	              if($('.p_name').html() == "4399一卡通" || $('.p_name').html() == "骏网一卡通")
    	              {
    	            	  var card_no = $('#card_no').val();
    	            	  var card_pass = $('#card_pwd').val();
    	            	  if(card_no!=""||card_pass!="")
    	                  {
    	            		  $('#pay_card_no').val(card_no);
    	            		  $('#pay_card_pwd').val(card_pass);
    	                  }
    	            	  else
    	                  {
    	            		  $.dialog.tips('请填写充值卡卡号密码');
    	            		  return false;
    	                  }
    	              }
    	           
    	           
    	            	
    	    
    	     		  $.dialog({
    	    			  title:'订单确认',
    	    			  content:$('#cz_ok').html(),
    	    			  lock:true,
    	    			  ok:function(){
    	    				  var $pop = $('#Pop').html();
    	    				  $('#gotopay_form').submit();
    	    				  $.dialog({
    	    					  title:'系统提示',
    	    					  content:$pop,
    	    					  lock:true
    	    				  });
    	    			  },
    	    			  cancel:function(){
    	    				  $.dialog.close();
    	    			  },
    	    			  okVal:'确认订单',
    	    			  cancelVal:'返回修改'
    	    		  })
    	    	  }else{
    	    		  $.dialog.alert('请完善信息再进行充值');
    	    		  return false;
    	    	  }
    		  },
    		  error:function(){
    			  $.dialog.alert('获取订单失败,请刷新重试');
    		  }
    	  })
       })
     })