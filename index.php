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

/**
 * This is not required because the template is filtered by the Router; however,
 * in case the router fails, let's include the template here as a fallback.
 */
get_template_part( 'templates/views/configs/index' );
