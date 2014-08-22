<?php
   /**
    * @name 文章控制器
    * 
    * @author lostman 
    */
  class ArticleAction extends CommonAction{
  	public $config;
  	public $global;
  	public function __construct(){
  		parent::__construct();
  		$public = A('Public');
  		$this->global = $public;
  		$public->read_conf();
  		$config = F('basic');
  		$this->config = $config;
  		$this->assign('config',$config);
  		$conn =M('category');
	    $map['show'] = "0";
	    $map['ismenu'] = "1";
	    $list = $conn->where($map)->select();
	    $this->assign('category',$list);
  	}
  	public function index(){
  		import('@.ORG.Page');
  		$model = D('ArticleView');
  		$map['article.status'] = "0";
  		$count = $model->where($map)->count();
  		$Page = new Page($count,30);
  		$list = $model->where($map)->order('article.addtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
  		$show = $Page->show();
  		$this->assign('page',$show);
  		$this->assign('list1',$list);
  		$mode2 = M('game');
  		$cond['isdisplay'] = "0";
  		$lists = $mode2->where($cond)->order('addtime desc')->select();
  		$this->assign('lists',$lists);
  		$this->global->head();
  		$this->display(TMPL_PATH.$this->config['THEME'].'/news.html');
  		$this->global->footer();
  	}
  	
  	/**
  	 * @name 文章阅读
  	 */
  	public function read(){
  		$map['aid'] = $_GET['aid'];
  		$map['status'] = "0";
  		$model = M('article');
  		$info = $model->where($map)->find();

  		if(!$info){
  			$this->error('您查看的文章不存在或者已经被禁用.');
  		}else{
  			$this->assign('info',$info);
  			$model->where($map)->setInc('hits','1');
  			$this->global->head();
  			$this->display(TMPL_PATH.$this->config['THEME'].'/read.html');  
  			$this->global->footer();
  		}
  	}
  	/**
  	 * @name 列出分类下的所有文章
  	 */
  	public function category(){
  		import('@.ORG.Page');
  		$map['typeid'] = $_GET['t'];
  		$typename = htmlspecialchars($_GET['p']);
  		$this->assign('type',$typename);
  		$map['status'] = 0;
  		$model = M('article');
  		$count = $model->where($map)->count('aid');
  		$Page = new Page($count,30);
  		$list = $model->where($map)->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
  		$show = $Page->show();
  		$this->assign('list',$list);
  		$this->assign('page',$show);
  		$this->display(TMPL_PATH.$this->config['THEME'].'/category.html');
  	}
  }
  
?>