<?php

/*
 *消息传入处理接口
 *1、传入消息
 *2、处理传入消息，并写入数据库中
 *3、返回消息处理结果
 *
 */



	class ChatInAction Extends CommonAction{
		
		function Index(){

		if($_GET['msg']!=null){
				//$json = $_GET['msg'];              
				$arr = json_decode($_GET['msg']);      //获取Json字符串，转换成数组对象
				$msg['user'] = $_SESSION['uid'];                         //向数组中插入关键数据
				$msg['touser']=$arr->to;
				$msg['content'] =$arr->msg;
				$msg['date'] = time();
				$msg['ip']=get_client_ip();
				
				$add = M('msgtem');                            //实例化数据库操作对象
				$sta=$add->add($msg);                      //执行数据写入操作
				//dump($sta);
				if($sta){
					$status['code']=1;
					$status['message']='信息提交成功，服务器已经受理！';
					$this->ajaxReturn($status);
			
					
					//dump($status);
				}else{
					$status['code']=0;
					$status['message']='信息提交失败，服务器已经受理！';
				//	dump($status);
					$this->ajaxReturn($status,'json');
				}
			}else {
				echo "Work! Chat Interface";
			}
		}	
	}


?>