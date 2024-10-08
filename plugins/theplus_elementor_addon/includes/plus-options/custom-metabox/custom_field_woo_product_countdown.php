<?php
/**
 * Widget Name: Countdown
 * Description: Display countdown.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'cmb2_admin_init', 'theplus_custom_field_woo_product_countdown_metaboxes' );
/**
 * Get Widget Name
 *
 * @since 5.5.2
 * @version 5.5.2
 */
function theplus_custom_field_woo_product_countdown_metaboxes() {
	$cmb = new_cmb2_box(
		[
			'id'           => 'tpc_pro_countdown_tabs',
			'title'        => esc_html__( 'WooCommerce Countdown', 'theplus' ),
			'object_types' => 'product',
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true,
		]
	);
	$cmb->add_field(
		[
			'name' => esc_html__( 'Normal Countdown', 'theplus' ),
			'type' => 'title',
			'id'   => 'tpc_pro_countdown_normal_countdown',
		]
	);

	$cmb->add_field(
		[
			'name'        => esc_html__( 'Date', 'theplus' ),
			'id'          => 'tpc_proc_ndate',
			'type'        => 'text_date',
			'date_format' => 'm/d/Y',
		]
	);
	$cmb->add_field(
		[
			'name' => esc_html__( 'Scarcity Countdown (Evergreen)', 'theplus' ),
			'type' => 'title',
			'id'   => 'tpc_pro_countdown_normal_scarcity',
		]
	);
	$cmb->add_field(
		[
			'name'            => esc_html__( 'Minutes', 'theplus' ),
			'id'              => 'tpc_proc_ns_days',
			'type'            => 'text',
			'attributes'      => array(
				'type'    => 'number',
				'pattern' => '\d*',
				'min'     => '0',
				'max'     => '10000',
			),
			'sanitization_cb' => 'absint',
			'escape_cb'       => 'absint',
		]
	);
	$cmb->add_field(
		[
			'name' => esc_html__( 'Fake Numbers Counter', 'theplus' ),
			'type' => 'title',
			'id'   => 'tpc_pro_countdown_fake_numbers_counter',
		]
	);
	$cmb->add_field(
		[
			'name'            => esc_html__( 'Initial Number', 'theplus' ),
			'id'              => 'tpc_proc_fn_ini_num',
			'type'            => 'text',
			'attributes'      => array(
				'type'    => 'number',
				'pattern' => '\d*',
				'min'     => '0',
				'max'     => '10000',
			),
			'sanitization_cb' => 'absint',
			'escape_cb'       => 'absint',
		]
	);
	$cmb->add_field(
		[
			'name'            => esc_html__( 'Final Number', 'theplus' ),
			'id'              => 'tpc_proc_fn_final_num',
			'type'            => 'text',
			'attributes'      => array(
				'type'    => 'number',
				'pattern' => '\d*',
				'min'     => '0',
				'max'     => '10000',
			),
			'sanitization_cb' => 'absint',
			'escape_cb'       => 'absint',
		]
	);
	$cmb->add_field(
		[
			'name'            => esc_html__( 'Number Range', 'theplus' ),
			'id'              => 'tpc_proc_fn_num_range',
			'type'            => 'text',
			'attributes'      => array(
				'type'    => 'number',
				'pattern' => '\d*',
				'min'     => '0',
				'max'     => '100',
			),
			'sanitization_cb' => 'absint',
			'escape_cb'       => 'absint',
		]
	);
	$cmb->add_field(
		[
			'name'            => esc_html__( 'Change Interval (In Seconds)', 'theplus' ),
			'id'              => 'tpc_proc_ci_in_sec',
			'type'            => 'text',
			'attributes'      => array(
				'type'    => 'number',
				'pattern' => '\d*',
				'min'     => '0',
				'max'     => '100',
			),
			'sanitization_cb' => 'absint',
			'escape_cb'       => 'absint',
		]
	);
}
