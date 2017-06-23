<?php
/*
  Plugin Name: BOX
  Version: 4.9.9
  Author: Kriitka Bang
  Description: Its a Wordpress Plugin to cretae div article.
  License: GPL
 */

// Define plugin constants
define( 'SU_PLUGIN_FILE', __FILE__ );
define( 'SU_PLUGIN_VERSION', '4.9.9' );
define( 'SU_ENABLE_CACHE', true );

// Includes
require_once 'inc/vendor/sunrise.php';
require_once 'inc/core/admin-views.php';
require_once 'inc/core/requirements.php';
require_once 'inc/core/load.php';
require_once 'inc/core/assets.php';
require_once 'inc/core/shortcodes.php';
require_once 'inc/core/tools.php';
require_once 'inc/core/data.php';
require_once 'inc/core/generator-views.php';
require_once 'inc/core/generator.php';
require_once 'inc/core/widget.php';
require_once 'inc/core/vote.php';
require_once 'inc/core/counters.php';
