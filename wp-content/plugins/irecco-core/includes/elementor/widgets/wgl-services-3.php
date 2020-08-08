<?php
namespace WglAddons\Widgets;

use WglAddons\Includes\Wgl_Icons;
use WglAddons\Includes\Wgl_Carousel_Settings;
use WglAddons\Includes\Wgl_Elementor_Helper;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
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

class Wgl_Services_3 extends Widget_Base {
    
    public function get_name() {
        return 'wgl-services-3';
    }

    public function get_title() {
        return esc_html__('WGL Services 3', 'irecco-core');
    }

    public function get_icon() {
        return 'wgl-services-3';
    }

    public function get_categories() {
        return [ 'wgl-extensions' ];
    }

    
    protected function _register_controls()
    {
        $theme_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-primary-color'));
        $second_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-secondary-color'));
        $h_font_color = esc_attr(\iRecco_Theme_Helper::get_option('header-font')['color']);
        $main_font_color = esc_attr(\iRecco_Theme_Helper::get_option('main-font')['color']);

        /*-----------------------------------------------------------------------------------*/
        /*  Build Icon/Image Box
        /*-----------------------------------------------------------------------------------*/
        $this->start_controls_section('wgl_services_content',
            array(
                'label' => esc_html__('Service Content', 'irecco-core'),
            )
        );

        $this->add_control(
            'service_image',
            array(
                'label' => esc_html__('Thumbnail', 'irecco-core'),
                'type' => Controls_Manager::MEDIA,
            )
        );

        $this->add_control(
            'services_title',
            array(
                'label' => esc_html__('Title', 'irecco-core'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__('This is the heading​', 'irecco-core'),
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
                'default' => 'center',
                'toggle' => true,
            )
        );


        $this->add_control(
            'service_link',
            array(
                'label' => esc_html__('Service link', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('None', 'irecco-core'),
                    'whole' => esc_html__('Whole Item', 'irecco-core'),
                    'title' => esc_html__('Only Title', 'irecco-core'),
                ],
                'default' => '',
                'toggle' => true,
            )
        );

        $this->add_control(
            'item_link',
            array(
                'label' => esc_html__('Link', 'irecco-core'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'condition' => [ 
                    'service_link!' => '',
                ],
            )
        );

        /*End General Settings Section*/
        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section(Headings Section)
        /*-----------------------------------------------------------------------------------*/    

        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__('Image', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_space',
            array(
                'label' => esc_html__('Margin', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_image-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_responsive_control(
            'image_padding',
            array(
                'label' => esc_html__('Padding', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_image-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_control(
            'services_image_border_radius',
            array(
                'label' => esc_html__('Border Radius', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit'  => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            )
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'services_image_border',
				'selector' => '{{WRAPPER}} .wgl-services_image-wrap'
			]
        );
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'services_image_shadow',
				'selector' => '{{WRAPPER}} .wgl-services_image-wrap',
			]
		);

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  Style Section(Headings Section)
        /*-----------------------------------------------------------------------------------*/    

        // Title Styles

        $this->start_controls_section(
            'title_style_section',
            array(
                'label' => esc_html__('Title', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'custom_fonts_title',
                'selector' => '{{WRAPPER}} .wgl-services_title',
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
            'title_margin',
            array(
                'label' => esc_html__('Title Margin', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit'  => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_title-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_control(
            'services_title_border_radius',
            array(
                'label' => esc_html__('Border Radius', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit'  => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            )
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'services_title_border',
				'selector' => '{{WRAPPER}} .wgl-services_title'
			]
        );
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'services_title_shadow',
				'selector' => '{{WRAPPER}} .wgl-services_title',
			]
		);

        $this->start_controls_tabs( 'services_color_tab' );

        $this->start_controls_tab(
            'custom_services_color_idle',
            array(
                'label' => esc_html__('Idle' , 'irecco-core'),
            )
        );

        $this->add_responsive_control(
            'title_padding',
            array(
                'label' => esc_html__('Title Padding', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => 35,
                    'right' => 10,
                    'bottom' => 35,
                    'left' => 10,
                    'unit'  => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wgl-services_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_control(
            'services_color',
            array(
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $h_font_color,
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services_title' => 'color: {{VALUE}};'
                ),
            )
        );

        $this->add_control(
            'bg_services_color',
            array(
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => array(
                    '{{WRAPPER}} .wgl-services_title' => 'background-color: {{VALUE}};'
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'custom_services_color_hover',
            array(
                'label' => esc_html__('Hover' , 'irecco-core'),
            )
        );

        $this->add_responsive_control(
            'hover_title_padding',
            array(
                'label' => esc_html__('Title Padding', 'irecco-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => 25,
                    'right' => 10,
                    'bottom' => 25,
                    'left' => 10,
                    'unit'  => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover .wgl-services_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            )
        );

        $this->add_control(
            'services_color_hover',
            array(
                'label' => esc_html__('Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => $h_font_color,
                'selectors' => array(
                    '{{WRAPPER}}:hover .wgl-services_title' => 'color: {{VALUE}};'
                ),
            )
        );

        $this->add_control(
            'bg_services_color_hover',
            array(
                'label' => esc_html__('Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => array(
                    '{{WRAPPER}}:hover .wgl-services_title' => 'background-color: {{VALUE}};'
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section(); 

    }

    public function render()
    {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('services', [
			'class' => [
                'wgl-services-3',
                'a'.$settings[ 'alignment' ]
            ],
        ]);

        $this->add_render_attribute('image', [
			'class' => 'wgl-services_image',
            'src' => isset($settings['service_image']['url']) ? esc_url($settings['service_image']['url']) : '',
            'alt' => Control_Media::get_image_alt( $settings['service_image'] ),
        ]);

        $this->add_render_attribute('item_link', 'class', 'wgl-services_link');

        if (!empty($settings['item_link']['url'])) {
            $this->add_link_attributes('item_link', $settings['item_link']);
        }

        ?>
        <div <?php echo $this->get_render_attribute_string('services'); ?>>
            <div class="wgl-services_wrap"><?php
                if (!empty($settings[ 'service_image' ])) {?>
                    <div class="wgl-services_image-wrap"><img <?php echo $this->get_render_attribute_string( 'image' ); ?> /></div><?php
                }
                if (!empty($settings[ 'services_title' ])) {?>
                    <div class="wgl-services_title-wrap"><?php
                        if ($settings[ 'service_link' ] == 'title') {?>
                            <a <?php echo $this->get_render_attribute_string('item_link'); ?>><?php
                        }?>
                            <<?php echo $settings[ 'title_tag' ]; ?> class="wgl-services_title"><?php echo $settings[ 'services_title' ];?></<?php echo $settings[ 'title_tag' ]; ?>><?php
                        if ($settings[ 'service_link' ] == 'title') {?>
                            </a><?php
                        }?>
                    </div><?php
                }
                if ($settings[ 'service_link' ] == 'whole') {?>
                    <a <?php echo $this->get_render_attribute_string( 'item_link' ); ?>></a><?php
                }?>
            </div>
        </div>

        <?php     
    }
    
}