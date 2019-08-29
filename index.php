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
	 * https://fontawesome.com/icons?d=gallery&m=free
	 */
	require_once("phps/cloudflare.interface.php");
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

	<link rel="stylesheet" type="text/css" href="libraries/Dark-Tooltip-0.4.0/darktooltip.css">

	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/loader.css">
	<link rel="stylesheet" type="text/css" href="styles/avatar.css">
	<link rel="stylesheet" type="text/css" href="styles/cube.css">
</head>

<body class="bg"><!-- onload="(function(){sleep(1000)}).call(this)" -->

	<div id="loader"></div>

	<div id="header" class="container">
		<div class="row"></div>
	</div>

	<div id="navibar">
		<?php require_once("imports/navbar.php"); ?>
	</div>

	<div id="content" class="container">
		<div class="row padding-bottom" style="padding-top: 100px">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<h4 class="alert-heading"><strong>I'd like to say that</strong></h4>
					<span>
						<?php echo "In the next month Sep~Oct I will move the website to <a href=\"https://vic.onl/\" class=\"alert-link\">Vic Online https://vic.onl/</a>"; ?>
					</span>
				</div>
			</div>
			<div class="col-sm-3"></div>
		</div>

		<div class="row padding-bottom">
			<div class="col-sm-3"></div>
			<div class="col-sm-3 auto-fit"><?php require_once("imports/avatar.php"); ?></div>
			<div class="col-sm-3"><?php require_once("imports/cube.php"); ?></div>
			<div class="col-sm-3"></div>
		</div>

		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<div class="text-left">
					<span style="font-size: 25px"><?php echo "Hi. I'm {$GLOBALS["author"]} Welcome to the geek' website."; ?></span>
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
					<h4><?php require_once("imports/visitor.php"); ?></h4>
				</div>
			</div>
			<div class="col-sm-3"></div>
		</div>

		<div class="row padding-bottom">
			<div class="col-sm-3"></div>
			<div class="col-sm-6"><?php require_once("imports/social.php"); ?></div>
			<div class="col-sm-3"></div>
		</div>

		<div class="row padding-bottom"></div><!-- padding for dynamic footer -->
	</div>

	<div id="footer" class="container">
		<div class="row"><?php require_once("imports/footer.php"); ?></div>
	</div>

	<?php require_once("imports/about.php"); ?>

	<script type="text/javascript" src="libraries/jQuery-3.1.1/jquery-3.1.1.min.js"></script>

	<script type="text/javascript" src="libraries/Bootstrap-3.3.7/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="libraries/Dark-Tooltip-0.4.0/jquery.darktooltip.js"></script>

	<script type="text/javascript" src="scripts/misc.js"></script>
	<script type="text/javascript" src="scripts/events.js"></script>
	<script type="text/javascript" src="scripts/loader.js"></script>

</body>

</html>