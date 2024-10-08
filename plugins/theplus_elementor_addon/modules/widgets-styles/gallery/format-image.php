<?php
/**
 * Format images
 *
 * @package ThePlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! empty( $attachment ) ) {
	$featured_image_id = $attachment->ID;
} else {
	$featured_image_id = $image_id;
}

$tsize = '';

if ( ! empty( $featured_image_id ) && ! empty( $display_thumbnail ) && 'yes' === $display_thumbnail && ! empty( $thumbnail ) ) {
	if ( ! empty( $layout ) && ( 'grid' === $layout || 'masonry' === $layout ) ) {
		$tsize = $thumbnail;
	}

	$featured_image = tp_get_image_rander( $featured_image_id, $tsize );
} elseif ( ! empty( $featured_image_id ) ) {

	if ( ! empty( $layout ) && 'grid' === $layout ) {
		$tsize = 'tp-image-grid';
	} elseif ( ! empty( $layout ) && 'masonry' === $layout ) {
		$tsize = 'full';
	} elseif ( ! empty( $layout ) && 'carousel' === $layout ) {

		if ( ! empty( $featured_image_type ) && 'custom' === $featured_image_type && ! empty( $thumbnail_carousel ) ) {
			$tsize = $thumbnail_carousel;
		} elseif ( empty( $featured_image_type ) || 'full' === $featured_image_type ) {
			$tsize = 'full';
		} elseif ( 'grid' === $featured_image_type ) {
			$tsize = 'tp-image-grid';
		}
	} else {

		$tsize = 'full';
	}

	$featured_image = tp_get_image_rander( $featured_image_id, $tsize );
} else {
	$featured_image = theplus_get_thumb_url();
	$featured_image = $featured_image = '<img src="' . esc_url( $featured_image ) . '" alt="' . esc_attr( $image_alt ) . '">';
}

?>

<div class="gallery-image">
	<span class="thumb-wrap">
		<?php echo $featured_image; ?>
	</span>
</div>
