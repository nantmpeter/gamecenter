<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <title>充值管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="__PUBLIC__/admin/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="__PUBLIC__/admin/js/jquery-1.8.0.min.js" type="text/javascript"></script>
    <script src="__PUBLIC__/admin/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="__PUBLIC__/admin/js/bootstrap-popover.js"></script>
    <script src="__PUBLIC__/js/dialog/jquery.artDialog.js?skin=default" type="text/javascript"></script>
    <script src="__PUBLIC__/js/dialog/plugins/iframeTools.js" type="text/javascript"></script>
    <script src="__PUBLIC__/js/ajaxfileupload.js" type="text/javascript"></script>
    </head>
    <script>
	 $(document).ready(function(){
    	$('.btn-primary1').click(function(){
        	var tag = $(this).parent().attr('tag');
        	window.location.href = "<?php echo U('pay/edit_pay_type');?>/tid/"+tag;

    	});
        $('.btn-danger1').click(function(){
        	var tag = $(this).parent().attr('tag');
        	var pay = $(this).parent().attr('pay');
        	var dialog = $.dialog.through;
        	var del =  $(this).parent().parent();

        	dialog({
        		title:'确认操作',
        		content:'你确定要删除'+'<font color=red>'+pay+'</font>'+'吗?',
        	    lock:true,
        	    okVal:'确认',
        	    cancelVal:'取消',
        	    ok:function(){
        	    	$.ajax({
        	    		data:{'q':tag},
        	    		url:"<?php echo U('pay/del_pay');?>",
        	    		type:'post',
        	    		dataType:'json',
        	    		cache:false,
        	    		error:function(){
        	    			$.dialog.tips('系统发生错误,请刷新重试.');
        	    		},
        	    		success:function(data){
        	    			$.dialog.tips(data.msg);
        	    			if(data.status!="0"){
        	    				return false;
        	    			}
        	    			del.hide(1000);
        	    		}
        	    	})
        	    },
        	    cancel:function(){
        	    	$.dialog.close();
        	    }
        	})
        })
    })
    </script>
    <body><div>
    
<div class="table-list">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>排序</th>
                  <th>标签</th>
                  <th>渠道名称</th>
                  <th>图标</th>
                  <th>手续费</th>
                  <th>折扣</th>
                  <th>渠道描述</th>
                  <th>添加时间</th>
                  <th>修改时间</th>
                  <th>是否显示</th>
                  <th>是否禁用</th>
                  <th>添加者</th>
                  <th class="edit2">修改</th>
                  <th class="del2">删除</th>
                </tr>
              </thead>
              <tbody>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v_list): $mod = ($i % 2 );++$i;?><tr tag="<?php echo ($v_list["tag"]); ?>" class="tag">
                  <th><?php echo ($v_list["id"]); ?></th>
                  <th><?php echo ($v_list["sort"]); ?></th>
                  <th><?php echo ($v_list["tag"]); ?></th>
                  <th><?php echo ($v_list["payname"]); ?></th>
                  <th><img src="<?php echo ($v_list["icon"]); ?>" alt="<?php echo ($v_list["payname"]); ?>" title="<?php echo ($v_list["payname"]); ?>"></th>
                  <th><?php echo ($v_list["fee"]); ?></th>
                  <th><?php echo ($v_list["rebate"]); ?></th>
                  <th><?php echo (msubstrs($v_list["content"],0,5)); ?></th>
                  <th><?php echo (date('m/d',$v_list["addtime"])); ?></th>
                  <th><?php if(empty($v_list["modifytime"])): ?>暂未修改<?php else: ?> <?php echo (date('m/d',$v_list["modifytime"])); endif; ?></th>
                  <th><?php switch($v_list["isdisplay"]): case "1": ?>显示<?php break; case "0": ?>隐藏<?php break; endswitch;?></th>
                  <th><?php switch($v_list["status"]): case "1": ?>启用<?php break; case "0": ?>禁用<?php break; endswitch;?></th>
                  <th><?php echo ($v_list["operater"]); ?></th>
                  <th class="del" tag="<?php echo ($v_list["id"]); ?>"><button type="button" class="btn-primary1">修改</button></th>
                  <th class="del" tag="<?php echo ($v_list["id"]); ?>" pay="<?php echo ($v_list["payname"]); ?>"><button type="button" class="btn-danger1">删除</button></th> 
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
              </tbody>
            </table>
      </div>
          </div>
</body>
    </html>