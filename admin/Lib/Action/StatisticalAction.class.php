<?php
/**
 * @name 统计系统控制器
 *
 * @access private
 *
 * @author 
 */
Vendor ( 'Ucenter.UcApi' );
class StatisticalAction extends CommonAction {
 	public $config;
	  	public function __construct()
	  	{
	  		parent::_initialize();
	  		$this->config = C("ADMIN_THEME");
	  		parent::action_access(MODULE_NAME,ACTION_NAME);
	  	
	  	}
	/**
	 * name 网站统计管理
	 * 
	 */
	public function statistical_index() {
		$starttime = strtotime ( $_POST ['starttime'] );
		$endtime = strtotime ( $_POST ['endtime'] );
		
		if($starttime > $endtime){
			$this->error ( "您查询的时间有误！" );
		}
		
		$time = date ( 'Y-m-d' );
		if ($endtime == '') {
			$endtime = strtotime ( $time . '00:00:00' );
		}
		
		$endtime_1 = $endtime - 3600 * 24;
		if ($starttime == '') {
			$starttime = strtotime ( '2013-02-06 00:00:00' );
		}
		$Model = new Model ();
		$pay_ok = M ( 'pay_ok' );
		$game = M ( 'game' );
		$pay_type = M ( 'pay_type' );
		$admin_pay = M('admin_pay');
		$spend_log = M('spend_log');
		$member_extend_info = M ( 'member_extend_info' );
		/*
		 * 注册统计--(2013-02-20--2013-03-02)
		 */
		// 网站累计注册人数
		$count_reg = $member_extend_info->where ( 'grouping =0 and register_time BETWEEN ' . $starttime . ' AND ' . $endtime )->order ( 'uid desc' )->count ();
		$this->assign ( 'count_reg', $count_reg );
		// 网站累计ip
		// 查询一级公会每天充值人数、金额
		$count_ip = $Model->query ( "SELECT  count(distinct register_ip) AS num  FROM " . C ( 'DB_PREFIX' ) . "member_extend_info WHERE  register_time BETWEEN $starttime AND $endtime   AND grouping = 0 " );
		$this->assign ( 'count_ip', $count_ip );
		
		// 注册人数（渠道）
		$count_reg_chann = $member_extend_info->where ( 'sub_channels !=0 and register_time BETWEEN ' . $starttime . ' AND ' . $endtime )->order ( 'uid desc' )->count ();
		$this->assign ( 'count_reg_chann', $count_reg_chann );
		
		// 游戏名 注册人数
		$count_reg_gid = $Model->query ( "SELECT  count(*) AS num ,gid FROM " . C ( 'DB_PREFIX' ) . "member_extend_info WHERE  gid !=0 and register_time BETWEEN $starttime AND $endtime   AND grouping = 0 group by gid" );
		foreach ( $count_reg_gid as $k => $v ) {
			$game_info = $game->where ( 'gid =' . $v ['gid'] )->getField ( 'gamename' );
			$count_reg_gid [$k] ['gamename'] = $game_info;
		}
		$this->assign ( 'count_reg_gid', $count_reg_gid );
		/*
		 * 注册统计(2013-03-02)
		 */
		// 游戏名 昨日注册人数 昨日ip 昨日注册人数（渠道）
		$count_reg_gid_y = $Model->query ( "SELECT  count(*) AS num ,gid FROM " . C ( 'DB_PREFIX' ) . "member_extend_info WHERE  gid !=0 and register_time BETWEEN $endtime_1 AND $endtime   AND grouping = 0 group by gid" );
		foreach ( $count_reg_gid_y as $k => $v ) {
			$str = $Model->query ( "SELECT  count(distinct register_ip) AS num_ip  FROM " . C ( 'DB_PREFIX' ) . "member_extend_info WHERE  register_time BETWEEN $endtime_1 AND $endtime   AND  gid =" . $v ['gid'] );
			$str_1 = $Model->query ( "SELECT  count(*) AS num_chann  FROM " . C ( 'DB_PREFIX' ) . "member_extend_info WHERE  register_time BETWEEN $endtime_1 AND $endtime   AND  sub_channels !=0 AND  gid =" . $v ['gid'] );
			$game_info = $game->where ( 'gid =' . $v ['gid'] )->getField ( 'gamename' );
			$count_reg_gid_y [$k] ['gamename'] = $game_info;
			$count_reg_gid_y [$k] ['num_ip'] = $str [0] ['num_ip'];
			$count_reg_gid_y [$k] ['num_chann'] = $str_1 [0] ['num_chann'];
		}
		
		$this->assign ( 'count_reg_gid_y', $count_reg_gid_y );
		// 网站累计充值人次
		$count_pay = $pay_ok->where ( "order_status = '2,2,2' and success_time BETWEEN  $starttime AND $endtime " )->order ( 'uid desc' )->count ();
		$this->assign ( 'count_pay', $count_pay );
		// 网站累计充值金额
		$count_pay_money = $pay_ok->query ( "SELECT   sum(pay_money) as totalmoney FROM " . C ( 'DB_PREFIX' ) . "pay_ok WHERE order_status = '2,2,2' and success_time BETWEEN  $starttime AND $endtime " );
		$this->assign ( 'count_pay_money', $count_pay_money );
		// 实际到账
		$count_pay_realmoney = $pay_ok->query ( "SELECT sum(pay_really_money) as realmoney FROM " . C ( 'DB_PREFIX' ) . "pay_ok WHERE order_status = '2,2,2' and success_time BETWEEN  $starttime AND $endtime " );
		$this->assign ( 'count_pay_realmoney', $count_pay_realmoney );
		// 后台充值
		
		$count_adminpay_money = $admin_pay->query ( "SELECT  sum(real_money) as totalmoney FROM " . C ( 'DB_PREFIX' ) . "admin_pay WHERE  add_time BETWEEN  $starttime AND $endtime " );
		$this->assign ( 'count_adminpay_money', $count_adminpay_money );
		//渠道充值
		$count_pay_cpsmoney = $spend_log->query ( "SELECT sum(spend_money) as realmoney FROM " . C ( 'DB_PREFIX' ) . "spend_log WHERE sub_channels != 0 and spend_time BETWEEN  $starttime AND $endtime " );
		$this->assign ( 'count_pay_cpsmoney', $count_pay_cpsmoney );
		
		// 游戏名 充值金额
		$count_pay_gamemoney = $pay_ok->query ( "SELECT   sum(pay_really_money) as gamemoney ,gid FROM " . C ( 'DB_PREFIX' ) . "pay_ok WHERE gid !=0 and order_status = '2,2,2' and success_time BETWEEN  $starttime AND $endtime group by gid" );
		foreach ( $count_pay_gamemoney as $k => $v ) {
			$game_info = $game->where ( 'gid =' . $v ['gid'] )->getField ( 'gamename' );
			$count_pay_gamemoney [$k] ['gamename'] = $game_info;
		}
		$this->assign ( 'count_pay_gamemoney', $count_pay_gamemoney );
		
		// 充值方式 充值金额
		$count_pay_typemoney = $pay_ok->query ( "SELECT sum(pay_really_money) as typemoney,pay_tag FROM " . C ( 'DB_PREFIX' ) . "pay_ok WHERE order_status = '2,2,2' and success_time BETWEEN  $starttime AND $endtime group by pay_tag" );
		foreach ( $count_pay_typemoney as $k => $v ) {
			$pay_info = $pay_type->where ( "tag ='" . $v ['pay_tag'] . "'" )->getField ( 'payname' );
			$count_pay_typemoney [$k] ['payname'] = $pay_info;
		}
		
		$this->assign ( 'count_pay_typemoney', $count_pay_typemoney );
		
		/*
		 * 充值统计(2013-03-02)
		 */
		// 正常--除渠道媒体等推广引起的充值（元） 渠道（元） 充值金额 后台充值金额（元）
		//总共充值
		$count_pay_totalmoney = $pay_ok->query ( "SELECT   sum(pay_money) as totalmoney FROM " . C ( 'DB_PREFIX' ) . "pay_ok WHERE order_status = '2,2,2' and success_time BETWEEN  $endtime_1 AND $endtime " );
		$this->assign ( 'count_pay_totalmoney', $count_pay_totalmoney );
		//渠道充值
		$count_pay_cpstotalmoney = $spend_log->query ( "SELECT sum(spend_money) as realmoney FROM " . C ( 'DB_PREFIX' ) . "spend_log WHERE sub_channels != 0 and spend_time BETWEEN  $endtime_1 AND $endtime " );
		$n_paymoney = $count_pay_totalmoney[0]['totalmoney']- $count_pay_cpstotalmoney[0]['realmoney'];
		$this->assign ( 'n_paymoney', $n_paymoney );
		$this->assign ( 'count_pay_cpstotalmoney', $count_pay_cpstotalmoney );
		$count_adminpay_money_y = $admin_pay->query ( "SELECT  sum(real_money) as totalmoney FROM " . C ( 'DB_PREFIX' ) . "admin_pay WHERE  add_time BETWEEN  $endtime_1 AND $endtime " );
		$this->assign ( 'count_adminpay_money_y', $count_adminpay_money_y );
		
		// 充值方式 充值金额（元）
		$count_pay_typemoney_y = $pay_ok->query ( "SELECT   sum(pay_really_money) as typemoney,pay_tag FROM " . C ( 'DB_PREFIX' ) . "pay_ok WHERE order_status = '2,2,2' and success_time BETWEEN  $endtime_1 AND $endtime group by pay_tag" );
		foreach ( $count_pay_typemoney_y as $k => $v ) {
			$pay_info = $pay_type->where ( "tag ='" . $v ['pay_tag'] . "'" )->getField ( 'payname' );
			$count_pay_typemoney_y [$k] ['payname'] = $pay_info;
		}
		
		$this->assign ( 'count_pay_typemoney_y', $count_pay_typemoney_y );
		
		$count = $pay_ok->where ( 'success_time BETWEEN ' . $starttime . ' AND ' . $endtime )->order ( 'id desc' )->count ();
		$this->assign ( 'starttime', $starttime );
		$this->assign ( 'endtime', $endtime );
		$this->assign ( 'endtime_1', $endtime_1 );
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/statistical_index.html' );
	}
	/**
	 * name 防沉迷管理
	 */
	public function fcm_list() {
		$member = D ( 'MemberView' );
		import ( '@.ORG.Util.Page' );
		if (isset ( $_REQUEST ['username'] ) && $_REQUEST ['username'] != '') {
			
			$count = $member->where ( "member_extend_info.grouping =0 and username='" . trim ( $_REQUEST ['username'] ) . "'" )->order ( 'uid asc' )->count ();
			$p = new Page ( $count, 20 );
			$list = $member->where ( "member_extend_info.grouping =0 and username='" . trim ( $_REQUEST ['username'] ) . "'" )->order ( 'uid asc' )->limit ( $p->firstRow . ',' . $p->listRows )->select ();
		} elseif (isset ( $_REQUEST ['is_fcm'] ) && $_REQUEST ['is_fcm'] != '') {
			
			$count = $member->where ( "member_extend_info.grouping =0 and is_fcm= " . $_REQUEST ['is_fcm'] )->order ( 'uid asc' )->count ();
			
			$p = new Page ( $count, 20 );
			$list = $member->where ( "member_extend_info.grouping =0 and is_fcm= " . $_REQUEST ['is_fcm'] )->order ( 'uid asc' )->limit ( $p->firstRow . ',' . $p->listRows )->select ();
		} else {
			
			$count = $member->where ( "member_extend_info.grouping =0 " )->order ( 'uid desc' )->count ();
			$p = new Page ( $count, 20 );
			$list = $member->where ( "member_extend_info.grouping =0 " )->order ( 'uid desc' )->limit ( $p->firstRow . ',' . $p->listRows )->select ();
		}
		
		$p->setConfig ( 'prev', '上一页' );
		$p->setConfig ( 'header', '区服' );
		$p->setConfig ( 'first', '首 页' );
		$p->setConfig ( 'last', '末 页' );
		$p->setConfig ( 'next', '下一页' );
		$p->setConfig ( 'theme', "%first%%upPage%%linkPage%%downPage%%end%
			<li><span><select name='select' onChange='javascript:window.location.href=(this.options[this.selectedIndex].value);'>%allPage%</select></span></li>\n<li><span>共<font color='#009900'><b>%totalRow%</b></font>条记录 20篇/每页</span></li>" );
		$this->assign ( 'page', $p->show () );
		$this->assign ( 'list', $list );
		$this->assign ( 'is_fcm', $_POST ['is_fcm'] );
		$this->assign ( 'username', $_POST ['username'] );
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/fcm_list.html' );
	}
	/**
	 * name 防沉迷修改
	 */
	public function fcm_edit() {
		$log_str = '防沉迷修改';
		parent::admin_log ( $log_str );
		$conn = M ( 'member' );
		$arr ['uid'] = $_GET ['uid'];
		$info = $conn->where ( $arr )->find ();
		$this->assign ( 'info', $info );
		$this->assign ( 'uid', $arr ['uid'] );
		if ($_POST ['dosubmit']) {
			$map ['is_fcm'] = trim ( $_POST ['is_fcm'] );
			$arr1 ['uid'] = trim ( $_POST ['uid'] );
			$st = $conn->where ( $arr1 )->save ( $map ); // 根据条件保存修改的数据
			if ($st) {
				$this->success ( "修改成功!", U ( 'Statistical/fcm_list' ) );
			} else {
				$this->error ( "发生错误:" . mysql_error (), U ( 'Statistical/fcm_list' ) );
			}
		}
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/fcm_edit.html' );
	}
/**
 * name 批量开启防沉迷
 */
	public function fcm_open(){
		$log_str = '防沉迷批量开启';
		parent::admin_log ( $log_str );
		$lid = $_POST ['uid'];
		$lids = implode ( ',', $lid ); // 批量获取id
		$id = is_array ( $lid ) ? $lids : $lid;
		$arr ['uid'] = array (
				'in',
				$id
		);
		$map ['is_fcm'] = 0;
		if (! $lid) {
			$this->error ( "请勾选记录！" );
		}
		$member = M ( 'member' );
		$flag = $member->where ( $arr )->save ( $map ); // 数据
		if ($flag) {
			$this->success ( "批量开启成功!", U ( 'Statistical/fcm_list' ) );
		} else {
			$this->error ( "发生错误:" . mysql_error (), U ( 'Statistical/fcm_list' ) );
		}
	}
/**
 * name 批量关闭防沉迷
 */
	public function fcm_batch() {
		$log_str = '防沉迷批量关闭';
		parent::admin_log ( $log_str );
		$lid = $_POST ['uid'];
		$lids = implode ( ',', $lid ); // 批量获取id
		$id = is_array ( $lid ) ? $lids : $lid;
		$arr ['uid'] = array (
				'in',
				$id 
		);
		$map ['is_fcm'] = 1;
		if (! $lid) {
			$this->error ( "请勾选记录！" );
		}
		$member = M ( 'member' );
		$flag = $member->where ( $arr )->save ( $map ); // 删除数据
		if ($flag) {
			$this->success ( "批量关闭成功!", U ( 'Statistical/fcm_list' ) );
		} else {
			$this->error ( "发生错误:" . mysql_error (), U ( 'Statistical/fcm_list' ) );
		}
	}
/**
 * naem 会员管理
 */
	public function member_list() {
		$member = D ( 'MemberView' );
		import ( '@.ORG.Util.Page' );
		$username = $_REQUEST ['username'];
		$user_status = $_REQUEST ['user_status'];
		$point = $_REQUEST ['point']? $_REQUEST ['point']:0;
		$this->assign ( 'username', $username );
		$this->assign ( 'user_status',$user_status );
		$this->assign ( 'point',$point );
		if($username){
		$username_str = " and username='".$username."'";
		}
		
		if($user_status !=''){
			$user_status_str = " and user_status=".$user_status;
		}
		
		if($point==0){
			$point_str = 'money desc';
			
		}else{
			$point_str = 'point asc';
		}
	
		$count = $member->where ( "member_extend_info.grouping =0 " . $user_status_str.$username_str )->order ( $point_str )->count ();
		$p = new Page ( $count, 20 );
		$list = $member->where ( "member_extend_info.grouping =0 " . $user_status_str.$username_str)->order ( $point_str )->limit ( $p->firstRow . ',' . $p->listRows )->select ();
		foreach($list as $k=>$v){
		  $list[$k]['point1'] = $v['point'];
		}
		$p->setConfig ( 'prev', '上一页' );
		$p->setConfig ( 'header', '区服' );
		$p->setConfig ( 'first', '首 页' );
		$p->setConfig ( 'last', '末 页' );
		$p->setConfig ( 'next', '下一页' );
		$p->setConfig ( 'theme', "%first%%upPage%%linkPage%%downPage%%end%
			<li><span><select name='select' onChange='javascript:window.location.href=(this.options[this.selectedIndex].value);'>%allPage%</select></span></li>\n<li><span>共<font color='#009900'><b>%totalRow%</b></font>条记录 20篇/每页</span></li>" );
		$this->assign ( 'page', $p->show () );
		$this->assign ( 'list', $list );
		
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/member_list.html' );
	}
	
/**
 * name 会员信息修改
 */
	public function member_edit() {
		$log_str = '会员修改';
		parent::admin_log ( $log_str );
		$conn = M ( 'member' );
		$arr ['uid'] = $_GET ['uid'];
		$info = $conn->where ( $arr )->find ();
		$this->assign ( 'info', $info );
		$this->assign ( 'uid', $arr ['uid'] );
		if ($_POST ['dosubmit']) {
			$map ['email'] = trim ( $_POST ['email'] );
			$map ['nickname'] = trim ( $_POST ['nickname'] );
			$map ['user_status'] = trim ( $_POST ['user_status'] );
			$arr1 ['uid'] = trim ( $_POST ['uid'] );
			$username = trim ( $_POST ['username'] );
			$newpw = trim ( $_POST ['password'] );
			if (! preg_match ( "/\b(^(\S+@).+((\.com)|(\.net)|(\.org)|(\.info)|(\.edu)|(\.mil)|(\.gov)|(\.biz)|(\.ws)|(\.us)|(\.tv)|(\.cc)|(\..{2,2}))$)\b/", $map ['email'] )) {
				$this->error ( '您提交的数据有误:邮箱格式不正确,请检查您的输入!' );
			}
			
			if ($newpw) {
				if (strlen ( $newpw ) < 6 || strlen ( $newpw ) > 22) {
					$this->error ( '您提交的数据有误:密码长度为6到22位的字符,请检查您的输入!' );
				}
				$flag = uc_user_edit ( $username, '', $newpw, $map ['email'], 1 );
			}
			$st = $conn->where ( $arr1 )->save ( $map ); // 根据条件保存修改的数据
			                                             // 暂时不判断
			$this->success ( "修改成功!", U ( 'Statistical/member_list' ) );
		}
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/member_edit.html' );
	}
	
/**
 * name 会员删除
 */
	public function member_delete() {
		$log_str = '会员删除';
		parent::admin_log ( $log_str );
		$lid = $_POST ['uid'];
		$lids = implode ( ',', $lid ); // 批量获取id
		$id = is_array ( $lid ) ? $lids : $lid;
		$map ['uid'] = array (
				'in',
				$id 
		);
		if (! $lid) {
			$this->error ( "请勾选记录！" );
		}
		uc_user_delete ( $lid );
		$member = M ( 'member' );
		$member_extend_info = M ( 'member_extend_info' );
		$flag = $member->where ( $map )->delete (); // 删除数据
		$flag_1 = $member_extend_info->where ( $map )->delete (); // 删除数据
		if ($flag) {
			$this->success ( "删除成功!", U ( 'Statistical/member_list' ) );
		} else {
			$this->error ( "发生错误:" . mysql_error (), U ( 'Statistical/member_list' ) );
		}
	}
	/**
	 * name 批量锁定用户
	 */
	public function member_lock() {
		$log_str = '会员批量锁定';
		parent::admin_log ( $log_str );
		$lid = $_POST ['uid'];
		$lids = implode ( ',', $lid ); // 批量获取id
		$id = is_array ( $lid ) ? $lids : $lid;
		$arr ['uid'] = array (
				'in',
				$id 
		);
		if (! $lid) {
			$this->error ( "请勾选记录！" );
		}
		$map ['user_status'] = 1;
		$member = M ( 'member' );
		$flag = $member->where ( $arr )->save ( $map ); // 删除数据
		
		if ($flag) {
			$this->success ( "批量锁定成功!", U ( 'Statistical/member_list' ) );
		} else {
			$this->error ( "发生错误:" . mysql_error (), U ( 'Statistical/member_list' ) );
		}
	}
	/**
	 * naem 会员批量解除
	 */
	public function member_unlock() {
		$log_str = '会员批量解锁';
		parent::admin_log ( $log_str );
		$lid = $_POST ['uid'];
		$lids = implode ( ',', $lid ); // 批量获取id
		$id = is_array ( $lid ) ? $lids : $lid;
		$arr ['uid'] = array (
				'in',
				$id 
		);
		if (! $lid) {
			$this->error ( "请勾选记录！" );
		}
		$map ['user_status'] = 0;
		$member = M ( 'member' );
		$flag = $member->where ( $arr )->save ( $map ); // 删除数据
		
		if ($flag) {
			$this->success ( "批量解锁成功!", U ( 'Statistical/member_list' ) );
		} else {
			$this->error ( "发生错误:" . mysql_error (), U ( 'Statistical/member_list' ) );
		}
	}
	
/**
 * name 游戏 登陆记录
 */
	public function game_log() {
		$game_log = M ( 'game_log' );
		$game = M ( 'game' );
		$server = M ( 'server' );
		import ( '@.ORG.Util.Page' );
		if (isset ( $_REQUEST ['username'] ) && $_REQUEST ['username'] != '') {
			$count = $game_log->where ( "username='" . trim ( $_REQUEST ['username'] ) . "'" )->order ( 'uid asc' )->count ();
			$p = new Page ( $count, 20 );
			$list = $game_log->where ( "username='" . trim ( $_REQUEST ['username'] ) . "'" )->order ( 'uid asc' )->limit ( $p->firstRow . ',' . $p->listRows )->select ();
			$this->assign ( 'username', $_REQUEST ['username'] );
		} else {
			
			$count = $game_log->where ()->order ( 'uid desc' )->count ();
			$p = new Page ( $count, 20 );
			$list = $game_log->where ()->order ( 'uid desc' )->limit ( $p->firstRow . ',' . $p->listRows )->select ();
		}
		
		$p->setConfig ( 'prev', '上一页' );
		$p->setConfig ( 'header', '区服' );
		$p->setConfig ( 'first', '首 页' );
		$p->setConfig ( 'last', '末 页' );
		$p->setConfig ( 'next', '下一页' );
		$p->setConfig ( 'theme', "%first%%upPage%%linkPage%%downPage%%end%
			<li><span><select name='select' onChange='javascript:window.location.href=(this.options[this.selectedIndex].value);'>%allPage%</select></span></li>\n<li><span>共<font color='#009900'><b>%totalRow%</b></font>条记录 20篇/每页</span></li>" );
		$this->assign ( 'page', $p->show () );
		
		// 执行其他的数据操作
		
		foreach ( $list as $k => $v ) {
			$arr = $game->where ( 'gid = ' . $v ['gid'] )->find ();
			$arr1 = $server->where ( 'sid = ' . $v ['sid'] )->find ();
			$list [$k] ['gamename'] = $arr ['gamename'];
			$list [$k] ['servername'] = $arr1 ['servername'];
		}
		
		$this->assign ( 'list', $list );
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/game_log.html' );
	}
/**
 * name 删除游戏登陆记录
 */
	public function game_log_delete() {
		$log_str = '游戏登陆log删除';
		parent::admin_log ( $log_str );
		$lid = $_POST ['logid'];
		$lids = implode ( ',', $lid ); // 批量获取id
		$id = is_array ( $lid ) ? $lids : $lid;
		$map ['logid'] = array (
				'in',
				$id 
		);
		if (! $lid) {
			$this->error ( "请勾选记录！" );
		}
		$game_log = M ( 'game_log' );
		$flag = $game_log->where ( $map )->delete (); // 删除数据
		if ($flag) {
			$this->success ( "删除成功!", U ( 'Statistical/game_log' ) );
		} else {
			$this->error ( "发生错误:" . mysql_error (), U ( 'Statistical/game_log' ) );
		}
	}
}

?>