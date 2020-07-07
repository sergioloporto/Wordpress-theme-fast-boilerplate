<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
	<title><?php wp_title(''); ?></title>
	<meta charset="UTF-8">
	<?php wp_head(); ?>

</head>

<body class="body <?php echo (is_front_page()) ? 'home' : 'not-home'; ?>">
	<header class="header">
		<section class="header_nav">
			<nav class="header_nav__navbar">
				<?php
				wp_nav_menu(array(
					'theme_location' => 'menu-top',
					'container'      => 'ul',
					'menu_class'     => 'header_nav_ul',
					'menu_id'        => 'header_nav_id',
					'depth'          => 0,
				))
				?>
			</nav>
		</section>
	</header>
	<main class="main">