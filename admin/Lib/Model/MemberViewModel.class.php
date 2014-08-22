<?php 
 
  class MemberViewModel extends ViewModel{ 	
  		public $viewFields  = array(
  				'member'=>array('uid','is_fcm','id_card','nickname','email','phone','money','point','user_status','username','_type'=>'LEFT'),
  				'member_extend_info'=>array('uid','grouping','realname','subsign','lastlogin_time','register_time','_on'=>'member.uid=member_extend_info.uid'),
  		);
  }
?>