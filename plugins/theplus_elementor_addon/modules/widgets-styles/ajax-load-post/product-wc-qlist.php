<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="tp-wc-qlist-grid">
	<div class="tp-wc-qlist-grid-remove" data-product="<?php echo get_the_ID(); ?>"><i aria-hidden="true" class="fas fa-window-close"></i></div>
	<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"> 
		<?php

		$productImg = get_the_post_thumbnail();

		echo $productImg;
		echo esc_html( get_the_title() );

		if ( class_exists( 'Woocommerce' ) && ! empty( $bbc ) && 'product' === $bbc ) {
			$product12 = new WC_Product( get_the_ID() );
			?>
			<span class="price"><?php echo $product12->get_price_html(); ?></span> 
		<?php
		}

		?>
	</a>
</div>
