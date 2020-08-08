<?php
namespace WglAddons\Widgets;

use WglAddons\Includes\Wgl_Icons;
use WglAddons\Includes\Wgl_Loop_Settings;
use WglAddons\Includes\Wgl_Carousel_Settings;
use WglAddons\Templates\WglCountDown;
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

defined( 'ABSPATH' ) || exit; // Abort, if called directly.

class Wgl_CountDown extends Widget_Base {
    
    public function get_name() {
        return 'wgl-countdown';
    }

    public function get_title() {
        return esc_html__('WGL Countdown Timer', 'irecco-core');
    }

    public function get_icon() {
        return 'wgl-countdown';
    }

    public function get_categories() {
        return [ 'wgl-extensions' ];
    }

    public function get_script_depends() {
        return [
            'coundown',
            'wgl-elementor-extensions-widgets',
        ];
    }

    
    
    protected function _register_controls() {
        $theme_color = esc_attr(\iRecco_Theme_Helper::get_option('theme-primary-color'));
        $header_font_color = esc_attr(\iRecco_Theme_Helper::get_option('header-font')['color']);
        $main_font_color = esc_attr(\iRecco_Theme_Helper::get_option('main-font')['color']);

        /* Start General Settings Section */
        $this->start_controls_section('wgl_countdown_section',
            array(
                'label' => esc_html__('Countdown Timer Settings', 'irecco-core'),
            )
        );

        $this->add_control(
            'countdown_year',
            array(
                'label' => esc_html__('Year', 'irecco-core'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter your title', 'irecco-core'),
                'default' => esc_html__('2021', 'irecco-core'),
                'label_block' => true,
                'description' => esc_html__('Example: 2021', 'irecco-core'),
            )
        ); 

        $this->add_control('countdown_month',
            array(
                'label' => esc_html__('Month', 'irecco-core'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('12', 'irecco-core'),
                'default' => esc_html__('12', 'irecco-core'),
                'label_block' => true,
                'description' => esc_html__('Example: 12', 'irecco-core'),
            )
        ); 

        $this->add_control('countdown_day',
            array(
                'label' => esc_html__('Day', 'irecco-core'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('31', 'irecco-core'),
                'default' => esc_html__('31', 'irecco-core'),
                'label_block' => true,
                'description' => esc_html__('Example: 31', 'irecco-core'),
            )
        ); 

        $this->add_control('countdown_hours',
            array(
                'label' => esc_html__('Hours', 'irecco-core'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('24', 'irecco-core'),
                'default' => esc_html__('24', 'irecco-core'),
                'label_block' => true,
                'description' => esc_html__('Example: 24', 'irecco-core'),
            )
        );

        $this->add_control('countdown_min',
            array(
                'label' => esc_html__('Minutes', 'irecco-core'),
                'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('59', 'irecco-core'),
				'default' => esc_html__('59', 'irecco-core'),
                'label_block' => true,
				'description' => esc_html__('Example: 59', 'irecco-core'),
            )
        );

        /*End General Settings Section*/
        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  Button Section 
        /*-----------------------------------------------------------------------------------*/  

        $this->start_controls_section('wgl_countdown_content_section',
            array(
                'label' => esc_html__('Countdown Timer Content', 'irecco-core'),
            )
        );

        $this->add_control('hide_day',
            array(
                'label' => esc_html__('Hide Days?', 'irecco-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'irecco-core'),
                'label_off' => esc_html__('Off', 'irecco-core'),
                'return_value' => 'yes',
            )
        );

        $this->add_control('hide_hours',
            array(
                'label' => esc_html__('Hide Hours?', 'irecco-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'irecco-core'),
                'label_off' => esc_html__('Off', 'irecco-core'),
                'return_value' => 'yes',
            )
        ); 

        $this->add_control('hide_minutes',
            array(
                'label' => esc_html__('Hide Minutes?', 'irecco-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'irecco-core'),
                'label_off' => esc_html__('Off', 'irecco-core'),
                'return_value' => 'yes',
            )
        ); 

        $this->add_control('hide_seconds',
            array(
                'label' => esc_html__('Hide Seconds?', 'irecco-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'irecco-core'),
                'label_off' => esc_html__('Off', 'irecco-core'),
                'return_value' => 'yes',
            )
        );

        $this->add_control('show_value_names',
            array(
                'label' => esc_html__('Show Value Names?', 'irecco-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'irecco-core'),
                'label_off' => esc_html__('Off', 'irecco-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            )
        );

        $this->add_control('show_separating',
            array(
                'label' => esc_html__('Show Separating?', 'irecco-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'irecco-core'),
                'label_off' => esc_html__('Off', 'irecco-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            )
        );

        /*End General Settings Section*/
        $this->end_controls_section(); 

        $this->start_controls_section(
            'countdown_style_section',
            array(
                'label' => esc_html__('Style', 'irecco-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control('size',
            array(
                'label' => esc_html__('Countdown Size', 'irecco-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'large' => esc_html__('Large', 'irecco-core'),
                    'medium' => esc_html__('Medium', 'irecco-core'),
                    'small' => esc_html__('Small', 'irecco-core'),
                    'custom' => esc_html__('Custom', 'irecco-core'),
                ],
                'default' => 'medium'
            )
        ); 


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'label' => esc_html__('Number Typography', 'irecco-core'),
                'name' => 'custom_fonts_number',
                'selector' => '{{WRAPPER}} .wgl-countdown .countdown-section .countdown-amount',
                'condition' => [
                    'size' => 'custom'
                ]
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'label' => esc_html__('Text Typography', 'irecco-core'),
                'name' => 'custom_fonts_text',
                'selector' => '{{WRAPPER}} .wgl-countdown .countdown-section .countdown-period',
                'condition' => [
                    'size' => 'custom'
                ]
            )
        );

        $this->add_control(
            'number_text_color',
            array(
                'label' => esc_html__('Number Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wgl-countdown .countdown-section .countdown-amount' => 'color: {{VALUE}};',
                ],
            )
        );
          
        $this->add_control(
            'number_text_bg_color',
            array(
                'label' => esc_html__('Number Background Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#1f242c',
                'selectors' => [
                    '{{WRAPPER}} .wgl-countdown .countdown-section .countdown-amount span' => 'background-color: {{VALUE}};',
                ],
            )
        );

        $this->add_control(
            'period_text_color',
            array(
                'label' => esc_html__('Text Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#1f242c',
                'selectors' => [
                    '{{WRAPPER}} .wgl-countdown .countdown-section .countdown-period' => 'color: {{VALUE}};',
                ],
            )
        );

        $this->add_control(
            'separating_color',
            array(
                'label' => esc_html__('Separating Points Color', 'irecco-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#1f242c',
                'selectors' => [
                    '{{WRAPPER}} .wgl-countdown .countdown-section:not(:last-child) .countdown-amount:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .wgl-countdown .countdown-section:not(:last-child) .countdown-amount:after' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_separating' => 'yes'
                ]
            )
        );

        /*End Style Section*/
        $this->end_controls_section(); 
    }

    protected function render() {
        $atts = $this->get_settings_for_display();
        
       	$countdown = new WglCountDown();
        echo $countdown->render($this, $atts);

    }
    
}