<?php
/**
 * @name 支付宝支付接口--即时到账
 *
 * @author 31wan team
 *
 * @version 1.0
 *
 * @access public
 */
class alipay extends Think {
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
		require $dir . '/app/Lib/Pay/alipay/alipay.config.php';
		require $dir . '/app/Lib/Pay/alipay/lib/alipay_submit.class.php';
		/**************************请求参数**************************/
		
		//支付类型
		$payment_type = "1";
		//必填，不能修改
		//服务器异步通知页面路径
		$notify_url = 'http://' . $_SERVER ['HTTP_HOST']."/pay/notify_url";
		//需http://格式的完整路径，不能加?id=123这类自定义参数
		//页面跳转同步通知页面路径
		//$return_url = "http://demo.31wan.cn/alipay/return_url.php";
		$return_url = $arr ['callurl'];
		//需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
		//卖家支付宝帐户
		$seller_email = 'smartcell@zy528.com';
		//必填
		//商户订单号
		$out_trade_no = $arr ['orderid'];
		//商户网站订单系统中唯一订单号，必填
		//订单名称
		$subject =  $arr ['pay_to_account']; 
		//必填
		//付款金额
		$total_fee = $arr ['pay_money']; 
		//$total_fee = '0.2';
		//必填
		//订单描述
		$body = $arr ['pay_to_account']; 
		//商品展示地址
		$show_url = '';//可直接进入游戏
		//需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html
		//防钓鱼时间戳
		$anti_phishing_key = "";
		//若要使用请调用类文件submit中的query_timestamp函数
		//客户端的IP地址
		$exter_invoke_ip = "";
		//非局域网的外网IP地址，如：221.0.0.1
		
		
		/************************************************************/
		
		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service" => "create_direct_pay_by_user",
				"partner" => trim($alipay_config['partner']),
				"payment_type"	=> $payment_type,
				"notify_url"	=> $notify_url,
				"return_url"	=> $return_url,
				"seller_email"	=> $seller_email,
				"out_trade_no"	=> $out_trade_no,
				"subject"	=> $subject,
				"total_fee"	=> $total_fee,
				"body"	=> $body,
				"show_url"	=> $show_url,
				"anti_phishing_key"	=> $anti_phishing_key,
				"exter_invoke_ip"	=> $exter_invoke_ip,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		);
		
		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		
		return $html_text;
	}
	
	/**
	 *
	 * @name 易宝个人版回调 (get post 通用)
	 * @access public
	 * @return string
	 */
	public function CallBack($get = array(), $pay = array()) {
	
		$dir = $_SERVER ['DOCUMENT_ROOT'];
		require $dir . '/app/Lib/Pay/alipay/alipay.config.php';
		require $dir . '/app/Lib/Pay/alipay/lib/alipay_notify.class.php';
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
	
		if($verify_result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代码
		
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
			//获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
		
			//商户订单号
		
			//$out_trade_no = $_GET['out_trade_no'];
		
			//支付宝交易号
		
			$trade_no = $_GET['trade_no'];
		
			//交易状态
			$trade_status = $_GET['trade_status'];
		
		
			if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//如果有做过处理，不执行商户的业务程序
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
				$model->where($map)->setInc('point',$pay['pay_money']);//增加积分
				$paymodel = M('pay_ok');
				$update['remark'] = "充值成功,充值到:平台币.充值金额:".$pay['pay_money']."元,获得积分:".$pay['pay_money']."分".$trade_no;
				$update['order_status'] = "2,2,2";
				$cond['orderid'] = $pay['orderid'];
				$arr['flag'] =$paymodel->where($cond)->data($update)->save();
				$arr['pay_way_num'] =$payorder['pay_way_num'];
					
				return $arr;
			
			
			}
			else {
				echo "trade_status=".$_GET['trade_status'];
			}
		
			echo "验证成功<br />";
			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
		
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
			//验证失败
			//如要调试，请看alipay_notify.php页面的verifyReturn函数
			echo "验证失败";
		}

	}
}
?>