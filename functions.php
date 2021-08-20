<?php
// Theme functions and definitions
// @package HelloChildWoo

// Load child theme css and optional scripts 
// @return void
function hello_elementor_child_enqueue_scripts() {
    $version = rand(111,999);
    wp_enqueue_style(						// include foglo di stile del tema child
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
       $version 
	);
    wp_enqueue_style('wc-custom-style',				// include foglio di stile per WooCommerce
        get_stylesheet_directory_uri() . '/wc-custom-style.css',
        array(),
       $version 
    );
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );

require_once(__DIR__ . '/includes/security.php');		// include funzioni per la sicurezza dalla cartella /includes/
add_theme_support('woocommerce');				// include supporto per WooCommerce

//  icone personalizzate ai gataway di pagamento su WooCommerce Checkout (file immagine in svg inclusi nella cartella /includes/)
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
