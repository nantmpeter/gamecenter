<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>31wan - 后台管理中心</title>
<link href="__PUBLIC__/admin/css/reset.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/admin/css/zh-cn-system.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/admin/css/table_form.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/style/zh-cn-styles1.css" title="styles1" media="screen">
<link rel="alternate stylesheet" type="text/css" href="__PUBLIC__/admin/css/style/zh-cn-styles2.css" title="styles2" media="screen">
<link rel="alternate stylesheet" type="text/css" href="__PUBLIC__/admin/css/style/zh-cn-styles3.css" title="styles3" media="screen">
<link rel="alternate stylesheet" type="text/css" href="__PUBLIC__/admin/css/style/zh-cn-styles4.css" title="styles4" media="screen">
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/jquery-1.8.0.min.js"></script>
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/admin_common.js"></script>
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/styleswitch.js"></script>
</head>
<body>
<div class="subnav">
    <div class="content-menu ib-a blue line-x">
    </div>
<style type="text/css">
	html{_overflow-y:scroll}
</style><div class="pad-lr-10">
<form name="searchform" action="<?php echo U('Pay/order');?>" method="post">
<table class="search-form" cellspacing="0" width="100%">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
			订单号：  <input type="text" id="order" name="orderid" value="<?php echo ($orderid); ?>" placeholder="请输入订单号">
			充值账户： <input type="text" id="username" name="username" value="<?php echo ($username); ?>" placeholder="请输入用户名">
所属游戏： <select class="game input-small" name="game">
<option value=''>--全部游戏--</option>
	  	  <?php $_result=D('game')->select(); if ($_result): $i=0;foreach($_result as $key=>$game):++$i;$mod = ($i % 2 );?><option value="<?php echo ($game["gid"]); ?>" <?php if($game['gid']==$game_info){echo 'selected';} ?>><?php echo ($game["gamename"]); ?></option><?php endforeach; endif;?>
		</select>
&nbsp;&nbsp;&nbsp;<input name="search" class="button" value="搜索" type="submit">
	</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
<form name="myform" action="__URL__/pay_order_del" method="post">
<div class="table-list">
<table cellspacing="0" width="100%">
	<thead>
		<tr>
			<th align="left" width="20"><input value="" id="check_box" onclick="selectall('id[]');" type="checkbox"></th>
			<th align="left"></th>
			<th align="left">序号</th>
			<th align="left">订单号</th>
			<th align="left">游戏/服务器</th>
			<th align="left">充值账户</th>
			<th align="left">充值方式</th>
			<th align="left">金额</th>
			<th align="left">充值时间</th>
			
			<th align="left">订单状态</th>
			<th align="left">游戏充值状态</th>
			<th align="center">操作</th>
		</tr>
	</thead>
<tbody>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vlist): $mod = ($i % 2 );++$i;?><tr>
		<td align="left"><input value="<?php echo ($vlist["id"]); ?>" name="id[]" type="checkbox"></td>
		<td align="left"></td>
		<td align="left"><?php echo ($vlist["id"]); ?></td>
		<td align="left"><?php echo ($vlist["orderid"]); ?></td>
		<td align="left"><?php echo ($vlist["gamename"]); ?>[<?php echo ($vlist["servername"]); ?>]</td>
		<td align="left"><?php echo ($vlist["pay_to_account"]); ?></td>
		<td align="left"><?php echo ($vlist["payname"]); ?>
</td>	
		<td align="left"><?php echo ($vlist["pay_money"]); ?></td>
		<td align="left"><?php echo (date('m/d H:i:s',$vlist["pay_time"])); ?></td>
	
	<td> <?php switch($vlist["order_status"]): case "0,0,0": ?>下单未付款<?php break;?>
                  <?php case "1,1,1": ?>掉单<?php break;?>
                  <?php case "2,2,2": ?><font color='green'>充值成功</font><?php break; endswitch;?></td>
      <td align="left"> <?php switch($vlist["game_status"]): case "0": ?>未充值<?php break;?>
                  <?php case "1": ?><font color='green'>充值成功</font><?php break; endswitch;?></td>
		<td align="center">
			<a href="__URL__/order_info/id/<?php echo ($vlist["id"]); ?>">查看</a> | 
			<?php switch($vlist["game_status"]): case "0": ?><a href="__URL__/game_budan/id/<?php echo ($vlist["id"]); ?>">补单</a><?php break;?>
             <?php case "1": ?><font color="#cccccc">补单</font><?php break; endswitch;?>
		</td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</tbody>
</table>
    <div class="btn"><label for="check_box">全选/取消</label>
		<input class="button" value="删除"    type="submit">

			</div>

<div align="right"><?php echo ($page); ?></div>
</div>
</form>
<script type="text/javascript"> 


</script>
</div>
</body></html>