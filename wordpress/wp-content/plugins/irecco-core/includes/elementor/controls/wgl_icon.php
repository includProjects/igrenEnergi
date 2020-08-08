<?php

namespace WglAddons\Controls;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Base_Data_Control;

defined( 'ABSPATH' ) || exit;

/**
* Wgl Elementor Custom Icon Control
*
*
* @class        Wgl_Icon
* @version      1.0
* @category Class
* @author       WebGeniusLab
*/

class Wgl_Icon extends Base_Data_Control{

	/**
	 * Get radio image control type.
	 *
	 * Retrieve the control type, in this case `radio-image`.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Control type.
	 */
	public function get_type() {
		return 'wgl-icon';
	}

	public function enqueue() {
		// Scripts
		wp_enqueue_script( 'wgl-elementor-extensions', WGL_ELEMENTOR_ADDONS_URL . 'assets/js/wgl_elementor_extenstions.js');

		// Style
		wp_enqueue_style( 'wgl-elementor-extensions', WGL_ELEMENTOR_ADDONS_URL . 'assets/css/wgl_elementor_extenstions.css');
	}

	public static function get_flaticons() {
		return [
			'flaticon-search' => 'search',
			'flaticon-menu' => 'menu',
			'flaticon-supermarket' => 'supermarket',
			'flaticon-arrow' => 'arrow',
			'flaticon-wind-turbine' => 'wind-turbine',
			'flaticon-phone' => 'phone',
			'flaticon-phone-1' => 'phone-1',
			'flaticon-correct' => 'correct',
			'flaticon-download' => 'download',
			'flaticon-wind' => 'wind',
			'flaticon-power' => 'power',
			'flaticon-ecology' => 'ecology',
			'flaticon-ecology-1' => 'ecology-1',
			'flaticon-plant' => 'plant',
			'flaticon-paper-recycle' => 'paper-recycle',
			'flaticon-earth' => 'earth',
			'flaticon-trees' => 'trees',
			'flaticon-heart' => 'heart',
			'flaticon-eco-home' => 'eco-home',
			'flaticon-eco-bag' => 'eco-bag',
			'flaticon-water' => 'water',
			'flaticon-landscape' => 'landscape',
			'flaticon-play' => 'play',
			'flaticon-plus' => 'plus',
			'flaticon-power-1' => 'power-1',
			'flaticon-mill' => 'mill',
			'flaticon-down' => 'down',
			'flaticon-chevron' => 'chevron',
			'flaticon-telegram' => 'telegram',
			'flaticon-yard' => 'yard',
			'flaticon-user' => 'user',
			'flaticon-comment' => 'comment',
			'flaticon-chat' => 'chat',
			'flaticon-pin' => 'pin',
			'flaticon-at' => 'at',
			'flaticon-envelope' => 'envelope',
			'flaticon-black-back-closed-envelope-shape' => 'black-back-closed-envelope-shape',
			'flaticon-share' => 'share',
			'flaticon-quotation-marks' => 'quotation-marks',
			'flaticon-quote' => 'quote',
			'flaticon-left-quote' => 'left-quote',
			'flaticon-chain' => 'chain',
			'flaticon-link' => 'link',
			'flaticon-files-and-folders' => 'files-and-folders',
			'flaticon-files-and-folders-1' => 'files-and-folders-1',
			'flaticon-pencil-edit-button' => 'pencil-edit-button',
			'flaticon-hashtag' => 'hashtag',
			'flaticon-photograph' => 'photograph',
			'flaticon-heart-1' => 'heart-1',
			'flaticon-heart-2' => 'heart-2',
			'flaticon-greenhouse' => 'greenhouse',
			'flaticon-nuclear' => 'nuclear',
			'flaticon-ecology-2' => 'ecology-2',
			'flaticon-green' => 'green',
			'flaticon-settings' => 'settings',
			'flaticon-24-hours' => '24-hours',
			'flaticon-chat-1' => 'chat-1',
			'flaticon-leaf' => 'leaf',
			'flaticon-pot' => 'pot',
			'flaticon-light-bulb' => 'light-bulb',
			'flaticon-price' => 'price',
			'flaticon-coin' => 'coin',
			'flaticon-wallet' => 'wallet',
			'flaticon-thumb-up-button' => 'thumb-up-button',
			'flaticon-shopping-cart' => 'shopping-cart',
			'flaticon-shopping-bag' => 'shopping-bag',
			'flaticon-shopping-basket-button' => 'shopping-basket-button',
			'flaticon-shopping-bag-1' => 'shopping-bag-1',
			'flaticon-linkedin-letters' => 'linkedin-letters',
		];
	}

	/**
	 * Get radio image control default settings.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return [
			'label_block' => true,
			'options' => self::get_flaticons(),
			'include' => '',
			'exclude' => '',
			'select2options' => [],
		];
	}

	/**
	 * Render radio image control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {

		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<# if ( data.label ) {#>
				<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<# } #>
			<div class="elementor-control-input-wrapper">
				<select id="<?php echo $control_uid; ?>" class="elementor-control-icon elementor-select2" type="select2"  data-setting="{{ data.name }}" data-placeholder="<?php echo __( 'Select Icon', 'irecco-core' ); ?>">
					<# _.each( data.options, function( option_title, option_value ) {
						var value = data.controlValue;
						if ( typeof value == 'string' ) {
							var selected = ( option_value === value ) ? 'selected' : '';
						} else if ( null !== value ) {
							var value = _.values( value );
							var selected = ( -1 !== value.indexOf( option_value ) ) ? 'selected' : '';
						}
						#>
					<option {{ selected }} value="{{ option_value }}">{{{ option_title }}}</option>
					<# } ); #>
				</select>
			</div>
		</div>
		<# if ( data.description ) { #>
			<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}
}

?>