<?php
     /**
      * @name 会员管理控制器
      * 
      * @access private 
      * 
      * @package app
      * 
      * @author lostman $ (leefongyun@gmail.com)
      */
     class MembersAction extends CommonAction
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
     	 {
     	 	$model = D('GlogView');
     	 	$user['game_log.username'] = $this->userinfo['username'];
     	 	$history = $model->where($user)->order('game_log.logintime desc')->limit('3')->select();
     	 	if($history!=null){
     	 		$this->assign('history',$history);
     	 	}else{
     	 		$this->assign('history','0');
     	 	}
     	 	$this->assign('info',$this->userinfo);
     	 	$this->pc->head();
            $this->display(TMPL_PATH.$this->config['THEME'].'/member.html');
            $this->pc->footer();
      	 }
      	 
      	 public function user_modifypwd()
      	 {
      	 	if($_POST){
      	 		if($_POST['password_old']!=""&&$_POST['login_password']==$_POST['relogin_pwd']||$_POST['relogin_pwd']!=""){
      	 			
      	 			list($uid, $username, $password, $email) = uc_user_login($this->userinfo['username'], $_POST['password_old']);
      	 			if($uid > 0) {
      	 				uc_user_edit($this->userinfo['username'], $_POST['password_old'], $_POST['relogin_pwd']);
      	 				$this->success('更改成功');
      	 				
      	 			} elseif($uid == -1) {
      	 				$this->error('用户不存在,或者被删除');
      	 			} elseif($uid == -2) {
      	 				$this->error('对不起，原密码错误');
      	 		   	} else {
      	 		     	$this->error('系统异常');
      	 			}
      	 		}else{
      	 			$this->error('你提交的数据有误');
       	 		}
       	 	}
       	 	$this->pc->head();
      	 	$this->display(TMPL_PATH.$this->config['THEME'].'/user_modifypwd.html');
      	 	$this->pc->footer();
      	 	 
      	 }
      	 public function user_fcm()
      	 {
      	 
  
      	 	if($_POST){
       
      	 		if(idcard_checksum18($_POST['id_card'])){
      	 		$data['realname'] = $_POST['realname'];
      	 		$data['id_card'] = $_POST['id_card'];
      	 		$model = M('member');
      	 		$map['username'] = $this->userinfo['username'];
      	 		$st = $model->where($map)->save($data);
      	 		if($st){
      	 			$this->success('添加成功');
      	 		}else{
      	 			$this->error('系统发生错误.添加失败');
      	 		}
      	 		}else{
      	 			$this->error('身份证号校验错误。请输入正确的身份证号码');
      	 		}
      	 		
      	 	}
      	 	$data['realname'] = $this->userinfo['realname'];
      	 	$data['id_card'] = $this->userinfo['id_card'];
      	 	$verify = idcard_checksum18($data['id_card']);
      	 	if($verify){
      	 		$data['success'] = "您已经通过防沉迷验证";
      	 	}else{
      	 		$data['success'] = "您没有通过防沉迷验证";
      	 		
      	 	}
      	 	if($data!=""){
      	 		$this->assign('data',$data);
      	 	}
      	 	$this->pc->head();
      	 	$this->display(TMPL_PATH.$this->config['THEME'].'/user_fcm.html');
      	 	$this->pc->footer();
      	 	 
      	 }
      	public function card_check(){
      	    $card_log =M('card_log');
			$gid = $_GET['gid'];
			$sid = $_GET['sid'];
			list ($uid,$username) = explode ("\t",uc_authcode($_COOKIE['auth'],'DECODE'));
			if($data = uc_get_user($username)) {
				list($uid, $username, $email) = $data;
			}
		
			$st = $card_log->where('gid='.$gid.' and sid='.$sid.' and uid='.$uid)->find();
	
			if($st){
				$arr['msg'] = '你已经申请，新手卡为：'.$st['card_info'];
				$arr['state'] = '-1';
				die(json_encode($arr));
			}else{
				//若该用户未获取新手卡则根据gid sid 去获取一行新手卡
				$card =M('card');
				$card_info = $card->where('gid='.$gid.' and sid='.$sid)->select();
				$now_time=time();
			
				if(empty($card_info)){
					$arr['msg'] = '暂未获取新手卡信息！请联系管理员';
					$arr['state'] = '-1';
					die(json_encode($arr));
				}else{
					if($now_time<$card_info[0]['start_time']){
						$arr['msg'] = '该新手卡未到领取时间，请于'.date('Y年m月d日 H:i',$card_info[0]['start_time']).'领取';
						$arr['state'] = '-1';
						die(json_encode($arr));
					}
					if($card_info[0]['status']==1){
						$arr['msg'] = '该新手卡暂不可领取';
						$arr['state'] = '-1';
						die(json_encode($arr));
					}
					
					$gamecardarr = explode("\n",$card_info[0]['card']);
					$gamecard = $gamecardarr[0];//取行号的值
					$gamecards = rtrim(ltrim(str_replace($gamecard,"",$card_info[0]['card']))."\n")."\n";
					$map['card'] = $gamecards;
					$flag = $card->where('sid ='.$sid)->save($map); // 根据条件保存修改的数据
					if($flag){
						//插入card_log
						$map1['gid'] =$gid;
						$map1['uid'] =$uid;
						$map1['get_time'] =time();
						$map1['sid'] =$sid;
						$map1['card_info'] =$gamecard;
						$card_log->add($map1);
						$arr['msg'] = '已成功获取新手卡：'.$gamecard;
						$arr['state'] = '1';
						die(json_encode($arr));
					}else{
						$arr['msg'] = '获取新手卡失败，请联系网站管理员';
						$arr['state'] = '-1';
						die(json_encode($arr));
							
					}
				}
			}
      		
      		}
      	 public function card()
      	 {
      	 	//获取游戏
      	 	$game = M('game');
      	 	$server = M('server');
      	 	$card = M('card');
      	 	$game_list= $game->where('isdisplay = 0')->select();
      	 	foreach($game_list as $k=>$v){
      	 		$server_list = $server->where("is_display='0' and gid = ".$v['gid'])->select();
      	 		
      	 		$game_list[$k]['server_info'] = $server_list;
      	 	}
      	 	$this->assign('game_list',$game_list);
      	
      	 	
      	 	$this->pc->head();
      	 	
      	 	$this->display(TMPL_PATH.$this->config['THEME'].'/card.html');
      	 	$this->pc->footer();
      	 	 
      	 }
      	 /**
      	  * @NAME 更新用户资料
      	  */
      	 public function update(){
      	 	$data['nickname'] = trim($_POST['nickname']);
      	 	$data['phone'] = trim($_POST['phone']);
      	 	$data['safe_a'] = trim($_POST['safe_a']);
      	 	$data['safe_q'] = trim($_POST['safe_q']);
      	 	$data['gender'] = trim($_POST['gender']);
      	 	$map['username'] = $this->userinfo['username'];
      	 	$model = M('member');
      	 	$st = $model->where($map)->data($data)->save();
      	 	if(!$st){
      	 		$arr['state'] = "2";
      	 		$arr['msg'] = "更新失败,数据库系统发生错误,详情:".mysql_error();
      	 		die(json_encode($arr));
      	 	}
      	 	$arr['state'] = "1";
      	 	$arr['msg'] = "更新用户资料成功 ^ ^";
      	 	die(json_encode($arr));
      	 }
     }
?>