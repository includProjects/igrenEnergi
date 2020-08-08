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

class Wgl_Counter extends Widget_Base {
	
	public function get_name() {
		return 'wgl-counter';
	}

	public function get_title() {
		return esc_html__('WGL Counter', 'irecco-core');
	}

	public function get_icon() {
		return 'wgl-counter';
	}

	public function get_categories() {
		return [ 'wgl-extensions' ];
	}

	public function get_script_depends() {
		return [
			'appear',
		];
	}


	protected function _register_controls()
	{
		$theme_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-primary-color'));
		$second_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-secondary-color'));
		$third_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-third-color'));
		$header_font_color = esc_attr(\iRecco_Theme_Helper::get_option('header-font')['color']);
		$main_font_color = esc_attr(\iRecco_Theme_Helper::get_option('main-font')['color']);


		/*-----------------------------------------------------------------------------------*/
		/*  CONTENT -> GENERAL
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'wgl_counter_content',
			[ 'label' => esc_html__('General', 'irecco-core') ]
		);

		Wgl_Icons::init(
			$this,
			[
				'label' => esc_html__('Counter ', 'irecco-core'),
				'output' => '',
				'section' => false,
			]
		);

		$this->add_control(
			'positiont',
			[
				'label' => esc_html__('Position', 'irecco-core'),
				'type' => 'wgl-radio-image',
				'condition' => [ 'icon_type!' => '' ],
				'options' => [
					'top' => [
						'title'=> esc_html__('Top', 'irecco-core'),
						'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_elementor_addon/icons/style_def.png',
					],
					'left' => [
						'title'=> esc_html__('Left', 'irecco-core'),
						'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_elementor_addon/icons/style_left.png',
					],
					'right' => [
						'title'=> esc_html__('Right', 'irecco-core'),
						'image' => WGL_ELEMENTOR_ADDONS_URL . 'assets/img/wgl_elementor_addon/icons/style_right.png',
					],
				],
				'prefix_class' => 'elementor-position-',
				'default' => 'left',
			]
		);

		$this->add_control(
			'start_value',
			[
				'label' => esc_html__('Start Value', 'irecco-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'step' => 10,
				'default' => 0,
				'separator' => 'before'
			]
		); 

		$this->add_control(
			'end_value',
			[
				'label' => esc_html__('End Value', 'irecco-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 10,
				'default' => 120,
			]
		); 

		$this->add_control(
			'prefix',
			[
				'label' => esc_html__('Counter Prefix', 'irecco-core'),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'suffix',
			[
				'label' => esc_html__('Counter Suffix', 'irecco-core'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('+', 'irecco-core'),
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => esc_html__('Animation Speed', 'irecco-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 100,
				'step' => 100,
				'default' => 2000,
			]
		); 

		$this->add_control(
			'counter_title',
			[
				'label' => esc_html__('Title', 'irecco-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('This is the heading​', 'irecco-core'),
			]
		);

		$this->add_control(
			'title_block',
			[
				'label' => esc_html__('Title Display Block', 'irecco-core'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'return_value' => 'yes',
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
			]
		);

		$this->end_controls_section();


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

		$this->add_control(
			'primary_color',
			[
				'label' => esc_html__('Icon Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'condition' => [ 'icon_type' => 'font' ],
				'default' => '#838383',
				'selectors' => [
					'{{WRAPPER}} .wgl-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Icon Size', 'irecco-core'),
				'type' => Controls_Manager::SLIDER,
				'condition' => [ 'icon_type' => 'font' ],
				'range' => [
					'px' => [ 'min' => 16, 'max' => 100 ],
				],
				'default' => [ 'size' => 60, 'unit' => 'px' ],
				'selectors' => [
					'{{WRAPPER}} .wgl-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => esc_html__('Margin', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => 0,
					'right' => 22,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .wgl-counter_media-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__('Padding', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wgl-counter_media-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'counter_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wgl-counter_media-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'media_background',
				'label' => esc_html__('Background', 'irecco-core'),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wgl-counter_media-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'counter_icon_border',
				'selector' => '{{WRAPPER}} .wgl-counter_media-wrap'
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'counter_icon_shadow',
				'selector' => '{{WRAPPER}} .wgl-counter_media-wrap',
			]
		);

		$this->end_controls_section();

		/*-----------------------------------------------------------------------------------*/
		/*  Style Section(Headings Section)
		/*-----------------------------------------------------------------------------------*/    
		$this->start_controls_section(
			'value_style_section',
			[
				'label' => esc_html__('Value', 'irecco-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'value_offset',
			[
				'label' => esc_html__('Value Offset', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .wgl-counter_value-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'custom_fonts_value',
				'selector' => '{{WRAPPER}} .wgl-counter_value-wrap',
			]
		);

		$this->add_control(
			'value_color',
			[
				'label' => esc_html__('Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => $theme_color,
				'selectors' => [
					'{{WRAPPER}} .wgl-counter_value-wrap' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Title Styles
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
				'description' => esc_html__('Choose your tag for counter title', 'irecco-core'),
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
				'default' => [
					'top' => 12,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit'  => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .wgl-counter_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'custom_fonts_title',
				'selector' => '{{WRAPPER}} .wgl-counter_title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => $header_font_color,
				'selectors' => [
					'{{WRAPPER}} .wgl-counter_title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		
		// Item Styles

		$this->start_controls_section(
			'counter_style_section',
			[
				'label' => esc_html__('Item', 'irecco-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'counter_offset',
			[
				'label' => esc_html__('Margin', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wgl-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'counter_padding',
			[
				'label' => esc_html__('Padding', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wgl-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'counter_border_radius',
			[
				'label' => esc_html__('Border Radius', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wgl-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'counter_color_tab' );

		$this->start_controls_tab(
			'custom_counter_color_idle',
			[ 'label' => esc_html__('Idle' , 'irecco-core') ]
		);

		$this->add_control(
			'bg_counter_color',
			[
				'label' => esc_html__('Background Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wgl-counter' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'counter_border',
				'label' => esc_html__('Border Type', 'irecco-core'),
				'selector' => '{{WRAPPER}} .wgl-counter',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'counter_shadow',
				'selector' =>  '{{WRAPPER}} .wgl-counter',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'custom_counter_color_hover',
			[ 'label' => esc_html__('Hover' , 'irecco-core') ]
		);

		$this->add_control(
			'bg_counter_color_hover',
			[
				'label' => esc_html__('Background Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .wgl-counter' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'counter_border_hover',
				'label' => esc_html__('Border Type', 'irecco-core'),
				'selector' => '{{WRAPPER}}:hover .wgl-counter',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'counter_shadow_hover',
				'selector' =>  '{{WRAPPER}}:hover .wgl-counter',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	public function render() {
		
		$_s = $this->get_settings_for_display();

		$this->add_render_attribute( 'counter', [
			'class' => [
				'wgl-counter',
				'a'.$_s[ 'alignment' ],
				$_s[ 'title_block' ] ? 'title-block' : 'title-inline'
			],
		] );

		$this->add_render_attribute( 'counter_value', [
			'class' => [
				'wgl-counter_value',
				'value-placeholder'
			],
			'data-start-value' => $_s[ 'start_value' ],
			'data-end-value' => $_s[ 'end_value' ],
			'data-speed' => $_s[ 'speed' ],
		] );

		// Icon/Image output
		ob_start();
		if (! empty($_s[ 'icon_type' ])) {
			$icons = new Wgl_Icons;
			echo $icons->build($this, $_s, []);
		}
		$counter_media = ob_get_clean();

		?>
		<div <?php echo $this->get_render_attribute_string( 'counter' ); ?>>
			<div class="wgl-counter_wrap"><?php
				if ($_s[ 'icon_type' ] != '') {?>
					<div class="wgl-counter_media-wrap"><?php 
						if (! empty($counter_media)) {
							echo $counter_media;
						}?>
					</div><?php
				}?>
				<div class="wgl-counter_content-wrap">
					<div class="wgl-counter_value-wrap"><?php
						if (! empty($_s[ 'prefix' ])) {?>
							<span class="wgl-counter_prefix"><?php echo $_s[ 'prefix' ];?></span><?php
						}
						if (! empty($_s[ 'end_value' ])) {?>
							<div class="wgl-counter_value-placeholder">
								<span <?php echo $this->get_render_attribute_string( 'counter_value' ); ?>><?php echo $_s[ 'start_value' ];?></span>
								<span class="wgl-counter_value"><?php echo $_s[ 'end_value' ];?></span>
							</div><?php
						}
						if (! empty($_s[ 'suffix' ])) {?>
							<span class="wgl-counter_suffix"><?php echo $_s[ 'suffix' ];?></span><?php
						}?>
					</div>
					<?php
					if (! empty($_s[ 'counter_title' ])) {?>
						<<?php echo $_s[ 'title_tag' ]; ?> class="wgl-counter_title"><?php echo $_s[ 'counter_title' ];?></<?php echo $_s[ 'title_tag' ]; ?>><?php
					}?>
				</div>
			</div>
		</div>

		<?php
	}

}