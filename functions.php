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


// Customize page titles with Page titles first instead of site name
function ufclas_site_title( $title ){
 	global $page, $paged;
	
	$sep = ' » ';
	$site_description = get_bloginfo( 'description' );
	$site_organization = __('University of Florida', 'ufclas');
	
	// Custom title for the home page
	if( empty( $title ) && ( is_home() || is_front_page() ) ) {
		return get_bloginfo( 'name' ) . $sep . get_bloginfo( 'description' ) . $sep . $site_organization;
	}
	
	// Custom title for everything else
	$filtered_title = $title . $sep . get_bloginfo( 'name' );
	$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? $sep . sprintf( __( 'Page %s' ), max( $paged, $page ) ) : '';
	$filtered_title .=  $sep . $site_organization;
	
	return $filtered_title;
}

add_filter('wp_title', 'ufclas_site_title');

// Remove the parent theme filter
function ufclas_remove_default_site_title() {
	remove_filter( 'wp_title', 'cyberchimps_default_site_title', 10, 3 );
}
add_action( 'init', 'ufclas_remove_default_site_title' );