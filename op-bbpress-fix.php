<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.optimizepress.com/
 * @since             1.0.1
 * @package           Op_bbPress_Fix
 *
 * @wordpress-plugin
 * Plugin Name:       OptimizePress bbPress fix
 * Plugin URI:        http://www.optimizepress.com/
 * Description:       Allow rendering of forums on OptimizePress blog
 * Version:           1.0.1
 * Author:            OptimizePress
 * Author URI:        http://www.optimizepress.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       op-bbpress-fix
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

if (!function_exists('op_allow_bbforum')) {
    function op_allow_bbforum()
    {
        $forumPage = get_post(url_to_postid("http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']));

        if ($forumPage->post_type == 'forum') {
            op_update_option('blog_enabled', 'Y');
            op_update_option('installed', 'Y');
        }
    }
}
add_action('init', 'op_allow_bbforum');

if (!function_exists('bb_reply_renderPageTemplate')){
    function bb_reply_renderPageTemplate(){
        return OP_THEME_DIR . 'page.php';
    }
}
add_filter('opRenderOtherTemplate','bb_reply_renderPageTemplate');