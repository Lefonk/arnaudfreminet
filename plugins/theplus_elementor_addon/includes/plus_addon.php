<?php 

/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	
global $theplus_options,$post_type_options;
		
add_image_size( 'tp-image-grid', 700, 700, true);


/*dynamic listing quickview*/

if (! function_exists('tp_get_image_rander') && version_compare( L_THEPLUS_VERSION, '5.0.2', '<' ) ) {
	function tp_get_image_rander( $id ='', $size = 'full', $attr =[], $posttype = 'attachment' ) {
		if( empty($id) ){
			return '';
		}
		
		if(!empty($posttype) && $posttype=='post' ){
			$get_post = get_post( $id );
	 
			if ( ! $get_post ) {
				return '';
			}
			$id = get_post_thumbnail_id( $get_post );
		}
		
		if( ! wp_get_attachment_image_src( $id ) ){
			return '';
		}
		
		$output = '';	
		
		$get_image = wp_get_attachment_image( $id, $size, false, $attr );
		
		$check_srcset = strpos( $get_image, 'srcset' ) !== false;
				
		$output = $get_image . $output;

		return $output;
	}
}

// Check Html Tag
function theplus_html_tag_check(){
	return [ 'div',
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6',
		'a',
		'span',
		'p',
		'header',
		'footer',
		'article',
		'aside',
		'main',
		'nav',		
		'section',		
	];
}		

function theplus_validate_html_tag( $check_tag ) {
	return in_array( strtolower( $check_tag ), theplus_html_tag_check() ) ? $check_tag : 'div';
}

/*pre loader body class*/
$theplus_optionsget = get_option( 'theplus_options');
if(!empty($theplus_optionsget['check_elements']) && isset($theplus_optionsget['check_elements'])){
	if (in_array("tp_pre_loader", $theplus_optionsget['check_elements'])){
		function theplus_body_class($classes) {
			$classes[]="theplus-preloader";
			return $classes;
		}
	add_filter('body_class', 'theplus_body_class');
	}	
}


/*woo multi step*/
function woo_checkout_update_order_review() {
	ob_start();
	Woo_Checkout::checkout_order_review_default();
	$woo_checkout_order_review = ob_get_clean();

	wp_send_json(
		array(
			'order_review' => $woo_checkout_order_review,
		)
	);
}
add_action('wp_ajax_woo_checkout_update_order_review', 'woo_checkout_update_order_review',10);
add_action('wp_ajax_nopriv_woo_checkout_update_order_review','woo_checkout_update_order_review',10);


//user profile social
function theplus_user_social_links( $user_contact ) {   
   $user_contact['tp_phone_number'] = __('Phone Number', 'theplus');
   $user_contact['tp_profile_facebook'] = __('Facebook Link', 'theplus');
   $user_contact['tp_profile_twitter'] = __('Twitter Link', 'theplus');
   $user_contact['tp_profile_instagram'] = __('Instagram', 'theplus');

   return $user_contact;
}
add_filter('user_contactmethods', 'theplus_user_social_links',10);

/* WOOCOMMERCE Mini Cart */
function theplus_woocomerce_ajax_cart_update($fragments) {
	if(class_exists('woocommerce')) {		
		ob_start();
		?>			
			
			<div class="cart-wrap"><span><?php echo WC()->cart->get_cart_contents_count(); ?></span></div>
		<?php
		$fragments['.cart-wrap'] = ob_get_clean();
		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'theplus_woocomerce_ajax_cart_update', 10, 3);

/*3rd party WC_Product_Subtitle*/
if(!function_exists('product_subtitle_after_title')){
	function product_subtitle_after_title() {
		echo do_shortcode("[product_subtitle]");
	}
}
add_action("theplus_after_product_title","product_subtitle_after_title");
/*3rd party WC_Product_Subtitle*/

/*defer script*/
function tp_defer_scripts( $tag, $handle, $src ) {
			$defer = array( 
	'google_platform_js'
  );
  if ( in_array( $handle, $defer ) ) {
	 return '<script src="' . $src . '" async defer type="text/javascript"></script>' . "\n";
  }
	
	return $tag;
} 

add_filter( 'script_loader_tag', 'tp_defer_scripts', 10, 3 );
/*defer script*/

function theplus_get_thumb_url(){
	return THEPLUS_ASSETS_URL .'images/placeholder-grid.jpg';
}

/* Custom Link url attachment Media */
function plus_attachment_field_media( $form_fields, $post ) {
    $form_fields['plus-gallery-url'] = array(
        'label' => esc_html__('Custom URL','theplus'),
        'input' => 'url',
        'value' => get_post_meta( $post->ID, 'plus_gallery_url', true ),
        'helps' => esc_html__('Gallery Listing Widget Used Custom Url Media','theplus'),
    );
    return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'plus_attachment_field_media', 10, 2 );
function plus_attachment_field_save( $post, $attachment ) {    
    if( isset( $attachment['plus-gallery-url'] ) )
		update_post_meta( $post['ID'], 'plus_gallery_url', esc_url( $attachment['plus-gallery-url'] ) ); 
    
	return $post;	
}
add_filter( 'attachment_fields_to_save', 'plus_attachment_field_save', 10, 2 );
/* Custom Link url attachment Media */

class Theplus_MetaBox {
	
	public static function get($name) {
		global $post;
		
		if (isset($post) && !empty($post->ID)) {
			return get_post_meta($post->ID, $name, true);
		}
		
		return false;
	}
}
function theplus_get_option($options_type,$field){
	$theplus_options=get_option( 'theplus_options' );
	$post_type_options=get_option( 'post_type_options' );
	$values='';
	if($options_type=='general'){
		if(isset($theplus_options[$field]) && !empty($theplus_options[$field])){
			$values=$theplus_options[$field];
		}
	}
	if($options_type=='post_type'){
		if(isset($post_type_options[$field]) && !empty($post_type_options[$field])){
			$values=$post_type_options[$field];
		}
	}
	return $values;
}

function theplus_white_label_option($field){
	$label_options=get_option( 'theplus_white_label' );	
		$values='';
		if(isset($label_options[$field]) && !empty($label_options[$field])){
			$values=$label_options[$field];
		}	
	return $values;
}

function theplus_testimonial_post_name(){
	$post_type_options=get_option( 'post_type_options' );
	$testi_post_type=!empty($post_type_options['testimonial_post_type']) ? $post_type_options['testimonial_post_type'] : '';
	$post_name='theplus_testimonial';
	if(isset($testi_post_type) && !empty($testi_post_type)){
		if($testi_post_type=='themes'){
			$post_name=theplus_get_option('post_type','testimonial_theme_name');
		}elseif($testi_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','testimonial_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','testimonial_plugin_name');
			}
		}elseif($testi_post_type=='themes_pro'){
			$post_name='testimonial';
		}
	}else{
		$post_name='theplus_testimonial';
	}
	return $post_name;
}
function theplus_testimonial_post_category(){
	$post_type_options=get_option( 'post_type_options' );
	$testi_post_type=!empty($post_type_options['testimonial_post_type']) ? $post_type_options['testimonial_post_type'] : '';
	$taxonomy_name='theplus_testimonial_cat';
	if(isset($testi_post_type) && !empty($testi_post_type)){
		if($testi_post_type=='themes'){
			$taxonomy_name=theplus_get_option('post_type','testimonial_category_name');
		}else if($testi_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','testimonial_category_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$taxonomy_name=theplus_get_option('post_type','testimonial_category_plugin_name');
			}
		}elseif($testi_post_type=='themes_pro'){
			$taxonomy_name='testimonial_category';
		}
	}else{
		$taxonomy_name='theplus_testimonial_cat';
	}
	return $taxonomy_name;
}
function theplus_client_post_name(){
	$post_type_options=get_option( 'post_type_options' );
	$client_post_type=!empty($post_type_options['client_post_type']) ? $post_type_options['client_post_type'] : '';
	$post_name='theplus_clients';
	if(isset($client_post_type) && !empty($client_post_type)){
		if($client_post_type=='themes'){
			$post_name=theplus_get_option('post_type','client_theme_name');
		}elseif($client_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','client_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','client_plugin_name');
			}
		}elseif($client_post_type=='themes_pro'){
			$post_name='clients';
		}
	}else{
		$post_name='theplus_clients';
	}
	return $post_name;
}
function theplus_client_post_category(){
	$post_type_options=get_option( 'post_type_options' );
	$client_post_type=!empty($post_type_options['client_post_type']) ? $post_type_options['client_post_type'] : '';
	$post_name='theplus_clients_cat';
	if(isset($client_post_type) && !empty($client_post_type)){
		if($client_post_type=='themes'){
			$post_name=theplus_get_option('post_type','client_category_name');
		}else if($client_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','client_category_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','client_category_plugin_name');
			}
		}elseif($client_post_type=='themes_pro'){
			$post_name='clients_category';
		}
	}else{
		$post_name='theplus_clients_cat';
	}
	return $post_name;
}
function theplus_team_member_post_name(){
	$post_type_options=get_option( 'post_type_options' );
	$team_post_type=!empty($post_type_options['team_member_post_type']) ? $post_type_options['team_member_post_type'] : '';
	$post_name='theplus_team_member';
	if(isset($team_post_type) && !empty($team_post_type)){
		if($team_post_type=='themes'){
			$post_name=theplus_get_option('post_type','team_member_theme_name');
		}elseif($team_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','team_member_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','team_member_plugin_name');
			}
		}elseif($team_post_type=='themes_pro'){
			$post_name='team_member';
		}
	}else{
		$post_name='theplus_team_member';
	}
	return $post_name;
}
function theplus_team_member_post_category(){
	$post_type_options=get_option( 'post_type_options' );
	$team_post_type=!empty($post_type_options['team_member_post_type']) ? $post_type_options['team_member_post_type'] : '';
	$taxonomy_name='theplus_team_member_cat';
	if(isset($team_post_type) && !empty($team_post_type)){
		if($team_post_type=='themes'){
			$taxonomy_name=theplus_get_option('post_type','team_member_category_name');
		}else if($team_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','team_member_category_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$taxonomy_name=theplus_get_option('post_type','team_member_category_plugin_name');
			}
		}elseif($team_post_type=='themes_pro'){
			$taxonomy_name='team_member_category';
		}
	}else{
		$taxonomy_name='theplus_team_member_cat';
	}
	return $taxonomy_name;
}

/* woo swatches
 * @since 4.1.8
 * Woocommerce Custom Field Type
 */
function tp_product_attributes_types($selector){
		$type = tp_product_attr();
		
		foreach ( $type as $key => $options ) {
			$selector[ $key ] = $options['title'];
		}

		return $selector;
}

//Woocommerce Custom Attributes
function tp_product_attr($type = false){

	$types['color'] = array(
		'title'   => esc_html__( 'Color', 'theplus' ),
	);
	$types['image'] = array(
		'title'   => esc_html__( 'Image', 'theplus' ),
	);
	$types['button'] = array(
		'title'   => esc_html__( 'Button', 'theplus' ),
	);

	if ( $type ) {
		return isset( $types[ $type ] ) ? $types[ $type ] : array();
	}
	
	return $types;
}

$theplus_data=get_option( 'theplus_api_connection_data' );
if(isset($theplus_optionsget['check_elements']) && !empty($theplus_optionsget['check_elements']) && (in_array("tp_woo_single_basic", $theplus_optionsget['check_elements']) || in_array("tp_search_filter", $theplus_optionsget['check_elements']))  && !empty($theplus_data['theplus_woo_swatches_switch'])){
	add_filter( 'product_attributes_type_selector', 'tp_product_attributes_types') ;
}
/*woo swatches*/

function theplus_scroll_animation(){
	
	$theplus_data=get_option( 'theplus_api_connection_data' );
		
	if(isset($theplus_data['scroll_animation_offset']) && !empty($theplus_data['scroll_animation_offset']) && $theplus_data['scroll_animation_offset']!=0){
		$value= $theplus_data['scroll_animation_offset'].'%';
	}else if(isset($theplus_data['scroll_animation_offset']) && !empty($theplus_data['scroll_animation_offset']) && $theplus_data['scroll_animation_offset']==0){
		$value= '85%';
	}else{
		$value= '85%';
	}
	
	return $value;
}
function theplus_excerpt($limit) {
	if(method_exists('WPBMap', 'addAllMappedShortcodes')) {
		WPBMap::addAllMappedShortcodes();
	}
		global $post;
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		$content = explode(' ', get_the_content(), $limit);
		
		if(!empty($excerpt)){
			if (count($excerpt)>=$limit) {
				array_pop($excerpt);			
				$excerpt = implode(" ",$excerpt).'...';			
			}else{
				$excerpt = implode(" ",$excerpt);
			}
		}else if(count($content)>=$limit){
			array_pop($content);			
			$excerpt = implode(" ",$content).'...';			
		}else {
			$excerpt = implode(" ",$excerpt);			
		}	
		$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
	
	return $excerpt;
}
function limit_words($string, $word_limit){
	$words = explode(" ",$string);
	return implode(" ",array_splice($words,0,$word_limit));
}	
function theplus_get_title($limit) {
	if(method_exists('WPBMap', 'addAllMappedShortcodes')) {
		WPBMap::addAllMappedShortcodes();
	}
		global $post;
		$title = explode(' ', get_the_title(), $limit);
		if (count($title)>=$limit) {
			array_pop($title);
			$title = implode(" ",$title).'...';
		} else {
			$title = implode(" ",$title);
		}	
		$title = preg_replace('`[[^]]*]`','',$title);
	
	return $title;
}
function theplus_loading_image_grid($postid='',$type=''){
	global $post;
	$content_image='';
	if($type!='background'){		
		$image_url=THEPLUS_ASSETS_URL .'images/placeholder-grid.jpg';
		$content_image='<img src="'.esc_url($image_url).'" alt="'.esc_attr(get_the_title()).'"/>';
		
		return $content_image;
	
	}elseif($type=='background'){
	
		$image_url=THEPLUS_ASSETS_URL .'images/placeholder-grid.jpg';
		$data_src='style="background:url('.esc_url($image_url).') #f7f7f7;" ';
		
		return $data_src;
		
	}
}
function theplus_loading_bg_image($postid=''){
	global $post;
	$content_image='';
	if(!empty($postid)){
		$featured_image=get_the_post_thumbnail_url($postid,'full');
		if(empty($featured_image)){
			$featured_image=theplus_get_thumb_url();
		}
		$content_image='style="background:url('.esc_url($featured_image).') #f7f7f7;"';
		return $content_image;
	}else{
	return $content_image;
	}
}
function theplus_array_flatten($array) {
	  if (!is_array($array)) { 
		return FALSE; 
	  } 
	  $result = array(); 
	  foreach ($array as $key => $value) { 
		if (is_array($value)) { 
		  $result = array_merge($result, theplus_array_flatten($value)); 
		} 
		else { 
		  $result[$key] = $value; 
		} 
	  } 
	  return $result; 
}
function theplus_createSlug($str, $delimiter = '-'){
	
	$slug=preg_replace('/[^A-Za-z0-9-]+/', $delimiter, $str);
	return $slug;
	
} 

function tp_number_short( $n, $precision = 1 ) {
    if ($n < 900) {
        $n_format = number_format($n, $precision);
        $suffix = '';
    } else if ($n < 900000) {
        $n_format = number_format($n / 1000, $precision);
        $suffix = 'K';
    } else if ($n < 900000000) {
        $n_format = number_format($n / 1000000, $precision);
        $suffix = 'M';
    } else if ($n < 900000000000) {
        $n_format = number_format($n / 1000000000, $precision);
        $suffix = 'B';
    } else {
        $n_format = number_format($n / 1000000000000, $precision);
        $suffix = 'T';
	}
	
    if ( $precision > 0 ) {
        $dotzero = '.' . str_repeat( '0', $precision );
        $n_format = str_replace( $dotzero, '', $n_format );
    }
    return $n_format . $suffix;
}

/**
 * It is used for Remove transist for social feed, social remove, table widget
 *
 * @version 5.2.5
 */
function Tp_delete_transient() {
	$result = [];
	$delete_transient_nonce = isset($_POST['delete_transient_nonce']) ? $_POST['delete_transient_nonce'] : '';

	if( wp_verify_nonce($delete_transient_nonce, 'delete_transient_nonce') ) {
		global $wpdb;
			$table_name = $wpdb->prefix . "options";
			$DataBash = $wpdb->get_results( "SELECT * FROM $table_name" );
			$blockName = !empty($_POST['blockName']) ? $_POST['blockName'] : '';

			if($blockName == 'SocialFeed'){
				$transient = array(
					// facebook
						'Fb-Url-',
						'Fb-Time-',
						'Data-Fb-',
					// vimeo
						'Vm-Url-',
						'Vm-Time-',
						'Data-Vm-',
					// Instagram basic
						'IG-Url-',
						'IG-Profile-',
						'IG-Time-',
						'Data-IG-',	
					// Instagram Graph
						'IG-GP-Url-',
						'IG-GP-Time-',
						'IG-GP-Data-',
						'IG-GP-UserFeed-Url-',
						'IG-GP-UserFeed-Data-',
						'IG-GP-Hashtag-Url-',
						'IG-GP-HashtagID-data-',
						'IG-GP-HashtagData-Url-',
						'IG-GP-Hashtag-Data-',
						'IG-GP-story-Url-',
						'IG-GP-story-Data-',
						'IG-GP-Tag-Url-',
						'IG-GP-Tag-Data-',
					// Tweeter
						'Tw-BaseUrl-',
						'Tw-Url-',
						'Tw-Time-',
						'Data-tw-',
					// Youtube
						'Yt-user-',
						'Yt-user-Time-',
						'Data-Yt-user-',
						'Yt-Url-',
						'Yt-Time-',
						'Data-Yt-',
						'Yt-C-Url-',
						'Yt-c-Time-',
						'Data-c-Yt-',
						'Data-Yt-handle-',
						'Yt-handle-',
						'Yt-handle-Time-',
					// loadmore
						'SF-Loadmore-',
					// Performance
						'SF-Performance-'
				);
			}else if($blockName == 'SocialReviews'){
				$transient = array(
					// Facebook
						'Fb-R-Url-',
						'Fb-R-Time-',
						'Fb-R-Data-',
					// Google
						'G-R-Url-',
						'G-R-Time-',
						'G-R-Data-',
					// loadmore
						'SR-LoadMore-',
					// Performance
						'SR-Performance-',
					// Beach
						'Beach-Url-',
						'Beach-Time-',
						'Beach-Data-',
				);
			}else if($blockName == 'Table'){
				// Google Sheet
				$transient = array(
					'tp-gs-table-url-',
					'tp-gs-table-time-',
					'tp-gs-table-Data-',
				);
			}

			foreach ($DataBash as $First) {
				foreach ($transient as $second) {
					$Find_Transient = !empty($First->option_name) ? strpos( $First->option_name, $second ) : '';
					if(!empty($Find_Transient)){
						$wpdb->delete( $table_name, array( 'option_name' => $First->option_name ) );
					}
				}
			}
			
		$result['success'] = 1;
		$result['blockName'] = $blockName;
	}else{
		$result['success'] = 0;
	}

	// echo json_encode($result);
	echo wp_send_json($result);
	// exit();
}

if(current_user_can("manage_options")){
	add_action( 'wp_ajax_Tp_delete_transient', 'Tp_delete_transient' );
	add_action( 'wp_ajax_nopriv_Tp_delete_transient', 'Tp_delete_transient' );
}

function Tp_socialreview_Gettoken() {
	$result = [];
	$delete_transient_nonce = isset($_POST['GetNonce']) ? $_POST['GetNonce'] : '';
	if( wp_verify_nonce($delete_transient_nonce, 'SocialReview_nonce') ) {

		$get_json = wp_remote_get("https://theplusaddons.com/wp-json/template_socialreview_api/v2/socialreviewAPI?time=".time());
		
		if ( is_wp_error( $get_json ) ) {
			wp_send_json_error( array( 'messages' => 'something wrong in API' ) );
		}else{
			$URL_StatusCode = wp_remote_retrieve_response_code($get_json);
			if($URL_StatusCode == 200){
				$getdata = wp_remote_retrieve_body($get_json);
				$result['SocialReview'] = json_decode($getdata, true);
				$result['success'] = 1;
				wp_send_json($result);
			}
		}
	}else{
		$result['success'] = 0;
	}

	exit();
}
add_action( 'wp_ajax_theplus_socialreview_Gettoken', 'Tp_socialreview_Gettoken' );
add_action( 'wp_ajax_nopriv_theplus_socialreview_Gettoken', 'Tp_socialreview_Gettoken' );


function get_current_ID($id){
	$newid = apply_filters( 'wpml_object_id', $id, 'elementor_library', TRUE );

	return $newid ? $newid : $id;
}

function plus_acf_repeater_field_ajax(){
	if(!isset($_POST['security']) || empty($_POST['security']) || ! wp_verify_nonce( $_POST['security'], 'theplus-addons' )){
		die('Invalid Nonce Security checked!');
	} 
	
	$data = [];	
	if(!empty($_POST['post_id']) && isset($_POST['post_id']) && absint($_POST['post_id'])){
	$acf_fields = get_field_objects($_POST['post_id']);
	
		if( $acf_fields ){
			foreach( $acf_fields as $field_name => $field ){
				if($field['type'] == 'repeater'){
					$data[] = [
					  'meta_id' => $field['name'],
					  'text' => $field['label']
					] ;
				}
			}
		}
	}
	wp_send_json_success($data);
}

/**
 * Create template dynamic
 *
 * @since 5.3.0
 */
function theplus_template_create() {

	/**Security checked wp nonce*/
	$nonce = ! empty( $_POST['security'] ) ? sanitize_text_field( wp_unslash( $_POST['security'] ) ) : '';
	if ( ! isset( $nonce ) || empty( $nonce ) || ! wp_verify_nonce( $nonce, 'live_editor' ) ) {
		die( 'Security checked!' );
	}

	/**Security checked user login*/
	if ( ! is_user_logged_in() ) {
		wp_send_json_error( array( 'content' => __( 'Insufficient permissions.', 'theplus' ) ) );
	}

	$uniq       = uniqid();
	$rand_num   = wp_rand( 1, 1000 );
	$post_name  = 'tp-create-template-' . sanitize_text_field( wp_unslash( $uniq ) );
	$post_title = '';
	$args       = array(
		'post_type'              => 'elementor_library',
		'post_status'            => 'publish',
		'name'                   => $post_name,
		'posts_per_page'         => 1,
		'update_post_term_cache' => false,
		'update_post_meta_cache' => false,
	);
	$post       = get_posts( $args );

	if ( empty( $post ) ) {
		$post_title = 'TP Template ' . $rand_num;

		$params = array(
			'post_content' => '',
			'post_type'    => 'elementor_library',
			'post_title'   => $post_title,
			'post_name'    => $post_name,
			'post_status'  => 'publish',
			'meta_input'   => array(
				'_elementor_edit_mode'     => 'builder',
				'_elementor_template_type' => 'page',
				'_wp_page_template'        => 'elementor_canvas',
			),
		);

		$post_id = wp_insert_post( $params );

	}

	$temp_url = get_admin_url() . '/post.php?post=' . $post_id . '&action=elementor';

	$result = array(
		'url'   => $temp_url,
		'id'    => $post_id,
		'title' => $post_title,
	);

	wp_send_json_success( $result );
}
add_action( 'wp_ajax_theplus_template_create', 'theplus_template_create' );
add_action( 'wp_ajax_nopriv_theplus_template_create', 'theplus_template_create' );

/**
 *
 * Create - Edit New Template
 *
 * @since 5.3.0
 */
function change_new_template_title() {

	/**Security checked wp nonce*/
	$nonce = ! empty( $_POST['security'] ) ? sanitize_text_field( wp_unslash( $_POST['security'] ) ) : '';
	if ( ! isset( $nonce ) || empty( $nonce ) || ! wp_verify_nonce( $nonce, 'live_editor' ) ) {
		die( 'Security checked!' );
	}

	/**Security checked user login*/
	if ( ! is_user_logged_in() ) {
		wp_send_json_error( array( 'content' => __( 'Insufficient permissions.', 'theplus' ) ) );
	}

	$id            = ! empty( $_POST['id'] ) ? sanitize_text_field( wp_unslash( $_POST['id'] ) ) : '';
	$updated_title = ! empty( $_POST['updated_title'] ) ? sanitize_text_field( wp_unslash( $_POST['updated_title'] ) ) : '';

	$res = wp_update_post(
		array(
			'ID'         => $id,
			'post_title' => $updated_title,
		)
	);

	wp_send_json_success( $res );
}
add_action( 'wp_ajax_change_new_template_title', 'change_new_template_title' );
add_action( 'wp_ajax_nopriv_change_new_template_title', 'change_new_template_title' );

/**
 *
 * Edit Template
 *
 * @since 5.3.0
 */
function change_current_template_title() {

	/**Security checked wp nonce*/
	$nonce = ! empty( $_POST['security'] ) ? sanitize_text_field( wp_unslash( $_POST['security'] ) ) : '';
	if ( ! isset( $nonce ) || empty( $nonce ) || ! wp_verify_nonce( $nonce, 'live_editor' ) ) {
		die( 'Security checked!' );
	}

	/**Security checked user login*/
	if ( ! is_user_logged_in() ) {
		wp_send_json_error( array( 'content' => __( 'Insufficient permissions.', 'theplus' ) ) );
	}

	$id            = ! empty( $_POST['id'] ) ? sanitize_text_field( wp_unslash( $_POST['id'] ) ) : '';
	$updated_title = ! empty( $_POST['updated_title'] ) ? sanitize_text_field( wp_unslash( $_POST['updated_title'] ) ) : '';

	$res = wp_update_post(
		array(
			'ID'         => $id,
			'post_title' => $updated_title,
		)
	);

	$dev = array(
		'ID'         => $id,
		'post_title' => $updated_title,
	);

	wp_send_json_success( $dev );
}
add_action( 'wp_ajax_change_current_template_title', 'change_current_template_title' );
add_action( 'wp_ajax_nopriv_change_current_template_title', 'change_current_template_title' );

if( is_admin() &&  current_user_can("manage_options") && class_exists('acf')){	
	add_action('wp_ajax_plus_acf_repeater_field','plus_acf_repeater_field_ajax');
}


function get_acf_repeater_field(){
	
	$data= [];	
	if(class_exists('acf') && isset($_GET['post']) && absint($_GET['post'])){
		$post_id = get_field('tp_preview_post',$_GET['post']);
		$acf_fields = get_field_objects($post_id);
		if( $acf_fields ){
			foreach( $acf_fields as $field_name => $field ){
				if($field['type'] == 'repeater'){
					$data[$field['name']] = $field['label'];
				}
			}
		}
	}
	return $data;
}

/**
 *
 * Ajax Pagination
 *
 * @since 5.3.0
 */
function theplus_ajax_based_pagination() {

	/**Security checked wp nonce */
	$nonce = ! empty( $_POST['nonce'] ) ? wp_unslash( $_POST['nonce'] ) : '';
	if ( ! isset( $nonce ) || empty( $nonce ) || ! wp_verify_nonce( $nonce, 'theplus-addons' ) ) {
		die( 'Security checked!' );
	}

	/**Security checked wp nonce */
	check_ajax_referer( 'theplus-addons', 'nonce' );

	$postdata = isset( $_POST['option'] ) ? wp_unslash( $_POST['option'] ) : '';
	if ( empty( $postdata ) || ! is_array( $postdata ) ) {
		ob_start();
			ob_get_contents();
		ob_end_clean();
		exit;
	}

	/** $filter_type = ( !empty($postdata['filtertype']) && 'search_list' === $postdata['filtertype'] ) ? $postdata['filtertype'] : ''; */
	$widgetname         = isset( $postdata['load'] ) ? sanitize_text_field( wp_unslash( $postdata['load'] ) ) : '';
	$post_load          = $widgetname;
	$desktop_class      = '';
	$tablet_class       = '';
	$mobile_class       = '';
	$tablet_metro_class = 0;
	$kij                = 0;
	$ji                 = 1;
	$ij                 = '';
	$offset             = 0;

	$paginationType = ! empty( $postdata['paginationType'] ) ? $postdata['paginationType'] : 'standard';

	if ( 'dynamiclisting' === $widgetname || 'products' === $widgetname ) {
		$post_type         = isset( $postdata['post_type'] ) ? sanitize_text_field( wp_unslash( $postdata['post_type'] ) ) : '';
		$layout            = isset( $postdata['layout'] ) ? sanitize_text_field( wp_unslash( $postdata['layout'] ) ) : '';
		$texonomy_category = isset( $postdata['texonomy_category'] ) ? sanitize_text_field( wp_unslash( $postdata['texonomy_category'] ) ) : '';

		$DisplayPost  = ( isset( $postdata['display_post'] ) && intval( $postdata['display_post'] ) ) ? sanitize_text_field( $postdata['display_post'] ) : 4;
		$display_post = $DisplayPost;       // Not used

		$post_load_more = ( isset( $postdata['post_load_more'] ) && intval( $postdata['post_load_more'] ) ) ? wp_unslash( $postdata['post_load_more'] ) : 1;
		$post_title_tag = isset( $postdata['post_title_tag'] ) ? wp_unslash( $postdata['post_title_tag'] ) : '';

		$style                     = isset( $postdata['style'] ) ? sanitize_text_field( wp_unslash( $postdata['style'] ) ) : 'style-1';
		$desktop_column            = ( isset( $postdata['desktop-column'] ) && intval( $postdata['desktop-column'] ) ) ? wp_unslash( $postdata['desktop-column'] ) : 3;
		$tablet_column             = ( isset( $postdata['tablet-column'] ) && intval( $postdata['tablet-column'] ) ) ? wp_unslash( $postdata['tablet-column'] ) : 4;
		$mobile_column             = ( isset( $postdata['mobile-column'] ) && intval( $postdata['mobile-column'] ) ) ? wp_unslash( $postdata['mobile-column'] ) : 6;
		$metro_column              = isset( $postdata['metro_column'] ) ? wp_unslash( $postdata['metro_column'] ) : '';
		$metro_style               = isset( $postdata['metro_style'] ) ? wp_unslash( $postdata['metro_style'] ) : '';
		$responsive_tablet_metro   = isset( $postdata['responsive_tablet_metro'] ) ? wp_unslash( $postdata['responsive_tablet_metro'] ) : '';
		$tablet_metro_column       = isset( $postdata['tablet_metro_column'] ) ? wp_unslash( $postdata['tablet_metro_column'] ) : '';
		$tablet_metro_style        = isset( $postdata['tablet_metro_style'] ) ? wp_unslash( $postdata['tablet_metro_style'] ) : '';
		$category_type             = isset( $postdata['category_type'] ) ? $postdata['category_type'] : 'false';
		$category                  = isset( $postdata['category'] ) ? wp_unslash( $postdata['category'] ) : '';
		$order_by                  = isset( $postdata['order_by'] ) ? sanitize_text_field( wp_unslash( $postdata['order_by'] ) ) : '';
		$post_order                = isset( $postdata['post_order'] ) ? sanitize_text_field( wp_unslash( $postdata['post_order'] ) ) : '';
		$filter_category           = isset( $postdata['filter_category'] ) ? sanitize_text_field( wp_unslash( $postdata['filter_category'] ) ) : '';
		$animated_columns          = isset( $postdata['animated_columns'] ) ? sanitize_text_field( wp_unslash( $postdata['animated_columns'] ) ) : '';
		$featured_image_type       = isset( $postdata['featured_image_type'] ) ? wp_unslash( $postdata['featured_image_type'] ) : '';
		$display_thumbnail         = isset( $postdata['display_thumbnail'] ) ? wp_unslash( $postdata['display_thumbnail'] ) : '';
		$thumbnail                 = isset( $postdata['thumbnail'] ) ? wp_unslash( $postdata['thumbnail'] ) : '';
		$thumbnail_car             = isset( $postdata['thumbnail_car'] ) ? wp_unslash( $postdata['thumbnail_car'] ) : '';
		$display_theplus_quickview = isset( $postdata['display_theplus_quickview'] ) ? wp_unslash( $postdata['display_theplus_quickview'] ) : '';
		$includePosts              = ( isset( $postdata['include_posts'] ) && intval( $postdata['include_posts'] ) ) ? wp_unslash( $postdata['include_posts'] ) : '';
		$excludePosts              = ( isset( $postdata['exclude_posts'] ) && intval( $postdata['exclude_posts'] ) ) ? wp_unslash( $postdata['exclude_posts'] ) : '';

		$dynamic_template = isset( $postdata['skin_template'] ) ? $postdata['skin_template'] : '';
		$paged            = ( isset( $postdata['page'] ) && intval( $postdata['page'] ) ) ? wp_unslash( $postdata['page'] ) : ''; // Not used

		$is_archivePage  = isset( $postdata['is_archive'] ) ? $postdata['is_archive'] : 0;
		$Archivepage     = isset( $postdata['archive_page'] ) ? $postdata['archive_page'] : '';
		$ArchivepageType = ( ! empty( $Archivepage ) && ! empty( $Archivepage['archive_Type'] ) ) ? sanitize_text_field( $Archivepage['archive_Type'] ) : '';
		$ArchivepageID   = ( ! empty( $Archivepage ) && ! empty( $Archivepage['archive_Id'] ) ) ? $Archivepage['archive_Id'] : '';
		$ArchivepageName = ( ! empty( $Archivepage ) && ! empty( $Archivepage['archive_Name'] ) ) ? $Archivepage['archive_Name'] : '';

		$is_searchPage = isset( $postdata['is_search'] ) ? $postdata['is_search'] : 0;
		$SearchPage    = isset( $postdata['is_search_page'] ) ? $postdata['is_search_page'] : '';
		$SearchPageval = ( ! empty( $SearchPage ) && ! empty( $SearchPage['is_search_value'] ) ) ? sanitize_text_field( $SearchPage['is_search_value'] ) : '';
		$CustonQuery   = ! empty( $postdata['custon_query'] ) ? $postdata['custon_query'] : '';
		$author_prefix = isset( $load_attr["author_prefix"] ) ? wp_unslash($load_attr["author_prefix"]) : '';

		$enable_archive_search = ! empty( $postdata['enable_archive_search'] ) ? 'true' : 'false';
		$listing_type          = isset( $postdata['listing_type'] ) ? $postdata['listing_type'] : '';


		if ( 'carousel' !== $layout && 'metro' !== $layout ) {
			$desktop_class = 'tp-col-lg-' . esc_attr( $desktop_column );
			$tablet_class  = 'tp-col-md-' . esc_attr( $tablet_column );
			$mobile_class  = 'tp-col-sm-' . esc_attr( $mobile_column );
			$mobile_class .= ' tp-col-' . esc_attr( $mobile_column );
		}
	}

	if ( 'dynamiclisting' === $widgetname ) {
		$title_desc_word_break        = isset( $postdata['title_desc_word_break'] ) ? wp_unslash( $postdata['title_desc_word_break'] ) : '';
		$style_layout                 = isset( $postdata['style_layout'] ) ? sanitize_text_field( wp_unslash( $postdata['style_layout'] ) ) : '';
		$post_tags                    = isset( $postdata['post_tags'] ) ? wp_unslash( $postdata['post_tags'] ) : '';
		$post_authors                 = isset( $postdata['post_authors'] ) ? wp_unslash( $postdata['post_authors'] ) : '';
		$display_post_meta            = isset( $postdata['display_post_meta'] ) ? sanitize_text_field( wp_unslash( $postdata['display_post_meta'] ) ) : '';
		$post_meta_tag_style          = isset( $postdata['post_meta_tag_style'] ) ? wp_unslash( $postdata['post_meta_tag_style'] ) : '';
		$display_post_meta_date       = isset( $postdata['display_post_meta_date'] ) ? wp_unslash( $postdata['display_post_meta_date'] ) : '';
		$display_post_meta_author     = isset( $postdata['display_post_meta_author'] ) ? wp_unslash( $postdata['display_post_meta_author'] ) : '';
		$display_post_meta_author_pic = isset( $postdata['display_post_meta_author_pic'] ) ? wp_unslash( $postdata['display_post_meta_author_pic'] ) : '';
		$display_excerpt              = isset( $postdata['display_excerpt'] ) ? sanitize_text_field( wp_unslash( $postdata['display_excerpt'] ) ) : '';
		$post_excerpt_count           = isset( $postdata['post_excerpt_count'] ) ? wp_unslash( $postdata['post_excerpt_count'] ) : '';
		$display_post_category        = isset( $postdata['display_post_category'] ) ? wp_unslash( $postdata['display_post_category'] ) : '';
		$dpc_all                      = isset( $postdata['dpc_all'] ) ? wp_unslash( $postdata['dpc_all'] ) : '';
		$post_category_style          = isset( $postdata['post_category_style'] ) ? sanitize_text_field( wp_unslash( $postdata['post_category_style'] ) ) : '';
		$display_title_limit          = isset( $postdata['display_title_limit'] ) ? wp_unslash( $postdata['display_title_limit'] ) : '';
		$display_title_by             = isset( $postdata['display_title_by'] ) ? wp_unslash( $postdata['display_title_by'] ) : '';
		$display_title_input          = isset( $postdata['display_title_input'] ) ? wp_unslash( $postdata['display_title_input'] ) : '';
		$display_title_3_dots         = isset( $postdata['display_title_3_dots'] ) ? wp_unslash( $postdata['display_title_3_dots'] ) : '';
		$feature_image                = isset( $postdata['feature_image'] ) ? wp_unslash( $postdata['feature_image'] ) : '';
		$full_image_size              = ! empty( $postdata['full_image_size'] ) ? $postdata['full_image_size'] : 'yes';

		$texo_category        = ! empty( $postdata['texo_category'] ) ? $postdata['texo_category'] : '';
		$texo_post_tag        = ! empty( $postdata['texo_post_tag'] ) ? $postdata['texo_post_tag'] : '';
		$texo_post_taxonomies = ! empty( $postdata['texo_post_taxonomies'] ) ? $postdata['texo_post_taxonomies'] : '';
		$texo_include_slug    = ! empty( $postdata['texo_include_slug'] ) ? $postdata['texo_include_slug'] : '';
		$author_prefix        = isset($postdata["author_prefix"]) ? wp_unslash($postdata["author_prefix"]) : 'By';

	} elseif ( 'products' === $widgetname ) {
		$b_dis_badge_switch     = isset( $postdata['badge'] ) ? sanitize_text_field( wp_unslash( $postdata['badge'] ) ) : '';
		$out_of_stock           = isset( $postdata['out_of_stock'] ) ? sanitize_text_field( wp_unslash( $postdata['out_of_stock'] ) ) : '';
		$variation_price_on     = isset( $postdata['variationprice'] ) ? sanitize_text_field( wp_unslash( $postdata['variationprice'] ) ) : '';
		$hover_image_on_off     = isset( $postdata['hoverimagepro'] ) ? sanitize_text_field( wp_unslash( $postdata['hoverimagepro'] ) ) : '';
		$display_product        = isset( $postdata['display_product'] ) ? wp_unslash( $postdata['display_product'] ) : '';
		$display_rating         = isset( $postdata['display_rating'] ) ? wp_unslash( $postdata['display_rating'] ) : '';
		$display_catagory       = isset( $postdata['display_catagory'] ) ? wp_unslash( $postdata['display_catagory'] ) : '';
		$display_yith_list      = isset( $postdata['display_yith_list'] ) ? wp_unslash( $postdata['display_yith_list'] ) : '';
		$display_yith_compare   = isset( $postdata['display_yith_compare'] ) ? wp_unslash( $postdata['display_yith_compare'] ) : '';
		$display_yith_wishlist  = isset( $postdata['display_yith_wishlist'] ) ? wp_unslash( $postdata['display_yith_wishlist'] ) : '';
		$display_yith_quickview = isset( $postdata['display_yith_quickview'] ) ? wp_unslash( $postdata['display_yith_quickview'] ) : '';
		$display_cart_button    = isset( $postdata['cart_button'] ) ? wp_unslash( $postdata['cart_button'] ) : '';
		$dcb_single_product     = isset( $postdata['dcb_single_product'] ) ? wp_unslash( $postdata['dcb_single_product'] ) : '';
		$dcb_variation_product  = isset( $postdata['dcb_variation_product'] ) ? wp_unslash( $postdata['dcb_variation_product'] ) : '';
	}

	$Paginate_sf = ! empty( $postdata['Paginate_sf'] ) ? $postdata['Paginate_sf'] : 0;
	$new_offset  = ! empty( $postdata['new_offset'] ) ? $postdata['new_offset'] : 0;
	$offset      = (int) $new_offset;

	if ( ! empty( $CustonQuery ) ) {
		$args = array();
		if ( has_filter( $CustonQuery ) ) {
			$args = apply_filters( $CustonQuery, $args );
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

	/**Display Product Option ListingWidget*/
	if ( 'products' === $widgetname ) {

		if ( ! empty( $texonomy_category ) && ! empty( $category ) && empty( $is_archivePage ) ) {
			$attr_tax[] = array(
				'taxonomy' => $texonomy_category,
				'field'    => 'slug',
				'terms'    => explode( ',', $category ),
			);
		}

		if ( 'all' !== $display_product ) {
			$wooProductType = theplus_woo_product_type( $display_product );

			if ( ! empty( $wooProductType ) ) {
				if ( 'featured' === $display_product ) {
					$attr_tax[] = $wooProductType;
				}

				if ( 'featured' !== $display_product ) {
					$meta_keyArr[] = $wooProductType;
				}
			}
		}

		if ( 'all' === $display_product ) {
			$attr_tax[] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => array( 'exclude-from-search', 'exclude-from-catalog' ),
				'operator' => 'NOT IN',
			);
		}
	}

	if ( 'dynamiclisting' === $widgetname && empty( $is_archivePage ) ) {
		if ( 'post' === $post_type ) {
			if ( ! empty( $texo_category ) ) {
				$attr_tax[] = array(
					'taxonomy' => $texo_category,
					'field'    => 'id',
					'terms'    => explode( ',', $category ),
				);
			}

			if ( ! empty( $texo_post_tag ) ) {
				$attr_tax[] = array(
					'taxonomy' => $texo_post_tag,
					'field'    => 'id',
					'terms'    => explode( ',', $post_tags ),
				);
			}
		} elseif ( ! empty( $texo_include_slug ) && ! empty( $texo_post_taxonomies ) ) {
				$attr_tax[] = array(
					'taxonomy' => $texo_post_taxonomies,
					'field'    => 'slug',
					'terms'    => explode( ',', $texo_include_slug ),
				);
		}
	}

	/**Archive Page*/
	if ( ('products' === $widgetname && ! empty( $is_archivePage ) && $ArchivepageType && $ArchivepageID) && ( 'archive_listing' === $listing_type || 'search_list' === $listing_type ) ) {
		$attr_tax[] = array(
			'taxonomy' => $ArchivepageType,
			'field'    => 'id',
			'terms'    => $ArchivepageID,
		);
	} elseif ( ('dynamiclisting' === $widgetname && ! empty( $is_archivePage )) && ('archive_listing' === $listing_type || 'search_list' === $listing_type) ) {
		if ( 'post' === $post_type ) {
			$attr_tax[] = array(
				'taxonomy' => $ArchivepageName,
				'field'    => 'id',
				'terms'    => $ArchivepageID,
			);
		} else {
			$attr_tax[] = array(
				'taxonomy' => $texo_post_taxonomies,
				'field'    => 'slug',
				'terms'    => $category,
			);
		}
	}

	/**Search Page*/
	if ( ! empty( $is_searchPage ) ) {
		$args['s']     = $SearchPageval;
		$args['exact'] = false;
	}

	if ( ! empty( $excludePosts ) ) {
		$args['post__not_in'] = explode( ',', $excludePosts );
	}

	if ( ! empty( $includePosts ) ) {
		$args['post__in'] = explode( ',', $includePosts );
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

	$totalcount = '';
	ob_start();
		$loop       = new WP_Query( $args );
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

			if ( 'products' === $widgetname && 'product' === $post_type ) {
				include THEPLUS_WSTYLES . 'ajax-load-post/product-style.php';
			} elseif ( 'dynamiclisting' === $widgetname ) {
				include THEPLUS_WSTYLES . 'ajax-load-post/dynamic-listing-style.php';
			}

			++$ji;
			++$kij;
		}
	}
	$Alldata = ob_get_contents();
	ob_end_clean();

	if ( ! empty( $Alldata ) ) {
		$result['HtmlData']    = $Alldata;
		$result['totalrecord'] = $totalcount;
		$result['widgetName']  = $widgetname;
	}

	wp_send_json( $result );
}
add_action( 'wp_ajax_theplus_ajax_based_pagination', 'theplus_ajax_based_pagination' );
add_action( 'wp_ajax_nopriv_theplus_ajax_based_pagination', 'theplus_ajax_based_pagination' );

/*Wp login ajax*/
function theplus_ajax_login() {
	
	if( (!isset( $_POST['security'] ) || !wp_verify_nonce( $_POST['security'], 'ajax-login-nonce' ) )  ){		
		echo wp_json_encode( ['registered'=>false, 'message'=> esc_html__( 'Ooops, something went wrong, please try again later.', 'theplus' )] );
		exit;
	}
	
	$access_info = [];		
	$access_info['user_login']    = !empty($_POST['username']) ? sanitize_user($_POST['username']) : "";
	$access_info['user_password'] = !empty($_POST['password']) ? $_POST['password'] : "";
	$access_info['rememberme']    = true;
	
	$user_signon = wp_signon( $access_info );
	
	if ( !is_wp_error($user_signon) ){
		
		$userID = $user_signon->ID;
		wp_set_current_user( $userID, $access_info['user_login'] );
		wp_set_auth_cookie( $userID, true, true );
		
		echo wp_json_encode( ['loggedin' => true, 'message'=> esc_html__('Login successful, Redirecting...', 'theplus')] );
		
	} else {
		if ( isset( $user_signon->errors['invalid_email'][0] ) ) {
			
			echo wp_json_encode( ['loggedin' => false, 'message'=> esc_html__('Ops! Invalid Email..!', 'theplus')] );
		} elseif ( isset( $user_signon->errors['invalid_username'][0] ) ) {

			echo wp_json_encode( ['loggedin' => false, 'message'=> esc_html__('Ops! Invalid Username..!', 'theplus')] );
		} elseif ( isset( $user_signon->errors['incorrect_password'][0] ) ) {
			
			echo wp_json_encode( ['loggedin' => false, 'message'=> esc_html__('Ops! Incorrent Password..!', 'theplus')] );
		}
	}
	die();
}
add_action( 'wp_ajax_nopriv_theplus_ajax_login', 'theplus_ajax_login' );
/*Wp login ajax*/

/* login social application facebook/google */
function tp_login_social_app( $name, $email, $type = ''){
	$response	= [];
	$user_data	= get_user_by( 'email', $email ); 

	if ( ! empty( $user_data ) && $user_data !== false ) {
		$user_ID = $user_data->ID;
		wp_set_auth_cookie( $user_ID );
		wp_set_current_user( $user_ID, $name );
		do_action( 'wp_login', $user_data->user_login, $user_data );
		echo wp_json_encode( ['loggedin' => true, 'message'=> esc_html__('Login successful, Redirecting...', 'theplus')] );
	} else {
		
		$password = wp_generate_password( 12, true, false );
		
		$args = [
			'user_login' => $name,
			'user_pass'  => $password,
			'user_email' => $email,
			'first_name' => $name,
		];
		
		if ( username_exists( $name ) ) {
			$suffix_id = '-' . zeroise( wp_rand( 0, 9999 ), 4 );
			$name  .= $suffix_id;

			$args['user_login'] = strtolower( preg_replace( '/\s+/', '', $name ) );
		}

		$result = wp_insert_user( $args );

		$user_data = get_user_by( 'email', $email );

		if ( $user_data ) {
			$user_ID    = $user_data->ID;
			$user_email = $user_data->user_email;

			$user_meta = array(
				'login_source' => $type,
			);

			update_user_meta( $user_ID, 'theplus_login_form', $user_meta );
						
			if ( wp_check_password( $password, $user_data->user_pass, $user_data->ID ) ) {
				wp_set_auth_cookie( $user_ID );
				wp_set_current_user( $user_ID, $name );
				do_action( 'wp_login', $user_data->user_login, $user_data );
				echo wp_json_encode( ['loggedin' => true, 'message'=> esc_html__('Login successful, Redirecting...', 'theplus')] );
			}
		}
	}
	
	die();
}
/* login social application facebook/google */

/*facebook verify data*/
function tp_facebook_verify_data_user( $fb_token, $fb_id, $fb_secret ) {
	$fb_api = 'https://graph.facebook.com/oauth/access_token';
	$fb_api = add_query_arg( [
		'client_id'     => $fb_id,
		'client_secret' => $fb_secret,
		'grant_type'    => 'client_credentials',
	], $fb_api );

	$fb_res = wp_remote_get( $fb_api );

	if ( is_wp_error( $fb_res ) ) {
		wp_send_json_error();
	}

	$fb_response = json_decode( wp_remote_retrieve_body( $fb_res ), true );

	$app_token = $fb_response['access_token'];

	$debug_token = 'https://graph.facebook.com/debug_token';
	$debug_token = add_query_arg( [
		'input_token'  => $fb_token,
		'access_token' => $app_token,
	], $debug_token );

	$response = wp_remote_get( $debug_token );

	if ( is_wp_error( $response ) ) {
		return false;
	}

	return json_decode( wp_remote_retrieve_body( $response ), true );
}

function tp_facebook_get_user_email( $user_id, $access_token ){
	$fb_url = 'https://graph.facebook.com/' . $user_id;
	$fb_url = add_query_arg( [
		'fields'       => 'email',
		'access_token' => $access_token,
	], $fb_url );

	$response = wp_remote_get( $fb_url );

	if ( is_wp_error( $response ) ) {
		return false;
	}

	return json_decode( wp_remote_retrieve_body( $response ), true );
}
/*facebook verify data*/

/*Wp facebook social login ajax*/
function theplus_ajax_facebook_login() {
	
	if(!get_option('users_can_register')){
		echo wp_json_encode( ['registered'=>false, 'message'=> esc_html__( 'Registration option not enbled in your general settings.', 'theplus' )] );
		die();
	}
	
	if( (!isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'ajax-login-nonce' ) )  ){		
		echo wp_json_encode( ['registered'=>false, 'message'=> esc_html__( 'Ooops, something went wrong, please try again later.', 'theplus' )] );
		die();
	}
	
	$access_token = (!empty( $_POST['accessToken'] )) ? sanitize_text_field( $_POST['accessToken'] ) : '';
	$user_id = (!empty( $_POST['id'] )) ? sanitize_text_field( $_POST['id'] ) : 0;
	$email	=	(isset($_POST['email'])) ? sanitize_email($_POST['email']) : '';
	$name	=	(isset($_POST['name'])) ? sanitize_user( $_POST['name'] ) : '';
	
	$fb_data= get_option( 'theplus_api_connection_data' );
	$fb_app_id = (!empty($fb_data['theplus_facebook_app_id'])) ? $fb_data['theplus_facebook_app_id'] : '';
	$fb_secret_id = (!empty($fb_data['theplus_facebook_app_secret'])) ? $fb_data['theplus_facebook_app_secret'] : '';
				
	$verify_data = tp_facebook_verify_data_user( $access_token, $fb_app_id, $fb_secret_id );
	
	if ( empty( $user_id ) || ( $user_id !== $verify_data['data']['user_id'] ) || empty( $verify_data ) || empty( $fb_app_id ) || empty( $fb_secret_id ) || ( $fb_app_id !== $verify_data['data']['app_id'] ) || ( ! $verify_data['data']['is_valid'] ) ) {
		echo wp_json_encode( ['loggedin' => false, 'message'=> esc_html__('Invalid Authorization', 'theplus')] );
		die();
	}
	
	$email_res = tp_facebook_get_user_email( $verify_data['data']['user_id'], $access_token );
	
	if ( !empty( $email ) && ( empty( $email_res['email'] ) || $email_res['email'] !== $email ) ) {
		echo wp_json_encode( ['loggedin' => false, 'message'=> esc_html__('Facebook email validation failed', 'theplus')] );
		die();
	}

	$verify_email = !empty( $email ) && !empty( $email_res['email'] ) ? sanitize_email( $email_res['email'] ) : $verify_data['user_id'] . '@facebook.com';
	
	tp_login_social_app( $name, $verify_email, 'facebook' );
	
	die();
}

add_action( 'wp_ajax_nopriv_theplus_ajax_facebook_login', 'theplus_ajax_facebook_login' );
/*Wp facebook social login ajax*/

/*Forgot Password*/
function theplus_ajax_forgot_password_ajax() {
	global $wpdb, $wp_hasher;
	$tpforgotdata = isset($_POST['tpforgotdata']) ? $_POST['tpforgotdata'] : '';
	
	$forgotdata = tp_check_decrypt_key($tpforgotdata);
	$forgotdata = json_decode($forgotdata,true);
	
	$nonce = isset($forgotdata['noncesecure']) ? $forgotdata['noncesecure'] : '';
	
	if ( ! wp_verify_nonce( $nonce, 'tp_user_lost_password_action' ) ){
		die ( 'Security checked!');
	}        
		
	$user_login = isset($_POST['user_login']) ? wp_unslash($_POST['user_login']) : '';
	
	$errors = new WP_Error();
 
    if ( empty( $user_login ) || ! is_string( $user_login ) ) {        
		echo wp_json_encode( [ 'lost_pass'=>'empty_username', 'message'=> sprintf(__( '<strong>ERROR</strong>: Enter a username or email address.','theplus' )) ] );
		exit;
    } elseif ( strpos( $user_login, '@' ) ) {
        $user_data = get_user_by( 'email', trim( wp_unslash( $user_login ) ) );
        if ( empty( $user_data ) ) {          
			echo wp_json_encode( [ 'lost_pass'=>'invalid_email', 'message'=> sprintf(__( '<strong>ERROR</strong>: There is no account with that username or email address.','theplus' )) ] );
			exit;
        }
    } else {
        $login     = trim( $user_login );
        $user_data = get_user_by( 'login', $login );
		if ( ! $user_data ) {			
			echo wp_json_encode( [ 'lost_pass'=>'invalidcombo', 'message'=> sprintf(__( '<strong>ERROR</strong>: There is no account with that username or email address.','theplus' )) ] );
			exit;
		}
    }
 
    do_action( 'lostpassword_post', $errors );

    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    $key        = get_password_reset_key( $user_data );

    if ( is_wp_error( $key ) ) {
		return $key;
    }

    if ( is_multisite() ) {
		$site_name = get_network()->site_name;
    } else {
		$site_name = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
	}
	
	$reset_url = isset($forgotdata['reset_url']) ? $forgotdata['reset_url'] : '';
	$forgot_url = isset($forgotdata['forgot_url']) ? $forgotdata['forgot_url'] : '';
	
	//$forgotdatatceol = json_decode($forgotdata['tceol']);
	
	/*forgot password mail*/
	$message='';
	if(!empty($forgotdata['tceol']) && (!empty($forgotdata['tceol']['tp_cst_email_lost_opt']) && $forgotdata['tceol']['tp_cst_email_lost_opt']=='yes')){
					
		$elsub =  html_entity_decode($forgotdata['tceol']['tp_cst_email_lost_subject']);
		$elmsg =  html_entity_decode($forgotdata['tceol']['tp_cst_email_lost_message']);
		
		if(!empty($forgotdata["f_p_opt"]) && $forgotdata["f_p_opt"]=='default'){		
			$tplr_link_get = network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' );		
		}else if(!empty($forgotdata["f_p_opt"]) && $forgotdata["f_p_opt"]=='f_p_frontend'){
			$data_fp_frontdata = [];
			$data_fp_frontdata['key'] = $key;
			$data_fp_frontdata['redirecturl'] = $reset_url;
			$data_fp_frontdata['forgoturl'] = $forgot_url;
			$data_fp_frontdata['login'] = rawurlencode( $user_login );
			
			$frontdata_key= tp_plus_simple_decrypt( json_encode($data_fp_frontdata), 'ey' );
			
			$tplr_link_get = network_site_url( "wp-login.php?action=theplusrpf&datakey=$frontdata_key", 'login' );
		}
		
		$elfind = array( '/\[tplr_sitename\]/', '/\[tplr_username\]/', '/\[tplr_link\]/' );
		$lrreplacement = array( $site_name,$user_login,$tplr_link_get);		
		$clrmessage = preg_replace( $elfind,$lrreplacement,$elmsg );
		
		$lrheaders = array( 'Content-Type: text/html; charset=UTF-8' );
		 
		wp_mail( $user_email, $elsub, $clrmessage, $lrheaders );
		
	}else{ 
		$message = esc_html__( 'Someone has requested a password reset for the following account:','theplus' ) . "\r\n\r\n";

		$message .= sprintf( esc_html__( 'Site Name: %s','theplus' ), $site_name ) . "\r\n\r\n";

		$message .= sprintf( esc_html__( 'Username: %s','theplus' ), $user_login ) . "\r\n\r\n";
		$message .= esc_html__( 'If this was a mistake, just ignore this email and nothing will happen.','theplus' ) . "\r\n\r\n";
		$message .= esc_html__( 'To reset your password, visit the following address:','theplus' ) . "\r\n\r\n";
		
		if(!empty($forgotdata["f_p_opt"]) && $forgotdata["f_p_opt"]=='default'){		
			$message .= '<' . network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . ">\r\n";		
		}else if(!empty($forgotdata["f_p_opt"]) && $forgotdata["f_p_opt"]=='f_p_frontend'){
			$data_fp_frontdata = [];
			$data_fp_frontdata['key'] = $key;
			$data_fp_frontdata['redirecturl'] = $reset_url;
			$data_fp_frontdata['forgoturl'] = $forgot_url;
			$data_fp_frontdata['login'] = rawurlencode( $user_login );
			
			$frontdata_key= tp_plus_simple_decrypt( json_encode($data_fp_frontdata), 'ey' );
			$message .= '<' . network_site_url( "wp-login.php?action=theplusrpf&datakey=$frontdata_key", 'login' ) . ">\r\n";
		}
	}
	

	$title = sprintf( esc_html__( '[%s] Password Reset','theplus' ), $site_name );

	$title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );

	$message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );
	
	$fp_correct_email_text = !empty($forgotdata['fp_correct_email']) ? $forgotdata['fp_correct_email'] : 'Check your e-mail for the reset password link.';
	
	if(!empty($forgotdata['tceol']) && (!empty($forgotdata['tceol']['tp_cst_email_lost_opt']) && $forgotdata['tceol']['tp_cst_email_lost_opt']=='yes')){		
		echo wp_json_encode( [ 'lost_pass'=>'confirm', 'message'=> $fp_correct_email_text ] );
	}else{
		if ( wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) )
		echo wp_json_encode( [ 'lost_pass'=>'confirm', 'message'=> $fp_correct_email_text ] );
	else
		echo wp_json_encode( [ 'lost_pass'=>'could_not_sent', 'message'=> esc_html__('The e-mail could not be sent.','theplus') . "<br />\n" . esc_html__('Possible reason: your host may have disabled the mail() function.','theplus') ] );
	}	

	exit;
}
add_action( 'wp_ajax_nopriv_theplus_ajax_forgot_password', 'theplus_ajax_forgot_password_ajax' );
add_action( 'wp_ajax_theplus_ajax_forgot_password', 'theplus_ajax_forgot_password_ajax' );
/*Forgot Password*/

/*ENCRYPT DECRIPT*/
function tp_check_decrypt_key($key){   	 
	$decrypted = tp_plus_simple_decrypt( $key, 'dy' );
	return $decrypted;
}
function tp_plus_simple_decrypt( $string, $action = 'dy' ) {
	// you may change these values to your own
	$tppk=get_option( 'theplus_purchase_code' );
	$generated = !empty(get_option( 'tp_key_random_generate' )) ? get_option( 'tp_key_random_generate' ) : 'PO$_key';
	
	$secret_key = ( isset($tppk['tp_api_key']) && !empty($tppk['tp_api_key']) ) ? $tppk['tp_api_key'] : $generated;
	$secret_iv = 'PO$_iv';

	$output = false;
	$encrypt_method = "AES-128-CBC";
	$key = hash( 'sha256', $secret_key );
	$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

	if( $action == 'ey' ) {
		$output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	}
	else if( $action == 'dy' ){
		$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	}

	return $output;
}

/*reset password start*/
add_action( 'wp_ajax_nopriv_theplus_ajax_reset_password', 'theplus_ajax_reset_password_ajax' );
add_action( 'wp_ajax_theplus_ajax_reset_password', 'theplus_ajax_reset_password_ajax' );
function theplus_ajax_reset_password_ajax() {
	$tpresetdata = isset($_POST['tpresetdata']) ? $_POST['tpresetdata'] : '';
	
	$resetdata = tp_check_decrypt_key($tpresetdata);
	$resetdata = json_decode($resetdata,true);
	$user_login = isset($resetdata['login']) ? $resetdata['login'] : '';	
	$user_login = urldecode($user_login);
    $user_key = isset($resetdata['key']) ? $resetdata['key'] : '';
	$nonce = isset($resetdata['noncesecure']) ? $resetdata['noncesecure'] : '';
	
	if ( ! wp_verify_nonce( $nonce, 'tp_reset_action' ) ){
		die ( 'Security checked!');
	}
	
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
        $user = check_password_reset_key( $user_key, $user_login );
 
        if ( ! $user || is_wp_error( $user ) ) {
            if ( $user && $user->get_error_code() === 'expired_key' ) {
			   echo wp_json_encode( [ 'reset_pass'=>'expire', 'message'=> esc_html__('The entered key has expired. Please start reset process again.','theplus') ] );
            } else {
				echo wp_json_encode( [ 'reset_pass'=>'invalid', 'message'=> esc_html__('The entered key is invalid. Please start reset process again.','theplus') ] );
            }
            exit;
        }
 
        if ( isset( $_POST['user_pass'] ) ) {
            if ( $_POST['user_pass'] != $_POST['user_pass_conf'] ) {                
				echo wp_json_encode( [ 'reset_pass'=>'mismatch', 'message'=> esc_html__('Password does not match. Please try again.','theplus') ] );
				exit;
            }
 
            if ( empty( $_POST['user_pass'] ) ) {                
                echo wp_json_encode( [ 'reset_pass'=>'empty', 'message'=> esc_html__('Password Field is Empty. Enter Password.','theplus') ] );                
                exit;
            }
			
            reset_password( $user, $_POST['user_pass'] );
			
           echo wp_json_encode( [ 'reset_pass'=>'success', 'message'=> esc_html__('Your password has been changed. Use your new password to sign in.','theplus') ] );
		   
        } else {
            echo "Invalid request.";
        }
 
        exit;
    }
}

add_action( 'login_form_theplusrp','redirect_to_tp_custom_password_reset');
if(!empty($_GET['action']) && $_GET['action']=='theplusrpf'){
	add_action( 'login_form_resetpass','redirect_to_tp_custom_password_reset' );	
}

function redirect_to_tp_custom_password_reset() {
	
    if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
        // Verify key / login combo
		
		if(!empty($_GET['action']) && $_GET['action']=='theplusrpf'){
			$datakey = isset($_GET['datakey']) ? $_GET['datakey'] : '';
			$forgotdata = tp_check_decrypt_key($datakey);
			$forgotdata = json_decode(stripslashes($forgotdata),true);
			$user = check_password_reset_key( $forgotdata['key'], rawurldecode($forgotdata['login']) );
			$forgoturl = $forgotdata['forgoturl'];
			$redirecturl = $forgotdata['redirecturl'];
			$login = $forgotdata['login'];
			$key = $forgotdata['key'];
		}else{
			$forgoturl = isset($_GET['forgoturl']) ? wp_http_validate_url($_GET['forgoturl']) : '';
			$redirecturl ='';
			$login = isset($_GET['login']) ? $_GET['login'] : '';
			$key = isset($_GET['key']) ? $_GET['key'] : '';
			
			$user = check_password_reset_key( $key, $login );			
		}
        	
        if ( ! $user || is_wp_error( $user ) ) {
			
            if ( $user && $user->get_error_code() === 'expired_key' ) {
				$redirect_url = $forgoturl;
				$redirect_url = add_query_arg( 'expired', 'expired', $redirect_url );
				wp_safe_redirect($redirect_url);
            } else {
				$redirect_url = $forgoturl;
				$redirect_url = add_query_arg( 'invalid', 'invalid', $redirect_url );
				wp_safe_redirect($redirect_url);
            }
            exit;
        }
		if(!empty($redirecturl)){	
			$data_res = [];
			$data_res['login'] =  $login;
			$data_res['forgoturl'] = $forgoturl;
			$data_res['key'] = $key;
			
			$data_reskey= tp_plus_simple_decrypt( json_encode($data_res), 'ey' );
			
			$redirect_url = $redirecturl;
			$redirect_url = add_query_arg( 'action', 'theplusrpf', $redirect_url );
			$redirect_url = add_query_arg( 'datakey', $data_reskey, $redirect_url );
			wp_safe_redirect($redirect_url);
		}else{
			wp_safe_redirect(home_url());
		}
        exit;
    }
}
/*reset password end*/

function theplus_ajax_register_user( $email='', $first_name='', $last_name='',$tp_user_role='' ) {
	    $errors = new \WP_Error();
		$result    = '';
	    if ( ! is_email( $email ) ) {
	        $errors->add( 'email', esc_html__( 'The email address you entered is not valid.', 'theplus' ) );
	        return $errors;
	    }
	 
	    if ( username_exists( $email ) || email_exists( $email ) ) {
	        $errors->add( 'email_exists', esc_html__( 'An account exists with this email address.', 'theplus' ) );
	        return $errors;
	    }
		
	    if(!empty($_POST["dis_password"]) && $_POST["dis_password"]=='yes'){
			if(!empty($_POST["dis_password_conf"]) && $_POST["dis_password_conf"]!='yes' && $_POST['password']){
				$password = $_POST['password'];
			}else{
				if($_POST['password'] == $_POST['conf_password']){	
					$password = $_POST['password'];
				}else{
					$errors->add( 'pass_mismatch', esc_html__( 'Password & Confirm Password Not Match!', 'theplus' ) );
					return $errors;
				}
			}			
		}else{
			$password = wp_generate_password( 12, false );
		}
		
		if(!empty($_POST["user_login"])){
			$user_login = !empty($_POST['user_login']) ? sanitize_user($_POST['user_login']) : '';
		}else{
			$user_login = $email;
		}
		
	    $user_data = array(
	        'user_login'    => $user_login,
	        'user_email'    => $email,
	        'user_pass'     => $password,
	        'first_name'    => $first_name,
	        'last_name'     => $last_name,
	        'nickname'      => $first_name,
	    );
		$user_id_get = username_exists( $user_login );
		
		$user_id='';
		if ( ! $user_id_get ) {
			$user_id = wp_insert_user( $user_data );
			if(empty($_POST['tceo'])){
				if(!empty($_POST["dis_password"]) && $_POST["dis_password"]=='no'){
					wp_new_user_notification( $user_id, null, 'both' );
				}else{
					wp_new_user_notification( $user_id, null, 'both' );
				}
			}			
			
			wp_update_user( array ('ID' => $user_id) ) ;
		}
		
	    return $user_id;
}
if(get_option('users_can_register')){
	add_action( 'wp_ajax_nopriv_theplus_ajax_register', 'theplus_ajax_register' );
}

function get_element_widget_data( $elements, $id ) {

	foreach ( $elements as $element ) {
		if ( $id === $element['id'] ) {
			return $element;
		}

		if ( ! empty( $element['elements'] ) ) {
			$element = get_element_widget_data( $element['elements'], $id );

			if ( $element ) {
				return $element;
			}
		}
	}

	return false;
}

function theplus_ajax_register() {
	
	if( !isset( $_POST['security'] ) || !wp_verify_nonce( $_POST['security'], 'ajax-login-nonce' ) ){		
	echo wp_json_encode( ['registered'=>false, 'message'=> esc_html__( 'Ooops, something went wrong, please try again later.', 'theplus' )] );
	exit;
	}
	 
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) { 
		if ( ! get_option( 'users_can_register' ) ) {
			echo wp_json_encode( ['registered'=>false, 'message'=> esc_html__( 'Registering new users is currently not allowed.', 'theplus' )] );
		} else {
			$email      = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
			$first_name = isset($_POST['first_name']) ? sanitize_text_field( $_POST['first_name'] ) : '';
			$last_name  = isset($_POST['last_name']) ? sanitize_text_field( $_POST['last_name'] ) : '';
			$user_login  = isset($_POST['user_login']) ? sanitize_text_field( $_POST['user_login'] ) : '';
			$passwordemc  = isset($_POST['password']) ? $_POST['password'] : '';
		
			$captcha = isset($_POST["token"]) ? $_POST["token"] : '';
			$dis_cap = $_POST["dis_cap"];
			$dis_mail_chimp = $_POST["dis_mail_chimp"];
			$mail_chimp_check = $_POST["mail_chimp_check"];
			$auto_loggedin = $_POST["auto_loggedin"];
			
			if(!empty($dis_cap) && $dis_cap=='yes'){
				if(!$captcha){
					$message = sprintf(__( 'Please check the the captcha form.', 'theplus' ), get_bloginfo( 'name' ) );
					echo wp_json_encode( ['registered' => false, 'message'=> $message] );					
					exit;
				}
			}
			$check_recaptcha= get_option( 'theplus_api_connection_data' );
			$resscore='';
			$check_captcha = false;
			if( !empty($dis_cap) && $dis_cap=='yes' && !empty($check_recaptcha['theplus_secret_key_recaptcha']) && !empty($captcha) ){
				$secretKey = $check_recaptcha['theplus_secret_key_recaptcha'];
				$ip = $_SERVER['REMOTE_ADDR'];
				
				$url = 'https://www.google.com/recaptcha/api/siteverify';
				$data = array('secret' => $secretKey, 'response' => $captcha);
				
				$options = array(
					'http' => array(
					  'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					  'method'  => 'POST',
					  'content' => http_build_query($data)
					)
				  );
				  
				  
				$recaptcha_secret = isset($data['secret']) ? $data['secret'] : '';
				$recaptcha_respo = isset($data['response']) ? $data['response'] : '';					
				$response = wp_remote_get("https://www.google.com/recaptcha/api/siteverify?secret=". $recaptcha_secret ."&response=". $recaptcha_respo);
				$responseKeys = json_decode($response["body"], true);
				
				$resscore=$responseKeys["score"];
				$check_captcha = true;
				if(!$responseKeys['success']){
					$message = sprintf(__( 'Please check the the reCaptcha form.', 'theplus' ), get_bloginfo( 'name' ) );
					echo wp_json_encode( ['registered' => false, 'message'=> $message, 'recaptcha' => false ] );
					exit;
				}
				
			}
			
			$result     = theplus_ajax_register_user( $email, $first_name, $last_name );
			if(empty($result)){				
				echo wp_json_encode( ['registered'=>false, 'message'=> esc_html__( 'Username Already Exists.', 'theplus' )] );				
			}else if ( is_wp_error( $result ) ) {
				// Parse errors into a string and append as parameter to redirect
				$errors  = $result->get_error_message();
				echo wp_json_encode( ['registered' => false, 'message'=> $errors ] );
			} else {
				// Success
				
				if(!empty($_POST['tceo']) && (!empty($_POST['tceo']['tp_cst_email_opt']) && $_POST['tceo']['tp_cst_email_opt']=='yes')){
					
					$esub =  stripslashes(html_entity_decode($_POST['tceo']['tp_cst_email_subject']));
					$emsg =  stripslashes(html_entity_decode($_POST['tceo']['tp_cst_email_message']));
					$find = array( '/\[tp_firstname\]/', '/\[tp_lastname\]/', '/\[tp_username\]/', '/\[tp_email\]/', '/\[tp_password\]/' );
					$replacement = array( $first_name,$last_name, $user_login, $email,$passwordemc );
					$cmessage = preg_replace( $find, $replacement, $emsg );
					$headers = array( 'Content-Type: text/html; charset=UTF-8' );
					 
					wp_mail( $email, $esub, $cmessage, $headers );
				}				
				$message = sprintf(__( 'You have successfully registered to %s. We have emailed your password to the email address you entered.', 'theplus' ), get_bloginfo( 'name' ) );
				$response = ['registered' => true, 'message'=> $message, 'recaptcha' => $check_captcha, 'recaptcha_score' => $resscore ];
				
				//mailchimp subscriber user
				
				if((!empty($dis_mail_chimp) && $dis_mail_chimp=='yes') && (!empty($mail_chimp_check) && $mail_chimp_check=='yes')){
					$sep_cust_mail_chimp_apikey = isset($_POST["mc_custom_apikey"]) ? $_POST["mc_custom_apikey"] : '';
					$sep_cust_mail_chimp_listid = isset($_POST["mc_custom_listid"]) ? $_POST["mc_custom_listid"] : '';
					
					$mc_cst_group_value=$mc_cst_tags_value='';

					if(!empty($_POST['mc_cst_group_value']) && sanitize_text_field($_POST['mc_cst_group_value'])){
						$mc_cst_group_value= sanitize_text_field($_POST['mc_cst_group_value']);
					}
					if(!empty($_POST['mc_cst_tags_value']) && sanitize_text_field($_POST['mc_cst_tags_value'])){
						$mc_cst_tags_value= sanitize_text_field($_POST['mc_cst_tags_value']);
					}
					
					plus_mailchimp_subscribe_using_lr($email, $first_name, $last_name,$dis_mail_chimp,$sep_cust_mail_chimp_apikey,$sep_cust_mail_chimp_listid,$mc_cst_group_value,$mc_cst_tags_value);
				}
				
				if((!empty($auto_loggedin) && $auto_loggedin==true)){
					$access_info = [];
					$access_info['user_login']    = !empty($email) ? $email : "";
					$access_info['user_password'] = !empty($_POST['password']) ? $_POST['password'] : "";
					$access_info['rememberme']    = true;
					$user_signon = wp_signon( $access_info, false );
					if ( !is_wp_error($user_signon) ){				
						$response = ['registered' => true, 'message'=> esc_html__('Login successful, Redirecting...', 'theplus')];
					} else {			
						$response = ['registered' => false, 'message'=> esc_html__('Registered Successfully, Ops! Login Failed...!', 'theplus')];
					}
				}
				echo wp_json_encode($response);
			}
		}

		exit;
	}
}

function plus_mailchimp_subscribe_using_lr($email='', $first_name='', $last_name='',$dis_mail_chimp='',$sep_cust_mail_chimp_apikey='',$sep_cust_mail_chimp_listid='',$mc_cst_group_value='',$mc_cst_tags_value=''){
		
	$list_id=$api_key='';
	if($dis_mail_chimp=='yes' && (!empty($sep_cust_mail_chimp_apikey) && !empty($sep_cust_mail_chimp_listid))){
		$api_key = $sep_cust_mail_chimp_apikey;
		$list_id = $sep_cust_mail_chimp_listid;		
	}else{
		$options = get_option( 'theplus_api_connection_data' );
		$list_id = (!empty($options['theplus_mailchimp_id'])) ? $options['theplus_mailchimp_id'] : '';
		$api_key = (!empty($options['theplus_mailchimp_api'])) ? $options['theplus_mailchimp_api'] : '';
	}
	
	$mc_r_status = 'subscribed';
	if(!empty($_POST['mcl_double_opt_in']) && $_POST['mcl_double_opt_in']=='yes'){
		$mc_r_status = 'pending';
	}
	
	$mc_cst_group_value=$mc_cst_tags_value='';

	if(!empty($_POST['mc_cst_group_value']) && sanitize_text_field($_POST['mc_cst_group_value'])){
		$mc_cst_group_value= sanitize_text_field($_POST['mc_cst_group_value']);
	}
	if(!empty($_POST['mc_cst_tags_value']) && sanitize_text_field($_POST['mc_cst_tags_value'])){
		$mc_cst_tags_value= sanitize_text_field($_POST['mc_cst_tags_value']);
	}
	$result = json_decode( theplus_mailchimp_subscriber_message($email, $mc_r_status, $list_id, $api_key, array('FNAME' => $first_name,'LNAME' => $last_name),$mc_cst_group_value,$mc_cst_tags_value ) );	
	
}

function theplus_load_metro_style_layout($columns='1',$metro_column='3',$metro_style='style-1'){
	$i=($columns!='') ? $columns : 1;
	if(!empty($metro_column)){
		//style-3
		if($metro_column=='3' && $metro_style=='style-1'){
			$i=($i<=10) ? $i : ($i%10);			
		}
		if($metro_column=='3' && $metro_style=='style-2'){
			$i=($i<=9) ? $i : ($i%9);			
		}
		if($metro_column=='3' && $metro_style=='style-3'){
			$i=($i<=15) ? $i : ($i%15);			
		}
		if($metro_column=='3' && $metro_style=='style-4'){
			$i=($i<=8) ? $i : ($i%8);			
		}
		//style-4
		if($metro_column=='4' && $metro_style=='style-1'){
			$i=($i<=12) ? $i : ($i%12);			
		}
		if($metro_column=='4' && $metro_style=='style-2'){
			$i=($i<=14) ? $i : ($i%14);			
		}
		if($metro_column=='4' && $metro_style=='style-3'){
			$i=($i<=12) ? $i : ($i%12);			
		}
		//style-5
		if($metro_column=='5' && $metro_style=='style-1'){
			$i=($i<=18) ? $i : ($i%18);			
		}
		//style-6
		if($metro_column=='6' && $metro_style=='style-1'){
			$i=($i<=16) ? $i : ($i%16);			
		}
	}
	return $i;
}

function theplus_key_notice_ajax(){
	if(!isset($_POST['security']) || empty($_POST['security']) || ! wp_verify_nonce( $_POST['security'], 'theplus-addons' )){
		 die ( 'Invalid Nonce Security checked!');
	} 
	
	if ( get_option( 'theplus-notice-dismissed' ) !== false ) {
		update_option( 'theplus-notice-dismissed', '1' );
	} else {
		$deprecated = null;
		$autoload = 'no';
		add_option( 'theplus-notice-dismissed','1', $deprecated, $autoload );
	}
}
if( is_admin() &&  current_user_can("manage_options") ){
	add_action('wp_ajax_theplus_key_notice','theplus_key_notice_ajax');
}

//post pagination
function theplus_pagination($pages = '', $range = 2, $pagination_next='', $pagination_prev=''){  
	$showitems = ($range * 2)+1;  
	
	global $paged;
	if(empty($paged)) $paged = 1;
	
	if($pages == ''){
		global $wp_query;
		if( $wp_query->max_num_pages <= 1 )
		return;
		
		$pages = $wp_query->max_num_pages;
		/*if(!$pages)
		{
			$pages = 1;
		}*/
		$pages = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	}   
	
	if(1 != $pages){
		$paginate ="<div class=\"theplus-pagination\">";
		if ( get_previous_posts_link() ){
			$paginate .= get_previous_posts_link('<i class="fas fa-long-arrow-alt-left" aria-hidden="true"></i>'.$pagination_prev);
		}
		
		for ($i=1; $i <= $pages; $i++){
			if (1 != $pages && ( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				$paginate .= ($paged == $i)? "<span class=\"current\">".esc_html($i)."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".esc_html($i)."</a>";
			}
		}
		
		if ( get_next_posts_link() ){
			get_next_posts_link($pagination_next,1);
		}			
		if ( $paged < $pages ) $paginate .= "<a class='paginate-next' href='".get_pagenum_link($paged + 1)."'>".$pagination_next."<i class='fas fa-long-arrow-alt-right' aria-hidden='true'></i></a>";
		
		$paginate .="</div>\n";
		return $paginate;
	}
}

function theplus_mailchimp_subscriber_message( $email, $status, $list_id, $api_key, $merge_fields = array(), $mc_cst_group_value='', $mc_cst_tags_value=''){

    $data = array(
        'apikey'        => $api_key,
        'email_address' => $email,
        'status'        => $status,
    );
	
	if(!empty($merge_fields)){
		$data['merge_fields'] = $merge_fields;
	}
	
	if(!empty($mc_cst_group_value) && sanitize_text_field($mc_cst_group_value)){
		$interests = explode( ' | ', trim( sanitize_text_field($mc_cst_group_value) ) );
		$interests=array_flip($interests);
		
		foreach($interests as $key => $value){
			$data['interests'][$key] = true;
		}
	}
	
	if(!empty($mc_cst_tags_value) && sanitize_text_field($mc_cst_tags_value)){
		$data['tags'] = explode( '|', trim( sanitize_text_field($mc_cst_tags_value)) );
	}
	
	$mch_api = curl_init();
 
    curl_setopt($mch_api, CURLOPT_URL, 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($data['email_address'])));
    curl_setopt($mch_api, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$api_key )));
    curl_setopt($mch_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    curl_setopt($mch_api, CURLOPT_RETURNTRANSFER, true); // return the API response
    curl_setopt($mch_api, CURLOPT_CUSTOMREQUEST, 'PUT'); // method PUT
    curl_setopt($mch_api, CURLOPT_TIMEOUT, 10);
    curl_setopt($mch_api, CURLOPT_POST, true);
    curl_setopt($mch_api, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($mch_api, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json
 
    $result = curl_exec($mch_api);
    return $result;
}
function plus_mailchimp_subscribe(){
	$options = get_option( 'theplus_api_connection_data' );
	$list_id = (!empty($options['theplus_mailchimp_id'])) ? $options['theplus_mailchimp_id'] : '';
	$api_key = (!empty($options['theplus_mailchimp_api'])) ? $options['theplus_mailchimp_api'] : ''; // YOUR MAILCHIMP API KEY HERE
	
	$FNAME=$LNAME=$BIRTHDAY=$PHONE='';	
	$chimp_field = array();
	if(!empty($_POST['FNAME'])){
		$FNAME= sanitize_text_field($_POST['FNAME']);
		$chimp_field['FNAME'] =$FNAME;
	}
	if(!empty($_POST['LNAME'])){
		$LNAME= sanitize_text_field($_POST['LNAME']);
		$chimp_field['LNAME'] =$LNAME;
	}
	if(!empty($_POST['BIRTHDAY']) && !empty($_POST['BIRTHMONTH'])){
		$BIRTHDAY = sanitize_text_field($_POST['BIRTHMONTH']) . '/' . sanitize_text_field($_POST['BIRTHDAY']);
		$chimp_field['BIRTHDAY'] =$BIRTHDAY;
	}
	if(!empty($_POST['PHONE'])){
		$PHONE= wp_unslash($_POST['PHONE']);
		$chimp_field['PHONE'] =$PHONE;
	}
	
	$mc_status = 'subscribed';
	if(!empty($_POST['mc_double_opt_in']) && $_POST['mc_double_opt_in']=='pending'){
		$mc_status = 'pending';
	}
	
	$mc_cst_group_value = '';
	if(!empty($_POST['mc_cst_group_value']) && sanitize_text_field($_POST['mc_cst_group_value'])){
		$mc_cst_group_value= sanitize_text_field($_POST['mc_cst_group_value']);
	}
	
	$mc_cst_tags_value = '';
	if(!empty($_POST['mc_cst_tags_value']) && sanitize_text_field($_POST['mc_cst_tags_value'])){
		$mc_cst_tags_value= sanitize_text_field($_POST['mc_cst_tags_value']);
	}
	
	$result = json_decode( theplus_mailchimp_subscriber_message($_POST['email'], $mc_status, $list_id, $api_key, $chimp_field,$mc_cst_group_value,$mc_cst_tags_value) );
	
	if( $result->status == 400 ){
		echo 'incorrect';
	} elseif( $result->status == 'subscribed' ){
		echo 'correct';
	} elseif( $result->status == 'pending' ){
		echo 'pending';
	} else {
		echo 'not-verify';
	}
	die;
}
add_action('wp_ajax_plus_mailchimp_subscribe','plus_mailchimp_subscribe');
add_action('wp_ajax_nopriv_plus_mailchimp_subscribe', 'plus_mailchimp_subscribe');

if(!function_exists('theplus_api_check_license')){
	function theplus_api_check_license($tp_api_key='',$home_url='',$check_license='') {
		$store_url = 'https://store.posimyth.com';
		$item_name = 'The Plus Addons for Elementor';
		$option_name = 'theplus_verified';
		$license_action = (!empty($check_license)) ? $check_license : 'activate_license';
		$api_params = array(
			'edd_action' => $license_action,
			'license' => $tp_api_key,
			'item_name' => urlencode( $item_name ),
			'url' => $home_url
		);
		
		//@version 3.3.4
		$response = get_transient( 'theplus_verify_trans_api_store' );		
		if (false === $response || $license_action == 'activate_license') {				
			$response = wp_remote_post( $store_url, array( 'timeout' => 30, 'sslverify' => false, 'body' => $api_params ) );
			set_transient('theplus_verify_trans_api_store', $response, 172800); 
		}
		
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			
			$message =  ( is_wp_error( $response ) && ! empty( $response->get_error_message() ) ) ? $response->get_error_message() : esc_html__( 'An error occurred, please try again.','theplus' );
			return false;
		} else {
			
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
			$license = 'invalid';
			if ( !empty($license_data) && true == $license_data->success  && !empty($license_data->success)) {
				
				if(!empty($license_data->license)){
					$license = $license_data->license;
				}
				
				$expire_date=$license_data->expires;
				if($expire_date!='lifetime'){
					$expire = strtotime($expire_date);
				}else{
					$expire = $expire_date;
				}
				$today_date = strtotime("today midnight");
				if($expire !='lifetime' && $today_date >= $expire && $license_data->license == 'valid'){
					$verify= '0' ;
					theplus_check_api_options('theplus_verified',$verify,$license,$expire);
					
					return 'expired';
				}
				if( $license_data->license == 'valid' ) {
					$verify = '1' ;
					theplus_check_api_options('theplus_verified',$verify,$license,$expire);
					
					return 'valid';
				}elseif($license_data->license == 'expired' ){
					$verify = '0' ;
					theplus_check_api_options('theplus_verified',$verify,$license,$expire);
					
					return 'expired';
				} else {
					$verify = '0' ;
					theplus_check_api_options('theplus_verified',$verify,$license,$expire);
					
					return 'invalid';
				}
			}else{
				$verify = '0' ;
				theplus_check_api_options('theplus_verified',$verify,$license);
				
				return 'success_false';
			}
		}
	}
}

if(!function_exists('theplus_api_check_license_code')){
	function theplus_api_check_license_code($tp_api_key='',$generate_key='',$check_license='') {
		if(isset($tp_api_key) && !empty($tp_api_key) && !empty($generate_key)){
			$get_url='https://store.posimyth.com/theplus-verify/';
			$method='verify';
			
			$get_url=$get_url.'?url=verify_api/'.$method.'/'.$tp_api_key.'/'.$generate_key;
			
			//@version 3.3.4
			$response = get_transient( 'theplus_verify_trans_api_code' );
			if (false === $response || $check_license=='') {				
				$response = wp_remote_get( $get_url );
				set_transient('theplus_verify_trans_api_code', $response, 172800);
			}
			
			if ( is_wp_error( $response ) ) {
				return false;
			}

			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
			$license = 'invalid';
			
			$option_name = 'theplus_verified';
			if( !empty($license_data) && $license_data->success == true ) {
				if(!empty($license_data->license)){
					$license = $license_data->license;
				}
				
				$expire=$license_data->expires;
				
				if($expire !='lifetime' && $license_data->license == 'valid'){
					$verify= '0' ;
					theplus_check_api_options('theplus_verified',$verify,$license,$expire);
					
					return 'expired';
				}
				if( $license_data->license == 'valid' ) {
					$verify = '1' ;
					theplus_check_api_options('theplus_verified',$verify,$license,$expire);
					
					return 'valid';
				}elseif($license_data->license == 'expired' ){
					$verify = '0' ;
					theplus_check_api_options('theplus_verified',$verify,$license,$expire);
					
					return 'expired';
				} else {
					$verify = '0' ;
					theplus_check_api_options('theplus_verified',$verify,$license,$expire);
					
					return 'invalid';
				}
			}else{
				$verify = '0' ;
				theplus_check_api_options('theplus_verified',$verify,$license);
				return 'success_false';
			}
		}else{
			return false;
		}
	}
}

if(!function_exists('plus_simple_crypt')){
	function plus_simple_crypt( $string, $action = 'dy' ) {	    
		$tppk=get_option( 'theplus_purchase_code' );
		$generated = !empty(get_option( 'tp_key_random_generate' )) ? get_option( 'tp_key_random_generate' ) : 'PO$_key';
		
		$secret_key = ( isset($tppk['tp_api_key']) && !empty($tppk['tp_api_key']) ) ? $tppk['tp_api_key'] : $generated;
		$secret_iv = 'PO$_iv';
	    $output = false;
	    $encrypt_method = "AES-128-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	 
	    if( $action == 'ey' ) {
	        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	    }
	    else if( $action == 'dy' ){
	        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	    }
	 
	    return $output;
	}
}

function theplus_check_api_options($option_name,$verify,$valid='',$expire=''){
	
	if($option_name!='' && $verify!=''){	
		$value=array(
			 'verify'=>$verify,
			 'license' => $valid,
			 'expire'=>$expire,
		 );
		
		if ( get_option( $option_name ) ) {
			update_option( $option_name, $value );
		} else {
			$deprecated = null;
			$autoload = 'yes';
			add_option( $option_name,$value, $deprecated, $autoload );
		}
	}
}

if(!function_exists('theplus_check_api_status')){
	function theplus_check_api_status() {
		$option_name = 'theplus_verified';
		$values=get_option( $option_name );
		$expired=!empty($values["expire"]) ? $values["expire"] : '';
		$verify=!empty($values["verify"]) ? $values["verify"] : '';
		$today_date = strtotime("today midnight");
			
		if($expired!='lifetime' && $today_date >= $expired ){
			return false;
		}else if($verify==1){
			return true;
		}else{
			return false;
		}
	}
}

//@version 3.3.5
function check_expired_date_key() {
	$option_name = 'theplus_verified';
	
	$values=get_option( $option_name );
	$expired=!empty($values["expire"]) ? $values["expire"] : '';
	$verify=!empty($values["verify"]) ? $values["verify"] : '';
	$today_date = strtotime("today midnight");
	
		if($expired!='lifetime' && $today_date >= $expired ){
			$verify=0;$expire='';
			theplus_check_api_options($option_name,$verify,'',$expire);
		}
}
add_action( 'admin_init', 'check_expired_date_key', 1 );

/*woo thank you page selection start*/
function theplus_thankyou_content_func(){
	$tp_data=get_option( 'theplus_api_connection_data' );
	$tp_thankyoupage_id = $tp_data['theplus_woo_thank_you_page_select'];	
	if(!empty($tp_thankyoupage_id)){
		echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $tp_thankyoupage_id );
	}else{
		the_content();
	}
}
add_action( 'theplus_thankyou_content', 'theplus_thankyou_content_func' );

add_filter(	'wc_get_template','theplus_checkout_page_template', 51, 3 );

function theplus_checkout_page_template($located, $name, $args){	
	$tp_data=get_option( 'theplus_api_connection_data' );		
	if($name === 'checkout/thankyou.php' && !empty($tp_data['theplus_woo_thank_you_page_select'])){
		$located = THEPLUS_WSTYLES . 'woo-thankyou/thankyou.php';
	}
	return $located;
}
/*woo thank you page selection end*/

//Woocommerce Products
if(class_exists('woocommerce')) {
function theplus_out_of_stock() {
  global $post;
  $id = $post->ID;
  $status = get_post_meta($id, '_stock_status',true);
  
  if ($status == 'outofstock') {
  	return true;
  } else {
  	return false;
  }
}
function theplus_product_badge($out_of_stock_val='') {
 global $post, $product;
 	if (theplus_out_of_stock()) {
		echo '<span class="badge out-of-stock">'.$out_of_stock_val.'</span>';
	} else if ( $product->is_on_sale() ) {
		if ('discount' == 'discount') {
			if ($product->get_type() == 'variable') {
				$available_variations = $product->get_available_variations();								
				$maximumper = 0;
				for ($i = 0; $i < count($available_variations); ++$i) {
					$variation_id=$available_variations[$i]['variation_id'];
					$variable_product1= new WC_Product_Variation( $variation_id );
					$regular_price = $variable_product1->get_regular_price();
					$sales_price = $variable_product1->get_sale_price();
					$percentage = $sales_price ? round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100) : 0;
					if ($percentage > $maximumper) {
						$maximumper = $percentage;
					}
				}
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$maximumper.'%</span>', $post, $product);
			} else if ($product->get_type() == 'simple'){
				if( !empty($product->get_sale_price()) ){
					$salePrice = $product->get_sale_price();
					$percentage = round( ( ( $product->get_regular_price() - $salePrice ) / $product->get_regular_price() ) * 100 );
					// $output_html = '<span class="badge onsale perc">&darr; '.$percentage.'%</span>';
					echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);
				}
			} else if ($product->get_type() == 'external'){
				$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);
			}
		} else {
			echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale">'.esc_html__( 'Sale','theplus' ).'</span>', $post, $product);
		}
	}
}
add_action( 'theplus_product_badge', 'theplus_product_badge',3 );

function plus_filter_woocommerce_sale_flash( $output_html, $post, $product ) { 
	if ($product->get_type() == 'variable') {
		$available_variations = $product->get_available_variations();								
		$maximumper = 0;
		for ($i = 0; $i < count($available_variations); ++$i) {
			$variation_id=$available_variations[$i]['variation_id'];
			$variable_product1= new WC_Product_Variation( $variation_id );
			$regular_price = $variable_product1->get_regular_price();
			$sales_price = $variable_product1->get_sale_price();
			$percentage = $sales_price ? round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100) : 0;
			if ($percentage > $maximumper) {
				$maximumper = $percentage;
			}
		}
		$output_html = '<span class="badge onsale perc">&darr; '.$maximumper.'%</span>';
	} else if ($product->get_type() == 'simple'){
		if( !empty($product->get_sale_price() )){
			$salePrice = $product->get_sale_price();
			$percentage = round( ( ( $product->get_regular_price() - $salePrice ) / $product->get_regular_price() ) * 100 );
			$output_html = '<span class="badge onsale perc">&darr; '.$percentage.'%</span>';
		}
	} else if ($product->get_type() == 'external'){
		if( !empty($product->get_sale_price() )){
			$salePrice = $product->get_sale_price();
			$percentage = round( ( ( $product->get_regular_price() - $salePrice ) / $product->get_regular_price() ) * 100 );
			$output_html = '<span class="badge onsale perc">&darr; '.$percentage.'%</span>';
		}
	}else {
		$output_html = '<span class="badge onsale">'.esc_html__( 'Sale','theplus' ).'</span>';
	}
    return $output_html;
}; 

add_filter( 'woocommerce_sale_flash', 'plus_filter_woocommerce_sale_flash', 11, 3 );

}

add_action('elementor/widgets/register', function($widgets_manager){
	$elementor_widget_blacklist = [
		'plus-elementor-widget',
	];
	
	foreach($elementor_widget_blacklist as $widget_name){
		$widgets_manager->unregister($widget_name);
	}
}, 15);

function registered_widgets(){

	// widgets class map
	return [
		
		'tp-adv-text-block' => [
			'dependency' => [],
		],
		'tp-advanced-typography' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/adv-typography/plus-adv-typography.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/adv-typography/plus-adv-typography.min.js',
				],
			],
		],
		'tp-advanced-circle' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/circletype.min.js',
				],
			],
		],
		'tp-advanced-buttons' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-adv-button.css',
				],
			],
		],

		'tp_cta_st_1' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-cta-style-1.css',
				],
			],
		],
		'tp_cta_st_2' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-cta-style-2.css',
				],
			],
		],
		'tp_cta_st_3' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-cta-style-3.css',
				],
			],
		],
		'tp_cta_st_4' => [
			'dependency' => [

				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-cta-style-4.css',
				],
			],
		],
		'tp_cta_st_5' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-cta-style-5.css',
				],
			],
		],
		'tp_cta_st_6' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-cta-style-6.css',
				],
			],
		],
		'tp_cta_st_7' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-cta-style-7.css',
				],
			],
		],
		'tp_cta_st_8' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-cta-style-8.css',
				],
			],
		],
		'tp_cta_st_9' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-cta-style-9.css',
				],
			],
		],
		'tp_cta_st_10' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-cta-style-10.css',
				],
			],
		],
		'tp_cta_st_11' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-cta-style-11.css',
				],
			],
		],
		'tp_cta_st_12' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-cta-style-12.css',
				],
			],
		],
		'tp_cta_st_13' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-cta-style-13.css',
				],
			],
		],
		'tp_cta_st_14' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-cta-style-14.css',
				],
			],
		],
		'tp_download_st_1' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-download-style-1.css',
				],
			],
		],
		'tp_download_st_2' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-download-style-2.css',
				],
			],
		],
		'tp_download_st_3' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-download-style-3.css',
				],
			],
		],
		'tp_download_st_4' =>  [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-download-style-4.css',
				],
			],
		],
		'tp_download_st_5' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/advanced-buttons/plus-download-style-5.css',
				],
			],
		],
		'tp-advanced-buttons-js' => [
			'dependency' => [
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/advanced-buttons/plus-advanced-buttons.min.js',
				],
			],
		],
		'tp_advertisement_banner' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/addbanner/plus-addbanner-style.css',
				],
			],
		],
		'tp_add_banner-style-1' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/addbanner/plus-addbanner-style-1.css',
				],
			],
		],
		'tp_add_banner-style-2' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/addbanner/plus-addbanner-style-2.css',
				],
			],
		],
		'tp_add_banner-style-3' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/addbanner/plus-addbanner-style-3.css',
				],
			],
		],
		'tp_add_banner-style-4' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/addbanner/plus-addbanner-style-4.css',
				],
			],
		],
		'tp_add_banner-style-5' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/addbanner/plus-addbanner-style-5.css',
				],
			],
		],
		'tp_add_banner-style-6' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/addbanner/plus-addbanner-style-6.css',
				],
			],
		],
		'tp_add_banner-style-7' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/addbanner/plus-addbanner-style-7.css',
				],
			],
		],
		'tp_add_banner-style-8' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/addbanner/plus-addbanner-style-8.css',
				],
			],
		],
		'tp-accordion' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tabs-tours/plus-tabs-tours.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/accordion/plus-accordion.min.js',
				],
			],
		],
		'tp-age-gate' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/age-gate/plus-method.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/age-gate/plus-age-gate.min.js',
				],
			],
		],
		'tp-age-gate-method-1' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/age-gate/plus-method-1.css',
				],
			],
		],
		'tp-age-gate-method-2' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/age-gate/plus-method-2.css',
				],
			],
		],
		'tp-age-gate-method-3' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/age-gate/plus-method-3.css',
				],
			],
		],
		'tp-animated-service-boxes' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tp-bootstrap-grid.css',
			        THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/animated-service-box/plus-asb-style.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/animated-service-box/plus-service-box.min.js',
				],
			],
		],
		'tp-image-accordion' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/animated-service-box/plus-image-accordion.css',
				],
			],
		],
		'tp-image-accordion-style-2' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/animated-service-box/plus-image-accordion-style-2.css',
				],
			],
		],
		'tp-sliding-boxes' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/animated-service-box/plus-sliding-box.css',
				],
			],
		],
		'tp-article-box-style-1' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/animated-service-box/plus-article-box-1.css',
				],
			],
		],
		'tp-article-box-style-2' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/animated-service-box/plus-article-box-2.css',
				],
			],
		],
		'tp-info-banner-style-1' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/animated-service-box/plus-info-banner-style-1.css',
				],
			],
		],
		'tp-info-banner-style-2' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/animated-service-box/plus-info-banner-style-2.css',
				],
			],
		],
		'tp-hover-section' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/animated-service-box/plus-hover-section.css',
				],
			],
		],
		'tp-fancy-box' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/animated-service-box/plus-fancy-box.css',
				],
			],
		],
		'tp-services-element' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/animated-service-box/plus-service-element.css',
				],
			],
		],
		'tp-services-element-style-1' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/animated-service-box/plus-services-style-1.css',
				],
			],
		],
		'tp-services-element-style-2' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/animated-service-box/plus-services-style-2.css',
				],
			],
		],
		'tp-portfolio-style-1' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/animated-service-box/plus-portfolio-style-1.css',
				],
			],
		],
		'tp-portfolio-style-2' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/animated-service-box/plus-portfolio-style-2.css',
				],
			],
		],
		'tp-audio-player' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/audio-player/plus-ap.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/audio-player/plus-audio-player.min.js',					
				],
			],
		],
		'tp-audio-player-style-1' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/audio-player/plus-ap-style-1.css',
				],
			],
		],
		'tp-audio-player-style-2' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/audio-player/plus-ap-style-2.css',
				],
			],
		],
		'tp-audio-player-style-3' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/audio-player/plus-ap-style-3.css',
				],
			],
		],
		'tp-audio-player-style-4' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/audio-player/plus-ap-style-4.css',
				],
			],
		],
		'tp-audio-player-style-5' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/audio-player/plus-ap-style-5.css',
				],
			],
		],
		'tp-audio-player-style-6' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/audio-player/plus-ap-style-6.css',
				],
			],
		],
		'tp-audio-player-style-7' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/audio-player/plus-ap-style-7.css',
				],
			],
		],
		'tp-audio-player-style-8' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/audio-player/plus-ap-style-8.css',
				],
			],
		],
		'tp-audio-player-style-9' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/audio-player/plus-ap-style-9.css',
				],
			],
		],
		'tp-before-after' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/before-after/plus-before-after.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/before-after/plus-before-after.min.js',
				],
			],
		],
		'tp-blockquote' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/block-quote/plus-block-quote.css',
				],
			],
		],
		'tp-blockquote-bl_1' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/block-quote/plus-block-layout1.css',
				],
			],
		],
		'tp-blockquote-bl_2' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/block-quote/plus-block-layout2.css',
				],
			],
		],
		'tp-blockquote-bl_3' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/block-quote/plus-block-layout3.css',
				],
			],
		],
		'tp-blog-listout' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tp-bootstrap-grid.css',
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/blog-list/plus-bloglist-style.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',
				],
			],
		],
		'tp-bloglistout-style-1' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/blog-list/plus-bloglist-style-1.css',
				],
			],
		],
		'tp-bloglistout-style-2' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/blog-list/plus-bloglist-style-2.css',
				],
			],
		],
		'tp-bloglistout-style-3' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/blog-list/plus-bloglist-style-3.css',
				],
			],
		],
		'tp-bloglistout-style-4' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/blog-list/plus-bloglist-style-4.css',
				],
			],
		],
		'tp-bloglistout-preloder' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/blog-list/plus-preloader.css',
				],
			],
		],
		'tp-dynamic-smart-showcase' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-smart-showcase/dynamic-showcase.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/dynamic-smart-showcase/plus-dynamic-smart-showcase.min.js',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/dynamic-smart-showcase/plus-bss-filter.min.js',
				],
			],
		],
		'tp-dynamic-smart-showcase-mag_one_2_2' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-smart-showcase/dynamic-ss-style-1.css',
				],				
			],
		],
		'tp-dynamic-smart-showcase-mag_one_1_2_v' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-smart-showcase/dynamic-ss-style-2.css',
				],				
			],
		],
		'tp-dynamic-smart-showcase-mag_one_1_2_h' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-smart-showcase/dynamic-ss-style-3.css',
				],				
			],
		],
		'tp-dynamic-smart-showcase-mag_rows_2' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-smart-showcase/dynamic-ss-style-4.css',
				],				
			],
		],
		'tp-dynamic-smart-showcase-mag_four_x_rows_1' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-smart-showcase/dynamic-ss-style-5.css',
				],				
			],
		],
		'tp-dynamic-smart-showcase-mag_two_3_v' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-smart-showcase/dynamic-ss-style-6.css',
				],				
			],
		],
		'tp-dynamic-smart-showcase-mag_two_1_2' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-smart-showcase/dynamic-ss-style-7.css',
				],				
			],
		],
		'tp-dynamic-smart-showcase-mag_two_4' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-smart-showcase/dynamic-ss-style-8.css',
				],				
			],
		],
		'tp-dynamic-smart-showcase-post-ticker' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-smart-showcase/dynamic-smart-post-ticker.css',
				],				
			],
		],
		'tp-breadcrumbs-bar' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/breadcrumbs-bar/plus-breadcrumbs-bar.css',
				],				
			],
		],
		'tp-breadcrumbs-bar-style_1' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/breadcrumbs-bar/plus-bb-style1.css',
				],				
			],
		],
		'tp-breadcrumbs-bar-style_2' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/breadcrumbs-bar/plus-bb-style2.css',
				],				
			],
		],
		'plus-post-filter' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-category-filter/plus-post-filter.min.css',
                    THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-category-filter/plus-filter-style-3.css',

				],
			],
		],
		'plus-post-filter-style-1' => [
            'dependency' => [
                'css' => [
                    THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-category-filter/plus-filter-style-1.css',
                ],
            ],
        ],
        'plus-post-filter-style-2' => [
            'dependency' => [
                'css' => [
                    THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-category-filter/plus-filter-style-2.css',
                ],
            ],
        ],
        'plus-post-filter-style-3' => [
            'dependency' => [
                'css' => [
                    // THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-category-filter/plus-filter-style-3.css',
                ],
            ],
        ],
        'plus-post-filter-style-4' => [
            'dependency' => [
                'css' => [
                    THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-category-filter/plus-filter-style-4.css',
                ],
            ],
        ],
        'plus-post-filter-h-style-1' => [
            'dependency' => [
                'css' => [
                    THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-category-filter/plus-filter-h-style-1.css',
                ],
            ],
        ],
        'plus-post-filter-h-style-2' => [
            'dependency' => [
                'css' => [
                    THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-category-filter/plus-filter-h-style-2.css',
                ],
            ],
        ],
        'plus-post-filter-h-style-3' => [
            'dependency' => [
                'css' => [
                    THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-category-filter/plus-filter-h-style-3.css',
                ],
            ],
        ],
        'plus-post-filter-h-style-4' => [
            'dependency' => [
                'css' => [
                    THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-category-filter/plus-filter-h-style-4.css',
                ],
            ],
        ],
		'plus-pagination' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-extra-adv/plus-pagination.css',
				],
			],
		],
		'plus-listing-metro' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/isotope.pkgd.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-metro-list.min.js',
				],
			],
		],
		'plus-listing-masonry' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/isotope.pkgd.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/packery-mode.pkgd.min.js',
				],
			],
		],
		'tp-button' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style.css',
				],
			],
		],
		'tp-button-style-1' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-1.css',
				],
			],
		],
		'tp-button-style-2' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-2.css',
				],
			],
		],
		'tp-button-style-3' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-3.css',
				],
			],
		],
		'tp-button-style-4' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-4.css',
				],
			],
		],
		'tp-button-style-5' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-5.css',
				],
			],
		],
		'tp-button-style-6' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-6.css',
				],
			],
		],
		'tp-button-style-7' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-7.css',
				],
			],
		],
		'tp-button-style-8' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-8.css',
				],
			],
		],
		'tp-button-style-9' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-9.css',
				],
			],
		],
		'tp-button-style-10' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-10.css',
				],
			],
		],
		'tp-button-style-11' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-11.css',
				],
			],
		],
		'tp-button-style-12' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-12.css',
				],
			],
		],
		'tp-button-style-13' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-13.css',
				],
			],
		],
		'tp-button-style-14' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-14.css',
				],
			],
		],
		'tp-button-style-15' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-15.css',
				],
			],
		],
		'tp-button-style-16' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-16.css',
				],
			],
		],
		'tp-button-style-17' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-17.css',
				],
			],
		],
		'tp-button-style-18' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-18.css',
				],
			],
		],
		'tp-button-style-19' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-19.css',
				],
			],
		],
		'tp-button-style-20' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-20.css',
				],
			],
		],
		'tp-button-style-21' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-21.css',
				],
			],
		],
		'tp-button-style-22' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-22.css',
				],
			],
		],
		'tp-button-style-24' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tp-button/tp-button-style-24.css',
				],
			],
		],
		'tp-wp-bodymovin' => [
		],
		'tp-carousel-anything' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/slick.min.css',
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel/plus-carousel.css',
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel-anything/plus-carousel-anything.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/slick.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-slick-carousel.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/carousel-anything/plus-carousel-anything.min.js',
				],
			],
		],
		'tp-carousel-remote' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel-remote/plus-carousel.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/slick.min.js',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/carousel-remote/plus-carousel-remote.min.js',
				],
			],
		],
		'tp-carousel-dot' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel-remote/plus-dots.css',
				],
			],
		],
		'tp-carousel-tooltip' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel-remote/plus-tooltip.css',
				],
			],
		],
		'tp-plus-horizontal-connection' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel-remote/plus-horizontal-connection.css',
				],
			],
		],
		'tp-carousel-pagination' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel-remote/plus-pagination.css',
				],
			],
		],
		'tp-caldera-forms' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/forms-style/plus-caldera-form.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/forms-style/plus-caldera-form.js',
				],
			],
		],
		'tp-cascading-image' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/image-factory/plus-image-factory.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/cascading-image/plus-cascading-image.min.js',
				],
			],
		],
		'tp-chart' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/chart.js', 
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/chart/plus-chart.min.js', 
				], 
			],
		],
		'tp-circle-menu' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/circle-menu/plus-circle-menu.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.circlemenu.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/circle-menu/plus-circle-menu.min.js',
				],
			],
		],
		'tp-clients-listout' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/client-list/plus-client-list.css',					
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',
				],
			],
		],
		'tp-contact-form-7' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tp-bootstrap-grid.css',
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/forms-style/plus-cf7-style.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/forms-style/plus-cf7-form.js',
				],
			],
		],
		'tp-coupon-code' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/coupon-code/plus-coupon-code.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/coupon-code/plus-coupon-code.min.js',
				],
			],
		],
		'tp-coupon-standard' => [
			'dependency' => [
				'css' => [
					 THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/coupon-code/plus-standard.css',
				],
			],
		],
		'tp-coupon-peel' => [
			'dependency' => [
				'css' => [
					 THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/coupon-code/plus-peel.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/peeljs.js',
				],
			],
		],
		'tp-coupon-scratch' => [
			'dependency' => [
				'css' => [
					 THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/coupon-code/plus-scratch.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/html2canvas.min.js',
				],
			],
		],
		'tp-coupon-slideOut' => [
			'dependency' => [
				'css' => [
					 THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/coupon-code/plus-slide.css',
				],
			],
		],
		'tp-dynamic-listing' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-listing/plus-dynamic-listing.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/dynamic-listing/plus-dynamic-listing.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',
				],
			],
		],
		'tp-dynamic-listout-qview' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/jquery.fancybox.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.fancybox.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/dynamic-listing/plus-dynamic-listing-qview.min.js',
				],
			],
		],
		'tp-custom-field' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/custom-field/plus-custom-field.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/custom-field/plus-custom-field.min.js',					
				],
			],
		],
		'tp-countdown' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/countdown/plus-cd-style.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/countdown/plus.countdwon.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/jquery.downCount.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/countdown/plus-countdown.min.js',
				],
			],
		],
		'tp-countdown-style-1' => [
			'dependency' => [
				'css' => [										
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/countdown/plus-cd-s-1.css',
				],
			],
		],
		'tp-countdown-style-2' => [
			'dependency' => [
				'css' => [		
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/countdown/flipdown.min.css',								
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/countdown/plus-cd-s-2.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/countdown/flipdown.min.js',
				],
			],
		],
		'tp-countdown-style-3' => [
			'dependency' => [
				'css' => [										
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/countdown/plus-cd-s-3.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/countdown/progressbar.min.js',
				],
			],
		],
		'tp-dark-mode' => [
			'dependency' => [
				'css' => [										
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/darkmode/plus-dark-mode.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/darkmode.min.js',
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/darkmode/plus-dark-mode.min.js',
				],
			],
		],
		'tp-draw-svg' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/draw-svg/plus-draw-svg.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/vivus.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/draw-svg/plus-draw-svg.min.js',
				],
			],
		],
		'tp-dynamic-device' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-device/plus-dynamic-device.min.css',					
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/dynamic-device/plus-dynamic-device.min.js',
				],
			],
		],
		'tp-everest-form' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/forms-style/plus-everest-form.css',
				],
			],
		],
		'tp-smooth-scroll' => [
			'dependency' => [
				'js' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/smooth-scroll.js',
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/smooth-scroll/plus-smooth-scroll.min.js',
				],
			],
		],
		'tp-flip-box' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/info-box/plus-infobox-style.css',
				],
			],
		],
		'tp-gallery-listout' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/tp-bootstrap-grid.css',
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/gallery-list/plus-gallery-list.css',					
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',
				],
			],
		],
		'tp-gallery-listout-style-1' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/gallery-list/plus-gl-style1.css',					
				],
			],
		],
		'tp-gallery-listout-style-2' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/gallery-list/plus-gl-style2.css',					
				],
			],
		],
		'tp-gallery-listout-style-3' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/gallery-list/plus-gl-style3.css',					
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.hoverdir.js',
				],
			],
		],
		'tp-gallery-listout-style-4' => [
			'dependency' => [
				'css' => [					
					 THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/gallery-list/plus-gl-style4.css',					
				],
			],
		],
		'tp-map-googlemap' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/google-map/plus-gmap.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/google-map/plus-google-map.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/google-map/plus-gmap.min.js',
				]
			],
		],
		'tp-map-osm' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/osmmap/leaflet.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/osmmap/markerclusterer.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/osmmap/leaflet.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/google-map/plus-osm-map.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/google-map/plus-gmap.min.js',
				]
			],
		],
		'tp-gravityt-form' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/forms-style/plus-gravity-form.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/forms-style/plus-gravity-form.js',
				]
			],
		],		
		'tp-heading-animation' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/heading-animation/tp-heading-animation.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/heading-animation/plus-heading-animation.min.js',
				]
			],
		],
		'tp-heading-animation-style-1' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/heading-animation/heading-animation-style-1.css',
				],
			],
		],
		'tp-heading-animation-style-2' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/heading-animation/heading-animation-style-2.css',
				],
			],
		],
		'tp-heading-animation-style-3' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/heading-animation/heading-animation-style-3.css',
				],
			],
		],
		'tp-heading-animation-style-4' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/heading-animation/heading-animation-style-4.css',
				],
			],
		],
		'tp-heading-animation-style-5' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/heading-animation/heading-animation-style-5.css',
				],
			],
		],
		'tp-heading-animation-style-6' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/heading-animation/heading-animation-style-6.css',
				],
			],
		],
		'tp-header-extras' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/header-extras/plus-header-extras.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/header-extras/plus-header-extras.min.js',
				],
			],
		],
		'tp-header-audio' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/buzz.min.js',
				],
			],
		],
		'tp-heading-title' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/heading-title/plus-ht-style.css',
				],			
			],
		],
		'tp-heading-title-style_1' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/heading-title/plus-ht-style-1.css',
				],
			],
		],
		'tp-heading-title-style_2' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/heading-title/plus-ht-style-2.css',
				],
			],
		],
		'tp-heading-title-style_3' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/heading-title/plus-ht-style-3.css',
				],
			],
		],
		'tp-heading-title-style_4' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/heading-title/plus-ht-style-4.css',
				],
			],
		],
		'tp-heading-title-style_5' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/heading-title/plus-ht-style-5.css',
				],
			],
		],
		'tp-heading-title-style_6' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/heading-title/plus-ht-style-6.css',
				],
			],
		],
		'tp-heading-title-style_7' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/heading-title/plus-ht-style-7.css',
				],
			],
		],
		'tp-heading-title-style_8' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/heading-title/plus-ht-style-8.css',
				],
			],
		],
		'tp-heading-title-style_9' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/heading-title/plus-ht-style-9.css',
				],
			],
		],
		'tp-heading-title-style_10' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/heading-title/plus-ht-style-10.css',
				],
			],
		],
		'tp-heading-title-style_11' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/heading-title/plus-ht-style-11.css',
				],
			],
		],
		'tp-heading-title-splite-animation' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.waypoints.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/splittext.min.js',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/tweenmax/tweenmax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/heading-title/plus-heading-title.min.js',
				],				
			],
		],
		'tp-hotspot' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tippy.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/hotspot/plus-hotspot.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tippy.all.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/hotspot/plus-hotspot.min.js',
				],
			],
		],
		'tp-horizontal-scroll-advance' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/horizontal-scroll/plus-horizontal-scroll.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/gsap/gsap.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/gsap/ScrollTrigger.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/gsap/ScrollToPlugin.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/horizontal-scroll/plus-horizontal-scroll.min.js',
				],
			],
		],
		'tp-image-factory' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/image-factory/plus-image-factory.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/image-factory/plus-image-factory.min.js',
				],
			],
		],
		
		'tp-info-box' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/info-box/plus-infobox-style.css',
				],
			],
		],
		'tp-info-box-style_1' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/info-box/plus-infobox-style-1.css',
				],
			],
		],
		'tp-info-box-style_2' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/info-box/plus-infobox-style-2.css',
				],
			],
		],
		'tp-info-box-style_3' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/info-box/plus-infobox-style-3.css',
				],
			],
		],
		'tp-info-box-style_4' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/info-box/plus-infobox-style-4.css',
				],
			],
		],
		'tp-info-box-style_7' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/info-box/plus-infobox-style-5.css',
				],
			],
		],
		'tp-info-box-style_11' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/info-box/plus-infobox-style-6.css',
				],
			],
		],
		'tp-bg-hover-ani' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/info-box/plus-bg-hover-ani.css',
				],
			],
		],
		'tp-info-box-js' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/info-box/plus-info-box.min.js',
				],
			],
		],
		'tp-mailchimp-subscribe' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/mailchimp/plus-mailchimp.css',
				],
			],
		],
		'tp-messagebox' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/messagebox/plus-messagebox.min.css',
				],
			],
		],
		'tp-messagebox-js' => [
			'dependency' => [
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/messagebox/plus-messagebox.min.js',
				],
			],
		],
		'tp-morphing-layouts' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/shape-morph/plus-shape-morph.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/anime.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/shape-morph/theplus-shape-morph.min.js',
				],
			],
		],
		'tp-morphing-scroll' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/scrollmonitor.js',
				],
			],
		],
		'tp-mouse-cursor' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/mouse-cursor-widget/plus-mouse-cursors.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/mouse-cursor-widget/plus-mouse-cursors.min.js',
				],
			],
		],
		'tp-navigation-menu' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/navigation-menu/plus-nav-menu.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/navigation-menu/plus-nav-menu.min.js',
				],
			],
		],
		'tp-navigation-scroll' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/headroom.min.js',
				],
			],
		],
		'tp-navigation-menu-lite' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/navigation-menu-lite/plus-nav-menu-lite.min.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/navigation-menu-lite/plus-nav-menu-lite.min.js',
				],
			],
		],
		'tp-ninja-form' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/forms-style/plus-ninja-form.css',
				],
			],
		],
		'tp-number-counter' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/number-counter/plus-nc.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/numscroller.js',
				],
			],
		],
		'tp-number-counter-style-1' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/number-counter/plus-nc-style-1.css',
				],
			],
		],
		'tp-number-counter-style-2' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/number-counter/plus-nc-style-2.css',
				],
			],
		],
		'tp-post-featured-image' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/post-feature-image/plus-post-image.min.css',					
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/post-feature-image/plus-post-feature-image.min.js',
				],
			],
		],
		'tp-post-featured-image-js' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/post-feature-image/plus-post-feature-image.min.js',
				],
			],
		],
		'tp-post-title' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/post-title/plus-post-title.min.css',					
				],				
			],
		],
		'tp-post-content' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/post-content/plus-post-content.min.css',					
				],				
			],
		],
		'tp-post-meta' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/post-meta-info/plus-post-meta-info.min.css',
				],
				
			],
		],
		'tp-post-author' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/post-author/plus-post-author.min.css',
				],				
			],
		],
		'tp-post-comment' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/post-comment/plus-post-comment.min.css',
				],				
			],
		],
		'tp-post-navigation' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/tp-bootstrap-grid.css',
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/post-navigation/plus-post-navigation.min.css',
				],				
			],
		],
		'tp-off-canvas' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/off-canvas/plus-off-canvas.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/offcanvas/plus-offcanvas.js',
				],
			],
		],
		'tp-page-scroll' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/page-scroll/plus-page-scroll.css',
				],
				'js'  => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/page-scroll/plus-page-scroll.min.js',
				],
			],
		],
		'tp-page-scroll-np-button' => [
            'dependency' => [
                'css' => [
                     THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/page-scroll/plus-np-button.css',
                ],
            ],
        ],
        'tp-page-scroll-paginate' => [
            'dependency' => [
                'css' => [
                    THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/page-scroll/plus-paginate.css',
                ],
            ],
        ],
		'tp-fullpage' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/fullpage.css',
				],
				'js'  => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/fullpage.js',
				],
			],
		],
		'tp-pagepiling' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/jquery.pagepiling.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/page-scroll/plus-scroll-pilling.css',
				],
				'js'  => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/jquery.pagepiling.min.js',
				],
			],
		],
		'tp-multiscroll' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/page-scroll/plus-multiscroll.css',
			   	],
				'js'  => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/jquery.multiscroll.min.js',
				],
			],
		],
		'tp-horizontal-scroll' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/page-scroll/plus-horizontal.css',
			   	],
				'js'  => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/jquery.jInvertScroll.min.js',
				],
			],
		],
		'tp-mobile-menu' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/mobile-menu/plus-mobile-menu.min.css',
				],
				'js'  => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/mobile-menu/plus-mobile-menu.min.js',
				],
			],
		],
		'tp-pricing-list' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/pricing-list/plus-pricing-list.css',
				],
			],
		],
		'tp-pricing-list-style_1' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/pricing-list/plus-pricing-style1.css',
				],
			],
		],
		'tp-pricing-list-style_2' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/pricing-list/plus-pricing-style2.css',
				],
			],
		],
		'tp-pricing-list-style_3' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/pricing-list/plus-pricing-style3.css',
				],
			],
		],
		'tp-pricing-table' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/pricing-table/plus-pricing-table.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/pricing-table/plus-pricing-table.min.js',
				],
			],
		],
		'tp-pricing-table-style-1' => array(
			'dependency' => array(
				'css' => array(
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/pricing-table/plus-pricing-style-1.css',
				),
			),
		),
		'tp-pricing-table-style-2' => array(
			'dependency' => array(
				'css' => array(
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/pricing-table/plus-pricing-style-2.css',
				),
			),
		),
		'tp-pricing-table-style-3' => array(
			'dependency' => array(
				'css' => array(
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/pricing-table/plus-pricing-style-3.css',
				),
			),
		),
		'tp-pricing-ribbon' => array(
			'dependency' => array(
				'css' => array(
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/pricing-table/plus-table-ribbon.css',
				),
			),
		),
		'tp-product-listout' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/product-list/plus-product-list.css',					
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',     
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/product-listing/plus-product-listing.min.js',
				],
			],
		],
		'tp-product-listout-swatches' => [
			'dependency' => [
				'css' => [			
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-swatches/woo-swatches-front.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/woo-swatches/woo-swatches-front.js',					
				],
			],
		],
		'tp-product-listout-qcw' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/product-list/plus-product-list-yith.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/jquery.fancybox.min.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/product-listing/plus-product-listing-qcw.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.fancybox.min.js',
				],
			],
		],
		'tp-ajax-based-pagination' => [
			'dependency' => [
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/ajax-pagination/plus-ajax-pagination.min.js',				
				],
			],
		],
		'plus-product-listout-yithcss' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/product-list/plus-product-list-yith.css',
				],
			],
		],
		'plus-product-listout-quickview' => [
			'dependency' => [				
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/product-listing/plus-product-listing-yith-qcw.min.js',
				],
			],
		],
		'plus-key-animations' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-animation/plus-key-animations.min.css',
				],
			],
		],
		'tp-protected-content' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-extra-adv/plus-password-protected.css',
				],
			],
		],
		'tp-post-search' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/mailchimp/plus-mailchimp.css',
				],
			],
		],
		'tp-progress-bar' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/progress-piechart/plus-progress.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.waypoints.min.js',
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/progress-bar/plus-progress-bar.min.js',
				],
			],
		],
		'tp-piechart' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/progress-piechart/plus-piechart.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/circle-progress.js',
				],
			],
		],
		'tp-process-steps' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/process-steps/plus-process-steps.css',
				],
			],
		],
		'tp-process-bg' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/process-steps/plus-process-bg.css',
				],
			],
		],
		'tp-process-counter' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/process-steps/plus-process-counter.css',
				],
			],
		],
		'tp-process-steps-js' => [
			'dependency' => [
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/process-steps/plus-process-steps.min.js',
				],
			],
		],
		'tp-row-background' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/row-background/plus-row-background.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/row-background/plus-row-background.min.js',
				],
			],
		],
		'plus-vegas-gallery' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/vegas.css',					
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/vegas.js',
				],
			],
		],
		'plus-row-animated-color' => [
			'dependency' => [
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/effect.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/row-background/plus-row-animate-color.js',
				],
			],
		],
		'plus-row-segmentation' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/anime.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/segmentation.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/row-background/plus-row-segmentation.min.js',
				],
			],
		],
		'plus-row-scroll-color' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/scrolling_background_color.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/scrollmonitor.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/row-background/plus-scroll-bg-color.min.js',
				],
			],
		],
		'plus-row-canvas-particle' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/particles.min.js',
				],
			],
		],
		'plus-row-canvas-particleground' => [
			'dependency' => [
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.particleground.js', //canvas style 6
				],
			],
		],
		'plus-row-canvas-8' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/row-background/plus-row-canvas-style-8.min.js',
				],
			],
		],
		'tp-scroll-navigation' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/scroll-navigation/plus-scroll-navigation.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/pagescroll2id.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/scroll-navigation/plus-scroll-navigation.min.js',
				],
			],
		],
		'tp-scroll-navigation-style-1' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/scroll-navigation/plus-sn-style-1.css',
				],
			],
		],
		'tp-scroll-navigation-style-2' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/scroll-navigation/plus-scroll-style2.css',
				],
			],
		],
		'tp-scroll-navigation-style-3' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/scroll-navigation/plus-scroll-style3.css',
				],
			],
		],
		'tp-scroll-navigation-style-4' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/scroll-navigation/plus-scroll-style4.css',
				],
			],
		],
		'tp-scroll-navigation-style-5' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/scroll-navigation/plus-scroll-style5.css',
				],
			],
		],
		'tp-display-counter' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/scroll-navigation/plus-counter-style.css',
				],
			],
		],
		'tp-scroll-sequence' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/scroll-sequence/tp-scroll-sequence.min.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/scroll-sequence/tp-scroll-sequence.min.js',
				],
			],
		],
		'tp-search-filter' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/search-filter/plus-search-filter.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/search-filter/plus-search-filter.min.js',
				],
			],
		],
		'tp-search-datepicker' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/datepicker.min.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/jsdelivr.daterangepicker.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/datepicker.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/moment.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/jsdelivr.daterangepicker.min.js',
				],
			],
		],
		'tp-search-slider' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/nouislider.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/nouislider.min.js',
				],
			],
		],
		'tp-search-bar' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/search-bar/plus-search-bar.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/search-bar/plus-search-bar.min.js',
				],
			],
		],
		'tp-shape-divider' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/shape-divider/plus-shape-divider.min.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/shape-divider/plus-shape-divider.min.js',
				],
			],
		],
		'tp-site-logo' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/site-logo/plus-site-logo.css',
				],		
			],
		],
		'tp-social-embed' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-embed/plus-social-embed.min.css',
				],		
			],
		],
		'tp-social-feed' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-feed/plus-social-feed.min.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/jquery.fancybox.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/social-feed/plus-social-feed.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.fancybox.min.js',
				],
			],
		],
		'tp-social-icon' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style.css',
				],				
			],
		],
		'tp-social-icon-style-1' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style-1.css',
				],				
			],
		],
		'tp-social-icon-style-2' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style-2.css',
				],				
			],
		],
		'tp-social-icon-style-3' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style-3.css',
				],				
			],
		],
		'tp-social-icon-style-4' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style-4.css',
				],				
			],
		],
		'tp-social-icon-style-5' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style-5.css',
				],				
			],
		],
		'tp-social-icon-style-6' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style-6.css',
				],				
			],
		],
		'tp-social-icon-style-7' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style-7.css',
				],				
			],
		],
		'tp-social-icon-style-8' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style-8.css',
				],				
			],
		],
		'tp-social-icon-style-9' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style-9.css',
				],				
			],
		],
		'tp-social-icon-style-10' => [	
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style-10.css',
				],				
			],
		],
		'tp-social-icon-style-11' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style-11.css',
				],				
			],
		],
		'tp-social-icon-style-12' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style-12.css',
				],				
			],
		],
		'tp-social-icon-style-13' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style-13.css',
				],				
			],
		],
		'tp-social-icon-style-14' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style-14.css',
				],				
			],
		],
		'tp-social-icon-style-15' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-icon/plus-social-icon-style-15.css',
				],				
			],
		],
		'tp-social-reviews' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-reviews/plus-social-reviews.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/social-reviews/plus-social-reviews.min.js',
				],
			],
		],
		'tp-social-reviews-style-1' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-reviews/plus-sr-style1.css',
				],
			],
		],
		'tp-social-reviews-style-2' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-reviews/plus-sr-style2.css',
				],
			],
		],
		'tp-social-reviews-style-3' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-reviews/plus-sr-style3.css',
				],
			],
		],
		'tp-social-sharing' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-sharing/plus-social-sharing.css',
				],
				'js' => [
					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/social-sharing/plus-social-sharing.min.js',
				],
			],
		],
		'tp-social-1-2-layout' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-sharing/plus-layout1-2.css',
				],
			],
		],
		'tp-social-toggle-style-1' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-sharing/plus-toggle.css',
				],
			],
		],
		'tp-social-toggle-style-2' => [
            'dependency' => [
                'css' => [
                    THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/social-sharing/plus-tooggle-2.css',
                ],
            ],
        ],
		'tp-style-list' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/stylist-list/plus-style-list.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/stylist-list/plus-stylist-list.min.js',
				],
			],
		],
		'tp-switcher' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/switcher/plus-switcher.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/switcher/plus-switcher.min.js',
				],
			],
		],
		'tp-syntax-highlighter' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/syntax-highlighter/plus-syntax-highlighter.css',
				],
			],
		],
		'tp-syntax-highlighter-icons' => [
			'dependency' => [
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/syntax-highlighter/tp-copy-dow-icons.js',
				],
			],
		],
		'prism_default' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/syntax-highlighter/plus-default-theme.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/syntax-highlighter/prism-default.js',
				],
			],
		],
		'prism_coy' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/syntax-highlighter/plus-copy-theme.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/syntax-highlighter/prism-coy.js',
				],
			],
		],
		'prism_dark' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/syntax-highlighter/plus-dark-theme.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/syntax-highlighter/prism-dark.js',
				],
			],
		],
		'prism_funky' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/syntax-highlighter/plus-funky-theme.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/syntax-highlighter/prism-funky.js',
				],
			],
		],
		'prism_okaidia' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/syntax-highlighter/plus-okaidia-theme.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/syntax-highlighter/prism-okaidia.js',
				],
			],
		],
		'prism_solarizedlight' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/syntax-highlighter/plus-solarized.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/syntax-highlighter/prism-solarizedlight.js',
				],
			],
		],
		'prism_tomorrownight' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/syntax-highlighter/plus-tomorrow-theme.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/syntax-highlighter/prism-tomorrownight.js',
				],
			],
		],
		'prism_twilight' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/syntax-highlighter/plus-twilight-theme.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/syntax-highlighter/prism-twilight.js',
				],
			],
		],
		'tp-table' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/data-table/plus-data-table.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.datatables.min.js',
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/data-table/plus-data-table.min.js',
				],
			],
		],
		'tp-table-content' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tocbot.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/table-content/plus-table-content.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tocbot.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/table-content/plus-table-content.min.js',
				],
			],
		],
		'tp-table-content-style-1' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/table-content/plus-content-style1.css',
				],
			],
		],
		'tp-table-content-style-2' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/table-content/plus-content-style2.css',
				],
			],
		],
		'tp-table-content-style-3' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/table-content/plus-content-style3.css',
				],
			],
		],
		'tp-table-content-style-4' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/table-content/plus-content-style4.css',
				],
			],
		],
		'tp-tabs-tours' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/tabs-tours/plus-tabs-tours.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/tabs-tours/plus-tabs-tours.min.js',
				],
			],
		],
		'tp-team-member-listout' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tp-bootstrap-grid.css',
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/team-member-list/plus-team-member-style.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',
				],
			],
		],
		'tp-team-member-style-1' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/team-member-list/plus-team-member-style-1.css',
				],
			],
		],
		'tp-team-member-style-2' => [
			'dependency' => [
				'css' => [					
				    THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/team-member-list/plus-team-member-style-2.css',
				],
			],
		],
		'tp-team-member-style-3' => [
			'dependency' => [
				'css' => [					
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/team-member-list/plus-team-member-style-3.css',
				],
			],
		],
		'tp-team-member-style-4' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/team-member-list/plus-team-member-style-4.css',
				],
			],
		],
		'tp-carousel-style' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel/plus-carousel.css',
				],
			],
		],
		'tp-carousel-style-1' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel/plus-carousel-style-1.css',
				],
			],
		],
		'tp-carousel-style-2' => [
			'dependency' => [
				'css' => [
					 THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel/plus-carousel-style-2.css',
				],
			],
		],
		'tp-carousel-style-3' => [
			'dependency' => [
				'css' => [
					 THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel/plus-carousel-style-3.css',
				],
			],
		],
		'tp-carousel-style-4' => [
			'dependency' => [
				'css' => [
					 THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel/plus-carousel-style-4.css',
				],
			],
		],
		'tp-carousel-style-5' => [
			'dependency' => [
				'css' => [
					 THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel/plus-carousel-style-5.css',
				],
			],
		],
		'tp-carousel-style-6' => [
			'dependency' => [
				'css' => [
					 THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel/plus-carousel-style-6.css',
				],
			],
		],
		'tp-carousel-style-7' => [
			'dependency' => [
				'css' => [
					 THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel/plus-carousel-style-7.css',
				],
			],
		],
		'tp-arrows-style' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/arrows/plus-arrows-style.css',
				],
			],
		],
		'tp-arrows-style-1' => [
			'dependency' => [
				'css' => [
					 THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/arrows/plus-arrows-style-1.css',
				],
			],
		],
		'tp-arrows-style-2' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/arrows/plus-arrows-style-2.css',
				],
			],
		],
		'tp-arrows-style-3' => [
			'dependency' => [
				'css' => [
					 THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/arrows/plus-arrows-style-3-4.css',
				],
			],
		],
		'tp-arrows-style-4' => [
			'dependency' => [
				'css' => [
					 THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/arrows/plus-arrows-style-3-4.css',
				],
			],
		],
		'tp-arrows-style-5' => [
			'dependency' => [
				'css' => [
					 THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/arrows/plus-arrows-style-5.css',
				],
			],
		],
		'tp-arrows-style-6' => [
			'dependency' => [
				'css' => [
					 THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/arrows/plus-arrows-style-6.css',
				],
			],
		],
		'tp-testimonial-listout' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tp-bootstrap-grid.css',
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/testimonial/plus-testimonial.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/testimonial/plus-testimonial.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',
				],
			],
		],
		'tp-testimonial-style-1' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/testimonial/plus-ts1.css',
				],
			],
		],
		'tp-testimonial-style-2' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/testimonial/plus-ts2.css',
				],
			],
		],
		'tp-testimonial-style-3' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/testimonial/plus-ts3.css',
				],
			],
		],
		'tp-testimonial-style-4' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/testimonial/plus-ts4.css',
				],
			],
		],
		'tp-timeline' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/timeline/plus-timeline.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/timeline/plus-timeline.min.js',					
				],
			],
		],
		'tp-timeline-animation' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.waypoints.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/velocity/velocity.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/velocity/velocity.ui.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-animation-load.min.js',				
				],
			],
		],
		'tp-timeline-masonry' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/isotope.pkgd.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/packery-mode.pkgd.min.js',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',	
				],
			],
		],
		'tp-timeline-style-1' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/timeline/plus-timeline-style-1.css',
				],
			],
		],
		'tp-timeline-style-2' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/timeline/plus-timeline-style-2.css',
				],
			],
		],
		'tp-unfold' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/unfold/plus-unfold.min.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/unfold/plus-unfold.min.js',
				],
			],
		],
		'tp-video-player' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/video-player/plus-video-player.css',
				],
				'js' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/video-player/plus-video-player.min.js',
				],
			],
		],
		'tp-dynamic-categories' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-categories/plus-dynamic-categories.css',
				],
			],
		],
		'tp-dynamic-categories-style_1' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-categories/dynamic-style-1.css',
				],
			],
		],
		'tp-dynamic-categories-style_2' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-categories/dynamic-style-2.css',
				],
			],
		],
		'tp-dynamic-categories-style_3' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-categories/dynamic-style-3.css',
				],
			],
		],
		'tp-dynamic-categories-st3' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/dynamic-category/plus-dynamic-category.min.js',	
				],
			],
		],
		'tp-wp-forms' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/forms-style/plus-wpforms-form.css',
				],
			],
		],
		'tp-woo-cart' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-cart/plus-woo-cart.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/woo-cart/plus-woo-cart.min.js',	
				],
			],
		],
		'tp-woo-checkout' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-checkout/plus-woo-checkout.min.css',
				],
			],
		],
		'tp-woo-compare' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-compare/plus-woo-compare.min.css',

				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/woo-compare/plus-woo-compare.min.js',
				],
			],
		],
		'tp-woo-compare-list' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-compare/plus-woo-compare-list.min.css',

				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/woo-compare/woo-compare-list.min.js',
				],
			],
		],
		'tp-woo-compare-count' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-compare/plus-woo-compare-count.min.css',

				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/woo-compare/woo-compare-count.min.js',
				],
			],
		],
		'tp-woo-compare-button' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/woo-compare/woo-compare-btn.min.js',
				],
			],
		],
		'tp-woo-multi-step' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/woo-multi-step/plus-woo-multi-step.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/woo-multi-step/plus-woo-multi-step.min.js',
				],
			],
		],
		'tp-woo-multi-step-style-1' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/woo-multi-step/plus-multi-step-s1.min.css',
				],
			],
		],
		'tp-woo-multi-step-style-2' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/woo-multi-step/plus-multi-step-s2.min.css',
				],
			],
		],
		'tp-woo-multi-step-style-3' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/woo-multi-step/plus-multi-step-s3.min.css',
				],
			],
		],
		'tp-woo-multi-step-style-4' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/woo-multi-step/plus-multi-step-s4.min.css',
				],
			],
		],
		'tp-woo-multi-step-style-5' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/woo-multi-step/plus-multi-step-s5.min.css',
				],
			],
		],
		'tp-woo-multi-step-coupon' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/woo-multi-step/plus-multi-step-coupon.min.js',
				],
			],
		],
		'tp-woo-multi-step-backend' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/woo-multi-step/plus-multi-step-backend.min.js',
				],
			],
		],
		'tp-woo-myaccount' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-my-account/plus-woo-my-account.css',
				],
			],
		],
		'tp-woo-wishlist' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-wishlist/plus-woo-wishlist.min.css',

				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/woo-wishlist/plus-woo-wishlist.min.js',
				],
			],
		],
		'tp-woo-wishlist-product-listing' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-wishlist/plus-woo-wishlist.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-product-woo-listing.min.js',
				],
			],
		],
		'tp-woo-wishlist-dynamic-listing' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-product-woo-listing.min.js'
				],
			],
		],
		'tp_ma_l_1' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-my-account/plus-account-style1.css',
				],
			],
		],
		'tp_ma_l_2' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-my-account/plus-account-style2.css',
				],
			],
		],
		'tp-woo-order-track' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-order-track/plus-woo-order-track.min.css',
				],			
			],
		],
		'tp-woo-single-basic' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-single-basic/plus-woo-single-basic.min.css',
				],
			],
		],
		'tp-woo-single-pricing' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-single-pricing/plus-woo-single-pricing.min.css',
				],				
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/woo-single-pricing/plus-add-to-cart.min.js',
				],
			],
		],
		'tp-woo-single-price-progress' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-single-pricing/plus-woo-single-pricing-progress.min.css',
				],				
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/woo-single-pricing/plus-woo-single-price-progress.min.js',
				],
			],
		],
		'tp-woo-single-image' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-single-image/plus-woo-single-image.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/isotope.pkgd.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',
				],
			],
		],		
		'tp-single-style_1' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-single-image/plus-image-style1.css',
				],
			],
		],
		'tp-single-style_3' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-single-image/plus-image-style2.css',
				],
			],
		],
		'tp-single-hover' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-single-image/plus-image-hover.css',
				],
			],
		],
		'tp-woo-single-tabs' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-single-tabs/plus-woo-single-tabs.min.css',
				],
			],
		],
		'tp-woo-thank-you' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/woo-thank-you/plus-woo-thank-you.min.css',
				],
			],
		],
		'tp-product-recent-view' => [
            'dependency' => [
                'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-product-woo-listing.min.js'
                ],
            ],
        ],
		'tp-wp-quickview' => [
            'dependency' => [
                'css' => [
                    THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/jquery.fancybox.min.css',
                    THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/wp-quick-view/plus-wp-quick-view.min.css',
                ],
                'js' => [
                    THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.fancybox.min.js',
                    THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/wp-quick-view/plus-wp-quick-view.min.js',
                ],
            ],
        ],
		'tp-wp-login-register' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/wp-login-register/plus-wp-login-register.min.css',
				],
			],
		],
		'tp-wp-login-register-ex' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/login-register/plus-login-register.min.js',
				],
			],
		],
		'plus-lottie-player' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/lottie-player.js',
				],
			],
		],
		'plus-velocity' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.waypoints.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/velocity/velocity.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/velocity/velocity.ui.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-animation-load.min.js',
				],
			],
		],
		'plus-alignmnet-effect' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/main/plus-extra-adv/plus-alignmnet.css',
				],
			],
		],
		'plus-responsive-visibility' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/main/plus-extra-adv/plus-responsive-visibility.css',
				],
			],
		],
		'plus-widget-error' => [
			'dependency' => [
				'css' => [
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/main/plus-extra-adv/plus-widget-error.css',
				],
			],
		],
		'plus-magic-scroll' => [
			'dependency' => [
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/timelinemax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/tweenmax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/scrollmagic/scrollmagic.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/scrollmagic/animation.gsap.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-magic-scroll.min.js',
				],
			],
		],
		'plus-tooltip' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tippy.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tippy.all.min.js',
				],
			],
		],
		'plus-mousemove-parallax' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/tweenmax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-mouse-move-parallax.min.js',
				],
			],
		],
		'plus-tilt-parallax' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-animation/plus-tilt-animation.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tilt.jquery.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-tilt-parallax.min.js',
				],
			],
		],
		'plus-reveal-animation' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-extra-adv/plus-reveal-animate.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.waypoints.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-reveal-animation.min.js',
				],
			],
		],
		'plus-floating-animation' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-continues-effect/plus-floating-animation.css',
				],
			],
		],
		'plus-pulse-animation' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-continues-effect/plus-pulse-animation.css',
				],
			],
		],
		'plus-tossing-animation' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-continues-effect/plus-tossing-animation.css',
				],
			],
		],
		'plus-drop-waves-animation' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-continues-effect/plus-drop-waves.css',
				],
			],
		],
		'plus-rotating-animation' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-continues-effect/plus-rotating-animation.css',
				],
			],
		],
		'plus-continue-scale-animation' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-continues-effect/plus-kenburns-animation.css',
				],
			],
		],
		'plus-content-hover-effect' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-extra-adv/plus-content-hover-effect.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-content-hover-effect.min.js',
				],
			],
		],
		'plus-carousel' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/slick.min.css',
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/carousel/plus-carousel.css'
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/slick.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-slick-carousel.min.js',
				],
			],
		],
		'plus-imagesloaded' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',
				],
			],
		],
		'plus-isotope' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/isotope.pkgd.js',
				],
			],
		],
		'plus-hover3d' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.hover3d.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-hover-tilt.js',
				],
			],
		],
		'plus-wavify' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/tweenmax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/wavify.js',
				],
			],
		],
		'plus-lity-popup' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/lity.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-extra-adv/plus-lity.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/lity.min.js',
				],
			],
		],
		'plus-extras-column' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-extra-adv/plus-sticky-column.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/resizesensor.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/sticky-sidebar.min.js',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/column-stickly/plus-column-stickly.min.js',
				],
			],
		],
		'plus-equal-height' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/equal-height/plus-equal-height.min.js',
				],
			],
		],
		'plus-section-column-link' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/section-column-link/plus-section-column-link.min.js',
				],
			],
		],
		'plus-event-tracker' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/event-tracker/plus-event-tracker.min.js',
				],
			],
		],
		'plus-lazyLoad' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/lazy_load/tp-lazy_load.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/lazyload.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/lazy_load/tp-lazy_load.js',
				],
			],
		],
		'plus-column-cursor' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/mouse-cursor/plus-mouse-cursor.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/mouse-cursor/plus-mouse-cursor.min.js',
				],
			],
		],
		'plus-extras-section-skrollr' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/skrollr.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-section-skrollr.min.js',
				],
			],
		],
		'plus-adv-typo-extra-js-css' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/imagerevealbase.css',
				],
				'js' => [										
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/charming.min.js',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/tweenmax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagerevealdemo.js',
				],
			],
		],
		'plus-swiper' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/swiper-bundle.min.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/swiper-bundle.min.js',
				],
			],
		],
		'plus-listing-load-more' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/listing-extra/ajax-load-more.css',
				],
			],
		],
		'plus-backend-editor' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tippy.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/plus-extra-adv/plus-content-hover-effect.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/swiper-bundle.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.waypoints.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/general/modernizr.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/velocity/velocity.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/velocity/velocity.ui.js',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tilt.jquery.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tippy.all.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/timelinemax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/tweenmax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/jquery-parallax.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/scrollmagic/scrollmagic.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/scrollmagic/animation.gsap.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/plus-extra-adv/plus-backend-editor.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-animation-load.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-magic-scroll.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-mouse-move-parallax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-reveal-animation.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-content-hover-effect.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/splittext.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/heading-title/plus-heading-title.min.js',
					L_THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/admin/tp-advanced-shadow-layout.js',
				],
			],
		],
	];
	
}