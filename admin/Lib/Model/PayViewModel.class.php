<?php
    class PayViewModel extends ViewModel
    {
    		public $viewFields = array( 

    			  'pay_type' => array('payname'),
    			  
    			  'pay_ok' => array('id','orderid','pay_way_num','pay_really_money','gid','sid','pay_to_account','pay_tag','pay_port','pay_money','get_coin','pay_ip','pay_time','success_time','order_status','remark','game_status','_on'=>'pay_type.tag = pay_ok.pay_tag'),

    			  'game' => array('gamename','_on'=>'pay_ok.gid=game.gid'),
    			
    			  'server' => array('servername','_on'=>'pay_ok.sid = server.sid')
    	    );
    }
?>