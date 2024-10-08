<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( $tlContentFrom == 'tlcontent' ) {
	$postid = get_the_ID();?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<?php
}
?>

<div class="testimonial-list-content d-flex flex-row flex-wrap tp-align-items-center">		
	<div class="post-content-image flex-column flex-wrap">
		<?php require THEPLUS_WSTYLES . 'testimonial/format-image.php'; ?>
	</div>
	<div class="testimonial-content-text flex-column flex-wrap">
	<?php
		require THEPLUS_WSTYLES . 'testimonial/post-meta-logo.php';
		require THEPLUS_WSTYLES . 'testimonial/post-meta-title.php';
		require THEPLUS_WSTYLES . 'testimonial/get-excerpt.php';
	?>
		<div class="author-left-text">
		<?php
			require THEPLUS_WSTYLES . 'testimonial/post-title.php';
			require THEPLUS_WSTYLES . 'testimonial/post-meta-designation.php';
		?>
		</div>
	</div>
</div>
<?php

if ( $tlContentFrom == 'tlcontent' ) {
	?>
	</article><?php
} ?>
