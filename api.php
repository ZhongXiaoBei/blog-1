<?php
$method = $_REQUEST['method'];
switch($method){
	case 'login':
		login();
	break;
	case 'article':
		getArticle();
	break;
	case 'save':
		save();
	break;
}

function save(){
	$isLogin = $_COOKIE['token'] == md5('binkeryhuangbin') ? true : false;
	if($isLogin == false){
		echo '{"status":"400"}';
		return;
	}
	$path = $_POST['path'];
	//echo $path . '\n';
	//echo $_POST['text'] . '\n';
//	$text = json_decode($_POST['text']);
	$text = $_POST['text'];
	//echo $text . '\n';
	$count = file_put_contents($path,$text);
	echo '{"status":200,"count":'.$count.'}';
}

function getArticle(){
	$isLogin = $_COOKIE['token'] == md5('binkeryhuangbin') ? true : false;
	if($isLogin == false){
		echo '{"status":"400"}';
		return;
	}
	$path = $_POST['path'];
	$text = file_get_contents($path);
	$obj->status = 200;
	$obj->text = $text;
	
	echo json_encode($obj);
}

function login(){
	$user = $_POST['user'];
	$password = $_POST['password'];
	if($user == 'binkery' && $password == 'huangbin'){
		$md5 = md5($user.$password);
		echo '{"status":"200","token":"'.$md5.'"}';
	}else{
		echo '{"status":"404"}';
	}
	
}

?>