<?php
    /**
     * @name 系统主框架控制器
     * @author Administrator
     * @access private
     */
	class IndexAction extends CommonAction{
		
	    public function index()
	    { 
	    	PublicAction::read_conf();
	    	$data = F('basic');
	    	$list = parent::check_user_access();
	    	$slist['admin_path'] = C("ADMIN_PATH");
	    	$this->assign('list',$list);
	    	$this->assign('data',$data);
	    	$this->assign('slist',$slist);
	    	$this->display(TMPL_PATH.C("ADMIN_THEME").'/index.html');
	    }
	    
	}