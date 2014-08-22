<?php

class GameViewModel extends ViewModel
{
  public $viewFields = array( 

  'server'=>array('sid','servername','start_time','server_url','status','_type'=>'LEFT'), 

   'game'=>array('gid','sort','gamename','tag','desc1','gamepic','game_web','gametype','_on'=>'game.gid=server.gid')
 ); 

}
?>