<?php
	if (false === empty($title)) $title = sprintf('%s &raquo; If I Was CEO', $title);
	else $title = 'If I Was CEO &raquo; What would you do?2';
?>
<!doctype html>
<!--
	Thanks for taking a look at the inside workings of IfIWasCEO.
	If you do notice anything wrong / unusal then please let me know!
	james@ifiwasceo.com :)
	
	Thanks go to @phuu for the design. It's so awesome, it even works
	on your smartphone (responsive designs ++)!!
	
	Hope you enjoy the site :)
-->
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title>IfIWasCEO &raquo; What would you do?</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon.ico">
		<link rel="stylesheet" href="/assets/stylesheets/style.css">
		
		<script src="/assets/javascripts/modernizr-1.7.min.js"></script>
		<script src="/assets/javascripts/respond.min.js"></script>
	</head>
	<body>
		<div id="container">
			
			<header>
				<hgroup>
					<h1><a href="http://ifiwasceo.com/" title="If I Was CEO"><img src="/assets/images/logo.png" alt="If I Was CEO" /></a></h1>
					<h2>Your ideas for the world's CEOs</h2>
				</hgroup>
			</header>
			
			<noscript>
				<h2 class="error">You have Javascript disabled :( Some parts of the site may seem a little weird. Why not enable Javascript?</h2>
			</noscript>
					
<?php
	if ((false === empty($write)) && ($write instanceof View)) echo $write->render();
?>
			
			
			<section id="content" role="content">
				
<?php
	if ((false === empty($view)) && ($view instanceof View)) echo $view->render();
?>
				
			</section>
			
			<footer>
				<nav>
					<ul>
						<li><a href="http://ifiwasceo.com/">Home</a></li>
						<li><a href="http://ifiwasceo.com/about">About</a></li>
						<li><a href="http://blog.ifiwasceo.com/">Blog</a></li>
						<li><a href="http://ifiwasceo.com/feedback">Feedback</a></li>
						<li><a href="http://ifiwasceo.com/auth">Login</a></li>
					</ul>
				</nav>
				<aside>Made with &hearts; by <a href="http://jdrydn.com">@jdrydn</a> and <a href="http://phuu.net">@phuunet</a>.</aside>
			</footer>
			
		</div>
		
		<!--[if lt IE 7 ]>
		<script src="js/libs/dd_belatedpng.js"></script>
		<script>
			DD_belatedPNG.fix('img, .png_bg'); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb
		</script>
		<![endif]-->
		
		<!-- Google Analytics -->
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-23904941-1']);
			_gaq.push(['_setDomainName', 'ifiwasceo.com']);
			_gaq.push(['_trackPageview']);
			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
		<!-- / Google Analytics -->
	</body>
</html>
<!-- End of line. -->