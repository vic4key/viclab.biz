<!DOCTYPE html>

<?php
	/**
	 * https://developers.facebook.com/docs/sharing/web
	 * https://developers.facebook.com/tools/debug/sharing/
	 * https://developers.facebook.com/tools/debug/og/object/
	 * https://developers.facebook.com/docs/sharing/webmasters/images
	 *
	 * https://fonts.google.com/
	 *
	 * https://fontawesome.com/icons?d=gallery
	 */
	require_once("cloudflare.interface.php");
?>

<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="author" content="<?php echo $GLOBALS["author"]; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo $GLOBALS["title"]." © ".$GLOBALS["author"]; ?>">

	<meta property="og:url" content="<?php echo $GLOBALS["base"]; ?>"/>
	<meta property="og:title" content="<?php echo $GLOBALS["title"]; ?>"/>
	<meta property="og:image" content="<?php echo $GLOBALS["cover"]; ?>"/>

	<title><?php echo $GLOBALS["title"]; ?></title>

	<link rel="icon" href="<?php echo $GLOBALS["icon"]; ?>">

	<link rel="stylesheet" type="text/css" href="libraries/Bootstrap-3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="libraries/Bootstrap-3.3.7/css/bootstrap-theme.min.css">

	<link rel="stylesheet" type="text/css" href="libraries/Font-Awesome-4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/avatar.css">
	<link rel="stylesheet" type="text/css" href="styles/cube.css">
</head>

<body class="bg height-100"> <!-- onload="(function(){sleep(1000)}).call(this)" -->

	<div class="loader"></div>

	<nav class="navbar navbar-inverse navbar-fixed-top" style="margin-bottom: 0px !important">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo $GLOBALS["base"]; ?>">VICLAB</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">HOME</a></li>
					<li><a id="mn_about" href="" data-toggle="modal" data-target="#md_modal">ABOUT</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div id="header" class="container">
		<div class="row"></div>
	</div>

	<div id="content" class="container height-100">
		<div class="row height-25"></div>

		<div class="row padding-bottom">
			<div class="col-sm-3"></div>
			<div class="col-sm-3 auto-fit">
				<div id="avatar" class="flip-card">
					<div class="flip-card-inner">
						<div class="flip-card-front">
							<img class="img-thumbnail img-thumbnail-avatar" src="<?php echo $GLOBALS["avatar"]; ?>">
						</div>
						<div class="flip-card-back">
							<h1><?php echo $GLOBALS["author"]; ?></h1>
							<p>Software Engineer</p>
							<p>Software Security</p>
							<p>Reverse Engineer</p>
							<p>Web Developer</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="wrap">
					<div class="cube">
						<div class="front"><span>Windows<br>Linux<br>Android</span></div>
						<div class="back"><span>C++<br>Python<br>PHP<br>JS</span></div>
						<div class="top"><span>IDA<br>OllyDbg<br>WinDbg<br>dnSpy</span></div>
						<div class="bottom"><span>MS VS<br>MS VS Code<br>Sublime Text</span></div>
						<div class="left"><span>SVN Server<br>Tortoise SVN<br>Tortoise Git</span></div>
						<div class="right"><span>Open CV<br>Open GL<br>jQuery<br>Boostrap</span></div>
					</div>
				</div>
			</div>
			<div class="col-sm-3"></div>
		</div>

		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<div class="text-left">
					<span style="font-size: 25px">Hi. I'm Vic P. Welcome to the geek' blog.</span>
				</div>
			</div>
			<div class="col-sm-1"></div>
		</div>

		<div class="row padding-bottom">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<div class="text-left">
					<h4>These are mostly fundamental information or tutorials for sharing.</h4>
					<h4>I hope you find what you are looking for here.</h4>
					<h4>
						<?php
							try
							{
								$jdata = ICloudFlare::Instance()->QueryVisitors(CF_UV_MONTH);
								jassert($jdata);
								printf("In the last %s, total %d visitors, at most %d and at least %d visitors per %s.",
									$jdata->unit_time,
									$jdata->total_visitors,
									$jdata->max_visitors,
									$jdata->min_visitors,
									$jdata->per_time
								);
							}
							catch(Exception $exception)
							{
								// the exception code handling here
							}
						?>
					</h4>
				</div>
			</div>
			<div class="col-sm-3"></div>
		</div>

		<div class="row padding-bottom">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<a target="_blank" data-toggle="tooltip" title="Blog" href="<?php echo "http://blog.".$GLOBALS["domain"]; ?>">
					<i id="link1" class="fa fa-rss-square fa-fw"></i>
				</a>

				<a target="_blank" data-toggle="tooltip" title="GitHub" href="<?php echo "https://github.com/".$GLOBALS["user"]; ?>">
					<i class="fa fa-github-square fa-fw"></i>
				</a>

				<a target="_blank" data-toggle="tooltip" title="Twitter" href="<?php echo "https://twitter.com/".$GLOBALS["user"]; ?>">
					<i class="fa fa-twitter-square fa-fw"></i>
				</a>

				<a target="_blank" data-toggle="tooltip" title="Youtube" href="https://www.youtube.com/channel/UCa6sreb--oyg1LHC2LQQxPg">
					<i class="fa fa-youtube-square fa-fw"></i>
				</a>

				<a target="_self" data-toggle="tooltip" title="Email" href="<?php echo "mailto:".$GLOBALS["email"]; ?>">
					<i class="fa fa-envelope fa-fw"></i>
				</a>
			</div>
			<div class="col-sm-3"></div>
		</div>

		<div class="row padding-bottom">
			<div class="col-sm-3"></div>
			<div class="col-sm-6"></div>
			<div class="col-sm-3"></div>
		</div>
	</div>

	<div id="footer" class="container text-center">
		<div class="row">
			<span class="text-muted"><?php echo "Copyright © {$GLOBALS["author"]} 2014 - {$GLOBALS["year"]}" ?></span>
		</div>
	</div>

	<div class="modal fade" id="md_modal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content bg">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				</div>
				<div class="modal-body">Modal Content</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="libraries/jQuery-3.1.1/jquery-3.1.1.min.js"></script>

	<script type="text/javascript" src="libraries/Bootstrap-3.3.7/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="scripts/misc.js"></script>
	<script type="text/javascript" src="scripts/events.js"></script>
</body>

</html>