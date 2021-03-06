<?php

/**
 * Template Activate Theme
 *
 * @link       https://themeforest.net/user/webgeniuslab
 * @since      1.0.0
 *
 * @package    iRecco
 * @subpackage iRecco/core/dashboard
 */

/**
 * @since      1.0.0
 * @package    iRecco
 * @subpackage iRecco/core/dashboard
 * @author     WebGeniusLab <webgeniuslab@gmail.com>
 */

?>
<div class="wgl-activation-theme_form">
	<div class="container-form">
		<?php
			if(!iRecco_Theme_Helper::wgl_theme_activated()):
		?>
			<h1 class="wgl-title"><?php esc_html_e( 'Activate your Licence', 'irecco' ); ?></h1>
			<div class="wgl-content">
				<p class="wgl-content_subtitle">
					<?php echo sprintf( esc_html__('Welcome and thank you for Choosing %s Theme!', 'irecco'), esc_html(wp_get_theme()->get('Name')));?>
					<br/>
					<?php echo sprintf(esc_html__('The %s theme needs to be activated to enable demo import installation and customer support service.', 'irecco'), esc_html(wp_get_theme()->get('Name')));?>
				</p>
			</div>
			
			<form class="form wgl-purchase" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post">
				<div class="help-description">
					<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e('How to find purchase code?', 'irecco');?></a>
				</div>
				<div class="form-row">
					<div class="form-group">
						<label class="form-label" for="user_email"><?php esc_html_e( 'E-mail address', 'irecco' ); ?></label>
						<input class="form-control" type="text" placeholder="<?php esc_attr_e( 'E-mail address', 'irecco' ); ?>" name="user_email" value="<?php echo esc_attr( get_option('admin_email') ); ?>" required>
					</div>

					<div class="form-group">
						<label class="form-label" for="purchase_item"><?php esc_html_e( 'Enter Your Purchase Code', 'irecco' ); ?></label>
						<input class="form-control" placeholder="<?php esc_attr_e( 'Enter Your Purchase Code', 'irecco' ); ?>" type="text" name="purchase_item" required>
					</div>					
				</div>


				<?php wp_nonce_field( 'purchase-activation', 'security' ); ?>

				<input type="hidden" name="action" value="purchase_activation">

				<button type="submit" class="button button-primary activate-license" value="submit">
					<span class="text-btn"><?php esc_html_e( 'Activate', 'irecco' ); ?></span>
					<span class="loading-icon"></span>
				</button>
			</form>	

		<?php
			else:
			?>
				<div class="wgl-activation-theme_congratulations">
	    			<h1 class="wgl-title">
	    				<span>
	    					<?php esc_html_e( 'Thank you!', 'irecco' ); ?>
	    				</span>
	    				<br/>
	    				<?php esc_html_e( 'Your theme\'s license is activated successfully.', 'irecco' ); ?>
	    			</h1>
    			</div>
    			<form class="form wgl-deactivate_theme" action="" method="post">
    				<div class="form-group hidden_group">
    					<input type="hidden" name="deactivate_theme" value="1" class="form-control">
    				</div>

					<button type="submit" class="button button-primary deactivate_theme-license" value="submit">
						<span>
							<?php esc_html_e( 'Deactivate', 'irecco' ); ?>
						</span>
					</button>
    			</form>
    		<?php
			endif;
		?>	
		<div class="text-desc-info">
			<p class="text-desc-info_license"><?php esc_html_e('1 license  = 1 domain = 1 website', 'irecco');?></p>
			<p class="text-desc-info_author"><?php esc_html_e('You can always buy more licences for this product:', 'irecco');?>
				<a href="https://themeforest.net/user/webgeniuslab">ThemeForest WebGeniusLab</a>
			</p>
		</div>
	</div>

</div>

