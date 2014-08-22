<?php

    class ArticleAction extends CommonAction
	{
		public $config;
		public function __construct()
		{
			parent::_initialize();
			$this->config = C("ADMIN_THEME");
			parent::action_access(MODULE_NAME,ACTION_NAME);	
		}
		
	      public function article_index()
		  {
		  
		   $article = D('ArticleView');
			import('@.ORG.Util.Page');
			if(isset($_REQUEST['typeid'])&&$_REQUEST['typeid']!='')
			{
				$count = $article->where('article.typeid='.$_REQUEST['typeid'])->order('addtime desc')->count();
				$p = new Page($count,20); 
				$list = $article->where('article.typeid='.$_REQUEST['typeid'])->order('addtime desc')->limit($p->firstRow.','.$p->listRows)->select();
				$this->assign('typeid',$_REQUEST['typeid']);
			}
			elseif(isset($_REQUEST['status'])&&$_REQUEST['status']!='')
			{
				$count = $article->where('article.status='.$_REQUEST['status'])->order('addtime desc')->count();
				$p = new Page($count,20); 
				$list = $article->where('article.status='.$_REQUEST['status'])->order('addtime desc')->limit($p->firstRow.','.$p->listRows)->select();
				$this->assign('status',$_REQUEST['status']);
			}
		  elseif(isset($_REQUEST['title'])&&$_REQUEST['title']!='')
			{
				$count = $article->where("article.title like '%".trim($_REQUEST['title'])."%'")->order('addtime desc')->count();
				$p = new Page($count,20); 
				$list = $article->where("article.title like '%".trim($_REQUEST['title'])."%'")->order('addtime desc')->limit($p->firstRow.','.$p->listRows)->select();
				$this->assign('title',$_REQUEST['title']);

			}else
			{
				$count = $article->order('addtime desc')->count();
				$p = new Page($count,20); 
				$list = $article->order('addtime desc')->limit($p->firstRow.','.$p->listRows)->select();
			}
			$p->setConfig('prev','上一页');
			$p->setConfig('header','篇文章');
			$p->setConfig('first','首 页');
			$p->setConfig('last','末 页');
			$p->setConfig('next','下一页');
			$p->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%
			<li><span><select name='select' onChange='javascript:window.location.href=(this.options[this.selectedIndex].value);'>%allPage%</select></span></li>\n<li><span>共<font color='#009900'><b>%totalRow%</b></font>篇文章 20篇/每页</span></li>");
			$this->assign('page',$p->show());
			$this->assign('list',$list);
			$this->moveop();//文章编辑option
			$this->jumpop();//快速跳转option
			$this->urlmode();
			
			$type = M('category');
			//获取栏目option
			$list = $type->select();
			import("@.ORG.Util.Category");
			$cat=new Category(array('typeid','fid','typename','cname'));
			$s=$cat->getTree($list);//获取分类数据树结构
			
			$this->assign('option',$s);
			$this->display(TMPL_PATH.C('ADMIN_THEME').'/article_index.html');
		}
	    public function add()
		{
		   $this->addop();
		  $this->display(TMPL_PATH.C('ADMIN_THEME').'/article_add.html');
		}
	    private function addop(){
		$type = M('category');
		//获取栏目option
		$list = $type->select();
		import("@.ORG.Util.Category"); 
		$cat=new Category(array('typeid','fid','typename','cname'));
		$s=$cat->getTree($list);//获取分类数据树结构
		
		$this->assign('option',$s);
	    }
		public function doadd()
		
		{
			$log_str = '文章发布';
			parent::admin_log ( $log_str );
           if($_POST)
           {
              if($_POST['content']==""||$_POST['typeid']==""||$_POST['title']=="")
              {
			     $this->error("请把文章填写完整!");
			  }			  
		      $view = M("article");
			  $data['title'] = $_POST['title'];
			  if($_POST['titlecorlor']=="")
			  {
			     $data['titlecorlor'] = "black";
			  }
			  else
			  {
			  $data['titlecorlor'] = $_POST['titlecorlor'];
			  }
			  $data['author'] = $_POST['author'];
			  $data['tags'] = $_POST['tags'];
			  $data['description'] = $_POST['description'];
			  $data['from'] = $_POST['from'];
			  $data['redirect'] = $_POST['redirect'];
			  if($_POST['addtime']=="")
			  {
			     $data['addtime'] = time();
			  }
			  else
			  {
			     $data['addtime'] = strtotime($_POST['addtime']);
			  }
			  $data['imgurl'] = getimg($_POST['content']);
			  if($_POST['ishot']!=null)
			  {
			    $data['ishot'] = $_POST['ishot'];
			  }
			  $data['content'] = $_POST['content'];
			  $data['hits'] = $_POST['hits'];
			  $data['typeid'] = $_POST['typeid'];
			  if($_POST['isflash']!=null)
			  {
			     $data['isflash'] = $_POST['isflash'];
			  }
			  if($_POST['istop']!=null)
			  {
			     $data['istop'] = $_POST['istop'];
			  }
			  $st = $view->data($data)->add();
			  if($st)
			  {
			     $this->success("文章发布成功!",U('Article/article_index'));
			  }
			  else
			  {
			     $this->error("发生错误:".mysql_error());
			  }
		   }
           else
           {
		      $this->error("Request Error");
		   }		
 		}
   public function edit()
    {
    	
		$type = M('article');
		$list = $type->where('aid='.$_GET['aid'])->find();
		$this->assign('list',$list);
		$this->editop();//文章编辑option
		$this->jumpop();//快速跳转option
		$this->vote($list['voteid']);
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/article_edit.html');
    }
	
	
	public function doedit()
    {	
    	$log_str = '文章修改';
    	parent::admin_log ( $log_str );
		if(empty($_POST['title']))
		{
			$this->error("标题不能为空!");
		}
		if(empty($_POST['typeid']))
		{
			$this->error("请选择栏目!");
			
		}
		if(isset($_POST['imgurl']))
		{
			$data['imgurl'] = trim($_POST['imgurl']);
		}
		if(!empty($_POST['TitleFontColor']))
		{
			$data['titlecolor'] = trim($_POST['TitleFontColor']);
		}
		$data['aid'] = $_POST['aid'];
		$map['aid'] = $_POST['aid'];
		$data['redirect'] = $_POST['redirect'];
		if($_POST['voteid']!="")
		{
		$data['voteid'] = $_POST['voteid'];
		}
		$data['content'] = stripslashes($_POST['content']);
		$data['title'] = trim($_POST['title']);
		$data['hits'] = trim($_POST['hits']);
		$data['typeid'] = trim($_POST['typeid']);
		$data['addtime'] = strtotime($_POST['addtime']);
		$data['author'] = $_POST['author'];
		$data['tags'] = $_POST['tags'];
		$data['description'] = $_POST['description'];
		$data['from'] = $_POST['from'];
		$data['isflash'] = $_POST['isflash'];
		$data['ishot'] = $_POST['ishot'];
		$article = M('article');
		if($article->where($map)->save($data))
		{
			$this->error('操作成功!',U('Article/article_index'));
		}
		 
		$this->error('操作失败!,please contcat administrator'.mysql_error());

       }
	 public function del()
    {
    	$log_str = '文章删除';
    	parent::admin_log ( $log_str );
		$article=D('article');
		if($article->delete($_REQUEST['aid']))
		{
		 $this->error('操作成功!',U('Article/article_index')); 
		}
		$this->error('操作失败!');
    }
	
	public function status(){
		$a = M('article');
		if($_GET['status'] == 0)
		{
			$a->where( 'aid='.$_GET['aid'] )-> setField( 'status',1);
		}
		elseif($_GET['status'] == 1)
		{
			$a->where( 'aid='.$_GET['aid'] )-> setField( 'status',0);
		}
		else
		{
			$this->error('非法操作');
		}
		$this->redirect('article_index');
	}


	public function delall(){

		$log_str = '文章批量删除';
		parent::admin_log ( $log_str );
		$aid = $_REQUEST['aid'];  //获取文章aid
		$aids = implode(',',$aid);//批量获取aid
		$id = is_array($aid) ? $aids : $aid;
		$map['aid'] = array('in',$id);
		if(!$aid)
		{
			$this->error('请勾选记录!');
		}
		$article = D('article');
		
		if($_REQUEST['Del'] == '更新时间')
		{
			$data['addtime'] = date('Y-m-d H:i:s');
			if($article->where($map)->save($data))
			{
				$this->error('操作成功!',U('Article/article_index'));
			}
			$this->error('操作失败!');
		}
		
		if($_REQUEST['Del'] == '删除')
		{
			foreach($aid as $v)
			{
				$article->delete($v);
			}
			$this->error('操作成功!',U('Article/article_index'));
		}
		
		if($_REQUEST['Del'] == '批量未审')
		{
			$data['status'] = 1;
			if($article->where($map)->save($data))
			{
				$this->error('操作成功!',U('Article/article_index'));
			}
			$this->error('操作失败!');
		}
		
		if($_REQUEST['Del'] == '批量审核')
		{
			$data['status'] = 0;
			if($article->where($map)->save($data))
			{
				$this->error('操作成功!',U('Article/article_index'));
			}
			$this->error('操作失败!');
		}
		
		if($_REQUEST['Del'] == '推荐')
		{
			$data['ishot'] = 1;
			if($article->where($map)->save($data))
			{
				$this->error('操作成功!',U('Article/article_index'));
			}
			$this->error('操作失败!');
		}
		
		if($_REQUEST['Del'] == '解除推荐')
		{
			$data['ishot'] = 0;
			if($article->where($map)->save($data)){
				$this->error('操作成功!',U('Article/article_index'));
			}
			$this->error('操作失败!');
		}
		
		if($_REQUEST['Del'] == '固顶')
		{
			$data['istop'] = 1;
			if($article->where($map)->save($data))
			{
				$this->error('操作成功!',U('Article/article_index'));
			}
			$this->error('操作失败!');
		}
		
		if($_REQUEST['Del'] == '解除固顶')
		{
			$data['istop']=0;
			if($article->where($map)->save($data))
			{
				$this->error('操作成功!',U('Article/article_index'));
			}
			$this->error('操作失败!');
		}

		if($_REQUEST['Del'] == '幻灯')
		{
			$data['isflash'] = 1;
			if($article->where($map)->save($data))
			{
				$this->error('操作成功!',U('Article/article_index'));
			}
			$this->error('操作失败!');
		}
		
		if($_REQUEST['Del'] == '解除幻灯')
		{
			$data['isflash']=0;
			if($article->where($map)->save($data))
			{
				$this->error('操作成功!',U('Article/article_index'));
			}
			$this->error('操作失败!');
		}
		
		if($_REQUEST['Del'] == '移动')
		{
			$data['typeid'] = $_REQUEST['typeid'];
			if($article->where($map)->save($data))
			{
				$this->error('操作成功!',U('Article/article_index'));
			}
			$this->error('操作失败!',1);
		}
	}
	
	//文章模块 批量移动option
	private function moveop()
	{
		$type = M('category');
		$oplist = $type->where('islink=0')->field("typeid,typename,fid,concat(path,'-',typeid) as bpath")->order('bpath')->select();
		foreach($oplist as $k=>$v)
		{
			if($v['fid'] == 0)
			{
				$count[$k] = '';
			}
			else
			{
				for($i = 0;$i < count(explode('-',$v['bpath'])) * 2;$i++)
				{
					$count[$k].='&nbsp;';
				}
			}
			$op.="<option value=\"{$v['typeid']}\">{$count[$k]}|-{$v['typename']}</option>";
		}
        $this->assign('op2',$op);
	}
	
	//文章模块 快速跳转栏目option
	private function jumpop()
	{
		$type = M('category');
		$oplist = $type->where('islink=0')->field("typeid,typename,fid,concat(path,'-',typeid) as bpath")->order('bpath')->select();
		foreach($oplist as $k=>$v)
		{
			if($v['fid'] == 0)
			{
				$count[$k]='';
			}
			else
			{
				for($i = 0;$i < count(explode('-',$v['bpath'])) * 2;$i++)
				{
					$count[$k].='&nbsp;';
				}
			}
			$op.="<option value=\"".U('Article/index?typeid='.$v['typeid'])."\">{$count[$k]}|-{$v['typename']}</option>";
		}
        $this->assign('op',$op);
	}
	
 
	
	//文章模块-编辑-栏目option
	public function editop()
	{
		$article = M('article');
		$a = $article->where('aid='.$_GET['aid'])->field('typeid')->find();
		$type = M('category');
	
		//获取栏目option
		$list = $type->select();
		import("@.ORG.Util.Category");
		$cat=new Category(array('typeid','fid','typename','cname'));
		$option=$cat->getTree($list);//获取分类数据树结构
		$this->assign('atypeid',$a);
		$this->assign('option',$option);
	}
	
	//投票模块:for add()
	private function vote($vid){
		$vote = M('vote');
		$vo = $vote->where('status=1')->getField('id,title');
		if($vid == 0)
		{
			$votehtml = '<option value=\"0\" selected>不投票</option>';
		}
		else
		{
			$votehtml = '<option value=\"0\">不投票</option>';
		}
		foreach($vo as $k=>$v)
		{
			if($k == $vid)
			{
				$votehtml.="<option value=\"{$k}\" selected>{$v}</option>";
			}
			else
			{
				$votehtml.="<option value=\"{$k}\">{$v}</option>";
			}
		}
		$this->assign('votehtml',$votehtml);
		unset($votehtml);
	}
	//评论模块也调用此方法
	public function urlmode()
	{
		$config = F('basic','','./Web/Conf/');
		switch($config['urlmode'])
		{
			case 0:
				$urlmode = 'index.php/';
				break;
			case 1:
				$urlmode = '';
				break;
			case 2:
				$urlmode = 'index.php?s=';
		}
		switch ($config['suffix'])
		{
			case 0:
				$suffix	= '.html';
				break;
			case 1:
				$suffix = '.htm';
				break;
			case 2:
				$suffix = '.shtml';
				break;
		}
		$this->assign('urlmode',$urlmode);
		$this->assign('suffix',$suffix);
		unset($config);
	}

	public function search()
	{
		$article = D('ArticleView');
		import('@.ORG.Util.Page');
		$map['title'] = array('like','%'.$_POST['keywords'].'%');
		$count = $article->where($map)->order('addtime desc')->count();
		$p = new Page($count,20); 
		$list = $article->where($map)->order('addtime desc')->limit($p->firstRow.','.$p->listRows)->select();
		$p->setConfig('prev','上一页');
		$p->setConfig('header','篇文章');
		$p->setConfig('first','首 页');
		$p->setConfig('last','末 页');
		$p->setConfig('next','下一页');
		$p->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%
		<li><span><select name='select' onChange='javascript:window.location.href=(this.options[this.selectedIndex].value);'>%allPage%</select></span></li>\n<li><span>共<font color='#009900'><b>%totalRow%</b></font>篇文章 20篇/每页</span></li>");
		$this->assign('page',$p->show());
		$this->assign('list',$list);
		$this->moveop();//文章编辑option
		$this->jumpop();//快速跳转option
		$this->urlmode();
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/article_index.html');
	}
	
	
	public function category_index()
	{
		import("@.ORG.Util.Category");
		$type = M('category');
		$article = M('article');
		$list = $type->order('typeid desc')->select();
		foreach($list as $k=>$v)
		{
			$list[$k]['count'] = count(explode('-',$v['bpath']));
			$list[$k]['total'] = $article->where('typeid='.$v['typeid'])->count();
		}
		$cat=new Category(array('typeid','fid','typename','cname'));
		$s=$cat->getTree($list);//获取分类数据树结构
		$this->assign('list',$s);
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/category_index.html');
			
	}
		
	public function category_add()
	{
		$type = M('category');
		//获取栏目option
		$list = $type->select();
		import("@.ORG.Util.Category");
		$cat=new Category(array('typeid','fid','typename','cname'));
		$s=$cat->getTree($list);//获取分类数据树结构
		$this->assign('list',$s);
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/category_add.html');
	}
		
	public function category_doadd()
	{
		$log_str = '栏目增加';
		parent::admin_log ( $log_str );
		if(empty($_POST['typename']))
		{
			$this->error('栏目名称不能为空!');
		}
	
		$type = D('Category');
	
		if($type->create())
		{
			if($type->add())
			{
				$this->success('操作成功!',U('Article/category_index'));
			}
			$this->error('操作失败!',1);
		}
		$this->error($type->getError());
	}
	
	public function category_edit()
	{
	
		$type = M('category');
		$list = $type->where('typeid='.$_GET['typeid'])->find();
		//获取栏目option

		$list1 = $type->select();
		import("@.ORG.Util.Category");
		$cat=new Category(array('typeid','fid','typename','cname'));
		$option=$cat->getTree($list1);//获取分类数据树结构
	    $this->assign('option',$option);	
		$this->assign('list',$list);
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/category_edit.html');
	
	}
		
	//执行编辑
	public function doedit_cat()
	{
		$log_str = '栏目修改';
		parent::admin_log ( $log_str );
		if(empty($_POST['typename']))
		{
			$this->error('栏目名称不能为空!');
		}
		$type = D('Category');
		$type->create();
		if($type->save())
		{
			$this->success('操作成功!',U('Article/category_index'));
		}
		$this->error('操作失败!');
	}
		
	//删除栏目&执行删除
	public function category_del()
	{
		$log_str = '栏目删除';
		parent::admin_log ( $log_str );
		$type = M('category');
		$article = M('article');
		if($type->where('fid='.$_REQUEST['typeid'])->select())
		{
			$this->error('请先删除子栏目!',U('Article/category_index'));
		}
		if($article->where('typeid='.$_REQUEST['typeid'])->select())
		{
			$this->error('请先清空栏目下文章!',U('Article/category_index'));
		}
		if($type->where('typeid='.$_REQUEST['typeid'])->delete())
		{
			$this->success('删除成功!',U('Article/category_index'));
		}
	}
	
	public function category_status()
	{
		$a = M('category');
		$s = explode("-",$_REQUEST['s']);
		if($s[1] == 0)
		{
			$a->where( 'typeid='.$_REQUEST['typeid'] )-> setField($s[0],1);
		}
		elseif($s[1] == 1)
		{
			$a->where( 'typeid='.$_REQUEST['typeid'] )-> setField($s[0],0);
		}
		else
		{
			$this->error('非法操作');
		}
		$this->redirect(U('Article/index'));
	}
	}

?>