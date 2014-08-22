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
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/admin_common.js"></script>
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/styleswitch.js"></script>

	<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/calendar/jscal2.css">
			<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/calendar/border-radius.css">
			<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/calendar/win2k.css">
			<script type="text/javascript" src="__PUBLIC__/js/calendar/calendar.js"></script>
			<script type="text/javascript" src="__PUBLIC__/js/calendar/lang/en.js"></script>
</head>
<body>
<style type="text/css">
	html{_overflow-y:scroll}
</style><div id="main_frameid" class="pad-10" style="_margin-right:-12px;_width:98.9%;">
<script type="text/javascript">
$(function(){if ($.browser.msie && parseInt($.browser.version) < 7) $('#browserVersionAlert').show();}); 
</script>
<div class="explain-col mb10" style="display:none" id="browserVersionAlert">
使用IE8浏览器可获得最佳视觉效果</div>
<form name="searchform" action="<?php echo U('Statistical/statistical_index');?>" method="post">
<table class="search-form" cellspacing="0" width="100%">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
			时间： <input name="starttime" id="starttime" value="<?php echo (date('Y-m-d',$starttime)); ?>" size="20" class="date input-text" readonly="" type="text">&nbsp;<script type="text/javascript">
			Calendar.setup({
			weekNumbers: true,
		    inputField : "starttime",
		    trigger    : "starttime",
		    dateFormat: "%Y-%m-%d",
		    showTime: false,
		    minuteStep: 1,
		    onSelect   : function() {this.hide();}
			});
        </script>  至   <input name="endtime" id="endtime" value="<?php echo (date('Y-m-d',$endtime)); ?>" size="20" class="date input-text" readonly="" type="text">&nbsp;<script type="text/javascript">
			Calendar.setup({
			weekNumbers: true,
		    inputField : "endtime",
		    trigger    : "endtime",
		    dateFormat: "%Y-%m-%d",
		    showTime: false,
		    minuteStep: 1,
		    onSelect   : function() {this.hide();}
			});
        </script>   

<input name="search" class="button" value="统计" type="submit">
	</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
<div class="col-2 lf mr10" style="width:48%">
	<h6>注册统计--(<?php echo (date('Y-m-d',$starttime)); ?>--<?php echo (date('Y-m-d',$endtime)); ?>)</h6>
	<div class="content">
	网站累计注册人数：<?php echo ($count_reg); ?><br>
	网站累计ip：<?php echo ($count_ip[0]["num"]); ?> <br>
	注册人数（渠道）：<?php echo ($count_reg_chann); ?> <br>

      <div class="bk20 hr"><hr></div>  
        <table width="50%" class="table_form">
        <tr>
     
        <th  align="left">游戏名</th>
        <th  align="left">注册人数 </th>
        
        </tr>
        
          <?php if(is_array($count_reg_gid)): $i = 0; $__LIST__ = $count_reg_gid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?><tr>
        <td  align="center"><?php echo ($v2["gamename"]); ?></td>
        <td  align="center"><?php echo ($v2["num"]); ?></td>

        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
       
        </table> 
	</div>
</div>
<div class="col-2 col-auto">
	<h6>注册统计(<?php echo (date('Y-m-d',$endtime_1)); ?>)</h6>
	<div class="content">
        <table width="100%" class="table_form">
        <tr>
     
        <th>游戏名</th>
        <th>昨日注册人数 </th>
        <th>昨日ip</th>
        <th>昨日注册人数（渠道）</th>
        </tr>
     <?php if(is_array($count_reg_gid_y)): $i = 0; $__LIST__ = $count_reg_gid_y;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?><tr>
        <td  align="center"><?php echo ($v2["gamename"]); ?></td>
        <td  align="center"><?php echo ($v2["num"]); ?></td>
        <td align="center"><?php echo ($v2["num_ip"]); ?></td>
        <td align="center"><?php echo ($v2["num_chann"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        
        
        
        </table> 
	</div>
</div>
<div class="bk10"></div>
<div class="col-2 lf mr10" style="width:48%">
	<h6>充值统计--(<?php echo (date('Y-m-d',$starttime)); ?>--<?php echo (date('Y-m-d',$endtime)); ?>)</h6>
	<div class="content" >
	
	网站累计充值人次：<?php echo ($count_pay); ?><br>
	网站累计充值金额(元)：<?php echo ($count_pay_money[0]["totalmoney"]); ?> <br>
	实际到账(元)：<?php echo ($count_pay_realmoney[0]["realmoney"]); ?> <br>
	后台充值(元)：<?php echo ($count_adminpay_money[0]["totalmoney"]); ?><br>
	渠道充值(元)：<?php echo ($count_pay_cpsmoney[0]["realmoney"]); ?> <br>
	
	<div class="bk20 hr"><hr></div>  
        <table width="50%" class="table_form">
        <tr>
     
        <th  align="left">游戏名</th>
        <th  align="left">充值金额（元） </th>
        
        </tr>
          <?php if(is_array($count_pay_gamemoney)): $i = 0; $__LIST__ = $count_pay_gamemoney;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?><tr>
        <td  align="center"><?php echo ($v2["gamename"]); ?></td>
        <td  align="center"><?php echo ($v2["gamemoney"]); ?></td>

        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table> 
<div class="bk20 hr"><hr></div>  
        <table width="50%" class="table_form">
        <tr>
     
        <th  align="left">充值方式</th>
        <th  align="left">充值金额（元） </th>
        
        </tr>
        <?php if(is_array($count_pay_typemoney)): $i = 0; $__LIST__ = $count_pay_typemoney;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?><tr>
        <td  align="center"><?php echo ($v2["payname"]); ?></td>
        <td  align="center"><?php echo ($v2["typemoney"]); ?></td>

        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table> 
	</div>
</div>
<div class="col-2 col-auto">
	<h6>充值统计(<?php echo (date('Y-m-d',$endtime_1)); ?>)</h6>
	<div class="content">
	<table width="100%" class="table_form">
        <tr>
     
        <th  align="left">正常（元）</th>
        <th  align="left">渠道（元） </th>
        <th  align="left">总充值金额</th>
        <th align="left">后台充值金额（元）</th>
        
        </tr>
        <tr>
        <td  align="center"><?php echo ($n_paymoney); ?></td>
        <td  align="center"><?php echo ($count_pay_cpstotalmoney[0]["realmoney"]); ?></td>
        <td align="center"><?php echo ($count_pay_totalmoney[0]["totalmoney"]); ?></td>
        <td align="center"><?php echo ($count_adminpay_money_y[0]["totalmoney"]); ?></td>
        </tr>
        </table> 
      <div class="bk20 hr"><hr></div>  
        <table width="50%" class="table_form">
        <tr>
     
        <th  align="left">充值方式</th>
        <th  align="left">充值金额（元） </th>
        
        </tr>
        <?php if(is_array($count_pay_typemoney_y)): $i = 0; $__LIST__ = $count_pay_typemoney_y;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?><tr>
        <td  align="center"><?php echo ($v2["payname"]); ?></td>
        <td  align="center"><?php echo ($v2["typemoney"]); ?></td>

        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table> 
        
	</div>
</div>

</div>
<script type="text/javascript">$("#main_frameid").removeClass("display");</script><div id="phpcms_notice"></div><script type="text/javascript" src=""></script></body></html>