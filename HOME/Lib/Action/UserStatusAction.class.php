<?php

/*
 * 用户在线状态保持方法
 * 
 * 获取当前用户的用户key，更新这个key的时间戳
 * 
 * 删除超时的时间戳
 * 
 * Think 2014年1月25日
 * 
 * 每次操作只更新用户自己的key-timestamp ，删除表中所有的超时数据
 */

class UserStatusAction Extends Action{
	
	public function Index(){
		
		//echo "Hello!";	
		if($_SESSION['uid']){
			
			/*
			 * 干脆都不需要传入参数了，直接从session里面读
			 * 
			 */
			 
			 echo "Hi";
			$userid['uid']=$_SESSION['uid'];
			$nowtime=time();                       //获取当前时间
			$timeout=$nowtime - 40;               //设置超时时间为40秒超时
			$timestamparr['timestamp']=$nowtime;     //=time();  不能这样写，可能会有异常      //获取当前时间
			$dbobj=M('islive');  
			$chk=$dbobj->where($userid)->find();    //查询该Key在数据库中是否存在   ||
			if($chk){
													 //如果这个key在数据库中存在，就开始执行操作   ||这个是存在才操作
				$dbobj->where($userid)->save($timestamparr);    //执行数据库的时间戳更新操作
													     //参数组装
				         //执行删除超时记录
				$dbobj2=M();
				$Str="DELETE FROM `tk_islive` WHERE `timestamp` < ";
				$Str2=$Str.$timeout;
				$dbobj2->query($Str2);
				
			}else{
				//修正关闭浏览器，session没有丢失，又打开浏览器不显示在线的bug
				if($_SESSION['uid']!=null&&$_SESSION['uid']!=" "){
					//严格检查，为空不行，带空格的也不行
					$livedb=M('islive');           //写入在线状态记录
					$chk2=$livedb->where($userid)->find(); 
					if($chk2){
						echo "hello!";
					}else{
						$liveinfo['uid']=$_SESSION['uid']; 
						$liveinfo['timestamp']=time();
						$livedb->add($liveinfo);
					}
				}
			} 
		
		/*
		 * 
		 * 
		 * 
		if($_GET['key']){
			$userkey['key']=$_GET['key'];
			$nowtime=time();                       //获取当前时间
			$timeout=$nowtime - 60*10;               //设置超时时间为10分钟
			$timestamparr['timestamp']=$nowtime;     //=time();  不能这样写，可能会有异常      //获取当前时间
			$dbobj=M('islive');  
			$chk=$dbobj->where($userkey)->find();    //查询该Key在数据库中是否存在
			if($chk){
													 //如果这个key在数据库中存在，就开始执行操作
				$dbobj->where($userkey)->save($timestamparr);    //执行数据库的时间戳更新操作

				//$sql="timestamp<" + $timeout;               //参数组装
				//$dbobj->where('timestamp<' + $timeout)->delete();           //执行删除超时记录
				$dbobj2=M();
				$Str="DELETE FROM `tk_islive` WHERE `timestamp` < ";
				$Str2=$Str.$timeout;
				$dbobj2->query($Str2);
			}    
		 * 
		 * 
		 */
		}
	}

	public function isLive(){
		
	}
}

?>