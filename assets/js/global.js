document.getElementsByTagName( "body" )[0].className += " js";

function scollToElem(elem0, elem1){

	jQuery(elem0).on('click', function(event) {

		var scrollTop = jQuery(elem1).offset().top;

		/* Not needed if scroll-behavior: smooth; in css
		jQuery('body, html').animate(
	      {
	        scrollTop: scrollTop
	      },
	      '100' //speed
	    );
	    */

		jQuery('.nav-primary').removeClass('nav-primary--open');

		jQuery('.hamburger-menu').removeClass('animate');

		jQuery('#site-header__contact').show();

		jQuery('html,body').removeClass('oh');

		//event.preventDefault();

	});
}

function togglePrimNav(){

	jQuery('#hamburger-menu').on('click', function(){

		jQuery('.nav-primary').toggleClass('nav-primary--open');
		jQuery('#site-header__contact').fadeToggle();
		jQuery('.site-header').toggleClass('site-header--fixed2');
		jQuery('html,body').toggleClass('oh');

	});
}

function headerFix(){

	var scrollTop = jQuery(window).scrollTop(),
		header = jQuery('.site-header');

	if ( scrollTop > 100 ) {

		header.addClass('site-header--fixed');
		//jQuery('body').css('margin-top','60px');

	} else {

		header.removeClass('site-header--fixed');
		//jQuery('body').css('margin-top','0');
	}

	console.log( scrollTop );
}

function hamburgerAnim(){

	jQuery('.menu-wrapper').on('click', function() {
		jQuery('.hamburger-menu').toggleClass('animate');
	});

}

function showElem(){

	jQuery('.who-we-work-with__a').on('click', function(event){

		event.preventDefault();

		jQuery('.who-we-work-with__caption').removeClass('open');

		jQuery(this).closest('.who-we-work-with__fig').find('.who-we-work-with__caption').addClass('open');

	});
}

function hideElem(){

	jQuery('.who-we-work-with__close').on('click', function(event){

		event.preventDefault();

		jQuery(this).closest('.who-we-work-with__caption').removeClass('open');

	});
}

function slickSlideLogos(){

	jQuery('.client-logos__list').slick({

	  arrows: false,
	  autoplay: true,
	  autoplaySpeed: 1000,
	  infinite: true,
	  speed: 800,
	  slidesToShow: 9,
	  slidesToScroll: 1,
	  prevArrow: '<button type="button" class="slick-prev dashicons dashicons-arrow-left"></button>',
	  nextArrow: '<button type="button" class="slick-next dashicons dashicons-arrow-right"></button>',
	  responsive: [
	    {
	      breakpoint: 1025,
	      settings: {
	        slidesToShow: 6,
	  		slidesToScroll: 1,
	        infinite: true,
	        dots: false
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	      	infinite: true,
	        slidesToShow: 4,
	        slidesToScroll: 3
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	      	arrows: false,
	      	autoplay: true,
  			autoplaySpeed: 1000,
  			speed: 1000,
	      	infinite: true,
	        slidesToShow: 3,
	        slidesToScroll: 2
	      }
	    },
	    {
	      breakpoint: 380,
	      settings: {
	      	arrows: false,
	      	autoplay: true,
  			autoplaySpeed: 1000,
  			speed: 1000,
	      	infinite: true,
	        slidesToShow: 2,
	        slidesToScroll: 1
	      }
	    }
	    // You can unslick at a given breakpoint now by adding:
	    // settings: "unslick"
	    // instead of a settings object
	  ]
	});
}

function setHeight(){

	var windowH = window.innerHeight;

	if ( ( windowH > 660 ) && ( jQuery('.home').length ) ){

		headerH = jQuery('.site-header').height(),
		logoRowH = jQuery('.client-logos').height(),
		introHome = jQuery('.intro-home > .wrap'),
		height = windowH - ( headerH + logoRowH ),
		introHome2 = document.getElementById('intro-home');

		var introHomeP = document.getElementById('intro-home');
		var clientLogoRow = document.getElementById('client-logos');

		var introHomeTPF = parseFloat( window.getComputedStyle(introHomeP, null).getPropertyValue('padding-top') );
		var logoRowTPF = parseFloat( window.getComputedStyle(clientLogoRow, null).getPropertyValue('padding-top') );
		var logoRowBPF = parseFloat( window.getComputedStyle(clientLogoRow, null).getPropertyValue('padding-bottom') );

		introHome.height( windowH - ( headerH + logoRowH + logoRowTPF + logoRowBPF + (introHomeTPF * 2) ) );
	}
		
}

var onDocReady = function(){

	scollToElem('.home .menu-item--what-we-do > a', '#what-we-do');
		scollToElem('.home .menu-item--who-we-work > a', '#who-we-work-with');
		scollToElem('.home .menu-item--get-in-touch > a', '#get-in-touch');
		togglePrimNav();
		hamburgerAnim();
		showElem();
		hideElem();
		slickSlideLogos();
		setHeight();
}

jQuery( document ).ready( function() {
		
		onDocReady();
});

jQuery(window).on('scroll', function(){

	headerFix();
});
