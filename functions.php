<?php
/**
 * Theme functions and definitions
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
    $version = rand(111,999);
    wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
       $version 
	);
    wp_enqueue_style('wc-custom-style',
        get_stylesheet_directory_uri() . '/wc-custom-style.css',
        array(),
       $version 
    );
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );

require_once(__DIR__ . '/includes/security.php');

// Includere supporto per woocommerce
add_theme_support('woocommerce');

// Shortcode to place *post content* where you want
function wpc_elementor_shortcode( $atts ) {
    if ( have_posts() ) : while ( have_posts() ) : the_post();
	the_content();
	endwhile; else: ?>
	<p>Sorry, no posts matched your criteria.</p>
	<?php endif;
}
add_shortcode( 'my_elementor_postcontent', 'wpc_elementor_shortcode');

// Shortcode to place post content where you want, but shorter
function wpc_elementor_shortcode_2( $atts ) {
	echo get_post_field('post_content', $post->ID);
}
add_shortcode( 'my_elementor_postcontent_shorter', 'wpc_elementor_shortcode_2');

/**
*  Aggiungi icone personalizzate ai gataway di pagamento 
*/ 
function custom_gateway_icon( $icon, $id ) {
    if ( $id === 'stripe' ) {
        return '<img src="' . get_stylesheet_directory_uri() . '/includes/stripe.svg' . '" alt="Stripe" width="50" > 
                <img src="' . get_stylesheet_directory_uri() . '/includes/visa.svg' . '" alt="Visa" width="50" > 
                <img src="' . get_stylesheet_directory_uri() . '/includes/mastercard.svg' . '" alt="Mastercard" width="50" >
        '; 
    } elseif ($id === 'bacs') {
        return '<img src="' . get_stylesheet_directory_uri() . '/includes/bank.svg' . '" alt="Bank Transfert" width="30" >
        ';
    } elseif ($id === 'paypal') {
        return '<img src="' . get_stylesheet_directory_uri() . '/includes/paypal.svg' . '" alt="Bank Transfert" width="50" >';
    }else {
        return $icon;
    }
}
add_filter( 'woocommerce_gateway_icon', 'custom_gateway_icon', 10, 2 );
