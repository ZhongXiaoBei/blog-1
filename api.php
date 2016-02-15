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
    case 'read':
        readCnt();
    break;
}

function readCnt(){
    $post = $_REQUEST['post'];
    $text = @file_get_contents('cache/cnt.cnt');
    if($text == FALSE){
        $array = array('total' => 1);
    }else{
        $array = json_decode($text,true);
    }
    $value = $array[$post] + 1;
    $total = $array['total'] + 1;
    $array[$post] = $value;
    $array['total'] = $total;

    $text = json_encode($array);
    @file_put_contents('cache/cnt.cnt',$text);

    $obj->status = 200;
    $obj->cnt = $value;
    $obj->total = $total;

    echo json_encode($obj);
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
	$text = @file_get_contents($path);
    if($text == FALSE){
        $text = '';
    }
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
