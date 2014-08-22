<?php 
class inc extends Think
{
public function config(){
$webconfig = M('webconfig');
$info = $webconfig->find();

$arr ['appid'] = $info['appid'];
$arr ['appkey'] =  $info['appkey'];
$arr ['callback'] = $info['domain'].'/open/callback';
$arr ['scope'] = 'get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo,check_page_fans,add_t,add_pic_t,del_t,get_repost_list,get_info,get_other_info,get_fanslist,get_idolist,add_idol,del_idol,get_tenpay_addr';
$arr ['errorReport'] = 'true';
$arr ['storageType'] = 'file';
$arr ['host'] = 'localhost';
$arr ['user'] = 'root';
$arr ['password'] = 'root';
$arr ['database'] = 'test';
 return  json_encode ( $arr ) ;
}
}
?>

