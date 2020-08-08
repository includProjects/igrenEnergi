<?php

namespace WglAddons\Widgets;

if (!defined('ABSPATH')) exit; // Abort, if called directly.

use WglAddons\Includes\Wgl_Icons;
use WglAddons\Includes\Wgl_Carousel_Settings;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use Elementor\Group_Control_Css_Filter;


class Wgl_Header_Menu extends Widget_Base
{
    public function get_name()
    {
        return 'wgl-header-menu';
    }

    public function get_title()
    {
        return esc_html__('WGL Menu', 'irecco-core');
    }

    public function get_icon()
    {
        return 'wgl-header-menu';
    }

    public function get_categories()
    {
        return ['wgl-header-modules'];
    }

    public function get_script_depends()
    {
        return [
            'wgl-elementor-extensions-widgets',
        ];
    }

    protected function _register_controls()
    {
        $primary_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-primary-color'));
        $secondary_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-secondary-color'));
        $h_font_color = esc_attr(\iRecco_Theme_Helper::get_option('header-font')['color']);
        $main_font_color = esc_attr(\iRecco_Theme_Helper::get_option('main-font')['color']);

        /*-----------------------------------------------------------------------------------*/
        /*  Build Icon/Image Box
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'section_navigation_settings',
            [
                'label' => esc_html__('Navigation Settings', 'irecco-core'),
            ]
        );

        $this->add_control(
            'menu_choose',
            [
                'label' => esc_html__('Menu', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__('Default', 'irecco-core'),
                    'custom' => esc_html__('Custom Menu', 'irecco-core'),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'custom_menu',
            [
                'label' => esc_html__('Custom Menu', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'condition' => ['menu_choose' => 'custom'],
                'options' => irecco_get_custom_menu(),
                'default' => 'Main',
            ]
        );


        $this->add_control(
            'lavalamp_active',
            [
                'label' => esc_html__('Enable Lavalamp Marker', 'irecco-core'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'menu_height',
            [
                'label' => esc_html__('Menu Height', 'irecco-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'step' => 1,
                'default' => 100,
                'description' => esc_html__('Enter value in pixels', 'irecco-core'),
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .primary-nav' => 'height: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_control(
            'menu_align',
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
                'label_block' => false,
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .primary-nav' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'menu_section',
            [
                'label' => esc_html__('Navigation Style', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'menu_items_padding',
            [
                'label' => esc_html__('Padding', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .primary-nav > ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .primary-nav > ul' => 'margin-left: -{{LEFT}}{{UNIT}}; margin-right: -{{RIGHT}}{{UNIT}}; margin-bottom: -{{BOTTOM}}{{UNIT}}',
                ],
            ]
        );

        $this->start_controls_tabs('menu_items_color_tabs');

        $this->start_controls_tab(
            'custom_menu_items_color_normal',
            [
                'label' => esc_html__('Idle', 'irecco-core'),
            ]
        );

        $this->add_control(
            'menu_items_color',
            [
                'label' => esc_html__('Items Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $h_font_color,
                'selectors' => [
                    '{{WRAPPER}} .primary-nav > ul > li > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_menu_items_color_hover',
            [
                'label' => esc_html__('Hover', 'irecco-core'),
            ]
        );

        $this->add_control(
            'menu_items_hover_color',
            [
                'label' => esc_html__('Items Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primary-nav > ul > li:hover > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'custom_fonts_menu_items',
                'selector' => '{{WRAPPER}} .primary-nav>div>ul,{{WRAPPER}} .primary-nav>ul',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_sub_menu_settings',
            [
                'label' => esc_html__('Sub Menu Settings', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'custom_sub_menu_background',
                'label' => esc_html__('Sub Menu Background', 'irecco-core'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .primary-nav ul li ul',
            ]
        );

        $this->add_control(
            'custom_sub_menu_color',
            [
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $h_font_color,
                'selectors' => [
                    '{{WRAPPER}} .primary-nav ul li ul' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'sub_menu_border',
                'selector' => '{{WRAPPER}} .primary-nav ul li ul li:not(:last-child)',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sub_menu_shadow',
                'selector' => '{{WRAPPER}} .primary-nav ul li ul',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'custom_fonts_sub_menu_items',
                'selector' => '{{WRAPPER}} .primary-nav>div>ul ul,{{WRAPPER}} .primary-nav>ul ul',
            ]
        );

        $this->end_controls_section();
    }

    public function render()
    {
        $settings = $this->get_settings_for_display();
        extract($settings);

        $menu = '';

        if ($menu_choose === 'custom') {
            $menu = !empty($custom_menu) ? $custom_menu : '';
        }

        if (has_nav_menu('main_menu')) {
            echo "<nav class='primary-nav" . (!empty($lavalamp_active) ? ' menu_line_enable' : '') . "'>";
            irecco_main_menu($menu);
            echo '</nav>';

            echo '<div class="mobile-hamburger-toggle">',
                '<div class="hamburger-box">',
                '<div class="hamburger-inner">',
                '</div>',
                '</div>',
                '</div>';
        }
    }
}
