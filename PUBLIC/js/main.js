/*
function test(){
	alert("Hi!");
     			
}
*/
     var GetMsg=1000;       //消息请求时间           设置项        //初始化值  
     var GetLive=5000;      //在线用户请求时间    设置项
     var GetStatus=5000;    //在线状态请求时间    设置项
        	
   $(document).ready(function(){
       //文档载入完毕后执行函数
		$("#send").click(function docheck(){
			msgarr =new Object;
			msgarr.msg="{\"to\":\"" + $("#touser").val() + "\",\"msg\":\"" + $("textarea").val() + "\"}";
			msgarr.t=Math.random();
			msgdisplay = new String;
			msgdisplay = "<div ><p class=\"sendmsg\">" + "我对" + $("#touser").val() + "</br>说：" + $("textarea").val() + "</p></div>";
			$("#msg").append(msgdisplay);
			$("textarea").val("");
					
			$.ajax({
				type:"GET",
				url:"index.php/ChatIn?",
				data:msgarr,
				success:function(a){
					if(a.code==1){
						alert("数据提交成功！");
					}
				}
			});  //ajax结束符  
		}); //监听事件结束符
	});  //初始化函数结束符
			
			
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
			if(a>0&&a<9){GetMsg=1000};
			if(a>10){GetMsg=100;}                        //动态时间       消息多时降低轮询等待时间
			if(a!=0){
				$.ajax({
					type:"GET",
					url:"index.php/ChatOut",
					success:function(cbjson){
							back = new String;
							back = "<div ><p class=\"getmsg\">" + "用户：" + cbjson.from + "     时间:" + cbjson.date + "</br>内容：" + cbjson.msg  + "</p></div>";
							$("#msgbox").append(back);
					}
									
				});
			}
		}   //第一个ajax请求的cellback结束符
	});  //第一个ajax函数结束
	setTimeout("check()",GetMsg);
} check();





				
function getLive(){
		$.ajax({
			Type:"GET",
			url:"index.php/isLive",
			success:function(data){
			$(".live").detach();
				for(var i=0 ; i<data.length ;i++){
					back = "<li class=\"live\">" + "在线用户：" + data[i]['uid'] + "</li>";
					$("#liveuser").append(back);
				}
			}
		});
		setTimeout("getLive()",GetLive);
} getLive();
				
				
function getStatus(){
	$.ajax({
		Type:"GET",
		url:"index.php/UserStatus"
	});
	setTimeout("getStatus()",GetStatus);
} getStatus();
				