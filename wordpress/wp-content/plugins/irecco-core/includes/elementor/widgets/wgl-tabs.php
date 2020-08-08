<?php

namespace WglAddons\Widgets;

defined( 'ABSPATH' ) || exit; // Abort, if called directly.

use WglAddons\Includes\Wgl_Icons;
use WglAddons\Includes\Wgl_Elementor_Helper;
use WglAddons\Templates\WglToggleAccordion;
use Elementor\Frontend;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;


class Wgl_Tabs extends Widget_Base {
	
	public function get_name() {
		return 'wgl-tabs';
	}

	public function get_title() {
		return esc_html__('WGL Tabs', 'irecco-core');
	}

	public function get_icon() {
		return 'wgl-tabs';
	}

	public function get_categories() {
		return [ 'wgl-extensions' ];
	}

	protected function _register_controls() {
		$primary_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-primary-color'));
		$secondary_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-secondary-color'));
		$h_font_color = esc_attr(\iRecco_Theme_Helper::get_option('header-font')['color']);
		$main_font_color = esc_attr(\iRecco_Theme_Helper::get_option('main-font')['color']);


		/*-----------------------------------------------------------------------------------*/
		/*  CONTENT -> GENERAL
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'section_content_general',
			[ 'label' => esc_html__('General', 'irecco-core') ]
		);

		$this->add_responsive_control('tabs_tab_align',
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
					'justify' => [
						'title' => esc_html__('Justified', 'irecco-core'),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'left',
			]
		);
		
		$this->add_responsive_control(
			'tabs_section_margin',
			[
				'label' => esc_html__('Margin', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		/*-----------------------------------------------------------------------------------*/
		/*  CONTENT -> CONTENT
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'section_content_content',
			[ 'label' => esc_html__('Content', 'irecco-core') ]
		);

		$this->add_control(
			'tabs_tab',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'tabs_tab_title' => esc_html__('Tab Title 1', 'irecco-core') ],
					[ 'tabs_tab_title' => esc_html__('Tab Title 2', 'irecco-core') ],
					[ 'tabs_tab_title' => esc_html__('Tab Title 3', 'irecco-core') ],
				],
				'fields' => [
					[
						'name' => 'tabs_tab_title',
						'label' => esc_html__('Tab Title', 'irecco-core'),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__('Tab Title', 'irecco-core'),
					],
					[
						'name' => 'tabs_tab_icon_type',
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
					],
					[
						'name' => 'tabs_tab_icon_pack',
						'label' => esc_html__('Icon Pack', 'irecco-core'),
						'type' => Controls_Manager::SELECT,
						'condition' => [ 'tabs_tab_icon_type' => 'font' ],
						'options' => [
							'fontawesome' => esc_html__('Fontawesome', 'irecco-core'), 
							'flaticon' => esc_html__('Flaticon', 'irecco-core'),
						],
						'default' => 'fontawesome',
					],
					[
						'name' => 'tabs_tab_icon_flaticon',
						'label' => esc_html__('Icon', 'irecco-core'),
						'type' => 'wgl-icon',
						'label_block' => true,
						'condition' => [
							'tabs_tab_icon_pack'  => 'flaticon',
							'tabs_tab_icon_type'  => 'font',
						],
						'description' => esc_html__('Select icon from Flaticon library.', 'irecco-core'),
					],
					[
						'name' => 'tabs_tab_icon_fontawesome',
						'label' => esc_html__('Icon', 'irecco-core'),
						'type' => Controls_Manager::ICON,
						'label_block' => true,
						'condition' => [
							'tabs_tab_icon_pack'  => 'fontawesome',
							'tabs_tab_icon_type'  => 'font',
						],
						'description' => esc_html__('Select icon from Fontawesome library.', 'irecco-core'),
					],
					[
						'name' => 'tabs_tab_icon_thumbnail',
						'label' => esc_html__('Image', 'irecco-core'),
						'type' => Controls_Manager::MEDIA,
						'label_block' => true,
						'condition' => [ 'tabs_tab_icon_type' => 'image' ],
						'default' => [ 'url' => Utils::get_placeholder_image_src() ],
					],
					[
						'name' => 'tabs_content_type',
						'label' => esc_html__('Content Type', 'irecco-core'),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'content' => esc_html__('Content', 'irecco-core'),
							'template' => esc_html__('Saved Templates', 'irecco-core'),
						],
						'default' => 'content',
					],
					[
						'name' => 'tabs_content_templates',
						'label' => esc_html__('Choose Template', 'irecco-core'),
						'type' => Controls_Manager::SELECT,
						'condition' => [ 'tabs_content_type' => 'template' ],
						'options' => Wgl_Elementor_Helper::get_instance()->get_elementor_templates(),
					],
					[
						'name' => 'tabs_content',
						'label' => esc_html__('Tab Content', 'irecco-core'),
						'type' => Controls_Manager::WYSIWYG,
						'condition' => [ 'tabs_content_type' => 'content' ],
						'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'irecco-core'),
					],
				],
				'title_field' => '{{tabs_tab_title}}',
			]
		);

		$this->end_controls_section();


		/*-----------------------------------------------------------------------------------*/
		/*  STYLE -> TITLE
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__('Title', 'irecco-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tabs_title_typo',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wgl-tabs_title',
			]
		);

		$this->add_control(
			'tabs_title_tag',
			[
				'label' => esc_html__('Title HTML Tag', 'irecco-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
				],
				'default' => 'h4',
			]
		);

		$this->add_responsive_control(
			'tabs_title_padding',
			[
				'label' => esc_html__('Padding', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
				    'top' => 18,
				    'right' => 0,
				    'bottom' => 18,
				    'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tabs_title_margin',
			[
				'label' => esc_html__('Margin', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => 0,
					'right' => 64,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tabs_title_line',
			[
				'label' => esc_html__('Add Title Bottom Line', 'irecco-core'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'return_value' => 'yes',
			]
		);

		
		$this->start_controls_tabs( 'tabs_header_tabs' );
	
		$this->start_controls_tab(
			'tabs_header_idle',
			[ 'label' => esc_html__('Idle', 'irecco-core') ]
		);

		$this->add_control(
			't_title_color_idle',
			[
				'label' => esc_html__('Title Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => $h_font_color,
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_header' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			't_title_bg_color_idle',
			[
				'label' => esc_html__('Title Background Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_header' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			't_title_border_radius_idle',
			[
				'label' => esc_html__('Border Radius', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tabs_title_border',
				'selector' => '{{WRAPPER}} .wgl-tabs_header',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_header_hover',
			[ 'label' => esc_html__('Hover', 'irecco-core') ]
		);

		$this->add_control(
			't_title_color_hover',
			[
				'label' => esc_html__('Title Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => $h_font_color,
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_header:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			't_title_bg_color_hover',
			[
				'label' => esc_html__('Title Background Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_header:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			't_title_line_color_hover',
			[
				'label' => esc_html__('Title Bottom Line Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'condition' => [ 'tabs_title_line' => 'yes' ],
				'default' => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_header:hover:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			't_title_border_radius_hover',
			[
				'label' => esc_html__('Border Radius', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_header:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 't_title_border_hover',
				'selector' => '{{WRAPPER}} .wgl-tabs_header:hover',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			't_header_active',
			[ 'label' => esc_html__('Active', 'irecco-core') ]
		);

		$this->add_control(
			't_title_color_active',
			[
				'label' => esc_html__('Title Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => $h_font_color,
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_header.active' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			't_title_bg_color_active',
			[
				'label' => esc_html__('Title Background Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_header.active' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			't_title_line_color_active',
			[
				'label' => esc_html__('Title Bottom Line Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'condition' => [ 'tabs_title_line' => 'yes' ],
				'default' => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_header.active:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			't_title_border_radius_active',
			[
				'label' => esc_html__('Border Radius', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_header.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 't_title_border_active',
				'selector' => '{{WRAPPER}} .wgl-tabs_header.active',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section(); 


		/*-----------------------------------------------------------------------------------*/
		/*  STYLE -> ICON
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__('Icon', 'irecco-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'tabs_icon_size',
			[
				'label' => esc_html__('Icon Size', 'irecco-core'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 26,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_icon:not(.wgl-tabs_icon-image)' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tabs_icon_position',
			[
				'label' => esc_html__('Icon/Image Position', 'irecco-core'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => esc_html__('Top', 'irecco-core'), 
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => esc_html__('Right', 'irecco-core'),
						'icon' => 'eicon-h-align-right',
					],
					'bottom' => [
						'title' => esc_html__('Bottom', 'irecco-core'),
						'icon' => 'eicon-v-align-bottom',
					],
					'left' => [
						'title' => esc_html__('Left', 'irecco-core'),
						'icon' => 'eicon-h-align-left',
					]
				],
				'default' => 'top',
			]
		);

		$this->add_responsive_control(
			'tabs_icon_margin',
			[
				'label' => esc_html__('Margin', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->start_controls_tabs( 'tabs_icon_tabs' );
	 
		$this->start_controls_tab(
			'tabs_icon_idle',
			[ 'label' => esc_html__('Idle', 'irecco-core') ]
		);

		$this->add_control(
			'tabs_icon_color',
			[
				'label' => esc_html__('Icon Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_icon_hover',
			[ 'label' => esc_html__('Hover', 'irecco-core') ]
		);

		$this->add_control(
			'tabs_icon_color_hover',
			[
				'label' => esc_html__('Icon Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_header:hover .wgl-tabs_icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_icon_active',
			[ 'label' => esc_html__('Active', 'irecco-core') ]
		);

		$this->add_control(
			'tabs_icon_color_active',
			[
				'label' => esc_html__('Icon Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_header.active .wgl-tabs_icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section(); 


		/*-----------------------------------------------------------------------------------*/
		/*  STYLE -> CONTENT
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'irecco-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tabs_content_typo',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wgl-tabs_content',
			]
		);

		$this->add_responsive_control(
			'tabs_content_padding',
			[
				'label' => esc_html__('Padding', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => 29,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tabs_content_margin',
			[
				'label' => esc_html__('Margin', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tabs_content_color',
			[
				'label' => esc_html__('Content Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => $main_font_color,
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tabs_content_bg_color',
			[
				'label' => esc_html__('Content Background Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_content' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tabs_content_border_radius',
			[
				'label' => esc_html__('Border Radius', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wgl-tabs_content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tabs_content_border',
				'selector' => '{{WRAPPER}} .wgl-tabs_content',
			]
		);

		$this->end_controls_section(); 

	}

	protected function render() {
		
		$_s = $this->get_settings_for_display();
		$id_int = substr( $this->get_id_int(), 0, 3 );

		$this->add_render_attribute(
			'tabs',
			[
				'class' => [
					'wgl-tabs',
					'icon_position-'.$_s[ 'tabs_icon_position' ],
					'tabs_align-'.$_s[ 'tabs_tab_align' ],
				],
			]
		);

		?>
		<div <?php echo $this->get_render_attribute_string( 'tabs' ); ?>>

			<div class="wgl-tabs_headings"><?php
				foreach ( $_s[ 'tabs_tab' ] as $index => $item ) :

					$tab_count = $index + 1;
					$tab_title_key = $this->get_repeater_setting_key( 'tabs_tab_title', 'tabs_tab', $index );
					$this->add_render_attribute(
						$tab_title_key,
						[
							'data-tab-id' => 'wgl-tab_' . $id_int . $tab_count,
							'class' => [ 'wgl-tabs_header' ],
						]
					);

					?>
					<<?php echo $_s[ 'tabs_title_tag' ]; ?> <?php echo $this->get_render_attribute_string( $tab_title_key ); ?>>
						<span class="wgl-tabs_title"><?php echo $item[ 'tabs_tab_title' ] ?></span>

						<?php 
						// Tab Icon/image
						if ( $item[ 'tabs_tab_icon_type' ] != '' ) {
							if ( $item[ 'tabs_tab_icon_type' ] == 'font' && (!empty( $item['tabs_tab_icon_flaticon'] ) || !empty( $item[ 'tabs_tab_icon_fontawesome' ] )) ) {
								switch ( $item[ 'tabs_tab_icon_pack' ] ) {
									case 'fontawesome':
										wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
										$icon_font = $item[ 'tabs_tab_icon_fontawesome' ];
										break;
									case 'flaticon':
										wp_enqueue_style('flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
										$icon_font = $item[ 'tabs_tab_icon_flaticon' ];
										break;
								}
								?>
								<span class="wgl-tabs_icon">
									<i class="icon <?php echo esc_attr( $icon_font) ?>"></i>
								</span>
								<?php
							}
							if (
								$item['tabs_tab_icon_type'] == 'image'
								&& !empty($item['tabs_tab_icon_thumbnail'])
								&& !empty($item['tabs_tab_icon_thumbnail']['url'])
							) {
								$this->add_render_attribute('thumbnail', 'src', $item['tabs_tab_icon_thumbnail']['url']);
								$this->add_render_attribute('thumbnail', 'alt', Control_Media::get_image_alt($item['tabs_tab_icon_thumbnail' ]));
								$this->add_render_attribute('thumbnail', 'title', Control_Media::get_image_title($item['tabs_tab_icon_thumbnail']));
								?>
								<span class="wgl-tabs_icon wgl-tabs_icon-image">
								<?php
									echo Group_Control_Image_Size::get_attachment_image_html($item, 'thumbnail', 'tabs_tab_icon_thumbnail');
								?>
								</span>
								<?php
							}
						}
						// End Tab Icon/image
						?>

					</<?php echo $_s[ 'tabs_title_tag' ]; ?>>

				<?php endforeach;?>
			</div>

			<div class="wgl-tabs_content-wrap"><?php 
				foreach ( $_s[ 'tabs_tab' ] as $index => $item ) :

					$tab_count = $index + 1;
					$tab_content_key = $this->get_repeater_setting_key( 'tab_content', 'tabs_tab', $index );
					$this->add_render_attribute(
						$tab_content_key,
						[
							'data-tab-id' => 'wgl-tab_' . $id_int . $tab_count,
							'class' => [ 'wgl-tabs_content' ],
						]
					);

					?>
					<div <?php echo $this->get_render_attribute_string( $tab_content_key ); ?>>
					<?php
						if ( $item[ 'tabs_content_type' ] == 'content' ) {
							echo do_shortcode( $item[ 'tabs_content' ] );
						} else if ( $item[ 'tabs_content_type' ] == 'template' ) {
							$id = $item[ 'tabs_content_templates' ];
							$wgl_frontend = new Frontend;
							echo $wgl_frontend->get_builder_content_for_display( $id, false );
						}
					?>
					</div>

				<?php endforeach; ?>
			</div>
			
		</div>
		<?php

	}
	
}