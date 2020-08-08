<?php

namespace WglAddons\Widgets;

defined('ABSPATH') || exit; // Abort, if called directly.

use WglAddons\Includes\Wgl_Icons;
use WglAddons\Includes\Wgl_Carousel_Settings;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use Elementor\Repeater;


class Wgl_Services_6 extends Widget_Base
{

    public function get_name()
    {
        return 'wgl-services-6';
    }

    public function get_title()
    {
        return esc_html__('WGL Services 6', 'irecco-core');
    }

    public function get_icon()
    {
        return 'wgl-services-6';
    }

    public function get_categories()
    {
        return ['wgl-extensions'];
    }


    protected function _register_controls()
    {
        $primary_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-primary-color'));
        $secondary_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-secondary-color'));
        $h_font_color = esc_attr(\iRecco_Theme_Helper::get_option('header-font')['color']);
        $main_font_color = esc_attr(\iRecco_Theme_Helper::get_option('main-font')['color']);

        /*-----------------------------------------------------------------------------------*/
        /*  CONTENT -> ICON/IMAGE
        /*-----------------------------------------------------------------------------------*/

        Wgl_Icons::init(
            $this,
            ['section' => true]
        );

        /*-----------------------------------------------------------------------------------*/
        /*  CONTENT -> CONTENT
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'module_content',
            ['label' => esc_html__('Content', 'irecco-core')]
        );

        $this->add_control(
            'ib_title',
            [
                'label' => esc_html__('Title', 'irecco-core'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__('This is the heading​', 'irecco-core'),
            ]
        );

        $this->add_control(
            'ib_text',
            [
                'label' => esc_html__('Text', 'irecco-core'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'alignment',
            [
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
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        /*-----------------------------------------------------------------------------------*/
        /*  CONTENT -> LINK
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'section_style_link',
            ['label' => esc_html__('Button', 'irecco-core')]
        );

        $this->add_control(
            'add_item_link',
            [
                'label' => esc_html__('Add Link To Whole Item', 'irecco-core'),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['add_read_more!' => 'yes'],
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'item_link',
            [
                'label' => esc_html__('Link', 'irecco-core'),
                'type' => Controls_Manager::URL,
                'condition' => ['add_item_link' => 'yes'],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'add_read_more',
            [
                'label' => esc_html__('Add \'Read More\' Button', 'irecco-core'),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['add_item_link!' => 'yes'],
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label' => esc_html__('Button Text', 'irecco-core'),
                'type' => Controls_Manager::TEXT,
                'condition' => ['add_read_more' => 'yes'],
                'label_block' => true,
                'default' => '',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__('Button Link', 'irecco-core'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'condition' => [
                    'add_read_more' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'hr_link',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'icon_read_more_pack',
            [
                'label' => esc_html__('Icon Pack', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'condition' => ['add_read_more' => 'yes'],
                'options' => [
                    'fontawesome' => esc_html__('Fontawesome', 'irecco-core'),
                    'flaticon' => esc_html__('Flaticon', 'irecco-core'),
                ],
                'default' => 'flaticon',
            ]
        );

        $this->add_control(
            'read_more_icon_flaticon',
            [
                'label' => esc_html__('Icon', 'irecco-core'),
                'type' => 'wgl-icon',
                'condition' => [
                    'add_read_more' => 'yes',
                    'icon_read_more_pack' => 'flaticon',
                ],
                'label_block' => true,
                'description' => esc_html__('Select icon from Flaticon library.', 'irecco-core'),
                'default' => 'flaticon-plus',
            ]
        );

        $this->add_control(
            'read_more_icon_fontawesome',
            [
                'label' => esc_html__('Icon', 'irecco-core'),
                'type' => Controls_Manager::ICON,
                'label_block' => true,
                'condition' => [
                    'add_read_more' => 'yes',
                    'icon_read_more_pack' => 'fontawesome',
                ],
                'description' => esc_html__('Select icon from Fontawesome library.', 'irecco-core'),
            ]
        );

        $this->add_control(
            'read_more_icon_align',
            [
                'label' => esc_html__('Icon Position', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'condition' => [
                    'add_read_more' => 'yes',
                    'read_more_text!' => ''
                ],
                'options' => [
                    'left' => esc_html__('Before', 'irecco-core'),
                    'right' => esc_html__('After', 'irecco-core'),
                ],
                'default' => 'left',
            ]
        );

        $this->add_control(
            'read_more_icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'add_read_more' => 'yes',
                    'read_more_text!' => ''
                ],
                'range' => [
                    'px' => ['min' => 0, 'max' => 100],
                ],
                'default' => ['size' => 0, 'unit' => 'px'],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore.icon-right i' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wgl-services_readmore.icon-left i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        /*-----------------------------------------------------------------------------------*/
        /*  STYLE -> ITEM
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'item_style_section',
            [
                'label' => esc_html__('Item', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'item_pad',
            [
                'label' => esc_html__('Padding', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 50,
                    'left' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'services_item_shadow',
                'selector' => '{{WRAPPER}} .wgl-services_wrap',
            ]
        );

        $this->start_controls_tabs('item_color_tab');

        $this->start_controls_tab(
            'custom_item_color_idle',
            ['label' => esc_html__('Idle', 'irecco-core')]
        );

        $this->add_control(
            'item_color',
            [
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $primary_color,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_wrap' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_item_color_hover',
            ['label' => esc_html__('Hover', 'irecco-core')]
        );

        $this->add_control(
            'item_color_hover',
            [
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}:hover .wgl-services_wrap:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        /*-----------------------------------------------------------------------------------*/
        /*  STYLE -> MEDIA
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
            ['condition' => ['icon_type'  => 'font']]
        );

        $this->start_controls_tab(
            'icon_colors_normal',
            ['label' => esc_html__('Idle', 'irecco-core')]
        );

        $this->add_control(
            'primary_color',
            [
                'label' => esc_html__('Primary Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(255, 255, 255, 0.2)',
                'selectors' => [
                    '{{WRAPPER}} .wgl-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_colors_hover',
            ['label' => esc_html__('Hover', 'irecco-core')]
        );

        $this->add_control(
            'hover_primary_color',
            [
                'label' => esc_html__('Primary Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(255, 255, 255, 0.2)',
                'selectors' => [
                    '{{WRAPPER}}:hover .wgl-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'icon_space',
            [
                'label' => esc_html__('Margin', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => 0,
                    'right' => -47,
                    'bottom' => -103,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-widget_container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Size', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'condition' => ['icon_type' => 'font'],
                'range' => [
                    'px' => ['min' => 16, 'max' => 200],
                ],
                'default' => ['size' => 173, 'unit' => 'px'],
                'selectors' => [
                    '{{WRAPPER}} .wgl-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'media_alignment',
            [
                'label' => esc_html__('Media Alignment', 'irecco-core'),
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
                'default' => 'right',
                'toggle' => true,
                'prefix_class' => 'media-',
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => esc_html__('Padding', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_media-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  STYLE -> TITLE
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
                'label' => esc_html__('HTML Tag', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => '‹h1›',
					'h2' => '‹h2›',
					'h3' => '‹h3›',
					'h4' => '‹h4›',
					'h5' => '‹h5›',
					'h6' => '‹h6›',
					'div' => '‹div›',
					'span' => '‹span›',
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

        $this->start_controls_tabs('title_color_tab');

        $this->start_controls_tab(
            'custom_title_color_normal',
            ['label' => esc_html__('Idle', 'irecco-core')]
        );

        $this->add_control(
            'title_color_idle',
            [
                'label' => esc_html__('Title Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_divider_color_idle',
            [
                'label' => esc_html__('Title Divider Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_content-wrap:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_title_color_hover',
            ['label' => esc_html__('Hover', 'irecco-core')]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__('Title Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .wgl-services_title, {{WRAPPER}}:hover .wgl-services_title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_divider_color_hover',
            [
                'label' => esc_html__('Title Divider Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_wrap:hover .wgl-services_content-wrap:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        /*-----------------------------------------------------------------------------------*/
        /*  STYLE -> TEXT
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'text_style_section',
            [
                'label' => esc_html__('Text', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'text_offset',
            [
                'label' => esc_html__('Title Offset', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'custom_fonts_text',
                'selector' => '{{WRAPPER}} .wgl-services_text',
            ]
        );

        $this->start_controls_tabs('text_color_tab');

        $this->start_controls_tab(
            'custom_text_color_normal',
            ['label' => esc_html__('Normal', 'irecco-core')]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $main_font_color,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_text_color_hover',
            ['label' => esc_html__('Hover', 'irecco-core')]
        );

        $this->add_control(
            'text_color_hover',
            [
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $main_font_color,
                'selectors' => [
                    '{{WRAPPER}}:hover .wgl-services_text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        /*-----------------------------------------------------------------------------------*/
        /*  STYLE -> BUTTON
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'button_style_section',
            [
                'label' => esc_html__('Button', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['add_read_more!' => ''],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'custom_fonts_button',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .wgl-services_readmore',
            ]
        );

        $this->add_responsive_control(
            'custom_button_padding',
            [
                'label' => esc_html__('Padding', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => 17,
                    'right' => 19,
                    'bottom' => 17,
                    'left' => 19,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'custom_button_margin',
            [
                'label' => esc_html__('Margin', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'custom_button_border',
            [
                'label' => esc_html__('Border Radius', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 50,
                    'right' => 50,
                    'bottom' => 50,
                    'left'  => 50,
                    'unit'  => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );

        $this->start_controls_tabs('button_color_tab');

        $this->start_controls_tab(
            'custom_button_color_idle',
            ['label' => esc_html__('Idle', 'irecco-core')]
        );

        $this->add_control(
            'button_background',
            [
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $h_font_color,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => esc_html__('Border Type', 'irecco-core'),
                'selector' => '{{WRAPPER}} .wgl-services_readmore',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow',
                'selector' => '{{WRAPPER}} .wgl-services_readmore',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_button_color_hover',
            ['label' => esc_html__('Hover', 'irecco-core')]
        );

        $this->add_control(
            'button_background_hover',
            [
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $h_font_color,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore:hover' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border_hover',
                'label' => esc_html__('Border Type', 'irecco-core'),
                'selector' => '{{WRAPPER}} .wgl-services_readmore:hover',
            ]
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

        $this->add_control(
            'icon_heading',
            [
                'label' => esc_html__('Icon Settings', 'irecco-core'),
                'type' => Controls_Manager::HEADING,
                'condition' => ['add_read_more!' => ''],
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs(
            'button_icon_tabs',
            [
                'condition' => ['add_read_more!' => '']
            ]
        );

        $this->start_controls_tab(
            'button_icon_idle',
            ['label' => esc_html__('Idle', 'irecco-core')]
        );
        
        $this->add_control(
            'button_icon_color_idle',
            [
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon_rotate_idle',
            [
                'label' => esc_html__('Rotation', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg', 'turn'],
                'range' => [
                    'deg' => ['min' => 0, 'max' => 360],
                    'turn' => ['min' => 0, 'max' => 1, 'step' => 0.1],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore i' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'button_icon_transition_idle',
            [
                'label' => esc_html__('Transition', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => ['min' => 0, 'max' => 3, 'step' => 0.1],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore i' => 'transition: {{SIZE}}s;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_icon_hover',
            ['label' => esc_html__('Hover', 'irecco-core')]
        );

        $this->add_control(
            'button_icon_color_hover',
            [
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon_rotate_hover',
            [
                'label' => esc_html__('Rotation', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg', 'turn'],
                'range' => [
                    'deg' => ['min' => 0, 'max' => 360],
                    'turn' => ['min' => 0, 'max' => 1, 'step' => 0.1],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore:hover i' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'button_icon_transition_hover',
            [
                'label' => esc_html__('Transition', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => ['min' => 0, 'max' => 3, 'step' => 0.1],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore:hover i' => 'transition: {{SIZE}}s;',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }


    public function render()
    {
        $_s = $this->get_settings_for_display();
        extract($_s);

        $this->add_render_attribute(
            'services',
            [
                'class' => [
                    'wgl-services-6',
                    'services_' . $_s['alignment']
                ],
            ]
        );

        $this->add_render_attribute(
            'serv_link',
            [
                'class' => [
                    'wgl-services_readmore',
                    $read_more_icon_align ? 'icon-' . esc_attr($read_more_icon_align) : ''
                ],
            ]
        );
        $this->add_link_attributes('serv_link', $_s['link']);

        $this->add_render_attribute('item_link', 'class', 'wgl-services_link');

        if (!empty($_s['item_link']['url'])) {
            $this->add_link_attributes('item_link', $_s['item_link']);
        }

        // HTML tags allowed for rendering
        $allowed_html = [
            'a' => [
                'href' => true, 'title' => true,
                'class' => true, 'style' => true
            ],
            'br' => ['class' => true, 'style' => true],
            'em' => ['class' => true, 'style' => true],
            'strong' => ['class' => true, 'style' => true],
            'span' => [ 'class' => true, 'style' => true ],
            'p' => [ 'class' => true, 'style' => true ]
        ];

        // Icon/Image output
        ob_start();
        if (!empty($_s['icon_type'])) {
            $icons = new Wgl_Icons;
            echo $icons->build($this, $_s, []);
        }
        $services_media = ob_get_clean();

        // Render
        echo '<div ', $this->get_render_attribute_string('services'), '>';
        echo '<div class="wgl-services_wrap">';

        if ($_s['icon_type'] != '') {
            echo '<div class="wgl-services_media-wrap">';
            if (!empty($services_media)) {
                echo $services_media;
            }
            echo '</div>';
        }

        echo '<div class="wgl-services_content-wrap">';

        echo '<', $_s['title_tag'], ' class="wgl-services_title">',
            wp_kses($_s['ib_title'], $allowed_html),
            '</', $_s['title_tag'], '>';
        echo '<div class="wgl-services_text">',
            wp_kses($_s['ib_text'], $allowed_html),
            '</div>';
        if ($_s['add_read_more']) {
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
            echo '<a ', $this->get_render_attribute_string('serv_link'), '>',
                !empty($icon_font) ? '<i class="' . esc_attr($icon_font) . '"></i>' : '',
                esc_html($read_more_text),
                '</a>';
        }

        echo '</div>'; // content-wrap

        if ($_s['add_item_link']) {
            echo '<a ', $this->get_render_attribute_string('item_link'), '></a>';
        }

        echo '</div>'; // wgl-services_wrap
        echo '</div>';
    }
}
