<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo $GLOBALS["base"]; ?>">
				<i class="fa fa-gg fa-lg" aria-hidden="true"></i>
			</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active">
					<a href="#">
						<i class="fa fa-home fa-lg" aria-hidden="true"></i>
					</a>
				</li>
				<li>
					<a id="mn_about" href="" data-toggle="modal" data-target="#md_modal">
						<i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>
					</a>
				</li>
				<li>
					<a target="_blank" href="<?php echo "https://github.com/{$GLOBALS["user"]}/{$GLOBALS["domain"]}/"; ?>">
						<i class="fa fa-star-o fa-lg" aria-hidden="true"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>