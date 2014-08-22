<?php 
 
  class GameViewModel extends ViewModel{ 	
  		public $viewFields  = array(
  				'game'=>array('gid','game_starttime','sort','gamename','tag','gametype','isdisplay','_type'=>'LEFT'),
  				'gametype'=>array('id','typename','_on'=>'game.gametype=gametype.id'),
  		);
  }
?>