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
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use Elementor\Group_Control_Css_Filter;


defined( 'ABSPATH' ) || exit; // Abort, if called directly.

class Wgl_Video_Popup extends Widget_Base {

	public function get_name() {
		return 'wgl-video-popup';
	}

	public function get_title() {
		return esc_html__('WGL Video Popup', 'irecco-core');
	}

	public function get_icon() {
		return 'wgl-video-popup';
	}

	public function get_categories() {
		return [ 'wgl-extensions' ];
	}


	protected function _register_controls() {
		$primary_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-primary-color'));
		$main_font_color = esc_attr(\iRecco_Theme_Helper::get_option('main-font')['color']);
		$h_font_color = esc_attr(\iRecco_Theme_Helper::get_option('header-font')['color']);

		/*-----------------------------------------------------------------------------------*/
		/*  Content
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'wgl_video_popup_section',
			[
				'label' => esc_html__('Video Popup Settings', 'irecco-core'),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'irecco-core'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__('Subtitle', 'irecco-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Play', 'irecco-core'),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__('Video Link', 'irecco-core'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter your URL', 'irecco-core'),
				'description' => esc_html__('Enter video link from youtube or vimeo.', 'irecco-core'),
				'default' => 'https://www.youtube.com/watch?v=TKnufs85hXk',
				'label_block' => true,
				'separator' => 'after',
			]
		);

		$this->add_control(
			'title_pos',
			[
				'label' => esc_html__('Title Position', 'irecco-core'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => esc_html__('Top', 'irecco-core'),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => esc_html__('Right', 'irecco-core'),
						'icon' => 'eicon-h-align-right',
					],
					'bot' => [
						'title' => esc_html__('Bottom', 'irecco-core'),
						'icon' => 'eicon-v-align-bottom',
					],
					'left' => [
						'title' => esc_html__('Left', 'irecco-core'),
						'icon' => 'eicon-h-align-left',
					],
				],
				'label_block' => false,
				'default' => 'bot',
				'toggle' => true,
			]
		);

		$this->add_responsive_control(
			'button_pos',
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
					'inline' => [
						'title' => esc_html__('Inline', 'irecco-core'),
						'icon' => 'eicon-h-align-stretch',
					],
				],
				'default' => 'center',
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label' => esc_html__('Background Image', 'irecco-core'),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'description' => esc_html__('Select video background image.', 'irecco-core'),
				'separator' => 'after',
			]
		);

		$this->add_control(
			'animation_style',
			[
				'label' => esc_html__('Animation Style', 'irecco-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__('No animation', 'irecco-core'),
					'ring_static' => esc_html__('Static Ring', 'irecco-core'),
					'ring_pulse' => esc_html__('Pulsing Ring', 'irecco-core'),
					'ring_rotate' => esc_html__('Rotating Ring', 'irecco-core'),
					'circles' => esc_html__('Divergent Rings', 'irecco-core'),
				],
				'default' => '',
			]
		);

		$this->add_control(
			'anim_color',
			[
				'label' => esc_html__('Animation Element Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'condition' => [ 'animation_style!' => '' ],
				'default' => $primary_color,
				'selectors' => [
					'{{WRAPPER}} .videobox_animation' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'always_run_animation',
			[
				'label' => esc_html__('Always Run Animation', 'irecco-core'),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [ 'animation_style!' => ['', 'ring_static'] ],
				'label_on' => esc_html__('On', 'irecco-core'),
				'label_off' => esc_html__('Off', 'irecco-core'),
				'description'  => esc_html__('Run until hover state.', 'irecco-core'),
			]
		);

		$this->end_controls_section();


		/*-----------------------------------------------------------------------------------*/
		/*  Styles options
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__('Title', 'irecco-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 'title!' => '' ],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Margin', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'selector' => '{{WRAPPER}} .title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => $h_font_color,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_bg_color',
			[
				'label' => esc_html__('Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title' => 'background-color: {{VALUE}};',
				],
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

		$this->end_controls_section();


		$this->start_controls_section(
			'subtitle_style',
			[
				'label' => esc_html__('Subitle', 'irecco-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 'subtitle!' => '' ],
			]
		);

		$this->add_responsive_control(
			'subtitle_padding',
			[
				'label' => esc_html__('Padding', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => 25,
					'right' => 0,
					'bottom' => 25,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typo',
				'selector' => '{{WRAPPER}} .subtitle',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'subtitle_tag',
			[
				'label' => esc_html__('Subtitle Tag', 'irecco-core'),
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
				'default' => 'div',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__('Button', 'irecco-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' => esc_html__('Margin', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .videobox_link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_size',
			[
				'label' => esc_html__('Button Size', 'irecco-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => ['max' => 200],
				],
				'size_units' => [ 'px' ],
				'default' => [
					'size' => 70,
					'unit' => 'px',
				],
				'description' => esc_html__('Button diameter in pixels.', 'irecco-core'),
				'selectors' => [
					'{{WRAPPER}} .videobox_link' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
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
					'{{WRAPPER}} .videobox_link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'name' => 'bg_color',
				'label' => esc_html__('Button Background', 'irecco-core'),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .videobox_link',
				'fields_options' => [
					'background' => [ 'default' => 'classic' ],
					'color' => [ 'default' => $primary_color ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => esc_html__('Border Type', 'irecco-core'),
				'selector' => '{{WRAPPER}} .videobox_link',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_shadow',
				'selector' =>  '{{WRAPPER}} .videobox_link',
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
				'name' => 'bg_color_hover',
				'label' => esc_html__('Button Background', 'irecco-core'),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .videobox_link:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border_hover',
				'label' => esc_html__('Border Type', 'irecco-core'),
				'selector' => '{{WRAPPER}} .videobox_link:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_shadow_hover',
				'selector' =>  '{{WRAPPER}} .videobox_link:hover',
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

		$this->add_control(
			'triangle_size',
			[
				'label' => esc_html__('Triangle Size', 'irecco-core'),
				'type' => Controls_Manager::SLIDER,
				'separator' => 'before',
				'range' => [
					'px' => ['max' => 100],
				],
				'size_units' => [ 'px', '%' ],
				'default' => ['size' => 0, 'unit' => '%'],
				'selectors' => [
					'{{WRAPPER}} .videobox_icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'triangle_color',
			[
				'label' => esc_html__('Triangle Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .videobox_icon' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'triangle_corners',
			[
				'label' => esc_html__('Triangle Rounded Corners', 'irecco-core'),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'after',
				'label_on' => esc_html__('On', 'irecco-core'),
				'label_off' => esc_html__('Off', 'irecco-core'),
				'return_value' => 'yes',
			]
		);

		$this->end_controls_section();

	}

	protected function render()
	{
		// Enqueue swipebox script
		wp_enqueue_script('swipebox', get_template_directory_uri() . '/js/swipebox/js/jquery.swipebox.min.js', [], false, false);
		wp_enqueue_style('swipebox', get_template_directory_uri() . '/js/swipebox/css/swipebox.min.css');

		$_s = $this->get_settings_for_display();
		$triangle_svg = $animated_element = '';

		$this->add_render_attribute(
			'video-wrap',
			[
				'class' => [
					'wgl-video_popup',
					'button_align-'.$_s[ 'button_pos' ],
					$_s[ 'animation_style' ] ? 'animation_' . $_s[ 'animation_style' ] : '',
					'title_pos-'.$_s[ 'title_pos' ],
					!empty($_s['bg_image']['url']) ? 'with_image' : '',
					$_s[ 'always_run_animation' ] ? 'always-run-animation' : '',
				],
			]
		);

		// Animation element
		switch ($_s[ 'animation_style' ]) {
			case 'circles':
				$animated_element .= '<div class="videobox_animation circle_1"></div>';
				$animated_element .= '<div class="videobox_animation circle_2"></div>';
				$animated_element .= '<div class="videobox_animation circle_3"></div>';
				break;
			case 'ring_pulse':
			case 'ring_static':
				$animated_element .= '<div class="videobox_animation"></div>';
				break;
			case 'ring_rotate':
				$svg_ring_circle_color = !empty($_s[ 'anim_color' ]) ? 'rgba('.\iRecco_Theme_Helper::HexToRGB($_s[ 'anim_color' ]).', 0.1)' : 'rgba(0,0,0,0.1)';
				$svg_ring = '<svg class="ring_1" viewBox="0 0 202 202">';
					$svg_ring .= '<g fill="none" stroke-width="1">';
						$svg_ring .= '<circle stroke="'.$svg_ring_circle_color.'" cx="101" cy="101" r="100"/>';
						$svg_ring .= '<path stroke="'.esc_attr($_s[ 'anim_color' ]).'" d="M74,197.3c-33.5-9.4-59.9-35.8-69.3-69.2"/>';
						$svg_ring .= '<path stroke="'.esc_attr($_s[ 'anim_color' ]).'" d="M128,4.7c33.5,9.4,59.9,35.8,69.3,69.3"/>';
					$svg_ring .= '</g>';
					$svg_ring .= '</svg>';
				$animated_element .= '<div class="videobox_animation">';
				$animated_element .= $svg_ring;
				$animated_element .= '</div>';
				break;
		}

		// Triangle svg
		switch ($_s[ 'triangle_corners' ]) {
			case false:
				$triangle_svg .= '<svg class="videobox_icon" viewBox="0 0 10 10"><polygon points="1,0 1,10 8.5,5"/></svg>';
				break;
			case true:
				$triangle_svg .= '<svg class="videobox_icon" viewBox="0 0 232 232"><path d="M203,99L49,2.3c-4.5-2.7-10.2-2.2-14.5-2.2 c-17.1,0-17,13-17,16.6v199c0,2.8-0.07,16.6,17,16.6c4.3,0,10,0.4,14.5-2.2 l154-97c12.7-7.5,10.5-16.5,10.5-16.5S216,107,204,100z"/></svg>';
				break;
		}

		// Render html
		$uniqrel = uniqid();

		$output = '<div '.($this->get_render_attribute_string( 'video-wrap' )).'>';
			$output .= '<div class="videobox_content">';
				$output .= !empty($_s['bg_image']['url']) ? '<div class="videobox_background">'.wp_get_attachment_image( $_s[ 'bg_image' ][ 'id' ] , 'full' ).'</div>' : '';
				$output .= !empty($_s['bg_image']['url']) ? '<div class="videobox_link_wrapper">' : '';
				$output .= !empty($_s[ 'title' ]) ? '<'.$_s[ 'title_tag' ].' class="title">'.esc_html__($_s[ 'title' ]).'</'.$_s[ 'title_tag' ].'>' : '';
				$output .= '<a data-rel="youtube-'.esc_attr($uniqrel).'" class="videobox_link videobox" href="'.(!empty($_s[ 'link' ]) ? esc_url($_s[ 'link' ]) : '#').'">';
					$output .= !empty($_s[ 'subtitle' ]) ? '<'.$_s[ 'subtitle_tag' ].' class="subtitle">'.esc_html__($_s[ 'subtitle' ]).'</'.$_s[ 'subtitle_tag' ].'>' : '';
					$output .= $triangle_svg;
					$output .= $animated_element;
				$output .= '</a>';
				$output .= !empty($_s['bg_image']['url']) ? '</div>' : '';
			$output .= '</div>';
		$output .= '</div>';

		echo \iRecco_Theme_Helper::render_html($output);

	}

}