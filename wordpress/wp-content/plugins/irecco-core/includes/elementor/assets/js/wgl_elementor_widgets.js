(function( $ ) {
    "use strict";

    jQuery(window).on('elementor/frontend/init', function (){
        if ( window.elementorFrontend.isEditMode() ) {
            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-blog.default',
                function( $scope ){ 
                    irecco_parallax_video();
                    irecco_blog_masonry_init();
                    irecco_carousel_slick(); 
                }
            );            

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-blog-hero.default',
                function( $scope ){ 
                    irecco_parallax_video();
                	irecco_blog_masonry_init();
                	irecco_carousel_slick(); 
                }
            );            

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-carousel.default',
                function( $scope ){ 
                    irecco_carousel_slick();  
                }
            );            

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-portfolio.default',
                function( $scope ){ 
                    irecco_isotope();
                    irecco_carousel_slick();  
                    irecco_scroll_animation();
                }
            );            

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-events.default',
                function( $scope ){ 
                    irecco_isotope();
                	irecco_carousel_slick();  
                    irecco_scroll_animation();
                    irecco_events_masonry_init();
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-progress-bar.default',
                function( $scope ){ 
                    irecco_progress_bars_init();  
                }
            ); 

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-testimonials.default',
                function( $scope ){ 
                	irecco_carousel_slick();  
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-toggle-accordion.default',
                function( $scope ){ 
                    irecco_accordion_init();  
                }
            ); 

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-team.default',
                function( $scope ){ 
                    irecco_isotope();
                    irecco_carousel_slick();  
                    irecco_scroll_animation();
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-tabs.default',
                function( $scope ){ 
                    irecco_tabs_init();  
                }
            ); 

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-clients.default',
                function( $scope ){ 
                	irecco_carousel_slick();  
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-image-layers.default',
                function( $scope ){ 
                	irecco_img_layers();  
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-video-popup.default',
                function( $scope ){ 
                    irecco_videobox_init();  
                }
            );            

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-countdown.default',
                function( $scope ){ 
                	irecco_countdown_init();  
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-time-line-vertical.default',
                function( $scope ){ 
                	irecco_init_timeline_appear();  
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-striped-services.default',
                function( $scope ){ 
                	irecco_striped_services_init();  
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-image-comparison.default',
                function( $scope ){ 
                	irecco_image_comparison();  
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-counter.default',
                function( $scope ){ 
                	irecco_counter_init();  
                }
            );

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-header-menu.default',
                function( $scope ){ 
                    irecco_menu_lavalamp(); 
                    irecco_ajax_mega_menu();
                }
            );            

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-header-search.default',
                function( $scope ){ 
                    irecco_search_init(); 
                }
            );            
            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/wgl-header-side_panel.default',
                function( $scope ){ 
                    irecco_side_panel_init(); 
                }
            );

        }
    });

})( jQuery );

