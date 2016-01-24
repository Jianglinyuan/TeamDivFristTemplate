<?php 
defined('G_IN_SYSTEM')or exit('no');
System::load_app_class('admin','','no');
class gonggao extends admin {
	
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class('model');
		$this->ment=array(
						array("navigation","公告管理",ROUTE_M.'/'.ROUTE_C),
						array("navigation","添加公告",ROUTE_M.'/'.ROUTE_C."/add"), 
		);
		
	}
	public function init(){
		$lists=$this->db->GetList("SELECT * FROM `@#_gonggao` where 1");		
		include $this->tpl(ROUTE_M,'gonggao_list');
	}
	
	public function add(){
		if(isset($_POST['submit'])){
		$title=htmlspecialchars(trim($_POST['title']));
		$content=htmlspecialchars(trim($_POST['content']));			 
		$this->db->Query("insert into `@#_gonggao`(`title`,`content`) values('$title','$content') ");	
			if($this->db->affected_rows()){
					_message("添加成功",WEB_PATH.'/'.ROUTE_M.'/'.ROUTE_C."/init");
			}else{
					_message("添加失败");
			}
		}
		include $this->tpl(ROUTE_M,'gonggao_add');
	}
	
	public function delete(){
		$id=intval($this->segment(4)); 
			$this->db->Query("DELETE FROM `@#_gonggao` WHERE (`id`='$id')");
			if($this->db->affected_rows()){
			
					_message("删除成功",WEB_PATH.'/'.ROUTE_M.'/'.ROUTE_C."/init");
			}else{
					_message("删除失败");
			}  
	}
	
	public function update(){
		$id=intval($this->segment(4));
		$slideone=$this->db->Getone("SELECT * FROM `@#_gonggao` where `id`='$id'");	
		
		if(isset($_POST['submit'])){
			$title=htmlspecialchars(trim($_POST['title']));	
			$link=htmlspecialchars(trim($_POST['content']));		
			$this->db->Query("UPDATE `@#_gonggao` SET `title`='$title',`content`='$link' WHERE `id`=$id");
			if($this->db->affected_rows()){
					_message("修改成功",WEB_PATH.'/'.ROUTE_M.'/'.ROUTE_C."/init");
			}else{
					_message("修改失败");
			}
		}
		include $this->tpl(ROUTE_M,'gonggao_update');
	}
	
	
}



?>