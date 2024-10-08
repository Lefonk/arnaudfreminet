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

if ( ! class_exists( 'Tp_Woo_Compare' ) ) {

	/**
	 * It is Tp_Woo_Compare Main Class
	 *
	 * @since 5.5.4
	 */
	class Tp_Woo_Compare {

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
			add_action( 'wp_ajax_tp_wc_ql_data_ajax', array( $this, 'tp_wc_ql_data' ) );
			add_action( 'wp_ajax_nopriv_tp_wc_ql_data_ajax', array( $this, 'tp_wc_ql_data' ) );
		}

		/**
		 * Product listing Quickview
		 *
		 * @since 5.5.4
		 */
		public function tp_wc_ql_data() {
			check_ajax_referer( 'theplus-addons', 'security' );

			$alldata = '';

			$alldata_table = '';

			$getvaluebrowsertype  = ! empty( $_POST['getvaluebrowsertype'] ) ? sanitize_text_field( wp_unslash( $_POST['getvaluebrowsertype'] ) ) : false;
			$getvaluefortabletype = isset( $_POST['getvaluefortabletype'] ) ? sanitize_text_field( wp_unslash( $_POST['getvaluefortabletype'] ) ) : false;

			$bbc = isset( $_POST['bbc'] ) ? json_decode( tp_check_decrypt_key( $_POST['bbc'] ), true ) : array( 'product' );

			if ( ! empty( $getvaluebrowsertype ) && true == $getvaluebrowsertype ) {
				$uwl  = isset( $_POST['getvaluebrowser'] ) ? $_POST['getvaluebrowser'] : array( '0' );
				$args = array(
					'post_type'      => $bbc,
					'post_status'    => 'publish',
					'posts_per_page' => intval( -1 ),
					'post__in'       => $uwl,
				);
				ob_start();
				$loop = new WP_Query( $args );
				if ( $loop->have_posts() ) {
					while ( $loop->have_posts() ) {
						$loop->the_post();
						include THEPLUS_WSTYLES . 'ajax-load-post/product-wc-qlist.php';
					}
				}
				$alldata = ob_get_contents();
				ob_end_clean();
			}

			if ( ! empty( $getvaluefortabletype ) && true == $getvaluefortabletype ) {
				$getvaluefortable = isset( $_POST['getvaluefortable'] ) ? json_decode( tp_check_decrypt_key( $_POST['getvaluefortable'] ), true ) : array();

				$uwl  = isset( $_POST['getvaluebrowser'] ) ? $_POST['getvaluebrowser'] : array( '0' );
				$args = array(
					'post_type'      => $bbc,
					'post_status'    => 'publish',
					'posts_per_page' => intval( -1 ),
					'post__in'       => $uwl,
				);

				$tablecount = new WP_Query( $args );

				$output = '<table cellpadding="1" cellspacing="1" style="width:100%">';

				foreach ( $getvaluefortable as $key => $value ) {

					$output .= '<tr class="tp-wc-table-' . $value['tp_wc_field_type'] . '">';

						$output .= '<th>' . $value['tp_wc_field_label'] . '</th>';

						$loop = new WP_Query( $args );

					if ( $loop->have_posts() ) {
						while ( $loop->have_posts() ) {
							$loop->the_post();

							$product_id = get_the_ID();
							if ( class_exists( 'Woocommerce' ) && 'product' === $bbc ) {
								$product = new WC_Product( $product_id );
							}
							/**
							 * $product = new WC_Product( $product_id );
							 */

							if ( 'image' === $value['tp_wc_field_type'] ) {
								$output .= '<td>' . get_the_post_thumbnail() . '</td>';
							} elseif ( 'title' === $value['tp_wc_field_type'] ) {
								$output .= '<td>' . get_the_title() . '</td>';
							} elseif ( 'price' === $value['tp_wc_field_type'] && 'product' === $bbc ) {
								$output .= '<td>' . $product->get_price_html() . '</td>';
							} elseif ( 'excerpt' === $value['tp_wc_field_type'] ) {
								if ( get_the_excerpt() ) {
									$output .= '<td>' . get_the_excerpt() . '</td>';
								} elseif ( ! empty( $value['tp_wc_field_empty'] ) ) {
										$output .= '<td>' . $value['tp_wc_field_empty'] . '</td>';
								} else {
									$output .= '<td></td>';
								}
							} elseif ( 'description' === $value['tp_wc_field_type'] ) {
								if ( get_the_content() ) {
									$output .= '<td>' . get_the_content() . '</td>';
								} elseif ( ! empty( $value['tp_wc_field_empty'] ) ) {
										$output .= '<td>' . $value['tp_wc_field_empty'] . '</td>';
								} else {
									$output .= '<td></td>';
								}
							} elseif ( 'sku' === $value['tp_wc_field_type'] && 'product' === $bbc ) {
								if ( $product->get_sku() ) {
									$output .= '<td>' . $product->get_sku() . '</td>';
								} elseif ( ! empty( $value['tp_wc_field_empty'] ) ) {
										$output .= '<td>' . $value['tp_wc_field_empty'] . '</td>';
								} else {
									$output .= '<td></td>';
								}
							} elseif ( 'stock' === $value['tp_wc_field_type'] && 'product' === $bbc ) {
								if ( $product->get_stock_quantity() ) {
									$output .= '<td>' . $product->get_stock_quantity() . '</td>';
								} elseif ( ! empty( $value['tp_wc_field_empty'] ) ) {
										$output .= '<td>' . $value['tp_wc_field_empty'] . '</td>';
								} else {
									$output .= '<td></td>';
								}
							} elseif ( 'weight' === $value['tp_wc_field_type'] && 'product' === $bbc ) {
								if ( $product->get_weight() ) {
									$output .= '<td>' . $product->get_weight() . '</td>';
								} elseif ( ! empty( $value['tp_wc_field_empty'] ) ) {
										$output .= '<td>' . $value['tp_wc_field_empty'] . '</td>';
								} else {
									$output .= '<td></td>';
								}
							} elseif ( 'dimension' === $value['tp_wc_field_type'] && 'product' === $bbc ) {
								if ( $product->get_length() && $product->get_width() && $product->get_height() ) {
									$output .= '<td>' . $product->get_length() . ' x ' . $product->get_width() . ' x ' . $product->get_height() . ' cm</td>';
								} elseif ( ! empty( $value['tp_wc_field_empty'] ) ) {
										$output .= '<td>' . $value['tp_wc_field_empty'] . '</td>';
								} else {
									$output .= '<td></td>';
								}
							} elseif ( 'rating' === $value['tp_wc_field_type'] && 'product' === $bbc ) {
								$rating_count = $product->get_rating_count();

								$average = $product->get_average_rating();

								if ( $rating_count > 0 ) {
									$output .= '<td><div class="tp-wc-table-star" style="--rating: ' . $average . '"></td>';
								} elseif ( ! empty( $value['tp_wc_field_empty'] ) ) {
										$output .= '<td>' . $value['tp_wc_field_empty'] . '</td>';
								} else {
									$output .= '<td></td>';
								}
							} elseif ( 'add-to-cart' === $value['tp_wc_field_type'] && 'product' === $bbc ) {
								if ( 0 == $product->get_stock_quantity() ) {
									$addcart = '<a href="?add-to-cart=' . $product_id . '" rel="nofollow" data-product_id="' . $product_id . '" class="tp-wc-table-addtocart">' . $value['tp_wc_field_add_to_cart'] . '</a>';
								} else {
									$addcart = $value['tp_wc_field_out_of_stock'];
								}
								$output .= '<td>' . $addcart . '</td>';
							} elseif ( 'custom' === $value['tp_wc_field_type'] ) {
								if ( get_post_meta( $product_id, $value['tp_wc_field_custom'], true ) ) {
									$output .= '<td>' . get_post_meta( $product_id, $value['tp_wc_field_custom'], true ) . '</td>';
								} elseif ( ! empty( $value['tp_wc_field_empty'] ) ) {
										$output .= '<td>' . $value['tp_wc_field_empty'] . '</td>';
								} else {
									$output .= '<td></td>';
								}
							} elseif ( 'empty' === $value['tp_wc_field_type'] ) {
								if ( ! empty( $value['tp_wc_field_empty'] ) ) {
									$output .= '<td>' . $value['tp_wc_field_empty'] . '</td>';
								} else {
									$output .= '<td></td>';
								}
							} elseif ( 'remove' === $value['tp_wc_field_type'] ) {
									$output .= '<td><div class="tp-wc-table-remove-item" data-product="' . $product_id . '"><i aria-hidden="true" class="fas fa-window-close"></i></div></td>';
							} elseif ( $value['tp_wc_field_type'] && ! empty( $product ) && $product->get_attribute( $value['tp_wc_field_type'] ) && 'product' === $bbc ) {
									$output .= '<td>' . $product->get_attribute( $value['tp_wc_field_type'] ) . '</td>';
							} elseif ( ! empty( $value['tp_wc_field_empty'] ) ) {
									$output .= '<td>' . $value['tp_wc_field_empty'] . '</td>';
							} elseif ( 'acf' === $value['tp_wc_field_type'] ) {
								$acf_field = get_field_object( $value['tp_wc_field_acf'] );

								if ( 'color_picker' === $acf_field['type'] ) {
									$output .= '<td>';

										$output .= '<label for="color-field"> <div class="tp-wc-color-wrap" style="display: flex;">';

											$output .= '<span style="background-color:' . esc_html( $acf_field['value'] ) . ';" class="tp-wc-color-opt" ></span>';

										$output .= '</div> </label>';

									$output .= '</td>';
								} elseif ( 'image' === $acf_field['type'] ) {
									$output .= '<td> <img src="' . $acf_field['value']['url'] . '" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" > </td>';
								} elseif ( 'checkbox' === $acf_field['type'] ) {
									$output .= '<td>' . esc_html( $acf_field['value'][0] ) . '</td>';
								} elseif ( 'url' === $acf_field['type'] ) {
									$output .= '<td> <a href="' . esc_html( $acf_field['value'] ) . '" target="_blank">' . esc_html( $acf_field['value'] ) . '</a></td>';
								} elseif ( 'true_false' === $acf_field['type'] ) {
									if ( 1 == $acf_field['value'] ) {
										$output .= '<td style="color: green;"> True </td>';
									} else {
										$output .= '<td style="color: red;"> False </td>';
									}
								} else {
									$output .= '<td>' . wp_kses_post( $acf_field['value'] ) . '</td>';
								}
							} else {
								$output .= '<td></td>';
							}
						}
					}

					$output .= '</tr>';
				}

				$output .= '</table>';
				echo $output;

				$alldata_table = ob_get_contents();
				ob_end_clean();
			}

			if ( ! empty( $alldata ) || ! empty( $alldata_table ) ) {
				$result['HtmlData']            = $alldata;
				$result['HtmlDataTable']       = $alldata_table;
				$result['HtmlDataTableLength'] = $tablecount->found_posts;
				$result['htmljsonwcqvlist']    = wp_json_encode( array( 'wcqvlist' => $uwl ) );
			} else {
				$result['HtmlData']            = array();
				$result['HtmlDataTable']       = '';
				$result['HtmlDataTableLength'] = $tablecount->found_posts;
				$result['htmljsonwcqvlist']    = array( '0' );
			}

			wp_reset_postdata();
			wp_send_json( $result );
		}
	}

	return Tp_Woo_Compare::get_instance();
}
