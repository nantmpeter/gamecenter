<?php
/**
      * @name 全局配置控制器
      * 
      * @access private
      * 
      * @author lostman $ (leefongyun@gmail.com)
      */
class GlobalAction extends CommonAction {
	
	public $config;
	public function __construct()
	{
		parent::_initialize();
		$this->config = C("ADMIN_THEME");
		parent::action_access(MODULE_NAME,ACTION_NAME);
	
	}
	/**
	 * @name 角色权限设置
	 */
	public function role_priv(){
		import("@.ORG.Util.Category");
		$category_list = M('category_list');
		$list = $category_list->order('id asc')->select();
		$cat=new Category(array('id','fid','category','cname'));
		$s=$cat->getTree($list);//获取分类数据树结构
		$roleid = $_GET ['roleid'];
		$role_access = M('role_access');
		$list_role = $role_access->where('role_id = '.$roleid)->order('role_id asc')->select();
		//判断出是否选择
		foreach($s as $k=>$v){
		   foreach ($list_role as $kk=>$vv){
		   	  if($vv['access_id']==$v['id']){
		   	  	$s[$k]['flag'] = 1;
		   	  }
		   }
		}
		$log_str = '权限设置';
		parent::admin_log ( $log_str );
		if(isset($_POST['dosubmit'])) {
			$role_access->where('role_id = '.$_POST['roleid'])->delete (); // 删除数据
			foreach($_POST['menuid'] as $id =>$listorder) {
				$info = $category_list->where('id = '.$listorder)->find();
				//print_r($info);
				$conds['access_fid'] =  $info['fid'];
				$conds['access_id'] = $info['id'];
				$conds['module'] = $info['category'];
				$conds['access_name'] = $info['module_alias'];
				if($conds['access_fid']!=0){
					//子节点
					$cd['id'] = $conds['access_fid'];
					$category = $category_list->where($cd)->getField('category');
					$module = $category_list->where($cd)->getField('module_alias');
					$conds['parent_module_alias'] = $category;
					$conds['parent_module'] = $module;
				}else{
					$conds['parent_module_alias'] = $conds['module'];
				}
				$conds['role_id'] = $_POST['roleid'];
                $insert = $role_access->data($conds)->add();
					if(!$insert){
						die(mysql_error());
						//$this->error('添加失败'.mysql_error());
					}
					unset($conds);
			}
			$this->success('添加成功',U ( 'Global/role_list'));
			}

		$this->assign('list',$s);
		$this->assign('roleid',$roleid);
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/role_priv.html' );
		
	}
/**
 * @name 站点配置
 */
	public function siteconf() {
		$conn = M ( 'webconfig' );
		$arr ['id'] = '1';
		$info = $conn->where ( $arr )->find ();
		$this->assign ( 'info', $info );
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/siteconf.html' );
	}
	/**
	 * @name 保存站点icon
	 */
	public function save_icon() {		
		// 文件上传
		import ( "@.ORG.Net.UploadFile" );
		$upload = new UploadFile (); // 实例化上传类
		$upload->maxSize = 111024; // 设置附件上传大小
		$upload->allowExts = array (
				'jpg',
				'ico',
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
			$map ['favicon'] = 'http://'.$_SERVER['HTTP_HOST'].'/Public/Uploads/icon/'.$info ['0'] ['savename'];
			$conn = M ( 'webconfig' );
			$a ['id'] = '1';
			$conn->where ( $a )->save ( $map );
			$arr ['msg'] = '图标上传成功';
			die ( json_encode ( $arr ) );
		}
	}
	/**
	 * @name 保存站点lo
	 */
	public function save_logo() {		
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
			$map ['logo'] = 'http://'.$_SERVER['HTTP_HOST'].'/Public/Uploads/icon/'.$info ['0'] ['savename'];
			$conn = M ( 'webconfig' );
			$a ['id'] = '1';
			$conn->where ( $a )->save ( $map );
			$arr ['msg'] = 'logo上传成功';
			die ( json_encode ( $arr ) );
		}
	}
	/**
	 * @name 更新站点配置
	 */
	public function save_basic() {		
		$arr ['id'] = '1';
		$map ['sitename'] = trim ( $_POST ['sitename'] );
		$map ['sitename2'] = trim ( $_POST ['sitename2'] );
		$map ['domain'] = trim ( $_POST ['domain'] );
		$map ['keywords'] = trim ( $_POST ['keywords'] );
		$map ['descriptions'] = trim ( $_POST ['descriptions'] );
 		$map ['url_model'] = $_POST ['urlmode'];
		$map ['url_html_suffix'] = $_POST ['suffix'];
		$map ['open'] = $_POST ['open'];
		$map ['openreg'] = $_POST ['openreg'];
 		$map ['gzip'] = $_POST ['gzip'];
		
		$map ['uc_api'] = $_POST ['uc_api'];
		$map ['uc_password'] = $_POST ['uc_password'];
		$map ['uc_key'] = $_POST ['uc_key'];
		$map ['mail_password'] = $_POST ['mail_password'];
		$map ['mail_user'] = $_POST ['mail_user'];
		$map ['mail_from'] = $_POST ['mail_from'];
		$map ['mail_port'] = $_POST ['mail_port'];
		$map ['mail_server'] = $_POST ['mail_server'];
		$map ['appkey'] = $_POST ['appkey'];
		
		$map ['appid'] = $_POST ['appid'];
		$map ['social_login'] = $_POST ['social_login'];
		$map ['maxloginfailedtimes'] = $_POST ['maxloginfailedtimes'];
		$map ['max_error'] = $_POST ['max_error'];
		$map ['save_errorlog'] = $_POST ['save_errorlog'];
		$map ['save_uselog'] = $_POST ['save_uselog'];
		
		$conn = M ( 'webconfig' );
		$st = $conn->where ( $arr )->data ( $map )->save ();
		if ($st != "1") {
			$msg ['status'] = "0";
			$msg ['msg'] = '更新站点配置失败!';
			die ( json_encode ( $msg ) );
		} else {
			$msg ['status'] = "1";
			$msg ['msg'] = "更新站点配置成功!";
			die ( json_encode ( $msg ) );
		}
	}
	/**
	 * @name 管理员管理
	 */
	public function manager_list() {
		$conn = M ( 'manager' );
		$admin_role = M ( "admin_role" ); // 实例化admin_role对象
		import ( '@.ORG.Util.Page' );
		$count = $conn->order ( 'roleid desc' )->count ();
		$p = new Page ( $count, 20 );
		$list = $conn->order ( 'roleid desc' )->limit ( $p->firstRow . ',' . $p->listRows )->select ();
		$p->setConfig ( 'prev', '上一页' );
		$p->setConfig ( 'header', '区服' );
		$p->setConfig ( 'first', '首 页' );
		$p->setConfig ( 'last', '末 页' );
		$p->setConfig ( 'next', '下一页' );
		$p->setConfig ( 'theme', "%first%%upPage%%linkPage%%downPage%%end%
			<li><span><select name='select' onChange='javascript:window.location.href=(this.options[this.selectedIndex].value);'>%allPage%</select></span></li>\n<li><span>共<font color='#009900'><b>%totalRow%</b></font>篇文章 20篇/每页</span></li>" );
		$this->assign ( 'page', $p->show () );
		
		foreach ( $list as $k => $v ) {
			$infog = $admin_role->where ( "roleid = " . $v ['roleid'] )->find ();
			$list [$k] ['rolename'] = $infog ['rolename'];
		}
		$this->assign ( 'list', $list );
		$role_list = $admin_role->order ( 'roleid desc' )->select ();
		$this->assign ( 'role_list', $role_list );
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/manager_list.html' );
	}
	/**
	 * @name 增加角色
	 */
	public function manager_add() {	
		$log_str = '增加角色';
		parent::admin_log ( $log_str );
		$conn = M ( 'manager' );
		$admin_role = M ( "admin_role" ); // 实例化admin_role对象
		if ($_POST ['dosubmit']) {
			$map ['username'] = trim ( $_POST ['username'] );
		
			$map ['email'] = trim ( $_POST ['email'] );
			$map ['roleid'] = trim ( $_POST ['roleid'] );
			
			if (! preg_match ( "/^([a-zA-Z0-9]|[._]){5,22}$/", $map ['username'] )) {
				$this->error ( '您提交的数据有误:用户名非法,请检查您的输入!' );
			}
			if (strlen ( $_POST ['password'] ) < 6 || strlen ( $_POST ['password'] ) > 22 || $_POST ['password'] == "") {
				$this->error ( '您提交的数据有误:密码长度为6到22位的字符,请检查您的输入!' );
			}
			$map ['password'] = MD5(trim ( $_POST ['password']) );
			if (! preg_match ( "/\b(^(\S+@).+((\.com)|(\.net)|(\.org)|(\.info)|(\.edu)|(\.mil)|(\.gov)|(\.biz)|(\.ws)|(\.us)|(\.tv)|(\.cc)|(\..{2,2}))$)\b/", $map ['email'] )) {
				$this->error ( '您提交的数据有误:邮箱格式不正确,请检查您的输入!' );
			}
			
			$flag = $conn->where ( 'username=' . $map ['username'] )->getField ( 'rolename' );
			if ($flag) {
				$this->error ( "管理员已存在！" );
			}
			
			if ($conn->add($map)) {
				$this->success ( "管理员添加成功!", U ( 'Global/manager_list' ) );
			} else {
				$this->error ( "发生错误:" . mysql_error (), U ( 'Global/manager_list' ) );
			}
		}
		$role_list = $admin_role->order ( 'roleid desc' )->select ();
		$this->assign ( 'role_list', $role_list );
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/manager_add.html' );
	}
	/**
	 * @name 角色信息修改该
	 */
	public function manager_edit() {
		$log_str = '角色修改';
		parent::admin_log ( $log_str );
		$conn = M ( 'manager' );
		$admin_role = M ( "admin_role" ); // 实例化admin_role对象
		$arr ['uid'] = $_GET ['uid'];
		$info = $conn->where ( $arr )->find ();
		$this->assign ( 'info', $info );

		$this->assign ( 'uid', $arr ['uid'] );
		if ($_POST ['dosubmit']) {

			if($_POST ['password']){
			$map ['password'] = md5(trim($_POST ['password']));
			}
			$map ['email'] = trim ( $_POST ['email'] );
			$map ['status'] = trim ( $_POST ['status'] );
			$map ['roleid'] = trim ( $_POST ['roleid'] );
			$arr1 ['uid'] = $_POST ['uid'];
			$st = $conn->where ( $arr1 )->save ( $map ); // 根据条件保存修改的数据
			if ($st) {
				$this->success ( "修改成功!", U ( 'Global/manager_list' ) );
			} else {
				$this->error ( "发生错误:" . mysql_error (), U ( 'Global/manager_list' ) );
			}
		}
		$role_list = $admin_role->order ( 'roleid desc' )->select ();
		$this->assign ( 'role_list', $role_list );
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/manager_edit.html' );
	}
	/**
	 * @name 删除管理员
	 */
	public function manager_delete() {
		$log_str = '删除管理员';
		parent::admin_log ( $log_str );
		$uid = $_REQUEST ['uid'];
		$uids = implode ( ',', $uid ); // 批量获取gid
		$id = is_array ( $uid ) ? $uids : $uid;
		if($id=="1"){
			if($_SESSION['user']!="admin"){
				$this->error('不能删除管理员账户,您没有权限');
			}
					
		}
		$map ['uid'] = array (
				'in',
				$id 
		);
		if (! $uid) {
			$this->error ( '请勾选记录!', 1 );
		}
		$manager = M ( "manager" ); // 实例化game对象
		$flag = $manager->where ( $map )->delete (); // 删除数据
		if ($flag) {
			$this->success ( "管理员删除成功!", U ( 'Global/manager_list' ) );
		} else {
			$this->error ( "发生错误:" . mysql_error (), U ( 'Global/manager_list' ) );
		}
	}
	/**
	 * @name 角色管理
	 */
	public function role_list() {
 		$admin_role = M ( "admin_role" ); // 实例化admin_role对象
		import ( '@.ORG.Util.Page' );
		$count = $admin_role->order ( 'roleid desc' )->count ();
		$p = new Page ( $count, 20 );
		$list = $admin_role->order ( 'roleid desc' )->limit ( $p->firstRow . ',' . $p->listRows )->select ();
		$p->setConfig ( 'prev', '上一页' );
		$p->setConfig ( 'header', '区服' );
		$p->setConfig ( 'first', '首 页' );
		$p->setConfig ( 'last', '末 页' );
		$p->setConfig ( 'next', '下一页' );
		$p->setConfig ( 'theme', "%first%%upPage%%linkPage%%downPage%%end%
			<li><span><select name='select' onChange='javascript:window.location.href=(this.options[this.selectedIndex].value);'>%allPage%</select></span></li>\n<li><span>共<font color='#009900'><b>%totalRow%</b></font>篇文章 20篇/每页</span></li>" );
		$this->assign ( 'page', $p->show () );
		$this->assign ( 'list', $list );
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/role_list.html' );
	}
/**
 * @name 增加角色
 */
	public function role_add() {
		$log_str = '增加角色';
		parent::admin_log ( $log_str );
		if ($_POST ['dosubmit']) {
			$map ['rolename'] = trim ( $_POST ['rolename'] );
			$map ['description'] = trim ( $_POST ['description'] );
			$map ['disabled'] = trim ( $_POST ['disabled'] );
			
			$admin_role = M ( "admin_role" ); // 实例化admin_role对象
			$flag = $admin_role->where ( 'rolename=' . $map ['rolename'] )->getField ( 'rolename' );
			if ($flag) {
				$this->error ( "角色已存在！" );
			}
			if ($admin_role->add ( $map )) {
				$this->success ( "角色添加成功!", U ( 'Global/role_list' ) );
			} else {
				$this->error ( "发生错误:" . mysql_error (), U ( 'Global/role_list' ) );
			}
		}
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/role_add.html' );
	}
	/**
	 * @name 角色信息修改
	 */
	public function role_edit() {
		$log_str = '角色修改';
		parent::admin_log ( $log_str );
		$conn = M ( 'admin_role' );
		$arr ['roleid'] = $_GET['roleid'];
		if($_GET['roleid']=="1"){
			if($_SESSION['group']!="超级管理员"){
				$this->error('您没有权限编辑超级管理员组');
			}
		}
		$info = $conn->where($arr)->find();
		$this->assign ( 'info', $info );
		$this->assign ( 'roleid', $arr ['roleid'] );
		 
		$model = M('category_list');
		$maps['fid'] = "0";
		$list = $model->where($maps)->select();
		$this->assign('list',$list);
 		if ($_POST ['dosubmit']) {
			
			$map ['disabled'] = trim ( $_POST ['disabled'] );
			$map ['description'] = trim ( $_POST ['description'] );
			$arr1 ['roleid'] = trim ( $_POST ['roleid'] );
			$st = $conn->where ( $arr1 )->save ( $map ); // 根据条件保存修改的数据
			if ($st) {
				$this->success ( "修改成功!", U ( 'Global/role_list' ) );
			} else {
				$this->error ( "发生错误:" . mysql_error (), U ( 'Global/role_list' ) );
			}
		}
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/role_edit.html' );
	}
	/**
	 * @name 删除角色
	 */
	public function role_delete() {
		$log_str = '删除角色';
		parent::admin_log ( $log_str );
		$roleid = $_REQUEST ['roleid'];
		$roleids = implode ( ',', $roleid ); // 批量获取gid

		$id = is_array ( $roleid ) ? $roleids : $roleid;
		if($id=="1"){
			if($_SESSION['user']!="admin"){
				$this->error('您没有权限删除超级管理员组');
			}
		}
		$map ['roleid'] = array (
				'in',
				$id 
		);
		if (! $roleid) {
			$this->error ( '请勾选记录!', 1 );
		}
		$admin_role = M ( "admin_role" ); // 实例化game对象
		$flag = $admin_role->where ( $map )->delete (); // 删除数据
		if ($flag) {
			$this->success ( "角色删除成功!", U ( 'Global/role_list' ) );
		} else {
			$this->error ( "发生错误:" . mysql_error (), U ( 'Global/role_list' ) );
		}
	}

	
	
	
}
?>