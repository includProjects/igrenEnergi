<?php

/**
 * The template for displaying 404 page
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package    WordPress
 * @subpackage iRecco
 * @since      1.0
 * @version    1.0.3
 */


get_header();

$main_bg_color = iRecco_Theme_Helper::get_option('404_page_main_bg_image')['background-color'];
$bg_render = iRecco_Theme_Helper::bg_render('404_page_main');

$styles = !empty($main_bg_color) ? 'background-color: ' . $main_bg_color . ';' : '';
$styles .= $bg_render ?: '';
$styles = $styles ? ' style="' . esc_attr($styles) . '"' : '';

?>
<div class="wgl-container full-width">
  <div class="row">
    <div class="wgl_col-12">
      <section class="page_404_wrapper" <?php echo \iRecco_Theme_Helper::render_html($styles); ?>>
        <div class="page_404_wrapper-container">
          <div class="row">
            <div class="wgl_col-12 wgl_col-md-12">
              <div class="main_404-wrapper">
                <div class="banner_404"><img src="<?php echo esc_url(get_template_directory_uri() . "/img/404.png"); ?>" alt="<?php echo esc_attr__('404', 'irecco'); ?>"></div>
                <h2 class="banner_404_title"><span><?php echo esc_html__('Ooops! Page Not Found', 'irecco'); ?></span></h2>
                <p class="banner_404_text"><?php echo esc_html__('The page you are looking for was moved, removed, renamed or never existed.', 'irecco'); ?></p>
                <div class="irecco_404_search">
                  <?php get_search_form(); ?>
                </div>
                <div class="irecco_404__button">
                  <a class="irecco_404__link wgl-button" href="<?php echo esc_url(home_url('/')); ?>">
                    <?php esc_html_e('Take Me Home', 'irecco'); ?>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<?php get_footer();
