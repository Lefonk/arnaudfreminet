<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$date_on   = ! empty( $settings['display_post_meta_date'] ) ? $settings['display_post_meta_date'] : 'yes';
$date_type = ! empty( $settings['date_type'] ) ? $settings['date_type'] : 'post_published';

$date_mtype = '';

if ( 'yes' === $date_on ) {

	if ( 'post_modified' === $date_type ) {
		$date_mtype = get_the_modified_date();
	} else {
		$date_mtype = get_the_date();
	}
}

?>
<span class="meta-date"><a href="<?php echo esc_url( get_the_permalink() ); ?>"><span class="entry-date"><?php echo $date_mtype; ?></span></a></span>
