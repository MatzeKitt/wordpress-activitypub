<?php
/**
 * Multisite Language Switcher integration class file.
 *
 * @package Activitypub
 */

namespace Activitypub\Integration;

use Activitypub\Collection\Outbox;

/**
 * Compatibility with the Multisite Language Switcher plugin.
 *
 * @see https://github.com/lloc/Multisite-Language-Switcher/
 */
class Multisite_Language_Switcher {
	/**
	 * Initialize the class, registering WordPress hooks.
	 */
	public static function init() {
		\add_action( 'save_post_' . Outbox::POST_TYPE, array( self::class, 'ignore_outbox_post' ), 9 );
		\add_action( 'save_post_' . Outbox::POST_TYPE, array( self::class, 'unignore_outbox_post' ), 11 );
	}

	/**
	 * Short-circuit saving Multisite Language Switcher data for the Outbox post type.
	 */
	public static function ignore_outbox_post() {
		\add_action( 'msls_main_save', '__return_null' );
	}

	/**
	 * Remove short-circuit for Multisite Language Switcher data.
	 */
	public static function unignore_outbox_post() {
		\remove_action( 'msls_main_save', '__return_null' );
	}
}
