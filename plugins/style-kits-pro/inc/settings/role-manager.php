<?php
/**
 * Analog User Roles Tab.
 *
 * @package AnalogPro/Admin
 * @subpackage Analog/Admin
 */

namespace AnalogPRO\Settings;

use Analog\Settings\Admin_Settings;
use Analog\Settings\Settings_Page;
use \Analog\Options;
use \Analog\Quick_Edit;
use \Analog\Elementor\Tools;

defined( 'ABSPATH' ) || exit;

/**
 * User_Roles.
 */
class Role_Manager extends Settings_Page {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id    = 'uroles';
		$this->label = __( 'User Roles', 'ang-pro' );

		add_action( 'ang_settings_start', array( $this, 'enqueue_scripts' ) );
		add_filter( 'ang_user_roles_enabled', '__return_true' );
		$this->user_roles_filter();

		parent::__construct();
	}

	/**
	 * Get settings array.
	 *
	 * @return array
	 */
	public function get_settings() {
		$settings = apply_filters(
			'ang_uroles_settings',
			array(
				array(
					'title' => __( 'User Roles Management', 'ang-pro' ),
					'desc'  => sprintf(
						'%1$s <a href="https://analogwp.com/docs/user-roles-and-style-kits-visibility/" target="_blank">%2$s</a>',
						__( 'Disable Style Kits  functionality for specific user roles.', 'ang-pro' ),
						__( 'Learn more', 'ang-pro' ),
					),
					'class' => 'ang-uroles-heading',
					'type'  => 'content',
					'id'    => 'ang-uroles',
				),
				array(
					'title' => __( 'WordPress Admin Dashboard', 'ang-pro' ),
					'class' => 'collapsible',
					'id'    => 'uroles-dashboard-section',
					'type'  => 'collapsiblestart',
				),
				array(
					'title' => '',
					'desc'  => __( 'Selected user roles will not be able to import templates from the wp-admin Dashboard, or find any reference to Style Kits.', 'ang-pro' ),
					'type'  => 'title',
					'class' => 'ang-temp-gallery',
					'id'    => 'ang-uroles-library-dashboard',
				),
				array(
					'title'   => __( 'User Roles', 'ang-pro' ),
					'id'      => 'library_dashboard_roles',
					'default' => false,
					'type'    => 'multi-checkbox',
					'options' => get_user_roles(),
				),
				array(
					'type' => 'sectionend',
					'id'   => 'ang-uroles-template-gallery',
				),
				array(
					'type' => 'collapsibleend',
				),

				array(
					'title' => __( 'Elementor Editor', 'ang-pro' ),
					'class' => 'collapsible',
					'id'    => 'uroles-editor-section',
					'type'  => 'collapsiblestart',
				),
				array(
					'title' => '',
					'desc'  => __( 'Selected user roles will not be able to import templates from Elementor editor or have access to Style Kits settings and controls.', 'ang-pro' ),
					'type'  => 'title',
					'class' => 'ang-style-kits',
					'id'    => 'ang-uroles-library-editor',
				),
				array(
					'title'   => __( 'User Roles', 'ang-pro' ),
					'id'      => 'library_editor_roles',
					'default' => false,
					'type'    => 'multi-checkbox',
					'options' => get_user_roles(),
				),
				array(
					'type' => 'sectionend',
					'id'   => 'ang-uroles-wp-dashboard',
				),
				array(
					'type' => 'collapsibleend',
				),
			)
		);

		return apply_filters( 'ang_get_settings_' . $this->id, $settings );
	}

	/**
	 * Enqueue Scripts.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'ang_pro_settings', ANG_PRO_URL . 'assets/css/admin-settings.css', array(), filemtime( ANG_PRO_PATH . 'assets/css/admin-settings.css' ) );
	}

	/**
	 * Controls Style kits functionality for specific user roles.
	 */
	public function user_roles_filter() {
		$role_switches = array(
			'library_dashboard_roles',
			'library_editor_roles',
		);
		foreach ( $role_switches as $switches ) :
			$options = Options::get_instance()->get( $switches );
			if ( empty( $options ) ) {
				continue;
			}
			foreach ( $options as $key => $value ) {
				$user = wp_get_current_user();
				if ( '1' === $value && in_array( $key, $user->roles, true ) ) {
					switch ( $switches ) {
						case 'library_dashboard_roles':
							add_action(
								'admin_menu',
								function() use ( $user ) {
									remove_menu_page( 'analogwp_templates' );
									remove_submenu_page( 'analogwp_templates', 'analogwp_templates' );

									global $pagenow;
									if ( ! in_array( 'administrator', $user->roles, true ) && isset( $_GET['page'] ) && ( 'admin.php' === $pagenow ) && ( 'ang-settings' === $_GET['page'] || 'analogwp_templates' === $_GET['page'] ) ) { // phpcs:ignore
										wp_safe_redirect( admin_url(), 301 );
										exit;
									}
								}
							);

							// Remove SK quick edit & bulk edit actions from supported post types.
							remove_action( 'quick_edit_custom_box', array( Quick_Edit::get_instance(), 'display_custom_quickedit_book' ), 10 );
							remove_action( 'bulk_edit_custom_box', array( Quick_Edit::get_instance(), 'display_custom_quickedit_book' ), 10 );

							// Remove Apply Global Kit link from post row actions.
							remove_filter( 'post_row_actions', array( Tools::get_instance(), 'filter_post_row_actions' ), 15 );
							remove_filter( 'page_row_actions', array( Tools::get_instance(), 'filter_post_row_actions' ), 15 );
							break;
						default:
							// Helper filter for SK elementor disable switch.
							add_filter( 'ang_sk_elementor_disabled', '__return_true' );

							// Remove SK scripts from elementor editor.
							add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'remove_elementor_scripts' ) );
							add_action( 'elementor/preview/enqueue_styles', array( $this, 'remove_elementor_scripts' ) );
							break;
					}
				}
			}
		endforeach;
	}

	/**
	 * Removes Style Kit Modal Scripts & Styles from Elementor.
	 */
	public function remove_elementor_scripts() {
		wp_dequeue_style( 'analogwp-elementor-modal' );
		wp_dequeue_style( 'analog-google-fonts' );
		wp_dequeue_script( 'analogwp-elementor-modal' );
	}

	/**
	 * Output the settings.
	 */
	public function output() {
		$settings = $this->get_settings();

		Admin_Settings::output_fields( $settings );
	}

	/**
	 * Save settings.
	 */
	public function save() {
		$settings = $this->get_settings();

		Admin_Settings::save_fields( $settings );
	}
}

return new Role_Manager();
