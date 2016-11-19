<?php
/**
 * Main theme initialization file.
 *
 * @package Xavier
 */

namespace Xavier;

// Initialize the Xavier global variable.
$GLOBALS['xavier'] = null;

require_once __DIR__ . '/includes/php/class-module.php';
require_once __DIR__ . '/includes/php/class-theme.php';
require_once __DIR__ . '/includes/php/class-compatability.php';
require_once __DIR__ . '/includes/php/class-enqueues.php';
require_once __DIR__ . '/includes/php/class-setup.php';
require_once __DIR__ . '/includes/php/class-configs.php';
require_once __DIR__ . '/includes/php/class-menu.php';

// Initilaze Xavier.
$GLOBALS['xavier'] = new Theme();
$GLOBALS['xavier']->init();
