<?php
   /**
    * @name 文章视图 
    * 
    * @todo 连接文章类别表和文章表
    */
   class ArticleViewModel extends ViewModel
   {
   	   public $viewFields = array(

   	   		'category' => array('typename'),
   	   		'article'  =>array('aid','title','typeid','titlecorlor','addtime','status','_on'=>'category.typeid=article.typeid')
   	   );
   }
?>