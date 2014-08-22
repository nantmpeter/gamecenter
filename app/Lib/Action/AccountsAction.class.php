<?php
/**
   * @name 用户管理模块
   * 
   * @author 31wan team
   * 
   * @access private
   * 
   * @package app
   */
Vendor ( 'Ucenter.UcApi' );
class AccountsAction extends Action {
	public function idcard_check() {
		if (! idcard_checksum18 ( $_GET ['id'] )) {
			$arr ['msg'] = '对不起，身份证号码校验错误!';
			$arr ['info'] = 'idcard';
			$arr ['state'] = '-1';
			die ( json_encode ( $arr ) );
		} else {
			$arr ['msg'] = '身份证号码校验正确!';
			$arr ['info'] = 'idcard';
			$arr ['state'] = '1';
			die ( json_encode ( $arr ) );
		}
	}
	public function realname_check() {
		$realname = $_GET ['real'];
		if (! isChineseName ( $realname )) {
			$arr ['msg'] = '对不起，真实姓名必须是中文!';
			$arr ['info'] = 'realname';
			$arr ['state'] = '-1';
			die ( json_encode ( $arr ) );
		} else {
			$arr ['msg'] = '真实姓名验证成功!';
			$arr ['info'] = 'realname';
			$arr ['state'] = '1';
			die ( json_encode ( $arr ) );
		}
	}
	public function nickname_check() {
		$model = M ( 'member' );
		$map ['nickname'] = $_GET ['n'];
		$st = $model->where ( $map )->select ();
		if (! $st) {
			$arr ['state'] = '1';
			$arr ['msg'] = '恭喜您，昵称可用!';
			$arr ['info'] = 'nickname';
			die ( json_encode ( $arr ) );
		} else {
			$arr ['state'] = '-2';
			$arr ['msg'] = '对不起，这个昵称已经有人用了哦!';
			$arr ['info'] = 'nickname';
			die ( json_encode ( $arr ) );
		}
	}
	public function email_check() {
		$e = $_GET ['e'];
		$ucresult = uc_user_checkemail ( $e );
		if ($ucresult > 0) {
			$arr ['msg'] = 'Email 格式正确!';
			$arr ['state'] = '1';
			$arr ['info'] = 'email';
			die ( json_encode ( $arr ) );
		} elseif ($ucresult == - 4) {
			$arr ['msg'] = 'Email 格式错误!';
			$arr ['state'] = '-4';
			$arr ['info'] = 'email';
			die ( json_encode ( $arr ) );
		} elseif ($ucresult == - 5) {
			$arr ['msg'] = '该Email 不允许注册!';
			$arr ['state'] = '-5';
			$arr ['info'] = 'email';
			die ( json_encode ( $arr ) );
		} elseif ($ucresult == - 6) {
			$arr ['msg'] = '该Email 已经被注册!';
			$arr ['state'] = '-6';
			$arr ['info'] = 'email';
			die ( json_encode ( $arr ) );
		}
	}
	public function username_check() {
		$t = $_GET ['u'];
		if (! preg_match ( "/^([a-zA-Z0-9]|[._]){5,22}$/", $t )) {
			$arr ['state'] = '-4';
			$arr ['result'] = 'fail';
			$arr ['msg'] = '对不起，用户名只能由字母和数组组成!';
			$arr ['info'] = 'username';
			die ( json_encode ( $arr ) );
		}
		// 检查用户名是否存在
		$ucresult = uc_user_checkname ( $t );
		if ($ucresult > 0) {
			$arr ['state'] = '1';
			$arr ['msg'] = '恭喜您，此用户名可以使用！';
			$arr ['info'] = 'username';
			$arr ['result'] = 'success';
			die ( json_encode ( $arr ) );
		} elseif ($ucresult == - 1) {
			$arr ['state'] = '-1';
			$arr ['result'] = 'err0004';
			$arr ['info'] = 'username';
			$arr ['msg'] = '用户名不合法!';
			die ( json_encode ( $arr ) );
		} elseif ($ucresult == - 2) {
			$arr ['state'] = '-2';
			$arr ['result'] = 'err0004';
			$arr ['info'] = 'username';
			$arr ['msg'] = '用户名包含不允许注册的词语!';
			die ( json_encode ( $arr ) );
		} elseif ($ucresult == - 3) {
			$arr ['state'] = '-3';
			$arr ['result'] = 'err0001';
			$arr ['info'] = 'username';
			$arr ['msg'] = '对不起,用户名已经存在!';
			die ( json_encode ( $arr ) );
		}
	}
	public function username_check1() {
		unset ( $_SESSION ['uid'] );
		unset ( $_SESSION ['member'] );
		cookie ( 'auth', '1' );
		$html = uc_user_synlogout ();
		$callback = isset ( $_GET ['jsonpCallback'] ) ? $_GET ['jsonpCallback'] : 'jsonpCallback';
	    $gid = htmlspecialchars($_GET['gid']);	
			//若sid、uid 丢失 获取相应最新的开服 uid默认为平台默认推广账号
	    $uid_1 = htmlspecialchars($_GET['uid']); //推广编号  查询出他的上级id
		$username = strtolower(trim(htmlspecialchars($_GET ['cn'])));
		$password = trim ( htmlspecialchars($_GET ['pwd']) );
		$domain = $this->getdomain($_SERVER['HTTP_HOST']);
		$email = $username.'@'.$domain;
		if (! preg_match ( "/^([a-zA-Z0-9]|[._]){5,22}$/", $username )) {
		$data = "{\"result\":\"err0003\"}";
		echo $callback . '(' . $data  . ')';die();
		}
		if (strlen ( $password ) < 6 || strlen ( $password ) > 22 || $password == "") {
				$data = "{\"result\":\"err0006\"}";
				echo $callback . '(' . $data  . ')';die();
			}
			// #### 接入UC #####
			$uid = uc_user_register($username,$password,$email);
			if ($uid <= 0) {
				if ($uid == - 1) {
					$data = "{\"result\":\"err0001\"}";
					echo $callback . '(' . $data  . ')';die();
				} elseif ($uid == - 2) {
					$data = "{\"result\":\"err0001\"}";
					echo $callback . '(' . $data  . ')';die();
				} elseif ($uid == - 3) {
					$data = "{\"result\":\"err0003\"}";
					echo $callback . '(' . $data  . ')';die();
				} elseif ($uid == - 4) {
				$data = "{\"result\":\"err0001\"}";
				echo $callback . '(' . $data  . ')';die();
				} elseif ($uid == - 5) {
					$data = "{\"result\":\"err0001\"}";
					echo $callback . '(' . $data  . ')';die();
				} elseif ($uid == - 6) {
				$data = "{\"result\":\"err0001\"}";
				echo $callback . '(' . $data  . ')';die();
				} else {
				$data = "{\"result\":\"err0001\"}";
				echo $callback . '(' . $data  . ')';die();
				}
			} else{		// 注册成功
				$userinfo ['username'] = $username;
				$userinfo ['nickname'] = $username;
				$userinfo ['email'] = $email;
				$userinfo ['point'] = "0";
				$userinfo ['id_card'] = '';
				$userinfo ['uid'] = $uid;
				$model = M ( 'member' );
				if ($model->add ($userinfo)) {
					
					$extend = M ( 'member_extend_info' );
					$extends_info ['uid'] = $uid;
					$extends_info ['register_time'] = time ();
					$extends_info ['register_ip'] = get_client_ip ();
					$extends_info ['lastlogin_time'] = time ();
					$extends_info ['lastlogin_ip'] = get_client_ip ();
					$extends_info ['realname'] = '';
					$extends_info ['from_soical'] = 'cps';
					$extends_info ['gid'] = $gid;
					$extends_info ['sid'] = htmlspecialchars($_GET['sid']);
					$smodel = M('server');
					 
				 	if($extends_info ['sid']){
						$extends_info ['sid'] = htmlspecialchars($_GET['sid']);
					}else{
						$s_info= $smodel->where("status = '0' and gid = ".$gid)->order('add_time desc')->select();
						$extends_info ['sid'] =$s_info[0]['sid'];
					} 
					
					//确保sid与gid是同一款游戏
					$s_info1= $smodel->where("sid = ".$extends_info ['sid'])->find();
					if($s_info1['gid']!=$extends_info ['gid']){
						$s_info= $smodel->where("status = '0' and gid = ".$gid)->order('add_time desc')->select();
						$extends_info ['sid'] =$s_info[0]['sid'];
					}
					
					
					$sid = $extends_info ['sid'];
					//推广链接本身就是一级公会链接
					if($uid_1){
						$info = $extend->where (' grouping = 1 and uid ='.$uid_1)->find ();
						if (empty($info)) {
							$extends_info ['sub_channels'] = '4';
							$extends_info ['total_channels'] = '4';
								
						}else{
							$extends_info ['sub_channels'] = $uid_1;
							if($info['subsign']=='0'){
								$extends_info ['total_channels'] = $uid_1;
							}else{
								$extends_info ['total_channels'] = $info['subsign'];
							}
							
						}
					}else{
						$extends_info ['sub_channels'] = '4';
						$extends_info ['total_channels'] = '4';
					}
					 $extend->add($extends_info);
					// 设置cookies
					setcookie ('auth', uc_authcode ( $uid . "\t" . $username, 'ENCODE' ), 0, C ( 'COOKIE_PATH' ), C ( 'COOKIE_DOMAIN' ), 0, false );
					setcookie ( 'name', $username, time () + 3600, "/" );
					/**
					 * **********************************
					*/
					// 防止本机注册
					import ( "@.ORG.Getmacaddr" );
					$mac = new GetMacAddr ( PHP_OS );
					$ip = get_client_ip ();
					$macaddr = $mac->mac_addr;
					setcookie ( "gameplf_anti_csrf", md5 ( $macaddr ), time () + 3600 * 24, "/" );
					setcookie ( "login_check_ip", md5 ( $ip ), time () + 3600 * 24, "/" );
						
					$ucsynlogin = uc_user_synlogin ( $uid );
					$_SESSION ['uid'] = $uid;
					$_SESSION ['member'] = $username;
					$ucsynlogin =str_replace('"', "'", $ucsynlogin);
					$data="{\"result\":\"success\",\"gid\":\"$gid\",\"fid\":\"$sid\",\"login\":\"$ucsynlogin\"}";
					echo $callback . '(' . $data  . ')';die();
					
					
				} else {
					$data = "{\"result\":\"err0001\"}";
					echo $callback . '(' . $data  . ')';die();
				}
					
			
			}
				
		
		
		
	}
	
	/**
	 *
	 * @name 登陆检测
	 */
	public function checklogin1() {
		$callback = isset ( $_GET ['jsonpCallback'] ) ? $_GET ['jsonpCallback'] : 'jsonpCallback';
		$username = trim ( htmlspecialchars($_GET ['cn']) );
		$password = trim ( htmlspecialchars($_GET ['pwd']) );
		$uid_1 = trim ( htmlspecialchars($_GET ['uid']));
		$sid = trim ( htmlspecialchars($_GET ['sid']) );
		$gid = trim ( htmlspecialchars($_GET ['gid']) );
	
		if ($username == "" || $password == "") {
				
			$data = "{\"result\":\"error\",\"msg\":\"请完善您的账号密码再进行登录!\"}";
	
			echo $callback . '(' . $data . ')';
		}
	
		// 判断该用户是否被锁定
		$member = M ( 'member' );
		$u_info = $member->where ( "username ='" . $username . "'" )->find ();
		if ($u_info ['user_status'] == '1') {
			$data = "{\"result\":\"error\",\"msg\":\"您的账户已被锁定，请联系客服!\"}";
			echo $callback . '(' . $data . ')';
		}
	
		list ( $uid, $username, $password, $email ) = uc_user_login ( $username, $password );
		if ($uid > 0) {
			// 记录成功日志
			// 设置cookies
			setcookie ( C ( 'COOKIE_PREFIX' ) . 'auth', uc_authcode ( $uid . "\t" . $username, 'ENCODE' ), 0, C ( 'COOKIE_PATH' ), C ( 'COOKIE_DOMAIN' ), 0, false );
			setcookie ( 'name', $username, time () + 3600, "/" );
			/**
			 * **********************************
			*/
			// 防止本机注册
			import ( "@.ORG.Getmacaddr" );
			$mac = new GetMacAddr ( PHP_OS );
			$ip = get_client_ip ();
			$macaddr = $mac->mac_addr;
			setcookie ( "gameplf_anti_csrf", md5 ( $macaddr ), time () + 3600 * 24, "/" );
			setcookie ( "login_check_ip", md5 ( $ip ), time () + 3600 * 24, "/" );
			/**
			 * **********************************
			*/
			// 同步登录
			$ucsynlogin = uc_user_synlogin ( $uid );
			$_SESSION ['uid'] = $uid;
			$_SESSION ['member'] = $username;
			$map ['lastlogin_ip'] = get_client_ip ();
			$map ['lastlogin_time'] = time ();
			$member = M ( "member_extend_info" ); // 实例化member_extend_info对象
			$member->where ( 'uid = ' . $uid )->save ( $map ); // 根据条件保存修改的数据
			$ucsynlogin =str_replace('"', "'", $ucsynlogin);
			$data="{\"result\":\"success\",\"gid\":\"$gid\",\"fid\":\"$sid\",\"login\":\"$ucsynlogin\"}";
			echo $callback . '(' . $data  . ')';die();
				
		} elseif ($uid == - 1) {
			$data = "{\"result\":\"error\",\"msg\":\"用户名不存在,或者被删除!\"}";
			echo $callback . '(' . $data . ')';
		} elseif ($uid == - 2) {
	
			$data = "{\"result\":\"error\",\"msg\":\"对不起,用户密码错误!\"}";
			echo $callback . '(' . $data . ')';
		} else {
			$data = "{\"result\":\"error\",\"msg\":\"未知错误,请重新登录!\"}";
			echo $callback . '(' . $data . ')';
		}
	}
	
public function username_check2() {
		$t = htmlspecialchars($_GET ['u']);
		$callback = isset ( $_GET ['jsonpCallback'] ) ? $_GET ['jsonpCallback'] : 'jsonpCallback';
		if (! preg_match ( "/^([a-zA-Z0-9]|[._]){5,22}$/", $t )) {
			$data = "{\"result\":\"error\",\"msg\":\"对不起，用户名只能由字母和数组组成!\"}";
			echo $callback . '(' . $data . ')';
				
		}
		// 检查用户名是否存在
		$ucresult = uc_user_checkname ( $t );
		if ($ucresult > 0) {
			$data = "{\"result\":\"success\",\"msg\":\"恭喜您，此用户名可以使用！\"}";
			echo $callback . '(' . $data . ')';
		} elseif ($ucresult == - 1) {
			$data = "{\"result\":\"error\",\"msg\":\"用户名不合法!\"}";
			echo $callback . '(' . $data . ')';
		} elseif ($ucresult == - 2) {
	
			$data = "{\"result\":\"error\",\"msg\":\"用户名包含不允许注册的词语!\"}";
			echo $callback . '(' . $data . ')';
		} elseif ($ucresult == - 3) {
	
			$data = "{\"result\":\"error\",\"msg\":\"对不起,用户名已经存在!\"}";
				
			echo $callback . '(' . $data . ')';
		}
	}
	
	public function register() {
		$public = A ( 'Public' );
		$public->read_conf ();
		$config = F ( 'basic' );
		if ($config ['OPENREG'] == "1") {
			$this->error ( '对不起.本站已经关闭注册' );
		}
		$conn = M ( 'category' );
		$maps ['show'] = "0";
		$maps ['ismenu'] = "1";
		$list = $conn->where ( $maps )->select ();
		$url = $_SERVER ['HTTP_REFERER'];
		$this->assign ( 'url', $url );
		$this->assign ( 'category', $list );
		$this->assign ( 'config', $config );
		
		$model = M ( 'game' );
		$cond ['isdisplay'] = "0";
		$lists = $model->where ( $cond )->order ( 'addtime desc' )->select ();
		$this->assign ( 'lists', $lists );
		$public->head ();
		$this->display ( TMPL_PATH . $config ['THEME'] . '/register.html' );
		$public->footer ();
	}
	/**
	 *
	 * @name 注册模块
	 * @todo 实现注册(整合UC)
	 */
	public function do_register() {
		// $verify_code = trim($_POST['verify_code']);
		$referer = $_POST ['referer'];
		/*
		 * if($_SESSION['verify'] != md5($verify_code)) {
		 * $this->error('您提交的数据有误:验证码错误'); }
		 */
		$username = trim ( $_POST ['username'] );
		$password = trim ( $_POST ['password'] );
		$email = trim ( $_POST ['email'] );
		$nickname = trim ( $_POST ['nickname'] );
		$truename = trim ( $_POST ['true_name'] );
		$idcard = trim ( $_POST ['idcard'] );
		
		if (! preg_match ( "/^([a-zA-Z0-9]|[._]){5,22}$/", $username )) {
			$this->error ( '您提交的数据有误:用户名非法,请检查您的输入!' );
		}
		if (strlen ( $password ) < 6 || strlen ( $password ) > 22 || $password == "") {
			$this->error ( '您提交的数据有误:密码长度为6到22位的字符,请检查您的输入!' );
		}
		if (! preg_match ( "/\b(^(\S+@).+((\.com)|(\.net)|(\.org)|(\.info)|(\.edu)|(\.mil)|(\.gov)|(\.biz)|(\.ws)|(\.us)|(\.tv)|(\.cc)|(\..{2,2}))$)\b/", $email )) {
			$this->error ( '您提交的数据有误:邮箱格式不正确,请检查您的输入!' );
		}
		if ($nickname == "" || strlen ( $nickname ) > 20) {
			$this->error ( '您提交的数据有误:昵称为空或者长度不正确,请检查您的输入!' );
		}
		if ($truename == "" || strlen ( $truename ) < 6 || strlen ( $truename ) > 12 || ! isChineseName ( $truename )) {
			$this->error ( '您提交的数据有误:真实名称不正确,请检查您的输入!' );
		}
		if ($idcard == "" || ! idcard_checksum18 ( $idcard )) {
			$this->error ( '您提交的数据有误:身份证号码不正确,请检查您的输入!' );
		}
		
		// #### 接入UC #####
		$uid = uc_user_register ( $username, $password, $email );
		if ($uid <= 0) {
			if ($uid == - 1) {
				$this->error ( '您提交的数据有误:用户名非法,请检查您的输入!' );
			} elseif ($uid == - 2) {
				$this->error ( '您提交的数据有误:用户名包含不允许注册的词语,请检查您的输入!' );
			} elseif ($uid == - 3) {
				$this->error ( '您提交的数据有误:用户名已经存在！,请检查您的输入!' );
			} elseif ($uid == - 4) {
				$this->error ( '您提交的数据有误:Email格式,请检查您的输入!' );
			} elseif ($uid == - 5) {
				$this->error ( '您提交的数据有误:您使用的Email不允许注册,请检查您的输入!' );
			} elseif ($uid == - 6) {
				$this->error ( '您提交的数据有误:您使用的Email已经被别人注册,请检查您的输入!' );
			} else {
				$this->error ( '您提交的数据有误:请检查您的输入!' );
			}
		} else 		// 注册成功
		{
			$userinfo ['username'] = $username;
			$userinfo ['nickname'] = $nickname;
			$userinfo ['email'] = $email;
			$userinfo ['point'] = "0";
			$userinfo ['id_card'] = $idcard;
			$userinfo ['uid'] = $uid;
			$model = M ( 'member' );
			$st = $model->data ( $userinfo )->add ();
			if (! $st) {
				$this->error ( '系统发生错误,请稍候重试' );
			} else {
				$extends_info ['uid'] = $uid;
				$extends_info ['register_time'] = time ();
				$extends_info ['register_ip'] = get_client_ip ();
				$extends_info ['lastlogin_time'] = time ();
				$extends_info ['lastlogin_ip'] = get_client_ip ();
				$extends_info ['realname'] = $truename;
				$extends_info ['from_soical'] = $referer;
				
				$extend = M ( 'member_extend_info' );
				$s = $extend->data ( $extends_info )->add ();
				if (! $s) {
					$this->error ( '系统发生错误,请稍候重试' );
				}
			}
			
			setcookie ( C ( 'COOKIE_PREFIX' ) . 'auth', uc_authcode ( $uid . "\t" . $username, 'ENCODE' ), 0, C ( 'COOKIE_PATH' ), C ( 'COOKIE_DOMAIN' ), 0, false );
			$ucsynlogin = uc_user_synlogin ( $uid );
			$_SESSION ['uid'] = $uid;
			$_SESSION ['member'] = $username;
			$this->success ( '注册成功,系统正在为你登陆中..' . $ucsynlogin, '/', '3' );
		}
	}
	public function loginout() {
		unset ( $_SESSION ['uid'] );
		unset ( $_SESSION ['member'] );
		cookie ( 'auth', '1' );
		$html = uc_user_synlogout ();
		$this->success ( '用户登出成功..' . $html, '/', '2' );
	}
	public function login() {

		$public = A ( 'Public' );
		$public->read_conf ();
		$config = F ( 'basic' );
		$conn = M ( 'category' );
		$maps ['show'] = "0";
		$maps ['ismenu'] = "1";
		$url = $_GET ['url'];
		if ($_GET ['server'] != "") {
			$server = '&server=' . $_GET ['server'];
			$url = $url . $server;
		}
		$this->assign ( 'url', $url );
		$list = $conn->where ( $maps )->select ();
		$this->assign ( 'category', $list );
		$this->assign ( 'config', $config );
		
		$model = M ( 'game' );
		$cond ['isdisplay'] = "0";
		$lists = $model->where ( $cond )->order ( 'addtime desc' )->select ();
		$this->assign ( 'lists', $lists );
		$public->head ();
		$this->display ( TMPL_PATH . $config ['THEME'] . '/login.html' );
		$public->footer ();
	}
	
	/**
	 *
	 * @name 忘记密码
	 */
	public function forget_password() {
		$public = A ( 'Public' );
		$public->read_conf ();
		$config = F ( 'basic' );
		$conn = M ( 'category' );
		$maps ['show'] = "0";
		$maps ['ismenu'] = "1";
		$url = $_GET ['url'];
		if ($_GET ['server'] != "") {
			$server = '&server=' . $_GET ['server'];
			$url = $url . $server;
		}
		$this->assign ( 'url', $url );
		$list = $conn->where ( $maps )->select ();
		$this->assign ( 'category', $list );
		$this->assign ( 'config', $config );
		if ($_POST ['submit']) {
			$username = trim ( $_POST ['username'] );
			// 检查用户名是否存在
			$ucresult = uc_user_checkname ( $username );
			if ($ucresult == '-3') {
				Header ( "Location: /accounts/forget_password_s?username=$username" );
			} else {
				Header ( "Location: /accounts/forget_password" );
			}
		}
		$model = M ( 'game' );
		$cond ['isdisplay'] = "0";
		$lists = $model->where ( $cond )->order ( 'addtime desc' )->select ();
		$this->assign ( 'lists', $lists );
		$public->head ();
		$this->display ( TMPL_PATH . $config ['THEME'] . '/pwd_1.html' );
		$public->footer ();
	}
	
	/**
	 *
	 * @name 忘记密码发送邮件
	 */
	public function forget_password_s() {
		$public = A ( 'Public' );
		$public->read_conf ();
		$config = F ( 'basic' );
		$conn = M ( 'category' );
		$maps ['show'] = "0";
		$maps ['ismenu'] = "1";
		$url = $_GET ['url'];
		if ($_GET ['server'] != "") {
			$server = '&server=' . $_GET ['server'];
			$url = $url . $server;
		}
		$this->assign ( 'url', $url );
		$list = $conn->where ( $maps )->select ();
		$this->assign ( 'category', $list );
		$this->assign ( 'config', $config );
		
		$model = M ( 'game' );
		$cond ['isdisplay'] = "0";
		$lists = $model->where ( $cond )->order ( 'addtime desc' )->select ();
		$this->assign ( 'lists', $lists );
		$username = $_GET ['username'];
		$ucresult = uc_user_checkname ( $username );
		if ($ucresult != '-3') {
			// Header("Location: /accounts/forget_password");
		}
		$this->assign ( 'username', $username );
		$member = M ( 'member' );
		$u_info = $member->where ( "username ='" . $username . "'" )->find ();
		$this->assign ( 'u_info', $u_info );
		$this->assign ( 'username', $username );
		if ($_POST ['submit']) {
			$email = trim ( $_POST ['t'] );
			$username = trim ( $_POST ['username'] );
			$public = A ( 'Public' );
			$reurl = $config ['DOMAIN'] . '/accounts/forget_password_t?vc=' . md5 ( md5 ( $username ) );
			$subject = "用户邮箱找回密码'";
			$body = "尊敬的网页游戏用户您好：
请点击以下地址找回您的密码," . $reurl . "
祝您游戏愉快！有任何问题可到我们官方网站联系";
			if ($public->think_send_mail ( $email, '平台系统信息', $subject, $body )) {
				$arr_i ['user_status'] = 1;
				$arr_i ['pwd_flag'] = md5 ( md5 ( $username ) );
				$member->where ( "username ='" . $username . "'" )->save ( $arr_i ); // 更新状态
				$this->success ( '已发送到您的邮箱，请去邮箱完成验证', '/' );
			} else {
				$this->error ( '发送失败 ，请联系客服', '/' );
			}
		}
		$public->head ();
		$this->display ( TMPL_PATH . $config ['THEME'] . '/pwd_s.html' );
		$public->footer ();
	}
	
	/**
	 *
	 * @name 忘记密码发送邮件
	 */
	public function forget_password_t() {
		$public = A ( 'Public' );
		$public->read_conf ();
		$config = F ( 'basic' );
		$conn = M ( 'category' );
		$maps ['show'] = "0";
		$maps ['ismenu'] = "1";
		$url = $_GET ['url'];
		if ($_GET ['server'] != "") {
			$server = '&server=' . $_GET ['server'];
			$url = $url . $server;
		}
		$this->assign ( 'url', $url );
		$list = $conn->where ( $maps )->select ();
		$this->assign ( 'category', $list );
		$this->assign ( 'config', $config );
		$model = M ( 'game' );
		$cond ['isdisplay'] = "0";
		$lists = $model->where ( $cond )->order ( 'addtime desc' )->select ();
		$this->assign ( 'lists', $lists );
		$username = $_GET ['vc'];
		$member = M ( 'member' );
		$u_info = $member->where ( "pwd_flag ='" . $username . "'" )->find ();
		if ($u_info ['pwd_flag'] == '') {
			$this->error ( '链接已失效！', '/' );
		}
		$this->assign ( 'u_info', $u_info );
		$public->head ();
		$this->display ( TMPL_PATH . $config ['THEME'] . '/pwd_t.html' );
		$public->footer ();
	}
	public function pwdreset() {
		if ($_POST ['submit']) {
			$passwd2 = trim ( $_POST ['passwd2'] );
			$passwd = trim ( $_POST ['passwd'] );
			if ($passwd != $passwd2) {
				$this->error ( '两次密码输入不正确' );
			}
			$username = trim ( $_POST ['username'] );
			$member = M ( 'member' );
			$u_info = $member->where ( "username ='" . $username . "'" )->find ();
			
			$flag = uc_user_edit ( $username, '', $passwd, $u_info ['email'], $ignoreoldpw = 1 );
			if ($flag == 1) {
				$arr_i ['user_status'] = 0;
				$arr_i ['pwd_flag'] = '';
				$member->where ( "username ='" . $username . "'" )->save ( $arr_i ); // 更新状态
				list ( $uid, $username, $password, $email ) = uc_user_login ( $username, $passwd );
				
				if ($uid > 0) {
					// 记录成功日志
					// 设置cookies
					setcookie ( C ( 'COOKIE_PREFIX' ) . 'auth', uc_authcode ( $uid . "\t" . $username, 'ENCODE' ), 0, C ( 'COOKIE_PATH' ), C ( 'COOKIE_DOMAIN' ), 0, false );
					/**
					 * **********************************
					 */
					// 防止本机注册
					import ( "@.ORG.Getmacaddr" );
					$mac = new GetMacAddr ( PHP_OS );
					$ip = get_client_ip ();
					$macaddr = $mac->mac_addr;
					setcookie ( "gameplf_anti_csrf", md5 ( $macaddr ), time () + 3600 * 24, "/" );
					setcookie ( "login_check_ip", md5 ( $ip ), time () + 3600 * 24, "/" );
					/**
					 * **********************************
					 */
					// 同步登录
					$ucsynlogin = uc_user_synlogin ( $uid );
					$_SESSION ['uid'] = $uid;
					$_SESSION ['member'] = $username;
					$member_extend_info = M ( "member_extend_info" ); // 实例化member_extend_info对象
					$map ['lastlogin_ip'] = get_client_ip ();
					$map ['lastlogin_time'] = time ();
					$member_extend_info->where ( 'uid = ' . $uid )->save ( $map ); // 根据条件保存修改的数据
				}
				$this->success ( '更改成功', '/' ); // 直接登录
			} else {
				$this->success ( '更改失败，请联系客服', '/' );
			}
		}
	}
	
	public function getdomain($url) {
		$host = strtolower ( $url );
		if (strpos ( $host, '/' ) !== false) {
			$parse = @parse_url ( $host );
			$host = $parse ['host'];
		}
		$topleveldomaindb = array (
				'com',
				'edu',
				'gov',
				'int',
				'mil',
				'net',
				'org',
				'biz',
				'info',
				'pro',
				'name',
				'museum',
				'coop',
				'aero',
				'xxx',
				'idv',
				'mobi',
				'cc',
				'me'
		);
		$str = '';
		foreach ( $topleveldomaindb as $v ) {
			$str .= ($str ? '|' : '') . $v;
		}
	
		$matchstr = "[^\.]+\.(?:(" . $str . ")|\w{2}|((" . $str . ")\.\w{2}))$";
		if (preg_match ( "/" . $matchstr . "/ies", $host, $matchs )) {
			$domain = $matchs ['0'];
		} else {
			$domain = $host;
		}
		return $domain;
	}
	/**
	 *
	 * @name 登陆检测
	 */
	public function checklogin() {
		$username = trim ( $_POST ['user_name'] );
		$password = trim ( $_POST ['user_pwd'] );
		$url = $_POST ['return'];
		if ($username == "" || $password == "") {
			$arr ['msg'] = '请完善您的账号密码再进行登录!';
			$arr ['state'] = '-6';
			$arr ['info'] = 'login';
			die ( json_encode ( $arr ) );
		}
		
	//判断该用户是否被锁定
		$member = M ( 'member' );
		$u_info = $member->where ( "username ='" . $username . "'" )->find ();
		if ($u_info['user_status']=='1') {
			$arr ['msg'] = '您的账户已被锁定，请联系客服！';
			$arr ['state'] = '-6';
			$arr ['info'] = 'login';
			die ( json_encode ( $arr ) );
		}
		
		list ( $uid, $username, $password, $email ) = uc_user_login ( $username, $password );
		if ($uid > 0) {
			
			
			//若是用户在uc中存在，在本程序中不存在则注册
			$u_info = $member->where ( "username ='" . $username . "'" )->find ();
			if(empty($u_info)){
			$userinfo ['username'] = $username;
			$userinfo ['nickname'] = $username;
			$userinfo ['email'] = $email;
			$userinfo ['point'] = "0";
			$userinfo ['id_card'] = '';
			$userinfo ['uid'] = $uid;
			$model = M ( 'member' );
			$st = $model->data ( $userinfo )->add ();
			if (! $st) {
				$this->error ( '系统发生错误,请稍候重试' );
			} else {
				$extends_info ['uid'] = $uid;
				$extends_info ['register_time'] = time ();
				$extends_info ['register_ip'] = get_client_ip ();
				$extends_info ['lastlogin_time'] = time ();
				$extends_info ['lastlogin_ip'] = get_client_ip ();
				$extends_info ['realname'] = '';
				$extends_info ['from_soical'] = 'uc';
			
				$extend = M ( 'member_extend_info' );
				$s = $extend->data ( $extends_info )->add ();
				if (! $s) {
					$this->error ( '系统发生错误,请稍候重试' );
				}
			}}
			
			
			// 记录成功日志
			// 设置cookies
			setcookie ( C ( 'COOKIE_PREFIX' ) . 'auth', uc_authcode ( $uid . "\t" . $username, 'ENCODE' ), 0, C ( 'COOKIE_PATH' ), C ( 'COOKIE_DOMAIN' ), 0, false );
			/**
			 * **********************************
			 */
			// 防止本机注册
			import ( "@.ORG.Getmacaddr" );
			$mac = new GetMacAddr ( PHP_OS );
			$ip = get_client_ip ();
			$macaddr = $mac->mac_addr;
			setcookie ( "gameplf_anti_csrf", md5 ( $macaddr ), time () + 3600 * 24, "/" );
			setcookie ( "login_check_ip", md5 ( $ip ), time () + 3600 * 24, "/" );
			/**
			 * **********************************
			 */
			// 同步登录
			$ucsynlogin = uc_user_synlogin ( $uid );

			$_SESSION ['uid'] = $uid;
			$_SESSION ['member'] = $username;
			
			$url = $_POST ['url'];
			if ($url == "") {
				$arr ['msg'] = '登陆成功,系统自动为你跳转到首页';
				$arr ['script'] = $ucsynlogin;
				$arr ['state'] = '1';
				$arr ['info'] = 'login';
				die ( json_encode ( $arr ) );
			} else {
				$member = M ( "member_extend_info" ); // 实例化member_extend_info对象
				$map ['lastlogin_ip'] = get_client_ip ();
				$map ['lastlogin_time'] = time ();
				$member = M ( "member_extend_info" ); // 实例化member_extend_info对象
				$member->where ( 'uid = ' . $uid )->save ( $map ); // 根据条件保存修改的数据
				
				$arr ['msg'] = '登陆成功,系统自动为你跳转到您登陆前的页面';
				$arr ['script'] = $ucsynlogin;
				$arr ['state'] = '1';
				$arr ['info'] = 'login';
				$arr ['returnu'] = $url;
				die ( json_encode ( $arr ) );
			}
		} elseif ($uid == - 1) {
			$arr ['msg'] = '用户名不存在,或者被删除!'.$uid;
			$arr ['state'] = '-1';
			$arr ['info'] = 'login';
			die ( json_encode ( $arr ) );
		} elseif ($uid == - 2) {
			$arr ['msg'] = '对不起,用户密码错误!';
			$arr ['state'] = '-2';
			$arr ['info'] = 'login';
			die ( json_encode ( $arr ) );
		} else {
			$arr ['msg'] = '未知错误,请重新登录!';
			$arr ['state'] = '-3';
			$arr ['info'] = 'login';
			die ( json_encode ( $arr ) );
		}
	}
}
?>