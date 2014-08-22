<?php
      /**
       * @name 系统RBAC权限验证 所有访问权限为 private 的控制器都要继承它
       * 
       * @author lostman $ (leefongyun@gmail.com) 
       * 
       * @todo RBAC
       */
Vendor('Ucenter.UcApi');

       class CommonAction extends Action
       {
       	   /**
       	    * @name 更新缓存
       	    */
       	   public function clear_cache(){
       	   	$st3 = unlink($_SERVER['DOCUMENT_ROOT'].'/app/Conf/basic.php');
       	   	$st4 = deldir($_SERVER['DOCUMENT_ROOT'].'/app/Runtime');
       	   	$st = deldir(RUNTIME_PATH);
       	   	$st2 = unlink(CONF_PATH.'/basic.php');
       	   	$admin = C('ADMIN_PATH');
       	   	$this->assign('jumpUrl',U('Main/welcome'));
       	   	$this->success('更新缓存成功!');   	
       	   }
	       	/**
	       	 * @@name 管理员日志记录
	       	 * @param array $arr
	       	 */
	       	public function  admin_log($arrs){
	       		$model = M('admin_exec_log');
	       		$arr['user'] = $_SESSION['user'];
	       		$arr['ip'] = get_client_ip();
	       		$arr['time'] = time();
	       		$arr['remark'] = $arrs;
	       		$model->data($arr)->add();
	       	}
       	 /**
       	  * 用户访问检测
       	  *
       	  */
       	   public function check_user_access(){
       	   	   $map['username'] = $_SESSION['user'];
       	   	   $model = M('manager');
       	   	   $cond['role_access.role_id'] = $model->where($map)->getField('roleid');
       	   	   $cond['role_access.access_fid'] = 0;
       	   	   $access = D('RbacView');
       	   	   $mylist = $access->where($cond)->order('category_list.listorder asc')->select();

       	   	   return $mylist;
            }
       	   public function _initialize()
       	   {
       	   	$map['ip'] = get_client_ip();
       	   	$model = M('web_not_allow_ip');
       	   	$st = $model->where($map)->find();
       	   	if($st){
       	   		header('HTTP/1.1 404 Not Found');
       	   		header("status: 404 Not Found");
       	   		exit();
       	   	}
       	   	import('@.ORG.Util.Cookie');
       	   	// 用户权限检查
       	   	if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
       	   		import('@.ORG.Util.RBAC');
       	   		if (!$_SESSION['user']) {
       	   			redirect(U('Public/login'));
       	   			unset($_SESSION['user']);
       	   		}
       	   	}
       	
       	   }
       	   /**
       	    * @name 检测用户操作权限
       	    */
       	   public function action_access($module_name,$action){

       	   	  $model = M('category_list');
       	   	  $arr['module_alias'] = $module_name;
       	   	  $info_1 = $model->where($arr)->find();
       	   	  $map['module_alias'] = $action;
       	   	  $map['fid'] = $info_1['id'];
       	   	  $info = $model->where($map)->find();
       	   	  $cond['access_id'] = $info['id'];
       	   	  $cond['role_id']  = $_SESSION['role_id'];
       	   	  $cond['access_fid']  = $info_1['id'];
       	   	  $role_access = M('role_access');
       	   	  $st = $role_access->where($cond)->select();
       	 
       	   	  if(!$st){
       	   	 
       	   	  		$this->error('未授权,非法访问.系统已经记录你的操作!');
       	   	 
       	   	  }//验证通过
       	   	  
       	   }
       }
?>