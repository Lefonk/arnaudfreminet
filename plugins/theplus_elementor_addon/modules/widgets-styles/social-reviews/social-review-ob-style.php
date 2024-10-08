<?php
/**
 * Ob Styles
 *
 * @link       https://posimyth.com/
 * @package    ThePlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$Description_HTML = '';
ob_start();
	echo '<div class="tp-SR-content">';
		require THEPLUS_WSTYLES . 'social-reviews/social-review-showmore.php';
	echo '</div>';
$Description_HTML .= ob_get_clean();


$Star_HTML  = '';
$Star_HTML .= '<div class="tp-SR-star">';
for ( $i = 0; $i < $rating; $i++ ) {
	$Star_HTML .= '<i star-rating="' . esc_attr( $i ) . '" class="' . esc_attr( $icon ) . ' SR-star"></i>';
}
$Star_HTML .= '</div>';

// Username.
$UserName_HTML  = '';
$UserName_HTML .= '<div class="tp-SR-username">';
$UserName_HTML .= '<a href="' . esc_url( $ULink ) . '" target="_blank" rel="noopener noreferrer">' . esc_html( $UName ) . '</a>';
$UserName_HTML .= '</div>';

// Logo Image.
$Logo_HTML = '<a href="' . esc_url( $PageLink ) . '" target="_blank" rel="noopener noreferrer"><img class="tp-SR-logo" src="' . esc_url( $logo ) . '" /></a>';

// Time.
$Time_HTML = '<div class="tp-SR-time">' . esc_html( $Time ) . '</div>';

// Profile.
$Profile_HTML = '<img class="tp-SR-profile" src="' . esc_url( $UImage ) . '" />';

// POSTID.
$Copyid_html = '';
if ( \Elementor\Plugin::$instance->editor->is_edit_mode() && ! empty( $ShowFeedId ) ) {
	$Copyid_html = '<div class="tp-SR-copy-Review"><input type="text" id="tp-copy-SR-ReviewId" class="tp-copy-SR-ReviewId" value="' . esc_attr( $PostId ) . '" disabled><div class="tp-SR-copy-icon" data-copypostid="' . esc_attr( $PostId ) . '"><i class="far fa-copy CopyLoading"></i></div></div>';
}
