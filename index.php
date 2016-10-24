<?php
/**
 * Xavier keeps its templates within a different directory (templates)
 * and uses the Template Router to direct traffic to the correct configs. From
 * there, Timber & Twig take over to handle the rest of the initial load.
 *
 * The index.php template is required by WordPress show a theme as available
 * in the WordPress admin screen.
 *
 * @package Xavier
 */

?>

<!DOCTYPE html>
<html class="nojs" lang="">
	<head>
		<title><?php wp_title() ?></title>
		<meta charset="" />
		<meta name="description" content="">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="pingback" href="" />

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<xavier>
			<!-- Content here is only visible for bots. -->
			<div class="invisible">
				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) {
						echo '<h1>' . single_post_title( '', false ) . '</h1>';
					}

					while ( have_posts() ) : the_post();

						if ( is_singular() ) {
							the_title( '<h1>', '</h1>' );
						} else {
							the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
						}

						the_content();

					endwhile;

				endif;
				?>
			</div>
		</xavier>

		<?php wp_footer(); ?>
	</body>
</html>
