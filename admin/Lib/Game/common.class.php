<?php 
    /**
     * @name 125wan登录充值接口
     * 
     * @author 31wan team 
     * 
     * @version 1.0 
     * 
     * @access public 
     */
    class common extends Think
    {     	
     	public function BeginLogin($arr)
     	{
     	/* 	username
     		玩家通行证[int/varchar(20)]
     		例:abcdef
     		time
     		当前时间戳[int]
     		icard
     		防沉迷信息[int]
     		例:0:未加入防沉迷,1:已加入大于18,2:已加入小于18
     		gameid
     		游戏编号[int]
     		例:1
     		serverid
     		区服编号[int]
     		例:101
     		fromid
     		为合作网站分配的渠道ID[int]
     		例: 8888
     		key
     		加密认证串[varchar(32)]
     		方法一[+为连接符,不参与加密] md5($username+$icard+$gameid+$serverid+$time+$fromid+$basekey) */
     		$username = $arr['username'];
			$time =time();
			$icard = 1;
			$gameid = $arr['gameid'];
			$serverid = $arr['serverid'];
			$fromid = $arr['p_id'];
			$loginkey = $arr['game_key'];
			//md5($username+$icard+$gamename+$serverid+$time+$fromid+$loginkey)
	   	    $str=md5($username.$icard.$gameid.$serverid.$time.$fromid.$loginkey);
		    $request='http://www.125wan.com/api/ms/login/?username='.$username.'&time='.$time.'&icard='.$icard.'&gameid='.$gameid.'&serverid='.$serverid.'&fromid='.$fromid.'&key='.$str;
		    return $request;
	   	  	
     	}
     	
     	
     	//根据订单号获取订单金额 然后结合费率算出实际充值到游戏的金额 (因为充值时已经充值到个人的账号 所以需要从用户账号减掉 同时更新订单状态（游戏充值状态）)
     	//order_id username gid sid money 
     	public function pay($arr)
     	{
     		
     		
     		
     		
     		return $request;
     	
     	}
    	
    	
    }