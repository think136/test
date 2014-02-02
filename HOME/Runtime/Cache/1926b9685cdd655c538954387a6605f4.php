<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html" ; charset="utf-8">
		<title>Web Chat!</title>
		
		<link rel="stylesheet" href="__PUBLIC__/css/base.css">
		<link rel="stylesheet" href="__PUBLIC__/css/ui.css">
		<script src="__PUBLIC__/js/jquery-1.9.1.js"></script>
		<script src="__PUBLIC__/js/jquery-ui.js"></script>
		<script src="__PUBLIC__/js/ServerInterface.js"></script>
		<script src="__PUBLIC__/js/SiteFunction.js"></script>
		<script src="__PUBLIC__/js/jquery.paginate.js"></script>
		<link rel="stylesheet" href="__PUBLIC__/css/pagestyle.css">
		
		<script src="__PUBLIC__/js/jquery.jqpagination.min.js"></script>
		<link rel="stylesheet" href="__PUBLIC__/css/jqpagination.css">

		<style>
			body{background: url(__PUBLIC__/image/7.jpg);font-family: "Microsoft Yahei"}
			.test{border:1px solid #000}
			.test li{display:inline}
		
		</style>
		
		
		<style>
			 
			 #site #site-body #body-min2{height:500px}
			 #site #site-body #body-min3{height:500px}
			 #site-body #body-min2 #body-min2-tabs-1{height:400px;}
			 #site-body #body-min2 #body-min2-tabs-2{height:400px;}
			 #site-body #body-min2 #body-min2-tabs-3{height:400px;}
			 #site-body #body-min2 #body-min2-tabs-4{height:400px;}
			 #site-body #index-tabs ul{height:30px}
			 #site-body #index-tabs ul li{height:30px;padding:0px}
			 #site-body #index-tabs ul li a{height:20px;padding:5px 20px;}
			 
		</style>
		
		
		
		<style>
			
			.jPaginate{
    height:34px;
    position:relative;
    color:#a5a5a5;
    font-size:small;   
	width:100%;
}
.jPaginate a{
    line-height:15px;
    height:18px;
    cursor:pointer;
    padding:2px 5px;
    margin:2px;
    float:left;
}
.jPag-control-back{
	position:absolute;
	left:0px;
}
.jPag-control-front{
	position:absolute;
	top:0px;
}
.jPaginate span{
    cursor:pointer;
}
ul.jPag-pages{
    float:left;
    list-style-type:none;
    margin:0px 0px 0px 0px;
    padding:0px;
}
ul.jPag-pages li{
    display:inline;
    float:left;
    padding:0px;
    margin:0px;
}
ul.jPag-pages li a{
    float:left;
    padding:2px 5px;
}
span.jPag-current{
    cursor:default;
    font-weight:normal;
    line-height:15px;
    height:18px;
    padding:2px 5px;
    margin:2px;
    float:left;
}
ul.jPag-pages li span.jPag-previous,
ul.jPag-pages li span.jPag-next,
span.jPag-sprevious,
span.jPag-snext,
ul.jPag-pages li span.jPag-previous-img,
ul.jPag-pages li span.jPag-next-img,
span.jPag-sprevious-img,
span.jPag-snext-img{
    height:22px;
    margin:2px;
    float:left;
    line-height:18px;
}

ul.jPag-pages li span.jPag-previous,
ul.jPag-pages li span.jPag-previous-img{
    margin:2px 0px 2px 2px;
    font-size:12px;
    font-weight:bold;
        width:10px;

}
ul.jPag-pages li span.jPag-next,
ul.jPag-pages li span.jPag-next-img{
    margin:2px 2px 2px 0px;
    font-size:12px;
    font-weight:bold;
    width:10px;
}
span.jPag-sprevious,
span.jPag-sprevious-img{
    margin:2px 0px 2px 2px;
    font-size:18px;
    width:15px;
    text-align:right;
}
span.jPag-snext,
span.jPag-snext-img{
    margin:2px 2px 2px 0px;
    font-size:18px;
    width:15px;
     text-align:right;
}
ul.jPag-pages li span.jPag-previous-img{
    background:transparent url(../images/previous.png) no-repeat center right;
            }
ul.jPag-pages li span.jPag-next-img{
    background:transparent url(../images/next.png) no-repeat center left;
            }
span.jPag-sprevious-img{
    background:transparent url(../images/sprevious.png) no-repeat center right;
            }
span.jPag-snext-img{
    background:transparent url(../images/snext.png) no-repeat center left;
            }

			
			
			
			
			
			
			
		</style>
		
		
		
		
		<script>
			
			
	$(function(){
		//注册键盘监听事件          //测试函数
		$(window).keydown(function(event){
			switch(event.keyCode){
				case 13 : sendmsg(222); break;
			}
		});
				
	});
			
			
	$(function(){
		//焦点获取测试    //测试函数
		$("#222 .chat").focus(function(){
			alert("222窗口获得焦点了！");
		});
	});
	
	
	

	
	
	
	function SendCommpToServer(id,commp){
		/*
		 * @THINK  2014年2月1日16:23:14          通信代码
		 *      好友添加请求发送函数
		 * 
		 * 传入一个ID还有操作动作，执行相关操作！
		 */
		
		
		switch(commp){
			
			case 1 :{
				//处理好友添加点击
				data = new String;
				data['add']=id;
				$.ajax({
					Type:"GET",
					url:"index.php/Friends/addfriend",
					data:data,
					dataType:"json",
					success:function(json){
						if(json["code"]==1){
							alert(json["msg"]);
						}else{
							alert(json["msg"]);
						}
					}
				});
			} break;
			case 2 :{
				//处理通过验证点击
				data = new String;
				data["check"]=id;
				$.ajax({
					Type:"GET",
					url:"index.php/Friends/checkin",
					data:data,
					dataType:"json",
					success:function(json){
						if(json["code"]==1){
							alert(json["msg"]);
							witeuser();
						}else{
							alert(json["msg"]);
						}
					}
				});
			} break;
		}
	}
	
	
	$(function(){
		//点击事件注册函数
		$("#body-min2 .witeadd").click(function(){
			witeuser();
		});	
	});
	
	
	function witeuser(){
		//好友请求列表加载函数
		$.ajax({
			Type:"GET",
			url:"index.php/Friends/checkout",
			success:function(data){
				$("#body-min2-tabs-2 .witeuserlist").detach();
				for(var i=0; i<data.length; i++){
					str = "<tr class=\"witeuserlist\"><td>" + data[i]["id"] + "</td><td>" + data[i]["name"] + "</td><td onclick=\"SendCommpToServer(" + data[i]["id"] + ",2)\">通过</td><td onclick=\"SendCommpToServer(" + data[i]["id"] + ",3)\">拒绝</td></tr>";
					$("#body-min2-tabs-2 table").append(str);
				}
			}
		});	
	}
	
	
	
	
	
	
	$(function(){
		$("#body-min2 .friendManage").click(function(){
			$.ajax({
				Type:"GET",
				url:"index.php/Friends",
				success:function(){
					
				}
			});		
		});	
	});
	
	
	
	
	$(function(){
		$("#body-min2 .OldMsg").click(function(){
			//alert("Hi!2");	//聊天记录加载		
			getOldMsg();

		});	
	});
	
	
	function getOldMsg(page){
		
		$.ajax({
			Type:"GET",
			url:"index.php/ChatOut/GetOldMsg",
			success:function(data){
				$("#body-min2-tabs-3 .oldmsg").remove();
				for(var i=0; i<data['data'].length; i++){
					str = "<tr class=\"oldmsg\"><td>" + data["data"][i]["id"] + "</td><td>" + data["data"][i]["user"] + "</td><td>" + data["data"][i]["content"] + "</td><td>" + data["data"][i]["date"] + "</td><td>" + data["data"][i]["ip"] + "</td></tr>";
					$("#body-min2-tabs-3 table").append(str);
				}
			}
		});
	}	
	
	
	function setPage(commp,totle){
		switch(commp){
			
			case 'first' : {} break;
			case 'up' : {} break;
			case '1' : {} break;
			case '2' : {} break;
			case '3' : {} break;
			case '4' : {} break;
			case '5' : {} break;
			case '6' : {} break;
			case '7' : {} break;
			case '8' : {} break;
			case '9' : {} break;
			case '10' : {} break;
			case 'down' : {} break;
			case 'end' : {} break;
		}
	}
	
	
	
	
	
	/*
	 *    THINK
	 * **************************************
	 *                布局调整区
	 * **************************************
	 *        2014年1月31日23:16:23
	 * **************************************
	 */
	
	
	 $(function() {
	 	//好友菜单栏设置    第一个选项卡在线好友列表
   		 $( "#live-menu" ).accordion();
 	 });
 	 
 	  $(function() {
 	  	//第一个选项卡设置项
  		  $( "#index-tabs" ).tabs();
	  });
	  
	 $(function() {
	 	//第二个选项卡中的选项菜单设置
		$( "#body-min2-menulist" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
		$( "#body-min2-menulist li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
	 });
			
			/******************************************前台界面功能代码*************************************/



			
			/*------------------------------    以下是前后交互通信部分代码           -----------------------------*/
			
			
/*
 * ******************
 *       THINK
 * ******************
 *     测试代码区
 * ******************
 */
			
			
		function test(){
			var a = document.getElementById("checkbox");
			b = $("#body-min2 input:checked");
			//alert($(b[0]).val());
			for(var i = 0; i<b.length; i++){
				alert($(b[i]).val());
			}
		}
		
		function test12(){
			$(function(){
				$( "#addfriend" ).dialog( "open" );
			});
		}		
		
		/*
		 $(function() {
		 	//Wiget    正对好友添加界面的弹出框
		 	
			$( "#addfriend" ).dialog({
				autoOpen: false,
				show: {
					effect: "drop",
					duration: 500
				},
				hide: {
					effect:"drop",
					duration: 500
				}
			});
			$( "#tttttt" ).click(function() {
				$( "#addfriend" ).dialog( "open" );
			});
		});
		
		*/
		
		
		
		$(function(){
			$("#demo2").removeClass();
			$("#demo2").paginate({
					count 		: 50,
					start 		: 5,
					display     : 10,
					border					: false,
					text_color  			: '#888',
					background_color    	: '#EEE',	
					text_hover_color  		: 'black',
					background_hover_color	: '#CFCFCF'
			});
		});
		
	
		
		
		
	$('#domo2').jqPagination({
		link_string	: '/?page={page_number}',
		max_page	: 40,
		paged		: function(page) {
			$('.log').prepend('<li>Requested page ' + page + '</li>');
		}
	});
		

			
			

	</script>
		
	</head>
	<body>
		
		<div id="site">
			<div id="site-body">
				<div id="body-top">  <!--   页面头部        用于显示滚动信息    -->
				</div>
				
				
				<div id="index-tabs">          <!--     文档位置 ：第一行 第二列   -->
					  <ul>             <!--  主体内容菜单   -->
	  					  <li><a href="#body-min">Chat</a></li>
	   					  <li><a href="#body-min2">Admin</a></li>
	   					  <li><a href="#body-min3">System Set</a></li>
	  				 </ul>
					
					
					<div id="body-min">
						<div id="min-left">
							<div id="people">
								<div id="live-menu">
									<h3>系统公告</h3>
										<div>这个功能正在写</div>
									<h3>在线用户</h3>
										<div id="liveuser">
											<ul>
											</ul>
										</div>
									<h3>我的好友</h3>
										<div id="livefriends">
											<ul>
											</ul>
										</div>
								</div>
							</div>
						</div>
						<div id="min-right"> 
							<div id="right-bar" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
								<ul id="mini-bar">
<<<<<<< .mine
									<li><a href="index.php/DoLogin/doLogout">登出</a></li>
=======
									<li><a href="index.php/DoLogin/dologout">登出</a></li>
>>>>>>> .r15
								</ul>
							</div>
												
										<!--     聊天窗体调试区域
												<div id="222" class="chat test" style="left:50px">
														<div class="chat-top test">
																<ul style="position:relative; top:-10px;">
																		<li class="test" style="float:right; margin-right: 10px;" onclick="closechat(222)">关闭</li>
																		<li class="test" style="float:right; margin-right: 10px;" onclick="mini(222)">最小化</li>
																</ul>
														</div>
														<div class="chat-msg test">
																<div class="test" style="float:left">里面的消息测试，里面的消息测试</div>
														</div>
														<div class="chat-tool test"></div>
														<div class="chat-write test">
															<div class="write-msg test"><textarea class="set"></textarea></div>
															<div class="send test" onclick="sendmsg(222)"><span>发送</span></div>
														</div>
												</div>   
											-->        
						</div>       
					</div>      <!--   第一个菜单调用显示页面    -->
				
				
				
				
					<div id="body-min2">
						<div id="body-min2-menulist">
							 <ul>
								<li class="list1"><a href="#body-min2-tabs-1">添加好友</a></li>
								<li class="list1 witeadd"><a href="#body-min2-tabs-2">好友请求</a></li>
								<li class="list1 OldMsg"><a href="#body-min2-tabs-3">聊天记录</a></li>
								<li class="list1 friendManage"><a href="#body-min2-tabs-4">好友管理</a></li>
								<li class="list1 OldMsg"><a href="#body-min2-tabs-5">账户设置</a></li>
							</ul>
							<div id="body-min2-tabs-1">
								<p id = "tttttt" >添加好友</p>
								<input id="checkbox" type="checkbox" value="checkbox3"/><input type="button" value="TEST" onclick="test()"/>
								<input id="checkbox2" type="checkbox" value="checkbo1x"/>
								<input id="checkbox3" type="checkbox" value="checkbox34"/>
								<input id="checkbox4" type="checkbox" value="checkbox4"/>
							</div>
							
							<div id="body-min2-tabs-2">
								<div>
									<table border="1">
										<tr>
											<td>ID</td>
											<td>用户名</td>
											<td colspan="2">操作</td>
										</tr>
									</table>
								</div>
							</div>
							
							<div id="body-min2-tabs-3">
								<table border="1">
									<tr>
										<td>收信人</td>
										<td>消息来源</td>
										<td>消息内容</td>
										<td>时间</td>
										<td>IP地址</td>
									</tr>
									<tr>
									</tr>
								</table>
								<div id="demo2">
									
  								  <a href="#" class="first" data-action="first">&laquo;</a>
  								  <a href="#" class="previous" data-action="previous">&lsaquo;</a>
   									<input type="text" readonly="readonly" data-max-page="40" />
    							  <a href="#" class="next" data-action="next">&rsaquo;</a>
   								  <a href="#" class="last" data-action="last">&raquo;</a>

								</div>
							</div>
							
							
							<div id="body-min2-tabs-4">
								
								
								好友管理
							</div>
							<div id="body-min2-tabs-5">
								账户设置
							</div>
							
							
							<div id="addfriend" title="添加好友">
								<div>
									<div>请输入条件：<input /><span class="search">搜索</span></div>
									<div class="addres">
										<ul>
											<li class="td">用户ID  /  用户名 </li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>        <!--   第二个菜单调用块结束    -->
				
				
				
				<div id="body-min3">这个页面做给有权限的用户使用</div>
				</div>
			</div>
		</div>
	</body>	
</html>