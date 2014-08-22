<?php
    /**
     * @name 游戏登陆控制器
     * 
     * @access private 
     * 
     * @author 31wan team
     * 
     * @version 2.0
     *
     */
    class GameAction extends CommonAction
    {
    	/**
    	 * @name 游戏登陆
    	 */
    	public function login(){
    		$public = A('Public');
    		$public->read_conf();
    		$config = F('basic');
    		$map['gid'] = (int)(trim($_GET['game']));
    		$map['sid'] = (int)(trim($_GET['server']));
    		$gid = $map['gid'];
    		$model = M('game');
    		$result = $model->where("gid={$gid}")->find();
    		if(!$result){
    			$this->error("对不起,该游戏不存在.请检查你的输入.",'/');
    		}
    		if($result['isdisplay']==1){
    			$this->error("对不起,该游戏已经关闭.请检查你的输入.",'/');	 
    		}
    		$smodel = M('server');
    		$res = $smodel->where($map)->find();
    		if(!$res){
    			$this->error("对不起,该服务器不存在.请检查你的输入.",'/');
    		}else if($res['start_time']>time()){
    			$this->error("对不起,该服务器尚未开放.开放时间为：".date('Y年m月d日 H:i',$res['start_time']),'/');
    		}else if($res['is_display']==1){
    			$this->error($res['stop_notice'],'10');
    		}
    	
    	if(!$this->userinfo){
    			redirect(U('accounts/login'));
    		}
    	
    		$import = import("@.Game.".$result['tag']."");
    		if(!$import){
    			$this->error('游戏登陆接口加载失败,请联系客服处理','/');
    		}
    		
    		$data = new $result['tag'];
    		if(!method_exists($data, "BeginLogin")){
    			$this->error('游戏登陆 方法不存在,请联系客服处理','/');
    		}
    	
    		//用户名、gameid、serverid、p_id、game_key
    		$arr['username']=$this->userinfo['username'];
    		$arr['game_key']=$result['game_key'];
    		$arr['p_id']=$result['p_id'];
    		$arr['serverid']=$res['serverid'];
    		$arr['gameid']=$res['gameid'];
    		
    		$game_url = $data->BeginLogin($arr);
    
    		$map['username'] = $this->userinfo['username'];
    		$log = M('game_log');
    		$logreslt = $log->where($map)->find();
    		$ucomm = uc_get_user($this->userinfo['username']);
    		list($uid, $username, $email) = $ucomm;
    		if(!$logreslt){
    			//增加记录
    			$i['uid'] = $uid;
    			$i['username'] = $this->userinfo['username'];
    			$i['gid'] = $map['gid'];
    			$i['sid'] = $map['sid'];
    			$i['logintime'] = time();
    			$i['loginip'] = get_client_ip();
    			$st = $log->data($i)->add();
    			if(!$st){
    				$this->error('登陆记录插入失败,请联系客服处理','/');
    			}
    		}else{
    			$logininfo['logintime'] = time();
    			$logininfo['loginip'] = get_client_ip();
    			$st = $log->where($map)->setField($logininfo);
    			if(!$st){
    				$this->error('登陆记录更新失败,请联系客服处理','/');
    			}
    		}
    		$this->assign('data',$data);
    		$this->assign('info',$result);
    		$this->assign('game_url',$game_url);
	     	$this->display(TMPL_PATH.$config['THEME'].'/game_login.html');
    		
    	}
    }
?>