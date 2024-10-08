<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="tp-sf-feed d-flex flex-row">
	<?php
		$imghideclass = '';
	if ( empty( $ImageURL ) ) {
		$imghideclass = 'tp-soc-image-not-found';
	}

		echo '<div class="tp-sf-contant ' . esc_attr( $imghideclass ) . '">';
				require THEPLUS_WSTYLES . 'social-feed/social-feed-ob-style.php';
	if ( ! empty( $Massage ) ) {
		echo $Massage_html;
	}
	if ( ! empty( $Description ) ) {
		include THEPLUS_WSTYLES . 'social-feed/feed-Description.php';
	}
				echo $Header_html;
				require THEPLUS_WSTYLES . 'social-feed/feed-footer.php';
		echo '</div>';

	if ( ! empty( $ImageURL ) ) {
		?>

		<div class="tp-sf-contant-img" style="background-image: url('<?php echo esc_url( $ImageURL ); ?>');">
			<?php
				echo $Iconlogo;
				include THEPLUS_WSTYLES . 'social-feed/fancybox-feed.php';
			?>
		</div>
		<?php
	}
	?>

</div>
<?php
	echo $Copyid_html;
