<?php
/**
 * Widget Name: Social Reviews
 * Description: Social Reviews
 * Author: Theplus
 * Author URI: http://posimyththemes.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Social_Reviews
 */
class ThePlus_Social_Reviews extends Widget_Base {

	public $tp_doc = THEPLUS_TPDOC;

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;	

	/**
	 * Get Widget Name.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-social-reviews';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Social Reviews', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-star-o theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Custom URL.
	 *
	 * @since 1.0.0
	 * @version 5.6.5
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Social Reviews', 'Elementor Social Reviews', 'Elementor Reviews Widget', 'Elementor Social Proof Widget', 'Social Proof Reviews', 'Elementor Social Proof', 'Reviews Widget for Elementor', 'for Social Reviews', 'Social Reviews Plugin for Elementor' );
	}

	/**
	 * Is_reload_preview_required.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function is_reload_preview_required() {
		return true;
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'RType',
			array(
				'label'   => esc_html__( 'Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'review',
				'options' => array(
					'review' => esc_html__( 'Reviews', 'theplus' ),
					'beach'  => esc_html__( 'Badge', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_review',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "connect-carousel-remote-with-social-review-carousel-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'RType' => array( 'review' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_beach',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-google-badges-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'RType' => array( 'beach' ),
				),
			)
		);
		$this->add_control(
			'style',
			array(
				'label'     => esc_html__( 'Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style-1', 'theplus' ),
					'style-2' => esc_html__( 'Style-2', 'theplus' ),
					'style-3' => esc_html__( 'Style-3', 'theplus' ),
				),
				'condition' => array(
					'RType' => 'review',
				),
			)
		);
		$this->add_control(
			'layoutstyle2',
			array(
				'label'     => esc_html__( 'Style layout', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'layout-1',
				'options'   => array(
					'layout-1' => esc_html__( 'layout-1', 'theplus' ),
					'layout-2' => esc_html__( 'layout-2', 'theplus' ),
				),
				'condition' => array(
					'RType' => 'review',
					'style' => 'style-2',
				),
			)
		);
		$this->add_control(
			'layout',
			array(
				'label'     => esc_html__( 'Layout', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'grid',
				'options'   => array(
					'grid'     => esc_html__( 'Grid', 'theplus' ),
					'masonry'  => esc_html__( 'Masonry', 'theplus' ),
					'carousel' => esc_html__( 'Carousel', 'theplus' ),
				),
				'condition' => array(
					'RType' => 'review',
				),
			)
		);
		$this->add_control(
			'how_it_works_grid',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-social-reviews-in-grid-layout-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'RType!' => 'beach',
					'layout' => array( 'grid' ),

				),
			)
		);
		$this->add_control(
			'how_it_works_masonry',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-social-reviews-in-masonry-grid-layout-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'RType!' => 'beach',
					'layout' => array( 'masonry' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_carousel',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-social-reviews-in-carousel-slider-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'RType!' => 'beach',
					'layout' => array( 'carousel' ),
				),
			)
		);
		$this->add_control(
			'Bstyle',
			array(
				'label'     => esc_html__( 'Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style-1', 'theplus' ),
					'style-2' => esc_html__( 'Style-2', 'theplus' ),
					'style-3' => esc_html__( 'Style-3', 'theplus' ),
				),
				'condition' => array(
					'RType' => 'beach',
				),
			)
		);
		$this->add_control(
			'BType',
			array(
				'label'     => esc_html__( 'Source', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'b-facebook',
				'options'   => array(
					'b-facebook' => esc_html__( 'Facebook', 'theplus' ),
					'b-google'   => esc_html__( 'Google', 'theplus' ),
				),
				'condition' => array(
					'RType' => 'beach',
				),
			)
		);
		$this->add_control(
			'how_it_works_facebook',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-facebook-badges-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'RType!' => 'review',
					'BType'  => array( 'b-facebook' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_google',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-google-badges-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'RType!' => 'review',
					'BType'  => array( 'b-google' ),
				),
			)
		);
		$this->add_control(
			'BeachFacebookButton',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<a class="tp-beach-fb-button" id="tp-beach-fb-button" ><i class="fa fa-facebook-official" aria-hidden="true"></i>Generate Access Token</a>',
				'content_classes' => 'tp-beach-fb-btn',
				'label_block'     => true,
				'condition'       => array(
					'RType' => 'beach',
					'BType' => 'b-facebook',
				),
			)
		);
		$this->add_control(
			'BTypeFacebook',
			array(
				'label'       => esc_html__( 'Facebook Review', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'rows'        => 5,
				'default'     => esc_html__( 'Facebook Reviews', 'theplus' ),
				'placeholder' => esc_html__( 'Enter TEXT', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'RType' => 'beach',
					'BType' => 'b-facebook',
				),
			)
		);
		$this->add_control(
			'BTypeGoogle',
			array(
				'label'       => esc_html__( 'Google Review', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'rows'        => 5,
				'default'     => esc_html__( 'Google Reviews', 'theplus' ),
				'placeholder' => esc_html__( 'Enter TEXT', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'RType' => 'beach',
					'BType' => 'b-google',
				),
			)
		);
		$this->add_control(
			'BToken',
			array(
				'label'       => esc_html__( 'Access Token', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 5,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Value', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'RType' => 'beach',
				),
			)
		);
		$this->add_control(
			'B_TokenGoogle',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : How to <a href="https://console.cloud.google.com/apis/credentials" target="_blank" rel="noopener noreferrer">(Create Token ?)</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'RType' => 'beach',
					'BType' => 'b-google',
				),
			)
		);
		$this->add_control(
			'BPPId',
			array(
				'label'     => esc_html__( 'Page/Place Id', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'RType' => 'beach',
				),
			)
		);
		$this->add_control(
			'B_TokenPlaceId',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : How to <a href="https://developers.google.com/places/web-service/place-id" target="_blank" rel="noopener noreferrer">(Place Id ?)</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'RType' => 'beach',
					'BType' => 'b-google',
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'ReviewsType',
			array(
				'label'   => esc_html__( 'Source', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'facebook',
				'options' => array(
					'facebook' => esc_html__( 'Facebook', 'theplus' ),
					'google'   => esc_html__( 'Google', 'theplus' ),
					'manual'   => esc_html__( 'Manual', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'how_it_works_facebook',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-facebook-reviews-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'ReviewsType' => array( 'facebook' ),
				),
			)
		);
		$repeater->add_control(
			'how_it_works_google',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-google-reviews-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'ReviewsType' => array( 'google' ),
				),
			)
		);
		$repeater->add_control(
			'how_it_works_manual',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-reviews-manually-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'ReviewsType' => array( 'manual' ),
				),
			)
		);
		$repeater->add_control(
			'GLanguage',
			array(
				'label'     => __( 'Language', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'en',
				'options'   => array(
					'af'     => __( 'Afrikaans', 'theplus' ),
					'sq'     => __( 'Albanian', 'theplus' ),
					'am'     => __( 'Amharic', 'theplus' ),
					'ar'     => __( 'Arabic', 'theplus' ),
					'hy'     => __( 'Armenian', 'theplus' ),
					'az'     => __( 'Azerbaijani', 'theplus' ),
					'eu'     => __( 'Basque', 'theplus' ),
					'be'     => __( 'Belarusian', 'theplus' ),
					'bn'     => __( 'Bengali', 'theplus' ),
					'bs'     => __( 'Bosnian', 'theplus' ),
					'bg'     => __( 'Bulgarian', 'theplus' ),
					'my'     => __( 'Burmese', 'theplus' ),
					'ca'     => __( 'Catalan', 'theplus' ),
					'zh'     => __( 'Chinese', 'theplus' ),
					'zh-CN'  => __( 'Chinese (Simplified)', 'theplus' ),
					'zh-HK'  => __( 'Chinese (Hong Kong)', 'theplus' ),
					'zh-TW'  => __( 'Chinese (Traditional)', 'theplus' ),
					'hr'     => __( 'Croatian', 'theplus' ),
					'cs'     => __( 'Czech', 'theplus' ),
					'da'     => __( 'Danish', 'theplus' ),
					'nl'     => __( 'Dutch', 'theplus' ),
					'en'     => __( 'English', 'theplus' ),
					'en-AU'  => __( 'English (Australian)', 'theplus' ),
					'en-GB'  => __( 'English (Great Britain)', 'theplus' ),
					'et'     => __( 'Estonian', 'theplus' ),
					'fa'     => __( 'Farsi', 'theplus' ),
					'fi'     => __( 'Finnish', 'theplus' ),
					'fil'    => __( 'Filipino', 'theplus' ),
					'fr'     => __( 'French', 'theplus' ),
					'fr-CA'  => __( 'French (Canada)', 'theplus' ),
					'gl'     => __( 'Galician', 'theplus' ),
					'ka'     => __( 'Georgian', 'theplus' ),
					'de'     => __( 'German', 'theplus' ),
					'el'     => __( 'Greek', 'theplus' ),
					'gu'     => __( 'Gujarati', 'theplus' ),
					'iw'     => __( 'Hebrew', 'theplus' ),
					'hi'     => __( 'Hindi', 'theplus' ),
					'hu'     => __( 'Hungarian', 'theplus' ),
					'is'     => __( 'Icelandic', 'theplus' ),
					'id'     => __( 'Indonesian', 'theplus' ),
					'it'     => __( 'Italian', 'theplus' ),
					'ja'     => __( 'Japanese', 'theplus' ),
					'kn'     => __( 'Kannada', 'theplus' ),
					'kk'     => __( 'Kazakh', 'theplus' ),
					'km'     => __( 'Khmer', 'theplus' ),
					'ko'     => __( 'Korean', 'theplus' ),
					'ky'     => __( 'Kyrgyz', 'theplus' ),
					'lo'     => __( 'Lao', 'theplus' ),
					'lv'     => __( 'Latvian', 'theplus' ),
					'lt'     => __( 'Lithuanian', 'theplus' ),
					'mk'     => __( 'Macedonian', 'theplus' ),
					'ms'     => __( 'Malay', 'theplus' ),
					'ml'     => __( 'Malayalam', 'theplus' ),
					'mr'     => __( 'Marathi', 'theplus' ),
					'mn'     => __( 'Mongolian', 'theplus' ),
					'ne'     => __( 'Nepali', 'theplus' ),
					'no'     => __( 'Norwegian', 'theplus' ),
					'pl'     => __( 'Polish', 'theplus' ),
					'pt'     => __( 'Portuguese', 'theplus' ),
					'pt-BR'  => __( 'Portuguese (Brazil)', 'theplus' ),
					'pt-PT'  => __( 'Portuguese (Portugal)', 'theplus' ),
					'pa'     => __( 'Punjabi', 'theplus' ),
					'ro'     => __( 'Romanian', 'theplus' ),
					'ru'     => __( 'Russian', 'theplus' ),
					'sr'     => __( 'Serbian', 'theplus' ),
					'si'     => __( 'Sinhalese', 'theplus' ),
					'sk'     => __( 'Slovak', 'theplus' ),
					'sl'     => __( 'Slovenian', 'theplus' ),
					'es'     => __( 'Spanish', 'theplus' ),
					'es-419' => __( 'Spanish (Latin America)', 'theplus' ),
					'sw'     => __( 'Swahili', 'theplus' ),
					'sv'     => __( 'Swedish', 'theplus' ),
					'ta'     => __( 'Tamil', 'theplus' ),
					'te'     => __( 'Telugu', 'theplus' ),
					'th'     => __( 'Thai', 'theplus' ),
					'tr'     => __( 'Turkish', 'theplus' ),
					'uk'     => __( 'Ukrainian', 'theplus' ),
					'ur'     => __( 'Urdu', 'theplus' ),
					'uz'     => __( 'Uzbek', 'theplus' ),
					'vi'     => __( 'Vietnamese', 'theplus' ),
					'zu'     => __( 'Zulu', 'theplus' ),
				),
				'condition' => array(
					'ReviewsType' => 'google',
				),
			)
		);
		$repeater->add_control(
			'FacebookButton',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<a class="tp-review-fb-button" id="tp-review-fb-button" ><i class="fa fa-facebook-official" aria-hidden="true"></i>Generate Access Token</a>',
				'content_classes' => 'tp-review-fb-btn',
				'label_block'     => true,
				'condition'       => array(
					'ReviewsType' => 'facebook',
				),
			)
		);
		$repeater->add_control(
			'Token',
			array(
				'label'       => esc_html__( 'Access Token', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 5,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Value', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'ReviewsType!' => 'manual',
				),
			)
		);
		$repeater->add_control(
			'FbPageId',
			array(
				'label'     => esc_html__( 'Page/Place ID', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'ReviewsType' => 'facebook',
				),
			)
		);
		$repeater->add_control(
			'FbRType',
			array(
				'label'     => esc_html__( 'Result Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default'  => esc_html__( 'Default', 'theplus' ),
					'negative' => esc_html__( 'Negative', 'theplus' ),
					'positive' => esc_html__( 'Positive', 'theplus' ),
				),
				'condition' => array(
					'ReviewsType' => 'facebook',
				),
			)
		);
		$repeater->add_control(
			'TokenGoogle',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : How to <a href="https://console.cloud.google.com/apis/credentials" target="_blank" rel="noopener noreferrer">(Create Token ?)</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'ReviewsType' => 'google',
				),
			)
		);
		$repeater->add_control(
			'GPlaceID',
			array(
				'label'     => esc_html__( 'Page/Place ID', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'ReviewsType' => 'google',
				),
			)
		);

		$repeater->add_control(
			'TokenPlaceId',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : How to <a href="https://developers.google.com/places/web-service/place-id" target="_blank" rel="noopener noreferrer">(Place Id ?)</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'ReviewsType' => 'google',
				),
			)
		);
		$repeater->add_control(
			'CUImg',
			array(
				'label'     => esc_html__( 'User Profile Image', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::GALLERY,
				'dynamic'   => array( 'active' => true ),
				'default'   => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'ReviewsType' => 'manual',
				),
				'separator' => 'after',
			)
		);
		$repeater->add_control(
			'Cuname',
			array(
				'label'       => esc_html__( 'Username', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'placeholder' => esc_html__( 'Enter Username', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'ReviewsType' => 'manual',
				),
			)
		);
		$repeater->add_control(
			'Cmassage',
			array(
				'label'       => esc_html__( 'Review Message', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'placeholder' => esc_html__( 'Enter Message', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'ReviewsType' => 'manual',
				),
			)
		);
		$repeater->add_control(
			'CPFname',
			array(
				'label'     => esc_html__( 'Platform', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'facebook',
				'options'   => array(
					'facebook' => esc_html__( 'Facebook', 'theplus' ),
					'google'   => esc_html__( 'Google', 'theplus' ),
					'manual'   => esc_html__( 'Manual', 'theplus' ),
				),
				'condition' => array(
					'ReviewsType' => 'manual',
				),
			)
		);
		$repeater->add_control(
			'CcuSname',
			array(
				'label'     => esc_html__( 'Platform Name', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'ReviewsType' => 'manual',
					'CPFname'     => 'manual',
				),
			)
		);
		$repeater->add_control(
			'CImg',
			array(
				'label'     => esc_html__( 'Platform Logo', 'theplus' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array( 'active' => true ),
				'default'   => array(
					'url' => '',
				),
				'condition' => array(
					'ReviewsType' => 'manual',
					'CPFname'     => 'manual',
				),
			)
		);
		$repeater->add_control(
			'Cdate',
			array(
				'label'       => esc_html__( 'Date', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'placeholder' => esc_html__( 'Enter Date', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'ReviewsType' => 'manual',
				),
			)
		);
		$repeater->add_control(
			'Cstar',
			array(
				'label'       => esc_html__( 'Rating Value (1-5)', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'placeholder' => esc_html__( 'Enter Value', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'ReviewsType' => 'manual',
				),
			)
		);
		$repeater->add_control(
			'icons',
			array(
				'label'   => esc_html__( 'Rating Icon', 'theplus' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-star',
					'library' => 'solid',
				),
			)
		);
		$repeater->add_control(
			'RCategory',
			array(
				'label'       => esc_html__( 'Category (For Filter)', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'e.g. Category1, Category2', 'theplus' ),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'MaxR',
			array(
				'label'   => esc_html__( 'Max Results', 'theplus' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 50,
				'step'    => 1,
				'default' => 6,
			)
		);
		$this->add_control(
			'Rreviews',
			array(
				'label'       => esc_html__( 'Social Reviews', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'ReviewsType' => 'facebook',
						'MaxR'        => 6,
						'CUImg'       => array( 'url' => \Elementor\Utils::get_placeholder_image_src() ),
					),

				),
				'separator'   => 'before',
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ ReviewsType }}}',
				'condition'   => array(
					'RType' => 'review',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'review_optn_section',
			array(
				'label'     => esc_html__( 'Review Option', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'RType' => 'review',
				),
			)
		);
		$this->add_control(
			'FBNagative',
			array(
				'label'       => wp_kses_post( "Negative Review Stars <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "turn-negative-facebook-review-into-positive-review-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '1',
				'options'     => array(
					'1' => esc_html__( '1', 'theplus' ),
					'2' => esc_html__( '2', 'theplus' ),
					'3' => esc_html__( '3', 'theplus' ),
					'4' => esc_html__( '4', 'theplus' ),
				),
				'description' => 'Note : In Facebook Reviews, You can set value of stars you want to show for negative review you got.',
			)
		);
		$this->add_control(
			'ShowFeedId',
			array(
				'label'     => wp_kses_post( "Display Id & Exclude <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "exclude-social-reviews-by-id-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'FeedId',
			array(
				'label'       => esc_html__( 'Exclude Post Ids', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => '',
				'placeholder' => esc_html__( 'Add Ids With A Comma To Exclude', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'ShowFeedId' => 'yes',
				),
			)
		);
		$this->add_control(
			'SRExcldPIdsNote',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note: By Enabling This Option, You Will See The Post Id Of Each In The Back-end, And Then You Can Use Those To Exclude Posts You Want To.',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'ShowFeedId' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'badge_optn_section',
			array(
				'label'     => esc_html__( 'Badge Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'RType' => 'beach',
				),
			)
		);
		$this->add_control(
			'Btxt1',
			array(
				'label'   => esc_html__( 'Postfix Content', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Recommended By', 'theplus' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'Btxt2',
			array(
				'label'     => esc_html__( 'Prefix Content', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'People', 'theplus' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'Bstyle!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'BRecommend',
			array(
				'label'     => esc_html__( 'Show Recommended', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'Bstyle' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->add_control(
			'Blinktxt',
			array(
				'label'       => esc_html__( 'Prefix Content Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Would You Recommend', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'condition'   => array(
					'Bstyle'     => 'style-1',
					'BRecommend' => 'yes',
				),
			)
		);
		$this->add_control(
			'BSButton',
			array(
				'label'     => esc_html__( '(Single | Multiple) Button', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'Bstyle'     => 'style-1',
					'BRecommend' => 'yes',
				),
			)
		);
		$this->add_control(
			'BBtnName',
			array(
				'label'       => esc_html__( 'First Button', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'YES', 'theplus' ),
				'placeholder' => esc_html__( 'Enter Button Name', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'Bstyle'     => 'style-1',
					'BRecommend' => 'yes',
				),
			)
		);
		$this->add_control(
			'BBtnTName',
			array(
				'label'       => esc_html__( 'Second Button', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'NO', 'theplus' ),
				'placeholder' => esc_html__( 'Enter Button Name', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'Bstyle'     => 'style-1',
					'BRecommend' => 'yes',
					'BSButton'   => 'yes',
				),
			)
		);
		$this->add_control(
			'IconHidden',
			array(
				'label'     => esc_html__( 'Show Icon', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'Bstyle' => 'style-2',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'columns_manage_section',
			array(
				'label'     => esc_html__( 'Columns Manage', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'RType'   => 'review',
					'layout!' => 'carousel',
				),
			)
		);
		$this->add_control(
			'desktop_column',
			array(
				'label'   => esc_html__( 'Desktop Column', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => theplus_get_columns_list(),
			)
		);
		$this->add_control(
			'tablet_column',
			array(
				'label'   => esc_html__( 'Tablet Column', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => theplus_get_columns_list(),
			)
		);
		$this->add_control(
			'mobile_column',
			array(
				'label'   => esc_html__( 'Mobile Column', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '6',
				'options' => theplus_get_columns_list(),
			)
		);
		$this->add_responsive_control(
			'columnSpace',
			array(
				'label'      => esc_html__( 'Columns Gap/Space Between', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'top'    => '15',
					'right'  => '15',
					'bottom' => '15',
					'left'   => '15',
				),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .post-inner-loop .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'filters_optn_section',
			array(
				'label'     => esc_html__( 'Filter Option', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'RType'   => 'review',
					'layout!' => 'carousel',
				),
			)
		);
		$this->add_control(
			'filter_category',
			array(
				'label'     => wp_kses_post( "Category Wise Filter <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-a-category-wise-filter-in-social-reviews-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'all_filter_category',
			array(
				'label'     => esc_html__( 'All Filter Category Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'All', 'theplus' ),
				'condition' => array(
					'filter_category' => 'yes',
				),
			)
		);
		$this->add_control(
			'filter_style',
			array(
				'label'     => esc_html__( 'Category Filter Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => theplus_get_style_list( 4 ),
				'condition' => array(
					'filter_category' => 'yes',
					'layout!'         => 'carousel',
				),
			)
		);
		$this->add_control(
			'filter_hover_style',
			array(
				'label'     => esc_html__( 'Filter Hover Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => theplus_get_style_list( 4 ),
				'condition' => array(
					'filter_category' => 'yes',
				),
			)
		);
		$this->add_control(
			'filter_category_align',
			array(
				'label'        => esc_html__( 'Filter Alignment', 'theplus' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'      => 'center',
				'toggle'       => true,
				'label_widget' => false,
				'condition'    => array(
					'filter_category' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'loadmore_lazyload_section',
			array(
				'label'     => esc_html__( 'Load More/Lazy Load', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'RType'   => 'review',
					'layout!' => 'carousel',
				),
			)
		);
		$this->add_control(
			'post_extra_option',
			array(
				'label'   => esc_html__( 'More Post Loading', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'      => esc_html__( 'Select Options', 'theplus' ),
					'load_more' => esc_html__( 'Load More', 'theplus' ),
					'lazy_load' => esc_html__( 'Lazy Load', 'theplus' ),
				),
			)
		);

		$this->add_control(
			'display_posts',
			array(
				'label'     => esc_html__( 'Maximum Posts Display', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 200,
				'step'      => 1,
				'default'   => 8,
				'separator' => 'before',
				'condition' => array(
					'post_extra_option' => array( 'load_more', 'lazy_load' ),
				),
			)
		);
		$this->add_control(
			'load_more_post',
			array(
				'label'     => esc_html__( 'More Posts On Click/Scroll', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 30,
				'step'      => 1,
				'default'   => 4,
				'condition' => array(
					'post_extra_option' => array( 'load_more', 'lazy_load' ),
				),
			)
		);
		$this->add_control(
			'load_more_btn_text',
			array(
				'label'     => esc_html__( 'Button Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Load More', 'theplus' ),
				'condition' => array(
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_control(
			'tp_loading_text',
			array(
				'label'     => esc_html__( 'Loading Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Loading...', 'theplus' ),
				'condition' => array(
					'post_extra_option' => array( 'load_more', 'lazy_load' ),
				),
			)
		);
		$this->add_control(
			'loaded_posts_text',
			array(
				'label'     => esc_html__( 'All Posts Loaded Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'All done!', 'theplus' ),
				'condition' => array(
					'post_extra_option' => array( 'load_more', 'lazy_load' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'extrabeach_options_section',
			array(
				'label'     => esc_html__( 'Extra Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'RType' => 'beach',
				),
			)
		);
		$this->add_control(
			'beach_TimeFrq',
			array(
				'label'   => esc_html__( 'Refresh Time', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '86400',
				'options' => array(
					'3600'   => esc_html__( '1 hour', 'theplus' ),
					'7200'   => esc_html__( '2 hour', 'theplus' ),
					'21600'  => esc_html__( '6 hour', 'theplus' ),
					'86400'  => esc_html__( '1 day', 'theplus' ),
					'604800' => esc_html__( '1 Week', 'theplus' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'extra_options_section',
			array(
				'label'     => esc_html__( 'Extra Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'RType' => 'review',
				),
			)
		);
		$this->add_control(
			'TimeFrq',
			array(
				'label'   => esc_html__( 'Refresh Time', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '86400',
				'options' => array(
					'3600'   => esc_html__( '1 hour', 'theplus' ),
					'7200'   => esc_html__( '2 hour', 'theplus' ),
					'21600'  => esc_html__( '6 hour', 'theplus' ),
					'86400'  => esc_html__( '1 day', 'theplus' ),
					'604800' => esc_html__( '1 Week', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'TextLimit',
			array(
				'label'     => esc_html__( 'Text Limit', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'TextType',
			array(
				'label'     => esc_html__( 'Limit On', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'char',
				'options'   => array(
					'char' => esc_html__( 'Character', 'theplus' ),
					'word' => esc_html__( 'Word', 'theplus' ),
				),
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->add_control(
			'TextMore',
			array(
				'label'     => esc_html__( 'More Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Show More', 'theplus' ),
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->add_control(
			'TextLess',
			array(
				'label'     => esc_html__( 'Less Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Show Less', 'theplus' ),
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->add_control(
			'TextCount',
			array(
				'label'     => esc_html__( 'Limit Count', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 2000,
				'step'      => 1,
				'default'   => 100,
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->add_control(
			'TextDots',
			array(
				'label'     => esc_html__( 'Display Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->add_control(
			'ScrollOn',
			array(
				'label'     => esc_html__( 'Content Scrolling Bar', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => '',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'ScrollHgt',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 100,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'ScrollOn' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'performance_options_section',
			array(
				'label' => esc_html__( 'Performance', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'perf_manage',
			array(
				'label'     => esc_html__( 'Performance', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'SF_delete_transient',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<span>Delete All Transient </span><a class="tp-SReview-delete-transient" id="tp-SReview-delete-transient" > Delete </a>',
				'content_classes' => 'tp-SReview-delete-transient-btn',
				'label_block'     => true,
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'Unisl_optn_stl_section',
			array(
				'label'     => esc_html__( 'Universal', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'RType' => 'review',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'UnnameTypo',
				'label'    => esc_html__( 'Username Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-SR-username a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'UnMsgTypo',
				'label'    => esc_html__( 'Message Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-SR-content',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'UnPostOnTypo',
				'label'     => esc_html__( 'Post On Text Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-social-reviews .tp-SR-logotext',
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->start_controls_tabs( 'unisl_color_style' );
		$this->start_controls_tab(
			'unisl_optn_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'UnnameCr',
			array(
				'label'     => esc_html__( 'Username Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-SR-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'UnMassageCr',
			array(
				'label'     => esc_html__( 'Message Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-SR-content' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'UnPostONCr',
			array(
				'label'     => esc_html__( 'Post On Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-SR-logotext .tp-newline:nth-child(n)' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'UnTimeCr',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-SR-time' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'BoxNlable',
			array(
				'label'     => esc_html__( 'Box Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'BgBoxNpd',
			array(
				'label'      => esc_html__( 'Box Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .grid-item .tp-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'UnNBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-review',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'UnB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-review',
			)
		);
		$this->add_responsive_control(
			'UnNBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-review' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'UnNBs',
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-review',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'unisl_optn_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'UnHnameCr',
			array(
				'label'     => esc_html__( 'Username Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .grid-item:hover .tp-SR-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'UnHMassageCr',
			array(
				'label'     => esc_html__( 'Message Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .grid-item:hover .tp-SR-content' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'UnHPostONCr',
			array(
				'label'     => esc_html__( 'Post On Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .grid-item:hover .tp-SR-logotext .tp-newline:nth-child(n)' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'UnHTimeCr',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .grid-item:hover .tp-SR-time' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'BoxHlable',
			array(
				'label'     => esc_html__( 'Box Background Options', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'BgBoxHpd',
			array(
				'label'      => esc_html__( 'Box Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .grid-item:hover .tp-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'UnHBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-review:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'UnHB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-review:hover',
			)
		);
		$this->add_responsive_control(
			'UnHBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-review:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'UnHBs',
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-review:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'unitop_color_style' );
		$this->start_controls_tab(
			'unisl_optnR_top',
			array(
				'label' => esc_html__( 'Top', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'topBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-SR-header',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'topB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-SR-header',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'unisl_optnR_btm',
			array(
				'label' => esc_html__( 'Bottom', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'BottomBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-social-reviews .tp-SR-bottom',
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'BottomB',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-social-reviews .tp-SR-bottom',
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'BottomPostCr',
			array(
				'label'     => esc_html__( 'Posted On Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-newline:nth-child(1)' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'BottomPltCr',
			array(
				'label'     => esc_html__( 'Platform Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-newline:nth-child(2)' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'unisl_optn_Icon',
			array(
				'label' => esc_html__( 'Icon', 'theplus' ),
			)
		);
		$this->add_responsive_control(
			'Starpadding',
			array(
				'label'      => esc_html__( 'Star Box Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-SR-star' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'StarIconCr',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-SR-star .SR-star' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'StarIconspace',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon space', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-reviews .tp-SR-star .SR-star' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'StarIconsize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-reviews .tp-SR-star .SR-star' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'UserNameArea',
			array(
				'label'     => esc_html__( 'Username Area', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'Unnamemargin',
			array(
				'label'      => esc_html__( 'Username Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-SR-username' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'Unnamepadding',
			array(
				'label'      => esc_html__( 'Username Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-SR-username' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'ProfileArea',
			array(
				'label'     => esc_html__( 'Profile Image', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'OverlayImage',
			array(
				'label'     => esc_html__( 'Overlay Image', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'OverlayImgLeft',
			array(
				'label'      => __( 'Image Position', 'plugin-domain' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => -100,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .social-reviews-style-1.overlayimage img.tp-SR-profile' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .social-reviews-style-2.overlayimage .tp-SR-profile' => 'top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'style!'       => 'style-3',
					'OverlayImage' => 'yes',
				),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'     => 'border',
				'label'    => __( 'Profile Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-SR-profile',
			)
		);
		$this->add_responsive_control(
			'BgPRs',
			array(
				'label'      => esc_html__( 'Profile Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-SR-profile' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'label'    => __( 'Profile Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-SR-profile',
			)
		);
		$this->add_responsive_control(
			'BgHpd',
			array(
				'label'      => esc_html__( 'Header Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-SR-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'BgBpd',
			array(
				'label'      => esc_html__( 'Content Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-SR-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'BgFpd',
			array(
				'label'      => esc_html__( 'Footer Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-SR-bottom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style!' => 'style-3',
				),
				'separator'  => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'ShW_MTxt_stl_section',
			array(
				'label'     => esc_html__( 'Show More Text', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'RType'     => 'review',
					'TextLimit' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'SmTxtTypo',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-social-reviews .tp-message a.readbtn',
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'ShW_MTxt_style' );
		$this->start_controls_tab(
			'ShW_MTxt_NMl',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->add_control(
			'SmTxtNCr',
			array(
				'label'     => esc_html__( 'Show More', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-message a.readbtn' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->add_control(
			'SlTxtNCr',
			array(
				'label'     => esc_html__( 'Show Less', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-message.show-less a.readbtn' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->add_control(
			'DotTxtNCr',
			array(
				'label'     => esc_html__( 'Dot Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-message .sf-dots' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'ShW_MTxt_Hvr',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->add_control(
			'SmTxtHCr',
			array(
				'label'     => esc_html__( 'Show More', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-message a.readbtn:hover' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->add_control(
			'SlTxtHCr',
			array(
				'label'     => esc_html__( 'Show Less', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-message.show-less a.readbtn:hover' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->add_control(
			'DotTxtHCr',
			array(
				'label'     => esc_html__( 'Dot Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-message:hover .sf-dots' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'scroll_section',
			array(
				'label'     => esc_html__( 'Scroll Text', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'RType'    => 'review',
					'ScrollOn' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'scrollC_style' );
		$this->start_controls_tab(
			'scrollC_Bar',
			array(
				'label' => esc_html__( 'Scrollbar', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'ScrollBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-normal-scroll::-webkit-scrollbar',
			)
		);
		$this->add_responsive_control(
			'ScrollWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-reviews .tp-normal-scroll::-webkit-scrollbar' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'scrollC_Tmb',
			array(
				'label' => esc_html__( 'Thumb', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'ThumbBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-normal-scroll::-webkit-scrollbar-thumb',
			)
		);
		$this->add_responsive_control(
			'ThumbBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-normal-scroll::-webkit-scrollbar-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'ThumbBsw',
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-normal-scroll::-webkit-scrollbar-thumb',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'scrollC_Trk',
			array(
				'label' => esc_html__( 'Track', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'TrackBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-normal-scroll::-webkit-scrollbar-track',
			)
		);
		$this->add_responsive_control(
			'TrackBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-normal-scroll::-webkit-scrollbar-track' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'TrackBsw',
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-normal-scroll::-webkit-scrollbar-track',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'LoadMore_style_section',
			array(
				'label'     => esc_html__( 'Load More/Lazy Load', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'RType'             => 'review',
					'layout!'           => 'carousel',
					'post_extra_option' => array( 'load_more', 'lazy_load' ),
				),
			)
		);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'      => 'load_more_typography',
					'label'     => esc_html__( 'Load More Typography', 'theplus' ),
					'global'    => array(
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					),
					'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more',
					'condition' => array(
						'post_extra_option' => 'load_more',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'      => 'loaded_posts_typo',
					'label'     => esc_html__( 'Loaded All Posts Typography', 'theplus' ),
					'global'    => array(
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					),
					'selector'  => '{{WRAPPER}} .plus-all-posts-loaded',
					'separator' => 'before',
					'condition' => array(
						'post_extra_option' => array( 'load_more', 'lazy_load' ),
					),
				)
			);
			$this->add_control(
				'load_more_border',
				array(
					'label'     => esc_html__( 'Load More Border', 'theplus' ),
					'type'      => Controls_Manager::SWITCHER,
					'label_on'  => esc_html__( 'Show', 'theplus' ),
					'label_off' => esc_html__( 'Hide', 'theplus' ),
					'default'   => 'no',
					'separator' => 'before',
					'condition' => array(
						'post_extra_option' => 'load_more',
					),
				)
			);
			$this->add_control(
				'load_more_border_style',
				array(
					'label'     => esc_html__( 'Border Style', 'theplus' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'solid',
					'options'   => theplus_get_border_style(),
					'selectors' => array(
						'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-style: {{VALUE}};',
					),
					'condition' => array(
						'post_extra_option' => 'load_more',
						'load_more_border'  => 'yes',
					),
				)
			);
			$this->add_responsive_control(
				'load_more_border_width',
				array(
					'label'      => esc_html__( 'Border Width', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'default'    => array(
						'top'    => 1,
						'right'  => 1,
						'bottom' => 1,
						'left'   => 1,
					),
					'selectors'  => array(
						'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'condition'  => array(
						'post_extra_option' => 'load_more',
						'load_more_border'  => 'yes',
					),
				)
			);
			$this->start_controls_tabs( 'tabs_load_more_border_style' );
			$this->start_controls_tab(
				'tab_load_more_border_normal',
				array(
					'label'     => esc_html__( 'Normal', 'theplus' ),
					'condition' => array(
						'post_extra_option' => 'load_more',
						'load_more_border'  => 'yes',
					),
				)
			);
			$this->add_control(
				'load_more_border_color',
				array(
					'label'     => esc_html__( 'Border Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#252525',
					'selectors' => array(
						'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-color: {{VALUE}};',
					),
					'condition' => array(
						'post_extra_option' => 'load_more',
						'load_more_border'  => 'yes',
					),
				)
			);
			$this->add_responsive_control(
				'load_more_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'separator'  => 'after',
					'condition'  => array(
						'post_extra_option' => 'load_more',
						'load_more_border'  => 'yes',
					),
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_load_more_border_hover',
				array(
					'label'     => esc_html__( 'Hover', 'theplus' ),
					'condition' => array(
						'post_extra_option' => 'load_more',
						'load_more_border'  => 'yes',
					),
				)
			);
			$this->add_control(
				'load_more_border_hover_color',
				array(
					'label'     => esc_html__( 'Border Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#252525',
					'selectors' => array(
						'{{WRAPPER}} .ajax_load_more .post-load-more:hover' => 'border-color: {{VALUE}};',
					),
					'condition' => array(
						'post_extra_option' => 'load_more',
						'load_more_border'  => 'yes',
					),
				)
			);
			$this->add_responsive_control(
				'load_more_border_hover_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .ajax_load_more .post-load-more:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'separator'  => 'after',
					'condition'  => array(
						'post_extra_option' => 'load_more',
						'load_more_border'  => 'yes',
					),
				)
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->start_controls_tabs( 'tabs_load_more_style' );
			$this->start_controls_tab(
				'tab_load_more_normal',
				array(
					'label'     => esc_html__( 'Normal', 'theplus' ),
					'condition' => array(
						'post_extra_option' => 'load_more',
					),
				)
			);
			$this->add_control(
				'load_more_color',
				array(
					'label'     => esc_html__( 'Text Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .ajax_load_more .post-load-more' => 'color: {{VALUE}}',
					),
					'condition' => array(
						'post_extra_option' => 'load_more',
					),
				)
			);
			$this->add_control(
				'loaded_posts_color',
				array(
					'label'     => esc_html__( 'Loaded Posts Text Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .plus-all-posts-loaded' => 'color: {{VALUE}}',
					),
					'separator' => 'after',
					'condition' => array(
						'post_extra_option' => array( 'load_more', 'lazy_load' ),
					),
				)
			);
			$this->add_control(
				'loading_spin_heading',
				array(
					'label'     => esc_html__( 'Loading Spinner ', 'theplus' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => array(
						'post_extra_option' => 'lazy_load',
					),
				)
			);
			$this->add_control(
				'loading_spin_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .ajax_lazy_load .post-lazy-load .tp-spin-ring div' => 'border-color: {{VALUE}} transparent transparent transparent',
					),
					'condition' => array(
						'post_extra_option' => 'lazy_load',
					),
				)
			);
			$this->add_responsive_control(
				'loading_spin_size',
				array(
					'type'        => Controls_Manager::SLIDER,
					'label'       => esc_html__( 'Size', 'theplus' ),
					'size_units'  => array( 'px' ),
					'range'       => array(
						'px' => array(
							'min'  => 1,
							'max'  => 200,
							'step' => 1,
						),
					),
					'render_type' => 'ui',
					'selectors'   => array(
						'{{WRAPPER}} .ajax_lazy_load .post-lazy-load .tp-spin-ring div' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
					),
					'condition'   => array(
						'post_extra_option' => 'lazy_load',
					),
				)
			);
			$this->add_responsive_control(
				'loading_spin_border_size',
				array(
					'type'        => Controls_Manager::SLIDER,
					'label'       => esc_html__( 'Border Size', 'theplus' ),
					'size_units'  => array( 'px' ),
					'range'       => array(
						'px' => array(
							'min'  => 1,
							'max'  => 20,
							'step' => 1,
						),
					),
					'render_type' => 'ui',
					'selectors'   => array(
						'{{WRAPPER}} .ajax_lazy_load .post-lazy-load .tp-spin-ring div' => 'border-width: {{SIZE}}{{UNIT}};',
					),
					'condition'   => array(
						'post_extra_option' => 'lazy_load',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'load_more_background',
					'types'     => array( 'classic', 'gradient' ),
					'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more',
					'condition' => array(
						'post_extra_option' => 'load_more',
					),
				)
			);
			$this->add_control(
				'load_more_shadow_options',
				array(
					'label'     => esc_html__( 'Box Shadow Options', 'theplus' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => array(
						'post_extra_option' => 'load_more',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'load_more_shadow',
					'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more',
					'condition' => array(
						'post_extra_option' => 'load_more',
					),
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_load_more_hover',
				array(
					'label'     => esc_html__( 'Hover', 'theplus' ),
					'condition' => array(
						'post_extra_option' => 'load_more',
					),
				)
			);
			$this->add_control(
				'load_more_color_hover',
				array(
					'label'     => esc_html__( 'Text Hover Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .ajax_load_more .post-load-more:hover' => 'color: {{VALUE}}',
					),
					'separator' => 'after',
					'condition' => array(
						'post_extra_option' => 'load_more',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'load_more_hover_background',
					'types'     => array( 'classic', 'gradient' ),
					'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more:hover',
					'separator' => 'after',
					'condition' => array(
						'post_extra_option' => 'load_more',
					),
				)
			);
			$this->add_control(
				'load_more_shadow_hover_options',
				array(
					'label'     => esc_html__( 'Hover Shadow Options', 'theplus' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => array(
						'post_extra_option' => 'load_more',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'load_more_hover_shadow',
					'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more:hover',
					'condition' => array(
						'post_extra_option' => 'load_more',
					),
				)
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_carousel_options_styling',
			array(
				'label'     => esc_html__( 'Carousel', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'RType'  => 'review',
					'layout' => 'carousel',
				),
			)
		);
		$this->add_control(
			'slider_direction',
			array(
				'label'   => esc_html__( 'Slider Mode', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => array(
					'horizontal' => esc_html__( 'Horizontal', 'theplus' ),
					'vertical'   => esc_html__( 'Vertical', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'carousel_direction',
			array(
				'label'   => esc_html__( 'Slide Direction', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => array(
					'rtl' => esc_html__( 'Right to Left', 'theplus' ),
					'ltr' => esc_html__( 'Left to Right', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'slide_speed',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Slide Speed', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 10000,
						'step' => 100,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 1500,
				),
			)
		);
		$this->start_controls_tabs( 'tabs_carousel_style' );
		$this->start_controls_tab(
			'tab_carousel_desktop',
			array(
				'label' => esc_html__( 'Desktop', 'theplus' ),
			)
		);
		$this->add_control(
			'slider_desktop_column',
			array(
				'label'   => esc_html__( 'Desktop Columns', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => theplus_carousel_desktop_columns(),
			)
		);
		$this->add_control(
			'steps_slide',
			array(
				'label'       => esc_html__( 'Next Previous', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '1',
				'description' => esc_html__( 'Select option of column scroll on previous or next in carousel.', 'theplus' ),
				'options'     => array(
					'1' => esc_html__( 'One Column', 'theplus' ),
					'2' => esc_html__( 'All Visible Columns', 'theplus' ),
				),
			)
		);
		$this->add_responsive_control(
			'slider_padding',
			array(
				'label'      => esc_html__( 'Slide Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'top'    => '0',
					'right'  => '15',
					'bottom' => '0',
					'left'   => '15',
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick .slick-initialized .slick-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'slider_draggable',
			array(
				'label'     => esc_html__( 'Draggable', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'slider_infinite',
			array(
				'label'     => esc_html__( 'Infinite Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'slider_pause_hover',
			array(
				'label'     => esc_html__( 'Pause On Hover', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'slider_adaptive_height',
			array(
				'label'     => esc_html__( 'Adaptive Height', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'slider_animation',
			array(
				'label'   => esc_html__( 'Animation Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ease',
				'options' => array(
					'ease'   => esc_html__( 'With Hold', 'theplus' ),
					'linear' => esc_html__( 'Continuous', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'slider_autoplay',
			array(
				'label'     => esc_html__( 'Autoplay', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'autoplay_speed',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Autoplay Speed', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 500,
						'max'  => 10000,
						'step' => 200,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 3000,
				),
				'condition'  => array(
					'slider_autoplay' => 'yes',
				),
			)
		);
		$this->add_control(
			'slider_dots',
			array(
				'label'     => esc_html__( 'Show Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'slider_dots_style',
			array(
				'label'     => esc_html__( 'Dots Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Style 5', 'theplus' ),
					'style-6' => esc_html__( 'Style 6', 'theplus' ),
					'style-7' => esc_html__( 'Style 7', 'theplus' ),
				),
				'condition' => array(
					'slider_dots' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'dots_border_color',
			array(
				'label'     => esc_html__( 'Dots Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-6 li button' => '-webkit-box-shadow:inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li.slick-active button' => '-webkit-box-shadow:inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li button' => 'border-color:{{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick ul.slick-dots.style-3 li button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-3 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick ul.slick-dots.style-4 li button' => '-webkit-box-shadow: inset 0 0 0 0px {{VALUE}};-moz-box-shadow: inset 0 0 0 0px {{VALUE}};box-shadow: inset 0 0 0 0px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li button:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'slider_dots_style' => array( 'style-1', 'style-2', 'style-3', 'style-5' ),
					'slider_dots'       => 'yes',
				),
			)
		);
		$this->add_control(
			'dots_bg_color',
			array(
				'label'     => esc_html__( 'Dots Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li button,{{WRAPPER}} .list-carousel-slick ul.slick-dots.style-3 li button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-4 li button:before,{{WRAPPER}} .list-carousel-slick .slick-dots.style-5 button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-7 button' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_dots_style' => array( 'style-2', 'style-3', 'style-4', 'style-5', 'style-7' ),
					'slider_dots'       => 'yes',
				),
			)
		);
		$this->add_control(
			'dots_active_border_color',
			array(
				'label'     => esc_html__( 'Dots Active Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-4 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-6 .slick-active button:after' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'slider_dots_style' => array( 'style-2', 'style-4', 'style-6' ),
					'slider_dots'       => 'yes',
				),
			)
		);
		$this->add_control(
			'dots_active_bg_color',
			array(
				'label'     => esc_html__( 'Dots Active Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li::after,{{WRAPPER}} .list-carousel-slick .slick-dots.style-4 li.slick-active button:before,{{WRAPPER}} .list-carousel-slick .slick-dots.style-5 .slick-active button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-7 .slick-active button' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_dots_style' => array( 'style-2', 'style-4', 'style-5', 'style-7' ),
					'slider_dots'       => 'yes',
				),
			)
		);
		$this->add_control(
			'dots_top_padding',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Dots Top Padding', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slider.slick-dotted' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'slider_dots' => 'yes',
				),
			)
		);
		$this->add_control(
			'hover_show_dots',
			array(
				'label'     => esc_html__( 'On Hover Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_dots' => 'yes',
				),
			)
		);
		$this->add_control(
			'slider_arrows',
			array(
				'label'     => esc_html__( 'Show Arrows', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'slider_arrows_style',
			array(
				'label'     => esc_html__( 'Arrows Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Style 5', 'theplus' ),
					'style-6' => esc_html__( 'Style 6', 'theplus' ),
				),
				'condition' => array(
					'slider_arrows' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'arrows_position',
			array(
				'label'     => esc_html__( 'Arrows Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top-right',
				'options'   => array(
					'top-right'     => esc_html__( 'Top-Right', 'theplus' ),
					'bottm-left'    => esc_html__( 'Bottom-Left', 'theplus' ),
					'bottom-center' => esc_html__( 'Bottom-Center', 'theplus' ),
					'bottom-right'  => esc_html__( 'Bottom-Right', 'theplus' ),
				),
				'condition' => array(
					'slider_arrows'       => array( 'yes' ),
					'slider_arrows_style' => array( 'style-3', 'style-4' ),
				),
			)
		);
		$this->add_control(
			'arrow_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-6:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-6:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-1', 'style-3', 'style-4', 'style-6' ),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'arrow_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1:before,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-6 .icon-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-next.style-2 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-next.style-5 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-5 .icon-wrap:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows' => 'yes',
				),
			)
		);
		$this->add_control(
			'arrow_hover_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1:hover,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1:hover,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:hover:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:hover:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4' ),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'arrow_hover_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1:hover:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:hover:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-6:hover .icon-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-next.style-5:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-5:hover .icon-wrap::after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows' => 'yes',
				),
			)
		);
		$this->add_control(
			'outer_section_arrow',
			array(
				'label'     => esc_html__( 'Outer Content Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_arrows'       => 'yes',
					'slider_arrows_style' => array( 'style-1', 'style-2', 'style-5', 'style-6' ),
				),
			)
		);
		$this->add_control(
			'hover_show_arrow',
			array(
				'label'     => esc_html__( 'On Hover Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_arrows' => 'yes',
				),
			)
		);
		$this->add_control(
			'slider_center_mode',
			array(
				'label'     => esc_html__( 'Center Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'center_padding',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Center Padding', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 0,
				),
				'condition'  => array(
					'slider_center_mode' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'slider_center_effects',
			array(
				'label'     => esc_html__( 'Center Slide Effects', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => theplus_carousel_center_effects(),
				'condition' => array(
					'slider_center_mode' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'scale_center_slide',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Center Slide Scale', 'theplus' ),
				'size_units'  => '',
				'range'       => array(
					'' => array(
						'min'  => 0.3,
						'max'  => 2,
						'step' => 0.02,
					),
				),
				'default'     => array(
					'unit' => '',
					'size' => 1,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slide.slick-current.slick-active.slick-center,
					{{WRAPPER}} .list-carousel-slick .slick-slide.scc-animate' => '-webkit-transform: scale({{SIZE}});-moz-transform:    scale({{SIZE}});-ms-transform:     scale({{SIZE}});-o-transform:      scale({{SIZE}});transform:scale({{SIZE}});opacity:1;',
				),
				'condition'   => array(
					'slider_center_mode'    => 'yes',
					'slider_center_effects' => 'scale',
				),
			)
		);
		$this->add_control(
			'scale_normal_slide',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Normal Slide Scale', 'theplus' ),
				'size_units'  => '',
				'range'       => array(
					'' => array(
						'min'  => 0.3,
						'max'  => 2,
						'step' => 0.02,
					),
				),
				'default'     => array(
					'unit' => '',
					'size' => 0.8,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slide' => '-webkit-transform: scale({{SIZE}});-moz-transform:    scale({{SIZE}});-ms-transform:     scale({{SIZE}});-o-transform:      scale({{SIZE}});transform:scale({{SIZE}});transition: .3s all linear;',
				),
				'condition'   => array(
					'slider_center_mode'    => 'yes',
					'slider_center_effects' => 'scale',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'shadow_active_slide',
				'selector'  => '{{WRAPPER}} .list-carousel-slick .slick-slide.slick-current.slick-active.slick-center .blog-list-content',
				'condition' => array(
					'slider_center_mode'    => 'yes',
					'slider_center_effects' => 'shadow',
				),
			)
		);
		$this->add_control(
			'opacity_normal_slide',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Normal Slide Opacity', 'theplus' ),
				'size_units'  => '',
				'range'       => array(
					'' => array(
						'min'  => 0.1,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'     => array(
					'unit' => '',
					'size' => 0.7,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slide' => 'opacity:{{SIZE}}',
				),
				'condition'   => array(
					'slider_center_mode'     => 'yes',
					'slider_center_effects!' => 'none',
				),
			)
		);
		$this->add_control(
			'slider_rows',
			array(
				'label'     => esc_html__( 'Number Of Rows', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => esc_html__( '1 Row', 'theplus' ),
					'2' => esc_html__( '2 Rows', 'theplus' ),
					'3' => esc_html__( '3 Rows', 'theplus' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'slide_row_top_space',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Row Top Space', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick[data-slider_rows="2"] .slick-slide > div:last-child,{{WRAPPER}} .list-carousel-slick[data-slider_rows="3"] .slick-slide > div:nth-last-child(-n+2)' => 'padding-top:{{SIZE}}px',
				),
				'condition'  => array(
					'slider_rows' => array( '2', '3' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_carousel_tablet',
			array(
				'label' => esc_html__( 'Tablet', 'theplus' ),
			)
		);
		$this->add_control(
			'slider_tablet_column',
			array(
				'label'   => esc_html__( 'Tablet Columns', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => theplus_carousel_tablet_columns(),
			)
		);
		$this->add_control(
			'tablet_steps_slide',
			array(
				'label'       => esc_html__( 'Next Previous', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '1',
				'description' => esc_html__( 'Select option of column scroll on previous or next in carousel.', 'theplus' ),
				'options'     => array(
					'1' => esc_html__( 'One Column', 'theplus' ),
					'2' => esc_html__( 'All Visible Columns', 'theplus' ),
				),
			)
		);

		$this->add_control(
			'slider_responsive_tablet',
			array(
				'label'     => esc_html__( 'Responsive Tablet', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'tablet_slider_draggable',
			array(
				'label'     => esc_html__( 'Draggable', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_infinite',
			array(
				'label'     => esc_html__( 'Infinite Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_autoplay',
			array(
				'label'     => esc_html__( 'Autoplay', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_autoplay_speed',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Autoplay Speed', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 500,
						'max'  => 10000,
						'step' => 200,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 1500,
				),
				'condition'  => array(
					'slider_responsive_tablet' => 'yes',
					'tablet_slider_autoplay'   => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_dots',
			array(
				'label'     => esc_html__( 'Show Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_arrows',
			array(
				'label'     => esc_html__( 'Show Arrows', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_rows',
			array(
				'label'     => esc_html__( 'Number Of Rows', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => esc_html__( '1 Row', 'theplus' ),
					'2' => esc_html__( '2 Rows', 'theplus' ),
					'3' => esc_html__( '3 Rows', 'theplus' ),
				),
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_center_mode',
			array(
				'label'     => esc_html__( 'Center Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_center_padding',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Center Padding', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 0,
				),
				'condition'  => array(
					'slider_responsive_tablet' => 'yes',
					'tablet_center_mode'       => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_carousel_mobile',
			array(
				'label' => esc_html__( 'Mobile', 'theplus' ),
			)
		);
		$this->add_control(
			'slider_mobile_column',
			array(
				'label'   => esc_html__( 'Mobile Columns', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '2',
				'options' => theplus_carousel_mobile_columns(),
			)
		);
		$this->add_control(
			'mobile_steps_slide',
			array(
				'label'       => esc_html__( 'Next Previous', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '1',
				'description' => esc_html__( 'Select option of column scroll on previous or next in carousel.', 'theplus' ),
				'options'     => array(
					'1' => esc_html__( 'One Column', 'theplus' ),
					'2' => esc_html__( 'All Visible Columns', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'slider_responsive_mobile',
			array(
				'label'     => esc_html__( 'Responsive Mobile', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'mobile_slider_draggable',
			array(
				'label'     => esc_html__( 'Draggable', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_infinite',
			array(
				'label'     => esc_html__( 'Infinite Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_autoplay',
			array(
				'label'     => esc_html__( 'Autoplay', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_autoplay_speed',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Autoplay Speed', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 500,
						'max'  => 10000,
						'step' => 200,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 1500,
				),
				'condition'  => array(
					'slider_responsive_mobile' => 'yes',
					'mobile_slider_autoplay'   => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_dots',
			array(
				'label'     => esc_html__( 'Show Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_arrows',
			array(
				'label'     => esc_html__( 'Show Arrows', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_rows',
			array(
				'label'     => esc_html__( 'Number Of Rows', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => esc_html__( '1 Row', 'theplus' ),
					'2' => esc_html__( '2 Rows', 'theplus' ),
					'3' => esc_html__( '3 Rows', 'theplus' ),
				),
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_center_mode',
			array(
				'label'     => esc_html__( 'Center Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_center_padding',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Center Padding', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 0,
				),
				'condition'  => array(
					'slider_responsive_mobile' => 'yes',
					'mobile_center_mode'       => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'carousel_unique_id',
			array(
				'label'       => esc_html__( 'Unique Carousel ID', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'separator'   => 'after',
				'description' => esc_html__( 'Keep this blank or Setup Unique id for carousel which you can use with "Carousel Remote" widget.', 'theplus' ),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_filter_category_styling',
			array(
				'label'     => esc_html__( 'Filter Category', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'RType'           => 'review',
					'layout!'         => 'carousel',
					'filter_category' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'filter_category_typography',
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters li a,{{WRAPPER}} .pt-plus-filter-post-category .category-filters.style-1 li a.all span.all_post_count',
				'separator' => 'after',
			)
		);
		$this->add_responsive_control(
			'filter_category_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-1 li a span:not(.all_post_count),{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count),{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)::before,{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-3 li a,{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-4 li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'filter_category_marign',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'filters_text_color',
			array(
				'label'     => esc_html__( 'Filters Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'after',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .post-filter-data.style-4 .filters-toggle-link' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pt-plus-filter-post-category .post-filter-data.style-4 .filters-toggle-link line,{{WRAPPER}} .pt-plus-filter-post-category .post-filter-data.style-4 .filters-toggle-link circle,{{WRAPPER}} .pt-plus-filter-post-category .post-filter-data.style-4 .filters-toggle-link polyline' => 'stroke: {{VALUE}}',
				),
				'condition' => array(
					'filter_style' => array( 'style-4' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_filter_color_style' );
		$this->start_controls_tab(
			'tab_filter_category_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'filter_category_color',
			array(
				'label'     => esc_html__( 'Category Filter Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'after',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters li a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'filter_category_4_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'after',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-4 li a:before' => 'border-top-color: {{VALUE}}',
				),
				'condition' => array(
					'filter_hover_style' => array( 'style-4' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'filter_category_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count),{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-4 li a:after',
				'separator' => 'before',
				'condition' => array(
					'filter_hover_style' => array( 'style-2', 'style-4' ),
				),
			)
		);
		$this->add_responsive_control(
			'filter_category_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
				'condition'  => array(
					'filter_hover_style' => 'style-2',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'filter_category_shadow',
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)',
				'separator' => 'before',
				'condition' => array(
					'filter_hover_style' => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_filter_category_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'filter_category_hover_color',
			array(
				'label'     => esc_html__( 'Category Filter Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters:not(.hover-style-2) li a:hover,{{WRAPPER}}  .pt-plus-filter-post-category .category-filters:not(.hover-style-2) li a:focus,{{WRAPPER}}  .pt-plus-filter-post-category .category-filters:not(.hover-style-2) li a.active,{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)::before' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'filter_category_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)::before',
				'separator' => 'before',
				'condition' => array(
					'filter_hover_style' => 'style-2',
				),
			)
		);
		$this->add_responsive_control(
			'filter_category_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
				'condition'  => array(
					'filter_hover_style' => 'style-2',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'filter_category_hover_shadow',
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)::before',
				'separator' => 'before',
				'condition' => array(
					'filter_hover_style' => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'filter_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-1 li a::after' => 'background: {{VALUE}};',
				),
				'separator' => 'before',
				'condition' => array(
					'filter_hover_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'count_filter_category_options',
			array(
				'label'     => esc_html__( 'Count Filter Category', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'category_count_color',
			array(
				'label'     => esc_html__( 'Category Count Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters li a span.all_post_count' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'category_count_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.style-1 li a.all span.all_post_count',
				'condition' => array(
					'filter_style' => array( 'style-1' ),
				),
			)
		);
		$this->add_control(
			'category_count_bg_color',
			array(
				'label'     => esc_html__( 'Count Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.style-3 a span.all_post_count' => 'background: {{VALUE}}',
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.style-3 a span.all_post_count:before' => 'border-top-color: {{VALUE}}',
				),
				'condition' => array(
					'filter_style' => array( 'style-3' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'filter_category_count_shadow',
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.style-1 li a.all span.all_post_count',
				'separator' => 'before',
				'condition' => array(
					'filter_style' => array( 'style-1' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'Fb_optn_stl_section',
			array(
				'label'     => esc_html__( 'Facebook', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'RType' => 'review',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'FbnameTypo',
				'label'    => esc_html__( 'Username Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-reviews .facebook .tp-SR-username a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'FbMsgTypo',
				'label'    => esc_html__( 'Message Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-reviews .facebook .tp-SR-content',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'FbPostOnTypo',
				'label'     => esc_html__( 'Post On Text Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-social-reviews .facebook .tp-SR-logotext',
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'FbTimeTypo',
				'label'    => esc_html__( 'Time Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-reviews .facebook .tp-SR-time',
			)
		);
		$this->start_controls_tabs( 'fb_color_style' );
		$this->start_controls_tab(
			'fb_optn_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'FbnameCr',
			array(
				'label'     => esc_html__( 'Username Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .grid-item.facebook .tp-SR-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'FbMassageCr',
			array(
				'label'     => esc_html__( 'Message Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .grid-item.facebook .tp-SR-content' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'FbPostONCr',
			array(
				'label'     => esc_html__( 'Post On Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .grid-item.facebook .tp-SR-logotext .tp-newline:nth-child(n)' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'FbTimeCr',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .grid-item.facebook .tp-SR-time' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'BoxFblable',
			array(
				'label'     => esc_html__( 'Box Background Options', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'FbBpadding',
			array(
				'label'      => esc_html__( 'Box Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .facebook .tp-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'FbNBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .facebook .tp-review',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'FbNB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .facebook .tp-review',
			)
		);
		$this->add_responsive_control(
			'FbCRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .facebook .tp-review' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'FbBs',
				'selector' => '{{WRAPPER}} .tp-social-reviews .facebook .tp-review',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'fb_optn_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'FbHnameCr',
			array(
				'label'     => esc_html__( 'Username Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .facebook:hover .tp-SR-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'FbHMassageCr',
			array(
				'label'     => esc_html__( 'Message Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .facebook:hover .tp-SR-content' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'FbHPostONCr',
			array(
				'label'     => esc_html__( 'Post On Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .facebook:hover .tp-SR-logotext .tp-newline:nth-child(n)' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'FbHTimeCr',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .facebook:hover .tp-SR-time' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'FbBHpadding',
			array(
				'label'      => esc_html__( 'Box Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .grid-item.facebook:hover .tp-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'FbHBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .facebook:hover .tp-review',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'FbHB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .facebook:hover .tp-review',
			)
		);
		$this->add_responsive_control(
			'FbBHRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .facebook:hover .tp-review' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'FbHBs',
				'selector' => '{{WRAPPER}} .tp-social-reviews .facebook:hover .tp-review',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'FbPRs',
			array(
				'label'      => esc_html__( 'Profile Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .facebook .tp-SR-profile' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'FbHpd',
			array(
				'label'      => esc_html__( 'Header Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .facebook .tp-SR-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'FbBpd',
			array(
				'label'      => esc_html__( 'Content Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .facebook .tp-SR-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'FbFpd',
			array(
				'label'      => esc_html__( 'Footer Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .facebook .tp-SR-bottom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'google_optn_stl_section',
			array(
				'label'     => esc_html__( 'Google', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'RType' => 'review',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'GnameTypo',
				'label'    => esc_html__( 'Username Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-reviews .google .tp-SR-username a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'GMsgTypo',
				'label'    => esc_html__( 'Message Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-reviews .google .tp-SR-content',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'GPostOnTypo',
				'label'     => esc_html__( 'Post On Text Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-social-reviews .google .tp-SR-logotext',
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'GTimeTypo',
				'label'    => esc_html__( 'Time Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-reviews .google .tp-SR-time',
			)
		);
		$this->start_controls_tabs( 'google_color_style' );
		$this->start_controls_tab(
			'google_optn_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'GNnameCr',
			array(
				'label'     => esc_html__( 'Username Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .google .tp-SR-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'GNMassageCr',
			array(
				'label'     => esc_html__( 'Message Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .google .tp-SR-content' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'GNPostONCr',
			array(
				'label'     => esc_html__( 'Post On Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .google .tp-SR-logotext' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'GNTimeCr',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .google .tp-SR-time' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'BoxGGlable',
			array(
				'label'     => esc_html__( 'Box Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'GNBpadding',
			array(
				'label'      => esc_html__( 'Box Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .google .tp-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'GNBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-social-reviews .google .tp-review',
				'condition' => array(
					'RType' => 'review',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'GNBr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .google .tp-review',
			)
		);
		$this->add_responsive_control(
			'GNRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .google .tp-review' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'GNBs',
				'selector' => '{{WRAPPER}} .tp-social-reviews .google .tp-review',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'google_optn_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'GHnameCr',
			array(
				'label'     => esc_html__( 'Username Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .google:hover .tp-SR-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'GHMassageCr',
			array(
				'label'     => esc_html__( 'Message Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .google:hover .tp-SR-content' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'GHPostONCr',
			array(
				'label'     => esc_html__( 'Post On Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .google:hover .tp-SR-logotext' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'GHTimeCr',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .google:hover .tp-SR-time' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'GHBpadding',
			array(
				'label'      => esc_html__( 'Box Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .google:hover .tp-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'GHBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .google:hover .tp-review',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'GHBr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .google:hover .tp-review',
			)
		);
		$this->add_responsive_control(
			'GHRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .google:hover .tp-review' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'GHBs',
				'selector' => '{{WRAPPER}} .tp-social-reviews .google:hover .tp-review',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'GPRs',
			array(
				'label'      => esc_html__( 'Profile Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .google .tp-SR-profile' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'GHpd',
			array(
				'label'      => esc_html__( 'Header Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .grid-item.google .tp-SR-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'GBpd',
			array(
				'label'      => esc_html__( 'Content Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .grid-item.google .tp-SR-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'GFpd',
			array(
				'label'      => esc_html__( 'Footer Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .google .tp-SR-bottom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'cstm_optn_stl_section',
			array(
				'label'     => esc_html__( 'Manual', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'RType' => 'review',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'CnameTypo',
				'label'    => esc_html__( 'Username Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-reviews .custom .tp-SR-username a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'CMsgTypo',
				'label'    => esc_html__( 'Message Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-reviews .custom .tp-SR-content',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'CPostOnTypo',
				'label'     => esc_html__( 'Post On Text Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-social-reviews .custom .tp-SR-logotext',
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'CTimeTypo',
				'label'    => esc_html__( 'Time Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-reviews .custom .tp-SR-time',
			)
		);
		$this->start_controls_tabs( 'cstm_color_style' );
		$this->start_controls_tab(
			'cstm_optn_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'CnameCr',
			array(
				'label'     => esc_html__( 'Username Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .custom .tp-SR-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'CMassageCr',
			array(
				'label'     => esc_html__( 'Message Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .custom .tp-SR-content' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'CPostONCr',
			array(
				'label'     => esc_html__( 'Post On Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .custom .tp-SR-logotext' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'CTimeCr',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .custom .tp-SR-time' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'content_CBBg_opt',
			array(
				'label'     => esc_html__( 'Bottom Background', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'CBBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-social-reviews .custom .tp-SR-header',
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->add_control(
			'BoxCustomlable',
			array(
				'label'     => esc_html__( 'Box Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'CusNBpadding',
			array(
				'label'      => esc_html__( 'Box Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .custom .tp-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'CNBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .custom .tp-review',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'CusNBr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .custom .tp-review',
			)
		);
		$this->add_responsive_control(
			'CusNCRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .custom .tp-review' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'CusNBs',
				'selector' => '{{WRAPPER}} .tp-social-reviews .custom .tp-review',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'cstm_optn_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'CHnameCr',
			array(
				'label'     => esc_html__( 'Username Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .custom:hover .tp-SR-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'CHMassageCr',
			array(
				'label'     => esc_html__( 'Message Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .custom:hover .tp-SR-content' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'CHPostONCr',
			array(
				'label'     => esc_html__( 'Post On Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .custom:hover .tp-SR-logotext' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'style!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'CHTimeCr',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .custom:hover .tp-SR-time' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'content_CHBBg_opt',
			array(
				'label'     => esc_html__( 'Bottom Background', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'CHBBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-social-reviews .custom:hover .tp-SR-header',
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->add_responsive_control(
			'CusHBpadding',
			array(
				'label'      => esc_html__( 'Box Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .custom:hover .tp-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'CHBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .custom:hover .tp-review',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'CusHBr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .custom:hover .tp-review',
			)
		);
		$this->add_responsive_control(
			'CusHCRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .custom:hover .tp-review' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'CusHBs',
				'selector' => '{{WRAPPER}} .tp-social-reviews .custom:hover .tp-review',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'CusPRs',
			array(
				'label'      => esc_html__( 'Profile Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .custom .tp-SR-profile' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'CusHpd',
			array(
				'label'      => esc_html__( 'Header Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .custom .tp-SR-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'CusBpd',
			array(
				'label'      => esc_html__( 'Content Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .custom .tp-SR-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'CusFpd',
			array(
				'label'      => esc_html__( 'Footer Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .custom .tp-SR-bottom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'bg_optn_stl_section',
			array(
				'label'     => esc_html__( 'Main Area', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'RType' => 'beach',
				),
			)
		);
		$this->add_responsive_control(
			'Bboxwidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Box Width', 'theplus' ),
				'size_units'  => array( '%' ),
				'range'       => array(
					'%' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => '%',
					'size' => 100,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-reviews .tp-review' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'Bstyle' => array( 'style-2', 'style-3' ),
				),
			)
		);
		$this->add_control(
			'alignmentbeach',
			array(
				'label'        => esc_html__( 'Alignment', 'theplus' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors'    => array(
					'{{WRAPPER}} .social-RB-style-2 .tp-batch-top,{{WRAPPER}} .social-RB-style-2 .tp-batch-rating,{{WRAPPER}} .social-RB-style-2 .tp-batch-contant' => 'text-align: {{VALUE}}',
				),
				'default'      => 'center',
				'toggle'       => true,
				'label_widget' => false,
				'condition'    => array(
					'Bstyle' => array( 'style-2' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'BTypo',
				'label'     => esc_html__( 'Title Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .social-RB-style-1.tp-review .tp-batch-user,{{WRAPPER}} .social-RB-style-2.tp-review .tp-batch-user,{{WRAPPER}} .social-RB-style-3.tp-review .tp-batch-user',
				'condition' => array(
					'Bstyle' => array( 'style-2' ),
				),
			)
		);
		$this->add_control(
			'TCr',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .social-RB-style-1.tp-review .tp-batch-user,{{WRAPPER}} .social-RB-style-2.tp-review .tp-batch-user,{{WRAPPER}} .social-RB-style-3.tp-review .tp-batch-user' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'Bstyle' => array( 'style-2' ),
				),
				'separator' => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'BRbyCr',
				'label'    => esc_html__( 'Extra Title Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-review .tp-batch-total',
			)
		);
		$this->add_control(
			'TRbyCr',
			array(
				'label'     => esc_html__( 'Extra Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-review .tp-batch-total' => 'color: {{VALUE}}',
				),
			)
		);
		$this->start_controls_tabs( 'bdg_imgR_style' );
		$this->start_controls_tab(
			'bdg_Iimg',
			array(
				'label'     => esc_html__( 'Images', 'theplus' ),
				'condition' => array(
					'Bstyle' => array( 'style-1' ),
				),
			)
		);
		$this->add_responsive_control(
			'Imgsize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-reviews .social-RB-style-1 .tp-batch-Img' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'Bstyle' => array( 'style-1' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'ImgBorder',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-social-reviews .social-RB-style-1 .tp-batch-Img',
				'condition' => array(
					'Bstyle' => array( 'style-1' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'ImgBS',
				'selector'  => '{{WRAPPER}} .tp-social-reviews .social-RB-style-1 .tp-batch-Img',
				'condition' => array(
					'Bstyle' => array( 'style-1' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'bdg_Icicn',
			array(
				'label'     => esc_html__( 'Icon', 'theplus' ),
				'condition' => array(
					'Bstyle' => array( 'style-2' ),
				),
			)
		);
		$this->add_responsive_control(
			'BSISize',
			array(
				'label'      => esc_html__( 'Social Icon Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .social-RB-style-2 .tp-SR-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Bstyle' => array( 'style-2' ),
				),
			)
		);
		$this->add_responsive_control(
			'BSITopB',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Social Icon Top-Bottom', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-reviews .social-RB-style-2 .tp-SR-logo' => 'top: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'Bstyle' => array( 'style-2' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'bdg_AavgR',
			array(
				'label'     => esc_html__( 'Average', 'theplus' ),
				'condition' => array(
					'Bstyle' => array( 'style-3' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'AvrageTxtTypo',
				'label'     => esc_html__( 'Text Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-social-reviews .tp-batch-number span',
				'condition' => array(
					'Bstyle' => array( 'style-3' ),
				),
			)
		);
		$this->add_control(
			'AvrageTxtCr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-batch-number span' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'Bstyle' => array( 'style-3' ),
				),
			)
		);
		$this->add_control(
			'AvrageCr',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-batch-number span' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'Bstyle' => array( 'style-3' ),
				),
			)
		);
		$this->add_responsive_control(
			'AvragePadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-batch-number span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Bstyle' => array( 'style-3' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'bdg_Rrating',
			array(
				'label' => esc_html__( 'Rating', 'theplus' ),
			)
		);
		$this->add_control(
			'BDyIcon',
			array(
				'label'   => esc_html__( 'Icon', 'theplus' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-star',
					'library' => 'solid',
				),
			)
		);
		$this->add_control(
			'BstarCr',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-batch-start' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'BstarIsize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-reviews .tp-batch-start' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'BstarIwidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Space', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-reviews .b-star' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'BstarBgCr',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-social-reviews .social-RB-style-2 .tp-batch-start',
				'condition' => array(
					'Bstyle' => array( 'style-2' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'BstarBr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-social-reviews .social-RB-style-2 .tp-batch-start',
				'separator' => 'before',
				'condition' => array(
					'Bstyle' => array( 'style-2' ),
				),
			)
		);
		$this->add_responsive_control(
			'BstarRsBr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .social-RB-style-2 .tp-batch-start' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Bstyle' => array( 'style-2' ),
				),
			)
		);
		$this->add_responsive_control(
			'BiconPadd',
			array(
				'label'      => esc_html__( 'Icon Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .social-RB-style-2 .tp-batch-start' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Bstyle' => array( 'style-2' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'bdg_InnerContent_opt',
			array(
				'label'     => esc_html__( 'Badge Inner Content Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'bdg_InnerContent_Padd',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-review .tp-batch-contant' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'bdg_InnerContent_style' );
		$this->start_controls_tab(
			'bdg_InnerContent_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'Bstyle' => array( 'style-2', 'style-3' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bdg_InnerContent_BGN',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .social-RB-style-2.tp-review .tp-batch-contant,{{WRAPPER}} .tp-social-reviews .social-RB-style-3.tp-review .tp-batch-top',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'bdg_InnerContent_BrN',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-social-reviews .social-RB-style-2.tp-review .tp-batch-contant,{{WRAPPER}} .tp-social-reviews .social-RB-style-3.tp-review .tp-batch-top',
				'condition' => array(
					'Bstyle' => array( 'style-2', 'style-3' ),
				),
			)
		);
		$this->add_responsive_control(
			'bdg_InnerContent_BDRsN',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .social-RB-style-2.tp-review .tp-batch-contant' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tp-social-reviews .social-RB-style-3.tp-review .tp-batch-top' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Bstyle' => array( 'style-2', 'style-3' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'bdg_InnerContent_BswN',
				'selector'  => '{{WRAPPER}} .tp-social-reviews .social-RB-style-2.tp-review .tp-batch-contant,{{WRAPPER}} .tp-social-reviews .social-RB-style-3.tp-review .tp-batch-top',
				'condition' => array(
					'Bstyle' => array( 'style-2', 'style-3' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'bdg_InnerContent_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'Bstyle' => array( 'style-2', 'style-3' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'bdg_InnerContent_BGH',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-social-reviews:hover .social-RB-style-2.tp-review .tp-batch-contant,{{WRAPPER}} .tp-social-reviews:hover .social-RB-style-3.tp-review .tp-batch-top',
				'condition' => array(
					'Bstyle' => array( 'style-2', 'style-3' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'bdg_InnerContent_BrH',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-social-reviews:hover .social-RB-style-2.tp-review .tp-batch-contant,{{WRAPPER}} .tp-social-reviews:hover .social-RB-style-3.tp-review .tp-batch-top',
				'condition' => array(
					'Bstyle' => array( 'style-2', 'style-3' ),
				),
			)
		);
		$this->add_responsive_control(
			'bdg_InnerContent_BDRsH',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews:hover .social-RB-style-2.tp-review .tp-batch-contant' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tp-social-reviews:hover .social-RB-style-3.tp-review .tp-batch-top' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'bdg_InnerContent_BswH',
				'selector' => '{{WRAPPER}} .tp-social-reviews:hover .social-RB-style-2.tp-review .tp-batch-contant,{{WRAPPER}} .tp-social-reviews:hover .social-RB-style-3.tp-review .tp-batch-top',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'bdg_Bgoutr_opt',
			array(
				'label'     => esc_html__( 'Badge Outer Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'bdg_Bgoutr_Padd',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'bdg_Bgoutr_style' );
		$this->start_controls_tab(
			'bdg_Bgoutr_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bdg_Bgoutr_BGN',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-review',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'bdg_Bgoutr_BrN',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-review',
			)
		);
		$this->add_responsive_control(
			'bdg_Bgoutr_BDRsN',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-review' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'bdg_Bgoutr_BswN',
				'selector' => '{{WRAPPER}} .tp-social-reviews .tp-review',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'bdg_Bgoutr_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bdg_Bgoutr_BGH',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews:hover .tp-review',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'bdg_Bgoutr_BrH',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews:hover .tp-review',
			)
		);
		$this->add_responsive_control(
			'bdg_Bgoutr_BDRsH',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews:hover .tp-review' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'bdg_Bgoutr_BswH',
				'selector'  => '{{WRAPPER}} .tp-social-reviews:hover .tp-review',
				'condition' => array(
					'Bstyle' => array( 'style-1', 'style-2', 'style-3' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'rcmnd_optn_stl_section',
			array(
				'label'     => esc_html__( 'Sub Area', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'Bstyle' => 'style-1',
				),
			)
		);
		$this->add_control(
			'RBalignment',
			array(
				'label'        => esc_html__( 'Alignment', 'theplus' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'space-around'  => array(
						'title' => esc_html__( 'Space Around', 'theplus' ),
						'icon'  => 'eicon-text-align-justify',
					),
					'flex-start'    => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'        => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'      => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
					'space-between' => array(
						'title' => esc_html__( 'Space Between', 'theplus' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'selectors'    => array(
					'{{WRAPPER}} .tp-social-reviews .tp-batch-recommend' => 'justify-content: {{VALUE}}',
				),
				'default'      => 'center',
				'toggle'       => true,
				'label_widget' => false,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'RBTypo',
				'label'    => esc_html__( 'Text Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-batch-recommend .tp-batch-recommend-text',
			)
		);
		$this->add_control(
			'RTCr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-batch-recommend' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'RBCr',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .tp-batch-recommend' => 'background-color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RBr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-batch-recommend',
			)
		);
		$this->add_responsive_control(
			'RRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-batch-recommend' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'rcmnd_btn_style' );
		$this->start_controls_tab(
			'rcmnd_optn_btnone',
			array(
				'label' => esc_html__( 'First Button', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'BtnOtypo',
				'label'    => esc_html__( 'Text Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-reviews .batch-btn-yes',
			)
		);
		$this->add_control(
			'BtnOCr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .batch-btn-yes' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'BtnOBg',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .batch-btn-yes' => 'background-color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'BtnOB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .batch-btn-yes',
			)
		);
		$this->add_responsive_control(
			'BtnOBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .batch-btn-yes' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'BtnOMargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-batch-recommend a.batch-btn-yes' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'rcmnd_optn_btntwo',
			array(
				'label' => esc_html__( 'Second Button', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'BtnTtypo',
				'label'    => esc_html__( 'Text Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-reviews .batch-btn-no',
			)
		);
		$this->add_control(
			'BtnTCr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .batch-btn-no' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'BtnTBg',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-reviews .batch-btn-no' => 'background-color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'BtnTB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-reviews .batch-btn-no',
			)
		);
		$this->add_responsive_control(
			'BtnTBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .batch-btn-no' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'BtnTMargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-reviews .tp-batch-recommend .batch-btn-no' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings   = $this->get_settings_for_display();
		$WidgetUID  = $this->get_unique_selector();
		$uid_socirw = uniqid( 'tp-socirw' );
		$widget_id  = $this->get_id();
		$layout     = ! empty( $settings['layout'] ) ? $settings['layout'] : 'grid';
		$RType      = ! empty( $settings['RType'] ) ? $settings['RType'] : 'review';
		$style      = ! empty( $settings['style'] ) ? $settings['style'] : 'style-1';
		$Repeater   = ! empty( $settings['Rreviews'] ) ? $settings['Rreviews'] : array();

		$RefreshTime = ! empty( $settings['TimeFrq'] ) ? $settings['TimeFrq'] : '3600';
		$TimeFrq     = array( 'TimeFrq' => $RefreshTime );

		$OverlayImage = ! empty( $settings['OverlayImage'] == 'yes' ) ? 'overlayimage' : '';
		$UserFooter   = ! empty( $settings['layoutstyle2'] ) ? $settings['layoutstyle2'] : 'layout-1';
		$FeedId       = ! empty( $settings['FeedId'] ) ? preg_split( '/\,/', $settings['FeedId'] ) : array();
		$CategoryWF   = ! empty( $settings['filter_category'] ) ? $settings['filter_category'] : 'no';
		$Postdisplay  = ! empty( $settings['display_posts'] ) ? (int) $settings['display_posts'] : '';
		$postLodop    = ! empty( $settings['post_extra_option'] ) ? $settings['post_extra_option'] : '';
		$postview     = ! empty( $settings['load_more_post'] ) ? (int) $settings['load_more_post'] : '';
		$loadbtnText  = ! empty( $settings['load_more_btn_text'] ) ? $settings['load_more_btn_text'] : '';
		$loadingtxt   = ! empty( $settings['tp_loading_text'] ) ? $settings['tp_loading_text'] : '';
		$allposttext  = ! empty( $settings['loaded_posts_text'] ) ? $settings['loaded_posts_text'] : '';
		$txtLimt      = ! empty( $settings['TextLimit'] == 'yes' ) ? true : false;
		$TextCount    = ! empty( $settings['TextCount'] ) ? $settings['TextCount'] : 100;
		$TextType     = ! empty( $settings['TextType'] ) ? $settings['TextType'] : 'char';
		$TextMore     = ! empty( $settings['TextMore'] ) ? $settings['TextMore'] : 'Show More';
		$TextLess     = ! empty( $settings['TextLess'] ) ? $settings['TextLess'] : 'Show Less';
		$TextDots     = ! empty( $settings['TextDots'] == 'yes' ) ? '...' : '';
		$ShowFeedId   = ! empty( $settings['ShowFeedId'] ) ? $settings['ShowFeedId'] : false;
		$Performance  = ! empty( $settings['perf_manage'] ) ? $settings['perf_manage'] : false;

		$layout_attr = '';
		$data_class  = '';
		if ( ! empty( $layout ) ) {
			$data_class .= theplus_get_layout_list_class( $layout );
			$layout_attr = theplus_get_layout_list_attr( $layout );
		} else {
			$data_class .= ' list-isotope';
		}

		$carousel_direction = '';
		$carousel_slider    = '';
		if ( 'carousel' === $layout ) {
			$carousel_direction = ! empty( $settings['carousel_direction'] ) ? $settings['carousel_direction'] : 'ltr';

			if ( ! empty( $carousel_direction ) ) {
				$carousel_data = array(
					'carousel_direction' => $carousel_direction,
				);

				$carousel_slider = 'data-result="' . htmlspecialchars( wp_json_encode( $carousel_data, true ), ENT_QUOTES, 'UTF-8' ) . '"';
			}
		}

		$desktop_class = '';
		$tablet_class  = '';
		$mobile_class  = '';
		if ( 'carousel' !== $layout ) {
			$desktop_class .= 'tp-col-12';
			$desktop_class  = ' tp-col-lg-' . esc_attr( $settings['desktop_column'] );
			$tablet_class   = ' tp-col-md-' . esc_attr( $settings['tablet_column'] );
			$mobile_class   = ' tp-col-sm-' . esc_attr( $settings['mobile_column'] );
			$mobile_class  .= ' tp-col-' . esc_attr( $settings['mobile_column'] );
		}

		$output    = '';
		$data_attr = '';
		if ( 'carousel' === $layout ) {
			if ( ! empty( $settings['hover_show_dots'] ) && 'yes' === $settings['hover_show_dots'] ) {
				$data_class .= ' hover-slider-dots';
			}

			if ( ! empty( $settings['hover_show_arrow'] ) && 'yes' === $settings['hover_show_arrow'] ) {
				$data_class .= ' hover-slider-arrow';
			}

			if ( ! empty( $settings['outer_section_arrow'] ) && 'yes' === $settings['outer_section_arrow'] && ( 'style-1' === $settings['slider_arrows_style'] || 'style-2' === $settings['slider_arrows_style'] || 'style-5' === $settings['slider_arrows_style'] || 'style-6' === $settings['slider_arrows_style'] ) ) {
				$data_class .= ' outer-slider-arrow';
			}

			$data_attr .= $this->get_carousel_options();
			if ( 'style-3' === $settings['slider_arrows_style'] || 'style-4' === $settings['slider_arrows_style'] ) {
				$data_class .= ' ' . $settings['arrows_position'];
			}

			if ( ( $settings['slider_rows'] > 1 ) || ( $settings['tablet_slider_rows'] > 1 ) || ( $settings['mobile_slider_rows'] > 1 ) ) {
				$data_class .= ' multi-row';
			}
		}
		if ( 'yes' === $CategoryWF ) {
			$data_class .= ' pt-plus-filter-post-category ';
		}

		$ji = 1;
		$ij = '';

		$uid_socirw = uniqid( 'post' );
		if ( ! empty( $settings['carousel_unique_id'] ) ) {
			$uid_socirw = 'tpca_' . $settings['carousel_unique_id'];
		}

		$data_attr .= ' data-id="' . esc_attr( $uid_socirw ) . '"';
		$data_attr .= ' data-style="' . esc_attr( $style ) . '"';

		$NormalScroll = '';
		$ScrollOn     = ! empty( $settings['ScrollOn'] ) ? true : false;
		if ( ! empty( $ScrollOn ) ) {
			$ScrollData = array(
				'className' => 'tp-normal-scroll',
				'ScrollOn'  => $ScrollOn,
				'Height'    => ! empty( $settings['ScrollHgt']['SIZE'] ) ? (int) $settings['ScrollHgt']['SIZE'] : 100,
				'TextLimit' => $txtLimt,
			);

			$NormalScroll = json_encode( $ScrollData, true );
		}

		$txtlimitData = '';
		if ( ! empty( $txtLimt ) ) {
			$txtlimitDataa = array(
				'showmoretxt' => $TextMore,
				'showlesstxt' => $TextLess,
			);

			$txtlimitData = json_encode( $txtlimitDataa, true );
		}

		$output .= '<div id="' . esc_attr( $uid_socirw ) . '" class="' . esc_attr( $uid_socirw ) . ' tp-social-reviews ' . esc_attr( $data_class ) . '" ' . $layout_attr . ' ' . $data_attr . ' ' . $carousel_slider . ' dir=' . esc_attr( $carousel_direction ) . ' data-enable-isotope="1"  data-scroll-normal="' . esc_attr( $NormalScroll ) . '" data-textlimit="' . esc_attr( $txtlimitData ) . '">';

		if ( 'review' === $RType ) {
			$FinalData = array();

			$Perfo_transient = get_transient( "SR-Performance-$widget_id" );
			if ( ( $Performance == false ) || ( $Performance == true && $Perfo_transient === false ) ) {
				$AllData = array();
				foreach ( $Repeater as $index => $R ) {
					$RRT = ! empty( $R['ReviewsType'] ) ? $R['ReviewsType'] : 'facebook';
					$R   = array_merge( $TimeFrq, $R );

					if ( $RRT == 'facebook' ) {
						$AllData[] = $this->Facebook_Reviews( $R );
					} elseif ( $RRT == 'google' ) {
						$AllData[] = $this->Google_Reviews( $R );
					} elseif ( $RRT == 'manual' ) {
						$AllData[] = $this->Custom_Reviews( $R );
					}
				}

				if ( ! empty( $AllData ) ) {
					foreach ( $AllData as $val ) {
						foreach ( $val as $vall ) {
							$FinalData[] = $vall;
						}
					}
				}

				$Reviews_Index = array_column( $FinalData, 'Reviews_Index' );
				array_multisort( $Reviews_Index, SORT_ASC, $FinalData );

				set_transient( "SR-Performance-$widget_id", $FinalData, $RefreshTime );
			} else {
				$FinalData = get_transient( "SR-Performance-$widget_id" );
			}

			if ( ! empty( $FinalData ) ) {
				foreach ( $FinalData as $index => $data ) {
					$PostId = ! empty( $data['PostId'] ) ? $data['PostId'] : array();
					if ( in_array( $PostId, $FeedId ) ) {
						unset( $FinalData[ $index ] );
					}
				}

				if ( 'yes' === $CategoryWF && 'carousel' !== $layout ) {
					$FilterTotal = '';
					if ( 'load_more' === $postLodop || 'lazy_load' === $postLodop ) {
						$FilterTotal = $Postdisplay;
					} else {
						$FilterTotal = count( $FinalData );
					}

					$output .= $this->get_filter_category( $FilterTotal, $FinalData );
				}

				if ( 'load_more' === $postLodop || 'lazy_load' === $postLodop ) {
					$totalReviews = count( $FinalData );
					$remindata    = array_slice( $FinalData, $Postdisplay );

					$RemingC   = count( $remindata );
					$FinalData = array_slice( $FinalData, 0, $Postdisplay );

					$trans_store = get_transient( "SR-LoadMore-$widget_id" );
					if ( false === $trans_store ) {
						set_transient( "SR-LoadMore-$widget_id", $remindata, $RefreshTime );
					} elseif ( ! empty( $trans_store ) && is_array( $trans_store ) && count( $trans_store ) != $totalReviews ) {
						set_transient( "SR-LoadMore-$widget_id", $remindata, $RefreshTime );
					}

					$postattr = array(
						'load_class'     => esc_attr( $widget_id ),
						'layout'         => esc_attr( $layout ),
						'style'          => esc_attr( $style ),
						'desktop_column' => esc_attr( $settings['desktop_column'] ),
						'tablet_column'  => esc_attr( $settings['tablet_column'] ),
						'mobile_column'  => esc_attr( $settings['mobile_column'] ),
						'DesktopClass'   => esc_attr( $desktop_class ),
						'TabletClass'    => esc_attr( $tablet_class ),
						'MobileClass'    => esc_attr( $mobile_class ),
						'TimeFrq'        => esc_attr( $RefreshTime ),
						'FeedId'         => $FeedId,
						'categorytext'   => esc_attr( $CategoryWF ),
						'TextLimit'      => esc_attr( $txtLimt ),
						'TextCount'      => esc_attr( $TextCount ),
						'TextType'       => esc_attr( $TextType ),
						'TextMore'       => esc_attr( $TextMore ),
						'TextLess'       => esc_attr( $TextLess ),
						'TextDots'       => esc_attr( $TextDots ),
						'loadingtxt'     => esc_attr( $loadingtxt ),
						'allposttext'    => esc_attr( $allposttext ),
						'TotalReview'    => esc_attr( $totalReviews ),
						'postview'       => esc_attr( (int) $postview ),
						'display'        => esc_attr( $Postdisplay ),
						'FilterStyle'    => esc_attr( $settings['filter_style'] ),
						'loadview'       => esc_attr( $postview ),
						'theplus_nonce'  => wp_create_nonce( 'theplus-addons' ),
					);

					$data_loadkey = tp_plus_simple_decrypt( json_encode( $postattr ), 'ey' );
				}

				$output .= '<div id="' . esc_attr( $uid_socirw ) . '" class="tp-row post-inner-loop ' . esc_attr( $uid_socirw ) . ' social-reviews-' . esc_attr( $style ) . ' ' . esc_attr( $OverlayImage ) . '" >';
				foreach ( $FinalData as $F_index => $Review ) {
					$r_key           = ! empty( $Review['RKey'] ) ? $Review['RKey'] : '';
					$RIndex          = ! empty( $Review['Reviews_Index'] ) ? $Review['Reviews_Index'] : '';
					$PostId          = ! empty( $Review['PostId'] ) ? $Review['PostId'] : '';
					$Type            = ! empty( $Review['Type'] ) ? $Review['Type'] : '';
					$Time            = ! empty( $Review['CreatedTime'] ) ? $Review['CreatedTime'] : '';
					$UName           = ! empty( $Review['UserName'] ) ? $Review['UserName'] : '';
					$UImage          = ! empty( $Review['UserImage'] ) ? $Review['UserImage'] : '';
					$ULink           = ! empty( $Review['UserLink'] ) ? $Review['UserLink'] : '';
					$PageLink        = ! empty( $Review['PageLink'] ) ? $Review['PageLink'] : '';
					$Massage         = ! empty( $Review['Massage'] ) ? $Review['Massage'] : '';
					$icon            = ! empty( $Review['Icon']['value'] ) ? $Review['Icon']['value'] : 'fas fa-star';
					$logo            = ! empty( $Review['Logo'] ) ? $Review['Logo'] : '';
					$rating          = ! empty( $Review['rating'] ) ? $Review['rating'] : '';
					$CategoryText    = ! empty( $Review['FilterCategory'] ) ? $Review['FilterCategory'] : '';
					$ErrClass        = ! empty( $Review['ErrorClass'] ) ? $Review['ErrorClass'] : '';
					$ReviewClass     = ! empty( $Review['selectType'] ) ? ' ' . $Review['selectType'] : '';
					$PlatformName    = ! empty( $ReviewClass ) ? ucwords( str_replace( 'custom', '', $ReviewClass ) ) : '';
					$category_filter = $loop_category = '';

					if ( ! empty( $CategoryWF == 'yes' ) && ! empty( $CategoryText ) && $layout != 'carousel' ) {
						$loop_category = explode( ',', $CategoryText );
						foreach ( $loop_category as $category ) {
							$category         = $this->Reviews_Media_createSlug( $category );
							$category_filter .= ' ' . esc_attr( $category ) . ' ';
						}
					}
					if ( ! in_array( $PostId, $FeedId ) ) {
						ob_start();
							include THEPLUS_WSTYLES . 'social-reviews/social-review-' . sanitize_file_name( $style ) . '.php';
							$output .= ob_get_contents();
						ob_end_clean();
					}
				}
					$output .= '</div>';

				if ( ! empty( $totalReviews ) && $totalReviews > $Postdisplay && $layout != 'carousel' ) {
					if ( $postLodop == 'load_more' ) {
						$output         .= '<div class="ajax_load_more">';
							$output     .= '<a class="post-load-more" data-loadingtxt="' . esc_attr( $loadingtxt ) . '" data-layout="' . esc_attr( $layout ) . '"  data-loadclass="' . esc_attr( $uid_socirw ) . '" data-loadview="' . esc_attr( $postview ) . '" data-loadattr= \'' . $data_loadkey . '\'>';
								$output .= $loadbtnText;
							$output     .= '</a>';
						$output         .= '</div>';
					} elseif ( $postLodop == 'lazy_load' ) {
						$output         .= '<div class="ajax_lazy_load">';
							$output     .= '<a class="post-lazy-load" data-loadingtxt="' . esc_attr( $loadingtxt ) . '" data-lazylayout="' . esc_attr( $layout ) . '" data-lazyclass="' . esc_attr( $uid_socirw ) . '" data-lazyview="' . esc_attr( $postview ) . '" data-lazyattr= \'' . $data_loadkey . '\'>';
								$output .= '<div class="tp-spin-ring"><div></div><div></div><div></div></div>';
							$output     .= '</a>';
						$output         .= '</div>';
					}
				}
			} else {
				$output .= '<div class="error-handal"> All Social Feed </div>';
			}
		} elseif ( $RType == 'beach' ) {
			$Bstyle       = ! empty( $settings['Bstyle'] ) ? $settings['Bstyle'] : 'style-1';
			$BRecommend   = ! empty( $settings['BRecommend'] ) ? $settings['BRecommend'] : '';
			$BSButton     = ! empty( $settings['BSButton'] ) ? $settings['BSButton'] : '';
			$BBtnName     = ! empty( $settings['BBtnName'] ) ? $settings['BBtnName'] : '';
			$Btxt1        = ! empty( $settings['Btxt1'] ) ? $settings['Btxt1'] : '';
			$Btxt2        = ! empty( $settings['Btxt2'] ) ? $settings['Btxt2'] : '';
			$Blinktxt     = ! empty( $BRecommend ) && ! empty( $settings['Blinktxt'] ) ? $settings['Blinktxt'] : '';
			$Btn2NO       = ! empty( $BRecommend ) && ! empty( $settings['BBtnTName'] ) ? $settings['BBtnTName'] : '';
			$BIcon        = ! empty( $settings['BDyIcon']['value'] ) ? $settings['BDyIcon']['value'] : 'fas fa-star';
			$BIconHidden2 = ! empty( $settings['IconHidden'] ) ? $settings['IconHidden'] : '';
			$BeachData    = $this->Beach_Reviews( $settings );
			$Beach        = ! empty( $BeachData[0] ) ? $BeachData[0] : array();
			$BTotal       = ! empty( $Beach['Total'] ) ? $Beach['Total'] : '';
			$BLink        = ! empty( $Beach['UserLink'] ) ? $Beach['UserLink'] : '';
			$BLogo        = ! empty( $Beach['Logo'] ) ? $Beach['Logo'] : '';
			$BType        = ! empty( $Beach['Type'] ) ? $Beach['Type'] : '';
			$BUname       = ! empty( $Beach['Username'] ) ? $Beach['Username'] : '';
			$BUImage      = ! empty( $Beach['UserImage'] ) ? $Beach['UserImage'] : array();
			$BRating      = ! empty( $Beach['Rating'] ) ? $Beach['Rating'] : '';
			$BErrClass    = ! empty( $Beach['ErrorClass'] ) ? $Beach['ErrorClass'] : '';
			$BMassage     = ! empty( $Beach['Massage'] ) ? $Beach['Massage'] : '';

			ob_start();
			include THEPLUS_WSTYLES . 'social-reviews/social-review-b-' . sanitize_file_name( $Bstyle ) . '.php';
			$output .= ob_get_contents();
			ob_end_clean();
		}
		$output .= '</div>';
		echo $output;
	}

	/**
	 * Function to handle Facebook Reviews
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 *
	 * @param array $RData The data related to Facebook Reviews
	 */
	protected function Facebook_Reviews( $RData ) {
		$settings = $this->get_settings_for_display();
		$Key      = ! empty( $RData['_id'] ) ? $RData['_id'] : '';
		$Token    = ! empty( $RData['Token'] ) ? $RData['Token'] : '';
		$PageId   = ! empty( $RData['FbPageId'] ) ? $RData['FbPageId'] : '';
		$RType    = ! empty( $RData['FbRType'] ) ? $RData['FbRType'] : 'default';
		$MaxR     = ! empty( $RData['MaxR'] ) ? $RData['MaxR'] : 6;
		$Ricon    = ! empty( $RData['icons'] ) ? $RData['icons'] : 'fas fa-star';
		$TimeFrq  = ! empty( $RData['TimeFrq'] ) ? $RData['TimeFrq'] : '';

		$FBNagative   = ! empty( $settings['FBNagative'] ) ? $settings['FBNagative'] : 1;
		$r_category   = ! empty( $RData['RCategory'] ) ? $RData['RCategory'] : '';
		$reviews_type = ! empty( $RData['ReviewsType'] ) ? $RData['ReviewsType'] : '';
		$Fb_Icon      = THEPLUS_ASSETS_URL . 'images/social-review/facebook.svg';

		$a_p_i  = "https://graph.facebook.com/v9.0/{$PageId}?access_token={$Token}&fields=ratings.fields(reviewer{id,name,picture.width(120).height(120)},created_time,rating,recommendation_type,review_text,open_graph_story{id}).limit($MaxR),overall_star_rating,rating_count";
		$Fbdata = $FbArr = array();

		$GetAPI  = get_transient( "Fb-R-Url-$Key" );
		$GetTime = get_transient( "Fb-R-Time-$Key" );
		if ( $GetAPI != $a_p_i || $GetTime != $TimeFrq ) {
			$Fbdata = $this->Review_Api( $a_p_i );
			set_transient( "Fb-R-Url-$Key", $a_p_i, $TimeFrq );
			set_transient( "Fb-R-Data-$Key", $Fbdata, $TimeFrq );
			set_transient( "Fb-R-Time-$Key", $TimeFrq, $TimeFrq );
		} else {
			$Fbdata = get_transient( "Fb-R-Data-$Key" );
		}

		$facebook_status = ! empty( $Fbdata['HTTP_CODE'] ) ? $Fbdata['HTTP_CODE'] : 400;
		if ( 200 == $facebook_status ) {
			$Rating = ! empty( $Fbdata['ratings'] ) && ! empty( $Fbdata['ratings']['data'] ) ? $Fbdata['ratings']['data'] : array();
			foreach ( $Rating as $index => $data ) {

				$FB = ! empty( $data['reviewer'] ) ? $data['reviewer'] : '';
				$RT = ! empty( $data['recommendation_type'] ) ? $data['recommendation_type'] : '';

				$Userlink = ( ! empty( $data['open_graph_story'] ) && ! empty( $data['open_graph_story']['id'] ) ? $data['open_graph_story']['id'] : '' );
				$FType    = '';

				if ( 'default' === $RType ) {
					$FType = $RT;
				} else {
					$FType = $RType;
				}

				$rating = 5;
				if ( 'negative' === $RT ) {
					$rating = $FBNagative;
				}

				if ( $FType == $RT ) {
					$FbArr[] = array(
						'Reviews_Index'  => $index,
						'PostId'         => ! empty( $FB['id'] ) ? $FB['id'] : '',
						'Type'           => $RT,
						'CreatedTime'    => ! empty( $data['created_time'] ) ? $this->Review_Time( $data['created_time'] ) : '',
						'UserName'       => ! empty( $FB['name'] ) ? $FB['name'] : '',
						'UserImage'      => ( ! empty( $FB['picture'] ) && ! empty( $FB['picture']['data']['url'] ) ? $FB['picture']['data']['url'] : THEPLUS_ASSETS_URL . 'images/tp-placeholder.jpg' ),
						'UserLink'       => "https://facebook.com/$Userlink",
						'PageLink'       => "https://www.facebook.com/{$PageId}/reviews",
						'Massage'        => ! empty( $data['review_text'] ) ? $data['review_text'] : '',
						'Icon'           => $Ricon,
						'rating'         => $rating,
						'Logo'           => $Fb_Icon,
						'selectType'     => $reviews_type,
						'FilterCategory' => $r_category,
						'RKey'           => "tp-repeater-item-$Key",
					);
				}
			}
		} else {
			$FbArr[] = $this->Review_Error_array( $Fbdata, $Key, $Fb_Icon, $reviews_type, $r_category );
		}

		return $FbArr;
	}

	/**
	 * Function to handle Googlge Reviews
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 *
	 * @param array $RData The data related to Google Reviews
	 */
	protected function Google_Reviews( $RData ) {
		$Key     = ! empty( $RData['_id'] ) ? $RData['_id'] : '';
		$Token   = ! empty( $RData['Token'] ) ? $RData['Token'] : '';
		$GPlace  = ! empty( $RData['GPlaceID'] ) ? $RData['GPlaceID'] : '';
		$TimeFrq = ! empty( $RData['TimeFrq'] ) ? $RData['TimeFrq'] : '';
		$Ricon   = ! empty( $RData['icons'] ) ? $RData['icons'] : 'fas fa-star';
		$MaxR    = ! empty( $RData['MaxR'] ) ? $RData['MaxR'] : '';

		$reviews_type = ! empty( $RData['ReviewsType'] ) ? $RData['ReviewsType'] : '';
		$r_category   = ! empty( $RData['RCategory'] ) ? $RData['RCategory'] : '';

		$GG_Icon    = THEPLUS_ASSETS_URL . 'images/social-review/google.webp';
		$g_language = ! empty( $RData['GLanguage'] ) ? $RData['GLanguage'] : 'en';

		$g_data  = array();
		$GArr    = array();
		$a_p_i   = "https://maps.googleapis.com/maps/api/place/details/json?placeid={$GPlace}&key={$Token}&language={$g_language}";
		$GetAPI  = get_transient( "G-R-Url-$Key" );
		$GetTime = get_transient( "G-R-Time-$Key" );
		if ( $GetAPI != $a_p_i || $GetTime != $TimeFrq ) {
			$g_data = $this->Review_Api( $a_p_i );
			set_transient( "G-R-Url-$Key", $a_p_i, $TimeFrq );
			set_transient( "G-R-Time-$Key", $TimeFrq, $TimeFrq );
			set_transient( "G-R-Data-$Key", $g_data, $TimeFrq );
		} else {
			$g_data = get_transient( "G-R-Data-$Key" );
		}

		$G_status = ! empty( $g_data['HTTP_CODE'] ) ? $g_data['HTTP_CODE'] : 400;
		if ( 200 == $G_status && empty( $g_data['error_message'] ) ) {
			$GR        = ! empty( $g_data['result']['reviews'] ) ? $g_data['result']['reviews'] : array();
			$PlaceName = strtolower( str_replace( ' ', '_', $g_data['result']['name'] ) );
			$PlaceURL  = ! empty( $g_data['result']['url'] ) ? $g_data['result']['url'] : '';

			$GG_Databash = get_option( "elementor_google_review_{$PlaceName}_{$g_language}" );
			if ( ! empty( $GR ) && ( empty( $GG_Databash ) || $GG_Databash == false ) ) {
				add_option( "elementor_google_review_{$PlaceName}_{$g_language}", $GR, '', 'yes' );
			} elseif ( ! empty( $GR ) && ! empty( $GG_Databash ) ) {
				$AarayTemp = array();
				foreach ( $GG_Databash as $i1 => $g_data ) {
					$AarayTemp[] = $g_data['author_url'];
				}

				foreach ( $GR as $i1 => $data_one ) {
					$AuthorUrlOne = ! empty( $data_one['author_url'] ) ? $data_one['author_url'] : array();

					foreach ( $GG_Databash as $i2 => $data_two ) {
						$AuthorUrlTwo = ! empty( $data_two['author_url'] ) ? $data_two['author_url'] : array();

						if ( $AuthorUrlOne != $AuthorUrlTwo ) {
							if ( ! in_array( $AuthorUrlOne, $AarayTemp ) ) {
								$AarayTemp[]   = $data_one['author_url'];
								$GG_Databash[] = array(
									'author_name'       => ! empty( $data_one['author_name'] ) ? $data_one['author_name'] : '',
									'author_url'        => ! empty( $data_one['author_url'] ) ? $data_one['author_url'] : '',
									'language'          => ! empty( $data_one['language'] ) ? $data_one['language'] : 'en',
									'profile_photo_url' => ! empty( $data_one['profile_photo_url'] ) ? $data_one['profile_photo_url'] : '',
									'rating'            => ! empty( $data_one['rating'] ) ? $data_one['rating'] : '',
									'relative_time_description' => ! empty( $data_one['relative_time_description'] ) ? $data_one['relative_time_description'] : '',
									'text'              => ! empty( $data_one['text'] ) ? $data_one['text'] : '',
									'time'              => ! empty( $data_one['time'] ) ? $data_one['time'] : '',
								);

								update_option( "elementor_google_review_{$PlaceName}_{$g_language}", $GG_Databash );
							}
						}
					}
				}
				$GR = $GG_Databash;
			}

			foreach ( $GR as $index => $G ) {
				if ( $index < $MaxR ) {
					$UnqURl  = explode( '/', trim( $G['author_url'] ) );
					$UnqName = explode( ' ', trim( $G['author_name'] ) );
					$Time    = ( ! empty( $G['relative_time_description'] ) ? $G['relative_time_description'] : '' );
					$GArr[]  = array(
						'Reviews_Index'  => $index,
						'PostId'         => ( ! empty( $UnqName[0] ) && ! empty( $UnqURl[5] ) ? $UnqName[0] . '-' . substr( $UnqURl[5], 0, 10 ) : '' ),
						'Type'           => '',
						'CreatedTime'    => $Time,
						'UserName'       => ! empty( $G['author_name'] ) ? $G['author_name'] : '',
						'UserImage'      => ! empty( $G['profile_photo_url'] ) ? $G['profile_photo_url'] : '',
						'UserLink'       => ! empty( $G['author_url'] ) ? $G['author_url'] : '',
						'PageLink'       => $PlaceURL,
						'Massage'        => ! empty( $G['text'] ) ? $G['text'] : '',
						'Icon'           => $Ricon,
						'rating'         => ! empty( $G['rating'] ) ? $G['rating'] : '',
						'Logo'           => $GG_Icon,
						'selectType'     => $reviews_type,
						'FilterCategory' => $r_category,
						'RKey'           => "tp-repeater-item-$Key",
					);
				}
			}
		} else {
			$GArr[] = $this->Review_Error_array( $g_data, $Key, $GG_Icon, $reviews_type, $r_category );
		}

		return $GArr;
	}

	/**
	 * Function to handle Custom Reviews
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 *
	 * @param array $RData The data related to Custom Reviews
	 */
	protected function Custom_Reviews( $RData ) {
		$Key   = ! empty( $RData['_id'] ) ? $RData['_id'] : '';
		$MaxR  = ! empty( $RData['MaxR'] ) ? $RData['MaxR'] : '';
		$CType = ! empty( $RData['CPFname'] ) ? $RData['CPFname'] : 'facebook';
		$Ricon = ! empty( $RData['icons'] ) ? $RData['icons'] : 'fas fa-star';

		$Name = array();
		if ( ! empty( $RData['Cuname'] ) ) {
			$Cuname = explode( '|', $RData['Cuname'] );

			foreach ( $Cuname as $D ) {
				$Name[] = array( 'Name' => $D );
			}
		} else {
			$Name[] = array( 'Name' => 'Gabriel' );
		}

		$Massage = array();
		if ( ! empty( $RData['Cmassage'] ) ) {
			$Cmassage = explode( '|', $RData['Cmassage'] );
			foreach ( $Cmassage as $D ) {
				$Massage[] = array( 'Message' => $D );
			}
		}

		$Date = array();
		if ( ! empty( $RData['Cdate'] ) ) {
			$Cdate = explode( '|', $RData['Cdate'] );
			foreach ( $Cdate as $D ) {
				$Date[] = array( 'Date' => $D );
			}
		}

		$Star = array();
		if ( ! empty( $RData['Cstar'] ) ) {
			$Cstar = explode( '|', $RData['Cstar'] );
			foreach ( $Cstar as $D ) {
				$Star[] = array( 'Star' => $D );
			}
		}

		$Platform = '';
		$logo     = '';
		if ( 'manual' === $CType ) {
			$Platform = ( ! empty( $RData['CcuSname'] ) ? $RData['CcuSname'] : '' );
			$logo     = ( ( ! empty( $RData['CImg'] ) && ! empty( $RData['CImg']['url'] ) ) ? $RData['CImg']['url'] : THEPLUS_ASSETS_URL . 'images/tp-placeholder.jpg' );
		} elseif ( 'facebook' === $CType ) {
			$Platform = $CType;
			$logo     = THEPLUS_ASSETS_URL . 'images/social-review/facebook.svg';
		} elseif ( 'google' === $CType ) {
			$Platform = $CType;
			$logo     = THEPLUS_ASSETS_URL . 'images/social-review/google.webp';
		}

		$PImg = array();
		if ( ! empty( $RData['CUImg'] ) ) {
			foreach ( $RData['CUImg'] as $D ) {
				$csturl = ! empty( $D['url'] ) ? $D['url'] : THEPLUS_ASSETS_URL . 'images/tp-placeholder.jpg';
				$PImg[] = array( 'Profile' => $csturl );
			}
		}

		$All = array();
		foreach ( $Name as $key => $value ) {
			$FImg  = ! empty( $PImg[ $key ] ) ? $PImg[ $key ] : array( 'Profile' => THEPLUS_ASSETS_URL . 'images/tp-placeholder.jpg' );
			$FMsg  = ! empty( $Massage[ $key ] ) ? $Massage[ $key ] : array( 'Message' => 'Good' );
			$FStar = ! empty( $Star[ $key ] ) ? $Star[ $key ] : array( 'Star' => '3' );
			$FDate = ! empty( $Date[ $key ] ) ? $Date[ $key ] : array( 'Date' => '3 day ago' );

			$All[] = array_merge( (array) $value, $FMsg, $FDate, $FStar, $FImg );
		}

		if ( 'manual' === $CType ) {
			$Platform = "custom $Platform";
		}

		$Arr = array();
		if ( ! empty( $All ) ) {
			foreach ( $All as $i => $v ) {
				if ( $i < $MaxR ) {
					$C_Name = explode( ' ', trim( $v['Name'] ) );
					$C_MSG  = explode( ' ', trim( $v['Message'] ) );
					$Arr[]  = array(
						'Reviews_Index'  => $i,
						'PostId'         => ( ! empty( $C_Name[0] ) && ! empty( $C_MSG[0] ) ? $C_Name[0] . $C_MSG[0] : '' ),
						'UserName'       => ! empty( $v['Name'] ) ? $v['Name'] : '',
						'UserImage'      => ! empty( $v['Profile'] ) ? $v['Profile'] : THEPLUS_ASSETS_URL . 'images/tp-placeholder.jpg',
						'Massage'        => $v['Message'],
						'CreatedTime'    => $v['Date'],
						'Icon'           => $Ricon,
						'rating'         => $v['Star'],
						'selectType'     => $Platform,
						'FilterCategory' => ! empty( $RData['RCategory'] ) ? $RData['RCategory'] : '',
						'Logo'           => $logo,
						'RKey'           => "tp-repeater-item-$Key",
					);
				}
			}
		}
		return $Arr;
	}

	/**
	 * Function to handle Beach Reviews
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 *
	 * @param array $RData The data related to Beach Reviews
	 */
	protected function Beach_Reviews( $attr ) {
		$settings  = $this->get_settings_for_display();
		$widget_id = $this->get_unique_selector();

		$b_type_facebook = ! empty( $settings['BTypeFacebook'] ) ? $settings['BTypeFacebook'] : '';

		$b_type_google = ! empty( $settings['BTypeGoogle'] ) ? $settings['BTypeGoogle'] : '';
		$b_time_frq    = ! empty( $settings['beach_TimeFrq'] ) ? $settings['beach_TimeFrq'] : '3600';
		$BType         = ! empty( $attr['BType'] ) ? $attr['BType'] : 'b-facebook';
		$b_token       = ! empty( $attr['BToken'] ) ? $attr['BToken'] : '';
		$b_ppId        = ! empty( $attr['BPPId'] ) ? $attr['BPPId'] : '';

		$a_p_i = '';
		$Arr   = array();
		if ( 'b-facebook' === $BType ) {
			$a_p_i = "https://graph.facebook.com/v9.0/{$b_ppId}?access_token={$b_token}&fields=ratings.fields(reviewer{id,name,picture.width(120).height(120)},created_time,rating,recommendation_type,review_text,open_graph_story{id}).limit(100),overall_star_rating,rating_count,username";
			$Type  = $b_type_facebook;
			$logo  = THEPLUS_ASSETS_URL . 'images/social-review/facebook.svg';
		} elseif ( 'b-google' === $BType ) {
			$a_p_i = "https://maps.googleapis.com/maps/api/place/details/json?placeid={$b_ppId}&key={$b_token}";
			$Type  = $b_type_google;
			$logo  = THEPLUS_ASSETS_URL . 'images/social-review/google.webp';
		}

		$b_data   = array();
		$BGetAPI  = get_transient( "Beach-Url-$widget_id" );
		$BGetTime = get_transient( "Beach-Time-$widget_id" );
		if ( $BGetAPI != $a_p_i || $BGetTime != $b_time_frq ) {
			$b_data = $this->Review_Api( $a_p_i );
			set_transient( "Beach-Url-$widget_id", $a_p_i, $b_time_frq );
			set_transient( "Beach-Time-$widget_id", $b_time_frq, $b_time_frq );
			set_transient( "Beach-Data-$widget_id", $b_data, $b_time_frq );
		} else {
			$b_data = get_transient( "Beach-Data-$widget_id" );
		}

		$Beach_CODE = ! empty( $b_data['HTTP_CODE'] ) ? $b_data['HTTP_CODE'] : 400;
		if ( 200 == $Beach_CODE && empty( $b_data['error_message'] ) ) {
			$Image        = array();
			$RatingsTotal = 0;
			if ( 'b-facebook' === $BType ) {
				$uname = ! empty( $b_data['username'] ) ? $b_data['username'] : '';
				// $Rating = !empty($b_data['rating_count']) ? $b_data['rating_count'] : 5;
				$Rating = ! empty( $b_data['overall_star_rating'] ) ? $b_data['overall_star_rating'] : '';
				$link   = "https://www.facebook.com/$b_ppId";

				$RatingImg    = ! empty( $b_data['ratings'] ) && ! empty( $b_data['ratings']['data'] ) ? $b_data['ratings']['data'] : array();
				$RatingsTotal = count( $RatingImg );

				foreach ( $RatingImg as $index => $Bdata ) {
					if ( $index > 3 ) {
						break; }
					$FB      = ! empty( $Bdata['reviewer'] ) ? $Bdata['reviewer'] : '';
					$Image[] = ( ! empty( $FB['picture'] ) && ! empty( $FB['picture']['data']['url'] ) ? $FB['picture']['data']['url'] : THEPLUS_ASSETS_URL . 'images/tp-placeholder.jpg' );
				}
			}

			if ( 'b-google' === $BType ) {
				$uname  = ! empty( $b_data['result']['name'] ) ? $b_data['result']['name'] : '';
				$Rating = ! empty( $b_data['result']['rating'] ) ? $b_data['result']['rating'] : '';

				$RatingsTotal = ! empty( $b_data['result']['user_ratings_total'] ) ? $b_data['result']['user_ratings_total'] : 0;
				$link         = "https://www.google.com/search?q=$uname";

				$GR = ! empty( $b_data['result'] ) ? $b_data['result']['reviews'] : array();
				foreach ( $GR as $index => $GI ) {
					if ( $index > 3 ) {
						break;
					}

					$Image[] = ! empty( $GI['profile_photo_url'] ) ? $GI['profile_photo_url'] : THEPLUS_ASSETS_URL . 'images/tp-placeholder.jpg';
				}
			}

			if ( ( 'b-facebook' === $BType && ! empty( $Rating ) ) || 'b-google' === $BType ) {

				$Arr[] = array(
					'Total'     => $RatingsTotal,
					'Username'  => $uname,
					'UserImage' => $Image,
					'UserLink'  => $link,
					'Type'      => $Type,
					'Logo'      => $logo,
					'Rating'    => $Rating,
				);
			} else {
				$Arr[] = array(
					'Total'      => 0,
					'Type'       => 'Oops',
					'Massage'    => "Error : Your facebook account doesn't provide overall ratings due to insufficient reviews on your page. ",
					'UserImage'  => array( $logo, $logo, $logo, $logo ),
					'ErrorClass' => 'danger-error',
					'Logo'       => $logo,
				);
			}
		} else {
			$Error = ! empty( $b_data['error'] ) ? $b_data['error'] : array();
			if ( 'b-facebook' === $BType ) {
				$Etype = ! empty( $Error['type'] ) ? $Error['type'] : '';

				if ( ! empty( $Error['message'] ) ) {
					$message = str_replace( '. ', '<br/>', $Error['message'] );
				} elseif ( ! empty( $Error['Message_Errorcurl'] ) ) {
					$message = $Error['Message_Errorcurl'];
				} else {
					$message = 'Something Wrong';
				}
			}

			if ( 'b-google' === $BType ) {
				$Etype   = ! empty( $b_data['status'] ) ? $b_data['status'] : '';
				$message = ! empty( $b_data['error_message'] ) ? str_replace( ', ', '<br/>', $b_data['error_message'] ) : 'Something wrong';
			}

			$Arr[] = array(
				'Total'      => $Etype,
				'Type'       => ! empty( $b_data['HTTP_CODE'] ) ? 'Error No : ' . $b_data['HTTP_CODE'] : 400,
				'Massage'    => $message,
				'UserImage'  => array( $logo, $logo, $logo, $logo ),
				'ErrorClass' => 'danger-error',
				'Logo'       => $logo,
			);
		}

		return $Arr;
	}

	/**
	 * Function to handle review time formatting
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 *
	 * @param string $datetime The datetime string to be formatted.
	 * @param bool   $full Whether to display the full date and time or just the date.
	 */
	protected function Review_Time( $datetime, $full = false ) {
		$now      = new \DateTime();
		$ago      = new \DateTime( $datetime );
		$diff     = $now->diff( $ago );
		$diff->w  = floor( $diff->d / 7 );
		$diff->d -= $diff->w * 7;
		$string   = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);

		foreach ( $string as $k => &$v ) {
			if ( $diff->$k ) {
				$v = $diff->$k . ' ' . $v . ( $diff->$k > 1 ? 's' : '' );
			} else {
				unset( $string[ $k ] );
			}
		}
		if ( ! $full ) {
			$string = array_slice( $string, 0, 1 );
		}

		return $string ? implode( ', ', $string ) . ' ago' : 'just now';
	}

	/**
	 * Function to fetch data from a specified API endpoint
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 * @param string $a_p_i The URL of the API endpoint.
	 * @return array The response data from the API endpoint, including status code.
	 */
	protected function Review_Api( $a_p_i ) {
		$settings = $this->get_settings_for_display();
		$final    = array();

		$URL          = wp_remote_get( $a_p_i );
		$status_code  = wp_remote_retrieve_response_code( $URL );
		$get_data_one = wp_remote_retrieve_body( $URL );
		$status_code  = array( 'HTTP_CODE' => $status_code );

		$Response = json_decode( $get_data_one, true );
		if ( is_array( $status_code ) && is_array( $Response ) ) {
			$final = array_merge( $status_code, $Response );
		}

		return $final;
	}

	/**
	 * Function to manage carousel options
	 *
	 * @since 1.0.0
	 * @version 5.5.3
	 */
	protected function get_carousel_options() {
		return include THEPLUS_PATH . 'modules/widgets/theplus-carousel-options.php';
	}

	/**
	 * Function to filter categories based on review count
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 * @param int   $count The count threshold for filtering categories.
	 * @param array $allreview The array containing all review data.
	 */
	protected function get_filter_category( $count, $allreview ) {
		$settings        = $this->get_settings_for_display();
		$CategoryWF      = ! empty( $settings['filter_category'] ) ? $settings['filter_category'] : '';
		$category_filter = '';
		$TeamMemberR     = ! empty( $settings['Rreviews'] ) ? $settings['Rreviews'] : array();
		if ( $CategoryWF == 'yes' ) {
			$filter_style        = $settings['filter_style'];
			$filter_hover_style  = $settings['filter_hover_style'];
			$all_filter_category = ! empty( $settings['all_filter_category'] ) ? $settings['all_filter_category'] : esc_html__( 'All', 'theplus' );

			$loop_category = array();
			foreach ( $TeamMemberR as $TMFilter ) {
				$TMCategory = ! empty( $TMFilter['RCategory'] ) ? $TMFilter['RCategory'] : '';
				if ( ! empty( $TMCategory ) ) {
					$loop_category[] = $TMCategory;
				}
			}

			$loop_category  = array_unique( $loop_category );
			$loop_category  = $this->Reviews_Split_Array_Category( $loop_category );
			$count_category = array_count_values( $loop_category );

			$all_category        = '';
			$category_post_count = '';
			if ( 'style-1' === $filter_style ) {
				$all_category = '<span class="all_post_count">' . esc_html( $count ) . '</span>';
			}

			if ( 'style-2' === $filter_style || 'style-3' === $filter_style ) {
				$category_post_count = '<span class="all_post_count">' . esc_attr( $count ) . '</span>';
			}

			$category_filter .= '<div class="post-filter-data ' . esc_attr( $filter_style ) . ' text-' . esc_attr( $settings['filter_category_align'] ) . '">';
			if ( 'style-4' === $filter_style ) {
				$category_filter .= '<span class="filters-toggle-link">' . esc_html__( 'Filters', 'theplus' ) . '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve"><g><line x1="0" y1="32" x2="63" y2="32"></line></g><polyline points="50.7,44.6 63.3,32 50.7,19.4 "></polyline><circle cx="32" cy="32" r="31"></circle></svg></span>';
			}

			$category_filter     .= '<ul class="category-filters ' . esc_attr( $filter_style ) . ' hover-' . esc_attr( $filter_hover_style ) . '">';
				$category_filter .= '<li><a href="#" class="filter-category-list active all" data-filter="*" >' . $category_post_count . '<span data-hover="' . esc_attr( $all_filter_category ) . '">' . esc_html( $all_filter_category ) . '</span>' . $all_category . '</a></li>';

			foreach ( $loop_category as $i => $key ) {
				$slug = $this->Reviews_Media_createSlug( $key );

				$category_post_count = '';
				if ( 'style-2' === $filter_style || 'style-3' === $filter_style ) {

					$CategoryCount = 0;
					foreach ( $allreview as $index => $value ) {
						$category_name = ! empty( $value['FilterCategory'] ) ? $value['FilterCategory'] : '';
						if ( $category_name == $key && $index < $count ) {
							++$CategoryCount;
						}
					}

					$category_post_count = '<span class="all_post_count">' . esc_html( $CategoryCount ) . '</span>';
				}

				$category_filter .= '<li>';

					$category_filter .= '<a href="#" class="filter-category-list"  data-filter=".' . esc_attr( $slug ) . '">';

						$category_filter .= $category_post_count;
						$category_filter .= '<span data-hover="' . esc_attr( $key ) . '">' . esc_html( $key ) . '</span>';

					$category_filter .= '</a>';

				$category_filter .= '</li>';
			}

				$category_filter .= '</ul>';

			$category_filter .= '</div>';
		}

		return $category_filter;
	}

	/**
	 * Function to split a multidimensional array into a flat array
	 *
	 * This function recursively traverses a multidimensional array and splits it into a flat array.
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 * @param array $array The multidimensional array to be split.
	 */
	protected function Reviews_Split_Array_Category( $array ) {
		if ( ! is_array( $array ) ) {
			return false;
		}

		$result = array();
		foreach ( $array as $key => $value ) {
			if ( is_array( $value ) ) {
				$result = array_merge( $result, $this->Reviews_Split_Array_Category( $value ) );
			} else {
				$result[ $key ] = $value;
			}
		}

		return $result;
	}

	/**
	 * Function to create a slug from a given string
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 * @param string $str The string from which to create the slug.
	 * @param string $delimiter The delimiter to replace special characters and spaces with (default is '-').
	 */
	protected function Reviews_Media_createSlug( $str, $delimiter = '-' ) {
		$slug = preg_replace( '/[^A-Za-z0-9-]+/', $delimiter, $str );

		return $slug;
	}

	/**
	 * Function to generate an array containing error information
	 *
	 * This function constructs an array containing error information based on the provided data.
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 * @param array  $data The data containing error information.
	 * @param int    $r_key The key associated with the review.
	 * @param string $icon The icon associated with the error message.
	 * @param string $reviews_type The type of reviews.
	 * @param string $r_category The category of the review.
	 */
	protected function Review_Error_array( $data, $r_key, $icon, $reviews_type, $r_category ) {
		$message = '';
		if ( ! empty( $data ) && ! empty( $data['error_message'] ) ) {
			$message = $data['error_message'];
		} elseif ( ! empty( $data ) && ! empty( $data['error'] ) ) {
			$message = $data['error']['message'];
		} elseif ( ! empty( $data ) && ! empty( $data['status'] ) ) {
			$message = $data['status'];
		} else {
			$message = 'Something Wrong';
		}

		return array(
			'Reviews_Index'  => 1,
			'ErrorClass'     => 'danger-error',
			'CreatedTime'    => ! empty( $data['status'] ) ? $data['status'] : '',
			'Massage'        => $message,
			'UserName'       => ! empty( $data['HTTP_CODE'] ) ? 'Error No : ' . $data['HTTP_CODE'] : '',
			'UserImage'      => $icon,
			'Logo'           => $icon,
			'selectType'     => $reviews_type,
			'FilterCategory' => $r_category,
			'RKey'           => "tp-repeater-item-{$r_key}",
		);
	}

	/**
	 * Defines the content template for the Reviews_Media element.
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	protected function content_template() {}
}
