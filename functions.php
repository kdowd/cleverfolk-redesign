<?php

// https://stripe.com/docs/testing#cards
// https://passwordprotectwp.com/submit-websites-to-search-engines/
// https://passwordprotectwp.com/how-to-index-your-page-on-search-engine/
// https://www.adyen.com/payment-methods?country=Australia
// UP TO DATE //////////
// https://woocommerce.github.io/code-reference/hooks/hooks.html


// nice - wp_send_json($array_result);
// Don't forget to stop execution afterward.
// wp_die();
//do_action("wp_ajax_{$action}");

if (!defined('CODE_BASE')) {
	define('CODE_BASE', get_template_directory_uri());
}


if (!defined('CURRENT_VERSION')) {
	define('CURRENT_VERSION', '1.03');
}

if (!defined('DEV_MODE')) {
	define('DEV_MODE', true);
}


// Handle Customizer settings
require get_template_directory() . '/inc/classes/class-mcluhan-customize.php';


/*	-----------------------------------------------------------------------------------------------
	ENQUEUE STYLES
--------------------------------------------------------------------------------------------------- */

if (!function_exists('mcluhan_load_style')) :
	function mcluhan_load_style()
	{

		$dependencies = array();
		$theme_version = wp_get_theme('mcluhan')->get('Version');
		$dependencies = array();

		// wp_register_style('mcluhan-fonts', get_theme_file_uri('/assets/css/fonts.css'));
		// $dependencies[] = 'mcluhan-fonts';

		wp_register_style('fontawesome', get_theme_file_uri('/assets/css/font-awesome.css'));
		$dependencies[] = 'fontawesome';

		wp_enqueue_style('mcluhan-style', get_template_directory_uri() . '/style.css', $dependencies, $theme_version);
	}
	add_action('wp_enqueue_scripts', 'mcluhan_load_style');
endif;


/*	-----------------------------------------------------------------------------------------------
	ADD EDITOR STYLES
--------------------------------------------------------------------------------------------------- */

if (!function_exists('mcluhan_add_editor_styles')) :
	function mcluhan_add_editor_styles()
	{
		add_editor_style(array('assets/css/mcluhan-classic-editor-styles.css', 'assets/css/fonts.css'));
	}
	add_action('init', 'mcluhan_add_editor_styles');
endif;



/* ENQUEUE SCRIPTS
------------------------------------------------ */

if (!function_exists('mcluhan_enqueue_scripts')) :
	function mcluhan_enqueue_scripts()
	{

		$theme_version = wp_get_theme('mcluhan')->get('Version');

		wp_enqueue_script('mcluhan_global', get_template_directory_uri() . '/assets/js/global.js', array('jquery', 'imagesloaded', 'masonry'), $theme_version, true);

		// Enqueue comment reply
		if ((!is_admin()) && is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}

		global $wp_query;

		// AJAX PAGINATION
		wp_localize_script('mcluhan_global', 'mcluhan_ajaxpagination', array(
			'ajaxurl'		=> admin_url('admin-ajax.php'),
			'query_vars'	=> wp_json_encode($wp_query->query),
		));
	}
	add_action('wp_enqueue_scripts', 'mcluhan_enqueue_scripts');
endif;




/*	-----------------------------------------------------------------------------------------------
	NO-JS CLASS
--------------------------------------------------------------------------------------------------- */

if (!function_exists('mcluhan_has_js')) {
	function mcluhan_has_js()
	{
?>
		<script>
			jQuery('html').removeClass('no-js').addClass('js');
		</script>
		<?php
	}
}
add_action('wp_head', 'mcluhan_has_js');


/*	-----------------------------------------------------------------------------------------------
	AJAX SEARCH RESULTS
	This function is called to load ajax search results on mobile.
--------------------------------------------------------------------------------------------------- */


if (!function_exists('mcluhan_ajax_results')) {
	function mcluhan_ajax_results()
	{

		$string = json_decode(stripslashes($_POST['query_data']), true);

		if ($string) :

			$args = array(
				's'					=> $string,
				'posts_per_page'	=> 5,
				'post_status'		=> 'publish',
			);

			$ajax_query = new WP_Query($args);

			if ($ajax_query->have_posts()) {

		?>

				<p class="results-title"><?php _e('Search Results', 'mcluhan'); ?></p>

				<ul>

					<?php

					// Custom loop
					while ($ajax_query->have_posts()) :

						$ajax_query->the_post();

						// Load the appropriate content template
						get_template_part('content-mobile-search');

					// End the loop
					endwhile;

					?>

				</ul>

				<?php if ($ajax_query->max_num_pages > 1) : ?>

					<a class="show-all" href="<?php echo esc_url(home_url('?s=' . $string)); ?>"><?php _e('Show all', 'mcluhan'); ?></a>

				<?php endif; ?>

<?php

			} else {

				echo '<p class="no-results-message">' . __('We could not find anything that matches your search query. Please try again.', 'mcluhan') . '</p>';
			} // End if().

		endif; // End if().

		die();
	}
} // End if().
add_action('wp_ajax_nopriv_ajax_pagination', 'mcluhan_ajax_results');
add_action('wp_ajax_ajax_pagination', 'mcluhan_ajax_results');







require __DIR__ . '/inc/mccluhan-basics.php';
require __DIR__ . '/inc/block-editor.php';
require __DIR__ . '/inc/search-functions.php';
//require __DIR__ . '/inc/comment-functions.php';
require __DIR__ . '/inc/body-classes.php';
require __DIR__ . '/inc/slimline-wp.php';
require __DIR__ . '/inc/scripts.php';
require __DIR__ . '/actions/actions.php';
require __DIR__ . '/inc/wc-actions.php';
require __DIR__ . '/inc/widget-areas.php';
require __DIR__ . '/inc/generic-form.php';
require __DIR__ . '/inc/generic-form-response.php';
#require __DIR__ . '/inc/logger.php';
require __DIR__ . '/inc/seo.php';
require __DIR__ . '/inc/utilities.php';
require __DIR__ . '/inc/pretty_print.php';

add_action('parse_request', 'woocommerce_clear_cart_url');
function woocommerce_clear_cart_url()
{
	//https://codex.wordpress.org/Plugin_API/Action_Reference
	//echo "sweet";

	if (isset($_GET['empty-cart'])) {
		logger(WC()->session);
	}

	//WC()->cart->empty_cart();
	//WC()->session->set('cart', array());
	// logger(WC()->session);
}

function wpdocs_set_custom_isvars($query)
{
	logger($query->query_vars->name);
}
//add_action('parse_query', 'wpdocs_set_custom_isvars');


// main hooks for customizations are: 
// see https://stackoverflow.com/questions/54421397/woocommerce-checkout-fields-settings-and-customization-hooks
// NICE = https://woocommerce.com/document/tutorial-customising-checkout-fields-using-actions-and-filters/
//  woocommerce_default_address_fields 
// - woocommerce_checkout_fields 
// - woocommerce_billing_fields 
// - woocommerce_shipping_fields 
// - woocommerce_form_field_{$args\[type\]} 

// email is needed for billing
add_filter('woocommerce_billing_fields', 'phone_optional_field');

function phone_optional_field($fields)
{
	$fields['billing_phone']['required'] = false;
	return $fields;
}



add_filter('woocommerce_product_query_meta_query', 'filter_product_query_meta_query', 10, 2);
function filter_product_query_meta_query($meta_query, $query)
{

	if (is_shop()) {
		// logger($meta_query);
		// Exclude products "out of stock"
		$meta_query[] = array(
			'key' => '_stock_status',
			'value' => 'outofstock',
			'compare' => '!=',
		);
	}




	return $meta_query;
}


/////////////////////////////////////////////////////////////////////////////
//https://iconicwp.com/blog/display-woocommerce-attributes-on-the-shop-page/



/**
 * Display available attributes.
 * 
 * @return array|void
 */
function iconic_available_attributes()
{
	global $product;
	logger($product);
}


add_action('woocommerce_after_shop_loop_item_title', 'cstm_display_product_category', 5);
// WORKS
//You can use a product global object and it's methods in Woocommerce 4.3
function cstm_display_product_category()
{
	global $product;
	$size = $product->get_attribute('std');

	if (isset($size)) {
		echo '<div class="items"><p>Size: ' . $size . '</p></div>';
	}
}


add_action('admin_init', 'disable_autosave');
function disable_autosave()
{
	wp_deregister_script('autosave');
}


function defer_parsing_of_js($url)
{
	if (FALSE === strpos($url, '.js')) return $url;
	if (strpos($url, 'jquery.js')) return $url;
	return "$url' defer ";
}
#add_filter('clean_url', 'defer_parsing_of_js', 11, 1);