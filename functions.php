<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);
}

add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );

/*	****************************  */
/*  Useful function for security  */
/*	****************************  */

/* _Forgot Password_ function avialable only for $admin_can_change
$admin_can_change = '';
add_filter( 'show_password_fields', function() {
    if ( is_admin() && ! current_user_can( $admin_can_change ) ) {
        return false;
    }
    return true;
} );
*/

/* Nascondi utente dalla lista

add_action('pre_user_query','site_pre_user_query');
function site_pre_user_query($user_search) {
	global $current_user;
	$username = $current_user->user_login;

	if ($username == 'HIDDEN_USER') {
	}

	else {
	global $wpdb;
    $user_search->query_where = str_replace('WHERE 1=1',
      "WHERE 1=1 AND {$wpdb->users}.user_login != 'HIDDEN_USER'",$user_search->query_where);
  }
}
*/

/*REMOVE SIMPLY DISCOVER*/
remove_action('wp_head', 'rsd_link');
/*REMOVE WP VERSION*/
remove_action('wp_head', 'wp_generator');
/*RIMUOVE RSS LINK*/
remove_action('wp_head', 'feed_links', 2);
/*RIMUOVE EXTRA FEED LINKS*/
remove_action('wp_head', 'feed_links_extra', 3);
/*RIMUOVE SUPPORTO WINDOWS LIVE WRITER*/
remove_action('wp_head', 'wlwmanifest_link');
/*REMOVE SHORTLINKS*/
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
