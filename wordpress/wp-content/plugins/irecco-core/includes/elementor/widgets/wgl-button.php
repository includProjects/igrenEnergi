<?php

namespace WglAddons\Widgets;

defined( 'ABSPATH' ) || exit; // Abort, if called directly.

use WglAddons\Includes\Wgl_Icons;
use WglAddons\Includes\Wgl_Loop_Settings;
use WglAddons\Includes\Wgl_Carousel_Settings;
use WglAddons\Templates\WglButton;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;


class Wgl_Button extends Widget_Base
{
	
	public function get_name() {
		return 'wgl-button';
	}

	public function get_title() {
		return esc_html__('WGL Button', 'irecco-core');
	}

	public function get_icon() {
		return 'wgl-button';
	}

	public function get_categories() {
		return [ 'wgl-extensions' ];
	}

	public static function get_button_sizes()
	{
		return [
			'sm' => esc_html__('Small', 'irecco-core'),
			'md' => esc_html__('Medium', 'irecco-core'),
			'lg' => esc_html__('Large', 'irecco-core'),
			'xl' => esc_html__('Extra Large', 'irecco-core'),
			'rd' => esc_html__('Round', 'irecco-core'),
		];
	}
	

	protected function _register_controls()
	{
		$primary_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-primary-color'));
		$secondary_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-secondary-color'));
		$h_font_color = esc_attr(\iRecco_Theme_Helper::get_option('header-font')['color']);
		$main_font_color = esc_attr(\iRecco_Theme_Helper::get_option('main-font')['color']);


		/*-----------------------------------------------------------------------------------*/
		/*  CONTENT -> GENERAL
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'wgl_button_section',
			[ 'label' => esc_html__('General', 'irecco-core') ]
		);

		$this->add_control(
			'text',
			[
				'label' => esc_html__('Text', 'irecco-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Learn More', 'irecco-core'),
				'placeholder' => esc_html__('Learn More', 'irecco-core'),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__('Link', 'irecco-core'),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'irecco-core'),
				'default' => [ 'url' => '#' ],
			]
		);

		$this->add_responsive_control(
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
					'justify' => [
						'title' => esc_html__('Justified', 'irecco-core'),
						'icon' => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default' => '',
			]
		);

		$this->add_control(
			'size',
			[
				'label' => esc_html__('Size', 'irecco-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'lg',
				'options' => self::get_button_sizes(),
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'button_css_id',
			[
				'label' => esc_html__('Button ID', 'irecco-core'),
				'type' => Controls_Manager::TEXT,
				'title' => esc_html__('Add your custom id WITHOUT the Pound key. e.g: my-id', 'irecco-core'),
				'separator' => 'before',
				'label_block' => false,
				'default' => '',
				'description' => esc_html__('Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows [A-z _ 0-9] chars without spaces.', 'irecco-core'),
			]
		);

		$this->end_controls_section();

		$output[ 'icon_align' ] = [
			'label' => esc_html__('Icon Position', 'irecco-core'),
			'type' => Controls_Manager::SELECT,
			'condition' => [ 'icon_type!' => '' ],
			'options' => [
				'left' => esc_html__('Before', 'irecco-core'),
				'right' => esc_html__('After', 'irecco-core'),
			],
			'default' => 'left',
		];

		$output[ 'icon_indent' ] = [
			'label' => esc_html__('Icon Spacing', 'irecco-core'),
			'type' => Controls_Manager::SLIDER,
			'condition' => [ 'icon_type!' => '' ],
			'range' => [
				'px' => [ 'max' => 50 ],
			],
			'default' => [ 'size' => '0', 'unit' => 'px' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-button .elementor-align-icon-right .elementor-button-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .elementor-button .elementor-align-icon-left .elementor-button-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
			],
		];

		Wgl_Icons::init(
			$this,
			[
				'output' => $output,
				'section' => true,
			]
		);


		/*-----------------------------------------------------------------------------------*/
        /*  STYLE -> BUTTON
        /*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__('Button', 'irecco-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'button_size',
            [
                'label' => esc_html__('Button Diameter', 'irecco-core'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [ 'size' => 'rd' ],
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [ 'max' => 200 ],
                ],
                'default' => [ 'size' => 70, 'unit' => 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .button-size-rd' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		
		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__('Hover Animation', 'irecco-core'),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_idle',
			[ 'label' => esc_html__('Idle', 'irecco-core') ]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__('Text Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__('Background Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
                'condition' => [ 'size!' => 'rd' ],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => $secondary_color,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' => esc_html__('Border Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'condition' => [ 'border_border!' => '' ],
				'default' => $primary_color,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_rd_background_color',
			[
				'label' => esc_html__('Background Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
                'condition' => [ 'size' => 'rd' ], 
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => $primary_color,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_circle_color',
			[
				'label' => esc_html__('Сircle Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
                'condition' => [ 'size' => 'rd' ], 
				'default' => 'rgba(214,214,214,0.5)',
				'selectors' => [
					'{{WRAPPER}} .size-rd__circle' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[ 'label' => esc_html__('Hover', 'irecco-core') ]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__('Text Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} a.elementor-button:not(.button-size-rd):hover, {{WRAPPER}} .elementor-button:not(.button-size-rd):hover, {{WRAPPER}} a.elementor-button:not(.button-size-rd):focus, {{WRAPPER}} .elementor-button:not(.button-size-rd):focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-button.button-size-rd .button-content-wrapper:hover, {{WRAPPER}} .elementor-button.button-size-rd .button-content-wrapper:hover, {{WRAPPER}} a.elementor-button .button-content-wrapper:focus, {{WRAPPER}} .elementor-button .button-content-wrapper:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => esc_html__('Background Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => $primary_color,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button:not(.button-size-rd):hover, {{WRAPPER}} .elementor-button:not(.button-size-rd):hover, {{WRAPPER}} a.elementor-button:not(.button-size-rd):focus, {{WRAPPER}} .elementor-button:not(.button-size-rd):focus' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} a.elementor-button.button-size-rd .button-content-wrapper:hover, {{WRAPPER}} .elementor-button.button-size-rd .button-content-wrapper:hover, {{WRAPPER}} a.elementor-button.button-size-rd .button-content-wrapper:focus, {{WRAPPER}} .elementor-button.button-size-rd .button-content-wrapper:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__('Border Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'condition' => [ 'border_border!' => '' ],
				'default' => $primary_color,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button:not(.button-size-rd):hover, {{WRAPPER}} .elementor-button:not(.button-size-rd):hover, {{WRAPPER}} a.elementor-button:not(.button-size-rd):focus, {{WRAPPER}} .elementor-button:not(.button-size-rd):focus' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} a.elementor-button.button-size-rd .button-content-wrapper:hover, {{WRAPPER}} .elementor-button.button-size-rd .button-content-wrapper:hover, {{WRAPPER}} a.elementor-button.button-size-rd .button-content-wrapper:focus, {{WRAPPER}} .elementor-button.button-size-rd .button-content-wrapper:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-button:not(.button-size-rd):hover, {{WRAPPER}} .elementor-button.button-size-rd .button-content-wrapper:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .elementor-button',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
                'condition' => [ 'size!' => 'rd' ],
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom'=> 0,
					'left'  => 0,
					'unit'  => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_rd_border_radius',
			[
				'label' => esc_html__('Border Radius', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
                'condition' => [ 'size' => 'rd' ],
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 50,
					'right' => 50,
					'bottom'=> 50,
					'left'  => 50,
					'unit'  => '%',
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' => esc_html__('Padding', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
                'condition' => [ 'size!' => 'rd' ],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'text_rd_padding',
			[
				'label' => esc_html__('Padding', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
                'condition' => [ 'size' => 'rd' ],
				'separator' => 'before',
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wgl-button .button-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		/*-----------------------------------------------------------------------------------*/
        /*  STYLE -> ICON
        /*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'icon_section_style',
			[
				'label' => esc_html__('Icon', 'irecco-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__('Margin', 'irecco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style_icon' );

		$this->start_controls_tab(
			'tab_button_normal_icon',
			[ 'label' => esc_html__('Idle', 'irecco-core') ]
		);

		$this->add_control(
			'color_icon',
			[
				'label' => esc_html__('Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover_icon',
			[ 'label' => esc_html__('Hover', 'irecco-core') ]
		);

		$this->add_control(
			'hover_color_icon',
			[
				'label' => esc_html__('Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .elementor-button:hover .elementor-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__('Font Size', 'irecco-core'),
				'type' => Controls_Manager::SLIDER,
				'condition' => [ 'icon_type' => 'font' ],
				'separator' => 'before',
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [ 'max' => 90 ],
				],
				'default' => [ 'size' => '13', 'unit' => 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}
	
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		
		echo Wgl_Button::init_button($this, $settings);
	}

	public static function init_button($self, $settings)
	{
		$self->add_render_attribute('wrapper', 'class', 'elementor-button-wrapper');

		if (!empty($settings['link']['url'])) {
			$self->add_render_attribute('button', 'class', 'elementor-button-link');
			$self->add_link_attributes('button', $settings['link']);
		}

		$self->add_render_attribute('button', 'class', 'wgl-button elementor-button');
		$self->add_render_attribute('button', 'role', 'button');

		if (!empty($settings['button_css_id'])) {
			$self->add_render_attribute('button', 'id', $settings['button_css_id']);
		}

		if (!empty($settings['size'])) {
			$self->add_render_attribute('button', 'class', 'button-size-' . $settings['size']);
		}

		if (isset($settings['hover_animation']) && !empty($settings['hover_animation'])) {
			$self->add_render_attribute('button', 'class', 'elementor-animation-' . $settings['hover_animation']);
		}

		$settings_icon_align = isset($settings[ 'icon_align' ]) ? 'elementor-align-icon-' . $settings['icon_align'] : '';

		$self->add_render_attribute( [
			'content-wrapper' => [
				'class' => [
					'button-content-wrapper',
					$settings_icon_align,
				]
			],
			'wrapper' => [
				'class' => 'elementor-button-icon',
			],
			'text' => [
				'class' => 'elementor-button-text',
			],
		] );

		?>
		<div <?php echo $self->get_render_attribute_string( 'wrapper' ); ?>>
			<a <?php echo $self->get_render_attribute_string('button'); ?>><?php
			if ( !empty($settings[ 'text' ]) || !empty($settings[ 'icon_type' ]) ) { ?>
				<div <?php echo $self->get_render_attribute_string( 'content-wrapper' ); ?>>
					<?php
					if ( ! empty( $settings[ 'icon_type' ] ) ) :
						$icons = new Wgl_Icons;
						$button_icon_out = $icons->build($self, $settings, []);
						echo \iRecco_Theme_Helper::render_html($button_icon_out);
					endif;
					?>
					<span <?php echo $self->get_render_attribute_string( 'text' ); ?>><?php echo $settings[ 'text' ]; ?></span>
				</div>
				<?php
				if ($settings[ 'size' ] == 'rd') {
					echo '<span class="size-rd__circle"></span>';
				}
			}
			?></a>
		</div>
		<?php

	}
}