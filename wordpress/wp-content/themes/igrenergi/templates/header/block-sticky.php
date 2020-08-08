<?php

defined( 'ABSPATH' ) || exit;

if (!class_exists('iRecco_header_sticky')) {
	class iRecco_header_sticky extends iRecco_get_header{

		public function __construct(){
			$this->header_vars();  
			$this->html_render = 'sticky';

	   		if (iRecco_Theme_Helper::options_compare('header_sticky','mb_customize_header_layout','custom') == '1') {
	   			$header_sticky_style = iRecco_Theme_Helper::get_option('header_sticky_style');
	   			
	   			echo "<div class='wgl-sticky-header wgl-sticky-element".($this->header_type === 'default' ? ' header_sticky_shadow' : '')."'".(!empty($header_sticky_style) ? ' data-style="'.esc_attr($header_sticky_style).'"' : '').">";

	   				echo "<div class='container-wrapper'>";
	   				
	   					$this->build_header_layout('sticky');
	   				echo "</div>";

	   			echo "</div>";
	   		}
		}
	}

    new iRecco_header_sticky();
}
