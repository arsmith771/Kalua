<?php

/*==================================================
=            Starter Theme Introduction            =
==================================================*/

/**
 *
 * About Starter
 * --------------
 * Starter is a project by Calvin Koepke to create a starter theme for Genesis Framework developers that doesn't over-bloat
 * their starting base. It includes commonly used templates, codes, and styles, along with optional SCSS and Gulp tasking.
 *
 * Credits and Licensing
 * --------------
 * Starter was created by Calvin Koepke, and is under GPL 2.0+.
 *
 * Find me on Twitter: @cjkoepke
 *
 */


/*============================================
=            Begin Functions File            =
============================================*/

/**
 *
 * Define Child Theme Constants
 *
 * @since 1.0.0
 *
 */
define( 'CHILD_THEME_NAME', 'kalua' );
define( 'CHILD_THEME_AUTHOR', '' );
define( 'CHILD_THEME_AUTHOR_URL', '' );
define( 'CHILD_THEME_URL', '' );
define( 'CHILD_THEME_VERSION', '0.5' );
define( 'TEXT_DOMAIN', 'kalua' );

/**
 *
 * Start the engine
 *
 * @since 1.0.0
 *
 */
include_once( get_template_directory() . '/lib/init.php');

//------------------------- Image sizes -------------
add_image_size( 'thumb-1', 280, 230, true ); // width, height, crop
/*
add_image_size( 'thumb-1', 400, 300, true ); // width, height, crop
add_image_size( 'thumb-2', 580, 318, true ); // width, height, crop
add_image_size( 'thumb-3', 400, 400, true ); // width, height, crop

*/

/**
 *
 * Load files in the /assets/ directory
 *
 * @since 1.0.0
 *
 */
add_action( 'wp_enqueue_scripts', 'kalua_load_assets' );
function kalua_load_assets() {

	// Load fonts. Font files served locally, not from Google Fonts CDN
	/*
	 wp_enqueue_style( 'kalua-fonts', '//fonts.googleapis.com/css2?family=PT+Sans:ital@0;1&family=Roboto+Slab:wght@400;700&display=swap', array(), CHILD_THEME_VERSION, null );
	 */
	
	// Load slick css.
	wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/slick.css', array(), CHILD_THEME_VERSION );

	// Load JS.
	wp_enqueue_script( 'kalua-global', get_stylesheet_directory_uri() . '/build/js/global.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Load Slick JS.
	wp_enqueue_script( 'slick-js', get_stylesheet_directory_uri() . '/build/js/slick.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Load whatinput JS.
	wp_enqueue_script( 'whatinput-js', get_stylesheet_directory_uri() . '/build/js/what-input.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Load default icons.
	wp_enqueue_style( 'dashicons' );


}

/**
 * Set the responsive menu arguments.
 *
 * @return array Array of menu arguments.
 *
 * @since 1.1.0
 */
function starter_get_responsive_menu_args() {

	$args = array(
		'mainMenu'         => __( 'Menu', TEXT_DOMAIN ),
		'menuIconClass'    => 'dashicons-before dashicons-menu',
		'subMenu'          => __( 'Menu', TEXT_DOMAIN ),
		'subMenuIconClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
				'.nav-secondary',
			),
			'others'  => array(
				'.nav-footer',
				'.nav-sidebar',
			),
		),
	);

	return $args;

}

/**
 *
 * Add theme supports
 *
 * @since 1.0.0
 *
 */
add_theme_support( 'genesis-responsive-viewport' ); /* Enable Viewport Meta Tag for Mobile Devices */
add_theme_support( 'html5',  array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) ); /* HTML5 */
add_theme_support( 'genesis-accessibility', array( 'skip-links', 'search-form', 'drop-down-menu', 'headings' ) ); /* Accessibility */
add_theme_support( 'genesis-after-entry-widget-area' ); /* After Entry Widget Area */
add_theme_support( 'genesis-footer-widgets', 3 ); /* Add Footer Widgets Markup for 3 */


/**
 *
 * Apply custom body classes
 *
 * @since 1.0.0
 * @uses /lib/classes.php
 *
 */
include_once( get_stylesheet_directory() . '/lib/classes.php' );

/**
 *
 * Apply Starter Theme defaults (overrides default Genesis settings)
 *
 * @since 1.0.0
 * @uses /lib/defaults.php
 *
 */
include_once( get_stylesheet_directory() . '/lib/defaults.php' );

/**
 *
 * Apply Starter Theme default attributes
 *
 * @since 1.0.0
 * @uses /lib/attributes.php
 *
 */
include_once( get_stylesheet_directory() . '/lib/attributes.php' );


//------------------------------- KALUA -----------------------------

// Custom menu shortcode 
add_shortcode('menu', 'print_menu_shortcode');
function print_menu_shortcode($atts, $content = null) {

    extract(shortcode_atts(array( 'name' => null, ), $atts));
    return wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
}

// Move Primary Nav Menu into Header
/*
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav' );
*/

// ------------------------------- Header --------------------------------------------

// Contact details
add_action('genesis_header', 'contact_details', 11 );
function contact_details(){

	echo '<address class="site-header__contact" id="site-header__contact"><a href="tel:' . types_render_field( 'telehone-number', array("id" => "15") ) . '">' . types_render_field( 'telehone-number', array("id" => "15") ) . '</a>' . types_render_field( 'email-address', array("id" => "15") ) . '</address>';
}

// Hamburger
add_action('genesis_header', 'menu_toggle_btn', 12 );
function menu_toggle_btn(){

	echo '<button class="menu-wrapper" id="hamburger-menu"><span class="hamburger-menu"></span></button>';
}


// ------------------------------- Homepage --------------------------------------------

// Remove the entry title
if ( is_page_template( 'templates/homepage.php') ){

	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
}

add_action( 'get_header', 'remove_titles_homepage' );
function remove_titles_homepage() {

    if ( is_page_template( 'templates/homepage.php') ){

        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    }
}

// Intro section
add_action('genesis_entry_content', 'intro_homepage', 10 );
function intro_homepage(){

	if ( is_page_template( 'templates/homepage.php') ){

		echo '<section class="intro-home row" style="background-image: url(https://kalua.local/wp-content/themes/kalua/images/headphones-cover.jpg)"><div class="wrap">';

			echo '<h1 class="intro-home__title"><span>' . types_render_field( 'intro-header-1-home', array() ) . '</span> ' . types_render_field( 'intro-header-2-home', array() ) . '</h1>';

			echo '<ul class="intro-home__list"><li class="intro-home__list-item"><a href="/radio" class="cta-1">Radio</a></li><li class="intro-home__list-item"><a href="/podcasts" class="cta-1">Podcasts</a></li><li class="intro-home__list-item"><a href="/digital" class="cta-1">Digital</a></li></ul>';

		echo '</div></section>'; 
	}
}



// Client logo carousel
add_action('genesis_entry_content', 'client_carousel_homepage', 11 );
function client_carousel_homepage(){

	if ( is_page_template( 'templates/homepage.php') ){

		echo '<section class="client-logos row row--2"><div class="wrap"><p class="client-logos__intro">Where you&apos;ll hear our work</p>' . do_shortcode('[wpv-view name="client-carousel"]') . '</div></section>';

	}
}



// What we do section
add_action('genesis_entry_content', 'what_we_do_homepage', 12 );
function what_we_do_homepage(){

	if ( is_page_template( 'templates/homepage.php') ){

		echo '<div id="what-we-do" class="anchor"></div>';

		echo '<section class="what-we-do row row--1"><div class="wrap">';

			echo '<h2>' . types_render_field( 'services-1-title-home', array() ) . '</h2>';

			echo types_render_field( 'services-1-text-home', array() );

			echo do_shortcode('[wpv-view name="service-blocks"]');

			echo '<p class="what-we-do__listen"><a href="#" class="what-we-do__listen__cta" target="_blank">Listen to our work <i class="fab fa-soundcloud"></i></a></p>';

		echo '</div></section>'; 
	}
}


// Who we work with section
add_action('genesis_entry_content', 'who_we_work_with_homepage', 13 );
function who_we_work_with_homepage(){

	if ( is_page_template( 'templates/homepage.php') ){

		echo '<div id="who-we-work-with" class="anchor"></div>';

		echo '<section class="who-we-work-with row"><div class="wrap">';

			echo '<h2>' . types_render_field( 'client-brands-title-home', array() ) . '</h2>';

			echo '<div class="who-we-work-with__list-container">' . do_shortcode('[wpv-view name="client-list"]') . '</div>';

			echo '<p><a href="#get-in-touch" class="cta-3">Get in touch</a></p>';

		echo '</div></section>'; 
	}
}


// Get in touch section
add_action('genesis_entry_content', 'get_in_touch_homepage', 14 );
function get_in_touch_homepage(){

	if ( is_page_template( 'templates/homepage.php') ){

		echo '<div id="get-in-touch" class="anchor"></div>';

		echo '<section class="get-in-touch-home row"><div class="wrap3">';

			echo '<h2>' . types_render_field( 'get-in-touch-title-home', array() ) .  '</h2>';

			echo types_render_field( 'get-in-touch-text2-home', array() );  

			echo do_shortcode('[wpv-view name="get-in-touch-blocks"]');


		echo '</div></section>'; 
	}
}


// ------------------------------- Radio page --------------------------------------------

// Intro section
add_action('genesis_entry_content', 'intro_radio', 10 );
function intro_radio(){

	if ( is_page_template( 'templates/radio.php') ){

		echo '<section class="intro-radio row row--2" >';

			echo '<div class="intro-radio__content wrap2">';

				echo '<div class="intro-radio__content__img" style="background-image: url(' . types_render_field( 'intro-image-radio', array("url" => "true") ) . ');"></div>';

				echo '<div class="intro-radio__content__txt">' . types_render_field( 'intro-text-radio', array() ) . '</div>';

			echo '</div>';

		echo '</section>'; 
	}
}

// Client logo carousel
add_action('genesis_entry_content', 'client_carousel_radio', 11 );
function client_carousel_radio(){

	if ( is_page_template( 'templates/radio.php') ){

		echo '<section class="client-logos row row--2"><div class="wrap">' . do_shortcode('[wpv-view name="client-carousel"]') . '</div></section>';

	}
}

// Services One section
add_action('genesis_entry_content', 'services_1_radio', 12 );
function services_1_radio(){

	if ( is_page_template( 'templates/radio.php') ){

		echo '<section class="services-1-radio row"><div class="wrap3">';

			echo '<h2 class="services-1-radio__title">' . types_render_field( 'content-row-1-title-radio', array() ) . '</h2>';

			echo types_render_field( 'content-row-1-text-radio', array() );

			echo '<p class="services-1-radio__cta-row"><a href="#get-in-touch-radio" class="cta-2">Get in touch</a></p>';
 
		echo '</div></section>'; 
	}
}

// Accreditation section
add_action('genesis_entry_content', 'accreditation_radio', 13 );
function accreditation_radio(){

	if ( is_page_template( 'templates/radio.php') ){

		echo '<section class="accreditation-radio row row--1-2"><div class="wrap3">';

			echo '<div class="dFlex dFlex--vcenter">';

				echo types_render_field( 'accreditation-logo-radio', array("size" => "thumbnail", "alt" => "Radio
	Centre Trustmark logo", "class" => "accreditation-radio__img") );

				echo types_render_field( 'accreditation-text-radio', array() ); 

			echo '</div>';
 
		echo '</div></section>'; 
	}
}

// Services Two section
add_action('genesis_entry_content', 'services_2_radio', 14 );
function services_2_radio(){

	if ( is_page_template( 'templates/radio.php') ){

		echo '<section class="services-2-radio row">';

			echo '<div class="wrap3"><h2 class="services-2-radio__title">' . types_render_field( 'services-list-title-radio', array() ) . '</h2></div>';

			echo '<div class="wrap">' . do_shortcode('[wpv-view name="services-list"]') . '</div>';
 
		echo '</section>'; 
	}
}

// Services Three section
add_action('genesis_entry_content', 'services_3_radio', 15 );
function services_3_radio(){

	if ( is_page_template( 'templates/radio.php') ){

		echo '<section class="services-3-radio row" style="background-image: url(' . types_render_field( 'content-row-2-image-radio', array("url" => "true") ) . ')"><div class="wrap">';

			echo '<div class="services-3-radio__content">';

				echo '<h2>' . types_render_field( 'content-row-2-title-radio', array() ) . '</h2>';

				echo types_render_field( 'content-row-2-text-radio', array() );

			echo '</div>';
 
		echo '</div></section>'; 
	}
}

// Get in touch section
add_action('genesis_entry_content', 'get_in_touch_radio', 16 );
function get_in_touch_radio(){

	if ( is_page_template( 'templates/radio.php') ){

		echo '<section id="get-in-touch-radio" class="get-in-touch-radio row"><div class="wrap3">';

			echo '<h2>' . types_render_field( 'get-in-touch-title-radio', array() ) . '</h2>';

			echo types_render_field( 'get-in-touch-text-radio', array() );
 
		echo '</div></section>'; 
	}
}

// ------------------------------- Footer --------------------------------------------

// Footer cta
add_action('genesis_footer', 'footer_cta', 8 );
function footer_cta(){

	echo '<div class="site-footer__cta"><p><a href="https://soundcloud.com/kaluastudios" target="_blank"><i class="fab fa-soundcloud icon"></i> Listen to our work on <span class="tdu">Soundcloud</span></a>.</p></div>';
}

// Footer social icons
add_action('genesis_footer', 'social_icon_menu_footer', 9 );
function social_icon_menu_footer(){

	echo '<div class="site-footer__social-icons">' . do_shortcode('[menu name="social-icons"]') . '</div>';

}