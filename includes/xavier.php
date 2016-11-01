<?php
/**
 * Main theme initialization file.
 *
 * @package Xavier
 */

namespace Xavier;

// Initialize the Xavier global variable.
$GLOBALS['xavier'] = null;

require_once __DIR__ . '/php/class-module.php';
require_once __DIR__ . '/php/class-theme.php';
require_once __DIR__ . '/php/class-compatability.php';
require_once __DIR__ . '/php/class-assets.php';
require_once __DIR__ . '/php/class-setup.php';
require_once __DIR__ . '/php/class-configs.php';
require_once __DIR__ . '/php/class-menu.php';

// Initilaze Xavier.
$GLOBALS['xavier'] = new Theme();
$GLOBALS['xavier']->init();
