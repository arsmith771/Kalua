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
define( 'CHILD_THEME_VERSION', '0.87' );
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
add_image_size( 'thumb-1-1', 350, 290, true ); // width, height, crop
add_image_size( 'thumb-2', 400, 300, true ); // width, height, crop
add_image_size( 'banner-mobile', 820, 820, true ); // width, height, crop
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
add_theme_support( 'genesis-accessibility', array( 'skip-links', 'search-form', 'headings' ) ); /* Accessibility */
add_theme_support( 'genesis-after-entry-widget-area' ); /* After Entry Widget Area */
add_theme_support( 'genesis-footer-widgets', 3 ); /* Add Footer Widgets Markup for 3 */

// Deactivate superfish menu feature
apply_filters( 'genesis_superfish_enabled', false );


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

//----------------------  Admin css -----------------------
add_action('admin_enqueue_scripts', 'admin_styles');
function admin_styles() {
    wp_enqueue_style('backend-admin', get_stylesheet_directory_uri() . '/admin.css');
}

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
	    
	$str = types_render_field( 'telehone-number', array("id" => "15") );  
	    
	// remove all whitespaces   
	$str = str_ireplace (' ', '', $str); 

	echo '<address class="site-header__contact" id="site-header__contact"><a href="tel:' . $str . '">' . types_render_field( 'telehone-number', array("id" => "15") ) . '</a>' . types_render_field( 'email-address', array("id" => "15") ) . '</address>';
}

// Hamburger
add_action('genesis_header', 'menu_toggle_btn', 12 );
function menu_toggle_btn(){

	echo '<button class="menu-wrapper" id="hamburger-menu"><span class="hamburger-menu"></span></button>';
}


// ------------------------------- Homepage --------------------------------------------

// Remove the entry title
add_action( 'get_header', 'remove_titles_homepage' );
function remove_titles_homepage() {

    if ( is_page_template( 'templates/homepage.php') ){

        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    }
}

// Add style tag for banner image
add_action( 'wp_head', 'banner_image_home' );
function banner_image_home() {

	 if ( is_page_template( 'templates/homepage.php') ){

	    echo '<style>.intro-home {background-image: url(' . types_render_field( 'hero-image-home', array("url" => "true", "size" => "banner-mobile") ) . ');} @media (min-width: 821px) { .intro-home {background-image: url(' . types_render_field( 'hero-image-home', array("url" => "true") ) . ');}}</style>';
	}
}


// Intro section
add_action('genesis_entry_content', 'intro_homepage', 10 );
function intro_homepage(){

	if ( is_page_template( 'templates/homepage.php') ){

		echo '<section class="intro-home row" id="intro-home"><div class="wrap">';

			echo '<h1 class="intro-home__title"><div class="intro-home__title__deco"><span>' . types_render_field( 'intro-header-1-home', array() ) . '</span><br> ' . types_render_field( 'intro-header-2-home', array() ) . '</div></h1>';

			echo '<ul class="intro-home__list"><li class="intro-home__list-item"><a href="/radio" class="cta-1">Radio</a></li><li class="intro-home__list-item"><a href="/podcasts" class="cta-1">Podcasts</a></li><li class="intro-home__list-item"><a href="/digital" class="cta-1">Digital</a></li></ul>';

		echo '</div></section>'; 
	}
}



// Client logo carousel
add_action('genesis_entry_content', 'client_carousel_homepage', 11 );
function client_carousel_homepage(){

	if ( is_page_template( 'templates/homepage.php') ){

		echo '<section class="client-logos row row--3" id="client-logos"><div class="wrap"><p class="client-logos__intro">Where you&apos;ll hear our work</p>' . do_shortcode('[wpv-view name="client-carousel"]') . '</div></section>';

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

			echo '<p class="what-we-do__listen"><a href="https://soundcloud.com/kaluastudios" class="what-we-do__listen__cta" target="_blank">Listen to our work&nbsp;&nbsp;<i class="fab fa-soundcloud icon icon--2"></i></a></p>';

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

			echo types_render_field( 'client-brands-text-home', array() );

			echo '<div class="who-we-work-with__list-container">' . do_shortcode('[wpv-view name="client-list"]') . '</div>';

			echo '<p><a href="#get-in-touch" class="cta-2">Get in touch</a></p>';

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

// Add style tag for main image
add_action( 'wp_head', 'main_image_radio' );
function main_image_radio() {

	 if ( is_page_template( 'templates/radio.php') ){

	    echo '<style>.intro-radio__content__img, .intro-radio__content__txt {background-image: url(' . types_render_field( 'intro-image-radio', array("url" => "true", "size" => "banner-mobile") ) . ');} @media (min-width: 821px) { .intro-radio__content__img {background-image: url(' . types_render_field( 'intro-image-radio', array("url" => "true") ) . ');}}</style>';
	}
}

// Intro section
add_action('genesis_entry_content', 'intro_radio', 10 );
function intro_radio(){

	if ( is_page_template( 'templates/radio.php') ){

		echo '<section class="intro-radio row row--2" >';

			echo '<div class="intro-radio__content wrap2">';

				echo '<div class="intro-radio__content__img"></div>';

				echo '<div class="intro-radio__content__txt intro-radio__content__txt--radio">' . types_render_field( 'intro-text-radio', array() ) . '</div>';

			echo '</div>';

		echo '</section>'; 
	}
}

// Client logo carousel
add_action('genesis_entry_content', 'client_carousel_radio', 11 );
function client_carousel_radio(){

	if ( is_page_template( 'templates/radio.php') ){

		echo '<section class="client-logos row row--3"><div class="wrap">' . do_shortcode('[wpv-view name="client-carousel"]') . '</div></section>';

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

				echo types_render_field( 'accreditation-logo-radio', array("alt" => "Radio
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

			echo '<div class="wrap4">' . do_shortcode('[wpv-view name="services-list"]') . '</div>';
 
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

// ------------------------------- Podcast page --------------------------------------------

// Add 
/*
add_action( 'genesis_entry_content', 'standfirst_podcast', 10 );
function standfirst_podcast() {

	 if ( is_page_template( 'templates/podcast.php') ){

	  echo '<section class="standfirst-podcast row" ><div class="wrap4">';

	  	echo  types_render_field( 'standfirst-podcast', array() );
	  
	  echo '</div></section>';
	}
}
*/

// Add style tag for main image
add_action( 'wp_head', 'main_image_podcast' );
function main_image_podcast() {

	 if ( is_page_template( 'templates/podcast.php') ){

	 	echo '<style>.intro-podcast__content__img, .intro-podcast__content__txt {background-image: url(' . types_render_field( 'main-image-podcast', array("url" => "true", "size" => "banner-mobile") ) . ');} @media (min-width: 821px) { .intro-podcast__content__img {background-image: url(' . types_render_field( 'main-image-podcast', array("url" => "true") ) . ');}}</style>';
	}
}


//
// Intro section
add_action('genesis_entry_content', 'intro_podcast', 10 );
function intro_podcast(){

	 if ( is_page_template( 'templates/podcast.php') ){

		echo '<section class="intro-podcast row row--2" >';

			echo '<div class="intro-podcast__content wrap2-0">';

				echo '<div class="intro-podcast__content__img"></div>';

				echo '<div class="intro-podcast__content__txt">' . types_render_field( 'standfirst-podcast', array() ) . '</div>';

			echo '</div>';

		echo '</section>'; 
	}
}



// Infographic section
add_action('genesis_entry_content', 'infographic_podcast', 11 );
function infographic_podcast(){

	if ( is_page_template( 'templates/podcast.php') ){

		echo '<section class="infographic-podcast row row--1-2"><div class="wrap4-1">';

			echo '<div class="infographic-podcast__content">';

				echo do_shortcode('[wpv-view name="infographs"]');

			echo '</div>';

		echo '</div></section>'; 
	}
}

// Content 1
add_action('genesis_entry_content', 'content_1_podcast', 12 );
function content_1_podcast(){

	if ( is_page_template( 'templates/podcast.php') ){

		echo '<section class="content-1-podcast row"><div class="wrap4">';

			echo '<div class="content-1-podcast__content">' . types_render_field( 'content-1-podcast', array() ) .'</div>';

		echo '</div></section>'; 
	}
}


// Services
add_action('genesis_entry_content', 'services_podcast', 13 );
function services_podcast(){

	if ( is_page_template( 'templates/podcast.php') ){

		echo '<section class="services-podcast row">';

			echo '<div class="wrap3"><h2 class="services-podcast__title">' . types_render_field('services-section-title-pod', array() ) . '</h2></div>';

			echo '<div class="wrap4"><div class="services-podcast__content">' . do_shortcode('[wpv-view name="services-list-2"]') . '</div></div>';

		echo '</section>'; 
	}
}

// Content 2
add_action('genesis_entry_content', 'content_2_podcast', 14 );
function content_2_podcast(){

	if ( is_page_template( 'templates/podcast.php') ){

		echo '<section class="content-2-podcast row row--4" style="background-image: url(' . types_render_field( 'content-row-2-background', array("url" => "true") ) . ')"><div class="wrap3">';

			echo '<div class="content-2-podcast__content">' . types_render_field( 'content-row-2-text', array() ) .'</div>';

		echo '</div></section>'; 
	}
}

// Content 3
add_action('genesis_entry_content', 'content_3_podcast', 15 );
function content_3_podcast(){

	if ( is_page_template( 'templates/podcast.php') ){

		echo '<section class="content-3-podcast row"><div class="wrap4">';

			echo '<h2 class="content-3-podcast__title">' . types_render_field( 'content-3-title-pod', array() ) . '</h2>';

			echo '<div class="content-3-podcast__content">';

				echo '<div class="content-3-podcast__images">' . types_render_field( 'content-row-3-img-pod', array() ) . '</div>';

				echo '<div class="content-3-podcast__text">' . types_render_field( 'content-row-3-text-pod', array() ) . '</div>';

			echo '</div>';

		echo '</div></section>'; 
	}
}

// Content 4
add_action('genesis_entry_content', 'content_4_podcast', 16 );
function content_4_podcast(){

	if ( is_page_template( 'templates/podcast.php') ){

		echo '<section class="content-4-podcast row"><div class="wrap4">';

			echo '<div class="content-4-podcast__content">';

				echo types_render_field( 'content-row-4-pod', array() );

			echo '</div>';

		echo '</div></section>'; 
	}
}

// ------------------------------- Digital page --------------------------------------------

// Add style tag for main image
add_action( 'wp_head', 'main_image_digital' );
function main_image_digital() {

	 if ( is_page_template( 'templates/digital.php') ){

	    echo '<style>.intro-digital__content__img, .intro-digital__content__txt {background-image: url(' . types_render_field( 'intro-image-digi', array("url" => "true", "size" => "banner-mobile") ) . ');} @media (min-width: 821px) { .intro-radio__digital__img {background-image: url(' . types_render_field( 'intro-image-digi', array("url" => "true") ) . ');}}</style>';
	}
}

// Add style tag for content row 3 image
add_action( 'wp_head', 'row_3_image_digital' );
function row_3_image_digital() {

	 if ( is_page_template( 'templates/digital.php') ){

	    echo '<style>.content-3-digi__img, .content-3-digi__img__txt {background-image: url(' . types_render_field( 'content-row-3-image-digi', array("url" => "true", "size" => "banner-mobile") ) . ');} @media (min-width: 821px) { .content-3-digi__img {background-image: url(' . types_render_field( 'content-row-3-image-digi', array("url" => "true") ) . ');}}</style>';
	}
}

// Add style tag for content row 3 image
add_action( 'wp_head', 'row_4_image_digital' );
function row_4_image_digital() {

	 if ( is_page_template( 'templates/digital.php') ){

	    echo '<style>.content-4-digi__img, .content-4-digi__img__txt {background-image: url(' . types_render_field( 'content-row-4-image-digi', array("url" => "true", "size" => "banner-mobile") ) . ');} @media (min-width: 821px) { .content-4-digi__img {background-image: url(' . types_render_field( 'content-row-4-image-digi', array("url" => "true") ) . ');}}</style>';
	}
}

// Intro section
add_action('genesis_entry_content', 'intro_digital', 10 );
function intro_digital(){

	if ( is_page_template( 'templates/digital.php') ){

		echo '<section class="intro-digital row row--2" >';

			echo '<div class="intro-digital__content wrap2-0">';

				echo '<div class="intro-digital__content__img"></div>';

				echo '<div class="intro-digital__content__txt">' . types_render_field( 'intro-text-digi', array() ) . '</div>';

			echo '</div>';

		echo '</section>'; 
	}
}

// Content row 1
add_action('genesis_entry_content', 'content_1_digital', 11 );
function content_1_digital(){

	if ( is_page_template( 'templates/digital.php') ){
		
		echo '<section class="content-1-digi row"><div class="wrap4">';

			echo '<h2 class="content-1-digi__title">' . types_render_field( 'content-row-1-title-digi', array() ) . '</h2>';

			echo '<div class="content-1-digi__content">';

				echo '<div class="content-1-digi__content__img">';

					echo types_render_field( 'content-row-1-image-digi', array() );
					
				echo '</div>';

				echo '<div class="content-1-digi__content__text">';

					echo types_render_field( 'content-row-1-text-digi', array() );

				echo '</div>';

			echo '</div>';

		echo '</div></section>'; 
	}
}

// Content row 2
add_action('genesis_entry_content', 'content_2_digital', 12 );
function content_2_digital(){

	if ( is_page_template( 'templates/digital.php') ){
		
		echo '<section class="content-2-digi row"><div class="wrap4">';

			echo '<h2 class="content-2-digi__title">' . types_render_field( 'content-row-2-title-digi', array() ) . '</h2>';

			echo '<div class="content-2-digi__content">';

				echo '<div class="content-2-digi__content__text">';

					echo types_render_field( 'content-row-2-text-digi', array() );

				echo '</div>';
				

				echo '<div class="content-2-digi__content__img">';

					echo types_render_field( 'content-row-2-image-digi', array() );
					
				echo '</div>';

			echo '</div>';

		echo '</div></section>'; 
	}
}

// Content row 3
add_action('genesis_entry_content', 'content_3_digital', 13 );
function content_3_digital(){

	if ( is_page_template( 'templates/digital.php') ){
		
		echo '<section class="content-3-digi row row--2">';

			echo '<div class="content-3-digi__content wrap2-1">';

				echo '<div class="content-3-digi__img"></div>';

				echo '<div class="content-3-digi__txt">';

					echo '<h2 class="content-3-digi__title">' . types_render_field( 'content-row-3-title-digi', array() ) . '</h2>';

					echo types_render_field( 'content-row-3-text-digi', array() );

				echo '</div>';

			echo '</div>';

		echo '</section>';
	}

}

// Content row 4
add_action('genesis_entry_content', 'content_4_digital', 14 );
function content_4_digital(){

	if ( is_page_template( 'templates/digital.php') ){
		
		echo '<section class="content-4-digi row row--2">';

			echo '<div class="content-4-digi__content wrap2">';

				echo '<div class="content-4-digi__txt">';

					echo '<h2 class="content-4-digi__title">' . types_render_field( 'content-row-4-title-digi', array() ) . '</h2>';

					echo types_render_field( 'content-row-4-text-digi', array() );

				echo '</div>';

				echo '<div class="content-4-digi__img"></div>';

			echo '</div>';

		echo '</section>';
	}

}

// Get in touch section
add_action('genesis_entry_content', 'get_in_touch_digital', 15 );
function get_in_touch_digital(){

	if ( is_page_template( 'templates/digital.php') ){

		echo '<section class="get-in-touch-digi row"><div class="wrap3">';

			echo '<h2>' . types_render_field( 'get-in-touch-title-digi', array() ) . '</h2>';

			echo types_render_field( 'get-in-touch-text-digi', array() );
 
		echo '</div></section>'; 
	}
}


// ------------------------------- About page --------------------------------------------

// Main intro
add_action( 'genesis_entry_content', 'intro_about', 10 );
function intro_about() {

	 if ( is_page_template( 'templates/about.php') ){

	  echo '<section class="intro-about row" style="background-image:url(' . types_render_field( 'about-intro-image', array("url" => "true") ) . ');"><div class="wrap2">';

	  	echo '<div class="intro-about__content"><div class="intro-about__txt">' . types_render_field( 'intro-text-about', array() ) . '</div></div>';
	  
	  echo '</div></section>';
	}
}

// Content row 1
add_action( 'genesis_entry_content', 'content_1_about', 11 );
function content_1_about() {

	 if ( is_page_template( 'templates/about.php') ){

	  echo '<section class="content-1-about row"><div class="wrap3">';

	  	echo '<div class="content-1-about__content">' . types_render_field( 'content-row-1-about', array() ) . '</div>';
	  
	  echo '</div></section>';
	}
}


// Content row 2
add_action( 'genesis_entry_content', 'content_2_about', 12 );
function content_2_about() {

	 if ( is_page_template( 'templates/about.php') ){

	  echo '<section class="content-2-about row"><div class="wrap3">';

	  	echo '<div class="content-2-about__content">';

	  		echo '<div class="content-2-about__col-1">' . types_render_field( 'content-row-2-col-1-about', array() ) . '</div>';

	  		echo '<div class="content-2-about__col-2">' . types_render_field( 'content-row-2-col-2-about', array() ) . '</div>';
	  
	  	echo '</div>';

	  echo '</div></section>';
	}
}

// Content row 3
add_action('genesis_entry_content', 'content_3_about', 13 );
function content_3_about(){

	if ( is_page_template( 'templates/about.php') ){

		echo '<section class="content-3-about row row--4" style="background-image: url(' . types_render_field( 'content-row-3-about-bg', array("url" => "true") ) . ')"><div class="wrap3">';

			echo '<div class="content-3-about__content">' . types_render_field( 'content-row-3-about-text', array() ) .'</div>';

		echo '</div></section>'; 
	}
}

// Get in touch section
add_action('genesis_entry_content', 'get_in_touch_about', 14 );
function get_in_touch_about(){

	if ( is_page_template( 'templates/about.php') ){

		echo '<section class="get-in-touch-home row"><div class="wrap3">';

			echo '<h2>' . types_render_field( 'get-in-touch-title-home', array("id" => "15") ) .  '</h2>';

			echo types_render_field( 'get-in-touch-text2-home', array("id" => "15") );  

			echo do_shortcode('[wpv-view name="get-in-touch-blocks"]');


		echo '</div></section>'; 
	}
}

// ------------------------------- Footer --------------------------------------------

// Footer cta
add_action('genesis_footer', 'footer_cta', 9 );
function footer_cta(){

	echo '<div class="site-footer__cta"><p><a href="https://soundcloud.com/kaluastudios" target="_blank">Listen to our work <i class="fas fa-chevron-right"></i> <i class="fab fa-soundcloud icon"></i></a></p></div>';
}

// Footer social icons
add_action('genesis_footer', 'social_icon_menu_footer', 11 );
function social_icon_menu_footer(){

	echo '<div class="site-footer__social-icons">' . do_shortcode('[menu name="social-icons"]') . '</div>';

}