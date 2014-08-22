<?php
       /**
        * @name  系统公共控制器
        * 
        * @author lostman $(leefongyun@gmail.com)
        * 
        * @access public 
        * 
        */
      class PublicAction extends Action
      {
      	   public function id(){
      	   	echo ACTION_NAME;
       	   }
       	   /**
       	    * name 清楚角色权限
       	    */
       	   
       	   public function clear_flag(){
       	   	if($_SESSION['user']){
       	   	  $time = $_GET['time'];
       	   	  $map['role_id'] = $_GET['ps'];
       	   	  $model = M('role_access');
       	   	  $model->where($map)->delete();
       	   	  $arr['msg'] = "清除权限记录成功"; #清除角色权限#
       	   	  die(json_encode($arr));
       	   	}
       	   }
       	   /**
       	    * name 保存权限记录
       	    */
       	   public function save_flag(){
       	   	 foreach($_POST['access'] as $m){
       	   	 	$model = M('category_list');
       	   	 	$info = $model->where("module_alias = '$m'")->find();
       	   	 	$conds['access_fid'] =  $info['fid'];
       	   	 	$conds['access_id'] = $info['id'];
       	   	 	$conds['module'] = $info['category'];
       	   	 	$conds['access_name'] = $m;
       	   	 	if($conds['access_fid']!="0"){
       	   	 		//子节点
       	   	 		$cd['id'] = $conds['access_fid'];
       	   	 		$category = $model->where($cd)->getField('category');
       	   	 		$module = $model->where($cd)->getField('module_alias');
       	   	 		$conds['parent_module_alias'] = $category;
       	   	 		$conds['parent_module'] = $module;
       	   	 	}else{
       	   	 		$conds['parent_module_alias'] = $conds['module'];
       	   	 	}
       	   	 	$conds['role_id'] = $_POST['role_id'];
       	   	 	$model = M('role_access');
       	   	 	$st = $model->where($conds)->select();
       	   	 	if(!$st){
       	   	 		//可以添加
       	   	 		$insert = $model->data($conds)->add();
       	   	 		if(!$insert){
                        die(mysql_error());
       	   	 			//$this->error('添加失败'.mysql_error());
       	   	 		}
       	   	 	}
       	   	 }
       	   	 
       	   	 $this->success('添加成功');
       	   }
       	   /**
       	    * name 获得操作
       	    */
       	   public function get_option(){
       	   	if($_SESSION['user']){
       	   	$map['fid'] = $_GET['id'];
       	   	$model = M('category_list');
       	   	$list = $model->where($map)->order('id desc')->select();
       	   	foreach($list as $m=>$v){
       	   		echo "<input type='checkbox' name='access[]' value='".$v['module_alias']."'/>".$v['category'];
       	   	}
       	   	}
       	   }
	      	protected function write_conf()
	      	{
	      		    $conn = M("webconfig");
			  		$data_re = $conn->find();
 			  		F('basic',$data_re,CONF_PATH);
			  	 
	      	}
	      	public function read_conf()
	      	{
	      		if(!CONF_PATH."/basic.php")
	      		{
	      			self::write_conf();
	      		}
	      	}
	      	/**
	      	 * name 退出系统
	      	 */
      	   public function loginout()
      	   {
      	   	  if(isset($_SESSION['user']))
      	   	  {
      	   	  	 unset($_SESSION['user']);
      	   	  	 unset($_SESSION['group']);
      	   	  	 session_destroy();
      	   	  	 redirect("/admin");
      	   	  }
      	   	  redirect("/admin");
      	   }
      	   /**
      	    * 登陆
      	    */
      	   public function login()
      	   {
      	   	  self::read_conf();
      	   	  $data = F('basic');
      	   	  $this->assign('data',$data);
      	   	  $action = U('Public/checklogin');
      	   	  $this->assign('action',$action);
      	   	  $this->display(TMPL_PATH.C("ADMIN_THEME").'/login.html');
      	   }
      	  /**
      	   * name  检测登陆
      	   */
      	   public function checklogin()
      	   {
      	 
      	      import ( '@.ORG.Util.RBAC' );
      	   	  if($_POST['loginname']==""||$_POST['loginpwd']=="")
      	   	  {
      	   	  	 $this->error("用户名或者密码不能为空!");
      	   	  }
      	   	  $username = $_POST['loginname'];
      	   	  $password = md5($_POST['loginpwd']);
      	   	  $map['manager.username'] = $username;
      	   	  $conn = D('ManagerView');
      	   	  $userpass = $conn->where($map)->getField("password");
      	   	  $status = $conn->where($map)->getField("status");
      	   	  $uid = $conn->where($map)->getField("uid");
      	   	  if($uid!="1"){
      	   	  if($status!="0")
      	   	  {
      	   	  	$this->error("对不起,您的账号已经被禁用,请联系管理员");
      	   	  }}
      	   	  if($password!=$userpass)
      	   	  {
	      	   	  	$error = M("admin_login_error");
	      	   	  	$error_log['username'] = trim($_POST['loginname']);
	      	   	  	$error_log['password'] = trim($_POST['loginpwd']);
	      	   	  	$error_log['os'] = get_client_os();
	      	   	  	$error_log['time'] = time();
	      	   	  	$error_log['ip'] = get_client_ip();
	      	   	  	$error->data($error_log)->add();
      	   	  	    $this->error("登陆失败,请检查您的输入!");
      	   	  }else{
      	   	  	 $flag = $conn->where($map)->getField("roleid");
      	   	  	 
      	   	  	 $u_group = $conn->where($map)->getField("rolename");
      	   	  	 $_SESSION['user'] = $username;
      	   	  	 $_SESSION['role_id'] = $flag;
      	   	  	 $_SESSION['group'] = $u_group;
 
      	   	  	 
      	   	  	 if($username=='admin') {
      	   	  	 	$_SESSION['administrator']		=	true;
      	   	  	 }
      	   	  	 //保存登陆记录
      	   	  	 $log['login_ip'] = get_client_ip();
      	   	  	 $log['os'] = get_client_os();
      	   	  	 $log['login_time'] = time();
      	   	  	 $conn->where($map)->save($log);
      	   	  	 $conn->where($map)->setInc('login_count','1');
      	   	  	 RBAC::saveAccessList();
      	   	  	 $this->success('登陆成功,系统检测到您为'.$u_group.'  正在跳转...','/'.C('ADMIN_PATH'));
      	   	  }
      	   	  
      	   	  
      	   }
      }
?>