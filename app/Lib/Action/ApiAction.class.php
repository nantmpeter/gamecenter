<?php 
/**
* author wjy
**/
class ApiAction extends Action {

	public function charge()
	{
		$type = $_GET['type'];
		if($type) {
			$model = M('charge');
			$r = $model->where(array('type'=>$type))->select();
			echo json_encode($r);
		}else{
			echo '<h1>404</h1>';
		}
	}
}
 ?>