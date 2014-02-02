<?php
/*
 * 用户注册类
 * 功能：注册相关功能实现
 * THINK  2014年1月29日21:38:03
 * 
 */
class RegAction extends  Action{
	
	public function Index(){
		//默认方法，用于输出显示模板
		$this->display();
	}
	
	public function DoReg(){
		//用户注册接口，接受表单，返回成功信息！
		$chk['name']=$reg['name'] = $_GET['user'];
		//$reg['pass'] = MD5($_GET['pass']);
		$reg['pass'] = $_GET['pass'];   //调试阶段暂时使用明文
		$dbobj = M('user');
		if($dbobj->where($chk)->field('name')->find()==null){
			//二次注册检查
			$res = $dbobj->add($reg);
			if($res){
				$return['code']=1;
				$return['msg']="操作成功，服务器已经受理！";
				$this->ajaxReturn($return);
			}else{
				$return['code']=0;
				$return['msg']="操作失败！服务器响应超时！";
				$this->ajaxReturn($return);
			}
		}else{
			$return['code']=0;
			$return['msg']="操作失败！该用户已经被注册！";
			$this->ajaxReturn($return);
		}
	}
	
	
	public function Check(){
		//检查用户是否已经被注册过
		$user['name'] = $_GET['check'];
		$dbobj = M('user');
		$res = $dbobj->where($user)->field('name')->find();
		if($res){
			$return['code']=0;
			$return['msg']="操作失败！该用户已经被注册！";
			$this->ajaxReturn($return);
		}else{
			$return['code']=1;
			$return['msg']="该用户可以注册！";
			$this->ajaxReturn($return);
		}
	}
	
	
}


?>