<?php

class GamesViewModel extends ViewModel
{
  public $viewFields = array( 
 
  'game' =>array('gid','game_starttime','sort','gamename','ishot','tag','gametype','gamepic','content','desc1','game_web','game_bbs','game_guide','card','isdisplay','game_hit'),
  
  'gametype'=>array('id','typename','_on'=>'game.gametype=gametype.id')
  
 ); 

}
?>