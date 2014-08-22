<?php
     /**
      * @name 游戏大厅控制器
      * 
      * @access private 
      * 
      * @package app
      * 
      * @author 
      */
     class HallAction extends CommonAction
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
     	 	
     	 	$game = D('GameView');
     	 	$gametype = M('gametype');
     	 	$server = M('server');
     	 	$hot_game = $game->where('game.ishot=0')->order('game.sort desc,server.add_time desc')->find();
     	 	$type = $gametype->where('id ='.$hot_game['gametype'])->find();

     	 	$this->assign('hot_game',$hot_game);
     	 	$this->assign('type',$type);
     	 	
     	 	#####游戏记录查询######
     	 	if($this->userinfo['username']!=""){
     	 		$model = D('GlogView');
     	 		$user['game_log.username'] = $this->userinfo['username'];
     	 		$history = $model->where($user)->order('game_log.logintime desc')->limit('3')->select();
     	 		if($history!=null){
     	 			$this->assign('history',$history);
     	 		}else{
     	 			$model = M('game');
     	 			$cd['isdisplay'] = 0;
     	 			$ginfo = $model->where($cd)->order("addtime desc")->limit("3")->select();
     	 			$this->assign('no_history',$ginfo);
     	 		}
     	 	}
     	 	$this->pc->head();
            $this->display(TMPL_PATH.$this->config['THEME'].'/hall.html');
            $this->pc->footer();
      	 }
      	 
      	 
      	 public function server_info()
      	 {
      	 	$gid = $_GET['gid'];
      	 	$arr['msg'] = '暂未获取新手卡信息！请联系管理员';
      	 	$arr['state'] = '1';
      	 	$game = M('game');
      	 	$server = M('server');
      	 	$gametype = M('gametype');
      	 	$game_list = $game->where('gid = '.$gid)->select();
      	 	$type = $gametype->where('id ='.$game_list[0]['gametype'])->getField('typename');
      	 	$arr[$gid]['hall']['hall_detail_desc'] = $game_list[0]['content'];
      	 	$arr[$gid]['hall']['hall_game_type'] = $type;
      	 	//$arr[$gid]['hall']['hall_game_character'] ='玄幻修真 ';
      	 	$arr[$gid]['hall']['hall_game_state'] ='火爆开启 ';
      	 	$arr[$gid]['hall']['hall_game_popularity'] ='2323 ';
      	
      	 	$server_list = $server->where('gid='.$gid)->order('sid desc')->select();
      	 	
      	 	foreach ($server_list as $k=>$v)
      	 	{
      	 		$arr[$gid]['servers'][$k]['status'] ='正常开启';
      	 		$arr[$gid]['servers'][$k]['id'] = $v['sid'];
      	 		$arr[$gid]['servers'][$k]['name'] = $v['servername'];
      	 		$arr[$gid]['servers'][$k]['line'] = $v['line'];
      	 		$arr[$gid]['servers'][$k]['desc'] = $v['line'];
      	 		if( $v['status']=='0'){
      	 		$arr[$gid]['servers'][$k]['is_recommended'] = '34';
      	 		}
      	 	}
      	 	die(json_encode($arr));
      	 }
     }