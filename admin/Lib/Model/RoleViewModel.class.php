<?php  
     /**
      * @name 角色权限控制 视图
      * @todo 不显示隐藏模块
      * @author lostman$ (leefongyun@gmail.com)
      */
    class RoleViewModel extends ViewModel
    {
    	public $viewFields = array(
    			
    			'role_access'=>array('role_id', 'access_id','access_fid','parent_module_alias','parent_module','module','access_name'),
    			 
    	
    			'category_list'=>array('category','module_alias','hidden','fid','listorder','_on'=>'category_list.id=role_access.access_id'),
    	    	
    	);
    }
?>