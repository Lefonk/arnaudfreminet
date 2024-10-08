<?php
/**
 * Widget Name: Social Feed
 * Description: Social Feed
 * Author: Theplus
 * Author URI: https://posimyth.com
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Social_Feed.
 */
class ThePlus_Social_Feed extends Widget_Base {

	/**
	 * Tablet prefix class
	 *
	 * @var slick_tablet of the class.
	 */
	public $slick_tablet = 'body[data-elementor-device-mode="tablet"] {{WRAPPER}} .list-carousel-slick ';

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;

	/**
	 * Mobile prefix class.
	 *
	 * @var slick_mobile of the class.
	 */
	public $slick_mobile = 'body[data-elementor-device-mode="mobile"] {{WRAPPER}} .list-carousel-slick ';

	/**
	 * Get Widget Name.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_name() {
		return 'tp-social-feed';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_title() {
		return esc_html__( 'Social Feed', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_icon() {
		return 'fa fa-rss theplus_backend_icon';
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
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_keywords() {
		return array( 'Social Feed', 'Social Media Feed', 'Instagram Feed', 'Facebook Feed', 'Twitter Feed', 'YouTube Feed', 'Pinterest Feed', 'LinkedIn Feed', 'Social Wall', 'Social Stream', 'Social Grid', 'Social Carousel', 'Social Tiles', 'Social Widget' );
	}

	/**
	 * Update is_reload_preview_required.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function is_reload_preview_required() {
		return true;
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	protected function register_controls() {
		/* Content Feed Start */
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content Feed', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Layout', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => array(
					'grid'     => esc_html__( 'Grid', 'theplus' ),
					'masonry'  => esc_html__( 'Masonry', 'theplus' ),
					'carousel' => esc_html__( 'Carousel', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'style',
			array(
				'label'   => esc_html__( 'Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'selectFeed',
			array(
				'label'   => esc_html__( 'Source', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'Facebook',
				'options' => array(
					'Facebook'  => esc_html__( 'Facebook', 'theplus' ),
					'Instagram' => esc_html__( 'Instagram', 'theplus' ),
					'Twitter'   => esc_html__( 'Twitter', 'theplus' ),
					'Youtube'   => esc_html__( 'Youtube', 'theplus' ),
					'Vimeo'     => esc_html__( 'Vimeo', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'InstagramType',
			array(
				'label'     => esc_html__( 'Select Option', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'Instagram_Basic',
				'options'   => array(
					'Instagram_Basic' => esc_html__( 'Personal', 'theplus' ),
					'Instagram_Graph' => esc_html__( 'Business', 'theplus' ),
				),
				'condition' => array(
					'selectFeed' => 'Instagram',
				),
			)
		);
		$repeater->add_control(
			'ProfileType',
			array(
				'label'     => esc_html__( 'Facebook Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'post',
				'options'   => array(
					'post' => esc_html__( 'Individual', 'theplus' ),
					'page' => esc_html__( 'Page', 'theplus' ),
				),
				'condition' => array(
					'selectFeed' => 'Facebook',
				),
			)
		);
		$repeater->add_control(
			'RAToken',
			array(
				'label'       => esc_html__( 'Access Token', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Value', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'ai' => [
					'active' => false,
				],
				'condition'   => array(
					'selectFeed!' => 'Twitter',
				),
			)
		);
		$repeater->add_control(
			'token_fb_post_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : How to Create Token <a href="https://theplusaddons.com/docs/get-a-facebook-access-token-for-wordpress/#Generate-Access-Token-for-Individual-Account" target="_blank" rel="noopener noreferrer">( Here )</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'selectFeed' => 'Facebook',
					'ProfileType' => 'post',
				),
			)
		);
		$repeater->add_control(
			'token_fb_page_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : How to Create Token <a href="https://api.posimyth.com/facebook-feed-access-token" target="_blank" rel="noopener noreferrer">( Here ) </a> </br> Note : Read Document <a href="https://theplusaddons.com/docs/get-a-facebook-access-token-for-wordpress/#Generate-Access-Token-for-Page" target="_blank" rel="noopener noreferrer"> ( Here ) </a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'selectFeed'  => 'Facebook',
					'ProfileType' => 'page',
				),
			)
		);
		$repeater->add_control(
			'token_ig_personal_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : How to Create Token <a href="https://theplusaddons.com/docs/get-an-instagram-access-token-for-wordpress/#Generate-Access-Token-for-Personal-Account" target="_blank" rel="noopener noreferrer">( Here )</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'selectFeed' 	=> 'Instagram',
					'InstagramType' => 'Instagram_Basic',
				),
			)
		);
		$repeater->add_control(
			'token_ig_business_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : How to Create Token <a href="https://api.posimyth.com/instagram-access-token" target="_blank" rel="noopener noreferrer">( Here )</a> </br> Note : Read Document <a href="https://theplusaddons.com/docs/get-an-instagram-access-token-for-wordpress/#Generate-Access-Token-for-Business-Account" target="_blank" rel="noopener noreferrer">( Here )</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'selectFeed' => 'Instagram',
					'InstagramType' => 'Instagram_Graph',
				),
			)
		);
		$repeater->add_control(
			'RATokenYoutube',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : How to <a href="https://theplusaddons.com/docs/get-a-youtube-api-key-for-wordpress" target="_blank" rel="noopener noreferrer">( Create Token ? )</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'selectFeed' => 'Youtube',
				),
			)
		);
		$repeater->add_control(
			'RATokenVimeo',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : How to <a href="https://theplusaddons.com/docs/get-a-vimeo-access-token-for-wordpress"  target="_blank" rel="noopener noreferrer">(Create Token ?)</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'selectFeed' => 'Vimeo',
				),
			)
		);
		$repeater->add_control(
			'Pageid',
			array(
				'label'       => esc_html__( 'Page ID', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Page ID', 'theplus' ),
				'label_block' => false,
				'condition'   => array(
					'selectFeed'  => 'Facebook',
					'ProfileType' => 'page',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'content',
			array(
				'label'       => esc_html__( 'Content Type', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => false,
				'options'     => array(
					'photo'  => esc_html__( 'Photo', 'theplus' ),
					'video'  => esc_html__( 'Video', 'theplus' ),
					'status' => esc_html__( 'Status', 'theplus' ),
				),
				'default'     => array( 'photo', 'video' ),
				'condition'   => array(
					'selectFeed' => 'Facebook',
				),
			)
		);
		$repeater->add_control(
			'fbAlbum',
			array(
				'label'     => esc_html__( 'Show Album', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => '',
				'condition' => array(
					'selectFeed' => 'Facebook',
				),
			)
		);
		$repeater->add_control(
			'AlbumMaxR',
			array(
				'label'     => esc_html__( 'Max Album Photo', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 50,
				'step'      => 1,
				'default'   => 8,
				'condition' => array(
					'selectFeed' => 'Facebook',
					'fbAlbum'    => 'yes',
				),
			)
		);
		$repeater->add_control(
			'IGImgPic',
			array(
				'label'     => esc_html__( 'Profile Image', 'theplus' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array( 'active' => true ),
				'default'   => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'selectFeed'    => 'Instagram',
					'InstagramType' => 'Instagram_Basic',
				),
			)
		);
		$repeater->add_control(
			'IGPageId',
			array(
				'label'       => __( 'Facebook Page Id', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Enter Page Id', 'theplus' ),
				'condition'   => array(
					'selectFeed'    => 'Instagram',
					'InstagramType' => 'Instagram_Graph',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'IG_FeedTypeGp',
			array(
				'label'     => esc_html__( 'Feed Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'IGUserdata',
				'options'   => array(
					'IGUserdata' => esc_html__( 'Userfeed', 'theplus' ),
					'IGHashtag'  => esc_html__( 'Hashtag', 'theplus' ),
					'IGTag'      => esc_html__( 'Mentions', 'theplus' ),
				),
				'condition' => array(
					'selectFeed'    => 'Instagram',
					'InstagramType' => 'Instagram_Graph',
				),
			)
		);
		$repeater->add_control(
			'IGUserName_GP',
			array(
				'label'       => __( 'UserName', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Enter UserName', 'theplus' ),
				'condition'   => array(
					'selectFeed'    => 'Instagram',
					'InstagramType' => 'Instagram_Graph',
					'IG_FeedTypeGp' => 'IGUserdata',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'IGHashtagName_GP',
			array(
				'label'       => __( 'Hashtag (#)', 'theplus' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Enter Hashtag', 'theplus' ),
				'condition'   => array(
					'selectFeed'    => 'Instagram',
					'InstagramType' => 'Instagram_Graph',
					'IG_FeedTypeGp' => 'IGHashtag',
				),
			)
		);
		$repeater->add_control(
			'IG_hashtagType',
			array(
				'label'     => esc_html__( 'Hashtag Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top_media',
				'options'   => array(
					'top_media'    => esc_html__( 'Top Media', 'theplus' ),
					'recent_media' => esc_html__( 'Recent Media', 'theplus' ),
				),
				'condition' => array(
					'selectFeed'    => 'Instagram',
					'InstagramType' => 'Instagram_Graph',
					'IG_FeedTypeGp' => 'IGHashtag',
				),
			)
		);
		$repeater->add_control(
			'TwApi',
			array(
				'label'       => esc_html__( 'Consumer Key (API Key)', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
				'condition'   => array(
					'selectFeed' => 'Twitter',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'TwApiSecret',
			array(
				'label'       => esc_html__( 'Consumer Secret (API Secret)', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
				'condition'   => array(
					'selectFeed' => 'Twitter',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'TwAccesT',
			array(
				'label'       => esc_html__( 'Access Token', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
				'condition'   => array(
					'selectFeed' => 'Twitter',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'TwAccesTS',
			array(
				'label'       => esc_html__( 'Access Token Secret', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
				'condition'   => array(
					'selectFeed' => 'Twitter',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'RATokenTwitter',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => 'Note : How To <a href="https://developer.twitter.com/en/apps"  target="_blank" rel="noopener noreferrer">(Create App ?)</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'selectFeed' => 'Twitter',
				),
			)
		);
		$repeater->add_control(
			'TwfeedType',
			array(
				'label'     => esc_html__( 'Twitter Feed Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'userfeed',
				'options'   => array(
					'wptimline'    => esc_html__( 'User Timeline', 'theplus' ),
					'userfeed'     => esc_html__( 'User Feed', 'theplus' ),
					'userlikes'    => esc_html__( 'Users Likes', 'theplus' ),
					'userlist'     => esc_html__( 'Tweets List', 'theplus' ),
					'twcollection' => esc_html__( 'Tweets Collection', 'theplus' ),
					'twsearch'     => esc_html__( 'Tweets By Search', 'theplus' ),
					'twtrends'     => esc_html__( 'Tweets Trends', 'theplus' ),
					'twRTMe'       => esc_html__( 'Retweets Of Me', 'theplus' ),
					'Twcustom'     => esc_html__( 'Custom Tweets', 'theplus' ),
				),
				'condition' => array(
					'selectFeed' => 'Twitter',
				),
			)
		);
		$repeater->add_control(
			'Twtimeline',
			array(
				'label'     => esc_html__( 'Timeline Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'Hometimline',
				'options'   => array(
					'Hometimline'      => esc_html__( 'Home Timeline', 'theplus' ),
					'mentionstimeline' => esc_html__( 'Mentions Timeline', 'theplus' ),
				),
				'condition' => array(
					'selectFeed' => 'Twitter',
					'TwfeedType' => 'wptimline',
				),
			)
		);
		$repeater->add_control(
			'TwSearch',
			array(
				'label'       => esc_html__( 'Search', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Value', 'theplus' ),
				'condition'   => array(
					'selectFeed' => 'Twitter',
					'TwfeedType' => 'twsearch',
				),
			)
		);
		$repeater->add_control(
			'TwRtype',
			array(
				'label'     => esc_html__( 'Result Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'recent',
				'options'   => array(
					'mixed'   => esc_html__( 'Mixed', 'theplus' ),
					'recent'  => esc_html__( 'Recent', 'theplus' ),
					'popular' => esc_html__( 'Popular', 'theplus' ),
				),
				'condition' => array(
					'selectFeed' => 'Twitter',
					'TwfeedType' => 'twsearch',
				),
			)
		);
		$repeater->add_control(
			'TwWOEID',
			array(
				'label'       => esc_html__( 'WOEID Code', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter WOEID Code', 'theplus' ),
				'condition'   => array(
					'selectFeed' => 'Twitter',
					'TwfeedType' => 'twtrends',
				),
			)
		);
		$repeater->add_control(
			'TwWOEID_link',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => 'Note : How to Get <a href="https://www.findmecity.com/"  target="_blank" rel="noopener noreferrer">(WOEID Code)</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'selectFeed' => 'Twitter',
					'TwfeedType' => 'twtrends',
				),
			)
		);
		$repeater->add_control(
			'TwcustId',
			array(
				'label'       => esc_html__( 'Tweet ID (Separated By Comma)', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => '',
				'placeholder' => esc_html__( 'e.g. Tweet ID 1, Tweet ID 2', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'selectFeed' => 'Twitter',
					'TwfeedType' => 'Twcustom',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'TwUsername',
			array(
				'label'       => esc_html__( 'Username', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Username', 'theplus' ),
				'condition'   => array(
					'selectFeed' => 'Twitter',
				),
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'TwfeedType',
							'operator' => 'in',
							'value'    => array( 'userlikes', 'userfeed' ),
						),
						array(
							'name'     => 'TwfeedType',
							'operator' => '==',
							'value'    => 'wptimline',
							'name'     => 'Twtimeline',
							'operator' => '==',
							'value'    => 'Hometimline',
						),
					),
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'Twlistsid',
			array(
				'label'       => esc_html__( 'Lists ID', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter List ID', 'theplus' ),
				'condition'   => array(
					'selectFeed' => 'Twitter',
					'TwfeedType' => 'userlist',
				),
			)
		);
		$repeater->add_control(
			'Twcollsid',
			array(
				'label'       => esc_html__( 'Collection ID', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Collection ID', 'theplus' ),
				'condition'   => array(
					'selectFeed' => 'Twitter',
					'TwfeedType' => 'twcollection',
				),
			)
		);
		$repeater->add_control(
			'TwDmedia',
			array(
				'label'     => esc_html__( 'Show Media', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'selectFeed'  => 'Twitter',
					'TwfeedType!' => 'twtrends',
				),
			)
		);
		$repeater->add_control(
			'TwRetweet',
			array(
				'label'     => esc_html__( 'Show Retweet', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'selectFeed'  => 'Twitter',
					'TwfeedType!' => 'twsearch',
				),
			)
		);
		$repeater->add_control(
			'TwComRep',
			array(
				'label'      => esc_html__( 'Show Comment Replies', 'theplus' ),
				'type'       => Controls_Manager::SWITCHER,
				'label_on'   => esc_html__( 'Enable', 'theplus' ),
				'label_off'  => esc_html__( 'Disable', 'theplus' ),
				'default'    => 'no',
				'condition'  => array(
					'selectFeed' => 'Twitter',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'TwfeedType',
							'operator' => 'in',
							'value'    => array( 'userfeed' ),
						),
						array(
							'name'     => 'TwfeedType',
							'operator' => '==',
							'value'    => 'wptimline',
							'name'     => 'Twtimeline',
							'operator' => '==',
							'value'    => 'Hometimline',
						),
					),
				),
			)
		);
		$repeater->add_control(
			'VimeoType',
			array(
				'label'     => esc_html__( 'Vimeo Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'Vm_Channel',
				'options'   => array(
					'Vm_User'       => esc_html__( 'User Video', 'theplus' ),
					'Vm_search'     => esc_html__( 'Search Video', 'theplus' ),
					'Vm_liked'      => esc_html__( 'Liked Video', 'theplus' ),
					'Vm_Channel'    => esc_html__( 'Channel Video', 'theplus' ),
					'Vm_Group'      => esc_html__( 'Group Video', 'theplus' ),
					'Vm_Album'      => esc_html__( 'Album (Showcases) Video', 'theplus' ),
					'Vm_categories' => esc_html__( 'Categories Video', 'theplus' ),
				),
				'condition' => array(
					'selectFeed' => 'Vimeo',
				),
			)
		);
		$repeater->add_control(
			'VmUname',
			array(
				'label'       => esc_html__( 'Username', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Username', 'theplus' ),
				'label_block' => false,
				'condition'   => array(
					'selectFeed' => 'Vimeo',
					'VimeoType'  => array( 'Vm_User', 'Vm_liked', 'Vm_Album' ),
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'VmQsearch',
			array(
				'label'       => esc_html__( 'Search', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Value', 'theplus' ),
				'label_block' => false,
				'condition'   => array(
					'selectFeed' => 'Vimeo',
					'VimeoType'  => 'Vm_search',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'VmChannel',
			array(
				'label'       => esc_html__( 'Channel Name', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Channel Name', 'theplus' ),
				'label_block' => false,
				'condition'   => array(
					'selectFeed' => 'Vimeo',
					'VimeoType'  => 'Vm_Channel',
				),
				'ai' => [
					'active' => false,
				],
			)
		);
		$repeater->add_control(
			'VmGroup',
			array(
				'label'       => esc_html__( 'Group Name', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Group Name', 'theplus' ),
				'label_block' => false,
				'condition'   => array(
					'selectFeed' => 'Vimeo',
					'VimeoType'  => 'Vm_Group',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'VmAlbum',
			array(
				'label'       => esc_html__( 'Album ID', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Album ID', 'theplus' ),
				'label_block' => false,
				'condition'   => array(
					'selectFeed' => 'Vimeo',
					'VimeoType'  => 'Vm_Album',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'VmAlbumPass',
			array(
				'label'       => esc_html__( 'Password', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Password', 'theplus' ),
				'label_block' => false,
				'condition'   => array(
					'selectFeed' => 'Vimeo',
					'VimeoType'  => 'Vm_Album',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'VmCategories',
			array(
				'label'       => esc_html__( 'Categories', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Categories', 'theplus' ),
				'label_block' => false,
				'condition'   => array(
					'selectFeed' => 'Vimeo',
					'VimeoType'  => 'Vm_categories',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'RYtType',
			array(
				'label'     => esc_html__( 'YouTube Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'YT_Channel',
				'options'   => array(
					'YT_Userfeed' => esc_html__( 'User feed','theplus' ),
					'YT_Handle' => esc_html__( 'Handle', 'theplus' ),
					'YT_Channel'  => esc_html__( 'Channel', 'theplus' ),
					'YT_Playlist' => esc_html__( 'Playlist', 'theplus' ),
					'YT_Search'   => esc_html__( 'Search', 'theplus' ),
				),
				'condition' => array(
					'selectFeed' => 'Youtube',
				),
			)
		);
		$repeater->add_control(
			'YtName',
			[
				'label' => esc_html__( 'Username', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__( 'Enter Username', 'theplus' ),	
				'label_block' => false,
				'ai' => [
					'active' => false,
				],
				'condition' => [
					'selectFeed' => 'Youtube',
					'RYtType' => 'YT_Userfeed',
				],
			]
		);
		$repeater->add_control(
			'yt_handle',
			array(
				'label'       => esc_html__( 'Handle Name', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( '@posimyth', 'theplus' ),
				'label_block' => false,
				'ai' => [
					'active' => false,
				],
				'condition'   => array(
					'selectFeed' => 'Youtube',
					'RYtType'    => 'YT_Handle',
				),
			)
		);
		$repeater->add_control(
			'YTChannel',
			array(
				'label'       => esc_html__( 'Channel ID', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Channel ID', 'theplus' ),
				'label_block' => false,
				'condition'   => array(
					'selectFeed' => 'Youtube',
					'RYtType'    => 'YT_Channel',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'YTPlaylist',
			array(
				'label'       => esc_html__( 'Playlist ID', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Playlist ID', 'theplus' ),
				'label_block' => false,
				'condition'   => array(
					'selectFeed' => 'Youtube',
					'RYtType'    => 'YT_Playlist',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'YTsearchQ',
			array(
				'label'       => esc_html__( 'Search Query', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Value', 'theplus' ),
				'label_block' => false,
				'condition'   => array(
					'selectFeed' => 'Youtube',
					'RYtType'    => 'YT_Search',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'YTvOrder',
			array(
				'label'     => esc_html__( 'Video Order', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'date',
				'options'   => array(
					'date'       => esc_html__( 'Date', 'theplus' ),
					'Title'      => esc_html__( 'Title', 'theplus' ),
					'rating'     => esc_html__( 'Rating', 'theplus' ),
					'relevance'  => esc_html__( 'Relevance', 'theplus' ),
					'viewCount'  => esc_html__( 'ViewCount', 'theplus' ),
					'videoCount' => esc_html__( 'VideoCount', 'theplus' ),
				),
				'condition' => array(
					'selectFeed' => 'Youtube',
					'RYtType'    => array( 'YT_Userfeed', 'YT_Channel' ),
				),
			)
		);
		$repeater->add_control(
			'YTthumbnail',
			array(
				'label'     => esc_html__( 'Thumbnail Size', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'medium',
				'options'   => array(
					'default'  => esc_html__( 'Thumbnail', 'theplus' ),
					'medium'   => esc_html__( 'Medium', 'theplus' ),
					'high'     => esc_html__( 'High', 'theplus' ),
					'standard' => esc_html__( 'Standard', 'theplus' ),
					'maxres'   => esc_html__( 'Max Resolution', 'theplus' ),
				),
				'condition' => array(
					'selectFeed' => 'Youtube',
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
				'ai' => [
					'active' => false,
				],
			)
		);
		$repeater->add_control(
			'MaxR',
			array(
				'label'   => esc_html__( 'Max Results', 'theplus' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
				'default' => 6,
			)
		);
		$this->add_control(
			'AllReapeter',
			array(
				'label'       => esc_html__( 'Social Feeds', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'selectFeed' => 'Facebook',
						'TwfeedType' => 'userfeed',
						'Twtimeline' => 'Hometimline',
						'VimeoType'  => 'Vm_Channel',
						'RYtType'    => 'YT_Channel',
						'MaxR'       => 6,
					),
				),
				'separator'   => 'before',
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ selectFeed }}}',
			)
		);
		$this->end_controls_section();

		// Social feed Start.
		$this->start_controls_section(
			'social_feed_section',
			array(
				'label' => esc_html__( 'Social Feed Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'TotalPost',
			array(
				'label'   => esc_html__( 'Maximum Posts', 'theplus' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 2000,
				'step'    => 1,
				'default' => 1000,
			)
		);
		$this->add_control(
			'DescripBTM',
			array(
				'label'     => esc_html__( 'Description Bottom', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);
		$this->add_control(
			'MediaFilter',
			array(
				'label'   => esc_html__( 'Media Filter', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default'   => esc_html__( 'Default', 'theplus' ),
					'ompost'    => esc_html__( 'Only Media Posts', 'theplus' ),
					'hmcontent' => esc_html__( 'Hide Media Posts', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'ShowTitle',
			array(
				'label'     => esc_html__( 'Show Title', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => '',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'ShowTitleNote',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => 'Note: It Will Work in Youtube, Vimeo and Instagram(Mention)',
				'content_classes' => 'tp-widget-description',
			)
		);
		$this->add_control(
			'ShowFeedId',
			array(
				'label'     => esc_html__( 'Display Id & Exclude', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
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
			'ExcldPIdsNote',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => 'Note: By Enabling This Option, You Will See The Post Id Of Each In The Back-end, And Then You Can Use Those To Exclude Posts You Want To.',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'ShowFeedId' => 'yes',
				),
			)
		);
		$this->add_control(
			'showFooterIn',
			array(
				'label'     => esc_html__( 'Emotions Titles', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);
		$this->end_controls_section();
		/*
		social feed end*/
		/*columns start*/
		$this->start_controls_section(
			'columns_manage_section',
			array(
				'label'     => esc_html__( 'Columns Manage', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'layout!' => 'carousel',
				),
			)
		);
		$this->add_control(
			'desktop_column',
			array(
				'label'     => esc_html__( 'Desktop', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => theplus_get_columns_list(),
				'condition' => array(
					'layout!' => 'carousel',
				),
			)
		);
		$this->add_control(
			'tablet_column',
			array(
				'label'     => esc_html__( 'Tablet', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '4',
				'options'   => theplus_get_columns_list(),
				'condition' => array(
					'layout!' => 'carousel',
				),
			)
		);
		$this->add_control(
			'mobile_column',
			array(
				'label'     => esc_html__( 'Mobile', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '6',
				'options'   => theplus_get_columns_list(),
				'condition' => array(
					'layout!' => 'carousel',
				),
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
				'condition'  => array(
					'layout!' => 'carousel',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .post-inner-loop .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
		/*
		columns end*/
		/*Filters Option Start*/
		$this->start_controls_section(
			'filters_optn_section',
			array(
				'label'     => esc_html__( 'Filter Option', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'layout!' => 'carousel',
				),
			)
		);
		$this->add_control(
			'filter_category',
			array(
				'label'     => esc_html__( 'Category Wise Filter', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'layout!' => 'carousel',
				),
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
					'layout!'         => 'carousel',
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
					'layout!'         => 'carousel',
				),
			)
		);
		$this->add_control(
			'filter_category_align',
			array(
				'label'       => esc_html__( 'Filter Alignment', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
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
				'default'     => 'center',
				'toggle'      => true,
				'label_block' => false,
				'condition'   => array(
					'filter_category' => 'yes',
					'layout!'         => 'carousel',
				),
			)
		);
		$this->end_controls_section();
		/*Filters Option End*/

		/*Load More/Lazy Load Option start*/
		$this->start_controls_section(
			'loadmore_lazyload_section',
			array(
				'label'     => esc_html__( 'Load More/Lazy Load Option', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'layout!' => 'carousel',
				),
			)
		);
			$this->add_control(
				'post_extra_option',
				array(
					'label'     => esc_html__( 'More Post Loading Options', 'theplus' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'none',
					'options'   => array(
						'none'      => esc_html__( 'Select Options', 'theplus' ),
						'load_more' => esc_html__( 'Load More', 'theplus' ),
						'lazy_load' => esc_html__( 'Lazy Load', 'theplus' ),
					),
					'condition' => array(
						'layout!' => array( 'carousel' ),
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
					'condition' => array(
						'layout!'           => array( 'carousel' ),
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
						'layout!'           => array( 'carousel' ),
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
						'layout!'           => array( 'carousel' ),
						'post_extra_option' => 'load_more',
					),
					'ai' => array(
						'active' => false,
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
						'layout!'           => array( 'carousel' ),
						'post_extra_option' => array( 'load_more', 'lazy_load' ),
					),
					'ai' => array(
						'active' => false,
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
						'layout!'           => array( 'carousel' ),
						'post_extra_option' => array( 'load_more', 'lazy_load' ),
					),
					'ai' => array(
						'active' => false,
					),
				)
			);

		$this->end_controls_section();
		/*Load More/Lazy Load Option end*/

		/*Extra options*/
		$this->start_controls_section(
			'extra_options_section',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
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
			'TimFreqNote',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => 'Note: It Will Send API Requests To Social Media For Feed Refresh Based On Your Selected Value Above.',
				'content_classes' => 'tp-widget-description',
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
				'ai' => array(
					'active' => false,
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
				'ai' => array(
					'active' => false,
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
				'default'   => 'no',
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
						'max'  => 2000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 150,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'ScrollOn' => 'yes',
				),
			)
		);
		$this->add_control(
			'FcySclOn',
			array(
				'label'     => esc_html__( 'Fancybox Scrolling Bar', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'FcySclHgt',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 2000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 150,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'FcySclOn' => 'yes',
				),
			)
		);
		$this->add_control(
			'OnPopup',
			array(
				'label'     => esc_html__( 'On Post Click', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'OnFancyBox',
				'options'   => array(
					'Donothing'  => esc_html__( 'Do Nothing', 'theplus' ),
					'GoWebsite'  => esc_html__( 'Go To Website', 'theplus' ),
					'OnFancyBox' => esc_html__( 'Open Fancy Box', 'theplus' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'CURLOPT_SSL_VERIFYPEER',
			array(
				'label'     => esc_html__( 'Curl SSL Verify Peer', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->end_controls_section();
		/* Extra options end*/

		/*Performance Start*/
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
				'raw'             => '<span>Delete All Transient </span><a class="tp-feed-delete-transient" id="tp-feed-delete-transient" > Delete </a>',
				'content_classes' => 'tp-feed-delete-transient-btn',
				'label_block'     => true,
			)
		);
		$this->end_controls_section();
		/*Performance End*/

		/*All Content Style Start*/
		$this->start_controls_section(
			'section_alcontnt_styling',
			array(
				'label' => esc_html__( 'Universal', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'AllMsgTp',
				'label'     => esc_html__( 'Extra Title Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-title',
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'AllDesTp',
				'label'    => esc_html__( 'Description Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-message',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'AllNameTp',
				'label'    => esc_html__( 'Name Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-sf-username a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'AllTimeTp',
				'label'     => esc_html__( 'Time Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-sf-time a',
				'separator' => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'AllFooterTp',
				'label'     => esc_html__( 'Footer Area Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-sf-footer',
				'separator' => 'after',
			)
		);
		$this->start_controls_tabs( 'sfd_alcontnt_clr_tabs' );
		$this->start_controls_tab(
			'sfd_alcontnt_clr_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'AllNTitleC',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_control(
			'AllNDesC',
			array(
				'label'     => esc_html__( 'Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-message' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'AllNNameC',
			array(
				'label'     => esc_html__( 'Name Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-sf-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'AllNTimeC',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-sf-time a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'AllNIconCr',
			array(
				'label'     => esc_html__( 'Icon Footer Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-sf-footer,{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-sf-footer a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'AllNurlC',
			array(
				'label'     => esc_html__( 'URL Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-feedurl' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'AllNMtC',
			array(
				'label'     => esc_html__( '@Mention Tag Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-mantion' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'AllNHtC',
			array(
				'label'     => esc_html__( '#Hashtag Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-hashtag' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'sfd_alcontnt_clr_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'AllHTitleC',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed:hover .tp-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_control(
			'AllHDesC',
			array(
				'label'     => esc_html__( 'Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed:hover .tp-message' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'ALLHNameC',
			array(
				'label'     => esc_html__( 'Name Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed:hover .tp-sf-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'AllHTimeC',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed:hover .tp-sf-time a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'AllHIconCr',
			array(
				'label'     => esc_html__( 'Icon Footer Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed:hover .tp-sf-footer,{{WRAPPER}} .tp-social-feed .tp-sf-feed:hover .tp-sf-footer a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'AllHurlC',
			array(
				'label'     => esc_html__( 'URL Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-message:hover .tp-feedurl' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'AllHMtC',
			array(
				'label'     => esc_html__( 'Mention Tag Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-message:hover .tp-mantion' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'AllHHtC',
			array(
				'label'     => esc_html__( '#Hashtag Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .tp-message:hover .tp-hashtag' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'SocIconSize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-feed .social-logo-fb,
					{{WRAPPER}} .tp-social-feed .social-logo-yt,
					{{WRAPPER}} .tp-social-feed .social-logo-tw' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'SocIconColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .social-logo-fb,
					{{WRAPPER}} .tp-social-feed .social-logo-yt,
					{{WRAPPER}} .tp-social-feed .social-logo-tw' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'PostArea',
			array(
				'label'     => esc_html__( 'Post Thumbnail Area', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'AllImg',
			array(
				'label'      => esc_html__( 'Post Thumbnail Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-soc-img-cls' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'AllImgBR',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed img.tp-post-thumb',
			)
		);
		$this->add_responsive_control(
			'AllImgbr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed img.tp-post-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'AllImgBoxSh',
				'selector' => '{{WRAPPER}} .tp-social-feed img.tp-post-thumb',
			)
		);
		$this->add_responsive_control(
			'AllTitle',
			array(
				'label'      => esc_html__( 'Title Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'ShowTitle' => 'yes',
				),
				'separator'  => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'AllTitleBR',
				'label'     => esc_html__( 'Title Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-title',
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_control(
			'DescriptionArea',
			array(
				'label'     => esc_html__( 'Description Area', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'Alldescription',
			array(
				'label'      => esc_html__( 'Description Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'AllDesBR',
				'label'    => esc_html__( 'Description Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-message',
			)
		);
		$this->add_control(
			'ProfileArea',
			array(
				'label'     => esc_html__( 'Profile Area', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'AllProfile',
			array(
				'label'      => esc_html__( 'Profile Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-sf-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'AllProfBR',
				'label'    => esc_html__( 'Profile Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-sf-header',
			)
		);
		$this->add_responsive_control(
			'AllPRs',
			array(
				'label'      => esc_html__( 'Profile Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed img.tp-sf-logo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'AllBoxSh',
				'selector' => '{{WRAPPER}} .tp-social-feed .tp-sf-feed img.tp-sf-logo',
			)
		);
		$this->add_control(
			'FooterArea',
			array(
				'label'     => esc_html__( 'Footer Area', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'AllFooter',
			array(
				'label'      => esc_html__( 'Footer Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-sf-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'AllbtmBR',
				'label'    => esc_html__( 'Footer Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .tp-sf-feed .tp-sf-footer',
			)
		);
		$this->add_control(
			'UniVBgin_opt',
			array(
				'label'     => esc_html__( 'Box Inner Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'style' => array( 'style-3', 'style-4' ),
				),
			)
		);
		$this->add_responsive_control(
			'inAllboxpadd',
			array(
				'label'      => esc_html__( 'Box Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-contant' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style' => array( 'style-3', 'style-4' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'inAllNBgCr',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-social-feed .tp-sf-contant',
				'condition' => array(
					'style' => array( 'style-3', 'style-4' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'inAllNBcr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-social-feed .tp-sf-contant',
				'condition' => array(
					'style' => array( 'style-3', 'style-4' ),
				),
			)
		);
		$this->add_responsive_control(
			'inAllNBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-contant' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style' => array( 'style-3', 'style-4' ),
				),
			)
		);
		$this->add_control(
			'UniVBg_opt',
			array(
				'label'     => esc_html__( 'Box Background Options', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'sfd_alcontnt_tabs' );
		$this->start_controls_tab(
			'sfd_alcontnt_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_responsive_control(
			'Allboxpadd',
			array(
				'label'      => esc_html__( 'Box Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'AllNBgCr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .tp-sf-feed',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'AllNBcr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .tp-sf-feed',
			)
		);
		$this->add_responsive_control(
			'AllNBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'AllNBs',
				'selector' => '{{WRAPPER}} .tp-social-feed .tp-sf-feed',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'sfd_alcontnt_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_responsive_control(
			'AllHboxpadd',
			array(
				'label'      => esc_html__( 'Box Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'AllHBgCr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .tp-sf-feed:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'AllHBcr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .tp-sf-feed:hover',
			)
		);
		$this->add_responsive_control(
			'AllHBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .tp-sf-feed:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'AllHBs',
				'selector' => '{{WRAPPER}} .tp-social-feed .tp-sf-feed:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*
		All Content Style End*/
		/*FancyBox Option Style Start*/
		$this->start_controls_section(
			'section_Fncbox_optn_styling',
			array(
				'label' => esc_html__( 'FancyBox', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'FancyStyle',
			array(
				'label'   => esc_html__( 'FancyBox Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default' => esc_html__( 'Default', 'theplus' ),
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
				),
			)
		);
		$this->start_controls_tabs( 'sfd_Fncbox_optn_tabs' );
		$this->start_controls_tab(
			'sfd_Fncbox_optn_n',
			array(
				'label' => esc_html__( 'Option', 'theplus' ),
			)
		);
		$this->add_control(
			'FancyOption',
			array(
				'label'    => esc_html__( 'Features', 'theplus' ),
				'type'     => Controls_Manager::SELECT2,
				'multiple' => true,
				'options'  => array(
					'slideShow'  => esc_html__( 'SlideShow', 'theplus' ),
					'share'      => esc_html__( 'Share', 'theplus' ),
					'zoom'       => esc_html__( 'Zoom', 'theplus' ),
					'thumbs'     => esc_html__( 'Thumbs', 'theplus' ),
					'fullScreen' => esc_html__( 'FullScreen', 'theplus' ),
					'download'   => esc_html__( 'Download', 'theplus' ),
					'close'      => esc_html__( 'Close', 'theplus' ),
				),
				'default'  => array( 'fullScreen', 'close' ),
			)
		);
		$this->add_control(
			'LoopFancy',
			array(
				'label'     => esc_html__( 'Loop', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'infobar',
			array(
				'label'     => esc_html__( 'Image Counter', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'ArrowsFancy',
			array(
				'label'     => esc_html__( 'Show Arrows', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'TransitionFancy',
			array(
				'label'   => esc_html__( 'Transition Effect', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => array(
					'false'       => esc_html__( 'None', 'theplus' ),
					'tube'        => esc_html__( 'Tube', 'theplus' ),
					'fade'        => esc_html__( 'Fade', 'theplus' ),
					'slide'       => esc_html__( 'Slide', 'theplus' ),
					'rotate'      => esc_html__( 'Rotate', 'theplus' ),
					'circular'    => esc_html__( 'Circular', 'theplus' ),
					'zoom-in-out' => esc_html__( 'Zoom-in-out', 'theplus' ),
				),
			)
		);
		$this->add_responsive_control(
			'TranDuration',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Transition Duration ( ms )', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 366,
				),
				'render_type' => 'ui',
			)
		);
		$this->add_control(
			'AnimationFancy',
			array(
				'label'   => esc_html__( 'Animation Effect', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'zoom',
				'options' => array(
					'false'       => esc_html__( 'None', 'theplus' ),
					'zoom'        => esc_html__( 'Zoom', 'theplus' ),
					'fade'        => esc_html__( 'Fade', 'theplus' ),
					'zoom-in-out' => esc_html__( 'Zoom-in-out', 'theplus' ),
				),
			)
		);
		$this->add_responsive_control(
			'DurationFancy',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Animation Duration ( ms )', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 366,
				),
				'render_type' => 'ui',
			)
		);
		$this->add_control(
			'ClickContent',
			array(
				'label'   => esc_html__( 'Content Click', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'next',
				'options' => array(
					'false' => esc_html__( 'None', 'theplus' ),
					'next'  => esc_html__( 'Next', 'theplus' ),
					'zoom'  => esc_html__( 'Zoom', 'theplus' ),
					'close' => esc_html__( 'Close', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'Slideclick',
			array(
				'label'   => esc_html__( 'Outer Click', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'close',
				'options' => array(
					'false' => esc_html__( 'None', 'theplus' ),
					'next'  => esc_html__( 'Next', 'theplus' ),
					'zoom'  => esc_html__( 'Zoom', 'theplus' ),
					'close' => esc_html__( 'Close', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'ThumbsOption',
			array(
				'label'     => esc_html__( 'Thumbs Option', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'ThumbsOptionNote',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => 'Note : Make sure It"s selected from Features',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'ThumbsOption' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'ThumbsBrCr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '.fancybox-thumbs__list a.fancybox-thumbs-active:before,.fancybox-thumbs__list a:before',
				'condition' => array(
					'ThumbsOption' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'ThumbsBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '.fancybox-thumbs .fancybox-thumbs__list',
				'condition' => array(
					'ThumbsOption' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'sfd_Fncbox_optn_h',
			array(
				'label' => esc_html__( 'Style', 'theplus' ),
			)
		);
		$this->add_control(
			'Fancy_out_Bg',
			array(
				'label'     => esc_html__( 'Outer Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'FancyBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.fancybox-container .fancybox-bg',
			)
		);
		$this->add_control(
			'Fancy_Outer_filter',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'Fancy_Outer_filter_blur',
			array(
				'label'      => esc_html__( 'Blur', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 100,
						'min'  => 1,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'Fancy_Outer_filter' => 'yes',
				),
			)
		);
		$this->add_control(
			'Fancy_Outer_filter_grayscale',
			array(
				'label'      => esc_html__( 'Grayscale', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'.fancybox-container' => '-webkit-backdrop-filter:grayscale({{Fancy_Outer_filter_grayscale.SIZE}})  blur({{Fancy_Outer_filter_blur.SIZE}}{{Fancy_Outer_filter_blur.UNIT}}) !important;backdrop-filter:grayscale({{Fancy_Outer_filter_grayscale.SIZE}})  blur({{Fancy_Outer_filter_blur.SIZE}}{{Fancy_Outer_filter_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'Fancy_Outer_filter' => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->add_control(
			'Fancy_inn_Bg',
			array(
				'label'     => esc_html__( 'Inner Background Options', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'FancyInBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '.fancybox-si,.fancybox-si.fancy-style-1,.fancybox-si.fancy-style-2',
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'FancyInBgB',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '.fancybox-si',
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_responsive_control(
			'FancyInBgBs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.fancybox-si' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'FancyInBoxSw',
				'selector'  => '.fancybox-si',
				'separator' => 'after',
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'FancyName',
				'label'     => esc_html__( 'Name Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '.fancybox-si .tp-fcb-username a',
				'separator' => 'before',
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'FancyTime',
				'label'     => esc_html__( 'Time Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '.fancybox-si .tp-fcb-time a',
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'FancyTitle',
				'label'     => esc_html__( 'Title Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '.fancybox-si .tp-fcb-title',
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'FancyDes',
				'label'     => esc_html__( 'Description Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '.fancybox-si .tp-message',
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_control(
			'FancyNameCr',
			array(
				'label'     => esc_html__( 'Name Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.fancybox-si .tp-fcb-username a' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'FancyTimeCr',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.fancybox-si .tp-fcb-time a' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_control(
			'FancytitleCr',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.fancybox-si .tp-fcb-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
					'ShowTitle'  => 'yes',
				),
			)
		);
		$this->add_control(
			'FancyDesCr',
			array(
				'label'     => esc_html__( 'Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.fancybox-si .tp-message' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_control(
			'FancyiconCr',
			array(
				'label'     => esc_html__( 'Footer Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.fancybox-si .tp-sf-footer span' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_control(
			'FancpaginateCr',
			array(
				'label'     => esc_html__( 'Paginate Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.fancybox-infobar' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_control(
			'FancySICr',
			array(
				'label'     => esc_html__( 'Social Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.fancybox-si .social-logo-fb,.fancybox-si .social-logo-tw,.fancybox-si .social-logo-yt' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'FancySIs',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Social Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
				'selectors'   => array(
					'.fancybox-si .social-logo-fb,.fancybox-si .social-logo-tw,.fancybox-si .social-logo-yt' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'Fancy_btn_opt',
			array(
				'label'     => esc_html__( 'Button Options', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'FancyBtnCr',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '.fancybox-si .tp-fcb-footer .tp-btn-viewpost',
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_control(
			'FancyBtnTxtCr',
			array(
				'label'     => esc_html__( 'Button Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.fancybox-si .tp-fcb-footer .tp-btn-viewpost a' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'FancyBtnBr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '.fancybox-si .tp-fcb-footer .tp-btn-viewpost',
				'separator' => 'before',
				'condition' => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_responsive_control(
			'FancyBtnpadd',
			array(
				'label'      => esc_html__( 'Box Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'.fancybox-si .tp-fcb-footer .tp-btn-viewpost' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'FancyStyle' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*
		FancyBox Option Style End*/
		/*Show More Text Option Start*/
		$this->start_controls_section(
			'shw_more_opt_styling',
			array(
				'label'     => esc_html__( 'Show More Text', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->add_control(
			'ContentShowMore',
			array(
				'label'     => esc_html__( 'Content Show More', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'TextLimit' => 'yes',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'SmTxtTypo',
				'label'     => esc_html__( 'Show More Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-social-feed .tp-message a.readbtn',
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'shw_more_opt_tabs' );
		$this->start_controls_tab(
			'shw_more_opt_n',
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
						'{{WRAPPER}} .tp-social-feed .tp-message a.readbtn' => 'color: {{VALUE}};',
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
						'{{WRAPPER}} .tp-social-feed .tp-message.show-less a.readbtn' => 'color: {{VALUE}};',
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
						'{{WRAPPER}} .tp-social-feed .tp-message .sf-dots' => 'color: {{VALUE}};',
					),
					'condition' => array(
						'TextLimit' => 'yes',
					),
					'separator' => 'after',
				)
			);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'shw_more_opt_h',
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
						'{{WRAPPER}} .tp-social-feed .tp-message a.readbtn:hover' => 'color: {{VALUE}};',
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
						'{{WRAPPER}} .tp-social-feed .tp-message.show-less a.readbtn:hover' => 'color: {{VALUE}};',
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
						'{{WRAPPER}} .tp-social-feed .tp-message:hover .sf-dots' => 'color: {{VALUE}};',
					),
					'condition' => array(
						'TextLimit' => 'yes',
					),
					'separator' => 'after',
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'FancyShowMore',
			array(
				'label'     => esc_html__( 'Fancybox Show More', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'TextLimit' => 'yes',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'Fy_SmTxtTypo',
				'label'     => esc_html__( 'Show More Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '.fancybox-si .tp-message a.readbtn',
				'condition' => array(
					'style'     => array( 'style-1', 'style-2', 'style-3', 'style-4' ),
					'TextLimit' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'Fy_shw_more_opt_tabs' );
		$this->start_controls_tab(
			'Fy_shw_more_opt_n',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
			$this->add_control(
				'Fy_SmTxtNCr',
				array(
					'label'     => esc_html__( 'Show More', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'.fancybox-si .tp-message a.readbtn' => 'color: {{VALUE}};',
					),
					'condition' => array(
						'TextLimit' => 'yes',
					),
				)
			);
			$this->add_control(
				'Fy_SlTxtNCr',
				array(
					'label'     => esc_html__( 'Show Less', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'.fancybox-si .tp-message.show-text a.readbtn' => 'color:{{VALUE}};',
					),
					'condition' => array(
						'TextLimit' => 'yes',
					),
				)
			);
			$this->add_control(
				'Fy_DotTxtNCr',
				array(
					'label'     => esc_html__( 'Dot Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'.fancybox-si .tp-message .sf-dots' => 'color: {{VALUE}};',
					),
					'condition' => array(
						'style'     => array( 'style-1', 'style-2', 'style-3', 'style-4' ),
						'TextLimit' => 'yes',
					),
					'separator' => 'after',
				)
			);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Fy_shw_more_opt_h',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'TextLimit' => 'yes',
				),
			)
		);
			$this->add_control(
				'Fy_SmTxtHCr',
				array(
					'label'     => esc_html__( 'Show More', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'.fancybox-si .tp-message a.readbtn:hover' => 'color: {{VALUE}};',
					),
					'condition' => array(
						'TextLimit' => 'yes',
					),
				)
			);
			$this->add_control(
				'Fy_SlTxtHCr',
				array(
					'label'     => esc_html__( 'Show Less', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'.fancybox-si .tp-message.show-text a.readbtn:hover' => 'color: {{VALUE}};',
					),
					'condition' => array(
						'TextLimit' => 'yes',
					),
				)
			);
			$this->add_control(
				'Fy_DotTxtHCr',
				array(
					'label'     => esc_html__( 'Dot Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'.fancybox-si .tp-message:hover .sf-dots' => 'color: {{VALUE}};',
					),
					'condition' => array(
						'TextLimit' => 'yes',
					),
					'separator' => 'after',
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Show More Text Option End*/

		/* Scroll Bar Option start*/
		$this->start_controls_section(
			'ScrollBarTab',
			array(
				'label'      => esc_html__( 'Scroll Bar', 'theplus' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'ScrollOn',
									'operator' => '===',
									'value'    => 'yes',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'FcySclOn',
									'operator' => '===',
									'value'    => 'yes',
								),
							),
						),
					),
				),
			)
		);
			$this->add_control(
				'ContentScroll',
				array(
					'label'     => esc_html__( 'Content Scrolling Bar', 'theplus' ),
					'type'      => \Elementor\Controls_Manager::HEADING,
					'condition' => array(
						'ScrollOn' => 'yes',
					),
				)
			);
			$this->start_controls_tabs( 'scrollC_style' );
			$this->start_controls_tab(
				'scrollC_Bar',
				array(
					'label'     => esc_html__( 'Scrollbar', 'theplus' ),
					'condition' => array(
						'ScrollOn' => 'yes',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'ScrollBg',
					'types'     => array( 'classic', 'gradient' ),
					'selector'  => '{{WRAPPER}} .tp-social-feed .tp-normal-scroll::-webkit-scrollbar',
					'condition' => array(
						'ScrollOn' => 'yes',
					),
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
						'{{WRAPPER}} .tp-social-feed .tp-normal-scroll::-webkit-scrollbar' => 'width: {{SIZE}}{{UNIT}};',
					),
					'condition'   => array(
						'ScrollOn' => 'yes',
					),
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'scrollC_Tmb',
				array(
					'label'     => esc_html__( 'Thumb', 'theplus' ),
					'condition' => array(
						'ScrollOn' => 'yes',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'ThumbBg',
					'types'     => array( 'classic', 'gradient' ),
					'selector'  => '{{WRAPPER}} .tp-social-feed .tp-normal-scroll::-webkit-scrollbar-thumb',
					'condition' => array(
						'ScrollOn' => 'yes',
					),
				)
			);
			$this->add_responsive_control(
				'ThumbBrs',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .tp-social-feed .tp-normal-scroll::-webkit-scrollbar-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'condition'  => array(
						'ScrollOn' => 'yes',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'ThumbBsw',
					'selector'  => '{{WRAPPER}} .tp-social-feed .tp-normal-scroll::-webkit-scrollbar-thumb',
					'condition' => array(
						'ScrollOn' => 'yes',
					),
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'scrollC_Trk',
				array(
					'label'     => esc_html__( 'Track', 'theplus' ),
					'condition' => array(
						'ScrollOn' => 'yes',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'TrackBg',
					'types'     => array( 'classic', 'gradient' ),
					'selector'  => '{{WRAPPER}} .tp-social-feed .tp-normal-scroll::-webkit-scrollbar-track',
					'condition' => array(
						'ScrollOn' => 'yes',
					),
				)
			);
			$this->add_responsive_control(
				'TrackBRs',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .tp-social-feed .tp-normal-scroll::-webkit-scrollbar-track' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'condition'  => array(
						'ScrollOn' => 'yes',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'TrackBsw',
					'selector'  => '{{WRAPPER}} .tp-social-feed .tp-normal-scroll::-webkit-scrollbar-track',
					'condition' => array(
						'ScrollOn' => 'yes',
					),
				)
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_control(
				'FancyboxScroll',
				array(
					'label'     => esc_html__( 'Fancybox Scrolling Bar', 'theplus' ),
					'type'      => \Elementor\Controls_Manager::HEADING,
					'condition' => array(
						'FcySclOn' => 'yes',
					),
					'separator' => 'before',
				)
			);
			$this->start_controls_tabs( 'fancyC_style' );
			$this->start_controls_tab(
				'fancyC_Bar',
				array(
					'label'     => esc_html__( 'Scrollbar', 'theplus' ),
					'condition' => array(
						'FcySclOn' => 'yes',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'FcySclBg',
					'types'     => array( 'classic', 'gradient' ),
					'selector'  => '.fancybox-si .tp-fancy-scroll::-webkit-scrollbar',
					'condition' => array(
						'FcySclOn' => 'yes',
					),
				)
			);
			$this->add_responsive_control(
				'FcySclWidth',
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
						'.fancybox-si .tp-fancy-scroll::-webkit-scrollbar' => 'width: {{SIZE}}{{UNIT}};',
					),
					'condition'   => array(
						'FcySclOn' => 'yes',
					),
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'fancyC_Tmb',
				array(
					'label'     => esc_html__( 'Thumb', 'theplus' ),
					'condition' => array(
						'FcySclOn' => 'yes',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'FcyThumbBg',
					'types'     => array( 'classic', 'gradient' ),
					'selector'  => '.fancybox-si .tp-fancy-scroll::-webkit-scrollbar-thumb',
					'condition' => array(
						'FcySclOn' => 'yes',
					),
				)
			);
			$this->add_responsive_control(
				'FcyThumbBrs',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'.fancybox-si .tp-fancy-scroll::-webkit-scrollbar-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'condition'  => array(
						'FcySclOn' => 'yes',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'FcyThumbBsw',
					'selector'  => '.fancybox-si .tp-fancy-scroll::-webkit-scrollbar-thumb',
					'condition' => array(
						'FcySclOn' => 'yes',
					),
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'fancyC_Trk',
				array(
					'label'     => esc_html__( 'Track', 'theplus' ),
					'condition' => array(
						'FcySclOn' => 'yes',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'FcyTrackBg',
					'types'     => array( 'classic', 'gradient' ),
					'selector'  => '.fancybox-si .tp-fancy-scroll::-webkit-scrollbar-track',
					'condition' => array(
						'FcySclOn' => 'yes',
					),
				)
			);
			$this->add_responsive_control(
				'FcyTrackBRs',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'.fancybox-si .tp-fancy-scroll::-webkit-scrollbar-track' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'condition'  => array(
						'FcySclOn' => 'yes',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'FcyTrackBsw',
					'selector'  => '.fancybox-si .tp-fancy-scroll::-webkit-scrollbar-track',
					'condition' => array(
						'FcySclOn' => 'yes',
					),
				)
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/* Scroll Bar Option End */

		/*Load More/Lazy Load style Start*/
		$this->start_controls_section(
			'LoadMoreStyle',
			array(
				'label'     => esc_html__( 'Load More Style', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout!'            => 'carousel',
					'post_extra_option!' => 'none',
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
						'layout!'           => array( 'carousel' ),
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
						'layout!'           => array( 'carousel' ),
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
						'layout!'           => array( 'carousel' ),
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
						'layout!'           => array( 'carousel' ),
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
						'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
							'layout!'           => array( 'carousel' ),
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
						'layout!'           => array( 'carousel' ),
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
						'layout!'           => array( 'carousel' ),
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
						'layout!'           => array( 'carousel' ),
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
						'layout!'           => array( 'carousel' ),
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
						'layout!'           => array( 'carousel' ),
						'post_extra_option' => 'load_more',
					),
				)
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*Load More/Lazy Load style End*/

		/*Carousel Option Start*/
		$this->start_controls_section(
			'section_carousel_options_styling',
			array(
				'label'     => esc_html__( 'Carousel', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
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
					'slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6' ),
					'slider_arrows'       => 'yes',
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
					'slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6' ),
					'slider_arrows'       => 'yes',
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
			'tablet_slider_dots_style',
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
					'tablet_slider_dots' => array( 'yes' ),
					'slider_responsive_tablet' => 'yes'
				),
			)
		);
		$this->add_control(
			'tablet_dots_border_color',
			array(
				'label'     => esc_html__( 'Dots Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					$this->slick_tablet . '.slick-dots.style-1 li button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-6 li button' => '-webkit-box-shadow:inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					$this->slick_tablet . '.slick-dots.style-1 li.slick-active button' => '-webkit-box-shadow:inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					$this->slick_tablet . '.slick-dots.style-2 li button' => 'border-color:{{VALUE}};',
					$this->slick_tablet . 'ul.slick-dots.style-3 li button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					$this->slick_tablet . '.slick-dots.style-3 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					$this->slick_tablet . 'ul.slick-dots.style-4 li button' => '-webkit-box-shadow: inset 0 0 0 0px {{VALUE}};-moz-box-shadow: inset 0 0 0 0px {{VALUE}};box-shadow: inset 0 0 0 0px {{VALUE}};',
					$this->slick_tablet . '.slick-dots.style-1 li button:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_dots_style' => array( 'style-1', 'style-2', 'style-3', 'style-5' ),
					'tablet_slider_dots'       => 'yes',
					'slider_responsive_tablet' => 'yes'
				),
			)
		);
		$this->add_control(
			'tablet_dots_bg_color',
			array(
				'label'     => esc_html__( 'Dots Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					$this->slick_tablet . '.slick-dots.style-2 li button, ' . $this->slick_tablet . ' ul.slick-dots.style-3 li button, ' . $this->slick_tablet . ' .slick-dots.style-4 li button:before, ' . $this->slick_tablet . ' .slick-dots.style-5 button, ' . $this->slick_tablet . ' .slick-dots.style-7 button' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_dots_style' => array( 'style-2', 'style-3', 'style-4', 'style-5', 'style-7' ),
					'tablet_slider_dots'       => 'yes',
					'slider_responsive_tablet' => 'yes'
				),
			)
		);
		$this->add_control(
			'tablet_dots_active_border_color',
			array(
				'label'     => esc_html__( 'Dots Active Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					$this->slick_tablet . '.slick-dots.style-2 li::after' => 'border-color: {{VALUE}};',
					$this->slick_tablet . '.slick-dots.style-4 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					$this->slick_tablet . '.slick-dots.style-6 .slick-active button:after' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_dots_style' => array( 'style-2', 'style-4', 'style-6' ),
					'tablet_slider_dots'       => 'yes',
					'slider_responsive_tablet' => 'yes'
				),
			)
		);
		$this->add_control(
			'tablet_dots_active_bg_color',
			array(
				'label'     => esc_html__( 'Dots Active Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					$this->slick_tablet . '.slick-dots.style-2 li::after,' . $this->slick_tablet . '.slick-dots.style-4 li.slick-active button:before,' . $this->slick_tablet . '.slick-dots.style-5 .slick-active button,' . $this->slick_tablet . '.slick-dots.style-7 .slick-active button' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_dots_style' => array( 'style-2', 'style-4', 'style-5', 'style-7' ),
					'tablet_slider_dots'       => 'yes',
					'slider_responsive_tablet' => 'yes'
				),
			)
		);
		$this->add_control(
			'tablet_dots_top_padding',
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
					$this->slick_tablet . '.slick-slider.slick-dotted' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'tablet_slider_dots' => 'yes',
					'slider_responsive_tablet' => 'yes'
				),
			)
		);
		$this->add_control(
			'tablet_hover_show_dots',
			array(
				'label'     => esc_html__( 'On Hover Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'tablet_slider_dots' => 'yes',
					'slider_responsive_tablet' => 'yes'
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
			'tablet_slider_arrows_style',
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
					'tablet_slider_arrows' => array( 'yes' ),
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_arrows_position',
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
					'tablet_slider_arrows'       => array( 'yes' ),
					'tablet_slider_arrows_style' => array( 'style-3', 'style-4' ),
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_arrow_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					$this->slick_tablet . '.slick-nav.slick-prev.style-1,' . $this->slick_tablet . '.slick-nav.slick-next.style-1,' . $this->slick_tablet . '.slick-nav.style-3:before,' . $this->slick_tablet . '.slick-prev.style-3:before,' . $this->slick_tablet . '.slick-prev.style-6:before,' . $this->slick_tablet . '.slick-next.style-6:before' => 'background: {{VALUE}};',
					$this->slick_tablet . '.slick-prev.style-4:before,' . $this->slick_tablet . '.slick-nav.style-4:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_arrows_style' => array( 'style-1', 'style-3', 'style-4', 'style-6' ),
					'tablet_slider_arrows'       => 'yes',
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_arrow_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					$this->slick_tablet . '.slick-nav.slick-prev.style-1:before,' . $this->slick_tablet . '.slick-nav.slick-next.style-1:before,' . $this->slick_tablet . '.slick-prev.style-3:before,' . $this->slick_tablet . '.slick-nav.style-3:before,' . $this->slick_tablet . '.slick-prev.style-4:before,' . $this->slick_tablet . '.slick-nav.style-4:before,' . $this->slick_tablet . '.slick-nav.style-6 .icon-wrap' => 'color: {{VALUE}};',
					$this->slick_tablet . '.slick-prev.style-2 .icon-wrap:before,' . $this->slick_tablet . '.slick-prev.style-2 .icon-wrap:after,' . $this->slick_tablet . '.slick-next.style-2 .icon-wrap:before,' . $this->slick_tablet . '.slick-next.style-2 .icon-wrap:after,' . $this->slick_tablet . '.slick-prev.style-5 .icon-wrap:before,' . $this->slick_tablet . '.slick-prev.style-5 .icon-wrap:after,' . $this->slick_tablet . '.slick-next.style-5 .icon-wrap:before,' . $this->slick_tablet . '.slick-next.style-5 .icon-wrap:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6' ),
					'tablet_slider_arrows'       => 'yes',
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_arrow_hover_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					$this->slick_tablet . '.slick-nav.slick-prev.style-1:hover,' . $this->slick_tablet . '.slick-nav.slick-next.style-1:hover,' . $this->slick_tablet . '.slick-prev.style-2:hover::before,' . $this->slick_tablet . '.slick-next.style-2:hover::before,' . $this->slick_tablet . '.slick-prev.style-3:hover:before,' . $this->slick_tablet . '.slick-nav.style-3:hover:before' => 'background: {{VALUE}};',
					$this->slick_tablet . '.slick-prev.style-4:hover:before,' . $this->slick_tablet . '.slick-nav.style-4:hover:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4' ),
					'tablet_slider_arrows'       => 'yes',
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_arrow_hover_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					$this->slick_tablet . '.slick-nav.slick-prev.style-1:hover:before,' . $this->slick_tablet . '.slick-nav.slick-next.style-1:hover:before,' . $this->slick_tablet . '.slick-prev.style-3:hover:before,' . $this->slick_tablet . '.slick-nav.style-3:hover:before,' . $this->slick_tablet . '.slick-prev.style-4:hover:before,' . $this->slick_tablet . '.slick-nav.style-4:hover:before,' . $this->slick_tablet . '.slick-nav.style-6:hover .icon-wrap' => 'color: {{VALUE}};',
					$this->slick_tablet . '.slick-prev.style-2:hover .icon-wrap::before,' . $this->slick_tablet . '.slick-prev.style-2:hover .icon-wrap::after,' . $this->slick_tablet . '.slick-next.style-2:hover .icon-wrap::before,' . $this->slick_tablet . '.slick-next.style-2:hover .icon-wrap::after,' . $this->slick_tablet . '.slick-prev.style-5:hover .icon-wrap::before,' . $this->slick_tablet . '.slick-prev.style-5:hover .icon-wrap::after,' . $this->slick_tablet . '.slick-next.style-5:hover .icon-wrap::before,' . $this->slick_tablet . '.slick-next.style-5:hover .icon-wrap::after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6' ),
					'tablet_slider_arrows'       => 'yes',
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_outer_section_arrow',
			array(
				'label'     => esc_html__( 'Outer Content Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'tablet_slider_arrows'       => 'yes',
					'tablet_slider_arrows_style' => array( 'style-1', 'style-2', 'style-5', 'style-6' ),
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_hover_show_arrow',
			array(
				'label'     => esc_html__( 'On Hover Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'tablet_slider_arrows' => 'yes',
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
			'mobile_slider_dots_style',
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
					'mobile_slider_dots' => array( 'yes' ),
					'slider_responsive_mobile' => 'yes'
				),
			)
		);
		$this->add_control(
			'mobile_dots_border_color',
			array(
				'label'     => esc_html__( 'Dots Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					$this->slick_mobile . '.slick-dots.style-1 li button,'. $this->slick_mobile . '.slick-dots.style-6 li button' => '-webkit-box-shadow:inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					$this->slick_mobile . '.slick-dots.style-1 li.slick-active button' => '-webkit-box-shadow:inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					$this->slick_mobile . '.slick-dots.style-2 li button' => 'border-color:{{VALUE}};',
					$this->slick_mobile . 'ul.slick-dots.style-3 li button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					$this->slick_mobile . '.slick-dots.style-3 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					$this->slick_mobile . 'ul.slick-dots.style-4 li button' => '-webkit-box-shadow: inset 0 0 0 0px {{VALUE}};-moz-box-shadow: inset 0 0 0 0px {{VALUE}};box-shadow: inset 0 0 0 0px {{VALUE}};',
					$this->slick_mobile . '.slick-dots.style-1 li button:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_dots_style' => array( 'style-1', 'style-2', 'style-3', 'style-5' ),
					'mobile_slider_dots'       => 'yes',
					'slider_responsive_mobile' => 'yes'
				),
			)
		);
		$this->add_control(
			'mobile_dots_bg_color',
			array(
				'label'     => esc_html__( 'Dots Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					$this->slick_mobile . '.slick-dots.style-2 li button,' .$this->slick_mobile . 'ul.slick-dots.style-3 li button,' .$this->slick_mobile . '.slick-dots.style-4 li button:before,' .$this->slick_mobile . '.slick-dots.style-5 button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-7 button' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_dots_style' => array( 'style-2', 'style-3', 'style-4', 'style-5', 'style-7' ),
					'mobile_slider_dots'       => 'yes',
					'slider_responsive_mobile' => 'yes'
				),
			)
		);
		$this->add_control(
			'mobile_dots_active_border_color',
			array(
				'label'     => esc_html__( 'Dots Active Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					$this->slick_mobile . '.slick-dots.style-2 li::after' => 'border-color: {{VALUE}};',
					$this->slick_mobile . '.slick-dots.style-4 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					$this->slick_mobile . '.slick-dots.style-6 .slick-active button:after' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_dots_style' => array( 'style-2', 'style-4', 'style-6' ),
					'mobile_slider_dots'       => 'yes',
					'slider_responsive_mobile' => 'yes'
				),
			)
		);
		$this->add_control(
			'mobile_dots_active_bg_color',
			array(
				'label'     => esc_html__( 'Dots Active Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					$this->slick_mobile . '.slick-dots.style-2 li::after,' . $this->slick_mobile . '.slick-dots.style-4 li.slick-active button:before,' . $this->slick_mobile . '.slick-dots.style-5 .slick-active button,' . $this->slick_mobile . '.slick-dots.style-7 .slick-active button' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_dots_style' => array( 'style-2', 'style-4', 'style-5', 'style-7' ),
					'mobile_slider_dots'       => 'yes',
					'slider_responsive_mobile' => 'yes'
				),
			)
		);
		$this->add_control(
			'mobile_dots_top_padding',
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
					$this->slick_mobile . '.slick-slider.slick-dotted' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'mobile_slider_dots' => 'yes',
					'slider_responsive_mobile' => 'yes'
				),
			)
		);
		$this->add_control(
			'mobile_hover_show_dots',
			array(
				'label'     => esc_html__( 'On Hover Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'mobile_slider_dots' => 'yes',
					'slider_responsive_mobile' => 'yes'
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
			'mobile_slider_arrows_style',
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
					'mobile_slider_arrows' => array( 'yes' ),
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_arrows_position',
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
					'mobile_slider_arrows'       => array( 'yes' ),
					'mobile_slider_arrows_style' => array( 'style-3', 'style-4' ),
					'slider_responsive_mobile' => 'yes',

				),
			)
		);
		$this->add_control(
			'mobile_arrow_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					$this->slick_mobile . '.slick-nav.slick-prev.style-1,' . $this->slick_mobile . '.slick-nav.slick-next.style-1,' . $this->slick_mobile . '.slick-nav.style-3:before,' . $this->slick_mobile . '.slick-prev.style-3:before,' . $this->slick_mobile . '.slick-prev.style-6:before,' . $this->slick_mobile . '.slick-next.style-6:before' => 'background: {{VALUE}};',
					$this->slick_mobile . '.slick-prev.style-4:before,' . $this->slick_mobile . '.slick-nav.style-4:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_arrows_style' => array( 'style-1', 'style-3', 'style-4', 'style-6' ),
					'mobile_slider_arrows'       => 'yes',
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_arrow_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					$this->slick_mobile . '.slick-nav.slick-prev.style-1:before,' . $this->slick_mobile . '.slick-nav.slick-next.style-1:before,' . $this->slick_mobile . '.slick-prev.style-3:before,' . $this->slick_mobile . '.slick-nav.style-3:before,' . $this->slick_mobile . '.slick-prev.style-4:before,' . $this->slick_mobile . '.slick-nav.style-4:before,' . $this->slick_mobile . '.slick-nav.style-6 .icon-wrap' => 'color: {{VALUE}};',
					$this->slick_mobile . '.slick-prev.style-2 .icon-wrap:before,' . $this->slick_mobile . '.slick-prev.style-2 .icon-wrap:after,' . $this->slick_mobile . '.slick-next.style-2 .icon-wrap:before,' . $this->slick_mobile . '.slick-next.style-2 .icon-wrap:after,' . $this->slick_mobile . '.slick-prev.style-5 .icon-wrap:before,' . $this->slick_mobile . '.slick-prev.style-5 .icon-wrap:after,' . $this->slick_mobile . '.slick-next.style-5 .icon-wrap:before,' . $this->slick_mobile . '.slick-next.style-5 .icon-wrap:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6' ),
					'mobile_slider_arrows'       => 'yes',
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_arrow_hover_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					$this->slick_mobile . '.slick-nav.slick-prev.style-1:hover,' . $this->slick_mobile . '.slick-nav.slick-next.style-1:hover,' . $this->slick_mobile . '.slick-prev.style-2:hover::before,' . $this->slick_mobile . '.slick-next.style-2:hover::before,' . $this->slick_mobile . '.slick-prev.style-3:hover:before,' . $this->slick_mobile . '.slick-nav.style-3:hover:before' => 'background: {{VALUE}};',
					$this->slick_mobile . '.slick-prev.style-4:hover:before,' . $this->slick_mobile . '.slick-nav.style-4:hover:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4' ),
					'mobile_slider_arrows'       => 'yes',
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_arrow_hover_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					$this->slick_mobile . '.slick-nav.slick-prev.style-1:hover:before,' . $this->slick_mobile . '.slick-nav.slick-next.style-1:hover:before,' . $this->slick_mobile . '.slick-prev.style-3:hover:before,' . $this->slick_mobile . '.slick-nav.style-3:hover:before,' . $this->slick_mobile . '.slick-prev.style-4:hover:before,' . $this->slick_mobile . '.slick-nav.style-4:hover:before,' . $this->slick_mobile . '.slick-nav.style-6:hover .icon-wrap' => 'color: {{VALUE}};',
					$this->slick_mobile . '.slick-prev.style-2:hover .icon-wrap::before,' . $this->slick_mobile . '.slick-prev.style-2:hover .icon-wrap::after,' . $this->slick_mobile . '.slick-next.style-2:hover .icon-wrap::before,' . $this->slick_mobile . '.slick-next.style-2:hover .icon-wrap::after,' . $this->slick_mobile . '.slick-prev.style-5:hover .icon-wrap::before,' . $this->slick_mobile . '.slick-prev.style-5:hover .icon-wrap::after,' . $this->slick_mobile . '.slick-next.style-5:hover .icon-wrap::before,' . $this->slick_mobile . '.slick-next.style-5:hover .icon-wrap::after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6' ),
					'mobile_slider_arrows'       => 'yes',
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_outer_section_arrow',
			array(
				'label'     => esc_html__( 'Outer Content Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'mobile_slider_arrows'       => 'yes',
					'mobile_slider_arrows_style' => array( 'style-1', 'style-2', 'style-5', 'style-6' ),
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_hover_show_arrow',
			array(
				'label'     => esc_html__( 'On Hover Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'mobile_slider_arrows' => 'yes',
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
				'separator'   => 'before',
				'description' => esc_html__( 'Keep this blank or Setup Unique id for carousel which you can use with "Carousel Remote" widget.', 'theplus' ),
			)
		);
		$this->end_controls_section();
		/*
		Carousel Option End*/
		/*Filter Category Style Start*/
		$this->start_controls_section(
			'section_filter_category_styling',
			array(
				'label'     => esc_html__( 'Filter Category', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
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
		/*
		Filter Category Style End*/
		/*Facebook Style Start*/
		$this->start_controls_section(
			'section_facebook_styling',
			array(
				'label' => esc_html__( 'Facebook', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'FbMsgTp',
				'label'     => esc_html__( 'Extra Title Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-social-feed .feed-Facebook .tp-sf-feed .tp-title',
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'FbDesTp',
				'label'    => esc_html__( 'Description Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Facebook .tp-sf-feed .tp-message',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'FbNameTp',
				'label'    => esc_html__( 'Name Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Facebook .tp-sf-feed .tp-sf-username a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'FbTimeTp',
				'label'    => esc_html__( 'Time Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Facebook .tp-sf-feed .tp-sf-time a',
			)
		);
		$this->start_controls_tabs( 'sfd_fb_clr_tabs' );
		$this->start_controls_tab(
			'sfd_fb_clr_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'FbNTitleC',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Facebook .tp-sf-feed .tp-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_control(
			'FbNDesC',
			array(
				'label'     => esc_html__( 'Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Facebook .tp-sf-feed .tp-message' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'FbNNameC',
			array(
				'label'     => esc_html__( 'Name Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Facebook .tp-sf-feed .tp-sf-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'FbNTimeC',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Facebook .tp-sf-feed .tp-sf-time a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'FbNIconCr',
			array(
				'label'     => esc_html__( 'Icon Footer Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Facebook .tp-sf-feed .tp-sf-footer' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'sfd_fb_clr_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'FbHTitleC',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Facebook:hover .tp-sf-feed .tp-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_control(
			'FbHDesC',
			array(
				'label'     => esc_html__( 'Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Facebook:hover .tp-sf-feed .tp-message' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'FbHNameC',
			array(
				'label'     => esc_html__( 'Name Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Facebook:hover .tp-sf-feed .tp-sf-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'FbHTimeC',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Facebook:hover .tp-sf-feed .tp-sf-time a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'FbHIconCr',
			array(
				'label'     => esc_html__( 'Icon Footer Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Facebook:hover .tp-sf-feed .tp-sf-footer' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'sfd_fb_tabs' );
		$this->start_controls_tab(
			'sfd_fb_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'FbNBgCr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Facebook .tp-sf-feed',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'FbNBcr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Facebook .tp-sf-feed',
			)
		);
		$this->add_responsive_control(
			'FbNBRcr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .feed-Facebook .tp-sf-feed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'FbNBs',
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Facebook .tp-sf-feed',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'sfd_fb_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'FbHBgCr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Facebook:hover .tp-sf-feed',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'FbHBcr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Facebook:hover .tp-sf-feed',
			)
		);
		$this->add_responsive_control(
			'FbHBRcr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .feed-Facebook:hover .tp-sf-feed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'FbHBs',
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Facebook:hover .tp-sf-feed',
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
					'{{WRAPPER}} .tp-social-feed .feed-Facebook .tp-sf-feed .tp-sf-logo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'SocIconSizefb',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-feed .fa-facebook.social-logo-fb' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'SocIconColorfb',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .fa-facebook.social-logo-fb' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		/*
		Facebook Style End*/
		/*Vimeo Style Start*/
		$this->start_controls_section(
			'section_vimeo_styling',
			array(
				'label' => esc_html__( 'Vimeo', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'VmMsgTp',
				'label'     => esc_html__( 'Extra Title Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-social-feed .feed-Vimeo .tp-sf-feed .tp-title',
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'VmDesTp',
				'label'    => esc_html__( 'Description Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Vimeo .tp-sf-feed .tp-message',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'VmNameTp',
				'label'    => esc_html__( 'Name Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Vimeo .tp-sf-feed .tp-sf-username a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'VmTimeTp',
				'label'    => esc_html__( 'Time Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Vimeo .tp-sf-feed .tp-sf-time a',
			)
		);
		$this->start_controls_tabs( 'sfd_vm_clr_tabs' );
		$this->start_controls_tab(
			'sfd_vm_clr_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'VmNTitleC',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Vimeo .tp-sf-feed .tp-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_control(
			'VmNDesC',
			array(
				'label'     => esc_html__( 'Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Vimeo .tp-sf-feed .tp-message' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'VmNNameC',
			array(
				'label'     => esc_html__( 'Name Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Vimeo .tp-sf-feed .tp-sf-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'VmNTimeC',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Vimeo .tp-sf-feed .tp-sf-time a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'VmNIconCr',
			array(
				'label'     => esc_html__( 'Icon Footer Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Vimeo .tp-sf-feed .tp-sf-footer' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'sfd_vm_clr_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'VmHTitleC',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Vimeo:hover .tp-sf-feed .tp-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_control(
			'VmHDesC',
			array(
				'label'     => esc_html__( 'Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Vimeo:hover .tp-sf-feed .tp-message' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'VmHNameC',
			array(
				'label'     => esc_html__( 'Name Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Vimeo:hover .tp-sf-feed .tp-sf-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'VmHTimeC',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Vimeo:hover .tp-sf-feed .tp-sf-time a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'VmHIconCr',
			array(
				'label'     => esc_html__( 'Icon Footer Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Vimeo:hover .tp-sf-feed .tp-sf-footer' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'sfd_vm_tabs' );
		$this->start_controls_tab(
			'sfd_vm_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'VmNBgCr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Vimeo .tp-sf-feed',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'VmNBcr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Vimeo .tp-sf-feed',
			)
		);
		$this->add_responsive_control(
			'VmNBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .feed-Vimeo .tp-sf-feed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'VmNBs',
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Vimeo .tp-sf-feed',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'sfd_vm_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'VmHBgCr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Vimeo:hover .tp-sf-feed',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'VmHBcr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Vimeo:hover .tp-sf-feed',
			)
		);
		$this->add_responsive_control(
			'VmHBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .feed-Vimeo:hover .tp-sf-feed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'VmHBs',
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Vimeo:hover .tp-sf-feed',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'VmPRs',
			array(
				'label'      => esc_html__( 'Profile Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .feed-Vimeo .tp-sf-feed .tp-sf-logo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'SocIconSizevimeo',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-feed .fa-vimeo-v.social-logo-yt' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'SocIconColorvimeo',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .fa-vimeo-v.social-logo-yt' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		/*
		Vimeo Style End*/
		/*Youtube Style Start*/
		$this->start_controls_section(
			'section_ytube_styling',
			array(
				'label' => esc_html__( 'Youtube', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'YtMsgTp',
				'label'     => esc_html__( 'Extra Title Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-social-feed .feed-Youtube .tp-sf-feed .tp-title',
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'YtDesTp',
				'label'    => esc_html__( 'Description Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Youtube .tp-sf-feed .tp-message',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'YtNameTp',
				'label'    => esc_html__( 'Name Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Youtube .tp-sf-feed .tp-sf-username a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'YtTimeTp',
				'label'    => esc_html__( 'Time Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Youtube .tp-sf-feed .tp-sf-time a',
			)
		);
		$this->start_controls_tabs( 'sfd_ytube_clr_tabs' );
		$this->start_controls_tab(
			'sfd_ytube_clr_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'YtNTitleC',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Youtube .tp-sf-feed .tp-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_control(
			'YtNDesC',
			array(
				'label'     => esc_html__( 'Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Youtube .tp-sf-feed .tp-message' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'YtNNameC',
			array(
				'label'     => esc_html__( 'Name Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Youtube .tp-sf-feed .tp-sf-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'YtNTimeC',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Youtube .tp-sf-feed .tp-sf-time a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'YtNIconCr',
			array(
				'label'     => esc_html__( 'Icon Footer Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Youtube .tp-sf-feed .tp-sf-footer' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'sfd_ytube_clr_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'YtHTitleC',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Youtube:hover .tp-sf-feed .tp-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_control(
			'YtHDesC',
			array(
				'label'     => esc_html__( 'Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Youtube:hover .tp-sf-feed .tp-message' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'YtHNameC',
			array(
				'label'     => esc_html__( 'Name Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Youtube:hover .tp-sf-feed .tp-sf-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'YtHTimeC',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Youtube:hover .tp-sf-feed .tp-sf-time a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'YtHIconCr',
			array(
				'label'     => esc_html__( 'Icon Footer Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Youtube:hover .tp-sf-feed .tp-sf-footer' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'sfd_ytube_tabs' );
		$this->start_controls_tab(
			'sfd_ytube_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'YtNBgCr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Youtube .tp-sf-feed',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'YtNBcr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Youtube .tp-sf-feed',
			)
		);
		$this->add_responsive_control(
			'YtNBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .feed-Youtube .tp-sf-feed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'YtNBs',
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Youtube .tp-sf-feed',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'sfd_ytube_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'YtHBgCr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Youtube:hover .tp-sf-feed',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'YtHBcr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Youtube:hover .tp-sf-feed',
			)
		);
		$this->add_responsive_control(
			'YtHBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .feed-Youtube:hover .tp-sf-feed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'YtHBs',
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Youtube:hover .tp-sf-feed',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'YtPRs',
			array(
				'label'      => esc_html__( 'Profile Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .feed-Youtube .tp-sf-feed .tp-sf-logo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'SocIconSizeyoutube',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-feed .fa-youtube.social-logo-yt' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'SocIconColoryoutube',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .fa-youtube.social-logo-yt' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		/*
		Youtube Style End*/
		/*Twitter Style Start*/
		$this->start_controls_section(
			'section_twitter_styling',
			array(
				'label' => esc_html__( 'Twitter', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'TwMsgTp',
				'label'     => esc_html__( 'Extra Title Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-social-feed .feed-Twitter .tp-sf-feed .tp-title',
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'TwDesTp',
				'label'    => esc_html__( 'Description Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Twitter .tp-sf-feed .tp-message',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'TwNameTp',
				'label'    => esc_html__( 'Name Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Twitter .tp-sf-feed .tp-sf-username a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'TwTimeTp',
				'label'    => esc_html__( 'Time Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Twitter .tp-sf-feed .tp-sf-time a',
			)
		);
		$this->start_controls_tabs( 'sfd_twitter_clr_tabs' );
		$this->start_controls_tab(
			'sfd_twitter_clr_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'TwNTitleC',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Twitter .tp-sf-feed .tp-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_control(
			'TwNDesC',
			array(
				'label'     => esc_html__( 'Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Twitter .tp-sf-feed .tp-message' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'TwNNameC',
			array(
				'label'     => esc_html__( 'Name Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Twitter .tp-sf-feed .tp-sf-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'TwNTimeC',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Twitter .tp-sf-feed .tp-sf-time a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'TwNIconCr',
			array(
				'label'     => esc_html__( 'Icon Footer Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Twitter .tp-sf-feed .tp-sf-footer *' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'sfd_twitter_clr_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'TwHTitleC',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Twitter:hover .tp-sf-feed .tp-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_control(
			'TwHDesC',
			array(
				'label'     => esc_html__( 'Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Twitter:hover .tp-sf-feed .tp-message' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'TwHNameC',
			array(
				'label'     => esc_html__( 'Name Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Twitter:hover .tp-sf-feed .tp-sf-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'TwHTimeC',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Twitter:hover .tp-sf-feed .tp-sf-time a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'TwHIconCr',
			array(
				'label'     => esc_html__( 'Icon Footer Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Twitter:hover .tp-sf-feed .tp-sf-footer *' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'sfd_twitter_tabs' );
		$this->start_controls_tab(
			'sfd_twitter_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'TwNBgCr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Twitter .tp-sf-feed',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'TwNBcr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Twitter .tp-sf-feed',
			)
		);
		$this->add_responsive_control(
			'TwNBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .feed-Twitter .tp-sf-feed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'TwNBs',
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Twitter .tp-sf-feed',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'sfd_twitter_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'TwHBgCr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Twitter:hover .tp-sf-feed',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'TwHBcr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Twitter:hover .tp-sf-feed',
			)
		);
		$this->add_responsive_control(
			'TwHBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .feed-Twitter:hover .tp-sf-feed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'TwHBs',
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Twitter:hover .tp-sf-feed',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'TwPRs',
			array(
				'label'      => esc_html__( 'Profile Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .feed-Twitter .tp-sf-feed .tp-sf-logo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'SocIconSizetwt',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-feed .fa-twitter.social-logo-tw' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'SocIconColortwt',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .fa-twitter.social-logo-tw' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		/*
		Twitter Style End*/
		/*Instagram Style Start*/
		$this->start_controls_section(
			'section_insta_styling',
			array(
				'label' => esc_html__( 'Instagram', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'IgMsgTp',
				'label'     => esc_html__( 'Extra Title Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-social-feed .feed-Instagram .tp-sf-feed .tp-title',
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'IgNameTp',
				'label'    => esc_html__( 'Name Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Instagram .tp-sf-feed .tp-sf-username a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'IgTimeTp',
				'label'    => esc_html__( 'Time Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Instagram .tp-sf-feed .tp-sf-time a',
			)
		);
		$this->start_controls_tabs( 'sfd_insta_clr_tabs' );
		$this->start_controls_tab(
			'sfd_insta_clr_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'IgNTitleC',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Instagram .tp-sf-feed .tp-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_control(
			'IgNNameC',
			array(
				'label'     => esc_html__( 'Name Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Instagram .tp-sf-feed .tp-sf-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'IgNTimeC',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Instagram .tp-sf-feed .tp-sf-time a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'sfd_insta_clr_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'IgHTitleC',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Instagram:hover .tp-sf-feed .tp-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowTitle' => 'yes',
				),
			)
		);
		$this->add_control(
			'IgHNameC',
			array(
				'label'     => esc_html__( 'Name Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Instagram:hover .tp-sf-feed .tp-sf-username a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'IgHTimeC',
			array(
				'label'     => esc_html__( 'Time Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .feed-Instagram:hover .tp-sf-feed .tp-sf-time a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'sfd_insta_tabs' );
		$this->start_controls_tab(
			'sfd_insta_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'IgNBgCr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Instagram .tp-sf-feed',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'IgNBcr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Instagram .tp-sf-feed',
			)
		);
		$this->add_responsive_control(
			'IgNBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .feed-Instagram .tp-sf-feed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'IgNBs',
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Instagram .tp-sf-feed',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'sfd_insta_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'IgHBgCr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Instagram:hover .tp-sf-feed',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'IgHBcr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Instagram:hover .tp-sf-feed',
			)
		);
		$this->add_responsive_control(
			'IgHBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .feed-Instagram:hover .tp-sf-feed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'IgHBs',
				'selector' => '{{WRAPPER}} .tp-social-feed .feed-Instagram:hover .tp-sf-feed',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'IgPRs',
			array(
				'label'      => esc_html__( 'Profile Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-feed .feed-Instagram .tp-sf-feed .tp-sf-logo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'SocIconSizeinsta',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-feed .fa-instagram.social-logo-fb' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'SocIconColorinsta',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-feed .fa-instagram.social-logo-fb' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		/*Instagram Style End*/
	}

	/**
	 * Render Accrordion.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$WidgetUID = $this->get_unique_selector();
		$uid_sfeed = uniqid( 'tp-sfeed' );
		$WidgetId  = $this->get_id();
		$layout    = ! empty( $settings['layout'] ) ? $settings['layout'] : 'grid';
		$style     = ! empty( $settings['style'] ) ? $settings['style'] : 'style-1';

		$Rsocialfeed = ! empty( $settings['AllReapeter'] ) ? $settings['AllReapeter'] : array();
		$RefreshTime = ! empty( $settings['TimeFrq'] ) ? $settings['TimeFrq'] : '3600';

		$TimeFrq   = array( 'TimeFrq' => $RefreshTime );
		$TotalPost = ! empty( $settings['TotalPost'] ) ? $settings['TotalPost'] : 1000;
		$FeedId    = ! empty( $settings['FeedId'] ) ? preg_split( '/\,/', $settings['FeedId'] ) : array();
		$ShowTitle = ! empty( $settings['ShowTitle'] ) ? $settings['ShowTitle'] : false;

		$showFooterIn = ! empty( $settings['showFooterIn'] == 'yes' ) ? true : false;

		$txtLimt   = ! empty( $settings['TextLimit'] == 'yes' ) ? true : false;
		$TextCount = ! empty( $settings['TextCount'] ) ? $settings['TextCount'] : 100;
		$TextType  = ! empty( $settings['TextType'] ) ? $settings['TextType'] : 'char';
		$TextMore  = ! empty( $settings['TextMore'] ) ? $settings['TextMore'] : 'Show More';
		$TextLess  = ! empty( $settings['TextLess'] ) ? $settings['TextLess'] : '';
		$TextDots  = ! empty( $settings['TextDots'] == 'yes' ) ? '...' : '';

		$FancyStyle  = ! empty( $settings['FancyStyle'] ) ? $settings['FancyStyle'] : 'default';
		$DescripBTM  = ! empty( $settings['DescripBTM'] == 'yes' ) ? true : false;
		$MediaFilter = ! empty( $settings['MediaFilter'] ) ? $settings['MediaFilter'] : 'default';
		$CategoryWF  = ! empty( $settings['filter_category'] ) ? $settings['filter_category'] : '';
		$Postdisplay = ! empty( $settings['display_posts'] ) ? (int) $settings['display_posts'] : 8;
		$postview    = ! empty( $settings['load_more_post'] ) ? $settings['load_more_post'] : '';
		$postLodop   = ! empty( $settings['post_extra_option'] ) ? $settings['post_extra_option'] : '';
		$loadbtnText = ! empty( $settings['load_more_btn_text'] ) ? $settings['load_more_btn_text'] : '';
		$loadingtxt  = ! empty( $settings['tp_loading_text'] ) ? $settings['tp_loading_text'] : '';
		$allposttext = ! empty( $settings['loaded_posts_text'] ) ? $settings['loaded_posts_text'] : '';
		$ShowFeedId  = ! empty( $settings['ShowFeedId'] ) ? $settings['ShowFeedId'] : 'no';
		$PopupOption = ! empty( $settings['OnPopup'] ) ? $settings['OnPopup'] : 'OnFancyBox';
		$Performance = ! empty( $settings['perf_manage'] ) ? $settings['perf_manage'] : false;

		$NormalScroll = '';
		$ScrollOn     = ! empty( $settings['ScrollOn'] == 'yes' ) ? true : false;
		$FcyScrolllOn = ! empty( $settings['FcySclOn'] == 'yes' ) ? true : false;
		$OffsetPost   = ! empty( $FeedId ) ? $Postdisplay - count( $FeedId ) : '';

		$FeedArray    = array();
		$ShomoreArray = array();
		if ( ! empty( $txtLimt ) ) {
			$ShomoreArray = array(
				'TextMore' => $TextMore,
				'TextLess' => $TextLess,
			);

			array_merge( $FeedArray, $ShomoreArray );
		}

		$NormalShomore = json_encode( $ShomoreArray, true );

		if ( ! empty( $ScrollOn ) || ! empty( $FcyScrolllOn ) ) {
			$ScrollData = array(
				'className'   => 'tp-normal-scroll',
				'ScrollOn'    => $ScrollOn,
				'Height'      => ! empty( $settings['ScrollHgt']['size'] ) ? (int) $settings['ScrollHgt']['size'] : 150,
				'TextLimit'   => $txtLimt,

				'Fancyclass'  => 'tp-fancy-scroll',
				'FancyScroll' => $FcyScrolllOn,
				'FancyHeight' => ! empty( $settings['FcySclHgt']['size'] ) ? (int) $settings['FcySclHgt']['size'] : 150,
			);

			$NormalScroll = json_encode( $ScrollData, true );
		}

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
			$desktop_class = 'tp-col-lg-' . esc_attr( $settings['desktop_column'] );
			$tablet_class  = 'tp-col-md-' . esc_attr( $settings['tablet_column'] );
			$mobile_class  = 'tp-col-sm-' . esc_attr( $settings['mobile_column'] );
			$mobile_class .= ' tp-col-' . esc_attr( $settings['mobile_column'] );
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

		$fancybox_settings = $this->tp_social_feed_fancybox( $settings );
		$fancybox_settings = json_encode( $fancybox_settings );
		if ( 'yes' === $CategoryWF ) {
			$data_class .= ' pt-plus-filter-post-category ';
		}

		$ji = 1;
		$ij = '';

		$uid_sfeed = uniqid( 'post' );
		if ( ! empty( $settings['carousel_unique_id'] ) ) {
			$uid_sfeed = 'tpca_' . $settings['carousel_unique_id'];
		}

		$Fancyboxids = json_encode( array( $WidgetId, $uid_sfeed ) );
		$data_attr  .= ' data-id="' . esc_attr( $uid_sfeed ) . '"';
		$data_attr  .= ' data-style="' . esc_attr( $style ) . '"';
		$output     .= '<div id="' . esc_attr( $uid_sfeed ) . '" class="' . esc_attr( $uid_sfeed ) . ' tp-social-feed ' . esc_attr( $data_class ) . '" ' . $layout_attr . ' ' . $data_attr . ' data-fancy-option=\'' . $fancybox_settings . '\' data-scroll-normal=\'' . esc_attr( $NormalScroll ) . '\' data-feed-data=\'' . esc_attr( $NormalShomore ) . '\' ' . $carousel_slider . ' dir=' . esc_attr( $carousel_direction ) . ' data-ids=\'' . $Fancyboxids . '\' data-enable-isotope="1" >';

		$FancyBoxJS = '';
		if ( 'OnFancyBox' === $PopupOption ) {
			$FancyBoxJS = 'data-fancybox=' . esc_attr( $uid_sfeed );
		}

		$FinalData       = array();
		$Perfo_transient = get_transient( "SF-Performance-$WidgetId" );
		
		if ( ( 'yes' !== $Performance ) || ( 'yes' === $Performance && false == $Perfo_transient ) ) {
			$AllData = array();
			foreach ( $Rsocialfeed as $index => $social ) {
				$RFeed  = ! empty( $social['selectFeed'] ) ? $social['selectFeed'] : 'Facebook';
				$social = array_merge( $TimeFrq, $social );
				if ( 'Facebook' === $RFeed ) {
					$AllData[] = $this->FacebookFeed( $social, $settings );
				} elseif ( 'Twitter' === $RFeed ) {
					$AllData[] = $this->TwetterFeed( $social, $settings );
				} elseif ( 'Instagram' === $RFeed ) {
					$AllData[] = $this->InstagramFeed( $social, $settings );
				} elseif ( 'Vimeo' === $RFeed ) {
					$AllData[] = $this->VimeoFeed( $social, $settings );
				} elseif ( 'Youtube' === $RFeed ) {
					$AllData[] = $this->YouTubeFeed( $social, $settings );
				}
			}

			foreach ( $AllData as $key => $val ) {
				foreach ( $val as $key => $vall ) {
					$FinalData[] = $vall;
				}
			}

			$Feed_Index = array_column( $FinalData, 'Feed_Index' );
			array_multisort( $Feed_Index, SORT_ASC, $FinalData );

			set_transient( "SF-Performance-$WidgetId", $FinalData, $RefreshTime );
		} else {
			$FinalData = get_transient( "SF-Performance-$WidgetId" );
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
				$totalFeed = ( count( $FinalData ) );
				$remindata = array_slice( $FinalData, $Postdisplay );

				$RemingC   = count( $remindata );
				$FinalData = array_slice( $FinalData, 0, $Postdisplay );

				$FRemingC    = count( $FinalData );
				$trans_store = get_transient( "SF-Loadmore-$WidgetId" );
				if ( $trans_store === false ) {
					set_transient( "SF-Loadmore-$WidgetId", $remindata, $RefreshTime );
				} elseif ( ! empty( $trans_store ) && is_array( $trans_store ) && count( $trans_store ) != $totalFeed ) {
					set_transient( "SF-Loadmore-$WidgetId", $remindata, $RefreshTime );
				}

				$postattr     = array(
					'load_class'     => esc_attr( $WidgetId ),
					'layout'         => esc_attr( $layout ),
					'style'          => esc_attr( $style ),
					'desktop_column' => esc_attr( $settings['desktop_column'] ),
					'tablet_column'  => esc_attr( $settings['tablet_column'] ),
					'mobile_column'  => esc_attr( $settings['mobile_column'] ),
					'DesktopClass'   => esc_attr( $desktop_class ),
					'TabletClass'    => esc_attr( $tablet_class ),
					'MobileClass'    => esc_attr( $mobile_class ),
					'postview'       => esc_attr( (int) $postview ),
					'display'        => esc_attr( $Postdisplay ),
					'TextLimit'      => esc_attr( $txtLimt ),
					'TextCount'      => esc_attr( $TextCount ),
					'TextType'       => esc_attr( $TextType ),
					'TextMore'       => esc_attr( $TextMore ),
					'TextDots'       => esc_attr( $TextDots ),
					'loadingtxt'     => esc_attr( $loadingtxt ),
					'allposttext'    => esc_attr( $allposttext ),
					'totalFeed'      => esc_attr( $totalFeed ),
					'FancyStyle'     => esc_attr( $FancyStyle ),
					'DescripBTM'     => esc_attr( $DescripBTM ),
					'MediaFilter'    => esc_attr( $MediaFilter ),
					'TotalPost'      => esc_attr( $TotalPost ),
					'categorytext'   => esc_attr( $CategoryWF ),
					'PopupOption'    => esc_attr( $PopupOption ),
					'FilterStyle'    => esc_attr( $settings['filter_style'] ),
					'theplus_nonce'  => wp_create_nonce( 'theplus-addons' ),
				);
				$data_loadkey = tp_plus_simple_decrypt( json_encode( $postattr ), 'ey' );
			}

			$output .= '<div id="' . esc_attr( $uid_sfeed ) . '" class="tp-row post-inner-loop ' . esc_attr( $uid_sfeed ) . ' social-feed-' . esc_attr( $style ) . '">';
			foreach ( $FinalData as $F_index => $AllVmData ) {
				$PopupTarget = $PopupLink = '';
				$uniqEach    = uniqid();
				$PopupSylNum = "{$uid_sfeed}-{$F_index}-{$uniqEach}";

				$RKey         = ! empty( $AllVmData['RKey'] ) ? $AllVmData['RKey'] : '';
				$PostId       = ! empty( $AllVmData['PostId'] ) ? $AllVmData['PostId'] : '';
				$selectFeed   = ! empty( $AllVmData['selectFeed'] ) ? $AllVmData['selectFeed'] : '';
				$Massage      = ! empty( $AllVmData['Massage'] ) ? $AllVmData['Massage'] : '';
				$Description  = ! empty( $AllVmData['Description'] ) ? $AllVmData['Description'] : '';
				$Type         = ! empty( $AllVmData['Type'] ) ? $AllVmData['Type'] : '';
				$PostLink     = ! empty( $AllVmData['PostLink'] ) ? $AllVmData['PostLink'] : '';
				$CreatedTime  = ! empty( $AllVmData['CreatedTime'] ) ? $AllVmData['CreatedTime'] : '';
				$PostImage    = ! empty( $AllVmData['PostImage'] ) ? $AllVmData['PostImage'] : '';
				$UserName     = ! empty( $AllVmData['UserName'] ) ? $AllVmData['UserName'] : '';
				$UserImage    = ! empty( $AllVmData['UserImage'] ) ? $AllVmData['UserImage'] : '';
				$UserLink     = ! empty( $AllVmData['UserLink'] ) ? $AllVmData['UserLink'] : '';
				$socialIcon   = ! empty( $AllVmData['socialIcon'] ) ? $AllVmData['socialIcon'] : '';
				$CategoryText = ! empty( $AllVmData['FilterCategory'] ) ? $AllVmData['FilterCategory'] : '';
				$ErrorClass   = ! empty( $AllVmData['ErrorClass'] ) ? $AllVmData['ErrorClass'] : '';
				$EmbedURL     = ! empty( $AllVmData['Embed'] ) ? $AllVmData['Embed'] : '';
				$EmbedType    = ! empty( $AllVmData['EmbedType'] ) ? $AllVmData['EmbedType'] : '';

				$category_filter = '';
				$loop_category   = '';

				if ( ! empty( $CategoryWF ) && 'yes' === $CategoryWF && ! empty( $CategoryText ) && 'carousel' !== $layout ) {

					$loop_category = explode( ',', $CategoryText );
					foreach ( $loop_category as $category ) {
						$category = $this->SF_Media_createSlug( $category );

						$category_filter .= ' ' . esc_attr( $category ) . ' ';
					}
				}

				if ( 'Facebook' === $selectFeed ) {
					$Fblikes     = ! empty( $AllVmData['FbLikes'] ) ? $AllVmData['FbLikes'] : 0;
					$comment     = ! empty( $AllVmData['comment'] ) ? $AllVmData['comment'] : 0;
					$share       = ! empty( $AllVmData['share'] ) ? $AllVmData['share'] : 0;
					$likeImg     = THEPLUS_ASSETS_URL . 'images/social-feed/like.png';
					$ReactionImg = THEPLUS_ASSETS_URL . 'images/social-feed/love.png';
					$FbAlbum     = ! empty( $AllVmData['FbAlbum'] ) ? true : false;

					if ( ! empty( $FbAlbum ) ) {
						$FancyBoxJS = 'data-fancybox=' . esc_attr( "album-Facebook{$F_index}-{$uid_sfeed}" );
					}
				}

				if ( 'Twitter' === $selectFeed ) {
					$TwRT   = ! empty( $AllVmData['TWRetweet'] ) ? $AllVmData['TWRetweet'] : 0;
					$TWLike = ! empty( $AllVmData['TWLike'] ) ? $AllVmData['TWLike'] : 0;

					$TwReplyURL   = ! empty( $AllVmData['TwReplyURL'] ) ? $AllVmData['TwReplyURL'] : '';
					$TwRetweetURL = ! empty( $AllVmData['TwRetweetURL'] ) ? $AllVmData['TwRetweetURL'] : '';
					$TwlikeURL    = ! empty( $AllVmData['TwlikeURL'] ) ? $AllVmData['TwlikeURL'] : '';
					$TwtweetURL   = ! empty( $AllVmData['TwtweetURL'] ) ? $AllVmData['TwtweetURL'] : '';
				}

				if ( 'Vimeo' === $selectFeed ) {
					$share   = ! empty( $AllVmData['share'] ) ? $AllVmData['share'] : 0;
					$likes   = ! empty( $AllVmData['likes'] ) ? $AllVmData['likes'] : 0;
					$comment = ! empty( $AllVmData['comment'] ) ? $AllVmData['comment'] : 0;
				}

				if ( 'Youtube' === $selectFeed ) {
					$view    = ! empty( $AllVmData['view'] ) ? $AllVmData['view'] : 0;
					$likes   = ! empty( $AllVmData['likes'] ) ? $AllVmData['likes'] : 0;
					$comment = ! empty( $AllVmData['comment'] ) ? $AllVmData['comment'] : 0;
					$Dislike = ! empty( $AllVmData['Dislike'] ) ? $AllVmData['Dislike'] : 0;
				}

				$ImageURL = '';
				$videoURL = '';
				if ( ( 'video' === $Type || 'photo' === $Type ) && 'Instagram' !== $selectFeed ) {
					$videoURL = $PostLink;
					$ImageURL = $PostImage;
				}

				$IGGP_Icon = '';
				if ( 'Instagram' === $selectFeed ) {
					$IGGP_Type = ! empty( $AllVmData['IG_Type'] ) ? $AllVmData['IG_Type'] : 'Instagram_Basic';
					if ( 'Instagram_Graph' === $IGGP_Type ) {
						$IGGP_Icon = ! empty( $AllVmData['IGGP_Icon'] ) ? $AllVmData['IGGP_Icon'] : '';
						$likes     = ! empty( $AllVmData['likes'] ) ? $AllVmData['likes'] : 0;
						$comment   = ! empty( $AllVmData['comment'] ) ? $AllVmData['comment'] : 0;
						$videoURL  = $PostLink;
						$PostLink  = ! empty( $AllVmData['IGGP_PostLink'] ) ? $AllVmData['IGGP_PostLink'] : '';
						$ImageURL  = $PostImage;

						$IGGP_CAROUSEL = ! empty( $AllVmData['IGGP_CAROUSEL'] ) ? $AllVmData['IGGP_CAROUSEL'] : '';
						if ( 'CAROUSEL_ALBUM' === $Type && 'default' === $FancyStyle ) {
							$FancyBoxJS = 'data-fancybox=' . esc_attr( "IGGP-CAROUSEL-{$F_index}-{$uniqEach}" );
						} else {
							$FancyBoxJS = 'data-fancybox=' . esc_attr( $uid_sfeed );
						}
					} elseif ( 'Instagram_Basic' === $IGGP_Type ) {
						$videoURL = $PostLink;
						$ImageURL = $PostImage;
					}
				}

				if ( ! empty( $FbAlbum ) ) {
					$PostLink = ! empty( $PostLink[0]['link'] ) ? $PostLink[0]['link'] : 0;
				}

				if ( ( $F_index < $TotalPost ) && ( ( 'default' === $MediaFilter ) || ( 'ompost' === $MediaFilter && ! empty( $PostLink ) && ! empty( $PostImage ) ) || ( 'hmcontent' === $MediaFilter && empty( $PostLink ) && empty( $PostImage ) ) ) ) {
					$output .= '<div class="grid-item ' . esc_attr( 'feed-' . $selectFeed . ' ' . $desktop_class . ' ' . $tablet_class . ' ' . $mobile_class . ' ' . $RKey . ' ' . $category_filter ) . '" data-index="' . esc_attr( $selectFeed . $F_index ) . '" >';
						ob_start();
							include THEPLUS_WSTYLES . 'social-feed/social-feed-' . sanitize_file_name( $style ) . '.php';
							$output .= ob_get_contents();
						ob_end_clean();
					$output .= '</div>';
				}
			}
				$output .= '</div>';

			if ( ! empty( $totalFeed ) && $totalFeed > $Postdisplay ) {
				if ( 'load_more' === $postLodop && 'carousel' !== $layout ) {

					$output .= '<div class="ajax_load_more">';

						$output .= '<a class="post-load-more" data-loadingtxt="' . esc_attr( $loadingtxt ) . '" data-layout="' . esc_attr( $layout ) . '"  data-loadclass="' . esc_attr( $uid_sfeed ) . '" data-loadview="' . esc_attr( $postview ) . '" data-loadattr= \'' . $data_loadkey . '\'>';

							$output .= $loadbtnText;

						$output .= '</a>';

					$output .= '</div>';
				} elseif ( 'lazy_load' === $postLodop && 'carousel' !== $layout ) {
					$output .= '<div class="ajax_lazy_load">';

						$output .= '<a class="post-lazy-load" data-loadingtxt="' . esc_attr( $loadingtxt ) . '" data-lazylayout="' . esc_attr( $layout ) . '" data-lazyclass="' . esc_attr( $uid_sfeed ) . '" data-lazyview="' . esc_attr( $postview ) . '" data-lazyattr= \'' . $data_loadkey . '\'>';

							$output .= '<div class="tp-spin-ring"><div></div><div></div><div></div></div>';

						$output .= '</a>';

					$output .= '</div>';
				}
			}
		} else {
			$output .= '<div class="error-handal">' . esc_html__( 'All Social Feed', 'theplus' ) . '</div>';
		}

		$output .= '</div>';

		echo $output;
	}

	/**
	 * Get Facebook video feed based on provided settings.
	 *
	 * @since 1.0.0
	 *
	 * @param array $social Facebook social media settings.
	 *
	 * @return array Fetched Facebook video feed data.
	 */
	protected function FacebookFeed( $social ) {
		$settings   = $this->get_settings_for_display();
		$BaseURL    = 'https://graph.facebook.com/v11.0';
		$FbKey      = ! empty( $social['_id'] ) ? $social['_id'] : '';
		$FbAcT      = ! empty( $social['RAToken'] ) ? $social['RAToken'] : '';
		$FbPType    = ! empty( $social['ProfileType'] ) ? $social['ProfileType'] : 'post';
		$FbPageid   = ! empty( $social['Pageid'] ) ? $social['Pageid'] : '';
		$FbAlbum    = ( ! empty( $social['fbAlbum'] ) && 'yes' === $social['fbAlbum'] ) ? true : false;
		$FbLimit    = ! empty( $social['MaxR'] ) ? $social['MaxR'] : 6;
		$FbALimit   = ! empty( $social['AlbumMaxR'] ) ? $social['AlbumMaxR'] : 6;
		$Fbcontent  = ! empty( $social['content'] ) ? $social['content'] : array();
		$FbTime     = ! empty( $social['TimeFrq'] ) ? $social['TimeFrq'] : '3600';
		$FbCategory = ! empty( $social['RCategory'] ) ? $social['RCategory'] : '';

		$FbselectFeed = ! empty( $social['selectFeed'] ) ? $social['selectFeed'] : '';

		$FbIcon = 'fab fa-facebook social-logo-fb';

		$content = array();
		if ( ! empty( $Fbcontent ) && ( is_array( $Fbcontent ) || is_object( $Fbcontent ) ) ) {
			foreach ( $Fbcontent as $Data ) {
				$Filter = ( ! empty( $Data ) ) ? $Data : 'photo';
				array_push( $content, $Filter );
			}
		} else {
			array_push( $content, 'photo' );
		}

		$url       = '';
		$FbAllData = '';

		$FbArr = array();
		if ( ! empty( $FbAcT ) && 'post' === $FbPType ) {
			$url = "{$BaseURL}/me?fields=id,name,first_name,last_name,link,email,birthday,picture,posts.limit($FbLimit){type,message,story,caption,description,shares,picture,full_picture,source,created_time,reactions.summary(true),comments.summary(true).filter(toplevel)},albums.limit($FbLimit){id,type,link,picture,created_time,name,count,photos.limit($FbALimit){id,link,created_time,likes,images,name,comments.summary(true).filter(toplevel)}}&access_token={$FbAcT}";
		} elseif ( ! empty( $FbAcT ) && ! empty( $FbPageid ) && 'page' === $FbPType ) {
			$url = "{$BaseURL}/{$FbPageid}?fields=id,name,username,link,fan_count,new_like_count,phone,emails,about,birthday,category,picture,posts.limit($FbLimit){id,full_picture,created_time,message,attachments{media,media_type,title,url},picture,story,status_type,shares,reactions.summary(true),likes.summary(true),comments.summary(true).filter(toplevel)},albums.limit($FbLimit){id,type,link,picture,created_time,name,count,photos.limit($FbALimit){id,link,created_time,images,name}}&access_token={$FbAcT}";
		}

		if ( ! empty( $url ) ) {
			$GetFbRL   = get_transient( "Fb-Url-$FbKey" );
			$GetFbTime = get_transient( "Fb-Time-$FbKey" );

			if ( $GetFbRL != $url || $GetFbTime != $FbTime ) {
				$FbAllData = $this->tp_api_call( $url );

				set_transient( "Fb-Url-$FbKey", $url, $FbTime );
				set_transient( "Data-Fb-$FbKey", $FbAllData, $FbTime );
				set_transient( "Fb-Time-$FbKey", $FbTime, $FbTime );
			} else {
				$FbAllData = get_transient( "Data-Fb-$FbKey" );
			}

			$status = ! empty( $FbAllData['HTTP_CODE'] ) ? $FbAllData['HTTP_CODE'] : '';
			if ( $status == 200 ) {
				$FbPost = '';
				if ( ! empty( $FbAlbum ) ) {
					$FbPost = ( ! empty( $FbAllData['albums']['data'] ) ) ? $FbAllData['albums']['data'] : array();
				} else {
					$FbPost = ( ! empty( $FbAllData['posts']['data'] ) ) ? $FbAllData['posts']['data'] : array();
				}
				foreach ( $FbPost as $index => $FbData ) {
					$id           = ! empty( $FbData['id'] ) ? $FbData['id'] : '';
					$link         = ! empty( $FbAllData['link'] ) ? $FbAllData['link'] : '';
					$type         = ! empty( $FbData['type'] ) ? $FbData['type'] : '';
					$name         = ! empty( $FbAllData['name'] ) ? $FbAllData['name'] : '';
					$FbMessage    = ! empty( $FbData['message'] ) ? $FbData['message'] : '';
					$FbPicture    = $FbSource = ! empty( $FbData['full_picture'] ) ? $FbData['full_picture'] : '';
					$Created_time = ! empty( $FbData['created_time'] ) ? $this->feed_Post_time( $FbData['created_time'] ) : '';
					$FbReactions  = ! empty( $FbData['reactions']['summary']['total_count'] ) ? $this->tp_number_short( $FbData['reactions']['summary']['total_count'] ) : 0;
					$FbComments   = ! empty( $FbData['comments']['summary']['total_count'] ) ? $this->tp_number_short( $FbData['comments']['summary']['total_count'] ) : 0;
					$Fbshares     = ! empty( $FbData['shares']['count'] ) ? $this->tp_number_short( $FbData['shares']['count'] ) : '';

					if ( 'video' === $type ) {
						$FbSource = ! empty( $FbData['source'] ) ? $FbData['source'] : '';
					}

					$FbCaption     = ! empty( $FbData['caption'] ) ? $FbData['caption'] : '';
					$FbDescription = ! empty( $FbData['description'] ) ? $FbData['description'] : '';

					if ( 'page' === $FbPType ) {
						$type = ! empty( $FbData['attachments']['data'][0]['media_type'] ) ? $FbData['attachments']['data'][0]['media_type'] : '';
						if ( 'album' === $type ) {
							$type = 'photo';
						}

						if ( 'video' === $type ) {
							if ( ! empty( $FbData['attachments']['data'][0]['media']['source'] ) ) {
								$FbSource = $FbData['attachments']['data'][0]['media']['source'];
							} elseif ( ! empty( $FbData['attachments']['data'][0]['url'] ) ) {
								$FbSource = 'https://www.facebook.com/plugins/video.php?href=' . $FbData['attachments']['data'][0]['url'];
							} else {
								$FbSource = '';
							}
						}
					}
					if ( 'video' === $type ) {
						$FbSource = str_replace( 'autoplay=1', 'autoplay=0', $FbSource );
					}

					if ( ! empty( $FbAlbum ) ) {
						$type = 'video';
						$link = ! empty( $FbData['link'] ) ? $FbData['link'] : '';

						$FbMessage = ! empty( $FbData['name'] ) ? $FbData['name'] : '';
						$Fbcount   = ! empty( $FbData['count'] ) ? $FbData['count'] : '';
						$FbPicture = ! empty( $FbData['picture']['data']['url'] ) ? $FbData['picture']['data']['url'] : '';
						$FbSource  = ! empty( $FbData['photos']['data'] ) ? $FbData['photos']['data'] : array();
					}

					if ( ( in_array( 'photo', $content ) && 'photo' === $type ) || ( in_array( 'video', $content ) && 'video' === $type ) || ( in_array( 'status', $content ) && ( 'status' === $type || 'link' === $type ) ) ) {
						$FbArr[] = array(
							'Feed_Index'     => $index,
							'PostId'         => $id,
							'Massage'        => '',
							'Description'    => $FbMessage . $FbCaption . $FbDescription,
							'Type'           => 'video',
							'PostLink'       => $FbSource,
							'CreatedTime'    => $Created_time,
							'PostImage'      => $FbPicture,
							'UserName'       => $name,
							'UserImage'      => ( ! empty( $FbAllData['picture']['data']['url'] ) ? $FbAllData['picture']['data']['url'] : '' ),
							'UserLink'       => $link,
							'share'          => $Fbshares,
							'comment'        => $FbComments,
							'FbLikes'        => $FbReactions,
							'Embed'          => 'Alb',
							'EmbedType'      => $type,
							'FbAlbum'        => $FbAlbum,
							'socialIcon'     => $FbIcon,
							'selectFeed'     => $FbselectFeed,
							'FilterCategory' => $FbCategory,
							'RKey'           => "tp-repeater-item-$FbKey",
						);
					}
				}
			} else {
				$FbArr[] = $this->SF_Error_handler( $FbAllData, $FbKey, $FbCategory, $FbselectFeed, $FbIcon );
			}
		} else {
			$Msg = '';
			if ( empty( $FbAcT ) ) {
				$Msg .= 'Empty Access Token </br>';
			}

			if ( $FbPType == 'page' && empty( $FbPageid ) ) {
				$Msg .= 'Empty Page ID';
			}

			$ErrorData['error']['message'] = $Msg;

			$FbArr[] = $this->SF_Error_handler( $ErrorData, $FbKey, $FbCategory, $FbselectFeed, $FbIcon );
		}

		return $FbArr;
	}

	/**
	 * Get Instagram video feed based on provided settings.
	 *
	 * @since 1.0.0
	 *
	 * @param array $social Instagram social media settings.
	 *
	 * @return array Fetched Instagram video feed data.
	 */
	protected function InstagramFeed( $social ) {
		$IGKey       = ! empty( $social['_id'] ) ? $social['_id'] : '';
		$IGAcT       = ! empty( $social['RAToken'] ) ? $social['RAToken'] : '';
		$Profile     = ( ! empty( $social['IGImgPic'] ) && ! empty( $social['IGImgPic']['url'] ) ) ? $social['IGImgPic']['url'] : '';
		$TimeFrq     = ! empty( $social['TimeFrq'] ) ? $social['TimeFrq'] : '3600';
		$IGType      = ! empty( $social['InstagramType'] ) ? $social['InstagramType'] : 'Instagram_Basic';
		$HashtagType = ! empty( $social['IG_hashtagType'] ) ? $social['IG_hashtagType'] : 'top_media';
		$RCategory   = ! empty( $social['RCategory'] ) ? $social['RCategory'] : '';
		$selectFeed  = ! empty( $social['selectFeed'] ) ? $social['selectFeed'] : '';
		$Default_Img = THEPLUS_ASSETS_URL . 'images/tp-placeholder.jpg';
		$IGIcon      = 'fab fa-instagram social-logo-fb';
		$IGcount     = ! empty( $social['MaxR'] ) ? $social['MaxR'] : 6;

		$IGArr = array();
		if ( 'Instagram_Basic' === $IGType ) {
			$IGAPI      = "https://graph.instagram.com/me/?fields=account_type,id,media_count,username,media.limit($IGcount){id,caption,permalink,thumbnail_url,timestamp,username,media_type,media_url}&access_token={$IGAcT}";
			$GetURL     = get_transient( "IG-Url-$IGKey" );
			$GetTime    = get_transient( "IG-Time-$IGKey" );
			$GetProfile = get_transient( "IG-Profile-$IGKey" );

			$IGData = array();
			if ( $GetURL !== $IGAPI || $GetProfile !== $Profile || $GetTime !== $TimeFrq ) {
				$IGData = $this->tp_api_call( $IGAPI );
					set_transient( "IG-Url-$IGKey", $IGAPI, $TimeFrq );
					set_transient( "Data-IG-$IGKey", $IGData, $TimeFrq );
					set_transient( "IG-Profile-$IGKey", $Profile, $TimeFrq );
					set_transient( "IG-Time-$IGKey", $TimeFrq, $TimeFrq );
			} else {
				$IGData = get_transient( "Data-IG-$IGKey" );
			}

			$IGStatus = ! empty( $IGData['HTTP_CODE'] ) ? $IGData['HTTP_CODE'] : 400;
			if ( $IGStatus == 200 ) {
				$posts = ( ! empty( $IGData['media'] ) && ! empty( $IGData['media']['data'] ) ) ? $IGData['media']['data'] : array();
				foreach ( $posts as $index => $IGPost ) {
					$media_type = ! empty( $IGPost['media_type'] ) ? $IGPost['media_type'] : '';

					if ( $media_type === 'IMAGE' ) {
						$type = 'photo';
					}

					$PostImage = '';
					if ( ! empty( $IGPost['media_url'] ) && 'VIDEO' === $IGPost['media_type'] ) {
						$PostImage = ! empty( $IGPost['thumbnail_url'] ) ? $IGPost['thumbnail_url'] : $Default_Img;
					} elseif ( ! empty( $IGPost['media_url'] ) ) {
						$PostImage = $IGPost['media_url'];
					}

					$IGArr[] = array(
						'Feed_Index'     => $index,
						'PostId'         => ! empty( $IGPost['id'] ) ? $IGPost['id'] : '',
						'Massage'        => '',
						'Description'    => ! empty( $IGPost['caption'] ) ? $IGPost['caption'] : '',
						'Type'           => 'video',
						'PostLink'       => ! empty( $IGPost['media_url'] ) ? $IGPost['media_url'] : '',
						'CreatedTime'    => ! empty( $IGPost['timestamp'] ) ? $this->feed_Post_time( $IGPost['timestamp'] ) : '',
						'PostImage'      => $PostImage,
						'UserName'       => ! empty( $IGData['username'] ) ? $IGData['username'] : '',
						'UserImage'      => $Profile,
						'UserLink'       => ! empty( $IGPost['permalink'] ) ? $IGPost['permalink'] : '',
						'IG_Type'        => $IGType,
						'socialIcon'     => $IGIcon,
						'selectFeed'     => $selectFeed,
						'FilterCategory' => $RCategory,
						'RKey'           => "tp-repeater-item-$IGKey",
					);
				}
			} else {
				if ( empty( $IGAcT ) ) {
					$IGData['error']['message'] = 'Enter Access Token';
				}

				$IGArr[] = $this->SF_Error_handler( $IGData, $IGKey, $RCategory, $selectFeed, $IGIcon );
			}
		} elseif ( 'Instagram_Graph' === $IGType ) {
			$BashURL    = 'https://graph.facebook.com/v11.0';
			$IGPageId   = ! empty( $social['IGPageId'] ) ? $social['IGPageId'] : '';
			$IGFeedType = ! empty( $social['IG_FeedTypeGp'] ) ? $social['IG_FeedTypeGp'] : 'IGUserdata';
			$IGGPcount  = ( $IGcount > 49 ) ? $IGcount : $IGcount * 6;

			$UserID_API = "{$BashURL}/{$IGPageId}?fields=instagram_business_account{id,profile_picture_url,username,ig_id,media_count}&access_token={$IGAcT}";
			$GetURL     = get_transient( "IG-GP-Url-$IGKey" );
			$GetTime    = get_transient( "IG-GP-Time-$IGKey" );
			$UserID_Res = array();
			if ( ( $GetURL != $UserID_API ) || ( $GetTime != $TimeFrq ) ) {
				$UserID_Res = $this->tp_api_call( $UserID_API );
					set_transient( "IG-GP-Url-$IGKey", $UserID_API, $TimeFrq );
					set_transient( "IG-GP-Time-$IGKey", $TimeFrq, $TimeFrq );
					set_transient( "IG-GP-Data-$IGKey", $UserID_Res, $TimeFrq );
			} else {
				$UserID_Res = get_transient( "IG-GP-Data-$IGKey" );
			}

			$UserID_CODE = ! empty( $UserID_Res['HTTP_CODE'] ) ? $UserID_Res['HTTP_CODE'] : 400;
			if ( $UserID_CODE == 200 ) {
				$GET_UserID      = ! empty( $UserID_Res['instagram_business_account'] ) ? $UserID_Res['instagram_business_account']['id'] : '';
				$GET_UserName    = ! empty( $UserID_Res['instagram_business_account']['username'] ) ? $UserID_Res['instagram_business_account']['username'] : '';
				$GET_Profile     = ! empty( $UserID_Res['instagram_business_account']['profile_picture_url'] ) ? $UserID_Res['instagram_business_account']['profile_picture_url'] : $Default_Img;
				$IGGP_CountFiler = 0;

				if ( 'IGUserdata' === $IGFeedType ) {
					$IGUserName   = ! empty( $social['IGUserName_GP'] ) ? $social['IGUserName_GP'] : $GET_UserName;
					$UserPost_API = "{$BashURL}/{$GET_UserID}?fields=business_discovery.username({$IGUserName}){username,profile_picture_url,followers_count,media_count,media.limit({$IGGPcount}){permalink,media_type,media_url,like_count,comments_count,timestamp,caption,id,media_product_type,children{media_url,permalink,media_type}}}&access_token={$IGAcT}";

					$UserPost_Databash = get_transient( "IG-GP-UserFeed-Url-$IGKey" );
					$UserPost_Res      = array();
					if ( $UserPost_Databash != $UserPost_API || $GetTime != $TimeFrq ) {
						$UserPost_Res = $this->tp_api_call( $UserPost_API );
							set_transient( "IG-GP-UserFeed-Url-$IGKey", $UserPost_API, $TimeFrq );
							set_transient( "IG-GP-UserFeed-Data-$IGKey", $UserPost_Res, $TimeFrq );
					} else {
						$UserPost_Res = get_transient( "IG-GP-UserFeed-Data-$IGKey" );
					}

					$UserPost_CODE = ! empty( $UserPost_Res['HTTP_CODE'] ) ? $UserPost_Res['HTTP_CODE'] : 400;
					if ( $UserPost_CODE == 200 ) {
						$GET_Profile = ! empty( $UserPost_Res['business_discovery']['profile_picture_url'] ) ? $UserPost_Res['business_discovery']['profile_picture_url'] : $GET_Profile;

						$BD = ! empty( $UserPost_Res['business_discovery']['media'] ) ? $UserPost_Res['business_discovery']['media']['data'] : array();

						foreach ( $BD as $index => $IGGA ) {
							$Permalink = ! empty( $IGGA['permalink'] ) ? $IGGA['permalink'] : '';

							$PostImage = '';
							if ( ! empty( $IGGA['media_url'] ) && 'VIDEO' === $IGGA['media_type'] ) {
								$PostImage = THEPLUS_ASSETS_URL . 'images/placeholder-grid.jpg';
							} elseif ( ! empty( $IGGA['media_url'] ) ) {
								$PostImage = $IGGA['media_url'];
							}

							$IGGP_Icon  = '';
							$Media_type = ! empty( $IGGA['media_type'] ) ? $IGGA['media_type'] : '';
							if ( 'IMAGE' === $Media_type ) {
							} elseif ( 'VIDEO' === $Media_type ) {
								$IGGP_Icon = '<svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="video" class="svg-inline--fa fa-video fa-w-18 IGGP_video" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M525.6 410.2L416 334.7V177.3l109.6-75.6c21.3-14.6 50.4.4 50.4 25.8v256.9c0 25.5-29.2 40.4-50.4 25.8z" opacity="0.4"></path><path class="fa-primary" fill="currentColor" d="M0 400.2V111.8A47.8 47.8 0 0 1 47.8 64h288.4a47.8 47.8 0 0 1 47.8 47.8v288.4a47.8 47.8 0 0 1-47.8 47.8H47.8A47.8 47.8 0 0 1 0 400.2z"></path></g></svg>';
							} elseif ( 'CAROUSEL_ALBUM' === $Media_type ) {
								$IGGP_Icon = '<svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="clone" class="svg-inline--fa fa-clone fa-w-16 IGGP_Multiple" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M48 512a48 48 0 0 1-48-48V176a48 48 0 0 1 48-48h48v208a80.09 80.09 0 0 0 80 80h208v48a48 48 0 0 1-48 48H48z" opacity="0.4"></path><path class="fa-primary" fill="currentColor" d="M512 48v288a48 48 0 0 1-48 48H176a48 48 0 0 1-48-48V48a48 48 0 0 1 48-48h288a48 48 0 0 1 48 48z"></path></g></svg>';
							}

							$CAROUSEL_ALBUM      = ! empty( $IGGA['children'] ) ? $IGGA['children']['data'] : array();
							$IGGP_CAROUSEL_ALBUM = array();
							foreach ( $CAROUSEL_ALBUM as $key => $IGGP ) {
								$IGGP_MediaType = ! empty( $IGGP['media_type'] ) ? $IGGP['media_type'] : 'IMAGE';
								$IGGP_MediaURl  = ! empty( $IGGP['media_url'] ) ? $IGGP['media_url'] : '';

								if ( $key == 0 && 'VIDEO' === $IGGP_MediaType ) {
									foreach ( $CAROUSEL_ALBUM as $thumb_i => $IGGP_Thumb ) {
										$IGGP_ThumbImg = ! empty( $IGGP_Thumb['media_type'] ) ? $IGGP_Thumb['media_type'] : 'IMAGE';
										if ( 'IMAGE' === $IGGP_ThumbImg ) {
											$PostImage = ! empty( $IGGP_Thumb['media_url'] ) ? $IGGP_Thumb['media_url'] : '';
											break;
										}
									}
								}

								if ( 'IMAGE' === $IGGP_MediaType ) {
									$IGGP_CAROUSEL_ALBUM[] = array(
										'IGGPCAR_Index' => $index,
										'IGGPImg_Type'  => $IGGP_MediaType,
										'IGGPURL_Media' => $IGGP_MediaURl,
									);
								}
							}

							if ( 'VIDEO' !== $Media_type && $IGGP_CountFiler < $IGcount ) {
								$IGArr[] = array(
									'Feed_Index'     => $index,
									'PostId'         => ! empty( $IGGA['id'] ) ? $IGGA['id'] : '',
									'Massage'        => '',
									'Description'    => ! empty( $IGGA['caption'] ) ? $IGGA['caption'] : '',
									'Type'           => $Media_type,
									'PostLink'       => ! empty( $IGGA['media_url'] ) ? $IGGA['media_url'] : '',
									'CreatedTime'    => ! empty( $IGGA['timestamp'] ) ? $this->feed_Post_time( $IGGA['timestamp'] ) : '',
									'PostImage'      => $PostImage,
									'UserName'       => $IGUserName,
									'UserImage'      => ! empty( $GET_Profile ) ? $GET_Profile : $Default_Img,
									'UserLink'       => "https://www.instagram.com/{$IGUserName}",
									'comment'        => ! empty( $IGGA['comments_count'] ) ? $this->tp_number_short( $IGGA['comments_count'] ) : 0,
									'likes'          => ! empty( $IGGA['like_count'] ) ? $this->tp_number_short( $IGGA['like_count'] ) : 0,
									'IGGP_PostLink'  => $Permalink,
									'IG_Type'        => $IGType,
									'IGGP_Icon'      => $IGGP_Icon,
									'IGGP_CAROUSEL'  => $IGGP_CAROUSEL_ALBUM,
									'socialIcon'     => $IGIcon,
									'selectFeed'     => $selectFeed,
									'FilterCategory' => $RCategory,
									'RKey'           => "tp-repeater-item-$IGKey",
								);
								++$IGGP_CountFiler;
							}
						}
					} else {
						$IGArr[] = $this->SF_Error_handler( $UserPost_Res, $IGKey, $RCategory, $selectFeed, $IGIcon );
					}
				} elseif ( 'IGHashtag' === $IGFeedType ) {
					$HashtagName = ! empty( $social['IGHashtagName_GP'] ) ? $social['IGHashtagName_GP'] : 'words';

					$HashtagID_API    = "{$BashURL}/ig_hashtag_search?user_id={$GET_UserID}&q={$HashtagName}&access_token={$IGAcT}";
					$Hashtag_Databash = get_transient( "IG-GP-HashtagID-Url-$IGKey" );
					$Hashtag_Res      = array();
					if ( $Hashtag_Databash != $HashtagID_API || $GetTime != $TimeFrq ) {
						$Hashtag_Res = $this->tp_api_call( $HashtagID_API );
							set_transient( "IG-GP-HashtagID-Url-$IGKey", $HashtagID_API, $TimeFrq );
							set_transient( "IG-GP-HashtagID-data-$IGKey", $Hashtag_Res, $TimeFrq );
					} else {
						$Hashtag_Res = get_transient( "IG-GP-HashtagID-data-$IGKey" );
					}

					$Hashtag_CODE = ! empty( $Hashtag_Res['HTTP_CODE'] ) ? $Hashtag_Res['HTTP_CODE'] : 400;
					if ( $Hashtag_CODE == 200 ) {
						$Hashtag_GetID = ! empty( $Hashtag_Res['data'][0]['id'] ) ? $Hashtag_Res['data'][0]['id'] : '';

						$Hashtag_Data          = "{$BashURL}/{$Hashtag_GetID}/{$HashtagType}?user_id={$GET_UserID}&fields=id,media_type,media_url,comments_count,like_count,caption,permalink,timestamp,children{media_url,permalink,media_type}&limit=50&access_token={$IGAcT}";
						$Hashtag_Data_Databash = get_transient( "IG-GP-HashtagData-Url-$IGKey" );
						$Hashtag_Data_Res      = array();
						if ( $Hashtag_Data_Databash != $Hashtag_Data || $GetTime != $TimeFrq ) {
							$Hashtag_Data_Res = $this->tp_api_call( $Hashtag_Data );
								set_transient( "IG-GP-HashtagData-Url-$IGKey", $Hashtag_Data, $TimeFrq );
								set_transient( "IG-GP-Hashtag-Data-$IGKey", $Hashtag_Data_Res, $TimeFrq );
						} else {
							$Hashtag_Data_Res = get_transient( "IG-GP-Hashtag-Data-$IGKey" );
						}

						$Hashtag_Data_CODE = ! empty( $Hashtag_Data_Res['HTTP_CODE'] ) ? $Hashtag_Data_Res['HTTP_CODE'] : 400;
						if ( $Hashtag_Data_CODE == 200 ) {

							$HashtagData = ! empty( $Hashtag_Data_Res['data'] ) ? $Hashtag_Data_Res['data'] : array();
							foreach ( $HashtagData as $index => $IGHash ) {
								$media_url = ! empty( $IGHash['media_url'] ) ? $IGHash['media_url'] : '';
								$permalink = ! empty( $IGHash['permalink'] ) ? $IGHash['permalink'] : '';

								$IGGP_Icon  = $PostImage = '';
								$Media_type = ! empty( $IGHash['media_type'] ) ? $IGHash['media_type'] : '';
								if ( 'IMAGE' === $Media_type ) {
									$PostImage = $media_url;
								} elseif ( 'VIDEO' === $Media_type ) {
									$IGGP_Icon = '<svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="video" class="svg-inline--fa fa-video fa-w-18 IGGP_video" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M525.6 410.2L416 334.7V177.3l109.6-75.6c21.3-14.6 50.4.4 50.4 25.8v256.9c0 25.5-29.2 40.4-50.4 25.8z" opacity="0.4"></path><path class="fa-primary" fill="currentColor" d="M0 400.2V111.8A47.8 47.8 0 0 1 47.8 64h288.4a47.8 47.8 0 0 1 47.8 47.8v288.4a47.8 47.8 0 0 1-47.8 47.8H47.8A47.8 47.8 0 0 1 0 400.2z"></path></g></svg>';
									$PostImage = $media_url;
								} elseif ( 'CAROUSEL_ALBUM' === $Media_type ) {
									$IGGP_Icon = '<svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="clone" class="svg-inline--fa fa-clone fa-w-16 IGGP_Multiple" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M48 512a48 48 0 0 1-48-48V176a48 48 0 0 1 48-48h48v208a80.09 80.09 0 0 0 80 80h208v48a48 48 0 0 1-48 48H48z" opacity="0.4"></path><path class="fa-primary" fill="currentColor" d="M512 48v288a48 48 0 0 1-48 48H176a48 48 0 0 1-48-48V48a48 48 0 0 1 48-48h288a48 48 0 0 1 48 48z"></path></g></svg>';
									$PostImage = ! empty( $IGHash['children']['data'][0]['media_url'] ) ? $IGHash['children']['data'][0]['media_url'] : '';
								}

								$CAROUSEL_ALBUM      = ! empty( $IGHash['children'] ) ? $IGHash['children']['data'] : array();
								$IGGP_CAROUSEL_ALBUM = array();
								foreach ( $CAROUSEL_ALBUM as $key => $IGGP ) {
									$IGGP_MediaType = ! empty( $IGGP['media_type'] ) ? $IGGP['media_type'] : 'IMAGE';
									$IGGP_MediaURl  = ! empty( $IGGP['media_url'] ) ? $IGGP['media_url'] : '';

									if ( $key == 0 && $IGGP_MediaType == 'VIDEO' ) {
										foreach ( $CAROUSEL_ALBUM as $thumb_i => $IGGP_Thumb ) {
											$IGGP_ThumbImg = ! empty( $IGGP_Thumb['media_type'] ) ? $IGGP_Thumb['media_type'] : 'IMAGE';
											if ( $IGGP_ThumbImg == 'IMAGE' ) {
												$PostImage = ! empty( $IGGP_Thumb['media_url'] ) ? $IGGP_Thumb['media_url'] : '';
												break;
											}
										}
									}

									if ( 'IMAGE' === $IGGP_MediaType ) {
										$IGGP_CAROUSEL_ALBUM[] = array(
											'IGGPCAR_Index' => $index,
											'IGGPImg_Type' => $IGGP_MediaType,
											'IGGPURL_Media' => $IGGP_MediaURl,
										);
									}
								}

								if ( 'VIDEO' !== $Media_type && $IGGP_CountFiler < $IGcount ) {
									$IGArr[] = array(
										'Feed_Index'     => $index,
										'PostId'         => ! empty( $IGHash['id'] ) ? $IGHash['id'] : '',
										'Massage'        => '',
										'Description'    => ! empty( $IGHash['caption'] ) ? $IGHash['caption'] : '',
										'Type'           => $Media_type,
										'PostLink'       => $media_url,
										'PostImage'      => $PostImage,
										'CreatedTime'    => ! empty( $IGHash['timestamp'] ) ? $this->feed_Post_time( $IGHash['timestamp'] ) : '',
										'UserLink'       => $permalink,
										'comment'        => ! empty( $IGHash['comments_count'] ) ? $this->tp_number_short( $IGHash['comments_count'] ) : 0,
										'likes'          => ! empty( $IGHash['like_count'] ) ? $this->tp_number_short( $IGHash['like_count'] ) : 0,
										'IG_Type'        => $IGType,
										'IGGP_Icon'      => $IGGP_Icon,
										'IGGP_CAROUSEL'  => $IGGP_CAROUSEL_ALBUM,
										'IGGP_PostLink'  => $permalink,
										'socialIcon'     => $IGIcon,
										'selectFeed'     => $selectFeed,
										'FilterCategory' => $RCategory,
										'RKey'           => "tp-repeater-item-$IGKey",
									);
									++$IGGP_CountFiler;
								}
							}
						} else {
							$IGArr[] = $this->SF_Error_handler( $Hashtag_Data_Res, $IGKey, $RCategory, $selectFeed );
						}
					} else {
						$IGArr[] = $this->SF_Error_handler( $Hashtag_Res, $IGKey, $RCategory, $selectFeed, $IGIcon );
					}
				} elseif ( 'IGTag' === $IGFeedType ) {
					$Tag_API = "{$BashURL}/{$GET_UserID}/tags?fields=id,username,media_type,media_url,like_count,caption,timestamp,permalink,comments_count,media_product_type,children{media_url,permalink,media_type}&limit={$IGGPcount}&access_token={$IGAcT}";

					$Tag_Databash = get_transient( "IG-GP-Tag-Url-$IGKey" );
					$Tag_Res      = array();
					if ( $Tag_Databash != $Tag_API || $GetTime != $TimeFrq ) {
						$Tag_Res = $this->tp_api_call( $Tag_API );
							set_transient( "IG-GP-Tag-Url-$IGKey", $Tag_API, $TimeFrq );
							set_transient( "IG-GP-Tag-Data-$IGKey", $Tag_Res, $TimeFrq );
					} else {
						$Tag_Res = get_transient( "IG-GP-Tag-Data-$IGKey" );
					}

					$Tag_CODE = ! empty( $Tag_Res['HTTP_CODE'] ) ? $Tag_Res['HTTP_CODE'] : 400;
					$Tag_Data = ! empty( $Tag_Res['data'] ) ? $Tag_Res['data'] : array();
					if ( $Tag_CODE == 200 && ! empty( $Tag_Data ) ) {
						foreach ( $Tag_Data as $index => $Tag ) {
							$CAROUSEL_ALBUM = ! empty( $Tag['children'] ) ? $Tag['children']['data'] : array();
							$Permalink      = ! empty( $Tag['permalink'] ) ? $Tag['permalink'] : '';
							$Tag_Username   = ! empty( $Tag['username'] ) ? $Tag['username'] : '';

							$IGGP_Icon  = '';
							$Media_type = ! empty( $Tag['media_type'] ) ? $Tag['media_type'] : '';
							if ( 'IMAGE' === $Media_type ) {
							} elseif ( 'VIDEO' === $Media_type ) {
								$IGGP_Icon = '<svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="video" class="svg-inline--fa fa-video fa-w-18 IGGP_video" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M525.6 410.2L416 334.7V177.3l109.6-75.6c21.3-14.6 50.4.4 50.4 25.8v256.9c0 25.5-29.2 40.4-50.4 25.8z" opacity="0.4"></path><path class="fa-primary" fill="currentColor" d="M0 400.2V111.8A47.8 47.8 0 0 1 47.8 64h288.4a47.8 47.8 0 0 1 47.8 47.8v288.4a47.8 47.8 0 0 1-47.8 47.8H47.8A47.8 47.8 0 0 1 0 400.2z"></path></g></svg>';
							} elseif ( 'CAROUSEL_ALBUM' === $Media_type ) {
								$IGGP_Icon = '<svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="clone" class="svg-inline--fa fa-clone fa-w-16 IGGP_Multiple" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M48 512a48 48 0 0 1-48-48V176a48 48 0 0 1 48-48h48v208a80.09 80.09 0 0 0 80 80h208v48a48 48 0 0 1-48 48H48z" opacity="0.4"></path><path class="fa-primary" fill="currentColor" d="M512 48v288a48 48 0 0 1-48 48H176a48 48 0 0 1-48-48V48a48 48 0 0 1 48-48h288a48 48 0 0 1 48 48z"></path></g></svg>';
							}

							$CAROUSEL_ALBUM      = ! empty( $Tag['children'] ) ? $Tag['children']['data'] : array();
							$IGGP_CAROUSEL_ALBUM = array();
							foreach ( $CAROUSEL_ALBUM as $key => $IGGP ) {
								$IGGP_MediaType = ! empty( $IGGP['media_type'] ) ? $IGGP['media_type'] : 'IMAGE';
								$IGGP_MediaURl  = ! empty( $IGGP['media_url'] ) ? $IGGP['media_url'] : '';

								if ( $key == 0 && 'VIDEO' === $IGGP_MediaType ) {
									foreach ( $CAROUSEL_ALBUM as $thumb_i => $IGGP_Thumb ) {
										$IGGP_ThumbImg = ! empty( $IGGP_Thumb['media_type'] ) ? $IGGP_Thumb['media_type'] : 'IMAGE';
										if ( $IGGP_ThumbImg == 'IMAGE' ) {
											$PostImage = ! empty( $IGGP_Thumb['media_url'] ) ? $IGGP_Thumb['media_url'] : $Default_Img;
											break;
										}
									}
								}

								if ( 'IMAGE' === $IGGP_MediaType ) {
									$IGGP_CAROUSEL_ALBUM[] = array(
										'IGGPCAR_Index' => $index,
										'IGGPImg_Type'  => $IGGP_MediaType,
										'IGGPURL_Media' => $IGGP_MediaURl,
									);
								}
							}

							$Taggedby = 'Tagged by <a href="https://www.instagram.com/' . esc_attr( $Tag_Username ) . '" class="tp-mantion" target="_blank" rel="noopener noreferrer"> @' . esc_attr( $Tag_Username ) . '<a>';

							if ( 'VIDEO' !== $Media_type && $IGGP_CountFiler < $IGcount ) {
								$IGArr[] = array(
									'Feed_Index'     => $index,
									'PostId'         => ! empty( $Tag['id'] ) ? $Tag['id'] : '',
									'Massage'        => $Taggedby,
									'Description'    => ! empty( $Tag['caption'] ) ? $Tag['caption'] : '',
									'Type'           => $Media_type,
									'PostLink'       => ! empty( $Tag['media_url'] ) ? $Tag['media_url'] : '',
									'CreatedTime'    => ! empty( $Tag['timestamp'] ) ? $this->feed_Post_time( $Tag['timestamp'] ) : '',
									'PostImage'      => ! empty( $Tag['media_url'] ) ? $Tag['media_url'] : '',
									'UserName'       => $GET_UserName,
									'UserImage'      => $GET_Profile,
									'UserLink'       => $Permalink,
									'comment'        => ! empty( $Tag['comments_count'] ) ? $this->tp_number_short( $Tag['comments_count'] ) : 0,
									'likes'          => ! empty( $Tag['like_count'] ) ? $this->tp_number_short( $Tag['like_count'] ) : 0,
									'IG_Type'        => $IGType,
									'IGGP_Icon'      => $IGGP_Icon,
									'IGGP_CAROUSEL'  => $IGGP_CAROUSEL_ALBUM,
									'IGGP_PostLink'  => $Permalink,
									'socialIcon'     => $IGIcon,
									'selectFeed'     => $selectFeed,
									'FilterCategory' => $RCategory,
									'RKey'           => "tp-repeater-item-$IGKey",
								);
								++$IGGP_CountFiler;
							}
						}
					} else {
						$IGArr[] = $this->SF_Error_handler( $Tag_Res, $IGKey, $RCategory, $selectFeed, $IGIcon );
					}
				}
			} else {
				$IGArr[] = $this->SF_Error_handler( $UserID_Res, $IGKey, $RCategory, $selectFeed, $IGIcon );
			}
		}
		return $IGArr;
	}

	/**
	 * Get Vimeo video feed based on provided settings.
	 *
	 * @since 1.0.0
	 *
	 * @param array $social Vimeo social media settings.
	 *
	 * @return array Fetched Vimeo video feed data.
	 */
	protected function VimeoFeed( $social ) {
		$BaseURL      = 'https://api.vimeo.com';
		$VmKey        = ! empty( $social['_id'] ) ? $social['_id'] : '';
		$VmAcT        = ! empty( $social['RAToken'] ) ? $social['RAToken'] : '';
		$VmType       = ! empty( $social['VimeoType'] ) ? $social['VimeoType'] : 'Vm_User';
		$VmUname      = ! empty( $social['VmUname'] ) ? $social['VmUname'] : '';
		$VmQsearch    = ! empty( $social['VmQsearch'] ) ? $social['VmQsearch'] : '';
		$VmChannel    = ! empty( $social['VmChannel'] ) ? $social['VmChannel'] : '';
		$VmGroup      = ! empty( $social['VmGroup'] ) ? $social['VmGroup'] : '';
		$VmCategories = ! empty( $social['VmCategories'] ) ? str_replace( ' ', '', $social['VmCategories'] ) : '';
		$VmAlbum      = ! empty( $social['VmAlbum'] ) ? $social['VmAlbum'] : '';
		$VmMax        = ! empty( $social['MaxR'] ) ? $social['MaxR'] : 6;
		$VmTime       = ! empty( $social['TimeFrq'] ) ? $social['TimeFrq'] : '3600';
		$VmSelectFeed = ! empty( $social['selectFeed'] ) ? $social['selectFeed'] : '';
		$VmRCategory  = ! empty( $social['RCategory'] ) ? $social['RCategory'] : '';
		$VmIcon       = 'fab fa-vimeo-v social-logo-yt';

		$URL   = '';
		$Vimeo = '';
		if ( 'Vm_User' === $VmType ) {
			$URL = "{$BaseURL}/users/{$VmUname}/videos?access_token={$VmAcT}&per_page={$VmMax}&page=1";
		} elseif ( 'Vm_search' === $VmType ) {
			$URL = "{$BaseURL}/videos?access_token={$VmAcT}&query={$VmQsearch}&per_page={$VmMax}&page=1";
		} elseif ( 'Vm_liked' === $VmType ) {
			$URL = "{$BaseURL}/users/{$VmUname}/likes?access_token={$VmAcT}&per_page={$VmMax}&page=1";
		} elseif ( 'Vm_Channel' === $VmType ) {
			$URL = "{$BaseURL}/channels/{$VmChannel}/videos?access_token={$VmAcT}&per_page={$VmMax}&page=1";
		} elseif ( 'Vm_Group' === $VmType ) {
			$URL = "{$BaseURL}/groups/{$VmGroup}/videos?access_token={$VmAcT}&per_page={$VmMax}&page=1";
		} elseif ( 'Vm_Album' === $VmType ) {
			$VmAPass = ! empty( $social['VmAlbumPass'] ) ? '&password=' . $social['VmAlbumPass'] : '';
			$URL     = "{$BaseURL}/users/{$VmUname}/albums/{$VmAlbum}/videos?access_token={$VmAcT}&per_page={$VmMax}&page=1$VmAPass";
		} elseif ( 'Vm_categories' === $VmType ) {
			$URL = "{$BaseURL}/categories/{$VmCategories}/videos?access_token={$VmAcT}&per_page={$VmMax}&page=1";
		}

		$GetVmURL  = get_transient( "Vm-Url-$VmKey" );
		$GetVmTime = get_transient( "Vm-Time-$VmKey" );
		if ( ( $GetVmURL != $URL ) || ( $GetVmTime != $VmTime ) ) {
			$Vimeo = $this->tp_api_call( $URL );
			set_transient( "Vm-Url-$VmKey", $URL, $VmTime );
			set_transient( "Vm-Time-$VmKey", $VmTime, $VmTime );
			set_transient( "Data-Vm-$VmKey", $Vimeo, $VmTime );
		} else {
			$Vimeo = get_transient( "Data-Vm-$VmKey" );
		}

		$VmArr     = array();
		$HTTP_CODE = ! empty( $Vimeo['HTTP_CODE'] ) ? $Vimeo['HTTP_CODE'] : '';
		if ( $HTTP_CODE == 200 ) {
			$VmData = ! empty( $Vimeo['data'] ) ? $Vimeo['data'] : array();
			foreach ( $VmData as $index => $Vmsocial ) {
				$VmUrl   = ! empty( $Vmsocial['uri'] ) ? str_replace( 'videos', 'video', $Vmsocial['uri'] ) : '';
				$VmImg   = ! empty( $Vmsocial['pictures'] ) ? $Vmsocial['pictures']['sizes'] : array();
				$VmThumb = array();
				foreach ( $VmImg as $VmValue ) {
					$VmThumb[] = $VmValue['link'];
				}
				$VmImage   = end( $VmThumb );
				$VmProfile = ! empty( $Vmsocial['user'] ) ? $Vmsocial['user']['pictures']['sizes'] : array();
				$VmPThumb  = array();
				foreach ( $VmProfile as $Vmlink ) {
					$VmPThumb[] = $Vmlink['link'];
				}

				$VmProfileLink = end( $VmPThumb );
				$VmArr[]       = array(
					'Feed_Index'     => $index,
					'PostId'         => ! empty( $Vmsocial['resource_key'] ) ? $Vmsocial['resource_key'] : '',
					'Massage'        => ! empty( $Vmsocial['name'] ) ? $Vmsocial['name'] : '',
					'Description'    => ! empty( $Vmsocial['description'] ) ? $Vmsocial['description'] : '',
					'Type'           => ! empty( $Vmsocial['type'] ) ? $Vmsocial['type'] : '',
					'PostLink'       => ! empty( $Vmsocial['link'] ) ? $Vmsocial['link'] : '',
					'CreatedTime'    => ! empty( $Vmsocial['created_time'] ) ? $this->feed_Post_time( $Vmsocial['created_time'] ) : '',
					'PostImage'      => ! empty( $VmImage ) ? $VmImage : '',
					'UserName'       => ! empty( $Vmsocial['user']['name'] ) ? $Vmsocial['user']['name'] : '',
					'UserImage'      => ! empty( $VmProfileLink ) ? $VmProfileLink : '',
					'UserLink'       => ! empty( $Vmsocial['user']['link'] ) ? $Vmsocial['user']['link'] : '',
					'share'          => ! empty( $Vmsocial['user']['metadata'] ) ? $this->tp_number_short( $Vmsocial['user']['metadata']['connections']['shared']['total'] ) : 0,
					'likes'          => ! empty( $Vmsocial['metadata'] ) ? $this->tp_number_short( $Vmsocial['metadata']['connections']['likes']['total'] ) : 0,
					'comment'        => ! empty( $Vmsocial['metadata'] ) ? $this->tp_number_short( $Vmsocial['metadata']['connections']['comments']['total'] ) : 0,
					'Embed'          => "https://player.vimeo.com{$VmUrl}",
					'EmbedType'      => ! empty( $Vmsocial['type'] ) ? $Vmsocial['type'] : '',
					'socialIcon'     => $VmIcon,
					'selectFeed'     => $VmSelectFeed,
					'FilterCategory' => $VmRCategory,
					'RKey'           => "tp-repeater-item-$VmKey",
				);
			}
		} else {
			$Error                           = ! empty( $Vimeo['error'] ) ? $Vimeo['error'] : '';
			$ErrorData['error']['message']   = ! empty( $Vimeo['error'] ) && ! empty( $Vimeo['developer_message'] ) ? '<b>' . $Vimeo['error'] . '</b></br>' . $Vimeo['developer_message'] : '';
			$ErrorData['error']['HTTP_CODE'] = ! empty( $Vimeo['HTTP_CODE'] ) ? $Vimeo['HTTP_CODE'] : 400;

			$VmArr[] = $this->SF_Error_handler( $ErrorData, $VmKey, $VmRCategory, $VmSelectFeed, $VmIcon );
		}

		return $VmArr;
	}

	/**
	 * Get Twitter feed based on provided settings.
	 *
	 * @since 1.0.0
	 *
	 * @param array $social Social media settings for Twitter.
	 *
	 * @return array Fetched Twitter feed data.
	 */
	protected function TwetterFeed( $social ) {
		$settings    = $this->get_settings_for_display();
		$BaseURL     = 'https://api.twitter.com/1.1';
		$TwKey       = ! empty( $social['_id'] ) ? $social['_id'] : '';
		$TwApi       = ! empty( $social['TwApi'] ) ? $social['TwApi'] : '';
		$TwApiSecret = ! empty( $social['TwApiSecret'] ) ? $social['TwApiSecret'] : '';
		$TwAccesT    = ! empty( $social['TwAccesT'] ) ? $social['TwAccesT'] : '';
		$TwAccesTS   = ! empty( $social['TwAccesTS'] ) ? $social['TwAccesTS'] : '';
		$twcount     = ! empty( $social['MaxR'] ) ? $social['MaxR'] * 5 : 6 * 5;
		$TwTime      = ! empty( $social['TimeFrq'] ) ? $social['TimeFrq'] : '3600';
		$MediaFilter = ! empty( $settings['MediaFilter'] ) ? $settings['MediaFilter'] : 'default';
		$RCategory   = ! empty( $social['RCategory'] ) ? $social['RCategory'] : '';
		$selectFeed  = ! empty( $social['selectFeed'] ) ? $social['selectFeed'] : '';
		$TwIcon      = 'fab fa-twitter social-logo-tw';

		$url        = '';
		$getfield   = '';
		$TwArr      = array();
		$TwResponce = array();
		if ( ! empty( $TwApi ) && ! empty( $TwApiSecret ) && ! empty( $TwAccesT ) && ! empty( $TwAccesTS ) ) {
			$TwUsername = ! empty( $social['TwUsername'] ) ? $social['TwUsername'] : '';
			$TwType     = ! empty( $social['TwfeedType'] ) ? $social['TwfeedType'] : '';
			$TwSearch   = ! empty( $social['TwSearch'] ) ? $social['TwSearch'] : '';
			$TwDmedia   = ! empty( $social['TwDmedia'] == 'yes' ) ? true : false;
			$TwComRep   = ! empty( $social['TwComRep'] ) ? false : true;
			$TwRetweet  = ! empty( $social['TwRetweet'] == 'yes' ) ? true : false;

			require_once THEPLUS_WSTYLES . 'social-feed/TwitterAPIExchange.php';
			$Twsettings = array(
				'consumer_key'              => $TwApi,
				'consumer_secret'           => $TwApiSecret,
				'oauth_access_token'        => $TwAccesT,
				'oauth_access_token_secret' => $TwAccesTS,
			);

			if ( 'wptimline' === $TwType ) {
				$Twtimeline = ! empty( $social['Twtimeline'] ) ? $social['Twtimeline'] : '';
				if ( $Twtimeline == 'Hometimline' ) {
					$url      = "{$BaseURL}/statuses/home_timeline.json";
					$getfield = "?screen_name={$TwUsername}&count={$twcount}&exclude_replies={$TwComRep}&include_entities={$TwDmedia}&tweet_mode=extended";
				} elseif ( $Twtimeline == 'mentionstimeline' ) {
					$url      = "{$BaseURL}/statuses/mentions_timeline.json";
					$getfield = "?count={$twcount}&include_entities={$TwDmedia}&tweet_mode=extended";
				}
			} elseif ( 'userfeed' === $TwType ) {
				$url      = "{$BaseURL}/statuses/user_timeline.json";
				$getfield = "?screen_name={$TwUsername}&count={$twcount}&include_entities={$TwDmedia}&include_rts={$TwRetweet}&exclude_replies={$TwComRep}&tweet_mode=extended";
			} elseif ( 'twsearch' === $TwType ) {
				$TwSearch = ! empty( $social['TwSearch'] ) ? $social['TwSearch'] : 'twitter';
				$TwRtype  = ! empty( $social['TwRtype'] ) ? $social['TwRtype'] : 'recent';

				$url      = "{$BaseURL}/search/tweets.json";
				$getfield = "?q={$TwSearch}&result_type={$TwRtype}&count={$twcount}&include_entities={$TwDmedia}&tweet_mode=extended";
			} elseif ( 'userlist' === $TwType ) {
				$Twlistsid = ! empty( $social['Twlistsid'] ) ? $social['Twlistsid'] : '99921778';
				$url       = "{$BaseURL}/lists/statuses.json";
				$getfield  = "?list_id={$Twlistsid}&count={$twcount}&include_rts={$TwRetweet}&include_entities={$TwDmedia}&tweet_mode=extended";
			} elseif ( 'twcollection' === $TwType ) {
				$Twcollsid = ! empty( $social['Twcollsid'] ) ? $social['Twcollsid'] : '539487832448843776';
				$url       = "{$BaseURL}/collections/entries.json";
				$getfield  = "?id=custom-{$Twcollsid}&count={$twcount}&tweet_mode=extended";
			} elseif ( 'userlikes' === $TwType ) {
				$url      = "{$BaseURL}/favorites/list.json";
				$getfield = "?screen_name={$TwUsername}&count={$twcount}&include_entities={$TwDmedia}&tweet_mode=extended";
			} elseif ( 'twtrends' === $TwType ) {
				$TwWOEID  = ! empty( $social['TwWOEID'] ) ? $social['TwWOEID'] : '23424848';
				$url      = "{$BaseURL}/trends/place.json";
				$getfield = "?id={$TwWOEID}";
			} elseif ( 'twRTMe' === $TwType ) {
				$url      = "{$BaseURL}/statuses/retweets_of_me.json";
				$getfield = "?count={$twcount}&include_entities={$TwDmedia}&include_user_entities=true&tweet_mode=extended";
			} elseif ( 'Twcustom' === $TwType ) {
				$TwcustId = ! empty( $social['TwcustId'] ) ? $social['TwcustId'] : '';
				$url      = "{$BaseURL}/statuses/lookup.json";
				$getfield = "?id={$TwcustId}&include_entities={$TwDmedia}&tweet_mode=extended";
			}

			$GetTwBaseUrl = get_transient( "Tw-BaseUrl-$TwKey" );
			$GetTwURL     = get_transient( "Tw-Url-$TwKey" );
			$GetTwTime    = get_transient( "Tw-Time-$TwKey" );
			if ( ( $GetTwURL != $getfield ) || ( $GetTwBaseUrl != $url ) || ( $TwTime != $GetTwTime ) ) {
					$requestMethod = 'GET';
					$twitter       = new \TwitterAPIExchange( $Twsettings );
					$TwResponse    = $twitter->setGetfield( $getfield )->buildOauth( $url, $requestMethod )->performRequest();
					$TwResponce    = json_decode( $TwResponse, true );

					set_transient( "Tw-BaseUrl-$TwKey", $url, $TwTime );
					set_transient( "Tw-Url-$TwKey", $getfield, $TwTime );
					set_transient( "Tw-Time-$TwKey", $TwTime, $TwTime );
					set_transient( "Data-tw-$TwKey", $TwResponce, $TwTime );
			} else {
				$TwResponce = get_transient( "Data-tw-$TwKey" );
			}
		}

		$Twcode = '';
		if ( ! empty( $TwResponce['errors'] ) ) {
			$Twcode = 400;
		}

		if ( ! empty( $TwResponce && 'twtrends' !== $TwType && $Twcode != 400 ) ) {
			if ( 'twsearch' === $TwType ) {
				$TwResponce = ! empty( $TwResponce['statuses'] ) ? $TwResponce['statuses'] : array();
			} elseif ( 'twcollection' === $TwType ) {
				$TwColluser = ! empty( $TwResponce['objects']['users'] ) ? $TwResponce['objects']['users'] : array();
				$TwResponce = ! empty( $TwResponce['objects']['tweets'] ) ? $TwResponce['objects']['tweets'] : array();
			}

			$CountFiler = 0;
			foreach ( $TwResponce as $index => $TwData ) {
				$twid = ! empty( $TwData['id'] ) ? $TwData['id'] : '';

				$retweet_count  = ! empty( $TwData['retweet_count'] ) ? $this->tp_number_short( $TwData['retweet_count'] ) : 0;
				$favorite_count = ! empty( $TwData['favorite_count'] ) ? $this->tp_number_short( $TwData['favorite_count'] ) : 0;

				$Full_Text  = ! empty( $TwData['full_text'] ) ? $TwData['full_text'] : '';
				$TwUsername = ! empty( $TwData['user']['name'] ) ? $TwData['user']['name'] : '';
				$twname     = ! empty( $TwData['user']['screen_name'] ) ? $TwData['user']['screen_name'] : '';
				$TwProfile  = ! empty( $TwData['user']['profile_image_url'] ) ? $TwData['user']['profile_image_url'] : '';

				if ( ! empty( $TwData['extended_entities']['media'][0]['media_url'] ) && ( ( ! empty( $social['TwDmedia'] ) && 'yes' === $social['TwDmedia'] ) || ( ! empty( $settings['layout'] ) && 'carousel' === $settings['layout'] ) ) ) {
					$TwImg  = ! empty( $TwData['extended_entities']['media'][0]['media_url'] ) ? $TwData['extended_entities']['media'][0]['media_url'] : '';
					$Twlink = ! empty( $TwData['extended_entities']['media'][0]['media_url'] ) ? $TwData['extended_entities']['media'][0]['media_url'] : '';
					$Type   = ! empty( $TwData['extended_entities']['media'][0]['type'] ) ? $TwData['extended_entities']['media'][0]['type'] : '';
				} else {
					$TwImg  = ! empty( $TwData['entities']['media'][0]['media_url'] ) ? $TwData['entities']['media'][0]['media_url'] : '';
					$Twlink = ! empty( $TwData['entities']['media'][0]['media_url'] ) ? $TwData['entities']['media'][0]['media_url'] : '';
					$Type   = ! empty( $TwData['entities']['media'][0]['type'] ) ? $TwData['entities']['media'][0]['type'] : '';
				}

				if ( 'twcollection' === $TwType ) {
					$twCuser = ! empty( $TwData['user'] ) ? $TwData['user']['id'] : '';
					foreach ( $TwColluser as $data ) {
						$twUid = ! empty( $data['id'] ) ? $data['id'] : '';
						if ( $twCuser == $twUid ) {
							$TwUsername = ! empty( $data['name'] ) ? $data['name'] : '';
							$Fbname     = ! empty( $data['screen_name'] ) ? $data['screen_name'] : '';
							$TwProfile  = ! empty( $data['profile_image_url'] ) ? $data['profile_image_url'] : '';
						}
					}
				}

				$TwFilter = ! empty( $social['MaxR'] ) ? $social['MaxR'] : 6;
				if ( ( 'default' === $MediaFilter && $TwFilter > $index ) || ( 'ompost' === $MediaFilter && ! empty( $Twlink ) && $CountFiler <= $TwFilter ) || ( 'hmcontent' === $MediaFilter && empty( $Twlink ) && $CountFiler <= $TwFilter ) ) {
					$TwArr[] = array(
						'Feed_Index'     => $index,
						'PostId'         => $twid,
						'Description'    => $Full_Text,
						'Type'           => $Type,
						'PostLink'       => ! empty( $Twlink ) ? $Twlink : '',
						'CreatedTime'    => ! empty( $TwData['created_at'] ) ? $this->feed_Post_time( $TwData['created_at'] ) : '',
						'PostImage'      => ! empty( $TwImg ) ? $TwImg : '',
						'UserName'       => $TwUsername,
						'UserImage'      => $TwProfile,
						'UserLink'       => "https://twitter.com/{$twname}",
						'TWRetweet'      => $retweet_count,
						'TWLike'         => $favorite_count,
						'TwReplyURL'     => "https://twitter.com/intent/tweet?in_reply_to={$twid}",
						'TwRetweetURL'   => "https://twitter.com/intent/retweet?tweet_id={$twid}",
						'TwlikeURL'      => "https://twitter.com/intent/like?tweet_id={$twid}",
						'TwtweetURL'     => "https://twitter.com/{$twname}/status/{$twid}",
						'socialIcon'     => $TwIcon,
						'selectFeed'     => $selectFeed,
						'FilterCategory' => $RCategory,
						'RKey'           => "tp-repeater-item-$TwKey",
					);

					++$CountFiler;
				}
			}
		} elseif ( ! empty( $TwResponce && 'twtrends' === $TwType && $Twcode != 400 ) ) {
			$TwResTrends = ! empty( $TwResponce[0]['trends'] ) ? $TwResponce[0]['trends'] : array();
			foreach ( $TwResTrends as $index => $trends ) {
				$TrendName = ! empty( $trends['name'] ) ? $trends['name'] : '';
				$TrendURL  = ! empty( $trends['url'] ) ? $trends['url'] : '';

				$TwArr[] = array(
					'Feed_Index' => $index,
					'UserName'   => $TrendName,
					'UserLink'   => $TrendURL,
					'socialIcon' => $TwIcon,
				);
			}
		} else {
			$Msg = '';
			if ( empty( $TwApi ) ) {
				$Msg .= 'Empty Consumer Key </br>';
			}
			if ( empty( $TwApiSecret ) ) {
				$Msg .= 'Empty Consumer Secret </br>';
			}
			if ( empty( $TwAccesT ) ) {
				$Msg .= 'Empty Access Token </br>';
			}
			if ( empty( $TwAccesTS ) ) {
				$Msg .= 'Empty Access Token Secret </br>';
			}

			$Error = ! empty( $TwResponce['errors'] ) ? $TwResponce['errors'][0] : array();

			$ErrorData['error']['HTTP_CODE'] = ! empty( $Error['code'] ) ? $Error['code'] : 400;
			$ErrorData['error']['message']   = ! empty( $Error['message'] ) ? $Error['message'] : $Msg;

			$TwArr[] = $this->SF_Error_handler( $ErrorData, $TwKey, $RCategory, $selectFeed, $TwIcon );
		}

		return $TwArr;
	}

	/**
	 * Fetch data from the YouTube API based on the provided parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param array $social The array of social feed parameters.
	 *
	 * @return mixed The data fetched from the YouTube API.
	 */
	protected function YouTubeFeed( $social ) {
		$BaseURL      = 'https://www.googleapis.com/youtube/v3';
		$YtKey        = ! empty( $social['_id'] ) ? $social['_id'] : '';
		$YtAcT        = ! empty( $social['RAToken'] ) ? $social['RAToken'] : '';
		$YtType       = ! empty( $social['RYtType'] ) ? $social['RYtType'] : 'YT_Channel';
		$YtName       = ! empty( $social['YtName'] ) ? $social['YtName'] : '';
		$YtOrder      = ! empty( $social['YTvOrder'] ) ? $social['YTvOrder'] : 'date';
		$YTthumbnail  = ! empty( $social['YTthumbnail'] ) ? $social['YTthumbnail'] : 'medium';
		$YtMax        = ! empty( $social['MaxR'] ) ? $social['MaxR'] : 6;
		$YtTime       = ! empty( $social['TimeFrq'] ) ? $social['TimeFrq'] : '3600';
		$YtCategory   = ! empty( $social['RCategory'] ) ? $social['RCategory'] : '';
		$YtselectFeed = ! empty( $social['selectFeed'] ) ? $social['selectFeed'] : '';
		$YtIcon       = 'fab fa-youtube social-logo-yt';

		$URL      = '';
		$UserLink = '';
		$YTData   = array();
		$YtArr    = array();

		if ( 'YT_Userfeed' === $YtType ) {
			$YTUserAPI     = "{$BaseURL}/channels?part=snippet&forUsername={$YtName}&key={$YtAcT}";
			$GetYtuser     = get_transient( "Yt-user-$YtKey" );
			$GetYtUserTime = get_transient( "Yt-user-Time-$YtKey" );
			if ( ( $GetYtuser != $YTUserAPI ) || ( $GetYtUserTime != $YtTime ) ) {
				$YtUNdata = $this->tp_api_call( $YTUserAPI );
					set_transient( "Data-Yt-user-$YtKey", $YtUNdata, $YtTime );
					set_transient( "Yt-user-$YtKey", $YTUserAPI, $YtTime );
					set_transient( "Yt-user-Time-$YtKey", $YtTime, $YtTime );
			} else {
				$YtUNdata = get_transient( "Data-Yt-user-$YtKey" );
			}
			$YTStatus = ! empty( $YtUNdata['HTTP_CODE'] ) ? $YtUNdata['HTTP_CODE'] : '';
			if ( $YTStatus == 200 ) {
				$YTUserID  = ! empty( $YtUNdata['items'][0]['id'] ) ? $YtUNdata['items'][0]['id'] : '';
				$YtPic     = '';
				$YtPicPath = $YtUNdata['items'][0]['snippet']['thumbnails'];
				if ( ! empty( $YtPicPath ) ) {
					if ( ! empty( $YtPicPath['default']['url'] ) ) {
						$YtPic = $YtPicPath['default']['url']; }
					if ( ! empty( $YtPicPath['medium']['url'] ) ) {
						$YtPic = $YtPicPath['medium']['url']; }
					if ( ! empty( $YtPicPath['high']['url'] ) ) {
						$YtPic = $YtPicPath['high']['url']; }
				}
				$UserLink = array(
					'UserLink'  => "https://www.youtube.com/user/{$YtName}",
					'YTprofile' => $YtPic,
				);
				$URL      = "{$BaseURL}/search?part=snippet&type=video&order={$YtOrder}&maxResults={$YtMax}&channelId={$YTUserID}&key={$YtAcT}";
			}
		} elseif ( 'YT_Channel' === $YtType ) {
			$YtChannel = ! empty( $social['YTChannel'] ) ? $social['YTChannel'] : '';
			$UserLink  = array( 'UserLink' => "https://www.youtube.com/channel/{$YtChannel}" );
			$URL       = "{$BaseURL}/search?part=snippet&type=video&order={$YtOrder}&maxResults={$YtMax}&channelId={$YtChannel}&key={$YtAcT}";
		} elseif ( 'YT_Playlist' === $YtType ) {
			$YtPlaylist = ! empty( $social['YTPlaylist'] ) ? $social['YTPlaylist'] : '';
			$UserLink   = array( 'UserLink' => "https://www.youtube.com/playlist?list={$YtPlaylist}" );
			$URL        = "{$BaseURL}/playlistItems?part=snippet&playlistId={$YtPlaylist}&maxResults={$YtMax}&key={$YtAcT}";
		} elseif ( 'YT_Search' === $YtType ) {
			$Ytsearch = ! empty( $social['YTsearchQ'] ) ? $social['YTsearchQ'] : '';
			$UserLink = array( 'UserLink' => 'https://www.youtube.com/channel/' );
			$URL      = "{$BaseURL}/search?part=id,snippet&q={$Ytsearch}&type=video&maxResults={$YtMax}&key={$YtAcT}";
		} elseif ( 'YT_Handle' === $YtType ){
			$yt_handle = ! empty( $social['yt_handle'] ) ? $social['yt_handle'] : '@posimyth';

			$YTUserAPI = "{$BaseURL}/channels?part=id,snippet,statistics,contentDetails&forHandle={$yt_handle}&key={$YtAcT}";
			$GetYtuser = get_transient( "Yt-handle-$YtKey" );
			
			$GetYtUserTime = get_transient( "Yt-handle-Time-$YtKey" );
			
			if ( ( $GetYtuser != $YTUserAPI ) || ( $GetYtUserTime != $YtTime ) ) {
				
				$YtUNdata = $this->tp_api_call( $YTUserAPI );
					set_transient( "Data-Yt-handle-$YtKey", $YtUNdata, $YtTime );
					set_transient( "Yt-handle-$YtKey", $YTUserAPI, $YtTime );
					set_transient( "Yt-handle-Time-$YtKey", $YtTime, $YtTime );
			} else {
				$YtUNdata = get_transient( "Data-Yt-handle-$YtKey" );
			}

			$YTStatus = ! empty( $YtUNdata['HTTP_CODE'] ) ? $YtUNdata['HTTP_CODE'] : '';
			if ( 200 === $YTStatus ) {
				
				$YTUserID  = ! empty( $YtUNdata['items'][0]['id'] ) ? $YtUNdata['items'][0]['id'] : '';
				$YtPic     = '';
				$YtPicPath = $YtUNdata['items'][0]['snippet']['thumbnails'];
				if ( ! empty( $YtPicPath ) ) {
					if ( ! empty( $YtPicPath['default']['url'] ) ) {
						$YtPic = $YtPicPath['default']['url']; }
					if ( ! empty( $YtPicPath['medium']['url'] ) ) {
						$YtPic = $YtPicPath['medium']['url']; }
					if ( ! empty( $YtPicPath['high']['url'] ) ) {
						$YtPic = $YtPicPath['high']['url']; }
				}
				$UserLink = array(
					'UserLink'  => "https://www.youtube.com/user/{$yt_handle}",
					'YTprofile' => $YtPic,
				);
				$URL      = "{$BaseURL}/search?part=snippet&type=video&order={$YtOrder}&maxResults={$YtMax}&channelId={$YTUserID}&key={$YtAcT}";
			}
		}

		$GetYtURL  = get_transient( "Yt-Url-$YtKey" );
		$GetYtTime = get_transient( "Yt-Time-$YtKey" );
		if ( ( $GetYtURL != $URL ) || ( $GetYtTime != $YtTime ) ) {
			$YTPData = $this->tp_api_call( $URL );
			$YTData  = array_merge( $UserLink, $YTPData );
				set_transient( "Yt-Url-$YtKey", $URL, $YtTime );
				set_transient( "Yt-Time-$YtKey", $YtTime, $YtTime );
				set_transient( "Data-Yt-$YtKey", $YTData, $YtTime );
		} else {
			$Yt_S_Data = get_transient( "Data-Yt-$YtKey" );
			$YTData    = array_merge( $UserLink, $Yt_S_Data );
		}

		$HTTP_CODE = ! empty( $YTData['HTTP_CODE'] ) ? $YTData['HTTP_CODE'] : '';
		if ( $HTTP_CODE == 200 ) {
			$UserLink  = ! empty( $YTData['UserLink'] ) ? $YTData['UserLink'] : '';
			$YtProfile = ! empty( $YTData['YTprofile'] ) ? $YTData['YTprofile'] : '';
			$Ytpost    = ! empty( $YTData['items'] ) ? $YTData['items'] : array();

			foreach ( $Ytpost as $index => $YtSearch ) {
				$snippet = ! empty( $YtSearch['snippet'] ) ? $YtSearch['snippet'] : '';
				$VideoId = ! empty( $YtSearch['id']['videoId'] ) ? $YtSearch['id']['videoId'] : '';

				$thumbnails = '';
				if ( 'default' === $YTthumbnail && ! empty( $snippet['thumbnails']['default']['url'] ) ) {
					$thumbnails = $snippet['thumbnails']['default']['url'];
				} elseif ( 'medium' === $YTthumbnail && ! empty( $snippet['thumbnails']['medium']['url'] ) ) {
					$thumbnails = $snippet['thumbnails']['medium']['url'];
				} elseif ( 'high' === $YTthumbnail && ! empty( $snippet['thumbnails']['high']['url'] ) ) {
					$thumbnails = $snippet['thumbnails']['high']['url'];
				} elseif ( 'standard' === $YTthumbnail && ! empty( $snippet['thumbnails']['standard']['url'] ) ) {
					$thumbnails = $snippet['thumbnails']['standard']['url'];
				} elseif ( 'maxres' === $YTthumbnail && ! empty( $snippet['thumbnails']['maxres']['url'] ) ) {
					$thumbnails = $snippet['thumbnails']['maxres']['url'];
				}

				if ( 'YT_Handle' === $YtType || 'YT_Userfeed' === $YtType || 'YT_Channel' === $YtType || 'YT_Search' === $YtType ) {
					$YtVideoUrl = "https://www.youtube.com/watch?v={$VideoId}";
				} elseif ( 'YT_Playlist' === $YtType ) {
					$V_ID = $VideoId = ! empty( $snippet['resourceId']['videoId'] ) ? $snippet['resourceId']['videoId'] : '';
					$P_ID = ! empty( $snippet['playlistId'] ) ? $snippet['playlistId'] : '';

					$YtVideoUrl = "https://www.youtube.com/watch?v={$V_ID}&list={$P_ID}";
				}

				if ( 'YT_Playlist' === $YtType || 'YT_Search' === $YtType || 'YT_Channel' === $YtType ) {
					$channelId = ! empty( $snippet['channelId'] ) ? $snippet['channelId'] : '';
					$YTsPic    = "{$BaseURL}/channels?part=snippet&id={$channelId}&key={$YtAcT}";
					if ( ( get_transient( "Yt-C-Url-$YtKey" ) != $YTsPic ) || ( get_transient( "Yt-c-Time-$YtKey" ) != $YtTime ) ) {
						$YTRPic = $this->tp_api_call( $YTsPic );
							set_transient( "Yt-C-Url-$YtKey", $YTsPic, $YtTime );
							set_transient( "Yt-c-Time-$YtKey", $YtTime, $YtTime );
							set_transient( "Data-c-Yt-$YtKey", $YTRPic, $YtTime );
					} else {
						$YTRPic = get_transient( "Data-c-Yt-$YtKey" );
					}

					$YtSstatus = ! empty( $YTRPic['HTTP_CODE'] ) ? $YTRPic['HTTP_CODE'] : '';
					if ( $YtSstatus == 200 ) {
						$YtProfile = ( $YTRPic['items'][0]['snippet']['thumbnails']['high']['url'] ) ? $YTRPic['items'][0]['snippet']['thumbnails']['high']['url'] : '';
					}
				}

				$GetComment   = "{$BaseURL}/videos?part=statistics&id={$VideoId}&maxResults={$YtMax}&key={$YtAcT}";
				$YtCommentAll = $this->tp_api_call( $GetComment );
				$HTTP_CODE_C  = ! empty( $YtCommentAll['HTTP_CODE'] ) ? $YtCommentAll['HTTP_CODE'] : '';
				if ( $HTTP_CODE_C == 200 ) {
					$statistics  = ! empty( $YtCommentAll['items'][0]['statistics'] ) ? $YtCommentAll['items'][0]['statistics'] : '';
					$YtCMTstatus = ! empty( $YtCommentAll['HTTP_CODE'] ) ? $YtCommentAll['HTTP_CODE'] : '';
					if ( $YtCMTstatus == 200 && ! empty( $statistics ) ) {
						$view    = ! empty( $statistics ) && ! empty( $statistics['viewCount'] ) ? $statistics['viewCount'] : 0;
						$like    = ! empty( $statistics ) && ! empty( $statistics['likeCount'] ) ? $statistics['likeCount'] : 0;
						$Dislike = ! empty( $statistics ) && ! empty( $statistics['dislikeCount'] ) ? $statistics['dislikeCount'] : 0;
						$comment = ! empty( $statistics ) && ! empty( $statistics['commentCount'] ) ? $statistics['commentCount'] : 0;
					}
				}

				$YtArr[] = array(
					'Feed_Index'     => $index,
					'PostId'         => $VideoId,
					'Massage'        => ! empty( $snippet['title'] ) ? $snippet['title'] : '',
					'Description'    => ! empty( $snippet['description'] ) ? $snippet['description'] : '',
					'Type'           => 'video',
					'PostLink'       => ! empty( $YtVideoUrl ) ? $YtVideoUrl : '',
					'CreatedTime'    => ( ! empty( $snippet['publishedAt'] ) ) ? $this->feed_Post_time( $snippet['publishedAt'] ) : '',
					'PostImage'      => ! empty( $thumbnails ) ? $thumbnails : '',
					'UserName'       => ! empty( $snippet['channelTitle'] ) ? $snippet['channelTitle'] : '',
					'UserImage'      => ! empty( $YtProfile ) ? $YtProfile : '',
					'UserLink'       => ! empty( $UserLink ) ? $UserLink : '',
					'view'           => ( isset( $view ) ) ? $this->tp_number_short( $view ) : 0,
					'likes'          => ( isset( $like ) ) ? $this->tp_number_short( $like ) : 0,
					'comment'        => ( isset( $comment ) ) ? $this->tp_number_short( $comment ) : 0,
					'Dislike'        => ( isset( $Dislike ) ) ? $this->tp_number_short( $Dislike ) : 0,
					'Embed'          => "https://www.youtube.com/embed/{$VideoId}",
					'EmbedType'      => 'video',
					'socialIcon'     => 'fab fa-youtube social-logo-yt',
					'selectFeed'     => ! empty( $social['selectFeed'] ) ? $social['selectFeed'] : '',
					'FilterCategory' => ! empty( $social['RCategory'] ) ? $social['RCategory'] : '',
					'RKey'           => 'tp-repeater-item-' . $social['_id'],
				);
			}
		} else {
			$Error = ! empty( $YTData['error'] ) ? $YTData['error'] : array();

			$ErrorData['error']['message']   = ! empty( $Error['message'] ) ? $Error['message'] : '';
			$ErrorData['error']['HTTP_CODE'] = ! empty( $Error['HTTP_CODE'] ) ? $Error['HTTP_CODE'] : 400;

			$YtArr[] = $this->SF_Error_handler( $ErrorData, $YtKey, $YtCategory, $YtselectFeed, $YtIcon );
		}
		return $YtArr;
	}

	/**
	 * Make a GET request to the specified API using cURL.
	 *
	 * @since 1.0.0
	 *
	 * @param string $API The URL of the API to make the request to.
	 *
	 * @return array An array containing the HTTP status code and the decoded response from the API.
	 */
	protected function tp_api_call( $API ) {
		$settings               = $this->get_settings_for_display();
		$CURLOPT_SSL_VERIFYPEER = ! empty( $settings['CURLOPT_SSL_VERIFYPEER'] ) ? true : false;
		$curl                   = curl_init();

		curl_setopt_array(
			$curl,
			array(
				CURLOPT_URL            => $API,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING       => '',
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_TIMEOUT        => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST  => 'GET',
				CURLOPT_SSL_VERIFYPEER => $CURLOPT_SSL_VERIFYPEER,
			)
		);

		$response   = json_decode( curl_exec( $curl ), true );
		$statuscode = array( 'HTTP_CODE' => curl_getinfo( $curl, CURLINFO_HTTP_CODE ) );

		$Final = array();
		if ( is_array( $statuscode ) && is_array( $response ) ) {
			$Final = array_merge( $statuscode, $response );
		}

		curl_close( $curl );
		return $Final;
	}

	/**
	 * Calculate the time difference between a given datetime and the current datetime, and return a human-readable string.
	 *
	 * @since 1.0.0
	 *
	 * @param string $datetime The datetime to compare.
	 * @param bool   $full     Whether to return the full time difference or just the most significant part (default is false).
	 *
	 * @return string The human-readable time difference string.
	 */
	protected function feed_Post_time( $datetime, $full = false ) {
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
	 * Format a number into a short human-readable format with a specified precision.
	 *
	 * @since 1.0.0
	 *
	 * @param float $n          The number to be formatted.
	 * @param int   $precision  The number of decimal places to include in the formatted result (default is 1).
	 *
	 * @return string The formatted number in short format.
	 */
	protected function tp_number_short( $n, $precision = 1 ) {

		if ( $n < 900 ) {
			$n_format = number_format( $n, $precision );
			$suffix   = '';
		} elseif ( $n < 900000 ) {
			$n_format = number_format( $n / 1000, $precision );
			$suffix   = 'K';
		} elseif ( $n < 900000000 ) {
			$n_format = number_format( $n / 1000000, $precision );
			$suffix   = 'M';
		} elseif ( $n < 900000000000 ) {
			$n_format = number_format( $n / 1000000000, $precision );
			$suffix   = 'B';
		} else {
			$n_format = number_format( $n / 1000000000000, $precision );
			$suffix   = 'T';
		}
		if ( $precision > 0 ) {
			$dotzero  = '.' . str_repeat( '0', $precision );
			$n_format = str_replace( $dotzero, '', $n_format );
		}

		return $n_format . $suffix;
	}

	/**
	 * Get options for the carousel/slider.
	 *
	 * @since 1.0.0
	 * @version 5.5.3
	 * @return string The generated data attributes for the carousel/slider.
	 */
	protected function get_carousel_options() {
		return include THEPLUS_PATH . 'modules/widgets/theplus-carousel-options.php';
	}

	/**
	 * Generate settings array for configuring fancybox/lightbox for social feed.
	 *
	 * @since 1.0.0
	 *
	 * @param array $settings The settings array for configuring fancybox/lightbox.
	 *
	 * @return array The generated settings array for fancybox/lightbox.
	 */
	protected function tp_social_feed_fancybox( $settings ) {
		$FancyData = ! empty( $settings['FancyOption'] ) ? $settings['FancyOption'] : array();

		$button = array();
		if ( is_array( $FancyData ) ) {
			foreach ( $FancyData as $value ) {
				$button[] = $value;
			}
		}

		$fancybox = array();

		$fancybox['loop']    = ! empty( $settings['LoopFancy'] ) ? true : false;
		$fancybox['infobar'] = ! empty( $settings['infobar'] ) ? true : false;
		$fancybox['arrows']  = ! empty( $settings['ArrowsFancy'] ) ? true : false;

		$fancybox['animationEffect']   = $settings['AnimationFancy'];
		$fancybox['animationDuration'] = !empty( $settings['DurationFancy']['size'] ) ? $settings['DurationFancy']['size'] : 366;

		$fancybox['clickContent']       = $settings['ClickContent'];
		$fancybox['slideclick']         = $settings['Slideclick'];
		$fancybox['transitionEffect']   = $settings['TransitionFancy'];
		$fancybox['transitionDuration'] = !empty( $settings['TranDuration']['size'] ) ? $settings['TranDuration']['size'] : 366 ;

		$fancybox['button'] = $button;

		return $fancybox;
	}

	/**
	 * Get the HTML for category filtering.
	 *
	 * @since 1.0.0
	 *
	 * @param int   $count    The total count of items to be filtered.
	 * @param array $allfeed  All items to be filtered.
	 *
	 * @return string HTML for category filtering.
	 */
	protected function get_filter_category( $count, $allfeed ) {
		$settings        = $this->get_settings_for_display();
		$CategoryWF      = ! empty( $settings['filter_category'] ) ? $settings['filter_category'] : '';
		$category_filter = '';
		$TeamMemberR     = ! empty( $settings['AllReapeter'] ) ? $settings['AllReapeter'] : array();
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
			$loop_category  = $this->SF_Split_Array_Category( $loop_category );
			$count_category = array_count_values( $loop_category );

			$all_category = $category_post_count = '';
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

				$category_filter .= '<ul class="category-filters ' . esc_attr( $filter_style ) . ' hover-' . esc_attr( $filter_hover_style ) . '">';

					$category_filter .= '<li><a href="#" class="filter-category-list active all" data-filter="*" >' . $category_post_count . '<span data-hover="' . esc_attr( $all_filter_category ) . '">' . esc_html( $all_filter_category ) . '</span>' . $all_category . '</a></li>';

			foreach ( $loop_category as $i => $key ) {
				$slug = $this->SF_Media_createSlug( $key );

				$category_post_count = '';

				if ( 'style-2' === $filter_style || 'style-3' === $filter_style ) {
					$CategoryCount = 0;
					foreach ( $allfeed as $index => $value ) {
						$CategoryName = ! empty( $value['FilterCategory'] ) ? $value['FilterCategory'] : '';

						if ( $CategoryName == $key && $index < $count ) {
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
	 * Recursively split a nested array into a flat associative array.
	 *
	 * @since 1.0.0
	 *
	 * @param array $array The nested array to be split.
	 *
	 * @return array|false The flattened associative array or false if the input is not an array.
	 */
	protected function SF_Split_Array_Category( $array ) {
		if ( ! is_array( $array ) ) {
			return false;
		}

		$result = array();
		foreach ( $array as $key => $value ) {
			if ( is_array( $value ) ) {
				$result = array_merge( $result, $this->SF_Split_Array_Category( $value ) );
			} else {
				$result[ $key ] = $value;
			}
		}

		return $result;
	}

	/**
	 * Create a slug from a given string.
	 *
	 * @since 1.0.0
	 *
	 * @param string $str       The string to create a slug from.
	 * @param string $delimiter The delimiter to use in the slug (default is '-').
	 *
	 * @return string The generated slug.
	 */
	protected function SF_Media_createSlug( $str, $delimiter = '-' ) {
		$slug = preg_replace( '/[^A-Za-z0-9-]+/', $delimiter, $str );
		return $slug;
	}

	/**
	 * Handle and format errors for display.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $ErrorData   The error data, typically an array with an 'error' key.
	 * @param string $Rkey        Optional. The key associated with the error.
	 * @param string $RCategory   Optional. The category associated with the error.
	 * @param string $selectFeed  Optional. The selected feed associated with the error.
	 * @param string $Icon        Optional. The icon associated with the error.
	 *
	 * @return array Formatted error data.
	 */
	protected function SF_Error_handler( $ErrorData, $Rkey = '', $RCategory = '', $selectFeed = '', $Icon = '' ) {
		$Error = ! empty( $ErrorData['error'] ) ? $ErrorData['error'] : array();

		return array(
			'Feed_Index'     => 0,
			'ErrorClass'     => 'error-class',
			'socialIcon'     => $Icon,
			'CreatedTime'    => "<b>{$selectFeed}</b>",
			'Description'    => ! empty( $Error['message'] ) ? $Error['message'] : 'Somthing Wrong',
			'UserName'       => ! empty( $Error['HTTP_CODE'] ) ? 'Error Code : ' . $Error['HTTP_CODE'] : 400,
			'UserImage'      => THEPLUS_ASSETS_URL . 'images/tp-placeholder.jpg',
			'selectType'     => $selectFeed,
			'FilterCategory' => $RCategory,
			'RKey'           => "tp-repeater-item-$Rkey",
		);
	}

	/**
	 * Define the content template for the widget.
	 *
	 * @since 1.0.0
	 */
	protected function content_template() {}
}