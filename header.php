<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main>
 * and the left sidebar conditional
 *
 * @since 1.0.0
 */
?><!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if IE]><script src="<?php echo BAVOTASAN_THEME_URL; ?>/library/js/html5.js"></script><![endif]-->
<?php wp_head(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-57003410-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body <?php body_class(); ?>>
	<div id="page">

		<header id="header">
			<div class="container header-meta">
				<div id="site-meta">
                    <?php $smamo_logo_options = get_option( 'theme_smamo_logo_options' ); $logo_url = $smamo_logo_options['logo']; if ($logo_url !== ''):?>
                    <a id="site-logo" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                       <img src="<?php echo esc_url($logo_url); ?>"/> 
                    </a>
                    
                    <h1 class="site-title" style="display:none;" >
						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</h1>
                    
                    <?php else : ?>
					
                    <h1 class="site-title" >
						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</h1>
                    
                    <?php endif; ?>
					
                    <!--<h2 class="site-description">
						<?php //bloginfo( 'description' ); ?>
					</h2>-->
                    
				</div>

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		          <i class="fa fa-bars"></i>
		        </button>

				<nav id="site-navigation" class="navbar" role="navigation">
					<h3 class="sr-only"><?php _e( 'Main menu', 'matheson' ); ?></h3>
					<a class="sr-only" href="#primary" title="<?php esc_attr_e( 'Skip to content', 'matheson' ); ?>"><?php _e( 'Skip to content', 'matheson' ); ?></a>

					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'collapse navbar-collapse', 'menu_class' => 'nav nav-justified', 'fallback_cb' => 'bavotasan_default_menu', 'depth' => 2 ) ); ?>
				</nav><!-- #site-navigation -->
			</div>
		</header>

		<?php
		// Header image section
		header_images();
		?>

		<main>