<?php
/**
 * The main template file.
 *
 * Kind of a "catch all" when nothing else matches.
 *
 * @package Xavier
 */

$context = Timber::get_context();

Timber::render( 'index.twig', $context );
