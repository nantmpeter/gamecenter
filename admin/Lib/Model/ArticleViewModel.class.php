<?php
/***********************************************************
	@function article 视图模型

    @Filename ArticleViewModel.class.php $


*************************************************************/
class ArticleViewModel extends ViewModel
{
	public $viewFields = array( 

  'article'=>array('aid','typeid','title','addtime','istop','hits','status','isflash','ishot','_type'=>'LEFT'), 

  'category'=>array('typename', '_on'=>'article.typeid=category.typeid'), 

 ); 

}
?>