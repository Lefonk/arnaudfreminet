<?php
/**
 * Analog Unsplash Extension
 *
 * @package   Analog Unsplash
 * @author    Analog
 * @license   GPL-3.0
 * @link      https://analogwp.com
 * @copyright 2017 Analog (Pty) Ltd
 */

namespace Analog\Modules\Unsplash\Endpoint;

use Analog\Modules\Unsplash\Core\Init;
use Analog\Modules\Unsplash\Core\Api\Remote;
use Analog\Modules\Unsplash;
use WP_REST_Server;
use WP_REST_Request;
use WP_REST_Response;

/**
 * @subpackage REST_Controller
 */
class Base {
	/**
	 * Instance of this class.
	 *
	 * @since    0.8.1
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Set up WordPress hooks and filters
	 *
	 * @return void
	 */
	public function do_hooks() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     0.8.1
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Base ) ) {
			self::$instance = new self();
			self::$instance->do_hooks();
		}
	}

	/**
	 * Register the routes for the objects of the controller.
	 */
	public function register_routes() {
		$endpoints = array(
			'/collections'  => array(
				WP_REST_Server::READABLE => 'image_collections',
			),
			'/upload'       => array(
				WP_REST_Server::CREATABLE => 'upload_image',
			),
			'/resize'       => array(
				WP_REST_Server::CREATABLE => 'resize_image',
			),
			'/mark_upload/' => array(
				WP_REST_Server::CREATABLE => 'mark_as_uploaded',
			),

		);

		foreach ( $endpoints as $endpoint => $details ) {
			foreach ( $details as $method => $callback ) {
				register_rest_route(
					'ang-up',
					$endpoint,
					array(
						'methods'             => $method,
						'callback'            => array( $this, $callback ),
						'permission_callback' => array( $this, 'rest_permission_check' ),
					)
				);
			}
		}

	}

	/**
	 * Get all unsplash image collections.
	 *
	 * @param WP_REST_Request $request Request object.
	 *
	 * @return array
	 */
	public function image_collections( WP_REST_Request $request ) {
		$force_update = filter_var( $request->get_param( 'force_update' ), FILTER_VALIDATE_BOOLEAN );
		if ( $force_update ) {
			return Remote::get_loaded_photos( true );
		}
		return Remote::get_loaded_photos();
	}

	/**
	 * Upload Image to /uploads directory.
	 *
	 * @param WP_REST_Request $request Request object.
	 * @return array
	 */
	public function upload_image( WP_REST_Request $request ) {

		if ( is_user_logged_in() && current_user_can( 'edit_theme_options' ) ) {

			error_reporting( E_ALL | E_STRICT );

			// Create /ang-up directory inside /uploads to temporarily store images
			if ( ! is_dir( ANG_UP_UPLOAD_PATH ) ) {
				wp_mkdir_p( ANG_UP_UPLOAD_PATH );
			}

			// Is directory writeable, if not exit with an error
			if ( ! is_writable( ANG_UP_UPLOAD_PATH . '/' ) ) {
				$response = json_encode(
					array(
						'error' => true,
						'msg'   => __( 'Unable to save image, check your server permissions of `uploads/ang-up`', 'ang-pro' ),
					)
				);
				wp_send_json( $response );
			}

			$path = ANG_UP_UPLOAD_PATH . '/'; // Temp Image Path

			// Get data params from the $request.
			if ( $request ) {
				$id  = sanitize_key( $request->get_param( 'id' ) ); // Image ID
				$img = sanitize_text_field( $request->get_param( 'image' ) ); // Image URL
			}

			// If ID and IMG not set, exit
			if ( ! isset( $id ) || ! isset( $img ) ) {
				$response = array(
					'error'    => true,
					'msg'      => __( 'An issue occurred retrieving image info via the REST API.', 'ang-pro' ),
					'path'     => $path,
					'filename' => $filename,
				);
				wp_send_json( $response );
			}

			// Create temp. image variables
			$filename = $id . '.jpg';
			$img_path = $path . '' . $filename;

			if ( function_exists( 'copy' ) ) {

				// Save file to server using copy() function
				$saved_file = @copy( $img . 'jpg', $img_path );

				// Was the temporary image saved?
				if ( $saved_file ) {

					if ( file_exists( $path . '' . $filename ) ) {
						// SUCCESS - Image saved.
						$response = array(
							'error'    => false,
							'msg'      => __( 'Image successfully uploaded to server.', 'ang-pro' ),
							'path'     => $path,
							'filename' => $filename,
						);
					} else {
						// ERROR - File does not exist.
						$response = array(
							'error'    => true,
							'msg'      => __( 'Uploaded image not found, please ensure you have proper permissions set on the uploads directory.', 'ang-pro' ),
							'path'     => '',
							'filename' => '',
						);
					}
				} else {
					// ERROR - Error on save.
					$response = array(
						'error'    => true,
						'msg'      => __( 'Unable to download image to server, please check the server permissions of the ang-up folder in your WP uploads directory.', 'ang-pro' ),
						'path'     => '',
						'filename' => '',
					);
				}
			}
			// copy() not enabled.
			else {
				$response = array(
					'error'    => true,
					'msg'      => __( 'The core PHP copy() function is not available on your server. Please contact your server administrator to upgrade your PHP version.', 'ang-pro' ),
					'path'     => $path,
					'filename' => $filename,
				);
			}

			wp_send_json( $response );

		}

	}

	/**
	 *  Resize Image and run thru media uploader.
	 *
	 * @param WP_REST_Request $request Request object.
	 * @return array
	 */

	public function resize_image( WP_REST_Request $request ) {

		if ( is_user_logged_in() && current_user_can( 'edit_theme_options' ) ) {

			error_reporting( E_ALL | E_STRICT );

			require_once ABSPATH . 'wp-admin/includes/file.php'; // download_url()
			require_once ABSPATH . 'wp-admin/includes/image.php'; // wp_read_image_metadata()

			if ( $request && $request->get_param( 'path' ) ) {

				$path            = sanitize_text_field( $request->get_param( 'path' ) ); // Path on server
				$name            = sanitize_text_field( $request->get_param( 'filename' ) ); // name
				$filename        = $path . $name; // full filename
				$filetype        = wp_check_filetype( basename( $filename ), null );
				$title           = sanitize_text_field( $request->get_param( 'title' ) ); // Title
				$alt             = sanitize_text_field( $request->get_param( 'alt' ) ); // Alt text
				$caption         = sanitize_text_field( $request->get_param( 'caption' ) ); // Caption text
				$custom_filename = sanitize_title( $request->get_param( 'custom_filename' ) ); // Custom filename
				$download_w      = ! empty( $request->get_param( 'width' ) ) ? absint( $request->get_param( 'width' ) ) : 1600; // width
				$download_h      = ! empty( $request->get_param( 'height' ) ) ? absint( $request->get_param( 'height' ) ) : 800; // height

				$name = ( ! empty( $custom_filename ) ) ? $custom_filename . '.jpg' : $name;

				// Resize image to max size (set in Settings)
				$image = wp_get_image_editor( $filename );
				if ( ! is_wp_error( $image ) ) {
					$image->resize( $download_w, $download_h, false );
					$image->save( $filename );
				}

				// Get upload directory
				$wp_upload_dir = wp_upload_dir(); // ['path'] ['basedir']

				// Copy file from uploads/ang-up to a media library directory.
				$new_filename = $wp_upload_dir['path'] . '/' . $name;
				$copy_file    = @copy( $filename, $new_filename );

				if ( ! $copy_file ) {

					// Error
					$response = array(
						'success' => false,
						'msg'     => __( 'Unable to copy image to the media library. Please check your server permissions.', 'ang-pro' ),
					);

				} else {

					// Build attachment array
					$attachment = array(
						'guid'           => $wp_upload_dir['url'] . basename( $new_filename ),
						'post_mime_type' => $filetype['type'],
						'post_title'     => $title,
						'post_excerpt'   => $caption,
						'post_content'   => '',
						'post_status'    => 'inherit',
					);

					$image_id = wp_insert_attachment( $attachment, $new_filename, 0 ); // Insert as attachment

					update_post_meta( $image_id, '_wp_attachment_image_alt', $alt ); // Add alt text

					$attach_data = wp_generate_attachment_metadata( $image_id, $new_filename ); // Generate metadata
					wp_update_attachment_metadata( $image_id, $attach_data ); // Add metadata

					// Response
					if ( file_exists( $new_filename ) ) { // If image was uploaded temporary image

						// Success
						$response = array(
							'success'   => true,
							'msg'       => __( 'Image successfully uploaded to your media library!', 'ang-pro' ),
							'id'        => $image_id,
							'url'       => wp_get_attachment_url( $image_id ),
							'admin_url' => admin_url(),
						);

					} else {

						// Error
						$response = array(
							'success' => false,
							'msg'     => __( 'There was an error sending the image to your media library. Please check your server permissions and confirm the upload_max_filesize setting (php.ini) is large enough for the downloaded image (8mb minimum is recommended).', 'ang-pro' ),
							'id'      => '',
							'url'     => '',
						);
					}
				}

				// Delete temporary image
				if ( file_exists( $filename ) ) {
					unlink( $filename );
				}

				wp_send_json( $response ); // Send response as JSON

			} else {

				$response = array(
					'success' => false,
					'msg'     => __( 'There was an error resizing the image, please try again.', 'ang-pro' ),
					'id'      => '',
					'url'     => '',
				);
				wp_send_json( $response ); // Send response as JSON

			}
		}
	}

	/**
	 * Mark a image as uploaded.
	 *
	 * @param WP_REST_Request $request Request object.
	 *
	 * @return WP_REST_Response
	 */
	public function mark_as_uploaded( WP_REST_Request $request ) {
		$img_id          = $request->get_param( 'img_id' );
		$upload          = $request->get_param( 'upload' );
		$uploaded_images = get_user_meta( get_current_user_id(), Init::$user_meta_uploads, true );
		if ( ! $uploaded_images ) {
			$uploaded_images = array();
		}
		if ( $upload ) {
			$uploaded_images[ $img_id ] = $upload;
		} elseif ( isset( $uploaded_images[ $img_id ] ) ) {
			return;
		}
		$data                  = array();
		$data['template_id']   = $img_id;
		$data['action']        = $upload;
		$data['update_status'] = update_user_meta( get_current_user_id(), Init::$user_meta_uploads, $uploaded_images );
		$data['uploads']       = get_user_meta( get_current_user_id(), Init::$user_meta_uploads, true );
		return new WP_REST_Response( $data, 200 );
	}

	/**
	 * Check if a given request has access to update a setting
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @return WP_Error|bool
	 */
	public function rest_permission_check() {
		return current_user_can( 'edit_posts' );
	}
}

Base::get_instance();
