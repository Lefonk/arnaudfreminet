<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="tp-widget-<?php echo esc_attr( $uid_sfeed ); ?> fancybox-si fancy-<?php echo esc_attr( $FancyStyle ); ?>" id="Fancy-<?php echo esc_attr( $PopupSylNum ); ?>" data-FancyFeedType="<?php echo $selectFeed; ?>" >

	<?php
		require THEPLUS_WSTYLES . 'social-feed/fancybox-feed-post.php';
		require THEPLUS_WSTYLES . 'social-feed/fancybox-header.php';

		echo '<div class="tp-fcb-contant">';
	if ( ! empty( $Massage ) ) {
		echo '<div class="tp-fcb-title">' . wp_kses_post( $Massage ) . '</div>';
	}
	if ( ! empty( $Description ) ) {
		include THEPLUS_WSTYLES . 'social-feed/feed-Description.php';
	}
		echo '</div>';
		echo '<div class="tp-fcb-footer">';
			require THEPLUS_WSTYLES . 'social-feed/feed-footer.php';
			echo '<div class="tp-btn-viewpost">
                    <a href="' . esc_url( $UserLink ) . '" target="_blank" rel="noopener noreferrer" >View post</a>
                </div>';
		echo '</div>';
	?>

</div>
<?php require THEPLUS_WSTYLES . 'social-feed/popup-type.php'; ?>
