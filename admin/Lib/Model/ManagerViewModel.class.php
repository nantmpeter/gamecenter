<?php 
 
  class ManagerViewModel extends ViewModel{ 	
  		public $viewFields  = array(
  				'admin_role'=>array('rolename'),
  				'manager'=>array('uid','username','password','login_ip','os','login_time','login_count','status','email','_on'=>'admin_role.roleid=manager.roleid')			
  		);
  }
?>