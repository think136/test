<?php

/*
 * 好友操作接口类
 * 
 * 功能：获取好友列表，获得待确认好友列表，添加好友，删除好友，确认添加好友
 * 
 * 数据环境：tk_fmatch表
 * id[int]  uid[int]  fid[int]  status[tinyint]  creatdate[int]   changedate
 * 
 * status=1  有效好友      status=2 待确认好友       status=3 等待对方确认      status=0删除好友
 * 
 */

class FriendsAction Extends CommonAction{
	
	public function Index(){
		//默认方法，调用这个方法，返回当前用户的好友列表
		if($_SESSION['uid']!=NULL&&$_SESSION['uid']!=""){
			//$select['uid']=$_SESSION['uid'];
			//$select['status']=1;
			
			$sql = "SELECT tk_fmatch.fid,tk_user.name FROM tk_fmatch LEFT JOIN tk_user ON tk_user.id=tk_fmatch.fid WHERE(tk_fmatch.uid=".$_SESSION['uid']." AND tk_fmatch.status=1)";
			$dbobj = M();
			$res = $dbobj->query($sql);
			
			
			//$dbobj=M('fmatch');
			//$res=$dbobj->where($select)->field('fid')->select();
			$this->ajaxReturn($res);
		}
	}
	
	public function finduser(){
		/*
		 * 好友查找方法
		 * 传入好友的ID或者是用户名，返回查询结果。
		 * 
		 */
		
		if($_GET['kw']){
			$kw = $_GET['kw'];
			$kc = (int)$kw;
			$dbobj = M();
			$res;
				if($kc==0){
					$sql = "SELECT id,name FROM tk_user WHERE( name LIKE \"%".$kw."%\")";
					$res = $dbobj->query($sql);	
					$this->ajaxReturn($res);
				}else{
					$sql = "SELECT id,name FROM tk_user WHERE( id=".$kw." OR name LIKE \"%".$kw."%\")";
					$res = $dbobj->query($sql);	
					$this->ajaxReturn($res);
				}
		}
	}
	
	
	
	public function checkout(){
		//待确认好友列表，调用这个方法，返回当前登录用户待添加的好友列表。
		if($_SESSION['uid']!=NULL&&$_SESSION['uid']!=""){
			$dbobj = M();
			$sql = "SELECT tk_fmatch.fid AS id,tk_user.name FROM tk_fmatch LEFT JOIN tk_user ON tk_fmatch.fid=tk_user.id WHERE status=2 AND uid=".$_SESSION['uid'];
			$res = $dbobj->query($sql);
			$this->ajaxReturn($res);
		}
	}
	
	public function checkin(){
		//确认好友方法，传入参数，确认这个好友。
		/*
		 * 业务逻辑：
		 * 1、要有这个id值代表的用户等待确认，不能凭空产生非法数值
		 * 2、只能确认自己的好友，不能确认别人的好友
		 * 
		 * 3、在添加后要在双方好友列表中显示对方   ***
		 * 
		 * 只能确认匹配状态为2的好友，状态不为2的返回没有
		 * ps：此操作只为防止外部错误提交
		 * 
		 */
		
		if($_SESSION['uid']!=NULL&&$_SESSION['uid']!=""){
			$dbobj=M('fmatch');
			$select['uid']=$_SESSION['uid'];      //确认自己好友列表中的记录
			$select['fid']=$_GET['check'];
			
			$select2['uid']=$_GET['check'];       //确认对方的请求，在对方的好友列表中状态置为正常
			$select2['fid']=$_SESSION['uid'];
			
			$ckre=$dbobj->where($select)->field('status')->find();

			if($ckre!=NULL){
				if($ckre['status']==2){
						$chenkin['status']=1;
						$res=$dbobj->where($select)->save($chenkin);    //执行修改操作，状态变为已确认状态       自己列表
					         	$dbobj->where($select2)->save($chenkin);  //对方列表
						$return['code']=1;
						$return['msg']="操作成功，服务器已经受理！";
						$this->ajaxReturn($return);
				}else{
						$return['code']=0;
						$return['msg']="添加用户失败，可能已经添加";
						$this->ajaxReturn($return);
				}
			}else{
					$return['code']=0;
					$return['msg']="添加用户失败！好友列表中不存在此用户！";
					$this->ajaxReturn($return);	
			}
			
			//存在问题：在确认的时候，应当是成对的进行确认，双方的状态都应该置为1    问题已经修正  2014年1月28日2:44:55 think
		}
	}
	
	
	public function addfriend(){
		//好友添加方法，传入参数，向对方请求添加
		/*
		 * 业务逻辑：
		 * 1、传入的这个参数是对方好友的id、而不是自己的id
		 * 2、传入的id需要在用户表中存在才行
		 * 
		 */
		$dbobjmatch=M('fmatch');
		$dbobjuser=M('user');
		if($_GET['add']&&$_SESSION['uid']!=NULL&&$_SESSION['uid']!=""){
			
			/*
			 * 赋值写法：写在一起联合赋值，后期调整不容易调整
			 * 			$uchk['id']=$addme['fid']=$adduser['uid']=$_GET['add'];
			 * 			$addme['uid']=$adduser['fid']=$_SESSION['uid'];
			 * 			$adduser['creatdate']=$adduser['changedate']=$addme['creatdate']=$addme['changedate']=time();
			 */
			 
				$getA=$_GET['add'];                    //通过中间值的方式，既能便于调整，也便于修改。
				$sessA=$_SESSION['uid'];
				 
				$addme['fid']=$getA;                 //get
				$addme['uid']=$sessA;              //session
				$addme['creatdate']=time();
				$addme['changedate']=time();
				
				$adduser['uid']=$getA;               //get
				$adduser['fid']=$sessA;              //session
				$adduser['creatdate']=time();
				$adduser['changedate']=time();

			
			if($dbobjuser->field('id')->where($uchk)->find()!=NULL){
					//将要添加的用户是不是在用户表中存在
					//两个人的好友记录必然是成对出现的

					$matchchk['uid']=$_SESSION['uid'];
					$matchchk['fid']=$_GET['add'];
					
				
					if($dbobjmatch->where($matchchk)->find()==NULL){
							//echo  "Hi!";
							//此处已经做检查，数据库中已经有好友匹配记录的，将不能再次添加，否则返回失败信息
							//修改点：好友匹配表中已经存在匹配记录的，不允许再次写入。   问题已经修正   2014年1月28日2:45:36   think
							$adduser['status']=2;                    //写入状态码
							$addme['status']=3;                     //写入状态码
							$dbobjmatch->add($adduser);    //写入好友匹配记录 【对方列表】
							$dbobjmatch->add($addme);      //写入好友匹配记录 【我的列表】
							
							$return['code']=1;                       //返回成功信息
							$return['msg']="操作成功，服务器已经受理！";
							$this->ajaxReturn($return);
					}else{
							$return['code']=0;                       //返回失败信息
							$return['msg']="操作失败，已经存在好友记录！";
							$this->ajaxReturn($return);
					}
								//存在问题：要是表中存在逻辑删除记录就糟糕了
								//修改思路：在判断条件中增加好友状态的判断条件
			}
		}
	}
	
	
	public function delfriend(){
		//好友删除方法，传入一个参数，将好友置为删除状态。
	}
} 
?>