"use strict";

is_visible_init();
irecco_slick_navigation_init();

jQuery(document).ready(function($) {
	irecco_split_slider();
	irecco_sticky_init();
	irecco_search_init();
	irecco_side_panel_init();
	irecco_mobile_header();
	irecco_woocommerce_helper();
	irecco_woocommerce_login_in();
	irecco_init_timeline_appear();
	irecco_accordion_init();
	irecco_services_accordion_init();
	irecco_striped_services_init();
	irecco_progress_bars_init();
	irecco_carousel_slick();
	irecco_image_comparison();
	irecco_counter_init();
	irecco_countdown_init ();
	irecco_circuit_services();
	irecco_circuit_services_resize();
	irecco_img_layers();
	irecco_page_title_parallax();
	irecco_extended_parallax();
	irecco_portfolio_parallax();
	irecco_message_anim_init();
	irecco_scroll_up();
	irecco_link_scroll();
	irecco_skrollr_init();
	irecco_sticky_sidebar();
	irecco_videobox_init();
	irecco_parallax_video();
	irecco_tabs_init();
	irecco_select_wrap();
	jQuery( '.wgl_module_title .carousel_arrows' ).irecco_slick_navigation();
	jQuery( '.wgl-filter_wrapper .carousel_arrows' ).irecco_slick_navigation();
	jQuery( '.wgl-products > .carousel_arrows' ).irecco_slick_navigation();
	jQuery( '.irecco_module_custom_image_cats > .carousel_arrows' ).irecco_slick_navigation();
	irecco_scroll_animation();
	irecco_woocommerce_mini_cart();
	irecco_text_background();
	irecco_dynamic_styles();
	irecco_ajax_mega_menu();
});

jQuery(window).load(function() {
	irecco_isotope();
	irecco_blog_masonry_init();
	setTimeout(function(){
		jQuery('#preloader-wrapper').fadeOut();
	},1100);
	particles_custom();

	irecco_menu_lavalamp();
	jQuery(".wgl-currency-stripe_scrolling").each(function(){
		jQuery(this).simplemarquee({
			speed: 40,
			space: 0,
			handleHover: true,
			handleResize: true
		});
	})
});
