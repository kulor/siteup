<?php require('sitecheck.php') ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Siteup check</title>
		<link rel="stylesheet" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/base/base-min.css"> 
	</head>
	<body>
		<div id="doc" class="yui-t7">
			<div id="hd">
				<h1>Siteup check</h1>
				<h3>Monitoring the status of your websites</h3>
			</div>
			<div id="bd">
				<div class="yui-g">
					<ul>
						<?php
						$sitecheck_carbonsilk = new Sitecheck('http://www.carbonsilk.com', 'Carbon Silk');
						$sitecheck_carbonsilk->notify_email = 'you@example.com';
						echo '<li>' . $sitecheck_carbonsilk->status_response() . '</li>';

						$sitecheck_apple = new Sitecheck('http://www.apple.com', 'Apple');
						$sitecheck_apple->notify_email = 'you@example.com';
						echo '<li>' . $sitecheck_apple->status_response() . '</li>';
						?>
					</ul>
				</div>
			</div>
			<div id="ft">Siteup by <a href="http://www.carbonsilk.com">Carbon Silk</a>. Source code at <a href="http://github.com/kulor/siteup/tree/master">GitHub</a></div>
		</div>
	</body>
</html>