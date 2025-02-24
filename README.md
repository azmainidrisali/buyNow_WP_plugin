# Instant Order Redirect for WooCommerce

**Version:** 1.8  
**Author:** Md Parvez  
**Requires WordPress Version:** 5.0+  
**Requires WooCommerce Version:** 3.0+  
**License:** GPL-2.0+

## Description
Instant Order Redirect for WooCommerce enhances the shopping experience by adding a "Buy Now" button below the "Add to Cart" button on product pages. This button allows customers to instantly proceed to checkout with the selected product. Additionally, the plugin provides quick chat buttons for WhatsApp and Messenger, enabling direct communication with customers.

## Features
- **Instant Buy Now Button:** Redirects users to the checkout page with the selected product immediately added to the cart.
- **WhatsApp Chat Button:** Allows customers to contact store owners via WhatsApp.
- **Messenger Chat Button:** Enables direct communication via Facebook Messenger.
- **Customizable Settings:** Configure WhatsApp number and Messenger link from the WordPress admin panel.
- **Seamless WooCommerce Integration:** Works flawlessly with WooCommerce product pages.

## Installation

### Automatic Installation
1. Log in to your WordPress dashboard.
2. Navigate to **Plugins > Add New**.
3. Search for "Instant Order Redirect for WooCommerce".
4. Click **Install Now**, then **Activate** the plugin.

### Manual Installation
1. Download the latest version of the plugin.
2. Upload the plugin folder to the `/wp-content/plugins/` directory.
3. Go to **Plugins > Installed Plugins** in your WordPress dashboard.
4. Find "Instant Order Redirect for WooCommerce" and click **Activate**.

## Configuration
1. Navigate to **Instant Order Redirect** from the WordPress admin menu.
2. Enter your **WhatsApp Number** (without `+` sign, e.g., `1234567890`).
3. Enter your **Messenger Chat Link** (e.g., `https://m.me/yourusername`).
4. Click **Save Changes**.

## Usage
- The **Buy Now** button appears automatically on all WooCommerce product pages.
- Clicking the **Buy Now** button clears the cart and redirects the user to checkout with the selected product.
- The **WhatsApp** and **Messenger** buttons appear if their respective settings are configured.

## Hooks & Filters
### Actions
- `woocommerce_after_add_to_cart_button` - Adds the Buy Now, WhatsApp, and Messenger buttons.

### AJAX Endpoints
- `wp_ajax_iom_clear_cart_add_product` - Clears the cart and adds the selected product.
- `wp_ajax_nopriv_iom_clear_cart_add_product` - Enables AJAX functionality for non-logged-in users.

## Screenshots
1. ![image](https://github.com/user-attachments/assets/18c53766-acbf-492b-a817-7a738960ba15)

2. ![image](https://github.com/user-attachments/assets/de775424-09ec-42d6-87e9-5a3aa6e2ca8b)


## Support
For support, please contact Md Parvez.

## Changelog
### v1.8
- Added admin settings for WhatsApp and Messenger chat links.
- Improved security and sanitization of user inputs.
- Enhanced compatibility with WooCommerce latest version.
- Optimized AJAX handling for better performance.

## License
This plugin is licensed under the GPL-2.0+ License. See [LICENSE](LICENSE) for more details.

## Contribution
Pull requests and feature requests are welcome. Feel free to open an issue or contribute to the development.

---
© 2025 Md Parvez. All rights reserved.

