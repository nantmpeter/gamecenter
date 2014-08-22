<?php
    $global = require_once './res/config/config.inc.php';
    $basic = @include_once 'basic.php';
    $app =  array(
      'URL_CASE_INSENSITIVE' =>true,//URL不区分大小写
      '__TPL__'   =>__ROOT__.'/Web/Tpl',
      'URL_ROUTER_ON' => true,
      'COOKIE_PREFIX' => '',
      'URL_ROUTE_RULES' => array(
          'lists/:id' => 'Lists/index',
      	//  'hall' => array('Lists/index','id=1'),
       	//  'service' => array('Lists/index','id=5'),
      ),
    		'SESSION_AUTO_START'=>true,
    		'URL_CASE_INSENSITIVE' =>true,
    		'USER_AUTH_ON'              =>true,
    		'USER_AUTH_TYPE'			=>2,		// 默认认证类型 1 登录认证 2 实时认证
    		'USER_AUTH_KEY'             =>'authId',	// 用户认证SESSION标记
    		'ADMIN_AUTH_KEY'			=>'administrator',
    		'USER_AUTH_MODEL'           =>'Admin',	// 默认验证数据表模型
    		'AUTH_PWD_ENCODER'          =>'md5',	// 用户认证密码加密方式
    		'NOT_AUTH_MODULE'           =>'Public,Index,Article,Accounts,Open',	// 默认无需认证模块
    		'REQUIRE_AUTH_MODULE'       =>'Members,Card,Game',		// 默认需要认证模块
    		'NOT_AUTH_ACTION'           =>'register,usercheck',		// 默认无需认证操作
    		'USER_AUTH_GATEWAY'         =>  '/accounts/login',// 默认认证网关
    		
    		'REQUIRE_AUTH_ACTION'       =>'',		// 默认需要认证操作
    		'GUEST_AUTH_ON'             =>false,    // 是否开启游客授权访问
    		'GUEST_AUTH_ID'             =>0,        // 游客的用户ID
    );
    
    $newglobal = array_merge($global,$app);
    if($basic!="")
    {
    $newglobal_re = array_merge($newglobal,$basic); 
    return $newglobal_re; 
    }
    else
    {
    	return $newglobal;
    }
?>