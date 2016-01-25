<?php
/**
 * Plugin Name: CYP - Chabad.org Support
 * Version: 0.1.0
 * Author: Shmuli Markel
 * Author URI: http://shmulimarkel.com
 * Description: Adds ChabadOne support for admin users
 */

// load css to both frontend and backend
function load_custom_top_bar_css() {
  wp_register_style( 'cyp_support_custom_css', plugins_url( 'styles.css', __FILE__ ), false, '1.0.0' );
  wp_enqueue_style( 'cyp_support_custom_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_top_bar_css' );
add_action( 'wp_enqueue_scripts', 'load_custom_top_bar_css' );

// add dashboard widget
add_action( 'wp_dashboard_setup', 'dashboard_widgets_link_to_support' );
function dashboard_widgets_link_to_support() {
  global $wp_meta_boxes;
  wp_add_dashboard_widget( 'custom_help_widget', 'CYP Support', 'cyp_dashboard' );
}

// widget content callback
function cyp_dashboard() {
  echo '<p>Need help? Found a bug? Contact support <a href="http://www.chabadone.org/platform/personal/support/TechnicalSupport.asp?category=ChabadOne%20Sites%20-%20CYP" target="_blank">here</a>.</p>';
  echo '<a href="http://www.chabadone.org/platform/personal/support/TechnicalSupport.asp?category=ChabadOne%20Sites%20-%20CYP" target="_blank"><img src="' . plugins_url( 'chabadone_logo.png', __FILE__ ) . '" height="23" width="137"/></a>';
}

// add admin menu-bar item
add_action( 'admin_bar_menu', function( \WP_Admin_Bar $bar ){
  $bar->add_menu( array(
      'id'     => 'chabadone',
      'title'  => '<span class="ab-icon"></span>'.__( 'Support', 'some-textdomain' ),
      'href'   => 'http://www.chabadone.org/platform/personal/support/TechnicalSupport.asp?category=ChabadOne%20Sites%20-%20CYP',
      'meta'   => array(
        'target'   => '_blank',
      ),
  ) );
}, 999 );