<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://posimyth.com/
 * @since      5.5.4
 *
 * @package    ThePlus
 */

/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tp_Woo_Listing' ) ) {

	/**
	 * It is Tp_Woo_Listing Main Class
	 *
	 * @since 5.5.4
	 */
	class Tp_Woo_Listing {

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
		 * @since 5.5.4
		 */
		public function __construct() {
			add_action( 'wp_ajax_tp_wl_get_all_data_ajax', array( $this, 'tp_wl_get_all_data' ) );
			add_action( 'wp_ajax_nopriv_tp_wl_get_all_data_ajax', array( $this, 'tp_wl_get_all_data' ) );
		}

		/**
		 * All data get from Woo Listing 
		 *
		 * @since 5.5.4
		 */
        public function tp_wl_get_all_data() {

			check_ajax_referer( 'theplus-addons', 'security' );

			$login = ! empty( $_POST['login'] ) ? wp_unslash( $_POST['login'] ) : '';

			$optiondata = isset( $_POST['option'] ) ? wp_unslash( $_POST['option'] ) : array();
			if ( ! is_array( $optiondata ) ) {
				ob_get_contents();
				exit;
				ob_end_clean();
			}


			if ( empty( $optiondata ) || ! is_array( $optiondata ) ) {
				$result['HtmlData']     = array();
				$result['HtmlError']    = array();
				$result['htmljsondata'] = array();

				wp_die();
			}
			
			$listingtype = ! empty( $_POST['listingtype'] ) ? wp_unslash( $_POST['listingtype'] ) : array();

			if( 'wishlist' === $listingtype && 'false' === $login ) {
				$shoplist = ! empty( $_POST['notloginwl'] ) ? wp_unslash( $_POST['notloginwl'] ) : array();
			}

			foreach ( $optiondata as $key => $postdata ) {
				$uwl = array();

				$postdata = tp_check_decrypt_key( $postdata );
				$postdata = json_decode( $postdata, true );

				$wishlistdynname = ! empty( $postdata['shopname'] ) ? wp_unslash( $postdata['shopname'] ) : 'tpwishlist';

				if ( 'true' === $login ) {
					$user = wp_get_current_user();

					$user_wishlist = get_user_meta( $user->ID, $wishlistdynname, true );
					if ( $user_wishlist ) {
						$uwl = $user_wishlist;
					}
				} else {
					if( 'wishlist' === $listingtype ) {
						$uwl = ! empty( $shoplist[$key] ) ? wp_unslash( $shoplist[$key] ) : array();
					}
					if( 'recently_viewed' === $listingtype ){
						$uwl = ! empty( $_POST['notloginwl'] ) ? wp_unslash( $_POST['notloginwl'] ) : array();
					}
				}

				$desktop_class = '';
				$tablet_class  = '';
				$mobile_class  = '';

				$layout = isset( $postdata['layout'] ) ? sanitize_text_field( wp_unslash( $postdata['layout'] ) ) : '';
				$style  = isset( $postdata['style'] ) ? sanitize_text_field( wp_unslash( $postdata['style'] ) ) : 'style-1';

				$widgetName = isset( $postdata['load'] ) ? sanitize_text_field( wp_unslash( $postdata['load'] ) ) : '';
				/** $filter_type = ! empty( $postdata['filtertype'] ) ? $postdata['filtertype'] : '';*/
				$post_load   = $widgetName;
				$post_type   = isset( $postdata['post_type'] ) ? sanitize_text_field( wp_unslash( $postdata['post_type'] ) ) : '';
				$filter_type = ! empty( $postdata['listing_type'] ) && 'wishlist' === $postdata['listing_type'] ? $postdata['listing_type'] : '';

				$DisplayPost  = isset( $postdata['display_post'] ) && intval( $postdata['display_post'] ) ? sanitize_text_field( $postdata['display_post'] ) : 4;
				$display_post = $DisplayPost;           // Not used.

				$post_load_more = isset( $postdata['post_load_more'] ) && intval( $postdata['post_load_more'] ) ? wp_unslash( $postdata['post_load_more'] ) : 1;
				$post_title_tag = isset( $postdata['post_title_tag'] ) ? wp_unslash( $postdata['post_title_tag'] ) : '';
				$desktop_column = isset( $postdata['desktop-column'] ) && intval( $postdata['desktop-column'] ) ? wp_unslash( $postdata['desktop-column'] ) : 3;
				$tablet_column  = isset( $postdata['tablet-column'] ) && intval( $postdata['tablet-column'] ) ? wp_unslash( $postdata['tablet-column'] ) : 4;
				$mobile_column  = isset( $postdata['mobile-column'] ) && intval( $postdata['mobile-column'] ) ? wp_unslash( $postdata['mobile-column'] ) : 6;

				$metro_column = isset( $postdata['metro_column'] ) ? wp_unslash( $postdata['metro_column'] ) : '';
				$metro_style  = isset( $postdata['metro_style'] ) ? wp_unslash( $postdata['metro_style'] ) : '';

				$responsive_tablet_metro = isset( $postdata['responsive_tablet_metro'] ) ? wp_unslash( $postdata['responsive_tablet_metro'] ) : '';

				$tablet_metro_column = isset( $postdata['tablet_metro_column'] ) ? wp_unslash( $postdata['tablet_metro_column'] ) : '';
				$tablet_metro_style  = isset( $postdata['tablet_metro_style'] ) ? wp_unslash( $postdata['tablet_metro_style'] ) : '';

				$category = isset( $postdata['category'] ) ? wp_unslash( $postdata['category'] ) : '';
				$order_by = isset( $postdata['order_by'] ) ? sanitize_text_field( wp_unslash( $postdata['order_by'] ) ) : '';

				$post_order = isset( $postdata['post_order'] ) ? sanitize_text_field( wp_unslash( $postdata['post_order'] ) ) : '';

				$filter_category  = isset( $postdata['filter_category'] ) ? sanitize_text_field( wp_unslash( $postdata['filter_category'] ) ) : '';
				$animated_columns = isset( $postdata['animated_columns'] ) ? sanitize_text_field( wp_unslash( $postdata['animated_columns'] ) ) : '';

				$featured_image_type = isset( $postdata['featured_image_type'] ) ? wp_unslash( $postdata['featured_image_type'] ) : '';
				$display_thumbnail   = isset( $postdata['display_thumbnail'] ) ? wp_unslash( $postdata['display_thumbnail'] ) : '';

				$thumbnail     = isset( $postdata['thumbnail'] ) ? wp_unslash( $postdata['thumbnail'] ) : '';
				$thumbnail_car = isset( $postdata['thumbnail_car'] ) ? wp_unslash( $postdata['thumbnail_car'] ) : '';

				$display_theplus_quickview = isset( $postdata['display_theplus_quickview'] ) ? wp_unslash( $postdata['display_theplus_quickview'] ) : '';

				$includePosts = isset( $postdata['include_posts'] ) && intval( $postdata['include_posts'] ) ? wp_unslash( $postdata['include_posts'] ) : '';
				$excludePosts = isset( $postdata['exclude_posts'] ) && intval( $postdata['exclude_posts'] ) ? wp_unslash( $postdata['exclude_posts'] ) : '';

				$paged = isset( $postdata['page'] ) && intval( $postdata['page'] ) ? wp_unslash( $postdata['page'] ) : '';          // Not used.

				$dynamic_template = isset( $postdata['skin_template'] ) ? $postdata['skin_template'] : '';

				$is_archivePage  = isset( $postdata['is_archive'] ) ? $postdata['is_archive'] : 0;
				$Archivepage     = isset( $postdata['archive_page'] ) ? $postdata['archive_page'] : '';
				$ArchivepageType = ! empty( $Archivepage ) && ! empty( $Archivepage['archive_Type'] ) ? sanitize_text_field( $Archivepage['archive_Type'] ) : '';
				$ArchivepageID   = ! empty( $Archivepage ) && ! empty( $Archivepage['archive_Id'] ) ? $Archivepage['archive_Id'] : '';

				$is_searchPage = isset( $postdata['is_search'] ) ? $postdata['is_search'] : 0;
				$SearchPage    = isset( $postdata['is_search_page'] ) ? $postdata['is_search_page'] : '';
				$SearchPageval = ! empty( $SearchPage ) && ! empty( $SearchPage['is_search_value'] ) ? sanitize_text_field( $SearchPage['is_search_value'] ) : '';
				$CustonQuery   = ! empty( $postdata['custon_query'] ) ? $postdata['custon_query'] : '';

				/** Dynamic Listing*/
				if ( 'dynamiclisting' === $widgetName ) {
					$display_post_category = ! empty( $postdata['display_post_category'] ) ? $postdata['display_post_category'] : '';
					$post_category_style   = isset( $postdata['post_category_style'] ) ? wp_unslash( $postdata['post_category_style'] ) : '';
					$title_desc_word_break = isset( $postdata['title_desc_word_break'] ) ? wp_unslash( $postdata['title_desc_word_break'] ) : '';

					$display_button = isset( $postdata['display_button'] ) ? wp_unslash( $postdata['display_button'] ) : '';

					$display_excerpt   = isset( $postdata['display_excerpt'] ) ? wp_unslash( $postdata['display_excerpt'] ) : '';
					$texonomy_category = isset( $postdata['texonomy_category'] ) ? sanitize_text_field( wp_unslash( $postdata['texonomy_category'] ) ) : '';

					$author_prefix = isset( $postdata['author_prefix'] ) ? wp_unslash( $postdata['author_prefix'] ) : '';
					$style_layout  = isset( $postdata['style_layout'] ) ? sanitize_text_field( wp_unslash( $postdata['style_layout'] ) ) : '';
					$post_tags     = isset( $postdata['post_tags'] ) ? wp_unslash( $postdata['post_tags'] ) : '';
					$post_authors  = isset( $postdata['post_authors'] ) ? wp_unslash( $postdata['post_authors'] ) : '';

					$display_post_meta   = isset( $postdata['display_post_meta'] ) ? sanitize_text_field( wp_unslash( $postdata['display_post_meta'] ) ) : '';
					$post_meta_tag_style = isset( $postdata['post_meta_tag_style'] ) ? wp_unslash( $postdata['post_meta_tag_style'] ) : '';

					$display_post_meta_date   = isset( $postdata['display_post_meta_date'] ) ? wp_unslash( $postdata['display_post_meta_date'] ) : '';
					$display_post_meta_author = isset( $postdata['display_post_meta_author'] ) ? wp_unslash( $postdata['display_post_meta_author'] ) : '';

					$display_post_meta_author_pic = isset( $postdata['display_post_meta_author_pic'] ) ? wp_unslash( $postdata['display_post_meta_author_pic'] ) : '';

					$post_excerpt_count   = isset( $postdata['post_excerpt_count'] ) ? wp_unslash( $postdata['post_excerpt_count'] ) : '';
					$dpc_all              = isset( $postdata['dpc_all'] ) ? wp_unslash( $postdata['dpc_all'] ) : '';
					$display_title_limit  = isset( $postdata['display_title_limit'] ) ? wp_unslash( $postdata['display_title_limit'] ) : '';
					$display_title_by     = isset( $postdata['display_title_by'] ) ? wp_unslash( $postdata['display_title_by'] ) : '';
					$display_title_input  = isset( $postdata['display_title_input'] ) ? wp_unslash( $postdata['display_title_input'] ) : '';
					$display_title_3_dots = isset( $postdata['display_title_3_dots'] ) ? wp_unslash( $postdata['display_title_3_dots'] ) : '';

					$feature_image   = isset( $postdata['feature_image'] ) ? wp_unslash( $postdata['feature_image'] ) : '';
					$full_image_size = ! empty( $postdata['full_image_size'] ) ? $postdata['full_image_size'] : 'yes';

				}

				/** Product Listing*/
				if ( 'products' === $widgetName ) {
					$out_of_stock    = isset( $postdata['out_of_stock'] ) ? sanitize_text_field( wp_unslash( $postdata['out_of_stock'] ) ) : '';
					$display_rating  = isset( $postdata['display_rating'] ) ? wp_unslash( $postdata['display_rating'] ) : '';
					$display_product = isset( $postdata['display_product'] ) ? wp_unslash( $postdata['display_product'] ) : '';

					$b_dis_badge_switch = isset( $postdata['badge'] ) ? sanitize_text_field( wp_unslash( $postdata['badge'] ) ) : '';
					$variation_price_on = isset( $postdata['variationprice'] ) ? sanitize_text_field( wp_unslash( $postdata['variationprice'] ) ) : '';
					$hover_image_on_off = isset( $postdata['hoverimagepro'] ) ? sanitize_text_field( wp_unslash( $postdata['hoverimagepro'] ) ) : '';

					$display_catagory  = isset( $postdata['display_catagory'] ) ? wp_unslash( $postdata['display_catagory'] ) : '';
					$display_yith_list = isset( $postdata['display_yith_list'] ) ? wp_unslash( $postdata['display_yith_list'] ) : '';

					$display_yith_compare  = isset( $postdata['display_yith_compare'] ) ? wp_unslash( $postdata['display_yith_compare'] ) : '';
					$display_yith_wishlist = isset( $postdata['display_yith_wishlist'] ) ? wp_unslash( $postdata['display_yith_wishlist'] ) : '';

					$display_cart_button = isset( $postdata['cart_button'] ) ? wp_unslash( $postdata['cart_button'] ) : '';
					$dcb_single_product  = isset( $postdata['dcb_single_product'] ) ? wp_unslash( $postdata['dcb_single_product'] ) : '';

					$display_yith_quickview = isset( $postdata['display_yith_quickview'] ) ? wp_unslash( $postdata['display_yith_quickview'] ) : '';
					$dcb_variation_product  = isset( $postdata['dcb_variation_product'] ) ? wp_unslash( $postdata['dcb_variation_product'] ) : '';
				}

				$No_PostFound = isset( $postdata['No_PostFound'] ) ? wp_unslash( $postdata['No_PostFound'] ) : '';

				$tablet_metro_class = 0;

				$kij = 0;
				$ji  = 1;
				$ij  = '';

				if ( 'carousel' !== $layout && 'metro' !== $layout ) {
					$desktop_class = 'tp-col-lg-' . esc_attr( $desktop_column );
					$tablet_class  = 'tp-col-md-' . esc_attr( $tablet_column );
					$mobile_class  = 'tp-col-sm-' . esc_attr( $mobile_column );
					$mobile_class .= ' tp-col-' . esc_attr( $mobile_column );
				}

				if ( ! empty( $CustonQuery ) ) {
					$args = array();
					if ( has_filter( $CustonQuery ) ) {
						$args = apply_filters( $CustonQuery, $args );
					}
				} else {
					$args = array(
						'post_type'      => $post_type,
						'post_status'    => 'publish',
						'post__in'       => $uwl,
						'posts_per_page' => $display_post,
						'orderby'        => $order_by,
						'order'          => $post_order,
						'offset'         => 0,
					);
				}

				$newc = ! empty( $uwl ) ? count( $uwl ) : 0;
				
				ob_start();
				$loop = new WP_Query( $args );

				$totalcount = $loop->found_posts;

				/** Dynamic Listing*/
				if ( 'dynamiclisting' === $widgetName ) {
					if ( $loop->have_posts() ) {
						while ( $loop->have_posts() ) {
							$loop->the_post();

							$template_id = '';
							if ( ! empty( $dynamic_template ) ) {
								$count = count( $dynamic_template );
								$value = (int) $offset % (int) $count;

								$template_id = $dynamic_template[ $value ];
							}

							// Read more button.
							$the_button = '';
							if ( 'yes' === $display_button ) {

								$btn_uid = uniqid( 'btn' );

								$data_class  = $btn_uid;
								$data_class .= ' button-' . $button_style . ' ';

								$the_button = '<div class="pt-plus-button-wrapper">';

									$the_button .= '<div class="button_parallax">';

										$the_button .= '<div class="ts-button">';

											$the_button .= '<div class="pt_plus_button ' . $data_class . '">';

												$the_button .= '<div class="animted-content-inner">';

													$the_button .= '<a href="' . esc_url( get_the_permalink() ) . '" class="button-link-wrap" role="button" rel="nofollow">';

														$the_button .= include THEPLUS_WSTYLES . 'blog/post-button.php';

													$the_button .= '</a>';

												$the_button .= '</div>';

											$the_button .= '</div>';

										$the_button .= '</div>';

									$the_button .= '</div>';

								$the_button .= '</div>';
							}
							include THEPLUS_WSTYLES . 'ajax-load-post/dynamic-listing-style.php';
							++$ji;
							++$kij;
						}
					}
				}

				/** Product Listing*/
				if ( 'products' === $widgetName ) {
					if ( $loop->have_posts() ) {
						while ( $loop->have_posts() ) {
							$loop->the_post();

							$template_id = '';
							if ( ! empty( $dynamic_template ) ) {
								$count = count( $dynamic_template );
								$value = (int) $offset % (int) $count;

								$template_id = $dynamic_template[ $value ];
							}

							include THEPLUS_WSTYLES . 'ajax-load-post/product-style.php';
							++$ji;
							++$kij;
						}
					}
				}

				$Alldata = ob_get_contents();
				ob_end_clean();

				$user = wp_get_current_user();
				if ( ! empty( $Alldata ) ) {
					$result[$key]['HtmlData']     = $Alldata;
					$result[$key]['HtmlError']    = $No_PostFound;
					$result[$key]['status']       = 1;
					$result[$key]['htmljsondata'] = wp_json_encode(
						array(
							'user_id'  => $user->ID,
							'listdata' => $uwl,
							'count'    => $newc,
						)
					);
				} else {
					$result[$key]['HtmlData']     = array();
					$result[$key]['HtmlError']    = $No_PostFound;
					$result[$key]['status']       = 0;
					$result[$key]['htmljsondata'] = array( '0' );
				}
			}

			wp_reset_postdata();
			wp_send_json( $result );
		}
	}

	return Tp_Woo_Listing::get_instance();
}