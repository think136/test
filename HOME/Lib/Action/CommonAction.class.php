<?php

/*
 * 
 * 权限控制父类
 * 
 * 继承该类，强制检查登录权限
 * 
 * 
 */


	class CommonAction extends Action{
		Public function _initialize(){
   		// 初始化的时候检查用户权限
   			if(!isset($_SESSION['uid']) || $_SESSION['uid']==''){
				$this->redirect('DoLogin/index');
			}
		}
	}
?>
