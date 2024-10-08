<?php
/**
 * Style 1
 *
 * @package ThePlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! empty( $attachment ) ) {
	$image_id = $attachment->ID;
} else {
	$image_id = $image_id;
}

$full_image = '';
$lazyclass  = '';
$full_image = wp_get_attachment_url( $image_id, 'full' );

$bg_attr = '';
if ( 'metro' === $layout ) {
	if ( ! empty( $image_id ) && ! empty( $display_thumbnail ) && 'yes' === $display_thumbnail && ! empty( $thumbnail ) ) {

		$full_image1 = wp_get_attachment_image_src( $image_id, $thumbnail );
		if ( ! empty( $full_image1 ) ) {
			$bg_attr = 'style="background:url(' . $full_image1[0] . ')"';
		} else {
			$bg_attr = theplus_loading_image_grid( $postid, 'background' );
		}
	} elseif ( ! empty( $full_image ) ) {
		$bg_attr = 'style="background:url(' . $full_image . ')"';
	} else {
		$bg_attr = theplus_loading_image_grid( $postid, 'background' );
	}

	if ( tp_has_lazyload() ) {
		$lazyclass = ' lazy-background';
	}
}
?>
<div>
<?php
if ( ! empty( $settings['display_box_link'] ) && 'yes' === $settings['display_box_link'] ) {
	if ( ! empty( $settings['force_custom_url'] ) && 'yes' === $settings['force_custom_url'] ) {
		?>
			<a href="<?php echo esc_url( $custom_url ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="gallery-list-content" <?php echo $popup_attr; ?>>
		<?php
	} else {
		?>
			<a href="<?php echo esc_url( $full_image ); ?>" class="gallery-list-content" <?php echo $popup_attr; ?>>
		<?php
	}
} else {
	?>
	<div class="gallery-list-content">
	<?php
}

if ( 'metro' !== $layout ) {
	?>
	
	<div class="post-content-image">
		<?php include THEPLUS_WSTYLES . 'gallery/format-image.php'; ?>
	</div>

	<?php } ?>
	<div class="post-content-center">		
		<div class="post-hover-content">
			<?php
			if ( ! empty( $display_icon_zoom ) && 'yes' === $display_icon_zoom ) {
				include THEPLUS_WSTYLES . 'gallery/meta-icon.php';
			}

			if ( ! empty( $image_icon ) && ! empty( $list_img ) ) {
				?>
				<div class="gallery-list-icon"><?php echo $list_img; ?></div>
				<?php
			}

			if ( ! empty( $display_title ) && 'yes' === $display_title ) {
				include THEPLUS_WSTYLES . 'gallery/meta-title.php';
			}

			if ( ! empty( $display_excerpt ) && 'yes' === $display_excerpt && ! empty( $caption ) ) {
				include THEPLUS_WSTYLES . 'gallery/get-excerpt.php';
			}
			?>
		</div>
	</div>
	<?php if ( 'metro' === $layout ) { ?>
		<div class="gallery-bg-image-metro <?php echo esc_attr( $lazyclass ); ?>" <?php echo $bg_attr; ?>></div>
		<?php
	}

	if ( ! empty( $settings['display_box_link'] ) && 'yes' === $settings['display_box_link'] ) {
		?>
		</a>
	<?php } else { ?>
	</div>
	<?php } ?>
</div>
