<?php
/**
    * @name 充值系统控制器
    * 
    * @author lostman $
    * 
    * @access public 
    */
class PayAction extends CommonAction {
	/**
	 *
	 * @name 订单生成
	 * @return string
	 */
	public function create_order() {
		import ( "@.ORG.String" );
		Load ( 'extend' );
		$arr ['orderid'] = date ( 'Ymd' ) . String::rand_string ( 1, 5 ) . date ( 'His' ) . String::rand_string ( 1, 5 );
		echo $arr ['orderid'];
	}
	/**
	 *
	 * @name 充值角色是否在所充值的服务器
	 * @return json
	 */
	public function user_in_server_check() {
	}
	/**
	 *
	 * @name 支付开始
	 */
	public function begin_pay() {
		$user = trim ( $_POST ['user_id'] ); // 用户名
		$user2 = trim ( $_POST ['user_id2'] );
		$order_id = trim ( $_POST ['order_id'] );
		$game_id = ( int ) (trim ( $_POST ['game_id'] ));
		$server_id = ( int ) (trim ( $_POST ['server_id'] ));
		$pay_money = ( int ) (trim ( $_POST ['pay_money'] )); // 充值的钱
		$pay_where = trim ( $_POST ['pay_where'] ); // 充值到哪
		$arr ['pay_way_num'] = $pay_where;
		if (trim ( $_POST ['pay_card_no'] ) != "") {
			$pay_card_no = trim ( $_POST ['pay_card_no'] );
			$arr ['pay_card_no'] = $pay_card_no;
		}
		if (trim ( $_POST ['pay_card_pwd'] ) != "") {
			$pay_card_pwd = trim ( $_POST ['pay_card_pwd'] );
			$arr ['pay_card_pwd'] = $pay_card_pwd;
		}
		$paytag = trim ( $_POST ['pay_tag'] );
	
	
		if ($paytag == 'yeepay') {
			if (trim ( $_POST ['pay_bank'] ) != "") {
				$pay_bank = trim ( $_POST ['pay_bank'] );
			}
		}
		if ($user != $user2 || $order_id == "" || $game_id == "" || strlen ( $user ) < 4 || $user == "" || $server_id == "" || $pay_money == "" || $pay_where = "") {
			$this->error ( '请完善您的订单信息再进行提交' );
		} else {
			$ucresult = uc_user_checkname ( $user );
			if ($ucresult != - 3) {
				$this->error ( '你的输入有误,此用户名不存在' );
			}
			$userinfo = uc_get_user ( $user );
			$arr ['uid'] = $userinfo ['0'];
			$arr ['pay_to_account'] = $user;
			$map ['orderid'] = $order_id;
			$model = M ( 'pay_ok' );
			$ordercheck = $model->where ( $map )->select ();
			if ($ordercheck) {
				$this->error ( '对不起,订单号已经被使用.请你重新生成订单并充值.' );
			}
			$arr ['orderid'] = $order_id;
			if ($paytag == "") {
				$this->error ( '系统发生错误,查找不到您所选择的充值方式.请联系客服处理.' );
			}
			$tag ['tag'] = $paytag;
			$tagmodel = M ( 'pay_type' );
			$tagcheck = $tagmodel->where ( $tag )->find ();
			
			if (! $tagcheck) {
				$this->error ( '系统发生错误,您选择的充值方式不存在,请联系客服处理.' );
			}
			$arr ['pay_tag'] = $tagcheck ['tag'];
			$arr ['pay_port'] = $tagcheck ['payname'];
			
			$game = M ( 'game' );
			$maps ['gid'] = $game_id;
			$maps ['isdisplay'] = "0";
			$gamecheck = $game->where ( $maps )->find ();
			if ($gamecheck == "") {
				$this->error ( '对不起,你充值的游戏不存在,请联系客服处理.' );
			} else {
				$serverinfo ['gid'] = $game_id;
				$serverinfo ['sid'] = $server_id;
				$servermodel = M ( 'server' );
				$sinfo = $servermodel->where ( $serverinfo )->find ();
				if ($sinfo == "" || $sinfo ['is_display'] == "1") {
					$this->error ( '对不起,您充值的服务器不存在或者已经停服.' );
				} else if ($sinfo ['start_time'] > time ()) {
					$this->error ( '对不起,您充值的服务器开放时间为:' . date ( 'Y年m月d日 H:i' ) . '，请您届时再开始充值 ^ ^.' );
				}
			}
			$arr ['gid'] = $game_id;
			$arr ['sid'] = $server_id;
			if ($pay_bank != "") {
				$arr ['pay_bank'] = $pay_bank;
			} else {
				$arr ['pay_bank'] = " ";
			}
			$arr ['pay_money'] = $pay_money;
			$arr ['get_coin'] = $pay_money * $gamecheck ['payto'];
			$arr ['pay_ip'] = get_client_ip ();
			$arr ['pay_time'] = time ();
			$arr ['order_status'] = "0,0,0";
			$arr ['remark'] = "下单未付款";
			// ########插入数据库############
			$pay_log = M ( "pay_ok" );
			$paylogwrite = $pay_log->add ( $arr );
			if (! $paylogwrite) {
				$this->error ( '充值日志写入失败.请联系客服解决' );
			}
			$import = import ( "@.Pay." . strtolower ($arr['pay_tag']) . "" );
			if (! $import) {
				$this->assign ( 'jumpUrl', '/' );
				$this->error ( "充值渠道接口加载失败！请联系客服解决." );
			}
			$Public = A ( "Public" );
			$Public->wirte_log_pay ( array (
					'data' => $arr,
					'file' => 'pay_log',
					'split' => ' ' 
			) );
			$arr ['callurl'] = 'http://' . $_SERVER ['HTTP_HOST'] . U ( 'pay/callback', array (
					'paytag' => strtolower ( $arr ['pay_tag'] ) 
			) );

			$Public->read_conf ();
			$config = F ( 'basic' );

			$beginpay = new $arr['pay_tag']();
		
			if (! method_exists ( $beginpay, 'BeginPay' )) {
				$this->assign ( 'jumpUrl', '/' );
				$this->error ( "游戏充值渠道操作方法不存在！请联系客服解决." );
			}
			// 模板赋值
			
			$data = $beginpay->BeginPay ( $arr );
		
			$this->assign ( 'data', $data );
			
			// 若是个人版易宝则不需要用form提交,企业（易宝）及网银在线需要页面跳转
			if ($arr ['pay_tag'] == 'junnet'||$arr ['pay_tag'] == 'yeepay'||$arr ['pay_tag'] == 'alipay'||$arr ['pay_tag'] == 'unicom') {

				$this->display ( TMPL_PATH . $config ['THEME'] . '/pay/' . $arr ['pay_tag'] . '.html' );
			} else {
				/*
				 * #非银行卡支付专业版测试时调用的方法，在测试环境下调试通过后，请调用正式方法annulCard
				 * #两个方法所需参数一样，所以只需要将方法名改为annulCard即可 #测试通过，正式上线时请调用该方法
				 */
				// annulCard($p2_Order,$p3_Amt,$p4_verifyAmt,$p5_Pid,$p6_Pcat,$p7_Pdesc,$p8_Url,$pa_MP,$pa7_cardAmt,$pa8_cardNo,$pa9_cardPwd,$pd_FrpId,$pz_userId,$pz1_userRegTime);
				$dir = $_SERVER ['DOCUMENT_ROOT'];
				require $dir . '/app/lib/pay/yeepaycard/YeePayCommon.php';
				annulCard ( $data ['p2_Order'], $data ['p3_Amt'], $data ['p4_verifyAmt'], $data ['p5_Pid'], $data ['p6_Pcat'], $data ['p7_Pdesc'], $data ['p8_Url'], $data ['pa_MP'], $data ['pa7_cardAmt'], $data ['pa8_cardNo'], $data ['pa9_cardPwd'], $data ['pd_FrpId'], $data ['pz_userId'], $data ['pz1_userRegTime'] );
			}
		}
	}
	/**
	 *
	 * @name 充值json
	 */
	public function cash_change_currency() {
		$game = trim ( $_GET ['game'] );
		$server = trim ( $_GET ['server'] );
		$cash = trim ( $_GET ['cash'] );
		if ($game != "" || $server != "" || $cash != "") {
			$map ['gid'] = ( int ) ($game);
			$game_conds = ( int ) ($game);
			$map ['sid'] = ( int ) ($server); // 强制类型转换
			$icash = ( int ) ($cash);
			$model = M ( 'game' );
			$gameinfo = $model->where ( "gid = '$game_conds'" )->find ();
			if ($gameinfo ['isdisplay'] != "0") {
				$arr ['state'] = '5';
				$arr ['msg'] = '系统发生错误,你充值的游戏不存在!';
				die ( json_encode ( $arr ) );
			}
			$sermodel = M ( 'server' );
			$serverinfo = $sermodel->where ( $map )->find ();
			if ($serverinfo == "") {
				$arr ['state'] = '2';
				$arr ['msg'] = '系统发生错误,你提交的查询有误!';
				die ( json_encode ( $arr ) );
			}
			if ($serverinfo ['is_display'] != "0") {
				$arr ['state'] = '3';
				$arr ['msg'] = '系统发生错误,你充值的服务器已经关服!';
				die ( json_encode ( $arr ) );
			}
			if ($serverinfo ['start_time'] > time ()) {
				$arr ['state'] = '4';
				$arr ['msg'] = '系统发生错误,你充值的服务器还未到开放时间!';
				die ( json_encode ( $arr ) );
			}
			
			$return ['state'] = "1";
			$return ['cash'] = $icash * $gameinfo ['payto'];
			$return ['currency'] = $gameinfo ['currency'];
			die ( json_encode ( $return ) );
		}
	}
	/**
	 *
	 * @name 充值用户名检测
	 *      
	 * @return json
	 */
	public function u_check() {
		$user = trim ( $_GET ['user'] );
		if ($user != "" || strlen ( $user ) > 4) {
			$ucresult = uc_user_checkname ( $user );
			if ($ucresult == - 3) {
				$arr ['msg'] = "恭喜你,用户名存在";
				die ( json_encode ( $arr ) );
			} else {
				$arr ['msg'] = "用户名不存在！请检查你的输入！";
				die ( json_encode ( $arr ) );
			}
		} else {
			$arr ['msg'] = "用户名不存在！请检查你的输入！";
			die ( json_encode ( $arr ) );
		}
	}
	public function index() {
		if (trim ( $_GET ['user'] ) != "" || trim ( $_GET ['server'] ) != "" || trim ( $_GET ['game'] ) != "") {
			$user = trim ( $_GET ['user'] );
			$pay_game = trim ( $_GET ['game'] );
			$pay_server = trim ( $_GET ['server'] );
			$ucresult = uc_user_checkname ( $user );
			if ($ucresult == - 3) {
				$arr ['pay_user'] = $user; // 充值用户
			}
			// ####### 检测传入游戏是否正确#########
			$model = M ( 'game' );
			$regame = $model->where ( "gid = '$pay_game'" )->find ();
			if ($regame != "") {
				$arr ['pay_game'] = $regame ['gamename'];
				$arr ['pay_game_id'] = $pay_game; // 充值游戏ID
			}
			$gameview = M ( 'server' );
			$cond ['gid'] = $pay_game;
			$cond ['sid'] = $pay_server;
			$reserver = $gameview->where ( $cond )->find ();
			if ($reserver != "") {
				$arr ['pay_server'] = $reserver ['servername']; // 充值服务器
				$arr ['pay_server_id'] = $reserver ['sid'];
			}
			$this->assign ( 'userinfo', $arr );
		}
		$public = A ( 'Public' );
		$public->read_conf ();
		$config = F ( 'basic' );
		$public->head ();
		// #获取所有游戏列表###
		$model = M ( 'game' );
		$map ['isdisplay'] = "0";
		$games = $model->where ( $map )->order ( "game_hit desc" )->getField ( 'gid,smallpic,gamename' );
		$this->assign ( 'games', $games );
		if ($this->userinfo ['username'] != "") {
			$arr ['pay_user'] = $this->userinfo ['username'];
			$this->assign ( 'userinfo', $arr );
		}
		$this->display ( TMPL_PATH . $config ['THEME'] . '/pay.html' );
		$public->footer ();
	}
	/**
	 *
	 * @name 根据游戏ID查询服务器
	 * @return string
	 */
	public function get_server() {
		header ( 'Content-type:text/html; charset=utf-8' );
		if ($_GET ['gid'] != "") {
			$gid = trim ( $_GET ['gid'] );
			$model = M ( 'server' );
			$map ['gid'] = $gid;
			$map ['is_display'] = "0";
			$server_list = $model->where ( $map )->order ( 'sid desc' )->select ();
			foreach ( $server_list as $m ) {
				print ("<li class='servers'><a onclick='javascript:get_sid(this)' name='" . $m ['servername'] . '(' . $m ['line'] . ")' server='" . $m ['sid'] . "'>" . $m ['servername'] . "(" . $m ['line'] . ")" . "</a></li>") ;
			}
		}
		
		if ($_GET ['sgid'] != "") {
			
			$gid = trim ( $_GET ['sgid'] );
			$model = M ( 'server' );
			$map ['gid'] = $gid;
			$map ['is_display'] = "1";
			$server_list = $model->where ( $map )->order ( 'sid desc' )->select ();
			foreach ( $server_list as $m ) {
				print ("<option value='" . $m ['sid'] . "'>" . $m ['servername'] . "</option>") ;
			}
		}
	}
	public function callback() {
		
		$get = $_REQUEST;
		
		$payway = $get ['paytag'];
		switch ($get ['paytag']) {
			case 'alipay' :
				$get ['orderid'] = $get ['out_trade_no'];
				$get ['success_time'] = strtotime ( $get ['notify_time'] );
				$get ['v_amount'] = $get ['total_fee']; // 实际金额
				break;
			case 'yeepay' : // yibao
				$get ['orderid'] = $get ['r6_Order'];
				$get ['success_time'] = time ();
				$get ['v_amount'] = $get ['r3_Amt']; // 实际金额
				break;
			case 'junnet' : // 骏网
				$get ['orderid'] = $get ['r6_Order'];
				$get ['success_time'] = time ();
				$get ['v_amount'] = $get ['r3_Amt']; // 实际金额
				break;
			case 'telecom' : // 电信卡
				$get ['orderid'] = $get ['p2_Order'];
				$get ['success_time'] = time ();
				$get ['v_amount'] = $get ['p7_realAmount']; // 实际金额
				break;
			case 'netease' : // 网易卡
				$get ['orderid'] = $get ['p2_Order'];
				$get ['success_time'] = time ();
				$get ['v_amount'] = $get ['p7_realAmount']; // 实际金额
				break;
			case 'unicom' : // 联通卡
			$get ['orderid'] = $get ['r6_Order'];
				$get ['success_time'] = time ();
				$get ['v_amount'] = $get ['r3_Amt']; // 实际金额
				break;
			case 'qqcard' : // Q币
				$get ['orderid'] = $get ['p2_Order'];
				$get ['success_time'] =time ();
				$get ['v_amount'] = $get ['p7_realAmount']; // 实际金额
				break;
			case 'sndacard' : // 盛大卡
				$get ['orderid'] = $get ['p2_Order'];
				$get ['success_time'] = time ();
				$get ['v_amount'] = $get ['p7_realAmount']; // 实际金额
				break;
			case 'chinabank' : // 网银在线 *_*
				$get ['orderid'] = $get ['v_oid']; // 订单
				$get ['success_time'] = time ();
				$get ['v_amount'] = $get ['v_amount']; // 实际金额
				break;
			case 'phone' : // 支付宝话费卡充值
					$get ['orderid'] = $get ['out_trade_no']; // 订单
					$get ['success_time'] = time ();
					$get ['v_amount'] = $get ['total_fee']; // 实际金额
					break;
		}
	
		$public = A ( 'Public' );
		$model = M ( 'pay_ok' );
		// 判断是否存在
		$payorder = $model->where ( "orderid='{$get['orderid']}'" )->find ();
		
		if (! $payorder) {
			$public->wirte_log_pay ( array (
					'data' => $get,
					'file' => 'pay_error_' . $payway,
					'split' => ' ' 
			) );
			$this->error ( '充值失败!订单号不存在!!!' );
		}
		// 判断是否已经更新状态
		if ($payorder ['order_status'] == "2,2,2") {
			$this->pay_ok ( $get ['orderid'] );
			die ();
		}
		
		$map ['order_status'] = "1,1,1"; // 1,1,1
		$map ['success_time'] = time ();
		$map ['remark'] = "充值网关回调成功.准备冲入游戏或平台币";
		
		$tagmodel = M ( 'pay_type' );
		$tag ['tag'] = strtolower ( $payorder ['pay_tag'] );
		$tagcheck = $tagmodel->where ( $tag )->find ();
		$map ['pay_money'] = $get ['v_amount'];
		$map ['pay_really_money'] = $get ['v_amount'] * ($tagcheck ['fee'] / 100);
		

		$update = $model->where("orderid='{$get['orderid']}'" )->save($map);
		
		if (! $update) {
			$this->error ( '系统发生错误,更新订单状态失败.请联系客服解决. *_*' );
		}
		
		$import = import ( "@.Pay." . $payway . "" );
		if (! $import) {
			$this->error ( '加载充值回调接口失败,此订单可能已经调单.请联系客服处理' );
		}
		$pay = new $payway ();
		if (! method_exists ( $pay, "CallBack" )) {
			$this->error ( '没有回调函数,此订单已经调单.请联系客服处理' );
		}
		$data = $pay->CallBack ( $get, $payorder );
	
		if ($data ['flag'] == '1') {
			// 若是充值到平台则不操作 若是充值到游戏则需要充值到游戏
			if ($data ['pay_way_num'] == '0') {
				$game = M ( 'game' );
				$result = $game->where ( "gid=" . $payorder ['gid'] )->find ();
				$import = import ( "@.Game." . $result ['tag'] . "" );
				if (! $import) {
					$this->error ( '游戏充值接口加载失败,请联系客服处理' );
				}
				$gamepay = new $result ['tag'] ();
				if (! method_exists ( $gamepay, "pay" )) {
					$this->error ( '游戏充值 方法不存在,请联系客服处理' );
				}
				$str = $gamepay->pay ( $get ['orderid'] );
				
				if ($str ['flag'] == '1') {
					$this->pay_ok ( $get ['orderid'] );
				} else {
					
					$this->error ( $str ['mgs'] );
				}
			} else {
				$this->pay_ok ( $get ['orderid'] );
			}
		} else {
			$this->error ( '已充值成功，请不要重复充值！', '/' );
		}
	}
	public function notify_url() {

$dir = $_SERVER ['DOCUMENT_ROOT'];
require $dir . '/app/lib/pay/alipay/alipay.config.php';
require $dir . '/app/lib/pay/alipay/lib/alipay_notify.class.php';

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();
if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
	//商户订单号
	$out_trade_no = $_POST['out_trade_no'];
	//支付宝交易号
	$trade_no = $_POST['trade_no'];
	//交易状态
	$trade_status = $_POST['trade_status'];

	$model = M ( 'pay_ok' );
	// 判断是否存在
	$payorder = $model->where ( "orderid='{$out_trade_no}'" )->find ();
    if($_POST['trade_status'] == 'TRADE_FINISHED') {
    	

    	// 判断是否已经更新状态
    	if ($payorder ['order_status'] == "2,2,2") {
    		$this->pay_ok ( $out_trade_no );
    		die ();
    	}else{
    		
    		$map1 ['success_time'] = time ();
    		$tagmodel = M ( 'pay_type' );
    		$tag ['tag'] = strtolower ( $payorder ['pay_tag'] );
    		$tagcheck = $tagmodel->where ( $tag )->find ();
    		$map1 ['pay_really_money'] =  $payorder ['pay_money'] * ($tagcheck ['fee'] / 100);
    	    $model->where("orderid='{$out_trade_no}'" )->save($map1);
    		
    		//冲入游戏 or plf
    		//主要是更新订单状态和充值到用户账户
    		$map['username'] = $payorder['pay_to_account'];
    		$member = M('member');
    		//查询出费率
    		$pay_type = M('pay_type');
    		$pay_fee=$pay_type->where("tag ='".$payorder['pay_tag']."'")->find();
    		if($pay_fee['fee'] !=''){
    			$pay['pay_money'] = $payorder['pay_money']*$pay_fee['fee']/100;
    		}else{
    			$pay['pay_money'] =$payorder['pay_money'];
    		}
    		$member->where($map)->setInc('money',$pay['pay_money']);//冲入金钱
    		$member->where($map)->setInc('point',$pay['pay_money'])*10;//增加积分
    		$paymodel = M('pay_ok');
    		$update['remark'] = "充值成功,充值到:平台币.充值金额:".$pay['pay_money']."元,获得积分:".$pay['pay_money']."分".$trade_no;
    		$update['order_status'] = "2,2,2";
    		$cond['orderid'] =$out_trade_no;
    		$paymodel->where($cond)->data($update)->save();
    		
    	//充值到游戏
    		$game = M ( 'game' );
    		$result = $game->where ( "gid=" . $payorder ['gid'] )->find ();
    		$import = import ( "@.Game." . $result ['tag'] . "" );
    		if (! $import) {
    			$this->error ( '游戏充值接口加载失败,请联系客服处理' );
    		}
    		$gamepay = new $result ['tag'] ();
    		if (! method_exists ( $gamepay, "pay" )) {
    			$this->error ( '游戏充值 方法不存在,请联系客服处理' );
    		}
    		$str = $gamepay->pay ( $out_trade_no );
    		
    		if ($str ['flag'] == '1') {
    			$this->pay_ok ($out_trade_no);
    		} else {
    				
    			$this->error ( $str ['mgs'] );
    		}
    		
    		
    		
    		
    		
    	}
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
				
		//注意：
		//该种交易状态只在两种情况下出现
		//1、开通了普通即时到账，买家付款成功后。
		//2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
    else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
				
		//注意：
		//该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    	// 判断是否已经更新状态
    	if ($payorder ['order_status'] == "2,2,2") {
    		$this->pay_ok ( $out_trade_no );
    		die ();
    	}else{
    		$map1 ['success_time'] = time ();
    		$tagmodel = M ( 'pay_type' );
    		$tag ['tag'] = strtolower ( $payorder ['pay_tag'] );
    		$tagcheck = $tagmodel->where ( $tag )->find ();
    		$map1 ['pay_really_money'] =  $payorder ['pay_money'] * ($tagcheck ['fee'] / 100);
    		$model->where("orderid='{$out_trade_no}'" )->save($map1);
    		
    		//冲入游戏 or plf
    		//主要是更新订单状态和充值到用户账户
    		$map['username'] = $payorder['pay_to_account'];
    		$member = M('member');
    		//查询出费率
    		$pay_type = M('pay_type');
    		$pay_fee=$pay_type->where("tag ='".$payorder['pay_tag']."'")->find();
    		if($pay_fee['fee'] !=''){
    			$pay['pay_money'] = $payorder['pay_money']*$pay_fee['fee']/100;
    		}else{
    			$pay['pay_money'] =$payorder['pay_money'];
    		}
    		$member->where($map)->setInc('money',$pay['pay_money']);//冲入金钱
    		$member->where($map)->setInc('point',$pay['pay_money'])*10;//增加积分
    		$paymodel = M('pay_ok');
    		$update['remark'] = "充值成功,充值到:平台币.充值金额:".$pay['pay_money']."元,获得积分:".$pay['pay_money']."分".$trade_no;
    		$update['order_status'] = "2,2,2";
    		$cond['orderid'] =$out_trade_no;
    		$paymodel->where($cond)->data($update)->save();
    		
    	//充值到游戏
    		$game = M ( 'game' );
    		$result = $game->where ( "gid=" . $payorder ['gid'] )->find ();
    		$import = import ( "@.Game." . $result ['tag'] . "" );
    		if (! $import) {
    			$this->error ( '游戏充值接口加载失败,请联系客服处理' );
    		}
    		$gamepay = new $result ['tag'] ();
    		if (! method_exists ( $gamepay, "pay" )) {
    			$this->error ( '游戏充值 方法不存在,请联系客服处理' );
    		}
    		$str = $gamepay->pay ( $out_trade_no );
    		
    		if ($str ['flag'] == '1') {
    			$this->pay_ok ($out_trade_no);
    		} else {
    				
    			$this->error ( $str ['mgs'] );
    		}
    	
    	
    	}
    	
    	
    	
    }

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
        
	echo "success";		//请不要修改或删除
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    echo "fail";

    //调试用，写文本函数记录程序运行情况是否正常
    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
}

	}
	
	
	
	
	public function notify_url_phone() {
		
		$dir = $_SERVER ['DOCUMENT_ROOT'];
		require $dir . '/app/lib/pay/phone/alipay.config.php';
		require $dir . '/app/lib/pay/phone/lib/alipay_notify.class.php';
		
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();
		if($verify_result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
			//获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
			//商户订单号
			$out_trade_no = $_POST['out_trade_no'];
			//支付宝交易号
			$trade_no = $_POST['trade_no'];
			//交易状态
			$trade_status = $_POST['trade_status'];
		
			$model = M ( 'pay_ok' );
			// 判断是否存在
			$payorder = $model->where ( "orderid='{$out_trade_no}'" )->find ();
			if($_POST['trade_status'] == 'TRADE_FINISHED') {
				 
		
				// 判断是否已经更新状态
				if ($payorder ['order_status'] == "2,2,2") {
					$this->pay_ok ( $out_trade_no );
					die ();
				}else{
					//冲入游戏 or plf
					//主要是更新订单状态和充值到用户账户
					$map['username'] = $payorder['pay_to_account'];
					$model = M('member');
					//查询出费率
					$pay_type = M('pay_type');
					$pay_fee=$pay_type->where("tag ='".$payorder['pay_tag']."'")->find();
					if($pay_fee['fee'] !=''){
						$pay['pay_money'] = $payorder['pay_money']*$pay_fee['fee']/100;
					}else{
						$pay['pay_money'] =$payorder['pay_money'];
					}
					$model->where($map)->setInc('money',$pay['pay_money']);//冲入金钱
					$model->where($map)->setInc('point',$pay['pay_money'])*10;//增加积分
					$paymodel = M('pay_ok');
					$update['remark'] = "充值成功,充值到:平台币.充值金额:".$pay['pay_money']."元,获得积分:".$pay['pay_money']."分".$trade_no;
					$update['order_status'] = "2,2,2";
					$cond['orderid'] =$out_trade_no;
					$paymodel->where($cond)->data($update)->save();
		
		
				}
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//如果有做过处理，不执行商户的业务程序
		
				//注意：
				//该种交易状态只在两种情况下出现
				//1、开通了普通即时到账，买家付款成功后。
				//2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。
		
				//调试用，写文本函数记录程序运行情况是否正常
				//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
			}
			else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//如果有做过处理，不执行商户的业务程序
		
				//注意：
				//该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。
		
				//调试用，写文本函数记录程序运行情况是否正常
				//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
				// 判断是否已经更新状态
				if ($payorder ['order_status'] == "2,2,2") {
					$this->pay_ok ( $out_trade_no );
					die ();
				}else{
					//冲入游戏 or plf
					//主要是更新订单状态和充值到用户账户
					$map['username'] = $payorder['pay_to_account'];
					$model = M('member');
					//查询出费率
					$pay_type = M('pay_type');
					$pay_fee=$pay_type->where("tag ='".$payorder['pay_tag']."'")->find();
					if($pay_fee['fee'] !=''){
						$pay['pay_money'] = $payorder['pay_money']*$pay_fee['fee']/100;
					}else{
						$pay['pay_money'] =$payorder['pay_money'];
					}
					$model->where($map)->setInc('money',$pay['pay_money']);//冲入金钱
					$model->where($map)->setInc('point',$pay['pay_money'])*10;//增加积分
					$paymodel = M('pay_ok');
					$update['remark'] = "充值成功,充值到:平台币.充值金额:".$pay['pay_money']."元,获得积分:".$pay['pay_money']."分".$trade_no;
					$update['order_status'] = "2,2,2";
					$cond['orderid'] =$out_trade_no;
					$paymodel->where($cond)->data($update)->save();
					 
					 
				}
				 
				 
				 
			}
		
			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
		
			echo "success";		//请不要修改或删除
		
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
			//验证失败
			echo "fail";
		
			//调试用，写文本函数记录程序运行情况是否正常
			//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		}
	}
	/**
	 *
	 * @name 充值成功显示页面
	 *      
	 * @return string
	 */
	public function pay_ok($order) {
		$public = A ( 'Public' );
		$public->read_conf ();
		$config = F ( 'basic' );
		$map ['orderid'] = $order;
		$model = M ( 'pay_ok' );
		$data = $model->where ( $map )->find ();
		
		
		
		$this->assign ( 'data', $data );
		$this->display ( TMPL_PATH . $config ['THEME'] . '/pay_ok.html' );
	}
}
?>