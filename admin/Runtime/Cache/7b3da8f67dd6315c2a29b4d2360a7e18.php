<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <title>充值管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="__PUBLIC__/admin/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="__PUBLIC__/admin/js/jquery.min.js" type="text/javascript"></script>
    <script src="__PUBLIC__/admin/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="__PUBLIC__/admin/js/bootstrap-popover.js"></script>
    <script language="javascript" type="text/javascript" src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>
    <script src="__PUBLIC__/js/dialog/jquery.artDialog.js?skin=idialog" type="text/javascript"></script>
    <script src="__PUBLIC__/js/dialog/plugins/iframeTools.js" type="text/javascript"></script>
    <script src="__PUBLIC__/js/ajaxfileupload.js" type="text/javascript"></script>
    <script>
    $(document).ready(function(){
    	 $('#form2').submit(function(){
    		 //增加充值方式
    		 var $sort = $('#sort').val();
    		 var $icon = $('#iconc').val();
    		 var $tag = $('#tag').val();
    		 var $pay_name = $('#pay_name').val();
    		 var $fee = $('#fee').val();
    		 var $rebate = $('#rebate').val();
    		 var $content = $('#content').val();
    		 if($sort==""||$icon==""||$tag==""||$pay_name==""||$content==""){
    			 $.dialog.alert('请填写完整充值渠道的信息再进行提交!');
    			 return false;
    		 }
    		  
    	 })
    	 $('#load').click(function(){
   		  $.ajaxFileUpload({
   			  fileElementId :'icon',
   			  secureuri :false,
   			  type:'POST',
   			  dataType:'text',
   			  error:function(){$.dialog.tips('上传图标发生错误,请稍候再试')},
   			  success:function(data){
   				$('#iconc').val(data);
   				alert('上传成功.系统已经记录你的上传路径,请继续下一步操作.');
   				$('#icon_form').hide(2000);
   			  },
   			  url:"<?php echo U('pay/save_icon');?>"
   			  })
   	  })
    })
    </script>
   </head>
   <body>
     <div class="container">
   
	<form id="icon_form" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
	<div class="control-group">
    <br/>
    <label class="control-label" for="icon">图标</label>
    <div class="controls">
     <input type="file" id="icon" name="icon" placeholder="icon">&nbsp;&nbsp;<button type="button" class="" id="load">上传</button>
    </div>
  </div>
       </form>
  
     <form class="form-horizontal" id="form2" method="post" action="<?php echo U('pay/do_pay_way_add');?>">
  <div class="control-group">
    <label class="control-label" for="sort">排序</label>
    <div class="controls">
      <input class="input-mini" type="text" id="sort" name="sort" placeholder="排序" >
            <input class="input-mini" type="hidden" id="iconc" name="iconc" >
          
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Tag">Tag</label>
    <div class="controls">
      <input type="text" class="input-medium" class="" id="tag" name="tag" placeholder="tag">
    </div>
  </div>
   <div class="control-group">
    <label class="control-label" for="pay_name">渠道名称</label>
    <div class="controls">
      <input type="text" class="input-medium" id="pay_name" name="pay_name" placeholder="pay_name">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="fee">费率</label>
    <div class="controls">
      <input type="text" class="input-mini" id="fee" name="fee" placeholder="fee">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="rebate">折扣</label>
    <div class="controls">
      <input type="text" class="input-mini" id="rebate" name="rebate" placeholder="rebate">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="account">支付商户号</label>
    <div class="controls">
      <input type="text" size="60"id="account" name="account" placeholder="account">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="key">支付密钥</label>
    <div class="controls">
      <input type="text"size="60" id="key" name="key" placeholder="key">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="content">描述</label>
    <div class="controls">
    <textarea rows="5" name="content" id="content" placeholder="请输入充值渠道描述"></textarea>
     </div>
  </div>
   <div class="control-group">
    <label class="control-label" for="isdisplay">是否显示</label>
    <div class="controls">
    <input type="radio" name="isdisplay" id="isdisplay" value="0"> 不显示
      <input type="radio" name="isdisplay" id="isdisplay" value="1" checked> 显示
     </div>
  </div>
   <div class="control-group">
    <label class="control-label" for="status">是否启用</label>
    <div class="controls">
      <input type="radio" name="status" id="status" value="0"> 不启用
      <input type="radio" name="status" id="status" value="1" checked> 启用
      
     </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <label class="checkbox">
            <button type="submit" class="btn" id="add">添加</button>
      
       </label>
    </div>
  </div>
</form>
     </div>
   </body>
   </html>