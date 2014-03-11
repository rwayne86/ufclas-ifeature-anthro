<?php 

// Allow shortcode in text widgets
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

// Add IE 8 compatibility script - http://code.google.com/p/ie7-js/
function ufclas_add_script(){
	echo '<!--[if lt IE 9]>
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	<![endif]-->';
}
add_action('wp_print_styles', 'ufclas_add_script');

// Register Header Right Sidebar
function ufclas_header_right_sidebar() {

	$args = array(
		'id'            => 'header-right',
		'name'          => __( 'Header Right', 'ufclas' ),
		'description'   => __( 'Widgets will appear in the header right', 'ufclas' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	);
	register_sidebar( $args );

}
add_action( 'widgets_init', 'ufclas_header_right_sidebar' );