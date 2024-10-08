<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @link        https://posimyth.com/
 * @since       5.6.6
 *
 * @package     the-plus-addons-for-elementor-page-builder
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// delete_option('default_plus_options');