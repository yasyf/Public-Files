<?php
extract($_GET, EXTR_SKIP);
if(isset($file))
{	
$file = rawurldecode($file);
$ext = pathinfo($file, PATHINFO_EXTENSION);
$codeexts = array("cpp","css","diff","dtd","javascript","mysql","perl","php","python","ruby","sql","xml");
$archiveexts = array("zip","tar","gz","7z","rar","sit","sitx","tgz","bz2","tbz");
$finfo = finfo_open(FILEINFO_MIME);
$type = finfo_file($finfo, $file);
if(isset($display))
{
	if($display){
		
	header("Content-Type: $type");
	header("Content-Disposition: attachment; filename='$file'");
	header('Content-Length: ' . filesize($file));
	ob_clean();
	flush();
	readfile($file);
	exit;
	}
	}
	
}
else {
	$file = "Yasyf Mohamedali's Public Files";
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

    <link href="/favicon.ico" rel="shortcut icon">

    <!-- include_stylesheets :viso -->
    <link href="/static/stylesheets/reset.css" media="screen" rel="stylesheet" type="text/css" />
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

  

<?php
if($file == "Yasyf Mohamedali's Public Files")
{
	$allfiles = scandir(dirname(__FILE__));
	$list = "";
	$sysfiles = array("-i",".","..",".gitignore",".htaccess","cloudapp.php","static",".git");
foreach ($allfiles as $key => $value) {
	if(array_search($value,$sysfiles) === false)
	$list .= "<span><strong><a href='?file=$value' target='_blank'>$value</a></strong></span><br />";
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
	<?php
}
else if(getimagesize($file))
{
?>
 <body id="image">
<header id="header">
<h1><a href="http://files.yasyf.com">Yasyf's Public Files</a></h1>
 <h2><?php echo $file; ?></h2>
 <a class="embed" href="<?php echo "?file=$file&display=true"; ?>">Direct Link</a>
</header>
 <section id="content">
  <img alt="<?php echo $file; ?>" src="<?php echo "?file=$file&display=true"; ?>">
</section>
<?	
}
else if (substr($type, 0, 4) == 'text') {
	$content = file_get_contents($file);
	if(array_search($ext,$codeexts)){
		require_once 'Text/Highlighter.php';
		$highlighter =& Text_Highlighter::factory($ext);
		$content = $highlighter->highlight($content); 
		
		?>
		<body id="text">
					<header id="header">
					<h1><a href="http://files.yasyf.com">Yasyf's Public Files</a></h1>
					 <h2><?php echo $file; ?></h2>
					 <a class="embed" href="<?php echo "?file=$file&display=true"; ?>">Direct Link</a>
					</header>
					<section class="monsoon" id="content">
					<div class="highlight"><pre><code><?php echo $content; ?></code></pre></div>
					</section>
 		<?php
	}
	else {
		?>
		<body id="text">
			<header id="header">
			<h1><a href="http://files.yasyf.com">Yasyf's Public Files</a></h1>
			 <h2><?php echo $file; ?></h2>
			<a class="embed" href="<?php echo "?file=$file&display=true"; ?>">Direct Link</a>
			</header>
			<section class="monsoon" id="content">
			<pre><code><?php echo $content; ?></code></pre>
			</section>
 			
 			<?php
	}
}
else{
?>
  <body id="other">
<div class="wrapper">
  <section id="content">
<?php
if(array_search($ext,$archiveexts)){
	?>
	<figure class="archive"></figure>
	<?php
}
else {
	?>
	    <figure class="unknown"></figure>
	<?php
}
?>
     <h2><?php echo $file; ?></h2>

    <p>
      <a href="<?php echo "?file=$file&display=true"; ?>">View</a>

      <small>or <strong>opt</strong>/<strong>alt click</strong> to download</small>
    </p>
  </section>
 <footer id="footer">
      <h1><a href="http://files.yasyf.com">Yasyf's Public Files</a></h1>
    </footer>
</div>
<?php	
}
	?>

</body>
</html>