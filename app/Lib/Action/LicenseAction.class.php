<?php
/**
 * @name 授权页面
*
* @access private
*
* @package app
*
* @author  31wan team
*/
class LicenseAction extends CommonAction{
	
	public function index(){
		$this->display(TMPL_PATH.'/default/license.html');
	}
	
	public function certificate(){
		$domain = $_GET['domain'];

		$authorization = M("authorization"); // 实例化authorization对象
		$info = $authorization->where("domain ='".$domain."'")->find();

		if(empty($info)){
			$this->error("域名未授权,请联系企业QQ:800030820！");
			die();
		}
		$this->assign('info',$info);
		$this->display(TMPL_PATH.'/default/certificate.html');
	}
	
	public function search(){
		$domain = $_GET['domain'];
		$authorization = M("authorization"); // 实例化authorization对象
		$info = $authorization->where("domain ='".$domain."'")->find();
		if(empty($info)){
			echo  "document.write('<a href='http://demo.31wan.cn/license/'>未授权</a>')";
		}else{
			echo "document.write('已授权')";
		}
	}
	
	
	
	
	
	
	
	
	
}

?>