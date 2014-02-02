<?php

class JsonAction Extends Action{
	function Index(){
		echo "Class It's Work!";	
	}
	
	function test(){
		$arr['part1']="json Test";
		$arr['part2']="json Test2";
		$arr2['A']['a']="Json A";
		$arr2['A']['b']="Json B";
		$arr2['A']['c']="Json C";
		$arr2['B']['a']="2Json A";
		$arr2['B']['b']="2Json B";
		$arr2['B']['c']="2Json C";
		$this->ajaxReturn($arr2,'json');		
	}	
	
	function Jsondecode(){
		$a = $_GET['action'];
		$b = json_decode($a);
		dump($b);	
		$c = $b->a;
		$d = $b->b;
		echo $c;
		echo $d;
		//{"A":{"a":"Json A","b":"Json B","c":"Json C"},"B":{"a":"2Json A","b":"2Json B","c":"2Json C"}}
	}
	function Jsonencode(){
		$arr2['A']['a']="Json A";
		$arr2['A']['b']="Json B";
		$arr2['A']['c']="Json C";
		$arr2['B']['a']="2Json A";
		$arr2['B']['b']="2Json B";
		$arr2['B']['c']="2Json C";
		
		$json = json_encode($arr2);
		echo $json;
	}
	
	function str( $length = 20 ) {  

		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
		//$str = ”;  
			for ( $i = 0; $i < $length; $i++ )  
				{  
					// 这里提供两种字符获取方式  
					// 第一种是使用 substr 截取$chars中的任意一位字符；  
					// 第二种是取字符数组 $chars 的任意元素  
					// $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);  
					$str.=$chars[ mt_rand(0, strlen($chars) - 1) ];  
				}  
					echo $str;  
				}
} 

?>