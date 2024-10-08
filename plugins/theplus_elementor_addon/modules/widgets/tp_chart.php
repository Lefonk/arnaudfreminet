<?php
/**
 * Widget Name: Chart
 * Description: Chart
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 *  @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Chart.
 */
class ThePlus_Chart extends Widget_Base {

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
		return 'tp-chart';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Chart', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-area-chart theplus_backend_icon';
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
		return array( 'Advanced Chart', 'Chart Widget', 'Elementor Chart', 'Graph Widget', 'Elementor Graph', 'Data Visualization Widget', 'Elementor Data Visualization', 'Advanced Data Visualization', 'Interactive Chart', 'Interactive Graph', 'Elementor Addon Chart', 'Elementor Addon Graph' );
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
	 * Register controls.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'chart_tab_content',
			array(
				'label' => esc_html__( 'Chart', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'select_chart',
			array(
				'label'   => esc_html__( 'Select Chart', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'line',
				'options' => array(
					'line'      => esc_html__( 'Line', 'theplus' ),
					'bar'       => esc_html__( 'Bar', 'theplus' ),
					'radar'     => esc_html__( 'Radar', 'theplus' ),
					'pie'       => esc_html__( 'Doughnut & Pie', 'theplus' ),
					'polarArea' => esc_html__( 'Polar Area', 'theplus' ),
					'bubble'    => esc_html__( 'Bubble', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_bubble',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "bubble-chart-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'select_chart' => array( 'bubble' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_polarArea',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "polar-area-graph-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'select_chart' => array( 'polarArea' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_pie',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "pie-chart-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'select_chart' => array( 'pie' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_radar',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "radar-chart-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'select_chart' => array( 'radar' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_bar',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "bar-graph-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'select_chart' => array( 'bar' ),
				),
			)
		);
		$this->add_control(
			'bar_chart_type',
			array(
				'label'     => esc_html__( 'Orientation', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'vertical_bar',
				'options'   => array(
					'vertical_bar'   => esc_html__( 'Vertical Bar', 'theplus' ),
					'horizontal_bar' => esc_html__( 'Horizontal Bar', 'theplus' ),
				),
				'condition' => array(
					'select_chart' => 'bar',
				),
			)
		);
		$this->add_control(
			'doughnut_pie_chart_type',
			array(
				'label'     => esc_html__( 'Orientation', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'pie',
				'options'   => array(
					'pie'      => esc_html__( 'Pie', 'theplus' ),
					'doughnut' => esc_html__( 'Doughnut', 'theplus' ),
				),
				'condition' => array(
					'select_chart' => 'pie',
				),
			)
		);
		$this->add_control(
			'main_label',
			array(
				'label'       => esc_html__( 'label Values', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Jan | Feb | Mar', 'theplus' ),
				'placeholder' => esc_html__( 'Seprate by | ', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'chart_dataset',
			array(
				'label'     => esc_html__( 'Dataset', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'select_chart' => array( 'line', 'bar', 'radar' ),
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'loop_label',
			array(
				'label'       => esc_html__( 'Label', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Label', 'theplus' ),
				'placeholder' => esc_html__( 'Enter label', 'theplus' ),
				'dynamic'     => array( 'active' => true ),

			)
		);
		$repeater->add_control(
			'loop_data',
			array(
				'label'       => esc_html__( 'Data', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( '0 | 25 | 42', 'theplus' ),
				'placeholder' => esc_html__( 'Seprate by | ', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'separator'   => 'before',
			)
		);
		$repeater->add_control(
			'multi_dot_bg',
			array(
				'label'        => esc_html__( 'Multiple Dot Background', 'theplus' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'theplus' ),
				'label_off'    => esc_html__( 'Off', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			)
		);
		$repeater->add_control(
			'dot_bg',
			array(
				'label'     => esc_html__( 'Dot Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgb(0 0 0 / 50%)',
				'condition' => array(
					'multi_dot_bg!' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'multi_dot_bg_multiple',
			array(
				'label'       => esc_html__( 'Dot Background', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( '#f7d78299|#6fc78499|#8072fc99', 'theplus' ),
				'placeholder' => esc_html__( 'Seprate by | ', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'multi_dot_bg' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'multi_dot_border',
			array(
				'label'        => esc_html__( 'Multiple Border', 'theplus' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'theplus' ),
				'label_off'    => esc_html__( 'Off', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			)
		);
		$repeater->add_control(
			'dot_border',
			array(
				'label'     => esc_html__( 'Dot Border', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgb(0 0 0 / 50%)',
				'condition' => array(
					'multi_dot_border!' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'multi_dot_border_multiple',
			array(
				'label'       => esc_html__( 'Dot Border', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( '#f7d78299|#6fc78499|#8072fc99', 'theplus' ),
				'placeholder' => esc_html__( 'Seprate by | ', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'multi_dot_border' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'fill_opt',
			array(
				'label'       => esc_html__( 'Fill', 'theplus' ),
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Enable', 'theplus' ),
				'label_off'   => esc_html__( 'Disable', 'theplus' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Note : Fill works in Line and Radar chart', 'theplus' ),
				'separator'   => 'before',
			)
		);
		$repeater->add_control(
			'line_styling_opt',
			array(
				'label'       => esc_html__( 'Border Dash', 'theplus' ),
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Enable', 'theplus' ),
				'label_off'   => esc_html__( 'Disable', 'theplus' ),
				'default'     => 'no',
				'description' => esc_html__( 'Note : Border Dash works in Line and Radar chart', 'theplus' ),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'chart_content',
			array(
				'label'       => esc_html__( 'Chart Data Boxes', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'loop_label' => esc_html__( 'Jan', 'theplus' ),
						'loop_data'  => esc_html__( '25 | 15 | 30 ', 'theplus' ),
						'dot_bg'     => '#f7d78299',
						'dot_border' => '#f7d78299',
					),
					array(
						'loop_label' => esc_html__( 'Feb', 'theplus' ),
						'loop_data'  => esc_html__( '12 | 18 | 28', 'theplus' ),
						'dot_bg'     => '#6fc78499',
						'dot_border' => '#6fc78499',
					),
					array(
						'loop_label' => esc_html__( 'Mar', 'theplus' ),
						'loop_data'  => esc_html__( '11 | 20 | 40', 'theplus' ),
						'dot_bg'     => '#8072fc99',
						'dot_border' => '#8072fc99',
					),
				),
				'title_field' => '{{{ loop_label }}}',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'chart_dataset_alone',
			array(
				'label'      => esc_html__( 'Dataset', 'theplus' ),
				'tab'        => Controls_Manager::TAB_CONTENT,
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'select_chart',
									'operator' => '==',
									'value'    => 'polarArea',
								),
								array(
									'terms' => array(
										array(
											'name'  => 'select_chart',
											'value' => 'pie',
										),
										array(
											'name'  => 'doughnut_pie_chart_type',
											'value' => 'pie',
										),
									),
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'alone_data',
			array(
				'label'       => esc_html__( 'Data', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( '10 | 15 | 20', 'theplus' ),
				'placeholder' => esc_html__( 'Seprate by | ', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'alone_bg_colors',
			array(
				'label'       => esc_html__( 'Background Colors', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( '#f7d78299|#6fc78499|#8072fc99', 'theplus' ),
				'placeholder' => esc_html__( 'Seprate by | ', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'alone_border_colors',
			array(
				'label'       => esc_html__( 'Border Colors', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( '#f7d78299|#6fc78499|#8072fc99', 'theplus' ),
				'placeholder' => esc_html__( 'Seprate by | ', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'separator'   => 'before',
				'conditions'  => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'terms' => array(
										array(
											'name'  => 'select_chart',
											'value' => 'pie',
										),
										array(
											'name'  => 'doughnut_pie_chart_type',
											'value' => 'pie',
										),
									),
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'alone_border_colors_polar',
			array(
				'label'       => esc_html__( 'Border Colors', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( '#f7d78299|#6fc78499|#8072fc99', 'theplus' ),
				'placeholder' => esc_html__( 'Seprate by | ', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'separator'   => 'before',
				'conditions'  => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'terms' => array(
										array(
											'name'  => 'select_chart',
											'value' => 'polarArea',
										),
									),
								),
							),
						),
					),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'doughnut_chart_dataset',
			array(
				'label'     => esc_html__( 'Dataset', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'select_chart'            => 'pie',
					'doughnut_pie_chart_type' => 'doughnut',
				),
			)
		);
		$repeater2 = new \Elementor\Repeater();
		$repeater2->add_control(
			'doughnut_loop_label',
			array(
				'label'       => esc_html__( 'Label', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Label', 'theplus' ),
				'placeholder' => esc_html__( 'Enter label', 'theplus' ),
				'dynamic'     => array( 'active' => true ),

			)
		);
		$repeater2->add_control(
			'doughnut_loop_data',
			array(
				'label'       => esc_html__( 'Data', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( '10 | 15 | 20', 'theplus' ),
				'placeholder' => esc_html__( 'Seprate by | ', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'separator'   => 'before',
			)
		);
		$repeater2->add_control(
			'doughnut_loop_background',
			array(
				'label'       => esc_html__( 'Background Colors', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( '#ff5a6e99|#8072fc99|#6fc78499', 'theplus' ),
				'placeholder' => esc_html__( 'Seprate by | ', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'separator'   => 'before',
			)
		);
		$repeater2->add_control(
			'doughnut_loop_border',
			array(
				'label'       => esc_html__( 'Border Colors', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( '#00000099|#00000099|#00000099', 'theplus' ),
				'placeholder' => esc_html__( 'Seprate by | ', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'doughnut_chart_datasets',
			array(
				'label'       => esc_html__( 'Chart Data Boxes', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater2->get_controls(),
				'default'     => array(
					array(
						'doughnut_loop_label'      => esc_html__( 'Jan', 'theplus' ),
						'doughnut_loop_data'       => esc_html__( '25 | 15 | 30 ', 'theplus' ),
						'doughnut_loop_background' => '#ff5a6e99|#8072fc99|#6fc78499',
						'doughnut_loop_border'     => '#00000099|#00000099|#00000099',
					),
					array(
						'doughnut_loop_label'      => esc_html__( 'Feb', 'theplus' ),
						'doughnut_loop_data'       => esc_html__( '12 | 18 | 28', 'theplus' ),
						'doughnut_loop_background' => '#f7d78299|#6fc78499|#8072fc99',
						'doughnut_loop_border'     => '#40e0d0|#40e0d0|#40e0d0',
					),
					array(
						'doughnut_loop_label'      => esc_html__( 'Mar', 'theplus' ),
						'doughnut_loop_data'       => esc_html__( '11 | 20 | 40', 'theplus' ),
						'doughnut_loop_background' => '#71d1dc99|#8072fc99|#ff5a6e99',
						'doughnut_loop_border'     => '#00000099|#00000099|#00000099',
					),
				),
				'title_field' => '{{{ doughnut_loop_label }}}',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'chart_dataset_bubble',
			array(
				'label'     => esc_html__( 'Datasets', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'select_chart' => 'bubble',
				),
			)
		);
		$repeater1 = new \Elementor\Repeater();
		$repeater1->add_control(
			'loop_label',
			array(
				'label'       => esc_html__( 'Label', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Label', 'theplus' ),
				'placeholder' => esc_html__( 'Enter label', 'theplus' ),
				'dynamic'     => array( 'active' => true ),

			)
		);
		$repeater1->add_control(
			'bubble_data',
			array(
				'label'       => esc_html__( 'Data', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( '[5|15|15][10|18|12][7|14|14]', 'theplus' ),
				'placeholder' => esc_html__( 'Seprate by | ', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'separator'   => 'before',
			)
		);
		$repeater1->add_control(
			'multi_dot_bg',
			array(
				'label'        => esc_html__( 'Multiple Background Colors', 'theplus' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'theplus' ),
				'label_off'    => esc_html__( 'Off', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			)
		);
		$repeater1->add_control(
			'dot_bg',
			array(
				'label'     => esc_html__( 'Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgb(0 0 0 / 50%)',
				'condition' => array(
					'multi_dot_bg!' => 'yes',
				),
			)
		);
		$repeater1->add_control(
			'multi_dot_bg_multiple',
			array(
				'label'       => esc_html__( 'Background', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( '#f7d78299|#6fc78499|#8072fc99', 'theplus' ),
				'placeholder' => esc_html__( 'Seprate by | ', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'multi_dot_bg' => 'yes',
				),
			)
		);
		$repeater1->add_control(
			'multi_dot_border',
			array(
				'label'        => esc_html__( 'Multiple Border Colors', 'theplus' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'theplus' ),
				'label_off'    => esc_html__( 'Off', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			)
		);
		$repeater1->add_control(
			'dot_border',
			array(
				'label'     => esc_html__( 'Dot Border', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgb(0 0 0 / 50%)',
				'condition' => array(
					'multi_dot_border!' => 'yes',
				),
			)
		);
		$repeater1->add_control(
			'multi_dot_border_multiple',
			array(
				'label'       => esc_html__( 'Dot Background Colors', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( '#f7d78299|#6fc78499|#8072fc99', 'theplus' ),
				'placeholder' => esc_html__( 'Seprate by | ', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'multi_dot_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'bubble_content',
			array(
				'label'       => esc_html__( 'Chart Data Boxes', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater1->get_controls(),
				'default'     => array(
					array(
						'loop_label'  => esc_html__( 'Jan', 'theplus' ),
						'bubble_data' => esc_html__( '[5|15|15][10|18|12][7|14|14]', 'theplus' ),
						'dot_bg'      => '#f7d78299',
						'dot_border'  => '#f7d78299',
					),
					array(
						'loop_label'  => esc_html__( 'Feb', 'theplus' ),
						'bubble_data' => esc_html__( '[7|10|16][15|14|18][15|17|12]', 'theplus' ),
						'dot_bg'      => '#6fc78499',
						'dot_border'  => '#6fc78499',
					),
					array(
						'loop_label'  => esc_html__( 'Mar', 'theplus' ),
						'bubble_data' => esc_html__( '[9|20|12][8|16|16][14|24|20]', 'theplus' ),
						'dot_bg'      => '#8072fc99',
						'dot_border'  => '#8072fc99',
					),
				),
				'title_field' => '{{{ loop_label }}}',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'chart_extra_options',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_responsive_control(
			'maxbarthickness',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Bar Size', 'theplus' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'condition' => array(
					'select_chart' => 'bar',
				),
			)
		);
		$this->add_responsive_control(
			'barthickness',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Bar Space', 'theplus' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					'select_chart' => 'bar',
				),
			)
		);
		$this->add_control(
			'show_grid_lines',
			array(
				'label'     => esc_html__( 'Grid Lines', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'select_chart!' => 'pie',
				),
			)
		);
		$this->start_controls_tabs(
			'tabs_axes_style',
			array(
				'condition' => array(
					'select_chart!'   => 'pie',
					'show_grid_lines' => 'yes',
				),
			)
		);
		$this->start_controls_tab(
			'tab_axes_x',
			array(
				'label'     => esc_html__( 'X Axes', 'theplus' ),
				'condition' => array(
					'select_chart!'   => 'pie',
					'show_grid_lines' => 'yes',
				),
			)
		);
		$this->add_control(
			'grid_color',
			array(
				'label'     => esc_html__( 'Grid Color X Axes', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgb(0 0 0 / 50%)',
				'condition' => array(
					'select_chart!'   => 'pie',
					'show_grid_lines' => 'yes',
				),
			)
		);
		$this->add_control(
			'zero_linecolor_x',
			array(
				'label'     => esc_html__( 'Zero Line Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, 0.25)',
				'condition' => array(
					'select_chart!'   => 'pie',
					'show_grid_lines' => 'yes',
				),
			)
		);
		$this->add_control(
			'draw_border_x',
			array(
				'label'     => esc_html__( 'Draw Border', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'select_chart!'   => 'pie',
					'show_grid_lines' => 'yes',
				),
			)
		);
		$this->add_control(
			'draw_on_chart_area_x',
			array(
				'label'     => esc_html__( 'Draw Border on Chart Area', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'select_chart!'   => 'pie',
					'show_grid_lines' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_axes_y',
			array(
				'label'     => esc_html__( 'Y Axes', 'theplus' ),
				'condition' => array(
					'select_chart!'   => 'pie',
					'show_grid_lines' => 'yes',
				),
			)
		);
		$this->add_control(
			'grid_color_xAxes',
			array(
				'label'     => esc_html__( 'Grid Color Y Axes', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgb(0 0 0 / 50%)',
				'condition' => array(
					'select_chart!'   => 'pie',
					'show_grid_lines' => 'yes',
				),
			)
		);
		$this->add_control(
			'zero_linecolor_y',
			array(
				'label'     => esc_html__( 'Zero Line Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, 0.25)',
				'condition' => array(
					'select_chart!'   => 'pie',
					'show_grid_lines' => 'yes',
				),
			)
		);
		$this->add_control(
			'draw_border_y',
			array(
				'label'     => esc_html__( 'Draw Border', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'select_chart!'   => 'pie',
					'show_grid_lines' => 'yes',
				),
			)
		);
		$this->add_control(
			'draw_on_chart_area_y',
			array(
				'label'     => esc_html__( 'Draw Border on Chart Area', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'select_chart!'   => 'pie',
					'show_grid_lines' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'show_labels',
			array(
				'label'     => esc_html__( 'Labels', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
				'condition' => array(
					'select_chart!' => 'pie',
				),
			)
		);
		$this->add_control(
			'show_labels_color',
			array(
				'label'     => esc_html__( 'Label Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#666',
				'condition' => array(
					'select_chart!' => 'pie',
					'show_labels'   => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'show_labels_size',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Label Size', 'theplus' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'   => array(
					'size' => 12,
				),
				'condition' => array(
					'select_chart!' => 'pie',
					'show_labels'   => 'yes',
				),
			)
		);
		$this->add_control(
			'show_legend',
			array(
				'label'     => esc_html__( 'Legend', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'show_legend_size',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Size', 'theplus' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'   => array(
					'size' => 12,
				),
				'condition' => array(
					'show_legend' => 'yes',
				),
			)
		);
		$this->add_control(
			'show_legend_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#666',
				'condition' => array(
					'show_legend' => 'yes',
				),
			)
		);
		$this->add_control(
			'show_legend_position',
			array(
				'label'     => esc_html__( 'Position', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'top'    => array(
						'title' => esc_html__( 'Top', 'theplus' ),
						'icon'  => 'eicon-v-align-top',
					),
					'bottom' => array(
						'title' => esc_html__( 'Bottom', 'theplus' ),
						'icon'  => 'eicon-v-align-bottom',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'top',
				'condition' => array(
					'show_legend' => 'yes',
				),
			)
		);
		$this->add_control(
			'show_legend_align',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'start'  => array(
						'title' => esc_html__( 'Start', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'end'    => array(
						'title' => esc_html__( 'End', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'condition' => array(
					'show_legend' => 'yes',
				),
			)
		);
		$this->add_control(
			'tension',
			array(
				'label'     => esc_html__( 'Smooth', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
				'condition' => array(
					'select_chart' => 'line',
				),
			)
		);
		$this->add_control(
			'custom_point_styles',
			array(
				'label'     => esc_html__( 'Custom Point Styles', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'select_chart' => array( 'line', 'radar', 'bubble' ),
				),
			)
		);
		$this->add_control(
			'point_styles',
			array(
				'label'     => esc_html__( 'Point Styles', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'circle',
				'options'   => array(
					'circle'      => esc_html__( 'Circle', 'theplus' ),
					'cross'       => esc_html__( 'Cross', 'theplus' ),
					'crossRot'    => esc_html__( 'CrossRot', 'theplus' ),
					'dash'        => esc_html__( 'Dash', 'theplus' ),
					'line'        => esc_html__( 'Line', 'theplus' ),
					'rect'        => esc_html__( 'Rect', 'theplus' ),
					'rectRounded' => esc_html__( 'RectRounded', 'theplus' ),
					'rectRot'     => esc_html__( 'RectRot', 'theplus' ),
					'star'        => esc_html__( 'Star', 'theplus' ),
					'triangle'    => esc_html__( 'Triangle', 'theplus' ),
				),
				'condition' => array(
					'select_chart'        => array( 'line', 'radar', 'bubble' ),
					'custom_point_styles' => 'yes',
				),
			)
		);
		$this->add_control(
			'point_bg',
			array(
				'label'     => esc_html__( 'Point Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e99',
				'condition' => array(
					'select_chart'        => array( 'line', 'radar' ),
					'custom_point_styles' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'point_n_size',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Point Normal Size', 'theplus' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'   => array(
					'size' => 5,
				),
				'condition' => array(
					'select_chart'        => array( 'line', 'radar' ),
					'custom_point_styles' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'point_h_size',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Point Hover Size', 'theplus' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'   => array(
					'size' => 10,
				),
				'condition' => array(
					'select_chart'        => array( 'line', 'radar' ),
					'custom_point_styles' => 'yes',
				),
			)
		);
		$this->add_control(
			'point_border_color',
			array(
				'label'     => esc_html__( 'Point Border', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#00000099',
				'condition' => array(
					'select_chart'        => array( 'line', 'radar' ),
					'custom_point_styles' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'point_border_width',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Point Border Width', 'theplus' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'   => array(
					'size' => 1,
				),
				'condition' => array(
					'select_chart'        => array( 'line', 'radar' ),
					'custom_point_styles' => 'yes',
				),
			)
		);
		$this->add_control(
			'show_tooltip',
			array(
				'label'     => esc_html__( 'Tooltip', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'tooltip_event',
			array(
				'label'     => esc_html__( 'Event', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hover',
				'options'   => array(
					'hover' => esc_html__( 'Hover', 'theplus' ),
					'click' => esc_html__( 'Click', 'theplus' ),
				),
				'condition' => array(
					'show_tooltip' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'tooltip_font_size',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Font Size', 'theplus' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'   => array(
					'size' => 12,
				),
				'condition' => array(
					'show_tooltip' => 'yes',
				),
			)
		);
		$this->add_control(
			'tooltip_color',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'condition' => array(
					'show_tooltip' => 'yes',
				),
			)
		);
		$this->add_control(
			'tooltip_body_color',
			array(
				'label'     => esc_html__( 'Body Font Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'condition' => array(
					'show_tooltip' => 'yes',
				),
			)
		);
		$this->add_control(
			'tooltip_bg',
			array(
				'label'     => esc_html__( 'Tooltip Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'show_tooltip' => 'yes',
				),
			)
		);
		$this->add_control(
			'aspect_ratio',
			array(
				'label'     => esc_html__( 'Aspect Ratio', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'maintain_aspect_ratio',
			array(
				'label'     => esc_html__( 'Maintain Aspect Ratio', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'c_animation',
			array(
				'label'     => esc_html__( 'Animation', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'easeOutQuart',
				'options'   => array(
					'linear'           => esc_html__( 'linear', 'theplus' ),
					'easeInQuad'       => esc_html__( 'easeInQuad', 'theplus' ),
					'easeOutQuad'      => esc_html__( 'easeOutQuad', 'theplus' ),
					'easeInOutQuad'    => esc_html__( 'easeInOutQuad', 'theplus' ),
					'easeInCubic'      => esc_html__( 'easeInCubic', 'theplus' ),
					'easeOutCubic'     => esc_html__( 'easeOutCubic', 'theplus' ),
					'easeInOutCubic'   => esc_html__( 'easeInOutCubic', 'theplus' ),
					'easeInQuart'      => esc_html__( 'easeInQuart', 'theplus' ),
					'easeOutQuart'     => esc_html__( 'easeOutQuart', 'theplus' ),
					'easeInOutQuart'   => esc_html__( 'easeInOutQuart', 'theplus' ),
					'easeInQuint'      => esc_html__( 'easeInQuint', 'theplus' ),
					'easeOutQuint'     => esc_html__( 'easeOutQuint', 'theplus' ),
					'easeInOutQuint'   => esc_html__( 'easeInOutQuint', 'theplus' ),
					'easeInSine'       => esc_html__( 'easeInSine', 'theplus' ),
					'easeOutSine'      => esc_html__( 'easeOutSine', 'theplus' ),
					'easeInOutSine'    => esc_html__( 'easeInOutSine', 'theplus' ),
					'easeInExpo'       => esc_html__( 'easeInExpo', 'theplus' ),
					'easeOutExpo'      => esc_html__( 'easeOutExpo', 'theplus' ),
					'easeInOutExpo'    => esc_html__( 'easeInOutExpo', 'theplus' ),
					'easeInCirc'       => esc_html__( 'easeInCirc', 'theplus' ),
					'easeOutCirc'      => esc_html__( 'easeOutCirc', 'theplus' ),
					'easeInOutCirc'    => esc_html__( 'easeInOutCirc', 'theplus' ),
					'easeInElastic'    => esc_html__( 'easeInElastic', 'theplus' ),
					'easeOutElastic'   => esc_html__( 'easeOutElastic', 'theplus' ),
					'easeInOutElastic' => esc_html__( 'easeInOutElastic', 'theplus' ),
					'easeInBack'       => esc_html__( 'easeInBack', 'theplus' ),
					'easeOutBack'      => esc_html__( 'easeOutBack', 'theplus' ),
					'easeInOutBack'    => esc_html__( 'easeInOutBack', 'theplus' ),
					'easeInBounce'     => esc_html__( 'easeInBounce', 'theplus' ),
					'easeOutBounce'    => esc_html__( 'easeOutBounce', 'theplus' ),
					'easeInOutBounce'  => esc_html__( 'easeInOutBounce', 'theplus' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'c_animation_duration',
			array(
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Duration', 'theplus' ),
				'range'   => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10000,
						'step' => 100,
					),
				),
				'default' => array(
					'size' => 1000,
				),
			)
		);
		$this->end_controls_section();

		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Bubble Array.
	 *
	 * @param string $bubble_data The data representing bubble coordinates and radii in a string format.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function bubble_array( $bubble_data ) {
		$bubble_data = trim( $bubble_data );
		$split_value = preg_match_all( '#\[([^\]]+)\]#U', $bubble_data, $fetch_and_match );
		if ( ! $split_value ) {
			return array();
		} else {
			$data_value = $fetch_and_match[1];
			$bubble     = array();
			foreach ( $data_value as $item_value ) {
				$item_value = trim( $item_value, '][ ' );
				$item_value = explode( '|', $item_value );

				if ( 3 != count( $item_value ) ) {
					continue;
				}

				$x_y_r    = new \stdClass();
				$x_y_r->x = floatval( trim( $item_value[0] ) );
				$x_y_r->y = floatval( trim( $item_value[1] ) );
				$x_y_r->r = floatval( trim( $item_value[2] ) );
				$bubble[] = $x_y_r;
			}
			return $bubble;
		}
	}

	/**
	 * Chart Render.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$output     = '';
		$label_data = '';
		$get_data   = '';
		$charttype  = '';

		$select_chart   = ! empty( $settings['select_chart'] ) ? $settings['select_chart'] : 'line';
		$bar_chart_type = ! empty( $settings['bar_chart_type'] ) ? $settings['bar_chart_type'] : 'vertical_bar';

		$doughnut_pie_chart_type = ! empty( $settings['doughnut_pie_chart_type'] ) ? $settings['doughnut_pie_chart_type'] : 'pie';

		if ( 'bar' === $select_chart && 'horizontal_bar' === $bar_chart_type ) {
			$charttype = 'horizontalBar';
		} elseif ( 'pie' === $select_chart && 'doughnut' === $doughnut_pie_chart_type ) {
			$charttype = 'doughnut';
		} else {
			$charttype = $select_chart;
		}

		$options   = array();
		$datasets  = array();
		$datasets1 = array();

		$chart_datasets = array();

		if ( 'pie' === $select_chart || 'polarArea' === $select_chart ) {
			if ( 'doughnut' !== $doughnut_pie_chart_type ) {

				$alone_data = array_map( 'floatval', explode( '|', $settings['alone_data'] ) );
				if ( ! empty( $alone_data ) ) {
					$datasets[] = array(
						'data'            => $alone_data,
						'backgroundColor' => explode( '|', $settings['alone_bg_colors'] ),
					);
				}

				if ( 'doughnut' === $doughnut_pie_chart_type && ! empty( $settings['alone_border_colors'] ) ) {
					$datasets[] = array(
						'borderColor' => explode( '|', $settings['alone_border_colors'] ),
					);
				}

				if ( 'polarArea' === $select_chart && ! empty( $settings['alone_border_colors_polar'] ) ) {
					$datasets[] = array(
						'borderColor' => explode( '|', $settings['alone_border_colors_polar'] ),
					);
				}
			} else {
				foreach ( $settings['doughnut_chart_datasets'] as $item1 ) {

					$datasets2['data'] = array_map( 'floatval', explode( '|', $item1['doughnut_loop_data'] ) );

					$datasets2['backgroundColor'] = $item1['doughnut_loop_background'] ? explode( '|', $item1['doughnut_loop_background'] ) : array();

					$datasets2['borderColor'] = $item1['doughnut_loop_border'] ? explode( '|', $item1['doughnut_loop_border'] ) : array();

					$datasets[] = $datasets2;
				}
			}
		} else {
			$chart_datasets = 'bubble' === $select_chart ? $settings['bubble_content'] : $settings['chart_content'];

			foreach ( $chart_datasets as $item ) {
				$datasets1['label'] = $item['loop_label'];

				if ( 'bubble' === $select_chart ) {
					$datasets1['data'] = $this->bubble_array( $item['bubble_data'] );
				} else {
					$datasets1['data'] = array_map( 'floatval', explode( '|', $item['loop_data'] ) );
				}

				if ( ( ! empty( $item['multi_dot_bg'] ) && 'yes' === $item['multi_dot_bg'] ) && ! empty( $item['multi_dot_bg_multiple'] ) ) {
					$datasets1['backgroundColor'] = explode( '|', $item['multi_dot_bg_multiple'] );
				} else {
					$datasets1['backgroundColor'] = $item['dot_bg'];
				}

				if ( ( ! empty( $item['multi_dot_border'] ) && 'yes' === $item['multi_dot_border'] ) && ! empty( $item['multi_dot_border_multiple'] ) ) {
					$datasets1['borderColor'] = explode( '|', $item['multi_dot_border_multiple'] );
				} else {
					$datasets1['borderColor'] = $item['dot_border'];
				}

				$datasets1['borderDash'] = array();
				if ( ( 'line' === $select_chart || 'radar' === $select_chart ) && ( ! empty( $item['line_styling_opt'] ) && 'yes' === $item['line_styling_opt'] ) ) {
					$datasets1['borderDash'] = array( 5, 5 );
				}

				if ( ! empty( $item['fill_opt'] ) && 'yes' === $item['fill_opt'] ) {
					$datasets1['fill'] = true;
				} else {
					$datasets1['fill'] = false;
				}

				if ( ( 'line' === $select_chart || 'radar' === $select_chart || 'bubble' === $select_chart ) ) {
					if ( ! empty( $settings['custom_point_styles'] ) && 'yes' === $settings['custom_point_styles'] ) {
						if ( ! empty( $settings['point_styles'] ) ) {
							$datasets1['pointStyle'] = $settings['point_styles'];
						}

						if ( ! empty( $settings['point_bg'] ) && 'bubble' !== $select_chart ) {
							$datasets1['pointBackgroundColor'] = $settings['point_bg'];
						}

						if ( ! empty( $settings['point_n_size']['size'] ) && 'bubble' !== $select_chart ) {
							$datasets1['pointRadius'] = $settings['point_n_size']['size'];
						}

						if ( ! empty( $settings['point_h_size']['size'] ) && 'bubble' !== $select_chart ) {
							$datasets1['pointHoverRadius'] = $settings['point_h_size']['size'];
						}

						if ( ! empty( $settings['point_border_width']['size'] ) && 'bubble' !== $select_chart ) {
							$datasets1['borderWidth'] = $settings['point_border_width']['size'];
						}

						if ( ! empty( $settings['point_border_color'] ) && 'bubble' !== $select_chart ) {
							$datasets1['pointBorderColor'] = $settings['point_border_color'];
						}
					}

					if ( 'line' === $select_chart && ( ! empty( $settings['tension'] ) && 'yes' === $settings['tension'] ) ) {
						$datasets1['tension'] = 0.4;
					} else {
						$datasets1['tension'] = 0;
					}
				}

				if ( 'bar' === $select_chart ) {
					if ( ! empty( $settings['barthickness']['size'] ) ) {
						$datasets1['barThickness'] = $settings['barthickness']['size'];  /*space*/
					}
					if ( ! empty( $settings['maxbarthickness']['size'] ) ) {
						$datasets1['maxBarThickness'] = $settings['maxbarthickness']['size'];  /*size*/
					}
				}

				$datasets[] = $datasets1;
			}
		}

		if ( 'pie' === $select_chart && ( ! empty( $doughnut_pie_chart_type ) && 'pie' === $doughnut_pie_chart_type ) ) {
			$options['cutoutPercentage'] = 0;
		} elseif ( 'pie' === $select_chart && ( ! empty( $doughnut_pie_chart_type ) && 'doughnut' === $doughnut_pie_chart_type ) ) {
			$options['cutoutPercentage'] = 50;
		} elseif ( ! empty( $settings['show_grid_lines'] ) && 'yes' === $settings['show_grid_lines'] ) {
				$options['scales'] = array(
					'yAxes' => array(
						array(
							'ticks'     => array(
								'display'   => ! empty( $settings['show_labels'] ) ? true : false,
								'fontColor' => $settings['show_labels_color'],
								'fontSize'  => ! empty( $settings['show_labels_size']['size'] ) ? $settings['show_labels_size']['size'] : '',
							),
							'gridLines' => array(
								'color'           => $settings['grid_color'],
								'zeroLineColor'   => $settings['zero_linecolor_y'],
								'drawBorder'      => ! empty( $settings['draw_border_y'] ) ? true : false,
								'drawOnChartArea' => ! empty( $settings['draw_on_chart_area_y'] ) ? true : false,

							),
						),
					),
					'xAxes' => array(
						array(
							'ticks'     => array(
								'display'   => ! empty( $settings['show_labels'] ) ? true : false,
								'fontColor' => $settings['show_labels_color'],
								'fontSize'  => ! empty( $settings['show_labels_size']['size'] ) ? $settings['show_labels_size']['size'] : '',
							),
							'gridLines' => array(
								'color'           => $settings['grid_color_xAxes'],
								'zeroLineColor'   => $settings['zero_linecolor_x'],
								'drawBorder'      => ! empty( $settings['draw_border_x'] ) ? true : false,
								'drawOnChartArea' => ! empty( $settings['draw_on_chart_area_x'] ) ? true : false,
							),
						),
					),
				);
		} else {
			$options['scales'] = array(
				'yAxes' => array(
					array(
						'ticks'     => array(
							'display'   => $settings['show_labels'] ? true : false,
							'fontColor' => $settings['show_labels_color'],
							'fontSize'  => isset( $settings['show_labels_size']['size'] ) ? $settings['show_labels_size']['size'] : '',
						),
						'gridLines' => array(
							'display' => false,
						),
					),
				),
				'xAxes' => array(
					array(
						'ticks'     => array(
							'display'   => $settings['show_labels'] ? true : false,
							'fontColor' => $settings['show_labels_color'],
							'fontSize'  => isset( $settings['show_labels_size']['size'] ) ? $settings['show_labels_size']['size'] : '',
						),
						'gridLines' => array(
							'display' => false,
						),
					),
				),
			);
		}

		if ( ! empty( $settings['show_legend'] ) && 'yes' === $settings['show_legend'] ) {
			if ( ! empty( $settings['show_legend_position'] ) ) {
				$options['legend'] = array(
					'position' => $settings['show_legend_position'],
					'align'    => $settings['show_legend_align'],
					'labels'   => array(
						'fontColor' => $settings['show_legend_color'],
						'fontSize'  => $settings['show_legend_size']['size'],
					),
				);
			}
		} else {
			$options['legend'] = array( 'display' => false );
		}

		if ( ! empty( $settings['c_animation'] ) && ! empty( $settings['c_animation_duration']['size'] ) ) {
			$options['animation'] = array(
				'duration' => $settings['c_animation_duration']['size'],
				'easing'   => $settings['c_animation'],
			);
		}

		if ( ! empty( $settings['show_tooltip'] ) && 'yes' === $settings['show_tooltip'] ) {
			if ( ! empty( $settings['tooltip_bg'] ) || ! empty( $settings['tooltip_color'] ) || ! empty( $settings['tooltip_body_color'] ) ) {
				$options['tooltips'] = array(
					'backgroundColor' => $settings['tooltip_bg'],
					'titleFontColor'  => $settings['tooltip_color'],
					'bodyFontColor'   => $settings['tooltip_body_color'],
					'titleFontSize'   => $settings['tooltip_font_size']['size'],
					'bodyFontSize'    => $settings['tooltip_font_size']['size'],
				);
			}

			if ( ! empty( $settings['tooltip_event'] ) && 'click' === $settings['tooltip_event'] ) {
				$options['events'] = array( 'click' );
			}
		} else {
			$options['tooltips'] = array( 'enabled' => false );
		}

		if ( ! empty( $settings['aspect_ratio'] ) && 'yes' === $settings['aspect_ratio'] ) {
			$options['aspectRatio'] = 1;
		}

		if ( ! empty( $settings['maintain_aspect_ratio'] ) && 'yes' !== $settings['maintain_aspect_ratio'] ) {
			$options['maintainAspectRatio'] = false;
		}

		$this->add_render_attribute(
			array(
				'get_all_chart_values' => array(
					'data-settings' => array(
						wp_json_encode(
							array_filter(
								array(
									'type'    => $charttype,
									'data'    => array(
										'labels'   => explode( '|', $settings['main_label'] ),
										'datasets' => $datasets,
									),
									'options' => $options,
								)
							)
						),
					),
				),
			)
		);

		$unique = uniqid( 'chart' );

		$output .= '<div class="tp-chart-wrapper" data-id="' . esc_attr( $unique ) . '" ' . $this->get_render_attribute_string( 'get_all_chart_values' ) . '>';

			$output .= '<canvas id="' . esc_attr( $unique ) . '"></canvas>';

		$output .= '</div>';

		echo $output;
	}
}
