<?php
/**
 * @name 游戏控制器
 *
 * @access private
 *
 */
class GameAction extends CommonAction
{

 	public $config;
	  	public function __construct()
	  	{
	  		parent::_initialize();
	  		$this->config = C("ADMIN_THEME");
	  		parent::action_access(MODULE_NAME,ACTION_NAME);
	  	
	  	}
/**
 * @name 游戏列表
 */
	public function game_list()
	{
		$game = D('GameView');
		import('@.ORG.Util.Page');
		if(isset($_REQUEST['gametype'])&&$_REQUEST['gametype']!='')
			{
			
				$count = $game->where('game.gametype='.$_REQUEST['gametype'])->order('gid asc')->count();
				$p = new Page($count,20); 
				$list = $game->where('game.gametype='.$_REQUEST['gametype'])->order('gid asc')->limit($p->firstRow.','.$p->listRows)->select();
				
			}
	        elseif(isset($_REQUEST['gamename'])&& $_REQUEST['gamename']!='')
			{
				
				$count = $game->where("game.gamename='".trim($_REQUEST['gamename'])."'")->order('gid asc')->count();
				$p = new Page($count,20); 
				$list = $game->where("game.gamename='".trim($_REQUEST['gamename'])."'")->order('gid asc')->limit($p->firstRow.','.$p->listRows)->select();
			}else
			{
				
				$count = $game->order('gid asc')->count();
				$p = new Page($count,20); 
				$list = $game->order('gid asc')->limit($p->firstRow.','.$p->listRows)->select();
			}
	
			$p->setConfig('prev','上一页');
			$p->setConfig('header','款游戏');
			$p->setConfig('first','首 页');
			$p->setConfig('last','末 页');
			$p->setConfig('next','下一页');
			$p->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%
			<li><span><select name='select' onChange='javascript:window.location.href=(this.options[this.selectedIndex].value);'>%allPage%</select></span></li>\n<li><span>共<font color='#009900'><b>%totalRow%</b></font>篇文章 20篇/每页</span></li>");
			$this->assign('page',$p->show());
			$this->assign('list',$list);	
		
			$typelist = M("gametype"); // 实例化gametype对象
			$list_type = $typelist->where()->select();
			$this->assign('list_type',$list_type);
			$this->assign('type',$_POST['gametype']);
			$this->assign('gamename',$_POST['gamename']);
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/game_list.html');
	}
	/**
	 * @name 增加游戏
	 */	
	public function game_add()
	{
		$arr = '增加游戏';
		parent::admin_log ( $arr );
		$game = M("game"); // 实例化game对象
		if($_POST['dosubmit']){	
		$map['gamename'] = trim($_POST['gamename']);
		$flag = $game->where('gamename='.$map['gamename'])->getField('gamename');
		if($flag){
			$this->error("游戏名已存在！");
		}
		
		if($map['gamename']==''){
			$this->error("游戏名不能为空！");	
		}
		$map['gametype'] = trim($_POST['gametype']);
		$map['isdisplay'] = trim($_POST['isdisplay']);
		$map['content'] = trim($_POST['content']);
		$map['desc1'] = trim($_POST['desc1']);
		$map['game_web'] = trim($_POST['game_web']);
		$map['game_bbs'] = trim($_POST['game_bbs']);
		$map['game_guide'] = trim($_POST['game_guide']);
		$map['currency'] = trim($_POST['currency']);
		$map['payto'] = trim($_POST['payto']);
		$map['tag'] = trim($_POST['tag']);
		$map['short'] = trim($_POST['short']);
		$map['game_hit'] = trim($_POST['game_hit']);
		$map['game_starttime'] = strtotime(trim($_POST['game_starttime']));
		if($map['game_starttime']==''){
			$map['game_starttime'] = time();
		}
		$map['ishot'] = trim($_POST['ishot']);
		$map['sort'] = trim($_POST['sort']);
		$map['game_key'] = trim($_POST['game_key']);
		$map['game_paykey'] = trim($_POST['game_paykey']);
		$map['game_url'] = trim($_POST['game_url']);
		$map['p_id'] = trim($_POST['p_id']);
		$map['addtime'] = time();
		import("@.ORG.Net.UploadFile");
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath = $_SERVER['DOCUMENT_ROOT'].'/Public/Uploads/images/';// 设置附件上传目录
		if(!$upload->upload()) {// 上传错误提示错误信息
		    //$this->error($upload->getErrorMsg());
			$map['gamepic'] ='';
			$map['smallpic'] ='';
			$map['ordinarypic'] ='';
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
			foreach ($info as $k=>$v){
			if($v['key']=='gamepic'){
				$map['gamepic'] =$info[$k]['savename'];
			}
			if($v['key']=='smallpic'){
				$map['smallpic'] =$info[$k]['savename'];
			}
			if($v['key']=='ordinarypic'){
				$map['ordinarypic'] =$info[$k]['savename'];
			}
		}
			
		}
		if(empty($map['gamepic'])){
			$map['gamepic'] ='';
		}
		if(empty($map['smallpic'])){
			//	echo 1;
			$map['smallpic'] ='';
		}
		if(empty($map['ordinarypic'])){
			$map['ordinarypic'] ='';
		}
		
		if($game->add($map)){
			$this->success("游戏发布成功!",U('Game/game_list'));
			
		} else{
		   $this->error("发生错误:".mysql_error(),U('Game/game_list'));
	    }
		}
		$typelist = M("gametype"); // 实例化gametype对象
		$list = $typelist->where()->select();
		$this->assign('list',$list);
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/game_add.html');
	}
	/**
	 * @name 游戏修改
	 */

	public function game_edit()
	{
		$arr_1 = '修改游戏';
		parent::admin_log ( $arr_1 );
			$conn = M('game');
			$arr['gid'] = $_GET['gid'];
			$info = $conn->where($arr)->find();
			$this->assign('info',$info);
			$typelist = M("gametype"); // 实例化gametype对象
			$list = $typelist->where()->select();
			$this->assign('list',$list);
			$this->assign('gid',$arr['gid']);
			if($_POST['dosubmit']){
				$gid['gid'] = trim($_POST['gid']);
				$info = $conn->where($gid)->find();
			$map['gamename'] = trim($_POST['gamename']);
			if($map['gamename']==''){
				$this->error("游戏名不能为空！");	
			}
			$map['desc1'] = trim($_POST['desc1']);
			$map['gametype'] = trim($_POST['gametype']);
			$map['isdisplay'] = trim($_POST['isdisplay']);
			$map['content'] = trim($_POST['content']);
			$map['game_web'] = trim($_POST['game_web']);
			$map['game_bbs'] = trim($_POST['game_bbs']);
			$map['game_guide'] = trim($_POST['game_guide']);
			$map['currency'] = trim($_POST['currency']);
			$map['payto'] = trim($_POST['payto']);
			$map['tag'] = trim($_POST['tag']);
			$map['short'] = trim($_POST['short']);
			$map['game_hit'] = trim($_POST['game_hit']);
			$map['game_starttime'] = strtotime(trim($_POST['game_starttime']));
			if($map['game_starttime']==''){
				$map['game_starttime'] = $info['game_starttime'];
			}
			$map['ishot'] = trim($_POST['ishot']);
			$map['sort'] = trim($_POST['sort']);
			$map['game_key'] = trim($_POST['game_key']);
			$map['game_paykey'] = trim($_POST['game_paykey']);
			$map['game_url'] = trim($_POST['game_url']);
			$map['game_payurl'] = trim($_POST['game_payurl']);
			$map['p_id'] = trim($_POST['p_id']);
			//$map['addtime'] = time();
			import("@.ORG.Net.UploadFile");
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath = $_SERVER['DOCUMENT_ROOT'].'/Public/Uploads/images/';// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
			    //$this->error($upload->getErrorMsg());
				$map['gamepic'] =$info['gamepic'];
				$map['smallpic'] =$info['smallpic'];
				$map['ordinarypic'] =$info['ordinarypic'];
			}else{// 上传成功 获取上传文件信息
				$info_img =  $upload->getUploadFileInfo();
			
		foreach ($info_img as $k=>$v){
			if($v['key']=='gamepic'){
				$map['gamepic'] =$info_img[$k]['savename'];
			}
			if($v['key']=='smallpic'){
				$map['smallpic'] =$info_img[$k]['savename'];
			}
			if($v['key']=='ordinarypic'){
				$map['ordinarypic'] =$info_img[$k]['savename'];
			}
		}
		}
		
		if(empty($map['gamepic'])){
			$map['gamepic'] =$info['gamepic'];
		}
		if(empty($map['smallpic'])){
		//	echo 1;
			$map['smallpic'] =$info['smallpic'];
		}
		if(empty($map['ordinarypic'])){
			$map['ordinarypic'] =$info['ordinarypic'];
		}
			
			$st =$conn->where($gid)->save($map); // 根据条件保存修改的数据
			if($st)
			{
				$this->success("游戏修改成功!",U('Game/game_list'));	
					} else{
						$this->error("发生错误:".mysql_error(),U('Game/game_list'));
					}
					
					
				}
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/game_edit.html');
	}
	/**
	 * @name 删除游戏
	 */	
	public function game_delete()
	{
		$arr = '删除游戏';
		parent::admin_log ( $arr );
		$gid = $_REQUEST['gid'];
		$gids = implode(',',$gid);//批量获取gid
		$id = is_array($gid) ? $gids : $gid;
		$map['gid'] = array('in',$id);
		if(!$gid)
		{
				$this->error("请勾选记录！");
		}
		$game = M("game"); // 实例化game对象
		$server = M('server');
		$flag_server = $server->where($map)->getField('sid');
		if($flag_server){
			$this->error("请先删除该游戏下所属区服!",U('Game/game_list'));
		}else{
			$flag = $game->where($map)->delete(); // 删除数据
			if($flag){
				$this->success("游戏删除成功!",U('Game/game_list'));	
			} else{
				$this->error("发生错误:".mysql_error(),U('Game/game_list'));
			}	
		}
		
	}
	/**
	 * @name 开服列表
	 */	
	public function server_list()
	{
		$server = M('server');
		//实例化game模型
		$game = M('game');
		//执行其他的数据操作
		$game_list = $game->select();
		$this->assign('game_list',$game_list);
		import('@.ORG.Util.Page');
		if($_REQUEST['status']!=''){
		$status =" and `status` ='".$_REQUEST['status']."'" ;
	}
	if($_REQUEST['servername'] !=''){
		$servername =" and servername='".trim($_REQUEST['servername'])."'";
	}
	if($_REQUEST['gid']!=''){
		$gid =" and gid= ".$_REQUEST['gid'];
	}
	    $count = $server->where(' 1 '.$gid.$servername.$status)->order('sid asc')->count();
		$p = new Page($count,20);
		$list = $server->where(' 1 '.$gid.$servername.$status)->order('sid asc')->limit($p->firstRow.','.$p->listRows)->select();
foreach($list as $k=>$v){
	$info = $game->where('gid ='.$v['gid'])->find();
	$list[$k]['gamename'] = $info['gamename'];
	
}
	
		$p->setConfig('prev','上一页');
		$p->setConfig('header','区服');
		$p->setConfig('first','首 页');
		$p->setConfig('last','末 页');
		$p->setConfig('next','下一页');
		$p->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%
			<li><span><select name='select' onChange='javascript:window.location.href=(this.options[this.selectedIndex].value);'>%allPage%</select></span></li>\n<li><span>共<font color='#009900'><b>%totalRow%</b></font>篇文章 20篇/每页</span></li>");
		$this->assign('page',$p->show());
		$this->assign('list',$list);
		$this->assign('status',$_POST['status']);
		
		$this->assign('gid',$_POST['gid']);
		$this->assign('servername',$_POST['servername']);
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/server_list.html');
	}
/**
 * @name 增加服务器
 */
	public function server_add()
	{
		$arr = '增加区服';
		parent::admin_log ( $arr );
		//实例化game模型
		$game = M('game');
		//执行其他的数据操作
		$game_list = $game->select();
		$this->assign('game_list',$game_list);
		$this->assign('gid',$_GET['gid']);
		$server = M('server');
		if($_POST['dosubmit']){
			$map['gid'] = trim($_POST['gid']);
			$map['servername'] = trim($_POST['servername']);
			$flag = $server->where('servername='.$map['servername'])->getField('servername');
			if($flag){
				$this->error("开服名称已存在！");
			}
		
			if($map['servername']==''){
				$this->error("开服名称不能为空！");
			}
			if($map['gid']==''){
				$this->error("所属游戏不能为空！");
			}
			$map['line'] = trim($_POST['line']);
			$map['status'] = trim($_POST['status']);
			$map['content'] = trim($_POST['content']);
			$map['is_display'] = trim($_POST['is_display']);
			
			$map['start_time'] = strtotime(trim($_POST['start_time']));
			if($map['start_time']==''){
				$this->error("开服时间不能为空！");
			}
			$map['server_url'] = trim($_POST['server_url']);
			$map['gameid'] = trim($_POST['gameid']);
			$map['serverid'] = trim($_POST['serverid']);
			$map['add_time'] = time();
			
			import("@.ORG.Net.UploadFile");
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath = $_SERVER['DOCUMENT_ROOT'].'/Public/Uploads/images/';// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
				//$this->error($upload->getErrorMsg());
				$map['server_img'] ='';
	
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
				foreach($info as $k=>$v){
					if($info[$k]['key']=='server_img'){
						$map['server_img'] =$info['0']['savename'];
					}else{
						$map['server_img'] ='';
					}

				}
					
			}
			
			if($server->add($map)){
				$this->success("开服信息发布成功!",U('Game/server_list'));
					
			} else{
				$this->error("发生错误:".mysql_error(),U('Game/server_list'));
			}
		}
		
		
		
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/server_add.html');
	}
	/**
	 * @name 服务器信息修改
	 */	
	public function server_edit()
	{
		$arr_1 = '修改区服';
		parent::admin_log ( $arr_1 );
		//实例化game模型
		$game = M('game');
		//执行其他的数据操作
		$game_list = $game->select();
		$this->assign('game_list',$game_list);
		$server = M('server');
		$arr['sid'] = $_GET['sid'];
		$info = $server->where($arr)->find();
		$this->assign('info',$info);
		$this->assign('sid',$arr['sid']);
		if($_POST['dosubmit']){
			$map['gid'] = trim($_POST['gid']);
			$map['servername'] = trim($_POST['servername']);
			if($map['servername']==''){
				$this->error("开服名称不能为空！");
			}
			if($map['gid']==''){
				$this->error("所属游戏不能为空！");
			}
			$map['line'] = trim($_POST['line']);
			$map['status'] = trim($_POST['status']);
			$map['content'] = trim($_POST['content']);
			$map['is_display'] = trim($_POST['is_display']);
				
			$map['start_time'] = strtotime(trim($_POST['start_time']));
			if($map['start_time']==''){
				$this->error("开服时间不能为空！");
			}
			$map['server_url'] = trim($_POST['server_url']);
			$map['gameid'] = trim($_POST['gameid']);
			$map['serverid'] = trim($_POST['serverid']);
			
				
			import("@.ORG.Net.UploadFile");
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath = $_SERVER['DOCUMENT_ROOT'].'/Public/Uploads/images/';// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
				//$this->error($upload->getErrorMsg());
				$map['server_img'] =$info['server_img'];
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
				foreach($info as $k=>$v){
					if($info[$k]['key']=='server_img'){
						$map['server_img'] =$info['0']['savename'];
					}else{
						$map['server_img'] =$info['server_img'];
					}
				}	
			}
		    $sid['sid'] = trim($_POST['sid']);
			$st =$server->where($sid)->save($map); // 根据条件保存修改的数据
			if($st){
				$this->success("开服修改成功!",U('Game/server_list'));	
					} else{
						$this->error("发生错误:".mysql_error(),U('Game/server_list'));
					}
		}
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/server_edit.html');
	}
	/**
	 * @name 删除服务器
	 */
	public function server_delete(){
		$arr = '删除区服';
		parent::admin_log ( $arr );
		$sid = $_REQUEST['sid'];
		$sids = implode(',',$sid);//批量获取gid
		$id = is_array($sid) ? $sids : $sid;
		$map['sid'] = array('in',$id);
		if(!$sid)
		{
			$this->error("请勾选记录！");
			
		}
		$card = M("card"); // 实例化game对象
		$server = M('server');
		$flag_card = $card->where($map)->getField('sid');
		if($flag_card){
			$this->error("请先删除该区新手卡!",U('Game/server_list'));
		}else{
			$flag = $server->where($map)->delete(); // 删除数据
			if($flag){
				$this->success("删除成功!",U('Game/server_list'));
			} else{
				$this->error("发生错误:".mysql_error(),U('Game/game_list'));
			}
		}
	}
	/**
	 * @name 游戏类型列表
	 */
	public function gametype_list(){
		//实例化gametype模型
		$type = M('gametype');
		//执行其他的数据操作
		$gametype = $type->select();
		$this->assign('gametype',$gametype);
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/gametype_list.html');
	}
	/**
	 * @name 增加游戏类型
	 */
	public function gametype_add()
	{
		$arr = '增加游戏类型';
		parent::admin_log ( $arr );
	if($_POST['dosubmit']){
		$map['typename'] = trim($_POST['typename']);
		$gametype = M("gametype"); // 实例化gametype对象
		$flag = $gametype->where('typename='.$map['typename'])->getField('typename');
		if($flag){
			$this->error("游戏类型已存在！");
		}
		
		if($gametype->add($map)){
			$this->success("发布成功!",U('Game/gametype_list'));
				
		} else{
			$this->error("发生错误:".mysql_error(),U('Game/gametype_list'));
		}
		
		
		}
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/gametype_add.html');
	}
	/**
	 * @name 修改游戏类型
	 */
	public function gametype_edit(){
		$arr_1 = '修改游戏类型';
		parent::admin_log ( $arr_1 );
		$conn = M('gametype');
		$arr['id'] = $_GET['id'];
		$info = $conn->where($arr)->find();
		$this->assign('info',$info);
		$this->assign('id',$arr['id']);
		if($_POST['dosubmit']){
			$map['typename'] = trim($_POST['typename']);
			$arr1['id'] = trim($_POST['id']);
			if($map['typename']==''){
				$this->error("类型名不能为空！");
			}
			$st =$conn->where($arr1)->save($map); // 根据条件保存修改的数据
			if($st){
				$this->success("修改成功!",U('Game/gametype_list'));
			} else{
				$this->error("发生错误:".mysql_error(),U('Game/gametype_list'));
			}	
		}
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/gametype_edit.html');
	}
	/**
	 * @name 删除游戏类型
	 */
	public function gametype_delete()
	{
		$arr = '删除游戏类型';
		parent::admin_log ( $arr );
	   $gid = $_REQUEST['id'];
		$gids = implode(',',$gid);//批量获取gid
		$id = is_array($gid) ? $gids : $gid;
		$map['gametype'] = array('in',$id);
		$map1['id'] = array('in',$id);
		if(!$gid)
		{
				$this->error("请勾选记录！");
		}
		$gametype = M("gametype"); // 实例化game对象
		$game = M('game');
		$flag_game = $game->where($map)->getField('gid');
		if($flag_game){
			$this->error("该分类下还有游戏!",U('Game/gametype_list'));
		}else{
			$flag = $gametype->where($map1)->delete(); // 删除数据
			if($flag){
				$this->success("删除成功!",U('Game/gametype_list'));	
			} else{
				$this->error("发生错误:".mysql_error(),U('Game/gametype_list'));
			}	
		}
	}
	/**
	 * @name 新手卡列表
	 */
	public function card_list(){
		//实例化gametype模型
		$card = M('card');
		$server = M('server');
		$game = M('game');
	    import('@.ORG.Util.Page');
		if(isset($_REQUEST['name'])&& $_REQUEST['name']!='')
		{
			$count = $card->where("name = '".trim($_REQUEST['name'])."'")->order('id desc')->count();
			$p = new Page($count,20);
			$list = $card->where("name = '".trim($_REQUEST['name'])."'")->order('id desc')->limit($p->firstRow.','.$p->listRows)->select();
		
		}elseif(isset($_REQUEST['gid'])&& $_REQUEST['gid']!='')
		{
			$count = $card->where("gid= ".$_REQUEST['gid'])->order('id desc')->count();
			$p = new Page($count,20);
			$list = $card->where("gid= ".$_REQUEST['gid'])->order('id desc')->limit($p->firstRow.','.$p->listRows)->select();
		
		}else{
			$count = $card->order('id desc')->count();
			$p = new Page($count,20);
			$list = $card->order('id desc')->limit($p->firstRow.','.$p->listRows)->select();
		
		}
		foreach($list as $key=>$v){
			$infog = $game->where("gid = ".$v['gid'])->find();
			$list[$key]['gamename']=$infog['gamename'];
			$infos = $server->where("sid = ".$v['sid'])->find();
			$list[$key]['servername'] = $infos['servername'];
			$gamecardarr = explode("\n",$v['card']);
			$list[$key]['remain']= count($gamecardarr);
		}
		$p->setConfig('prev','上一页');
		$p->setConfig('header','区服');
		$p->setConfig('first','首 页');
		$p->setConfig('last','末 页');
		$p->setConfig('next','下一页');
		$p->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%
			<li><span><select name='select' onChange='javascript:window.location.href=(this.options[this.selectedIndex].value);'>%allPage%</select></span></li>\n<li><span>共<font color='#009900'><b>%totalRow%</b></font>篇文章 20篇/每页</span></li>");
		$this->assign('page',$p->show());
		$this->assign('list',$list);
		$this->assign('name',$_POST['name']);
		
		$this->assign('gid',$_POST['gid']);
		$this->assign('servername',$_POST['servername']);
		//执行其他的数据操作
		$server_list = $server->select();
		$game_list = $game->select();
		$num = count($server_list);
		$this->assign('server_list',$server_list);
		$this->assign('game_list',$game_list);
		$this->assign('num',$num);
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/card_list.html');
	}
	/**
	 * @name 增加新手卡
	 */
	public function card_add()
	{
		$arr = '增加新手卡';
		parent::admin_log ( $arr );
		$card = M("card"); // 实例化gametype对象
		if($_POST['dosubmit']){
			$map['gid'] = trim($_POST['gid']);
			$map['sid'] = trim($_POST['sid']);
			$map['name'] = trim($_POST['name']);
			$flag = $card->where('sid='.$map['sid'].' and gid='.$map['gid'])->getField('name');
			if($flag){
				$this->error("新手卡已存在！");
			}
			if($map['name']==''){
				$this->error("新手卡名称不能为空");
			}
			$map['status'] = trim($_POST['status']);
			$map['card'] = trim($_POST['card']);
			$gamecardarr = explode("\n",$map['card']);
			$map['total']= count($gamecardarr);
			$map['start_time'] = strtotime(trim($_POST['start_time']));
		
			if($card->add($map)){
				$this->success("新手卡发布成功!",U('Game/card_list'));
					
			} else{
				$this->error("发生错误:".mysql_error(),U('Game/card_list'));
			}
			
		}
		$server = M('server');
		$game = M('game');
		//执行其他的数据操作
		$server_list = $server->select();
		$game_list = $game->select();
		$num = count($server_list);
		$this->assign('server_list',$server_list);
		$this->assign('game_list',$game_list);
		$this->assign('num',$num);
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/card_add.html');
	}
	/**
	 * @name 修改新手卡信息
	 */
	public function card_edit()
	{
		    $arr_1 = '修改新手卡';
		    parent::admin_log ( $arr_1 );
			$card = M("card"); // 实例化gametype对象
			$arr['id'] = $_GET['id'];
			$info = $card->where($arr)->find();
			$this->assign('info',$info);
			$this->assign('id',$arr['id']);
			$server = M('server');
			$game = M('game');
			$gamename = $game->where('gid='.$info['gid'])->getField('gamename');
			$servername = $server->where('sid='.$info['sid'])->getField('servername');
			$this->assign('gamename',$gamename);
			$this->assign('servername',$servername);
		if($_POST['dosubmit']){
			
 		 $map['gid'] = trim($_POST['gid']);
			$map['sid'] = trim($_POST['sid']);
			$map['name'] = trim($_POST['name']);
			$arr1['id'] = trim($_POST['id']);
			if($map['name']==''){
				$this->error("新手卡名称不能为空！");
			}
			$map['status'] = trim($_POST['status']);
			$map['card'] = trim($_POST['card']);
			$map['start_time'] = strtotime(trim($_POST['start_time']));
			$st =$card->where($arr1)->save($map); // 根据条件保存修改的数据
			if($st){
				$this->success("修改成功!",U('Game/card_list'));
			} else{
				$this->error("发生错误:".mysql_error(),U('Game/card_list'));
			}	  
			
			
			
			
	
		}
	
	
		$this->display(TMPL_PATH.C('ADMIN_THEME').'/card_edit.html');
	}
/**
 * @name 删除新手卡
 */
	public function card_delete()
	{
		$arr = '删除新手卡';
		parent::admin_log ( $arr );
	 $cid = $_REQUEST['cid'];
		$cids = implode(',',$cid);//批量获取gid
		$id = is_array($cid) ? $cids : $cid;
		$map['id'] = array('in',$id);
		if(!$cid)
		{
				$this->error("请勾选记录！");
		}
		$card = M("card"); // 实例化card对象
		$flag = $card->where($map)->delete(); // 删除数据
			if($flag){
				$this->success("删除成功!",U('Game/card_list'));	
			} else{
				$this->error("发生错误:".mysql_error(),U('Game/card_list'));
			}	
		
	}
	
	
}