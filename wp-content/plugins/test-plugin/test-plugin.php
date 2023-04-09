<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://test.com
 * @since             1.0.0
 * @package           Test
 *
 * @wordpress-plugin
 * Plugin Name:       Test Plugin
 * Plugin URI:        https://test.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           0.1.0
 * Author:            Alex Reyes
 * Author URI:        https://test.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       test-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

/**
 * Plugin version.
 */
define('TEST_VERSION', '1.0.26');

/**
 * Current plugin dir.
 */
define('TEST_DIR', plugin_dir_path(__FILE__));

/**
 * Current plugin url.
 */
define('TEST_URL', plugin_dir_url(__FILE__));

/**
 * Table prefix for the plugin
 */
define('TEST_TABLE_PREFIX', 'test_');

/**
 * Table prefix for the plugin
 */
define('TEST_REST_API_NAMESPACE', 'purposeai/v1');

/**
 * Script prefix for the plugin
 */
define('TEST_SCRIPT_NAMESPACE', 'purpose-ai-');

require TEST_DIR . '/vendor/autoload.php';

/**
 * Register the custon autoloader for this plugin.
 */
spl_autoload_register(function ($classname) {
  if (strpos($classname, 'Test') !== false) {
    // Separate the classname into parts
    $parts = explode('\\', $classname);
    // Remove the first part since it's the main namespace
    array_shift($parts);
    // Remove the last part and turn it into the file name
    $file = 'class-' . strtolower(str_replace('_', '-', array_pop($parts))) . '.php';
    // if we still have parts then join them as a path.
    $path = (!empty($parts)) ? strtolower(str_replace('_', '-', implode(DIRECTORY_SEPARATOR, $parts))) . DIRECTORY_SEPARATOR : '';
    // Create the final path to the file.
    $file_path = TEST_DIR . 'includes' . DIRECTORY_SEPARATOR . $path . $file;
    // If the file path exists, require it!
    if (file_exists($file_path)) {
      require_once $file_path;
    }
  }
});

use Test\Test;

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-purpose-ai-activator.php
 */
function activate_test_plugin() {
  // Do stuff here
}
register_activation_hook(__FILE__, 'activate_test_plugin');

$testPlugin = new Test();
