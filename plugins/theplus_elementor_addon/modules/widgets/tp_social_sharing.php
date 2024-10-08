<?php
/**
 * Widget Name: Social Sharing
 * Description: Social Sharing
 * Author: Theplus
 * Author URI: https://posimyth.com
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
 * Class ThePlus_Social_Sharing
 */
class ThePlus_Social_Sharing extends Widget_Base {

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
		return 'tp-social-sharing';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Social Sharing', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-share-square theplus_backend_icon';
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
	 * Get Widget Category.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget Keyword.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Social Sharing', 'Share Buttons', 'Social Media Sharing', 'Social Icons', 'Social Share', 'Social Share Buttons', 'Share Widget', 'Share Icons', 'Share Buttons Widget' );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {
		/*Content Layout */
		$this->start_controls_section(
			'social_sharing_content_section',
			array(
				'label' => esc_html__( 'Social Sharing', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'sociallayout',
			array(
				'label'   => esc_html__( 'Layout', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => array(
					'horizontal' => esc_html__( 'Horizontal', 'theplus' ),
					'vertical'   => esc_html__( 'Vertical', 'theplus' ),
					'toggle'     => esc_html__( 'Toggle', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'styleHZ',
			array(
				'label'     => esc_html__( 'Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Style 5', 'theplus' ),
				),
				'condition' => array(
					'sociallayout' => 'horizontal',
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
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
				),
				'condition' => array(
					'sociallayout' => 'vertical',
				),
			)
		);
		$this->add_control(
			'toggleStyle',
			array(
				'label'     => esc_html__( 'Toggle Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
				),
				'condition' => array(
					'sociallayout' => 'toggle',
				),
			)
		);
		$this->add_control(
			'hDirection',
			array(
				'label'     => esc_html__( 'Hover Direction', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top',
				'options'   => array(
					'left'   => esc_html__( 'Left', 'theplus' ),
					'right'  => esc_html__( 'Right', 'theplus' ),
					'top'    => esc_html__( 'Top', 'theplus' ),
					'bottom' => esc_html__( 'Bottom', 'theplus' ),
				),
				'condition' => array(
					'sociallayout' => 'toggle',
					'toggleStyle'  => 'style-2',
				),
			)
		);
		$this->add_control(
			'viewtype',
			array(
				'label'     => esc_html__( 'View Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'iconText',
				'options'   => array(
					'icon'          => esc_html__( 'Icon', 'theplus' ),
					'iconCount'     => esc_html__( 'Icon Count', 'theplus' ),
					'text'          => esc_html__( 'Text', 'theplus' ),
					'textCount'     => esc_html__( 'Text Count', 'theplus' ),
					'iconText'      => esc_html__( 'Icon Text', 'theplus' ),
					'iconTextCount' => esc_html__( 'Icon Text Count', 'theplus' ),
				),
				'condition' => array(
					'sociallayout!' => 'toggle',
				),
			)
		);
		$this->add_control(
			'column',
			array(
				'label'     => esc_html__( 'Column', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'auto',
				'options'   => array(
					'auto' => esc_html__( 'Auto', 'theplus' ),
					'1'    => esc_html__( '1', 'theplus' ),
					'2'    => esc_html__( '2', 'theplus' ),
					'3'    => esc_html__( '3', 'theplus' ),
					'4'    => esc_html__( '4', 'theplus' ),
					'5'    => esc_html__( '5', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-social-list .tp-social-menu,
						{{WRAPPER}} .tp-social-list .totalcount' => 'width: calc(100%/{{VALUE}})',
				),
				'condition' => array(
					'sociallayout' => 'horizontal',
				),
			)
		);
		$this->add_responsive_control(
			'alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'left',
				'options'   => array(
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
				'selectors' => array(
					'{{WRAPPER}} .tp-social-sharing' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .tp-social-list'    => 'justify-content: {{VALUE}}',
				),
				'condition' => array(
					'sociallayout' => 'horizontal',
					'styleHZ!'     => array( 'style-4', 'style-5' ),
				),
			)
		);
		$this->add_responsive_control(
			'alignmentV',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'left',
				'options'   => array(
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
				'selectors' => array(
					'{{WRAPPER}} .tp-social-sharing' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .tp-social-list'    => 'justify-content: {{VALUE}}',
				),
				'condition' => array(
					'sociallayout' => 'vertical',
				),
			)
		);
		$this->add_responsive_control(
			'alignmentT',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'left',
				'options'   => array(
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
				'selectors' => array(
					'{{WRAPPER}} .tp-social-sharing' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .tp-social-list'    => 'justify-content: {{VALUE}}',
				),
				'condition' => array(
					'sociallayout' => 'toggle',
					'toggleStyle'  => array( 'style-2' ),
				),
			)
		);
		$this->add_responsive_control(
			'style1Align',
			array(
				'label'     => esc_html__( 'Content Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'text-left',
				'options'   => array(
					'text-left'   => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'text-center' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'text-right'  => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'condition' => array(
					'sociallayout!' => 'toggle',
				),
			)
		);
		$this->add_control(
			'displayCounter',
			array(
				'label'     => esc_html__( 'Display Counter', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'sociallayout!' => 'toggle',
				),
			)
		);
		$this->add_control(
			'shareNumber',
			array(
				'label'       => esc_html__( 'Total Share', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '1.2K', 'theplus' ),
				'label_block' => false,
				'condition'   => array(
					'sociallayout!'  => 'toggle',
					'displayCounter' => 'yes',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$this->add_control(
			'shareLabel',
			array(
				'label'       => esc_html__( 'Share Label', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Share', 'theplus' ),
				'label_block' => false,
				'condition'   => array(
					'sociallayout!'  => 'toggle',
					'displayCounter' => 'yes',
				),
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'socialNtwk',
			array(
				'label'   => esc_html__( 'Social Network', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fab fa-facebook-f',
				'options' => array(
					'fab fa-amazon'             => esc_html__( 'Amazon ', 'theplus' ),
					'fab fa-digg'               => esc_html__( 'Digg ', 'theplus' ),
					'fab fa-delicious'          => esc_html__( 'Delicious ', 'theplus' ),
					'far fa-envelope'           => esc_html__( 'Mail', 'theplus' ),
					'fab fa-facebook-f'         => esc_html__( 'FaceBook ', 'theplus' ),
					'fab fa-facebook-messenger' => esc_html__( 'Facebook Messenger ', 'theplus' ),
					'fab fa-get-pocket'         => esc_html__( 'Pocket ', 'theplus' ),
					'fab fa-instagram' 			=> esc_html__( 'Instagram', 'theplus' ),
					'fab fa-linkedin-in'        => esc_html__( 'Linkedln ', 'theplus' ),
					'fab fa-odnoklassniki'      => esc_html__( 'Odnoklassniki ', 'theplus' ),
					'fab fa-pinterest-p'        => esc_html__( 'Pinterest ', 'theplus' ),
					'fab fa-reddit'             => esc_html__( 'Reddit ', 'theplus' ),
					'fab fa-skype'              => esc_html__( 'Skype ', 'theplus' ),
					'fab fa-snapchat-ghost'     => esc_html__( 'Snapchat ', 'theplus' ),
					'fab fa-stumbleupon'        => esc_html__( 'Stumbleupon ', 'theplus' ),
					'fab fa-telegram-plane'     => esc_html__( 'Telegram ', 'theplus' ),
					'fab fa-tumblr'             => esc_html__( 'Tumblr ', 'theplus' ),
					'fab fa-twitter'            => esc_html__( 'Twitter ', 'theplus' ),
					'fab fa-viber'              => esc_html__( 'Viber ', 'theplus' ),
					'fab fa-vk'                 => esc_html__( 'VK ', 'theplus' ),
					'fab fa-weibo'              => esc_html__( 'Weibo ', 'theplus' ),
					'fab fa-whatsapp'           => esc_html__( 'Whatsapp ', 'theplus' ),
					'fab fa-xing'               => esc_html__( 'Xing ', 'theplus' ),
					'tpmsp'                     => esc_html__( 'Mobile Share Panel ', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'tpmspIcons',
			array(
				'label'     => esc_html__( 'Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-star',
					'library' => 'solid',
				),
				'condition' => array(
					'socialNtwk' => 'tpmsp',
				),
			)
		);
		$repeater->add_control(
			'tpmsp_open',
			array(
				'label'      => esc_html__( 'Open Mobile Share Panel', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1500,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 767,
				),
				'condition'  => array(
					'socialNtwk' => 'tpmsp',
				),
			)
		);
		$repeater->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Network', 'theplus' ),
				'label_block' => false,
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'countNumber',
			array(
				'label'       => esc_html__( 'Count Number', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '7', 'theplus' ),
				'label_block' => false,
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'countLabel',
			array(
				'label'       => esc_html__( 'Count Label', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => false,
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'socialBtn',
			array(
				'label'       => esc_html__( 'Social Button', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => false,
				'ai' => array(
					'active' => false,
				),
			)
		);
		$repeater->add_control(
			'customURL',
			array(
				'label'     => esc_html__( 'Custom URL', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'socialNtwk!' => 'tpmsp',
				),
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'customLink',
			array(
				'label'       => esc_html__( 'Custom URL Link', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'condition'   => array(
					'socialNtwk!' => 'tpmsp',
					'customURL'   => 'yes',
				),
			)
		);
		$repeater->start_controls_tabs( 'Nml_Hvr_icon_color' );
		$repeater->start_controls_tab(
			'Nml_icon_color',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$repeater->add_control(
			'titleNmlColor',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-list {{CURRENT_ITEM}} .social-btn-title' => 'color:{{VALUE}};',
				),
			)
		);
		$repeater->add_control(
			'countNmlColor',
			array(
				'label'     => esc_html__( 'Count Number Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-list {{CURRENT_ITEM}} .social-count' => 'color:{{VALUE}};',
				),
			)
		);
		$repeater->add_control(
			'countLblNmlColor',
			array(
				'label'     => esc_html__( 'Count Label Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-list {{CURRENT_ITEM}} .count-label' => 'color:{{VALUE}};',
				),
			)
		);
		$repeater->add_control(
			'socialbtnNmlColor',
			array(
				'label'     => esc_html__( 'Social Button Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .sharing-horizontal.sharing-style-4 .tp-social-list {{CURRENT_ITEM}} .social-button' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'sociallayout' => 'horizontal',
					'styleHZ'      => 'style-4',
				),
			)
		);
		$repeater->add_control(
			'iconNmlColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-list {{CURRENT_ITEM}} .social-btn-icon' => 'color:{{VALUE}};',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'iconNmlBG',
				'label'    => esc_html__( 'Icon Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-list {{CURRENT_ITEM}} .share-btn .social-btn-icon',
			)
		);
		$repeater->add_control(
			'nmlBColor',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-list {{CURRENT_ITEM}} .share-btn' => 'border-color:{{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'normalBG',
				'label'     => esc_html__( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-social-list {{CURRENT_ITEM}} .share-btn',
				'separator' => 'before',
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'Hvr_icon_color',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$repeater->add_control(
			'titleHvrColor',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-list {{CURRENT_ITEM}} .share-btn:hover .social-btn-title' => 'color:{{VALUE}};',
				),
			)
		);
		$repeater->add_control(
			'countHvrColor',
			array(
				'label'     => esc_html__( 'Count Number Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-list {{CURRENT_ITEM}} .share-btn:hover .social-count' => 'color:{{VALUE}};',
				),
			)
		);
		$repeater->add_control(
			'countLblHvrColor',
			array(
				'label'     => esc_html__( 'Count Label Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-list {{CURRENT_ITEM}} .share-btn:hover .count-label' => 'color:{{VALUE}};',
				),
			)
		);
		$repeater->add_control(
			'socialbtnHvrColor',
			array(
				'label'     => esc_html__( 'Social Button Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .sharing-horizontal.sharing-style-4 .tp-social-list {{CURRENT_ITEM}} .share-btn:hover .social-button' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'sociallayout' => 'horizontal',
					'styleHZ'      => 'style-4',
				),
			)
		);
		$repeater->add_control(
			'iconHvrColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-list {{CURRENT_ITEM}} .share-btn:hover .social-btn-icon' => 'color:{{VALUE}};',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'iconHvrBG',
				'label'    => esc_html__( 'Icon Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-list {{CURRENT_ITEM}} .share-btn:hover .social-btn-icon',
			)
		);
		$repeater->add_control(
			'hvrBColor',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-list {{CURRENT_ITEM}} .share-btn:hover' => 'border-color:{{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'hoverBG',
				'label'     => esc_html__( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-social-list {{CURRENT_ITEM}} .share-btn:hover',
				'separator' => 'before',
			)
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$this->add_control(
			'socialSharing',
			array(
				'label'       => esc_html__( 'Social Sharing', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'socialNtwk' => 'fab fa-facebook-f',
						'title'      => 'Facebook',
					),
					array(
						'socialNtwk' => 'fab fa-twitter',
						'title'      => 'Twitter',
					),
					array(
						'socialNtwk' => 'fab fa-pinterest-p',
						'title'      => 'Pinterest',
					),
					array(
						'socialNtwk' => 'fab fa-linkedin-in',
						'title'      => 'Linkedln',
					),
				),
				'separator'   => 'before',
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'social_sharing_toggle_content_section',
			array(
				'label'     => esc_html__( 'Toggle Button', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'sociallayout' => 'toggle',
				),
			)
		);
		$this->add_control(
			'toggleText',
			array(
				'label'       => esc_html__( 'Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'share', 'theplus' ),
				'label_block' => true,
				'condition'   => array(
					'toggleStyle' => 'style-1',
				),
			)
		);
		$this->add_control(
			'iconStore',
			array(
				'label'   => esc_html__( 'Select Icon', 'theplus' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fa fa-share-alt',
					'library' => 'solid',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'social_sharing_title_styling',
			array(
				'label'     => esc_html__( 'Title', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'sociallayout!' => 'toggle',
					'viewtype!'     => array( 'icon', 'iconCount' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'titleTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .tp-social-list .tp-social-menu .social-btn-title',
			)
		);
		$this->add_responsive_control(
			'titleSpace',
			array(
				'label'      => esc_html__( 'Title Spacing', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .sharing-horizontal .tp-social-list .social-btn-title,{{WRAPPER}} .sharing-vertical .tp-social-list .social-btn-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'social_sharing_counter_styling',
			array(
				'label'     => esc_html__( 'Counter', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'sociallayout!' => 'toggle',
					'viewtype'      => array( 'iconCount', 'textCount', 'iconTextCount' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'countNumTypo',
				'label'     => esc_html__( 'Number Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector'  => '{{WRAPPER}} .sharing-horizontal .tp-social-list .social-count,{{WRAPPER}} .sharing-vertical .tp-social-list .social-count',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'countNumSpace',
			array(
				'label'      => esc_html__( 'Number Spacing', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .sharing-horizontal .tp-social-list .social-count,{{WRAPPER}} .sharing-vertical .tp-social-list .social-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'countLblTypo',
				'label'    => esc_html__( 'Label Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .sharing-horizontal .tp-social-list .count-label,{{WRAPPER}} .sharing-vertical .tp-social-list .count-label',
			)
		);
		$this->add_responsive_control(
			'countLblSpace',
			array(
				'label'      => esc_html__( 'Label Spacing', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .sharing-horizontal  .tp-social-list .count-label,{{WRAPPER}} .sharing-vertical  .tp-social-list .count-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'socialbtnTypo',
				'label'     => esc_html__( 'Social Button Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector'  => '{{WRAPPER}} .sharing-horizontal.sharing-style-4 .tp-social-list .social-button',
				'condition' => array(
					'sociallayout' => 'horizontal',
					'styleHZ'      => 'style-4',
				),
			)
		);
		$this->add_responsive_control(
			'socialbtnSpace',
			array(
				'label'      => esc_html__( 'Social Button Spacing', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .sharing-horizontal.sharing-style-4  .tp-social-list .social-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'sociallayout' => 'horizontal',
					'styleHZ'      => 'style-4',
				),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'      => 'socialbtnBorder',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .sharing-horizontal.sharing-style-4 .tp-social-list .social-button',
				'condition' => array(
					'sociallayout' => 'horizontal',
					'styleHZ'      => 'style-4',
				),
			)
		);
		$this->add_responsive_control(
			'socialbtnBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .sharing-horizontal.sharing-style-4 .tp-social-list .social-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'sociallayout' => 'horizontal',
					'styleHZ'      => 'style-4',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'socialbtnBG',
				'label'     => esc_html__( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .sharing-horizontal.sharing-style-4 .tp-social-list .social-button',
				'condition' => array(
					'sociallayout' => 'horizontal',
					'styleHZ'      => 'style-4',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'social_sharing_icon_styling',
			array(
				'label'     => esc_html__( 'Icon', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'sociallayout' => array( 'horizontal', 'vertical', 'toggle' ),
				),
			)
		);
		$this->add_responsive_control(
			'iconSize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px', 'em', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-list .social-btn-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'iconWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Width', 'theplus' ),
				'size_units'  => array( 'px', 'em', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-list .social-btn-icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'iconGap',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Between Gap', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'sociallayout' => 'toggle',
					'toggleStyle'  => 'style-2',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'social_sharing_toggle_styling',
			array(
				'label'     => esc_html__( 'Toggle', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'sociallayout' => 'toggle',
				),
			)
		);
		$this->add_responsive_control(
			'toggleWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Toggle Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 40,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .sharing-toggle.sharing-style-2 .toggle-share' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .sharing-toggle.sharing-style-2 .tp-social-list li.tp-main-menu a.tp-share-btn' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'sociallayout' => 'toggle',
					'toggleStyle'  => 'style-2',
				),
			)
		);
		$this->add_responsive_control(
			'tglIconWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Width', 'theplus' ),
				'size_units'  => array( 'px', 'em' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .sharing-toggle.sharing-style-1 .toggle-icon .toggle-btn' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'sociallayout' => 'toggle',
					'toggleStyle'  => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'tglIconSize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px', 'em' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 16,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .sharing-toggle.sharing-style-2 .tp-social-list li.tp-main-menu a.tp-share-btn,{{WRAPPER}} .sharing-toggle.sharing-style-1 .toggle-btn' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .sharing-toggle.sharing-style-2 .tp-social-list li.tp-main-menu a.tp-share-btn svg,{{WRAPPER}} .sharing-toggle.sharing-style-1 .toggle-btn svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				),
				'separator'   => 'after',
			)
		);
		$this->start_controls_tabs( 'Nml_Hvr_Color' );
		$this->start_controls_tab(
			'Nml_Color',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'tglTitleNmlColor',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .sharing-toggle.sharing-style-1 .toggle-label' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'sociallayout' => 'toggle',
					'toggleStyle'  => 'style-1',
				),
			)
		);
		$this->add_control(
			'tglIcnNmlColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .tp-social-sharing.sharing-toggle.sharing-style-2 .tp-social-list li.tp-main-menu a.tp-share-btn,{{WRAPPER}} .sharing-toggle.sharing-style-1 .toggle-icon .toggle-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-social-sharing.sharing-toggle.sharing-style-2 .tp-social-list li.tp-main-menu a.tp-share-btn svg,{{WRAPPER}} .sharing-toggle.sharing-style-1 .toggle-icon .toggle-btn svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'sociallayout' => 'toggle',
				),
			)
		);
		$this->add_control(
			'tglIcnNmlBG',
			array(
				'label'     => esc_html__( 'Icon Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .sharing-toggle.sharing-style-1 .toggle-icon .toggle-btn' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'sociallayout' => 'toggle',
					'toggleStyle'  => 'style-1',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tglNmlBG',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .sharing-toggle.sharing-style-2 .tp-social-list li.tp-main-menu a.tp-share-btn,{{WRAPPER}} .sharing-toggle.sharing-style-1 .toggle-share',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tglNmlshadow',
				'selector' => '{{WRAPPER}} .tp-social-sharing.sharing-toggle.sharing-style-2 .tp-social-list li.tp-main-menu a.tp-share-btn,
				{{WRAPPER}} .tp-social-sharing.sharing-toggle.sharing-style-1 .toggle-share',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Hvr_Color',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'tglTitleHvrColor',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .sharing-toggle.sharing-style-1 .toggle-share.menu-active .toggle-label' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'sociallayout' => 'toggle',
					'toggleStyle'  => 'style-1',
				),
			)
		);
		$this->add_control(
			'tglIcnHvrColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-sharing.sharing-toggle.sharing-style-2 .tp-social-list.active li.tp-main-menu a.tp-share-btn,{{WRAPPER}} .sharing-toggle.sharing-style-1 .toggle-share.menu-active .toggle-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-social-sharing.sharing-toggle.sharing-style-2 .tp-social-list.active li.tp-main-menu a.tp-share-btn svg,{{WRAPPER}} .sharing-toggle.sharing-style-1 .toggle-share.menu-active .toggle-btn svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'sociallayout' => 'toggle',
				),
			)
		);
		$this->add_control(
			'tglIcnHvrBG',
			array(
				'label'     => esc_html__( 'Icon Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .sharing-toggle.sharing-style-1 .toggle-share.menu-active .toggle-btn' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'sociallayout' => 'toggle',
					'toggleStyle'  => 'style-1',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tglHvrBG',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .sharing-toggle.sharing-style-2 .tp-social-list.active li.tp-main-menu a.tp-share-btn,{{WRAPPER}} .sharing-toggle.sharing-style-1 .toggle-share.menu-active',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tglHvrshadow',
				'selector' => '{{WRAPPER}} .tp-social-sharing.sharing-toggle.sharing-style-2 .tp-social-list.active li.tp-main-menu a.tp-share-btn,
				{{WRAPPER}} .tp-social-sharing.sharing-toggle.sharing-style-1 .toggle-share.menu-active,
				{{WRAPPER}} .tp-social-sharing.sharing-toggle.sharing-style-2 .tp-social-list li.tp-main-menu a.tp-share-btn:hover,
				{{WRAPPER}} .tp-social-sharing.sharing-toggle.sharing-style-1 .toggle-share:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'social_sharing_total_counter_styling',
			array(
				'label'     => esc_html__( 'Total Counter', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'sociallayout'   => array( 'horizontal', 'vertical' ),
					'displayCounter' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'totalNumTypo',
				'label'     => esc_html__( 'Number Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector'  => '{{WRAPPER}} .tp-social-list .totalcount-item .total-count-number',
				'condition' => array(
					'displayCounter' => 'yes',
					'shareNumber!'   => '',
				),
			)
		);
		$this->add_control(
			'totalNumColor',
			array(
				'label'     => esc_html__( 'Number Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-list .totalcount-item .total-count-number' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'displayCounter' => 'yes',
					'shareNumber!'   => '',
				),
				'separator' => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'totalLblTypo',
				'label'     => esc_html__( 'Label Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector'  => '{{WRAPPER}} .tp-social-list .totalcount-item .total-number-label',
				'condition' => array(
					'displayCounter' => 'yes',
					'shareLabel!'    => '',
				),
			)
		);
		$this->add_control(
			'totalLblColor',
			array(
				'label'     => esc_html__( 'Label Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-social-list .totalcount-item .total-number-label' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'displayCounter' => 'yes',
					'shareLabel!'    => '',
				),
			)
		);
		$this->add_responsive_control(
			'totalSpace',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Space Between', 'theplus' ),
				'size_units'  => array( 'px', 'em', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-list .totalcount-item .total-number-label' => ' margin-top: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'displayCounter' => 'yes',
					'shareNumber!'   => '',
					'shareLabel!'    => '',
				),
				'separator'   => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'social_sharing_bg_styling',
			array(
				'label' => esc_html__( 'Background', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'bgWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px', 'em', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-list li.tp-social-menu' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'bgHeight',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
				'size_units'  => array( 'px', 'em' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-list li.tp-social-menu' => 'height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tp-social-list .totalcount' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'iconSpaceBtwn',
			array(
				'label'      => esc_html__( 'Icon Space Between', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-list .tp-social-menu,{{WRAPPER}} .tp-social-list .totalcount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'Nml_Hvr_Border' );
		$this->start_controls_tab(
			'Nml_Border',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'     => 'bgNmlBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-list .share-btn',
			)
		);
		$this->add_responsive_control(
			'bgNmlBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-list .share-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Hvr_Border',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'     => 'bgHvrBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-social-list .share-btn:hover',
			)
		);
		$this->add_responsive_control(
			'bgHvrBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-list .share-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Social Sharing Render.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings       = $this->get_settings_for_display();
		$uid_socishre   = uniqid( 'tp-ss' );
		$social_sharing = ! empty( $settings['socialSharing'] ) ? $settings['socialSharing'] : array();
		$sociallayout   = ! empty( $settings['sociallayout'] ) ? $settings['sociallayout'] : 'horizontal';

		$column      = ! empty( $settings['column'] ) ? $settings['column'] : 'auto';
		$style_h_z   = ! empty( $settings['styleHZ'] ) ? $settings['styleHZ'] : 'style-1 ';
		$style       = ! empty( $settings['style'] ) ? $settings['style'] : 'style-1 ';
		$togglestyle = ! empty( $settings['toggleStyle'] ) ? $settings['toggleStyle'] : 'style-1';

		$display_counter = ! empty( $settings['displayCounter'] ) ? $settings['displayCounter'] : false;

		$viewtype     = ! empty( $settings['viewtype'] ) ? $settings['viewtype'] : 'iconText';
		$h_direction  = ! empty( $settings['hDirection'] ) ? $settings['hDirection'] : 'top';
		$share_number = ! empty( $settings['shareNumber'] ) ? $settings['shareNumber'] : '';
		$share_label  = ! empty( $settings['shareLabel'] ) ? $settings['shareLabel'] : '';
		$icon_store   = ! empty( $settings['iconStore'] ) ? $settings['iconStore'] : '';
		$toggle_width = ! empty( $settings['toggleWidth']['size'] ) ? $settings['toggleWidth']['size'] : 40;
		$icon_gap     = ! empty( $settings['iconGap']['size'] ) ? $settings['iconGap']['size'] : 0;
		$toggle_text  = ! empty( $settings['toggleText'] ) ? $settings['toggleText'] : '';

		$p = 1;

		$select_style = '';
		$direction    = '';
		$get_counter  = '';
		$column_auto  = '';
		$loop_style   = '';

		if ( 'toggle' !== $sociallayout && 'horizontal' !== $sociallayout ) {
			$select_style = $style;
		} elseif ( 'toggle' === $sociallayout ) {
			$select_style = $togglestyle;
		} elseif ( 'horizontal' === $sociallayout ) {
			$select_style = $style_h_z;
		}

		if ( 'toggle' === $sociallayout && 'style-2' === $togglestyle ) {
			if ( 'left' === $h_direction ) {
				$direction .= 'right';
			} elseif ( 'right' === $h_direction ) {
				$direction .= 'left';
			} elseif ( 'top' === $h_direction ) {
				$direction .= 'bottom';
			} elseif ( 'bottom' === $h_direction ) {
				$direction .= 'top';
			}
		}

		if ( 'horizontal' === $sociallayout && 'auto' !== $column ) {
			$column_auto = 'column-auto';
		}

		$post_id     = get_the_ID();
		$get_link    = get_the_permalink( $post_id );
		$get_title   = get_the_title( $post_id );
		$media_url   = get_the_post_thumbnail_url( $post_id, 'full' );
		$description = wp_strip_all_tags( get_the_excerpt(), true );
		$share_link  = array(
			'fab fa-amazon'             => 'https://www.amazon.com/gp/wishlist/static-add?u=' . $get_link,
			'fab fa-digg'               => 'https://digg.com/submit?url=' . $get_link,
			'fab fa-delicious'          => 'https://del.icio.us/save?url=' . $get_link . '&title=' . $get_title,
			'far fa-envelope'           => 'mailto:?subject=' . $get_title . '&body=' . $description . "\n" . $get_link,
			'fab fa-facebook-f'         => 'https://www.facebook.com/sharer.php?u=' . $get_link,
			'fab fa-facebook-messenger' => 'fb-messenger://share/?link=' . $get_link,
			'fab fa-get-pocket'         => 'https://getpocket.com/save?url=' . $get_link . '&title=' . $get_title,
			'fab fa-instagram' 			=> 'https://www.instagram.com/',
			'fab fa-linkedin-in'        => 'https://www.linkedin.com/shareArticle?mini=true&url=' . $get_link . '&title=' . $get_title,
			'fab fa-odnoklassniki'      => 'https://connect.ok.ru/offer?url=' . $get_link . '&title=' . $get_title . '&imageUrl=' . $media_url,
			'fab fa-pinterest-p'        => 'https://www.pinterest.com/pin/create/button/?url=' . $get_link . '&media=' . $media_url,
			'fab fa-reddit'             => 'https://reddit.com/submit?url=' . $get_link . '&title=' . $get_title,
			'fab fa-skype'              => 'https://web.skype.com/share?url=' . $get_link,
			'fab fa-snapchat-ghost'     => 'https://www.snapchat.com/scan?attachmentUrl=' . $get_link,
			'fab fa-stumbleupon'        => 'https://www.stumbleupon.com/submit?url=' . $get_link . '&title=' . $get_title,
			'fab fa-telegram-plane'     => 'https://telegram.me/share/url?url=' . $get_link . '&text=' . $get_title,
			'fab fa-tumblr'             => 'https://tumblr.com/share/link?url=' . $get_link,
			'fab fa-twitter'            => 'https://twitter.com/intent/tweet?text=' . $get_title . ' ' . $get_link,
			'fab fa-viber'              => 'viber://forward?text=' . $get_title . ' ' . $get_link,
			'fab fa-vk'                 => 'https://vkontakte.ru/share.php?url=' . $get_link . '&title=' . $get_title . '&description=' . $description . '&image=' . $media_url,
			'fab fa-weibo'              => 'https://service.weibo.com/share/share.php?url=' . $get_link . '&title=' . $get_title . '&pic=' . $media_url,
			// 'fab fa-whatsapp' => "https://api.whatsapp.com/send?text=*".$get_title."*\n".$description."\n".$get_link,
			'fab fa-whatsapp'           => 'https://api.whatsapp.com/send?text=' . $get_title . "-\n" . $get_link,
			'fab fa-xing'               => 'https://www.xing.com/app/user?op=share&url=' . $get_link,
		);
		
		$output      = '<div class="tp-social-sharing sharing-' . esc_attr( $sociallayout ) . ' sharing-' . esc_attr( $select_style ) . ' tp-widget-' . esc_attr( $uid_socishre ) . '">';

			$lz4 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['tglNmlBG_image'], $settings['tglHvrBG_image'] ) : '';
		if ( 'toggle' === $sociallayout && 'style-1' === $togglestyle ) {
			$output .= '<div class="toggle-share ' . esc_attr( $lz4 ) . '">';

				$output .= '<div class="toggle-icon">';

			if ( ! empty( $toggle_text ) ) {
				$output .= '<span class="toggle-label">' . esc_html( $toggle_text ) . '</span>';
			}

			$output .= '<div class="toggle-btn">';
			if ( $icon_store ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $icon_store, array( 'aria-hidden' => 'true' ) );
				$output .= ob_get_contents();
				ob_end_clean();
			}

			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
		}
		$output .= '<ul class="tp-social-list ' . esc_attr( $column_auto ) . ' ' . esc_attr( $h_direction ) . ' ">';

		if ( ! empty( $display_counter ) && ( 'horizontal' === $sociallayout || 'vertical' === $sociallayout ) ) {
			$output .= '<li class="totalcount ">';
			$output .= '<span class="totalcount-item">';

				$output .= '<span class="total-count-number">' . esc_html( $share_number ) . '</span>';
				$output .= '<span class="total-number-label">' . esc_html( $share_label ) . '</span>';
				$output .= '</span>';

			$output .= '</li>';
		}
		if ( 'toggle' === $sociallayout && 'style-2' === $togglestyle ) {
			$output     .= '<li class="tp-main-menu">';
				$output .= '<a class="tp-share-btn ' . esc_attr( $lz4 ) . '">';
			if ( $icon_store ) {
					ob_start();
					\Elementor\Icons_Manager::render_icon( $icon_store, array( 'aria-hidden' => 'true' ) );
					$output .= ob_get_contents();
					ob_end_clean();
			}
				$output     .= '</a>';
					$output .= '</li>';
		}
		if ( ! empty( $social_sharing ) ) {
			$left_value = 0;

			foreach ( $social_sharing as $network ) {
				++$p;

				$left_value = $left_value + $toggle_width + $icon_gap;

				$output .= '<li class="tp-social-menu  elementor-repeater-item-' . esc_attr( $network['_id'] ) . ' ">';

				$get_custom_link = '';
				if ( ! empty( $network['customURL'] ) && ! empty( $network['customLink']['url'] ) ) {
					$get_custom_link = $network['customLink']['url'];
				} else {
					$iconname = $network['socialNtwk'];

					$get_custom_link = isset( $share_link[ $iconname ] ) ? $share_link[ $iconname ] : '#';
				}

				$target   = '';
				$nofollow = '';

				$tf = '';
				$nf = '';
				if ( ! empty( $get_custom_link ) ) {
					$target   = ! empty( $network['customLink']['target'] ) ? '_blank' : ' ';
					$nofollow = ! empty( $network['customLink']['nofollow'] ) ? 'nofollow' : ' ';

					$tf = 'target="' . esc_attr( $target ) . '"';
					$nf = 'rel="' . esc_attr( $nofollow ) . '"';
				}

				$lz2 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $network['normalBG_image'], $network['hoverBG_image'] ) : '';
				if ( ! empty( $network['socialNtwk'] ) && 'tpmsp' === $network['socialNtwk'] ) {
					$output .= '<script>
								jQuery( document ).ready(function() {
								const share = document.getElementById("tp-mp-main-wrap1");
								if ( navigator.share ) {	
									jQuery( share ).on("click",function() {
										navigator.share({
										   title: document.title,
											text: document.title,
											url: window.location.href
										})
									});
								}
								});
								</script>';
					$output .= '<div id="tp-mp-main-wrap1" class="share-btn ' . esc_attr( $settings['style1Align'] ) . ' ' . esc_attr( $lz2 ) . '">';

					$tpmsp_open = ! empty( $network['tpmsp_open']['size'] ) ? $network['tpmsp_open']['size'] : '';
					$output    .= '<style>.tp-widget-' . esc_attr( $uid_socishre ) . ' div#tp-mp-main-wrap1{display:none !important;} @media (max-width: ' . esc_attr( $tpmsp_open ) . 'px){ .tp-widget-' . esc_attr( $uid_socishre ) . ' div#tp-mp-main-wrap1{display:flex !important;}}</style>';
				} else {
					$output .= '<a href="' . esc_url( $get_custom_link ) . '" ' . $tf . ' ' . $nf . ' class="share-btn ' . esc_attr( $settings['style1Align'] ) . ' ' . esc_attr( $lz2 ) . '">';
				}

				if ( 'text' !== $viewtype && 'textCount' !== $viewtype ) {
					$lz1 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $network['iconNmlBG_image'], $network['iconHvrBG_image'] ) : '';

					$output   .= '<span class="social-btn-icon ' . esc_attr( $lz1 ) . '">';
						$mpimg = '';
					if ( ! empty( $network['socialNtwk'] ) && 'tpmsp' === $network['socialNtwk'] && $network['tpmspIcons'] ) {
						ob_start();
						\Elementor\Icons_Manager::render_icon( $network['tpmspIcons'], array( 'aria-hidden' => 'true' ) );
						$mpimg = ob_get_contents();
						ob_end_clean();

						$output .= $mpimg;
					} else {
						$output .= '<i aria-hidden="true" class="' . esc_attr( $network['socialNtwk'] ) . '"></i>';
					}
					$output .= '</span>';
				}

				if ( 'horizontal' === $sociallayout || 'vertical' === $sociallayout ) {
					if ( ! empty( $network['title'] ) && 'icon' !== $viewtype && 'iconCount' !== $viewtype ) {
						$output .= '<span class="social-btn-title">' . wp_kses_post( $network['title'] ) . '</span>';
					}

					if ( 'iconCount' === $viewtype || 'textCount' === $viewtype || 'iconTextCount' === $viewtype ) {
						$output .= '<div class="social-count-number">';
						if ( ! empty( $network['countNumber'] ) ) {
							$output .= '<span class="social-count">' . esc_html( $network['countNumber'] ) . '</span>';
						}
						if ( ! empty( $network['countLabel'] ) ) {
							$output .= '<span class="count-label">' . esc_html( $network['countLabel'] ) . '</span>';
						}
						if ( ! empty( $network['socialBtn'] ) ) {
							$lz3     = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['socialbtnBG_image'] ) : '';
							$output .= '<span class="social-button ' . esc_attr( $lz3 ) . '">' . wp_kses_post( $network['socialBtn'] ) . '</span>';
						}
						$output .= '</div>';
					}
				}

				if ( ! empty( $network['socialNtwk'] ) && 'tpmsp' === $network['socialNtwk'] ) {
					$output .= '</div>';
				} else {
					$output .= '</a>';
				}

				$output .= '</li>';
				if ( 'toggle' === $sociallayout && 'style-2' === $togglestyle ) {
					$loop_style .= '.tp-widget-' . esc_attr( $uid_socishre ) . '.sharing-toggle.sharing-style-2 .tp-social-list.' . esc_attr( $h_direction ) . '.active li:nth-child(' . $p . '){ ' . $direction . ': ' . $left_value . 'px;}';
				}
			}
		}

			$output .= '</ul>';
		$output     .= '</div>';

		if ( ! empty( $loop_style ) ) {
			$output .= '<style>' . $loop_style . '</style>';
		}

		echo $output;
	}
}
