<?php
/*****************************************
      @function 广告管理

	  @file AdAction.class.php $

	  @Author Lostman $

******************************************/
class AdAction extends CommonAction {
	public $config;
	public function __construct()
	{
		parent::_initialize();
		$this->config = C("ADMIN_THEME");
		parent::action_access(MODULE_NAME,ACTION_NAME);
	
	}
	/**
	 *
	 * @name 友情链接管理
	 */
	public function ad_link() {
		$ad = M ( 'link' );
		$passed = isset ( $_REQUEST ['passed'] ) ? $map ['passed'] = $_REQUEST ['passed'] : $map ['passed'] = 1;

		import ( '@.ORG.Util.Page' );
		$count = $ad->where ($map)->count ();
		$p = new Page ( $count, 20 );
		$p->setConfig ( 'prev', '上一页' );
		$p->setConfig ( 'header', '条记录' );
		$p->setConfig ( 'first', '首 页' );
		$p->setConfig ( 'last', '末 页' );
		$p->setConfig ( 'next', '下一页' );
		$p->setConfig ( 'theme', "%first%%upPage%%linkPage%%downPage%%end%
		<li><span><select name='select' onChange='javascript:window.location.href=(this.options[this.selectedIndex].value);'>%allPage%</select></span></li>\n<li><span>共<font color='#009900'><b>%totalRow%</b></font>条记录 20条/每页</span></li>" );
		$this->assign ( 'page', $p->show () );
		$list = $ad->where ($map)->order ( 'addtime desc' )->limit ( $p->firstRow . ',' . $p->listRows )->select ();
		$this->assign ( 'list', $list );
		$this->assign ( 'passed', $passed );
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/ad_link.html' );
	}
	/**
	 * @name 增加友情链接
	 */
	public function ad_linkadd()
	{
		$log_str = '增加友情链接';
		parent::admin_log ( $log_str );
		$link = M ('link');
		if($_POST['dosubmit']){
			$map['name'] = trim($_POST['name']);
			$map['url'] = trim($_POST['url']);
			$map['username'] = trim($_POST['username']);
			if($map['name']==''){
				$this->error("网站名不能为空！");
			}
			$flag = $link->where('name='.$map['name'])->getField('name');
			if($flag){
				$this->error("友情链接已存在！");
			}
			$map['introduce'] = trim($_POST['introduce']);
			$map['elite'] = trim($_POST['elite']);
			$map['listorder'] = trim($_POST['listorder']);
			$map['passed']= trim($_POST['passed']);
			$map['addtime'] = time();
			if($link->add($map)){
				$this->success("友情链接发布成功!",U('Ad/ad_link'));
			} else{
				$this->error("发生错误:".mysql_error(),U('Ad/ad_link'));
			}	
		}

		$this->display(TMPL_PATH.C('ADMIN_THEME').'/ad_linkadd.html');
	}
	/**
	 * @name 修改友情链接
	 */
	public function ad_linkedit(){
		$log_str = '修改友情链接';
		parent::admin_log ( $log_str );
		$conn = M('link');
		$arr['linkid'] = $_GET['linkid'];
		$info = $conn->where($arr)->find();
		$this->assign('info',$info);
		$this->assign('linkid',$arr['linkid']);
		if($_POST['dosubmit']){
			$map['name'] = trim($_POST['name']);
			$map['url'] = trim($_POST['url']);
			$map['username'] = trim($_POST['username']);
			if($map['name']==''){
				$this->error("网站名不能为空！");
			}
			
			$map['introduce'] = trim($_POST['introduce']);
			$map['elite'] = trim($_POST['elite']);
			$map['listorder'] = trim($_POST['listorder']);
			$map['passed']= trim($_POST['passed']);
			$arr1['linkid'] = trim($_POST['linkid']);
			$st =$conn->where($arr1)->save($map); // 根据条件保存修改的数据
			if($st){
				$this->success("修改成功!",U('Ad/ad_link'));
			} else{
				$this->error("发生错误:".mysql_error(),U('Ad/ad_link'));
			}
		}
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/ad_linkedit.html');
	}
	/**
	 * @name 删除友情链接
	 */	
	public function ad_linkdelete()
	{
		$log_str = '删除友情链接';
		parent::admin_log ( $log_str );
		$gid = $_REQUEST['linkid'];
		$gids = implode(',',$gid);//批量获取gid
		$id = is_array($gid) ? $gids : $gid;
		$map['linkid'] = array('in',$id);
		if(!$gid)
		{
			$this->error('请勾选记录!');
		}
		$conn = M('link');
			$flag = $conn->where($map)->delete(); // 删除数据
			if($flag){
				$this->success("删除成功!",U('Ad/ad_link'));
			} else{
				$this->error("发生错误:".mysql_error(),U('Ad/ad_link'));
			}
		
	}
	/**
	 * @name 广告管理
	 */
	public function ad_index() {
		$ad = M ( 'ad' );
		$count = $ad->count ();
		import ( '@.ORG.Util.Page' );
		$count = $ad->where ()->count ();
		$p = new Page ( $count, 20 );
		$p->setConfig ( 'prev', '上一页' );
		$p->setConfig ( 'header', '条记录' );
		$p->setConfig ( 'first', '首 页' );
		$p->setConfig ( 'last', '末 页' );
		$p->setConfig ( 'next', '下一页' );
		$p->setConfig ( 'theme', "%first%%upPage%%linkPage%%downPage%%end%
		<li><span><select name='select' onChange='javascript:window.location.href=(this.options[this.selectedIndex].value);'>%allPage%</select></span></li>\n<li><span>共<font color='#009900'><b>%totalRow%</b></font>条记录 20条/每页</span></li>" );
		$this->assign ( 'page', $p->show () );
		$list = $ad->where ()->order ( 'addtime desc' )->limit ( $p->firstRow . ',' . $p->listRows )->select ();
		$ad_where = M('ad_where');
foreach($list as $k=>$v){
	
	//执行其他的数据操作
	$where_list = $ad_where->where('id = '.$v['type'])->find();
	$list[$k]['typetitle'] = $where_list['title'];
}
		
		$this->assign ( 'list', $list );
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/ad_index.html' );
	}
	/**
	 *
	 * @name 广告位列表
	 */	
	public function adwhere_list(){
		//实例化gametype模型
		$ad_where = M('ad_where');
		//执行其他的数据操作
		$where_list = $ad_where->select();
		$this->assign('where_list',$where_list);
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/adwhere_list.html');
	}
	/**
	 *
	 * @name增加广告位
	 */
	public function add_adwhere()
	{
		$arr = '增加广告位子';
		parent::admin_log ( $arr );
		if($_POST['dosubmit']){
			$map['title'] = trim($_POST['title']);
			$ad_where = M("ad_where"); // 实例化gametype对象
			$flag = $ad_where->where('title='.$map['title'])->getField('title');
			if($flag){
				$this->error("广告位子已存在");
			}
	
			if($ad_where->add($map)){
				$this->success("发布成功!",U('Ad/adwhere_list'));
	
			} else{
				$this->error("发生错误:".mysql_error(),U('Ad/adwhere_list'));
			}
	
	
		}
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/add_adwhere.html');
	}
	/**
	 *
	 * @name 修改该广告位
	 */
	public function edit_adwhere(){
		$arr_1 = '修改广告位子';
		parent::admin_log ( $arr_1 );
		$conn = M('ad_where');
		$arr['id'] = $_GET['id'];
		$info = $conn->where($arr)->find();
		$this->assign('info',$info);
		$this->assign('id',$arr['id']);
		if($_POST['dosubmit']){
			$map['title'] = trim($_POST['title']);
			$arr1['id'] = trim($_POST['id']);
			if($map['title']==''){
				$this->error("广告位子不能为空！");
			}
			$st =$conn->where($arr1)->save($map); // 根据条件保存修改的数据
			if($st){
				$this->success("修改成功!",U('Ad/adwhere_list'));
			} else{
				$this->error("发生错误:".mysql_error(),U('Ad/adwhere_list'));
			}
		}
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/edit_adwhere.html');
	}
	/**
	 *
	 * @name 删除广告
	 */
	public function adwhere_delete()
	{
		$arr = '删除广告位子';
		parent::admin_log ( $arr );
		$gid = $_REQUEST['id'];
		$gids = implode(',',$gid);//批量获取gid
		$id = is_array($gid) ? $gids : $gid;
		$map['type'] = array('in',$id);
		$map1['id'] = array('in',$id);
		if(!$gid)
		{
			$this->error("请勾选记录！");
		}
		$ad_where = M("ad_where"); // 实例化game对象
		$ad = M('ad');
		$flag_game = $ad->where($map)->getField('id');
		if($flag_game){
			$this->error("该广告位下还有广告!",U('Ad/adwhere_list'));
		}else{
			$flag = $ad_where->where($map1)->delete(); // 删除数据
			if($flag){
				$this->success("删除成功!",U('Ad/adwhere_list'));
			} else{
				$this->error("发生错误:".mysql_error(),U('Ad/adwhere_list'));
			}
		}
	}
	/**
	 * @name 增加广告
	 */	
	
	public function add() {
		$arr = '增加广告';
		parent::admin_log ( $arr );
		$ad = M("ad"); // 实例化gametype对象
		if($_POST['dosubmit']){
			$map['title'] = trim($_POST['title']);
			$flag = $ad->where("title ='".$map['title']."'")->getField('title');
			if($flag){
				$this->error("广告名称已存在！");
			}
			if($map['title']==''){
				$this->error("广告名称不能为空");
			}
			$map['status'] = trim($_POST['status']);
			$map['url'] = trim($_POST['url']);
			$map['type'] = trim($_POST['type']);
			$map['end_time'] = strtotime(trim($_POST['end_time']));
			$map['addtime'] = time();
			$map['description'] = trim($_POST['description']);
			import("@.ORG.Net.UploadFile");
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath = $_SERVER['DOCUMENT_ROOT'].'/Public/Uploads/images/';// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
				//$this->error($upload->getErrorMsg());
				$map['content'] ='';
			
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
	
			   $map['content'] =$info['0']['savename'];
				
				}
				
				if($ad->add($map)){
					$this->success("广告发布成功!",U('Ad/ad_index'));
						
				} else{
					$this->error("发生错误:".mysql_error(),U('Ad/ad_index'));
				}
				
				
					
			}
			
		$ad_where = M('ad_where');
		//执行其他的数据操作
		$where_list = $ad_where->select();
		$this->assign('where_list',$where_list);
		
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/ad_add.html' );
	}
	/**
	 *
	 * @name 修改广告
	 */
	public function edit() {
		$arr = '修改广告';
		parent::admin_log ( $arr );
		$type = M ( 'ad' );
		if($_POST['dosubmit']){
			$id = trim($_POST['id']);
			$info = $type->where('id='.$id)->find();
			$map['title'] = trim($_POST['title']);
			if($map['title']==''){
				$this->error("广告名称不能为空！");
			}
			$map['status'] = trim($_POST['status']);
			$map['type'] = trim($_POST['type']);
			$map['end_time'] = strtotime(trim($_POST['end_time']));
			$map['description'] = trim($_POST['description']);
			$map['url'] = trim($_POST['url']);
			//$map['addtime'] = time();
			import("@.ORG.Net.UploadFile");
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath = $_SERVER['DOCUMENT_ROOT'].'/Public/Uploads/images/';// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
			$map['content'] ='';
			}else{// 上传成功 获取上传文件信息
				$info_img =  $upload->getUploadFileInfo();
				$map['content'] =$info_img[0]['savename'];
		
			}
			if(empty($map['content'])){
				$map['content'] =$info['content'];
			}
			$st =$type->where('id='.$id)->save($map); // 根据条件保存修改的数据
			if($st){
				$this->success("广告修改成功!",U('Ad/ad_index'));
			} else{
				$this->error("发生错误:".mysql_error(),U('Ad/ad_index'));
			}
				
				
		}
		$ad_where = M('ad_where');
		//执行其他的数据操作
		$where_list = $ad_where->select();
		$this->assign('where_list',$where_list);
		$list = $type->where ( 'id=' . $_GET ['id'] )->find ();
		$this->assign ( 'list', $list );
		$this->display ( TMPL_PATH . C ( 'ADMIN_THEME' ) . '/ad_edit.html' );
	}

	/**
	 *
	 * @name 广告删除
	 */
	public function del() {
		$log_str = '广告删除';
		parent::admin_log ( $log_str );
	    $gid = $_REQUEST['id'];
		$gids = implode(',',$gid);//批量获取gid
		$id = is_array($gid) ? $gids : $gid;
		$map1['id'] = array('in',$id);
		if(!$gid)
		{
			$this->error("请勾选记录！");
		}
		$ad = M('ad');
		$flag = $ad->where($map1)->delete(); // 删除数据
			if($flag){
				$this->success("删除成功!",U('Ad/ad_index'));
			} else{
				$this->error("发生错误:".mysql_error(),U('Ad/ad_index'));
		
	}
	}
	

}
?>