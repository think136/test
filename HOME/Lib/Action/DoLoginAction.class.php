<?php

class DoLoginAction Extends Action{
	
	public function Index(){
		//用户登录界面显示方法
		
		//echo "Hi";
		$this->display();
	}
	
	public function doLogin(){
		//用户登录方法
		if($_POST){
			$username=$_POST['user'];
			$password=$_POST['pass'];
			//$checkcode=$_POST['code'];	       //获取验证码
			if($username==NULL||$password==NULL){
				$this->error("用户名或者密码不能为空！");	
			}else{
				$dbobj=M('user');
				$chkarr['name']=$username;
				$chkarr['pass']=$password;
				$res=$dbobj->where($chkarr)->select();
				if($res){
					$_SESSION['uid']=$res[0][id];   //设置SESSION
					$this->success("登录成功！","__APP__");
					$livedb=M('islive');           //写入在线状态记录
					$chk2=$livedb->where($userid)->find(); 
					
					if($chk2){
						//这里修正一个用户因登录多次而写入多次在线消息的bug
					}else{

						$liveinfo['uid']=$res[0][id]; 
						$liveinfo['timestamp']=time();
						$livedb->add($liveinfo);						
					}
				}else{
					$this->error("用户名或者密码错误！");	
				}
			}
		}
	}	
	
	
	public function doLogout(){
		//用户登出方法
			$_SESSION=array();
				if(isset($_COOKIE[session_name()])){
					setcookie(session_name(),'',time()-1,'/');
				}
			session_destroy();
			$this->redirect('DoLogin/Index');    //页面跳转
	}
	
	public function code(){
		//验证码生成方法
		//session名：image_code
		import('HOME.Util.code');
		$codeobj = new code();
		$codeobj->show();
	}
	

	
	
}

?>