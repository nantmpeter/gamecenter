<?php
     /**
      * @name 拓展模块
      * @author 31wan team
      * @access private
      */
   class OtherAction extends CommonAction
   {
   	   public $config;
   	   public function __construct(){
   	   	    parent::_initialize();
     	 	$this->config = C("ADMIN_THEME");
     	 	parent::action_access(MODULE_NAME,ACTION_NAME);


   	   }
   	   /**
   	    * @name 数据库备份
   	    */
	    public function index()
	    {
			$rs = new Model();
			$list = $rs->query("SHOW TABLES FROM "."`".C('DB_NAME')."`");
			$table = array();
	        foreach ($list as $k => $v)
			{
	            $table[$k] = current($v);
	        }
			$this->assign('tablelist',$table);
			$this->display(TMPL_PATH.$this->config.'/other_index.html');
		}
		/**
		 * @name 执行是上传数据库分卷备份
		 */
		
		public function dobackup(){
			if(empty($_POST['ids']))
			{

				$this->error('请选择需要备份的数据库表！',1);
			}
			$filesize = intval($_POST['filesize']);
			if ($filesize < 512)
			{
				$this->error('出错了,请为分卷大小设置一个大于512的整数值！',1);
			}
			$file =$_SERVER['DOCUMENT_ROOT'].'/Public/admin/bk/';
			$random = mt_rand(1000, 9999);
			$sql = '';
			$p = 1;
			foreach($_POST['ids'] as $table)
			{
				$rs = D(str_replace(C('db_prefix'),'',$table));
				$array = $rs->select();
				$sql.= "TRUNCATE TABLE `$table`;\n";
				foreach($array as $value)
				{
					$sql.= $this->insertsql($table, $value);
					if (strlen($sql) >= $filesize*1000)
					{
						$filename = $file.date('Ymd').'_'.$random.'_'.$p.'.sql';
						write_file($filename,$sql);
						$p++;
						$sql='';
					}
				}
			}
			if(!empty($sql))
			{
				$filename = $file.date('Ymd').'_'.$random.'_'.$p.'.sql';
				write_file($filename,$sql);
			}
		    $this->success('数据库分卷备份已完成,共分成'.$p.'个sql文件存放！',U("Other/restore"));
		}
		/**
		 * @name 插入数据库
		 * @access table 数据库表 row 插入行
		 */
		public function insertsql($table, $row)
		{
			$sql = "INSERT INTO `{$table}` VALUES (";
			$values = array();
			foreach ($row as $value)
			{
			$values[] = "'" . mysql_real_escape_string($value) . "'";
			}
			$sql .= implode(', ', $values) . ");\n";
			return $sql;
		}
		/**
		 * @name  还原数据
		 */
		public function restore()
		{
			$filepath = $_SERVER['DOCUMENT_ROOT'].'/Public/admin/bk/*.sql';
			$filearr = glob($filepath);

			if (!empty($filearr))
			{
				foreach($filearr as $k=>$sqlfile)
				{
					preg_match("/([0-9]{8}_[0-9a-z]{4}_)([0-9]+)\.sql/i",basename($sqlfile),$num);
					$restore[$k]['filename'] = basename($sqlfile);
					$restore[$k]['filesize'] = round(filesize($sqlfile)/(1024*1024), 2);
					$restore[$k]['maketime'] = date('Y-m-d H:i:s', filemtime($sqlfile));
					$restore[$k]['pre'] = $num[1];
					$restore[$k]['number'] = $num[2];
					$restore[$k]['path'] = $_SERVER['DOCUMENT_ROOT'].'/Public/admin/bk/';
				}
				$this->assign('list',$restore);
				$this->display(TMPL_PATH.$this->config.'/restore.html');
			}
			else
			{
				$this->error('没有检测到备份文件,请先备份或上传备份文件到./Public/admin/bk/',U("Other/index"));
			}
		}
		/**
		 * @name 数据库还原
		 */
		public function back()
		{
			$rs = new Model();
			$pre = $_REQUEST['id'];
			$fileid = $_REQUEST['fileid'] ? intval($_REQUEST['fileid']) : 1;
			$filename = $pre.$fileid.'.sql';
			$filepath = $_SERVER['DOCUMENT_ROOT'].'/Public/admin/bk/'.$filename;
			if(file_exists($filepath))
			{
				$sql = read_file($filepath);
				$sql = str_replace("\r\n", "\n", $sql);
				foreach(explode(";\n", trim($sql)) as $query)
				{
					$rs->query(trim($query));
				}
				$this->success('第'.$fileid.'个备份文件恢复成功,准备恢复下一个,请稍等！',U('Other/back?id='.$pre.'&fileid='.($fileid+1)));
			}
			else
			{
				$this->success("数据库恢复成功！",U("Other/index"));
			}

		}
	  /**
      * @name 数据库下载
      */
		public function down()
		{
			$filepath = $_SERVER['DOCUMENT_ROOT'].'/Public/admin/bk/'.$_GET['id'];
			if (file_exists($filepath))
			{
				$filename = $filename ? $filename : basename($filepath);
				$filetype = trim(substr(strrchr($filename, '.'), 1));
				$filesize = filesize($filepath);
				header('Cache-control: max-age=31536000');
				header('Expires: '.gmdate('D, d M Y H:i:s', time() + 31536000).' GMT');
				header('Content-Encoding: none');
				header('Content-Length: '.$filesize);
				header('Content-Disposition: attachment; filename='.$filename);
				header('Content-Type: '.$filetype);
				readfile($filepath);
				exit;
			}
			else
			{
				$this->error('出错了,没有找到分卷文件！',1);
			}
		}
	 /**
      * @name 删除分卷
      */
		public function del()
		{
			$filename = trim($_REQUEST['id']);
			@unlink($_SERVER['DOCUMENT_ROOT'].'/Public/admin/bk/'.$filename);
			$this->success($filename.'已经删除！',U("other/restore"));
		}
     /**
      * @name 批量删除备份文件
      */
		public function delall()
		{
			if(empty($_REQUEST['ids']))
			{
				$this->error("请先选择备份文件!",1);
			}
			foreach($_REQUEST['ids'] as $value)
			{
				@unlink($_SERVER['DOCUMENT_ROOT'].'/Public/admin/bk/'.$value);
			}
			$this->success('批量删除分卷文件成功！',U("Other/restore"));
		}
	  /**
      * @name 上传备份文件页
      */
		public function upload()
		{
			$this->display(TMPL_PATH.$this->config.'/other_upload.html');
		}
     /**
      * @name 执行上传备份文件操作
      */
		public function doupload()
		{
			//处理文件名,获取原始文件名
			$filename = str_replace(".sql","",$_FILES['url']['name']);
			import('@.ORG.Net.UploadFile');
			$upload=new UploadFile();
			$upload->maxSize='2048000';
			$upload->savePath= $_SERVER['DOCUMENT_ROOT'].'/Public/admin/bk/';
			$upload->saveRule= $filename;
			$upload->uploadReplace = true;
			$upload->allowExts = array('sql');     //准许上传的文件后缀
			if($upload->upload())
			{
				$this->success('上传成功!',U("Other/restore"));
			}
			else
			{
				$this->error($upload->getErrorMsg());
			}
		}

		/**
		 * @name 操作日志查看
		 */
		public function log(){
			import("ORG.Util.Page");
			$model = M('admin_exec_log');
			$count = $model->count('id');
			$page = new Page($count,'25');
			$show = $page->show();
			$list = $model->order('time desc')->limit($page->firstRow.','.$page->listRows)->select();
		    $this->assign('list',$list);
		    $this->assign('page',$show);
		    $this->display(TMPL_PATH.$this->config.'/log.html');
		}
		/**
		 * @name 删除日志
		 */
		public function del_log(){
			if($_REQUEST['id']!=""){
				$model = M('admin_exec_log');
			foreach($_REQUEST['id'] as $m)
				$map['id'] = $m;
			    $model->where($map)->delete();
			    $this->success('删除成功');
			}else{
				$this->error('请选择要删除的日志');
			}

		}
		
		/**
		 * @name 删除屏蔽的IP
		 */
		public function del_ip(){
			$model = M('web_not_allow_ip');

			if($_REQUEST['id']!=""){
				foreach($_REQUEST['id'] as $m){
				$map['id'] = $m;
				$model->where($map)->delete();
				$this->success('删除成功');}
			}else{
				$this->error('请选择你要删除的IP');
			}
		}
		/**
		 * @name 添加屏蔽IP地址，删除IP地址
		 */
		public function ip(){
			$model = M('web_not_allow_ip');

			if($_POST['ip']){
				$map['ip'] = $_GET['ip'];
				$model->where($map)->delete();
				$this->success('删除成功');
 			}
			$list = $model->select();
			$this->assign('list',$list);
			$this->display(TMPL_PATH.$this->config.'/ip.html');
		}
		/**
		 * @name 增加屏蔽IP地址
		 */
		public function ip_add(){
			$ip = $_POST['ip'];
			if($ip!=""){
				$map['ip'] = $ip;
				$model = M('web_not_allow_ip');
				$model->data($map)->add();
				$this->success('添加黑名单成功');
			}else{
				$this->error('请填入要屏蔽的IP再进行提交');
			}
		}
		/**
		 * @name 后台栏目管理
		 */
		public function menu_list() {
			import("@.ORG.Util.Category");
			$category_list = M('category_list');
			$list = $category_list->order('listorder asc')->select();
			foreach($list as $k=>$v){
			$list[$k]['count'] = count(explode('-',$v['bpath']));

			}
			$cat=new Category(array('id','fid','category','cname'));
			$s=$cat->getTree($list);//获取分类数据树结构
		    $this->assign('list',$s);
			$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/menu_list.html' );
		}
		/**
		 * @name 后台栏目排序
		 */
		public function menu_listorders(){

			if(isset($_POST['dosubmit'])) {
				$category_list = M('category_list');
				foreach($_POST['listorders'] as $id =>$listorder) {
					$map['listorder'] =$listorder;
					$category_list->where('id ='.$id)->save($map); // 根据条件保存修改的数据
				}
				$this->success('操作成功！');
			} else {
				$this->success('操作失败！');
			}


		}
		/**
		 * @name增加后台栏目
		 */
		public function menu_add() {
			$log_str = '增加栏目';
			parent::admin_log ( $log_str );
			$category_list = M('category_list');
			//查询出一级后台栏目
			$list = $category_list->where('fid = 0')->order('id asc')->select();
			$this->assign('list',$list);
			if($_POST['dosubmit']){
				$map['category'] = trim($_POST['category']);
				if($map['category']==''){
					$this->error("栏目名不能为空！");
				}
				$map['module_alias'] = trim($_POST['module_alias']);
				if($map['module_alias']==''){
					$this->error("方法名不能为空！");
				}
				$map['hidden'] = trim($_POST['hidden']);
				$map['listorder'] = trim($_POST['listorder']);
				$map['fid'] = trim($_POST['fid']);
				if($category_list->add($map)){
					$this->success("栏目添加成功!",U('Other/menu_list'));

				} else{
					$this->error("发生错误:".mysql_error(),U('Other/menu_list'));
				}

			}
			$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/menu_add.html' );
		}
		/**
		 * @name 修改该后台栏目
		 */
		public function menu_edit(){
			$log_str = '修改栏目';
			parent::admin_log ( $log_str );
			$category_list = M('category_list');
			//查询出一级后台栏目
			$list = $category_list->where('fid = 0')->order('id asc')->select();
			$this->assign('list',$list);
			$arr['id'] = $_GET['id'];
			$info = $category_list->where($arr)->find();
			$this->assign('info',$info);
			if($_POST['dosubmit']){

				$map['category'] = trim($_POST['category']);
				if($map['category']==''){
					$this->error("栏目名不能为空！");
				}
				$map['module_alias'] = trim($_POST['module_alias']);
				if($map['module_alias']==''){
					$this->error("方法名不能为空！");
				}
				$map['hidden'] = trim($_POST['hidden']);
				$map['listorder'] = trim($_POST['listorder']);
				$map['fid'] = trim($_POST['fid']);
				$id['id'] = trim($_POST['id']);
				$st =$category_list->where($id)->save($map);
				if($st){
					$this->success("栏目修改成功!",U('Other/menu_list'));

				} else{
					$this->error("发生错误:".mysql_error(),U('Other/menu_list'));
				}



			}

			$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/menu_edit.html' );

		}
		/**
		 * @name 删除后台栏目
		 */
		public function menu_del(){
			$log_str = '删除栏目';
			parent::admin_log ( $log_str );
			$cid = $_REQUEST['id'];
			$cids = implode(',',$cid);//批量获取gid
			$id = is_array($cid) ? $cids : $cid;
			$map['id'] = array('in',$id);
			if(!$cid)
			{
				$this->error("请勾选记录！");
			}
			$category_list = M("category_list"); // 实例化category_list对象
			$flag = $category_list->where($map)->delete(); // 删除数据
			if($flag){
				$this->success("删除成功!",U('Other/menu_list'));
			} else{
				$this->error("发生错误:".mysql_error(),U('Other/menu_list'));
			}

		}

	
	
	



   }
?>