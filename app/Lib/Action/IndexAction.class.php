<?php
/**
 * @name 首页控制器
 *
 * @access private
 *
 * @package app
 *
 * @author 31wan team
 */
	class IndexAction extends CommonAction
	{
	     public function index()
	     {

	     	 $public = A('Public');
	     	 $public->read_conf(); 
	     	 $config = F('basic');
	     	 //$public->head();
	     	 $head = $public->head();    //具体怎么获得这些头部和底部变量的值根据情况自定
	     	 $this->assign('head', $head);
	     	 ###获取最新开服列表##
	     	 $model = D('GameView');
             $map['server.is_display'] = "0";
	     	 $list = $model->where($map)->order('server.start_time desc')->select();	     	 
	     	 $this->assign('server_lists',$list);
	     	 #####获取本站游戏######
	     	 $game = D('GamesView');
	     	 $cond['game.isdisplay'] = "0";
	     	 if($config['GAME_SORT']=="0"){
	     	 	
	     	 $games_lists = $game->where($cond)->order('game.sort asc')->limit('8')->select();
	     	 }else{
	     	 	
	     	 $games_lists = $game->where($cond)->order('game.game_hit desc')->limit('8')->select(); 
	     	 }
	     	 $this->assign('games_list',$games_lists);
	     	 unset($games_lists);
	     	 ########幻灯处理########
	   
	     	 $ad = M('ad');
	     	 $ad_list = $ad->where('type =2 and status =0 ')->order('addtime desc')->limit('3')->select();
	     	 $this->assign('ad_list',$ad_list);
	     	 #########热点########
	     	 $article = M('article');
	     	 $art['typeid'] = "9";
	     	 $art['status'] = "0";
	     	 $a_list = $article->where($art)->order('addtime desc')->limit('5')->select();
	     	 $art['istop'] = "1";
	     	 $hot_top = $article->where($art)->order('addtime desc')->limit('1')->select();
	     	 if($hot_top==""){
	     	 $this->assign('hot_top','1');
	     	 }else{
	     	 $this->assign('hot_top',$hot_top);
	     	 }
	     	 $this->assign('hotart',$a_list);
	     	 unset($a_list);
	     	 unset($art);
	     	 unset($hot_top);
	     	 #########新闻########
	     	 $art['typeid'] = "7";
	     	 $art['status'] = "0";
	     	 $a_list = $article->where($art)->order('addtime desc')->limit('5')->select();
	     	 $art['istop'] = "1";
	     	 $news_top = $article->where($art)->order('addtime desc')->limit('1')->select();
	     	 if($news_top==""){
	     	 	$this->assign('news_top','1');
	     	 }else{
	     	 	$this->assign('news_top',$news_top);
	     	 }
	     	 $this->assign('news',$a_list);
	     	 unset($a_list);
	     	 unset($art);
	     	 unset($news_top);
	     	 #########活动########
	     	 $art['typeid'] = "8";
	     	 $art['status'] = "0";
	     	 $a_list = $article->where($art)->order('addtime desc')->limit('5')->select();
	     	 $this->assign('huodong',$a_list);
	     	 $art['istop'] = "1";
	     	 $huodong_top = $article->where($art)->order('addtime desc')->limit('1')->select();
	     	 if($huodong_top==""){
	     	 	$this->assign('huodong_top','1');
	     	 }else{
	     	 	$this->assign('huodong_top',$huodong_top);
	     	 }
	     	 unset($art);
	     	 unset($huodong_top);
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
	     	 $this->display(TMPL_PATH.$config['THEME'].'/index.html');
	     	 $public->footer(); 
	     }
	     public function build_server_json()
	     {
	     	 $model = D('GameView');
	     	 $map['server.is_display'] = "0";
	     	 $list = $model->where($map)->order('server.start_time desc')->select();
	     	 echo json_encode($list);
	     }
	     /*&
	      * @name 生成游戏列表
	      */
	     public function game_list()
	     {
	     	$public = A('Public');
	     	$public->read_conf();
	     	$config = F('basic');
	     	$this->assign('config',$config);
	     	$this->display(TMPL_PATH.$config['THEME'].'/game_list.html');
	     }
	     public function c()
	     {
	     	  $arr['callurl'] = 'http://'. $_SERVER['HTTP_HOST'] . U('pay/callback',array('paytag'=>'yeepay'));
	     	  echo $arr['callurl'];
	     }
	     public function d(){
	     	$c = D('game');
	     	$c->order('addtime desc')->where(' isdisplay=1')->limit(3)->select();
	     	echo $c->getLastSql();
	     }
	}