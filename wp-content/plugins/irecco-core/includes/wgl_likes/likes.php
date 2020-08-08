<?php

class WglSimpleLikes {

	protected static $instance = null;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	} 

	public function irecco_already_liked( $post_id, $is_comment ) {
		$post_users = NULL;
		$user_id = NULL;
		if ( is_user_logged_in() ) { // user is logged in
			$user_id = get_current_user_id();
			$post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, '_user_comment_liked' ) : get_post_meta( $post_id, '_user_liked' );
			if ( count( $post_meta_users ) != 0 ) {
				$post_users = $post_meta_users[0];
			}
		} else { // user is anonymous
			$user_id = $this->irecco_like_get_ip();
			$post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, '_user_comment_IP' ) : get_post_meta( $post_id, '_user_IP' ); 
			if ( count( $post_meta_users ) != 0 ) { // meta exists, set up values
				$post_users = $post_meta_users[0];
			}
		}
		if ( is_array( $post_users ) && in_array( $user_id, $post_users ) ) {
			return true;
		} else {
			return false;
		}
	} 

	public function likes_button( $post_id, $is_comment = NULL ) {
		$is_comment = ( NULL == $is_comment ) ? 0 : 1;
		$nonce = wp_create_nonce( 'simple-likes-nonce' ); // Security
		if ( $is_comment == 1 ) {
			$post_id_class = esc_attr( ' sl-comment-button-' . $post_id );
			$comment_class = esc_attr( ' sl-comment' );
			$like_count = get_comment_meta( $post_id, '_comment_like_count', true );
		} else {
			$post_id_class = esc_attr( ' sl-button-' . $post_id );
			$comment_class = '';
			$like_count = get_post_meta( $post_id, '_post_like_count', true );
		}
		$count = $this->get_like_count( $like_count );
		$icon_empty = $this->irecco_get_unliked_icon();
		$icon_full = $this->irecco_get_liked_icon();
		// Loader
		$loader = '<span class="sl-loader"></span>';
		// Liked/Unliked Variables
		if ( $this->irecco_already_liked( $post_id, $is_comment ) ) {
			$class = esc_attr( ' liked' );
			$title = esc_html__( 'Unlike', 'irecco' );
			$icon = $icon_full;
		} else {
			$class = '';
			$title = esc_html__( 'Like', 'irecco' );
			$icon = $icon_empty;
		}
		return '<div class="sl-wrapper wgl-likes"><a href="' . admin_url( 'admin-ajax.php?action=irecco_like' . '&post_id=' . $post_id . '&nonce=' . $nonce . '&is_comment=' . $is_comment . '&disabled=true' ) . '" class="sl-button' . $post_id_class . $class . $comment_class . '" data-nonce="' . $nonce . '" data-post-id="' . $post_id . '" data-iscomment="' . $is_comment . '" title="' . $title . '">' . $icon . $count . '</a>' . $loader . '</div>';
	}

	public function irecco_post_user_likes( $user_id, $post_id, $is_comment ) {
		$post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, '_user_comment_liked' ) : get_post_meta( $post_id, '_user_liked' );
		if ( count( $post_meta_users ) != 0 ) $post_users = $post_meta_users[0];
		if ( ! is_array( $post_users ) ) $post_users = [];
		if ( ! in_array( $user_id, $post_users ) ) $post_users['user-' . $user_id] = $user_id;
		
		return $post_users;
	}

	public function irecco_post_ip_likes( $user_ip, $post_id, $is_comment ) {
		$post_users = '';
		$post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, '_user_comment_IP' ) : get_post_meta( $post_id, '_user_IP' );
		// Retrieve post information
		if ( count( $post_meta_users ) != 0 ) $post_users = $post_meta_users[0];
		if ( ! is_array( $post_users ) ) $post_users = [];
		if ( ! in_array( $user_ip, $post_users ) ) $post_users['ip-' . $user_ip] = $user_ip;
		
		return $post_users;
	}

	public function irecco_like_get_ip() {
		if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) && ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = ( isset( $_SERVER['REMOTE_ADDR'] ) ) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
		}
		$ip = filter_var( $ip, FILTER_VALIDATE_IP );
		$ip = $ip === false ? '0.0.0.0' : $ip;
		return $ip;
	}

	public function irecco_get_liked_icon() {
		// If Font Awesome is needed, replace with: <i class="fa fa-heart"></i>
		return '<span class="sl-icon flaticon-heart-2 unliked"></span>';
	}

	public function irecco_get_unliked_icon() {
		// If Font Awesome is needed, replace with: <i class="fa fa-heart-o"></i>
		return '<span class="sl-icon flaticon-heart-1 liked"></span>'; 
	}

	public function irecco_sl_format_count( $number ) {
		$precision = 2;
		if ( $number >= 1000 && $number < 1000000 ) :
			$formatted = number_format( $number/1000, $precision ).'K';
		elseif ( $number >= 1000000 && $number < 1000000000 ) :
			$formatted = number_format( $number/1000000, $precision ).'M';
		elseif ( $number >= 1000000000 ) :
			$formatted = number_format( $number/1000000000, $precision ).'B';
		else :
			$formatted = $number; // Number is less than 1000
		endif;

		return str_replace( '.00', '', $formatted );
	}

	public function get_like_count( $like_count ) {
		if ( ! isset( $like_count ) || ! is_numeric( $like_count ) ) $like_count = 0;

		$out = $this->irecco_sl_format_count( $like_count );
		$out .= '<span class="sl-count-text"> ' . esc_html( _n( 'Like', 'Likes', $like_count, 'irecco' ) ) . '</span>';
		return '<span class="sl-count">' . $out . '</span>';
	} 
	
}

function wgl_simple_likes() {
	return WglSimpleLikes::instance();
}

?>