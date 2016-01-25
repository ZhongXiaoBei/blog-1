<?php
define('TOKEN','1fa350312a59cf1318ed696249346e3f');

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
	$isLogin = $_COOKIE['token'] == TOKEN ? true : false;
	if($isLogin == false){
		echo '{"status":"400"}';
		return;
	}
	$path = $_POST['path'];
	$text = $_POST['text'];
	$count = file_put_contents($path,$text);
	echo '{"status":200,"count":'.$count.'}';
}

function getArticle(){
	$isLogin = $_COOKIE['token'] == TOKEN ? true : false;
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
    $md5 = md5($_POST['user'] . $_POST['password']);
    $isRight = $md5 == TOKEN ? true : false;
	if($isRight == true){
		echo '{"status":"200","token":"'.$md5.'"}';
	}else{
		echo '{"status":"404","user":"'.$_POST['user'].'","password":"'.$_POST['password'].'","md5":"'.$md5.'"}';
	}
}

?>
