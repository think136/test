/**
 * @author THINK
 */



		
		/*  THINK
		 * ******************************
		 *       界面功能区代码
		 * ******************************
		 *   2014年1月31日23:11:36
		 * ******************************
		 */
		/*================功能起始区===================*/	
			
	function  newchat(id){
		//传入一个id ，插入一个窗口
		if(document.getElementById(id)==null){
			//要是这个窗口已经存在，就不创建
			boxarr = new String;
			boxarr = "<div id=\"" + id + "\" class=\"chat test\" style=\"left:50px\"><div class=\"chat-top test ui-widget-header\"><ul style=\"position:relative; top:-10px;\"><li class=\"test\" style=\"float:right; margin-right: 10px;\" onclick=\"closechat(" + id + ")\">关闭</li><li class=\"test\" style=\"float:right; margin-right: 10px;\" onclick=\"mini(" + id + ")\">最小化</li></ul></div><div class=\"chat-msg test\"></div><div class=\"chat-tool test\"></div><div class=\"chat-write test\"><div class=\"write-msg test\"><textarea class=\"set\"></textarea></div><div class=\"send test\" onclick=\"sendmsg(" + id + ")\"><span>发送</span></div></div></div>"; 
			$("#min-right").append(boxarr);
			setmove();
		}else{
			chose = new String;
			chose = "#"+id;
			$(chose).css({display:"block"});	
		}
	}
		
	function setmove(){
		//设置可移动
		$(function(){
			$(".chat").draggable({handle:".chat-top"});	
		});	
	}
			

			
	function closechat(id){
		//传入一个ID，关闭这个ID的小盒子。
		chose = new String;
			chose = "#"+id;
			$(chose).css({display:"none"});
	}
		
	function mini(id){
		//传入一个ID，将这个窗口最小化
		//在这里也要进行检查，检查这个ID的格子有没有被创建过
		bar = new String;
		redis = new String;
		var cid = 100000000 + id;
		if(document.getElementById(cid)==null){
			//要是没有就创建
			bar = "<li id=\"" + cid + "\" onclick=\"unmini(" + cid + ")\">" + id + "</li>";
			$("#mini-bar").append(bar); //在最小化框中写入内容
			commp = new String;
			commp = "#min-right #" + id;       //组装字符串
			$(commp).css({display:"none"});    //隐藏原来的窗口
		}else{
			//要是已经存在就置为显示
			redis = "#" + cid;
			$(redis).css({display:"block"});
			commp = new String;
			commp = "#min-right #" + id;       //组装字符串
			$(commp).css({display:"none"});    //隐藏原来的窗口
		}
	}
			
			
	function unmini(id){
		/*
		 * 最小化恢复函数，传入一个ID，将这个ID对应的窗口恢复
		 */
		cid = new String;
		cid = "#" + (id - 100000000);
		a = new String;
		a = "#" + id;
		$(a).css({display:"none"});
		$(cid).css({display:"block"});
		$(a).css({border:"1px #f00 solid"});
	}
			
			
	function sendmsg(id) {
		/*
		 * 消息发送函数，传入一个ID，获取这个窗口对应的输入内容，提交发送
		 * 
		 */
		ch1 = new String; //  
		ch2 = new String; //
		msg = new String;
		//组装文本来源选择器
		ch1 = "#" + id + " textarea"; //组装文本内容来源选择器
		ch2 = "#" + id + " .chat-msg"; //组装消息显示选择器
		var getmsg = $(ch1).val();      //获得消息区文本内容  
		var d = new Date();
		str = "<div class=\"sendmsgbox\">" + "我：" + "   |   " + d.toLocaleString() + "<p>" + getmsg  + "</p></div>";
		$(ch2).append(str);
		$(ch1).val("");   //令已经执行完的消息消失
		MsgToServer(id,getmsg);
		SetMsgDisplay(id);
	}
			
	function SetMsgDisplay(id){
		//设置新消息总在最下面显示
		ch1 = new String; //
		ch1 = "#" + id + " .chat-msg"; //组装消息显示选择器
		$(ch1).scrollTop(9000000000);   //设置滚动条相对于顶部的偏移量
	}
	
	function SetMsgAlert(id){
		barid = parseInt(id) + 100000000;
		ch1 = new String;
		ch1 = "#" + barid;
		$(ch1).css({border:"3px #F00 solid"});
	}
