<?php
/**
 * Social review style 2
 *
 * @link       https://posimyth.com/
 * @package    ThePlus
 */

?>
<div class="grid-item <?php echo esc_attr( $desktop_class ) . ' ' . esc_attr( $tablet_class ) . ' ' . esc_attr( $mobile_class ) . ' ' . esc_attr( $category_filter ) . ' ' . esc_attr( $r_key ) . ' ' . esc_attr( $ReviewClass ); ?>">
	<?php require THEPLUS_WSTYLES . 'social-reviews/social-review-ob-style.php'; ?>

	<div class="tp-review <?php echo esc_attr( $ErrClass ); ?>" >
		<?php
			echo '<div class="tp-SR-header">';
			echo $Profile_HTML;

		if ( 'layout-1' === $UserFooter ) {
			echo $UserName_HTML;
		}

			echo $Star_HTML;
			echo '</div>';
			echo $Description_HTML;
		?>

		<div class="tp-SR-header"> <?php
			
			if ( 'layout-2' === $UserFooter ) {
				echo $UserName_HTML;
				echo $Time_HTML;
			} ?>

			<div class="tp-SR-bottom-logo" >
				<?php echo $Logo_HTML; ?>
				<div class="tp-SR-logotext" >
					<span class="tp-newline" >
						<?php echo esc_html__( 'Posted On ', 'theplus' ) . esc_html( $PlatformName ); ?>
					</span>
				</div>
			</div>
		</div>
	</div>
	<?php echo $Copyid_html; ?>
</div>
