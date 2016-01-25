<!DOCTYPE HTML>
<html lang="zh" >
<head>
	<meta charset="UTF-8">
	<title>管理</title>
	<style>
		.panel{width:60%;margin:30px auto;}
		.pre_span{font-size:16px;width:100px;float:left;}
		input{width:200px;}
		.clear{clear:both;}
		.unit{height:30px;margin:auto 0;}
		
		#login{margin:0px;padding:0px 10px;background:#2d64b3;color:#efefef;font-size:16px;float:left;}
	</style>
	<script type="text/javascript" src="http://blog.binkery.com/statics/jquery.js"></script>
</head>
<body>
	<div class="panel">
		<div class="unit">
			<div class="pre_span">用户名：</div><input type="text" id="user"/><div class="clear"></div>
		</div>
		<div class="unit">
			<div class="pre_span">密码：</div><input type="password" id="password"/><div class="clear"></div>
		</div>
		<div id="login">Login</div>
	</div>
	<script>
		$("#login").click(function(){
			console.log("login");
			var user = $("#user").val();
			var password = $("#password").val();
			$.post("api.php",
				{
					"method":"login",
					"user":user,
					"password":password
				
				}
			,function(data,status){
				if(data.status == 200){
					$.cookie('token',data.token,{ expires: 7, path: '/' });
					 window.location.href="/";
				}else{
					
				}
			},"json");
		});
	</script>
</body>
</html>
