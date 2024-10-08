<?php

$settings = $this->get_settings_for_display();

$widget_name = '';
$data_slider = '';

$slider_direction = $settings['slider_direction'] == 'vertical' ? 'true' : 'false';

$data_slider .= ' data-slider_direction="' . esc_attr( $slider_direction ) . '"';
$data_slider .= ' data-slide_speed="' . esc_attr( $settings['slide_speed']['size'] ) . '"';

$data_slider .= ' data-slider_desktop_column="' . esc_attr( $settings['slider_desktop_column'] ) . '"';
$data_slider .= ' data-steps_slide="' . esc_attr( $settings['steps_slide'] ) . '"';

$slider_draggable = $settings['slider_draggable'] == 'yes' ? 'true' : 'false';

$data_slider .= ' data-slider_draggable="' . esc_attr( $slider_draggable ) . '"';

$widget_name = $this->get_name();

if ( 'tp-social-feed' === $widget_name || 'tp-social-reviews' === $widget_name || 'tp-dynamic-smart-showcase' === $widget_name || 'tp-woo-single-image' === $widget_name ) {
	$multi_drag = '';
} else {
	$multi_drag   = $settings['multi_drag'] == 'yes' ? 'true' : 'false';
	$data_slider .= ' data-multi_drag="' . esc_attr( $multi_drag ) . '"';
}

$slider_infinite        = ( $settings['slider_infinite'] == 'yes' ) ? 'true' : 'false';
$data_slider           .= ' data-slider_infinite="' . esc_attr( $slider_infinite ) . '"';
$slider_pause_hover     = ( $settings['slider_pause_hover'] == 'yes' ) ? 'true' : 'false';
$data_slider           .= ' data-slider_pause_hover="' . esc_attr( $slider_pause_hover ) . '"';
$slider_adaptive_height = ( $settings['slider_adaptive_height'] == 'yes' ) ? 'true' : 'false';
$data_slider           .= ' data-slider_adaptive_height="' . esc_attr( $slider_adaptive_height ) . '"';

if ( 'tp-dynamic-smart-showcase' === $widget_name || 'tp-woo-single-image' === $widget_name ) {
	$slider_animation = '';
} else {
	$slider_animation = $settings['slider_animation'];
	$data_slider     .= ' data-slider_animation="' . esc_attr( $slider_animation ) . '"';
}

$slider_autoplay = ( $settings['slider_autoplay'] == 'yes' ) ? 'true' : 'false';
$data_slider    .= ' data-slider_autoplay="' . esc_attr( $slider_autoplay ) . '"';
$data_slider    .= ' data-autoplay_speed="' . esc_attr( ! empty( $settings['autoplay_speed']['size'] ) ? $settings['autoplay_speed']['size'] : 3000 ) . '"';

// tablet
$data_slider .= ' data-slider_tablet_column="' . esc_attr( $settings['slider_tablet_column'] ) . '"';
$data_slider .= ' data-tablet_steps_slide="' . esc_attr( $settings['tablet_steps_slide'] ) . '"';

$slider_responsive_tablet = $settings['slider_responsive_tablet'];

$data_slider .= ' data-slider_responsive_tablet="' . esc_attr( $slider_responsive_tablet ) . '"';

if ( ! empty( $settings['slider_responsive_tablet'] ) && $settings['slider_responsive_tablet'] == 'yes' ) {
	$tablet_slider_draggable = ( $settings['tablet_slider_draggable'] == 'yes' ) ? 'true' : 'false';
	$data_slider            .= ' data-tablet_slider_draggable="' . esc_attr( $tablet_slider_draggable ) . '"';
	$tablet_slider_infinite  = ( $settings['tablet_slider_infinite'] == 'yes' ) ? 'true' : 'false';
	$data_slider            .= ' data-tablet_slider_infinite="' . esc_attr( $tablet_slider_infinite ) . '"';
	$tablet_slider_autoplay  = ( $settings['tablet_slider_autoplay'] == 'yes' ) ? 'true' : 'false';
	$data_slider            .= ' data-tablet_slider_autoplay="' . esc_attr( $tablet_slider_autoplay ) . '"';
	$tablet_autoplay_speed   = isset( $settings['tablet_autoplay_speed']['size'] ) ? $settings['tablet_autoplay_speed']['size'] : '1500';
	$data_slider            .= ' data-tablet_autoplay_speed="' . esc_attr( $tablet_autoplay_speed ) . '"';
	$tablet_slider_dots      = ( $settings['tablet_slider_dots'] == 'yes' ) ? 'true' : 'false';
	$data_slider            .= ' data-tablet_slider_dots="' . esc_attr( $tablet_slider_dots ) . '"';
	$data_slider .= ' data-tablet_slider_dots_style="slick-dots ' . ( isset( $settings['tablet_slider_dots_style'] ) ? esc_attr( $settings['tablet_slider_dots_style'] ) : 'style-1' ) . '" ';
	$tablet_slider_arrows    = ( $settings['tablet_slider_arrows'] == 'yes' ) ? 'true' : 'false';
	$data_slider            .= ' data-tablet_slider_arrows="' . esc_attr( $tablet_slider_arrows ) . '"';
	$data_slider            .= ' data-tablet_slider_rows="' . esc_attr( $settings['tablet_slider_rows'] ) . '"';
	$data_slider .= ' data-tablet_slider_arrows_style="' . ( isset( $settings['tablet_slider_arrows_style'] ) ? esc_attr( $settings['tablet_slider_arrows_style'] ) : 'style-1' ) . '" ';
	$data_slider .= ' data-tablet_arrows_position="' . ( isset( $settings['tablet_arrows_position'] ) ? esc_attr( $settings['tablet_arrows_position'] ) : 'top-right' ) . '" ';
	$data_slider .= ' data-tablet_arrow_bg_color="' . ( isset( $settings['tablet_arrow_bg_color'] ) ? esc_attr( $settings['tablet_arrow_bg_color'] ) : '#c44d48' ) . '" ';
	$data_slider .= ' data-tablet_arrow_icon_color="' . ( isset( $settings['tablet_arrow_icon_color'] ) ? esc_attr( $settings['tablet_arrow_icon_color'] ) : '#fff' ) . '" ';
	$data_slider .= ' data-tablet_arrow_hover_bg_color="' . ( isset( $settings['tablet_arrow_hover_bg_color'] ) ? esc_attr( $settings['tablet_arrow_hover_bg_color'] ) : '#fff' ) . '" ';
	$data_slider .= ' data-tablet_arrow_hover_icon_color="' . ( isset( $settings['tablet_arrow_hover_icon_color'] ) ? esc_attr( $settings['tablet_arrow_hover_icon_color'] ) : '#c44d48' ) . '" ';
	$tablet_center_mode      = ( $settings['tablet_center_mode'] == 'yes' ) ? 'true' : 'false';
	$data_slider            .= ' data-tablet_center_mode="' . esc_attr( $tablet_center_mode ) . '" ';
	$data_slider            .= ' data-tablet_center_padding="' . esc_attr( ! empty( $settings['tablet_center_padding']['size'] ) ? $settings['tablet_center_padding']['size'] : 0 ) . '" ';
}

// mobile
$data_slider .= ' data-slider_mobile_column="' . esc_attr( $settings['slider_mobile_column'] ) . '"';
$data_slider .= ' data-mobile_steps_slide="' . esc_attr( $settings['mobile_steps_slide'] ) . '"';

$slider_responsive_mobile = $settings['slider_responsive_mobile'];

$data_slider .= ' data-slider_responsive_mobile="' . esc_attr( $slider_responsive_mobile ) . '"';

if ( ! empty( $settings['slider_responsive_mobile'] ) && $settings['slider_responsive_mobile'] == 'yes' ) {
	$mobile_slider_draggable = ( $settings['mobile_slider_draggable'] == 'yes' ) ? 'true' : 'false';
	$data_slider            .= ' data-mobile_slider_draggable="' . esc_attr( $mobile_slider_draggable ) . '"';
	$mobile_slider_infinite  = ( $settings['mobile_slider_infinite'] == 'yes' ) ? 'true' : 'false';
	$data_slider            .= ' data-mobile_slider_infinite="' . esc_attr( $mobile_slider_infinite ) . '"';
	$mobile_slider_autoplay  = ( $settings['mobile_slider_autoplay'] == 'yes' ) ? 'true' : 'false';
	$data_slider            .= ' data-mobile_slider_autoplay="' . esc_attr( $mobile_slider_autoplay ) . '"';
	$data_slider            .= ' data-mobile_autoplay_speed="' . ( isset( $settings['mobile_autoplay_speed']['size'] ) ? esc_attr( $settings['mobile_autoplay_speed']['size'] ) : '1500' ) . '"';
	$mobile_slider_dots      = ( $settings['mobile_slider_dots'] == 'yes' ) ? 'true' : 'false';
	$data_slider            .= ' data-mobile_slider_dots="' . esc_attr( $mobile_slider_dots ) . '"';
	$data_slider .= ' data-mobile_slider_dots_style="slick-dots ' . ( isset( $settings['mobile_slider_dots_style'] ) ? esc_attr( $settings['mobile_slider_dots_style'] ) : 'style-1' ) . '" ';
	$mobile_slider_arrows    = ( $settings['mobile_slider_arrows'] == 'yes' ) ? 'true' : 'false';
	$data_slider            .= ' data-mobile_slider_arrows="' . esc_attr( $mobile_slider_arrows ) . '"';
	$data_slider            .= ' data-mobile_slider_rows="' . esc_attr( $settings['mobile_slider_rows'] ) . '"';
	$data_slider .= ' data-mobile_slider_arrows_style="' . ( isset( $settings['mobile_slider_arrows_style'] ) ? esc_attr( $settings['mobile_slider_arrows_style'] ) : 'style-1' ) . '" ';
	$data_slider .= ' data-mobile_arrows_position="' . ( isset( $settings['mobile_arrows_position'] ) ? esc_attr( $settings['mobile_arrows_position'] ) : 'top-right' ) . '" ';
	$data_slider .= ' data-mobile_arrow_bg_color="' . ( isset( $settings['mobile_arrow_bg_color'] ) ? esc_attr( $settings['mobile_arrow_bg_color'] ) : '#c44d48' ) . '" ';
	$data_slider .= ' data-mobile_arrow_icon_color="' . ( isset( $settings['mobile_arrow_icon_color'] ) ? esc_attr( $settings['mobile_arrow_icon_color'] ) : '#fff' ) . '" ';
	$data_slider .= ' data-mobile_arrow_hover_bg_color="' . ( isset( $settings['mobile_arrow_hover_bg_color'] ) ? esc_attr( $settings['mobile_arrow_hover_bg_color'] ) : '#fff' ) . '" ';
	$data_slider .= ' data-mobile_arrow_hover_icon_color="' . ( isset( $settings['mobile_arrow_hover_icon_color'] ) ? esc_attr( $settings['mobile_arrow_hover_icon_color'] ) : '#c44d48' ) . '" ';
	$mobile_center_mode      = ( $settings['mobile_center_mode'] == 'yes' ) ? 'true' : 'false';
	$data_slider            .= ' data-mobile_center_mode="' . esc_attr( $mobile_center_mode ) . '" ';
	$data_slider            .= ' data-mobile_center_padding="' . ( isset( $settings['mobile_center_padding']['size'] ) ? esc_attr( $settings['mobile_center_padding']['size'] ) : '0' ) . '"';
}

$slider_dots  = ( $settings['slider_dots'] == 'yes' ) ? 'true' : 'false';
$data_slider .= ' data-slider_dots="' . esc_attr( $slider_dots ) . '"';
$data_slider .= ' data-slider_dots_style="slick-dots ' . esc_attr( $settings['slider_dots_style'] ) . '"';

$slider_arrows = ( $settings['slider_arrows'] == 'yes' ) ? 'true' : 'false';
$data_slider  .= ' data-slider_arrows="' . esc_attr( $slider_arrows ) . '"';
$data_slider  .= ' data-slider_arrows_style="' . esc_attr( $settings['slider_arrows_style'] ) . '" ';
$data_slider  .= ' data-arrows_position="' . esc_attr( $settings['arrows_position'] ) . '" ';
$data_slider  .= ' data-arrow_bg_color="' . (isset($settings['arrow_bg_color']) ? esc_attr($settings['arrow_bg_color']) : '') . '" ';
$data_slider  .= ' data-arrow_icon_color="' . (isset($settings['arrow_icon_color']) ? esc_attr($settings['arrow_icon_color']) : '') . '" ';
$data_slider  .= ' data-arrow_hover_bg_color="' . (isset($settings['arrow_hover_bg_color']) ? esc_attr($settings['arrow_hover_bg_color']) : '') . '" ';
$data_slider  .= ' data-arrow_hover_icon_color="' . (isset($settings['arrow_hover_icon_color']) ? esc_attr($settings['arrow_hover_icon_color']) : '') . '" ';

$slider_center_mode = ( $settings['slider_center_mode'] == 'yes' ) ? 'true' : 'false';
$data_slider       .= ' data-slider_center_mode="' . esc_attr( $slider_center_mode ) . '" ';
$data_slider       .= ' data-center_padding="' . esc_attr( ( ! empty( $settings['center_padding']['size'] ) ) ? $settings['center_padding']['size'] : 0 ) . '" ';
$data_slider       .= ' data-scale_center_slide="' . esc_attr( ( ! empty( $settings['scale_center_slide']['size'] ) ) ? $settings['scale_center_slide']['size'] : 1 ) . '" ';
$data_slider       .= ' data-scale_normal_slide="' . esc_attr( ( ! empty( $settings['scale_normal_slide']['size'] ) ) ? $settings['scale_normal_slide']['size'] : 0.8 ) . '" ';
$data_slider       .= ' data-opacity_normal_slide="' . esc_attr( ( ! empty( $settings['opacity_normal_slide']['size'] ) ) ? $settings['opacity_normal_slide']['size'] : 0.7 ) . '" ';

$data_slider .= ' data-slider_rows="' . esc_attr( $settings['slider_rows'] ) . '" ';

return $data_slider;