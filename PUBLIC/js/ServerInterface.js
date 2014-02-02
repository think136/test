		/*
		 *	 THINK
		 * *****************************************
		 *              网络通信区代码
		 * *****************************************
		 *          2014年1月31日23:14:16
		 * 
		 */	
			
			
     var GetMsg=1000;       //消息请求时间             设置项        //初始化值  
     var GetLive=5000;      //在线用户请求时间    设置项
     var GetStatus=10000;    //心跳提交时间         设置项
     
     
	function MsgToServer(id,msg){
		/*
		 * 消息提交通信方法
		 * 
		 */
		//组装消息对象
		if(msg!=null){
			msgarr =new Object;
			msgarr.msg="{\"to\":\"" + id + "\",\"msg\":\"" + msg + "\"}";
			msgarr.t=Math.random();
				
			$.ajax({
				type:"GET",
				url:"index.php/ChatIn?",
				data:msgarr,
				success:function(a){
					if(a.code==1){
						//alert("数据提交成功！");
					}
				}
			});  //ajax结束符  
		}
	}     
     

			
			
	function check(){
		//消息检查方法
		chkarr = new Object;
		chkarr.check = "{\"user\":\"1000000\"}" ;
		chkarr.t=Math.random();
						
		$.ajax({
			type:"GET",
			url:"index.php/ChatEven",
			data:chkarr,
			success:function(a){
			$("#even").val(a);
				if(a==0){	GetMsg=5000;}                    //动态时间       没有消息时调高轮询等待时间
				if(a>0&&a<9){GetMsg=1000;}
				if(a>10){GetMsg=100;}                        //动态时间       消息多时降低轮询等待时间
				if(a!=0){
					$.ajax({
						type:"GET",
						url:"index.php/ChatOut",
						success:function(cbjson){
							back = new String;
							back = "<div class=\"getmsgbox\">" + "用户：" + cbjson.from + "   |   " + cbjson.date + "<p>" + cbjson.msg  + "</p></div>";
								
							ch1 = new String;
							ch1 = "#" + cbjson.from;
								
							if(document.getElementById(cbjson.from)==null){
								//要是这个消息的目的路由终点不存在，就新建一个
								//保证数据不丢失
								newchat(cbjson.from);
									//同时要给点提示才行
							}
									//组装回调消息路由选择器
							ch2 = new String;
							ch2 = "#" + cbjson.from + " .chat-msg";     //设置消息要去往的地方
							$(ch2).append(back);     // 向目的消息框写入信息；
							SetMsgDisplay(cbjson.from);
							SetMsgAlert(cbjson.from);
						}
					});
				}
			}   //第一个ajax请求的cellback结束符
		});  //第一个ajax函数结束
		setTimeout("check()",GetMsg);
	} check();	



	function getLive(){
		//在线用户显示
			$.ajax({
				Type:"GET",
				url:"index.php/isLive",
				success:function(data){
					if(data!=null){
						$("#liveuser ul li").detach();    //将老的数据清除掉
							for(var i=0 ; i<data.length ;i++){
								back = "<li class=\"live\" onclick=\"newchat(" + data[i]['uid'] + ")\">"  + data[i]['uid'] + "</li>";
								$("#liveuser ul").append(back);
							}
						}
				}
			});
			setTimeout("getLive()",GetLive);
	} getLive();	



	function getStatus(){
		//心跳提交方法
		//心跳机制
		$.ajax({
			Type:"GET",
			url:"index.php/UserStatus"
		});
		setTimeout("getStatus()",GetStatus);
	} getStatus();	
	
	function getFriends(){
		//获得好友方法
		//请求好友列表，填充进页面
		//免参数接口
		$.ajax({
			Type:"GET",
			url:"index.php/Friends",
			success:function(json){
				$("#livefriends ul li").detach();    //将老的数据清除掉
				for(var i=0; i<json.length; i++){
					back = "<li class=\"live\" onclick=\"newchat(" + json[i]['fid']  + ")\">"  + json[i]['name'] + "</li>";
					$("#livefriends ul").append(back);
				}
				setTimeout("getFriends()",GetLive);
			}
		});
	} getFriends();
	
	
	
	
		$(function(){
		/*
		 * @THINK 2014-2-1 16:20:27       //通信代码
		 *     好友查询函数
		 */
		
		$("#addfriend .search").click(function(){
			kw = new String;
			kw["kw"] = $("#addfriend input").val();	
			$.ajax({
				Type:"GET",
				url:"index.php/Friends/finduser",
				data:kw,
				dataType:"json",
				success:function(data){
					if(data==0){
						$("#addfriend ul .tr").detach();
						str = "<li class=\"tr\">没有找到符合条件的好友！</li>";
						$("#addfriend ul").append(str);
					}else{
						$("#addfriend ul .tr").detach();
						for(var i=0; i<data.length; i++){
							str = "<li class=\"tr\">" + data[i]['id'] + "   |    " + data[i]['name'] + "| <span onclick=\"SendCommpToServer(" + data[i]["id"] + ",1)\">添加</span></li>";
							$("#addfriend ul").append(str);
						}
					}
				} //回调结束
			});
		});
	});
			