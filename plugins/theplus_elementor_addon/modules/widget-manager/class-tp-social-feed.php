<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://posimyth.com/
 * @since      5.4.2
 *
 * @package    ThePlus
 */

/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tp_Social_Feed' ) ) {

	/**
	 * It is Tp_Social_Feed Main Class
	 *
	 * @since 5.4.2
	 */
	class Tp_Social_Feed {

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
		 * @since 5.4.2
		 */
		public function __construct() {
			add_action( 'wp_ajax_tp_feed_load', array( $this, 'tp_feed_load' ) );
			add_action( 'wp_ajax_nopriv_tp_feed_load', array( $this, 'tp_feed_load' ) );
		}

		/**
		 * Define Ajax function
		 *
		 * @since 1.0.0
		 */
		public function tp_feed_load() {
			ob_start();
			$result    = array();
			$load_attr = isset( $_POST['loadattr'] ) ? wp_unslash( $_POST['loadattr'] ) : '';

			if ( empty( $load_attr ) ) {
				ob_get_contents();
				exit;
				ob_end_clean();
			}

			$load_attr = tp_check_decrypt_key( $load_attr );
			$load_attr = json_decode( $load_attr, true );
			if ( ! is_array( $load_attr ) ) {
				ob_get_contents();
				exit;
				ob_end_clean();
			}

			$nonce = isset( $load_attr['theplus_nonce'] ) ? wp_unslash( $load_attr['theplus_nonce'] ) : '';
			if ( ! wp_verify_nonce( $nonce, 'theplus-addons' ) ) {
				die( 'Security checked!' );
			}

			$load_class = isset( $load_attr['load_class'] ) ? sanitize_text_field( wp_unslash( $load_attr['load_class'] ) ) : uniqid( 'tp-sfeed' );
			$style      = isset( $load_attr['style'] ) ? sanitize_text_field( wp_unslash( $load_attr['style'] ) ) : 'style-1';
			$layout     = isset( $load_attr['layout'] ) ? sanitize_text_field( wp_unslash( $load_attr['layout'] ) ) : 'grid';

			$desktop_column = ( isset( $load_attr['desktop_column'] ) && intval( $load_attr['desktop_column'] ) ) ? wp_unslash( $load_attr['desktop_column'] ) : '';
			$tablet_column  = ( isset( $load_attr['tablet_column'] ) && intval( $load_attr['tablet_column'] ) ) ? wp_unslash( $load_attr['tablet_column'] ) : '';
			$mobile_column  = ( isset( $load_attr['mobile_column'] ) && intval( $load_attr['mobile_column'] ) ) ? wp_unslash( $load_attr['mobile_column'] ) : '';

			$DesktopClass = isset( $load_attr['DesktopClass'] ) ? sanitize_text_field( wp_unslash( $load_attr['DesktopClass'] ) ) : '';
			$TabletClass  = isset( $load_attr['TabletClass'] ) ? sanitize_text_field( wp_unslash( $load_attr['TabletClass'] ) ) : '';
			$MobileClass  = isset( $load_attr['MobileClass'] ) ? sanitize_text_field( wp_unslash( $load_attr['MobileClass'] ) ) : '';
			$postview     = ( isset( $load_attr['postview'] ) && intval( $load_attr['postview'] ) ) ? wp_unslash( $load_attr['postview'] ) : '';
			$display      = ( isset( $load_attr['display'] ) && intval( $load_attr['display'] ) ) ? wp_unslash( $load_attr['display'] ) : '';
			$txtLimt      = isset( $load_attr['TextLimit'] ) ? wp_unslash( $load_attr['TextLimit'] ) : '';
			$TextCount    = isset( $load_attr['TextCount'] ) ? wp_unslash( $load_attr['TextCount'] ) : '';
			$TextType     = isset( $load_attr['TextType'] ) ? wp_unslash( $load_attr['TextType'] ) : '';
			$TextMore     = isset( $load_attr['TextMore'] ) ? wp_unslash( $load_attr['TextMore'] ) : '';
			$TextDots     = isset( $load_attr['TextDots'] ) ? wp_unslash( $load_attr['TextDots'] ) : '';
			$FancyStyle   = isset( $load_attr['FancyStyle'] ) ? wp_unslash( $load_attr['FancyStyle'] ) : 'default';
			$DescripBTM   = isset( $load_attr['DescripBTM'] ) ? wp_unslash( $load_attr['DescripBTM'] ) : '';
			$MediaFilter  = isset( $load_attr['MediaFilter'] ) ? wp_unslash( $load_attr['MediaFilter'] ) : 'default';
			$CategoryWF   = isset( $load_attr['categorytext'] ) ? wp_unslash( $load_attr['categorytext'] ) : '';
			$TotalPost    = ( isset( $load_attr['TotalPost'] ) && intval( $load_attr['TotalPost'] ) ) ? wp_unslash( $load_attr['TotalPost'] ) : '';
			$PopupOption  = isset( $load_attr['PopupOption'] ) ? wp_unslash( $load_attr['PopupOption'] ) : 'OnFancyBox';

			$uid_sfeed = $load_class;
			$FinalData = get_transient( 'SF-Loadmore-' . $load_class );
			$view      = isset( $_POST['view'] ) ? intval( $_POST['view'] ) : array();
			$feedshow  = isset( $_POST['feedshow'] ) ? intval( $_POST['feedshow'] ) : array();

			$FancyBoxJS = '';
			if ( 'OnFancyBox' === $PopupOption ) {
				$FancyBoxJS = 'data-fancybox=' . esc_attr( $load_class );
			}

			$desktop_class = '';
			$tablet_class  = '';
			$mobile_class  = '';
			if ( 'carousel' !== $layout ) {
				$desktop_class = 'tp-col-lg-' . esc_attr( $desktop_column );
				$tablet_class  = 'tp-col-md-' . esc_attr( $tablet_column );
				$mobile_class  = 'tp-col-sm-' . esc_attr( $mobile_column );
				$mobile_class .= ' tp-col-' . esc_attr( $mobile_column );
			}

			$FinalDataa = array();
			if ( is_array( $FinalData ) ) {
				$FinalDataa = array_slice( $FinalData, $view, $feedshow );
			}

			if ( ! empty( $FinalDataa ) ) {
				foreach ( $FinalDataa as $F_index => $loadData ) {
					$PopupTarget = $PopupLink = '';
					$uniqEach    = uniqid();
					$PopupSylNum = "{$uid_sfeed}-{$F_index}-{$uniqEach}";

					$RKey       = ! empty( $loadData['RKey'] ) ? $loadData['RKey'] : '';
					$PostId     = ! empty( $loadData['PostId'] ) ? $loadData['PostId'] : '';
					$selectFeed = ! empty( $loadData['selectFeed'] ) ? $loadData['selectFeed'] : '';
					$Massage    = ! empty( $loadData['Massage'] ) ? $loadData['Massage'] : '';

					$Description = ! empty( $loadData['Description'] ) ? $loadData['Description'] : '';

					$Type     = ! empty( $loadData['Type'] ) ? $loadData['Type'] : '';
					$PostLink = ! empty( $loadData['PostLink'] ) ? $loadData['PostLink'] : '';

					$CreatedTime = ! empty( $loadData['CreatedTime'] ) ? $loadData['CreatedTime'] : '';

					$PostImage  = ! empty( $loadData['PostImage'] ) ? $loadData['PostImage'] : '';
					$UserName   = ! empty( $loadData['UserName'] ) ? $loadData['UserName'] : '';
					$UserImage  = ! empty( $loadData['UserImage'] ) ? $loadData['UserImage'] : '';
					$UserLink   = ! empty( $loadData['UserLink'] ) ? $loadData['UserLink'] : '';
					$socialIcon = ! empty( $loadData['socialIcon'] ) ? $loadData['socialIcon'] : '';

					$CategoryText = ! empty( $loadData['FilterCategory'] ) ? $loadData['FilterCategory'] : '';

					$ErrorClass = ! empty( $loadData['ErrorClass'] ) ? $loadData['ErrorClass'] : '';
					$EmbedURL   = ! empty( $loadData['Embed'] ) ? $loadData['Embed'] : '';
					$EmbedType  = ! empty( $loadData['EmbedType'] ) ? $loadData['EmbedType'] : '';
					$FbAlbum    = ! empty( $loadData['FbAlbum'] ) ? $loadData['FbAlbum'] : '';

					$category_filter = '';
					$loop_category   = '';
					if ( ! empty( $CategoryWF == 'yes' ) && ! empty( $CategoryText ) && $layout != 'carousel' ) {
						$loop_category = explode( ',', $CategoryText );
						foreach ( $loop_category as $category ) {
							$category         = preg_replace( '/[^A-Za-z0-9-]+/', '-', $category );
							$category_filter .= ' ' . esc_attr( $category ) . ' ';
						}
					}

					if ( 'Facebook' === $selectFeed ) {
						$Fblikes = ! empty( $loadData['FbLikes'] ) ? $loadData['FbLikes'] : 0;
						$comment = ! empty( $loadData['comment'] ) ? $loadData['comment'] : 0;
						$share   = ! empty( $loadData['share'] ) ? $loadData['share'] : 0;
						$likeImg = THEPLUS_ASSETS_URL . 'images/social-feed/like.png';

						$ReactionImg = THEPLUS_ASSETS_URL . 'images/social-feed/love.png';
					}

					if ( 'Twitter' === $selectFeed ) {
						$TwRT       = ! empty( $loadData['TWRetweet'] ) ? $loadData['TWRetweet'] : 0;
						$TWLike     = ! empty( $loadData['TWLike'] ) ? $loadData['TWLike'] : 0;
						$TwReplyURL = ! empty( $loadData['TwReplyURL'] ) ? $loadData['TwReplyURL'] : '';

						$TwRetweetURL = ! empty( $loadData['TwRetweetURL'] ) ? $loadData['TwRetweetURL'] : '';
						$TwlikeURL    = ! empty( $loadData['TwlikeURL'] ) ? $loadData['TwlikeURL'] : '';
						$TwtweetURL   = ! empty( $loadData['TwtweetURL'] ) ? $loadData['TwtweetURL'] : '';
					}

					if ( 'Vimeo' === $selectFeed ) {
						$share   = ! empty( $loadData['share'] ) ? $loadData['share'] : 0;
						$likes   = ! empty( $loadData['likes'] ) ? $loadData['likes'] : 0;
						$comment = ! empty( $loadData['comment'] ) ? $loadData['comment'] : 0;
					}

					if ( 'Youtube' === $selectFeed ) {
						$view    = ! empty( $loadData['view'] ) ? $loadData['view'] : 0;
						$likes   = ! empty( $loadData['likes'] ) ? $loadData['likes'] : 0;
						$comment = ! empty( $loadData['comment'] ) ? $loadData['comment'] : 0;
						$Dislike = ! empty( $loadData['Dislike'] ) ? $loadData['Dislike'] : 0;
					}

					if ( 'video' === $Type || 'photo' === $Type && 'Instagram' !== $selectFeed ) {
						$videoURL = $PostLink;
						$ImageURL = $PostImage;
					}

					$IGGP_Icon = '';
					if ( 'Instagram' === $selectFeed ) {
						$IGGP_Type = ! empty( $loadData['IG_Type'] ) ? $loadData['IG_Type'] : 'Instagram_Basic';

						if ( 'Instagram_Graph' === $IGGP_Type ) {
							$IGGP_Icon = ! empty( $loadData['IGGP_Icon'] ) ? $loadData['IGGP_Icon'] : '';
							$likes     = ! empty( $loadData['likes'] ) ? $loadData['likes'] : 0;
							$comment   = ! empty( $loadData['comment'] ) ? $loadData['comment'] : 0;
							$videoURL  = $PostLink;
							$PostLink  = ! empty( $loadData['IGGP_PostLink'] ) ? $loadData['IGGP_PostLink'] : '';
							$ImageURL  = $PostImage;

							$IGGP_CAROUSEL = ! empty( $loadData['IGGP_CAROUSEL'] ) ? $loadData['IGGP_CAROUSEL'] : '';
							if ( 'CAROUSEL_ALBUM' === $Type && 'default' === $FancyStyle ) {
								$FancyBoxJS = 'data-fancybox=' . esc_attr( "IGGP-CAROUSEL-{$F_index}-{$uniqEach}" );
							} else {
								$FancyBoxJS = 'data-fancybox=' . esc_attr( $uid_sfeed );
							}
						} elseif ( 'Instagram_Basic' === $IGGP_Type ) {
							$videoURL = $PostLink;
							$ImageURL = $PostImage;
						}
					}

					if ( ! empty( $FbAlbum ) ) {
						$PostLink   = ! empty( $PostLink[0]['link'] ) ? $PostLink[0]['link'] : 0;
						$FancyBoxJS = 'data-fancybox=' . esc_attr( "album-Facebook{$F_index}-{$uid_sfeed}" );
					}

					if ( ( $F_index < $TotalPost ) && ( ( $MediaFilter == 'default' ) || ( $MediaFilter == 'ompost' && ! empty( $PostLink ) && ! empty( $PostImage ) ) || ( $MediaFilter == 'hmcontent' && empty( $PostLink ) && empty( $PostImage ) ) ) ) {
						echo '<div class="grid-item ' . esc_attr( 'feed-' . $selectFeed . ' ' . $desktop_class . ' ' . $tablet_class . ' ' . $mobile_class . ' ' . $RKey . ' ' . $category_filter ) . '" data-index="' . esc_attr( $selectFeed . $F_index ) . '">';
						if ( ! empty( $style ) ) {
							include THEPLUS_WSTYLES . 'social-feed/social-feed-' . $style . '.php';
						}
						echo '</div>';
					}
				}
			}

			$GridData = ob_get_clean();

			$result['success']      = 1;
			$result['totalFeed']    = isset( $load_attr['totalFeed'] ) ? wp_unslash( $load_attr['totalFeed'] ) : '';
			$result['FilterStyle']  = isset( $load_attr['FilterStyle'] ) ? wp_unslash( $load_attr['FilterStyle'] ) : '';
			$result['allposttext']  = isset( $load_attr['allposttext'] ) ? wp_unslash( $load_attr['allposttext'] ) : '';
			$result['HTMLContent']  = $GridData;
			$result['maximumposts'] = (int) $TotalPost;

			wp_send_json( $result );
		}
	}

	return Tp_Social_Feed::get_instance();
}
