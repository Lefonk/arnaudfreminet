<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

Class Plus_Generator {
	/**
	 * A reference to an instance of this class.
	 *
	 * @since 1.0.0
	 * @var   object
	 */
	private static $instance = null;
	
	public $transient_widgets = array();
	public $registered_widgets;
	public $transient_extensions = array();
    
	public function tp_pro_transient_widget($args) {
		$args = array_merge($this->transient_widgets, $args);
		return $args;
	}
	
	public function tp_layout_listing($options)  {

		$layout = !empty($options["layout"]) ? $options["layout"] : 'grid';
       
		if( 'grid' === $layout || 'masonry' === $layout){
			return 'plus-listing-masonry';
		}else if($layout == 'carousel'){
			return 'plus-carousel'; 
		}else if($layout == 'metro'){
			return 'plus-listing-metro';
		}
	}

	/**
	 * Button Style Get
	 * 
	 * @since 5.4.2
	 * @version 5.4.2
	 * @param string $button_style The style of the button.
	 * 
	 */
	public function tp_button_style($button_style)
	{
	   $this->transient_widgets[] = "tp-button-"."$button_style";
	   $this->transient_widgets[] = "tp-button";
	}

	/**
	 * Button Style Get
	 * 
	 * @since 5.4.2
	 * @version 5.4.2
	 * @param string $button_style The style of the button.
	 * 
	 */
	public function tp_continue_effect( $icon_animation_effect ) {
		if( 'pulse' === $icon_animation_effect ){
			$this->transient_widgets[] = "plus-pulse-animation";
		}else if( 'floating' === $icon_animation_effect ){
			$this->transient_widgets[] = "plus-floating-animation";
		}else if( 'tossing' === $icon_animation_effect ){
			$this->transient_widgets[] = "plus-tossing-animation";
		}else if( 'rotating' === $icon_animation_effect ){
			$this->transient_widgets[] = "plus-rotating-animation";
		}else if( 'drop_waves' === $icon_animation_effect || 'drop-waves' === $icon_animation_effect ){
			$this->transient_widgets[] = "plus-drop-waves-animation";
		}
	}

	/**
	 * Category Filter css
	 * 
	 * @since 5.5.3
	 * @version 5.5.3
	 * @param string $options The option of the widgets.
	 * 
	 */
	public function tp_category_filter( $options ){

		$filter_on = !empty($options['filter_category']) ? $options['filter_category'] : 'no';
                
		if ('yes' === $filter_on){
			$cat_fstyle = !empty($options['filter_style']) ? $options['filter_style'] : 'style-1';
			
			$this->transient_widgets[] = 'plus-post-filter-'.$cat_fstyle;
			$this->transient_widgets[] = 'plus-post-filter';

			$cat_hstyle = ! empty( $options['filter_hover_style'] ) ? $options['filter_hover_style'] : 'style-1';

			$this->transient_widgets[] = 'plus-post-filter-h-'.$cat_hstyle;
		}

	}

	/**
	 * Carousel dots style
	 * 
	 * @since 5.5.4
	 * @version 5.5.4
	 * @param string $options The option of the widgets.
	 * 
	 */
	public function tp_carousel_dots( $options ) {
		$sliderDots = isset( $options['slider_dots'] ) ? $options['slider_dots'] : 'yes';
		$tablet_slider_dots = isset( $options['tablet_slider_dots'] ) ? $options['tablet_slider_dots'] : 'yes';
		$mobile_slider_dots = isset( $options['mobile_slider_dots'] ) ? $options['mobile_slider_dots'] : 'yes';
		
		if ( 'yes' === $sliderDots ) {
			
			$slider_dots_style = ! empty( $options['slider_dots_style'] ) ? $options['slider_dots_style'] : 'style-1';
			
			$this->transient_widgets[] = 'tp-carousel-' . $slider_dots_style;
			$this->transient_widgets[] = 'tp-carousel-style';
		}
		if ( 'yes' === $tablet_slider_dots ) {

			$tablet_slider_dots_style = ! empty( $options['tablet_slider_dots_style'] ) ? $options['tablet_slider_dots_style'] : 'style-1';

			$this->transient_widgets[] = 'tp-carousel-' . $tablet_slider_dots_style;
			$this->transient_widgets[] = 'tp-carousel-style';
		}
		if ( 'yes' === $mobile_slider_dots ) {

			$mobile_slider_dots_style = ! empty( $options['mobile_slider_dots_style'] ) ? $options['mobile_slider_dots_style'] : 'style-1';

			$this->transient_widgets[] = 'tp-carousel-' . $mobile_slider_dots_style;
			$this->transient_widgets[] = 'tp-carousel-style';
		}
	}

	/**
	 * Carousel arrows style
	 * 
	 * @since 5.5.4
	 * @version 5.5.4
	 * @param string $options The option of the widgets.
	 * 
	 */
	public function tp_carousel_arrow( $options ){

		$show_arrows = isset( $options['slider_arrows'] ) ? $options['slider_arrows'] : 'no';

		$tablet_show_arrows  = isset( $options['tablet_slider_arrows'] ) ? $options['tablet_slider_arrows'] : 'no';
		$mobile_show_arrows  = isset( $options['mobile_slider_arrows'] ) ? $options['mobile_slider_arrows'] : 'no';

		
		if ( 'yes' === $show_arrows ) {

			$slider_arrows_style = ! empty( $options['slider_arrows_style'] ) ? $options['slider_arrows_style'] : 'style-1';

			$this->transient_widgets[] = 'tp-arrows-' . $slider_arrows_style;
			$this->transient_widgets[] = 'tp-arrows-style';
		}
		if ( 'yes' === $tablet_show_arrows ) {

			$tablet_slider_arrows_style = ! empty( $options['tablet_slider_arrows_style'] ) ? $options['tablet_slider_arrows_style'] : 'style-1';

			$this->transient_widgets[] = 'tp-arrows-' . $tablet_slider_arrows_style;
			$this->transient_widgets[] = 'tp-arrows-style';
		}
		if ( 'yes' === $mobile_show_arrows ) {

			$mobile_slider_arrows_style = ! empty( $options['mobile_slider_arrows_style'] ) ? $options['mobile_slider_arrows_style'] : 'style-1';

			$this->transient_widgets[] = 'tp-arrows-' . $mobile_slider_arrows_style;
			$this->transient_widgets[] = 'tp-arrows-style';
		}
	}

	/**
	* Check Widgets Options
	* @since 2.0.2
	* @version 5.4.2
	*/
	public function plus_widgets_options( $widgets = array(), $options = array(), $widget_name = '' ) {

		if ( ! empty( $options['seh_switch'] ) && 'yes' === $options['seh_switch'] ) {
			$this->transient_widgets[] = 'plus-equal-height';
		}

		if ( ( ! empty( $options['sc_link_switch'] ) && 'yes' === $options['sc_link_switch'] ) && ! empty( $options['sc_link']['url'] ) ) {
			$this->transient_widgets[] = 'plus-section-column-link';
		}

		if ( ( ( ! empty( $options['plus_eto_fb'] ) && 'yes' === $options['plus_eto_fb'] ) ) || ( ( ! empty( $options['plus_eto_gtag'] ) && 'yes' === $options['plus_eto_gtag'] ) ) ) {
			$this->transient_widgets[] = 'plus-event-tracker';
		}

		if ( function_exists( 'tp_has_lazyload' ) && tp_has_lazyload() ) {
			$this->transient_widgets[] = 'plus-lazyLoad';
		}

		if ( ! empty( $widget_name ) && 'section' === $widget_name || ! empty( $widget_name ) && 'container' === $widget_name ) {
			if ( ( ! empty( $options['plus_section_scroll_animation_in'] ) && 'none' !== $options['plus_section_scroll_animation_in'] ) || ( ! empty( $options['plus_section_scroll_animation_out'] ) && 'none' !== $options['plus_section_scroll_animation_out'] ) ) {
				$this->transient_widgets[] = 'plus-extras-section-skrollr';
			}
		}

		if ( ! empty( $widget_name ) && 'tp-advanced-typography' === $widget_name && ! empty( $options['text_continuous_animation'] ) && 'yes' === $options['text_continuous_animation'] ) {
			$image_effect = !empty( $options['text_continuous_animation'] ) ? $options['text_continuous_animation'] : ''; 
			if( !empty( $image_effect ) && 'yes' === $image_effect ){	
				$icon_animation_effect = !empty( $options['text_animation_effect'] ) ? $options['text_animation_effect'] : '';

				$this->tp_continue_effect( $icon_animation_effect );
			}
		}

		if ( ! empty( $options['plus_tooltip'] ) && 'yes' === $options['plus_tooltip'] ) {
			$this->transient_widgets[] = 'plus-tooltip';
		}

		if ( ! empty( $options['plus_mouse_move_parallax'] ) && 'yes' === $options['plus_mouse_move_parallax'] ) {
			$this->transient_widgets[] = 'plus-mousemove-parallax';
		}
		if ( ! empty( $options['plus_tilt_parallax'] ) && 'yes' === $options['plus_tilt_parallax'] ) {
			$this->transient_widgets[] = 'plus-tilt-parallax';
		}

		if(!empty($options["loop_display_button"]) && $options["loop_display_button"]=='yes'){
			$button_style = ! empty( $options['loop_button_style'] ) ? $options['loop_button_style'] : 'style-7';

			$this->tp_button_style( $button_style );
		}

		if ( ! empty( $widget_name ) ) {

			if ( ( ! empty( $options['plus_continuous_animation'] ) && 'yes' === $options['plus_continuous_animation'] ) ) {

				$comtinue_animations = ! empty( $options['plus_animation_effect'] ) ? $options['plus_animation_effect'] : 'pulse';

				if( ! empty( $comtinue_animations ) ) {
					$this->transient_widgets[] = "plus-". $comtinue_animations ."-animation";
				}
			}

			if( 'tp-accordion' === $widget_name || 'tp_advertisement_banner' === $widget_name || 'tp-advanced-typography' === $widget_name || 'tp-button' === $widget_name || 'tp-contact-form-7' === $widget_name || 'tp-post-search' === $widget_name || 'tp-info-box' === $widget_name || 'tp-flip-box' === $widget_name || 'tp-navigation-menu-lite' === $widget_name || 'tp-navigation-menu' === $widget_name || 'tp-pricing-list' === $widget_name || 'tp-social-icon' === $widget_name || 'tp-site-logo' === $widget_name ||'tp-social-sharing' === $widget_name || 'tp-tabs-tours' === $widget_name || 'tp-dynamic-listing' === $widget_name ||  'tp-timeline' === $widget_name){
				$this->transient_widgets[] = "plus-alignmnet-effect";
			}
			
			
			if ( 'tp-cascading-image' === $widget_name || 'tp-flip-box' === $widget_name || 'tp-image-factory' === $widget_name || 'tp-info-box' === $widget_name || 'tp-row-background' === $widget_name ) {

				$respo_visible = ! empty( $options['responsive_visible_opt'] ) ? $options['responsive_visible_opt'] : '';

				if ( 'yes' === $respo_visible ) {
					$this->transient_widgets[] = 'plus-responsive-visibility';
				}
			}

			if ( 'tp-age-gate' === $widget_name ) {
				$age_verify_method = ! empty( $options['age_verify_method'] ) ? $options['age_verify_method'] : 'method-1';

				if(!empty($age_verify_method)){
					$this->transient_widgets[] = 'tp-age-gate-' . $age_verify_method;
					$this->transient_widgets[] = 'tp-age-gate';
				}
			}

			if ( 'tp-audio-player' === $widget_name ) {

				$ap_style = ! empty( $options['ap_style'] ) ? $options['ap_style'] : 'style-1';

				if(!empty($ap_style)){
					$this->transient_widgets[] = 'tp-audio-player-' . $ap_style;
					$this->transient_widgets[] = 'tp-audio-player';
				}
				
			}

			if ( 'tp-blockquote' == $widget_name ) {
				$border_layout             = ! empty( $options['border_layout'] ) ? $options['border_layout'] : 'none';
				
				if(!empty($border_layout)){
					$this->transient_widgets[] = 'tp-blockquote-' . $border_layout;
					$this->transient_widgets[] = 'tp-blockquote';
				}
				
			}
			
			if ( 'tp-woo-checkout' === $widget_name ) {
				$this->transient_widgets[] = 'tp-woo-thank-you';
			}

			if ( 'tp-woo-compare' === $widget_name ) {
				$compare_type  = ! empty( $options['type'] ) ? $options['type'] : 'tp_wc_button';

				if ( 'tp_wc_list' === $compare_type ) {
					$this->transient_widgets[] = 'tp-woo-compare-list';
				}

				if ( 'tp_wc_count' === $compare_type ) {
					$count_type  = ! empty( $options['count_type'] ) ? $options['count_type'] : 'tp_wc_count_button';

					$this->transient_widgets[] = 'tp-woo-compare-count';
					if( 'tp_wc_count_list_view' === $count_type ){
						$this->transient_widgets[] = 'tp-woo-compare-list';
					}
				}

				if ( 'tp_wc_button' === $compare_type ) {
					$this->transient_widgets[] = 'tp-woo-compare-button';
				}
			}

			if( 'tp-woo-multi-step' === $widget_name ) {
				$msc_style   = ! empty( $options['mscStyle'] ) ? $options['mscStyle'] : 'style-1';
				$hide_coupon = ! empty( $options['hide_coupon_switch'] ) ? $options['hide_coupon_switch'] : '';

				$this->transient_widgets[] = 'tp-woo-multi-step-' . "$msc_style";
				$this->transient_widgets[] = 'tp-woo-multi-step';

				if ( 'yes' !== $hide_coupon ) {
					$this->transient_widgets[] = 'tp-woo-multi-step-coupon';
				}
			}

			if ( 'tp-button' === $widget_name ) {

				$hoverEffect  = ! empty( $options['btn_hover_effects'] ) ? $options['btn_hover_effects'] : '';
				$button_style = ! empty( $options['button_style'] ) ? $options['button_style'] : 'style-1';

				$this->tp_button_style( $button_style );

				if ( $hoverEffect ) {
					$this->transient_widgets[] = 'plus-content-hover-effect';
				}
			}

			if ( ( ! empty( $options['plus_overlay_effect'] ) && 'yes' === $options['plus_overlay_effect'] ) || ( ! empty( $widget_name ) && 'tp-button' === $widget_name && ! empty( $options['btn_special_effect'] ) && 'yes' === $options['btn_special_effect'] ) ) {
				$this->transient_widgets[] = 'plus-reveal-animation';
			}
			
			if ( ( ! empty( $options['magic_scroll'] ) && $options['magic_scroll'] == 'yes' ) || ( ! empty( $widget_name ) && 'tp-button' === $widget_name && ! empty( $options['btn_magic_scroll'] ) && 'yes' === $options['btn_magic_scroll'] ) ) {
				$this->transient_widgets[] = 'plus-magic-scroll';
			}

			if ( 'tp-countdown' === $widget_name ) {

				$CDstyle = ! empty( $options['CDstyle'] ) ? $options['CDstyle'] : 'style-1';

				if(!empty($CDstyle)){
					$this->transient_widgets[] = 'tp-countdown-' . $CDstyle;
					$this->transient_widgets[] = 'tp-countdown';
				}
				
			}

			if ( 'tp-coupon-code' === $widget_name ) {

				$coupon_style = ! empty( $options['couponType'] ) ? $options['couponType'] : 'standard';

				if(!empty($coupon_style)){
					$this->transient_widgets[] = 'tp-coupon-' . $coupon_style;
					$this->transient_widgets[] = 'tp-coupon-code';
				}
			}

			if ( 'tp-header-extras' === $widget_name ) {

				$header_audio = ! empty( $options['display_music_bar'] ) ? $options['display_music_bar'] : 'no';

				if ( 'yes' === $header_audio ) {
					$this->transient_widgets[] = 'tp-header-audio';
				}
			}

			if ( 'tp-heading-title' === $widget_name ) {

				$heading_style = ! empty( $options['heading_style'] ) ? $options['heading_style'] : 'style_1';

				if(!empty($heading_style)){
					$this->transient_widgets[] = 'tp-heading-title-' . $heading_style;
					$this->transient_widgets[] = 'tp-heading-title';
				}

				if ( ! empty( $options['heading_style'] ) && $options['heading_style'] == 'style_10' ) {
					$this->transient_widgets[] = 'tp-heading-title-splite-animation';
				}
			}

			if ( 'tp-google-map' === $widget_name ) {
				$map_type = ! empty( $options['MapType'] ) ? $options['MapType'] : 'googlemap';

				$this->transient_widgets[] = 'tp-google-map';

				if ( 'googlemap' === $map_type ) {
					$this->transient_widgets[] = 'tp-map-googlemap';
				}

				if ( 'osmmap' === $map_type ) {
					$this->transient_widgets[] = 'tp-map-osm';
				}
			}

			if ( 'tp-flip-box' === $widget_name || 'tp-info-box' === $widget_name ) {

				if ( 'tp-info-box' === $widget_name ) {

					$main_style = ! empty( $options['main_style'] ) ? $options['main_style'] : 'style_1';
					$hover_ani = ! empty( $options['bg_hover_animation'] ) ? $options['bg_hover_animation'] : 'hover_normal';

					$this->transient_widgets[] = 'tp-info-box-' . "$main_style";
					$this->transient_widgets[] = 'tp-info-box';

					if ( ! empty( $options['info_box_layout'] ) && 'carousel_layout' === $options['info_box_layout'] && ! empty( $options['connection_switch'] ) && 'yes' === $options['connection_switch'] && ! empty( $options['connection_unique_id'] ) ) {
						$this->transient_widgets[] = 'tp-info-box-js';
					}
					if ( ( ! empty( $options['loop_select_icon'] ) && 'lottie' === $options['loop_select_icon'] ) || ( ! empty( $options['image_icon'] ) && 'lottie' === $options['image_icon'] ) ) {
						$this->transient_widgets[] = 'plus-lottie-player';
					}
					if( 'hover_normal' !== $hover_ani ){
						$this->transient_widgets[] = 'tp-bg-hover-ani';
					}
				}
				
				$info_box_layout = !empty($options['info_box_layout']) ? $options['info_box_layout'] : 'single_layout';

				if('carousel_layout' === $info_box_layout) { 

					$show_arrows         = isset( $options['slider_arrows'] ) ? $options['slider_arrows'] : 'no';
					$slider_arrows_style = ! empty( $options['slider_arrows_style'] ) ? $options['slider_arrows_style'] : 'style-1';

					if ( 'yes' === $show_arrows ) {
					
						$this->transient_widgets[] = 'tp-arrows-' . $slider_arrows_style;
						$this->transient_widgets[] = 'tp-arrows-style';
					}

					$sliderDots        = isset( $options['slider_dots'] ) ? $options['slider_dots'] : 'yes';
					$slider_dots_style = ! empty( $options['slider_dots_style'] ) ? $options['slider_dots_style'] : 'style-1';

					if ( 'yes' === $sliderDots ) {
						$this->transient_widgets[] = 'tp-carousel-' . $slider_dots_style;
						$this->transient_widgets[] = 'tp-carousel-style';
					}
				}
               
				if('single_layout' === $info_box_layout) {

					$dis_btn =  !empty($options['display_button']) ? $options['display_button'] : '';
						if ('yes' === $dis_btn) {
							$button_style = ! empty( $options['button_style'] ) ? $options['button_style'] : 'style-7';

							$this->tp_button_style( $button_style );
						}
				}

				if ( ! empty( $options['info_box_layout'] ) && 'carousel_layout' === $options['info_box_layout'] ) {
					$this->transient_widgets[] = 'plus-carousel';
				}

				if ( ! empty( $options['box_hover_effects'] ) ) {
					$this->transient_widgets[] = 'plus-content-hover-effect';
				}

				if ( ! empty( $options['tilt_parallax'] ) && 'yes' === $options['tilt_parallax'] ) {
					$this->transient_widgets[] = 'plus-tilt-parallax';
				}

				if ( ( ! empty( $options['image_icon'] ) && 'svg' === $options['image_icon'] ) || ( ! empty( $options['loop_select_icon'] ) && 'svg' === $options['loop_select_icon'] ) ) {
					$this->transient_widgets[] = 'tp-draw-svg';
				}
			}

			if ( 'tp-number-counter' === $widget_name ) {

				$counter_style = ! empty( $options['style'] ) ? $options['style'] : 'style-1';

				if(!empty($counter_style)){
					$this->transient_widgets[] = 'tp-number-counter-' . $counter_style;
					$this->transient_widgets[] = 'tp-number-counter';
				}

				$this->transient_widgets[] = 'plus-content-hover-effect';

				if ( ( ! empty( $options['icon_type'] ) && $options['icon_type'] == 'lottie' ) ) {
					$this->transient_widgets[] = 'plus-lottie-player';
				}
				if ( ! empty( $options['icon_type'] ) && $options['icon_type'] == 'svg' ) {
					$this->transient_widgets[] = 'tp-draw-svg';
				}
			}

			if ( $widget_name == 'tp-pricing-list' ) {

				$pricing_style = ! empty( $options['menu_style'] ) ? $options['menu_style'] : 'style_1';

				if(!empty($pricing_style)){
					$this->transient_widgets[] = 'tp-pricing-list';
					$this->transient_widgets[] = 'tp-pricing-list-' . "$pricing_style";
				}

				if ( ! empty( $options['icon_type'] ) && $options['icon_type'] == 'lottie' ) {
					$this->transient_widgets[] = 'plus-lottie-player';
				}
			}

			if ( 'tp-search-filter' === $widget_name ) {
				$datepicker = array_search( 'date', array_column( $options['searchField'], 'WpFilterType' ) );
				$rangeslider = array_search( 'range', array_column( $options['searchField'], 'WpFilterType' ) );

				if( ! empty( $datepicker ) || 0 === $datepicker ){
					$this->transient_widgets[] = 'tp-search-datepicker';
				}

				if( ! empty( $rangeslider ) || 0 === $rangeslider ){
					$this->transient_widgets[] = 'tp-search-slider';
				}
			}

			if ( 'tp-pricing-table' === $widget_name ) {

				$p_style = ! empty( $options['pricing_table_style'] ) ? $options['pricing_table_style'] : 'style-1';

				$plus_tooltip = array_search( 'yes', array_column( $options['icon_list'], 'show_tooltips' ) );

				$table_ribbon  = ! empty( $options['display_ribbon_pin'] ) ? $options['display_ribbon_pin'] : 'no';

				$this->transient_widgets[] = 'tp-pricing-table-' . $p_style;
				$this->transient_widgets[] = 'tp-pricing-table';

				$button_style = ! empty( $options['button_style'] ) ? $options['button_style'] : 'style-8';

				$this->tp_button_style( $button_style );

				if ( ! empty( $options['image_icon'] ) && 'svg' === $options['image_icon'] ) {
					$this->transient_widgets[] = 'tp-draw-svg';
				}

				if ( ( ! empty( $options['button_icon_type'] ) && 'lottie' === $options['button_icon_type'] ) ) {
					$this->transient_widgets[] = 'plus-lottie-player';
				}

				if( ! empty( $plus_tooltip ) || $plus_tooltip === 0 ){
					$this->transient_widgets[] = 'plus-tooltip';
				}

				if( 'yes' === $table_ribbon ){
					$this->transient_widgets[] = 'tp-pricing-ribbon';
				}
			}

			if ( 'tp-progress-bar' === $widget_name ) {
				$progress_style = ! empty( $options['main_style'] ) ? $options['main_style'] : 'progressbar';

				if ( 'progressbar' == $progress_style ) {
					$this->transient_widgets[] = 'tp-progress-bar';
				}
				if ( 'pie_chart' == $progress_style ) {
					$this->transient_widgets[] = 'tp-piechart';
				}

				if ( ! empty( $options['image_icon'] ) && 'lottie' === $options['image_icon'] ) {
					$this->transient_widgets[] = 'plus-lottie-player';
				}
			}

			if ( 'tp-social-icon' === $widget_name ) {

				$social_icon               = ! empty( $options['styles'] ) ? $options['styles'] : 'style-1';

				if(!empty($social_icon)){
					$this->transient_widgets[] = 'tp-social-icon-' . $social_icon;
					$this->transient_widgets[] = 'tp-social-icon';
				}

				if ( ! empty( $options['pt_plus_social_networks'] ) ) {
					$magic_scroll = array_search( 'yes', array_column( $options['pt_plus_social_networks'], 'loop_magic_scroll' ) );
					if ( ! empty( $magic_scroll ) || $magic_scroll === 0 ) {
						$this->transient_widgets[] = 'plus-magic-scroll';
					}
					$plus_tooltip = array_search( 'yes', array_column( $options['pt_plus_social_networks'], 'plus_tooltip' ) );
					if ( ! empty( $plus_tooltip ) || $plus_tooltip === 0 ) {
						$this->transient_widgets[] = 'plus-tooltip';
					}
					$move_parallax = array_search( 'yes', array_column( $options['pt_plus_social_networks'], 'plus_mouse_move_parallax' ) );
					if ( ! empty( $move_parallax ) || $move_parallax === 0 ) {
						$this->transient_widgets[] = 'plus-mousemove-parallax';
					}
				}
			}

			if ( 'tp-social-sharing' === $widget_name ) {
				$sociallayout = ! empty( $options['sociallayout'] ) ? $options['sociallayout'] : 'horizontal';
				if ( 'horizontal' == $sociallayout || 'vertical' || $sociallayout ) {
					$this->transient_widgets[] = 'tp-social-1-2-layout';
				}
				if ( 'toggle' == $sociallayout ) {
					$toggle_style = !empty($options['toggleStyle']) ? $options['toggleStyle'] : 'style-1';

                    $this->transient_widgets[] = 'tp-social-toggle-'.$toggle_style;

				}
				$this->transient_widgets[] = 'tp-social-sharing';
			}

			if ( 'tp-syntax-highlighter' === $widget_name ) {

				$themeType     = ! empty( $options['themeType'] ) ? $options['themeType'] : 'prism-default';
				$cpybtnicon    = ! empty( $options['cpybtnicon']['value'] ) ? $options['cpybtnicon']['value'] : 'fas fa-copy';
				$copiedbtnicon = ! empty( $options['copiedbtnicon']['value'] ) ? $options['copiedbtnicon']['value'] : 'fas fa-arrow-alt-circle-down';
				$dwnldBtnIcon  = ! empty( $options['dwnldBtnIcon']['value'] ) ? $options['dwnldBtnIcon']['value'] : 'fas fa-arrow-alt-circle-down';
				
				if ( ! empty( $themeType ) ) {
					$this->transient_widgets[] = 'tp-syntax-highlighter';
					if ( $themeType == 'prism-default' ) {
						$this->transient_widgets[] = 'prism_default';
					} elseif ( $themeType == 'prism-coy' ) {
						$this->transient_widgets[] = 'prism_coy';
					} elseif ( $themeType == 'prism-dark' ) {
						$this->transient_widgets[] = 'prism_dark';
					} elseif ( $themeType == 'prism-funky' ) {
						$this->transient_widgets[] = 'prism_funky';
					} elseif ( $themeType == 'prism-okaidia' ) {
						$this->transient_widgets[] = 'prism_okaidia';
					} elseif ( $themeType == 'prism-solarizedlight' ) {
						$this->transient_widgets[] = 'prism_solarizedlight';
					} elseif ( $themeType == 'prism-tomorrownight' ) {
						$this->transient_widgets[] = 'prism_tomorrownight';
					} elseif ( $themeType == 'prism-twilight' ) {
						$this->transient_widgets[] = 'prism_twilight';
					}
					if ( $cpybtnicon || $copiedbtnicon || $dwnldBtnIcon ) {
						$this->transient_widgets[] = 'tp-syntax-highlighter-icons';
					}
				}
			}

			if ( 'tp-table-content' == $widget_name ) {

				$table_style               = ! empty( $options['Style'] ) ? $options['Style'] : 'none';
				if(!empty($table_style)){
					$this->transient_widgets[] = 'tp-table-content-' . $table_style;
					$this->transient_widgets[] = 'tp-table-content';
				}
			}

			if ( 'tp-advanced-buttons' === $widget_name ) {
				$ab_button_type = ! empty( $options['ab_button_type'] ) ? $options['ab_button_type'] : 'cta';

				if ( 'cta' == $ab_button_type ) {
					$cta_button_style = ! empty( $options['cta_button_style'] ) ? $options['cta_button_style'] : 'tp_cta_st_1';

					$this->transient_widgets[] = $cta_button_style;
					$this->transient_widgets[] = 'tp-advanced-buttons';
					$this->transient_widgets[] = 'tp-advanced-buttons-js';
				}

				if ( 'download' === $ab_button_type ) {
					$down_button_style = ! empty( $options['download_button_style'] ) ? $options['download_button_style'] : 'tp_download_st_1';

					$this->transient_widgets[] = $down_button_style;
					$this->transient_widgets[] = 'tp-advanced-buttons';
				}
			}

			if ( 'tp_advertisement_banner' === $widget_name ) {

				$add_style = ! empty( $options['add_style'] ) ? $options['add_style'] : 'style-1';

				if(!empty($add_style)){
					$this->transient_widgets[] = 'tp_add_banner-' . $add_style;
					$this->transient_widgets[] = 'tp_advertisement_banner';
				}

				if ( ! empty( $options['hov_styles'] ) && 'hover-tilt' === $options['hov_styles'] ) {
					$this->transient_widgets[] = 'plus-hover3d';
				}

				if ( ! empty( $options['display_button'] ) && 'yes' === $options['display_button'] ) {
					$button_style = ! empty( $options['button_style'] ) ? $options['button_style'] : 'style-7';

					$this->tp_button_style( $button_style );
				}

				$this->transient_widgets[] = 'plus-content-hover-effect';
			}

			if ( 'tp-animated-service-boxes' === $widget_name ) {

				$animated_style        = ! empty( $options['main_style'] ) ? $options['main_style'] : 'image-accordion';
				$image_accordion_style = ! empty( $options['image_accordion_style'] ) ? $options['image_accordion_style'] : 'accordion-style-1';
				$article_box_style     = ! empty( $options['article_box_style'] ) ? $options['article_box_style'] : 'article-box-style-1';
				$info_banner_style     = ! empty( $options['info_banner_style'] ) ? $options['info_banner_style'] : 'info-banner-style-1';
				$services_element      = ! empty( $options['services_element_style'] ) ? $options['services_element_style'] : 'services-element-style-1';
				$portfolio_style       = ! empty( $options['portfolio_style'] ) ? $options['portfolio_style'] : 'portfolio-style-1';

				if(!empty($animated_style)){
					$this->transient_widgets[] = 'tp-' . $animated_style;
					$this->transient_widgets[] = 'tp-animated-service-boxes';
				}

				if ( 'image-accordion' === $animated_style && 'accordion-style-2' === $image_accordion_style ) {
					$this->transient_widgets[] = 'tp-image-accordion-style-2';
				}
				if ( 'article-box' === $animated_style ) {
					$this->transient_widgets[] = 'tp-' . "$article_box_style";
				}
				if ( 'info-banner' === $animated_style ) {
					$this->transient_widgets[] = 'tp-' . "$info_banner_style";
				}
				if ( 'services-element' === $animated_style ) {
					$this->transient_widgets[] = 'tp-services-element';
					$this->transient_widgets[] = 'tp-' . "$services_element";
				}
				if ( 'portfolio' === $animated_style ) {
					$this->transient_widgets[] = 'tp-' . "$portfolio_style";
				}

				if ( ! empty( $options['loop_content'][0]['loop_image_icon'] ) && $options['loop_content'][0]['loop_image_icon'] == 'lottie' ) {
					$this->transient_widgets[] = 'plus-lottie-player';
				}

			}

			if ( 'tp-carousel-remote' == $widget_name ) {

				$carousel_dot = ! empty( $options['dotList'] ) ? $options['dotList'] : 'no';

				$dotstyle = ! empty( $options['dotstyle'] ) ? $options['dotstyle'] : 'style-1';
				$showpagi = ! empty( $options['showpagi'] ) ? $options['showpagi'] : 'no';
				$remote_type = ! empty( $options['remote_type'] ) ? $options['remote_type'] : 'carousel';

				if ( 'yes' == $carousel_dot ) {
					$this->transient_widgets[] = 'tp-carousel-dot';

					if ( 'style-2' == $dotstyle ) {
						$this->transient_widgets[] = 'tp-carousel-tooltip';
					}
				}
				
				if ( 'horizontal' === $remote_type ){
					$this->transient_widgets[] = 'tp-plus-horizontal-connection';
				}

				if ( 'yes' == $showpagi ) {
					$this->transient_widgets[] = 'tp-carousel-pagination';
				}
				$this->transient_widgets[] = 'tp-carousel-remote';
			}

			if ( 'tp-process-steps' === $widget_name ) {

				$display_counter = ! empty( $options['pro_ste_display_counter'] ) ? $options['pro_ste_display_counter'] : 'no';
				$special_bg      = ! empty( $options['pro_ste_display_special_bg'] ) ? $options['pro_ste_display_special_bg'] : 'no';

				if ( 'yes' == $display_counter ) {
					$this->transient_widgets[] = 'tp-process-counter';
				}

				if ( 'yes' == $special_bg ) {
					$this->transient_widgets[] = 'tp-process-bg';
				}

				$this->transient_widgets[] = 'tp-process-steps';

				if ( ( ! empty( $options['ps_style'] ) && 'style_2' === $options['ps_style'] ) || ( ! empty( $options['connection_switch'] ) && 'yes' === $options['connection_switch'] && ! empty( $options['connection_unique_id'] ) ) ) {
					$this->transient_widgets[] = 'tp-process-steps-js';
				}

				if ( ( ! empty( $options['loop_content'][0]['loop_image_icon'] ) && 'lottie' === $options['loop_content'][0]['loop_image_icon'] ) ) {
					$this->transient_widgets[] = 'plus-lottie-player';
				}
			}

			if ( 'tp-scroll-navigation' == $widget_name ) {

				$navigation_style = ! empty( $options['scroll_navigation_style'] ) ? $options['scroll_navigation_style'] : 'style-1';
				$display_counter = ! empty( $options['scroll_navigation_display_counter'] ) ? $options['scroll_navigation_display_counter'] : 'no';

				$this->transient_widgets[] = 'tp-scroll-navigation-' . "$navigation_style";
				$this->transient_widgets[] = 'tp-scroll-navigation';
				
				if( 'yes' === $display_counter ){
					$this->transient_widgets[] = 'tp-display-counter';
				}

			}

			if ( 'tp-navigation-menu' == $widget_name ) {

				$mouse_scroll = ! empty( $options['enable_sticky_osup_menu'] ) ? $options['enable_sticky_osup_menu'] : 'no';

				if( 'yes' === $mouse_scroll ){
					$this->transient_widgets[] = 'tp-navigation-scroll';
				}

			}

			if ( 'tp-timeline' === $widget_name ) {
				$timeline_style = ! empty( $options['style'] ) ? $options['style'] : 'style-1';

				$timeline_meso = ! empty( $options['timeline_inline_masonry'] ) ? $options['timeline_inline_masonry'] : 'no';

				$this->transient_widgets[] = 'tp-timeline-' . "$timeline_style";
				$this->transient_widgets[] = 'tp-timeline';

				foreach ( $options['content_loop_section'] as $item ){
					$timeline_anim = !empty( $item['loop_animation_effects'] ) ? $item['loop_animation_effects'] : '';

					if( !empty( $timeline_anim ) ){
						$this->transient_widgets[] = 'tp-timeline-animation';
					}
				}

				if ( 'yes' === $timeline_meso ){
					$this->transient_widgets[] = 'tp-timeline-masonry';
				}

				$button_style  = 'style-8';

				$this->transient_widgets[] = $this->tp_button_style( $button_style );
			
			}

			if ( 'tp-page-scroll' === $widget_name || 'tp-horizontal-scroll-advance' === $widget_name || 'tp-scroll-sequence' === $widget_name || 'tp-table' === $widget_name ) { 
				$this->transient_widgets[] = 'plus-widget-error';
			}

			if ( 'tp-page-scroll' === $widget_name ) {

				$page_scroll_opt = ! empty( $options['page_scroll_opt'] ) ? $options['page_scroll_opt'] : 'tp_full_page';

				$scroll_paginate = !empty($options['show_paginate']) ? $options['show_paginate'] : '';
                if( ! isset($options['show_next_prev']) ){
                    $this->transient_widgets[] = 'tp-page-scroll-np-button';
                }

                if('yes' === $scroll_paginate){
                    $this->transient_widgets[] = 'tp-page-scroll-paginate';
                }
				if ( $page_scroll_opt == 'tp_full_page' ) {
					$this->transient_widgets[] = 'tp-fullpage';
				}

				if ( $page_scroll_opt == 'tp_page_pilling' ) {
					$this->transient_widgets[] = 'tp-pagepiling';
				}
				if ( $page_scroll_opt == 'tp_multi_scroll' ) {
					$this->transient_widgets[] = 'tp-multiscroll';
				}
				if ( $page_scroll_opt == 'tp_horizontal_scroll' ) {
					$this->transient_widgets[] = 'tp-horizontal-scroll';
				}
			}

			if ( 'tp-blog-listout' === $widget_name ) {

				$tp_list_preloader = ! empty( $options['tp_list_preloader'] ) ? $options['tp_list_preloader'] : 'no';
				if ( 'yes' === $tp_list_preloader ) {
					$this->transient_widgets[] = 'tp-bloglistout-preloder';
				}

				$blog_style = ! empty( $options['style'] ) ? $options['style'] : 'style-1';

				$this->transient_widgets[] = 'tp-bloglistout-' . $blog_style;
				$this->transient_widgets[] = 'tp-blog-listout';

				if( ! empty( $options['post_extra_option'] ) ){
					$this->transient_widgets[] = 'plus-listing-load-more';
				}
			}

			if ( 'tp-blog-listout' === $widget_name || 'tp-product-listout' === $widget_name || 'tp-dynamic-listing' === $widget_name ) {

				$layout = ! empty( $options['layout'] ) ? $options['layout'] : 'grid';

				if ( 'carousel' == $layout ) {

					$this->tp_carousel_dots( $options );
					$this->tp_carousel_arrow( $options );
				}
            
				$this->transient_widgets[] = $this->tp_layout_listing( $options );
				
				if ( ! empty( $options['display_button'] ) && 'yes' === $options['display_button'] ) {
					$button_style = ! empty( $options['button_style'] ) ? $options['button_style'] : 'style-7';

					$this->tp_button_style( $button_style );
				}

				$this->tp_category_filter( $options );

				if ( ! empty( $options['post_extra_option'] ) && 'pagination' === $options['post_extra_option'] ) {
					$this->transient_widgets[] = 'plus-pagination';
				}

				$tpqv_option = ! empty( $options['tpqc'] ) ? $options['tpqc'] : 'default';

				if ( 'tp-dynamic-listing' === $widget_name && ! empty( $options['display_theplus_quickview'] ) && $options['display_theplus_quickview'] == 'yes' && $tpqv_option) {
					$this->transient_widgets[] = 'tp-dynamic-listout-qview';
				}
			}

			if ( 'tp-team-member-listout' === $widget_name ) {

				$team_member_style         = ! empty( $options['style'] ) ? $options['style'] : 'style-1';
				$this->transient_widgets[] = 'tp-team-member-' . "$team_member_style";
				$this->transient_widgets[] = 'tp-team-member-listout';

				$this->transient_widgets[] = $this->tp_layout_listing( $options );

				$this->tp_category_filter( $options );
               
				$layout = ! empty( $options['layout'] ) ? $options['layout'] : 'grid';

				if ( 'carousel' == $layout ) {

					$this->tp_carousel_dots( $options );				
					$this->tp_carousel_arrow( $options );
				}
			}

			if ( 'tp-testimonial-listout' === $widget_name ) {

				$testimoial_style = ! empty( $options['style'] ) ? $options['style'] : 'style-1';

				$this->transient_widgets[] = 'tp-testimonial-' . "$testimoial_style";
				$this->transient_widgets[] = 'tp-testimonial-listout';

				$layout = ! empty( $options['layout'] ) ? $options['layout'] : 'carousel';
				
				if ( 'carousel' === $layout ) {
					$this->transient_widgets[] = 'plus-carousel';

					$this->tp_carousel_dots( $options );				
					$this->tp_carousel_arrow( $options );
				}

			}

			if ( 'tp-social-feed' === $widget_name || 'tp-social-reviews' === $widget_name ) {

				$rtype        = ! empty( $options['RType'] ) ? $options['RType'] : 'review';
				$social_style = ! empty( $options['style'] ) ? $options['style'] : 'style-1';
				$bstyle       = ! empty( $options['Bstyle'] ) ? $options['Bstyle'] : 'style-1';

				if ( 'tp-social-reviews' === $widget_name ) {

					if ( 'review' === $rtype ) {

						$this->transient_widgets[] = 'tp-social-reviews-' . $social_style;
						$this->transient_widgets[] = 'tp-social-reviews';
					}

					if ( 'beach' === $rtype ) {
						$this->transient_widgets[] = 'tp-social-reviews-' . $bstyle;
						$this->transient_widgets[] = 'tp-social-reviews';
					}
				}

				$layout = ! empty( $options['layout'] ) ? $options['layout'] : 'grid';

				if ( 'carousel' == $layout ) {

					$this->tp_carousel_dots( $options );
					$this->tp_carousel_arrow( $options );
				}

				$this->transient_widgets[] = $this->tp_layout_listing( $options );

				if ( ! empty( $options['AllReapeter'] ) ) {
					$instafeedBus = false;
					foreach ( $options['AllReapeter'] as $value ) {
						if ( ( ! empty( $value['selectFeed'] ) && $value['selectFeed'] == 'Instagram' ) && ( ! empty( $value['InstagramType'] ) && 'Instagram_Graph' === $value['InstagramType'] ) ) {
							$instafeedBus = true;
							break;
						}
					}
					if ( $instafeedBus ) {
						$this->transient_widgets[] = 'plus-carousel';
					}
				}

				$this->tp_category_filter( $options );

				if( ! empty( $options['post_extra_option'] ) ){
					$this->transient_widgets[] = 'plus-listing-load-more';
				}
			}

			if ( 'tp-breadcrumbs-bar' == $widget_name ) {

				$breadcrumbs_style             = ! empty( $options['breadcrumbs_style'] ) ? $options['breadcrumbs_style'] : 'style_1';
				if(!empty($breadcrumbs_style)){
					$this->transient_widgets[] = 'tp-breadcrumbs-bar-' . $breadcrumbs_style;
					$this->transient_widgets[] = 'tp-breadcrumbs-bar';
				}
			}

			if ( 'tp-gallery-listout' === $widget_name ) {

				$gallery_style = ! empty( $options['style'] ) ? $options['style'] : 'style-1';

				$this->transient_widgets[] = 'tp-gallery-listout-' . "$gallery_style";
				$this->transient_widgets[] = 'tp-gallery-listout';

				$this->transient_widgets[] = $this->tp_layout_listing( $options );

				$this->tp_category_filter( $options );

				$layout = ! empty( $options['layout'] ) ? $options['layout'] : 'grid';

				if ( 'carousel' === $layout ) {

					$show_arrows         = isset( $options['slider_arrows'] ) ? $options['slider_arrows'] : 'no';
					$slider_arrows_style = ! empty( $options['slider_arrows_style'] ) ? $options['slider_arrows_style'] : 'style-1';

					if ( 'yes' === $show_arrows ) {
						$this->transient_widgets[] = 'tp-arrows-' . $slider_arrows_style;
						$this->transient_widgets[] = 'tp-arrows-style';
					}

					$sliderDots = isset( $options['slider_dots'] ) ? $options['slider_dots'] : 'yes';

					$slider_dots_style = ! empty( $options['slider_dots_style'] ) ? $options['slider_dots_style'] : 'style-1';
					if ( 'yes' === $sliderDots ) {
						$this->transient_widgets[] = 'tp-carousel-' . $slider_dots_style;
						$this->transient_widgets[] = 'tp-carousel-style';
					}
				}
			}

			if ( 'tp-cascading-image' === $widget_name && ( ( ! empty( $options['image_cascading'][0]['select_option'] ) && 'lottie' === $options['image_cascading'][0]['select_option'] ) ) ) {
				$this->transient_widgets[] = 'plus-lottie-player';
			}

			if ( 'tp-hotspot' === $widget_name){
				$pin_hotspot = !empty( $options['pin_hotspot'] ) ? $options['pin_hotspot'] : [];
				foreach ($pin_hotspot as $key => $value) {
					$image_effect = !empty( $value['image_effect'] ) ? $value['image_effect'] : '';

					if( !empty( $image_effect ) ){
						if( 'pulse' === $image_effect ){
							$this->transient_widgets[] = "plus-pulse-animation";
						}else if( 'floating' === $image_effect ){
							$this->transient_widgets[] = "plus-floating-animation";
						}else if( 'tossing' === $image_effect ){
							$this->transient_widgets[] = "plus-tossing-animation";
						}else if( 'rotate-continue' === $image_effect ){
							$this->transient_widgets[] = "plus-rotating-animation";
						}else if( 'normal-drop_waves' === $image_effect ){
							/**Loade From hotspot widget css file*/
						}else if( 'image-drop_waves' === $image_effect || 'hover_drop_waves' === $image_effect){
							$this->transient_widgets[] = "plus-drop-waves-animation";
						}
					}
				}
			}

			if ( 'tp-hotspot' === $widget_name && ( ( ! empty( $options['pin_hotspot'][0]['select_option'] ) && 'lottie' === $options['pin_hotspot'][0]['select_option'] ) ) ) {
				$this->transient_widgets[] = 'plus-lottie-player';
			}

			if ( 'tp-advanced-typography' === $widget_name ) {
				$typography_listing = ! empty( $options['typography_listing'] ) ? $options['typography_listing'] : 'default';
				$circle_effect = ! empty( $options['circular_text_switch'] ) ? $options['circular_text_switch'] : 'no'; 

				if ( $typography_listing == 'listing' ) {
					$this->transient_widgets[] = 'plus-magic-scroll';
					$this->transient_widgets[] = 'plus-mousemove-parallax';
				}

				if( 'yes' === $circle_effect){
					$this->transient_widgets[] = 'tp-advanced-circle';
				}

			}

			if ( 'tp-woo-myaccount' == $widget_name ) {

				$ma_layout                 = ! empty( $options['ma_layout'] ) ? $options['ma_layout'] : 'tp_ma_l_1';
				$this->transient_widgets[] = $ma_layout;
				$this->transient_widgets[] = 'tp-woo-myaccount';

			}

			if ( 'tp-off-canvas' === $widget_name && ( ( ! empty( $options['select_toggle_canvas'] ) && 'lottie' === $options['select_toggle_canvas'] ) ) ) {
				$this->transient_widgets[] = 'plus-lottie-player';
			}

			if ( 'tp-unfold' === $widget_name && ( ( ! empty( $options['icon_type'] ) && 'lottie' === $options['icon_type'] ) ) ) {
				$this->transient_widgets[] = 'plus-lottie-player';
			}

			if ( 'tp-dynamic-listing' === $widget_name ) {

				$listing_type = ! empty ( $options['blogs_post_listing'] ) ? $options['blogs_post_listing'] : 'page_listing';

				if ( 'custom_query' === $listing_type ) {
					if ( ! empty( $options['cqid_pagination'] ) && 'yes' === $options['cqid_pagination'] ) {
						$this->transient_widgets[] = 'plus-pagination';
					}
				}
				
				if( ! empty( $options['post_extra_option'] ) ){
					$this->transient_widgets[] = 'plus-listing-load-more';
				}

				if ( 'wishlist' === $listing_type ) {	
					$this->transient_widgets[] = 'tp-woo-wishlist-dynamic-listing';
				}
			}

			if ( 'tp-woo-single-pricing' === $widget_name && ! empty( $options['swatchesloop'] ) && 'yes' === $options['swatchesloop'] ) {
				$this->transient_widgets[] = 'tp-product-listout-swatches';
			}

			if( ! empty( $widget_name ) && 'tp-woo-single-pricing' == $widget_name ) {
				if( ! empty( $options["loop_content"] ) ) {
					$progressbar = false;
					foreach ( $options["loop_content"] as $value ) {
						if( ! empty( $value['stock_progress'] ) && 'yes' === $value['stock_progress'] ){
							$progressbar = true;
							break;
						}
					}
					if( $progressbar ){
						$this->transient_widgets[] = 'tp-woo-single-price-progress';					
					}
				}
			}

			if ( 'tp-product-listout' === $widget_name ) {

				if ( ! empty( $options['display_yith_list'] ) && 'yes' === $options['display_yith_list'] ) {
					$this->transient_widgets[] = 'plus-product-listout-yithcss';
					
					if ( ! empty( $options['display_yith_quickview'] ) && 'yes' === $options['display_yith_quickview'] ) {
						$this->transient_widgets[] = 'plus-product-listout-quickview';
					}
				}
				$tpqv_option = ! empty( $options['tpqc'] ) ? $options['tpqc'] : 'default';

				if ( ! empty( $options['display_theplus_quickview'] ) && 'yes' === $options['display_theplus_quickview'] && $tpqv_option ) {
					$this->transient_widgets[] = 'tp-product-listout-qcw';
					$this->transient_widgets[] = 'tp-product-listout-swatches';
				}

				if( ! empty( $options['post_extra_option'] ) ){
					$this->transient_widgets[] = 'plus-listing-load-more';
				}

				$list_type = !empty($options['product_post_listing']) ? $options['product_post_listing'] : 'page_listing';

                if( 'recently_viewed' === $list_type ){
                    $this->transient_widgets[] = 'tp-product-recent-view';
                }
				if ( 'wishlist' === $list_type ) {	
					$this->transient_widgets[] = 'tp-woo-wishlist-product-listing';
				}
			}

			if ( 'tp-wp-login-register' === $widget_name ) {
				if ( ( ( ! empty( $options['tp_dis_pass_pattern'] ) && ( ! empty( $options['tp_dis_pass_hint'] ) && 'yes' === $options['tp_dis_pass_hint'] ) && ! empty( $options['dis_pass_hint_on'] ) ) || ( ! empty( $options['tp_dis_show_pass_icon'] ) && 'yes' === $options['tp_dis_show_pass_icon'] ) ) ) {
					$this->transient_widgets[] = 'tp-wp-login-register-ex';
				}
			}

			if ( 'tp-dynamic-smart-showcase' === $widget_name ) {

				$magazine_style = ! empty( $options['magazine_style'] ) ? $options['magazine_style'] : 'mag_one_2_2';
				
		        if(!empty($magazine_style)){
					$this->transient_widgets[] = 'tp-dynamic-smart-showcase-' . $magazine_style;
					$this->transient_widgets[] = 'tp-dynamic-smart-showcase';
				}

				if( !isset($options['show_tricker']) ){
					$this->transient_widgets[] = 'tp-dynamic-smart-showcase-post-ticker';
				}

				$style = ! empty( $options['style'] ) ? $options['style'] : 'none';

				if ( 'magazine' === $style || 'none' === $style ) {
					$this->transient_widgets[] = 'plus-carousel';
				}
				if ( 'news' === $style ) {
					$this->tp_category_filter( $options );
				}

				$layout = ! empty( $options['layout'] ) ? $options['layout'] : 'carousel';

				if ( 'carousel' === $layout ){
					$this->tp_carousel_dots( $options );
					$this->tp_carousel_arrow( $options );
				}
			}

			if ( 'tp-heading-animation' === $widget_name ) {

				$ha_style = ! empty( $options['anim_styles'] ) ? $options['anim_styles'] : 'style-1';

				if(!empty($ha_style)){
					$this->transient_widgets[] = 'tp-heading-animation-' . $ha_style;
					$this->transient_widgets[] = 'tp-heading-animation';
				}
			}

			if ( 'tp-clients-listout' === $widget_name ) {

				$this->transient_widgets[] = $this->tp_layout_listing( $options );

				$this->tp_category_filter( $options );

				if( ! empty( $options['post_extra_option'] ) ){
					$this->transient_widgets[] = 'plus-listing-load-more';
				}

				if ( ! empty( $options['post_extra_option'] ) && 'pagination' === $options['post_extra_option'] ) {
					$this->transient_widgets[] = 'plus-pagination';
				}

				$layout = ! empty( $options['layout'] ) ? $options['layout'] : 'grid';
				if ( 'carousel' == $layout ) {
					$this->tp_carousel_dots( $options );
					$this->tp_carousel_arrow( $options );
				}
			}

			if ( 'tp-video-player' === $widget_name ) {
				$img_banner = ! empty( $options['image_banner'] ) ? $options['image_banner'] : 'banner_img';;
				$icon = '';
				$show_popup = ! empty( $options['popup_video'] ) ? $options['popup_video'] : 'no';

				if( 'yes' === $show_popup || 'only_icon' === $img_banner ){
					$this->transient_widgets[] = 'plus-lity-popup';
				}

				$image_effect = !empty( $options['icon_continuous_animation'] ) ? $options['icon_continuous_animation'] : ''; 
				if( !empty( $image_effect ) && 'yes' === $image_effect ){	
					$icon_animation_effect = !empty( $options['icon_animation_effect'] ) ? $options['icon_animation_effect'] : '';

					$this->tp_continue_effect( $icon_animation_effect );
				}
			}

			if ( 'tp-dynamic-device' === $widget_name ) {
				$device_mode = ! empty( $options['device_mode'] ) ? $options['device_mode'] : 'normal';
				$tp_dd_popup = ! empty( $options['device_link_popup'] ) ? $options['device_link_popup'] : '';
				$tp_dd_link  = ! empty( $options['device_link']['url'] ) ? $options['device_link']['url'] : '';

				if ( $device_mode == 'carousal' ) {
					$this->transient_widgets[] = 'plus-carousel';
				}

				if( 'popup' === $tp_dd_popup && ! empty( $tp_dd_link )){
					$this->transient_widgets[] = 'plus-lity-popup';
				}

				$image_effect = !empty( $options['icon_continuous_animation'] ) ? $options['icon_continuous_animation'] : ''; 
				if( !empty( $image_effect ) && 'yes' === $image_effect ){	
					$icon_animation_effect = !empty( $options['icon_animation_effect'] ) ? $options['icon_animation_effect'] : '';

					$this->tp_continue_effect( $icon_animation_effect );
				}
			}

			if ( 'tp-woo-single-image' === $widget_name ) {

				$single_select      = ! empty( $options['select'] ) ? $options['select'] : 'product_gallery';
				$select_pg_style    = ! empty( $options['select_pg_style'] ) ? $options['select_pg_style'] : 'style_1';
				$hover_image_on_off = ! empty( $options['hover_image_on_off'] ) ? $options['hover_image_on_off'] : 'no';

				$this->transient_widgets[] = 'tp-single-' . "$select_pg_style";

				if ( 'yes' == $hover_image_on_off ) {
					$this->transient_widgets[] = 'tp-single-hover';
				}

				if ( 'product_gallery' == $single_select && 'style_3' == $select_pg_style ) {
					$this->transient_widgets[] = $this->tp_layout_listing( $options );
				}

					$layout = ! empty( $options['layout'] ) ? $options['layout'] : 'grid';

				if ( 'carousel' == $layout ) {

					$this->tp_carousel_dots( $options );
					$this->tp_carousel_arrow( $options );
				}
			}

			if ( 'tp-carousel-anything' == $widget_name ) {

				$this->tp_carousel_dots( $options );
				$this->tp_carousel_arrow( $options );
			}

			if ( 'tp-messagebox' === $widget_name ) {
				$dismis = ! empty( $options['dismiss'] ) ? $options['dismiss'] : 'yes';

				if ( $dismis == 'yes' ) {
					$this->transient_widgets[] = 'tp-messagebox-js';
				}
			}

			if ( 'tp-post-featured-image' === $widget_name && ! empty( $options['pfi_type'] ) && 'pfi-background' === $options['pfi_type'] ) {
				$this->transient_widgets[] = 'tp-post-featured-image-js';
			}

			if( 'tp-morphing-layouts' === $widget_name ){
				$morph_layout = ! empty( $options['morph_layout'] ) ? $options['morph_layout'] : 'normal';

				if( 'fixed_scroll' === $morph_layout ){
					$this->transient_widgets[] = 'tp-morphing-scroll';
				}
			}

			if ( 'tp-image-factory' === $widget_name ) {
				if ( ! empty( $options['bg_image_parallax'] ) && 'yes' === $options['bg_image_parallax'] ) {
					$this->transient_widgets[] = 'plus-magic-scroll';
				}
				if ( ! empty( $options['animated_style'] ) && 'animate-image' === $options['animated_style'] ) {
					$this->transient_widgets[] = 'plus-velocity';
				}
			}

			if ( 'tp-table' === $widget_name ) {
				$table_headings = array_search( 'yes', array_column( $options['table_headings'], 'heading_show_tooltips' ) );
				$table_content  = array_search( 'yes', array_column( $options['table_content'], 'body_show_tooltips' ) );

				if ( ! empty( $table_headings ) || ! empty( $table_content ) || $table_headings === 0 || $table_content === 0 ) {
					$this->transient_widgets[] = 'plus-tooltip';
				}
                 
				$button_style = ! empty( $options['cell_button_style'] ) ? $options['cell_button_style'] : 'style-8';

				$this->tp_button_style( $button_style );

			}

			if ( 'tp-cascading-image' === $widget_name ) {
				if ( ! empty( $options['image_cascading'] ) ) {
					$magic_scroll = array_search( 'yes', array_column( $options['image_cascading'], 'loop_magic_scroll' ) );
					if ( ! empty( $magic_scroll ) || 0 === $magic_scroll ) {
						$this->transient_widgets[] = 'plus-magic-scroll';
					}
					$plus_tooltip = array_search( 'yes', array_column( $options['image_cascading'], 'plus_tooltip' ) );
					if ( ! empty( $plus_tooltip ) || 0 === $plus_tooltip ) {
						$this->transient_widgets[] = 'plus-tooltip';
					}
					$special_effect = array_search( 'yes', array_column( $options['image_cascading'], 'special_effect' ) );
					if ( ! empty( $special_effect ) || 0 === $special_effect ) {
						$this->transient_widgets[] = 'plus-reveal-animation';
					}
					$move_parallax = array_search( 'yes', array_column( $options['image_cascading'], 'cascading_move_parallax' ) );
					if ( ! empty( $move_parallax ) || 0 === $move_parallax ) {
						$this->transient_widgets[] = 'plus-mousemove-parallax';
					}
					$hover_parallax = array_search( 'yes', array_column( $options['image_cascading'], 'hover_parallax' ) );
					if ( ! empty( $hover_parallax ) || 0 === $hover_parallax ) {
						$this->transient_widgets[] = 'plus-hover3d';
					}
					$link_option = array_search( 'popup_link', array_column( $options['image_cascading'], 'link_option' ) );
					if ( ! empty( $link_option ) || 0 === $link_option ) {
						$this->transient_widgets[] = 'plus-lity-popup';
					}
				}

				$cascading_effects = 0;
				foreach ($options['image_cascading'] as $key => $value) {
					$image_effect = !empty( $value['image_effect'] ) ? $value['image_effect'] : '';

					if( !empty( $image_effect ) ){
						if( 'pulse' === $image_effect ){
							$this->transient_widgets[] = "plus-pulse-animation";
						}else if( 'floating' === $image_effect ){
							$this->transient_widgets[] = "plus-floating-animation";
						}else if( 'tossing' === $image_effect ){
							$this->transient_widgets[] = "plus-tossing-animation";
						}else if( 'rotate-continue' === $image_effect ){
							$this->transient_widgets[] = "plus-rotating-animation";
						}else if( 'drop-waves' === $image_effect ){
							// $this->transient_widgets[] = "plus-drop-waves-animation";
						}else if( 'continue-scale' === $image_effect ){
							$this->transient_widgets[] = "plus-continue-scale-animation";
						}
					}
				}
			}

			if ( 'tp-style-list' === $widget_name ) {
				if ( ! empty( $options['icon_list'] ) ) {
					$show_tooltips = array_search( 'yes', array_column( $options['icon_list'], 'show_tooltips' ) );
					if ( ! empty( $show_tooltips ) || $show_tooltips === 0 ) {
						$this->transient_widgets[] = 'plus-tooltip';
					}
				}
			}

			if ( 'tp-shape-divider' === $widget_name ) {
				if ( ! empty( $options['shape_divider'] ) && 'wave' === $options['shape_divider'] ) {
					$this->transient_widgets[] = 'plus-wavify';
				}
			}

			if ( 'tp-row-background' === $widget_name ) {
				if ( ! empty( $options['select_anim'] ) && 'bg_gallery' === $options['select_anim'] ) {
					$this->transient_widgets[] = 'plus-vegas-gallery';
				}
				if ( ! empty( $options['select_anim'] ) && 'bg_color' === $options['select_anim'] ) {
					$this->transient_widgets[] = 'plus-row-animated-color';
				}
				if ( ! empty( $options['select_anim'] ) && 'bg_Image_pieces' === $options['select_anim'] ) {
					$this->transient_widgets[] = 'plus-row-segmentation';
				}
				if ( ! empty( $options['bg_img_parallax'] ) && 'yes' === $options['bg_img_parallax'] ) {
					$this->transient_widgets[] = 'plus-magic-scroll';
				}
				if ( ! empty( $options['select_anim'] ) && 'scroll_animate_color' === $options['select_anim'] ) {
					$this->transient_widgets[] = 'plus-row-scroll-color';
				}
				if ( ! empty( $options['middle_style'] ) && 'canvas' === $options['middle_style'] ) {

					$canvas_style = ! empty( $options['canvas_style'] ) ? $options['canvas_style'] : 'style_1';

					if ( 'style_8' === $canvas_style ) {
						$this->transient_widgets[] = 'plus-row-canvas-8';
					}
					if ( 'style_2' === $canvas_style || 'style_3' === $canvas_style || 'style_4' === $canvas_style || 'style_5' === $canvas_style || 'style_7' === $canvas_style || 'custom' === $canvas_style ) {
						$this->transient_widgets[] = 'plus-row-canvas-particle';
					}
					if ( 'style_6' === $canvas_style ) {
						$this->transient_widgets[] = 'plus-row-canvas-particleground';
					}
				}
				if ( ! empty( $options['middle_style'] ) && ( 'mordern_parallax' === $options['middle_style'] || 'mordern_image_effect' === $options['middle_style'] || 'multi_layered_parallax' === $options['middle_style'] ) ) {
					$this->transient_widgets[] = 'plus-magic-scroll';
				}

				//Continues Animation
				foreach ($options['mordern_effects'] as $key => $value) {
					$image_effect = !empty( $value['mordern_effect'] ) ? $value['mordern_effect'] : '';

					if( !empty( $image_effect ) ){
						if( 'pulse' === $image_effect ){
							$this->transient_widgets[] = "plus-pulse-animation";
						}else if( 'floating' === $image_effect ){
							$this->transient_widgets[] = "plus-floating-animation";
						}else if( 'tossing' === $image_effect ){
							$this->transient_widgets[] = "plus-tossing-animation";
						}else if( 'rotating' === $image_effect ){
							$this->transient_widgets[] = "plus-rotating-animation";
						}
					}
				}
			}

			if ( 'tp-dynamic-categories' === $widget_name ) {

				$this->transient_widgets[] = $this->tp_layout_listing( $options );

				$head_style = ! empty( $options['style'] ) ? $options['style'] : 'style_1';

				if(!empty($head_style)){
					$this->transient_widgets[] = 'tp-dynamic-categories-' . $head_style;
					$this->transient_widgets[] = 'tp-dynamic-categories';
				}

				if ( 'style_3' === $head_style ) {

					$this->transient_widgets[] = 'tp-dynamic-categories-st3';
				}

				$layout = ! empty( $options['layout'] ) ? $options['layout'] : 'grid';

				if ( 'carousel' === $layout ) {

					$show_arrows = isset( $options['slider_arrows'] ) ? $options['slider_arrows'] : '';

					$slider_arrows_style = ! empty( $options['slider_arrows_style'] ) ? $options['slider_arrows_style'] : 'style-1';

					if ( 'yes' === $show_arrows ) {
						
						$this->transient_widgets[] = 'tp-arrows-' . $slider_arrows_style;
						$this->transient_widgets[] = 'tp-arrows-style';
					}

					$sliderDots        = isset( $options['slider_dots'] ) ? $options['slider_dots'] : 'yes';
					$slider_dots_style = ! empty( $options['slider_dots_style'] ) ? $options['slider_dots_style'] : 'style-1';
					if ( 'yes' === $sliderDots ) {
						$this->transient_widgets[] = 'tp-carousel-' . $slider_dots_style;
						$this->transient_widgets[] = 'tp-carousel-style';
					}
				}
			}

			if ( 'tp-advanced-typography' === $widget_name ) {
				if ( ! empty( $options['on_hover_img_reveal_switch'] ) && 'yes' === $options['on_hover_img_reveal_switch'] ) {
					$this->transient_widgets[] = 'plus-adv-typo-extra-js-css';
				}
				if ( ! empty( $options['typography_listing'] ) && 'listing' === $options['typography_listing'] ) {
					if ( ! empty( $options['listing_content'] ) ) {
						$hover_image = false;
						foreach ( $options['listing_content'] as $value ) {
							if ( ! empty( $value['on_hover_img_reveal_switch'] ) && 'yes' === $value['on_hover_img_reveal_switch'] ) {
								$hover_image = true;
								break;
							}
						}
						if ( $hover_image ) {
							$this->transient_widgets[] = 'plus-adv-typo-extra-js-css';
						}
					}
				}
			}

			if ( 'tp-scroll-sequence' === $widget_name ) {
				if ( ! empty( $options['stickySec'] ) && 'yes' === $options['stickySec'] ) {
					$this->transient_widgets[] = 'plus-key-animations';
				}
			}

			if ( 'tp-product-listout' === $widget_name || 'tp-dynamic-listing' === $widget_name ) {
				$paginationtype = ! empty( $options['paginationType'] ) ? $options['paginationType'] : '';

				if ( 'ajaxbased' === $paginationtype ) {
					$this->transient_widgets[] = 'tp-ajax-based-pagination';
				}
			}

			if ( 'column' === $widget_name ) {

				if ( ! empty( $options['plus_column_sticky'] ) && 'true' === $options['plus_column_sticky'] ) {
					$this->transient_widgets[] = 'plus-extras-column';
				}
				if ( ! empty( $options['plus_column_cursor_point'] ) && $options['plus_column_cursor_point'] == 'yes' ) {
					$this->transient_widgets[] = 'plus-column-cursor';
				}
			}
		}

		if ( version_compare( ELEMENTOR_VERSION, '3.1.0', '>=' ) && ! empty( $widget_name ) ) {
			if ( 'tp-tabs-tours' === $widget_name || 'tp-navigation-menu' === $widget_name ) {
				
				$tabswiper = ! empty( $options['tabs_swiper'] ) ? $options['tabs_swiper'] : 'no';
				$mobile_menu = ! empty( $options['show_mobile_menu'] ) ? $options['show_mobile_menu'] : 'yes';
				$menu_type = ! empty( $options['mobile_menu_type'] ) ? $options['mobile_menu_type'] : 'toggle';

				if ( 'yes' === $tabswiper || ( 'yes' === $mobile_menu && 'swiper' === $menu_type ) ) {
					$this->transient_widgets[] = 'plus-swiper';
				}
			}

			if( 'tp-mobile-menu' === $widget_name ){
				$dis_mode = ! empty( $options['mm_extra_display_mode'] ) ? $options['mm_extra_display_mode'] : 'swiper';
				
				if( 'swiper' === $dis_mode ){
					$this->transient_widgets[] = 'plus-swiper';
				}
			}
		}

		if ( ! empty( $this->transient_widgets ) ) {
			$widgets = array_merge( $widgets, $this->transient_widgets );
		}

		return $widgets;
	}
   
	/**
	 * Enqueue editor scripts
	 *
	 * @since 2.2.0
	 *
	 * @access public
	 */
	public function enqueue_editor_scripts() {
		// Register scripts
		wp_enqueue_script( 'plus-editor-js', $this->pathurl_security(THEPLUS_URL . DIRECTORY_SEPARATOR .  'assets/js/admin/plus-editor.min.js'), [], THEPLUS_VERSION, true );
		
		wp_localize_script( 'plus-editor-js', 'PlusEditor_localize', array(
			'plugin' => THEPLUS_URL,
			'ajax' => admin_url( 'admin-ajax.php' ),
			'delete_transient_nonce' => wp_create_nonce( 'delete_transient_nonce' ),
			'SocialReview_nonce' => wp_create_nonce('SocialReview_nonce'),
			'live_editor' => wp_create_nonce('live_editor'),
			'THEPLUS_ASSETS_URL' => THEPLUS_ASSETS_URL,
		));
		
	}
	
	//Plus Addons Scripts
	public function plus_enqueue_scripts() {
	
		if (theplus_library()->is_preview_mode()) {
			
			//Load Icons Mind
			$options = get_option( 'theplus_api_connection_data' );
			$load_font_id=array();
			if(isset($options["load_icons_mind_ids"]) && !empty($options["load_icons_mind_ids"])){
				$load_font_id = explode(",", $options["load_icons_mind_ids"]);
			}
			$paged_id = get_queried_object_id();
			if(!isset($options["load_icons_mind"]) || (isset($options["load_icons_mind"]) && !empty($options["load_icons_mind"]) && $options["load_icons_mind"]=='enable') || ( isset($options["load_icons_mind"]) && $options["load_icons_mind"]=='disable' && in_array($paged_id,$load_font_id) )){
				wp_enqueue_style(
					'plus-icons-mind-css',
					$this->pathurl_security(THEPLUS_URL . '/assets/css/extra/iconsmind.min.css'),
					false,
					THEPLUS_VERSION
				);
			}
			
			//Load pre loader
			$load_pre_loader_id=array();
			if(isset($options["load_pre_loader_func_ids"]) && !empty($options["load_pre_loader_func_ids"])){
				$load_pre_loader_id = explode(",", $options["load_pre_loader_func_ids"]);
			}
			$pre_load_paged_id = get_queried_object_id();
			if(!isset($options["load_pre_loader_func"]) || (isset($options["load_pre_loader_func"]) && !empty($options["load_pre_loader_func"]) && $options["load_pre_loader_func"]=='enable') || ( isset($options["load_pre_loader_func"]) && $options["load_pre_loader_func"]=='disable' && in_array($pre_load_paged_id,$load_pre_loader_id) )){
				
				wp_enqueue_style(
					'plus-pre-loader-css',
					$this->pathurl_security(THEPLUS_URL . '/assets/css/main/pre-loader/plus-pre-loader.min.css'),
					false,
					THEPLUS_VERSION
				);
				wp_enqueue_script(
					'plus-pre-loader-js2',
					$this->pathurl_security(THEPLUS_URL . '/assets/js/main/pre-loader/plus-pre-loader-extra-transition.min.js'),
					false,
					THEPLUS_VERSION
				);
				wp_enqueue_script(
					'plus-pre-loader-js',
					$this->pathurl_security(THEPLUS_URL . '/assets/js/main/pre-loader/plus-pre-loader.min.js'),
					false,
					THEPLUS_VERSION
				);
				
				if(!empty($options["load_pre_loader_lottie_js"]) && $options["load_pre_loader_lottie_js"]=='on'){				
					wp_enqueue_script('plus-pre-loader-lotties',$this->pathurl_security(THEPLUS_URL . '/assets/js/extra/lottie-player.js'),
						false,THEPLUS_VERSION);
				}
			}
			
			//Google Map Api			
			$check_elements=theplus_get_option('general','check_elements');
			$switch_api = (!empty($options['gmap_api_switch'])) ? $options['gmap_api_switch'] : '';
			if((empty($theplus_options) || (isset($check_elements) && !empty($check_elements) && in_array('tp_google_map',$check_elements))) && (empty($switch_api) || $switch_api=='enable' || $switch_api!='none') ){
				if(!empty($options['theplus_google_map_api'])){
					$theplus_google_map_api=$options['theplus_google_map_api'];
				}else{
					$theplus_google_map_api='';
				}
				wp_enqueue_script( 'gmaps-js','https://maps.googleapis.com/maps/api/js?key='.$theplus_google_map_api.'&libraries=places&sensor=false', array('jquery'), null, false, true);
			}
			
			if((isset($check_elements) && !empty($check_elements) && in_array('tp_wp_bodymovin',$check_elements)) && !empty($options['bodymovin_load_js_check'])){
				wp_enqueue_script( 'lottieplayer' , $this->pathurl_security(THEPLUS_URL . DIRECTORY_SEPARATOR .  'assets/js/extra/lottie-player.js'), array()); //Lottie Player
				wp_enqueue_script( 'lottie' , $this->pathurl_security(THEPLUS_URL . DIRECTORY_SEPARATOR .  'assets/js/extra/lottie.min.js'), array(), '5.5.2' ); //Bodymovin Animation
				wp_enqueue_script( 'theplus-bodymovin' , $this->pathurl_security(THEPLUS_URL . DIRECTORY_SEPARATOR .  'assets/js/main/bodymovin/plus-bodymovin.js'), array( 'jquery', 'lottie' ), THEPLUS_VERSION, true );
			}
			
			wp_enqueue_script( 'jquery-ui-slider' );//Audio Player	
			
			wp_enqueue_script( 'jquery-ui-draggable' );//dragable
			wp_enqueue_script( 'jquery-touch-punch' );//touch

		} else {
			global $wp_query;

			if (is_home() || is_singular() || is_archive() || is_search() || (isset( $wp_query ) && (bool) $wp_query->is_posts_page) || is_404()) {
				
				$queried_obj = get_queried_object_id();
				if(is_search()){
					$queried_obj = 'search';
				}

				if(is_404()){
					$queried_obj = '404';
				}

				$post_type = (is_singular() ? 'post' : 'term');
				
				$elements = theplus_get_option( 'general', 'check_elements' );
				$this->enqueue_frontend_pre_loader_load();

				if ( empty( $elements ) ) {
					return;
				}

				if( in_array( 'tp_google_map', $elements ) ){
					$this->enqueue_frontend_google_map_load();
				}				

				$this->enqueue_frontend_load();
			}
		}
	}

	protected function enqueue_frontend_google_map_load(){
		//Google Map Api		
		$check_elements=theplus_get_option('general','check_elements');
		$options = get_option( 'theplus_api_connection_data' );
		$switch_api = (!empty($options['gmap_api_switch'])) ? $options['gmap_api_switch'] : '';	
		if((empty($theplus_options) || (isset($check_elements) && !empty($check_elements) && in_array('tp_google_map',$check_elements))) && (empty($switch_api) || $switch_api=='enable')){
			if(!empty($options['theplus_google_map_api'])){
				$theplus_google_map_api=$options['theplus_google_map_api'];
			}else{
				$theplus_google_map_api='';
			}
			wp_enqueue_script( 'gmaps-js','https://maps.googleapis.com/maps/api/js?key='.$theplus_google_map_api.'&libraries=places&sensor=false', array('jquery'), null, false, true);
		}
	}

	/**
	 * Extra Option pre-loader js load
	 * 
	 * @since 5.2.2
	 */
	protected function enqueue_frontend_pre_loader_load() {
		$options = get_option( 'theplus_api_connection_data' );
		$pre_load_paged_id = get_queried_object_id();
		$load_pre_loader_id = array();

		$PreLoader_Pageids = !empty($options["load_pre_loader_func_ids"]) ? $options["load_pre_loader_func_ids"] : '';

		if( isset($PreLoader_Pageids) ){
			$load_pre_loader_id = explode(",", $PreLoader_Pageids);
		}

		$Ex_PreLoader = !empty($options["load_pre_loader_func"]) ? $options["load_pre_loader_func"] : '';
		if( (!empty($Ex_PreLoader) && $Ex_PreLoader == "enable") || ($Ex_PreLoader == "disable" && in_array($pre_load_paged_id, $load_pre_loader_id) ) ){
			wp_enqueue_style('plus-pre-loader-css',
				$this->pathurl_security( THEPLUS_URL .'/assets/css/main/pre-loader/plus-pre-loader.min.css' ),
				false, THEPLUS_VERSION
			);

			wp_enqueue_script('plus-pre-loader-js2',
				$this->pathurl_security( THEPLUS_URL . '/assets/js/main/pre-loader/plus-pre-loader-extra-transition.min.js' ), 
				array('jquery'), THEPLUS_VERSION
			);

			wp_enqueue_script('plus-pre-loader-js',
				$this->pathurl_security( THEPLUS_URL . '/assets/js/main/pre-loader/plus-pre-loader.min.js' ),
				array('jquery'), THEPLUS_VERSION
			);

			$Ex_PreLoader_lottieJS = !empty($options["load_pre_loader_lottie_js"]) ? $options["load_pre_loader_lottie_js"] : '';
			if( !empty($Ex_PreLoader_lottieJS) && $Ex_PreLoader_lottieJS == 'on' ){
				wp_enqueue_script('plus-pre-loader-lotties',
					$this->pathurl_security( THEPLUS_URL . '/assets/js/extra/lottie-player.js' ),
					false, THEPLUS_VERSION
				);
			}
		}
	}

	// rules how css will be enqueued on front-end
	protected function enqueue_frontend_load() {
		
		wp_register_script( 'lottie' , $this->pathurl_security(THEPLUS_URL . DIRECTORY_SEPARATOR .  'assets/js/extra/lottie.min.js'), array(), '5.5.2' ); //Bodymovin Animation
		wp_register_script( 'theplus-bodymovin' , $this->pathurl_security(THEPLUS_URL . DIRECTORY_SEPARATOR .  'assets/js/main/bodymovin/plus-bodymovin.js'), array( 'jquery', 'lottie' ), THEPLUS_VERSION, true );
		
		//Load Icons Mind
		$options = get_option( 'theplus_api_connection_data' );
		$load_font_id=array();
		if(isset($options["load_icons_mind_ids"]) && !empty($options["load_icons_mind_ids"])){
			$load_font_id = explode(",", $options["load_icons_mind_ids"]);
		}
		
		$paged_id = get_queried_object_id();
		if(!isset($options["load_icons_mind"]) || (isset($options["load_icons_mind"]) && !empty($options["load_icons_mind"]) && $options["load_icons_mind"]=='enable') || ( isset($options["load_icons_mind"]) && $options["load_icons_mind"]=='disable' && in_array($paged_id,$load_font_id) )){
			wp_enqueue_style('plus-icons-mind-css',$this->pathurl_security(THEPLUS_URL . '/assets/css/extra/iconsmind.min.css'),false,THEPLUS_VERSION);
		}

		/*sociel login google*/
		$options = get_option( 'theplus_api_connection_data' );		
		if((empty($theplus_options) || (isset($check_elements) && !empty($check_elements) && in_array('tp_wp_login_register',$check_elements))) && !empty($options['theplus_google_client_id'])){
			wp_enqueue_script( 'google_clientid_js', 'https://apis.google.com/js/api:client.js', array('jquery'), null, false, true);
			wp_enqueue_script( 'google_platform_js', 'https://apis.google.com/js/platform.js', array('jquery'), null, false, true);
		}
		/*sociel login google*/
		
		wp_enqueue_script( 'jquery-ui-slider' ); //Audio Player
		
		wp_enqueue_script( 'jquery-ui-draggable' ); //dragable
		wp_enqueue_script( 'jquery-touch-punch' ); //touch
	}
	
	/**
	 * Generate secure path url
	 *
	 * @since v2.0
	 */
	public function pathurl_security($url) {
        return preg_replace(['/^http:/', '/^https:/', '/(?!^)\/\//'], ['', '', '/'], $url);
    }
	public function tp_pro_registered_widgets(){
		return $this->registered_widgets;
	}
	
	public function init(){
		$this->registered_widgets = registered_widgets();
		
		add_filter('theplus_pro_registered_widgets',array($this,'tp_pro_registered_widgets'));
		add_filter('tp_has_widgets_condition',array($this,'plus_widgets_options'), 10 , 3);

		$this->transient_widgets = [];
		$this->transient_extensions = [];
		
		add_filter('tp_pro_transient_widgets', array($this,'tp_pro_transient_widget'));
		
		add_action( 'elementor/editor/before_enqueue_scripts', array($this, 'enqueue_editor_scripts') );
		
		
		add_action('wp_enqueue_scripts', array($this, 'plus_enqueue_scripts'));
				
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
 * Returns instance of Plus_Generator
 */
function theplus_generator() {
	return Plus_Generator::get_instance();
}