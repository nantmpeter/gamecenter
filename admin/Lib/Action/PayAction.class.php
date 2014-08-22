<?php
/**
      * @name 充值系统控制器
      * 
      * @author 31wan team
      * 
      * @version 1.0
      */
class PayAction extends CommonAction {
 	public $config;
	  	public function __construct()
	  	{
	  		parent::_initialize();
	  		$this->config = C("ADMIN_THEME");
	  		parent::action_access(MODULE_NAME,ACTION_NAME);
	  	
	  	}
	  	/**
	  	 * @name 充值方式管理
	  	 */
	public function edit_pay_type() {
	
		$map ['id'] = $_GET ['tid'];
		$model = M ( 'pay_type' );
		$result = $model->where ( $map )->find ();
		
		$this->assign ( 'pay', $result );
		$this->display ( TMPL_PATH . $this->config . '/edit_pay_type.html' );
	}
		/**
		 * @name 更新充值方式
		 */
	public function update_pay_type() {
		$log_str = '更新充值方式';
		parent::admin_log ( $log_str );

		$map ['id'] = $_POST ['id'];
		$conds ['sort'] = $_POST ['sort'];
		$conds ['tag'] = $_POST ['tag'];
		$conds ['payname'] = $_POST ['payname'];
		$conds ['icon'] = $_POST ['icon'];
		$conds ['fee'] = $_POST ['fee'];
		$conds ['rebate'] = $_POST ['rebate'];
		$conds ['content'] = $_POST ['content'];
		$conds ['modifytime'] = time ();
		$conds ['isdisplay'] = $_POST ['isdisplay'];
		$conds ['status'] = $_POST ['status'];
		$conds ['key'] = $_POST ['key'];
		$conds ['account'] = $_POST ['account'];
		
		$model = M ( 'pay_type' );
		$st = $model->where ( $map )->data ( $conds )->save ();
		if (! $st) {
			$arr ['status'] = "-1";
			$arr ['msg'] = "更新失败,系统发生错误.详情:" . mysql_error ();
			die ( json_encode ( $arr ) );
		} else {
			$arr ['status'] = "1";
			$arr ['msg'] = "更新充值方式成功.";
			die ( json_encode ( $arr ) );
		}
	}
	/**
	 *
	 * @name 充值查询（游戏币）
	 */
	public function order() {
		import ( "ORG.Util.Page" );
		// ###计算今日收益#######
		$time = date ( 'Y-m-d' );
		$begin = strtotime ( $time . '00:00:00' );
		$end = strtotime ( $time . '23:59:59' );
		$pay = M ( 'pay_ok' );
		$p ['pay_time'] = array (
				'between',
				array (
						$begin,
						$end 
				) 
		);
		$p ['order_status'] = array (
				'neq',
				'0,0,0' 
		);
		$m_list ['today'] = $pay->where ( $p )->sum ( 'pay_money' );
		
		$ytime = date ( 'Y-m-d', strtotime ( '-1 day' ) );
		$tbegin = strtotime ( $ytime . '00:00:00' );
		$tend = strtotime ( $ytime . '23:59:59' );
		$y ['pay_time'] = array (
				'between',
				array (
						$tbegin,
						$tend 
				) 
		);
		$y ['order_status'] = array (
				'neq',
				'0,0,0' 
		);
		$m_list ['yesterday'] = $pay->where ( $y )->sum ( 'pay_money' );
		// #################
		$model = D ( 'PayView' );
		$map ['pay_ok.pay_way_num'] = "0";
		
		
		if (isset ( $_REQUEST ['username'] ) && $_REQUEST ['username'] != '') {
			$map ['pay_ok.pay_to_account'] = trim($_REQUEST ['username']);
			$this->assign ( 'username', $_REQUEST ['username']);
			$count = $model->where ( $map )->count ();
		   $page = new Page ( $count, 25 );
		   $show = $page->show ();
		   $list = $model->where ( $map )->order ( 'id desc' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		} elseif (isset ( $_REQUEST ['orderid'] ) && $_REQUEST ['orderid'] != '') {
			$map ['pay_ok.orderid'] = trim($_REQUEST ['orderid']);
			$this->assign ( 'orderid', $_REQUEST ['orderid']);
			$count = $model->where ( $map )->count ();
			$page = new Page ( $count, 25);
			$show = $page->show ();
			$list = $model->where ( $map )->order ( 'id desc' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
			
		} elseif (isset ( $_REQUEST ['game'] ) && $_REQUEST ['game'] != '') {
			$map ['pay_ok.gid'] = trim($_REQUEST ['game']);
			$this->assign ( 'game_info', $_REQUEST ['game']);
			$count = $model->where ( $map )->count ();
			$page = new Page ( $count, 25 );
			$show = $page->show ();
			$list = $model->where ( $map )->order ( 'id desc' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		} else {
				
			$count = $model->where ( $map )->count ();
		   $page = new Page ( $count, 25 );
		   $show = $page->show ();
		$list = $model->where ( $map )->order ( 'id desc' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		}
	
		
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出
		$this->assign ( 'm_list', $m_list );
		$this->display ( TMPL_PATH . $this->config . '/pay_order.html' );
	}
	
	/**
	 *
	 * @name 订单删除
	 */
	public function pay_order_del() {
		$arr = '订单删除';
		parent::admin_log ( $arr );
		$cid = $_POST['id'];
		$cids = implode(',',$cid);//批量获取gid
		$id = is_array($cid) ? $cids : $cid;
		$map['id'] = array('in',$id);
		if(!$cid)
		{
			$this->error("请勾选记录！");
		}
		$pay_ok = M("pay_ok"); // 实例化card对象
		$flag = $pay_ok->where($map)->delete(); // 删除数据
		if($flag){
			$this->success("删除成功!",U('Pay/order'));
		} else{
			$this->error("发生错误:".mysql_error(),U('Pay/order'));
		}
	}
	/**
	 *
	 * @name 订单详细查看
	 */
	public function order_info() {
		$id = $_GET['id'];
		$model = D ( 'PayView' );
		$list = $model->where ('pay_ok.id ='.$id )->find();

		$this->assign ( 'info', $list ); // 赋值数据集
		$this->display ( TMPL_PATH . $this->config . '/order_info.html' );
	}
	/**
	 *
	 * @name 游戏补单
	 */
	public function game_budan() {
		$id = $_GET['id'];
		$model = M('pay_ok');
		$payorder = $model->where("id={$id}")->find();
		if($payorder['order_status']!="2,2,2"){
			$this->error('该订单充值未成功！不能补单',U('Pay/order'));
		}else{
		$game = M('game');
		$result = $game->where("gid=".$payorder['gid'])->find();
		
		$import = import("@.Game.".$result['tag']."");
		if(!$import){
			$this->error('游戏充值接口加载失败,请联系客服处理');
			die();
		}
		$gamepay = new $result['tag'];
		if(!method_exists($gamepay, "pay")){
			$this->error('游戏充值 方法不存在,请联系客服处理');
			die();
		}
		$str = $gamepay->pay($payorder['orderid']);
		if($str['flag'] =='1'){
			$this->success('游戏充值 成功',U('Pay/order'));
		}else {
			$this->error('游戏充值 失败,请联系技术人员',U('Pay/order'));
			die();
		}
		}
	
	}
	/**
	 * @name 订单查询（平台币）
	 */
	public function order_plf() {
			import ( "ORG.Util.Page" );
		// ###计算今日收益#######
		$time = date ( 'Y-m-d' );
		$begin = strtotime ( $time . '00:00:00' );
		$end = strtotime ( $time . '23:59:59' );
		$pay = M ( 'pay_ok' );
		$p ['pay_time'] = array (
				'between',
				array (
						$begin,
						$end 
				) 
		);
		$p ['order_status'] = array (
				'neq',
				'0,0,0' 
		);
		$m_list ['today'] = $pay->where ( $p )->sum ( 'pay_money' );
		
		$ytime = date ( 'Y-m-d', strtotime ( '-1 day' ) );
		$tbegin = strtotime ( $ytime . '00:00:00' );
		$tend = strtotime ( $ytime . '23:59:59' );
		$y ['pay_time'] = array (
				'between',
				array (
						$tbegin,
						$tend 
				) 
		);
		$y ['order_status'] = array (
				'neq',
				'0,0,0' 
		);
		$m_list ['yesterday'] = $pay->where ( $y )->sum ( 'pay_money' );
		// #################
		$model = D ( 'PayView' );
		$map ['pay_ok.pay_way_num'] = "1";
		
		
		if (isset ( $_REQUEST ['username'] ) && $_REQUEST ['username'] != '') {
			$map ['pay_ok.pay_to_account'] = trim($_POST ['username']);
			$this->assign ( 'username', $_POST ['username']);
			$count = $model->where ( $map )->count ();
		   $page = new Page ( $count, 25 );
		   $show = $page->show ();
		   $list = $model->where ( $map )->order ( 'id desc' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		} elseif (isset ( $_REQUEST ['orderid'] ) && $_REQUEST ['orderid'] != '') {
			$map ['pay_ok.orderid'] = trim($_POST ['orderid']);
			$this->assign ( 'orderid', $_POST ['orderid']);
			$count = $model->where ( $map )->count ();
			$page = new Page ( $count, 25 );
			$show = $page->show ();
			$list = $model->where ( $map )->order ( 'id desc' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
			
		} elseif (isset ( $_REQUEST ['game'] ) && $_REQUEST ['game'] != '') {
			$map ['pay_ok.gid'] = trim($_POST ['game']);
			$this->assign ( 'game_info', $_POST ['game']);
			$count = $model->where ( $map )->count ();
			$page = new Page ( $count, 25 );
			$show = $page->show ();
			$list = $model->where ( $map )->order ( 'id desc' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		} else {
				
			$count = $model->where ( $map )->count ();
		   $page = new Page ( $count, 25 );
		   $show = $page->show ();
		$list = $model->where ( $map )->order ( 'id desc' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		}
	
		
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出
		$this->assign ( 'm_list', $m_list );
		$this->display ( TMPL_PATH . $this->config . '/pay_order_plf.html' );
	}
	/**
	 * @name 后台充值
	 */
	public function budan() {
		$arr = 'budan';
		parent::admin_log ( $arr );
		if ($_GET ['orderid']) { // 补单
			$model = D ( 'PayView' );
			$map ['orderid'] = trim ( $_GET ['orderid'] );
			$info = $model->where ( $map )->find ();
			
			if ($info ['order_status'] != "1,1,1") {
				$this->error ( '对不起,该订单不需要补单!' );
			}
			$this->assign ( 'info', $info );
			$this->display ( TMPL_PATH . $this->config . '/pay_budan.html' );
		} 
		else { // 正常充值
			
			$this->display ( TMPL_PATH . $this->config . '/pay_to_plf.html' );
		}
	}
	/**
	 *
	 * @name 删除支付方式
	 */
	public function del_pay() {

		$arr = 'del_pay';
		parent::admin_log ( $arr );
		$map ['id'] = $_POST ['q'];
		$model = M ( 'pay_type' );
		$st = $model->where ( $map )->delete ();
		if (! $st) {
			$arr ['msg'] = '删除失败,mysql数据库发生错误,详情' . mysql_errno ();
			$arr ['status'] = '1';
			die ( json_encode ( $arr ) );
		} else {
			$arr ['msg'] = '删除支付方式成功';
			$arr ['status'] = '0';
			die ( json_encode ( $arr ) );
		}
	}
	/**
	 *
	 * @name 增加充值方式页
	 */
	public function pay_way_add() {
		$this->display ( TMPL_PATH . $this->config . '/pay_way_add.html' );
	}
	/**
	 *
	 * @name 充值方式管理
	 */
	public function manager_for_pay_way() {
		$model = M ( 'pay_type' );
		$list = $model->order ( 'sort asc' )->select ();
		$this->assign ( 'list', $list );
		$this->display ( TMPL_PATH . $this->config . '/manager_for_pay_way.html' );
	}
	
	/**
	 * @name 执行增加充值方式
	 */
	public function do_pay_way_add() {
		$arr = 'do_pay_way_add';
		parent::admin_log ( $arr );
		$info ['icon'] = $_POST ['iconc'];
		$info ['sort'] = $_POST ['sort'];
		$info ['tag'] = $_POST ['tag'];
		$info ['payname'] = $_POST ['pay_name'];
		$info ['fee'] = $_POST ['fee'];
		$info ['rebate'] = $_POST ['rebate'];
		$info ['content'] = $_POST ['content'];
		$info ['addtime'] = time ();
		$info ['isdisplay'] = $_POST ['isdisplay'];
		$info ['status'] = $_POST ['status'];
		$info ['account'] = $_POST ['account'];
		$info ['key'] = $_POST ['key'];
		$info ['operater'] = $_SESSION ['user'];

		$model = M ( 'pay_type' );
		$st = $model->data ( $info )->add ();
		if (! $st) {
			$this->error ( '添加充值方式失败,出错详情:' . mysql_error () );
		} else {
			$this->success ( '添加充值方式成功' );
		}
	}
	/**
	 *
	 * @name 保存充值方式icon
	 */
	public function save_icon() {
		$arr = '保存icon';
		parent::admin_log ( $arr );
		// 文件上传
		import ( "@.ORG.Net.UploadFile" );
		$upload = new UploadFile (); // 实例化上传类
		$upload->maxSize = 111024; // 设置附件上传大小
		$upload->allowExts = array (
				'jpg',
				'gif',
				'png',
				'jpeg' 
		); // 设置附件上传类型
		$upload->savePath = $_SERVER ['DOCUMENT_ROOT'] . '/Public/Uploads/icon/'; // 设置附件上传目录
		if (! $upload->upload ()) { // 上传错误提示错误信息
			$arr = array ();
			$arr = $upload->getErrorMsg ();
			die ( json_encode ( $arr ) );
		} else { // 上传成功 获取上传文件信息
			$info = $upload->getUploadFileInfo ();
			die ( "http://" . $_SERVER ['SERVER_NAME'] . "/Public/Uploads/icon/" . $info ['0'] ['savename'] );
		}
	}
	/**
	 *
	 * @name 充值到平台
	 */
	public function pay_member_plf() {
		$username = trim ( $_POST ['username'] );
		$money = ( int ) (trim ( $_POST ['money'] ));
		$res = uc_user_checkname ( $username );
		// uc检测用户
		if ($res == - 3) {
			$model = M ( 'member' );
			$map ['username'] = $username;
			$map ['user_status'] = "0";
			$user = $model->where ( $map )->find ();
			if (! $user) {
				$this->error ( '对不起,你要充值的用户名不存在或该用户已被锁定!系统发生异常.请联系平台管理员' );
			}
			$st = $model->where ( $map )->setInc ( 'money', $money ); // 用户的积分加3
			$et = $model->where ( $map )->setInc ( 'point', $money * 10 ); // 用户的积分加3
			if (! $st || ! $et) {
				$this->error ( '系统发生异常，可能未充值完成,请联系31wan. 出错信息：' . mysql_error () );
			} else {
				$arr = "为用户" . $username . '充值了' . $money . '平台币';
				parent::admin_log ( $arr );
				$admin_pay = M ( 'admin_pay' );
				$map1 ['op_username'] = $_SESSION ['user'];
				$map1 ['uid'] = $user ['uid'];
				$map1 ['username'] = $user ['username'];
				$map1 ['ip'] = get_client_ip ();
				$map1 ['add_time'] = time ();
				$map1 ['remark'] = trim ( $_POST ['remark'] );
				$map1 ['real_money'] = $money;
				$admin_pay->data ( $map1 )->add ();
				$this->success ( '充值成功!系统已经记录你的操作!' );
			}
		} else {
			$this->error ( '对不起,你要充值的用户名不存在!' );
		}
	}
	/**
	 *
	 * @name 订单管理
	 */
	public function pay_order_manager() {
		if ($_POST) {
			$model = M ( 'pay_ok' );
			foreach ( $_POST ['aid'] as $id ) {
				$map ['id'] = $id;
				$model->where ( $map )->delete ();
			}
			$this->success ( '删除成功' );
		}
		import ( "ORG.Util.Page" );
		$model = D ( 'PayView' );
		$count = $model->count ();
		$page = new Page ( $count, 25 );
		$show = $page->show ();
		$list = $model->order ( 'id desc' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list );
		$this->assign ( 'page', $show ); // 赋值分页输出
		$this->display ( TMPL_PATH . $this->config . '/pay_order_manager.html' );
	}
	/**
	 *
	 * @name 后台充值管理
	 */
	public function admin_pay() {
		$admin_pay = M ( 'admin_pay' );
		import ( '@.ORG.Util.Page' );
		$username = $_REQUEST ['username'];
		$op_username = $_REQUEST ['op_username'];
		$this->assign ( 'username', $username );
		$this->assign ( 'op_username', $op_username );
		if ($username) {
			$username_str = " and username ='" . $username . "' ";
		}
		if ($op_username) {
			$op_username_str = " and op_username ='" . $op_username . "' ";
		}
		
		$count = $admin_pay->where ( " 1 " . $username_str . $op_username_str )->order ( 'id desc' )->count ();
		$p = new Page ( $count, 20 );
		$list = $admin_pay->where ( " 1 " . $username_str . $op_username_str )->order ( 'id desc' )->limit ( $p->firstRow . ',' . $p->listRows )->select ();
		
		$p->setConfig ( 'prev', '上一页' );
		$p->setConfig ( 'header', '区服' );
		$p->setConfig ( 'first', '首 页' );
		$p->setConfig ( 'last', '末 页' );
		$p->setConfig ( 'next', '下一页' );
		$p->setConfig ( 'theme', "%first%%upPage%%linkPage%%downPage%%end%
			<li><span><select name='select' onChange='javascript:window.location.href=(this.options[this.selectedIndex].value);'>%allPage%
     	 
</select></span></li>\n<li><span>共<font color='#009900'><b>%totalRow%</b></font>条记录 20篇/每页</span></li>" );
		$this->assign ( 'page', $p->show () );
		$this->assign ( 'list', $list );
		$money = $admin_pay->query ( "SELECT sum(real_money) as money FROM " . C ( 'DB_PREFIX' ) . "admin_pay WHERE 1" );
		
		$this->assign ( 'money', $money [0] ['money'] );
		
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/admin_pay.html' );
	}
} 