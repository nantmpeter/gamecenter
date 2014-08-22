<?php
   /**
    * @name RBAC角色权限控制 视图
    * 
    * @author lostman$ (leefongyun@gmail.com)
    * 
    * @todo 链接角色权限访问表 和 后台菜单表
    */
   class RbacViewModel extends ViewModel{
   	
   	  public $viewFields =array(
   	  		
   	  		'category_list' => array('id','category','module_alias','fid','listorder'),
   	  		'role_access' => array('access_id','role_id','parent_module','parent_module_alias','access_fid','module','access_name','_on'=>'category_list.id=role_access.access_id')
   	  		
   	  );
   }
?>