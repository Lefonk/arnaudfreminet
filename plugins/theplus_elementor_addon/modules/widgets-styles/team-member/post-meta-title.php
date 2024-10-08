<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! isset( $post_title_tag ) && empty( $post_title_tag ) ) {
	$post_title_tag = 'h3';
}

$tmTitle = '';
if ( 'repeater' === $selctSource ) {
	$tmTitle = ! empty( $item['memberTitle'] ) ? $item['memberTitle'] : '';
} else {
	$tmTitle = get_the_title();
}

?>

<<?php echo theplus_validate_html_tag( $post_title_tag ); ?> class="post-title">
	<?php
	if ( empty( $disable_link ) && 'yes' !== $disable_link ) {
		?> <a href="<?php echo esc_url( $member_url ); ?>"> <?php
	}

	echo esc_html( $tmTitle );

	if ( empty( $disable_link ) && 'yes' !== $disable_link ) { ?>
		</a>
	<?php } ?>
</<?php echo theplus_validate_html_tag( $post_title_tag ); ?>>
