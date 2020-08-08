<?php

defined( 'ABSPATH' ) || exit;

if (!class_exists('iRecco_header_mobile')) {

    class iRecco_header_mobile extends iRecco_get_header
    {
        public function __construct()
        {
            $this->header_vars();
            $this->html_render = 'mobile';

            $header_mobile_background = iRecco_Theme_Helper::get_option('mobile_background');
            $header_mobile_color = iRecco_Theme_Helper::get_option('mobile_color');
            $mobile_header_custom =  iRecco_Theme_Helper::get_option('mobile_header');
            $mobile_sticky = iRecco_Theme_Helper::get_option('mobile_sticky');

            $mobile_styles = !empty($header_mobile_background['rgba']) ? 'background-color: '.(esc_attr($header_mobile_background['rgba'])).';' : '';
            $mobile_styles .= !empty($header_mobile_color) ? 'color: '.(esc_attr($header_mobile_color)).';' : '';
            $mobile_styles = !empty($mobile_styles) ? ' style="'.$mobile_styles.'"' : '';

            echo "<div class='wgl-mobile-header", ($mobile_sticky === '1' ? ' wgl-sticky-element' : ''), "'", 
                $mobile_styles,
                ($mobile_sticky === '1' ? ' data-style="standard"' : ''),
            ">";
            echo "<div class='container-wrapper'>";
            if (!empty($mobile_header_custom)) {
                $this->build_header_layout('mobile');
            } else {
                $this->default_header_mobile();
            }
            $this->build_header_mobile_menu();
            echo '</div>';
            echo '</div>';
        }

        public function default_header_mobile()
        {
            $mobile_height = iRecco_Theme_Helper::get_option('header_mobile_height');
            $mobile_height_style = '';

            if (isset($mobile_height['height'])) {
                $mobile_height_style .= 'height:'.(esc_attr((int)$mobile_height['height'])).'px;';
            }
            $mobile_height_style = !empty($mobile_height_style) ? ' style="'.$mobile_height_style.'"' : '';

            echo "<div class='wgl-header-row'>";
            echo "<div class='fullwidth-wrapper'>";
            echo "<div class='wgl-header-row_wrapper'", $mobile_height_style, ">";

                echo "<div class='header_side display_grow v_align_middle h_align_left'>";
                echo "<div class='header_area_container'>";
                if (has_nav_menu( 'main_menu' )) {
                    echo "<nav class='primary-nav'>";
                    if (function_exists('irecco_main_menu')) {
                        $menu = '';
                        if (class_exists( 'RWMB_Loader' )
                            && $this->id !== 0
                            && rwmb_meta('mb_customize_header_layout') == 'custom'
                        ) {
                            $menu = rwmb_meta('mb_menu_header');
                        }
                        irecco_main_menu ($menu);
                    }
                    echo '</nav>';

                    echo '<div class="mobile-hamburger-toggle">',
                        '<div class="hamburger-box"><div class="hamburger-inner"></div></div>',
                    '</div>';
                }
                echo '</div>';
                echo '</div>';

                echo "<div class='header_side display_grow v_align_middle h_align_center'>";
                echo "<div class='header_area_container'>";
                    parent::get_logo('mobile');
                echo '</div>';
                echo '</div>';

                echo "<div class='header_side display_grow v_align_middle h_align_right'>",
                    "<div class='header_area_container'>",
                    iRecco_Theme_Helper::render_html($this->search('mobile', '', 'mobile')),
                    '</div>';
                '</div>';

            echo '</div>'; // wgl-header-row_wrapper
            echo '</div>'; // fullwidth-wrapper
            echo '</div>'; // wgl-header-row
        }
    }

    new iRecco_header_mobile();
}
