<?php
/*
Plugin Name: Image Magnifier
Description: Adds a magnifier effect to featured images in custom post types.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class ImageMagnifier {
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_filter('the_content', array($this, 'add_magnifier_to_content'), 20);
        add_action('wp_footer', array($this, 'add_magnifier_html'));
    }

    public function enqueue_scripts() {
        if (is_singular() && has_post_thumbnail()) {
            wp_enqueue_style('image-magnifier', plugin_dir_url(__FILE__) . 'css/magnifier.css', array(), '1.0');
            wp_enqueue_script('image-magnifier', plugin_dir_url(__FILE__) . 'js/magnifier.js', array('jquery'), '1.0', true);
        }
    }

    public function add_magnifier_to_content($content) {
        if (is_singular() && has_post_thumbnail()) {
            $image_id = get_post_thumbnail_id();
            $image_url = wp_get_attachment_image_src($image_id, 'full');
            if ($image_url) {
                $image_url = $image_url[0];
                $magnifier_html = '<div class="image-magnifier-container">';
                $magnifier_html .= get_the_post_thumbnail(null, 'full', array('class' => 'main-image'));
                $magnifier_html .= '<div class="magnifier"><img src="' . esc_url($image_url) . '" alt="' . esc_attr__('Magnified Image', 'image-magnifier') . '"></div>';
                $magnifier_html .= '</div>';
                $content = $magnifier_html . $content;
            }
        }
        return $content;
    }

    public function add_magnifier_html() {
        if (is_singular() && has_post_thumbnail()) {
            $image_id = get_post_thumbnail_id();
            $image_url = wp_get_attachment_image_src($image_id, 'full');
            if ($image_url) {
                $image_url = $image_url[0];
                echo '<div class="magnified-view"><img src="' . esc_url($image_url) . '" alt="' . esc_attr__('Magnified View', 'image-magnifier') . '"></div>';
            }
        }
    }
}

new ImageMagnifier();