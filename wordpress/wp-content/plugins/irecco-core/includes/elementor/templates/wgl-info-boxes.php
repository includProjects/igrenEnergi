<?php
namespace WglAddons\Templates;

defined( 'ABSPATH' ) || exit; // Abort, if called directly.

use Elementor\Plugin;
use Elementor\Frontend;
use WglAddons\Includes\Wgl_Loop_Settings;
use WglAddons\Includes\Wgl_Elementor_Helper;
use WglAddons\Includes\Wgl_Carousel_Settings;
use WglAddons\Includes\Wgl_Icons;


/**
* WGL Elementor Info Box Template
*
*
* @class        WglInfoBoxes
* @version      1.0
* @category     Class
* @author       WebGeniusLab
*/

class WglInfoBoxes
{

    private static $instance = null;
    public static function get_instance( ) {
        if ( null == self::$instance ) {
            self::$instance = new self( );
        }

        return self::$instance;
    }

    public function render($self, $atts)
    {
        extract($atts);
        
        $theme_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-primary-color'));
        $theme_color_secondary = esc_attr(\iRecco_Theme_Helper::get_option('theme-secondary-color'));
        $header_font_color = esc_attr(\iRecco_Theme_Helper::get_option('header-font')['color']);
        $main_font_color = esc_attr(\iRecco_Theme_Helper::get_option('main-font')['color']);

        $infobox_inner = $infobox_icon = $infobox_title = $infobox_content = $infobox_button = $item_link_html = '';

        // Info box wrapper classes
        $infobox_helper_classes  = $icon_type === 'font' ?  ' elementor-icon-box-wrapper' : '';
        $infobox_helper_classes .= $icon_type === 'image' ? ' elementor-image-box-wrapper' : '';
         
        // HTML tags allowed for rendering
        $allowed_html = [
            'a' => [
                'href' => true, 'title' => true,
                'class' => true, 'style' => true
            ],
            'br' => [ 'class' => true, 'style' => true ],
            'em' => [ 'class' => true, 'style' => true ],
            'strong' => [ 'class' => true, 'style' => true ],
            'span' => [ 'class' => true, 'style' => true ],
            'p' => [ 'class' => true, 'style' => true ]
        ];

        // Title output
        $infobox_title .='<div class="wgl-infobox-title_wrapper">';
        $infobox_title .= !empty($ib_subtitle) ? '<div class="wgl-infobox_subtitle">'.wp_kses( $ib_subtitle, $allowed_html ).'</div>' : '';
        $infobox_title .= !empty($ib_title) ? '<'.esc_attr($title_tag).' class="wgl-infobox_title">'.wp_kses( $ib_title, $allowed_html ).'</'.esc_attr($title_tag).'>' : '';
        $infobox_title .= '</div>';

        // Content output
        $infobox_content .= !empty($ib_content) ? '<'.esc_attr($content_tag).' class="wgl-infobox_content">'.wp_kses($ib_content, $allowed_html).'</'.esc_attr($content_tag).'>' : '';

        // Icon/Image output
        if (!empty($icon_type)) {
            $atts['wrapper_class'] = 'wgl-infobox-icon_wrapper';
            $atts['container_class'] = 'wgl-infobox-icon_container';
            
            $icons = new Wgl_Icons;
            $infobox_icon .= $icons->build($self, $atts, []);
        }

        if ( !empty($add_read_more) ) {

            // Read more button  
            if ((bool)$read_more_icon_sticky) {
                $self->add_render_attribute('link', 'class', [
                    'corner-attached',
                    'corner-position_'.esc_attr($read_more_icon_sticky_pos)
                ]);
            }

            $self->add_render_attribute('link', 'class', [
                'wgl-infobox_button',
                'button-read-more',
                'read-more-icon',
                'icon-position-'.esc_attr($read_more_icon_align)
            ]);

            if (!empty($link['url'])) {
                $self->add_link_attributes('link', $link);
            }

            switch ($icon_read_more_pack) {
                case 'fontawesome':
                    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
                    $icon_font = $read_more_icon_fontawesome;
                    break;
                case 'flaticon':
                    wp_enqueue_style('flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
                    $icon_font = $read_more_icon_flaticon;
                    break;
            }

            $infobox_button .= '<div class="wgl-infobox-button_wrapper">';
            $infobox_button .= '<a ' . $self->get_render_attribute_string('link') . '>'; 
            if($read_more_icon_align === 'left'){
                $infobox_button .= !empty($icon_font) ? '<i class="'.esc_attr($icon_font).'"></i>' : '';
            }
            $infobox_button .= esc_html($read_more_text);
            if($read_more_icon_align === 'right'){
                $infobox_button .= !empty($icon_font) ? '<i class="'.esc_attr($icon_font).'"></i>' : '';
            }
            $infobox_button .= '</a>';
            $infobox_button .= '</div>';
        }

        if ($add_item_link) {
            if (!empty($item_link['url'])) {
                $self->add_link_attributes('item_link', $item_link);
            }

            $item_link_html = '<a class="wgl-infobox_item_link" ' . $self->get_render_attribute_string('item_link') . '></a>';
        }

        $content_class = '';
        $content_class .= $icon_type === 'font' ? ' elementor-icon-box-content' : '';
        $content_class .= $icon_type === 'image' ? ' elementor-image-box-content' : '';

        $infobox_inner .= $infobox_icon;
        $infobox_inner .= '<div class="wgl-infobox-content_wrapper'.esc_attr($content_class).'">';
        $infobox_inner .= $infobox_title;
        $infobox_inner .= $infobox_content;
        $infobox_inner .= $infobox_button;
        $infobox_inner .= '</div>';
        

        // Render html
        $output = '<div class="wgl-infobox">';
            $output .= '<div class="wgl-infobox_wrapper'.esc_attr($infobox_helper_classes).'">';
                $output .= $infobox_inner;
                $output .= $item_link_html;
            $output .= '</div>';
        $output .= '</div>';

        echo \iRecco_Theme_Helper::render_html($output);        
    }

}