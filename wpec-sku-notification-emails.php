<?php

/*
Plugin Name: WP e-Commerce SKU in notification emails
Plugin URI: http://www.leewillis.co.uk/wordpress-plugins/?utm_source=wordpress&utm_medium=www&utm_campaign=wpec-sku-notification-emails
Description: WP e-Commerce extension that adds the SKU to the notification emails that are produced.
Version: 0.1
Author: Lee Willis
Author URI: http://www.leewillis.co.uk
*/

/**
 * Copyright (c) 2013 Lee Willis. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */

function add_sku_to_table_args( $table_args, $WPSC_Purchase_Log_Notification ) {

	$table_args['headings']['SKU'] = 'left';

	$purchase_log = $WPSC_Purchase_Log_Notification->get_purchase_log();
	$cart_contents = $purchase_log->get_cart_contents();

	foreach( $cart_contents as $key => $cart_item ) {
		$sku = wpsc_product_sku( $cart_item->prodid );
		$table_args['rows'][$key][] = $sku;
	}

	return $table_args;

}
add_filter( 'wpsc_purchase_log_notification_product_table_args', 'add_sku_to_table_args', 10, 3 );