<?php
    
    class WeightAction extends CommonAction
    {
    	public $access;
    	public function __construct(){
    		parent::_initialize();
    		$this->access = $_GET['ac'];	
     	}
    	/**
    	 * @刷新用户有权限的表
    	 */
    	public function user_auth_list(){
    		$map['role_access.access_fid'] =  $this->access;
    		$map['role_access.role_id'] = $_SESSION['role_id'];
    		$map['category_list.hidden'] = "0";
    		$model = D('RoleView'); 
    		$data = $model->where($map)->order('category_list.listorder asc,category_list.id asc')->select();
    		if($data!=""){
    			$data['method'] = "child";
    		}
    		if($data==null){
    			$cond['fid'] = $map['access_fid'];
    			$cond['role_id'] = $_SESSION['role_id'];
    			$cond['hidden'] = "0";
    			$model = M('category_list');
    			$data = $model->where($cond)->order('listorder asc,id asc')->select();
    			$data['method'] = "root";
    			return $data;
    		}
    		
    		return $data;
    	}
    	public function weight_1()
    	{
    		$this->display(TMPL_PATH.C('ADMIN_THEME').'/weight_1.html');
    	}
    	public function index2()
    	{
    		$data = $this->user_auth_list();
    		
    		if($data['method']=="root"){
    			unset($data['method']);
    
    			$this->assign('data1',$data);
    		}else{
    			unset($data['method']);
    			$this->assign('data',$data);
    		}
    		
    		$this->display(TMPL_PATH.C('ADMIN_THEME').'/weight_'.$this->access.'.html');
     	}
    }
?>