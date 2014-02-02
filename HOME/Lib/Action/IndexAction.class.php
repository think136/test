<?php

/*
 * 入口类，输出内容模板
 * 需要增加权限限制
 * 
 */


class IndexAction extends CommonAction {
    public function index(){
   		$this->display();
    }
    
    public function time(){
    	$times = date("Y-m-d H:i:s");
    	//echo $times;
    	//echo date("Y-m-d H:i:s",time());
    	
    	//date("Y-m-d H:i:s")     时间格式化函数
    	//time() 时间戳函数，获取当前的Linux秒数，从1970-1-1-00：00:00  开始计算
    	//echo time();
		
		import('HOME.Util.tool');
		
		$a= new tool();
		$b = $a->ipunz(3699931414);
		echo $b;
    }
}