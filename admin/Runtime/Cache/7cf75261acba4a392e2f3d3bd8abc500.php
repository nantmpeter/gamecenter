<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <link href="__PUBLIC__/admin/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="__PUBLIC__/admin/js/jquery-1.8.0.min.js" type="text/javascript"></script>
    <script src="__PUBLIC__/admin/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="__PUBLIC__/js/dialog/jquery.artDialog.js?skin=default" type="text/javascript"></script>
    <script src="__PUBLIC__/js/dialog/plugins/iframeTools.js" type="text/javascript"></script>
    <script>
    $(document).ready(function(){
    	$('.btn1').click(function(){
    		var data = $('#username').val();
    		var money = $('#money').val();
    		var type= "^[0-9]*[1-9][0-9]*$";
    		var re = new RegExp(type);
    		if(data.length<4||data==""){
    			$.dialog.tips('请输入要充值的用户名');
    			return false;
    		}
     		if(money.match(re)==null){
    			$.dialog.tips('充值的金额必须为整数！');
    			return false;
    		}
    		$.dialog({
    			title:'确认充值',
    			content:'您确认为'+data+'充值'+money+'平台币吗?',
    		    lock:true,
    		    okVal:'确认充值',
    		    cancelVal:'我再想想',
    		    ok:function(){
    		    	$('#form1').submit();
    		    },
    		    cancel:function(){
    		    	$.dialog.close();
    		    	 
    		    }
    		})
    	})
    })
    </script>
<title>平台币充值</title>
</head>
<body>
 <div class="container">
 </br>
         <form class="form-horizontal" id="form1" method="post" action="<?php echo U('pay/pay_member_plf');?>">
         
         <div class="control-group">         
		 <div class="input-prepend">
		    <label class="control-label" for="username">用户名</label>
		    <div class="controls">
		  <input class="span2" id="username" name="username" type="text" placeholder="Username">
		  </div>
		</div>
		 </div>
<div class="control-group">         
<div class="input-append">
 <label class="control-label" for="username">充值金额</label>
		    <div class="controls">
		    <span class="">￥</span>
  <input class="span2" id="money" name="money" type="text">
  <span class="">.00</span>
  </div>
  <br/>
   <label class="control-label" for="remark">备注</label>
     <div class="controls">
  <textarea name="remark" id="remark" cols="20" rows="3"></textarea>
  </div>
</div>
     <div class="control-group">
     
    <div class="controls">
       <br/>
      <button type="button" class="btn1">充值平台币</button>
    </div>
  </div>
 </div>
 </form>
 </div>
 </body>
 </html>