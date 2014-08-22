<?php
     /**
      * @name 客服控制器
      * 
      * @access private 
      * 
      * @package app
      * 
      * @author 
      */
     class ServiceAction extends CommonAction
     {
     	 public $config;
     	 public $pc;
     	 public function __construct(){
     	 	parent::__construct();
     	 	$public = A('Public');
     	 	$this->pc = $public;
	     	$public->read_conf(); 
	     		$conn =M('category');
			  		$map['show'] = "0";
			  		$map['ismenu'] = "1";
			  		$list = $conn->where($map)->select();
			  		$model = M('game');
			  		$cond['isdisplay'] = "0";
			  		$lists = $model->where($cond)->order('addtime desc')->select();
			  		$this->assign('lists',$lists);
			  		//print_r($list);
			  		$this->assign('category',$list);
	     	$config = F('basic');
     	 	$this->config = $config;
     	 	$this->assign('config',$config);
     	 }
     	 public function index()
     	 {	 $this->pc->head();
     	 
            $this->display(TMPL_PATH.$this->config['THEME'].'/service.html');
            $this->pc->footer();
      	 }
     }