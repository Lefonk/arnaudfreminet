<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$postid = get_the_ID();
?>
<?php if ( $display_post_category == 'yes' ) { ?>
	<div class="post-metro-category-top">
		<?php include THEPLUS_WSTYLES . 'blog/blog-category-' . $post_category_style . '.php'; ?>
	</div>
<?php } ?>
<?php if ( ! empty( $display_post_meta ) && $display_post_meta == 'yes' ) { ?>
		<?php include THEPLUS_WSTYLES . 'blog/blog-post-meta-' . $post_meta_tag_style . '.php'; ?>
<?php } ?>
<div class="post-metro-content">
	<?php require THEPLUS_WSTYLES . 'blog/post-meta-title.php'; ?>
	<?php if ( ! empty( $display_excerpt ) && $display_excerpt == 'yes' && get_the_excerpt() ) { ?>
		<div class="post-hover-content">
			<?php include THEPLUS_WSTYLES . 'blog/get-excerpt.php'; ?>
		</div>
	<?php } ?>
	<?php
	if ( $the_button != '' ) {
		echo $the_button;
	}
	?>
</div>
