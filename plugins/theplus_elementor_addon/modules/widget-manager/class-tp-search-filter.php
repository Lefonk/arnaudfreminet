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

if ( ! class_exists( 'Tp_Search_Filter' ) ) {

	/**
	 * It is Tp_Search_Filter Main Class
	 *
	 * @since 5.4.2
	 */
	class Tp_Search_Filter {

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
			add_action( 'wp_ajax_theplus_filter_post', array( $this, 'theplus_filter_post' ) );
			add_action( 'wp_ajax_nopriv_theplus_filter_post', array( $this, 'theplus_filter_post' ) );
		}

		/**
		 * Search filter for posts.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function theplus_filter_post() {
			global $post, $wpdb;

			check_ajax_referer( 'theplus-searchfilter', 'nonce' );

			$optiondata = isset( $_POST['option'] ) ? wp_unslash( $_POST['option'] ) : '';
			if ( empty( $optiondata ) || ! is_array( $optiondata ) ) {
				ob_start();
					ob_get_contents();
				ob_end_clean();
				wp_die();
			}

			$maplocation = array();

			$tablet_metro_class = 0;
			$kij                = 0;

			$ji = 1;
			$ij = '';

			$offset = 0;

			foreach ( $optiondata as $key => $postdata ) {
				$filter_type = ( ! empty( $postdata['filtertype'] ) && 'search_list' === $postdata['filtertype'] ) ? $postdata['filtertype'] : '';
				$widgetname  = isset( $postdata['load'] ) ? sanitize_text_field( wp_unslash( $postdata['load'] ) ) : '';
				$post_load   = $widgetname;

				$desktop_class = '';
				$tablet_class  = '';
				$mobile_class  = '';

				if ( 'dynamiclisting' === $widgetname || 'products' === $widgetname ) {
					$post_type = isset( $postdata['post_type'] ) ? sanitize_text_field( wp_unslash( $postdata['post_type'] ) ) : '';
					$layout    = isset( $postdata['layout'] ) ? sanitize_text_field( wp_unslash( $postdata['layout'] ) ) : '';

					$texonomy_category = isset( $postdata['texonomy_category'] ) ? sanitize_text_field( wp_unslash( $postdata['texonomy_category'] ) ) : '';

					$DisplayPost  = ( isset( $postdata['display_post'] ) && intval( $postdata['display_post'] ) ) ? sanitize_text_field( $postdata['display_post'] ) : 4;
					$display_post = $DisplayPost;       // Not used

					$post_load_more = ( isset( $postdata['post_load_more'] ) && intval( $postdata['post_load_more'] ) ) ? wp_unslash( $postdata['post_load_more'] ) : 1;
					$post_title_tag = isset( $postdata['post_title_tag'] ) ? wp_unslash( $postdata['post_title_tag'] ) : '';

					$style = isset( $postdata['style'] ) ? sanitize_text_field( wp_unslash( $postdata['style'] ) ) : 'style-1';

					$desktop_column = ( isset( $postdata['desktop-column'] ) && intval( $postdata['desktop-column'] ) ) ? wp_unslash( $postdata['desktop-column'] ) : 3;
					$tablet_column  = ( isset( $postdata['tablet-column'] ) && intval( $postdata['tablet-column'] ) ) ? wp_unslash( $postdata['tablet-column'] ) : 4;
					$mobile_column  = ( isset( $postdata['mobile-column'] ) && intval( $postdata['mobile-column'] ) ) ? wp_unslash( $postdata['mobile-column'] ) : 6;
					$metro_column   = isset( $postdata['metro_column'] ) ? wp_unslash( $postdata['metro_column'] ) : '';
					$metro_style    = isset( $postdata['metro_style'] ) ? wp_unslash( $postdata['metro_style'] ) : '';

					$responsive_tablet_metro = isset( $postdata['responsive_tablet_metro'] ) ? wp_unslash( $postdata['responsive_tablet_metro'] ) : '';
					$tablet_metro_column     = isset( $postdata['tablet_metro_column'] ) ? wp_unslash( $postdata['tablet_metro_column'] ) : '';
					$tablet_metro_style      = isset( $postdata['tablet_metro_style'] ) ? wp_unslash( $postdata['tablet_metro_style'] ) : '';

					$category_type = isset( $postdata['category_type'] ) ? $postdata['category_type'] : 'false';
					$category      = isset( $postdata['category'] ) ? wp_unslash( $postdata['category'] ) : '';
					$order_by      = isset( $postdata['order_by'] ) ? sanitize_text_field( wp_unslash( $postdata['order_by'] ) ) : '';
					$post_order    = isset( $postdata['post_order'] ) ? sanitize_text_field( wp_unslash( $postdata['post_order'] ) ) : '';

					$filter_category     = isset( $postdata['filter_category'] ) ? sanitize_text_field( wp_unslash( $postdata['filter_category'] ) ) : '';
					$animated_columns    = isset( $postdata['animated_columns'] ) ? sanitize_text_field( wp_unslash( $postdata['animated_columns'] ) ) : '';
					$featured_image_type = isset( $postdata['featured_image_type'] ) ? wp_unslash( $postdata['featured_image_type'] ) : '';
					$display_thumbnail   = isset( $postdata['display_thumbnail'] ) ? wp_unslash( $postdata['display_thumbnail'] ) : '';

					$thumbnail     = isset( $postdata['thumbnail'] ) ? wp_unslash( $postdata['thumbnail'] ) : '';
					$thumbnail_car = isset( $postdata['thumbnail_car'] ) ? wp_unslash( $postdata['thumbnail_car'] ) : '';

					$display_theplus_quickview = isset( $postdata['display_theplus_quickview'] ) ? wp_unslash( $postdata['display_theplus_quickview'] ) : '';

					$includePosts = ( isset( $postdata['include_posts'] ) && intval( $postdata['include_posts'] ) ) ? wp_unslash( $postdata['include_posts'] ) : '';
					$excludePosts = ( isset( $postdata['exclude_posts'] ) && intval( $postdata['exclude_posts'] ) ) ? wp_unslash( $postdata['exclude_posts'] ) : '';

					$dynamic_template = isset( $postdata['skin_template'] ) ? $postdata['skin_template'] : '';

					$paged = ( isset( $postdata['page'] ) && intval( $postdata['page'] ) ) ? wp_unslash( $postdata['page'] ) : ''; // Not used

					$is_archivePage  = isset( $postdata['is_archive'] ) ? $postdata['is_archive'] : 0;
					$Archivepage     = isset( $postdata['archive_page'] ) ? $postdata['archive_page'] : '';
					$ArchivepageType = ( ! empty( $Archivepage ) && ! empty( $Archivepage['archive_Type'] ) ) ? sanitize_text_field( $Archivepage['archive_Type'] ) : '';
					$ArchivepageID   = ( ! empty( $Archivepage ) && ! empty( $Archivepage['archive_Id'] ) ) ? $Archivepage['archive_Id'] : '';
					$ArchivepageName = ( ! empty( $Archivepage ) && ! empty( $Archivepage['archive_Name'] ) ) ? $Archivepage['archive_Name'] : '';

					$is_searchPage  = isset( $postdata['is_search'] ) ? $postdata['is_search'] : 0;
					$SearchPage     = isset( $postdata['is_search_page'] ) ? $postdata['is_search_page'] : '';
					$search_pageval = ( ! empty( $SearchPage ) && ! empty( $SearchPage['is_search_value'] ) ) ? sanitize_text_field( $SearchPage['is_search_value'] ) : '';
					$CustonQuery    = ! empty( $postdata['custon_query'] ) ? $postdata['custon_query'] : '';

					$enable_archive_search = ( ! empty( $postdata['enablearchive'] ) && 'true' === $postdata['enablearchive'] ) ? 'true' : 'false';

					if ( 'carousel' !== $layout && 'metro' !== $layout ) {
						$desktop_class = 'tp-col-lg-' . esc_attr( $desktop_column );
						$tablet_class  = 'tp-col-md-' . esc_attr( $tablet_column );
						$mobile_class  = 'tp-col-sm-' . esc_attr( $mobile_column );
						$mobile_class .= ' tp-col-' . esc_attr( $mobile_column );
					}
				}

				if ( 'dynamiclisting' === $widgetname ) {
					$title_desc_word_break = isset( $postdata['title_desc_word_break'] ) ? wp_unslash( $postdata['title_desc_word_break'] ) : '';

					$style_layout = isset( $postdata['style_layout'] ) ? sanitize_text_field( wp_unslash( $postdata['style_layout'] ) ) : '';
					$post_tags    = isset( $postdata['post_tags'] ) ? wp_unslash( $postdata['post_tags'] ) : '';
					$post_authors = isset( $postdata['post_authors'] ) ? wp_unslash( $postdata['post_authors'] ) : '';

					$display_post_meta        = isset( $postdata['display_post_meta'] ) ? sanitize_text_field( wp_unslash( $postdata['display_post_meta'] ) ) : '';
					$post_meta_tag_style      = isset( $postdata['post_meta_tag_style'] ) ? wp_unslash( $postdata['post_meta_tag_style'] ) : '';
					$display_post_meta_date   = isset( $postdata['display_post_meta_date'] ) ? wp_unslash( $postdata['display_post_meta_date'] ) : '';
					$display_post_meta_author = isset( $postdata['display_post_meta_author'] ) ? wp_unslash( $postdata['display_post_meta_author'] ) : '';

					$display_post_meta_author_pic = isset( $postdata['display_post_meta_author_pic'] ) ? wp_unslash( $postdata['display_post_meta_author_pic'] ) : '';

					$display_excerpt       = isset( $postdata['display_excerpt'] ) ? sanitize_text_field( wp_unslash( $postdata['display_excerpt'] ) ) : '';
					$post_excerpt_count    = isset( $postdata['post_excerpt_count'] ) ? wp_unslash( $postdata['post_excerpt_count'] ) : '';
					$display_post_category = isset( $postdata['display_post_category'] ) ? wp_unslash( $postdata['display_post_category'] ) : '';

					$dpc_all = isset( $postdata['dpc_all'] ) ? wp_unslash( $postdata['dpc_all'] ) : '';

					$post_category_style  = isset( $postdata['post_category_style'] ) ? sanitize_text_field( wp_unslash( $postdata['post_category_style'] ) ) : '';
					$display_title_limit  = isset( $postdata['display_title_limit'] ) ? wp_unslash( $postdata['display_title_limit'] ) : '';
					$display_title_by     = isset( $postdata['display_title_by'] ) ? wp_unslash( $postdata['display_title_by'] ) : '';
					$display_title_input  = isset( $postdata['display_title_input'] ) ? wp_unslash( $postdata['display_title_input'] ) : '';
					$display_title_3_dots = isset( $postdata['display_title_3_dots'] ) ? wp_unslash( $postdata['display_title_3_dots'] ) : '';

					$feature_image   = isset( $postdata['feature_image'] ) ? wp_unslash( $postdata['feature_image'] ) : '';
					$full_image_size = ! empty( $postdata['full_image_size'] ) ? $postdata['full_image_size'] : 'yes';
					$author_prefix   = isset( $postdata['author_prefix'] ) ? wp_unslash( $postdata['author_prefix'] ) : 'By';
				} elseif ( 'products' === $widgetname ) {
					$b_dis_badge_switch = isset( $postdata['badge'] ) ? sanitize_text_field( wp_unslash( $postdata['badge'] ) ) : '';
					$out_of_stock       = isset( $postdata['out_of_stock'] ) ? sanitize_text_field( wp_unslash( $postdata['out_of_stock'] ) ) : '';

					$variation_price_on = isset( $postdata['variationprice'] ) ? sanitize_text_field( wp_unslash( $postdata['variationprice'] ) ) : '';
					$hover_image_on_off = isset( $postdata['hoverimagepro'] ) ? sanitize_text_field( wp_unslash( $postdata['hoverimagepro'] ) ) : '';

					$display_product   = isset( $postdata['display_product'] ) ? wp_unslash( $postdata['display_product'] ) : '';
					$display_rating    = isset( $postdata['display_rating'] ) ? wp_unslash( $postdata['display_rating'] ) : '';
					$display_catagory  = isset( $postdata['display_catagory'] ) ? wp_unslash( $postdata['display_catagory'] ) : '';
					$display_yith_list = isset( $postdata['display_yith_list'] ) ? wp_unslash( $postdata['display_yith_list'] ) : '';

					$display_yith_compare   = isset( $postdata['display_yith_compare'] ) ? wp_unslash( $postdata['display_yith_compare'] ) : '';
					$display_yith_wishlist  = isset( $postdata['display_yith_wishlist'] ) ? wp_unslash( $postdata['display_yith_wishlist'] ) : '';
					$display_yith_quickview = isset( $postdata['display_yith_quickview'] ) ? wp_unslash( $postdata['display_yith_quickview'] ) : '';
					$display_cart_button    = isset( $postdata['cart_button'] ) ? wp_unslash( $postdata['cart_button'] ) : '';
					$dcb_single_product     = isset( $postdata['dcb_single_product'] ) ? wp_unslash( $postdata['dcb_single_product'] ) : '';
					$dcb_variation_product  = isset( $postdata['dcb_variation_product'] ) ? wp_unslash( $postdata['dcb_variation_product'] ) : '';
				} elseif ( 'googlemap' === $widgetname ) {
					$Places  = isset( $postdata['places'] ) ? $postdata['places'] : '';
					$Options = isset( $postdata['options'] ) ? $postdata['options'] : '';

					$listing_type = isset( $postdata['listing_type'] ) ? $postdata['listing_type'] : '';

					$PostId       = isset( $postdata['PostId'] ) ? $postdata['PostId'] : '';
					$map_widgetId = isset( $postdata['MapWidgetId'] ) ? $postdata['MapWidgetId'] : '';
				}

				$loadmore_SF = ! empty( $postdata['loadMore_sf'] ) ? $postdata['loadMore_sf'] : 0;
				if ( ! empty( $loadmore_SF ) ) {
					$new_offset  = ! empty( $postdata['new_offset'] ) ? $postdata['new_offset'] : 0;
					$offset      = $new_offset;
					$DisplayPost = $post_load_more;
				}

				$Lazyload_SF = ! empty( $postdata['lazyload_sf'] ) ? $postdata['lazyload_sf'] : 0;
				if ( ! empty( $Lazyload_SF ) ) {
					$new_offset  = ! empty( $postdata['new_offset'] ) ? $postdata['new_offset'] : 0;
					$offset      = $new_offset;
					$DisplayPost = $post_load_more;
				}

				$Paginate_sf = ! empty( $postdata['Paginate_sf'] ) ? $postdata['Paginate_sf'] : 0;
				if ( ! empty( $Paginate_sf ) ) {
					$new_offset = ! empty( $postdata['new_offset'] ) ? $postdata['new_offset'] : '';
					$offset     = $new_offset;
				}

				if ( ! empty( $CustonQuery ) ) {
					$args = array();
					if ( has_filter( $CustonQuery ) ) {
						$args = apply_filters( $CustonQuery, $args );

						if ( ! empty( $args['post_type'] ) ) {
							$post_type = $args['post_type'];
						}

						if ( ! empty( $args['posts_per_page'] ) ) {
							$DisplayPost = $args['posts_per_page'];
						} else {
							$args['posts_per_page'] = $DisplayPost;
						}

						if ( ! empty( $args['offset'] ) ) {
							$offset = $args['offset'];
						} else {
							$args['offset'] = $offset;
						}

						if ( ! empty( $args['orderby'] ) ) {
							$order_by = $args['orderby'];
						} else {
							$args['orderby'] = $order_by;
						}

						if ( ! empty( $args['order'] ) ) {
							$post_order = $args['order'];
						} else {
							$args['order'] = $post_order;
						}
					}
				} elseif ( 'dynamiclisting' === $widgetname || 'products' === $widgetname ) {
						$args = array(
							'post_type'      => $post_type,
							'post_status'    => 'publish',
							'posts_per_page' => $DisplayPost,
							'offset'         => $offset,
							'orderby'        => $order_by,
							'order'          => $post_order,
						);
				}

				if ( ! empty( $excludePosts ) ) {
					$args['post__not_in'] = explode( ',', $excludePosts );
				}

				if ( ! empty( $includePosts ) ) {
					$args['post__in'] = explode( ',', $includePosts );
				}

				if ( ! empty( $post_authors ) && 'post' === $post_type && 'dynamiclisting' === $widgetname ) {
					$args['author'] = $post_authors;
				}

				if ( 'search_list' === $filter_type ) {
					$meta_keyArr = $meta_keyArr1 = $attr_tax = $TmpPostID = array();

					if ( ! empty( $postdata['seapara'] ) ) {
						foreach ( $postdata['seapara'] as $item => $val ) {
							$FieldValue = ( ! empty( $val ) && ! empty( $val['field'] ) ) ? $val['field'] : '';
							$TypeValue  = ( ! empty( $val ) && ! empty( $val['type'] ) ) ? $val['type'] : '';
							$DataValue  = ( ! empty( $val ) && ! empty( $val['value'] ) ) ? $val['value'] : '';
							$NameValue  = ( ! empty( $val ) && ! empty( $val['name'] ) ) ? $val['name'] : '';
							$keyEnable  = $WooSortEnable = 0;

							$PubliStatus = 'publish';
							if ( 'taxonomy' === $TypeValue ) {

								if ( 'rating' === $FieldValue && 'product' === $post_type && ! empty( $DataValue ) ) {
									$RatingQ = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->comments}.comment_post_ID FROM {$wpdb->commentmeta}, {$wpdb->comments} WHERE {$wpdb->commentmeta}.meta_key='rating' AND {$wpdb->commentmeta}.meta_value = %d AND {$wpdb->comments}.comment_type='review' AND {$wpdb->commentmeta}.comment_id = {$wpdb->comments}.comment_ID", $DataValue ) );

									if ( ! empty( $RatingQ ) ) {
										foreach ( $RatingQ as $value ) {
											if ( ! empty( $value->comment_post_ID ) ) {
												$TmpPostID[] = $value->comment_post_ID;
											}
										}
									} else {
										$TmpPostID[] = array();
									}
								} elseif ( 'search' === $FieldValue && strlen( $DataValue ) > 1 ) {
									$Generic = ! empty( $val ) ? $val['Generic'] : array();
									$AllData = $GTitle = $Gexcerpt = $Gcontent = $Gname = $PCat = $PTag = array();
									
									if ( ! empty( $Generic['GFEnable'] ) ) {
										
										$Result = ( 'fullMatch' === $Generic['GFSType'] ) ? "{$wpdb->esc_like($DataValue)}%" : "%{$wpdb->esc_like($DataValue)}%";

										$PType = $wpdb->prepare( "AND {$wpdb->posts}.post_type = %s", $post_type );

										if ( ! empty( $Generic['GFTitle'] ) ) {
											$PTitle = $wpdb->prepare( "{$wpdb->posts}.post_title LIKE %s ", $Result );
											$GTitle = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE {$PTitle} AND {$wpdb->posts}.post_status = %s {$PType}", $PubliStatus ) );
										}

										if ( ! empty( $Generic['GFContent'] ) ) {
											$Pcontent = $wpdb->prepare( "{$wpdb->posts}.post_content LIKE %s ", $Result );
											$Gcontent = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE {$Pcontent} AND {$wpdb->posts}.post_status = %s {$PType}", $PubliStatus ) );
										}
										if ( ! empty( $Generic['GFExcerpt'] ) ) {
											$Pexcerpt = $wpdb->prepare( "{$wpdb->posts}.post_excerpt LIKE %s ", $Result );
											$Gexcerpt = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE {$Pexcerpt} AND {$wpdb->posts}.post_status = %s {$PType}", $PubliStatus ) );
										}

										if ( ! empty( $Generic['GFName'] ) ) {
											$Pname = $wpdb->prepare( "{$wpdb->posts}.post_name LIKE %s ", $Result );
											$Gname = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE {$Pname} AND {$wpdb->posts}.post_status = %s {$PType}", $PubliStatus ) );
										}

										if ( ! empty( $Generic['GFCategory'] ) ) {
											$CatType = 'category_name';
											if ( 'post' === $post_type ) {
												$CatTaxonomy = 'category';
											} elseif ( 'product' === $post_type ) {
												$CatTaxonomy = $CatType = 'product_cat';
											} else {
												$CatTaxonomy = 'any';
											}

											$PCat = query_posts(
												array(
													'taxonomy' => $CatTaxonomy,
													'post_type' => $post_type,
													$CatType   => $DataValue,
													'post_status' => 'publish',
													'posts_per_page' => -1,
													'orderby'  => 'name',
													'order'    => 'ASC',
													'hide_empty' => 0,
												)
											);
										}

										if ( ! empty( $Generic['GFTags'] ) ) {
											if ( $post_type == 'post' ) {
												$TagTaxonomy = 'post_tag';
												$TagType     = 'tag_slug__in';
											} elseif ( $post_type == 'product' ) {
												$TagTaxonomy = 'product_tag';
												$TagType     = 'product_tag';
											} else {
												/**static tag Taxonomy*/
												$TagTaxonomy = 'post_tag';
												$TagType     = 'tag';
											}

											$PTag = query_posts(
												array(
													'taxonomy' => $TagTaxonomy,
													'post_type' => $post_type,
													$TagType   => $DataValue,
													'post_status' => 'publish',
													'posts_per_page' => -1,
													'orderby'  => 'name',
													'order'    => 'ASC',
													'hide_empty' => 0,
												)
											);
										}

										if ( ! empty( $GTitle ) ) {
											array_push( $AllData, $GTitle );
										}

										if ( ! empty( $Gcontent ) ) {
											array_push( $AllData, $Gcontent );
										}

										if ( ! empty( $Gexcerpt ) ) {
											array_push( $AllData, $Gexcerpt );
										}

										if ( ! empty( $Gname ) ) {
											array_push( $AllData, $Gname );
										}

										if ( ! empty( $PTag ) ) {
											array_push( $AllData, $PTag );
										}

										if ( ! empty( $PCat ) ) {
											array_push( $AllData, $PCat );
										}

										// array_push( $AllData, $GTitle, $Gcontent, $Gexcerpt, $Gname, $PTag, $PCat );

										if ( ! empty( $AllData ) ) {
											foreach ( $AllData as $value ) {
												if ( ! empty( $value ) ) {
													foreach ( $value as $vall ) {
														if ( ! empty( $vall->ID ) ) {
															$TmpPostID[] = $vall->ID;
														}
													}
												} else {
													$TmpPostID[] = array();
												}
											}
										}
									} else {
										$args['s'] = $DataValue;
									}
								} elseif ( 'alphabet' === $FieldValue ) {
									if ( ! empty( $DataValue ) ) {
										foreach ( $DataValue as $one ) {
											$PTitle = $wpdb->prepare( "{$wpdb->posts}.post_title LIKE %s ", $wpdb->esc_like( $one ) . '%' );
											$PType  = $wpdb->prepare( "AND {$wpdb->posts}.post_type=%s", $post_type );
											$AlphaQ = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} WHERE {$PTitle} AND {$wpdb->posts}.post_status=%s {$PType}", $PubliStatus ) );

											if ( ! empty( $AlphaQ ) ) {
												foreach ( $AlphaQ as $two ) {
													if ( ! empty( $two->ID ) ) {
														$TmpPostID[] = $two->ID;
													}
												}
											} else {
												$TmpPostID[] = 0;
											}
										}
									}
								} elseif ( 'date' === $FieldValue ) {
									$args['date_query'] = array(
										array(
											'after'     => ( ! empty( $DataValue ) && ! empty( $DataValue[0] ) ) ? $DataValue[0] : '',
											'before'    => ( ! empty( $DataValue ) && ! empty( $DataValue[1] ) ) ? $DataValue[1] : '',
											'inclusive' => true,
										),
									);
								} elseif ( 'range' === $FieldValue ) {
									$Range_Q[] = array(
										'key'     => '_price',
										'value'   => $DataValue,
										'compare' => 'BETWEEN',
										'type'    => 'NUMERIC',
									);

									if ( ! empty( $Range_Q ) ) {
										$meta_keyArr[] = $Range_Q;
									}
								} elseif ( ( 'color' === $FieldValue || 'image' === $FieldValue || 'button' === $FieldValue ) && 'product' === $post_type ) {
									if ( ! empty( $DataValue ) && ! empty( $NameValue ) ) {
										$attr_tax[] = array(
											'taxonomy' => $NameValue,
											'field'    => 'id',
											'terms'    => $DataValue,
											'operator' => 'IN',
										);
									}
								} elseif ( 'tabbing' === $FieldValue || 'checkBox' === $FieldValue || 'DropDown' === $FieldValue || 'radio' === $FieldValue ) {
									if ( ! empty( $DataValue ) ) {
										$keyEnable = 1;
									}
								} elseif ( 'woo_SgDropDown' === $FieldValue || 'woo_SgTabbing' === $FieldValue ) {
									$keyEnable = $WooSortEnable = 1;
								} elseif ( 'autocomplete' === $FieldValue ) {
									$maplocation = $this->theplus_searchfilter_autocomplete( $NameValue, $DataValue, $TypeValue, $val, $map_widgetId, $PostId );
								}
							} elseif ( 'acf_conne' === $TypeValue ) {
								if ( class_exists( 'ACF' ) ) {
									$ACF_Key = acf_get_field( $NameValue )['key'];
									if ( ! empty( $ACF_Key ) ) {
										if ( 'rating' === $FieldValue ) {
											$Rating_Q[] = array(
												'key'     => $NameValue,
												'value'   => $DataValue,
												'compare' => '=',
												'type'    => 'text',
											);
											if ( ! empty( $Rating_Q ) ) {
												$meta_keyArr[] = $Rating_Q;
											}
										} elseif ( 'search' === $FieldValue ) {
											if ( strlen( $DataValue ) > 1 ) {
												$data      = array();
												$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.ID AND {$wpdb->posts}.post_status = %s", $PubliStatus ) );
												if ( ! empty( $DB_Result ) ) {
													foreach ( $DB_Result as $value ) {
														$PostID  = ! empty( $value->ID ) ? $value->ID : '';
														$ACFdata = get_field( $ACF_Key, $PostID );

														if ( ! empty( $ACFdata ) ) {
															$array2 = explode( '|', $ACFdata );
															foreach ( $array2 as $val ) {
																if ( trim( strtolower( $val ) ) == strtolower( $DataValue ) ) {
																	$data[] = $ACFdata;
																}
															}
														}
													}
													if ( ! empty( $data ) ) {
														$meta_keyArr[] = array(
															'key' => $NameValue,
															'value' => $data,
															'compare' => 'IN',
														);
													} else {
														$meta_keyArr[] = array(
															'key' => $NameValue,
															'value' => '',
															'compare' => '==',
														);
													}
												}
											}
										} elseif ( 'date' === $FieldValue ) {
											if ( ! empty( $DataValue ) && ! empty( $NameValue ) ) {
												$Date_Q[] = array(
													'key'  => $NameValue,
													'value' => $DataValue,
													'compare' => 'BETWEEN',
													'type' => 'DATE',
												);

												if ( ! empty( $Date_Q ) ) {
													$meta_keyArr[] = $Date_Q;
												}
											}
										} elseif ( 'range' === $FieldValue ) {
											if ( ! empty( $DataValue ) && ! empty( $NameValue ) ) {
												$Range_Q[] = array(
													'key'  => $NameValue,
													'value' => $DataValue,
													'compare' => 'BETWEEN',
													'type' => 'NUMERIC',
												);

												if ( ! empty( $Range_Q ) ) {
													$meta_keyArr[] = $Range_Q;
												}
											}
										} elseif ( 'color' === $FieldValue || 'image' === $FieldValue || 'button' === $FieldValue ) {
											$Rangee_Q[] = array(
												'key'     => $NameValue,
												'value'   => $DataValue,
												'compare' => 'IN',
											);
											if ( ! empty( $Rangee_Q ) ) {
												$meta_keyArr[] = $Rangee_Q;
											}
										} elseif ( 'tabbing' === $FieldValue && ! empty( $DataValue ) ) {
											$data      = array();
											$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.ID AND {$wpdb->posts}.post_status=%s", $PubliStatus ) );

											foreach ( $DB_Result as $value ) {
												$PostID  = ! empty( $value->ID ) ? $value->ID : '';
												$ACFdata = get_field( $ACF_Key, $PostID );

												if ( ! empty( $ACFdata ) ) {
													$array2 = explode( '|', $ACFdata );
													foreach ( $array2 as $val ) {
														$fvalue = str_replace( ' ', '-', ltrim( rtrim( $val ) ) );
														if ( in_array( $fvalue, $DataValue ) ) {
															$data[] = $ACFdata;
														}
													}
												}
											}

											$tabbing_Q[] = array(
												'key'     => $NameValue,
												'value'   => $data,
												'compare' => 'IN',
											);
											if ( ! empty( $tabbing_Q ) ) {
												$meta_keyArr[] = $tabbing_Q;
											}
										} elseif ( 'radio' === $FieldValue ) {
											if ( ! empty( $DataValue ) && ! empty( $NameValue ) ) {
												$Rangee_Q[] = array(
													'key' => $NameValue,
													'value' => $DataValue,
													'compare' => '=',
												);

												if ( ! empty( $Rangee_Q ) ) {
													$meta_keyArr[] = $Rangee_Q;
												}
											}
										} elseif ( 'checkBox' === $FieldValue ) {
											if ( ! empty( $DataValue ) && ! empty( $NameValue ) ) {
												foreach ( $DataValue as $metadata ) {
													$CheckBox_Q[] = array(
														'key' => $NameValue,
														'value' => $metadata,
														'compare' => 'LIKE',
													);
												}

												if ( ! empty( $CheckBox_Q ) ) {
													$meta_keyArr[] = $CheckBox_Q;
												}
											}
										} elseif ( 'DropDown' === $FieldValue ) {
											if ( ! empty( $DataValue ) ) {
												$DropDown_Q[] = array(
													'key' => $NameValue,
													'value' => $DataValue,
													'compare' => 'LIKE',
												);
												if ( ! empty( $DropDown_Q ) ) {
													$meta_keyArr[] = $DropDown_Q;
												}
											}
										} else {
											$Rangee_Q[] = array(
												'key'     => $item,
												'value'   => $val,
												'compare' => '=',
											);
											if ( ! empty( $Rangee_Q ) ) {
												$meta_keyArr[] = $Rangee_Q;
											}
										}
									}
								}
							} elseif ( 'toolset_conne' === $TypeValue || 'pods_conne' === $TypeValue || 'metabox_conne' === $TypeValue ) { /******* Connection Toolset - PODs */
								if ( 'toolset_conne' === $TypeValue && ! is_plugin_active( 'types/wpcf.php' ) ) {
									return;
								} elseif ( 'pods_conne' === $TypeValue && ! class_exists( 'PodsInit' ) ) {
									return;
								} elseif ( 'metabox_conne' === $TypeValue && ! class_exists( 'RWMB_Field' ) ) {
									return;
								} elseif ( ! empty( $DataValue ) ) {
										$Connnection_Q = array();
									if ( 'rating' === $FieldValue ) {
										$Connnection_Q = $this->theplus_searchfilster_rating( $NameValue, $DataValue, $PubliStatus, $TypeValue );
									} elseif ( 'search' === $FieldValue ) {
										$Connnection_Q = $this->theplus_searchfilter_input( $NameValue, $DataValue, $PubliStatus, $TypeValue );
									} elseif ( 'date' === $FieldValue ) {
										$Connnection_Q = $this->theplus_searchfilter_DateFilter( $NameValue, $DataValue, $PubliStatus, $TypeValue );
									} elseif ( 'tabbing' === $FieldValue ) {
										$Connnection_Q = $this->theplus_searchfilter_Tabbing( $NameValue, $DataValue, $PubliStatus, $TypeValue );
									} elseif ( 'range' === $FieldValue ) {
										$Connnection_Q = $this->theplus_searchfilter_range( $NameValue, $DataValue, $PubliStatus, $TypeValue );
									} elseif ( 'radio' === $FieldValue ) {
										$Connnection_Q = $this->theplus_searchfilster_radiobtn( $NameValue, $DataValue, $PubliStatus, $TypeValue );
									} elseif ( 'checkBox' === $FieldValue ) {
										if ( 'toolset_conne' === $TypeValue ) {
											$TmpPostID = $this->theplus_searchfilster_checkBox( $NameValue, $DataValue, $PubliStatus, $TypeValue );
										} elseif ( 'pods_conne' === $TypeValue || 'metabox_conne' === $TypeValue ) {
											$Connnection_Q = $this->theplus_searchfilster_checkBox( $NameValue, $DataValue, $PubliStatus, $TypeValue );
										}
									} elseif ( 'DropDown' === $FieldValue ) {
										$Connnection_Q = $this->theplus_searchfilster_dropdown( $NameValue, $DataValue, $PubliStatus, $TypeValue );
									} elseif ( 'image' === $FieldValue ) {
										$Connnection_Q = array(
											'key'     => $NameValue,
											'value'   => $DataValue,
											'compare' => 'IN',
										);
									} elseif ( 'button' === $FieldValue ) {
										$Connnection_Q = $this->theplus_searchfilter_button( $NameValue, $DataValue, $PubliStatus, $TypeValue );
									} elseif ( 'color' === $FieldValue ) {
										$Connnection_Q = $this->theplus_searchfilster_color( $NameValue, $DataValue, $PubliStatus, $TypeValue );
									} elseif ( 'autocomplete' === $FieldValue ) {
										$maplocation = $this->theplus_searchfilter_autocomplete( $NameValue, $DataValue, $TypeValue, $val, $map_widgetId, $PostId );

										$Marks = ! empty( $maplocation['marks'] ) ? $maplocation['marks'] : '';

										if ( ! empty( $Marks ) ) {
											$MapsMarks = array();
											foreach ( $maplocation['marks'] as $mapvalue ) {
												if ( ! empty( $mapvalue[0] ) && ! empty( $mapvalue[1] ) ) {
													$MapsMarks[] = $mapvalue[0] . ',' . $mapvalue[1];
												}
											}

											$Connnection_Q = array(
												'key'     => $NameValue,
												'value'   => $MapsMarks,
												'compare' => 'IN',
											);
										}
									} else {
										$Connnection_Q = array(
											'key'     => $item,
											'value'   => $val,
											'compare' => '=',
										);
									}

									if ( ! empty( $Connnection_Q ) ) {
										$meta_keyArr[] = $Connnection_Q;
									}
								}
							}

							if ( ! empty( $keyEnable ) ) {
								if ( 'post' === $post_type ) {
									if ( 'category' === $NameValue && ! empty( $DataValue ) ) {
										$args['category__in'] = $DataValue;
									} elseif ( 'post_tag' === $NameValue && ! empty( $DataValue ) ) {
										$args['tag__in'] = $DataValue;
									} elseif ( ! empty( $texonomy_category ) && ! empty( $NameValue ) && ! empty( $DataValue ) ) {
											$attr_tax[] = array(
												array(
													'taxonomy' => $NameValue,
													'field' => 'term_id',
													'terms' => $DataValue,
												),
											);
									}
								} elseif ( 'product' === $post_type ) {
									$attr_tax[] = array(
										'taxonomy' => 'product_visibility',
										'field'    => 'name',
										'terms'    => array( 'exclude-from-search', 'exclude-from-catalog' ),
										'operator' => 'NOT IN',
									);
									if ( empty( $WooSortEnable ) ) {
										if ( ! empty( $DataValue ) && ! empty( $NameValue ) ) {
											$attr_tax[] = array(
												'taxonomy' => $NameValue,
												'field'    => 'id',
												'terms'    => $DataValue,
											);
										}
									}

									if ( ! empty( $DataValue ) && ! empty( $WooSortEnable ) ) {
										/*Woo Sorting*/
										foreach ( $DataValue as $val ) {
											if ( 'featured' === $val ) {
												$attr_tax[] = array(
													array(
														'taxonomy' => 'product_visibility',
														'field' => 'name',
														'terms' => 'featured',
													),
												);
											}
											if ( $val == 'on_sale' ) {
												$meta_keyArr[] = array(
													'relation' => 'OR',
													array(
														'key' => '_sale_price',
														'value' => 0,
														'compare' => '>',
														'type' => 'numeric',
													),
													array(
														'key' => '_min_variation_sale_price',
														'value' => 0,
														'compare' => '>',
														'type' => 'numeric',
													),
												);
											}
											if ( 'top_sales' === $val ) {
												$meta_keyArr[] = array(
													array(
														'key' => 'total_sales',
														'value' => 0,
														'compare' => '>',
													),
												);
											}
											if ( 'instock' === $val ) {
												$meta_keyArr[] = array(
													array(
														'key' => '_stock_status',
														'value' => 'instock',
													),
												);
											}
											if ( 'outofstock' === $val ) {
												$meta_keyArr[] = array(
													array(
														'key'       => '_stock_status',
														'value'     => 'outofstock',
													),
												);
											}
										}
									}
								} elseif ( ! empty( $NameValue ) && ! empty( $DataValue ) ) {
										$attr_tax[] = array(
											'taxonomy' => $NameValue,
											'field'    => 'id',
											'terms'    => $DataValue,
										);
								}
							}

							if( 'search' === $FieldValue && strlen( $DataValue ) > 1 ){
								if ( ! empty( $TmpPostID ) ) {
									$args['post__in'] = $TmpPostID;
								} else {
									$args['post__in'] = [0];
								}
							} elseif ( 'alphabet' === $FieldValue ) {
								if ( ! empty( $TmpPostID ) ) {
									$args['post__in'] = $TmpPostID;
								} else {
							 		// $args['post__in'] = [0];
								}
							}
						}
					}

					/*Search Page*/
					if ( ! empty( $is_searchPage ) ) {
						$args['s']     = $search_pageval;
						$args['exact'] = false;
					}

					/*Select Category widget*/
					if ( 'false' === $enable_archive_search ) {
						if ( ! empty( $category_type ) || 'true' === $category_type ) {
							if ( ! empty( $category ) && 'post' === $post_type ) {

								if ( 'cat' === $ArchivepageName ) {
									$args['category__in'] = explode( ',', $category );
								} elseif ( 'post_tag' === $ArchivepageName ) {

								} elseif ( ! empty( $ArchivepageName ) ) {
										$attr_tax[] = array(
											'taxonomy' => $NameValue,
											'field'    => 'term_id',
											'terms'    => explode( ',', $category ),
										);
								} else {
									$NameTexo = '';
									if ( 'cat' === $texonomy_category ) {
										$NameTexo = 'category';
									}

									$attr_tax[] = array(
										'taxonomy' => $NameTexo,
										'field'    => 'term_id',
										'terms'    => explode( ',', $category ),
									);
								}
							} elseif ( ! empty( $category ) && 'product' === $post_type ) {
								if ( ! empty( $is_archivePage ) ) {
									/**
									* need to add code when archve page is true and Only Active Archive Category option is on
									*/

									$attr_tax[] = array(
										'taxonomy' => 'product_cat',
										'field'    => 'id',
										'terms'    => $ArchivepageID,
									);

								} else {
									$attr_tax[] = array(
										'taxonomy' => 'product_cat',
										'field'    => 'slug',
										'terms'    => explode( ',', $category ),
									);
								}
							} elseif ( ! empty( $category ) ) {
								if ( ! empty( $texonomy_category ) ) {
									$attr_tax[] = array(
										'taxonomy' => $texonomy_category,
										'field'    => 'slug',
										'terms'    => explode( ',', $category ),
									);
								}
							}
						}
					}

					/**Display Product Option ListingWidget*/
					if ( 'product' === $post_type && 'all' !== $display_product ) {
						$wooProductType = $this->theplus_woo_product_type( $display_product );

						if ( ! empty( $wooProductType ) ) {
							if ( 'featured' === $display_product ) {
								$attr_tax[] = $wooProductType;
							}

							if ( 'featured' !== $display_product ) {
								$meta_keyArr[] = $wooProductType;
							}
						}
					}

					if ( ! empty( $attr_tax ) ) {
						$args['tax_query'] = array(
							'relation' => 'AND',
							$attr_tax,
						);
					}

					if ( ! empty( $meta_keyArr ) ) {
						$args['meta_query'] = array(
							'relation' => 'AND',
							$meta_keyArr,
						);
					}
				}
				$result[ $key ] = array();
				if ( 'googlemap' === $widgetname ) {
					$result[ $key ]['HtmlData']    = '';
					$result[ $key ]['totalrecord'] = '';
					$result[ $key ]['Maplocation'] = $maplocation;
					$result[ $key ]['widgetName']  = $widgetname;
					$result[ $key ]['places']      = $Places;
					$result[ $key ]['options']     = $Options;
				} else {
					$totalcount = '';

					ob_start();
						$loop = new WP_Query( $args );

						$totalcount = $loop->found_posts;

					if ( $loop->have_posts() ) {
						while ( $loop->have_posts() ) {
							$loop->the_post();

							$template_id = '';
							if ( ! empty( $dynamic_template ) ) {
								$count       = count( $dynamic_template );
								$value       = (int) $offset % (int) $count;
								$template_id = $dynamic_template[ $value ];
							}

							if ( 'products' === $widgetname && 'search_list' === $filter_type && 'product' === $post_type ) {
								include THEPLUS_WSTYLES . 'ajax-load-post/product-style.php';
							} elseif ( 'dynamiclisting' === $widgetname && 'search_list' === $filter_type ) {
								include THEPLUS_WSTYLES . 'ajax-load-post/dynamic-listing-style.php';
							}

							++$ji;
							++$kij;

						}
					}
					$Alldata = ob_get_contents();
					ob_end_clean();

					if ( ! empty( $Alldata ) ) {
						$result[ $key ]['HtmlData']    = $Alldata;
						$result[ $key ]['totalrecord'] = $totalcount;
						$result[ $key ]['widgetName']  = $widgetname;
						$result[ $key ]['Maplocation'] = '';
					}
				}
			}

			wp_reset_postdata();
			wp_send_json( $result );
		}

		/**
		 * Search Filter Search input (Toolset - PODs - MetaBox)
		 *
		 * @since 1.0.0
		 *
		 * @param string $NameValue     The value for the Name parameter.
		 * @param string $DataValue     The value for the Data parameter.
		 * @param string $PubliStatus   The value for the Publication Status parameter.
		 * @param string $TypeValue     The value for the Type parameter.
		 *
		 * @return array|null An array of criteria for querying products based on the chosen type.
		 */
		public function theplus_searchfilter_input( $NameValue, $DataValue, $PubliStatus, $TypeValue ) {
			global $post, $wpdb;

			if ( 'pods_conne' === $TypeValue || 'toolset_conne' === $TypeValue ) {
				$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.ID AND {$wpdb->posts}.post_status = %s", $PubliStatus ) );
				if ( ! empty( $DB_Result ) ) {
					$Data = array();

					foreach ( $DB_Result as $value ) {
						$ConData = '';
						$PostID  = ! empty( $value->ID ) ? $value->ID : '';
						if ( 'toolset_conne' === $TypeValue ) {
							$ConData = get_post_field( $NameValue, $PostID );
						} elseif ( 'pods_conne' === $TypeValue ) {
							$Pods    = pods( 'post', $PostID, false );
							$ConData = $Pods->display( $NameValue );
						}

						if ( ! empty( $ConData ) ) {
							$PODs_Array = explode( '|', $ConData );
							foreach ( $PODs_Array as $val ) {
								if ( trim( strtolower( $val ) ) == trim( strtolower( $DataValue ) ) ) {
									$Data[] = $ConData;
								}
							}
						}
					}

					if ( ! empty( $Data ) ) {
						return array(
							'key'     => $NameValue,
							'value'   => $Data,
							'compare' => 'IN',
						);
					}
				}
			} elseif ( 'metabox_conne' === $TypeValue ) {
				$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $NameValue, 'publish' ) );

				if ( ! empty( $DB_Result ) ) {
					foreach ( $DB_Result as $value ) {
						$array2 = explode( '|', $value->meta_value );

						foreach ( $array2 as $two ) {
							if ( trim( strtolower( $two ) ) == trim( strtolower( $DataValue ) ) ) {
								return array(
									'key'     => $NameValue,
									'value'   => $value->meta_value,
									'compare' => '=',
								);
							}
						}
					}
				}
			}
		}

		/**
		 * Search Filter Tabbing (Toolset - PODs - MetaBox)
		 *
		 * @since 1.0.0
		 *
		 * @param string $NameValue     The value for the Name parameter.
		 * @param string $DataValue     The value for the Data parameter.
		 * @param string $PubliStatus   The value for the Publication Status parameter.
		 * @param string $TypeValue     The value for the Type parameter.
		 *
		 * @return array|null An array of criteria for querying products based on the chosen type.
		 */
		public function theplus_searchfilter_Tabbing( $NameValue, $DataValue, $PubliStatus, $TypeValue ) {
			global $post, $wpdb;
			$Data = array();

			if ( 'toolset_conne' === $TypeValue ) {
				$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.ID AND {$wpdb->posts}.post_status = %s", $PubliStatus ) );

				if ( ! empty( $DB_Result ) && is_array( $DB_Result ) ) {
					foreach ( $DB_Result as $value ) {
						$PostID  = ! empty( $value->ID ) ? $value->ID : '';
						$ACFdata = get_post_field( $NameValue, $PostID );

						if ( ! empty( $ACFdata ) ) {
							$array2 = explode( '|', $ACFdata );

							foreach ( $array2 as $val ) {
								$fvalue = str_replace( ' ', '-', ltrim( rtrim( $val ) ) );
								if ( in_array( $fvalue, $DataValue ) ) {
									$Data[] = $ACFdata;
								}
							}
						}
					}

					if ( ! empty( $Data ) ) {
						return array(
							'key'     => $NameValue,
							'value'   => $Data,
							'compare' => 'IN',
						);
					}
				}
			} elseif ( 'pods_conne' === $TypeValue ) {
				$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->posts}.post_name = %s AND {$wpdb->posts}.post_status = %s AND {$wpdb->posts}.post_type = %s AND {$wpdb->postmeta}.meta_key = %s ", $NameValue, $PubliStatus, '_pods_field', $NameValue ) );

				if ( ! empty( $DB_Result ) && is_array( $DB_Result ) ) {
					foreach ( $DB_Result as $value ) {
						$array2 = explode( '|', $value->meta_value );

						foreach ( $array2 as $two ) {
							if ( in_array( trim( $two ), $DataValue ) ) {
								$Data[] = $value->meta_value;
							}
						}
					}

					if ( ! empty( $Data ) ) {
						return array(
							'key'     => $NameValue,
							'value'   => $Data,
							'compare' => 'IN',
						);
					}
				}
			} elseif ( 'metabox_conne' === $TypeValue ) {
				$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $NameValue, 'publish' ) );

				if ( ! empty( $DB_Result ) ) {
					foreach ( $DB_Result as $key => $value ) {
						$array2 = explode( '|', $value->meta_value );

						foreach ( $array2 as $two ) {
							$fvalue = trim( $two );
							if ( in_array( $fvalue, $DataValue ) ) {
								$Data[] = $value->meta_value;
							}
						}
					}
				}

				if ( ! empty( $Data ) ) {
					return array(
						'key'     => $NameValue,
						'value'   => $Data,
						'compare' => 'IN',
					);
				}
			}
		}

		/**
		 * Search Filter Date (Toolset - PODs - MetaBox)
		 *
		 * @since 1.0.0
		 *
		 * @param string $NameValue     The value for the Name parameter.
		 * @param string $DataValue     The value for the Data parameter.
		 * @param string $PubliStatus   The value for the Publication Status parameter.
		 * @param string $TypeValue     The value for the Type parameter.
		 *
		 * @return array|null An array of criteria for querying products based on the chosen type.
		 */
		public function theplus_searchfilter_DateFilter( $NameValue, $DataValue, $PubliStatus, $TypeValue ) {
			global $post, $wpdb;

			if ( 'pods_conne' === $TypeValue ) {
				if ( ! empty( $NameValue ) && ! empty( $DataValue ) ) {
					return array(
						'key'     => $NameValue,
						'value'   => $DataValue,
						'compare' => 'BETWEEN',
						'type'    => 'DATE',
					);
				} else {
					return false;
				}
			} elseif ( 'toolset_conne' == $TypeValue ) {
				$DB_Result = $wpdb->get_results(
					$wpdb->prepare(
						"SELECT {$wpdb->posts}.ID, {$wpdb->postmeta}.meta_value, {$wpdb->postmeta}.post_id
				FROM {$wpdb->posts}, {$wpdb->postmeta}
				WHERE {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id
				AND {$wpdb->posts}.post_status = %s
				AND {$wpdb->postmeta}.meta_key = %s ",
						$PubliStatus,
						$NameValue
					)
				);

				if ( ! empty( $DB_Result ) && is_array( $DB_Result ) ) {
					$Data    = array();
					$DateOne = ( ! empty( $DataValue ) && ! empty( $DataValue[0] ) ? $DataValue[0] : date( 'Y-m-d' ) );
					$DateTwo = ( ! empty( $DataValue ) && ! empty( $DataValue[1] ) ? $DataValue[1] : date( 'Y-m-d' ) );

					foreach ( $DB_Result as $value ) {
						$PostID    = ( ! empty( $value ) && ! empty( $value->ID ) ) ? $value->ID : '';
						$MetaValue = ( ! empty( $value ) && ! empty( $value->meta_value ) ) ? date_i18n( 'Y-m-d', $value->meta_value ) : '';

						if ( strtotime( $MetaValue ) >= strtotime( $DateOne ) && strtotime( $MetaValue ) <= strtotime( $DateTwo ) ) {
							$Data[] = ( ! empty( $value ) && ! empty( $value->meta_value ) ) ? $value->meta_value : '';
						}
					}

					if ( ! empty( $Data ) ) {
						return array(
							'key'     => $NameValue,
							'value'   => $Data,
							'compare' => 'IN',
						);
					}
				} else {
					return false;
				}
			} elseif ( 'metabox_conne' === $TypeValue ) {
				if ( ! empty( $NameValue ) && ! empty( $DataValue ) ) {
					return array(
						'key'     => $NameValue,
						'value'   => $DataValue,
						'compare' => 'BETWEEN',
						'type'    => 'DATE',
					);
				}
			}
		}

		/**
		 * Search Filter Checkbox (Toolset - PODs - MetaBox)
		 *
		 * @since 1.0.0
		 *
		 * @param string $NameValue     The value for the Name parameter.
		 * @param string $DataValue     The value for the Data parameter.
		 * @param string $PubliStatus   The value for the Publication Status parameter.
		 * @param string $TypeValue     The value for the Type parameter.
		 *
		 * @return array|null An array of criteria for querying products based on the chosen type.
		 */
		public function theplus_searchfilster_checkBox( $NameValue, $DataValue, $PubliStatus, $TypeValue ) {
			global $post, $wpdb;
			$Data = array();

			if ( 'toolset_conne' === $TypeValue ) {
				foreach ( $DataValue as $val1 ) {
					$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id AND {$wpdb->posts}.post_status = %s AND {$wpdb->postmeta}.meta_key = %s AND {$wpdb->postmeta}.meta_value Like %s", $PubliStatus, $NameValue, "%{$wpdb->esc_like($val1)}%" ) );
					if ( ! empty( $DB_Result ) ) {
						foreach ( $DB_Result as $val2 ) {
							if ( ! empty( $val2 ) && ! empty( $val2->post_id ) ) {
								$Data[] = $val2->post_id;
							}
						}
					}
				}

				if ( ! empty( $Data ) ) {
					return $Data;
				}
			} elseif ( 'pods_conne' === $TypeValue ) {
				$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $NameValue, $PubliStatus ) );

				if ( ! empty( $DB_Result ) ) {
					foreach ( $DB_Result as $value ) {
						$array2 = explode( '|', $value->meta_value );

						foreach ( $array2 as $two ) {
							$fvalue = trim( $two );
							if ( in_array( $fvalue, $DataValue ) ) {
								$Data[] = $value->meta_value;
							}
						}
					}

					if ( ! empty( $Data ) ) {
						return array(
							'key'     => $NameValue,
							'value'   => $Data,
							'compare' => 'IN',
						);
					}
				}
			} elseif ( 'metabox_conne' === $TypeValue ) {
				if ( ! empty( $NameValue ) && ! empty( $DataValue ) ) {
					return array(
						'key'     => $NameValue,
						'value'   => $DataValue,
						'compare' => 'IN',
					);
				}
			}
		}

		/**
		 * Search Filter Radio (Toolset - PODs - MetaBox)
		 *
		 * @since 1.0.0
		 *
		 * @param string $NameValue     The value for the Name parameter.
		 * @param string $DataValue     The value for the Data parameter.
		 * @param string $PubliStatus   The value for the Publication Status parameter.
		 * @param string $TypeValue     The value for the Type parameter.
		 *
		 * @return array|null An array of criteria for querying products based on the chosen type.
		 */
		public function theplus_searchfilster_radiobtn( $NameValue, $DataValue, $PubliStatus, $TypeValue ) {
			if ( 'toolset_conne' === $TypeValue || 'metabox_conne' === $TypeValue ) {
				return array(
					'key'     => $NameValue,
					'value'   => $DataValue,
					'compare' => '=',
				);
			} elseif ( 'pods_conne' === $TypeValue ) {
				$Data = array();
				global $post, $wpdb;
				$get_result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $NameValue, 'publish' ) );

				if ( ! empty( $get_result ) ) {
					foreach ( $get_result as $key => $value ) {
						$array2 = explode( '|', $value->meta_value );

						foreach ( $array2 as $two ) {
							$fvalue = trim( $two );
							if ( trim( $two ) == $DataValue ) {
								$Data[] = $value->meta_value;
							}
						}
					}

					if ( ! empty( $Data ) ) {
						return array(
							'key'     => $NameValue,
							'value'   => $Data,
							'compare' => 'IN',
						);
					}
				}
			}
		}

		/**
		 * Search Filter DropDown (Toolset - PODs - MetaBox)
		 *
		 * @since 1.0.0
		 *
		 * @param string $NameValue     The value for the Name parameter.
		 * @param string $DataValue     The value for the Data parameter.
		 * @param string $PubliStatus   The value for the Publication Status parameter.
		 * @param string $TypeValue     The value for the Type parameter.
		 *
		 * @return array|null An array of criteria for querying products based on the chosen type.
		 */
		public function theplus_searchfilster_dropdown( $NameValue, $DataValue, $PubliStatus, $TypeValue ) {
			if ( 'toolset_conne' === $TypeValue || 'metabox_conne' === $TypeValue ) {
				return array(
					'key'     => $NameValue,
					'value'   => $DataValue,
					'compare' => '=',
				);
			} elseif ( 'pods_conne' === $TypeValue ) {
				$Data = array();
				global $post, $wpdb;
				$get_result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $NameValue, 'publish' ) );

				if ( ! empty( $get_result ) ) {
					foreach ( $get_result as $value ) {
						$array2 = explode( '|', $value->meta_value );

						foreach ( $array2 as $two ) {
							if ( trim( $two ) == $DataValue ) {
								$Data[] = $value->meta_value;
							}
						}
					}

					if ( ! empty( $Data ) ) {
						return array(
							'key'     => $NameValue,
							'value'   => $Data,
							'compare' => 'IN',
						);
					}
				}
			}
		}

		/**
		 * Search Filter Button (Toolset - PODs - MetaBox)
		 *
		 * @since 1.0.0
		 *
		 * @param string $name_value     The value for the Name parameter.
		 * @param string $data_value     The value for the Data parameter.
		 * @param string $publi_status   The value for the Publication Status parameter.
		 * @param string $type_value     The value for the Type parameter.
		 *
		 * @return array|null An array of criteria for querying products based on the chosen type.
		 */
		public function theplus_searchfilter_button( $name_value, $data_value, $publi_status, $type_value ) {
			global $post, $wpdb;

			$data       = array();
			$get_result = array();

			if ( 'toolset_conne' === $type_value ) {
				$get_result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_value, {$wpdb->postmeta}.meta_key FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id AND {$wpdb->posts}.post_status = %s AND {$wpdb->postmeta}.meta_key = %s ", $publi_status, $name_value ) );
			} elseif ( 'pods_conne' === $type_value ) {
				$get_result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_value {$wpdb->postmeta}.meta_key FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.meta_key = %s And {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID AND {$wpdb->posts}.post_status = %s ", $name_value, $publi_status ) );
			} elseif ( 'metabox_conne' === $type_value ) {
				$get_result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_value, {$wpdb->postmeta}.meta_key FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $name_value, $publi_status ) );
			}

			if ( ! empty( $get_result ) && is_array( $get_result ) ) {
				foreach ( $get_result as $value ) {
					$array2 = explode( '|', $value->meta_value );

					foreach ( $array2 as $value1 ) {
						if ( trim( $value1 ) == $data_value[0] ) {
							$data[] = $value->meta_value;
						}
					}
				}

				if ( ! empty( $data ) ) {
					return array(
						'key'     => $name_value,
						'value'   => $data,
						'compare' => 'IN',
					);
				}
			}
		}

		/**
		 * Search Filter Rating (Toolset - PODs - MetaBox)
		 *
		 * @since 1.0.0
		 *
		 * @param string $name_value     The value for the Name parameter.
		 * @param string $data_value     The value for the Data parameter.
		 * @param string $publi_status   The value for the Publication Status parameter.
		 * @param string $type_value     The value for the Type parameter.
		 *
		 * @return array|null An array of criteria for querying products based on the chosen type.
		 */
		public function theplus_searchfilster_rating( $name_value, $data_value, $publi_status, $type_value ) {
			if ( 'toolset_conne' === $type_value || 'pods_conne' === $type_value || 'metabox_conne' === $type_value ) {
				return array(
					'key'     => $name_value,
					'value'   => $data_value,
					'compare' => 'IN',
				);
			}
		}

		/**
		 * Search Filter Color (Toolset - PODs - MetaBox)
		 *
		 * @since 1.0.0
		 *
		 * @param string $name_value     The value for the Name parameter.
		 * @param string $data_value     The value for the Data parameter.
		 * @param string $publi_status   The value for the Publication Status parameter.
		 * @param string $type_value     The value for the Type parameter.
		 *
		 * @return array|null An array of criteria for querying products based on the chosen type.
		 */
		public function theplus_searchfilster_color( $name_value, $data_value, $publi_status, $type_value ) {
			if ( 'pods_conne' === $type_value || 'toolset_conne' === $type_value || 'metabox_conne' === $type_value ) {
				return array(
					'key'     => $name_value,
					'value'   => $data_value,
					'compare' => 'IN',
				);
			}
		}

		/**
		 * Search Filter Range (Toolset - PODs - Metabox)
		 *
		 * @since 1.0.0
		 *
		 * @param string $name_value The value for the Name parameter.
		 * @param string $data_value The value for the Data parameter.
		 * @param string $publi_status The value for the Publication Status parameter.
		 * @param string $type_value The value for the Type parameter.
		 *
		 * @return array|null An array of criteria for querying products based on the chosen type.
		 */
		public function theplus_searchfilter_range( $name_value, $data_value, $publi_status, $type_value ) {
			if ( 'pods_conne' === $type_value || 'toolset_conne' === $type_value || 'metabox_conne' === $type_value ) {
				return array(
					'key'     => $name_value,
					'value'   => $data_value,
					'compare' => 'BETWEEN',
					'type'    => 'NUMERIC',
				);
			}
		}

		/**
		 * Search Filter Autocomplete (Toolset - PODs - Metabox)
		 *
		 * @since 1.0.0
		 *
		 * @param string $NameValue   The value for the Name parameter.
		 * @param string $DataValue   The value for the Data parameter.
		 * @param string $TypeValue   The value for the Type parameter.
		 * @param string $val         The value for the val parameter.
		 * @param int    $map_widgetId The value for the MapWidgetId parameter.
		 * @param int    $PostId      The value for the PostId parameter.
		 *
		 * @return array|null An array of criteria for querying products based on the chosen type.
		 */
		public function theplus_searchfilter_autocomplete( $NameValue, $DataValue, $TypeValue, $val, $map_widgetId, $post_Id ) {
			$maplocation = array();
			$get_address = get_post_meta( $post_Id, 'tp-gmap-address-' . $map_widgetId, true );
			$geo_value   = ( ! empty( $val ) && ! empty( $val['locationdata'] ) ) ? $val['locationdata'] : '';

			if ( ! empty( $geo_value ) && ! empty( $get_address ) ) {
				$country = ! empty( $geo_value['country'] ) ? trim( strtolower( $geo_value['country'] ) ) : '';
				$state   = ! empty( $geo_value['state'] ) ? trim( strtolower( $geo_value['state'] ) ) : '';
				$city    = ! empty( $geo_value['city'] ) ? trim( strtolower( $geo_value['city'] ) ) : '';

				$postal_code = ! empty( $geo_value['postalCode'] ) ? trim( strtolower( $geo_value['postalCode'] ) ) : '';
				$geo         = ! empty( $geo_value['geo'] ) ? $geo_value['geo'] : '';

				if ( ! empty( $geo ) ) {
					$maplocation['letlong'] = $geo_value['geo'];
				}

				foreach ( $get_address as $gplace1 ) {
					$address_components = ! empty( $gplace1['address_components'] ) ? $gplace1['address_components'] : array();

					$latitude  = ! empty( $gplace1['latitude'] ) ? $gplace1['latitude'] : '';
					$longitude = ! empty( $gplace1['longitude'] ) ? $gplace1['longitude'] : '';
					$address   = ! empty( $gplace1['address'] ) ? $gplace1['address'] : '';
					$letlong   = array( $latitude, $longitude );

					if ( ! empty( $address_components ) ) {
						foreach ( $address_components as $gplace2 ) {
							$long_name = ! empty( $gplace2['long_name'] ) ? trim( strtolower( $gplace2['long_name'] ) ) : '';
							if ( ! empty( $postal_code ) ) {
								if ( $long_name == $postal_code ) {
									$maplocation['marks'][]   = array( $latitude, $longitude );
									$maplocation['address'][] = $gplace1['address'];
								}
							} elseif ( ! empty( $city ) ) {
								if ( $long_name == $city ) {
									$maplocation['marks'][]   = array( $latitude, $longitude );
									$maplocation['address'][] = $gplace1['address'];
								}
							} elseif ( ! empty( $state ) ) {
								if ( $long_name == $state ) {
									$maplocation['marks'][]   = array( $latitude, $longitude );
									$maplocation['address'][] = $gplace1['address'];
								}
							} elseif ( ! empty( $country ) ) {
								if ( $long_name == $country ) {
									$maplocation['marks'][]   = array( $latitude, $longitude );
									$maplocation['address'][] = $gplace1['address'];
								}
							}
						}
					}
				}
			} else {

				$maplocation['letlong'] = array( 37.0902, 95.7129 );

				foreach ( $get_address as $gplace1 ) {
					$latitude  = ! empty( $gplace1['latitude'] ) ? $gplace1['latitude'] : '';
					$longitude = ! empty( $gplace1['longitude'] ) ? $gplace1['longitude'] : '';
					$address   = ! empty( $gplace1['address'] ) ? $gplace1['address'] : '';

					$maplocation['marks'][]   = array( $latitude, $longitude );
					$maplocation['address'][] = $gplace1['address'];
				}
			}

			return $maplocation;
		}

		/**
		 * Defines the product type criteria based on the specified display option.
		 *
		 * @since 1.0.0
		 *
		 * @param string $display_product The product type to display.
		 *
		 * @return array|null An array of criteria for querying products based on the chosen type.
		 */
		public function theplus_woo_product_type( $display_product ) {
			if ( 'featured' === $display_product ) {
				return array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'featured',
				);
			}

			if ( 'on_sale' === $display_product ) {
				return array(
					'relation' => 'OR',
					array(
						'key'     => '_sale_price',
						'value'   => 0,
						'compare' => '>',
						'type'    => 'numeric',
					),
					array(
						'key'     => '_min_variation_sale_price',
						'value'   => 0,
						'compare' => '>',
						'type'    => 'numeric',
					),
				);
			}

			if ( 'top_sales' === $display_product ) {
				return array(
					'key'     => 'total_sales',
					'value'   => 0,
					'compare' => '>',
				);
			}

			if ( 'instock' === $display_product ) {
				return array(
					'key'   => '_stock_status',
					'value' => 'instock',
				);
			}

			if ( 'outofstock' === $display_product ) {
				return array(
					'key'   => '_stock_status',
					'value' => 'outofstock',
				);
			}

			if ( 'all' === $display_product ) {
				return;
			}
		}
	}

	return Tp_Search_Filter::get_instance();
}
