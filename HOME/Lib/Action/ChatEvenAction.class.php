<?php

 
 

 
 
 class ChatEvenAction Extends CommonAction{
	public function Index(){
		/*
		 *消息状态接口
		 *1、传入用户ID
		 *2、返回该ID在消息暂存表中的消息条数
		 *
		if($_GET['check']!=null){
	 		 $arr = json_decode($_GET['check']);	
	 		 $check['touser']=$arr->user;
			 $chk=M('msgtem');
	 		 $res=$chk->where($check)->count('touser');
	 		 echo $res;
		}else{
			echo "0";
		}
		 */
		 
 	 	 /*
 		  *获取当前登录的用户
		  *自动返回当前暂存表中有多少数据
		  *
		  *
 		  */
 		  
 		  	 $check['touser']=$_SESSION['uid'];
			 $chk=M('msgtem');
	 		 $res=$chk->where($check)->count('touser');
	 		 echo $res;
		 
 	}	
 }
?>