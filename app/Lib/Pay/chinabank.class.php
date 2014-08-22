<?php 
    /**
     * @name 网银在线支付接口 for bank
     * 
     * @author lostman 
     * 
     * @version 1.0 
     * 
     * @access public 
     */
    class chinabank extends Think
    {
    	private $mid;
    	private $url;
        private $key = "72f304-3dbc-11e2-8137-00238be07319";//key
    	    	/**
    	 * @name 开始支付
    	 * @param array $arr
    	 * @return string
    	 */
    	public function BeginPay($arr){
    		
    		$v_mid = "22598246" ;//商户号，这里为测试商户号1001，替换为自己的商户号(老版商户号为4位或5位,新版为8位)即可
    		$this->mid = $v_mid;
    		$v_url = $arr['callurl'];//请填写返回url,地址应为绝对路径,带有http协议
    		$this->url = $v_url;
    		
    		##########获取信息#######
    		$data['url'] = $v_url;
    		$data['v_mid'] = $v_mid;
    		$data['order'] = $arr['orderid']; //订单
    		$data['amount'] = $arr['pay_money']; //充值金额 
    		$data['moneytype'] = "CNY";//人民bi
    		$text = $data['amount'].$data['moneytype'].$data['order'].$this->mid.$this->url.$this->key;
    		$data['mac'] = strtoupper(md5($text));
    		$data['remark1'] = $arr['pay_to_account'];
    		
    		return $data;
    	}
    	
    	/** 
    	 * @name 网银在线回调 (get post 通用)
    	 * @access public 
    	 * @return string
    	 */
    	public function CallBack($get = array(),$pay=array()){
    		
    		$v_oid     =trim($get['v_oid']);       // 商户发送的v_oid定单编号
    		$v_pmode   =trim($get['v_pmode']);    // 支付方式（字符串）
    		$v_pstatus =trim($get['v_pstatus']);   //  支付状态 ：20（支付成功）；30（支付失败）
    		$v_pstring =trim($get['v_pstring']);   // 支付结果信息 ： 支付完成（当v_pstatus=20时）；失败原因（当v_pstatus=30时,字符串）；
    		$v_amount  =trim($get['v_amount']);     // 订单实际支付金额
    		$v_moneytype  =trim($get['v_moneytype']); //订单实际支付币种
    		$remark1   =trim($get['remark1' ]);      //备注字段1
    		$remark2   =trim($get['remark2' ]);     //备注字段2
    		$v_md5str  =trim($get['v_md5str' ]);   //拼凑后的MD5校验值
    		$md5string=strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$this->key));
    		
    		if ($v_md5str==$md5string){//签名正确
    			if($v_pstatus=="20"){
    				//冲入游戏 or plf
				$model = M('pay_ok');
				$payorder = $model->where("orderid='{$get['orderid']}'")->find();
				//充值到平台
				if($payorder['pay_way_num']=="1"){
					$map['username'] = $pay['pay_to_account'];
			  	  	$model = M('member');
			  	  	//查询出费率
			  	  	$pay_type = M('pay_type');
			  	  	$pay_fee=$pay_type->where("tag ='".$payorder['pay_tag']."'")->find();
			  	  	if($pay_fee['fee'] !=''){
			  	  	$pay['pay_money'] = $pay['pay_money']*$pay_fee['fee']/100;
			  	  	}else{
			  	  	$pay['pay_money'] =$pay['pay_money'];
			  	  	}
			  	  	$model->where($map)->setInc('money',$pay['pay_money']);//冲入金钱
			  	  	$model->where($map)->setInc('point',$pay['pay_money'])*10;//增加积分
			  	  	$paymodel = M('pay_ok');
			  	  	$update['remark'] = "充值成功,充值到:平台币.充值金额:".$pay['pay_money']."元,获得积分:".$pay['pay_money']."分";
			  	  	$update['order_status'] = "2,2,2";
			  	  	$cond['orderid'] = $pay['orderid'];
			  	  	$flag =$paymodel->where($cond)->data($update)->save();
			  	  	return $flag;
				}else if($payorder['pay_way_num']=="0"){
					//直冲游戏
					
				}
    				
    			}else{
					echo "支付失败";
				}	
    		}else{
    			die('error');
    	}
    }
    }
 ?>
