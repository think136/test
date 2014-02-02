<?php

/*
 * 获得当前在线用户的用户ID 
 * 
 * 返回一个json数据
 * 
 */

class isLiveAction Extends Action{
	public function Index(){
		
		$dbobj=M('islive');
		$str = "uid !=".$_SESSION['uid'];  //在线列表将自身屏蔽
		$res=$dbobj->where($str)->field('uid')->select();
		//dump($res);
		$this->ajaxReturn($res);
	}
}

?>