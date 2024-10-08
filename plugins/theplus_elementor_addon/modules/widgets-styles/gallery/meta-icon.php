<?php
/**
 * Meta Icon
 *
 * @package ThePlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! empty( $loopImageIcon ) && 'icon' === $loopImageIcon ) {
	if ( ! empty( $loopIconStyle ) && 'font_awesome' === $loopIconStyle ) {
		$iconFontawesome = $loopIconFontawesome;
		$icon_content    = '<i class="' . esc_attr( $iconFontawesome ) . '" ></i>';
	} elseif ( ! empty( $loopIconStyle ) && 'icon_mind' === $loopIconStyle ) {
		$iconsMind    = $loopIconsMind;
		$icon_content = '<i class="' . esc_attr( $iconsMind ) . '" ></i>';
	} elseif ( ! empty( $loopIconStyle ) && 'font_awesome_5' === $loopIconStyle ) {
		ob_start();
		\Elementor\Icons_Manager::render_icon( $loopIconFontawesome5, array( 'aria-hidden' => 'true' ) );
		$icon_content = ob_get_contents();
		ob_end_clean();
	}
} elseif ( ! empty( $customImage ) ) {
	$icon_content = tp_get_image_rander( $customImageId, 'full' );
} else {
	$icon_content = '<i class="fas fa-search-plus" aria-hidden="true"></i>';
}
?>
<div class="meta-search-icon">
	<?php
	if ( ! empty( $settings['display_box_link'] ) && 'yes' === $settings['display_box_link'] || 'no' === $settings['popup_style'] ) {
		?>
		<div <?php echo $popup_attr_icon; ?>><?php echo $icon_content; ?></div>
	<?php } else { ?>
		<a href="<?php echo esc_url( $full_image ); ?>" <?php echo $popup_attr_icon; ?>>
			<?php echo $icon_content; ?>
		</a>
	<?php } ?>
</div>
