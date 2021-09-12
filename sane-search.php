<?php
/**
 * Plugin Name:     Sane Search
 * Plugin URI:      https://coloredcow.com
 * Description:     Make WordPress search sane.
 * Author:          ColoredCow
 * Author URI:      https://coloredcow.com
 * Text Domain:     sane-search
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         Sane_Search
 */

defined( 'ABSPATH' ) || exit;

add_action( 'parse_query', 'ss_set_decoded_search_string' );

/**
 * Set search query variable with the decoded value.
 *
 * @param  WP_Query $query WordPress Query object.
 * @return void
 */
function ss_set_decoded_search_string( $query ) {
	if ( is_admin() || ! $query->is_search ) {
		return;
	}

	$search_string  = $query->query_vars['s'];
	$decoded_string = quoted_printable_decode( str_replace( '%', '=', $search_string ) );

	$query->query_vars['s'] = $decoded_string;
}
