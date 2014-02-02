<?php

/*
 *消息获取接口
 *
 *1、传入用户ID   或者在session中取
 *2、返回用户消息暂存表中的消息
 *3、将已经取出的消息放入历史消息表
 *
 */

class ChatOutAction Extends CommonAction{
	//获得未读消息
	//获得已读历史消息
	function Index(){
		//每次获得一条数据的方法
		$getmsg['touser']=$_SESSION['uid'];                   //获取当前登录的用户
		$urdb=M('msgtem');                               //实例化数据库操作对象
		
		//$res=$urdb->find();   //执行数据取出操作       [每次只读取出一条数据]
		$res=$urdb->where($getmsg)->find();   //执行数据取出操作
	
		$msgreturn['from']=$res['user'];              //包装数据返回数组
		//$msgreturn['date']=$res['date'];
		$msgreturn['date']=date("Y-m-d H:i:s",$res['date']);
		$msgreturn['msg']=$res['content'];
		
		$hisarr['user']=$res['touser'];                    //包装历史消息写入数组
		$hisarr['fromuser']=$res['user'];
		$hisarr['content']=$res['content'];             
		$hisarr['date']=$res['date'];
		$hisarr['ip']=$res['ip'];                              //包装历史消息写入数组
		
		
		//$hisarr2['user']=$_SESSION['uid'];
		//$hisarr2['']
		
		if($hisarr['user']!=null&&$hisarr['fromuser']!=null){
			//如果这个消息是有效消息，才给响应
			$hisdb=M('history');                               //实例化写入操作对象
			$wrires=$hisdb->add($hisarr);                //执行历史写入操作
			$delid=$res['id'];                                     //获得读出消息ID
			$urdb->Delete($delid);                          //执行读出数据销毁操作
			$this->ajaxReturn($msgreturn,'json');     //操作都执行完了，给用户响应请求
		}
	}
	
	function GetOldMsg(){
		//历史消息记录获取接口
		$page = $_GET['p'];
		$pageper = 10;
		$user['user'] = $_SESSION['uid']; //获得操作对象
		//$user['fromuser'] = $_SESSION['uid']; // 
		$dbobj = M('history');
		$count = $dbobj->where($user)->count();   //数据的总数
		$totle = (int)($count/$pageper)+1;      //数据页的总数
		$ps;
		$pe;
		if($page==null || $page==1){
			$ps = 1;
			$pe = 10;
		}else{
			$ps = 1  + ($page-1)*$pageper;
			$pe = $pageper + ($page-1)*$pageper;
		}
		$return['totle']=$totle;
		$return['page']=$page;
		$dbobj2 = M();
		$sql = "SELECT tk_history.fromuser,tk_user.name,tk_history.content,tk_history.date FROM tk_history LEFT JOIN tk_user ON tk_history.fromuser=tk_user.id WHERE(tk_history.user=".$_SESSION['uid'].") limit ".$ps.",".$pe ;
		$res = $dbobj2->query($sql);
		for($i=0; $i<count($res); $i++){
			$return['data'][$i]['id'] = $res[$i]['fromuser'];
			$return['data'][$i]['user']=$res[$i]['name'];
			$return['data'][$i]['content']=$res[$i]['content'];
			$return['data'][$i]['date']=date("Y-m-d H:i:s",($res[$i]['date']));
		}
	//	echo $sql;
		$this->ajaxReturn($return);
		//，历史消息表，改善点：  取消消息来源，  消息归属人，消息来源，消息类型（发送？接受）
	}

	public function historymsg(){
		
		import('ORG.Util.Page');
		
		$user['user'] = $_SESSION['uid'];
		
		$dbobj = M('history');
		
		$count = $dbobj->where($user)->count();
		
		$page = new Page($count,15);
		
		$pageshow = $page->show();
		
		$res = $dbobj->where($user)->field('tk_user.name,tk_history.user,tk_history.fromuser,tk_history.content,tk_history.date,tk_history.ip')->join("LEFT JOIN tk_user ON tk_history.fromuser=tk_user.id")->limit($page->firstRow.','.$page->listRows)->select();
		
		for($i=0; $i<count($res); $i++){
			$res[$i]['date']=date("Y-m-d H:i:s",($res[$i]['date']));
		}
		
		$this->assign('res',$res);
		
		$this->assign('page',$pageshow);
		
		$this->display();
	}



	

	
}
?>