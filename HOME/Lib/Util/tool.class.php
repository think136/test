<?php
class tool{
	
	/*
	 * 工具类，用于各种常用操作转换
	 * THINK 2014年1月31日3:58:15
	 * 
	 */
	
	public function ipz($ip){
		//IP转换函数，传入一个IP地址段，返回一个十进制IP地址数
		$iparr = explode('.',trim($ip));
		$A = $iparr[0];
		$B = $iparr[1];
		$C = $iparr[2];
		$D = $iparr[3];
		$res = $A*256*256*256 + $B*256*256 + $C*256 +$D;
		return $res;
	}
	
	public function ipunz($ip){
		//IP地址转换函数，传入一个IP地址，返回一个IP地址字符串
		$ipint = $ip;
		$A = (int)($ipint/(256*256*256));
		$B = (int)(($ipint - $A*256*256*256)/(256*256));
		$C = (int)(($ipint - $A*256*256*256 - $B*256*256)/256);
		$D = (int)($ipint - $A*256*256*256 - $B*256*256 - $C*256);
		$res = $A.".".$B.".".$C.".".$D;
		return $res;
	}
}

?>