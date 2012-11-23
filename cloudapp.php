<?php
extract($_GET, EXTR_SKIP);
if(isset($file))
{
$fileraw = $file;
$file = rawurldecode($file);
$ext = pathinfo($file, PATHINFO_EXTENSION);
$codeexts = array("cpp","css","diff","dtd","javascript","mysql","perl","php","python","ruby","sql","xml","java");
$archiveexts = array("zip","tar","gz","7z","rar","sit","sitx","tgz","bz2","tbz");
$docexts = array("pdf","ppt","pptx","xls","xlsx","pages","docx");
$movexts = array("mp4","m4v","f4v","webm","flv","ogv");
$audexts = array("aac","m4a","f4a","ogg","oga","mp3");
$finfo = finfo_open(FILEINFO_MIME);
$type = mime_content_type($file);
$typefull = finfo_file($finfo, $file);
$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];


if(isset($display))
{
	if($display){
		
	header("Location: http://files.yasyf.com/direct/$fileraw");
	exit;
		}
	}

header("Expires: ".gmdate("D, d M Y H:i:s", time() + 2000000) . " GMT");
header("Pragma: cache");
header('Cache-Control: public');
header("Cache-Control: max-age=2000000");

}
else {
		$file = "Yasyf Mohamedali's Public Files";
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		header("Cache-Control: no-store, no-cache, must-revalidate"); 
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
}
?>

<!DOCTYPE html>
<html class="no-js" dir="ltr" lang="en">
  <head>
    <title><?php echo $file; ?> On Yasyf's Public Files</title>

    <meta charset="utf-8">

    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="width = device-width, initial-scale = 1.0, maximum-scale = 1.0, minimum-scale = 1.0, user-scalable = no" name="viewport">

    <meta content="CloudApp" name="author">

    <link href="favicon.ico" rel="shortcut icon">

    <!-- include_stylesheets :viso -->
    <link href="/static/stylesheets/reset.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="/static/stylesheets/highlight.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/static/stylesheets/monsoon.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/static/stylesheets/image.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/static/stylesheets/other.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/static/stylesheets/text.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/static/stylesheets/syntax.css" media="screen" rel="stylesheet" type="text/css" />


    <!--[if IE]>
    <link href="/stylesheets/ie.css" media="screen" rel="stylesheet" type="text/css" />
    <![endif]-->

    <!-- include_javascripts :viso -->
    <script src="/static/javascripts/vendor/jquery-1.6.1.min.js"></script>
    <script src="/static/javascripts/vendor/modernizr-1.7.min.js"></script>
    <script src="/static/javascripts/image.js"></script>
    <script src="/static/javascripts/other.js"></script>

    <!--[if lt IE 9]>
    <script src="/static/javascripts/vendor/selectivizr-1.0.2.min.js"></script>
    <![endif]-->
  <!-- 1. jquery library -->
<script
  src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js">
</script>
 
<!-- 2. flowplayer -->
<script src="http://releases.flowplayer.org/5.1.1/flowplayer.min.js"></script>
 
<!-- 3. skin -->
<link rel="stylesheet" type="text/css"
   href="http://releases.flowplayer.org/5.1.1/skin/functional.css" />
<!-- global options -->
<script>
flowplayer.conf = {
   engine: "flash"
};
</script>
<script type="text/javascript" src="http://cache.yasyf.com/js/jquery.lightbox_me.js"></script>
</head>
<?php
if($file == "Yasyf Mohamedali's Public Files")
{
	$allfiles = scandir(dirname(__FILE__));
	$list = "";
	$sysfiles = array("-i",".","..",".gitignore",".htaccess","cloudapp.php","static",".git","favicon.ico","direct");
foreach ($allfiles as $key => $value) {
	if(array_search($value,$sysfiles) === false)
	$list .= "<span><strong><a href='$value' target='_blank'>$value</a></strong></span><br /><br />";
}
	?>
	<body id="other">
	<div class="wrapper">
	  <section id="content">
	     <h2>Yasyf Mohamedali's Public Files</h2>

	     <?php echo $list; ?>
	  </section>
	 <footer id="footer">
	      <h1><a href="http://files.yasyf.com">Yasyf's Public Files</a></h1>
	    </footer>
	</div>
	<center><br /><br /><div><a rel="me" href="http://www.yasyf.com/" target="_new"><img src="http://cache.yasyf.com/images/logo_ym.png" width="100" height="100"  alt="Designed By Yasyf Mohamedali"  style="border: None 0 transparent;" /></a></div></center>
	<?php
}
else if(getimagesize($file))
{
?>
 <body id="image">
<header id="header">
<h1><a href="http://files.yasyf.com">Yasyf's Public Files</a></h1>
 <h2><?php echo $file; ?></h2>
 <span class="embed"><a class="embeda" id="qr" href="#">QR Code</a> | <a class="embeda" href="<?php echo "direct/$file"; ?>">Direct Link</a></span>
</header>
 <section id="content">
  <img alt="<?php echo $file; ?>" src="<?php echo "direct/$file"; ?>">
<br /><br /><div><a rel="me" href="http://www.yasyf.com/" target="_new"><img src="http://cache.yasyf.com/images/logo_ym.png" width="100" height="100"  alt="Designed By Yasyf Mohamedali"  style="border: None 0 transparent;" /></a></div>
</section>
<?php	
}
else if (array_search($ext,$docexts) !== false) {
	?>
	<body id="image">
		<header id="header">
		<h1><a href="http://files.yasyf.com">Yasyf's Public Files</a></h1>
		 <h2><?php echo $file; ?></h2>
		 <span class="embed"><a class="embeda" id="qr" href="#">QR Code</a> | <a class="embeda" href="<?php echo "direct/$file"; ?>">Direct Link</a></span>
		</header>
		 <section id="content">
		<center>
		  <iframe src="http://docs.google.com/viewer?url=<?php echo rawurlencode("http://files.yasyf.com/direct/$file"); ?>&embedded=true" width="85%" height="800px" style="border: none;"></iframe>
		<br /><br /><div><a rel="me" href="http://www.yasyf.com/" target="_new"><img src="http://cache.yasyf.com/images/logo_ym.png" width="100" height="100"  alt="Designed By Yasyf Mohamedali"  style="border: None 0 transparent;" /></a></div>
		</center>
		</section>
  <?php
}
else if (array_search($ext,$movexts) !== false) {
	?>
	<body id="image">
			<header id="header">
			<h1><a href="http://files.yasyf.com">Yasyf's Public Files</a></h1>
			 <h2><?php echo $file; ?></h2>
			 <span class="embed"><a class="embeda" id="qr" href="#">QR Code</a> | <a class="embeda" href="<?php echo "direct/$file"; ?>">Direct Link</a></span>
			</header>
			 <section id="content">
			<center>
			  <div class="flowplayer"><video src="<?php echo "direct/$file"; ?>"  type="<?php echo $type; ?>">
			<div class="wrapper">
			  <section id="content">
			   <h2><?php echo $file; ?></h2>
			    <p>
			      <a href="<?php echo "direct/$file"; ?>">View</a>
			      <small>or <strong>opt</strong>/<strong>alt click</strong> to download</small>
			    </p>
			  </section>
			 <footer id="footer">
			      <h1><a href="http://files.yasyf.com">Yasyf's Public Files</a></h1>
			    </footer>
			</div>
			</video></div> 
			<br /><br /><div><a rel="me" href="http://www.yasyf.com/" target="_new"><img src="http://cache.yasyf.com/images/logo_ym.png" width="100" height="100"  alt="Designed By Yasyf Mohamedali"  style="border: None 0 transparent;" /></a></div>
			</center>
			</section>
			 	
<?php
}
else if (array_search($ext,$audexts) !== false) {
	?>
	<body id="image">
				<header id="header">
				<h1><a href="http://files.yasyf.com">Yasyf's Public Files</a></h1>
				 <h2><?php echo $file; ?></h2>
<span class="embed"><a class="embeda" id="qr" href="#">QR Code</a> | <a class="embeda" href="<?php echo "direct/$file"; ?>">Direct Link</a></span>
				</header>
				 <section id="content">
				<center>
				  <audio src="<?php echo "direct/$file"; ?>" controls="controls" type="<?php echo $type; ?>">
				<div class="wrapper">
							  <section id="content">
							   <h2><?php echo $file; ?></h2>
							    <p>
							      <a href="<?php echo "direct/$file"; ?>">View</a>
							      <small>or <strong>opt</strong>/<strong>alt click</strong> to download</small>
							    </p>
							  </section>
							 <footer id="footer">
							      <h1><a href="http://files.yasyf.com">Yasyf's Public Files</a></h1>
							    </footer>
							</div>
				</audio> 
				<br /><br /><div><a rel="me" href="http://www.yasyf.com/" target="_new"><img src="http://cache.yasyf.com/images/logo_ym.png" width="100" height="100"  alt="Designed By Yasyf Mohamedali"  style="border: None 0 transparent;" /></a></div>
				</center>
				</section>


	<?php
}
else if (substr($type, 0, 4) == 'text') {
	$content = file_get_contents($file);
	if(array_search($ext,$codeexts)  !== false){
		require_once 'Text/Highlighter.php';
		$highlighter =& Text_Highlighter::factory("$ext");
		$highlighter->setRenderer($renderer);
		$content = $highlighter->highlight($content); 
		
		?>
		<body id="text">
					<header id="header">
					<h1><a href="http://files.yasyf.com">Yasyf's Public Files</a></h1>
					 <h2><?php echo $file; ?></h2>
	<span class="embed"><a class="embeda" id="qr" href="#">QR Code</a> | <a class="embeda" href="<?php echo "direct/$file"; ?>">Direct Link</a></span>
					</header>
					<section class="monsoon" id="content">
					<div class="highlight"><pre><code><?php echo $content; ?></code></pre></div>
<center><br /><br /><div><a rel="me" href="http://www.yasyf.com/" target="_new"><img src="http://cache.yasyf.com/images/logo_ym.png" width="100" height="100"  alt="Designed By Yasyf Mohamedali"  style="border: None 0 transparent;" /></a></div></center>					</section>
 		<?php
	}
	else {
		?>
		<body id="text">
			<header id="header">
			<h1><a href="http://files.yasyf.com">Yasyf's Public Files</a></h1>
			 <h2><?php echo $file; ?></h2>
<span class="embed"><a class="embeda" id="qr" href="#">QR Code</a> | <a class="embeda" href="<?php echo "direct/$file"; ?>">Direct Link</a></span>
			</header>
			<section class="monsoon" id="content">
			<pre><code><?php echo $content; ?></code></pre>
<center><br /><br /><div><a rel="me" href="http://www.yasyf.com/" target="_new"><img src="http://cache.yasyf.com/images/logo_ym.png" width="100" height="100"  alt="Designed By Yasyf Mohamedali"  style="border: None 0 transparent;" /></a></div></center>			</section>
 			
 			<?php
	}
}
else{
?>
  <body id="other">
<div class="wrapper">
  <section id="content">
<?php
if(array_search($ext,$archiveexts) !== false){
	?>
	<figure class="archive"></figure>
	<?php
}
else {
	?>
	    <figure class="unknown" style="background:url('/static/qr.php?url=<?php echo $url; ?>') no-repeat center center #f7f8f8;"></figure>
	<?php
}
?>
     <h2><?php echo $file; ?></h2>

    <p>
      <a href="<?php echo "direct/$file"; ?>">View</a>

      <small>or <strong>opt</strong>/<strong>alt click</strong> to download</small>
    </p>
  </section>
 <footer id="footer">
      <h1><a href="http://files.yasyf.com">Yasyf's Public Files</a></h1>
    </footer>
</div>
<center><br /><br /><div><a rel="me" href="http://www.yasyf.com/" target="_new"><img src="http://cache.yasyf.com/images/logo_ym.png" width="100" height="100"  alt="Designed By Yasyf Mohamedali"  style="border: None 0 transparent;" /></a></div></center>
<?php	
}
	?>
	<div id="qrdiv" style="display:none">
		<img src="/static/qr.php?url=<?php echo $url; ?>&size=large" />
		</div>
		<script>
	$("#qr").click(function() {
	  $("#qrdiv").lightbox_me({
		        centered: true
		        });
	})
	</script>
</body>
</html>