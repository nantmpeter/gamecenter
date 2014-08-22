<?php
     /**
      * @name 前台访问权限控制类
      * 
      * @access private
      * 
      * @todo 所有访问权限为private 都要继承自它
      * 
      * @author lostman $ (leefongyun@gmail.com)
      */
        Vendor('Ucenter.UcApi');
	    class CommonAction extends Action
		{
			protected  $userinfo,$game_log;
			final public function _initialize()
			{
				if(C('BLACK_LIST')=="on"){
				$map['ip'] = get_client_ip();
				$model = M('web_not_allow_ip');
				$st = $model->where($map)->find();
				if($st){
					header('HTTP/1.1 404 Not Found');
					header("status: 404 Not Found");
					exit();
				}}
				import('ORG.Util.Cookie');
				$model = M('webconfig');
				$profile = $model->where('id=1')->find();
		
		        if($profile['open']!="0")
		        {
		        	die($profile['close_notice']);
		        }
		    
		        if($_COOKIE['auth'])
		        {
		        	list ($uid,$username) = explode ("\t",uc_authcode($_COOKIE['auth'],'DECODE'));
		        	if($data = uc_get_user($username)) {
		        		list($uid, $username, $email) = $data;
		        	}
		        	if($uid==""||$username=="")
		        	{
		        	// 用户权限检查
		        	if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE'))))
		        	{
		        		import('ORG.Util.RBAC');
		        		if (!RBAC::AccessDecision()) {
		        			//检查认证识别号
		        		
		        			if (!$_SESSION [C('USER_AUTH_KEY')]) {
		        				//跳转到认证网关
		        				C('USER_AUTH_GATEWAY',U('accounts/login'));
		        				redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
		        			}
		        			// 没有权限 抛出错误
		        			if (C('RBAC_ERROR_PAGE')) {
		        				// 定义权限错误页面
		        				redirect(C('RBAC_ERROR_PAGE'));
		        			} else {
		        				if (C('GUEST_AUTH_ON')) {
		        					$this->assign('jumpUrl', PHP_FILE . C('USER_AUTH_GATEWAY'));
		        				}
		        				// 提示错误信息
		        				$this->error(L('_VALID_ACCESS_'));
		        			}
		        		}
		        	}
		        	}
		        	
		        	//读取用户信息
		        	$model = D('MemberView');
		        	$member_info = $model->where("member.uid={$uid}")->find();
		        	if(!$member_info){
		        		$add_member_info['uid'] = $uid;
		        		$add_member_info['username'] = $username;
		        		$add_member_info['email'] = $email;
		        		$add_member_info['point'] = 0;//初始积分0
		        		$return = $model->add($add_member_info);
		        		if($return > 0){
		        			$this->userinfo = $model->where("uid={$uid}")->find();
		        			$this->assign('userinfo',$this->userinfo);
		        		}
		        	}else{
		        		$this->userinfo = $member_info;
		        		$this->assign('userinfo',$this->userinfo);
		        	}
		        	
		        
		        }
		        else
		        { 
		        	unset($_SESSION);
		        	// 用户权限检查
		        	if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE'))))
		        	{
		        		import('admin.ORG.Util.RBAC');
		        		if (!RBAC::AccessDecision()) {
		        			//检查认证识别号
		        			if (!$_SESSION [C('USER_AUTH_KEY')]) {
		        				//跳转到认证网关
		        				$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		        				 
		        				redirect(C('USER_AUTH_GATEWAY').'?url='.$url);
		        			}
		        			// 没有权限 抛出错误
		        			if (C('RBAC_ERROR_PAGE')) {
		        				// 定义权限错误页面
		        				redirect(C('RBAC_ERROR_PAGE'));
		        			} else {
		        				if (C('GUEST_AUTH_ON')) {
		        					$this->assign('jumpUrl', PHP_FILE . C('USER_AUTH_GATEWAY'));
		        				}
		        				// 提示错误信息
		        				$this->error(L('_VALID_ACCESS_'));
		        			}
		        		}
		        	}
		        }
		        }
		        
		       
		      
			}
?>