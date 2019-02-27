<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Barlow:100,300,400,700,900|Lobster+Two:400,700,700i" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="/wp-content/themes/themename/assets/images/touch/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/wp-content/themes/themename/assets/images/touch/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/wp-content/themes/themename/assets/images/touch/favicon-16x16.png">
    <link rel="manifest" href="/wp-content/themes/themename/assets/images/touch/site.webmanifest">
    <link rel="mask-icon" href="/wp-content/themes/themename/assets/images/touch/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/wp-content/themes/themename/assets/images/touch/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="msapplication-config" content="/wp-content/themes/themename/assets/images/touch/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<title><?php (is_front_page() ? '' : wp_title('|', true, 'right')) ?><?php bloginfo('name'); ?></title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header>
		<div class="container">
			<nav id="main-nav">
				<ul>
					<li class="logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home">
							<img title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo get_template_directory_uri() ?>/assets/images/logo.png"/>
						</a>
                        <a href="#" class="close-menu"></a>
					</li>
				<?php

					wp_nav_menu(array(
						'theme_location' => 'main_menu',
						'menu_class' => 'main-menu',
						'container' => false,
						'items_wrap' => '%3$s'
					));

					$locations = get_nav_menu_locations();
					$menu = wp_get_nav_menu_object( $locations['main_menu'] );
					$menuItems = wp_get_nav_menu_items($menu->term_id);
					$menuCount = 0;
					foreach($menuItems as $menuItem) {
					    if ($menuItem->menu_item_parent == 0) {
					        $menuCount++;
                        }
                    }

					for ($i = $menuCount; $i < 6; $i++) { ?>
						<li class="empty-item"></li>
					<?php }
				?>

				</ul>
			</nav>
            <a href="#" class="toggle-mobilenav">
                <span></span>
                <span></span>
                <span></span>
            </a>
            <nav id="mobile-nav">
                <div class="logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home">
                        <img title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo get_template_directory_uri() ?>/assets/images/logo.png"/>
                    </a>
                </div>
                <ul>
                    <li>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home">
                            <img title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo get_template_directory_uri() ?>/assets/images/logo-mobile.png"/>
                        </a>
                        <a href="#" class="close-menu"></a>
                    </li>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'mobile_menu',
                        'menu_class' => 'mobile-menu',
                        'container' => false,
                        'items_wrap' => '%3$s'
                    ));
                    ?>
                </ul>
            </nav>
		</div>
	</header>

	<section id="content">
		<div class="container">