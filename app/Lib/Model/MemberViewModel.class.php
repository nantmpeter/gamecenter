<?php
     /**
      * @name 用户信息模型
      */
	class MemberViewModel extends ViewModel
	{
		public $viewFields  = array(
			'member' =>array ('username','nickname','email','avatar','level','id_card','is_fcm','safe_a','safe_q','gender','phone','point','money','_type'=>'LEFT'),
			'member_extend_info' => array('register_time','register_ip','lastlogin_time','lastlogin_ip','max_error','realname','from_soical','total_channels','gid','sid','subsign','_on'=>'member.uid=member_extend_info.uid')
		);
	}