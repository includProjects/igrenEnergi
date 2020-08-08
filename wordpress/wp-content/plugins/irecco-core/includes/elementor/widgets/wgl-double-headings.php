<?php
namespace WglAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use Elementor\Group_Control_Css_Filter;


defined( 'ABSPATH' ) || exit; // Abort, if called directly.

class Wgl_Double_Headings extends Widget_Base {
	
	public function get_name() {
		return 'wgl-double-headings';
	}

	public function get_title() {
		return esc_html__('WGL Double Headings', 'irecco-core');
	}

	public function get_icon() {
		return 'wgl-double-headings';
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
			'wgl_double_headings_section',
			[ 'label' => esc_html__('General', 'irecco-core') ]
		);

		$this->add_control(
			'sub_pos',
			[
				'label' => esc_html__('Subtitle Position', 'irecco-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'column' => esc_html__('Top', 'irecco-core'),
					'column-reverse' => esc_html__('Bottom', 'irecco-core'),
				],
				'default' => 'column',
				'selectors' => [
					'{{WRAPPER}} .wgl-double_heading' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__('Subtitle', 'irecco-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Subtitle', 'irecco-core'),
				'placeholder' => esc_html__('Subtitle', 'irecco-core'),
				'separator' => 'after',
			]
		);
		
		$this->add_control(
			'title_1',
			[
				'label' => esc_html__('Title', 'irecco-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('This is the heading​', 'irecco-core'),
				'placeholder' => esc_html__('This is the heading​', 'irecco-core'),
			]
		);
		
		$this->add_control(
			'bg_text',
			[
				'label' => esc_html__('Background Text', 'irecco-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Text', 'irecco-core'),
				'placeholder' => esc_html__('Text', 'irecco-core'),
			]
		);

		$this->add_control(
			'title_div',
			[
				'label' => esc_html__('Add Divider before Subtitle', 'irecco-core'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'return_value' => 'yes',
				'prefix_class' => 'divider_',
			]
		);

		$this->add_control(
			'align',
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
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__('Title Tag', 'irecco-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => '‹h1›',
					'h2' => '‹h2›',
					'h3' => '‹h3›',
					'h4' => '‹h4›',
					'h5' => '‹h5›',
					'h6' => '‹h6›',
					'div' => '‹div›',
				],
				'default' => 'h3',
			]
		);
		
		$this->add_control(
			'link',
			[
				'label' => esc_html__('Link', 'irecco-core'),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'irecco-core'),
			]
		);

		$this->end_controls_section();


		/*-----------------------------------------------------------------------------------*/
		/*  STYLES -> GENERAL
		/*-----------------------------------------------------------------------------------*/ 

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__('General', 'irecco-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_1_h',
			[
				'label' => esc_html__('Title', 'irecco-core'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_1_typo',
				'selector' => '{{WRAPPER}} .dbl-title_1',
			]
		);

		$this->add_control(
			'title_1_color',
			[
				'label' => esc_html__('Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => $h_font_color,
				'selectors' => [
					'{{WRAPPER}} .dbl-title_1' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control('title_1_display',
			[
				'label' => esc_html__('Display', 'irecco-core'),
				'type' => Controls_Manager::SELECT,
				'separator' => 'after',
				'options' => [
					'block' => esc_html__('Block', 'irecco-core'),
					'inline' => esc_html__('Inline', 'irecco-core'),
				],
				'default' => 'inline',
				'selectors' => [
					'{{WRAPPER}} .dbl-title_1' => 'display: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'bg_text_h',
			[
				'label' => esc_html__('Background Text', 'irecco-core'),
				'type' => Controls_Manager::HEADING,
				'condition' => [ 'bg_text!'  => '' ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'bg_text_typo',
				'selector' => '{{WRAPPER}} .dbl-bg_text',
				'condition' => [ 'bg_text!'  => '' ],
			]
		);

		$this->add_control(
			'bg_text_color',
			[
				'label' => esc_html__('Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'condition' => [ 'bg_text!'  => '' ],
				'default' => 'rgba(214, 214, 214, 0.5)',
				'selectors' => [
					'{{WRAPPER}} .dbl-bg_text' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control('bg_text_display',
			[
				'label' => esc_html__('Display', 'irecco-core'),
				'type' => Controls_Manager::SELECT,
				'condition' => [ 'bg_text!'  => '' ],
				'separator' => 'after',
				'options' => [
					'block' => esc_html__('Block', 'irecco-core'),
					'inline' => esc_html__('Inline', 'irecco-core'),
				],
				'default' => 'inline',
				'selectors' => [
					'{{WRAPPER}} .dbl-bg_text' => 'display: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'subtitle_h',
			[
				'label' => esc_html__('Subtitle', 'irecco-core'),
				'type' => Controls_Manager::HEADING,
				'condition' => [ 'subtitle!'  => '' ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typo',
				'selector' => '{{WRAPPER}} .dbl-subtitle',
				'condition' => [ 'subtitle!'  => '' ],
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'condition' => [ 'subtitle!'  => '' ],
				'separator' => 'after',
				'default' => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} .dbl-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__('Subtitle Offset', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => 12,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit'  => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .dbl-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render()
	{
		$_s = $this->get_settings_for_display();

		if (!empty($_s['link']['url'])) {
			$this->add_render_attribute('link', 'class', 'dbl-title_link');
			$this->add_link_attributes('link', $_s['link']);
		}

		$this->add_render_attribute('heading_wrapper', 'class', [ 'wgl-double_heading', 'a'.$_s['align'] ]);

		?><div <?php echo $this->get_render_attribute_string( 'heading_wrapper' );?>><?php
			if (! empty($_s['subtitle']) ) : ?><div class="dbl-subtitle"><span><?php echo $_s[ 'subtitle' ]; ?></span></div><?php endif;
			if (! empty($_s['link']['url']) ) : ?><a <?php echo $this->get_render_attribute_string( 'link' );?>><?php endif;?>
				<<?php echo $_s['title_tag']; ?> class="dbl-title_wrapper"><?php
				if (! empty($_s['title_1']) ) : ?><span class="dbl-title dbl-title_1"><?php echo $_s[ 'title_1' ]; ?></span> <?php endif;?>
				</<?php echo $_s['title_tag']; ?>><?php
			if (! empty($_s['link']['url']) ) : ?></a><?php endif;
			if (! empty($_s['bg_text']) ) : ?><span class="dbl-title dbl-bg_text"><?php echo $_s[ 'bg_text' ]; ?></span> <?php endif;?>
		</div><?php

	}
	
}