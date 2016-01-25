<?php
	$startTime = microtime(true);
	$WEB_SITE = 'blog.binkery.com';
	$SITE_NAME = 'Binkery 博客';
	
	$isLogin = $_COOKIE['token'] == md5('binkeryhuangbin') ? true : false;
	
	function echoSummary(){
		$handle = @fopen('SUMMARY.md', "r");
		$result = '';
		$index1 = 0;
		$index2 = 0;
		$index3 = 0;
		$index4 = 0;
		if ($handle) {
			while (!feof($handle)) {
				$line = fgets($handle);
				$string = '<li>';
				$level = 0;
				$number = '';
				if(stripos($line,'####') === 0){
					$index4 += 1;
					$number .= '<b class="level_4">' . $index1 . '.' . $index2 . '.' . $index3 . '.' . $index4 . '.';
					$level = 4;
				}else if(stripos($line,'###') === 0){
					$index3 += 1;
					$index4 = 0;
					$number .= '<b class="level_3">' . $index1 . '.' . $index2 . '.' . $index3 . '.';
					$level = 3;
				}else if(stripos($line,'##') === 0){
					$index2 += 1;
					$index3 = 0;
					$index4 = 0;
					$number .=  '<b class="level_2">' . $index1 . '.' . $index2 . '.';
					$level = 2;
				}else if(stripos($line,'#') === 0){
					$index1 += 1;
					$index2 = 0;
					$index3 = 0;
					$index4 = 0;
					$number .= '<b class="level_1">' .  $index1 . '.';
					$level = 1;
				}
				$number .= '</b>';
				if(stripos($line,'[') == FALSE){
					$string .= $number . substr($line,$level);
				}else{
					$title1 = stripos($line,'[');
					$title2 = stripos($line,']');
					$link1 = stripos($line,'(');
					$link2 = stripos($line,')');
					$link = substr($line,$link1 + 1,$link2 - $link1 - 1);
					if($link == 'README.md'){
						$link = 'index.md';
					}
					$string .= '<a href="http://blog.binkery.com/'. str_replace('.md','.html',$link).'">' . $number . substr($line,$title1 + 1,$title2 - $title1 -1) . '</a>';
				}
				$string .= '</li>';
				$result .= $string;
			}
			fclose($handle);
		}
		return $result;
	}
	
	spl_autoload_register(function($class){
		require preg_replace('{\\\\|_(?!.*\\\\)}', DIRECTORY_SEPARATOR, ltrim($class, '\\')).'.php';
	});
	# Get Markdown class
	use \Michelf\Markdown;
	# Read file and pass content through the Markdown parser
	
	$summary = echoSummary();
	
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
<html lang="zh" >
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?=$title?> | <?=$SITE_NAME?></title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta name="description" content="<?=$description?>">
	<meta name="keywords" content="binkery,Android,计算机,技术,博客,分享,Java,Linux,项目,代码">
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
	<script type="text/javascript" src="http://<?=$WEB_SITE?>/jquery.js"></script>
	<script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "//hm.baidu.com/hm.js?fd51314443fc2f0859205bce4c561104";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();

		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-43760786-2', 'auto');
		ga('send', 'pageview');
	</script>
</head>
<body>
	<div class="summary">
		<h1><?=$SITE_NAME?></h1>
		<ul>
		<?=$summary?>
		</ul>
		<div id="summary_bottom_margin"></div>
	</div>
	<div class="content">
	<?php
		if($isLogin){
	?>
		<div id="edit">
			<div>编辑</div>
		</div>
		<div id="save">
			<div>保存</div>
		</div>
	<?php 
		}
	?>
		<article><?=$content?></article>
		<textarea id="editor"></textarea>
		<?php
			$endTime = microtime(true);
			$times = round($endTime - $startTime,3);
		?>
		<footer>Copyright Binkery | 2011-2015 | <?=$times?> seconds</footer>
		</div>
		
	<script type="text/javascript">SyntaxHighlighter.all();</script>
</body>

<script>
	$(document).ready(function(){
			var offset = $.cookie('position');
			console.log("ready offset = " + offset);
			$(".summary").scrollTop(offset);
			$(".summary").scroll(function(){
					var offset = $(".summary").scrollTop();
					console.log("offset = " + offset);
					$.cookie('position',offset,{ expires: 7, path: '/' });
			});
	});
	$("#save").hide();
	$("#edit").click(function(){
		$.post('/api.php',{
			"method":"article",
			"path": "<?=$file_path?>"
		},function(data,stutus){
			if(data.status == 200){
				$("article").hide();
				$("#editor").show();
				$("#editor").val(data.text);
				
				$("#edit").hide();
				$("#save").show();
			}
		},'json');
		
	});
	$("#save").click(function(){
		var text = $("#editor").val();
		$.post('/api.php',{
			"method":"save",
			"path":"<?=$file_path?>",
			"text":text
		},function(data,status){
			window.location.reload();
		},"json");
		
	});
</script>
</html>
