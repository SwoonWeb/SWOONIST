<?php

/*
 * Load theme scripts
 */
function theme_scripts() {
	// Load theme style
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'styles', get_template_directory_uri().'/styles.css' );
	// Load theme javascriot
	wp_enqueue_script('jquery');
	wp_enqueue_script('tether', get_template_directory_uri().'/vendor/tether/tether.min.js', array(), '4.0.0', true);
	wp_enqueue_script('bootstrap', get_template_directory_uri().'/vendor/bootstrap/bootstrap.js', array(), '4.0.0', true);
	wp_enqueue_script('ie10-viewport-bug-workaround', get_template_directory_uri().'/vendor/bootstrap/ie10-viewport-bug-workaround.js', array(), '4.0.0', true);
	wp_enqueue_script('select2', get_template_directory_uri().'/vendor/select2/select2.min.js', array(), '4.0.2', true);

	wp_enqueue_script('magnific-popup', get_template_directory_uri().'/vendor/magnific-popup/jquery.magnific-popup.min.js', array(), '1.1.0', true);

	// // https://developers.google.com/maps/documentation/javascript/get-api-key
	// wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBiDK98hDgbGYKAXant_mGAbtfLW7_wRtY', array(), '1.0.0', true);
	// wp_enqueue_script('atg-map', get_template_directory_uri().'/js/map.js', array(), '1.0.0', true);

	wp_enqueue_script('atg-common', get_template_directory_uri().'/js/common.js', array(), '1.0.0', true);
	wp_enqueue_script('atg-affix', get_template_directory_uri().'/js/affix.js', array(), '1.0.0', true);
	wp_enqueue_script('atg-sidenav', get_template_directory_uri().'/js/sidenav.js', array(), '1.0.0', true);
	wp_enqueue_script('atg-google-ads', '//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js', array(), '1.0.0', true);
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

// function footer_scripts(){
// 	echo '
// 		<script>
// 	  (adsbygoogle = window.adsbygoogle || []).push({});
// 	  </script>
// 	';
// }
// add_action('wp_footer', 'footer_scripts');