<?php
class ChatAction Extends Action{
	
	public function Index(){
		
	}	
	
	public function Message(){
		$re = M('islive');	
		$res = $re  -> count();
		//dump($res);
		echo $res;      //['key'];  //->length();
	}
	
}
?>