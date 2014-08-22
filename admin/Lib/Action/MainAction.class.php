<?php
    /**
     * @name 管理系统主控制面板
     */
     class MainAction extends CommonAction
     {
     	 public function index()
     	 {
	    	$this->display(TMPL_PATH.C("ADMIN_THEME").'/main.html');
     	 }
     	 
     	 public function welcome()
     	 {
     	 	
     	 	$str = explode('.',$_SERVER['SERVER_NAME']);
     	 	$domain = $str[1].'.'.$str[2];
     	 	$this->assign('domain',$domain);
     	 	$conn = M("manager");
     	 	$map['username'] = $_SESSION['user'];
     	 	$array['time'] = $conn->where($map)->getField("login_time");
     	 	$array['ip'] = $conn->where($map)->getField("login_ip");
       	 	$this->assign('info',$array);
     	 	$this->display(TMPL_PATH.C("ADMIN_THEME").'/welcome.html');
     	 }
     	 
     }
?>