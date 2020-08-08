<?php
namespace WglAddons\Widgets;

use WglAddons\Includes\Wgl_Icons;
use WglAddons\Includes\Wgl_Carousel_Settings;
use WglAddons\Includes\Wgl_Elementor_Helper;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;


defined( 'ABSPATH' ) || exit; // Abort, if called directly.

class Wgl_Services_5 extends Widget_Base {
    
    public function get_name() {
        return 'wgl-services-5';
    }

    public function get_title() {
        return esc_html__('WGL Services 5', 'irecco-core');
    }

    public function get_icon() {
        return 'wgl-services-5';
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
        /*  Build Icon/Image Box
        /*-----------------------------------------------------------------------------------*/

        Wgl_Icons::init( $this, array( 'label' => esc_html__('Services 5 ', 'irecco-core'), 'output' => '','section' => true, 'prefix' => '' ) );
        
        /*-----------------------------------------------------------------------------------*/
        /*  Content
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section('wgl_ib_content',
            array(
                'label' => esc_html__('Service Content', 'irecco-core'),
            )
        );

        $this->add_control(
            'ib_number',
            array(
                'label' => esc_html__('Service Number', 'irecco-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('01', 'irecco-core'),
            )
        );

        $this->add_control(
            'ib_title',
            array(
                'label' => esc_html__('Title', 'irecco-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('This is the heading​', 'irecco-core'),
            )
        );

        $this->add_control(
            'ib_content',
            array(
                'label' => esc_html__('Service Text', 'irecco-core'),
                'type' => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__('Description Text', 'irecco-core'),
				'label_block' => true,
                'default' => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'irecco-core'),
            )
        );

        $this->add_control(
            'alignment',
            array(
                'label' => esc_html__('Alignment', 'irecco-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'irecco-core'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'irecco-core'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'irecco-core'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'prefix_class' => 'wgl-services-5_',
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_wrap' => 'text-align: {{VALUE}};',
                ],
            )
        );

        /*End General Settings Section*/
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_link',
            [
                'label' => esc_html__('Service Link', 'irecco-core'),
            ]
        );

        $this->add_control(
            'add_item_link',
            array(
                'label' => esc_html__('Add Link To Whole Item', 'irecco-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'irecco-core'),
                'label_off' => esc_html__('Off', 'irecco-core'),
                'return_value' => 'yes',
                'condition' => [ 'add_read_more!' => 'yes' ],  

            )
        );

        $this->add_control(
            'item_link',
            array(
                'label' => esc_html__('Link', 'irecco-core'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'condition' => [ 'add_item_link' => 'yes' ],
            )
        );

        $this->add_control(
            'add_read_more',
            array(
                'label' => esc_html__('Add \'Read More\' Button', 'irecco-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'irecco-core'),
                'label_off' => esc_html__('Off', 'irecco-core'),
                'return_value' => 'yes',
                'condition' => [ 'add_item_link!' => 'yes' ], 
            )
        ); 

        $this->add_control(
            'read_more_text',
            array(
                'label' => esc_html__('Button Text', 'irecco-core'),
                'type' => Controls_Manager::TEXT,
                'default' =>  esc_html__('Read More', 'irecco-core'),
				'label_block' => true,
                'condition' => [ 'add_read_more' => 'yes' ],
            )
        );

        $this->add_control(
            'link',
            array(
                'label' => esc_html__('Button Link', 'irecco-core'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'condition' => [ 'add_read_more' => 'yes' ],
            )
        );

        $this->end_controls_section(); 

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section
        /*-----------------------------------------------------------------------------------*/

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section(Headings Section)
        /*-----------------------------------------------------------------------------------*/    

        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => esc_html__('Media', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 
            'icon_colors',
            [
                'condition' => [
                    'icon_type'  => 'font',
                ],
            ]
        );

        $this->start_controls_tab(
            'icon_colors_idle',
            [ 'label' => esc_html__('Idle', 'irecco-core') ]
        );

        $this->add_control(
            'primary_color',
            [
                'label' => esc_html__('Primary Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wgl-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_primary_color',
            [
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f6f0ec',
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_media-wrap' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_colors_hover',
            [
                'label' => esc_html__('Hover', 'irecco-core'),
            ]
        );

        $this->add_control(
            'hover_primary_color',
            [
                'label' => esc_html__('Primary Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}}:hover .wgl-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_hover_primary_color',
            [
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f6f0ec',
                'selectors' => [
                    '{{WRAPPER}}:hover .wgl-services_media-wrap' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'icon_space',
            array(
                'label' => esc_html__('Margin', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_media-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_responsive_control(
            'icon_space_pad',
            array(
                'label' => esc_html__('Padding', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default' => [
                    'top' => 16,
                    'right' => 16,
                    'bottom' => 16,
                    'left' => 16,
                    'unit'  => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_media-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Size', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 16,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 165,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'icon_type' => 'font',
                ]
            ]
        );

        $this->add_responsive_control(
            'image_size',
            [
                'label' => esc_html__('Width', 'irecco-core') . ' (%)',
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'icon_type' => 'image',
                ]
            ]
        );

        $this->start_controls_tabs( 
            'number_colors'
        );

        $this->start_controls_tab(
            'number_colors_idle',
            [
                'label' => esc_html__('Idle', 'irecco-core'),
            ]
        );

        $this->add_control(
            'number_primary_color',
            [
                'label' => esc_html__('Primary Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'number_bg_primary_color',
            [
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $theme_color,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_number' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'number_colors_hover',
            [
                'label' => esc_html__('Hover', 'irecco-core'),
            ]
        );

        $this->add_control(
            'number_hover_primary_color',
            [
                'label' => esc_html__('Primary Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}}:hover .wgl-services_number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'number_bg_hover_primary_color',
            [
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $second_color,
                'selectors' => [
                    '{{WRAPPER}}:hover .wgl-services_number' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section(Headings Section)
        /*-----------------------------------------------------------------------------------*/    
        $this->start_controls_section(
            'title_style_section',
            array(
                'label' => esc_html__('Title', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'title_tag',
            array(
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
            )
        );

        $this->add_responsive_control(
            'title_offset',
            array(
                'label' => esc_html__('Title Offset', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => 30,
                    'right' => 0,
                    'bottom' => 10,
                    'left' => 0,
                    'unit'  => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'custom_fonts_title',
                'selector' => '{{WRAPPER}} .wgl-services_title',
            )
        );


        $this->start_controls_tabs( 'title_color_tab' );

        $this->start_controls_tab(
            'custom_title_color_idle',
            array(
                'label' => esc_html__('Idle' , 'irecco-core'),
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $header_font_color,
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services_title' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_title_color_hover',
            array(
                'label' => esc_html__('Hover' , 'irecco-core'),
            )
        );

        $this->add_control(
            'title_color_hover',
            array(
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($header_font_color),
                'selectors' => array(
                    '{{WRAPPER}}:hover .wgl-services_title' => 'color: {{VALUE}};',
                    '{{WRAPPER}}:hover .wgl-services_title a' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style_section',
            array(
                'label' => esc_html__('Content', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'content_tag',
            array(
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
            )
        );

        $this->add_responsive_control(
            'content_offset',
            array(
                'label' => esc_html__('Content Offset', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_responsive_control(
            'content_padding',
            array(
                'label' => esc_html__('Content Padding', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'custom_content_mask_color',
                'label' => esc_html__('Background', 'irecco-core'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .wgl-services_text',
                'condition' => [ 
                    'custom_bg' => 'custom',
                ],
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'custom_fonts_content',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .wgl-services_text',
            )
        ); 

        $this->start_controls_tabs( 'content_color_tab' );

        $this->start_controls_tab(
            'custom_content_color_idle',
            array(
                'label' => esc_html__('Idle' , 'irecco-core'),
            )
        );

        $this->add_control(
            'content_color',
            array(
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($main_font_color),
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services_text' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_content_color_hover',
            array(
                'label' => esc_html__('Hover' , 'irecco-core'),
            )
        );

        $this->add_control(
            'content_color_hover',
            array(
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($main_font_color),
                'selectors' => array(
                    '{{WRAPPER}}:hover .wgl-services_text' => 'color: {{VALUE}};'
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        
        $this->start_controls_section(
            'button_style_section',
            array(
                'label' => esc_html__('Button', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 
                    'add_read_more!' => '',
                ],
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'custom_fonts_button',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .wgl-services_readmore',
            )
        );

        $this->add_responsive_control(
            'custom_button_padding',
            array(
                'label' => esc_html__('Padding', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_responsive_control(
            'custom_button_margin',
            array(
                'label' => esc_html__('Margin', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_control(
            'custom_button_border',
            array(
                'label' => esc_html__('Border Radius', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            )
        );

        $this->start_controls_tabs( 'button_color_tab' );

        $this->start_controls_tab(
            'custom_button_color_idle',
            array(
                'label' => esc_html__('Idle' , 'irecco-core'),
            )
        );

        $this->add_control(
            'button_background',
            array(
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services_readmore' => 'background: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'button_color',
            array(
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($theme_color),
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services_readmore' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'button_border',
                'label' => esc_html__('Border Type', 'irecco-core'),
                'selector' => '{{WRAPPER}} .wgl-services_readmore',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow',
                'selectors' =>  '{{WRAPPER}} .wgl-services_readmore',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_button_color_hover',
            array(
                'label' => esc_html__('Hover' , 'irecco-core'),
            )
        );

        $this->add_control(
            'button_background_hover',
            array(
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services_readmore:hover' => 'background: {{VALUE}};'
                ),
            )
        ); 

        $this->add_control(
            'button_color_hover',
            array(
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($second_color),
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services_readmore:hover' => 'color: {{VALUE}};'
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'button_border_hover',
                'label' => esc_html__('Border Type', 'irecco-core'),
                'selector' => '{{WRAPPER}} .wgl-services_readmore:hover',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow_hover',
                'selector' => '{{WRAPPER}} .wgl-services_readmore:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section(); 
        
        $this->start_controls_section(
            'service_5_style_section',
            array(
                'label' => esc_html__('Item', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'service_5_offset',
            array(
                'label' => esc_html__('Margin', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default' => [
                    'top' => 0,
                    'right' => 80,
                    'bottom' => 0,
                    'left' => 0,
                    'unit'  => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_responsive_control(
            'service_5_padding',
            array(
                'label' => esc_html__('Padding', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default' => [
                    'top' => 90,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit'  => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_control(
            'service_5_border_radius',
            [
                'label' => esc_html__('Border Radius', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'service_5_color_tab' );

        $this->start_controls_tab(
            'custom_service_5_color_idle',
            array(
                'label' => esc_html__('Idle' , 'irecco-core'),
            )
        );

        $this->add_control(
            'bg_service_5_color',
            array(
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services_wrap' => 'background-color: {{VALUE}};'
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'service_5_border',
                'label' => esc_html__('Border Type', 'irecco-core'),
                'selector' => '{{WRAPPER}} .wgl-services_wrap',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'service_5_shadow',
                'selector' =>  '{{WRAPPER}} .wgl-services_wrap',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_service_5_color_hover',
            array(
                'label' => esc_html__('Hover' , 'irecco-core'),
            )
        );

        $this->add_control(
            'bg_service_5_color_hover',
            array(
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}}:hover .wgl-services_wrap' => 'background-color: {{VALUE}};'
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'service_5_border_hover',
                'label' => esc_html__('Border Type', 'irecco-core'),
                'selector' => '{{WRAPPER}}:hover .wgl-services_wrap',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'service_5_shadow_hover',
                'selector' =>  '{{WRAPPER}}:hover .wgl-services_wrap',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    public function render()
    {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('services', 'class', 'wgl-services-5');

        $this->add_render_attribute('serv_link', 'class', 'wgl-services_readmore');

        if (!empty($item['link']['url'])) {
            $this->add_link_attributes('serv_link', $item['link']);
        }

        $this->add_render_attribute('item_link', 'class', 'wgl-services_item-link');

        if (!empty($item['item_link']['url'])) {
            $this->add_link_attributes('item_link', $settings['item_link']);
        }

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

        // Icon/Image output
        ob_start();
        if (!empty($settings[ 'icon_type' ])) {
            $icons = new Wgl_Icons;
            echo $icons->build($this, $settings, []);
        }
        $services_media = ob_get_clean();

        ?>
        <div <?php echo $this->get_render_attribute_string('services'); ?>>
            <div class="wgl-services_wrap"><?php
                if ($settings[ 'icon_type' ] != '') {?>
                <div class="wgl-services_media-wrap"><?php 
                    if (!empty($services_media)) {
                        echo $services_media;
                    }?>
                </div><?php
                }?>
                <div class="wgl-services_content-wrap"><?php
                    if (!empty($settings[ 'ib_number' ])) {?>
                        <h5 class="wgl-services_number"><?php echo esc_html($settings[ 'ib_number' ]);?></h5><?php
                    }?>
                    <<?php echo $settings[ 'title_tag' ]; ?> class="wgl-services_title"><?php echo wp_kses( $settings[ 'ib_title' ], $allowed_html );?></<?php echo $settings[ 'title_tag' ]; ?>><?php
                    if (!empty($settings[ 'ib_content' ])) {?>
                        <<?php echo $settings[ 'content_tag' ]; ?> class="wgl-services_text"><?php echo wp_kses( $settings[ 'ib_content' ], $allowed_html );?></<?php echo $settings[ 'content_tag' ]; ?>><?php
                    }
                    if ((bool)$settings['add_read_more']) {?>
                        <a <?php echo $this->get_render_attribute_string('serv_link'); ?>><?php echo esc_html($settings[ 'read_more_text' ]);?></a><?php
                    }?>
                </div><?php
                if ((bool)$settings['add_item_link']) {?>
                    <a <?php echo $this->get_render_attribute_string('item_link'); ?>></a><?php
                }?>
            </div>
        </div>

        <?php     
    }
    
}