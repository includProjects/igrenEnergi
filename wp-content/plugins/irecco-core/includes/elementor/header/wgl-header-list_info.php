<?php

namespace WglAddons\Widgets;

defined('ABSPATH') || exit; // Abort, If called directly.

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
use Elementor\Repeater;
use Elementor\Icons_Manager;


class Wgl_Header_List_Info extends Widget_Base {
	
	public function get_name() {
		return 'wgl-header-list-info';
	}

	public function get_title() {
		return esc_html__('WGL Icon + Text', 'irecco-core');
	}

	public function get_icon() {
		return 'wgl-header-list-info';
	}

	public function get_categories() {
		return [ 'wgl-header-modules' ];
	}

	protected function _register_controls()
	{
		$primary_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-primary-color'));
		$secondary_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-secondary-color'));
		$h_font_color = esc_attr(\iRecco_Theme_Helper::get_option('header-font')['color']);
		$main_font_color = esc_attr(\iRecco_Theme_Helper::get_option('main-font')['color']);


		/*-----------------------------------------------------------------------------------*/
		/*  CONTENT -> LIST SETTINGS
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'section_content_list_settings',
			[
				'label' => esc_html__('List Settings', 'irecco-core'),
			]
		);
		
		$this->add_control(
			'view',
			[
				'label' => esc_html__('Layout', 'irecco-core'),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'inline',
				'classes' => 'elementor-control-start-end',
				'label_block' => false,
				'prefix_class' => 'elementor-icon-list--layout-',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => esc_html__('Text', 'irecco-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [ 'active' => true ],
				'placeholder' => esc_html__('List Item', 'irecco-core'),
				'default' => esc_html__('List Item', 'irecco-core'),
			]
		);
		
		$repeater->add_control(
			'icon_pack',
			[
				'label' => esc_html__('Icon Pack', 'irecco-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'fontawesome' => esc_html__('Fontawesome', 'irecco-core'), 
					'flaticon' => esc_html__('Flaticon', 'irecco-core'),
				],
				'default' => 'fontawesome',
			]
		);    

		$repeater->add_control(
			'social_icon_flaticon',
			[
				'label' => esc_html__('Icon', 'irecco-core'),
				'type' => 'wgl-icon',
				'condition' => [ 'icon_pack' => 'flaticon' ],
				'description' => esc_html__('Select icon from Flaticon library.', 'irecco-core'),
				'label_block' => true,
				'default' => '',
			]
		);

		$repeater->add_control(
			'selected_icon_fontawesome',
			[
				'label' => esc_html__('Icon', 'irecco-core'),
				'type' => Controls_Manager::ICONS,
				'condition' => [ 'icon_pack' => 'fontawesome' ],
				'fa4compatibility' => 'icon',
				'label_block' => true,
				'default' => [
					'value' => 'fab fa-wordpress',
					'library' => 'fa-brands',
				],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => esc_html__('Link', 'irecco-core'),
				'type' => Controls_Manager::URL,
				'dynamic' => [ 'active' => true ],
				'label_block' => true,
				'placeholder' => esc_html__('https://your-link.com', 'irecco-core'),
			]
		);

		$this->add_control(
			'icon_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[ 'text' => esc_html__('List Item #1', 'irecco-core') ],
					[ 'text' => esc_html__('List Item #2', 'irecco-core') ],
					[ 'text' => esc_html__('List Item #3', 'irecco-core') ],
				],
				'title_field' => '{{{ text }}}',
			]
		);
		$this->end_controls_section();            

		$this->start_controls_section(
			'section_icon_list',
			[
				'label' => esc_html__('List', 'irecco-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label' => esc_html__('Gap Items', 'irecco-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body.rtl {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body:not(.rtl) {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'right: calc(-{{SIZE}}{{UNIT}}/2)',
				],
			]
		);

		$this->add_responsive_control(
			'icon_align',
			[
				'label' => esc_html__('Alignment', 'irecco-core'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'irecco-core'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'irecco-core'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'irecco-core'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
			]
		);

		$this->add_control(
			'divider',
			[
				'label' => esc_html__('Divider', 'irecco-core'),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'label_off' => esc_html__('Off', 'irecco-core'),
				'label_on' => esc_html__('On', 'irecco-core'),
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'content: ""',
				],
			]
		);

		$this->add_control(
			'divider_style',
			[
				'label' => esc_html__('Style', 'irecco-core'),
				'type' => Controls_Manager::SELECT,
				'condition' => [ 'divider' => 'yes' ],
				'options' => [
					'solid' => esc_html__('Solid', 'irecco-core'),
					'double' => esc_html__('Double', 'irecco-core'),
					'dotted' => esc_html__('Dotted', 'irecco-core'),
					'dashed' => esc_html__('Dashed', 'irecco-core'),
				],
				'default' => 'solid',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:not(:last-child):after' => 'border-left-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_weight',
			[
				'label' => esc_html__('Weight', 'irecco-core'),
				'type' => Controls_Manager::SLIDER,
				'condition' => [ 'divider' => 'yes' ],
				'range' => [
					'px' => [ 'min' => 1, 'max' => 20 ],
				],
				'default' => [ 'size' => 1 ],
				'selectors' => [
					'{{WRAPPER}} .elementor-inline-items .elementor-icon-list-item:not(:last-child):after' => 'border-left-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_height',
			[
				'label' => esc_html__('Height', 'irecco-core'),
				'type' => Controls_Manager::SLIDER,
				'condition' => [ 'divider' => 'yes' ],
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [ 'min' => 1, 'max' => 100 ],
					'%' => [ 'min' => 1, 'max' => 100 ],
				],
				'default' => [ 'unit' => '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' => esc_html__('Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'condition' => [ 'divider' => 'yes' ],
				'default' => '#ddd',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__('Icon', 'irecco-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'icon_color_tabs' );

		$this->start_controls_tab(
			'tab_color_idle',
			[ 'label' => esc_html__('Idle' , 'irecco-core') ]
		);

		$this->add_control(
			'icon_color_idle',
			[
				'label' => esc_html__('Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-list-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_color_hover',
			[ 'label' => esc_html__('Hover' , 'irecco-core') ]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__('Hover', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Size', 'irecco-core'),
				'type' => Controls_Manager::SLIDER,
				'separator' => 'before',
				'range' => [
					'px' => [ 'min' => 6 ],
				],
				'default' => [ 'size' => 14 ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-icon-list-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__('Gap Icons', 'irecco-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon' => is_rtl() ? 'margin-left:' : 'margin-right:' . ' {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[
				'label' => esc_html__('Text', 'irecco-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'text_color_tabs' );

		$this->start_controls_tab(
			'tab_text_idle',
			[ 'label' => esc_html__('Idle', 'irecco-core') ]
		);

		$this->add_control(
			'text_color_idle',
			[
				'label' => esc_html__('Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_text_hover',
			[ 'label' => esc_html__('Hover', 'irecco-core') ]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => esc_html__('Color', 'irecco-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'text_indent',
			[
				'label' => esc_html__('Text Indent', 'irecco-core'),
				'type' => Controls_Manager::SLIDER,
				'separator' => 'before',
				'range' => [
					'px' => [ 'max' => 50 ],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-text' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-list-item',
			]
		);

		$this->end_controls_section();
	}

	public function render(){
		
		$settings = $this->get_settings_for_display();
		$fallback_defaults = [
			'fa fa-check',
			'fa fa-times',
			'fa fa-dot-circle-o',
		];

		$this->add_render_attribute('icon_list', 'class', [
			'wgl-header-list-info',
			'elementor-icon-list-items',
			'elementor-inline-items'
		]);

		$this->add_render_attribute('list_item', 'class', [
			'elementor-icon-list-item',
			'elementor-inline-item'
		]);

		?>
		<ul <?php echo $this->get_render_attribute_string('icon_list'); ?>>
			<?php
			foreach ( $settings['icon_list'] as $index => $item ) :
				$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'icon_list', $index );

				$this->add_render_attribute( $repeater_setting_key, 'class', 'wgl-header-list-text elementor-icon-list-text' );

				$this->add_inline_editing_attributes( $repeater_setting_key );
				$migration_allowed = Icons_Manager::is_migration_allowed();
				?>
				<li class="elementor-icon-list-item">
					<?php
					if (!empty($item['link']['url'])) {
						$link_key = 'link_' . $index;
						$this->add_link_attributes($link_key, $item['link']);

						echo '<a ' . $this->get_render_attribute_string($link_key) . '>';
					}

					// add old default
					if ( ! isset( $item['icon'] ) && ! $migration_allowed ) {
						$item['icon'] = isset( $fallback_defaults[ $index ] ) ? $fallback_defaults[ $index ] : 'fa fa-check';
					}

					$item_class = '';
					switch ($item['icon_pack']) {
						case 'fontawesome':
						wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
						break;
						case 'flaticon':
						wp_enqueue_style('flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
						$item_class .= $item['social_icon_flaticon'];
						break;
					}

					$migrated = isset( $item['__fa4_migrated']['selected_icon_fontawesome'] );
					$is_new = ! isset( $item['icon'] ) && $migration_allowed;
					
					if($item['icon_pack'] === 'fontawesome'){
						if ( ! empty( $item['icon'] ) || ( ! empty( $item['selected_icon_fontawesome']['value'] ) && $is_new ) ) :
							?>
							<span class="wgl-header-list-icon elementor-icon-list-icon">
								<?php
								if ( $is_new || $migrated ) {
									Icons_Manager::render_icon( $item['selected_icon_fontawesome'], [ 'aria-hidden' => 'true' ] );
								} else { ?>
										<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
								<?php } ?>
							</span>
						<?php endif; 
					} else {
						if(!empty($item['social_icon_flaticon'])) :
							?>
							<span class="wgl-header-list-icon elementor-icon-list-icon">
								<i class="<?php echo esc_attr( $item_class ); ?>" aria-hidden="true"></i>
							</span>
						<?php endif; 
					}
					?>

					<span <?php echo $this->get_render_attribute_string( $repeater_setting_key ); ?>><?php echo $item['text']; ?></span>
					<?php if ( ! empty( $item['link']['url'] ) ) : ?>
						</a>
					<?php endif; ?>
				</li>
				<?php
			endforeach;
			?>
		</ul>
		<?php 
	}
	
}