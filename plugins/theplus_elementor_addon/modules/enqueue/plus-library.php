<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

Class Plus_Library
{
	/**
	 * A reference to an instance of this class.
	 *
	 * @since 1.0.0
	 * @var   object
	 */	
	private static $instance = null;
	
	public $registered_widgets;
	public $get_plus_pro_widget_settings;
    /**
     *  Return array of registered elements.
     *
     * @todo filter output
     */	 
    public function get_registered_widgets()
    {
        return array_keys($this->registered_widgets);
    }
	
	public function __construct(){
		$this->get_plus_widget_settings();
		add_filter('plus_widget_setting', array( $this,'plus_pro_widget_setting'));
	}
	
	public function plus_pro_widget_setting($args){
		$args = array_merge($this->get_plus_pro_widget_settings, $args); 
		return $args;
	}
    /**
     * Return saved settings
     *
     * @since 2.0
     */
    public function get_plus_widget_settings($element = null)
    {
		$replace = [
			'tp_smooth_scroll' => 'tp-smooth-scroll',
			'tp_accordion' => 'tp-accordion',
			'tp_adv_text_block' => 'tp-adv-text-block',
			'tp_advanced_typography' => 'tp-advanced-typography',
			'tp_advanced_buttons' => 'tp-advanced-buttons',
			'tp_age_gate' => 'tp-age-gate',
			'tp_animated_service_boxes' => 'tp-animated-service-boxes',
			'tp_advertisement_banner' => 'tp_advertisement_banner',
			'tp_audio_player' => 'tp-audio-player',
			'tp_before_after' => 'tp-before-after',
			'tp_blockquote' => 'tp-blockquote',
			'tp_blog_listout' => 'tp-blog-listout',
			'tp_dynamic_smart_showcase' => 'tp-dynamic-smart-showcase',
			'tp_breadcrumbs_bar' => 'tp-breadcrumbs-bar',
			'tp_button' => 'tp-button',
			'tp_carousel_anything' => 'tp-carousel-anything',
			'tp_carousel_remote' => 'tp-carousel-remote',
			'tp_caldera_forms' => 'tp-caldera-forms',
			'tp_cascading_image' => 'tp-cascading-image',
			'tp_chart' => 'tp-chart',
			'tp_circle_menu' => 'tp-circle-menu',
			'tp_clients_listout' => 'tp-clients-listout',
			'tp_contact_form_7' => 'tp-contact-form-7',
			'tp_countdown' => 'tp-countdown',
			'tp_coupon_code' => 'tp-coupon-code',
			'tp_dark_mode' => 'tp-dark-mode',
			'tp_draw_svg' => 'tp-draw-svg',
			'tp_dynamic_device' => 'tp-dynamic-device',
			'tp_dynamic_listing' => 'tp-dynamic-listing',			
			'tp_everest_form' => 'tp-everest-form',
			'tp_flip_box' => 'tp-flip-box',
			'tp_gallery_listout' => 'tp-gallery-listout',
			'tp_google_map' => 'tp-google-map',
			'tp_gravity_form' => 'tp-gravityt-form',			
			'tp_heading_animation' => 'tp-heading-animation',
			'tp_header_extras' => 'tp-header-extras',
			'tp_heading_title' => 'tp-heading-title',
			'tp_hotspot' => 'tp-hotspot',
			'tp_hovercard' => 'tp-hovercard',
			'tp_horizontal_scroll_advance' => 'tp-horizontal-scroll-advance',
			'tp_image_factory' => 'tp-image-factory',
			'tp_info_box' => 'tp-info-box',
			'tp_mailchimp' => 'tp-mailchimp-subscribe',
			'tp_messagebox' => 'tp-messagebox',
			'tp_mobile_menu' => 'tp-mobile-menu',			
			'tp_morphing_layouts' => 'tp-morphing-layouts',
			'tp_mouse_cursor' => 'tp-mouse-cursor',
			'tp_navigation_menu_lite' => 'tp-navigation-menu-lite',
			'tp_navigation_menu' => 'tp-navigation-menu',
			'tp_ninja_form' => 'tp-ninja-form',
			'tp_number_counter' => 'tp-number-counter',
			'tp_post_title' => 'tp-post-title',
			'tp_post_content' => 'tp-post-content',
			'tp_post_featured_image' => 'tp-post-featured-image',
			'tp_post_meta' => 'tp-post-meta',
			'tp_post_author' => 'tp-post-author',
			'tp_post_comment' => 'tp-post-comment',
			'tp_post_navigation' => 'tp-post-navigation',
			'tp_off_canvas' => 'tp-off-canvas',
			'tp_page_scroll' => 'tp-page-scroll',
			'tp_pre_loader' => 'tp-pre-loader',
			'tp_pricing_list' => 'tp-pricing-list',
			'tp_pricing_table' => 'tp-pricing-table',
			'tp_product_listout' => 'tp-product-listout',
			'tp_protected_content' => 'tp-protected-content',
			'tp_post_search' => 'tp-post-search',
			'tp_progress_bar' => 'tp-progress-bar',
			'tp_process_steps' => 'tp-process-steps',
			'tp_row_background' => 'tp-row-background',
			'tp_scroll_navigation' => 'tp-scroll-navigation',
			'tp_scroll_sequence' => 'tp-scroll-sequence',
			'tp_search_filter' => 'tp-search-filter',
			'tp_search_bar' => 'tp-search-bar',
			'tp_site_logo' => 'tp-site-logo',
			'tp_shape_divider' => 'tp-shape-divider',
			'tp_social_embed' => 'tp-social-embed',
			'tp_social_feed' => 'tp-social-feed',
			'tp_social_icon' => 'tp-social-icon',
			'tp_social_reviews' => 'tp-social-reviews',
			'tp_social_sharing' => 'tp-social-sharing',
			'tp_style_list' => 'tp-style-list',
			'tp_switcher' => 'tp-switcher',
			'tp_syntax_highlighter' => 'tp-syntax-highlighter',
			'tp_table' => 'tp-table',
			'tp_table_content' => 'tp-table-content',
			'tp_tabs_tours' => 'tp-tabs-tours',
			'tp_team_member_listout' => 'tp-team-member-listout',
			'tp_testimonial_listout' => 'tp-testimonial-listout',
			'tp_timeline' => 'tp-timeline',
			'tp_video_player' => 'tp-video-player',
			'tp_unfold' => 'tp-unfold',
			'tp_dynamic_categories' => 'tp-dynamic-categories',
			'tp_wp_forms' => 'tp-wp-forms',
			'tp_woo_cart' => 'tp-woo-cart',
			'tp_woo_checkout' => 'tp-woo-checkout',
			'tp_woo_compare' => 'tp-woo-compare',
			'tp_woo_multi_step' => 'tp-woo-multi-step',
			'tp_woo_myaccount' => 'tp-woo-myaccount',
			'tp_woo_order_track' => 'tp-woo-order-track',
			'tp_woo_single_basic' => 'tp-woo-single-basic',
			'tp_woo_single_image' => 'tp-woo-single-image',
			'tp_woo_single_pricing' => 'tp-woo-single-pricing',
			'tp_woo_single_tabs' => 'tp-woo-single-tabs',
			'tp_woo_thank_you' => 'tp-woo-thank-you',
			'tp_woo_wishlist' => 'tp-woo-wishlist',
			'tp_wp_quickview' => 'tp-wp-quickview',
			'tp_wp_login_register' => 'tp-wp-login-register',
			'tp_custom_field' => 'tp-custom-field',
        ];
		$merge = [
			'plus-backend-editor',
		];

		$elements=theplus_get_option('general','check_elements');
		if(empty($elements)){
			$elements = array_keys($replace);
		}

		$plus_extras=theplus_get_option('general','extras_elements');
		$elements = array_map(function ($val) use ($replace) {
		    return (array_key_exists($val, $replace) ? $replace[$val] : $val);
        }, $elements);

		if( ! empty( $elements ) ){
			$merge[] = 'plus-floating-animation';
			$merge[] = 'plus-pulse-animation';
			$merge[] = 'plus-tossing-animation';
			$merge[] = 'plus-drop-waves-animation';
			$merge[] = 'plus-rotating-animation';
			$merge[] = 'plus-reveal-animation';
			$merge[] = 'plus-continue-scale-animation';
			$merge[] = 'plus-alignmnet-effect';
			$merge[] = 'tp-woo-single-price-progress';
		}

		if(in_array('tp-age-gate',$elements)){
			$merge[] = 'tp-age-gate';
			$merge[] = 'tp-age-gate-method-1';
			$merge[] = 'tp-age-gate-method-2';
			$merge[] = 'tp-age-gate-method-3';
		}

		if(in_array('tp-audio-player',$elements)){
			$merge[]= 'tp-audio-player';
			$merge[]= 'tp-audio-player-style-1';
			$merge[]= 'tp-audio-player-style-2';
			$merge[]= 'tp-audio-player-style-3';
			$merge[]= 'tp-audio-player-style-4';
			$merge[]= 'tp-audio-player-style-5';
			$merge[]= 'tp-audio-player-style-6';
			$merge[]= 'tp-audio-player-style-7';
			$merge[]= 'tp-audio-player-style-8';
			$merge[]= 'tp-audio-player-style-9';
		}

		if(in_array('tp-coupon-code',$elements)){
			$merge[] = 'tp-coupon-code';
			$merge[] = 'tp-coupon-standard';
			$merge[] = 'tp-coupon-peel';
			$merge[] = 'tp-coupon-scratch';	
			$merge[] = 'tp-coupon-slideOut';
		}
		
		if(in_array('tp-google-map',$elements)){
			$merge[] = 'tp-google-map';
			$merge[] = 'tp-map-googlemap';
			$merge[] = 'tp-map-osm';
		}

		if(in_array('tp-pricing-list',$elements)){
			$merge[] = 'tp-pricing-list';
			$merge[] = 'tp-pricing-list-style_1';
			$merge[] = 'tp-pricing-list-style_2';
			$merge[] = 'tp-pricing-list-style_3';
		}

		if(in_array('tp-social-sharing',$elements)){
			$merge[] = 'tp-social-sharing';
			$merge[] = 'tp-social-1-2-layout';
			$merge[] = 'tp-social-toggle-style-1';
			$merge[] = 'tp-social-toggle-style-2';
		}

		if(in_array('tp-table-content',$elements)){
			$merge[] = 'tp-table-content';
			$merge[] = 'tp-table-content-style-1';
			$merge[] = 'tp-table-content-style-2';
			$merge[] = 'tp-table-content-style-3';
			$merge[] = 'tp-table-content-style-4';
		}

		if(in_array('tp-advanced-buttons',$elements) ){
			$merge[]='tp-advanced-buttons';
			$merge[]='tp_cta_st_1';
			$merge[]='tp_cta_st_2';
			$merge[]='tp_cta_st_3';
			$merge[]='tp_cta_st_4';
			$merge[]='tp_cta_st_5';
			$merge[]='tp_cta_st_6';
			$merge[]='tp_cta_st_7';
			$merge[]='tp_cta_st_8';
			$merge[]='tp_cta_st_9';
			$merge[]='tp_cta_st_10';
			$merge[]='tp_cta_st_11';
			$merge[]='tp_cta_st_12';
			$merge[]='tp_cta_st_13';
			$merge[]='tp_cta_st_14';
			$merge[]='tp_download_st_1';
			$merge[]='tp_download_st_2';
			$merge[]='tp_download_st_3';
			$merge[]='tp_download_st_4';
			$merge[]='tp_download_st_5';
			$merge[]='tp-advanced-buttons-js';
		}

		if(in_array('tp_advertisement_banner',$elements)){
			$merge[]= 'tp_advertisement_banner';
			$merge[]= 'tp_add_banner-style-1';
			$merge[]= 'tp_add_banner-style-2';
			$merge[]= 'tp_add_banner-style-3';
			$merge[]= 'tp_add_banner-style-4';
			$merge[]= 'tp_add_banner-style-5';
			$merge[]= 'tp_add_banner-style-6';
			$merge[]= 'tp_add_banner-style-7';
			$merge[]= 'tp_add_banner-style-8';
		}

		if(in_array('tp-advanced-typography',$elements)){
			$merge[]= 'tp-advanced-circle';
		}

		if(in_array('tp-search-filter',$elements)){
			$merge[]= 'tp-search-datepicker';
			$merge[]= 'tp-search-slider';
		}

		if(in_array('tp-header-extras',$elements)){
			$merge[]= 'tp-header-audio';
		}

		if(in_array('tp-morphing-layouts',$elements)){
			$merge[]= 'tp-morphing-scroll';
		}

		if(in_array('tp-navigation-menu',$elements)){
			$merge[]= 'tp-navigation-scroll';
		}

		$tmp_widget = true;
		$tp_widget = ['tp-button', 'tp-flip-box', 'tp-info-box', 'tp-pricing-table', 'tp-blog-listout','tp_advertisement_banner','tp-animated-service-boxes','tp-timeline','tp-product-listout','tp-dynamic-listing','tp-table'];
		foreach ($tp_widget as $value) {
			if(!empty($tmp_widget) && in_array( $value ,$elements)){
				$merge[]= 'tp-button';
				$merge[]= 'tp-button-style-1';
				$merge[]= 'tp-button-style-2';
				$merge[]= 'tp-button-style-3';
				$merge[]= 'tp-button-style-4';
				$merge[]= 'tp-button-style-5';
				$merge[]= 'tp-button-style-6';
				$merge[]= 'tp-button-style-7';
				$merge[]= 'tp-button-style-8';
				$merge[]= 'tp-button-style-9';
				$merge[]= 'tp-button-style-10';
				$merge[]= 'tp-button-style-11';
				$merge[]= 'tp-button-style-12';
				$merge[]= 'tp-button-style-13';
				$merge[]= 'tp-button-style-14';
				$merge[]= 'tp-button-style-15';
				$merge[]= 'tp-button-style-16';
				$merge[]= 'tp-button-style-17';
				$merge[]= 'tp-button-style-18';
				$merge[]= 'tp-button-style-19';	
				$merge[]= 'tp-button-style-20';
				$merge[]= 'tp-button-style-21';
				$merge[]= 'tp-button-style-22';
				/**$merge[]= 'tp-button-style-23'; */ 
			    $merge[]= 'tp-button-style-24';

				$tmp_widget = false; 
			}
		}

		if(in_array('tp-animated-service-boxes',$elements)){
			$merge[] = 'tp-animated-service-boxes';
			$merge[] = 'tp-image-accordion';
			$merge[] = 'tp-image-accordion-style-2';
			$merge[] = 'tp-sliding-boxes';
			$merge[] = 'tp-article-box-style-1';
			$merge[] = 'tp-article-box-style-2';
			$merge[] = 'tp-info-banner-style-1';
			$merge[] = 'tp-info-banner-style-2';
			$merge[] = 'tp-hover-section';
			$merge[] = 'tp-fancy-box';
			$merge[] = 'tp-services-element';
			$merge[] = 'tp-services-element-style-1';
			$merge[] = 'tp-services-element-style-2';
			$merge[] = 'tp-portfolio-style-1';
			$merge[] = 'tp-portfolio-style-2';
		}

		if(in_array('tp-messagebox',$elements)){
			$merge[] = 'tp-messagebox-js';
		}

		if(in_array('tp-carousel-remote',$elements)){
			$merge[] = 'tp-carousel-remote';
			$merge[] = 'tp-carousel-tooltip';
			$merge[] = 'tp-carousel-pagination';
			$merge[] = 'tp-carousel-dot';
			$merge[] = 'tp-plus-horizontal-connection';
		}

		if(in_array('tp-process-steps',$elements)){
			$merge[] = 'tp-process-bg';
			$merge[] = 'tp-process-counter';
			$merge[] = 'tp-process-steps-js';
		}

		if(in_array('tp-timeline',$elements)){
			$merge[] = 'tp-timeline';
			$merge[] = 'tp-timeline-style-1';
			$merge[] = 'tp-timeline-style-2';
			$merge[] = 'tp-timeline-animation';
			$merge[] = 'tp-timeline-masonry';
		}

		if(in_array('tp-social-reviews',$elements)){
			$merge[] = 'tp-social-reviews';
			$merge[] = 'tp-social-reviews-style-1';
			$merge[] = 'tp-social-reviews-style-2';
			$merge[] = 'tp-social-reviews-style-3';
		}

		if(in_array('tp-breadcrumbs-bar',$elements)){
			$merge[] = 'tp-breadcrumbs-bar';
			$merge[] = 'tp-breadcrumbs-bar-style_1';
			$merge[] = 'tp-breadcrumbs-bar-style_2';
		}

		$notice_flag = true;
		$notice_style = ['tp-horizontal-scroll-advance','tp-scroll-sequence','tp-table'];
		foreach ($notice_style as $value) {
			if(!empty($notice_flag) && in_array( $value ,$elements)){
				$merge[] = 'plus-widget-error';
				$notice_flag = false; 
			}
		}

		$filter_opt = true;

        $tp_filter = ['tp-blog-listout','tp-clients-listout','tp-dynamic-listing','tp-gallery-listout','tp-product-listout','tp-social-reviews','tp-social-feed','tp-team-member-listout','tp-dynamic-smart-showcase'];
        foreach ($tp_filter as $value) {
            
            if( !empty( $filter_opt ) && in_array( $value ,$elements )){
                $merge[] = 'plus-post-filter';
                $merge[] = 'plus-post-filter-style-1';
                $merge[] = 'plus-post-filter-style-2';
                $merge[] = 'plus-post-filter-style-3';
                $merge[] = 'plus-post-filter-style-4';

                $merge[] = 'plus-post-filter-h-style-1';
                $merge[] = 'plus-post-filter-h-style-2';
                $merge[] = 'plus-post-filter-h-style-3';
                $merge[] = 'plus-post-filter-h-style-4';

                $filter_opt = false; 
            }
        }

		/** carousel & arrows*/
		$carousel_flag = true;
		$carousel_style = ['tp-carousel-anything','tp-testimonial-listout','tp-dynamic-smart-showcase','tp-dynamic-listing','tp-social-feed','tp-social-reviews','tp-clients-listout','tp-dynamic-device','tp-gallery-listout','tp-product-listout','tp-team-member-listout','tp-dynamic-categories','tp-info-box','tp-blog-listout'];
		foreach ($carousel_style as $value) {
			if(!empty($carousel_flag) && in_array( $value ,$elements)){
				$merge[] = 'tp-carousel-style';
				$merge[] = 'tp-carousel-style-1';
				$merge[] = 'tp-carousel-style-2';
				$merge[] = 'tp-carousel-style-3';
				$merge[] = 'tp-carousel-style-4';
				$merge[] = 'tp-carousel-style-5';
				$merge[] = 'tp-carousel-style-6';
				$merge[] = 'tp-carousel-style-7';

				$merge[] = 'tp-arrows-style';
				$merge[] = 'tp-arrows-style-1';
				$merge[] = 'tp-arrows-style-2';
				$merge[] = 'tp-arrows-style-3';
				$merge[] = 'tp-arrows-style-4';
				$merge[] = 'tp-arrows-style-5';
				$merge[] = 'tp-arrows-style-6';
				$carousel_flag = false; 
			}
		}

		if(in_array('tp-gallery-listout',$elements)){
			$merge[] = 'plus-listing-masonry';
			$merge[] = 'plus-carousel';
			$merge[] = 'plus-listing-metro';
			$merge[] = 'tp-gallery-listout-style-1';
			$merge[] = 'tp-gallery-listout-style-2';
			$merge[] = 'tp-gallery-listout-style-3';
			$merge[] = 'tp-gallery-listout-style-4';
		}

		if(in_array('tp-testimonial-listout',$elements)){
			$merge[] = 'plus-listing-masonry';
			$merge[] = 'plus-carousel';
			$merge[] = 'tp-testimonial-listout';
			$merge[] = 'tp-testimonial-style-1';
			$merge[] = 'tp-testimonial-style-2';
			$merge[] = 'tp-testimonial-style-3';
			$merge[] = 'tp-testimonial-style-4';
		}

		if(in_array('tp-scroll-navigation',$elements)){
			$merge[] = 'tp-scroll-navigation';
			$merge[] = 'tp-scroll-navigation-style-1';
			$merge[] = 'tp-scroll-navigation-style-2';
			$merge[] = 'tp-scroll-navigation-style-3';
			$merge[] = 'tp-scroll-navigation-style-4';
			$merge[] = 'tp-scroll-navigation-style-5';
			$merge[] = 'tp-display-counter';
		}

		if(in_array('tp-flip-box',$elements)){
			$merge[] = 'plus-responsive-visibility';
		}

		if(in_array('tp-info-box',$elements)){
			$merge[] = 'tp-info-box';
			$merge[] = 'tp-info-box-style_1';
			$merge[] = 'tp-info-box-style_2';
			$merge[] = 'tp-info-box-style_3';
			$merge[] = 'tp-info-box-style_4';
			$merge[] = 'tp-info-box-style_7';
			$merge[] = 'tp-info-box-style_11';
			$merge[] = 'tp-bg-hover-ani';
			$merge[] = 'plus-responsive-visibility';
		}

		if(in_array('tp-woo-compare',$elements)){
			$merge[] = 'tp-woo-compare';
			$merge[] = 'tp-woo-compare-list';
			$merge[] = 'tp-woo-compare-count';
			$merge[] = 'tp-woo-compare-button';
		}

		if(in_array('tp-woo-multi-step',$elements)){
			$merge[] = 'tp-woo-multi-step';
			$merge[] = 'tp-woo-multi-step-style-1';
			$merge[] = 'tp-woo-multi-step-style-2';
			$merge[] = 'tp-woo-multi-step-style-3';
			$merge[] = 'tp-woo-multi-step-style-4';
			$merge[] = 'tp-woo-multi-step-style-5';
			$merge[] = 'tp-woo-multi-step-backend';
		} 

		if(in_array('tp-woo-myaccount',$elements)){
			$merge[] = 'tp-woo-myaccount';
			$merge[] = 'tp_ma_l_1';
			$merge[] = 'tp_ma_l_2';
		}

		if(in_array('tp-woo-single-image',$elements)){
			$merge[] = 'tp-single-style_1';
			$merge[] = 'tp-single-style_3';
			$merge[] = 'tp-single-hover';
		}

		if(in_array('tp-woo-single-pricing',$elements)){
			$merge[] = 'tp-woo-single-price-progress';
		}

		if(in_array('tp-woo-wishlist',$elements)){
			$merge[] = 'tp-woo-wishlist-product-listing';
			$merge[] = 'tp-woo-wishlist-dynamic-listing';
		}

		if(in_array('tp-blockquote',$elements)){
			$merge[] = 'tp-blockquote';
			$merge[] = 'tp-blockquote-bl_1';
			$merge[] = 'tp-blockquote-bl_2';
			$merge[] = 'tp-blockquote-bl_3';
		}

		if(in_array('tp-countdown',$elements)){
			$merge[] = 'tp-countdown';
			$merge[] = 'tp-countdown-style-1';
			$merge[] = 'tp-countdown-style-2';
			$merge[] = 'tp-countdown-style-3';
		}

		if(in_array('tp-heading-title',$elements)){
			$merge[]= 'tp-heading-title';
			$merge[]= 'tp-heading-title-style_1';
			$merge[]= 'tp-heading-title-style_2';
			$merge[]= 'tp-heading-title-style_3';
			$merge[]= 'tp-heading-title-style_4';
			$merge[]= 'tp-heading-title-style_5';
			$merge[]= 'tp-heading-title-style_6';
			$merge[]= 'tp-heading-title-style_7';
			$merge[]= 'tp-heading-title-style_8';
			$merge[]= 'tp-heading-title-style_9';
			$merge[]= 'tp-heading-title-style_10';
			$merge[]= 'tp-heading-title-style_11';
		}

		if(in_array('tp-progress-bar',$elements)){
			$merge[] = 'tp-progress-bar';
			$merge[] = 'tp-piechart';
		}

		if(in_array('tp-social-icon',$elements)){
			$merge[] = 'tp-social-icon';
			$merge[] = 'tp-social-icon-style-1';
			$merge[] = 'tp-social-icon-style-2';
			$merge[] = 'tp-social-icon-style-3';
			$merge[] = 'tp-social-icon-style-4';
			$merge[] = 'tp-social-icon-style-5';
			$merge[] = 'tp-social-icon-style-6';
			$merge[] = 'tp-social-icon-style-7';
			$merge[] = 'tp-social-icon-style-8';
			$merge[] = 'tp-social-icon-style-9';
			$merge[] = 'tp-social-icon-style-10';
			$merge[] = 'tp-social-icon-style-11';
			$merge[] = 'tp-social-icon-style-12';
			$merge[] = 'tp-social-icon-style-13';
			$merge[] = 'tp-social-icon-style-14';
			$merge[] = 'tp-social-icon-style-15';
		}

		if ( in_array( 'tp-pricing-table', $elements ) ) {
			$merge[] = 'tp-pricing-table';
			$merge[] = 'tp-pricing-table-style-1';
			$merge[] = 'tp-pricing-table-style-2';
			$merge[] = 'tp-pricing-table-style-3';
			$merge[] = 'tp-pricing-ribbon';
		}

		if(in_array('tp-shape-divider',$elements)){
			$merge[]= 'plus-wavify';
		}

		if(in_array('tp-dynamic-listing',$elements) || in_array('tp-product-listout',$elements)){
			$merge[]= 'tp-ajax-based-pagination';
		}

		if(in_array('tp-dynamic-listing',$elements)){
			$merge[]= 'tp-custom-field';
		}
			
		if(in_array('tp_advertisement_banner',$elements) || in_array('tp-cascading-image',$elements)){
			$merge[]= 'plus-hover3d';
		}

		if(in_array('tp-row-background',$elements)){
			$merge[]= 'plus-vegas-gallery';
			$merge[]= 'plus-row-animated-color';
			$merge[]= 'plus-row-segmentation';
			$merge[]= 'plus-row-scroll-color';
			$merge[]= 'plus-row-canvas-particle';
			$merge[]= 'plus-row-canvas-particleground';
			$merge[]= 'plus-row-canvas-8';
		}

		if(in_array('tp-number-counter',$elements)){
			$merge[]= 'tp-number-counter';
			$merge[]= 'tp-number-counter-style-1';
			$merge[]= 'tp-number-counter-style-2';
			$merge[]= 'tp-draw-svg';
		}

		if(in_array('tp-blog-listout',$elements)){
			$merge[] = 'plus-listing-masonry';
			$merge[] = 'plus-carousel';
			$merge[] = 'plus-listing-metro';
			$merge[] = 'plus-pagination';

			$merge[] = 'tp-bloglistout-preloder';
			$merge[] = 'tp-blog-listout';
			$merge[] = 'tp-bloglistout-style-2';
			$merge[] = 'tp-bloglistout-style-3';
			$merge[] = 'tp-bloglistout-style-4';
			$merge[] = 'plus-listing-load-more';
		}
		if(in_array('tp-dynamic-smart-showcase',$elements)){
			$merge[] = 'plus-carousel';
			$merge[] = 'tp-dynamic-smart-showcase';
			$merge[] = 'tp-dynamic-smart-showcase-mag_one_2_2';
			$merge[] = 'tp-dynamic-smart-showcase-mag_one_1_2_v';
			$merge[] = 'tp-dynamic-smart-showcase-mag_one_1_2_h';
			$merge[] = 'tp-dynamic-smart-showcase-mag_rows_2';
			$merge[] = 'tp-dynamic-smart-showcase-mag_four_x_rows_1';
			$merge[] = 'tp-dynamic-smart-showcase-mag_two_3_v';
			$merge[] = 'tp-dynamic-smart-showcase-mag_two_1_2';
			$merge[] = 'tp-dynamic-smart-showcase-mag_two_4';

			$merge[] = 'tp-dynamic-smart-showcase-post-ticker';
		}

		if ( in_array( 'tp-heading-animation', $elements ) ) {
			$merge[] = 'tp-heading-animation';
			$merge[] = 'tp-heading-animation-style-1';
			$merge[] = 'tp-heading-animation-style-2';
			$merge[] = 'tp-heading-animation-style-3';
			$merge[] = 'tp-heading-animation-style-4';
			$merge[] = 'tp-heading-animation-style-5';
			$merge[] = 'tp-heading-animation-style-6';
		}

		if(in_array('tp-dynamic-listing',$elements)){
			$merge[] = 'plus-listing-masonry';
			$merge[] = 'plus-carousel';
			$merge[] = 'plus-listing-metro';
			$merge[] = 'plus-pagination';
			$merge[] = 'plus-listing-load-more';
		}
		if((in_array('tp-social-feed',$elements)) || (in_array('tp-social-reviews',$elements))){
			$merge[] = 'plus-listing-masonry';
			$merge[] = 'plus-carousel';
		}
		if(in_array('tp-clients-listout',$elements)){
			$merge[] = 'plus-listing-masonry';
			$merge[] = 'plus-carousel';
			$merge[] = 'plus-pagination';
			$merge[] = 'plus-listing-load-more';
		}
		if(in_array('tp-dynamic-device',$elements)){
			$merge[] = 'plus-carousel';
		}
		if(in_array('tp-product-listout',$elements)){
			$merge[] = 'plus-listing-masonry';
			$merge[] = 'plus-carousel';
			$merge[] = 'plus-listing-metro';
			$merge[] = 'plus-pagination';
			$merge[] = 'plus-product-listout-yithcss';
			$merge[] = 'plus-product-listout-quickview';
			$merge[] = 'plus-listing-load-more';
			$merge[] = 'tp-product-recent-view';
		}
		if(in_array('tp-team-member-listout',$elements)){
			$merge[] = 'tp-team-member-listout';
			$merge[] = 'tp-team-member-style-1';
			$merge[] = 'tp-team-member-style-2';
			$merge[] = 'tp-team-member-style-3';
			$merge[] = 'tp-team-member-style-4';
			$merge[] = 'plus-listing-masonry';
			$merge[] = 'plus-carousel';		
		}
		if(in_array('tp-testimonial-listout',$elements)){
			$merge[] = 'plus-listing-masonry';
			$merge[] = 'plus-carousel';
		}
		if(in_array('tp-page-scroll',$elements)){
			$merge[] = 'tp-fullpage';
			$merge[] = 'tp-pagepiling';
			$merge[] = 'tp-multiscroll';
			$merge[] = 'tp-horizontal-scroll';
			$merge[] = 'tp-page-scroll-np-button';
			$merge[] = 'tp-page-scroll-paginate';
		}
		if(in_array('tp-dynamic-categories',$elements)){
			$merge[] = 'plus-listing-masonry';
			$merge[] = 'plus-carousel';			
			$merge[] = 'plus-listing-metro';
			$merge[] = 'tp-dynamic-categories';
			$merge[] = 'tp-dynamic-categories-style_1';
			$merge[] = 'tp-dynamic-categories-style_2';
			$merge[] = 'tp-dynamic-categories-style_3';
		}
		
		if(!empty($plus_extras) && in_array('column_sticky',$plus_extras)){
			$merge[] ='plus-extras-column';
		}
		if(!empty($plus_extras) && in_array('column_mouse_cursor',$plus_extras)){
			$merge[] ='plus-column-cursor';
		}
		if(!empty($plus_extras) && in_array('section_scroll_animation',$plus_extras)){
			$merge[] ='plus-extras-section-skrollr';
		}
		if(!empty($plus_extras) && in_array('plus_equal_height',$plus_extras)){
			$merge[] ='plus-equal-height';
		}
		if(function_exists('tp_has_lazyload') && tp_has_lazyload()){		
			$merge[] ='plus-lazyLoad';
		}
		
		/*if(!empty($plus_extras) && in_array('plus_section_column_link',$plus_extras)){
			$merge[] ='plus-section-column-link';
		}*/	
		$result =array_unique($merge);
		$elements =array_merge($result , $elements);
		$this->get_plus_pro_widget_settings = (isset($element) ? (isset($elements[$element]) ? $elements[$element] : 0) : array_filter($elements));
        return $this->get_plus_pro_widget_settings;
    }

    /**
     * Check if elementor preview mode or not 
	 * @since 2.0
     */
    public function is_preview_mode()
    {
        if (isset($_POST['doing_wp_cron'])) {
            return true;
        }
        if (wp_doing_ajax()) {
            return true;
        }
        
		if (isset($_GET['elementor-preview']) && (int)$_GET['elementor-preview']) {
            return true;
        }
        if (isset($_POST['action']) && $_POST['action'] == 'elementor') {
            return true;
        }

        return false;
    }

	/**
	 * Returns the instance.
	 * @since  1.0.0
	 */
	public static function get_instance( $shortcodes = array() ) {
		
		if ( null == self::$instance ) {
			self::$instance = new self( $shortcodes );
		}
		return self::$instance;
	}
}
/**
 * Returns instance of Plus_Library
 */
function theplus_library() {
	return Plus_Library::get_instance();
}