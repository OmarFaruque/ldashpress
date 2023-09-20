<?php
/**
 * @wordpress-plugin
 * Plugin Name:       LDashPress
 * Plugin URI:        https://bit.ly/3t3rSdC
 * Description:       Plugin for export learnpress all course, lesson, quiz, topic to learndash. Samilarly learndash to learnpress including enrolled user 
 * Version:           1.0.0
 * Author:            Omar Faruque
 * Author URI:        https://bit.ly/3t3rSdC
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ldpress
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class LD_Press
{
  public $plugin;
  public $slug;

  function __construct() {
    $this->plugin = plugin_basename(__FILE__);
    $this->slug = 'ldpress';
  }

  function register() {
    add_action('admin_menu', array($this, 'add_admin_page'));
    add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
    add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
  }

  public function settings_link( $links ) {
    $settings_link = '<a href="admin.php?page='.$this->slug .'">Settings</a>';
    array_push($links, $settings_link);
    return $links;
  }

  function enqueue_assets() {
    wp_enqueue_style( "$this->plugin-css", plugins_url('/public/styles.css', __FILE__) );
    wp_enqueue_script( "$this->plugin-js", plugins_url('/public/scripts.js', __FILE__), null, null, true );
  }

  public function add_admin_page() {
    add_menu_page("Vue WordPress", 'Vue WordPress', 'manage_options', $this->slug, array($this, 'admin_index'), '');
  }

  public function admin_index() {
    require_once plugin_dir_path(__FILE__) . 'templates/admin/index.php';
  }
}


/**
 * Call Plugin main file
 */
if ( class_exists('LD_Press') ) {
  $ldpress = new LD_Press();
  $ldpress->register();
}



// Activation
require_once plugin_dir_path(__FILE__)  . 'inc/ldpress-plugin-activate.php';
register_activation_hook( __FILE__, array( 'LdpressPluginActivate', 'activate' ) );



// Deactivation
require_once plugin_dir_path(__FILE__)  . 'inc/ldpress-plugin-deactivate.php';
register_deactivation_hook( __FILE__, array( 'LdpressPluginDeactivate', 'deactivate' ) );
