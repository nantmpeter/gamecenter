<?php
/**
 * @name 易宝支付接口企业版本
 *
 * @author 31wan team
 *
 * @version 1.0
 *
 * @access public
 */
class netease extends Think {
	public function __construct() {
	}
	/**
	 *
	 * @name 开始支付
	 * @param array $arr        	
	 * @return string
	 */
	public function BeginPay($arr) {
		$dir = $_SERVER ['DOCUMENT_ROOT'];
		require $dir . '/app/lib/pay/yeepay/yeepayCommon.php';
		/*
		 * #	商家设置用户购买商品的支付信息. ##易宝支付平台统一使用GBK/GB2312编码方式,参数如用到中文，请注意转码
		 * #	商户订单号,选填. ##若不为""，提交的订单号必须在自身账户交易中唯一;为""时，易宝支付会自动生成随机的商户订单号.
		 * $p2_Order					= $_REQUEST['p2_Order']; #	支付金额,必填. ##单位:元，精确到分.
		 * $p3_Amt						= $_REQUEST['p3_Amt']; #	交易币种,固定值"CNY". 
		 * $p4_Cur						="CNY"; #	商品名称 ##用于支付时显示在易宝支付网关左侧的订单产品信息.
		 *  $p5_Pid						= $_REQUEST['p5_Pid']; #	商品种类 
		 *  $p6_Pcat					= $_REQUEST['p6_Pcat'];
		 * #	商品描述 $p7_Pdesc					= $_REQUEST['p7_Pdesc'];
		 * #	商户接收支付成功数据的地址,支付成功后易宝支付会向该地址发送两次成功通知. 
		 * $p8_Url						= $_REQUEST['p8_Url']; #	商户扩展信息 ##商户可以任意填写1K 的字符串,支付成功时将原样返回.
		 * $pa_MP						= $_REQUEST['pa_MP']; #	支付通道编码
		 * ##默认为""，到易宝支付网关.若不需显示易宝支付的页面，直接跳转到各银行、神州行支付、骏网一卡通等支付页面，该字段可依照附录:银行列表设置参数值.
		 * $pd_FrpId					= $_REQUEST['pd_FrpId']; #	应答机制 ##默认为"1": 需要应答机制;
		 * $pr_NeedResponse	= "1"; #调用签名函数生成签名串 $hmac =
		 * getReqHmacString($p2_Order,$p3_Amt,$p4_Cur,$p5_Pid,$p6_Pcat,$p7_Pdesc,$p8_Url,$pa_MP,$pd_FrpId,$pr_NeedResponse);
		 */
		// ########获取信息#######
		$pay_type = M('pay_type');
		$info = $pay_type->where("tag='".$arr['pay_tag']."'")->find();
		$data ['p0_Cmd'] = "Buy"; 
		$data ['p1_MerId'] =$info['account'];		
		$data ['p2_Order'] = $arr ['orderid'];
		$data ['p3_Amt'] =$arr ['pay_money']; 
		//$data ['p3_Amt'] ='0.1';
		$data ['p4_Cur'] = "CNY"; 
		$data ['p5_Pid'] = $arr ['pay_to_account'];
		$data ['p6_Pcat'] = $arr ['pay_to_account']; 
		$data ['p7_Pdesc'] = $arr ['pay_to_account'];  
		$data ['p8_Url'] = $arr ['callurl']; 
		$data ['pa_MP'] = $arr ['pay_to_account']; 
		$data ['pd_FrpId'] = 'NETEASE-NET'; //ka
		$data ['pr_NeedResponse'] = "1";
		$data ['p9_SAF'] = "0";
		$hmac = getReqHmacString($data ['p2_Order'],$data ['p3_Amt'],$data ['p4_Cur'],$data ['p5_Pid'],$data ['p6_Pcat'],$data ['p7_Pdesc'],$data ['p8_Url'],$data ['pa_MP'],$data ['pd_FrpId'],$data ['pr_NeedResponse']);
		$data ['hmac'] = $hmac;
		return $data;
	}
	
	/**
	 *
	 * @name 易宝企业版回调 (get post 通用)
	 * @access public
	 * @return string
	 */
	public function CallBack($get = array(), $pay = array()) {
		$dir = $_SERVER ['DOCUMENT_ROOT'];
		require $dir . '/app/lib/pay/yeepay/YeePayCommon.php';
		

		#	只有支付成功时易宝支付才会通知商户.
		##支付成功回调有两次，都会通知到在线支付请求参数中的p8_Url上：浏览器重定向;服务器点对点通讯.
		
		#	解析返回参数.
		$return = getCallBackValue($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
		
		#	判断返回签名是否正确（True/False）
		$bRet = CheckHmac($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
		#	以上代码和变量不需要修改.
		 
		#	校验码正确.
		if($bRet){
		if($r1_Code=="1"){
		
		#	需要比较返回的金额与商家数据库中订单的金额是否相等，只有相等的情况下才认为是交易成功.
		#	并且需要对返回的处理进行事务控制，进行记录的排它性处理，在接收到支付结果通知后，判断是否进行过业务逻辑处理，不要重复进行业务逻辑处理，防止对同一条交易重复发货的情况发生.
		
		if($r9_BType=="1"){
			//冲入游戏 or plf
			$model = M('pay_ok');
			$payorder = $model->where("orderid='{$get['orderid']}'")->find();
			//主要是更新订单状态和充值到用户账户
			$map['username'] = $pay['pay_to_account'];
			$model = M('member');
			//查询出费率
			$pay_type = M('pay_type');
			$pay_fee=$pay_type->where("tag ='".$payorder['pay_tag']."'")->find();
			if($pay_fee['fee'] !=''){
				$pay['pay_money'] = $pay['pay_money']*$pay_fee['fee']/100;
			}else{
				$pay['pay_money'] =$pay['pay_money'];
			}
			$model->where($map)->setInc('money',$pay['pay_money']);//冲入金钱
			$model->where($map)->setInc('point',$pay['pay_money'])*10;//增加积分
			$paymodel = M('pay_ok');
			$update['remark'] = "充值成功,充值到:平台币.充值金额:".$pay['pay_money']."元,获得积分:".$pay['pay_money']."分";
			$update['order_status'] = "2,2,2";
			$cond['orderid'] = $pay['orderid'];
			$arr['flag'] =$paymodel->where($cond)->data($update)->save();
			$arr['pay_way_num'] =$payorder['pay_way_num'];
			
			return $arr;
		//echo "交易成功";
				//echo  "<br />在线支付页面返回";
		}elseif($r9_BType=="2"){
		#如果需要应答机制则必须回写流,以success开头,大小写不敏感.
			echo "success";
			//冲入游戏 or plf
			$model = M('pay_ok');
			$payorder = $model->where("orderid='{$get['orderid']}'")->find();
			//主要是更新订单状态和充值到用户账户
			$map['username'] = $pay['pay_to_account'];
			$model = M('member');
			//查询出费率
			$pay_type = M('pay_type');
			$pay_fee=$pay_type->where("tag ='".$payorder['pay_tag']."'")->find();
			if($pay_fee['fee'] !=''){
				$pay['pay_money'] = $pay['pay_money']*$pay_fee['fee']/100;
			}else{
				$pay['pay_money'] =$pay['pay_money'];
			}
			$model->where($map)->setInc('money',$pay['pay_money']);//冲入金钱
			$model->where($map)->setInc('point',$pay['pay_money'])*10;//增加积分
			$paymodel = M('pay_ok');
			$update['remark'] = "充值成功,充值到:平台币.充值金额:".$pay['pay_money']."元,获得积分:".$pay['pay_money']."分";
			$update['order_status'] = "2,2,2";
			$cond['orderid'] = $pay['orderid'];
			$arr['flag'] =$paymodel->where($cond)->data($update)->save();
			$arr['pay_way_num'] =$payorder['pay_way_num'];
		
			return $arr;
			//echo "<br />交易成功";
			//echo  "<br />在线支付服务器返回";
		}
	}
		
}else{
	echo "交易信息被篡改";
		}

	}
}
?>