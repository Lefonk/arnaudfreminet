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

if ( ! class_exists( 'Tp_Search_Bar' ) ) {

	/**
	 * It is Tp_Search_Bar Main Class
	 *
	 * @since 5.4.2
	 */
	class Tp_Search_Bar {

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
		 */
		public function __construct() {
			add_action( 'wp_ajax_tp_search_bar', array( $this, 'tp_search_bar' ) );
			add_action( 'wp_ajax_nopriv_tp_search_bar', array( $this, 'tp_search_bar' ) );
			add_filter( 'pre_get_posts', array( $this, 'theplus_search_bar_query' ) );
		}

		/**
		 * Search bar
		 *
		 * @since   5.4.2
		 * */
		public function tp_search_bar() {

			if ( ! isset( $_POST['nonce'] ) || empty( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'tp-searchbar' ) ) {
				die( 'Security checked!' );
			}

			$searchData = array();
			parse_str( $_POST['searchData'], $searchData );

			$DefaultData = ! empty( $_POST['DefaultData'] ) ? $_POST['DefaultData'] : '';
			$SpecialCTP  = ( ! empty( $DefaultData ) && ! empty( $DefaultData['SpecialCTP'] ) ) ? 1 : 0;
			if ( ! empty( $DefaultData ) && ! empty( $DefaultData['Def_Post'] ) ) {
				$Def_post = $DefaultData['Def_Post'];
			} elseif ( ! empty( $DefaultData ) && ! empty( $SpecialCTP ) ) {
				$Def_post = ( ! empty( $DefaultData ) && ! empty( $DefaultData['SpecialCTPType'] ) ) ? $DefaultData['SpecialCTPType'] : 'post';
			} else {
				$Def_post = 'any';
			}

			$GetTaxonomy = ! empty( $searchData['taxonomy'] ) ? $searchData['taxonomy'] : '';

			$Enable_DefaultStxt = 0;
			$PostType           = '';
			if ( ! empty( $searchData ) && ! empty( $searchData['post_type'] ) ) {
				$PostType = sanitize_text_field( $searchData['post_type'] );
			} else {
				$Enable_DefaultStxt = 1;
				$PostType           = $Def_post;
			}

			$PostType  = ( ! empty( $searchData ) && ! empty( $searchData['post_type'] ) ) ? sanitize_text_field( $searchData['post_type'] ) : $Def_post;
			$postper   = ! empty( $_POST['postper'] ) ? intval( $_POST['postper'] ) : 3;
			$GFilter   = ! empty( $_POST['GFilter'] ) ? $_POST['GFilter'] : array();
			$GFSType   = ! empty( $GFilter['GFSType'] ) ? sanitize_text_field( $GFilter['GFSType'] ) : 'otheroption';
			$ACFEnable = ! empty( $_POST['ACFilter']['ACFEnable'] ) ? $_POST['ACFilter']['ACFEnable'] : 0;
			$ACF_Key   = ! empty( $_POST['ACFilter']['ACFkey'] ) ? $_POST['ACFilter']['ACFkey'] : '';

			if ( $PostType == 'product' && ! class_exists( 'woocommerce' ) ) {
				$response['error']   = 1;
				$response['message'] = 'woocommerce checked!';
				wp_send_json_success( $response );
				die();
			}

			$ResultData = ! empty( $_POST['ResultData'] ) ? $_POST['ResultData'] : array();
			$Pagestyle  = ! empty( $ResultData['Pagestyle'] ) ? $ResultData['Pagestyle'] : 'none';

			$response = array(
				'error'      => false,
				'post_count' => 0,
				'message'    => '',
				'posts'      => null,
			);

			foreach ($searchData as $key => $value) {
				if (strpos($key, 'taxonomy_') !== false) {
					// Key contains 'taxonomy'
					$taxonomy_name = str_replace('taxonomy_', '', $key);
		
					$taxonomy = get_taxonomy( $taxonomy_name );
					if ( $taxonomy && ! empty( $taxonomy->object_type ) ) {
						$post_types = $taxonomy->object_type;
						$PostType = $post_types[0];
					} else {
						$PostType = 'any';
					}
				}
			}

			$query_args = array(
				'post_type'           => $PostType,
				'suppress_filters'    => false,
				'ignore_sticky_posts' => true,
				'orderby'             => 'relevance',
				'posts_per_page'      => -1,
				'post_status'         => 'publish',
			);

			$seaposts = array();
			if ( ! empty( $_POST['text'] ) ) {
				global $wpdb;
				$sqlContent = $_POST['text'];
				if ( ! empty( $ACFEnable ) || ( ! empty( $GFilter['GFEnable'] ) ) ) {
					$AllData = $GTitle = $GExcerpt = $Gcontent = $GName = $PCat = $PTag = $ACFData = array();

					$Result = '';
					if ( $GFSType == 'fullMatch' ) {
						$Result = "{$wpdb->esc_like($sqlContent)}";
					} elseif ( $GFSType == 'wordmatch' ) {
						$Result = "{$wpdb->esc_like($sqlContent)}%";
					} else {
						$Result = "%{$wpdb->esc_like($sqlContent)}%";
					}

					$Publish = $wpdb->prepare( " AND {$wpdb->posts}.post_status = %s ", 'publish' );

					$DType = '';
					if ( ! empty( $PostType ) ) {
						if ( ! empty( $Enable_DefaultStxt ) ) {
							$DType = '';
						} else {
							$DType = $wpdb->prepare( ' AND post_type = %s', $PostType );
						}
					} else {
						$DType = " AND post_type IN ('post','page','product')";
					}

					if ( ! empty( $GFilter['GFEnable'] ) ) {
						if ( ! empty( $GFilter['GFTitle'] ) ) {
							$GTitle = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.post_title LIKE %s {$Publish} {$DType}", $Result ) );
						}
						if ( ! empty( $GFilter['GFExcerpt'] ) ) {
							$GExcerpt = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.post_excerpt LIKE %s {$Publish} {$DType}", $Result ) );
						}
						if ( ! empty( $GFilter['GFContent'] ) ) {
							$Gcontent = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.post_content LIKE %s {$Publish} {$DType}", $Result ) );
						}
						if ( ! empty( $GFilter['GFName'] ) ) {
							$GName = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.post_name LIKE %s {$Publish} {$DType}", $Result ) );
						}
						if ( ! empty( $GFilter['GFCategory'] ) && $PostType != 'page' ) {
							$CatTaxonomy = '';
							$CatPT       = $PostType;
							$CatType     = 'category_name';
							if ( $PostType == 'post' ) {
								$CatTaxonomy = 'category';
							} elseif ( $PostType == 'product' ) {
								$CatTaxonomy = $CatType = 'product_cat';
							} else {
								$CatTaxonomy = 'any';
								$CatPT       = 'post';
							}

							$PCat = query_posts(
								array(
									'taxonomy'       => $CatTaxonomy,
									'post_type'      => $CatPT,
									$CatType         => $sqlContent,
									'post_status'    => 'publish',
									'posts_per_page' => -1,
									'orderby'        => 'name',
									'order'          => 'ASC',
									'hide_empty'     => 0,
								)
							);
						}
						if ( ! empty( $GFilter['GFTags'] ) && $PostType != 'page' ) {
							$TagTaxonomy = $TagType = '';
							$TagPT       = $PostType;
							$ArrayData   = array();
							if ( is_array( $PostType ) ) {
								foreach ( $PostType as $key => $value ) {
									if ( $value == 'post' ) {
										$TagTaxonomy = 'post_tag';
										$TagType     = 'tag';
									} elseif ( $value == 'product' ) {
										$TagTaxonomy = 'product_tag';
										$TagType     = 'product_tag';
									} else {
										/**static tag Taxonomy*/
										$TagTaxonomy = 'post_tag';
										$TagType     = 'tag';
									}

									$ArrayData = array(
										'taxonomy'       => $TagTaxonomy,
										'post_type'      => $value,
										$TagType         => $sqlContent,
										'post_status'    => 'publish',
										'posts_per_page' => -1,
										'orderby'        => 'name',
										'order'          => 'ASC',
										'hide_empty'     => 0,
									);

									$Gettags = query_posts( $ArrayData );

									$PTag = array_merge( $PTag, $Gettags );
								}
							} else {
								if ( $PostType == 'post' ) {
									$TagTaxonomy = 'post_tag';
									$TagType     = 'tag';
								} elseif ( $PostType == 'product' ) {
									$TagTaxonomy = 'product_tag';
									$TagType     = 'product_tag';
								} else {
									/**static tag Taxonomy*/
									$TagTaxonomy = 'post_tag';
									$TagType     = 'tag';
								}

								$PTag = query_posts(
									array(
										'taxonomy'       => $TagTaxonomy,
										'post_type'      => $TagPT,
										$TagType         => $sqlContent,
										'post_status'    => 'publish',
										'posts_per_page' => -1,
										'orderby'        => 'name',
										'order'          => 'ASC',
										'hide_empty'     => 0,
									)
								);
							}
						}
					}

					if ( class_exists( 'acf' ) && ! empty( $ACFEnable ) && ! empty( $ACF_Key ) ) {
						$ACFPrepare = $wpdb->prepare( "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.ID {$Publish}" );
						$AcfPost    = $wpdb->get_results( $ACFPrepare );
						foreach ( $AcfPost as $key => $one ) {
							$PostID  = ! empty( $one->ID ) ? $one->ID : '';
							$GetData = acf_get_field( $ACF_Key )['key'];
							$ACFone  = get_field( $GetData, $PostID );
							if ( ! empty( $ACFone ) ) {
								$ACFArray = explode( '|', $ACFone );
								foreach ( $ACFArray as $two ) {
									$ACFtxt = ltrim( rtrim( $two ) );
									if ( ( $GFSType == 'otheroption' ) && str_contains( strtolower( $ACFtxt ), strtolower( $sqlContent ) ) ) {
										$ACFData[] = $one->ID;
									} elseif ( ( $GFSType == 'fullMatch' ) && ( strtolower( $ACFtxt ) == strtolower( $sqlContent ) ) ) {
										$ACFData[] = $one->ID;
									}
								}
							}
						}
					}

					array_push( $AllData, $GTitle, $GExcerpt, $Gcontent, $GName, $PCat, $PTag, $ACFData );
					$TmpPostID = array();
					if ( ! empty( $AllData ) ) {
						foreach ( $AllData as $one ) {
							if ( ! empty( $one ) ) {
								foreach ( $one as $two ) {
									if ( ! empty( $GFilter['GFEnable'] ) && ! empty( $two->ID ) ) {
										$TmpPostID[] = $two->ID;
									} elseif ( ! empty( $ACFEnable ) && ! empty( $two ) ) {
										$TmpPostID[] = $two;
									}
								}
							}
						}
					}

					if ( ! empty( $TmpPostID ) ) {
						$query_args['post__in'] = $TmpPostID;
					} else {
						$query_args['s'] = $sqlContent;
						// $query_args['post__in'] = [0];
					}
				} else {
					$query_args['s'] = $sqlContent;
				}
			}

			if ( $PostType == 'product' ) {
				$tax_query = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => array( 'exclude-from-search', 'exclude-from-catalog' ),
						'operator' => 'NOT IN',
					),
				);
			}

			foreach ($searchData as $key => $value) {
				if (strpos($key, 'taxonomy_') !== false) {
					// Key contains 'taxonomy'
					$modifiedKey = str_replace('taxonomy_', '', $key);
					if (isset($value) && !empty($value) && $value !='all') {
						$tax_query[] = [
							'taxonomy' => $modifiedKey,
							'field'    => 'term_id',
							'terms'    => $value
						];
					}
				}
			}

			// if ( ! empty( $searchData['taxonomy'] ) && ! empty( $searchData['cat'] ) ) {
			// 	$tax_query = array(
			// 		array(
			// 			'taxonomy' => $searchData['taxonomy'],
			// 			'field'    => 'term_id',
			// 			'terms'    => $searchData['cat'],
			// 		),
			// 	);
			// }

			if ( ! empty( $tax_query ) ) {
				$query_args['tax_query'] = array(
					'relation' => 'AND',
					$tax_query,
				);
			}

			if ( $Pagestyle !== 'none' ) {
				$offset        = ! empty( $_POST['offset'] ) ? $_POST['offset'] : '';
				$loadmore_Post = ! empty( $_POST['loadNumpost'] ) ? $_POST['loadNumpost'] : $postper;

				$query_args['offset'] = $offset;
				if ( $Pagestyle == 'pagination' ) {
					$query_args['posts_per_page'] = $postper;
				} elseif ( $Pagestyle == 'load_more' ) {
					$query_args['posts_per_page'] = $loadmore_Post;
				} elseif ( $Pagestyle == 'lazy_load' ) {
					$query_args['posts_per_page'] = $loadmore_Post;
				}
			} else {
				$query_args['posts_per_page'] = $postper;
			}

			$seaposts = new WP_Query( $query_args );

			$response['posts']       = array();
			$response['limit_query'] = $postper;
			$response['columns']     = ceil( $seaposts->found_posts / $postper );
			$response['post_count']  = $seaposts->found_posts;
			$response['total_count'] = $seaposts->found_posts;

			if ( $Pagestyle == 'pagination' && $response['limit_query'] < $response['post_count'] ) {
				$response['pagination'] = '';

				$Pcounter               = ! empty( $ResultData['Pcounter'] ) ? $ResultData['Pcounter'] : 0;
				$PClimit                = ! empty( $ResultData['PClimit'] ) ? $ResultData['PClimit'] : 5;
				$PNavigation            = ! empty( $ResultData['PNavigation'] ) ? $ResultData['PNavigation'] : 0;
				$PNxttxt                = ! empty( $ResultData['PNxttxt'] ) ? $ResultData['PNxttxt'] : '';
				$PPrevtxt               = ! empty( $ResultData['PPrevtxt'] ) ? $ResultData['PPrevtxt'] : '';
				$PNxticon               = ! empty( $ResultData['PNxticon'] ) ? $ResultData['PNxticon'] : '';
				$PPrevicon              = ! empty( $ResultData['PPrevicon'] ) ? $ResultData['PPrevicon'] : '';
				$Pstyle                 = ! empty( $ResultData['Pstyle'] ) ? $ResultData['Pstyle'] : 'center';

				$next = $prev = $BtnNum = '';
				if ( ! empty( $PNavigation ) ) {
					$next     .= '<button class="tp-pagelink prev" data-prev="1" >';
						$next .= ( ! empty( $PPrevtxt ) ) ? '<span class="tp-prev-txt">' . esc_html( $PPrevtxt ) . '</span>' : '';
						$next .= ( ! empty( $PPrevicon ) ) ? '<span class="tp-prev-icon"> <i class="' . esc_attr( $PPrevicon ) . ' tp-title-icon"></i> </span>' : '';
					$next     .= '</button>';
				}

				if ( ! empty( $Pcounter ) ) {
					if ( $response['columns'] <= $PClimit ) {
						for ( $i = 0; $i < $PClimit; $i++ ) {
							if ( $i < $response['columns'] ) {
								$active  = ( ( $i + 1 ) == 1 ) ? 'active' : '';
								$BtnNum .= '<button class="tp-pagelink tp-ajax-page ' . esc_attr( $active ) . '" data-page="' . esc_attr( $i + 1 ) . '" >' . esc_html( $i + 1 ) . '</button>';
							}
						}
					} else {
						for ( $i = 0; $i < $response['columns']; $i++ ) {
							if ( $i < $PClimit ) {
								$active  = ( ( $i + 1 ) == 1 ) ? 'active' : '';
								$BtnNum .= '<button class="tp-pagelink tp-ajax-page ' . esc_attr( $active ) . '" data-page="' . esc_attr( $i + 1 ) . '" >' . esc_html( $i + 1 ) . '</button>';
							} else {
								$active  = ( ( $i + 1 ) == 1 ) ? 'active' : '';
								$BtnNum .= '<button class="tp-pagelink tp-ajax-page tp-hide ' . esc_attr( $active ) . '" data-page="' . esc_attr( $i + 1 ) . '" >' . esc_html( $i + 1 ) . '</button>';
							}
						}
					}
				} else {
					for ( $i = 0; $i < $response['columns']; $i++ ) {
						$active  = ( ( $i + 1 ) == 1 ) ? 'active' : '';
						$BtnNum .= '<button class="tp-pagelink tp-ajax-page tp-hide ' . esc_attr( $active ) . '" data-page="' . esc_attr( $i + 1 ) . '" >' . esc_html( $i + 1 ) . '</button>';
					}
				}

				if ( ! empty( $PNavigation ) ) {
					$prev     .= '<button class="tp-pagelink next" data-next="1">';
						$prev .= ! empty( $PNxttxt ) ? '<span class="tp-next-txt">' . esc_html( $PNxttxt ) . '</span>' : '';
						$prev .= ! empty( $PNxticon ) ? '<span class="tp-next-icon"> <i class="' . esc_attr( $PNxticon ) . ' tp-title-icon"></i> </span>' : '';
						$prev .= '</button>';
				}

				if ( $Pstyle == 'after' ) {
					$response['pagination'] .= $next . $prev . $BtnNum;
				} elseif ( $Pstyle == 'center' ) {
					$response['pagination'] .= $next . $BtnNum . $prev;
				} elseif ( $Pstyle == 'before' ) {
					$response['pagination'] .= $BtnNum . $next . $prev;
				}
			} elseif ( $Pagestyle == 'load_more' ) {
				$BtnTxt               = ! empty( $ResultData['loadbtntxt'] ) ? $ResultData['loadbtntxt'] : 0;
				$response['loadmore'] = '<a class="post-load-more" data-page="1" >' . esc_html( $BtnTxt ) . '</a>';
				$LoadPage             = ! empty( $ResultData['loadpage'] ) ? $ResultData['loadpage'] : 0;
				if ( ! empty( $LoadPage ) ) {
					$PageHtml   = '';
					$Pagetxt    = ! empty( $ResultData['loadPagetxt'] ) ? $ResultData['loadPagetxt'] : '';
					$loadnumber = ! empty( $ResultData['loadnumber'] ) ? $ResultData['loadnumber'] : $postper;
					// $Numbcount = ceil($seaposts->found_posts / $loadnumber);
					$Numbcount = ceil( ( $seaposts->found_posts - $postper ) / $loadnumber ) + 1;

					$PageHtml .= '<span class="tp-page-link" >' . esc_html( $Pagetxt ) . '</span>';
					$PageHtml .= '<button class="tp-pagelink tp-load-page" data-page="1" ><span class="tp-load-number" > 1 </span> / ' . esc_html( $Numbcount ) . ' </button>';

					$response['loadmore_page'] = $PageHtml;
				}
			} elseif ( $Pagestyle == 'lazy_load' ) {
				$response['lazymore'] = '<a class="post-lazy-load" data-page="1"><div class="tp-spin-ring"><div></div><div></div><div></div><div></div></div></a>';
			}

			foreach ( $seaposts->posts as $key => $post ) {
				$product = '';
				if ( $PostType == 'product' || $GetTaxonomy == 'product_cat' || $GetTaxonomy == 'product_tag' ) {
					$product = wc_get_product( $post->ID );
				}

				$url                       = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
				$response['posts'][ $key ] = array(
					'title'        => ! empty( $post ) ? $post->post_title : '',
					'content'      => ! empty( $post ) ? $post->post_title : '',
					'link'         => ! empty( $post ) ? get_permalink( $post ) : '',
					'content'      => ! empty( $post ) ? $post->post_excerpt : '',
					'thumb'        => $url,
					'PostType'     => $PostType,
					'Wo_Price'     => ! empty( $product ) ? $product->get_price_html() : '',
					'Wo_shortDesc' => ! empty( $product ) ? $product->get_short_description() : '',
				);
			}

			wp_reset_postdata();
			wp_send_json_success( $response );
		}

		public function custom_search_filter($query) {
			if ($query->is_search && !is_admin() && isset($_GET)) {
				$tax_query = [];
				$PostType = '';
				if(isset($_GET['post_type']) && !empty($_GET['post_type'])){
					$PostType = $_GET['post_type'];
				}
				foreach ($_GET as $key => $value) {
					if (strpos($key, 'taxonomy_') !== false) {
						$modifiedKey = str_replace('taxonomy_', '', $key);
						if (isset($value) && !empty($value) ) {
							$tax_query[] = [
								'taxonomy' => $modifiedKey,
								'field'    => 'term_id',
								'terms'    => $value
							];
						}
						$taxonomy = get_taxonomy( $modifiedKey );
						if ( $taxonomy && ! empty( $taxonomy->object_type ) ) {
							$post_types = $taxonomy->object_type;
							$PostType = $post_types[0];
						}else if(!empty($_GET['post_type'])){
							$PostType = $_GET['post_type'];
						}else{
							$PostType = 'any';
						}
					}
				}
		
				if(!empty($tax_query)){
					$query->set('tax_query', [ 'relation' => 'AND', $tax_query ]);
				}
				if(!empty($PostType)){
					$query->set('post_type', $PostType);
				}
			}
			return $query;
		}

		/*search URL*/
		public function theplus_search_bar_query( $query ) {
			// if ( $query->is_search() && ! is_admin() && $query->is_main_query() ) {
			// 	if ( isset( $_GET['taxonomy'] ) && ! empty( $_GET['taxonomy'] ) && $_GET['taxonomy'] != 'category' && isset( $_GET['cat'] ) && ! empty( $_GET['cat'] ) ) {
			// 		$emag = get_term_by( 'id', $_GET['cat'], $_GET['taxonomy'] );

			// 		if ( ! empty( $emag->count ) && $emag->count >= 1 ) {
			// 			unset( $query->query['cat'] );
			// 			unset( $query->query_vars['cat'] );
			// 			$query->query[ $_GET['taxonomy'] ]      = $emag->slug;
			// 			$query->query_vars[ $_GET['taxonomy'] ] = $emag->slug;
			// 		}
			// 	}
			// }

			if ($query->is_search && !is_admin() && isset($_GET)) {
				$tax_query = [];
				$PostType = '';
				if(isset($_GET['post_type']) && !empty($_GET['post_type'])){
					$PostType = $_GET['post_type'];
				}
				foreach ($_GET as $key => $value) {
					if (strpos($key, 'taxonomy_') !== false) {
						$modifiedKey = str_replace('taxonomy_', '', $key);
						if (isset($value) && !empty($value) ) {
							$tax_query[] = [
								'taxonomy' => $modifiedKey,
								'field'    => 'term_id',
								'terms'    => $value
							];
						}
						$taxonomy = get_taxonomy( $modifiedKey );
						if ( $taxonomy && ! empty( $taxonomy->object_type ) ) {
							$post_types = $taxonomy->object_type;
							$PostType = $post_types[0];
						}else if(!empty($_GET['post_type'])){
							$PostType = $_GET['post_type'];
						}else{
							$PostType = 'any';
						}
					}
				}
		
				if(!empty($tax_query)){
					$query->set('tax_query', [ 'relation' => 'AND', $tax_query ]);
				}

				if(!empty($PostType)){
					$query->set('post_type', $PostType);
				}
			}
			return $query;
		}
	}

	return Tp_Search_Bar::get_instance();
}
