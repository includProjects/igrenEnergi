<?php
namespace WglAddons\Widgets;

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
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;


defined( 'ABSPATH' ) || exit; // Abort, if called directly.

class Wgl_Services_8 extends Widget_Base {

    public function get_name() {
        return 'wgl-services-8';
    }

    public function get_title() {
        return esc_html__('WGL Services 8', 'irecco-core');
    }

    public function get_icon() {
        return 'wgl-services-8';
    }

    public function get_categories() {
        return [ 'wgl-extensions' ];
    }

    protected function _register_controls()
    {
        $primary_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-primary-color'));
        $secondary_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-secondary-color'));
        $h_font_color = esc_attr(\iRecco_Theme_Helper::get_option('header-font')['color']);
        $main_font_color = esc_attr(\iRecco_Theme_Helper::get_option('main-font')['color']);


        /*-----------------------------------------------------------------------------------*/
        /*  Content
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'wgl_ib_content',
            array( 'label' => esc_html__('Content', 'irecco-core') )
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
            'ib_subtitle',
            array(
                'label' => esc_html__('Subtitle', 'irecco-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Subtitle', 'irecco-core'),
            )
        );

        $this->add_control(
            'subtitle_div',
            array(
                'label' => esc_html__('Add Divider before Subtitle', 'irecco-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
                'prefix_class' => 'divider_',
            )
        );

        $this->add_control(
            'bg_text',
            array(
                'label' => esc_html__('Background Text', 'irecco-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('01', 'irecco-core'),
            )
        );

        $this->add_control(
            'ib_content',
            array(
                'label' => esc_html__('Serveces Text', 'irecco-core'),
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
                'prefix_class' => 'a',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_wrapper' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .wgl-services_wrapper .wgl-services_subtitle' => 'text-align: {{VALUE}};',
                ],
            )
        );

        $this->add_control(
            'hover_animation',
            array(
                'label' => esc_html__('Enable hover animation', 'irecco-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'irecco-core'),
                'label_off' => esc_html__('Off', 'irecco-core'),
                'return_value' => 'yes',
                'description' => esc_html__('Lift up the item on hover.', 'irecco-core'),
                'prefix_class' => 'wgl-hover_shift-',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_link',
            [ 'label' => esc_html__('Link', 'irecco-core') ]
        );

        $this->add_control(
            'add_item_link',
            array(
                'label' => esc_html__('Add Link To Whole Item', 'irecco-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'irecco-core'),
                'label_off' => esc_html__('Off', 'irecco-core'),
                'return_value' => 'yes',
                'condition' => [
                    'add_read_more!' => 'yes'
                ],
            )
        );

        $this->add_control(
            'item_link',
            array(
                'label' => esc_html__('Link', 'irecco-core'),
                'type' => Controls_Manager::URL,
                'condition' => [ 'add_item_link' => 'yes' ],
                'label_block' => true,
                'condition' => [
                    'add_item_link' => 'yes',
                ],
            )
        );

        $this->add_control(
            'add_read_more',
            array(
                'label' => esc_html__('Add \'Read More\' Button', 'irecco-core'),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [ 'add_item_link!' => 'yes' ],
                'label_on' => esc_html__('On', 'irecco-core'),
                'label_off' => esc_html__('Off', 'irecco-core'),
                'return_value' => 'yes',
                'condition' => [
                    'add_item_link!' => 'yes',
                ],
                'default' => 'yes',
            )
        );

        $this->add_control(
            'read_more_text',
            array(
                'label' => esc_html__('Button Text', 'irecco-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'add_read_more' => 'yes'
                ],
            )
        );

        $this->add_control(
            'link',
            array(
                'label' => esc_html__('Button Link', 'irecco-core'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'condition' => [
                    'add_read_more' => 'yes',
                ],
            )
        );

        $this->add_control(
            'hr_link',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'read_more_icon_sticky',
            array(
                'label' => esc_html__('Stick the button', 'irecco-core'),

                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'irecco-core'),
                'label_off' => esc_html__('Off', 'irecco-core'),
                'return_value' => 'yes',
                'description' => esc_html__('Attach to the center top or bottom corner.', 'irecco' ),
                'condition' => [
                    'add_read_more' => 'yes',
                ],
                'default' => 'yes',
            )
        );

        $this->add_control(
            'read_more_icon_sticky_pos',
            array(
                'label' => esc_html__('Read More Position', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top' => esc_html__('Top', 'irecco-core'),
                    'bottom' => esc_html__('Bottom', 'irecco-core'),
                ],
                'default' => 'top',
                'condition' => [
                    'add_read_more' => 'yes',
                    'read_more_icon_sticky' => 'yes',
                ],
            )
        );

        $this->add_control(
            'icon_read_more_pack',
            array(
                'label' => esc_html__('Icon Pack', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'condition' => [ 'add_read_more' => 'yes' ],
                'options' => [
                    'fontawesome' => esc_html__('Fontawesome', 'irecco-core'),
                    'flaticon' => esc_html__('Flaticon', 'irecco-core'),
                ],
                'default' => 'flaticon',
            )
        );

        $this->add_control(
            'read_more_icon_flaticon',
            array(
                'label' => esc_html__('Icon', 'irecco-core'),
                'type' => 'wgl-icon',
                'condition' => [
                    'add_read_more' => 'yes',
                    'icon_read_more_pack' => 'flaticon',
                ],
                'label_block' => true,
                'description' => esc_html__('Select icon from Flaticon library.', 'irecco-core'),
                'default' => 'flaticon-download',
            )
        );

        $this->add_control(
            'read_more_icon_fontawesome',
            array(
                'label' => esc_html__('Icon', 'irecco-core'),
                'type' => Controls_Manager::ICON,
                'label_block' => true,
                'condition' => [
                    'add_read_more' => 'yes',
                    'icon_read_more_pack' => 'fontawesome',
                ],
                'description' => esc_html__('Select icon from Fontawesome library.', 'irecco-core'),
            )
        );

        $this->add_control(
            'read_more_icon_align',
            array(
                'label' => esc_html__('Icon Position', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'condition' => [ 'add_read_more' => 'yes' ],
                'options' => [
                    'left' => esc_html__('Before', 'irecco-core'),
                    'right' => esc_html__('After', 'irecco-core'),
                ],
                'default' => 'right',
            )
        );

        $this->add_control(
            'read_more_icon_spacing',
            array(
                'label' => esc_html__('Icon Spacing', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [ 'add_read_more' => 'yes' ],
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 100 ],
                ],
                'default' => [ 'size' => 0, 'unix' => 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore.icon-position-right i' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wgl-services_readmore.icon-position-left i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            )
        );

        $this->add_control(
            'read_more_icon_rotation',
            array(
                'label' => esc_html__('Icon Rotation', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [ 'add_read_more' => 'yes' ],
                'size_units' => [ 'deg', 'turn'],
                'range' => [
                    'deg' => [ 'min' => -360, 'max' => 360 ],
                    'turn' => [ 'min' => -1, 'max' => 1, 'step' => 0.1 ],
                ],
                'default' => [ 'size' => -90, 'unit' => 'deg' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_readmore i' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            )
        );


        $this->end_controls_section();
        /*-----------------------------------------------------------------------------------*/
        /*  Style Title
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'title_style_section',
            array(
                'label' => esc_html__('Title', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ib_title!' => '',
                ],
            )
        );

        $this->add_control(
            'title_tag',
            array(
                'label' => esc_html__('Title Tag', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
                'description' => esc_html__('Choose your tag for services title', 'irecco-core'),
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
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 4,
                    'left' => 0,
                    'unit'  => 'px',
                    'isLinked'  => false,
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


        $this->start_controls_tabs(
            'title_color_tab' );

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
                'default' => '#232323',
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
                'default' => $primary_color,
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services-8:hover .wgl-services_title' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        /*-----------------------------------------------------------------------------------*/
        /*  Style Subitle
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'subtitle_style_section',
            array(
                'label' => esc_html__('Subitle', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 'ib_subtitle!' => '' ],
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'custom_fonts_bg_title',
                'selector' => '{{WRAPPER}} .wgl-services_subtitle',
            )
        );

        $this->add_responsive_control(
            'subtitle_offset',
            array(
                'label' => esc_html__('Subtitle Offset', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => -57,
                    'right' => 0,
                    'bottom' => 29,
                    'left' => 0,
                    'unit'  => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->start_controls_tabs( 'title_bg_color_tab' );

        $this->start_controls_tab(
            'custom_bg_title_color_idle',
            array(
                'label' => esc_html__('Idle' , 'irecco-core'),
            )
        );

        $this->add_control(
            'bg_title_color',
            array(
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => esc_attr($secondary_color),
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services_subtitle' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_bg_title_color_hover',
            array(
                'label' => esc_html__('Hover' , 'irecco-core'),
            )
        );

        $this->add_control(
            'title_bg_color_hover',
            array(
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}}:hover .wgl-services_subtitle' => 'color: {{VALUE}};'
                ),
            )
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


         /*-----------------------------------------------------------------------------------*/
        /*  STYLE -> BACKGROUND TEXT
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'bg_text_style_section',
            array(
                'label' => esc_html__('Background Text', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 'bg_text!' => '' ],
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'custom_fonts_bg_text',
                'selector' => '{{WRAPPER}} .wgl-services_bg_text',
            )
        );

        $this->add_responsive_control(
            'bg_text_offset',
            array(
                'label' => esc_html__('Background Text Offset', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 30,
                    'unit'  => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_bg_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );


        $this->start_controls_tabs( 'bg_text_color_tab' );

        $this->start_controls_tab(
            'custom_bg_text_color_idle',
            array(
                'label' => esc_html__('Idle' , 'irecco-core'),
            )
        );

        $this->add_control(
            'ext_bg_color',
            array(
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#d6d6d6',
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services_bg_text' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_bg_text_color_hover',
            array(
                'label' => esc_html__('Hover' , 'irecco-core'),
            )
        );

        $this->add_control(
            'bg_text_color_hover',
            array(
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#d6d6d6',
                'selectors' => array(
                    '{{WRAPPER}}:hover .wgl-services_bg_text' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        
         /*-----------------------------------------------------------------------------------*/
        /*  Style Content
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'content_style_section',
            array(
                'label' => esc_html__('Content', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ib_content!' => '',
                ],
            )
        );

        $this->add_control('content_tag',
            array(
                'label' => esc_html__('Content Tag', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'div',
                'description' => esc_html__('Choose your tag for services content', 'irecco-core'),
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
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom'=> 15,
                    'left'  => 0,
                    'unit'  => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .wgl-services_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'custom_content_mask_color',
                'label' => esc_html__('Background', 'irecco-core'),
                'types' => [ 'classic', 'gradient' ],
                'condition' => [ 'custom_bg' => 'custom' ],
                'selector' => '{{WRAPPER}} .wgl-services_content',
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'custom_fonts_content',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .wgl-services_content',
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
                    '{{WRAPPER}} .wgl-services_content' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}}:hover .wgl-services_content' => 'color: {{VALUE}};'
                ),
            )
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  Style Button
        /*-----------------------------------------------------------------------------------*/

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
                'default' => [
                    'top' => 20,
                    'right' => 23,
                    'bottom' => 20,
                    'left' => 23,
                ],
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
                'default' => [
                    'top' => 50,
                    'right' => 50,
                    'bottom'=> 50,
                    'left'  => 50,
                    'unit'  => '%',
                ],
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
                'default' => $primary_color,
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services_readmore' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'button_color',
            array(
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services_readmore' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wgl-services_readmore a' => 'color: {{VALUE}};',
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
                'selector' =>  '{{WRAPPER}} .wgl-services_readmore',
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
                'default' => '#ffffff',
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services_readmore:hover' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'button_color_hover',
            array(
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $primary_color,
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services_readmore:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wgl-services_readmore:hover a' => 'color: {{VALUE}};'
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

        /*-----------------------------------------------------------------------------------*/
        /*  Style Item
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
                'size_units' => [ 'px', 'em', '%' ],
                'default' => [
                    'top' => 50,
                    'right' => 40,
                    'bottom' => 35,
                    'left' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'item_color_tab' );

        $this->start_controls_tab(
            'custom_item_color_normal',
            [ 'label' => esc_html__('Normal' , 'irecco-core') ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'media_background',
                'label' => esc_html__('Background', 'irecco-core'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .wgl-services_media',
            ]
        );

        $this->add_control(
            'image_opacity',
            [
                'label' => esc_html__('Opacity', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'range' =>[
                    'px' => ['min' =>0.10, 'max' => 1, 'step' => 0.01 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_media' => 'opacity: {{SIZE}};',
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

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_item_color_hover',
            [ 'label' => esc_html__('Hover' , 'irecco-core') ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'media_background_hover',
                'label' => esc_html__('Background', 'irecco-core'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .wgl-services_media:hover',
            ]
        );
        $this->add_control(
            'image_opacity_hover',
            [
                'label' => esc_html__('Opacity', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'range' =>[
                    'px' => ['min' =>0.10, 'max' => 1, 'step' => 0.01],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services-8:hover .wgl-services_media' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'services_item_shadow_hover',
                'selector' => '{{WRAPPER}} .wgl-services_wrap:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

    }

    public function render()
    {
        $settings = $this->get_settings_for_display();
        extract($settings);

        $this->add_render_attribute('services', 'class', 'wgl-services-8');

        if (!empty($settings['link']['url'])) {
            $this->add_link_attributes('serv_link', $settings['link']);
        }

        $this->add_render_attribute('serv_class', [
            'class' => [
                'wgl-services_readmore',
                'icon-position-'.esc_attr($read_more_icon_align)
            ],
        ]);

        if ((bool)$read_more_icon_sticky) {
            $this->add_render_attribute('serv_class', 'class', [ 'corner-attached', 'corner-position_'.esc_attr($read_more_icon_sticky_pos) ]);
        }

        $this->add_render_attribute('item_link', 'class', 'wgl-services_link');

        if (!empty($settings['item_link']['url'])) {
            $this->add_link_attributes('item_link', $settings['item_link']);
        }

        // HTML tags allowed for rendering
        $allowed_html = [
            'a' => [
                'href' => true, 'title' => true,
                'class' => true, 'style' => true,
            ],
            'br' => [ 'class' => true, 'style' => true ],
            'em' => [ 'class' => true, 'style' => true ],
            'strong' => [ 'class' => true, 'style' => true ],
            'span' => [ 'class' => true, 'style' => true ],
            'p' => [ 'class' => true, 'style' => true ]
        ];

        // Render
        if ((bool)$settings['add_item_link']) {
            echo '<a ', $this->get_render_attribute_string('item_link'), '></a>';
        }
        ?>
        <div <?php echo $this->get_render_attribute_string( 'services' ); ?>>
            <div class="wgl-services_media">
            </div>
            <div class="wgl-services_wrap">
                <div class="wgl-services_content-wrap">
                    <?php
                    if ( !empty($settings[ 'bg_text' ]) ) : ?><div class="wgl-services_bg_text"><?php echo $settings[ 'bg_text' ]; ?></div><?php endif;
                    if ( !empty($settings[ 'ib_subtitle' ]) ) : ?><div class="wgl-services_subtitle"><span><?php echo $settings[ 'ib_subtitle' ]; ?></span></div><?php endif;
                    if ( !empty($settings[ 'ib_title' ]) ) : ?><<?php echo $settings['title_tag']; ?> class="wgl-services_title"><?php echo wp_kses($settings[ 'ib_title' ], $allowed_html ); ?></<?php echo $settings['title_tag']; ?>><?php endif;
                    if ( !empty($settings[ 'ib_content' ]) ) : ?><<?php echo $settings['content_tag']; ?> class="wgl-services_content"><?php echo wp_kses($settings[ 'ib_content' ], $allowed_html ); ?></<?php echo $settings['content_tag']; ?>><?php endif;
                    if ((bool)$settings[ 'add_read_more' ]) {

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


                        $button = '<div '.$this->get_render_attribute_string( 'serv_class' ) .'><a '.$this->get_render_attribute_string( 'serv_link' ) .'>';
                        if ($read_more_icon_align === 'left') {
                            $button .= !empty($icon_font) ? '<i class="'.esc_attr($icon_font).'"></i>' : '';
                        }
                        $button .= esc_html($read_more_text);
                        if ($read_more_icon_align === 'right') {
                            $button .= !empty($icon_font) ? '<i class="'.esc_attr($icon_font).'"></i>' : '';
                        }
                        $button .= '</a></div>';

                        echo $button;

                    }?>

                </div>
            </div>
        </div>

        <?php
    }

}
