<?php

/*
 * @Description 易宝支付非银行卡支付专业版接口范例 
 * @V3.0
 * @Author yang.xu
 */
	include 'YeePayCommon.php';	
		
	#	解析返回参数.
	$return = getCallBackValue($r0_Cmd,$r1_Code,$p1_MerId,$p2_Order,$p3_Amt,$p4_FrpId,$p5_CardNo,$p6_confirmAmount,$p7_realAmount,$p8_cardStatus,
$p9_MP,$pb_BalanceAmt,$pc_BalanceAct,$hmac);
	#	判断返回签名是否正确（True/False）
	$bRet = CheckHmac($r0_Cmd,$r1_Code,$p1_MerId,$p2_Order,$p3_Amt,$p4_FrpId,$p5_CardNo,$p6_confirmAmount,$p7_realAmount,$p8_cardStatus,
$p9_MP,$pb_BalanceAmt,$pc_BalanceAct,$hmac);
	#	以上代码和变量不需要修改.
		 	
	#	校验码正确.
	if($bRet){
		echo "success";
		#在接收到支付结果通知后，判断是否进行过业务逻辑处理，不要重复进行业务逻辑处理
		  if($r1_Code=="1"){
		      echo "<br>支付成功!";
		      echo "<br>商户订单号:".$p2_Order;
		      echo "<br>支付金额:".$p3_Amt;
		      exit; 
		  } else if($r1_Code=="2"){
		      echo "<br>支付失败!";
		      echo "<br>商户订单号:".$p2_Order;
		      exit; 
		  }
		} else{
		
	$sNewString = getCallbackHmacString($r0_Cmd,$r1_Code,$p1_MerId,$p2_Order,$p3_Amt,
	$p4_FrpId,$p5_CardNo,$p6_confirmAmount,$p7_realAmount,$p8_cardStatus,$p9_MP,$pb_BalanceAmt,$pc_BalanceAct);
			echo "<br>localhost:".$sNewString;	
			echo "<br>YeePay:".$hmac;
			echo "<br>交易签名无效!";
			exit; 
	}
  
?> 
<html>
<head>
<title>Return from YeePay Page</title>
</head>
<body>
</body>
</html>