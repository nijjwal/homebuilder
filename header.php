<!DOCTYPE html>
<html>
	<head>
		<title><?php wp_title(' | ', true, 'right'); ?><?php bloginfo('name'); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href = "<?php bloginfo('stylesheet_url');?>" rel = "stylesheet" type="text/css">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<?php wp_head(); ?>
	</head>
	<body>

		<div class = "navbar navbar-inverse navbar-static-top" id="navbgimg">
			<div class = "container">
				
				
				<a class="navbar-brand" href="<?php echo site_url(); ?>" id="logo">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png"/>
				</a>


				<div style="text-align:right">
			    	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/pinterest_small.png">
			    	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/linkedin_small.png">
			    	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/facebook_small.png">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/images/youtube_small.png">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/images/ask_sanjit.png">
				</div>
				
				<button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
					<span class = "icon-bar"></span>
					<span class = "icon-bar"></span>
					<span class = "icon-bar"></span>
				</button>
				
				<div class = "collapse navbar-collapse navHeaderCollapse">
				
					<?php
				            wp_nav_menu( array(
				                'menu'              => 'primary',
				                'theme_location'    => 'primary',
				                'depth'             => 2,
				                'menu_class'        => 'nav navbar-nav navbar-right',
				                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
				                'walker'            => new wp_bootstrap_navwalker())
				            );
				    ?>
				
				</div>

				<br/>
				
			</div>
		</div>
		
		<div class = "container">