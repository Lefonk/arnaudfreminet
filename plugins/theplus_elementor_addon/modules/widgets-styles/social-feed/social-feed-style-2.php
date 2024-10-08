<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="tp-sf-feed">

	<?php
		require THEPLUS_WSTYLES . 'social-feed/social-feed-ob-style.php';
			echo $Header_html;

	if ( ! empty( $Massage ) ) {
		echo $Massage_html;
	}

	if ( ! empty( $Description ) && empty( $DescripBTM ) ) {
		include THEPLUS_WSTYLES . 'social-feed/feed-Description.php';
	}

	if ( $MediaFilter == 'default' || $MediaFilter == 'ompost' ) {
		include THEPLUS_WSTYLES . 'social-feed/fancybox-feed.php';
	}

	if ( ! empty( $Description ) && ! empty( $DescripBTM ) ) {
		include THEPLUS_WSTYLES . 'social-feed/feed-Description.php';
	}
			require THEPLUS_WSTYLES . 'social-feed/feed-footer.php';
	?>

</div>
<?php
	echo $Copyid_html;
