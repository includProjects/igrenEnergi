<?php

$single = iRecco_SinglePost::getInstance();
$single->set_data();

$single_author_info = iRecco_Theme_Helper::get_option('single_author_info');
$single_meta = iRecco_Theme_Helper::get_option('single_meta');
$show_tags = iRecco_Theme_Helper::get_option('single_meta_tags');
$show_share = iRecco_Theme_Helper::get_option('single_share');
$hide_featured = iRecco_Theme_Helper::options_compare('post_hide_featured_image', 'mb_post_hide_featured_image', '1');

?>
<article class="blog-post blog-post-single-item format-<?php echo esc_attr($single->get_pf()); ?>">
	<div <?php post_class("single_meta"); ?>>
		<div class="item_wrapper">
			<div class="blog-post_content"><?php

				if ( ! $hide_featured ) {
					$pf_type = $single->get_pf();
					$video_style = function_exists("rwmb_meta") ? rwmb_meta('post_format_video_style') : '';
					if ( $pf_type !== 'standard-image' && $pf_type !== 'standard' ) {
						if ( $pf_type === 'video' && $video_style === 'bg_video' ) {
						} else {
							$single->render_featured();
						}
					}
				}

				the_content();

				wp_link_pages(
					[
						'before' => '<div class="page-link"><span class="pagger_info_text">' . esc_html__( 'Pages', 'irecco' ) . ': </span>',
						'after' => '</div>'
					]
				);

				if ( ! $show_tags && has_tag() || $show_share ) :

					echo '<div class="single_post_info">';

						// Tags
						if ( ! $show_tags && has_tag() ) {
							the_tags('<div class="tagcloud-wrapper"><div class="tagcloud">', ' ', '</div></div>');
						}

						echo '<div class="post_info-divider"></div>';

						// Shares
						if ( $show_share && function_exists('wgl_theme_helper') ) {
							echo '<div class="single_info-share_social-wpapper">',
									 wgl_theme_helper()->render_post_share('yes'),
								 '</div>';
						}

					echo '</div>'; // post_info

				else :

					echo '<div class="post_info-divider"></div>';

				endif;

				// Author Info
				if ( $single_author_info ) $single->render_author_info();

				?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</article>