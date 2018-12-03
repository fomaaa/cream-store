<?php
/**
 * Product Input Fields for WooCommerce - Main Class
 *
 * @version 1.2.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Alg_WC_PIF_Main' ) ) :

class Alg_WC_PIF_Main {

	/** @var string scope. */
	public $scope = '';

	/**
	 * Constructor.
	 *
	 * @version 1.2.0
	 * @since   1.0.0
	 * @todo    (later) solve archives add to cart issue (especially if required is set)
	 */
	function __construct( $scope ) {
		$this->scope = $scope;
		if ( 'yes' === get_wc_pif_option( $this->scope . '_enabled', 'yes' ) ) {
			// Show fields at frontend
			$position = get_wc_pif_option( 'frontend_position', 'woocommerce_before_add_to_cart_button2' );
			if ( 'disable' != $position ) {
				add_action( $position, array( $this, 'add_product_input_fields_to_frontend' ), get_wc_pif_option( 'frontend_position_priority', 10 ) );
			}
			// Process from $_POST/session to cart item data
			add_filter( 'woocommerce_add_to_cart_validation',       array( $this, 'validate_product_input_fields_on_add_to_cart' ),    PHP_INT_MAX, 2 );
			add_filter( 'woocommerce_add_cart_item_data',           array( $this, 'add_product_input_fields_to_cart_item_data' ),      PHP_INT_MAX, 3 );
			add_filter( 'woocommerce_get_cart_item_from_session',   array( $this, 'get_cart_item_product_input_fields_from_session' ), PHP_INT_MAX, 3 );
			// Show details at cart
			add_filter( 'woocommerce_cart_item_name',               array( $this, 'add_product_input_fields_to_cart_item_name' ),      PHP_INT_MAX, 3 );
			// Add item meta from cart to order
			if ( version_compare( get_option( 'woocommerce_version', null ), '3.0.0', '<' ) ) {
				add_action( 'woocommerce_add_order_item_meta',      array( $this, 'add_product_input_fields_to_order_item_meta' ),     PHP_INT_MAX, 3 );
			} else {
				add_action( 'woocommerce_checkout_create_order_line_item', array( $this, 'save_values_in_item' ),                             PHP_INT_MAX, 4 );
				add_action( 'woocommerce_new_order_item',                  array( $this, 'add_product_input_fields_to_order_item_meta_wc3' ), PHP_INT_MAX, 3 );
			}
			// Add option to hover textarea value on frontend showing its full value
			add_action( 'wp_head',                                      array( $this, 'hover_textarea_value' ) );
			// Text Area Auto Height option
			add_action( 'wp_head',                                      array( $this, 'textarea_auto_height' ) );
		}
		// Show details at order details, emails
		add_filter( 'woocommerce_order_item_name',                  array( $this, 'add_product_input_fields_to_order_item_name' ),     PHP_INT_MAX, 2 );
		// Output product input fields in order at backend
		add_action( 'woocommerce_before_order_itemmeta',            array( $this, 'output_custom_input_fields_in_admin_order' ),       10, 3 );
		// Output product input fields in invoice plugin
		add_action( 'wpo_wcpdf_after_item_meta',                    array( $this, 'output_custom_input_fields_in_invoice_plugin' ), 10, 3 );
		// Add to emails
		add_filter( 'woocommerce_email_attachments',                array( $this, 'add_files_to_email_attachments' ),                  PHP_INT_MAX, 3 );
		// Setups Advanced Order Export For WooCommerce plugin
		add_filter( 'woe_get_order_product_value_apif',             array( $this, 'setup_adv_order_export_plugin_column' ), 10, 5 );
		add_filter( 'woe_get_order_product_fields',                 array($this,  'add_input_fields_columns_to_adv_order_export_plugin' ) );
	}

	/**
     * Adds Input Fields Column on Advanced Order Export For WooCommerce plugin
     * @see https://br.wordpress.org/plugins/woo-order-export-lite/
     *
	 * @version 1.2.0
	 * @since   1.2.0
     *
	 * @param $fields
	 *
	 * @return mixed
	 */
	function add_input_fields_columns_to_adv_order_export_plugin( $fields ) {
		$fields['apif'] = array( 'label' => __( "Input Fields", 'product-input-fields-for-woocommerce' ), 'colname' => __( "Input Fields", 'product-input-fields-for-woocommerce' ), 'checked' => 1 );
		return $fields;
	}

	/**
     * Setups Input Fields Columns on Advanced Order Export For WooCommerce plugin
     *
	 * @version 1.2.0
	 * @since   1.2.0
     *
	 * @param $value
	 * @param WC_Order $order
	 * @param WC_Order_Item_Product $item
	 * @param $product
	 * @param $itemmeta
	 *
	 * @return string
	 */
	public function setup_adv_order_export_plugin_column( $value, \WC_Order $order, \WC_Order_Item_Product $item, $product, $itemmeta ) {
		$value .= $this->output_custom_input_fields_in_admin_order( $item->get_id(), $item, $product, false, true );
		return $value;
	}

	/**
     * Outputs custom input fields in invoice plugin
     *
     * @see https://br.wordpress.org/plugins/woocommerce-pdf-invoices-packing-slips/
     *
	 * @version 1.1.9
	 * @since   1.1.9
	 * @param $type
	 * @param $item
	 * @param $order
	 */
	public function output_custom_input_fields_in_invoice_plugin( $type, $item, $order ) {
		$this->output_custom_input_fields_in_admin_order( $item['item_id'], $item['item'], wc_get_product( $item['product_id'] ) );
	}

	/**
	 * Makes the textarea auto increase its height as users type
	 *
	 * @version 1.1.4
	 * @since   1.1.4
	 */
	public function textarea_auto_height() {
		if (
			is_admin() ||
			'yes' !== get_wc_pif_option( 'frontend_textarea_auto_height', 'yes' ) ||
			( ! is_product() )
		) {
			return;
		}
		?>
        <script>
            var pif_ta_autoheigh = {
                loaded: false,
                textarea_selector: '',
                init: function (textarea_selector) {
                    if (this.loaded === false) {
                        this.loaded = true;
                        this.textarea_selector = textarea_selector;
                        var textareas = document.querySelectorAll(this.textarea_selector);
                        [].forEach.call(textareas, function (el) {
                            el.addEventListener('input', function () {
                                pif_ta_autoheigh.auto_grow(this);
                            });
                        });
                    }
                },
                auto_grow: function (element) {
                    element.style.height = 'auto';
                    element.style.height = (element.scrollHeight) + "px";
                }
            };
            document.addEventListener("DOMContentLoaded", function () {
                pif_ta_autoheigh.init('.alg-product-input-fields-table textarea');
            });
        </script>
        <style>
            .alg-product-input-fields-table textarea {
                overflow: hidden;
            }
        </style>
		<?php
	}

	/**
	 * Add option to hover textarea value on frontend showing its full value
	 *
	 * @version 1.1.4
	 * @since   1.1.4
	 */
	public function hover_textarea_value() {
		if (
			is_admin() ||
			'yes' !== get_wc_pif_option( 'frontend_smart_textarea', 'yes' ) ||
			( ! is_cart() && ! is_checkout() && ! is_wc_endpoint_url( 'view-order' ) )
		) {
			return;
		}
		?>
		<style>
			.alg-pif-dt.textarea{
				cursor: pointer;
			}
			.alg-pif-dt.textarea:after{
				content:'\25bc';
				display:inline-block;
				margin:0 0 0 3px;
				font-size:10px;
			}
			.alg-pif-dt.textarea:hover + .alg-pif-dd, .alg-pif-dd.textarea:hover{
				max-height: 400px;
			}
			.alg-pif-dd.textarea{
				white-space: pre-wrap;
				overflow:hidden;
				max-height:22px;
				transition: max-height 0.4s ease-in-out;
			}
		</style>
		<?php
	}

	/**
	 * add_product_input_fields_to_frontend.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function add_product_input_fields_to_frontend() {
		echo alg_get_frontend_product_input_fields( $this->scope );
	}

	/**
	 * validate_product_input_fields_on_add_to_cart.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function validate_product_input_fields_on_add_to_cart( $passed, $product_id ) {
		$total_number = apply_filters( 'alg_wc_product_input_fields', 1, ( 'local' === $this->scope ? 'per_product_total_fields' : 'all_products_total_fields' ), $product_id );
		for ( $i = 1; $i <= $total_number; $i++ ) {
			$product_input_field = alg_get_all_values( $this->scope, $i, $product_id );
			if ( 'yes' !== $product_input_field['enabled'] ) {
				continue;
			}
			$field_name = ALG_WC_PIF_ID . '_' . $this->scope . '_' . $i;
			// Validate required
			if ( 'yes' === $product_input_field['required'] ) {
				if ( 'file' === $product_input_field['type'] ) {
					$field_value = ( isset( $_FILES[ $field_name ]['name'] ) ) ? $_FILES[ $field_name ]['name'] : '';
				} else {
					$field_value = ( isset( $_POST[ $field_name ] ) )          ?  $_POST[ $field_name ]         : '';
				}
				if ( '' == $field_value ) {
					$passed = false;
					wc_add_notice( str_replace( '%title%', $product_input_field['title'], $product_input_field['required_message'] ), 'error' );
				}
			}
			if ( 'file' === $product_input_field['type'] && isset( $_FILES[ $field_name ] ) && '' != $_FILES[ $field_name ]['name'] ) {
				// Validate file type
				if ( '' != ( $file_accept = $product_input_field['type_file_accept'] ) ) {
					$file_accept = explode( ',', $file_accept );
					if ( is_array( $file_accept ) && ! empty( $file_accept ) ) {
						$file_type = '.' . pathinfo( $_FILES[ $field_name ]['name'], PATHINFO_EXTENSION );
						if ( ! in_array( $file_type, $file_accept ) ) {
							$passed = false;
							wc_add_notice( $product_input_field['type_file_wrong_type_msg'], 'error' );
						}
					}
				}
				// Validate file max size
				if ( $product_input_field['type_file_max_size'] > 0 ) {
					if ( $_FILES[ $field_name ]['size'] > $product_input_field['type_file_max_size'] ) {
						$passed = false;
						wc_add_notice( $product_input_field['type_file_max_size_msg'], 'error' );
					}
				}
			}
		}
		return $passed;
	}

	/**
	 * add_product_input_fields_to_cart_item_data - from $_POST to $cart_item_data
	 *
	 * @version 1.1.4
	 * @since   1.0.0
	 */
	function add_product_input_fields_to_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
		$product_input_fields = array();
		$total_number = apply_filters( 'alg_wc_product_input_fields', 1, ( 'local' === $this->scope ? 'per_product_total_fields' : 'all_products_total_fields' ), $product_id );
		for ( $i = 1; $i <= $total_number; $i++ ) {
			$product_input_field = alg_get_all_values( $this->scope, $i, $product_id );
			if ( 'yes' !== $product_input_field['enabled'] ) {
				continue;
			}
			$product_input_field['_plugin_version'] = ALG_WC_PIF_VERSION;
			$product_input_field['_field_nr'] = $i;
			$field_name = ALG_WC_PIF_ID . '_' . $this->scope . '_' . $i;
			if ( 'file' === $product_input_field['type'] ) {
				if ( isset( $_FILES[ $field_name ] ) && '' != $_FILES[ $field_name ] && isset( $_FILES[ $field_name ]['tmp_name'] ) && '' != $_FILES[ $field_name ]['tmp_name'] ) {
					$product_input_field['_value'] = $_FILES[ $field_name ];
					$tmp_dest_file = tempnam( sys_get_temp_dir(), 'alg' );
					move_uploaded_file( $_FILES[ $field_name ]['tmp_name'], $tmp_dest_file );
					$product_input_field['_value']['_tmp_name'] = $tmp_dest_file;
				}
			} else {
				if ( isset( $_POST[ $field_name ] ) ) {
					$value = stripslashes_deep( $_POST[ $field_name ] );
					if ( $product_input_field['type'] == 'textarea' ) {
						$value = sanitize_textarea_field( $value );
					} else {
						$value = ! is_array( $value ) ? sanitize_text_field( $value ) : array_map( 'sanitize_text_field', $value );
					}
					$product_input_field['_value'] = $value;
				}
			}
			$product_input_fields[] = $product_input_field;
		}
		if ( ! empty( $product_input_fields ) ) {
			$cart_item_data[ ALG_WC_PIF_ID . '_' . $this->scope ] = $product_input_fields;
		}
		return $cart_item_data;
	}

	/**
	 * get_cart_item_product_input_fields_from_session.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function get_cart_item_product_input_fields_from_session( $item, $values, $key ) {
		if ( isset( $values[ ALG_WC_PIF_ID . '_' . $this->scope ] ) ) {
			$item[ ALG_WC_PIF_ID . '_' . $this->scope ] = $values[ ALG_WC_PIF_ID . '_' . $this->scope ];
		}
		return $item;
	}

	/**
	 * Adds product input values to cart item details.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function add_product_input_fields_to_cart_item_name( $name, $cart_item, $cart_item_key  ) {
		return $this->add_product_input_fields_to_order_item_name( $name, $cart_item, true );
	}

	/**
	 * Adds product input values to order details (and emails).
	 *
	 * @version 1.1.4
	 * @since   1.0.0
	 */
	function add_product_input_fields_to_order_item_name( $name, $item, $is_cart = false ) {
		$product_input_fields_html = '';
		$product_input_fields = isset( $item[ ALG_WC_PIF_ID . '_' . $this->scope ] ) ? maybe_unserialize( $item[ ALG_WC_PIF_ID . '_' . $this->scope ] ) : array();
		foreach ( $product_input_fields as $product_input_field ) {
			$value = isset( $product_input_field['_value'] ) ? $product_input_field['_value'] : '';
			if ( 'checkbox' === $product_input_field['type'] ) {
				$value = ( 'yes' === $value ) ? $product_input_field['type_checkbox_yes'] : $product_input_field['type_checkbox_no'];
			}
			if ( 'file' === $product_input_field['type'] ) {
				$value = maybe_unserialize( $value );
				$value = ( isset( $value['name'] ) ) ? $value['name'] : '';
			}
			if ( '' != $value ) {
				$value = is_array( $value ) ? implode( ", ", $value ) : $value;
				if (
					$is_cart ||
					$product_input_field['type'] == 'textarea'
				) {
					$product_input_fields_html .= '<dt class="alg-pif-dt ' . $product_input_field['type'] . '">' . $product_input_field['title'] . '</dt>' . '<dd class="alg-pif-dd ' . $product_input_field['type'] . '">' . $value . '</dd>' /* . '<pre>' . print_r( $product_input_field, true ) . '</pre>' */;
				} else {
					$product_input_fields_html .= str_replace( array( '%title%', '%value%' ), array( $product_input_field['title'], $value ), get_wc_pif_option( 'frontend_order_table_format', '&nbsp;| %title% %value%' ) );
				}
			}
		}
		if ( '' != $product_input_fields_html ) {
			if ( $is_cart ) {
				$name .= '<dl style="font-size:smaller;">';
			}
			$name .= $product_input_fields_html;
			if ( $is_cart ) {
				$name .= '</dl>';
			}
		}
		return $name;
	}

	/**
	 * save_values_in_item.
	 *
	 * @version 1.1.1
	 * @since   1.1.1
	 */
	function save_values_in_item( $item, $cart_item_key, $values, $order ) {
		$pif_values = ALG_WC_PIF_ID . '_' . 'values';
		$item->$pif_values = $values;
	}

	/**
	 * add_product_input_fields_to_order_item_meta_wc3.
	 *
	 * @version 1.1.1
	 * @since   1.1.1
	 */
	function add_product_input_fields_to_order_item_meta_wc3( $item_id, $item, $order_id ) {
		$pif_values = ALG_WC_PIF_ID . '_' . 'values';
		if ( isset( $item->$pif_values ) ) {
			$this->add_product_input_fields_to_order_item_meta( $item_id, $item->$pif_values, null );
		}
	}

	/**
	 * add_product_input_fields_to_order_item_meta.
	 *
	 * @version 1.1.4
	 * @since   1.0.0
	 * @todo    (maybe) rethink filename (maybe order ID + $item_id)
	 */
	function add_product_input_fields_to_order_item_meta( $item_id, $values, $cart_item_key ) {
		$product_input_fields  = ( isset( $values[ ALG_WC_PIF_ID . '_' . $this->scope ] ) ? $values[ ALG_WC_PIF_ID . '_' . $this->scope ] : array() );
		$_product_input_fields = array();
		foreach ( $product_input_fields as $product_input_field ) {
			if (
				'file' === $product_input_field['type'] &&
				isset ( $product_input_field['_value'] )
			) {
				$value = $product_input_field['_value'];
				if ( '' != ( $tmp_name = $value['_tmp_name'] ) ) {
					$name       = $item_id . '_' . $value['name'];
					$upload_dir = alg_get_uploads_dir( 'product_input_fields' );
					if ( ! file_exists( $upload_dir ) ) {
						mkdir( $upload_dir, 0755, true );
					}
					$upload_dir_and_name = $upload_dir . '/' . $name;
					$file_data           = file_get_contents( $tmp_name );
					file_put_contents( $upload_dir_and_name, $file_data );
					unlink( $tmp_name );
					$value['_tmp_name']            = addslashes( $upload_dir_and_name );
					$product_input_field['_value'] = $value;
				}
			}
			$_product_input_fields[] = $product_input_field;
		}
		wc_add_order_item_meta( $item_id, '_' . ALG_WC_PIF_ID . '_' . $this->scope, $_product_input_fields );
	}

	/**
	 * output_custom_input_fields_in_admin_order.
	 *
	 * @version 1.2.0
	 * @since   1.0.0
	 * @todo    (later) make fields editable
	 */
	function output_custom_input_fields_in_admin_order( $item_id, $item, $_product, $echo = true, $simple_text = false ) {
		if ( null === $_product ) {
			// Shipping
			return;
		}
		if ( version_compare( get_option( 'woocommerce_version', null ), '3.0.0', '<' ) ) {
			if ( ! isset( $item[ ALG_WC_PIF_ID . '_' . $this->scope ] ) || ! is_serialized( $item[ ALG_WC_PIF_ID . '_' . $this->scope ] ) ) {
				return;
			}
		} else {
			if ( ! $item->meta_exists( '_' . ALG_WC_PIF_ID . '_' . $this->scope ) ) {
				return;
			}
		}
		$html                 = '';
		$product_input_fields = ( version_compare( get_option( 'woocommerce_version', null ), '3.0.0', '<' ) ?
			unserialize( $item[ ALG_WC_PIF_ID . '_' . $this->scope ] ) :
			$item->get_meta( '_' . ALG_WC_PIF_ID . '_' . $this->scope )
		);

		foreach ( $product_input_fields as $product_input_field ) {
			if ( ! (
				isset( $product_input_field['title'] ) &&
				isset( $product_input_field['_field_nr'] ) &&
				isset( $product_input_field['_value'] ) &&
				isset( $product_input_field['type'] )
			) ) {
				continue;
			}
			$title = $product_input_field['title'];
			if ( '' == $title ) {
				$title = __( 'Product Input Field', 'product-input-fields-for-woocommerce' ) . ' (' . $this->scope . ') #' . $product_input_field['_field_nr'];
			}
			$_value = $product_input_field['_value'];
			if ( 'file' === $product_input_field['type'] ) {
				$_value = maybe_unserialize( $_value );
				$_value = ( isset( $_value['name'] ) && '' != $_value['name'] ) ?
					'<a href="' . add_query_arg( 'alg_wc_pif_download_file', $item_id . '_' . $_value['name'] ) . '">' . $_value['name'] . '</a>' : '';
			}
			if ( '' != $_value ) {
				$_value = is_array( $_value ) ? implode( ", ", $_value ) : $_value;
				if ( $simple_text ) {
					$html .= "\n" . $title . ': ' . $_value;
				} else {
					$html .= '<div class="wc-order-item-variation"><strong>' . $title . ':</strong> ' . $_value . '</div>';
				}
			}
		}
		if ( $echo ) {
			echo $html;
		} else {
			return $html;
		}
	}

	/**
	 * add_files_to_email_attachments.
	 *
	 * @version 1.1.4
	 * @since   1.0.0
	 */
	function add_files_to_email_attachments( $attachments, $status, $order ) {
		if (
			( 'new_order'                 === $status && 'yes' === get_wc_pif_option( 'attach_to_admin_new_order',           'yes' ) ) ||
			( 'customer_processing_order' === $status && 'yes' === get_wc_pif_option( 'attach_to_customer_processing_order', 'yes' ) )
		) {
			foreach ( $order->get_items() as $item_key => $item ) {
				$product_input_fields = maybe_unserialize( $item[ ALG_WC_PIF_ID . '_' . $this->scope ] );
				if ( ! is_array( $product_input_fields ) || empty( $product_input_fields ) ) {
					continue;
				}
				foreach ( $product_input_fields as $product_input_field ) {
					if (
						isset( $product_input_field['type'] ) &&
						'file' === $product_input_field['type'] &&
						isset( $product_input_field['_value'] )
					) {
						$_value = $product_input_field['_value'];
						$_value = maybe_unserialize( $_value );
						if ( isset( $_value['_tmp_name'] ) ) {
							$file_path = $_value['_tmp_name'];
							$attachments[] = $file_path;
						}
					}
				}
			}
		}
		return $attachments;
	}

}

endif;