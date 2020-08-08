<?php

namespace WglAddons\Widgets;

use WglAddons\Includes\Wgl_Icons;
use WglAddons\Includes\Wgl_Carousel_Settings;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;


defined( 'ABSPATH' ) || exit; // Abort, if called directly.

class Wgl_Accordion_Services extends Widget_Base {
    
    public function get_name() {
        return 'wgl-accordion-services';
    }

    public function get_title() {
        return esc_html__('WGL Accordion Services', 'irecco-core');
    }

    public function get_icon() {
        return 'wgl-accordion-services';
    }

    public function get_categories() {
        return [ 'wgl-extensions' ];
    }

    protected function _register_controls() {
        $theme_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-primary-color'));
        $second_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-secondary-color'));
        $third_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-third-color'));
        $header_font_color = esc_attr(\iRecco_Theme_Helper::get_option('header-font')['color']);
        $main_font_color = esc_attr(\iRecco_Theme_Helper::get_option('main-font')['color']);
 

        /*-----------------------------------------------------------------------------------*/
        /*  Content
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section('wgl_ib_content',
            [
                'label' => esc_html__('General', 'irecco-core'),
            ]
        );

        $this->add_control(
            'item_col',
            [
                'label' => esc_html__('Columns in Row', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '2' => esc_html__('2', 'irecco-core'),
                    '3' => esc_html__('3', 'irecco-core'),
                    '4' => esc_html__('4', 'irecco-core'),
                ],
                'default' => '4',
                'prefix_class' => 'item_col-'
            ]
        ); 

        $this->add_responsive_control(
            'interval',
            [
                'label' => esc_html__('Services Min Height', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 1000,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
					'size' => 360,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 360,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 360,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .wgl-services_item' => 'min-height: {{SIZE}}{{UNIT}};',
				],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'bg_color',
            [
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#323232',
                'condition' => [
                    'thumbnail[url]' => '',
                ],
            ]
        );

        $repeater->add_control(
            'thumbnail',
            [
                'label' => esc_html__('Thumbnail', 'irecco-core'),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'bg_position',
            [
                'label' => esc_html__('Position', 'Background Control', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'responsive' => true,
                'options' => [
                    'top left' => esc_html__('Top Left', 'Background Control', 'irecco-core'),
                    'top center' => esc_html__('Top Center', 'Background Control', 'irecco-core'),
                    'top right' => esc_html__('Top Right', 'Background Control', 'irecco-core'),
                    'center left' => esc_html__('Center Left', 'Background Control', 'irecco-core'),
                    'center center' => esc_html__('Center Center', 'Background Control', 'irecco-core'),
                    'center right' => esc_html__('Center Right', 'Background Control', 'irecco-core'),
                    'bottom left' => esc_html__('Bottom Left', 'Background Control', 'irecco-core'),
                    'bottom center' => esc_html__('Bottom Center', 'Background Control', 'irecco-core'),
                    'bottom right' => esc_html__('Bottom Right', 'Background Control', 'irecco-core'),

                ],
                'condition' => [
                    'thumbnail[url]!' => '',
                ],
            ]
        );

        $repeater->add_control(
            'bg_size',
            [
                'label' => esc_html__('Size', 'Background Control', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'responsive' => true,
                'default' => 'cover',
                'options' => [
                    'auto' => esc_html__('Auto', 'Background Control', 'irecco-core'),
                    'cover' => esc_html__('Cover', 'Background Control', 'irecco-core'),
                    'contain' => esc_html__('Contain', 'Background Control', 'irecco-core'),
                ],
                'condition' => [
                    'thumbnail[url]!' => '',
                ],
            ]
        );

        $repeater->add_control(
            'service_icon_type',
            [
                'label' => esc_html__('Add Icon/Image', 'irecco-core'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    '' => [
                        'title' => esc_html__('None', 'irecco-core'), 
                        'icon' => 'fa fa-ban',
                    ],
                    'font' => [
                        'title' => esc_html__('Icon', 'irecco-core'),
                        'icon' => 'fa fa-smile-o',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'irecco-core'),
                        'icon' => 'fa fa-picture-o',
                    ]
                ],
                'default' => '',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'service_icon_pack',
            [
                'label' => esc_html__('Icon Pack', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fontawesome' => esc_html__('Fontawesome', 'irecco-core'), 
                    'flaticon' => esc_html__('Flaticon', 'irecco-core'),
                ],
                'default' => 'fontawesome',
                'condition' => [
                    'service_icon_type' => 'font',
                ]
            ]
        );

        $repeater->add_control(
            'service_icon_flaticon',
            [
                'label' => esc_html__('Icon', 'irecco-core'),
                'type' => 'wgl-icon',
                'label_block' => true,
                'condition' => [
                    'service_icon_pack' => 'flaticon',
                    'service_icon_type' => 'font',
                ],
                'description' => esc_html__('Select icon from Flaticon library.', 'irecco-core'),
            ]
        );

        $repeater->add_control(
            'service_icon_fontawesome',
            [
                'label' => esc_html__('Icon', 'irecco-core'),
                'type' => Controls_Manager::ICON,
                'label_block' => true,
                'condition' => [
                    'service_icon_pack' => 'fontawesome',
                    'service_icon_type' => 'font',
                ],
                'description' => esc_html__('Select icon from Fontawesome library.', 'irecco-core'),
            ]
        );

        $repeater->add_control(
            'service_icon_thumbnail',
            [
                'label' => esc_html__('Image', 'irecco-core'),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'condition' => [
                    'service_icon_type' => 'image',
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'service_title',
            [
                'label' => esc_html__('Service Title', 'irecco-core'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'service_text',
            [
                'label' => esc_html__('Service Text', 'irecco-core'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'service_link',
            [
                'label' => esc_html__('Add Link', 'irecco-core'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Service', 'irecco-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{service_title}}',
                'default' => [
                    [ 'service_title' => esc_html__('Title 1', 'irecco-core')],
                    [ 'service_title' => esc_html__('Title 2', 'irecco-core')],
                    [ 'service_title' => esc_html__('Title 3', 'irecco-core')],
                ],
            ]
        );

        $this->add_control(
            'deprecated_notice',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Note: the items amount should be equal to columns amount, to ensure proper render', 'irecco-core'),
            ]
        );

        /*End General Settings Section*/
        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section
        /*-----------------------------------------------------------------------------------*/

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section(Headings Section)
        /*-----------------------------------------------------------------------------------*/    

        $this->start_controls_section(
            'section_style_item',
            [
                'label' => esc_html__('Item', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'item_space',
            [
                'label' => esc_html__('Padding', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .wgl-services_media-wrap:before' => 'bottom: {{BOTTOM}}{{UNIT}}; right: {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section(Headings Section)
        /*-----------------------------------------------------------------------------------*/    
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__('Title', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title Tag', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
                'description' => esc_html__('Choose your tag for service title', 'irecco-core'),
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'DIV',
                    'span' => 'SPAN',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_offset',
            [
                'label' => esc_html__('Title Offset', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'custom_fonts_title',
                'selector' => '{{WRAPPER}} .wgl-services_title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $header_font_color,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section(Content Section)
        /*-----------------------------------------------------------------------------------*/   

        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__('Content', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_tag',
            [
                'label' => esc_html__('Content Tag', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'div',
                'description' => esc_html__('Choose your tag for service content', 'irecco-core'),
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'DIV',
                    'span' => 'SPAN',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_offset',
            [
                'label' => esc_html__('Content Offset', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'custom_fonts_content',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .wgl-services_text',
            ]
        ); 

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($main_font_color),
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        
        /*-----------------------------------------------------------------------------------*/
        /*  Style Icon
        /*-----------------------------------------------------------------------------------*/ 

        $this->start_controls_section(
            'icon_style_section',
            [
                'label' => esc_html__('Icon', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_offset',
            [
                'label' => esc_html__('Icon Offset', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $header_font_color,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_icon-wrap:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
					'size' => 30,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 30,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .wgl-services_icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
            ]
        );

        $this->add_responsive_control(
            'icon_bg_h',
            [
                'label' => esc_html__('Icon Background Height', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
					'size' => 90,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 90,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 70,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .wgl-services_icon-wrap' => 'height: {{SIZE}}{{UNIT}};',
				],
            ]
        );

        $this->add_responsive_control(
            'icon_bg_w',
            [
                'label' => esc_html__('Icon Background Width', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
					'size' => 96,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 96,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 76,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .wgl-services_icon-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
            ]
        );

        $this->end_controls_section();
        
        /*-----------------------------------------------------------------------------------*/
        /*  Style Links
        /*-----------------------------------------------------------------------------------*/ 

        $this->start_controls_section(
            'button_style_section',
            [
                'label' => esc_html__('Link', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__('Link Margin', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'button_color_tab' );

        $this->start_controls_tab(
            'custom_button_color_media',
            [
                'label' => esc_html__('Inside Media' , 'irecco-core'),
            ]
        ); 

        $this->add_control(
            'button_color_media',
            [
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_media-wrap:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_media',
            [
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_media-wrap:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color_media',
            [
                'label' => esc_html__('Border Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_media-wrap:before' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_button_color_idle',
            [
                'label' => esc_html__('Idle' , 'irecco-core'),
            ]
        ); 

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $main_font_color,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_link' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__('Border Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $main_font_color,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_link' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_button_color_hover',
            [
                'label' => esc_html__('Hover' , 'irecco-core'),
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $theme_color,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_link:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label' => esc_html__('Border Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $theme_color,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_link:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        ); 

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section(); 

    }

    public function render() {
        
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'services', [
			'class' => [
                'wgl-accordion-services',
            ],
        ] );

        // HTML tags allowed for rendering
        $allowed_html = [
            'a' => [
                'href' => true,
                'title' => true,
            ],
            'br' => [],
            'em' => [],
            'strong' => [],
            'span' => [
                'class' => true,
                'style' => true,
            ],
            'p' => [
                'class' => true,
                'style' => true,
            ]
        ];

        // Icon/Image output
        ob_start();
        if (!empty($settings[ 'icon_type' ])) {
            $icons = new Wgl_Icons;
            echo $icons->build($this, $settings, []);
        }
        $services_media = ob_get_clean();

        ?>

        <div <?php echo $this->get_render_attribute_string( 'services' ); ?>><?php
            foreach ($settings[ 'items' ] as $index => $item) {

                if (!empty($item['service_link']['url'])) {
                    $service_link = $this->get_repeater_setting_key('service_link', 'items' , $index); 
                    $this->add_render_attribute($service_link, 'class', 'wgl-services_link');
                    $this->add_link_attributes($service_link, $item['service_link']);
                }

                $item_media = $this->get_repeater_setting_key( 'item_media', 'items' , $index ); 
                $this->add_render_attribute( $item_media, [
                    'class' => [
                        'wgl-services_media-wrap',
                        (!empty($item['thumbnail']['url']) ? '' : 'no-image' ),
                    ],
                    'style' => [
                        (!empty($item['thumbnail']['url']) ? 'background-image: url('.esc_url($item['thumbnail']['url']).');' : '' ),
                        ($item[ 'bg_position' ] != '' ? 'background-position: '.esc_attr($item[ 'bg_position' ]).';' : '' ),
                        ($item[ 'bg_size' ] != '' ? 'background-size: '.esc_attr($item[ 'bg_size' ]).';' : '' ),
                        ($item[ 'bg_color' ] != '' ? 'background-color: '.esc_attr($item[ 'bg_color' ]).';' : '' ),
                    ]
                ] );

                ?>
                <div class="wgl-services_item">
                    <div <?php echo $this->get_render_attribute_string( $item_media ); ?>></div>
                    <div class="wgl-services_content-wrap"><?php
                    // Icon/Image service
                    if($item[ 'service_icon_type' ] != '') {?>
                        <div class="wgl-services_icon-wrap"><?php
                        if ($item[ 'service_icon_type' ] == 'font' && (!empty($item[ 'service_icon_flaticon' ]) || !empty($item[ 'service_icon_fontawesome' ]))) {
                            switch ($item[ 'service_icon_pack' ]) {
                                case 'fontawesome':
                                    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
                                    $icon_font = $item[ 'service_icon_fontawesome' ];
                                    break;
                                case 'flaticon':
                                    wp_enqueue_style('flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
                                    $icon_font = $item[ 'service_icon_flaticon' ];
                                    break;
                            }
                            ?>
                            <span class="wgl-services_icon">
                                <i class="icon <?php echo esc_attr($icon_font) ?>"></i>
                            </span>
                            <?php
                        }
                        if ($item[ 'service_icon_type' ] == 'image' && !empty($item[ 'service_icon_thumbnail' ])) {
                            if (!empty($item['service_icon_thumbnail']['url'])) {
                                $this->add_render_attribute( 'thumbnail', 'src', $item['service_icon_thumbnail']['url'] );
                                $this->add_render_attribute( 'thumbnail', 'alt', Control_Media::get_image_alt( $item[ 'service_icon_thumbnail' ] ) );
                                $this->add_render_attribute( 'thumbnail', 'title', Control_Media::get_image_title( $item[ 'service_icon_thumbnail' ] ) );
                                ?>
                                <span class="wgl-services_icon wgl-services_icon-image">
                                <?php
                                    echo Group_Control_Image_Size::get_attachment_image_html( $item, 'thumbnail', 'service_icon_thumbnail' );
                                ?>
                                </span>
                                <?php
                            }
                        }?>
                        </div><?php
                    }
                    // End Icon/Image service
                    if (!empty($item[ 'service_title' ])) { ?>
                        <<?php echo $settings[ 'title_tag' ]; ?> class="wgl-services_title"><?php echo wp_kses( $item[ 'service_title' ], $allowed_html );?></<?php echo $settings[ 'title_tag' ]; ?>><?php
                    }
                    if (!empty($item[ 'service_text' ])) { ?>
                        <<?php echo $settings[ 'content_tag' ]; ?> class="wgl-services_text"><?php echo wp_kses( $item[ 'service_text' ], $allowed_html );?></<?php echo $settings[ 'content_tag' ]; ?>><?php
                    }
                    if (!empty($item['service_link']['url'])) {
                        echo '<a ', $this->get_render_attribute_string($service_link), '></a>';
                    }
                    ?>
                    </div>
                </div><?php
                if ($index + 1 == $settings['item_col']) break;
            }?>
        </div>

        <?php

    }
    
}