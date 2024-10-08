<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** set var if empty*/
if( empty( $loading_class ) ){
	$loading_class = "";
}

if ( 
	( ( ! empty( $filter_type ) && ( 'search_list' === $filter_type ) ) 
	|| ( ! empty( $more_post_optn ) && 'load_more' === $more_post_optn ) 
	|| ( ! empty( $paginationType ) && 'ajaxbased' === $paginationType ) 
	|| ( ( ! empty( $filter_type ) && 'recently_viewed' === $filter_type ) 
		|| ( ! empty( $filter_type ) && 'wishlist' === $filter_type ) 
		|| ( ! empty( $ajax_filter_type ) && 'ajax_base' === $ajax_filter_type ) 
		) 
	) ) { 
?>
	<div class="tp-skeleton" <?php echo $loading_class ?> >   
		<div class="tp-skeleton-img loading">
			<div class="tp-skeleton-bottom">
				<div class="tp-skeleton-title loading"></div>
				<div class="tp-skeleton-description loading"></div>
			</div>
		</div>
	</div>
<?php } ?>
