<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.lyft.com/widgets
 * @since             1.0.0
 * @package           Ride_Here_With_Lyft
 *
 * @wordpress-plugin
 * Plugin Name:       Ride Here With Lyft
 * Plugin URI:        https://www.lyft.com/widgets
 * Description:       Embed a Lyft ride button on your site to bring customers straight to your door.
 * Version:           1.1.0
 * Author:            Lyft
 * Author URI:        https://www.lyft.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ride-here-with-lyft
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('RIDE_HERE_WITH_LYFT_VERSION', '1.0.0');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ride-here-with-lyft.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ride_here_with_lyft() {

	$plugin = new Ride_Here_With_Lyft();
	$plugin->run();

}
run_ride_here_with_lyft();

