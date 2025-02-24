<?php
/**
 * Plugin Name: Instant Order Redirect for WooCommerce
 * Description: Adds a "Buy Now" button below the Add to Cart button that redirects users to the checkout page with the product added, and buttons for WhatsApp and Messenger.
 * Version: 1.8
 * Author: Md Parvez
 */

// Add menu item for the settings page
function iom_add_settings_menu() {
    add_menu_page(
        'Instant Order Redirect Settings', // Page title
        'Instant Order Redirect',          // Menu title
        'manage_options',                  // Capability
        'iom-settings',                    // Menu slug
        'iom_render_settings_page',        // Callback function to render the settings page
        'dashicons-cart',                  // Icon
        55                                 // Position
    );
}
add_action( 'admin_menu', 'iom_add_settings_menu' );

// Render the settings page content
function iom_render_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Instant Order Redirect Settings', 'woocommerce' ); ?></h1>

        <form method="post" action="options.php">
            <?php
            // Security field for the settings page
            settings_fields( 'iom_settings_group' );

            // Display the settings fields
            do_settings_sections( 'iom-settings' );
            ?>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register settings and fields
function iom_register_settings() {
    // Register the settings group
    register_setting( 'iom_settings_group', 'iom_settings' );

    // Add a section for our settings
    add_settings_section(
        'iom_section', // Section ID
        'Instant Order Redirect', // Section title
        '', // Section callback (not needed)
        'iom-settings' // Page slug
    );

    // Add WhatsApp Number field
    add_settings_field(
        'iom_whatsapp_number', // Field ID
        'WhatsApp Number', // Field Title
        'iom_whatsapp_number_callback', // Callback function to render the field
        'iom-settings', // Page slug
        'iom_section' // Section ID
    );

    // Add Messenger Link field
    add_settings_field(
        'iom_messenger_link', // Field ID
        'Messenger Link', // Field Title
        'iom_messenger_link_callback', // Callback function to render the field
        'iom-settings', // Page slug
        'iom_section' // Section ID
    );
}
add_action( 'admin_init', 'iom_register_settings' );

// Callback for the WhatsApp Number field
function iom_whatsapp_number_callback() {
    $options = get_option( 'iom_settings' );
    ?>
    <input type="text" name="iom_settings[iom_whatsapp_number]" value="<?php echo esc_attr( $options['iom_whatsapp_number'] ?? '' ); ?>" class="regular-text" />
    <p class="description">Enter the WhatsApp number (include country code without '+' sign). Example: 1234567890</p>
    <?php
}

// Callback for the Messenger Link field
function iom_messenger_link_callback() {
    $options = get_option( 'iom_settings' );
    ?>
    <input type="text" name="iom_settings[iom_messenger_link]" value="<?php echo esc_attr( $options['iom_messenger_link'] ?? '' ); ?>" class="regular-text" />
    <p class="description">Enter the full Messenger chat link. Example: https://m.me/yourusername</p>
    <?php
}



function iom_add_buttons_below_add_to_cart() {
    global $product;

    // Ensure this is a WooCommerce product page
    if( !is_product() || !class_exists( 'WooCommerce' ) ) return;

    // Get the settings values
    $options = get_option( 'iom_settings' );
    $whatsapp_link = $options['iom_whatsapp_number'] ?? '';
    $messenger_link = $options['iom_messenger_link'] ?? '';

    // AJAX URL for handling cart clearance before checkout
    $ajax_url = admin_url('admin-ajax.php');
    $product_id = $product->get_id();
    ?>
    <script type="text/javascript">
        function instantBuyNow(productId) {
            jQuery.post('<?php echo esc_url($ajax_url); ?>', {
                action: 'iom_clear_cart_add_product',
                product_id: productId
            }, function(response) {
                window.location.href = "<?php echo esc_url(wc_get_checkout_url()); ?>";
            });
        }
    </script>

    <button type="button" class="btn btn-primary buyNow" onclick="instantBuyNow(<?php echo esc_js($product_id); ?>)">
        Buy Now
    </button>
    
    <?php if ( !empty( $whatsapp_link ) ): ?>
    <button type="button" class="btn btn-success BthWapp" onclick="window.location.href='https://wa.me/<?php echo esc_attr( $whatsapp_link ); ?>'">
        Chat on WhatsApp
    </button>
    <?php endif; ?>
    
    <?php if ( !empty( $messenger_link ) ): ?>
    <button type="button" class="btn btn-info messengerWp" onclick="window.location.href='<?php echo esc_url( $messenger_link ); ?>'">
        Chat on Messenger
    </button>
    <?php endif; ?>
    <?php
}
add_action( 'woocommerce_after_add_to_cart_button', 'iom_add_buttons_below_add_to_cart', 10 );

// Handle AJAX request to clear cart and add new product
function iom_clear_cart_add_product() {
    if ( isset($_POST['product_id']) ) {
        WC()->cart->empty_cart(); // Clear existing cart
        WC()->cart->add_to_cart(intval($_POST['product_id'])); // Add new product
        wp_send_json_success();
    }
    wp_send_json_error();
}
add_action( 'wp_ajax_iom_clear_cart_add_product', 'iom_clear_cart_add_product' );
add_action( 'wp_ajax_nopriv_iom_clear_cart_add_product', 'iom_clear_cart_add_product' );
