<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://posimyth.com/
 * @since      1.0.0
 *
 * @package    ThePlus
 */

/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tp_Social_Reviews' ) ) {

	/**
	 * It is Tp_Social_Reviews Main Class
	 *
	 * @since 1.0.0
	 */
	class Tp_Social_Reviews {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Define the core functionality of the plugin.
		 *
		 * @version 5.4.2
		 */
		public function __construct() {
			add_action( 'wp_ajax_tp_reviews_load', array( $this, 'tp_reviews_load' ) );
			add_action( 'wp_ajax_nopriv_tp_reviews_load', array( $this, 'tp_reviews_load' ) );
		}

		/**
		 * Load more reviews & Ajax Call Funcction
		 *
		 * @version 5.4.2
		 */
		public function tp_reviews_load() {

			ob_start();

			$result = array();

			$load_attr = isset( $_POST['loadattr'] ) ? wp_unslash( $_POST['loadattr'] ) : '';
			if ( empty( $load_attr ) ) {
				ob_get_contents();
				ob_end_clean();
				exit;
			}

			$load_attr = tp_check_decrypt_key( $load_attr );
			$load_attr = json_decode( $load_attr, true );
			if ( ! is_array( $load_attr ) ) {
				ob_get_contents();
				exit;
				ob_end_clean();
			}
			$nonce = ( isset( $load_attr['theplus_nonce'] ) ) ? wp_unslash( $load_attr['theplus_nonce'] ) : '';
			if ( ! wp_verify_nonce( $nonce, 'theplus-addons' ) ) {
				die( 'Security checked!' );
			}

			$load_class = isset( $load_attr['load_class'] ) ? sanitize_text_field( wp_unslash( $load_attr['load_class'] ) ) : '';
			$style      = isset( $load_attr['style'] ) ? sanitize_text_field( wp_unslash( $load_attr['style'] ) ) : '';
			$layout     = isset( $load_attr['layout'] ) ? sanitize_text_field( wp_unslash( $load_attr['layout'] ) ) : '';

			$desktop_column = ( isset( $load_attr['desktop_column'] ) && intval( $load_attr['desktop_column'] ) ) ? wp_unslash( $load_attr['desktop_column'] ) : '';
			$tablet_column  = ( isset( $load_attr['tablet_column'] ) && intval( $load_attr['tablet_column'] ) ) ? wp_unslash( $load_attr['tablet_column'] ) : '';
			$mobile_column  = ( isset( $load_attr['mobile_column'] ) && intval( $load_attr['mobile_column'] ) ) ? wp_unslash( $load_attr['mobile_column'] ) : '';
			$DesktopClass   = isset( $load_attr['DesktopClass'] ) ? sanitize_text_field( wp_unslash( $load_attr['DesktopClass'] ) ) : '';

			$TabletClass = isset( $load_attr['TabletClass'] ) ? sanitize_text_field( wp_unslash( $load_attr['TabletClass'] ) ) : '';
			$MobileClass = isset( $load_attr['MobileClass'] ) ? sanitize_text_field( wp_unslash( $load_attr['MobileClass'] ) ) : '';
			$CategoryWF  = isset( $load_attr['categorytext'] ) ? sanitize_text_field( wp_unslash( $load_attr['categorytext'] ) ) : '';

			$FeedId    = ( ! empty( $_POST['FeedId'] ) && isset( $load_attr['FeedId'] ) ) ? wp_unslash( preg_split( '/\,/', $load_attr['FeedId'] ) ) : '';
			$txtLimt   = isset( $load_attr['TextLimit'] ) ? wp_unslash( $load_attr['TextLimit'] ) : '';
			$TextCount = isset( $load_attr['TextCount'] ) ? wp_unslash( $load_attr['TextCount'] ) : '';
			$TextType  = isset( $load_attr['TextType'] ) ? wp_unslash( $load_attr['TextType'] ) : '';
			$TextMore  = isset( $load_attr['TextMore'] ) ? wp_unslash( $load_attr['TextMore'] ) : '';
			$TextDots  = isset( $load_attr['TextDots'] ) ? wp_unslash( $load_attr['TextDots'] ) : '';
			$postview  = ( isset( $load_attr['postview'] ) && intval( $load_attr['postview'] ) ) ? wp_unslash( $load_attr['postview'] ) : '';
			$display   = ( isset( $load_attr['display'] ) && intval( $load_attr['display'] ) ) ? wp_unslash( $load_attr['display'] ) : '';
			$view      = isset( $_POST['view'] ) ? intval( $_POST['view'] ) : array();

			$feedshow   = isset( $_POST['feedshow'] ) ? intval( $_POST['feedshow'] ) : array();
			$FinalData  = get_transient( 'SR-LoadMore-' . $load_class );
			$FinalDataa = array_slice( $FinalData, $view, $feedshow );

			$desktop_class = '';
			$tablet_class  = '';
			$mobile_class  = '';

			if ( 'carousel' !== $layout ) {
				$desktop_class .= ' tp-col-12';
				$desktop_class  = 'tp-col-lg-' . esc_attr( $desktop_column );
				$tablet_class   = 'tp-col-md-' . esc_attr( $tablet_column );
				$mobile_class   = 'tp-col-sm-' . esc_attr( $mobile_column );
				$mobile_class  .= ' tp-col-' . esc_attr( $mobile_column );
			}

			foreach ( $FinalDataa as $F_index => $Review ) {
				$r_key     = ! empty( $Review['RKey'] ) ? $Review['RKey'] : '';
				$RIndex   = ! empty( $Review['Reviews_Index'] ) ? $Review['Reviews_Index'] : '';
				$PostId   = ! empty( $Review['PostId'] ) ? $Review['PostId'] : '';
				$Type     = ! empty( $Review['Type'] ) ? $Review['Type'] : '';
				$Time     = ! empty( $Review['CreatedTime'] ) ? $Review['CreatedTime'] : '';
				$UName    = ! empty( $Review['UserName'] ) ? $Review['UserName'] : '';
				$UImage   = ! empty( $Review['UserImage'] ) ? $Review['UserImage'] : '';
				$ULink    = ! empty( $Review['UserLink'] ) ? $Review['UserLink'] : '';
				$PageLink = ! empty( $Review['PageLink'] ) ? $Review['PageLink'] : '';
				$Massage  = ! empty( $Review['Massage'] ) ? $Review['Massage'] : '';
				$Icon     = ! empty( $Review['Icon']['value'] ) ? $Review['Icon']['value'] : 'fas fa-star';
				$Logo     = ! empty( $Review['Logo'] ) ? $Review['Logo'] : '';
				$rating   = ! empty( $Review['rating'] ) ? $Review['rating'] : '';

				$CategoryText = ! empty( $Review['FilterCategory'] ) ? $Review['FilterCategory'] : '';
				$ReviewClass  = ! empty( $Review['selectType'] ) ? ' ' . $Review['selectType'] : '';

				$ErrClass     = ! empty( $Review['ErrorClass'] ) ? $Review['ErrorClass'] : '';
				$PlatformName = ! empty( $Review['selectType'] ) ? ucwords( str_replace( 'custom', '', $Review['selectType'] ) ) : '';

				$category_filter = $loop_category = '';
				if ( ! empty( $CategoryWF ) && 'yes' === $CategoryWF && ! empty( $CategoryText ) && 'carousel' !== $layout ) {
					$loop_category = explode( ',', $CategoryText );

					foreach ( $loop_category as $category ) {
						$category         = preg_replace( '/[^A-Za-z0-9-]+/', '-', $category );
						$category_filter .= ' ' . esc_attr( $category ) . ' ';
					}
				}

				if ( ! empty( $style ) ) {
					include THEPLUS_WSTYLES . 'social-reviews/social-review-' . sanitize_file_name( $style ) . '.php';
				}
			}

			$GridData = ob_get_clean();

			$result['success']     = 1;
			$result['TotalReview'] = isset( $load_attr['TotalReview'] ) ? wp_unslash( $load_attr['TotalReview'] ) : '';
			$result['FilterStyle'] = isset( $load_attr['FilterStyle'] ) ? wp_unslash( $load_attr['FilterStyle'] ) : '';
			$result['allposttext'] = isset( $load_attr['allposttext'] ) ? wp_unslash( $load_attr['allposttext'] ) : '';
			$result['HTMLContent'] = $GridData;

			echo json_encode( $result );

			exit();
		}
	}

	return Tp_Social_Reviews::get_instance();
}
