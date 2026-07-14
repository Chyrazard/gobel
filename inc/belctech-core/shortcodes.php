<?php

/*
Display current year:
[current_year]
*/
if (!function_exists('belctech_current_year_shortcode')) {
	function belctech_get_current_year_shortcode() {
		$year = date_i18n ('Y');
		return $year;
	}

	add_shortcode ('current_year', 'belctech_get_current_year_shortcode');
}


/*
Progress bar shortcode amount left:
[missing_amount]
*/

function belctech_progress_bar_amount_left() {

	// WCML compatible
	$goal = apply_filters( 'wcml_raw_price_amount', get_theme_mod('progress_bar_goal', 0) );

	// WOOCS conversion
	if (class_exists('WOOCS')) {
		global $WOOCS;
		$goal = $WOOCS->woocs_exchange_value($goal);
	}

	// Additional filter for other changes
	$goal = apply_filters('belctech_progress_bar_goal_amount', $goal);

	$subtotal = WC()->cart->get_subtotal();
	if (get_theme_mod('progress_bar_subtotal_taxes', true)) {
	$tax = WC()->cart->get_subtotal_tax();
		$subtotal = $subtotal + $tax;
	}

	$subtotal = apply_filters('belctech_progress_bar_current_value', $subtotal);

	$amount_left = apply_filters('belctech_progress_bar_amount_left', wc_price( $goal - $subtotal, array('decimals' => get_option('woocommerce_price_num_decimals'))));

	return $amount_left;
}

add_shortcode ('missing_amount', 'belctech_progress_bar_amount_left');