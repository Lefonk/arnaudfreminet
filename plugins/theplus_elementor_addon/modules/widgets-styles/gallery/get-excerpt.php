<?php
/**
 * Meta Title
 *
 * @package ThePlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="entry-content">
	<?php echo wp_kses_post( $caption ); ?>
</div>
