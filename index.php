<?php
	$WEB_SITE = 'blog.binkery.com';
	$SITE_NAME = 'Binkery 博客';
	
	
	spl_autoload_register(function($class){
		require preg_replace('{\\\\|_(?!.*\\\\)}', DIRECTORY_SEPARATOR, ltrim($class, '\\')).'.php';
	});
	# Get Markdown class
	use \Michelf\Markdown;
	# Read file and pass content through the Markdown parser
	$text = file_get_contents('SUMMARY.md');
	$text = str_replace('.md','.html',$text);
	$summary = Markdown::defaultTransform($text);
	$summary = str_replace('href="','href="http://'.$WEB_SITE.'/',$summary);
	$summary = str_replace('http://'.$WEB_SITE.'/README.html','http://'.$WEB_SITE.'/',$summary);
	
	if(strlen($_SERVER["REQUEST_URI"]) == 1){
		$file_path = 'README.md';
	}else{
		$index = stripos($_SERVER["REQUEST_URI"],'.html');
		if($index == -1){
			$file_path = 'README.md';
		}else{
			$file_path = substr($_SERVER["REQUEST_URI"],0,$index);
			if($file_path == '/index'){
				$file_path = 'README.md';
			}else{
				$file_path = strtolower($file_path) . '.md';
			}
		}
	}
	
	$file_path = ltrim($file_path,'/');
	$myfile = fopen($file_path, "r");
	$title = fgets($myfile);
	$title = trim(trim($title,'#'));
	fclose($myfile);
	
	function excerpt($post_content){
		$theEndPosition=strrpos($post_content, '<!–more–>');

		if($theEndPosition<>0){
			return substr($post_content,0,$theEndPosition);
		}else{
			return $post_content;
		}
	}
	
	$text = file_get_contents($file_path);
	$content = Markdown::defaultTransform($text);
	$description = mb_substr(strip_tags(excerpt($content)),0,250,'utf-8');
	
	// delete <code> tag 
	$content = str_ireplace('<code>','',$content);
	$content = str_ireplace('</code>','',$content);
	
	$content = str_ireplace('<pre','<pre class="brush: js;"',$content);
?>
<!DOCTYPE HTML>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?=$title?> | <?=$SITE_NAME?></title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta name="description" content="<?=$description?>">
	<meta name="generator" content="binkery.huang">
	<meta name="author" content="BinHuang">
	<meta name="HandheldFriendly" content="true"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" href="http://<?=$WEB_SITE?>/css.css">
	<script type="text/javascript" src="http://<?=$WEB_SITE?>/SyntaxHighlighter/shCore.js"></script>
	<script type="text/javascript" src="http://<?=$WEB_SITE?>/SyntaxHighlighter/shBrushJScript.js"></script>
	<link type="text/css" rel="stylesheet" href="http://<?=$WEB_SITE?>/SyntaxHighlighter/shCoreDefault.css"/>
	
	<script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "//hm.baidu.com/hm.js?fd51314443fc2f0859205bce4c561104";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
	</script>
</head>
<body>
	<div class="summary">
		<h1><?=$SITE_NAME?></h1>
		<?=$summary?>
	</div>
	<div class="content">
		<?=$content?>
	</div>
	<script type="text/javascript">SyntaxHighlighter.all();</script>
</body>
</html>
